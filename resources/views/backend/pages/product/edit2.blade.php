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
    <section class="content">
      <div class="col-md-12">
          <div class="nav-tabs-custom">
          {!! Form::model($product,['method' => 'PATCH','route'=>['admin.product.update',$product->id],'class'=>'form-horizontal']) !!}
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
                              <input type="text" class="form-control" id="inputName" value="{{$product->name}}" placeholder="Name" name="name">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="SKU">SKU</label>
                          <input type="text" class="form-control" value="{{$product->SKU}}" id="SKU" placeholder="SKU" name="SKU">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label for="category_id" class="">Category</label>
                              <select class="table-group-action-input form-control input-medium" name="category_id">
                                <option value="{{$product->category_id}}"><?php

                                  foreach($category as $row){
                                    if($row->id ==$product->category_id)
                                      echo $row->name;
                                  }

                                  ?></option>
                                  @foreach($category as $cat)
                                  <option value="{{$cat->id}}">{{$cat->name}}</option>
                                  @endforeach
                              </select>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" class="form-control" value="{{$product->quantity}}" id="quantity" name="quantity">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="price" class="">Price</label>
                            <input type="text" class="form-control" value="{{$product->price}}" id="price" placeholder="price" name="price">
                        </div>
                      </div>

                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="status" class="">Status</label>
                            <select class="table-group-action-input form-control input-medium" name="status">
                              <option value="{{$product->status}}">{{$product->status}}</option>
                              <option value="HOT">HOT</option>
                              <option value="SALE">SALE</option>
                              <option value="GIF">GIF</option>
                              <option value="NEW">NEW</option>
                            </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label for="color" class="">Color</label>
                              <input type="text" class="form-control" value="{{$product->color}}" id="color" placeholder="color" name="color">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label for="sile" class="">Size</label>
                              <input type="text" class="form-control" value="{{$product->size}}" id="size" placeholder="size" name="size">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                        <label for="promotion" class="">Promotion</label>
                          <input class="form-control" value="{{$product->promotion}}" id="promotion"  name="promotion">
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
                      <label for="image" class="">Image 1</label>
                        <input type="file" name="image" class="form-control">
                  </div>
                  <div class="form-group">
                      <label for="image" class="">Image 2</label>
                        <input type="file" name="image2" class="form-control">
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
                        <textarea style="height:550px" id="content" class="form-control" name="description"><?php echo $product->description ?></textarea>
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
            {!! Form::close() !!}
          </div><!-- /.nav-tabs-custom -->
        </div><!-- /.col -->

    </section>
</div>
@stop