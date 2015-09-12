<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Requests\ProductRequest;
use App\Product;
use App\category;
use App\Color;
use App\Size;
use App\MapColor;
use App\MapSize;
use App\Image;
use File;
use Input;
use Request;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $product = Product::all();
        return view('backend.pages.product.listProduct',compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        $cat_id = new category;
        $color = Color::all();
        $size = Size::all();
        $category = $cat_id->all();
        return view('backend.pages.product.addNew',array(
                                                        'category' => $category,
                                                        'color' => $color,
                                                        'size' => $size
                                                         ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(ProductRequest $request)
    {
        //
        $data=$request->all();

        if(isset($data['image'])){
            $thumb  = $data['image'];
            $new = 'pro' . uniqid() . '.' . $thumb->getClientOriginalExtension();
            $thumb->move('upload/product' , $new);
        }
        $data['image'] = $new;

        $productId = Product::addProduct($data);

        $multi_image = Input::file('multi-images');
        foreach ($multi_image as $multi) {
            # code...
            $thumbnail = 'multi'.uniqid().'.'. $multi->getClientOriginalExtension();
            $multi->move('upload/multi-image', $thumbnail);
            Image::addImage($productId,$thumbnail);
        }

        if(Input::get('color') != ""){
            $color = Input::get('color');
            foreach ($color as $colorId) {
                # code...
                MapColor::mapColor($colorId,$productId);
            }
        }

        if($data['other_color'] !=""){
            $other = $data['other_color'];
            $colorId= Color::addColor($other);

                MapColor::mapColor($colorId,$productId);
        }

        if(Input::get('size')!=""){
            $size = Input::get('size');
            foreach ($size as $sizeId) {
                # code...
                MapSize::mapSize($sizeId,$productId);
            }
        }
        

        if($data['other_size'] !=""){
            $other = $data['other_size'];
            $sizeId = Size::addSize($other);
                MapSize::mapsize($sizeId,$productId);
        }

        return redirect('admin/product');
        //return "ok";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
        
        $cat_id = new category;
        $category = $cat_id->all();
        $product = Product::find($id);
        return view('backend.pages.product.edit2', array('category'=>$category,'product'=>$product));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
        $model = new Product;
        $user = $model->updateProduct($id);
        return Redirect::to('admin/product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
        $model = Product::find($id)->toArray();
        Product::find($id)->delete();
        File::delete('upload/product/' . $model['image'] );
        return Redirect::to('admin/product');
    }
}
