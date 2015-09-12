<div class="content-wrapper">
  <section class="content-header">
    <h1>
      General Form Elements
      <small>Preview</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Add user</a></li>
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
          <h2 class="box-title">Add New Category</h2>
        </div><!-- /.box-header -->
        <div class="row">
            <div class="col-lg-offset-3 col-lg-6">
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif 
                	{!! Form::open(['url'=>'admin/category/create','method'=>'post']) !!}
        			<div class='form-group'>
        			{!! Form::label('category_name','Category Name: ')!!}
        			{!! Form::text('category_name',null,['placeholder'=>'Enter your category name...' , 'class'=>'form-control'])!!}
        			</div>
        			<div class='form-group'>
        			{!! Form::label('parent','New category belong to: ')!!}
        			<select class="form-control" name="parent_id">
        				<option value='0'>-Root</option>
        				@foreach($listCategory as $v)
        				<option value="{!! $v['id'] !!}">{!! $v['name'] !!}</option>							
        				@endforeach
        			</select>
        			</div>
        			{!! Form::submit('add Category',['class'=>'btn btn-primary center-block']) !!}
        			{!! Form::close() !!}

                    </div>
                </div>
                <div class="box-footer">
                  <h2 class="box-title"></h2>
                </div><!-- /.box-header -->
            </div>
        </section>
    </div>
