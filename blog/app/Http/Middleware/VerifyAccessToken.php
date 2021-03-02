<?php

namespace App\Http\Middleware;
use App\QBOAuth;
use DateTime;
use QuickBooksOnline\API\DataService\DataService;
use QuickBooksOnline\API\Core\OAuth\OAuth2\OAuth2LoginHelper;

use Closure;

class VerifyAccessToken
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
        $token = $request->header('token');
        if(!$token) {
            return response()->json([
                'error' => 'Token not provided.'
            ], 401);
        }

        $qbo_auth = QBOAuth::where('access_token', $token)->first();

        if(!$qbo_auth){
            return response()->json([
                'error' => 'QBOAuth not found'
            ], 401);
        }

        $access_token_expire = new DateTime($qbo_auth->expires_in);
        $now = new DateTime();

        if($now > $access_token_expire){

            $oauth2LoginHelper = new OAuth2LoginHelper(env('CLIENT_ID'),env('CLIENT_SECRET'));
            $accessTokenObj = $oauth2LoginHelper->refreshAccessTokenWithRefreshToken($qbo_auth->refresh_token);

            $qbo_auth->access_token =  $accessTokenObj->getAccessToken();
            $qbo_auth->refresh_token = $accessTokenObj->getRefreshToken();
            $qbo_auth->expires_in = $accessTokenObj->getAccessTokenExpiresAt();
            $qbo_auth->x_refresh_token_expires_in = $accessTokenObj->getRefreshTokenExpiresAt();
            $qbo_auth->save();
        }

        return $next($request);
    }
}
