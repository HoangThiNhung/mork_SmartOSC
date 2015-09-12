<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\News;
use App\User;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        $news = News::all();
        $auth = User::all();
        return view('backend.pages.news.listNews',array('news'=>$news,'auth'=>$auth));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.pages.news.addNews');
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
        $data=$request->all();

        if(isset($data['image'])){
            $thumb  = $data['image'];
            $new = 'ava' . uniqid() . '.' . $thumb->getClientOriginalExtension();
            $thumb->move('upload/news' , $new);
        }
        $data['image'] = $new;

        $obj = new News;
        $obj->title = $data['title'];
        $obj->image = $data['image'];
        $obj->description = $data['description'];
        $obj->content = $data['content'];
        $obj->author_id = $data['author'];
        $obj->save();

        //return redirect('admin/users');
        return "Ok";
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
    }
}
