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

    public function scopeMostRecentActives($query)
    {
        return $query->orderByRaw('CASE WHEN highlight_expires_at IS NULL OR highlight_expires_at < NOW() THEN 0 ELSE highlight_expires_at - created_at END DESC');
    }

    public function getIsHighlightedAttribute()
    {
        return null !== $this->highlight_expires_at;
    }
}
