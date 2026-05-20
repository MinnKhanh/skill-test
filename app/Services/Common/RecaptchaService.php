<?php

namespace App\Services\Common;

use App\Exceptions\InputException;
use App\Services\Base\Service;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RecaptchaService extends Service
{
    /**
     * @throws InputException
     */
    public function verify(?string $token, ?string $ip = null): void
    {
        if (!config('services.recaptcha.enabled')) {
            return;
        }

        if (!$token) {
            throw new InputException(trans('auth.recaptcha_required'));
        }

        $secret = config('services.recaptcha.secret_key');
        if (!$secret) {
            throw new InputException(trans('auth.recaptcha_not_configured'));
        }

        $response = Http::asForm()
            ->timeout((int) config('services.recaptcha.timeout', 5))
            ->post(config('services.recaptcha.verify_url'), [
                'secret' => $secret,
                'response' => $token,
                'remoteip' => $ip,
            ]);

        if (!$response->ok() || !$response->json('success')) {
            Log::warning('reCAPTCHA verification failed', [
                'domain' => 'auth',
                'action' => 'register',
                'status' => $response->status(),
                'error_codes' => $response->json('error-codes', []),
            ]);

            throw new InputException(trans('auth.recaptcha_failed'));
        }
    }
}
