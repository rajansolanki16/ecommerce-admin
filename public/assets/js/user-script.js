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
