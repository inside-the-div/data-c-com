@extends('admin.layouts.master')

@section('title')
<title>All Emails</title>
@endsection


@section('content')
<!-- page title area  -->
<div class="row">
  <div class="col-12 text-right py-3">
      <a data-toggle="tooltip" data-placement="top" title="Back" href="{{ url()->previous() }}" class="btn btn-primary"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>

     <form class="d-inline" action="{{route('admin.email.download')}}" method="POST">
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
           <th scope="col">Email</th>
           <th scope="col">Phone</th>
           <th scope="col">Subject</th>
           <th scope="col">Date</th>
           <th scope="col">Action</th>
         </tr>
       </thead>
      <tbody>
		@php 
			$i= 0;
		@endphp
		@foreach($emails as $e)
			@php 
				$i++;
			@endphp
         <tr align="center">
           <th class="font-pt font-18" >{{$i}}</th>
           <td class="font-pt font-18">{{$e->name}}</td>
           <td class="font-pt font-18">{{$e->email}}</td>
          
           <td class="font-pt font-18">{{$e->phone}}</td>
           <td class="font-pt font-18">{{$e->subject}}</td>
           <td class="font-pt font-18">{{$e->created_at->format('d-m-Y')}}</td>
           

  
           <td class="font-pt font-18">

            <button data-toggle="tooltip" data-placement="top" title="Replay" class="btn btn-success replay-btn"  data-subject="{{$e->subject}}" data-email="{{$e->email}}" data-name="{{$e->name}}">
              <i class="fa fa-reply" aria-hidden="true"></i>
            </button>
            <a data-toggle="tooltip" data-placement="top" title="Full Info." class="btn btn-info" href="{{route('admin.email.show', ['id' => $e->id])}}"><i class="fa fa-eye" aria-hidden="true"></i>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Delete" class="btn btn-danger" href=""><i class="fa fa-trash" aria-hidden="true"></i>
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



 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel"></h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body">
         <input type="hidden" name="email" id="send_email">

         <label for="message">Message*</label>
         <textarea name="message" id="message" cols="30" rows="3" class="form-control"></textarea>
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
         <button id="send_email_btn" data-toggle="tooltip" data-placement="top" title="Send" type="submit" class="btn btn-success">
          <div id="email_send_loader" class="spinner-border spinner-border-sm" role="status">
            <span class="sr-only">Loading...</span>
          </div>
          <i class="fa fa-paper-plane" aria-hidden="true"></i>
        </button>
       </div>
     </div>
   </div>
 </div>



@endsection

@section('footer-section')
  <script>
        
        $("#email_send_loader").hide();
        var email;    
        var name;     
        var subject;  
        
        $(".replay-btn").click(function(){

           email    = $(this).data('email');
           name     = $(this).data('name');
           subject  = $(this).data('subject');
          // set in form
          $("#send_email").val(email);
          $("#exampleModalLabel").html(name);

          // show form
          $("#exampleModal").modal('show');
        })



        $("#send_email_btn").click(function(){
          var message = $("#message").val();

          if(message == ""){
            $("#message").focus();

            Toast.fire({
              icon: 'error',
              title: "Message Field Empty"
            });

            return false;
          }

          var info = {
            name:name,
            email:email,
            subject:subject,
            message:message
          };

          console.log(info);
          $("#email_send_loader").show();

          $.ajax({
             type:'POST',
             url:'/admin/email/replay',
             data:info,
             success:function(data){
              
              Toast.fire({
                icon: 'success',
                title: ""+data.success+""
              })

               $("#message").val("");
               $("#email_send_loader").hide();
            } // end success
          
          });


          
        })
      
           
      </script>
@endsection