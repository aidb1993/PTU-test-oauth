<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    protected $primaryKey = "id";
    protected $table = "purchase_orders";

    protected $fillable = [
        'data'
    ];
}
