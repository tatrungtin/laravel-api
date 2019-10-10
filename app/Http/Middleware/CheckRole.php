<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Responses\APIResponse;
use Auth;
class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  \String  $requestType
     * @return mixed
     */
    public function handle($request, Closure $next,  $requestType = null)
    {
        $user = Auth::user();
        $actionName = \Route::getCurrentRoute()->getName();
        if ($user->hasPermission($actionName))
            return $next($request);

        if($requestType == 'api')
            return APIResponse::error401('You do not have permission to access this feature');

        return abort(401);
    }
    
}
