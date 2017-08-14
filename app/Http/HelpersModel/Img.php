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
        if ($model->clsName === 'product') {
        	$pathPart = \Storage::disk('product')->exists($model->category_id);
        	if(!$pathPart) {
		        \Storage::disk('product')->makeDirectory($model->category_id);
	        }
	        $imgPath = '/images/' . $model->clsName . '/' . $model->category_id . '/' . $model->slug . $imgExt;
        } else {
	        $imgPath = '/images/' . $model->clsName . '/' . $model->slug . $imgExt;
        }
        $img->save(public_path($imgPath));
        return $imgPath;
    }

    public static function delete($model) {
	    \File::delete(public_path($model->img));
	    if ($model->clsName === 'category') {
	    	//удаялем картинки связаных продуктов
			\Storage::disk('product')->deleteDirectory($model->id);
		    $ids = $model->modelTree([$model->id]);
		    $childCats = $model->all()->whereIn('id', $ids)->toArray();
		    if (!empty($childCats)) {
			    foreach ($childCats as $childCat) {
				    \File::delete(public_path($childCat['img']));
				    \Storage::disk('product')->deleteDirectory($childCat['id']);
			    }
		    }
	    }
    }
}
