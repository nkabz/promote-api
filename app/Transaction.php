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
        'id', 'amount', 'type', 'comment_id', 'wallet_id',
    ];

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }

    public function child()
    {
        return $this->hasOne(Transaction::class, 'parent_id');
    }

}
