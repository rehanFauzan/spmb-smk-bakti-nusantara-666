<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CheckEmailConfig extends Command
{
    protected $signature = 'email:config';
    protected $description = 'Check email configuration';

    public function handle()
    {
        $this->info('Email Configuration:');
        $this->line('MAIL_MAILER: ' . config('mail.default'));
        $this->line('MAIL_HOST: ' . config('mail.mailers.smtp.host'));
        $this->line('MAIL_PORT: ' . config('mail.mailers.smtp.port'));
        $this->line('MAIL_USERNAME: ' . config('mail.mailers.smtp.username'));
        $this->line('MAIL_ENCRYPTION: ' . config('mail.mailers.smtp.encryption'));
        $this->line('MAIL_FROM_ADDRESS: ' . config('mail.from.address'));
        $this->line('MAIL_FROM_NAME: ' . config('mail.from.name'));
        
        return 0;
    }
}