<?php

namespace App\Services\Auth;

use App\Enums\UserStatus;
use App\Factories\CommonFactory;
use App\Models\User;
use App\Services\Base\Service;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Laravel\Socialite\Contracts\User as SocialiteUser;
use Illuminate\Validation\ValidationException;

class WebAuthService extends Service
{
    /**
     * Handle Web Login attempt
     *
     * @param array $credentials
     * @param bool $remember
     * @return void
     * @throws ValidationException
     */
    public function login(array $credentials, bool $remember = false): void
    {
        $credentials = Arr::only($credentials, ['email', 'password']);
        $credentials['status'] = UserStatus::ACTIVE->value;

        if (!Auth::guard('web')->attempt($credentials, $remember)) {
            throw ValidationException::withMessages([
                'email' => [trans('auth.failed')],
            ]);
        }

        session()->regenerate();
    }

    public function register(array $data): User
    {
        $user = DB::transaction(function () use ($data) {
            $user = User::query()->create([
                'name' => $this->fullName($data),
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'age' => $data['age'],
                'gender' => $data['gender'],
                'birth_date' => $data['birth_date'],
                'email' => Str::lower($data['email']),
                'password' => Hash::make($data['password']),
                'status' => UserStatus::ACTIVE,
            ]);

            if (!empty($data['avatar'])) {
                $image = CommonFactory::getFileService()
                    ->withUser($user)
                    ->uploadImage($data['avatar'], 'avatar');

                $user->update(['avatar_image_id' => $image['id']]);
            }

            return $user->refresh();
        });

        Auth::guard('web')->login($user);
        session()->regenerate();

        return $user;
    }

    public function loginWithGoogle(SocialiteUser $googleUser): User
    {
        if (!$googleUser->getEmail()) {
            throw ValidationException::withMessages([
                'email' => [trans('auth.google_login_failed')],
            ]);
        }

        $user = User::query()
            ->where('google_id', $googleUser->getId())
            ->orWhere('email', $googleUser->getEmail())
            ->first();

        if ($user && $user->status !== UserStatus::ACTIVE) {
            throw ValidationException::withMessages([
                'email' => [trans('auth.failed')],
            ]);
        }

        if (!$user) {
            $user = User::query()->create([
                'name' => $googleUser->getName() ?: $googleUser->getNickname() ?: 'Google User',
                'first_name' => $this->firstNameFromGoogle($googleUser),
                'last_name' => $this->lastNameFromGoogle($googleUser),
                'email' => Str::lower($googleUser->getEmail()),
                'email_verified_at' => now(),
                'password' => Hash::make(Str::password(32)),
                'status' => UserStatus::ACTIVE,
                'google_id' => $googleUser->getId(),
                'google_avatar_url' => $googleUser->getAvatar(),
            ]);
        } else {
            $user->forceFill([
                'google_id' => $user->google_id ?: $googleUser->getId(),
                'google_avatar_url' => $googleUser->getAvatar(),
            ])->save();
        }

        Auth::guard('web')->login($user);
        session()->regenerate();

        return $user;
    }

    public function sendPasswordResetLink(string $email): string
    {
        Password::broker('users')->sendResetLink(['email' => $email]);

        return trans('auth.password_reset_link_sent');
    }

    public function resetPassword(array $data): void
    {
        $status = Password::broker('users')->reset(
            Arr::only($data, ['email', 'password', 'password_confirmation', 'token']),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();
            },
        );

        if ($status !== Password::PASSWORD_RESET) {
            throw ValidationException::withMessages([
                'email' => [trans($status)],
            ]);
        }
    }

    /**
     * Handle Web Logout
     *
     * @return void
     */
    public function logout(): void
    {
        Auth::guard('web')->logout();

        session()->invalidate();
        session()->regenerateToken();
    }

    protected function fullName(array $data): string
    {
        return trim($data['first_name'] . ' ' . $data['last_name']);
    }

    protected function firstNameFromGoogle(SocialiteUser $googleUser): ?string
    {
        $parts = preg_split('/\s+/', trim((string) $googleUser->getName()));

        return $parts[0] ?? null;
    }

    protected function lastNameFromGoogle(SocialiteUser $googleUser): ?string
    {
        $parts = preg_split('/\s+/', trim((string) $googleUser->getName()));

        if (!$parts || count($parts) < 2) {
            return null;
        }

        return implode(' ', array_slice($parts, 1));
    }
}
