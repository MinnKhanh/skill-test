<?php

namespace Tests\Feature\Auth;

use App\Enums\UserStatus;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    protected function tearDown(): void
    {
        RateLimiter::clear('user@example.com|web_login|127.0.0.1');
        RateLimiter::clear('user@example.com|user_login|127.0.0.1');
        RateLimiter::clear('admin@example.com|admin_login|127.0.0.1');

        parent::tearDown();
    }

    public function test_login_page_is_visible(): void
    {
        $response = $this->get('/login');

        $response->assertOk()
            ->assertSee('Sign in')
            ->assertSee('Email')
            ->assertSee('Remember me');
    }

    public function test_web_user_can_login_with_valid_credentials(): void
    {
        $user = User::factory()->create([
            'email' => 'user@example.com',
            'password' => Hash::make('password123'),
            'status' => UserStatus::ACTIVE,
        ]);

        $response = $this->from('/login')->post('/login', [
            'email' => ' USER@EXAMPLE.COM ',
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('home'));
        $this->assertAuthenticatedAs($user, 'web');
    }

    public function test_web_login_rejects_invalid_credentials(): void
    {
        User::factory()->create([
            'email' => 'user@example.com',
            'password' => Hash::make('password123'),
            'status' => UserStatus::ACTIVE,
        ]);

        $response = $this->from('/login')->post('/login', [
            'email' => 'user@example.com',
            'password' => 'wrong-password',
        ]);

        $response->assertRedirect('/login')
            ->assertSessionHasErrors('email');
        $this->assertGuest('web');
    }

    public function test_web_login_rejects_inactive_users(): void
    {
        User::factory()->create([
            'email' => 'user@example.com',
            'password' => Hash::make('password123'),
            'status' => UserStatus::INACTIVE,
        ]);

        $response = $this->from('/login')->post('/login', [
            'email' => 'user@example.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/login')
            ->assertSessionHasErrors('email');
        $this->assertGuest('web');
    }

    public function test_web_login_validation_redirects_back_with_errors(): void
    {
        $response = $this->from('/login')->post('/login', [
            'email' => 'not-an-email',
            'password' => '',
        ]);

        $response->assertRedirect('/login')
            ->assertSessionHasErrors(['email', 'password']);
    }

    public function test_user_api_login_returns_token_for_active_user(): void
    {
        User::factory()->create([
            'email' => 'user@example.com',
            'password' => Hash::make('password123'),
            'status' => UserStatus::ACTIVE,
        ]);

        $response = $this->postJson('/api/auth/login', [
            'email' => 'user@example.com',
            'password' => 'password123',
        ]);

        $response->assertOk()
            ->assertJsonStructure([
                'message',
                'errors',
                'data' => ['access_token', 'type_token'],
            ])
            ->assertJsonPath('data.type_token', 'Bearer');
    }

    public function test_user_api_login_rejects_inactive_user(): void
    {
        User::factory()->create([
            'email' => 'user@example.com',
            'password' => Hash::make('password123'),
            'status' => UserStatus::INACTIVE,
        ]);

        $response = $this->postJson('/api/auth/login', [
            'email' => 'user@example.com',
            'password' => 'password123',
        ]);

        $response->assertUnauthorized()
            ->assertJsonStructure(['message', 'errors', 'data']);
    }

    public function test_admin_api_login_rejects_inactive_admin(): void
    {
        Admin::query()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'status' => UserStatus::INACTIVE,
        ]);

        $response = $this->postJson('/admin/auth/login', [
            'email' => 'admin@example.com',
            'password' => 'password123',
        ]);

        $response->assertUnauthorized()
            ->assertJsonStructure(['message', 'errors', 'data']);
    }

    public function test_web_user_can_register_with_profile_and_avatar(): void
    {
        config(['services.recaptcha.enabled' => false]);
        Storage::fake('upload');

        $response = $this->from('/register')->post('/register', [
            'first_name' => 'Bao',
            'last_name' => 'Khanh',
            'age' => 25,
            'gender' => 'male',
            'birth_date' => '2001-01-01',
            'avatar' => UploadedFile::fake()->image('avatar.png', 300, 300),
            'email' => 'new-user@example.com',
            'password' => 'Password1!',
            'password_confirmation' => 'Password1!',
        ]);

        $response->assertRedirect(route('home'));
        $this->assertAuthenticated('web');
        $this->assertDatabaseHas('users', [
            'email' => 'new-user@example.com',
            'first_name' => 'Bao',
            'last_name' => 'Khanh',
            'age' => 25,
            'gender' => 'male',
        ]);
        $this->assertDatabaseHas('images', [
            'type' => 'avatar',
        ]);
    }

    public function test_user_api_register_fails_when_recaptcha_is_invalid(): void
    {
        config([
            'services.recaptcha.enabled' => true,
            'services.recaptcha.secret_key' => 'secret',
        ]);
        Http::fake([
            config('services.recaptcha.verify_url') => Http::response(['success' => false], 200),
        ]);

        $response = $this->postJson('/api/auth/register', [
            'first_name' => 'Bao',
            'last_name' => 'Khanh',
            'age' => 25,
            'gender' => 'male',
            'birth_date' => '2001-01-01',
            'email' => 'new-user@example.com',
            'password' => 'Password1!',
            'password_confirmation' => 'Password1!',
            'g-recaptcha-response' => 'bad-token',
        ]);

        $response->assertBadRequest()
            ->assertJsonStructure(['message', 'errors', 'data']);
    }

    public function test_forgot_password_returns_safe_status_and_sends_notification(): void
    {
        Notification::fake();
        $user = User::factory()->create(['email' => 'user@example.com']);

        $response = $this->from('/forgot-password')->post('/forgot-password', [
            'email' => 'user@example.com',
        ]);

        $response->assertRedirect('/forgot-password')
            ->assertSessionHas('status', trans('auth.password_reset_link_sent'));
        Notification::assertSentTo($user, ResetPassword::class);
    }

    public function test_user_can_reset_password_with_valid_token(): void
    {
        $user = User::factory()->create([
            'email' => 'user@example.com',
            'password' => Hash::make('Oldpass1!'),
        ]);
        $token = Password::broker('users')->createToken($user);

        $response = $this->post('/reset-password', [
            'token' => $token,
            'email' => 'user@example.com',
            'password' => 'Newpass1!',
            'password_confirmation' => 'Newpass1!',
        ]);

        $response->assertRedirect(route('login'))
            ->assertSessionHas('status', trans('auth.password_reset_success'));
        $this->assertTrue(Hash::check('Newpass1!', $user->fresh()->password));
    }
}
