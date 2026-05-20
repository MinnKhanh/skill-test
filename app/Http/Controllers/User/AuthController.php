<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Str;
use App\Factories\CommonFactory;
use App\Helpers\ResponseHelper;
use Illuminate\Http\JsonResponse;
use App\Exceptions\InputException;
use App\Factories\UserFactory;
use App\Http\Resources\User\Auth\MeResource;
use App\Http\Requests\User\Auth\LoginRequest;
use App\Http\Controllers\Traits\HasRateLimiter;
use App\Http\Requests\User\Auth\RegisterRequest;
use App\Http\Requests\User\Auth\UpdateProfileRequest;
use App\Http\Requests\User\Auth\ChangePasswordRequest;
use App\Http\Requests\User\Auth\ForgotPasswordRequest;
use App\Http\Requests\User\Auth\ResetPasswordRequest;

class AuthController extends BaseController
{
    use HasRateLimiter;

    public const MAX_ATTEMPTS_LOGIN = 5;
    public const DECAY_SECONDS = 60;

    /**
     * AuthController constructor.
     */
    public function __construct()
    {
        $this->middleware($this->authMiddleware())->except(['login', 'register', 'forgotPassword', 'resetPassword']);
        $this->middleware($this->guestMiddleware())->only(['login', 'register', 'forgotPassword', 'resetPassword']);
    }

    /**
     * Register
     * @unauthenticated
     *
     * @param RegisterRequest $request
     * @return JsonResponse
     * @throws InputException
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        CommonFactory::getRecaptchaService()->verify(
            $request->input('g-recaptcha-response'),
            $request->ip(),
        );

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

        $data = UserFactory::getAuthService()->register($inputs);

        return $this->sendSuccessResponse($data, trans('auth.register_success'));
    }

    /**
     * Login
     * @unauthenticated
     *
     * @param LoginRequest $request
     * @return JsonResponse
     * @throws InputException
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $ip = $request->ip();
        $inputs = $request->only(['email', 'password']);
        $key = Str::lower($inputs['email'] . '|user_login|' . $ip);
        if ($this->tooManyAttempts($key, self::MAX_ATTEMPTS_LOGIN)) {
            return $this->sendLockoutResponse($key);
        }

        $loginData = UserFactory::getAuthService()->login($inputs);
        if ($loginData) {
            $this->clearLoginAttempts($key);

            return $this->sendSuccessResponse($loginData);
        }

        $this->incrementAttempts($key, self::DECAY_SECONDS);
        if ($this->retriesLeft($key, self::MAX_ATTEMPTS_LOGIN) == 0) {
            throw new InputException(trans('auth.throttle', ['seconds' => self::DECAY_SECONDS]));
        }

        return $this->sendFailedLoginResponse();
    }

    /**
     * Send Failed Login Response
     *
     * @return JsonResponse
     */
    protected function sendFailedLoginResponse(): JsonResponse
    {
        return ResponseHelper::sendResponse(ResponseHelper::STATUS_CODE_UNAUTHORIZED, trans('auth.failed'), null);
    }

    /**
     * Current login user
     *
     * @return JsonResponse
     */
    public function me(): JsonResponse
    {
        $currentUser = $this->guard()->user()?->load('avatarImage');

        return $this->sendSuccessResponse(new MeResource($currentUser));
    }

    /**
     * Update profile
     *
     * @param UpdateProfileRequest $request
     * @return JsonResponse
     * @throws InputException
     */
    public function updateProfile(UpdateProfileRequest $request): JsonResponse
    {
        $inputs = $request->only([
            'name',
        ]);
        $currentUser = $this->guard()->user();

        $data = UserFactory::getAuthService()->withUser($currentUser)->update($inputs);

        return $this->sendSuccessResponse($data, trans('response.update_successfully'));
    }

    /**
     * Change password
     *
     * @param ChangePasswordRequest $request
     * @return JsonResponse
     * @throws InputException
     */
    public function changePassword(ChangePasswordRequest $request): JsonResponse
    {
        $currentUser = $this->guard()->user();
        $inputs = $request->only(['current_password', 'password']);
        $data = UserFactory::getAuthService()->withUser($currentUser)->changePassword($inputs);

        return $this->sendSuccessResponse($data, trans('auth.logout_success'));
    }

    public function forgotPassword(ForgotPasswordRequest $request): JsonResponse
    {
        $message = UserFactory::getAuthService()->sendPasswordResetLink($request->validated('email'));

        return $this->sendSuccessResponse(null, $message);
    }

    public function resetPassword(ResetPasswordRequest $request): JsonResponse
    {
        UserFactory::getAuthService()->resetPassword($request->validated());

        return $this->sendSuccessResponse(null, trans('auth.password_reset_success'));
    }

    /**
     * Logout
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        $currentUser = $this->guard()->user();
        $currentUser->currentAccessToken()->delete();

        return $this->sendSuccessResponse(null, trans('auth.logout_success'));
    }
}
