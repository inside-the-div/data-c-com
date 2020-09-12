@extends('admin.layouts.master')



@section('title')
  <title>All Products</title>
@endsection


@section('content')

<!-- page title area  -->
<div class="row">
  <div class="col-12 text-right py-2">
      <a data-toggle="tooltip" data-placement="top" title="Back" href="{{ url()->previous() }}" class="btn btn-primary"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>

      <a data-toggle="tooltip" data-placement="top" title="Add New Products" class="btn btn-dark" href="{{route("admin.product.add")}}"> <i class="fa fa-plus-circle fa-fw" aria-hidden="true"></i></a>

      <form class="d-inline" action="{{route('admin.product.download')}}" method="POST">
        @csrf
        <button data-toggle="tooltip" data-placement="top" title="Donwload Category Data" class="btn btn-success"><i class="fa fa-download" aria-hidden="true"></i></button>
      </form>

      <a class="btn btn-info" data-toggle="tooltip" data-placement="top" title="About This Option" href=""><i class="fa fa-info-circle" aria-hidden="true"></i></a>
  </div>
</div>



 <div class="row mt-2">
   <div class="col-12">

    
     <div class="card p-3 rounded-0 table-responsive">

     <table class="table table-striped table-dark display " id="dataTable">
       <thead>
         <tr align="center">
           <th scope="col">No</th>
           <th scope="col">Name</th>
           <th scope="col">Code</th>
           <th scope="col">Image</th>
           <th scope="col">Stock</th>
           <th scope="col">Date</th>
           <th scope="col">Confirm</th>
           <th scope="col">Action</th>
         </tr>
       </thead>
      <tbody>
		@php 
			$i= 0;
		@endphp
		@foreach($products as $product)
			@php 
				$i++;
			@endphp
         <tr  align="center"   data-toggle="tooltip" data-placement="top"

            @if($product->stock < 1) title="Out Of Stock"  
            @elseif($product->stock < 10) title="Low Stock" @endif

          >
           <th class="font-pt font-18" >{{$i}}</th>
           <td class="font-pt font-18">{{$product->name}}</td>
           <td><a href="" class="text-light font-pt font-18">{{$product->code}}</a></td>
           <td class="font-pt font-18"><img width="40px" class="" src="{{URL::asset('/assets/img/products')}}/{{$product->image}}" alt=""></td>

           <td><a href="" class="text-light font-pt font-18">{{$product->stock}}</a></td>


           <td class="font-pt font-18">{{$product->created_at->format('Y-m-d')}}</td>

           <td align="left">

      {{--        <div class="custom-control custom-switch">
               <input type="checkbox" @if($product->home_show == 1) checked @endif class="custom-control-input show-home" data-id="{{$product->id}}" id="show-home-{{$product->id}}">
               <label class="custom-control-label" for="show-home-{{$product->id}}">Show Home</label>
             </div> --}}

             <div class="custom-control custom-switch">
               <input type="checkbox" @if($product->active == 1) checked @endif class="custom-control-input active-product" data-id="{{$product->id}}" id="active-{{$product->id}}">
               <label class="custom-control-label" for="active-{{$product->id}}">Active</label>
             </div>
           </td>
           <td class="font-pt font-18">


            <a data-toggle="tooltip" data-placement="top" title="Full Info." class="btn btn-info" href="{{route('admin.product.show', ['slug' => $product->slug])}}"><i class="fa fa-eye" aria-hidden="true"></i>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Edit"  href="{{route('admin.product.edit', ['id' => $product->id])}}" class="btn btn-primary">
              <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
            </a>
            <a data-toggle="tooltip" data-placement="top"  title="Delete" class="btn btn-danger delete-product" data-id="{{$product->id}}" href="#"><i class="fa fa-trash" aria-hidden="true"></i>
            </a>


           </td>
         </tr>
       @endforeach
       </tbody> 

     </table>

     
     </div>
   </div>
 </div>
 <!-- website info area end -->


<!-- category add modal -->

<!-- Modal add -->
<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-20 font-pt" id="exampleModalLabel">Add new category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
		<form action="{{route('admin.category.store')}}" method="POST" enctype="multipart/form-data">
			@csrf
			<div class="modal-body">
				<label for=""><b>Name*</b></label>
				<input type="text" class="form-control rounded-0 mb-2 font-pt font-18" name="name">

        <label for=""><b>Image*</b></label>
        <input type="file" name="image" class="form-control rounded-0">

				<label for=""><b>Description*</b></label>
				<textarea name="description" id="" cols="30" rows="5" class="form-control rounded-0 mb-2 font-pt font-18"></textarea>

				<label for=""><b>Tag*</b></label>
				<textarea name="tag" id="" cols="30" rows="5" class="form-control rounded-0 mb-2 font-pt font-18"></textarea>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-danger font-18" data-dismiss="modal">Close</button>
				<input type="submit" class="btn btn-info  font-18" value="Add" name="submit">
			</div>

		</form>

    </div>
  </div>
</div>





<!-- Modal  edit-->
<div class="modal fade bd-example-modal-lg" id="exampleModalForEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelForEdit" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-20 font-pt" id="exampleModalLabelForEdit">Edit Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form action="{{route('admin.category.update')}}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="modal-body">

        <input type="hidden" name="id" value="" id="edit-cat-id">
        <input type="hidden" name="user_id" value="" id="edit-cat-user-id">
        <label for=""><b>Name*</b></label>
        <input type="text" class="form-control rounded-0 mb-2 font-pt font-18" name="name" id="edit-cat-name">

        <label for=""><b>Image</b></label>
        <input type="file" name="image" class="form-control rounded-0">
        
        <label for=""><b>Description*</b></label>
        <textarea name="description" id="edit-cat-des" cols="30" rows="5" class="form-control rounded-0 mb-2 font-pt font-18" ></textarea>

        <label for=""><b>Tag*</b></label>
        <textarea name="tag" id="edit-cat-tag" cols="30" rows="5" class="form-control rounded-0 mb-2 font-pt font-18"></textarea>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-danger font-18" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-info  font-18" value="Update" name="submit">
      </div>

    </form>

    </div>
  </div>
</div>




@endsection

@section('footer-section')
  
  <script>
    $(document).ready(function(){


        $(".delete-product").click(function(){
          var id = $(this).data('id');
          var is_delete = delete_data(this,id,'/admin/product/delete');
        })


        
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
          }); // end ajax
        }) // end home show




        $(document).on("click",".active-product",function() {
          var id = $(this).data('id');

          

          $.ajax({
             type:'POST',
             url:'/admin/product/active_deactivated',
             data:{id:id},
             success:function(data){
                var message  = JSON.stringify(data.message).replace(/"/g, "");
                Toast.fire({
                  icon: 'success',
                  title: message
                })
             }
          }); // end ajax
        }) // end home show
     

        

    })

  </script>

@endsection