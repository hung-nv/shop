<?php

namespace App\Mail;

use App\Models\MailContent;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendPromotion extends Mailable
{
    use Queueable, SerializesModels;

    private $mailContent;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(MailContent $mailContent)
    {
        $this->mailContent = $mailContent;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->mailContent->subject)
            ->view('emails._promotion')
            ->with([
                'mailContent' => $this->mailContent
            ]);
    }
}
