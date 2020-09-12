@extends('admin.layouts.master')

@section('title')
  <title>All Brands</title>
@endsection


@section('content')



<!-- page title area  -->
<div class="row">
  <div class="col-12 text-right">
      <a data-toggle="tooltip" data-placement="top" title="Back" href="{{ url()->previous() }}" class="btn btn-primary"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>
        <button class="btn btn-dark
        " type="button" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus-circle" aria-hidden="true"></i></i></button>
      <a data-toggle="tooltip" data-placement="top" title="Download Categories Info." href="{{ url()->previous() }}" class="btn btn-success">
        <i class="fa fa-download" aria-hidden="true"></i>
      </a>
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
           <th scope="col">Image</th>
           <th scope="col">Total Porducts</th>
           <th scope="col">Action</th>
         </tr>
       </thead>
      <tbody>
		@php 
			$i= 0;
		@endphp
		@foreach($brands as $brand)
			@php 
				$i++;
			@endphp
         <tr align="center">
           <th class="font-pt font-18" >{{$i}}</th>
           <td class="font-pt font-18">{{$brand->name}}</td>
           <td class="font-pt font-18"><img width="30px;" src="{{URL::asset('uploadedimages')}}/{{$brand->image}}" alt=""></td>
           <td class="font-pt font-18">{{$brand->products->count()}}</td>
            <td>


                  <a data-toggle="tooltip" data-placement="top" title="Brand Details"  href="{{route('admin.brand.show', ['id' => $brand->id])}}" class="cusron font-18 font-pt btn btn-success">
                   <i class="fa fa-eye" aria-hidden="true"></i> 
                  </a>
                  <a href="#" class="cusron font-18 font-pt btn btn-info brand-edit-btn"   data-brandid="{{$brand->id}}" data-brandname="{{$brand->name}}" data-branddes="{{$brand->description}}" data-brandtag="{{$brand->tag}}"   type="button" data-toggle="modal" data-target="#exampleModalForEdit"  >
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                  </a>

                  <button  data-toggle="tooltip" data-placement="top" title="Delete Brand"   data-id="{{$brand->id}}" class="btn btn-danger delete-brand" type="button" >
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
                    <i class="fa fa-trash" aria-hidden="true"></i>
                  </button>


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


<!-- brand add modal -->

<!-- Modal add -->
<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-20 font-pt" id="exampleModalLabel">Add new brand</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
		<form action="{{route('admin.brand.store')}}" method="POST" enctype="multipart/form-data">
			@csrf
			<div class="modal-body">
				<label for=""><b>Name*</b></label>
				<input  required type="text" class="form-control rounded-0 mb-2 font-pt font-18" name="name">

        <label for=""><b>Image*</b></label>
        <input required  type="file" name="image" class="form-control rounded-0 input-file">

				
            <label for="description"><b>Description*</b></label>
            <textarea name="description" id="description" cols="30" rows="5" class="form-control rounded-0 mb-2 font-pt font-18"></textarea>

            <label for="tag"><b>Tag*</b></label>
            <textarea id="tag" name="tag" id="" cols="30" rows="5" class="form-control rounded-0 mb-2 font-pt font-18"></textarea>    
        


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
        <h5 class="modal-title font-20 font-pt" id="exampleModalLabelForEdit">Edit Brand</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form action="{{route('admin.brand.update')}}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="modal-body">

        <input type="hidden" name="id" value="" id="edit-brand-id">
        <input type="hidden" name="user_id" value="" id="edit-brand-user-id">
        <label for=""><b>Name*</b></label>
        <input required type="text" class="form-control rounded-0 mb-2 font-pt font-18" name="name" id="edit-brand-name">

        <label for=""><b>Image</b></label>
        <input   type="file" name="image" class="form-control rounded-0 input-file">
        
        <label for=""><b>Description*</b></label>
        <textarea name="description" id="edit-brand-des" cols="30" rows="5" class="form-control rounded-0 mb-2 font-pt font-18" ></textarea>

        <label for=""><b>Tag*</b></label>
        <textarea name="tag" id="edit-brand-tag" cols="30" rows="5" class="form-control rounded-0 mb-2 font-pt font-18"></textarea>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn-admin btn-delete" data-dismiss="modal">Close</button>
        <input type="submit" class="btn-admin btn-edit" value="Update" name="submit">
      </div>

    </form>

    </div>
  </div>
</div>




@endsection

@section('footer-section')
  
  <script>




    $(document).ready(function(){

      $(".brand-edit-btn").click(function(){
        //alert("thjis");

        var brand_id      =   $(this).data('brandid');
        var brand_name    =   $(this).data('brandname');
        var brand_des     =   $(this).data('branddes');
        var brand_tag     =   $(this).data('brandtag');
        var brand_user_id =   $(this).data('branduserid');

        $("#edit-brand-name").val(brand_name);
        $("#edit-brand-des").val(brand_des);
        $("#edit-brand-tag").val(brand_tag);
        $("#edit-brand-id").val(brand_id);
        $("#edit-brand-user-id").val(brand_user_id);
        
      })




      $(".delete-brand").click(function(){

        var id = $(this).data('id');
        var is_delete = delete_data(this,id,'/admin/brand/delete');
        // if(is_delete){
        //   $(this).hide();
        // }
      })




    })
  </script>

@endsection