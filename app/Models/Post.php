<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    //polinja kooi smeat da se vnesuvaat
    protected $fillable = [
        'user_id',
        'title',
        'body',
        'published'
    ];


    //published da se tretira kako true/false
    protected $casts = [
        'published' => 'boolean',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
        //sekoj post da pripagja barem na eden korisnik
    }


    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }

    public function scopePublished($query)
    {
        return $query->where('published', true);
    }
}
