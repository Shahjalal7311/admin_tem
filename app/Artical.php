<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artical extends Model
{
	/**
     * The attributes that should be hidden for arrays.
     *
     * @var array
    */

    protected $table = 'articals';
    
    protected $fillable = ['title', 'body','image_name','user_rmd_id','thum_img'];

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
    	return \DB::table('articals')->where('articals.user_rmd_id',$this->id)->sum('users.id');
    }

    public $appends = ['user_count'];

    public function setTitleAttribute($value){
    	$this->attributes['title'] = ucwords($value);
    }
}
