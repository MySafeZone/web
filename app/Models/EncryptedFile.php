<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\UuidModel;

class EncryptedFile extends UuidModel
{
    public $incrementing = false;
    public $timestamps = true;
    protected $table = 'encrypted_file';

    public function user()
    {
        return $this->belongsTo('User'); 
    }
}