<?php

namespace BGate;

use Closure;

class Comman
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

        $user= new \BModel\User ();

        if(!($user->checkLogin())){
          $error=['You are Not Logged in.'];
          return redirect()->action('\Backend\SystemController@loginForm')->with('error',$error);
        }

        return $next($request);
    }
}
