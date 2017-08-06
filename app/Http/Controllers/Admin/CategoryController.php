<?php
/**
 * Created by PhpStorm.
 * User: Shaikan
 * Date: 7/30/2017
 * Time: 22:06
 */

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\HelpersModel\Img;
use App\Http\Requests\StoreCategory;

class CategoryController extends \App\Http\Controllers\CategoryController
{

    public function index() {
        return 'Category Controller';
    }

    public function create(){
        $categories = Category::all()->groupBy('parent_id')->toArray();
        return view('category.create', ['categories' => $categories]);
    }

    public function store(StoreCategory $request) {
//        $this->validate(\request(), [
//            'name' => 'required|min:2|unique:categories,name',
//            'parent_id' => 'required|integer',
//            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
//        ]);

        $category = new Category();
        $category->name = request('name');
        $category->parent_id = request('parent_id');
        $category->reslug('name');
        Img::saveImg($category);


        return redirect('/admin/category/create');
    }
//    public function store() {
////        dd(\request()->file('img'));
//        $this->validate(\request(), [
//            'name' => 'required|min:2|unique:categories,name',
//            'parent_id' => 'required|integer',
//            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
//        ]);
//        $image = request()->file('img');
//        $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
//        $destinationPath = public_path('/images');
//        $image->move($destinationPath, $input['imagename']);
//        $category = new Category();
//        $category->create(\request()->only('name', 'parent_id'));
//        return redirect('/admin/category/create');
//    }
}