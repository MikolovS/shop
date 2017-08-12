<?php

namespace App;

use AlexeyMezenin\LaravelRussianSlugs\SlugsTrait;
use Illuminate\Database\Eloquent\Model;
use App\Category;

class Product extends Model
{
    use SlugsTrait;
    protected $fillable = ['cat_id', 'name', 'img', 'slug', 'price'];
    public $timestamps = FALSE;
    public $img_h = 500;
    public $img_w = 500;
    public $clsName = 'product';

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

}
