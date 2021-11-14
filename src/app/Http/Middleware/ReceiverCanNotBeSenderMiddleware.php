<?php

namespace App\Http\Middleware;

use App\Exceptions\Kudo\ReceiverException;
use Closure;
use Illuminate\Http\Request;

class ReceiverCanNotBeSenderMiddleware
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
        if($request->get('user_receiver_id') == request()->user()->id)
        {
            throw new ReceiverException('Receiver can not be the sender');
        }
        
        return $next($request);
    }
}
