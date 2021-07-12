<?php
/**
 * Created by PhpStorm.
 * User: Abeer Zimmo
 * Date: 3/10/2020
 * Time: 11:43 PM
 */
use \Illuminate\Http\Request;
use App\Models\Language;
use Illuminate\Support\Facades\App;
/**
 * set lang for app api
 *
 * @return
 */
function setLang(Request $request)
{
    $language=null;

    if($request->hasHeader('langId'))

        $language=Language::find($request->header('langId'));

    $lang =isset($language) ? $language->symbol : "ar";

    App::setLocale($lang);

    $lang_id= (($request->hasHeader('langId') == true)) ? $request->header('langId') : 2 ;

    return $lang_id ;
}