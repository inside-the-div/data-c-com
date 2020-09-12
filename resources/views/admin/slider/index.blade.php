@extends('admin.layouts.master')



@section('title')
  <title>All slider</title>
@endsection


@section('content')

<div class="row">
  <div class="col-12 text-right">
      <a data-toggle="tooltip" data-placement="top" title="Back" href="{{ url()->previous() }}" class="btn btn-primary"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>
      <button class="btn btn-dark
        " type="button" data-toggle="modal" data-target="#exampleModal">
        <i class="fa fa-plus-circle" aria-hidden="true"></i></i>
      </button>
  </div>
</div>



 <div class="row mt-2">
   <div class="col-12">
     <div class="card p-3 rounded-0 table-responsive">

     <table class="table table-striped table-dark display " id="dataTable">
       <thead>
         <tr>
           <th scope="col">No</th>
           <th scope="col">Image</th>
           <th scope="col">Date</th>
           <th scope="col">Active</th>
           <th scope="col">Action</th>
           
         </tr>
       </thead>
      <tbody>
		@php 
			$i= 0;
		@endphp
		@foreach($sliders as $slider)
			@php 
				$i++;
			@endphp
         <tr>
           <th class="font-pt font-18" >{{$i}}</th>
           <td class="font-pt font-18">
             <img src="{{URL::asset('/assets/img/slider')}}/{{$slider->image}}" alt="" width="60px;">
            
           </td>
           <td class="font-pt font-18">{{$slider->created_at->format('Y-m-d')}}</td>


          <td>

            <div class="toggleCheck chk3 ">
              <input @if($slider->active == 1) checked  @endif type="checkbox" id="active-{{$slider->id}}" name="active-{{$slider->id}}" class="sider-active"  data-id="{{$slider->id}}">
              <label for="active-{{$slider->id}}">
                <div class="toggleCheck_switch" data-checked="Yes" data-unchecked="No"></div>
              </label>
            </div>

          </td>

           <td class="font-pt font-18">
           		<a data-toggle="tooltip" data-placement="top" title="Show Slider"  href="{{route('admin.slider.show', ['id' => $slider->id])}}" class="cusron font-18 font-pt btn btn-success">
               <i class="fa fa-eye" aria-hidden="true"></i> 
              </a>

              <button  data-toggle="tooltip" data-placement="top" title="Delete Slider"   data-id="{{$slider->id}}" class="btn btn-danger delete-slider" type="button" >
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
                <i class="fa fa-trash" aria-hidden="true"></i>
              </button>
            
           </td>
         </tr>
       @endforeach
       </tbody> 

     </table>
     </div>
   </div>
 </div>
 <!-- website info area end -->




 <!-- Modal add -->
 <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title font-20 font-pt" id="exampleModalLabel">Add New Slider</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
      <form action="{{route('admin.slider.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
        <label for="image"><b>Image*</b></label>
        <input  required type="file" class="form-control" name="image" style="height: 50px;">

        {{-- <label for="image"><b>Link*</b></label>
        <input  required type="file" class="form-control" name="image" style="height: 50px;"> --}}

        <div class="modal-footer">
          <button type="button" class="btn-admin btn-delete" data-dismiss="modal">Close</button>
          <input type="submit" class="btn-admin btn-edit" value="Add" name="submit">
        </div>

      </form>

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




      

      $(".delete-slider").click(function(){
        var id = $(this).data('id');
        var is_delete = delete_data(this,id,'/admin/slider/delete');
      })


      $(".sider-active").click(function(e){
        var id = $(this).data('id');

        $.ajax({

           type:'POST',
           url:'/admin/slider/active',
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