<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'user_id', 'content', 'highlight_expires_at'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function post()
    {
        return $this->belongsTo('App\Post');
    }

    public function transaction()
    {
        return $this->hasOne('App\Transaction');
    }

    public function getIsHighlightedAttribute()
    {
        return null !== $this->highlight_expires_at;
    }
}
