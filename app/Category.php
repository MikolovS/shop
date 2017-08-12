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

    public function products()
    {
        return $this->hasMany('App\Product');
    }


}
