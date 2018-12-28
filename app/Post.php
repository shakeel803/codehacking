<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// use Cviebrock\EloquentSluggable\SluggableInterface;
// use Cviebrock\EloquentSluggable\SluggableTrait;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use Sluggable;
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title',
                'onUpdate'=>true,
            ]
        ];
    }
    protected $fillable = ['category_id','photo_id','user_id','title','body'];



    public function user()
    {
        return $this->belongsTo('App\User');
    }


    public function photo()
    {
        return $this->belongsTo('App\Photo');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }


    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}

