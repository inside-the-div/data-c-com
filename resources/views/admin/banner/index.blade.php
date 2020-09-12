@extends('admin.layouts.master')



@section('title')
<title>Banner Settings</title>
@endsection


@section('custom-css')
<style>
	.tag-area .single-tag{
	  display:inline-block;
	  background: rgba(0,0,0,0.1);
	  /*padding:1px 5px;*/
	  font-size:16px;
	  border-radius: 5px;
	  /*padding-bottom: 3px;*/
	  /*padding-right: 5px;*/
	  margin-right:5px;
	  margin-top: 5px;
	  padding: 1px 5px;
	  
	}
	.banner-image-preview-area .preview{
		min-height: 400px;
	}

</style>
@endsection


@section('content')


<div class="row mt-3">
	<div class="col-12 col-xl-10 offset-xl-1">
		

		<div class="card p-3 rounded-0">
			<!-- page title area  -->
			<div class="row mb-5">
			  <div class="col-12 text-center">
			      <h1 class="font-pt font-25">Website's Hero Area banner and auto-typed text</h1>
			  </div>
			</div>
			<form action="{{route('admin.banner.update')}}" method="POST" enctype="multipart/form-data">
				@csrf
				<div class="row">
					<div class="col-12 col-lg-12 col-xl-6">
						<label for="base-image"><b>Banner Image:</b></label>
						<input id="base-image" type="file" name="image" class="form-control rounded-0 mb-2">
						<div id="image-validate-base" class="text-danger"></div>

						<div class="card m-2 banner-image-preview-area" id="base-image-show">
							<div class="preview" id="base-image-preview" style="background:url({{Storage::url($banner->image)}});background-size:cover;" ></div>
						</div>
						
					</div>

					<div class="col-12 col-lg-12 col-xl-6">
						<label for="text"><b>Auto Typed Text:</b></label>
						<textarea name="text" id="text" cols="30" class="form-control rounded-0 mb-2 font-30 font-pt" rows="8">{{$banner->text}}</textarea>

						<div class="tag-area mt-2">
						
						</div>

						<input type="submit" value="submit" class="form-control my-2 btn_1">
					</div>
				</div>
				
				

				

				
			</form>
		</div>
	</div>
</div>

@endsection

@section('footer-section')

	<script>
		$(document).ready(function(){
			   makeTag();
			   $("#text").keyup(function(){
			     
				   	makeTag();
			   })





	   			$("#base-image").change(function(){
	   			    var img_size=(this.files[0].size);
	   	            if(img_size > 2000000) {
	   	            	$(this).val('');
	               		$("#image-validate-base").html("Image size is too large(size > 2MB)! use < 2MB ");
	   	            }else{
	   	            	
	   					//file type validation 
	   					var fileExtension = ['jpeg', 'jpg', 'png', 'gif'];
	   					if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
	   						$("#image-validate-base").html("Only formats are allowed :"+fileExtension.join(', '));
	   						$(this).val('');
	   					}else{
	   						$("#image-validate-base").html("");
	   						if (this.files && this.files[0]) {
	   							var reader = new FileReader();
	   							reader.onload = function(e,input) {

	   								$('#base-image-show').show();
	   								$('#base-image-preview').css('background-image', 'url('+e.target.result +')');
	   								$('#base-image-preview').hide();
	   								$('#base-image-preview').fadeIn(650);
	   							}
	   							reader.readAsDataURL(this.files[0],this);
	   						}
	   					}
	   	            }
	   			}) // end base image validation and show



		})

		function makeTag(){
			$(".tag-area").html('');

			 var all_tag =  $("#text").val();
			
			 var tags = all_tag.split(",");
				for(var i = 0; i< tags.length; i++){
					 var tag = tags[i].trim();
					 if(tag != ''){
					 	$(".tag-area").append('<span  class="single-tag padding">'+tag+'</span>');
					 }
				}
		}
	</script>
	  

@endsection