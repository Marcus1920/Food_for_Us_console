<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\NewUser;


class SendEmailsToBuyers  implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $emailService;

    public function __construct( )
    {
    }

    public function handle()
    {

        $buyerEmails = NewUser::where('intrest','=',2)->get();

        foreach($buyerEmails as $buyerEmail)
        {
            $messageBody  = 'new product added for sale ...';
            $data = array (
                'name'      =>      $buyerEmail->name  . '  ' . $buyerEmail->surname,
                'content'   =>      $messageBody,
                        );

            \Mail::send('emails.newPost', $data, function ($message) use ($buyerEmail)
            {
                $message->from('info@foodorus', 'Food For us');
                $message->to($buyerEmail->email)->subject("New Product Posted");
            });
        }

    }

}
