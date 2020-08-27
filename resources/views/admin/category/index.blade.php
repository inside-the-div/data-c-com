@extends('admin.layouts.master')



@section('title')
<title>Categories</title>
@endsection


@section('content')


<!-- page title area  -->
<div class="row">
  <div class="col-12 text-right">
      <a data-toggle="tooltip" data-placement="top" title="Back" href="{{ url()->previous() }}" class="btn btn-primary"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>

      <button  data-placement="top" title="Add New Category" class="btn btn-dark" type="button" data-toggle="tooltip" id="category_add_btn">
        <i class="fa fa-plus-circle" aria-hidden="true"></i>
      </button>


      <form class="d-inline" action="{{route('admin.category.download')}}" method="POST">
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
           <th scope="col">Total Products</th>
           <th scope="col">Date</th>
           <th scope="col">Action</th>
         </tr>
       </thead>
      <tbody>
		@php 
			$i= 0;
		@endphp
		@foreach($categories as $category)
			@php 
				$i++;
			@endphp
         <tr align="center">
           <th class="font-pt font-18" >{{$i}}</th>
           <td class="font-pt font-18">{{$category->name}}</td>
           
           <td>{{$category->products->count()}}</td>
           <td class="font-pt font-18">{{$category->created_at->format('Y-m-d')}}</td>
           <td class="font-pt font-18">
           		<a data-toggle="tooltip" data-placement="top" title="Details" href="{{route('admin.category.show', ['slug' => $category->slug])}}" class="btn btn-info">
               <i class="fa fa-eye" aria-hidden="true"></i> 
              </a>
             
             <button  
             data-catid="{{$category->id}}" 
             data-catname="{{$category->name}}" 
              
             class="btn btn-primary cat-edit-btn" type="button"  data-toggle="tooltip" data-placement="top" title="Edit">
               <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
             </button>

              <a data-toggle="tooltip" data-placement="top" title="Delete" class="btn btn-danger delete-category" data-id="{{$category->id}}" href="#"><i class="fa fa-trash" aria-hidden="true"></i>
              </a>

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
  
        <label for=""><b>Name*</b></label>
        <input type="text" class="form-control rounded-0 mb-2 font-pt font-18" name="name" id="edit-cat-name">

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


      $(".cat-edit-btn").click(function(){
        

        var cat_id= $(this).data('catid');
        var cat_name= $(this).data('catname');

       
        $("#edit-cat-name").val(cat_name);
        $("#edit-cat-id").val(cat_id);
       

        

        $("#exampleModalForEdit").modal('show');
        
      })


      $(".delete-category").click(function(){
        var id = $(this).data('id');
        var is_delete = delete_data(this,id,'/admin/category/delete');
      })


      $("#category_add_btn").click(function(){
        $("#exampleModal").modal('show');
      })



    })
  </script>

@endsection