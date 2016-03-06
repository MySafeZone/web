<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\UuidModel;

class Key extends UuidModel
{
    public $incrementing = false;
    public $timestamps = true;
    protected $table = 'keys';

    public function user()
    {
        return $this->belongsTo('App\Models\User'); 
    }
}