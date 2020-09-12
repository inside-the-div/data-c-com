@extends('admin.layouts.master')



@section('title')
<title>Add New Products</title>
@endsection


@section('content')
<!-- page title area  -->



<div class="row mb-2">
  <div class="col-12">
  	<div class="text-right">
  		<a data-toggle="tooltip" data-placement="top" title="Back" href="{{ url()->previous() }}" class="btn btn-primary"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>
  		<button class="btn btn-dark" type="button" id="category-modal-btn" data-toggle="tooltip" data-placement="top" title="Add Category"><i class="fa fa-plus-circle fa-fw" aria-hidden="true"></i></button>

  		
  	</div>
  </div>
</div>




<form action="{{route('admin.product.store')}}" method="POST" enctype="multipart/form-data">
	@csrf
	<div class="col-xl-8 offset-xl-2 col-12">
		<div class="row">
			<div class="col-12 col-lg-8">
				<div class="card p-3 rounded-0">

					<div class="row">
						<div class="col-12">
							<label for="" class="font-pt font-16"><b>Name*</b></label>
							<input required type="text" name="name" class="form-control rounded-0 font-pt font-18 mb-2">
						</div>
					</div>

					<div class="row my-2">
						<div class="col-12 col-lg-6 mb-2">
							<label for="" class="font-pt font-16"><b>Price*</b></label>
							<input required step="any" type="number" name="price" class="form-control rounded-0 font-pt font-18">
						</div>

						<div class="col-12 col-lg-6 mb-2">
							<label for="" class="font-pt font-16"><b>Stock*</b></label>
							<input required type="number" name="stock" class="form-control rounded-0 font-pt font-18">
						</div>

						<div class="col-12 col-lg-6">
							<label for="discount" class="font-pt font-16"><b>Discount(%)*</b></label>
							<input required step="any" type="number" name="discount" class="form-control rounded-0 font-pt font-18">
						</div>

						<div class="col-12 col-lg-6">
							<label for="shipping_cost" class="font-pt font-16"><b>Shipping Cost*</b></label>
							<input required step="any" type="number" name="shipping_cost" class="form-control rounded-0 font-pt font-18">
						</div>

					</div>

					<label for="product_arrt" class="font-pt font-16"><b>Attributes*</b></label>
					<textarea required name="attr_p" id="product_arrt" cols="30" rows="4" class="form-control rounded-0 font-pt font-18 mb-2"></textarea>


					<label for="description" class="font-pt font-16 mt-2"><b>Description*</b></label>
					<textarea required name="description" id="description" cols="30" rows="4" class="form-control rounded-0 font-pt font-18 mb-2"></textarea>


					<div class="row">
						<div class="col-12 ">
							<div class="p-3" id="seo-area">
								<label for=""><b>Meta Tag</b></label>
								<textarea name="meta_tag" id="" cols="30" rows="3" class="form-control rounded-0 mb-2"></textarea>
								<label for=""><b>Meta Descripton</b></label>
								<textarea name="meta_description" id="" cols="30" rows="3" class="form-control rounded-0 mb-2"></textarea>
								<label for=""><b>Meta Keyword</b></label>
								<textarea name="metea_keyword" id="" cols="30" rows="3" class="form-control rounded-0"></textarea>





							</div>
						</div>
					</div>

					<input type="submit" value="Add" class="form-control my-2 btn_1">

				</div>
			</div>
			<div class="col-12 col-lg-4"> 
				<div class="card p-3 rounded-0">

					

					<label for="category" class="font-pt font-16"><b>Category*</b></label>
					<select required name="category[]" id="category" class="form-control rounded-0 font-pt font-18 mb-2" multiple>
						@foreach($categories as $category)
						<option class="font-pt font-18 py-2" value="{{$category->id}}">{{$category->name}}</option>
						@endforeach
					</select>
				
					<label for="" class="font-pt font-16"><b>Image*(Base)</b></label>
					
					<input required class="form-control input-file " type="file" name="base_image" id="base-image">
					<p id="image-validate-base" class=" text-danger  text-center"></p>
					

					<div class="card m-2 product-image-preview-area" id="base-image-show">
						<div class="preview" id="base-image-preview"  ></div>
					</div>

					

					

					<label for="available" class="font-pt font-16"><b>Availability</b></label>
					<select name="available" id="available" class="form-control rounded-0 font-pt font-18 mb-2">
						<option class="py-2" value="1">Available</option>
						<option class="py-2" value="0">Not Available</option>
					</select>

					<label for="active" class="font-pt font-16"><b>Active</b></label>
					<select name="active" id="active" class="form-control rounded-0 font-pt font-18 mb-2">
						<option class="py-2" value="0">Not Active</option>
						<option class="py-2" value="1">Active</option>
					</select>


			    	<div class="custom-control custom-checkbox mr-sm-2">
			            <input type="checkbox" name="seo" class="custom-control-input " id="seo-checkbox" value="1">
			            <label class="custom-control-label font-18 font-pt text-info" for="seo-checkbox">Show More Option</label>
			        </div>

				</div>
			</div>
		</div>
	</div>
	
</form>






{{-- category add modal  --}}


<!-- Modal add -->
<div class="modal fade bd-example-modal-lg" id="category-add-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-20 font-pt" id="exampleModalLabel">Add new category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
		<form action="{{route('admin.category.store')}}" method="POST" enctype="multipart/form-data">
			@csrf
			<div class="modal-body">
				<label for=""><b>Name*</b></label>
				<input type="text" class="form-control rounded-0 mb-2 font-pt font-18" name="name">

        <div class="row">
          <div class="col-12 col-lg-6">
            <label for="parent_cat">Parent Category</label>
            <select name="parent_cat" id="parent_cat" class="form-control">
              <option value="0">Parent</option>
              @foreach($categories as $caregoty)
                <option value="{{$caregoty->id}}">{{$caregoty->name}}</option>
              @endforeach
            </select>
          </div>
          <div class="col-12 col-lg-6">
            <label for=""><b>Image*</b></label>
            <input type="file" name="image" class="form-control rounded-0" style="height: 47px;">
          </div>
        </div>

				<label for=""><b>Description*</b></label>
				<textarea name="description" id="" cols="30" rows="5" class="form-control rounded-0 mb-2 font-pt font-18"></textarea>

				<label for=""><b>Tag*</b></label>
				<textarea name="tag" id="" cols="30" rows="5" class="form-control rounded-0 mb-2 font-pt font-18"></textarea>
			</div>

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
			$('#base-image-show').hide();
			var preview_id;
			$(document).ready(function(){




				$("#base-image").change(function(){

					// image-validate-base

				    var img_size=(this.files[0].size);
		            
		            if(img_size > 2000000) {
		            	$(this).val('');
	            		$("#image-validate-base").html("Image size is too large(size > 2MB)! use < 2MB ");
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
					
				})


			}) //end jquery


		</script>


		<script>


		  $(document).ready(function() {


		    $('#product_arrt').summernote({

		      placeholder: 'Products Attributes',
		      tabsize: 4,
		      height: 200,
		      toolbar: [
		        
		        ['font', ['bold', 'underline', 'clear']],
		       
		        ['para', ['ul', 'ol', 'paragraph']],
		        
		        ['fontsize', ['fontsize']],
		       
		      ]
		    });

		    
		  });

		</script>


		
		<script>
			$(document).ready(function() {

				$("#category-modal-btn").click(function(){
					$("#category-add-modal").modal('show');
				});

				$("#brand-modal-btn").click(function(){
					$("#brand-add-model").modal('show');
				});

			 });
		</script>


		<script>
			$(document).ready(function() {

				$("#seo-area").hide();

				$("#seo-checkbox").click(function(){
					if($(this).prop('checked') == true){
						$("#seo-area").show();
					}else{
						$("#seo-area").hide();
					}
				});

				

			 });


		</script>





@endsection