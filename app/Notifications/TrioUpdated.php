<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\SlackMessage;
use App\Trio;

class TrioUpdated extends Notification implements ShouldQueue
{
    use Queueable;

    private $trio;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Trio $trio)
    {
        $this->trio = $trio;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack'];
    }

    /**
     * Get the Slack representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return SlackMessage
     */
    public function toSlack($notifiable)
    {
        \Log::info('Sending slack message');
        return (new SlackMessage)
            //->from('Trios', ':ghost:')
            //->to('#' . env('SLACK_CHANNEL', 'trios'))
            ->content('One of your invoices has been paid!' . $this->trio->id);
    }
}
