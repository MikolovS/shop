<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\HelpersModel\Img;
use App\Http\Requests\StoreCategory;

class CategoryController extends \App\Http\Controllers\CategoryController
{

    public function index() {
        $categories = Category::all()->where('parent_id', 0)->toArray();
        if (!$categories) {
            $categories = [];
        }
        return view('admin_layouts.category.index', compact('categories'));
    }

    public function group($category) {
        $collection = Category::all();
        $cat = $collection->whereStrict('slug', $category)->first();
        if (!$cat) {
            $categories = [];
        } else {
            $categories = $collection->where('parent_id', $cat->id)->toArray();
        }

        return view('admin_layouts.category.index', compact('categories'));
    }

    public function create(){
        $categories = Category::all()->groupBy('parent_id')->toArray();
        return view('category.create', compact('categories'));
    }
    public function show(Category $category){
        $collection = Category::all();
        $categories = $collection->groupBy('parent_id')->toArray();
        $parent = $collection->where('id', $category->parent_id);
        if (empty($parent)) {
            $parent = [

            ];
        }
        dd($parent);
        return view('admin_layouts.category.show', compact('collection', 'categories', 'parent', 'category'));
    }

    public function store(StoreCategory $request) {
        $category = new Category();
        $category->name = request('name');
        $category->parent_id = request('parent_id');
        $category->reslug('name');
        $category->img = Img::saveImg($category);
        $category->save();
        return redirect('/admin/category/create');
    }
    public function update(Category $category) {
        $category->name = request('name');
//        $category->parent_id = request('parent_id');
        $category->reslug('name');
        if (request()->file()) {
            $category->img = Img::saveImg($category);
        }
        $category->update();
        return redirect('/admin/category');
    }
}