<?php

namespace App\Http\Middleware;

use App\Exceptions\TeamUser\TeamOwnerCanNotBeAMember;
use App\Exceptions\TeamUser\ShouldBeTheTeamOwner;
use Closure;
use Illuminate\Http\Request;

class OnlyOwnerTeamMiddleware
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
        if($request->get('user_id') == request()->user()->id)
        {
            throw new TeamOwnerCanNotBeAMember('Team owner can not be a member');
        }
        

        if($request->route('team') != null)
        {
            $id = $request->route('team')->id ?? $request->route('team');
            if(($request->route('team') != null && request()->user()->teams()->where('id', $id)->count() == 0))
            {
                throw new ShouldBeTheTeamOwner('You should be the team owner to register new members');
            }
        }

        if(($request->get('team_id') != '' && request()->user()->teams()->where('id', $request->get('team_id'))->count() == 0)
         )
        {
            throw new ShouldBeTheTeamOwner('You should be the team owner to register new members');
        }


        return $next($request);
    }
}
