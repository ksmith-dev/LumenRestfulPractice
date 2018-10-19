<?php
namespace App\Http\Middleware;

use Closure;
use Auth0\SDK\JWTVerifier;
use Auth0\SDK\Exception\CoreException;

class Auth0Middleware
{
    /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     * @throws \Auth0\SDK\Exception\CoreException
     */
    public function handle($request, Closure $next)
    {
        if(!$request->hasHeader('Authorization')) {
            return response()->json('Authorization Header not found', 401);
        }

        $token = $request->bearerToken();

        if($request->header('Authorization') == null || $token == null) {
            return response()->json('No token provided', 401);
        }

        $this->retrieveAndValidateToken($token);

        return $next($request);
    }

    public function retrieveAndValidateToken($token)
    {
        try {
            $verifier = new JWTVerifier([
                'supported_algs' => ['RS256'],
                'valid_audiences' => ['https://connectapi.com'],
                'authorized_iss' => ['https://ksmithdev.auth0.com/']
            ]);

            $decoded = $verifier->verifyAndDecode($token);
        }
        catch(CoreException $e) {
            throw $e;
        };
    }

}