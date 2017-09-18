<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Request;
use App\NewUser;


class SendEmailsToBuyers  implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {

        $buyerEmails = NewUser::where('intrest','=',2)->get();

        foreach($buyerEmails as $buyerEmail)
        {

            $messageBody  = 'A new product  has just been posted , to get more information about this log in onto your application and start to buy .';
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
