@extends('admin.layouts.master')



@section('title')
<title>All Reviews</title>
@endsection


@section('content')

	<div class="row">
		<div class="col-12">

			<div class="tab-content" id="myTabContent">
			  <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
				 <div class="row mt-2">
				   <div class="col-12">
				     <div class="card p-3 rounded-0 table-responsive">

				     <table class="table table-striped table-dark display custom-data-table " id="">
				       <thead>
				         <tr>
				           <th scope="col">No</th>
				           <th scope="col">Customer</th>
				           <th scope="col">Product</th>
				           <th scope="col">Date</th>
				           <th scope="col">Approve</th>
				           <th scope="col">Action</th>
				           
				         </tr>
				       </thead>
				      <tbody>
						@php 
							$i= 0;
						@endphp
						@foreach($reviews as $review)
							@php 
								$i++;
							@endphp
				         <tr>
				           <th class="font-pt font-16" >{{$i}}</th>
				           <td class="font-pt font-16">{{$review->user->name}}  </td>
				           <td class="font-pt font-16">product</td>
				           <td class="font-pt font-16">date</td>


				          <td>

				            <div class="toggleCheck chk3 ">
				              <input @if($review->active == 1) checked  @endif type="checkbox" id="active-{{$review->id}}" name="active-{{$review->id}}" class="review-active review-no-{{$review->id}}"  data-id="{{$review->id}}">
				              <label for="active-{{$review->id}}">
				                <div class="toggleCheck_switch" data-checked="Yes" data-unchecked="No"></div>
				              </label>
				            </div>



				          </td>

				           <td class="font-pt ">
				           		<a data-toggle="tooltip" data-placement="top" title="Show review"  href="{{route('admin.review.show', ['id' => $review->id])}}" class="cusron  font-pt btn btn-success">
				               <i class="fa fa-eye" aria-hidden="true"></i> 
				              </a>

				              <button  data-toggle="tooltip" data-placement="top" title="Delete review"   data-id="{{$review->id}}" class="btn btn-danger delete-review" type="button" >
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
			  </div>

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




      

      $(".delete-review").click(function(){
        var id = $(this).data('id');
        var is_delete = delete_data(this,id,'/admin/review/delete');
      })


      $(".review-active").click(function(e){


        var id = $(this).data('id');


    
        

        $.ajax({

           type:'POST',
           url:'/admin/review/active',
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