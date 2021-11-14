<?php

namespace App\Http\Middleware;

use App\Exceptions\Kudo\KudoboardException;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class KudoboardShouldBelongSenderOrReceiver
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
        $letSender = request()->user()->all_kudoboards->filter(function($kudoboard) use($request){
            return $kudoboard->id == $request->get('kudoboard_id');
        });
        $receiver = User::find($request->get('user_receiver_id'));
        $letReceiver = $receiver->all_kudoboards->filter(function($kudoboard) use($request){
            return $kudoboard->id == $request->get('kudoboard_id');
        });

        if($letReceiver->count() == 0 && $letSender->count() == 0)
        {
            throw new KudoboardException('Kudoboard Should Belong Sender Or Receiver');
        }
        
        return $next($request);
    }
}
