<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\File;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model implements HasMedia
{
    use HasMediaTrait;
    protected $fillable = ['title', 'body','image_name'];

    protected static function boot(){
        parent::boot();
        static::creating(function($model){
            $model->user_rmd_id = \DB::table('users')->inRandomOrder()->first()->id;
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getUserContAttribute(){
    	return \DB::table('posts')->where('posts.user_rmd_id',$this->id)->sum('users.id');
    }

    public $appends = ['user_count'];

    public function setTitleAttribute($value){
    	$this->attributes['title'] = ucwords($value);
    }
}
