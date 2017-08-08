<?php

namespace App;


use AlexeyMezenin\LaravelRussianSlugs\SlugsTrait;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use SlugsTrait;
    protected $fillable = ['parent_id', 'name', 'img', 'slug'];
    public $timestamps = FALSE;
    public $img_h = 500;
    public $img_w = 500;
    public $clsName = 'category';

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function($model){
        });

        self::created(function($model){
            // ... code here
        });

        self::updating(function($model){
        });

        self::updated(function($model){
            // ... code here
        });

        self::deleting(function($model){
            // ... code here
        });

        self::deleted(function($model){
            // ... code here
        });
    }

}
