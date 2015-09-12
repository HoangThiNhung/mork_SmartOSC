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

            @if( count($errors) > 0 )
                @foreach($errors->all() as $key => $done)
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>Oh snap!</strong> <?php echo $error;?>
                    </div>
                @endforeach

            @endif

                <?php echo  Form::open(array('url' => URL::to('admin/category/update')."/".$cate->id, 'class' => 'form-horizontal')) ; ?>
                

                <div class="form-group">
                <label for="category_name">Category Name: </label>
                <input class="form-control" name="category_name" type="text" id="category_name" value="<?php echo $cate->name ?>">
                </div>
                <div class="form-group">
                
                
                </div>
                <input class="btn btn-primary center-block" type="submit" value="Update Category">
                
                <?php echo  Form::close() ; ?>

            </div>
        </div>
        <div class="box-footer">
          <h2 class="box-title"></h2>
        </div><!-- /.box-header -->
    </div>
  </section>
</div>

        