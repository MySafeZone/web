<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\UuidModel;

class EncryptedFile extends UuidModel
{
    public $incrementing = false;
    public $timestamps = true;
    protected $table = 'encryptedfiles';

    public function user()
    {
        return $this->belongsTo('User'); 
    }
}