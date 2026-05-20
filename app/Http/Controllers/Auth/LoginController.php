<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\InputException;
use App\Http\Controllers\Controller;
use App\Factories\CommonFactory;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Services\Auth\WebAuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    private const MAX_ATTEMPTS_LOGIN = 5;
    private const DECAY_SECONDS = 60;

    public function __construct(protected WebAuthService $authService)
    {
    }

    /**
     * Show the login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        try {
            CommonFactory::getRecaptchaService()->verify(
                $request->input('g-recaptcha-response'),
                $request->ip(),
            );
        } catch (InputException $exception) {
            throw ValidationException::withMessages([
                'g-recaptcha-response' => [$exception->getMessage()],
            ]);
        }

        $inputs = $request->only([
            'first_name',
            'last_name',
            'age',
            'gender',
            'birth_date',
            'email',
            'password',
        ]);
        if ($request->hasFile('avatar')) {
            $inputs['avatar'] = $request->file('avatar');
        }

        $this->authService->register($inputs);

        return redirect()->intended(route('home'))->with('status', trans('auth.register_success'));
    }

    /**
     * Handle a login request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(LoginRequest $request)
    {
        $inputs = $request->validated();
        $key = Str::lower($inputs['email'] . '|web_login|' . $request->ip());

        if (RateLimiter::tooManyAttempts($key, self::MAX_ATTEMPTS_LOGIN)) {
            throw ValidationException::withMessages([
                'email' => [trans('auth.throttle', ['seconds' => RateLimiter::availableIn($key)])],
            ]);
        }

        try {
            $this->authService->login($inputs, $request->boolean('remember'));
        } catch (ValidationException $exception) {
            RateLimiter::hit($key, self::DECAY_SECONDS);

            if (RateLimiter::retriesLeft($key, self::MAX_ATTEMPTS_LOGIN) === 0) {
                throw ValidationException::withMessages([
                    'email' => [trans('auth.throttle', ['seconds' => self::DECAY_SECONDS])],
                ]);
            }

            throw $exception;
        }

        RateLimiter::clear($key);

        return redirect()->intended(route('home'));
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        $this->authService->logout();

        return redirect('/');
    }

    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLinkEmail(ForgotPasswordRequest $request)
    {
        $message = $this->authService->sendPasswordResetLink($request->validated('email'));

        return back()->with('status', $message);
    }

    public function showResetPasswordForm(Request $request, string $token)
    {
        return view('auth.reset-password', [
            'token' => $token,
            'email' => $request->query('email'),
        ]);
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $this->authService->resetPassword($request->validated());

        return redirect()->route('login')->with('status', trans('auth.password_reset_success'));
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $this->authService->loginWithGoogle(Socialite::driver('google')->user());
        } catch (\Throwable $exception) {
            report($exception);

            return redirect()->route('login')->withErrors([
                'email' => trans('auth.google_login_failed'),
            ]);
        }

        return redirect()->intended(route('home'));
    }
}
