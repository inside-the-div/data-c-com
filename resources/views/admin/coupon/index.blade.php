@extends('admin.layouts.master')



@section('title')
<title>Add new categories</title>
@endsection


@section('content')




 <div class="row mt-2">
   <div class="col-12">
     <div class="card p-3 rounded-0 table-responsive">

     <table class="table table-striped table-dark display " id="dataTable">
       <thead>
         <tr>
           <th scope="col">No</th>
           <th scope="col">Code</th>
           <th scope="col">Start Date</th>
           <th scope="col">End Sate</th>
           <th scope="col">Type</th>
           <th scope="col">Discount</th>
           <th scope="col">Action</th>
         </tr>
       </thead>
      <tbody>
		@php 
			$i= 0;
		@endphp
		@foreach($coupons as $coupon)
			@php 
				$i++;
			@endphp
         <tr>
           <th class="font-pt font-18" >{{$i}}</th>
           <td class="font-pt font-18">{{$coupon->code}}</td>
           <td class="font-pt font-18">{{$coupon->start_time}}</td>
           <td class="font-pt font-18">{{$coupon->end_time}}</td>
           <td class="font-pt font-18">{{$coupon->type}}</td>
           <td class="font-pt font-18">{{$coupon->discount}} {{$coupon->discount_type}}</td>
           <td class="font-pt font-18">




            <a data-toggle="tooltip" data-placement="top" title="Full Info." class="btn btn-info" href="{{route('admin.coupon.show', ['id' => $coupon->id])}}"><i class="fa fa-eye" aria-hidden="true"></i>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Edit"  href="{{route('admin.coupon.edit', ['id' => $coupon->id])}}" class="btn btn-primary">
              <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
            </a>
            <a data-toggle="tooltip" data-placement="top"  title="Delete" class="btn btn-danger delete-btn" data-id="{{$coupon->id}}" href="#"><i class="fa fa-trash" aria-hidden="true"></i>
            </a>



{{-- 
            <div class="dropdown show">
              <a class="btn-admin btn-details dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Actions
              </a>
               <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                 
                   <a href="{{route('admin.coupon.show', ['id' => $coupon->id])}}" class="dropdown-item  action_button">Details</a>
                   <a  href="{{route('admin.coupon.edit', ['id' => $coupon->id])}}" class="dropdown-item action_button">Edit</a>
                   <a   href="#" class="dropdown-item action_button delete-btn" data-id="{{$coupon->id}}">Delete</a>

               </div>
             </div> --}}




           </td>
         </tr>
       @endforeach
       </tbody> 

       <tr>
       	
       </tr>
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
				<button type="button" class="btn-admin btn-delete" data-dismiss="modal">Close</button>
				<input type="submit" class="btn-admin btn-edit" value="Add" name="submit">
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




      $(".delete-btn").click(function(e){
        var id = $(this).data('id');
        var is_delete = delete_data(this,id,'/admin/coupon/delete');

        e.preventDefault();
      })
     



    })
  </script>

@endsection