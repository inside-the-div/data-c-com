@extends('admin.layouts.master')

@section('title')
<title>Send Email</title>
@endsection

@section('custom-css')
<style>

  .user-email-list{
    cursor: pointer;
  }
  .active-list{
    background:#d6d6d6;
  }
</style>
@endsection


@section('content')
<!-- page title area  -->
<div class="row">
  <div class="col-12 text-right mb2">
      <a data-toggle="tooltip" data-placement="top" title="Back" href="{{ url()->previous() }}" class="btn btn-primary"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>

  </div>
</div>


<div class="row">
  <div class="col-12 col-lg-4">
      <div class="card p-3">
        <h3 class="text-center font-pt font-20">All Users</h3>
        <hr class="mb-2">
        <ul>
          @foreach($users as $user )
          <li class="border-bottom p-2 font-pt font-17 user-email-list" data-email="{{$user->email}}">{{$user->email}}</li>
          @endforeach
          
      </div>
  </div>

  <div class="col-12 col-lg-6">
    <div class="card p-3">

      <h3 class="text-center font-pt font-20">Send Box</h3>
      <hr class="mb-2">


      <label for="email">Email*</label>
      <input type="email" name="email" class="form-control mb-2" id="send_email"> 

      <label for="subject">Subject*</label>
      <input type="email" name="subject" class="form-control mb-2" id="subject">

      <label for="message">Message*</label>
      <textarea name="message" id="message" cols="30" rows="15" class="form-control mb-2"></textarea>

       <button id="send_email_btn" data-toggle="tooltip" data-placement="top" title="Send" type="submit" class="btn btn-success">
        <div id="email_send_loader" class="spinner-border spinner-border-sm" role="status">
          <span class="sr-only">Loading...</span>
        </div>
        <i class="fa fa-paper-plane" aria-hidden="true"></i>
      </button>

    </div>
  </div>
</div>






@endsection

@section('footer-section')
  <script>
        


      $(".user-email-list").click(function(){
        
        var email = $(this).data('email');
        $("#send_email").val(email);


        $(".user-email-list").removeClass('active-list');
        $(this).addClass('active-list');
      })
        
      









        $("#email_send_loader").hide();


        $("#send_email_btn").click(function(){
          var message = $("#message").val();
          var email   = $("#send_email").val();
          var subject = $("#subject").val();

          if(message == "" || email == "" || subject == ""){
            $("#message").focus();
            Toast.fire({
              icon: 'error',
              title: "Please Fill All The Fields"
            });

            return false;
          }

          var info = {
            
            email:email,
            subject:subject,
            message:message
          };

          console.log(info);
          $("#email_send_loader").show();

          $.ajax({
             type:'POST',
             url:'/admin/email/send',
             data:info,
             success:function(data){
              
              Toast.fire({
                icon: 'success',
                title: ""+data.success+""
              })

               $("#email_send_loader").hide();

               $("#message").val("");
               $("#send_email").val("");
               $("#subject").val("");
            } // end success
          
          });


          
        })
      
           
      </script>
@endsection