<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\UuidModel;

class Leter extends UuidModel
{
    public $incrementing = false;
    public $timestamps = true;
    protected $table = 'leters';
    protected $fillable = ['bag_id', 'title', 'content', 'hash_content'];

    public function user()
    {
        return $this->belongsTo('\App\Models\User'); 
    }

    public function bag()
    {
        return $this->belongsTo('\App\Models\Bag');
    }
}
