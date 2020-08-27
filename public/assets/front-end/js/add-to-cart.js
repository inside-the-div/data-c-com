// start jquery
$(document).ready(function(){

// auto create cart 
  createCart();
// end auto create cart





//=============== start add to cart btn ====================
  $('.add-to-cart-btn').click(function(e){

    var add_to_cart_btn = $(this);

// check already added to not 
// shwo notification
    var is_added = $(this).data('added');
    if(is_added == "1"){
        $("#notification-already-added").fadeIn();
        setTimeout(function(){
          $("#notification-already-added").fadeOut();
        }, 2000);
      return false;
    }else{
      
        $("#notification-product-added").fadeIn();

        setTimeout(function(){
          $("#notification-product-added").fadeOut();
        }, 2000);
    }
// end
  
    $(this).addClass('already-added-btn'); // add new class
      

// add class and tooltip
    $added = `<i class="ti-check-box"><span>Already Added</span></i>`;
    var this_a = $(this).children('a');
    this_a.html($added);
    this_a.attr('data-original-title',"Already Added");
    this_a.addClass("bg-added");
// end
    
// set total product in cart badge
    var total_products = Number($("#total_cart_products").html());
    total_products++;
    $("#total_cart_products").html(total_products);
// end

// create new product
    var product = {};
    var id = $(this).data('id');
    var name = $(this).data('name');
    var price = $(this).data('price');
    var quantity = $(this).data('quantity');
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
// end 

    // send ajax request 
    $.ajax({
       type:'POST',
       url:'/add-to-cart',
       data:product,
       success:function(data){
        add_to_cart_btn.data('added',"1"); // add already add data
        mekeCart(data.products);
      } // end success
    
    });
// end ajax request

    e.preventDefault(); // stop reload

  }) // end add to cart btn


  //start delete full cart
  $('#delete-full-cart').click(function(e){

    // remove all alrady added class , data, background;

    var all_added_prosucts_li = $(".add-to-cart-btn");
    var all_a = $('.add-to-cart-a');
    
    for(var i=0;i<all_added_prosucts_li.length;i++){
        // console.log($(all_added_prosucts_li[i]).data('added'));
        $(all_added_prosucts_li[i]).data('added',"0");
    }    

    for(var i=0;i<all_a.length;i++){
        
        var this_a = $(all_a[i]);
        
        $added = `<i class="ti-shopping-cart"><span>Add to cart</span></i>`;
        this_a.html($added);
        this_a.attr('data-original-title',"Add to cart");

        this_a.removeClass("bg-added");
    }


    var ul = $("#cart_items_list");
    var total_price_of_cart = $("#total_price_of_cart");

    ul.html("");
    total_price_of_cart.html("");

    $.ajax({
       type:'POST',
       url:'/delete-full-cart',
       data:{delete:1},
       success:function(data){
          $("#total_cart_products").html(0);
           console.log(data);
          
       }

    }) // end ajax call

     e.preventDefault();
  }) // end delete full cart



}) // end jquery







$(document).on('click','.delete_this_product_from_cart',function(e){

  var code = $(this).attr('data-code');
  var price = Number($(this).attr('data-price'));
  var quantity = Number($(this).attr('data-quantity'));

  var total_price = (price * quantity);

  var cart_total = $("#total_price_of_cart").html().split(" ");
  cart_total = Number(cart_total[1]);

  var price_after_delete_this_product = (cart_total - total_price);
  $("#total_price_of_cart").html("৳ "+price_after_delete_this_product);
  var li = $("#product-"+code).hide();


  var total_cart_products = Number($("#total_cart_products").html());
  $("#total_cart_products").html((total_cart_products - 1));


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
  
     }
  }) // end ajax call

}





function createCart(){

  $.ajax({
     type:'POST',
     url:'/create-cart',
     data:{create:1},
     success:function(data){ 
        $("#total_cart_products").html(data.total_product);
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

    var no = 0;
    $.each(products, function(key,val){
        no++;
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



    total_price_of_cart_tag.html("৳ "+total_price);


  }else{

    console.log("empty");
   
  }
}


