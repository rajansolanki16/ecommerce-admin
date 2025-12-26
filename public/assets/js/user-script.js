//product listing
$(document).ready(function() {
    fetchProducts();
});

function fetchProducts() {
    var $grid = $('#vec_product-grid');
    if (!$grid.length) return;

    var url = $grid.data('fetch-url');

    $.ajax({
        url: url,
        method: 'GET',
        success: function(html) {
            if (!html.trim()) {
                $grid.html('<div class="ko-col-12">No products found</div>');
                return;
            }
            $grid.html(html);
        },
        error: function(xhr, status, error) {
            $grid.html('<div class="ko-col-12 text-danger">Error loading products</div>');
        }
    });
}

//wishlist add script
$(document).on('click', '.wishlist-btn', function (e) {
    e.preventDefault();

    let $btn = $(this);
    let productId = $btn.data('product-id');
    let wishlistUrl = $('#vec_product-grid').data('wishlist-url');
    let $icon = $btn.find('i');

    $.ajax({
        url: wishlistUrl,
        type: 'POST',
        data: {
            product_id: productId,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (res) {
            console.log('Wishlist response:', res);

            //  Icon toggle
            if (res.status === 'added') {
                $btn.addClass('added');
                $icon.removeClass('bi-heart')
                     .addClass('bi-heart-fill text-danger');
            } else {
                $btn.removeClass('added');
                $icon.removeClass('bi-heart-fill text-danger')
                     .addClass('bi-heart');
            }

            //  Header wishlist count update
            if ($('#wishlist-count').length) {
                $('#wishlist-count').text(res.count);
            }
        },
        error: function () {
            alert('Something went wrong!');
        }
    });
});



//delete wishlist product
$(document).on('click', '.vec_wishlist_remove', function (e) {
    e.preventDefault();

    let wishlistId = $(this).data('id');
    let row = $(this).closest('tr');

    $.ajax({
        url: '/wishlist/delete/' + wishlistId,
        type: 'DELETE',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (res) {

            if (res.status === 'success') {

                //  remove row
                row.fadeOut(300, function () {
                    $(this).remove();
                });

                //  update header count
                if ($('#wishlist-count').length) {
                    $('#wishlist-count').text(res.count);
                }
            }
        },
        error: function () {
            alert('Something went wrong!');
        }
    });
});

//add to cart ajax
$(document).ready(function() {

    $(document).on('click', '.add-to-cart', function(e) {
        e.preventDefault();

        var productId = $(this).data('id');
        //error msg 
         $('.cart-error').hide().text('');
         console.log('.cart-error');
       
        $.ajax({
            url: '/cart/add',
            type: 'POST',
            data: {
                product_id: productId,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.status === 'success') {
                    $('#cart-count').text(response.count); // update cart count
                    console.log('Product added to cart!');
                }
            },
             error: function(xhr) {

             if (xhr.status === 422 && xhr.responseJSON) {

                let res = xhr.responseJSON;
                $('#cart-error-' + res.product_id)
                    .text(res.message)
                    .show();
                } else {
                    alert('Something went wrong');
                }
            }
        
        });

    });

});

//cart product delete ajax
$(document).ready(function() {

    // Remove from cart
    $(document).on('click', '.remove-from-cart', function(e) {
        e.preventDefault();
        
        var button = $(this);
        var productId = button.data('id');
        var rowId = button.data('row');
        
        $.ajax({
            url: '/cart/remove/' + productId,
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.status === 'success') {
                    $('#' + rowId).fadeOut(400, function() {
                        $(this).remove();
                        
                        $('#cart-count').text(response.count);
                        $('#grand-total').text('₹' + response.grandTotal);
                    });
                    
                    console.log('Product removed from cart');
                }
            },
            error: function(xhr) {
                button.prop('disabled', false).text('Remove');
                alert(xhr.responseJSON?.message || 'Failed to remove product');
            }
        });
    });

});

//update cart quantity
    var updateTimeout;
    
    $(document).on('input', '.update-quantity', function() {
        var input = $(this);
        var productId = input.data('id');
        var quantity = parseInt(input.val()) || 1;
        
        if (quantity < 1) {
            quantity = 1;
            input.val(1);
        }
        
        clearTimeout(updateTimeout);
        
        updateTimeout = setTimeout(function() {
            updateCartQuantity(productId, quantity, input);
        }, 500);
    });
    
    // Also handle change event (for up/down arrows)
    $(document).on('change', '.update-quantity', function() {
        var input = $(this);
        var productId = input.data('id');
        var quantity = parseInt(input.val()) || 1;
        
        if (quantity < 1) {
            quantity = 1;
            input.val(1);
        }
        
        clearTimeout(updateTimeout);
        updateCartQuantity(productId, quantity, input);
    });
    
    function updateCartQuantity(productId, quantity, input) {
        // Disable input temporarily
        input.prop('disabled', true);
        
        $.ajax({
            url: '/cart/update/' + productId,
            type: 'POST',
            data: {
                quantity: quantity,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.status === 'success') {
                    // Update item total for this row
                    var row = input.closest('tr');
                    row.find('.item-total').text('₹' + response.itemTotal.toLocaleString());
                    $('#grand-total').text('₹' + response.grandTotal.toLocaleString());
                    $('#cart-count').text(response.count);
                    
                    row.find('.item-total').addClass('text-success fw-bold');
                    setTimeout(function() {
                        row.find('.item-total').removeClass('text-success fw-bold');
                    }, 800);
                    
                    console.log('Cart quantity updated');
                }
                input.prop('disabled', false);
            },
            error: function(xhr) {
                alert(xhr.responseJSON?.message || 'Failed to update cart');
                input.prop('disabled', false);
            }
        });
    }