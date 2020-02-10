<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignmentFetch extends Model
{
    protected $fillable = ["user_id", "site_id", "time_queried", "payload"];
}
