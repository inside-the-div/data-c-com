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
 

  <div class="col-12 col-lg-6 offset-lg-3">
    <div class="card p-3">

      <ul>
        <li><b>Name:</b> {{$email->name}}</li>
        <li><b>Email:</b> {{$email->email}}</li>
        <li><b>Subject:</b> {{$email->subject}}</li>
        <li><b>Message:</b> {{$email->message}}</li>
        <li><b>Date:</b> {{$email->created_at->format('d-m-Y')}}</li>
      </ul>

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