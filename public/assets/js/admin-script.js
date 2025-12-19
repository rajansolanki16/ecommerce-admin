// Admin JS
function setDeleteFormAction(element) {
    let deleteUrl = element.getAttribute("data-delete-url");
    $("#deleteForm").attr("action", deleteUrl);
    $("#deleteRecordModal").modal("show");
}

$(document).ready(function () {

    $('input[type="tel"]').on("input", function () {
        let value = $(this).val();

        if (!/^\+?\d*$/.test(value) || value.length > 14) {
            $(this).val(value.slice(0, -1));
        }
    });

    $('input[type="tel"]').on("keydown", function (e) {
        if (
            !/[\d]/.test(e.key) &&
            e.key !== "Backspace" &&
            e.key !== "Delete" &&
            e.key !== "ArrowLeft" &&
            e.key !== "ArrowRight" &&
            !(e.key === "+" && this.selectionStart === 0)
        ) {
            e.preventDefault();
        }
    });
    
    var checkinPicker = $(".checkin_date_picker").flatpickr({
        dateFormat: "Y-m-d",
        minDate: "today",
        defaultDate: $(".checkin_date_picker").data('old'),
        onChange: function (selectedDates) {
            var minCheckoutDate = new Date(selectedDates[0]);
            minCheckoutDate.setDate(minCheckoutDate.getDate());
            checkoutPicker.set('minDate', minCheckoutDate);
            checkoutPicker.setDate(minCheckoutDate);
        }
    });

    $(".checkin_date_picker").on('change' , function(){
        $(".checkout_date_picker").focus();
    });

    var checkoutPicker = $(".checkout_date_picker").flatpickr({
        dateFormat: "Y-m-d",
        minDate: new Date().fp_incr(0),
        defaultDate: $(".checkout_date_picker").data('old'),
    });
    /* date picker js end */

    $("input[type=number]").on("wheel", function (event) {
        event.preventDefault();
    });

    $(".search").on("keyup", function () {
        var searchValue = $(this).val().toLowerCase();
        var hasResults = false;
        $(".list.form-check-all tr").filter(function () {
            var title = $(this).find(".products h6 a").text().toLowerCase();
            var description = $(this)
                .find("td:nth-child(3)")
                .text()
                .toLowerCase();

            var isVisible =
                title.indexOf(searchValue) > -1 ||
                description.indexOf(searchValue) > -1;
            $(this).toggle(isVisible);
            if (isVisible) {
                hasResults = true;
            }
        });
        if (hasResults) {
            $(".noresult").hide();
        } else {
            $(".noresult").show();
        }
    });

    var selectedRowForSettings;
    var social_link_counter = 0;
    var site_reviews_counter = 0;

    $("#ko_settings_table").on("click", ".ko_settings_btn", function (event) {
        var button = $(this);
        selectedRowForSettings = button.closest("tr");
        var valueCell = selectedRowForSettings.find("td").eq(1);
        var slugCell = selectedRowForSettings.find("td").eq(0);
        var currentValue = valueCell.text();
        var currentSlug = slugCell.data('slug');

        if (button.attr("id") == "ko_settings_table_text") {
            valueCell.html(
                '<input type="text" name="' + currentSlug + '" class="form-control" value="' + currentValue +'" required>'
            );
        }

        if (button.attr("id") == "ko_settings_table_img" ) {
            valueCell.html(
                '<input type="file" name="' + currentSlug + '" class="form-control" accept="image/*" ><small class="text-muted d-flex justify-content-center mt-2">please leave it blank if you do not wants to change.</small>'
            );
        }

        if (button.attr("id") == "ko_settings_table_map_link" ) {
            valueCell.html(
                '<input type="text" name="' + currentSlug + '" class="form-control" value="' + currentValue +'" required>'
            );
        }

        if (button.attr("id") == "ko_settings_table_textarea") {
            let textareaSelector = 'textarea[name="' + currentSlug + '"]';

            valueCell.html(
                '<textarea name="' + currentSlug + '" class="form-control" >' + escapeHtml(currentValue) + '</textarea>'
            );
            
            initTinyMCE(textareaSelector);
        }

        if (button.attr("id") == "ko_settings_table_code") {
            let textareaSelector = 'textarea[name="' + currentSlug + '"]';

            valueCell.html(
                '<textarea name="' + currentSlug + '" class="form-control ko-code-snippet" >' + escapeHtml(currentValue) + '</textarea>'
            );
        }

        if (button.attr("id") === "ko_settings_table_site_social_links") {
            var old_links = button.data('links');
            var asset_url = button.data('asset_url');
            var html_string = "<input type='hidden' name='settings_social_link_edited' value='true' />";
            
            if ($("#add_new_social_link").length === 0) {
                button.parent().append("<div class='row'><button class='btn btn-sm btn-light mt-3 ko_setting_add_btn' id='add_new_social_link'>Add New</button></div>");
            }
    
            if (old_links && Array.isArray(old_links) && old_links.length !== 0) {
                old_links.forEach(function (item) {
                    social_link_counter++;
                    html_string += generateSocialLinkRow(social_link_counter, asset_url + item.icon, item.link, item.id);
                });
            } else {
                social_link_counter++;
                html_string += generateSocialLinkRow(social_link_counter);
            }
    
            valueCell.html(html_string);
        }

        if (button.attr("id") == "ko_settings_table_home_review_area") {
            var old_reviews = button.data('reviews');
            html_string="<input type='hidden' name='home_review_area_edited' value='true' />";
            if ($("#add_new_home_review").length === 0) {
                button.parent().append("<div class='row'><button type='button' class='btn btn-sm btn-light mt-3 ko_setting_add_btn' id='add_new_home_review'>add new</button></div>");
            }
            console.log(old_reviews);
            if(old_reviews && old_reviews.length  != 0 && Array.isArray(old_reviews)){
                old_reviews.forEach(function(item) {
                    site_reviews_counter += 1;
                    html_string +="<div class='row'><button class='btn btn-subtle-danger mx-auto d-block' style='width: 98%;' id='remove_setting_table_row'>Remove</button>";
                    html_string +="<div class='col-lg-12 mt-1'><div class='row'>";
                    html_string +="<div class='col-md-6'><input type='text' class='form-control' required name='name_"+site_reviews_counter+"' value='" +item.name +"' placeholder='Name'></div>";
                    html_string +="<div class='col-md-6'><input type='number' class='form-control' required name='rate_"+site_reviews_counter+"' value='" +item.rate +"' placeholder='Rating'></div>";
                    html_string +="</div><div class='row mt-2'><div class='col-md-12'><textarea class='form-control' name='review_"+site_reviews_counter+"' placeholder='Write the review here' required>" +item.review +"</textarea>";
                    html_string +="</div></div></div></div>";
                });
            }else{
                site_reviews_counter += 1;
                html_string +="<div class='row'><button class='btn btn-subtle-danger mx-auto d-block' style='width: 98%;' id='remove_setting_table_row'>Remove</button>";
                html_string +="<div class='col-lg-12 mt-1'><div class='row'>";
                html_string +="<div class='col-md-6'><input type='text' class='form-control' required name='name_"+site_reviews_counter+"' placeholder='Name'></div>";
                html_string +="<div class='col-md-6'><input type='number' class='form-control' required name='rate_"+site_reviews_counter+"' placeholder='Rating'></div>";
                html_string +="</div><div class='row mt-2'><div class='col-md-12'><textarea class='form-control' name='review_"+site_reviews_counter+"' placeholder='Review' required></textarea>";
                html_string +="</div></div></div></div>";
            }

            valueCell.html(html_string);
        }
    });

    
        
    $("#pageSettingForm").on("submit", function (event) {
        if ($(this).data("submitted")) {
            return true; 
        }

        event.preventDefault();

        let elements = document.querySelectorAll(".ko-code-snippet");

        if (elements.length > 0) {
            elements.forEach((element) => {
                let originalValue = element.value;
                let charCodeArray = [];

                for (let i = 0; i < originalValue.length; i++) {
                    charCodeArray.push(originalValue.charCodeAt(i));
                }

                let encodedValue = charCodeArray.join("-");
                element.value = encodedValue;
            });
        }

        $(this).data("submitted", true);

        setTimeout(() => {
            $(this).submit();
        }, 500);
    });
   

    $("#ko_settings_table").on("click", "#add_new_social_link", function (event) {
        event.preventDefault();
        $("#ko_settings_no_media").remove();
        var button = $(this);
        selectedRowForSettings = button.closest("tr");
        var valueCell = selectedRowForSettings.find("td").eq(1);

        social_link_counter++;
        valueCell.append(generateSocialLinkRow(social_link_counter));
    });

    $("#ko_settings_table").on("click", "#add_new_home_review", function (event) {
        event.preventDefault();
        $("#ko_settings_no_review").remove();
        var button = $(this);
        selectedRowForSettings = button.closest("tr");
        var valueCell = selectedRowForSettings.find("td").eq(1);

        site_reviews_counter += 1;
        var new_html ="<div class='row'><button class='btn btn-subtle-danger mx-auto d-block mt-2' style='width: 98%;' id='remove_setting_table_row'>Remove</button>";
        new_html +="<div class='col-lg-12 mt-1'><div class='row'>";
        new_html +="<div class='col-md-6'><input required type='text' class='form-control' name='name_"+site_reviews_counter+"' placeholder='Name'></div>";
        new_html +="<div class='col-md-6'><input required type='number' class='form-control' name='rate_"+site_reviews_counter+"' placeholder='Rating'></div>";
        new_html +="</div><div class='row mt-2'><div class='col-md-12'><textarea class='form-control' required name='review_"+site_reviews_counter+"' placeholder='Review'></textarea>";
        new_html +="</div></div></div></div>";
        valueCell.append(new_html);
    });



    $("#ko_settings_table").on("click", "#remove_setting_table_row", function () {
        $(this).parent().remove();
    });

    $(".remove-room-media").on("click", function () {
        $this = $(this);
        var parent_div = $this.parent().parent();
        var mediaElement = $this.closest(".position-relative");
        var media_url = $this.data("media");
        var admin_url = parent_div.data("url");
        var rid = parent_div.data("id");
        var token = $('meta[name="csrf-token"]').attr('content');
        var media_type = parent_div.data("type");

        $.ajax({
            url: admin_url,
            type: "POST",
            data: {
                media: media_url,
                room : rid,
                type : media_type,
                _token: token
            },
            success: function (response) {
                if (response.success) {
                mediaElement.fadeOut(300, function () {$(this).remove();});
            } else {
                alert("Unexpected response received.");
            }
            },
            error: function (xhr) {
                let errorMessage = "ERROR : ";
                let response = JSON.parse(xhr.responseText);
                if (response.error) {
                    errorMessage += response.error;
                } else {
                    errorMessage += "Unknown error occurred.";
                }
                alert(errorMessage);
            }
        });
    });

    $("#booking_room_type").on('change', function() {
        $('.booking_form_services').prop('checked', false).prop('disabled', false);
        get_room_services();
    });

    function generateSocialLinkRow(counter, iconSrc = '', url = '', id = '') {
        return `
            <div class='row align-items-center'>
                <button class='btn btn-subtle-danger mb-2 mt-2' id="remove_setting_table_row">Remove</button>
                <div class='col-xl-1 text-center'>
                    <img id='icon_preview_${counter}' src='${iconSrc}' alt='Icon Preview' style='max-width: 30px; display: ${iconSrc ? 'block' : 'none'}; margin-top: 5px;'/>
                </div>
                <div class='col-xl-5'>
                    <div class='mb-3'>
                        <label class='form-label'>Icon</label>
                        <input type='file' accept='image/*, .ico' class='form-control' name='icon_${counter}' ${iconSrc ? '' : 'required'} onchange='previewImage(event, ${counter})'>
                    </div>
                </div>
                <div class='col-xl-6'>
                    <div class='mb-3'>
                        <label class='form-label'>Link</label>
                        <input type='url' required class='form-control' name='url_${counter}' value='${url}' placeholder='https://'>
                        <input type='hidden' name='social_link_id_${counter}' value='${id}'>
                    </div>
                </div>
            </div>`;
    }

    function escapeHtml(text) {
        return text.replace(/&/g, "&amp;")
                   .replace(/</g, "&lt;")
                   .replace(/>/g, "&gt;")
                   .replace(/"/g, "&quot;")
                   .replace(/'/g, "&#039;");
    }
    
    function previewImage(event, counter) {
        var reader = new FileReader();
        reader.onload = function () {
            var output = document.getElementById('icon_preview_' + counter);
            output.src = reader.result;
            output.style.display = "block";
        };
        reader.readAsDataURL(event.target.files[0]);
    }
    

    function initTinyMCE(selector) {
        tinymce.init({
            selector: selector,
            height: 300,
            menubar: false,
            plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table code',
            toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | code',
            content_style: "body { font-family: Arial, sans-serif; font-size: 14px; }",
            setup: function (editor) {
                editor.on('init', function () {
                    editor.setMode('design');
                });
            }
        });
    }

    function destroyTinyMCE(selector) {
        if (tinymce.get(selector)) {
            tinymce.get(selector).remove();
        }
    }

    function get_room_services(){
        let $this = $("#booking_room_type");
        var token = $('meta[name="csrf-token"]').attr('content');
        let room_id =  $this.val();

        let ajax_url = $('#get_room_services_url').data('url');

        if(room_id !== null){
            $.ajax({
                url: ajax_url,
                type: "POST",
                data: {
                    rid : room_id,
                    _token: token
                },
                dataType: "json",
                success: function (response) {
                    if (Array.isArray(response) && response.length > 0) {
                        response.forEach(function (id) {
                            $('.booking_form_services[value="' + id + '"]').prop('checked', true).prop('disabled', true);
                        });
                    }
                }
            });
        }
    }
    get_room_services();

});

// document.addEventListener('DOMContentLoaded', function () {
//     document.querySelectorAll('[data-choices]').forEach(function (el) {

//         if (el.classList.contains('choices-initialized')) return;

//         const searchEnabled = el.dataset.choicesSearch !== 'false';
//         const removeItem = el.hasAttribute('data-choices-remove-item');
//         const isMultiple = el.hasAttribute('multiple');

//         new Choices(el, {
//             searchEnabled: searchEnabled,
//             removeItemButton: removeItem,
//             shouldSort: false,
//             placeholderValue: 'Select categories',
//             itemSelectText: '',
//         });

//         el.classList.add('choices-initialized');
//     });
// });

function previewSingleImage(event) {
    const reader = new FileReader();
    reader.onload = function () {
        document.getElementById('productImagePreview').src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}

function previewMultipleImages(event) {
    const preview = document.getElementById('galleryPreview');
    preview.innerHTML = '';

    Array.from(event.target.files).forEach(file => {
        const reader = new FileReader();

        reader.onload = function () {
            const col = document.createElement('div');
            col.classList.add('col-md-3', 'mb-3');

            col.innerHTML = `
                <div class="card shadow-sm">
                    <img src="${reader.result}" class="card-img-top" style="height:150px;object-fit:cover">
                </div>
            `;
            preview.appendChild(col);
        };

        reader.readAsDataURL(file);
    });
}


$(document).ready(function () {

    function toggleSections() {
        const type = $('#productType').val();

        console.log('Product Type:', type); 

        if (type == 1) {
            $('#variantSection').stop(true, true).slideDown();
            $('#vec_general_Info_Section').hide();
        } else {
            $('#variantSection').hide();
            $('#vec_general_Info_Section').stop(true, true).slideDown();
        }
    }

    // Initial load
    toggleSections();

    // On change
    $('#productType').on('change', toggleSections);
});

document.addEventListener('DOMContentLoaded', function() {
const categorySelect = document.querySelector('select[name="category"]');
    if(categorySelect) {
        new Choices(categorySelect, {
            searchEnabled: true,
            itemSelectText: '',
            shouldSort: false
        });
    }
});
    
function setDeleteFormAction(element) {
    const deleteUrl = element.getAttribute('data-delete-url');
    const form = document.getElementById('deleteForm');

    form.action = deleteUrl;

    const modal = new bootstrap.Modal(
        document.getElementById('deleteRecordModal')
    );
    modal.show();
}


function vec_generate_coupon_code() {
    const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    let code = '';

    for (let i = 0; i < 9; i++) {
        code += chars.charAt(Math.floor(Math.random() * chars.length));
    }
    document.getElementById('vec_coupon_code').value = code;
}


let table;

$(document).ready(function () {

    // Initialize DataTable
    if ($.fn.DataTable.isDataTable('#fixed-header')) {
        table = $('#fixed-header').DataTable();
    } else {
        table = $('#fixed-header').DataTable({
            pageLength: 10
        });
    }

    // Function to reset form to "Add" mode
    function resetForm() {
        $('#vec_attribute_value_form')[0].reset();
        $('#vec_attribute_value_form').attr('action', $('#vec_attribute_value_form').data('store-url'));
        $('#vec_attribute_value_form').find('input[name="_method"]').remove();
        $('#vec_attribute_value_form button[type="submit"]').text('Submit');
        $('#valueError').text('');
    }

    // ADD OR UPDATE VALUE VIA AJAX
    $('#vec_attribute_value_form').on('submit', function (e) {
        e.preventDefault();
        let formData = new FormData(this);
        $('#valueError').text('');

        let method = $(this).find('input[name="_method"]').val() || 'POST';

        fetch(this.action, {
            method: method,
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': $('input[name=_token]').val()
            },
            body: formData
        })
        .then(res => {
            if (!res.ok) return res.json().then(err => Promise.reject(err));
            return res.json();
        })
        .then(data => {

            // If editing an existing row
            if (method === 'PUT') {
                let row = table.row(`#row-${data.id}`);
                let actionHtml = generateActionHtml(data.id);

                row.data([
                    data.id,
                    data.value,
                    data.attribute,
                    actionHtml
                ]).draw(false);

                resetForm();
            } else {
                // Adding new row
                let actionHtml = generateActionHtml(data.id);

                table.row.add([
                    data.id,
                    data.value,
                    data.attribute,
                    actionHtml
                ]).node().id = `row-${data.id}`;

                table.draw(false);
                resetForm();
            }
        })
        .catch(err => {
            if (err.errors?.value) {
                $('#valueError').text(err.errors.value[0]);
            }
        });
    });

    // DELETE VALUE VIA AJAX
    $(document).on('click', '.deleteValue', function (e) {
        e.preventDefault();
        e.stopPropagation();

        let url = $(this).data('url');
        if (!url) { alert('Delete URL not found'); return; }

        let row = table.row($(this).closest('tr'));

        fetch(url, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === true) {
                row.remove().draw(false);
            } else {
                alert('Delete failed');
            }
        })
        .catch(err => { console.error(err); alert('Delete error'); });
    });

    // EDIT VALUE VIA AJAX (populate form)
    $(document).on('click', '.editValue', function (e) {
        e.preventDefault();
        e.stopPropagation();

        let editUrl = $(this).data('edit-url');
        let updateUrl = $(this).data('update-url');

        fetch(editUrl, {
            headers: { 'Accept': 'application/json' }
        })
        .then(res => res.json())
        .then(data => {
            // Populate the form with existing value
            $('#values').val(data.value);
            $('#vec_attribute_value_form').attr('action', updateUrl);

            // Add _method PUT if not exists
            if ($('#vec_attribute_value_form').find('input[name="_method"]').length === 0) {
                $('#vec_attribute_value_form').append('<input type="hidden" name="_method" value="PUT">');
            }

            // Change button text to Update
            $('#vec_attribute_value_form button[type="submit"]').text('Update');

            // Scroll to the form (optional)
            $('html, body').animate({ scrollTop: $('#vec_attribute_value_form').offset().top - 100 }, 500);
        })
        .catch(err => {
            console.error(err);
            alert('Failed to fetch data for edit');
        });
    });

    // Function to generate action buttons for table
    function generateActionHtml(id) {
        return `
            <div class="dropdown position-static">
                <button class="btn btn-subtle-secondary btn-sm btn-icon"
                    data-bs-toggle="dropdown">
                    <i class="bi bi-three-dots-vertical"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a href="javascript:void(0);"
                           class="dropdown-item editValue"
                           data-edit-url="/attribute-values/${id}/edit"
                           data-update-url="/attribute-values/${id}">
                           <i class="align-middle ph-pencil me-1"></i> Edit
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);"
                           class="dropdown-item deleteValue"
                           data-url="/attribute-values/${id}">
                           <i class="align-middle ph-trash me-1"></i> Remove
                        </a>
                    </li>
                </ul>
            </div>`;
    }

});
