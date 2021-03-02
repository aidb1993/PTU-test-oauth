<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QBOAuth extends Model
{
    protected $primaryKey = "id";
    protected $table = "qbo_auths";

    protected $fillable = [
        'access_token','refresh_token','x_refresh_token_expires_in','expires_in','token_type'
    ];
}
