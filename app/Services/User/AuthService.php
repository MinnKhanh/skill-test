<?php

namespace App\Services\User;

use App\Exceptions\InputException;
use App\Factories\CommonFactory;
use App\Models\User;
use App\Enums\UserStatus;
use App\Services\Base\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthService extends Service
{
    /**
     * Login
     *
     * @param array $data
     * @return array
     * @throws InputException
     */
    public function login(array $data)
    {
        $user = User::query()->where('email', '=', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password) || $user->status !== UserStatus::ACTIVE) {
            return null;
        }

        $token = $user->createToken('authUserToken')->plainTextToken;

        return [
            'access_token' => $token,
            'type_token' => 'Bearer',
        ];
    }

    /**
     * Register
     *
     * @param array $data
     * @return mixed
     * @throws InputException
     */
    public function register(array $data)
    {
        $newUser = DB::transaction(function () use ($data) {
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

        if (!$newUser) {
            throw new InputException(trans('auth.register_fail'));
        }

        return $newUser;
    }

    protected function fullName(array $data): string
    {
        return trim($data['first_name'] . ' ' . $data['last_name']);
    }

    /**
     * Update profile
     *
     * @param $data
     * @return int
     * @throws InputException
     */
    public function update($data)
    {
        $user = $this->user;
        if (!$user) {
            throw new InputException(trans('response.not_found'));
        }

        if ($user->status == UserStatus::INACTIVE) {
            throw new InputException(trans('response.invalid'));
        }

        return User::query()
            ->where('id', '=', $user->id)
            ->update($data);
    }

    /**
     * Change Password
     *
     * @param array $data
     * @return bool
     * @throws InputException
     */
    public function changePassword(array $data)
    {
        $user = $this->user;

        if (!Hash::check($data['current_password'], $user->password)) {
            throw new InputException(trans('auth.password'));
        }

        $user->update([
            'password' => Hash::make($data['password']),
        ]);

        return true;
    }

    public function sendPasswordResetLink(string $email): string
    {
        Password::broker('users')->sendResetLink(['email' => $email]);

        return trans('auth.password_reset_link_sent');
    }

    public function resetPassword(array $data): void
    {
        $status = Password::broker('users')->reset(
            $data,
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
}
