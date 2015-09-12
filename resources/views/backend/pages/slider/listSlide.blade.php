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
      <div class="row">
          <div class="col-lg-12">
              <div class="box">
          
                  <div class="box-header with-border">
                    <h3 class="box-title">List Slider</h3>
                  </div><!-- /.box-header -->
                  <div class="box-body">
                    <table class="table table-bordered">
                      <tbody><tr>
                        <th style="width: 10px">#</th>
                        <th>image</th>
                        <th>title</th>
                        <th>exception</th>
                        <th>description</th>
                        <th>btn-name</th>
                        <th>position</th>
                        <th colspan="2">Action</th>
                      </tr>
                      @foreach($slider as $row)
                      <tr>
                        <td>{{$row->id}}</td>
                        <td><img src="{{asset('upload/slider/'.$row->image)}}" height="50" ></td>
                        <td>
                          {{$row->tittle}}
                        </td>
                        <td>
                          <div class="form-group">
                            <textarea rows="3" class="form-control" name="exception">{{$row->exception}}</textarea>
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <textarea rows="3" class="form-control" name="description">{{$row->description}}</textarea>
                          </div>  
                        </td>
                        <td>
                          <div class="form-group">
                            <?php if($row->btn_name){ ?>
                              <button class="btn btn-primary">{{$row->btn_name}}</button>
                            
                              <?php } else echo "null"; ?>
                          </div>
                        </td>
                        <td>
                          {{$row->position}}
                        </td>
                        <td> <a href="{{route('admin.slider.edit',$row->id)}}" class="btn btn-warning">Update</a></td>
                        <td>
                          {!! Form::open(['method' => 'DELETE', 'route'=>['admin.slider.destroy', $row->id]]) !!}
                          {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                          {!! Form::close() !!}
                        </td>
                      </tr>
                      @endforeach
                    </tbody></table>
                  </div><!-- /.box-body -->
                  <div class="box-footer clearfix">
                    
                  </div>
                </div>
              </div>
          </div>
      </section>
</div>
@stop