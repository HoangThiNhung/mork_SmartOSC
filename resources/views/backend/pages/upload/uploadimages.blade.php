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
          <h2 class="box-title">Upload</h2>
        </div><!-- /.box-header -->
        <div class="row">
          <div class="col-lg-offset-2 col-lg-8">
            <input type="text" id="images" class="form-control" /> <br>
            <button class="btn btn-info">
            <a href="{{ Asset('filemanager/dialog.php?type=1&field_id=images&akey=myPrivateKey') }}" role="button" class="button-tynimce">Browser</a>
            </button>
          </div>
        </div>
        <div class="box-footer">
          <h2 class="box-title"></h2>
        </div>
      </div>
    </section>
  </div>
             <script type="text/javascript">
                jQuery(document).ready(function ($) {
                    $('.button-tynimce').fancybox({
                          'width'   : 880,
                          'height'  : 1000,
                          'type'    : 'iframe',
                          'autoScale'   : false
                      });
                    $('.fancybox').fancybox();
                    $('.button-tynimce').on('click',function(){
                    $(window).on('message', OnMessage);
                    });
                }); 
            </script>
@stop