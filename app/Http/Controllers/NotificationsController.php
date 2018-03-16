<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Notification;
use Illuminate\Support\Facades\Input;
use App\NewUser;

class NotificationsController extends Controller
{
    public function index()
    {
        $api_key = Input::get('api_key');

        $user = NewUser::where('api_key', $api_key)->first();

        $notifications = \DB::table('notifications')
            ->join('sellers_details_tabs', 'notifications.PostId', '=', 'sellers_details_tabs.id')
            ->leftjoin('product_types', 'sellers_details_tabs.productType', '=', 'product_types.id')
            ->leftjoin('packagings', 'sellers_details_tabs.packaging', '=', 'packagings.id')
            ->leftjoin('product_pickup_details', 'sellers_details_tabs.id', '=', 'product_pickup_details.SellersPostId')
            ->where('notifications.new_user_id', $user->id)
            ->where('notifications.Status', 0)
            ->select(
                \DB::raw(
                    "
                        notifications.id,
                        notifications.new_user_id,
                        notifications.PostId,
                        sellers_details_tabs.productPicture,
                        notifications.ProductName,
                        notifications.Message,
                        notifications.Status,
                        notifications.created_at,
                        sellers_details_tabs.new_user_id,
                        sellers_details_tabs.productPicture,
                        sellers_details_tabs.location,
                        sellers_details_tabs.gps_lat,
                        sellers_details_tabs.gps_long,
                        product_types.name as productType,
                        product_types.id as productTypeId,
                        sellers_details_tabs.quantity,
                        sellers_details_tabs.costPerKg,
                        sellers_details_tabs.description,
                        sellers_details_tabs.country,
                        sellers_details_tabs.city,
                        packagings.name as packaging,
                        sellers_details_tabs.availableHours,
                        sellers_details_tabs.paymentMethods,
                        sellers_details_tabs.transactionRating,
                        sellers_details_tabs.created_at,
                        sellers_details_tabs.updated_at,
                        product_pickup_details.sellByDate,
                        product_pickup_details.PickUpAddress as pickUpAddress,
                        product_pickup_details.MonToFridayHours as monToFridayHours,
                        product_pickup_details.SaturdayHours as saturdayHours,
                        product_pickup_details.SundayHours as sundayHours
                    "
                )
            )
            ->orderBy('id', 'DESC')
            ->get();


        return response()->json($notifications);
    }


    public function getAllNotification()
    {
        $notifications = \DB::table('notifications')
            ->join('new_users', 'notifications.new_user_id', '=', 'new_users.id')
            ->select(
                \DB::raw("
                                           new_users.id,
                                           notifications.PostId,
                                           notifications.ProductName,
                                           notifications.Message,
                                           new_users.name as name,
                                           new_users.surname as surname,
                                           notifications.created_at
                                         
                                         
                         ")

            )
            ->orderBy('id', 'DESC')
            ->get();

        return view('Notification.index', compact('notifications'));
    }

    public function resendNotification($id)
    {
        $notification = Notification::where('id', $id)->first();
        return view('Notification.resend', compact('notification'));
    }

    public function removeNotification()
        {
            $response = array();

            $id = Input::get('id');

            Notification::where('id', $id)
                ->update(['Status' => 1]);

            $response['message'] = "Successfully removed notification";

            return response()->json($response);

        }


}
