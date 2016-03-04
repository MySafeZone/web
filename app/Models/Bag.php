<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\UuidModel;
use Mail;

class Bag extends UuidModel
{
    public $incrementing = false;
    public $timestamps = true;
    protected $table = 'bags';
    protected $fillable = ['recipients', 'title', 'periodicity', 'shares', 'public_key', 'user_id'];

    public static $periodicities = array(
                '1' => 'Every day',
                '2' => 'Every week',
                '3' => 'Every 30 days',
                '4' => 'Every 90 days',
                '5' => 'Every 180 days',
                '6' => 'Every 365 days'
    );

    public function user()
    {
        return $this->belongsTo('\App\Models\User'); 
    }

    public function leters()
    {
        return $this->hasMany('\App\Models\Leter'); 
    }

    public function periodicityName()
    {
        return Bag::$periodicities[(int) $this->periodicity];
    }

    public function send()
    {
        foreach (explode(',', $this->recipients) as $email) {
            Mail::send(
                ['text' => 'emails.send'], ['email_sender' => $this->user->email, 'bag' => $this], function ($m) use ($email) {
                    $m->from('admin@leter.io', 'Leter.io');
                    $m->bcc('admin@leter.io', 'Leter.io');
                    $m->to($email)->subject('Leter.io > Decrypt the message');
                }
            );
        }
    }

    public function updateEnd()
    {
        $ts_update = 0;
        switch ($this->periodicity) {
        case 1:
            $ts_update = 60*60*24;
            break;

        case 2:
            $ts_update = 60*60*24*7;
            break;

        case 3:
            $ts_update = 60*60*24*30;
            break;

        case 4:
            $ts_update = 60*60*24*90;
            break;

        case 5:
            $ts_update = 60*60*24*180;
            break;

        case 6:
            $ts_update = 60*60*24*365;
            break;
        }

        $this->end_at = date("Y-m-d H:i:s", time()+$ts_update);
        $this->save();
    }
}
