<?php 

namespace App\Models;

/**
 * This is a great UUID generator package available on Composer
 * but you can generate your UUID however you see fit.
 */
use Rhumsaa\Uuid\Uuid;
use Illuminate\Database\Eloquent\Model;

class UuidModel extends Model
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        /**
         * Attach to the 'creating' Model Event to provide a UUID
         * for the `id` field (provided by $model->getKeyName())
         */
        static::creating(
            function ($model) {
                $model->{$model->getKeyName()} = (string)$model->generateNewId();
            }
        );
    }

    /**
     * Get a new version 4 (random) UUID.
     *
     * @return \Rhumsaa\Uuid\Uuid
     */
    public function generateNewId()
    {
        return $this->uuid();
    }
    
    private function uuid($v = 4, $d = null, $s = false)
    {
        switch ($v.($x='')) {
        case 3:
            $x=md5($d.($s?md5(microtime(true).uniqid($d, true)):''));
            break;
        case 4:
        default:
            $v=4;for ($i=0; $i<=30;
            ++$i) {
                $x.=substr('1234567890abcdef', mt_rand(0, 15), 1);
            }
            break;
        case 5:
            $x=sha1($d.($s?sha1(microtime(true).uniqid($d, true)):''));
            break;
        }
        return preg_replace(
            '@^(.{8})(.{4})(.{3})(.{3})(.{12}).*@',
            '$1-$2-'.$v.'$3-'.substr('89ab', rand(0, 3), 1).'$4-$5',
            $x
        );
    }
}
