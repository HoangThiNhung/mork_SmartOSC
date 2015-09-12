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
          <h2 class="box-title">List Category</h2>
        </div><!-- /.box-header -->
        <div class="col-lg-offset-2 col-lg-8">
      		<?php echo $menu_cat ?>
      	</div>
      	<div class="box-footer with-border">
      		<h3></h3>
      	</div>
    </div>
  </section>
</div>
@stop