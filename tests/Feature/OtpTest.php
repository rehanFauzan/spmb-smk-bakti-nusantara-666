<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Otp;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;

class OtpTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_generate_otp()
    {
        $email = 'test@example.com';
        $otpRecord = Otp::generateOtp($email);

        $this->assertNotNull($otpRecord);
        $this->assertEquals($email, $otpRecord->email);
        $this->assertEquals(6, strlen($otpRecord->otp));
        $this->assertFalse($otpRecord->is_used);
    }

    public function test_can_verify_valid_otp()
    {
        $email = 'test@example.com';
        $otpRecord = Otp::generateOtp($email);

        $result = Otp::verifyOtp($email, $otpRecord->otp);

        $this->assertTrue($result);
        
        // OTP should be marked as used
        $otpRecord->refresh();
        $this->assertTrue($otpRecord->is_used);
    }

    public function test_cannot_verify_invalid_otp()
    {
        $email = 'test@example.com';
        Otp::generateOtp($email);

        $result = Otp::verifyOtp($email, '000000');

        $this->assertFalse($result);
    }

    public function test_cannot_verify_expired_otp()
    {
        $email = 'test@example.com';
        $otpRecord = Otp::create([
            'email' => $email,
            'otp' => '123456',
            'expires_at' => now()->subMinutes(10), // Expired
            'is_used' => false
        ]);

        $result = Otp::verifyOtp($email, '123456');

        $this->assertFalse($result);
    }

    public function test_registration_sends_otp_email()
    {
        Mail::fake();

        $response = $this->post('/pendaftaran/register', [
            'nama_lengkap' => 'Test User',
            'email' => 'test@example.com',
            'no_hp' => '08123456789',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'terms' => '1'
        ]);

        Mail::assertSent(OtpMail::class, function ($mail) {
            return $mail->hasTo('test@example.com');
        });

        $response->assertRedirect();
        $this->assertDatabaseHas('otps', [
            'email' => 'test@example.com'
        ]);
    }

    public function test_successful_otp_verification_creates_user()
    {
        // Setup session data
        session([
            'temp_registration' => [
                'nama_lengkap' => 'Test User',
                'email' => 'test@example.com',
                'no_hp' => '08123456789',
                'password' => 'password123'
            ]
        ]);

        $otpRecord = Otp::generateOtp('test@example.com');

        $response = $this->post('/pendaftaran/verify-otp', [
            'email' => 'test@example.com',
            'otp' => $otpRecord->otp
        ]);

        $response->assertRedirect('/pendaftaran/form');
        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
            'name' => 'Test User'
        ]);
        $this->assertAuthenticated();
    }

    public function test_can_resend_otp()
    {
        Mail::fake();

        session([
            'temp_registration' => [
                'nama_lengkap' => 'Test User',
                'email' => 'test@example.com',
                'no_hp' => '08123456789',
                'password' => 'password123'
            ]
        ]);

        $response = $this->post('/pendaftaran/resend-otp', [
            'email' => 'test@example.com'
        ]);

        Mail::assertSent(OtpMail::class);
        $response->assertRedirect();
        $this->assertDatabaseHas('otps', [
            'email' => 'test@example.com'
        ]);
    }
}