<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\FavouriteResource;
use App\Http\Resources\NotificationsResource;
use App\Http\Resources\RateResource;
use App\Http\Resources\UserResource;
use App\Models\AppRate;
use App\Models\Category;
use App\Models\Favourite;
use App\Models\Language;
use App\Models\MobileToken;
use App\Models\ProductStore;
use App\Models\Rate;
use App\Models\User;
use App\Models\UserCategory;
use App\Traits\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Validator;

class AuthController extends AppBaseController
{
    //

    use Notification ;
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */

    public function login(Request $request)
    {
        setLang($request);

        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();

            $success['token'] =  $user->createToken('MyApp')->accessToken;
            return $this->sendResponse($success, "Successfully");
        } else {
            return $this->sendError(['error' => 'Unauthorised'], 401);
        }
    }

    public function loginSocial(Request $request, $provider)
    {
        $request->request->add([
            'grant_type' => $request->get('grant_type'),
            'client_id' => $request->header('clientId'),
            'client_secret' => $request->header('clientSecret'),
            'provider' => $provider,
            'access_token' => $request->get('access_token'),
            'scope' => null,
        ]);
        $proxy = Request::create('oauth/token', 'POST');

        if($request->has('secret_token'))
            $_SESSION['secret_token']=$request->get('secret_token');

        $r = Route::dispatch($proxy);
//        dd( ($r));

        if ($r->status() == 200) {
            $data = json_decode($r->getContent());
            $response['token'] = $data->access_token;
            return response()->json(['status' => true, 'data' => $response, 'message' => "تم تسجيل الدخول بنجاح"]);
//            return $r ;
        }

        return response()->json(['status' => false, 'message' => 'Error,Unauthorized ']);
    }


    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */

    public function register(Request $request)
    {
        setLang($request);

        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails())
            return response()->json(['status'=>false,'message'=>'Error','errors'=>$this->ValidateService($validator)]);

        $input = $request->all();


        $input['password'] = bcrypt($input['password']);

        $user = User::create($input);

        $success['token'] =  $user->createToken('MyApp')->accessToken;

        return $this->sendResponse( $success, "Successfully");
    }

    /**
     * set lang for app
     *
     * @return
     */
    public function changeLang($lang)
    {
        if($lang == "ar" || $lang == "en" ) {
            session(['language' => $lang]);
            App::setLocale($lang);

            return response()->json(['status' => true,
                'message' => __('settings.api.success_msg')]);

        }
        return response()->json(['status' => false, 'message' => __('settings.api.error_msg')]);

    }

    /**
     * store exponentPushToken for notification
     *
     * @return \Illuminate\Http\Response
     */
    public function exponentPushToken(Request $request )
    {
        setLang($request);

        $rules = [
            'exponent_push_token' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails())
            return response()->json(['status'=>false,'message'=>'Error','errors'=>$this->ValidateService($validator)]);

        $user_id = Auth::id();
        $token=MobileToken::where('user_id',$user_id)->where('exponent_push_token' , $request->exponent_push_token)->first();
        $message= __('settings.api.token_found') ;

        if(!isset($token)) {
            $token = MobileToken::create(['user_id' => $user_id, 'exponent_push_token' => $request->exponent_push_token]);
            $message=__('settings.api.success_msg') ;
        }

        return response()->json(['status' => true ,
            'data'=>['exponent_push_token' =>$token->exponent_push_token],
            'message' => $message]);

    }

    /**
     * logout api
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request){

        setLang($request);

        $exponent_push_token = $request->has('exponent_push_token') ? $request->exponent_push_token : null;

        if(isset($exponent_push_token)) {
            $exponent_push_tokens = MobileToken::where('exponent_push_token', $exponent_push_token)->get();

            foreach ($exponent_push_tokens as $exponent_push_token)
                $exponent_push_token->delete();
        }

        if (Auth::guard('api')->check()) {
            Auth::guard('api')->user()->token()->revoke();
            return response()->json(['status' => true, 'message' => __('settings.api.success_msg')], 200);
        } else {
            return response()->json(['status' => false, 'message' => __('settings.api.error_msg')]);
        }
    }

    /**
     * send verfication code to reset password
     *
     * @return \Illuminate\Http\Response
     */
    public function sendVerificationCode(Request $request)
    {
        setLang($request);

        $validator = Validator::make($request->all(), [
            'email' => 'required',

        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 403);
        }
        $user = User::where('email',$request->email)->first();

        if (isset($user)) {
            $code = substr(md5(microtime()),rand(0,7),7);;

            $user->confirm_code = $code;
            $user->save();

            $data=['user'=>$user];

            Mail::send('auth.emails.verification_code', $data , function ($message) use ($user) {
                $message->to($user->email, 'Pricna')->subject('Reset Password Verification Code');
            });

            $response = ['verification_code' => $code];

            return response()->json(['status' => true, 'data' => $response, 'message' =>  __('settings.api.send_email')]);
        }
        return response()->json(['status' => false, 'message' => __('settings.api.no_account') ]);
    }

    /**
     * confirm verfication code
     *
     * @return \Illuminate\Http\Response
     */
    public function confirmVerificationCode(Request $request)
    {
        setLang($request);

        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'verification_code' => 'required',

        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 403);
        }

        $user = User::where('email',$request->email)->first();

        if (isset($user))
            if ($request->verification_code == $user->confirm_code)
                return response()->json(['status' => true, 'message' =>  __('settings.api.verification_code_success')]);

        return response()->json(['status' => false, 'message' => __('settings.api.verification_code_error')]);

    }

    /**
     * change password after confirmation
     *
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $request)
    {
        setLang($request);

        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'new_password' => 'required|min:6|same:confirm_new_password',
            'confirm_new_password' => 'required|min:6',
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 403);
        }

        $user = User::where('email', $request->email)->first();

        if (isset($user))
        $user->password = bcrypt($request->new_password);

        if ($user->save())
            return response()->json(['status' => true, 'message' => __('settings.api.password_success')]);

    }

    public function profile() {
        $user = Auth::user();
        return $this->sendResponse( UserResource::make($user) , "Successfully");
    }

    public function updateProfile(Request $request) {

        setLang($request);

        $user = Auth::user();

        if (isset($request->email)) {
            $exist_email=User::where('email',$request->email)->where('id','<>',Auth::id())->first();

            if(isset($exist_email))
                return $this->sendError(['error' => __('settings.api.validate_update_email')], 403);

        }
        if (isset($request->email))
            $user->email = $request->email;

        if (isset($request->name))
            $user->name = $request->name;

        if ($request->hasFile('image')) {
            $user->img = $this->upload($request['image'], 'photo', 'users');;
        }

        $user->save();
        return $this->sendResponse(UserResource::make($user), "Successfully");
    }

    public function favouriteList(Request $request)
     {
         $query=Favourite::where('user_id',Auth::id());

         if (!empty($request['page'])) {
             $perPage = $request->has('offset') ? $request->offset : 10;
             $favourites = $query->paginate($perPage);
             $nextPage=$favourites->nextPageUrl();
         }
         else
         {
             $favourites = $query->get();
             $nextPage=null;
         }

         $response = [
             'favourites'=> FavouriteResource::collection($favourites),
             'nextPage'  => $nextPage
         ];

         return $this->sendResponse($response, "Successfully");

     }

    public function userCountry(Request $request) {
        setLang($request);

        $rules=[
            'country_id'=>'required|exists:countries,id',
        ];

        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 403);
        }

        $user=Auth::user();
        $user->country_id = $request->country_id ;
        $user->save();

        return $this->sendResponse( UserResource::make($user) , "Successfully");
    }

    public function userCategories(Request $request) {
        setLang($request);

        $rules=[
            'category_id'=>'required',
        ];

        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 403);
        }

        $user=Auth::user();

        foreach ($request->category_id as $category_id) {
            $category = Category::find($category_id);
            if (isset($category)) {
                $user_category = UserCategory::where('user_id', Auth::id())
                    ->where('category_id', $category->id)->first();

                if (!isset($user_category)) {
                    UserCategory::create([
                        'user_id' => Auth::id(),
                        'category_id' => $category->id
                    ]);
                }
            }
        }

        return $this->sendResponse( UserResource::make($user) , "Successfully");
    }

    public function deleteFavourite() {
        $items=Favourite::where('user_id',Auth::id())->get();

        foreach ($items as $item)
            $item->delete();


        return $this->sendResponse( [] , "Successfully");
    }

    public function ratesList(Request $request)
    {
        $query=Rate::where('user_id',Auth::id());

        if (!empty($request['page'])) {
            $perPage = $request->has('offset') ? $request->offset : 10;
            $rates = $query->paginate($perPage);
            $nextPage=$rates->nextPageUrl();
        }
        else
        {
            $rates = $query->get();
            $nextPage=null;
        }

        $response = [
            'rates'=> RateResource::collection($rates),
            'nextPage'  => $nextPage
        ];

        return $this->sendResponse($response, "Successfully");

    }

    public function testSendNotifications(Request $request)
    {
        setLang($request);

        $price=152;
        $store=ProductStore::where('product_id',$request->product_id)->first();

        $tokens=MobileToken::where('user_id',Auth::id())->pluck('exponent_push_token')->toArray();
        $this->mobileNotify( $tokens,$store->store_id,$price,__('settings.api.price_notify')." 152",$request->product_id);

        return $this->sendResponse( [] , "Successfully");

    }

    public function notificationsList(Request $request)
    {
        setLang($request);

        $query=\App\Models\Notification::where('user_id',Auth::id())->orderBy('created_at','DESC');

        if (!empty($request['page'])) {
            $perPage = $request->has('offset') ? $request->offset : 10;
            $rates = $query->paginate($perPage);
            $nextPage=$rates->nextPageUrl();
        }
        else
        {
            $rates = $query->get();
            $nextPage=null;
        }

        $response = [
            'notifications'=> NotificationsResource::collection($rates),
            'nextPage'  => $nextPage
        ];

        return $this->sendResponse($response, "Successfully");

    }

    public function deleteAllNotification()
    {
        $items=\App\Models\Notification::where('user_id',Auth::id())->orderBy('created_at','DESC')->get();

        foreach ($items as $item)
            $item->delete();

        return $this->sendResponse([], 'Items is deleted Successfully');

    }

    public function updateNotify()
    {
        $user=Auth::guard('api')->user();
        $user->is_notify= ! $user->is_notify;
        $user->save();

        $user=UserResource::make($user);
        return $this->sendResponse($user, 'Successfully');

    }

    public function appRate(Request $request) {
        $rules=[
            'rate'=>'required',
        ];

        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 403);
        }

        $rate=AppRate::where('user_id',auth()->id())->first();

        if(!isset($rate))
        $rate=new AppRate();

        $rate->user_id=auth()->id();
        $rate->rate=$request->rate;
        $rate->save();
        return $this->sendResponse( [] , "Successfully");
    }
}
