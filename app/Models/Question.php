<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['title', 'description', 'user_id', 'status'];
    use HasFactory;

    public function answers()
    {
        return $this->hasMany(Answer::class, 'question_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->withDefault();
    }

    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,
            'question_tag',
            'question_id',
            'tag_id',
            'id',
            'id'
        );
    }

}
