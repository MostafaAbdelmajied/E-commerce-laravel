<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $access_token = $request->header("access_token");
        if($access_token !== null){
            $user = User::where("access_token","=",$access_token)->first();
            if($user !== null){
            return $next($request);
            }else{
                return response()->json(["msg","user not found"],404);
            }
        }else{
            return response()->json(["msg"=>"access token not found"],404);
        }
    }
}
