<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteFetch extends Model
{
    protected $fillable = ["user_id", "payload", "time_queried"];
}
