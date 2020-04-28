<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewPatient extends Mailable
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
    public function __construct($patient, $pneumologist, $training)
    {
        //
        $this->patient = $patient;
        $this->training = $training;
        $this->pneumologist = $pneumologist;

      
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.new')->subject("Neuer APR-Pat. erfasst " . $this->training->title);
    }
}
