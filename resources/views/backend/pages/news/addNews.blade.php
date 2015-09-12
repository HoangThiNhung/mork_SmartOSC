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
          <form action="{{ Asset('admin/news') }}" method="post" enctype="multipart/form-data" class="form-horizontal"> 
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" name="author" value="{{ Auth::user()->id }}">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="true">Information</a></li>
              <li class=""><a href="#settings" data-toggle="tab" aria-expanded="false">Content</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="activity">
              <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                <h3></h3>
                        <div class="form-group">
                            <label for="inputName" class="">title</label>
                              <input type="text" class="form-control" id="inputName" placeholder="title" name="title">
                        </div>
                        <div class="form-group">
                          <label for="SKU">Image</label>
                          <input type="file" class="form-control" id="file"  name="image">
                        </div>
                        <div class="form-group">
                            <label for="category_id" class="">Short Description</label>
                              <input type="text" class="form-control" placeholder="short description" name="description">
                        </div>
                      </div>
                </div> 
              </div>
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
	                      <label class="control-label">Content
	                      </label>
	                        <textarea style="height:550px" id="content" class="form-control" name="content"></textarea>
	                    </div>
	                </div>
	                <div class="col-md-1"></div>
	              </div><!-- /.tab-pane -->   
	              <div class="form-group">
	                <div class="col-sm-offset-3 col-sm-10">
	                  <button type="submit" class="btn btn-primary">Submit</button>
	                </div>
	              </div>
	              <div class="form-group"></div>

              </div><!-- /.tab-content -->
            </form>
          </div><!-- /.nav-tabs-custom -->
        </div><!-- /.col -->

    </section>
</div>
@stop