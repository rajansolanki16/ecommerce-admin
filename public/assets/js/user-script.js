//product listing
$(document).ready(function() {
    fetchProducts();
});

function fetchProducts(page = 1) {
    var $grid = $('#vec_product-grid');
    if (!$grid.length) return;

    var url = $grid.data('fetch-url');
    url = `${url}?page=${page}`; 

    $.ajax({
        url: url,
        method: 'GET',
        success: function(response) {
            if (!response.html.trim()) {
                $grid.html('<div class="ko-col-12">No products found</div>');
                return;
            }
            
            $grid.html(response.html);
            $('.pagination').html(response.pagination);
            window.history.pushState({}, '', `?page=${page}`);
        },
        error: function(xhr, status, error) {
            $grid.html('<div class="ko-col-12 text-danger">Error loading products</div>');
        }
    });
}

$(document).on('click', '.pagination a', function(e) {
    e.preventDefault();  
    var page = $(this).attr('href').split('page=')[1]; 
    fetchProducts(page);  
});
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

            if (res.status === 'added') {
                $btn.addClass('added');
                $icon.removeClass('bi-heart')
                     .addClass('bi-heart-fill text-danger');
            } else {
                $btn.removeClass('added');
                $icon.removeClass('bi-heart-fill text-danger')
                     .addClass('bi-heart');
            }

            if ($('#wishlist-count').length) {
                $('#wishlist-count').text(res.count);
            }
        },
        error: function (xhr) {
            if (xhr.status === 401 || xhr.status === 419 || xhr.status === 302) {
                try {
                    let list = getGuestWishlist();
                    const idx = list.indexOf(productId);
                    if (idx > -1) {
                        list.splice(idx, 1);
                        $btn.removeClass('added');
                        $icon.removeClass('bi-heart-fill text-danger').addClass('bi-heart');
                    } else {
                        list.push(productId);
                        $btn.addClass('added');
                        $icon.removeClass('bi-heart').addClass('bi-heart-fill text-danger');
                    }
                    setGuestWishlist(list);
                    if ($('#wishlist-count').length) {
                        $('#wishlist-count').text(list.length);
                    }
                } catch (e) { console.error(e); }
            } else {
                alert('Something went wrong!');
            }
        }
    });
});

// Guest storage helpers: cookie <-> localStorage
function getCookie(name) {
    const match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
    return match ? decodeURIComponent(match[2]) : null;
}
function setCookie(name, value, days) {
    try {
        var expires = '';
        if (days) {
            var d = new Date();
            d.setTime(d.getTime() + (days*24*60*60*1000));
            expires = '; expires=' + d.toUTCString();
        }
        document.cookie = name + '=' + encodeURIComponent(value || '') + expires + '; path=/';
    } catch(e){}
}
function deleteCookie(name){ document.cookie = name + '=; Max-Age=-99999999; path=/'; }

function getGuestWishlist(){
    try{
        var wl = JSON.parse(localStorage.getItem('guest_wishlist') || '[]');
        if ((!Array.isArray(wl) || wl.length === 0) && getCookie('guest_wishlist')){
            try{ wl = JSON.parse(decodeURIComponent(getCookie('guest_wishlist'))); } catch(e){ wl = []; }
            if (Array.isArray(wl) && wl.length){
                localStorage.setItem('guest_wishlist', JSON.stringify(wl));
                deleteCookie('guest_wishlist');
            }
        }
        return Array.isArray(wl) ? wl : [];
    }catch(e){ return []; }
}
function setGuestWishlist(list){
    try{ localStorage.setItem('guest_wishlist', JSON.stringify(list)); setCookie('guest_wishlist', JSON.stringify(list), 7); }catch(e){}
}

function getGuestCart(){
    try{
        var gc = JSON.parse(localStorage.getItem('guest_cart') || '[]');
        if ((!Array.isArray(gc) || gc.length === 0) && getCookie('guest_cart')){
            try{ gc = JSON.parse(decodeURIComponent(getCookie('guest_cart'))); } catch(e){ gc = []; }
            if (Array.isArray(gc) && gc.length){
                localStorage.setItem('guest_cart', JSON.stringify(gc));
                deleteCookie('guest_cart');
            }
        }
        return Array.isArray(gc) ? gc : [];
    }catch(e){ return []; }
}
function setGuestCart(list){
    try{ localStorage.setItem('guest_cart', JSON.stringify(list)); setCookie('guest_cart', JSON.stringify(list), 7); }catch(e){}
}

function clearGuestStorage(){
    try{ localStorage.removeItem('guest_wishlist'); deleteCookie('guest_wishlist'); }catch(e){}
    try{ localStorage.removeItem('guest_cart'); deleteCookie('guest_cart'); }catch(e){}
}


function sendGuestStorageToServer(){
    try{
        var wl = getGuestWishlist();
        var gc = getGuestCart();
        if ((!Array.isArray(wl) || wl.length === 0) && (!Array.isArray(gc) || gc.length === 0)) return;
         


        $.ajax({
            //use route guest.merge
            url: guestMergeUrl,
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            contentType: 'application/json; charset=utf-8',
            data: JSON.stringify({ guest_wishlist: wl, guest_cart: gc }),
            success: function(){
                clearGuestStorage();
            },
            error: function(xhr){
                if (xhr.status === 419) {
                }
            }
        });
    }catch(e){ console.error(e); }
}

window.tryMergeGuestStorage = sendGuestStorageToServer;
$(document).ready(function(){ sendGuestStorageToServer(); });

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
                row.fadeOut(300, function () {
                    $(this).remove();
                });

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
                    $('#cart-count').text(response.count); 
                    console.log('Product added to cart!');
                }
            },
             error: function(xhr) {

                if (xhr.status === 422 && xhr.responseJSON) {
                    let res = xhr.responseJSON;
                    $('#cart-error-' + res.product_id)
                        .text(res.message)
                        .show();
                } else if (xhr.status === 401 || xhr.status === 419 || xhr.status === 302) {
                    try {
                        let list = getGuestCart();
                        let found = false;
                        for (let i = 0; i < list.length; i++) {
                            if (list[i].id == productId) {
                                list[i].quantity = (list[i].quantity || 0) + 1;
                                found = true;
                                break;
                            }
                        }
                        if (!found) {
                            list.push({ id: productId, quantity: 1 });
                        }
                        setGuestCart(list);
                        let total = 0;
                        list.forEach(i => total += i.quantity || 0);
                        if ($('#cart-count').length) $('#cart-count').text(total);
                    } catch (e) { console.error(e); }
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