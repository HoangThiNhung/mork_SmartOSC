<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CategoryRequest;
use App\Http\Controllers\Controller;

use App\category;
use Request;

class categoryController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//tao mới 1 object
		$obj = new category;
		//mấy cái này cũng biết rồi cơ mà lệnh htmlMenu là làm gì?
		//qua function ấy xem nhé
		$menu_cat =  $obj->htmlMenu($obj->all()->toArray());
		return view ('backend.pages.category.ListCategory',array('menu_cat'=>$menu_cat));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$obj = new category;
		$listCategory = $obj->all()->toArray();
		return view('backend.pages.category.addCategory',compact('listCategory'));
	}

	//List category



	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CategoryRequest $request)
	{
		$obj = new category;
		$obj->insertCategory(Request::get('parent_id'),Request::get('category_name'));
		return redirect('admin/category')->withErrors(['error' => 'Done']);
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
		$cate = category::find($id);

		return view('backend.pages.category.edit',array('cate'=>$cate));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, CategoryRequest $request)
	{
		category::where('id',$id)->update(array('name'=>$request->category_name));
		return redirect('admin/category');

        
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{

		category::find($id)->delete();
        return redirect('admin/category/');
	}

}
