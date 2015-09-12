@extends('backend.layouts.admin')
@section('content')

<div class="content-wrapper">
  <section class="content-header">
    <h1>
      General Form Elements
      <small>Preview</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Edit Slider</a></li>
      <li class="active">General Elements</li>
    </ol>
  </section>
  @if (count($errors) > 0)
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif
  <section class="content">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h2 class="box-title">Edit Slider</h2>
        </div><!-- /.box-header -->
        <!-- form start -->
        {!! Form::model($row,['method' => 'PATCH','route'=>['admin.slider.update',$row->id],'class'=>'form-horizontal']) !!}
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="box-body">
                <div class="col-lg-offset-3 col-lg-6">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" autocomplete='off' value="{{$row->tittle}}" name="tittle">
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <img src="{{asset('upload/slider/'.$row->image)}}" class="image-responsive" height="50">
                        <input type="file" class="form-control" id="image" autocomplete='off' value="{{$row->image}}" name="image">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">path</label>
                        <input type="text" class="form-control" id="path" autocomplete='off' value="{{$row->path}}" name="path">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">exception</label>
                        <textarea rows="3" class="form-control" id="exception" name="exception">{{$row->exception}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Description</label>
                        <textarea rows="3" class="form-control" id="description" name="description">{{$row->description}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">button name</label>
                        <input type="text" class="form-control" id="btn_name" autocomplete='off' value="{{$row->btn_name}}" name="btn_name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">position</label>
                        <input type="number" class="form-control" id="position" autocomplete='off' value="{{$row->position}}" name="position">
                    </div>
          
                </div>
            </div><!-- /.box-body -->

            <div class="box-footer">
              <center><button type="submit" class="btn btn-primary">Submit</button></center>
            </div>
        {{!! Form::close() !!}}
      </div>
  </section>
</div>
@stop