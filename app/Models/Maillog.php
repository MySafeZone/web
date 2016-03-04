<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maillog extends Model
{
    public $incrementing = true;
    public $timestamps = false;
    protected $table = 'maillogs';
}