<?php

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
// use Session;

function control($permission){
    $permissons_exist = 0;
    $user_id = Auth::user()->id;
    $permission_id      = DB::table('permissions')->where('name',$permission)->first();
    $role_id            = DB::table('role_user')->where('user_id',$user_id)->first();
    if(($permission_id != null || $permission_id != '') && ($role_id != '' || $role_id != null))
        $permissons_exist   = DB::table('permission_role')->where([
            ['permission_id','=',$permission_id->id],['role_id','=',$role_id->role_id]
        ])->count();
    if($user_id == 1){
        return true;
    }
    else if(isset($permissons_exist) && $permissons_exist > 0){
        return true;
    }
    else{
        return false;
    }
}


function url_title($str, $separator = '-', $lowercase = FALSE)
{
    if ($separator === 'dash')
    {
        $separator = '-';
    }
    elseif ($separator === 'underscore')
    {
        $separator = '_';
    }

    $q_separator = preg_quote($separator, '#');

    $trans = array(
        '&.+?;'         => '',
        '[^\w\d _-]'        => '',
        '\s+'           => $separator,
        '('.$q_separator.')+'   => $separator
    );

    $str = strip_tags($str);
    foreach ($trans as $key => $val)
    {
        $str = preg_replace('#'.$key.'#i'.(TRUE ? 'u' : ''), $val, $str);
    }

    if ($lowercase === TRUE)
    {
        $str = strtolower($str);
    }

    return trim(trim($str, $separator));
}

function checkValue($name)
{
    if($name){
       $data = 1;
    }else{
        $data = 0;
    }
    return $data;
}

