<?php

namespace App\Http\Middleware;
use Session;
use Closure;
use Auth;
use DB;

class AclMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $actions = $request->route()->getAction();
        // dd($permission);
        // dd($actions);
        $permission = $actions['permission'];
        // dd(Auth::user());

        $permissons_exist = 0;
        // echo 'here'; exit;
         // dd(Auth::user());
        $user_id = Auth::user()->id;
        $permission_id      = DB::table('permissions')->where('name',$permission)->first();
        $role_id            = DB::table('role_user')->where('user_id',$user_id)->first();
        if(($permission_id != null || $permission_id != '') && ($role_id != '' || $role_id != null))
            $permissons_exist   = DB::table('permission_role')->where([
                ['permission_id','=',$permission_id->id],['role_id','=',$role_id->role_id]
            ])->count();
        if($user_id == 1){
            return $next($request);
        }
        else if(isset($permissons_exist) && $permissons_exist > 0){
            return $next($request);
        }
        else{
            return redirect()->route('home')->with('warning','Permission Denied!');
        }
        // if(Session::has('merchant'))
        // {
        //     return $next($request);
            
        // }
        // else{
        //     return response()->view('member.login');
        // }


    }
}
