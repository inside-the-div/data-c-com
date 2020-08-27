@extends('admin.layouts.master')



@section('title')
<title>{{$product->name}}</title>
@endsection


@section('content')
<!-- page title area  -->
<div class="row">
	
</div>

<form action="{{route('admin.product.update')}}" method="POST" enctype="multipart/form-data">
	@csrf
	<div class="col-xl-8 offset-xl-2">
		<div class="row">
			<div class="col-12 col-lg-8">
				<div class="card p-3 rounded-0">

					<input type="hidden" name="product_id" value="{{$product->id}}">
					<label for="" class="font-pt font-18"><b>Name*</b></label>
					<input type="text" name="name" class="form-control rounded-0 font-pt font-18 mb-2" value="{{$product->name}}">


					
					<label for="" class="font-pt font-18"><b>Category*</b></label>
					<select name="category[]" id="category" class="form-control rounded-0 font-pt font-18 mb-2" multiple>
						
						@foreach($categories as $category)
						@if(in_array($category->name,$cat_array))
						<option selected class="font-pt font-18 py-2" value="{{$category->id}}">{{$category->name}}</option>
						@else
						<option class="font-pt font-18 py-2" value="{{$category->id}}">{{$category->name}}</option>
						@endif
						
						@endforeach
					</select>


					<label for="" class="font-pt font-18"><b>Price*</b></label>
					<input step="any" value="{{$product->price}}" type="number" name="price" class="form-control rounded-0 font-pt font-18 mb-2">

					<label for="" class="font-pt font-18"><b>Stock*</b></label>
					<input value="{{$product->stock}}"  type="number" name="stock" class="form-control rounded-0 font-pt font-18 mb-2">

					<label for="attributes" class="font-pt font-18"><b>Attributes*</b></label>
					<textarea    name="attr_p" id="product_arrt" cols="30" rows="4" class="form-control rounded-0 font-pt font-18 mb-2">{{$product->attributes}}</textarea>


					<label for="description" class="font-pt font-18"><b>Description*</b></label>
					<textarea   name="description" id="description" cols="30" rows="4" class="form-control rounded-0 font-pt font-18 mb-2">{{$product->description}}</textarea>

					<input type="submit" value="submit" class="form-control my-2 btn_1">

				</div>
			</div>
			<div class="col-12 col-lg-4"> 
				<div class="card p-3 rounded-0">
					<label for="" class="font-pt font-18"><b>Image*(Base)</b></label>
					
					<input class="form-control input-file" type="file" name="base_image" id="base-image">
					<p id="image-validate-base" class=" text-danger  text-center"></p>
					

					<div class="card m-2 product-image-preview-area" id="base-image-show">
						<div class="preview" id="base-image-preview" style="background:url({{URL::asset('/assets/img/products')}}/{{$product->image}});background-size:cover;" ></div>
					</div>


					<div class="old-image">
						@php $i = 0; @endphp            
						@foreach ($product->images as $p_img )
						@php $i++; @endphp
						<div class="product-new-image mt-2">
							<span data-id="{{$p_img->id}}" class="delete-this-image">X</span>
							<label class="font-pt font-18"  for=""><b>Slider - {{$i}}</b></label>

							<input data-total="{{$i}}" class="form-control new-image input-file" type="file" name="slider_{{$i}}">
							<p id="image-validate-{{$i}}" class=" text-danger  text-center"></p>
							<div class="card m-2 product-image-preview-area" >
								<div id="preview-{{$i}}" class="preview"  style="background:url({{URL::asset('/assets/img/products')}}/{{$p_img->image}});background-size:cover;"></div>
							</div>

							<input type="hidden" name="old_img_name_array[]" value="{{$p_img->image}}">
							<input type="hidden" name="old_img_id_array[]" value="{{$p_img->id}}">
						</div>
						@endforeach
					</div>

					<div id="old-slider-delete-array">
						
					</div>



					<input type="hidden" value="{{count($product->images)}}" name="total_old_img">

					<div id="more-image-area"></div>

					<button id="add-more-image-btn" class="btn_1 my-2 font-18 font-pt">Add More Image</button>



					<label for="available" class="font-pt font-18"><b>Availability</b></label>
					<select name="available" id="available" class="form-control rounded-0 font-pt font-18 mb-2">
						<option class="py-2" value="1">Available</option>
						<option class="py-2" value="0">Not Available</option>
					</select>


					<label for="active" class="font-pt font-18"><b>Active</b></label>
					<select name="active" id="active" class="form-control rounded-0 font-pt font-18 mb-2">
						<option class="py-2" value="0">Not Active</option>
						<option class="py-2" value="1">Active</option>
					</select>


				</div>
			</div>
		</div>
	</div>
	
</form>


@endsection


@section('footer-section')


<script>
	{{-- $('#base-image-show').hide(); --}}
	var preview_id;
	$(document).ready(function(){

				//add more image code start / create area  
				$("#add-more-image-btn").click(function(e){
					var total = $(".product-new-image").length;
					var new_img = `
					<div class="product-new-image mt-2">
					<span class="delete-this-image">X</span>
					<label class="font-pt font-18"  for=""><b>Slider - `+(total+1)+`</b></label>

					<input data-total="`+(total+1)+`" class="form-control new-image input-file" type="file" name="more_image[]">
					<p id="image-validate-`+(total+1)+`" class=" text-danger  text-center"></p>
					<div class="card m-2 product-image-preview-area" >
					<div id="preview-`+(total+1)+`" class="preview"  ></div>

					</div>
					</div>
					`;
					$("#more-image-area").append(new_img);
					e.preventDefault();
					return false;
				}) // end add more image code

				// start base image code
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
			}) // end jquery

			//slider image and new image code start 
			$(document).on('change', '.new-image', function(){  
				
			   preview_id = $(this).data('total'); // get preview id for show
			   
				var img_size=(this.files[0].size); // this image size

				if(img_size > 2000000) {
				  //size validation 
				  $(this).val('');
				  showValidationText(preview_id,"Image size is too large(size > 2MB)! use < 2MB ");

				}else{
					
					//file type validation 
					var fileExtension = ['jpeg', 'jpg', 'png', 'gif'];
					if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {

						showValidationText(preview_id,"Only formats are allowed :"+fileExtension.join(', '));
						$(this).val('');

					}else{
						showValidationText(preview_id,"");
						if (this.files && this.files[0]) {
							var reader = new FileReader();
							reader.onload = function(e,input) {
								$('#preview-'+preview_id).css('background-image', 'url('+e.target.result +')');
								$('#preview-'+preview_id).hide();
								$('#preview-'+preview_id).fadeIn(650);
							}
							reader.readAsDataURL(this.files[0],this);
						}
					} // end type validation

				} // end size validation

			}) // slider image and new image code end


			function showValidationText(divId,text){
				$("#image-validate-"+divId).html(text);
			}

			$(document).on('click','.delete-this-image',function(){

				var id = $(this).attr('data-id');
				// make a input filed array to delete the image form db 

				if(id != undefined){
					$("#old-slider-delete-array").append('<input type="hidden" name="slider_image_delete_id_array[]" value="'+id+'" />')

				}
				

				$(this).parent().remove();               
			})


		</script>

		<script>


			$(document).ready(function() {
				$('#product_arrt').summernote({

					placeholder: 'Products Attributes',
					tabsize: 4,
					height: 200,
					toolbar: [
					['style', ['style']],
					['font', ['bold', 'underline', 'clear']],
					['color', ['color']],
					['para', ['ul', 'ol', 'paragraph']],
					['font', ['strikethrough', 'superscript', 'subscript']],
					['fontsize', ['fontsize']],
					['view', ['fullscreen', 'codeview', 'help']]
					]
				});
			});

		</script>


		@endsection