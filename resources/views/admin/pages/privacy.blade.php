@extends('admin.layouts.master')


@section('title')
<title>Update Privacy Policy Page</title>
@endsection





@section('content')
	<div class="row ">
		<div class="col-12 col-xl-10 offset-xl-1 ">

		    <div class="card rounded-0 p-3">
		    	<h3 class="font-20 font-pt my-3 text-center font-weight-bold">Update Privacy Policy Pages</h3>
		    	<hr>
		    	<form action="{{route('admin.privacy.update')}}" method="POST">
		    		@csrf
		    		<div class="row">
		    			<div class="col-12 col-lg-6">
		    				<label for="privacy_tag" class="my-2">Tag* (For SEO)</label>
		    				<textarea class="form-control rounded-0"  id="tag" name="tag" rows="4">{{$privacy->tag}}</textarea>
		    			</div>
		    			<div class="col-12 col-lg-6">
		    				<label for="privacy_desctiption" class="my-2">Description* (For SEO)</label>
		    				<textarea class="form-control rounded-0"  id="privacy_desctiption" name="description" rows="4">{{$privacy->description}}</textarea>
		    			</div>
		    		</div>

		    		<div class="row my-2">
		    			<div class="col-12">
		    				<label for="privacy" class="mt-2">Text*</label>
		    				<textarea class="form-control rounded-0 html-editor"  id="privacy" name="text" rows="4">{{$privacy->privacy}}</textarea>
		    			</div>
		    		</div>
		    		<input type="submit" class="btn_1 mt-2 form-control" value="Update">
		    	</form>
		    </div>
	    
	  	</div>
	</div>

@endsection
@section('footer-section')
<script>


  $(document).ready(function() {
  	$('.html-editor').summernote({

  	 
  	  tabsize: 4,
  	  height: 400,
  	  toolbar: [
  	    
  	    ['style', ['style']],
  	    ['font', ['bold', 'underline', 'clear']],
  	    ['color', ['color']],
  	    ['para', ['ul', 'ol', 'paragraph']],
  	    ['font', ['strikethrough', 'superscript', 'subscript']],
  	    ['fontsize', ['fontsize']]
  	    
  	     
  	   
  	  ]
  	});
  });

</script>
@endsection
