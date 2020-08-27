@extends('admin.layouts.master')



@section('title')
<title>Single New Order</title>
@endsection


@section('content')
<!-- page title area  -->
<div class="row">
  <div class="col-12 text-right">
      <a data-toggle="tooltip" data-placement="top" title="Back" href="{{ url()->previous() }}" class="btn btn-primary"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>

      <a class="btn btn-info" data-toggle="tooltip" data-placement="top" title="About This Option" href=""><i class="fa fa-info-circle" aria-hidden="true"></i></a>
  </div>
</div>

<div class="row mt-2">
	<div class="col-12 col-lg-4">
		<div class="card p-3">
			<h1 class="text-center font-pt font-25">{{$category->name}}</h1>
			<h5 class="text-center font-pt font-18 mt-1"><b>Added By: </b>{{$category->user->name}}</h5>
			<h5 class="text-center font-pt font-18"><b>Date: </b>{{$category->created_at->format('d-m-Y')}}</h5>
			<hr>
			
			<img src="{{URL::asset('assets/img/category/')}}/{{$category->image}}" alt="" class="img-fluid border" >
			 <hr>
			<p><b>Description: </b>{{$category->description}}</p>
			<p><b>Tag: </b>{{$category->tag}}</p>

		</div>
	</div>
	<div class="col-12 col-lg-8">
		<div class="card p-3" style="max-height: 700px; overflow-y: scroll;">
			<h2 class="text-center font-pt font-25">Products</h2>
			<hr>

			 <div class="row">
			   <div class="col-12">

			    
			     <div class="card p-3 rounded-0 table-responsive">

			     <table class="table table-striped table-dark display " id="dataTable">
			       <thead>
			         <tr align="center">
			          
			           <th scope="col">Name</th>
			           
			           <th scope="col">Image</th>
			           <th scope="col">Stock</th>
			           
			           <th scope="col">Confirm</th>
			           <th scope="col">Action</th>
			         </tr>
			       </thead>
			      <tbody>
					
					@foreach($products as $product)
						
			         <tr  align="center"   data-toggle="tooltip" data-placement="top"

			            @if($product->stock < 1) title="Out Of Stock"  
			            @elseif($product->stock < 10) title="Low Stock" @endif

			          >
			          
			           <td class="font-pt font-18">{{$product->name}}</td>
			           
			           <td class="font-pt font-18"><img width="40px" class="" src="{{URL::asset('/assets/img/products')}}/{{$product->image}}" alt=""></td>

			           <td><a href="" class="text-light font-pt font-18">{{$product->stock}}</a></td>


			          

			           <td align="left">
			             <div class="custom-control custom-switch">
			               <input type="checkbox" @if($product->home_show == 1) checked @endif class="custom-control-input show-home" data-id="{{$product->id}}" id="show-home-{{$product->id}}">
			               <label class="custom-control-label" for="show-home-{{$product->id}}">Show Home</label>
			             </div>
			             <div class="custom-control custom-switch">
			               <input type="checkbox" @if($product->active == 1) checked @endif class="custom-control-input active-product" data-id="{{$product->id}}" id="active-{{$product->id}}">
			               <label class="custom-control-label" for="active-{{$product->id}}">Active</label>
			             </div>
			           </td>
			           <td class="font-pt font-18">


			            


			            <a data-toggle="tooltip" data-placement="top" title="Full Info." class="btn btn-info" href="{{route('admin.product.show', ['slug' => $product->slug])}}"><i class="fa fa-eye" aria-hidden="true"></i>
			            </a>



			           </td>
			         </tr>
			       @endforeach
			       </tbody> 

			     </table>

			     
			     </div>
			   </div>
			 </div>
		</div>
	</div>
</div>


@endsection

@section('footer-section')
  
  <script>
    $(document).ready(function(){

        $(document).on("click",".show-home",function() {
          var id = $(this).data('id');
          $.ajax({

             type:'POST',
             url:'/admin/product/home_show_hide',
             data:{id:id},
             success:function(data){

                var message  = JSON.stringify(data.message).replace(/"/g, "");

                Toast.fire({
                  icon: 'success',
                  title: message
                })
             }

          });
          
        })
     

        

    })



   


  </script>

@endsection