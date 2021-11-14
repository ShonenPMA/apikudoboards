<?php

namespace App\Http\Middleware;

use App\Exceptions\Kudo\OnlySender;
use App\Models\Kudo;
use Closure;
use Illuminate\Http\Request;

class OnlySenderMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->route('kudo') != null)
        {
            $kudo = $request->route('kudo')->id ? $request->route('kudo') : Kudo::find($request->route('kudo'));
            if((request()->user()->id != $kudo->user_sender_id ))
            {
                throw new OnlySender('Only sender can do this action');
            }
        }
        
        return $next($request);
    }
}
