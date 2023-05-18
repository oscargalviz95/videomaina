<?php
namespace App\Http\Controllers\API;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;

class CustomResetPasswordNotification extends ResetPasswordNotification
{
    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = url(config('app.url').route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return (new MailMessage)
            ->subject('Restablecer contraseña')
            ->greeting('¡Hola!')
            ->line('Estás recibiendo este correo electrónico porque hemos recibido una solicitud de restablecimiento de contraseña para tu cuenta.')
            ->action('Restablecer contraseña', $url)
            ->line('Este enlace de restablecimiento de contraseña caducará en 60 minutos.')
            ->line('Si no has solicitado un restablecimiento de contraseña, no se requiere ninguna acción adicional.')
            ->salutation('Saludos,'. PHP_EOL . 'Vídeo Mania')
            ->line('Si tienes problemas para hacer clic en el botón "Restablecer contraseña", copia y pega la siguiente URL en tu navegador web: '.$url);
    }
}