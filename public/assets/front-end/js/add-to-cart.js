// start jquery
$(document).ready(function(){

// auto create cart 
  createCart();
// end auto create cart




$(".add-to-cart-single-btn").click(function(e){


  var quantity = $("#quantity_1").val();

  var product = {};
  var id = $(this).data('id');
  var name = $(this).data('name');
  var price = $(this).data('price');
  var code = $(this).data('code');
  var slug = $(this).data('slug');
  var image = $(this).data('image');


  product['id'] = id;
  product['name'] = name;
  product['price'] = price;
  product['quantity'] = quantity;
  product['code'] = code;
  product['slug'] = slug;
  product['image'] = image;

  // send ajax request 

  $.ajax({

     type:'POST',
     url:'/add-to-cart',
     data:product,
     success:function(data){

      if(data.new_product == "1"){
        mekeCart(data.products);
      $("#notification-product-added").fadeIn();

      setTimeout(function(){
        $("#notification-product-added").fadeOut();
      }, 2000);

      }else{

      $("#notification-already-added").fadeIn();

      setTimeout(function(){
        $("#notification-already-added").fadeOut();
      }, 2000);

      } //edn else

    } //end success
   
  }); // end ajax request

  e.preventDefault();

}) // add to cart click end





  //start delete full cart
  $('#delete-full-cart').click(function(e){

  

    $.ajax({
       type:'POST',
       url:'/delete-full-cart',
       data:{delete:1},
       success:function(data){
          $("#total_cart_products").html(0);

          var ul = $("#cart_items_list");
          var total_price_of_cart = $("#total_price_of_cart");

          ul.html("");
          total_price_of_cart.html("৳ 0.0");
       }

    }) // end ajax call

     e.preventDefault();
  }) // end delete full cart



}) // end jquery





$(document).on('click','.delete_this_product_from_cart',function(e){

  var code = $(this).attr('data-code');

  deleteProductFormCart(code);

  e.preventDefault();

})  



// deleteProductFormCart

function deleteProductFormCart(code){

  $.ajax({
     type:'POST',
     url:'/delete-cart-product',
     data:{code:code},
     success:function(data){

      mekeCart(data.products);
     
     }
  }) // end ajax call

}





function createCart(){

  $.ajax({
     type:'POST',
     url:'/create-cart',
     data:{create:1},
     success:function(data){ 
        mekeCart(data.products);
     }

  }) // end ajax call
}


function mekeCart(products){

  var getUrl = window.location+"";
  var url_array = getUrl.split("/");
  var main_rul = url_array[0]+"//"+url_array[2]+"/";

  var total_price = 0;

  var total_price_of_cart_tag = $("#total_price_of_cart");

  var ul = $("#cart_items_list");
  ul.html('');

  if(products != 'null'){

    var total_products_count = 0;
    $.each(products, function(key,val){
        total_products_count++;
        var product = products[key];
        // console.log(product);
        var code = key;
        var id = product.id;
        var slug = product.slug;
        var name = product.name;
        var price = product.price;
        var quantity = product.quantity;
        var image = product.image;

        total_price += (price * quantity);

        ul.append(`

          <li id="product-`+code+`">
            <a href="`+main_rul+slug+`">
              <figure><img src="`+main_rul+`assets/img/products/`+image+`" data-src="`+main_rul+`assets/img/products/`+image+`" alt="" width="50" height="50" class="lazy"></figure>

              <strong>
              <span>`+name+`</span>
              ৳ `+price+` x `+quantity+`
              </strong>
            </a>
            <a href="#" class="action delete_this_product_from_cart" data-code="`+code+`" data-price="`+price+`" data-quantity="`+quantity+`"><i class="ti-trash"></i></a>
          </li>

        `);  
    });

     $("#total_cart_products").html(total_products_count);

    total_price_of_cart_tag.html("৳ "+total_price);

  }else{

    console.log("empty");
   
  }
}


