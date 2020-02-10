<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $fillable = ["user_id", "assignment_fetch_id", "payload", "assignment_id"];
}
