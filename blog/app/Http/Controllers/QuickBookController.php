<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use QuickBooksOnline\API\DataService\DataService;
use QuickBooksOnline\API\Core\OAuth\OAuth2\OAuth2LoginHelper;

class QuickBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $dataService = DataService::Configure(array(
                'auth_mode'     => 'oauth2',
                'ClientID'      => env('CLIENT_ID'),
                'ClientSecret'  => env('CLIENT_SECRET'),
                'RedirectURI'   => "https://developer.intuit.com/v2/OAuth2Playground/RedirectUrl",
                'scope'         => "com.intuit.quickbooks.accounting or com.intuit.quickbooks.payment",
                'baseUrl'       => "Development/Production"
          ));

          $OAuth2LoginHelper = $dataService->getOAuth2LoginHelper();
          $authorizationCodeUrl = $OAuth2LoginHelper->getAuthorizationCodeURL();
          header('Location: '.$authorizationCodeUrl);
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

        $loginHelper = new OAuth2LoginHelper('ABwVa031ISzemWRTUvC5E3xIxX1iy9VTCk4KfonWJIChFYFBNx', 'hBWDipA6gIydm6uSwkHGCskPRESVV6MhqSdHuymW');
        $token = $loginHelper->refreshAccessTokenWithRefreshToken('AB11623006138TN3cFU5tU95HHHbvDliFVzW9O7lNML50iNVzP');

        $user = User::create([
            'client_id'             => 'ABwVa031ISzemWRTUvC5E3xIxX1iy9VTCk4KfonWJIChFYFBNx',
            'client_secret'         => 'hBWDipA6gIydm6uSwkHGCskPRESVV6MhqSdHuymW',
            'accessToken_key'       => $token->getAccessToken(),
            'refresh_token'         => $token->getRefreshToken(),
            'accessTokenExpiresAt'  => $token->getAccessTokenExpiresAt(),
            'refreshTokenExpiresAt' => $token->getRefreshTokenExpiresAt(),
            'realm_id'              => '4620816365161736680',
            'token_type'            => 'bearer'
        ]);

        return $user;
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
