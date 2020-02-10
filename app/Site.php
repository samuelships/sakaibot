<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $fillable = ["site_fetch_id", "user_id", "name", "site_id"];
}
