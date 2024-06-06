<?php

namespace App\Listeners;

use App\Events\DoctorRegistered;
use App\Mail\DoctorEmail;
use App\Models\Doctor;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendDoctorEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(DoctorRegistered $event): void
    {
        Mail::to($event->doctor->email)->send(new DoctorEmail($event->doctor));
    }
}
