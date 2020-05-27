<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected static function boot()
    {
        parent::boot();

        User::created(function ($model) {
            $model->wallet()->create();
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'subscriber',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function availableNotifications()
    {
        return $this->notifications()
            ->where(function ($query) {
                $query->whereNull('read_at')
                    ->orWhere('read_at', '>', Carbon::now()->subHour());
            });
    }

    public function canPostMoreComments()
    {

        $limitPerMinute = config('customs.comments.limitPerMinute');

        return $this->comments()
            ->latest()
            ->take($limitPerMinute)
            ->whereBetween('created_at', [Carbon::now()->subMinute(), Carbon::now()])
            ->count() < $limitPerMinute;
    }

}
