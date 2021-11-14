<?php

namespace App\Http\Middleware;

use App\Exceptions\ProjectUser\ProjectOwnerCanNotBeAMember;
use App\Exceptions\ProjectUser\ShouldBeTheProjectOwner;
use Closure;
use Illuminate\Http\Request;

class OnlyOwnerProjectMiddleware
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
            throw new ProjectOwnerCanNotBeAMember('Project owner can not be a member');
        }

        if(request()->user()->projects()->where('id', $request->get('project_id'))->count() == 0)
        {
            throw new ShouldBeTheProjectOwner('You should be the project owner to register new members');
        }
        
        return $next($request);
    }
}
