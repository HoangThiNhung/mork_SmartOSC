            
@stop
@extends('frontend.layouts.default')
@include ('frontend.includes.format')
@section('content')
    @section('title')
        Chat
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

            <li class="active">Recommend</li>
        </ul>

    </div>

        <div class="col-sm-12">
          	{!! Form::open(['method' => 'post','url'=>['recommend'],'class'=>'form-horizontal']) !!}
              <div class="box">
                <textarea id="messagesDiv" name="content" rows="4" class="form-control" style="height:300px;overflow: scroll;"></textarea>
              </div>
              <div>
                <div class="col-sm-2">
                  <button type="submit" class="btn btn-primary" >tư vấn</button>
                </div>
                <br>
                <br>
              
            {!!Form::close()!!}
              </div>
            
            </div>
          </div>
          <div class="col-sm-2">
          </div>
         </div>
        </div>


@stop