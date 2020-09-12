@extends('admin.layouts.master')



@section('title')
<title>{{$product->name}}</title>
@endsection


@section('content')
<!-- page title area  -->
<div class="row">
  <div class="col-12 col-lg-8">
      <div class="card p-3 rounded-0">
          <div class="row">

            <div class="col-12">
              <h1 class="font-pt font-25 text-center">
               {{$product->name}}
               
              </h1>
              <h5 class="text-center font-18 mt-1">
                <b>Added By: </b> {{$product->user->name}}
              </h5>
              <h5 class="text-center font-18">
                <b>Added Date: </b> {{$product->created_at->format('d-m-Y')}}
              </h5>
              <hr>
              <div class="row" >
                <div class="col-12 col-lg-4">
                    <ul>
                      <li><b>Code: </b>{{$product->code}}</li>
                      <li><b>Tag Line: </b>{{$product->tag_line}}</li>
                      <li><b>View: </b>{{$product->view}}</li>
                      <li><b>Rating: </b>{{$product->rating}}</li>
                      <li><b>Reviews: </b>{{$product->reviews->count()}}</li>
                    </ul>
                </div>
                <div class="col-12 col-lg-4">
                  <ul>
                    <li><b>Stock: </b>{{$product->stock}}</li>
                    <li><b>Price: </b>{{$product->price}}</li>
                    <li><b>Discount: </b>{{$product->discount}}</li>
                    <li><b>Shipping cost: </b>{{$product->shipping_cost}}</li>
                  </ul>
                </div>

                <div class="col-12 col-lg-4">
                  <ul>
                    <li class=" mb-1 @if($product->active) bg-success @else bg-warning @endif" ><b>Active: </b>@if($product->active) Yes @else No @endif</li>
                    <li class=" mb-1 @if($product->available) bg-success @else bg-warning @endif"><b>Available: </b>@if($product->available) Yes @else No @endif</li>
                    <li class="@if($product->home_show) bg-success @else bg-warning @endif"><b>Show Home Page: </b>@if($product->home_show) Yes @else No @endif</li>
                    
                  </ul>
                </div>
              </div>






              <div class="font-pt font-18 mt-2 p-1" style="background: #ececec;">
                <b>Categories:</b>
                <ol>
                @foreach($product->categories as $category)
                 
                 <li class="font-pt font-16 d-inline"><a href="" class="text-info font-18">{{$category->name}}</a></li>
                
                @endforeach
                </ol>
              </div>

              <div class="font-pt font-18 mt-2 p-1" style="background: #ececec;">
                <b>Attributes:</b> 
                {!! $product->attributes !!}
              </div>

              <div class="font-pt font-18 mt-2 p-1" style="background: #ececec;">
                <b>Description:</b> <br>
                {{$product->description}}
              </div>

            </div>
          </div>
      </div>
  </div>
  <div class="col-12 col-lg-4" >

    <div class="row">
      <div class="col-12">
        
        <div class="card p-3">
          <img src="{{URL::asset('assets/img/products/')}}/{{$product->image}}" alt="" class="img-fluid " id="large-img">
          <div class="row">

            
              <div class="col-lg-4 col-12 mt-2">
                <img  src="{{URL::asset('assets/img/products/large-image/')}}/{{$product->image}}" alt="" class="img-fluid small-img ">
              </div>
            
          </div>
        </div>
       
      </div>
    </div>

  </div>
</div>

<div class="row mt-3 mb-5" >
  <div class="col-12 col-lg-6" style="max-height: 700px; overflow-y: scroll;">
    <div class="card p-3">
      <div class="text-center">
        <h5>All Reviews ({{$product->reviews->count()}})</h5>
        <hr>
      </div>
      <ol>
        @foreach($product->reviews as $review)
          <li class="p-2  mb-1 @if($review->active == 1) bg-success  @else bg-warning text-dark @endif">
            <b>Name: </b>{{$review->user->name}} <br>
            <b>Comment: </b>{{$review->comment}} <br>
            <b>Star: </b>{{$review->star}}
        </li>
        @endforeach
      </ol>
    </div>
  </div>

  <div class="col-12 col-lg-6" style="max-height: 700px; overflow-y: scroll;">
    <div class="card p-3">
      <div class="text-center">
        <h5>Order / Sell History</h5>
        <hr>
      </div>
      <ol>
        @foreach($product->reviews as $review)
          <li class="p-2  mb-1 @if($review->active == 1) bg-success  @else bg-warning text-dark @endif">
            <b>Name: </b>{{$review->user->name}} <br>
            <b>Comment: </b>{{$review->comment}} <br>
            <b>Star: </b>{{$review->star}}
        </li>
        @endforeach
      </ol>
    </div>
  </div>
</div>

@endsection

@section('footer-section')
    <script>
    $(document).ready(function(){

      $(".small-img").click(function(){

        var current_large_image = $("#large-img").attr('src');
        var this_img = $(this).attr('src');
        $("#large-img").attr('src',this_img);
        $(this).attr('src',current_large_image);
       
      })


    })
  </script>
@endsection