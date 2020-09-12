@extends('admin.layouts.master')



@section('title')
<title>Add new Faq</title>
@endsection


@section('content')
<!-- page title area  -->
{{-- <div class="row">

  <div class="col-12 ">
  	<div class="text-right">
  		<button class="btn_1 font-18 font-pt mx-2" type="button" data-toggle="modal" data-target="#faq-add-modal">Add New FAQ <i class="fa fa-plus-circle fa-fw" aria-hidden="true"></i></button>
  	</div>
  </div>
</div> --}}

<div class="row">
  <div class="col-12 text-right">
      <a data-toggle="tooltip" data-placement="top" title="Back" href="{{ url()->previous() }}" class="btn btn-primary"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>
      <button class="btn btn-dark
        " type="button" data-toggle="modal" data-target="#faq-add-modal">
        <i class="fa fa-plus-circle" aria-hidden="true"></i></i>
      </button>
  </div>
</div>




<div class="row mt-2">
 <div class="col-12">
   <div class="card p-3 rounded-0 table-responsive">

     <table class="table table-striped table-dark display " id="dataTable">
       <thead>
         <tr align="center">
           <th scope="col">No</th>
           <th scope="col">Image</th>
           <th scope="col">Date</th>
           <th scope="col">Added By</th>
           <th scope="col">Action</th>
         </tr>
       </thead>
       <tbody>
        @php 
        $i= 0;
        @endphp
        @foreach($faqs as $faq)
        @php 
        $i++;
        @endphp
        <tr align="center">
         <th class="font-pt font-18" >{{$i}}</th>
         <td class="font-pt font-18">
           {{$faq->question}}
         </td>
         <td class="font-pt font-18">{{$faq->created_at->format('Y-m-d')}}</td>

         <td>
           {{$faq->user->name}}
         </td>

         <td class="font-pt font-18">
           <a data-toggle="tooltip" data-placement="top" title="Show faq"  href="{{route('admin.faq.show', ['id' => $faq->id])}}" class="btn btn-info">
             <i class="fa fa-eye" aria-hidden="true"></i> 
           </a>
           <button data-question="{{$faq->question}}" data-id="{{$faq->id}}" data-ans="{{$faq->ans}}"  class="btn btn-primary" type="button" data-toggle="modal" data-target="#faq-edit-modal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
           <button  data-toggle="tooltip" data-placement="top" title="Delete faq"   data-id="{{$faq->id}}" class="btn btn-danger delete-faq" type="button" >
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

<div class="modal fade bd-example-modal-lg" id="faq-edit-modal" tabindex="-1" role="dialog" aria-labelledby="faq-edit-modal" aria-hidden="true">
 <div class="modal-dialog modal-lg" role="document">
   <div class="modal-content">
     <div class="modal-header">
       <h5 class="modal-title font-20 font-pt" id="faq-edit-modal">Edit FAQ</h5>
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
       </button>
     </div>
     <form action="{{route('admin.faq.update')}}" method="POST"  class="modal-body">
      @csrf
      <input type="hidden" name="id" id="edit-faq-id">
      <label for="edit-faq-question"><b>Question*</b></label>
      <input id="edit-faq-question"  required type="text" class="form-control" name="question" >

      <label for="edit-faq-ans"><b>Answer*</b></label>
      <textarea name="ans" id="edit-faq-ans" cols="30" rows="5" class="form-control"></textarea>

      <div class="modal-footer">
        <button type="button" class="btn-admin btn-delete" data-dismiss="modal">Close</button>
        <input type="submit" class="btn-admin btn-edit" value="Update" name="submit">
      </div>

    </form>

  </div>
</div>
</div>


<!-- Modal add -->
<div class="modal fade bd-example-modal-lg" id="faq-add-modal" tabindex="-1" role="dialog" aria-labelledby="faq-add-modal" aria-hidden="true">
 <div class="modal-dialog modal-lg" role="document">
   <div class="modal-content">
     <div class="modal-header">
       <h5 class="modal-title font-20 font-pt" id="faq-add-modal">Add New FAQ</h5>
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
       </button>
     </div>
     <form action="{{route('admin.faq.store')}}" method="POST" >
      @csrf
      <div class="modal-body">


        <label for="question"><b>Question*</b></label>
        <input id="question"  required type="text" class="form-control" name="question" >

        <label for="ans"><b>Answer*</b></label>
        <textarea name="ans" id="ans" cols="30" rows="5" class="form-control"></textarea>


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

    $(document).ready(function(){

      $(".faq-edit-btn").click(function(){

        var faq_id= $(this).data('id');
        var faq_question= $(this).data('question');
        var faq_ans= $(this).data('ans');

        $("#edit-faq-question").val(faq_question);
        $("#edit-faq-ans").val(faq_ans);
        $("#edit-faq-id").val(faq_id);

      })


      $(".delete-faq").click(function(){
        var id = $(this).data('id');
        var is_delete = delete_data(this,id,'/admin/faq/delete');
      })


    })
  </script>

  @endsection