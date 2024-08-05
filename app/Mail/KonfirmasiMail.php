<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class KonfirmasiMail extends Mailable
{
    use Queueable, SerializesModels;

    public $member;
    public $no_pengajuan;
    public $dateStart;
    public $dateEnd;
    public $status;
    public $reason;
    public $user;

    /**
     * Create a new message instance.
     */
    public function __construct($member, $no_pengajuan, $status, $reason, $dateStart, $dateEnd, $user)
    {
        $this->member = $member;
        $this->user = $user;
        $this->dateStart = $dateStart;
        $this->dateEnd = $dateEnd;
        $this->status = $status;
        $this->reason = $reason;
        $this->no_pengajuan = $no_pengajuan;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Konfirmasi Penerimaan Magang',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content('admin.email.konfirmasi', null, null, null, [
            'member' => $this->member,
            'user' => $this->user,
            'status' => $this->status,
            'reason' => $this->reason,
            'dateStart' => $this->dateStart,
            'dateEnd' => $this->dateEnd
        ]);
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
