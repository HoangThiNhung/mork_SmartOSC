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
      <li><a href="#">Forms</a></li>
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
          <h2 class="box-title">Add Role</h2>
        </div><!-- /.box-header -->
        <!-- form start -->
          {!! Form::open(['url'=>'/admin/updateRole','method'=>'post']) !!}
            <div class="box-body">
                <div class="col-lg-offset-3 col-lg-6">
                  <div class="form-group">
                    <label>Selects role to update</label>
                    <select class="form-control" name='role'>
                        <option value='0'>Select option to update</option>
                        @foreach($role as $row)
                        <option value='{{$row->id}}' >{{$row->name}}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    {!! Form::label('newRole','New name of role: ') !!}
                    {!! Form::text('newRole',null,['placeholder'=>'Enter new name role','class'=>'form-control'])!!}
                  </div>
                </div>
            </div><!-- /.box-body -->

            <div class="box-footer">
              <center><button type="submit" class="btn btn-primary">Submit</button></center>
            </div>
          {!! Form::close() !!}
      </div>
  </section>
</div>
@stop