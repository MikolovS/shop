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

    public function findChildren($collections, $ids) {
		$array = [];
		foreach ($collections as $key => $value) {
			foreach ($ids as $id) {
				if ($value == $id) {
					$array[] = $key;
					}
				}
			}
		return $array;
	}
    public function modelTree($ids) {
	    $ids = (array) $ids;
	    $collections = $this->select('id','parent_id')->get()->mapWithKeys(function ($item) {
		    return [$item['id'] => $item['parent_id']];
	    })->toArray();
	    $count = count($collections);
	    while ($count > 0) {
		    $ids = array_merge($ids, $this->findChildren($collections, $ids));
		    $ids = array_unique($ids);
		    $count--;
	    }
	    return $ids;
    }

    public function deleteChild() {
    	$ids = $this->modelTree([$this->id]);
    	if (!empty($ids)) {
		    $this->whereIn('id', $ids)->delete();
	    }
    }

	public function branchParent($collection, $branchParentId) {
		foreach ($collection as $id => $parent_id) {
			if ($branchParentId == $id) {
				return $parent_id;
			}
		}
		return FALSE;
	}

	public function categoryBranch($collections, $parent_id) {
		$categories = $collections->mapWithKeys(function ($item) {
			return [$item['id'] => $item['parent_id']];
		})->toArray();
		$branchIds = [];
		while ($parent_id !== 1) {
			if ($parent_id == FALSE) {
				break;
			}
			$branchIds[] = $parent_id;
			$parent_id = $this->branchParent($categories, $parent_id);
		}
		return $branchIds;
	}

    public function links($collection, $ids, $admin = FALSE)
    {
    	$admin = (boolean) $admin;
    	$models = $collection->whereIn('id', $ids);
    	if (!$admin) {
		    $links = $models->mapWithKeys(function ($item) {
			    return [$item['name'] => url('/' . $item['slug'])];
		    })->toArray();
		    return $links;
	    }

	    $links = $models->mapWithKeys(function ($item) {
		    return [$item['name'] => url('/admin/category/' . $item['slug'])];
	    })->toArray();
	    return $links;
    }
}
