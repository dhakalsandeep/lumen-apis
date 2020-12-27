<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class AuthenticateAccess
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

        $validSecrets = explode(',', env('ACCEPTED_SECRETS'));

        $secret = explode(" ",$request->header('Authorization'));
        if ($secret[0] == "Basic" ) {
            $secretKey = $secret[1];

            if (in_array($secretKey,$validSecrets)) {

                return $next($request);

            }
        }


        \abort(Response::HTTP_UNAUTHORIZED);
    }
}
