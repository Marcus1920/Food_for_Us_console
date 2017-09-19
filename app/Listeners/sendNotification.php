<?php

namespace App\Listeners;

use App\Events\newPostEvent;
use App\Packaging;
use App\ProductType;
use App\Sellers_details_tabs;
use App\Services\SellerPostsService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\NewUser;
use Mail;

class sendNotification implements ShouldQueue
{
    public function __construct()
    {
    }

    public function handle(newPostEvent $event)
    {

        $buyerEmails = NewUser::where('intrest','=',2)->get();
        $details     = $event->sellersPost;

        $productName =ProductType::where('id',$details->productType)->first();
        $packagingName =Packaging::where('id',$details->packaging)->first();

        foreach($buyerEmails as $buyerEmail)
        {

            $messageBody  = 'A new product  has just been posted,check details below;';
            $data = array (
                'name'      =>      $buyerEmail->name  . '  ' . $buyerEmail->surname,
                'content'   =>      $messageBody,
                'productName'        =>  $productName->name,
                'packaging'          => $packagingName->name,
                'costPerKg'           =>   $details->costPerKg,
                'rating'              =>   $details->rating,
                'location'              =>$details->location,
                'description'       =>   $details->description,
                'quantity'          =>   $details->quantity,
                'availableHours'    =>   $details->availableHours,
                'paymentMethods'    =>   $details->paymentMethods,
            );

            \Mail::send('emails.newPost', $data, function ($message) use ($buyerEmail)
            {
                //$message->attach("images/back.jpg");
                $message->from('info@foodforus', 'Food For us');
                $message->to($buyerEmail->email)->subject("New Product Posted");
            });
        }

    }
}
