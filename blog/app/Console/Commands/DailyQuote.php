<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use QuickBooksOnline\API\DataService\DataService;
use QuickBooksOnline\API\Core\OAuth\OAuth2\OAuth2LoginHelper;

class DailyQuote extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quote:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh token daily';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
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
        $_ENV['ACCESS_TOKEN_KEY'] = $token->getAccessToken();
        dd(env('ACCESS_TOKEN_KEY'));
        $this->info('Successfully sent daily quote to everyone.');
    }
}
