@extends('admin.layouts.master')



@section('title')
<title>All User</title>
@endsection


@section('content')



<div class="row">
  <div class="col-12 text-right">
      <a data-toggle="tooltip" data-placement="top" title="Back" href="{{ url()->previous() }}" class="btn btn-primary">
        <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
      </a>

      <a data-toggle="tooltip" data-placement="top" title="Download User Data" href="{{ url()->previous() }}" class="btn btn-success">
        <i class="fa fa-download" aria-hidden="true"></i>
      </a>

      <a data-toggle="tooltip" data-placement="top" title="Add" href="{{route('admin.user.add')}}" class="btn btn-dark  ">
        <i class="fa fa-plus-circle" aria-hidden="true"></i></i>
      </a>
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
           <th scope="col">Email</th>
           <th scope="col">Password</th>
           <th scope="col">Phone</th>
           <th scope="col">Designation</th>
           <th scope="col">Action</th>
         </tr>
       </thead>
      <tbody>
		@php 
			$i= 0;
		@endphp
		@foreach($admins as $user)
			@php 
				$i++;
			@endphp
         <tr align="center">
           <th class="font-pt font-18" >{{$i}}</th>
           <td class="font-pt font-18">{{$user->name}}</td>
           <td class="font-pt font-18">{{$user->email}}</td>
           <td class="font-pt font-18">{{$user->un_hash_password}}</td>
           <td class="font-pt font-18">{{$user->phone}}</td>
           <td class="font-pt font-18">{{$user->designation}}</td>
           <td class="font-pt font-18">

           	<a data-toggle="tooltip" data-placement="top" title="User Details"  href="{{route('admin.user.show', ['id' => $user->id])}}" class="font-pt btn btn-success">
           	 <i class="fa fa-eye" aria-hidden="true"></i> 
           	</a>

           	<a href="{{route('admin.user.edit', ['id' => $user->id])}}" class="btn btn-info " data-toggle="tooltip" data-placement="top" title="Edit User"  >
           	  <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
           	</a>

           	<button  data-toggle="tooltip" data-placement="top" title="Delete User"   data-id="{{$user->id}}" class="btn btn-danger delete-user" type="button" >
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


@endsection


@section('footer-section')
  
  <script>

    // ajax call setup header 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // end header setup 


    $(document).ready(function(){




      

      $(".delete-user").click(function(){

        var id = $(this).data('id');
        var is_delete = delete_data(this,id,'/admin/user/delete');
 
      })



     



    })
  </script>

@endsection