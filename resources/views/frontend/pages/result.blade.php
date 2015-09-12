            
@stop
@extends('frontend.layouts.default')
@include ('frontend.includes.format')
@section('content')
    @section('title')
        Tư vấn thời trang
    @endsection

<script src="https://cdn.firebase.com/js/client/2.2.1/firebase.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<div class="all">
   <div id="content">
      <div class="container">
      <div class="col-md-12">
        <ul class="breadcrumb">
            <li><a href="#">Home</a>
            </li>

            <li class="active">Tư vấn thời trang</li>
        </ul>

    </div>

        <div class="col-sm-12">
          	<div class="box">
                <div >
                  <h4><u>Hỏi</u></h4><strong><?php echo $content ?></strong>
                </div>
                <div  name="content" ><h4><u>Trả lời</u></h4> <em style="color:green"> <?php echo $rec->recommend ?></em>
                </div>
                <br><br>
                <div class="box">
                  <div class="row">
                  <?php foreach($product as $row){
                              $slug = convert_vi_to_en($row->name);
                              ?>
                    <div class="col-sm-3">

                                  <div class="product same-height">
                                      <div class="flip-container">
                                          <div class="flipper">
                                              <div class="front">
                                                  <a href="{{url('product-details/'.$row->id.'-product-'.$slug.'.html')}}">
                                                      <img src="{{asset('upload/product/'.$row->image)}}" alt="" class="img-responsive">
                                                  </a>
                                              </div>
                                              <div class="back">
                                                  <a href="{{url('product-details/'.$row->id.'-product-'.$slug.'.html')}}">
                                                      <img src="{{asset('upload/product/'.$row->image)}}" alt="" class="img-responsive">
                                                  </a>
                                              </div>
                                          </div>
                                      </div>
                                      <a href="{{url('product-details/'.$row->id.'-product-'.$slug.'.html')}}" class="invisible">
                                          <img src="{{asset('upload/product/'.$row->image)}}" alt="" class="img-responsive">
                                      </a>
                                      <div class="text">
                                      <a href="{{url('product-details/'.$row->id.'-product-'.$slug.'.html')}}">
                                          <h3>{{$row->name}}</h3>
                                      </a>
                                          <p class="price">{{price_formate( $row->price )}} VND</p>
                                      </div>
                                  
                                  <!-- /.product -->
                              </div>
                            </div>
                        <?php }
                        ?>

                    </div>
                    <a class="btn btn-primary" href="{{url('tu-van')}}">Quay lại</a>
                  </div>
                </div>
              </div>
            
        </div>
      </div>
    <div class="col-sm-2">
    </div>
  </div>
</div>


@stop