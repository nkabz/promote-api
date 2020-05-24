<?php

namespace App;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use Uuid;

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    protected $fillable = [
        'id', 'amount', 'type',
    ];

    public function wallet()
    {
        return $this->belongsTo('App\Wallet');
    }

    public function comment()
    {
        return $this->belongsTo('App\Comment');
    }

}
