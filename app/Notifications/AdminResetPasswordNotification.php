<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Common\LocaleLang;
use Illuminate\Contracts\Queue\ShouldQueue;
use Carbon\Carbon;

class AdminResetPasswordNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via()
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $lang = config('app.locale');
        LocaleLang::generateSetLocale($lang);

        $subject  = __('messages.emails.subject_reset_password_admin');

        $emailEnCode = urlencode($notifiable->email);

        $makeSuffixUrl = "cachekey=".config('custom.cache.reset_email_code')."&email={$emailEnCode}&token={$this->token}";

        $expiredAt = Carbon::now()->addDays(7)->format('Y-m-d');

        $compactData   = [
            'notifiable' => $notifiable,
            'url'  => $this->getLinkResetPassword($makeSuffixUrl, $notifiable),
            'expiredAt' => $expiredAt
        ];

        return (new MailMessage)
            ->subject($subject)
            ->markdown("emails_{$lang}.admin_reset_password", $compactData);
    }

    protected function getLinkResetPassword(string $makeSuffixUrl)
    {
        $adminUrl =  config('app.admin_url');

        return $adminUrl . '/reset-password?' . $makeSuffixUrl;
    }
}
