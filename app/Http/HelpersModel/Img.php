<?php

namespace App\Http\HelpersModel;

use Intervention\Image\Facades\Image;

class Img
{
    const NOIMG = '/public/images/noimg.jpg';
    const NEWCATEGORY = '/public/images/new_category.png';
    const NEWPRODUCT = '/public/images/new_product.png';

    public static function saveImg($model) {
        $img = Image::make(request()->file('img'))->resize($model->img_h, $model->img_w);
        $imgExt = '.' . request()->img->extension();
        $imgPath = '/images/' . $model->clsName . '/' . $model->slug . $imgExt;
        $img->save(public_path($imgPath));
        return $imgPath;
    }
}
