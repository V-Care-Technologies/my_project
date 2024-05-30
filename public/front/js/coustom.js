
jQuery.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
  }
});
jQuery('#frmRegistration').submit(function (e) {
  e.preventDefault();
  jQuery('.field_error').html('');
  jQuery.ajax({
    url: 'registration_process',
    data: jQuery('#frmRegistration').serialize(),
    type: 'post',
    beforeSend: function(){
      jQuery('.overlay-wrapper').show();  
 	},
    success: function (result) {
      if (result.status == "error") {
            jQuery('.overlay-wrapper').hide(); 
            jQuery.each(result.error, function (key, val) {
              jQuery('#' + key + '_error').html(val[0]);
            });
            Command: toastr["error"](result.message)
      }

      if (result.status == "success") {
          jQuery('.overlay-wrapper').hide(); 
        jQuery('#frmRegistration')[0].reset();
        jQuery('#thank_you_msg').html(result.msg);
        Command: toastr["success"]("Registration Successfully done")
        window.location.href = "./";
      }
    }
  });
});

jQuery('#frmLogin').submit(function (e) {
  jQuery('#login_msg').html("");
  e.preventDefault();
  jQuery.ajax({
    url: './login_process',
    data: jQuery('#frmLogin').serialize(),
    type: 'post',
    beforeSend: function(){
      jQuery('.overlay-wrapper').show();  
 	},
    success: function (result) {
      if (result.status == "error") {
          jQuery('.overlay-wrapper').hide(); 
          jQuery('#login_msg').html(result.msg);
          Command: toastr["error"](result.msg)
      }

      if (result.status == "success") {
          jQuery('.overlay-wrapper').hide(); 
          Command: toastr["success"]("Login Successfull")	
          window.location.href = window.location.href;
        //jQuery('#frmLogin')[0].reset();
        //jQuery('#thank_you_msg').html(result.msg);
      }
    }
  });
});

jQuery('#frmSubscribe').submit(function (e) {

  e.preventDefault();
  jQuery.ajax({
    url: './subscribe',
    data: jQuery('#frmSubscribe').serialize(),
    type: 'post',
    beforeSend: function(){
      jQuery('.overlay-wrapper').show();  
 	},
    success: function (result) {
      if (result.status == "error") {
         jQuery('.overlay-wrapper').hide(); 
        Command: toastr["error"](result.msg)
      }

      if (result.status == "success") {
          jQuery('.overlay-wrapper').hide(); 
         Command: toastr["success"]("Subscribe Successfully")	
        window.location.href = window.location.href;
       
      }
    }
  });
});

jQuery('#frmContact').submit(function (e) {
   
  e.preventDefault();
  jQuery.ajax({
    url: './sendcontact',
    data: jQuery('#frmContact').serialize(),
    type: 'post',
    beforeSend: function(){
      jQuery('.overlay-wrapper').show();  
 	},
    success: function (result) {
      if (result.status == "error") {
         jQuery('.overlay-wrapper').hide(); 
        Command: toastr["error"](result.msg)
      }

      if (result.status == "success") {
          jQuery('.overlay-wrapper').hide(); 
         Command: toastr["success"]("Contact Sent Successfully")	
        window.location.href = window.location.href;
       
      }
    }
  });
});

jQuery('#frmReturn').submit(function (e) {
    e.preventDefault();
    var routeUrl = jQuery(this).data('route');
    var formData = new FormData(this);  // Use FormData to handle file uploads

    jQuery.ajax({
        url: routeUrl,
        data: formData,
        type: 'post',
        contentType: false,  // Important for file uploads
        processData: false,  // Important for file uploads
        beforeSend: function () {
            jQuery('.overlay-wrapper').show();
        },
        success: function (result) {
            if (result.status == "error") {
                jQuery('.overlay-wrapper').hide();
                toastr["error"](result.msg);
            }

            if (result.status == "success") {
                jQuery('.overlay-wrapper').hide();
                toastr["success"]("Order Return Request Sent Successfully");
                window.location.href = window.location.href;
            }
        }
    });
});



// function change_product_color_image(img, color) {
//   jQuery('#color_id').val(color);
//   jQuery('.inner_box_image').html('<img src="' + img + '" class="tab-pane fade show active">');
//   jQuery('.mini_img_box').html('<img src="' + img + '" class="active" id="green_first-tab" data-bs-toggle="pill" data-bs-target="#green_first" type="button" role="tab" aria-controls="green_first" aria-selected="true">');
// }

function change_product_color_image(id, color) {
    jQuery('#color_id').val(color);
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        url: '/myts/product/changeproductimage', // Make sure the URL is correct
        method: "post",
        data: {
            id: id,
            color: color,
        },
        dataType: "json", // Expect JSON response
        success: function (data) {
            if (data.status === 1) {
                jQuery('#colorChangeDiv').html(data.html);
            } else {
                console.error('Error:', data.message);
            }
        },
        error: function (error) {
            console.error('Error:', error);
        }
    });
}

function sort_by() {
  var sort_by_value = jQuery('#sort_by_value').val();
  jQuery('#sort').val(sort_by_value);
  jQuery('#categoryFilter').submit();
}


// function deleteCartProduct(pid, color, attr_id) {
//   jQuery('#color_id').val(color);
//   jQuery('#qty').val(0)
//   add_to_cart(pid, color);
//   //jQuery('#total_price_'+attr_id).html('Rs '+qty*price);
//   jQuery('#cart_box' + attr_id).hide();
//   jQuery('#cart_boxx' + attr_id).hide();
//   jQuery('.aa-cartbox-summary').hide();
//   updateTotalAndSubtotal();
//   // footer_btn
// }


function deleteWishlistProduct(pid, size, color, attr_id) {
  jQuery('#color_id').val(color);
  jQuery('#size_id').val(size);
  jQuery('#qty').val(0)
  add_to_wishlist(pid, size, color);
  //jQuery('#total_price_'+attr_id).html('Rs '+qty*price);
  jQuery('#wishlist_box' + attr_id).hide();
 location.reload(true);
  // footer_btn
}

function setColor(color, type) {

  var color_str = jQuery('#color_filter').val();
  if (type == 1) {
    var new_color_str = color_str.replace(color + ':', '');
    jQuery('#color_filter').val(new_color_str);
  } else {
    jQuery('#color_filter').val(color + ':' + color_str);
    jQuery('#categoryFilter').submit();
  }

  jQuery('#categoryFilter').submit();
}

function sort_price_filter() {
  jQuery('#filter_price_start').val(jQuery('#skip-value-lower').html());
  jQuery('#filter_price_end').val(jQuery('#skip-value-upper').html());
  jQuery('#categoryFilter').submit();
}

 function funSearch(){
  var search_str=jQuery('#search_str').val();
  if(search_str!='' && search_str.length>3){
    window.location.href='../myts/search/'+search_str;
  }
}
