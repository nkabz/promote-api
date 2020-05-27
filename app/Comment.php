<?php

namespace App;

use App\Notifications\CommentCreated;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected static function booted()
    {
        static::created(function ($model) {
            $userNotified = $model->post->user;
            $userNotified->notify(new CommentCreated($model->user));
        });
    }

    protected $fillable = [
        'user_id', 'content', 'highlight_expires_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
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
