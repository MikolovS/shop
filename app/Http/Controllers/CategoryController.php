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
	    $collection = Category::all()->groupBy('parent_id')->toArray();

	    dd($collection);

        return view('layouts.main');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $collection = Category::all();
	    $categories =$collection->where('parent_id', 1)->toArray();
        if (!$categories) {
	        return view('admin.category.start', compact('category'));
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
    public function store(CategoryRequest $request, Category $category) {
        $category->name = mb_convert_case(request('name'), MB_CASE_TITLE, 'UTF-8');
        $category->parent_id = (integer) request('parent_id');
        $category->reslug('name');
        $category->img = Img::saveImg($category);
        $category->save();
        $message = 'Категория "' . $category->name . '" успешно создана!';
        if ($category->parent_id !== 1) {
	        return redirect('/admin/category/'. request('parent_slug'))->with(compact('message'));
        }
	    return redirect('/admin/category/')->with(compact('message'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category){
        $collections = Category::all();
        $categories = $collections->where('parent_id', $category->id)->toArray();
	    $branchIds = $category->categoryBranch($collections, $category->id);
	    $links = $category->links($collections, $branchIds, TRUE);
        if (empty($categories)) {
            $products = $category->products->toArray();
            if (empty($products)) {
	            return view('admin.category.root', compact('category', 'links'));
            }
            return view('admin.product.index', compact('products', 'category', 'links'));
        }
        return view('admin.category.show', compact('categories', 'category','links'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $parent = Category::all()->where('id', $category->parent_id)->first()->toArray();
        if (empty($parent)) {
            $parent = [
				'id' => '1',
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
        $category->name = mb_convert_case(request('name'), MB_CASE_TITLE, 'UTF-8');
        $category->parent_id = request('parent_id');
        $category->reslug('name', TRUE);
        if (request()->file()) {
            $category->img = Img::saveImg($category);
        }
        $category->update();
	    $message = 'Обновление произведено успешно!';
	    return redirect()->back()->with(compact('message'));
    }

	public function destroy(Category $category)
	{
		$category->delete();
		Img::delete($category);
		$category->deleteChild();
		$message = 'Категория ' . $category->name . ' удалена!';
		return redirect()->back()->with(compact('message'));
	}

}
