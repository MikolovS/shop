<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Requests\UpdateCategory;
use Illuminate\Http\Request;
use App\Category;
use App\Http\HelpersModel\Img;
use App\Http\Requests\StoreCategory;

class CategoryController extends Controller
{
    public function welcome(){
        return view('layouts.main');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $categories = Category::all()->where('parent_id', 1)->toArray();
        if (!$categories) {
            $categories = [];
        }
        return view('admin.category.index', compact('categories'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($parent_slug){
	    $parent = Category::findBySlug($parent_slug);
        return view('admin.category.create', compact('parent'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request) {
        $category = new Category();
        $category->name = ucfirst(request('name'));
        $category->parent_id = request('parent_id');
        $category->reslug('name');
        $category->img = Img::saveImg($category);
        $category->save();
        return redirect('/admin/category/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category){
        $categories = Category::all()->where('parent_id', $category->id)->toArray();
        if (empty($categories)) {
            $products = $category->products->toArray();
            if (empty($products)) {
	            return view('admin.category.root', compact('category'));
            }
            return view('admin.product.index', compact('products', 'category'));
        }
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $collection = Category::all();
        $categories = $collection->groupBy('parent_id')->toArray();
        $parent = $collection->where('id', $category->parent_id)->first()->toArray();
        if (empty($parent)) {
            $parent = [

            ];
        }
        return view('admin.category.edit', compact('collection', 'categories', 'parent', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Category $category, CategoryRequest $request) {
        if ($category->name !== request('name')) {
            \File::delete(public_path() . $category->img);
        }
        $category->name = ucfirst(request('name'));
        $category->parent_id = request('parent_id');
        $category->reslug('name', TRUE);
        if (request()->file()) {
            $category->img = Img::saveImg($category);
        }
        $category->update();
	    $message = 'Обновление произведено успешно!';
	    return redirect()->back()->with(compact('message'));
    }

    public function group($category) {

    }

}
