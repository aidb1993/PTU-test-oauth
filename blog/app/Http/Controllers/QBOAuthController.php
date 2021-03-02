<?php

namespace App\Http\Controllers;

use App\QBOAuth;
use Illuminate\Http\Request;
use QuickBooksOnline\API\DataService\DataService;
use QuickBooksOnline\API\Core\OAuth\OAuth2\OAuth2LoginHelper;

class QBOAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataService = DataService::Configure(array(
            'auth_mode'         => env('AUTH_MODE'),
            'ClientID'          => env('CLIENT_ID'),
            'ClientSecret'      => env('CLIENT_SECRET'),
            'accessTokenKey'    => env('ACCESS_TOKEN_KEY'),
            'refreshTokenKey'   => env('REFRESH_TOKEN_KEY'),
            'QBORealmID'        => env('QBO_REALM_ID'),
            'baseUrl'           => env('BASE_URL')
        ));

        $loginHelper = new OAuth2LoginHelper(env('CLIENT_ID'), env('CLIENT_SECRET'));
        $token = $loginHelper->refreshAccessTokenWithRefreshToken(env('REFRESH_TOKEN_KEY'));

        $qboAuth = QBOAuth::create([
            'access_token' => $token->getAccessToken(),
            'refresh_token' => $token->getRefreshToken(),
            'x_refresh_token_expires_in' => $token->getRefreshTokenExpiresAt(),
            'expires_in' => $token->getAccessTokenExpiresAt(),
            'token_type' => 'bearer'
        ]);

        return response()->json(['data' => $qboAuth],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
