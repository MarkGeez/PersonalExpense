<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class expense extends Model
{
    protected $fillable = [
        "category",
        "amount",
        "details",
        "date",
        "title",
        "date",
        "user_id"
    ];

    public function User(){

    }
}
