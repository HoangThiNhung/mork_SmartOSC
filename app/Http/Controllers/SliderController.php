<?php

namespace App\Http\Controllers;

use App\Slider;
use App\Http\Requests;
use Request;
use App\Http\Controllers\Controller;
use File;
use Illuminate\Support\Facades\Redirect;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        $slider= Slider::all();
        return view('backend.pages.slider.listSlide',compact('slider'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('backend.pages.slider.addNew');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
        $data=Request::all();

        if(isset($data['image'])){
            $thumb  = $data['image'];
            $new = 'slider' . uniqid() . '.' . $thumb->getClientOriginalExtension();
            $thumb->move('upload/slider' , $new);
        }
        $data['image'] = $new;

        Slider::create($data);
        //return redirect('admin/slider');
        return redirect('admin/slider');
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
        $row = Slider::find($id);
        return view('backend.pages.slider.edit',compact('row'));
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
        $data = Request::all();
        if(isset($data['image'])){
            $thumb  = $data['image'];
            $new = 'slider' . uniqid() . '.' . $thumb->getClientOriginalExtension();
            $thumb->move('upload/slider' , $new);
        }
        $data['image']= $new;

        Slider::where('id',$id)->update(array(
            'image'=>$data['image'],
            'path'=>$data['path'],
            'exception'=>$data['exception'],
            'description'=>$data['description'],
            'btn_name'=>$data['btn_name'],
            'position'=>$data['position'],
        ));
        return Redirect::back();
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
        $model = Slider::find($id)->toArray();
        Slider::find($id)->delete();
        File::delete('upload/slider/' . $model['image'] );
        return Redirect::to('admin/slider');
    }
}
