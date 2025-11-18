<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;

class TestEmailCommand extends Command
{
    protected $signature = 'email:test {email} {--name=Test User}';
    protected $description = 'Test email configuration by sending OTP email';

    public function handle()
    {
        $email = $this->argument('email');
        $name = $this->option('name');
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        $this->info("Sending test OTP email to: {$email}");
        $this->info("OTP Code: {$otp}");

        try {
            Mail::to($email)->send(new OtpMail($otp, $name));
            $this->info("✅ Email sent successfully!");
        } catch (\Exception $e) {
            $this->error("❌ Failed to send email: " . $e->getMessage());
            return 1;
        }

        return 0;
    }
}