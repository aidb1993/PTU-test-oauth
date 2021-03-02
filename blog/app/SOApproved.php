<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SOApproved extends Model
{
    protected $primaryKey = "id";
    protected $table = "s_o_approveds";

    protected $fillable = [
        'data'
    ];
}
