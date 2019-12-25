<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use DB;
use App\Exceptions\Entities\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * Class Authenticate
 * @package App\Http\Middleware
 */
class Authenticate extends \Illuminate\Auth\Middleware\Authenticate
{
    /**
     * @param  Request  $request
     * @param  Closure  $next
     * @param  mixed    ...$guards
     *
     * @return JsonResponse|mixed
     * @throws AuthorizationException
     */
    public function handle($request, Closure $next, ...$guards)
    {
        try {
            JWTAuth::parseToken()->getClaim('exp');
        } catch (JWTException $exception) {
            throw new AuthorizationException(AuthorizationException::ERROR_TYPE_UNAUTHORIZED);
        }

        if (!Auth::check()) {
            throw new AuthorizationException(AuthorizationException::ERROR_TYPE_UNAUTHORIZED);
        }

        $user = Auth::user();

        if (!$user || !$user->active) {
            DB::table('tokens')->where('user_id', $user->id)->delete();
            throw new AuthorizationException(AuthorizationException::ERROR_TYPE_USER_DISABLED);
        }

        return $next($request);
    }
}
