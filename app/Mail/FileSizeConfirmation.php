<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FileSizeConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $size;

    public function __construct($update)
    {
        $this->size = $update;
    }

    public function build()
    {
        return $this->view('emails.filesizeconfirm')
                    ->with($this->size);
    }
}
