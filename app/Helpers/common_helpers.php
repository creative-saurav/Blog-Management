<?php 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;




if (!function_exists('get_user_image')) {
    function get_user_image($url)
    {
        $path = public_path($url);
        if (is_file($path) && file_exists($path) && $url != '') {
            return asset($url);
        }
        return asset('image/user.jpg');
    }
}


if (!function_exists('get_image')) {
    function get_image($url) {
        $path = public_path($url);
        if ($url != '' && file_exists($path)) {
            return asset($url);
        }
        return asset('image/placeholder.png');
    }
}


if (! function_exists('get_settings')) {
    function get_settings($type = "", $return_type = "") {
        $value = DB::table('system_settings')->where('key', $type)->value('value');
        if($return_type === true){
            return json_decode($value, true);
        }elseif($return_type === 'decode'){
            return json_decode($value, true);
        }elseif($return_type == "object"){
            return json_decode($value);
        }else{
            return $value;
        }
    }
}
if ( ! function_exists('get_all_language'))
{
    function get_all_language(){
        return DB::table('languages')->select('name')->distinct()->get();
    }
}


if ( ! function_exists('get_phrase'))
{
    function get_phrase($phrase = '', $value_replace = array()) {
        $active_language = get_settings('language');
        Session(['active_language' => get_settings('language')]);

        $query = DB::table('languages')->where('name', $active_language)->where('phrase', $phrase);
        if($query->count() > 0){
            $tValue = $query->value('translated');
        }else{
            $tValue = $phrase;
            $all_language = get_all_language();

            if($all_language->count() > 0){
                foreach($all_language as $language){
                    if(DB::table('languages')->where('name', $language->name)->where('phrase', $phrase)->get()->count() == 0){
                        DB::table('languages')->insert(array('name' => strtolower($language->name), 'phrase' => $phrase, 'translated' => $phrase));
                    }
                }
            }else{
                DB::table('languages')->insert(array('name' => 'english', 'phrase' => $phrase, 'translated' => $phrase));
            }
        }

        if(count($value_replace) > 0){
            $translated_value_arr = explode('____', $tValue);
            $tValue = '';
            foreach($translated_value_arr as $key => $value){

                if(array_key_exists($key,$value_replace)){
                    $tValue .= $value.$value_replace[$key];
                }else{
                    $tValue .= $value;
                }
            }
        }

        return $tValue;
    }
}

if (!function_exists('get_frontend_settings')) {
    function get_frontend_settings($type = '', $description='')
    {
       $frontend_settings = DB::table('frontend_settings')->where('key', $type)->value('value');
        if($type == 'json') {
            $frontend_settings = json_decode($frontend_settings);
        }
        return $frontend_settings;
    }
}
if (!function_exists('currency')) {
    function currency($price = "")
    {
        $currency_position = DB::table('system_settings')->where('key', 'currency_position')->value('value');
        $code = DB::table('system_settings')->where('key', 'system_currency')->value('value');
        $symbol = DB::table('currencies')->where('id', $code)->value('symbol');

        if($currency_position == 'left'){
            return $symbol.''.$price;
        } else {
            return $price.''.$symbol;
        }
    }
}