//global variable
var notices = jQuery('#addedInfo');
var scrollSpeed = 500;
var hideSpeed = 300;
var dHeight = jQuery(document).height();
var wHeight = jQuery(window).height();
var scrollPos = dHeight - wHeight;

jQuery('.single_add_to_cart_button').click(function(e) {
	e.preventDefault();
	var product_id = jQuery('input[name="product_id"]').val();
	var variation_id = jQuery('input[name="variation_id"]').val();
	var quantity = jQuery('input[name="quantity"]').val();;
	var el = jQuery(this);
	
	var data = {
		action: 'yk_add_cart_single',
		nonce: ajax_handler.nonce,
		product_id: product_id,
		variation_id: variation_id,
		quantity: quantity,
	};

	if (variation_id) {
		jQuery.ajax({
			type: 'POST',
			url : ajax_handler.ajax_url,
			data: data,
			beforeSend: function() {
				jQuery('html, body').animate({
					scrollTop: scrollPos
				}, hideSpeed);
				closeIt(notices);
				el.text('Loading..');
			},
			success:function(results) {
				notices.fadeIn();
				notices.removeClass('hide');
				notices.append(results);
				var cartcount = jQuery('.item-count').html();
				var stock = jQuery('#notice').data('stock');
				jQuery('.cart-icon span').html(cartcount);
				jQuery('.single_add_to_cart_button').text('Add to cart');
				jQuery('html, body').animate({ scrollTop: scrollPos + 200 }, scrollSpeed);
				if (stock == 0) {
					el.addClass('disabled');
				}
			}
		});
	} else {
		jQuery.ajax ({
			url: ajax_handler.ajax_url,  
			type:'POST',
			data: data,
			beforeSend: function() {
				jQuery('html, body').animate({
					scrollTop: scrollPos
				}, hideSpeed);
				closeIt(notices);
				el.text('Loading..');
			},
			success:function(results) {
				notices.fadeIn();
				notices.removeClass('hide');
				notices.append(results);
				var cartcount = jQuery('.item-count').html();
				var stock = jQuery('#notice').data('stock');
				jQuery('.cart-icon span').html(cartcount);
				jQuery('.single_add_to_cart_button').text('Add to cart');
				jQuery('html, body').animate({ scrollTop: scrollPos + 200 }, scrollSpeed);
				if (stock == 0) {
					el.addClass('disabled');
				}
			}
		});
	}
});


jQuery(document).on( 'click', '.button-close', function(e) {
    //	e.preventDefault();
        jQuery('html, body').animate({
            scrollTop: scrollPos + 80
        }, hideSpeed);
        closeIt(notices);
    });
    
    function closeIt(element) {
        element.addClass('hide', setTimeout(function() {
            element.empty();
        }, hideSpeed));
    }