@extends('backend.layouts.admin')
@section('content')

<div class="content-wrapper">
  <section class="content-header">
          <h1>
            Add New Product
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">Add New Product</li>
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
      <div class="col-md-12">
          <div class="nav-tabs-custom">
          <form action="{{ Asset('admin/product') }}" method="post" enctype="multipart/form-data" class="form-horizontal"> 
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="true">Information</a></li>
              <li class=""><a href="#timeline" data-toggle="tab" aria-expanded="false">Image</a></li>
              <li class=""><a href="#settings" data-toggle="tab" aria-expanded="false">Description</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="activity">
              <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                <h3></h3>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label for="inputName" class="">Name</label>
                              <input type="text" class="form-control" id="inputName" placeholder="Name" name="name">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="SKU">SKU</label>
                          <input type="text" class="form-control" id="SKU" placeholder="SKU" name="SKU">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label for="category_id" class="">Category</label>
                              <select class="table-group-action-input form-control input-medium" name="category_id">
                                <option value="">Select...</option>
                                @foreach($category as $cat)
                                <option value="{{$cat->id}}">{{$cat->name}}</option>
                                @endforeach
                              </select>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="price" class="">Price</label>
                            <input type="text" class="form-control" id="price" placeholder="price" name="price">
                        </div>
                      </div>

                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="status" class="">Status</label>
                            <select class="table-group-action-input form-control input-medium" name="status">
                              <option value="">Select...</option>
                              <option value="1">Thin</option>
                              <option value="2">Slim</option>
                              <option value="3">yolo</option>
                              <option value="4">chuppy</option>
                              <option value="5">fat</option>
                            </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label for="color" class="">Color</label>
                              <select multiple class="table-group-action-input form-control input-medium" name="color[]">
                                <option value="">Select...</option>
                                @foreach($color as $colors)
                                <option value="{{$colors->id}}">{{$colors->name}}</option>
                                @endforeach
                              </select><br>
                            <input type="text" class="form-control" id="color" placeholder="màu khác" name="other_color">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label for="sile" class="">Size</label>
                            <select multiple class="table-group-action-input form-control input-medium" name="size[]">
                                <option value="">Select...</option>
                                @foreach($size as $sizes)
                                <option value="{{$sizes->id}}">{{$sizes->name}}</option>
                                @endforeach
                              </select><br>
                            <input type="text" class="form-control" id="size" placeholder="size khác" name="other_size">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                        <label for="promotion" class="">Promotion</label>
                          <input class="form-control" id="promotion"  name="promotion">
                    </div>
                    
                </div>
                <div class="col-md-3"></div>
              </div>

              </div><!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                <h3></h3>
                  <div class="form-group">
                      <label for="image" class="">thumbnail</label>
                        {!! Form::file('image',array('class'=>'form-control')) !!}
                  </div>
                  <div class="form-group">
                      <label for="image" class="">Multiple Image</label>
                        {!! Form::file('multi-images[]', array('multiple'=>true,'class'=>'form-control')) !!}
                  </div>
                </div>
                <div class="col-md-3"></div>
              </div><!-- /.tab-pane -->

              <div class="tab-pane" id="settings">
                
                  <script type="text/javascript">
                    tinymce.init({
                        selector: "textarea",
                        theme: "modern",
                        plugins: [
                             "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                             "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                             "save table contextmenu directionality emoticons template paste textcolor"
                       ],
                       content_css: "css/content.css",
                       toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons", 
                       style_formats: [
                            {title: 'Bold text', inline: 'b'},
                            {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                            {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                            {title: 'Example 1', inline: 'span', classes: 'example1'},
                            {title: 'Example 2', inline: 'span', classes: 'example2'},
                            {title: 'Table styles'},
                            {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
                        ],            
                        external_filemanager_path:"<?php echo Asset('/filemanager/'); ?>/",
                        filemanager_title:"Responsive Filemanager" ,
                        filemanager_access_key:"myPrivateKey" ,
                        external_plugins: { "filemanager" : "<?php echo Asset('/filemanager/plugin.min.js'); ?>"}
                     });
                </script>
                <script type="tex  t/javascript">
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
                <div class="col-md-1"></div>
                <div class="col-md-10">
                <h3></h3>
                    <div class="form-group">
                      <label class="control-label">Description
                      </label>
                        <textarea style="height:550px" id="content" class="form-control" name="description"></textarea>
                    </div>
                </div>
                <div class="col-md-1"></div>
              </div><!-- /.tab-pane -->
              <div class="form-group">
                <div class="col-sm-offset-3 col-sm-10">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </div>
              <div class="form-group">
                
              </div>
              </div><!-- /.tab-content -->
            </form>
          </div><!-- /.nav-tabs-custom -->
        </div><!-- /.col -->

    </section>
</div>
@stop