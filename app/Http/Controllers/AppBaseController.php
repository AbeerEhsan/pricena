<?php

namespace App\Http\Controllers;

use Illuminate\Http\UploadedFile;
use InfyOm\Generator\Utils\ResponseUtil;
use Response;

/**
 * @SWG\Swagger(
 *   basePath="/api/v1",
 *   @SWG\Info(
 *     title="Laravel Generator APIs",
 *     version="1.0.0",
 *   )
 * )
 * This class should be parent class for other API controllers
 * Class AppBaseController
 */
class AppBaseController extends Controller
{
    public function sendResponse($result, $message)
    {
        return Response::json(ResponseUtil::makeResponse($message, $result));
    }

    public function sendError($error, $code = 404)
    {
        return Response::json(ResponseUtil::makeError($error), $code);
    }
    public function upload(UploadedFile  $request ,$type ,$folder)
    {

        $file = $request;
        $ext = $file->getClientOriginalExtension();

        $file_new_name =  time() . '.' . $ext;

        if($type == "photo")
            $type='images';

        elseif($type == "video")
            $type='video';

        $is_uploaded = $file->move(public_path('uploads/'.$type.'/'.$folder), $file_new_name);

        if ($is_uploaded)
            return $file_new_name;

        return null;
    }


    public function sendSuccess($message)
    {
        return Response::json([
            'success' => true,
            'message' => $message
        ], 200);
    }

    public function ValidateService($validator)
    {
        $errors = $validator->errors()->toArray();
        $all_errors = [];
        foreach ($errors as $key => $error) {
            $error_validator = [];
            $error_validator['fieldName'] = $key;
            foreach ($error as $e) {
                $error_validator['message'][] = $e;
            }
            $all_errors[] = $error_validator;
        }
        return $all_errors;
    }

}
