<?php


namespace App\Mail;

use App\Services\EmailService;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;



class NewPosts  extends Mailable
{

    use Queueable, SerializesModels;


    protected $emailService;

    public function __construct(EmailService $emailService )
    {
      $this->emailService =$emailService;
    }


    public function build()
    {

        return $this->from('mark.mbayo.n@gmail.com')
            ->view('emails.NewPost');


//        return $this->from('')
//            ->view('view.name');
    }

}
