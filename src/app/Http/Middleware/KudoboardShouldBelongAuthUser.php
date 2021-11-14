<?php

namespace App\Http\Middleware;

use App\Exceptions\Kudo\KudoboardException;
use App\Models\Kudoboards;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class KudoboardShouldBelongAuthUser
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
        $authUser = request()->user()->all_kudoboards->filter(function($kudoboard) use($request){
            
            $kudoboardToCompare =gettype($request->route('kudoboards')) == 'object'
                ? $request->route('kudoboards')
                : Kudoboards::find($request->route('kudoboards'));
            
            return $kudoboard->id == $kudoboardToCompare->id;
        });

        if($authUser->count() == 0)
        {
            throw new KudoboardException('Kudoboard Should Belong to the authenticated user');
        }
        
        return $next($request);
    }
}
