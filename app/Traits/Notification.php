<?php namespace App\Traits;

use App\Models\Company;
use App\Models\MobileToken;
use App\Models\NotificationLang;
use App\Models\User;
use ExponentPhpSDK\Expo;
use Illuminate\Support\Facades\Auth;


trait Notification
{
    public function mobileNotify($tokens,$store_id,$price,$body,$product_id,$type=null)
    {
//        if($token == null)
//        $token= 'ExponentPushToken[N1Kd5EPQMRt_gCWdov2afr]' ;

        if(isset($tokens) && isset($tokens[0])) {
            $user_id = MobileToken::where('exponent_push_token', $tokens[0])->first()->user_id;

            $user = User::find($user_id);

            if(!isset($type))
            $type='price_change';

                $notify = \App\Models\Notification::create(
                    [
                        'user_id'=>$user_id ,
                        'type'=> $type ,
                        'product_id'=>$product_id ,
                        'store_id'=>$store_id ,
                        'data'=>$price ,
                    ]
                );


                $badge = \App\Models\Notification::where('user_id', $user_id)->where('is_seen', '0')->count();


                if(isset($user->is_notify) && $user->is_notify != 0) {
                    foreach ($tokens as $token) {

                        $interestDetails = [$user_id . '' . $token, $token];

                        // You can quickly bootup an expo instance
                        $expo = Expo::normalSetup();

                        // Subscribe the recipient to the server
                        $expo->subscribe($interestDetails[0], $interestDetails[1]);

                        $user_image = User::find($user_id)->image;
                        // Build the notification data
                        $notification = ['body' => $body,
                            'data' => json_encode(array('body' => $body, 'type' => $type
                            , 'badge' => $badge, 'receiver_image' => $user_image
                            ))];

                        // Notify an interest with a notification
                        $expo->notify($interestDetails[0], $notification, true);
                    }
                }
        }

    }


}