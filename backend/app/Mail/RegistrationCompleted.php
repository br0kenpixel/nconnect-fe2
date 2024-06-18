<?php

namespace App\Mail;

use App\Models\Attendee;
use App\Models\Conference;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RegistrationCompleted extends Mailable
{
    use Queueable, SerializesModels;

    private Conference $conference;
    private Attendee $attendee;
    private array $schedules;

    /**
     * Create a new message instance.
     */
    public function __construct(Conference $conference, Attendee $attendee, array $schedules)
    {
        $this->conference = $conference;
        $this->attendee = $attendee;
        $this->schedules = $schedules;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Registrácia vytvorená',
            from: new Address(env("MAIL_NOREPLY_ADDRESS", "noreply@nconnect.sk"), "nConnect"),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'registration_complete',
            with: [
                "conference" => $this->conference,
                "attendee" => $this->attendee,
                "schedules" => $this->schedules,
                "today" => date("d.m.Y H:i"),
                "edit" => env("FRONTEND_URL") . "/registration/" . $this->attendee->id
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
