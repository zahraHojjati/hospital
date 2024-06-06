<?php

namespace App\Mail;

use App\Models\Doctor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DoctorEmail extends Mailable
{
    use Queueable, SerializesModels;

    public Doctor $doctor;

    public function __construct(Doctor $doctor)
    {
        $this->doctor=$doctor;
    }

   public function build(): DoctorEmail
   {
       return $this->view('mail.doctor');
//       return $this
//           ->from('zahra.hojati171@gmail.com')
//           ->view('mail.doctor');
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
