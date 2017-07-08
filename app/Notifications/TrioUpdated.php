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
        $trio = $this->trio;
        \Log::info('Sending slack message');
        return (new SlackMessage)
            ->from('Trios')
            ->image('https://trios.akai.org.pl/img/trios_logo_120x120_nobg.png')
            ->to('#' . env('SLACK_CHANNEL', 'trios'))
            ->content('A trio was modified!')
            ->attachment(function ($attachment) use ($trio) {
                $attachment->title('Changed trio ' . $trio->id, 'https://trios.akai.org.pl/solve#' . $trio->id)
                    ->fields([
                        'Sentence 1' => $trio->sentence1,
                        'Sentence 2' => $trio->sentence2,
                        'Sentence 3' => $trio->sentence3,
                        'Answer' => $trio->answer,
                        'Active' => $trio->active
                    ]);
            });
    }
}
