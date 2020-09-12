@extends('admin.layouts.master')



@section('title')
<title>Edit New Order</title>
@endsection


@section('content')
<!-- page title area  -->
<div class="row">
  <div class="col-12 col-lg-8">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a class="font-pt" href="{{route("admin.dashboard")}}">Dashboard</a></li>
          <li class="breadcrumb-item active font-pt" aria-current="page">Categories</li>
        </ol>
      </nav>
  </div>
  <div class="col-12 col-lg-4">
  	<div class="text-right">
  		<button class="btn_1 font-18 font-pt mx-2" type="button" data-toggle="modal" data-target="#exampleModal">Add New category</button>
  	</div>
  </div>
</div>


<div class="row mt-2">
  <div class="col-12 col-lg-8 offset-lg-2">
    <div class="card p-3 rounded-0 table-responsive">
       
       <form action="{{route('admin.category.update')}}" method="post">
         @csrf
         
           <label for=""><b>Name*</b></label>
           <input type="text" class="form-control rounded-0 mb-2" name="name" value="{{$category->name}}">

           <label for=""><b>Description*</b></label>
           <textarea name="description" id="" cols="30" rows="5" class="form-control rounded-0 mb-2">{{$category->description}}</textarea>

           <label for=""><b>Tag*</b></label>
           <textarea name="tag" id="" cols="30" rows="5" class="form-control rounded-0 mb-2">{{$category->tag}}</textarea>
        
           <input type="hidden" value="{{$category->id}}" name="id">
         
           <input type="submit" class="btn_1 font-18  font-pt" value="Update" name="submit">
        

       </form>
     
    </div>
  </div>
</div>





@endsection