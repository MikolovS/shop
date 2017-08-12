<?php

namespace App\Http\Controllers;

use AlexeyMezenin\LaravelRussianSlugs\SlugsTrait;
use App\Category;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\StoreProduct;
use App\Http\Requests\UpdateProduct;
use App\Product;
use App\Http\HelpersModel\Img;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\New_;

class ProductController extends Controller
{
    use SlugsTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($category_slug)
    {
	    $category = Category::findBySlug($category_slug);
        return view('admin.product.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request, Product $product)
    {
	    $product->name = ucfirst(request('name'));
        $product->category_id = request('category_id');
        $product->price = request('price');
        $product->reslug('name');
        $product->slug = request('category_slug') . '--' . $product->slug;
        $product->img = Img::saveImg($product);
        $product->save();
	    $message = 'Создание произведено успешно!';
	    return redirect('/admin/product/' . $product->slug . '/edit')->with(compact('message'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $category = Category::all()->where('id', $product->category_id)->first()->toArray();
        return view('admin.product.edit', compact('product', 'categories', 'category', 'collection'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        if ($product->name !== request('name')) {
            \File::delete(public_path() . $product->img);
        }
        $product->name = ucfirst(request('name'));
        $product->category_id = request('category_id');
        $product->reslug('name', TRUE);
        $product->slug = request('category_slug') . '--' . $product->slug;
        $product->price = request('price');
        if (request()->file()) {
            $product->img = Img::saveImg($product);
        }
        $product->update();
        $message = 'Обновление произведено успешно!';
	    return redirect()->back()->with(compact('message'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
    	$product->delete();
	    $message = 'Продукт удален!';
	    return redirect()->back()->with(compact('message'));
    }
}
