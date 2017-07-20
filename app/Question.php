<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['title','content','user_id'];

    public function Topics()
    {
        return $this->belongsToMany(Topic::class)->withTimetamps();
    }
}
