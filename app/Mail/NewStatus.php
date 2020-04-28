<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewStatus extends Mailable
{
    use Queueable, SerializesModels;
    public $patient;
    public $training;
    public $pneumologist;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($patient, $pneumologist)
    {
        //
        $this->patient = $patient;
        $this->pneumologist = $pneumologist;

      
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.status')->subject( $this->patient->status . " APR " . $this->patient->name . " " . $this->patient->vorname . " Pat.");
    }
}
