<x-admin.header :title="'Product'" />
<div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Add Product</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                                        <li class="breadcrumb-item active">Add Product</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xxl-4">
                                            <h5 class="card-title mb-3">Product Information</h5>
                                            <p class="text-muted">Product Information refers to any information held by an organisation about the products it produces, buys, sells or distributes.</p>
                                        </div>
                                        <div class="col-xxl-8">
                                            <form action="#!">
                                                <div class="mb-3">
                                                    <label for="productTitle" class="form-label">Product Title <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="productTitle" placeholder="Enter product title" required="">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="productCategories" class="form-label">Categories <span class="text-danger">*</span></label>
                                                    <div class="choices" data-type="select-one" tabindex="0" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-expanded="false"><div class="choices__inner"><select class="form-control choices__input" data-choices="" name="productCategories" id="productCategories" hidden="" tabindex="-1" data-choice="active"><option value="" data-custom-properties="[object Object]">Select categories</option></select><div class="choices__list choices__list--single"><div class="choices__item choices__placeholder choices__item--selectable" data-item="" data-id="1" data-value="" data-custom-properties="[object Object]" aria-selected="true">Select categories</div></div></div><div class="choices__list choices__list--dropdown" aria-expanded="false"><input type="search" name="search_terms" class="choices__input choices__input--cloned" autocomplete="off" autocapitalize="off" spellcheck="false" role="textbox" aria-autocomplete="list" aria-label="Select categories" placeholder=""><div class="choices__list" role="listbox"><div id="choices--productCategories-item-choice-9" class="choices__item choices__item--choice is-selected choices__placeholder choices__item--selectable is-highlighted" role="option" data-choice="" data-id="9" data-value="" data-select-text="Press to select" data-choice-selectable="" aria-selected="true">Select categories</div><div id="choices--productCategories-item-choice-1" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="1" data-value="Appliances" data-select-text="Press to select" data-choice-selectable="">Appliances</div><div id="choices--productCategories-item-choice-2" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="2" data-value="Automotive Accessories" data-select-text="Press to select" data-choice-selectable="">Automotive Accessories</div><div id="choices--productCategories-item-choice-3" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="3" data-value="Electronics" data-select-text="Press to select" data-choice-selectable="">Electronics</div><div id="choices--productCategories-item-choice-4" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="4" data-value="Fashion" data-select-text="Press to select" data-choice-selectable="">Fashion</div><div id="choices--productCategories-item-choice-5" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="5" data-value="Footwear" data-select-text="Press to select" data-choice-selectable="">Footwear</div><div id="choices--productCategories-item-choice-6" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="6" data-value="Furniture" data-select-text="Press to select" data-choice-selectable="">Furniture</div><div id="choices--productCategories-item-choice-7" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="7" data-value="Headphones" data-select-text="Press to select" data-choice-selectable="">Headphones</div><div id="choices--productCategories-item-choice-8" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="8" data-value="Other Accessories" data-select-text="Press to select" data-choice-selectable="">Other Accessories</div><div id="choices--productCategories-item-choice-10" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="10" data-value="Sportswear" data-select-text="Press to select" data-choice-selectable="">Sportswear</div><div id="choices--productCategories-item-choice-11" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="11" data-value="Watches" data-select-text="Press to select" data-choice-selectable="">Watches</div></div></div></div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="productType" class="form-label">Product Type <span class="text-danger">*</span></label>
                                                    <div class="choices" data-type="select-one" tabindex="0" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-expanded="false"><div class="choices__inner"><select class="form-control choices__input" data-choices="" name="productType" id="productType" hidden="" tabindex="-1" data-choice="active"><option value="" data-custom-properties="[object Object]">Select Type</option></select><div class="choices__list choices__list--single"><div class="choices__item choices__placeholder choices__item--selectable" data-item="" data-id="1" data-value="" data-custom-properties="[object Object]" aria-selected="true">Select Type</div></div></div><div class="choices__list choices__list--dropdown" aria-expanded="false"><input type="search" name="search_terms" class="choices__input choices__input--cloned" autocomplete="off" autocapitalize="off" spellcheck="false" role="textbox" aria-autocomplete="list" aria-label="Select Type" placeholder=""><div class="choices__list" role="listbox"><div id="choices--productType-item-choice-2" class="choices__item choices__item--choice is-selected choices__placeholder choices__item--selectable is-highlighted" role="option" data-choice="" data-id="2" data-value="" data-select-text="Press to select" data-choice-selectable="" aria-selected="true">Select Type</div><div id="choices--productType-item-choice-1" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="1" data-value="Classified" data-select-text="Press to select" data-choice-selectable="">Classified</div><div id="choices--productType-item-choice-3" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="3" data-value="Simple" data-select-text="Press to select" data-choice-selectable="">Simple</div></div></div></div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="shortDecs" class="form-label">Short Description <span class="text-danger">*</span></label>
                                                    <textarea class="form-control" id="shortDecs" placeholder="Must enter minimum of a 100 characters" rows="3"></textarea>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="productBrand" class="form-label">Brand <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="productBrand" placeholder="Enter brand" required="">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="productUnit" class="form-label">Unit <span class="text-danger">*</span></label>
                                                            <div class="choices" data-type="select-one" tabindex="0" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-expanded="false"><div class="choices__inner"><select class="form-control choices__input" data-choices="" name="productUnit" id="productUnit" hidden="" tabindex="-1" data-choice="active"><option value="" data-custom-properties="[object Object]">Select Unit</option></select><div class="choices__list choices__list--single"><div class="choices__item choices__placeholder choices__item--selectable" data-item="" data-id="1" data-value="" data-custom-properties="[object Object]" aria-selected="true">Select Unit</div></div></div><div class="choices__list choices__list--dropdown" aria-expanded="false"><input type="search" name="search_terms" class="choices__input choices__input--cloned" autocomplete="off" autocapitalize="off" spellcheck="false" role="textbox" aria-autocomplete="list" aria-label="Select Unit" placeholder=""><div class="choices__list" role="listbox"><div id="choices--productUnit-item-choice-3" class="choices__item choices__item--choice is-selected choices__placeholder choices__item--selectable is-highlighted" role="option" data-choice="" data-id="3" data-value="" data-select-text="Press to select" data-choice-selectable="" aria-selected="true">Select Unit</div><div id="choices--productUnit-item-choice-1" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="1" data-value="Kilogram" data-select-text="Press to select" data-choice-selectable="">Kilogram</div><div id="choices--productUnit-item-choice-2" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="2" data-value="Pieces" data-select-text="Press to select" data-choice-selectable="">Pieces</div></div></div></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Tags</label>
                                                    <div class="choices" data-type="text" aria-haspopup="true" aria-expanded="false"><div class="choices__inner"><input class="form-control choices__input" id="choices-text-unique-values" data-choices="" data-choices-text-unique-true="" data-choices-removeitem="" type="text" value="Fashion,Style,Brands,Puma" hidden="" tabindex="-1" data-choice="active"><div class="choices__list choices__list--multiple"><div class="choices__item choices__item--selectable" data-item="" data-id="1" data-value="Fashion" data-custom-properties="[object Object]" aria-selected="true" data-deletable="">Fashion<button type="button" class="choices__button" aria-label="Remove item: 'Fashion'" data-button="">Remove item</button></div><div class="choices__item choices__item--selectable" data-item="" data-id="2" data-value="Style" data-custom-properties="[object Object]" aria-selected="true" data-deletable="">Style<button type="button" class="choices__button" aria-label="Remove item: 'Style'" data-button="">Remove item</button></div><div class="choices__item choices__item--selectable" data-item="" data-id="3" data-value="Brands" data-custom-properties="[object Object]" aria-selected="true" data-deletable="">Brands<button type="button" class="choices__button" aria-label="Remove item: 'Brands'" data-button="">Remove item</button></div><div class="choices__item choices__item--selectable" data-item="" data-id="4" data-value="Puma" data-custom-properties="[object Object]" aria-selected="true" data-deletable="">Puma<button type="button" class="choices__button" aria-label="Remove item: 'Puma'" data-button="">Remove item</button></div></div><input type="search" name="search_terms" class="choices__input choices__input--cloned" autocomplete="off" autocapitalize="off" spellcheck="false" role="textbox" aria-autocomplete="list" aria-label="null"></div><div class="choices__list choices__list--dropdown" aria-expanded="false"></div></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-check form-switch mb-3">
                                                            <input class="form-check-input" type="checkbox" role="switch" id="exchangeableInput">
                                                            <label class="form-check-label" for="exchangeableInput">Exchangeable</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-check form-switch mb-3">
                                                            <input class="form-check-input" type="checkbox" role="switch" id="refundableInput">
                                                            <label class="form-check-label" for="refundableInput">Refundable</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div><!--end col-->
                                    </div><!--end row-->
                                </div>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xxl-4">
                                            <h5 class="card-title mb-3">Description</h5>
                                            <p class="text-muted">Product Information refers to any information held by an organization about the products it produces, buys, sells or distributes.</p>
                                        </div><!--end col-->
                                        <div class="col-xxl-8">
                                            <div>
                                                <label class="form-label">Product Description <span class="text-danger">*</span></label>
                                                <div class="ckeditor-classic" style="display: none;"></div><div class="ck ck-reset ck-editor ck-rounded-corners" role="application" dir="ltr" lang="en" aria-labelledby="ck-editor__label_e2efe84732b62ea1798497ea84220899e"><label class="ck ck-label ck-voice-label" id="ck-editor__label_e2efe84732b62ea1798497ea84220899e">Rich Text Editor</label><div class="ck ck-editor__top ck-reset_all" role="presentation"><div class="ck ck-sticky-panel"><div class="ck ck-sticky-panel__placeholder" style="display: none;"></div><div class="ck ck-sticky-panel__content"><div class="ck ck-toolbar ck-toolbar_grouping" role="toolbar" aria-label="Editor toolbar" tabindex="-1"><div class="ck ck-toolbar__items"><button class="ck ck-button ck-disabled ck-off" type="button" tabindex="-1" aria-labelledby="ck-editor__aria-label_ed0b618299c6e10bb7562eda8def3adfc" aria-disabled="true" data-cke-tooltip-text="Undo (Ctrl+Z)" data-cke-tooltip-position="s"><svg class="ck ck-icon ck-reset_all-excluded ck-icon_inherit-color ck-button__icon" viewBox="0 0 20 20"><path d="m5.042 9.367 2.189 1.837a.75.75 0 0 1-.965 1.149l-3.788-3.18a.747.747 0 0 1-.21-.284.75.75 0 0 1 .17-.945L6.23 4.762a.75.75 0 1 1 .964 1.15L4.863 7.866h8.917A.75.75 0 0 1 14 7.9a4 4 0 1 1-1.477 7.718l.344-1.489a2.5 2.5 0 1 0 1.094-4.73l.008-.032H5.042z"></path></svg><span class="ck ck-button__label" id="ck-editor__aria-label_ed0b618299c6e10bb7562eda8def3adfc">Undo</span></button><button class="ck ck-button ck-disabled ck-off" type="button" tabindex="-1" aria-labelledby="ck-editor__aria-label_e5178e6f91d2d9a0963eadfc1b112b890" aria-disabled="true" data-cke-tooltip-text="Redo (Ctrl+Y)" data-cke-tooltip-position="s"><svg class="ck ck-icon ck-reset_all-excluded ck-icon_inherit-color ck-button__icon" viewBox="0 0 20 20"><path d="m14.958 9.367-2.189 1.837a.75.75 0 0 0 .965 1.149l3.788-3.18a.747.747 0 0 0 .21-.284.75.75 0 0 0-.17-.945L13.77 4.762a.75.75 0 1 0-.964 1.15l2.331 1.955H6.22A.75.75 0 0 0 6 7.9a4 4 0 1 0 1.477 7.718l-.344-1.489A2.5 2.5 0 1 1 6.039 9.4l-.008-.032h8.927z"></path></svg><span class="ck ck-button__label" id="ck-editor__aria-label_e5178e6f91d2d9a0963eadfc1b112b890">Redo</span></button><span class="ck ck-toolbar__separator"></span><div class="ck ck-dropdown ck-heading-dropdown"><button class="ck ck-button ck-off ck-button_with-text ck-dropdown__button" type="button" tabindex="-1" aria-label="Heading" data-cke-tooltip-text="Heading" data-cke-tooltip-position="s" aria-haspopup="true" aria-expanded="false"><span class="ck ck-button__label" id="ck-editor__aria-label_e1d176ac7d2c67f38d6bf0a148646066f">Paragraph</span><svg class="ck ck-icon ck-reset_all-excluded ck-icon_inherit-color ck-dropdown__arrow" viewBox="0 0 10 10"><path d="M.941 4.523a.75.75 0 1 1 1.06-1.06l3.006 3.005 3.005-3.005a.75.75 0 1 1 1.06 1.06l-3.549 3.55a.75.75 0 0 1-1.168-.136L.941 4.523z"></path></svg></button><div class="ck ck-reset ck-dropdown__panel ck-dropdown__panel_se"></div></div><span class="ck ck-toolbar__separator"></span><button class="ck ck-button ck-off" type="button" tabindex="-1" aria-labelledby="ck-editor__aria-label_e19d3883f55eb143f7622ad3ba1622c54" aria-pressed="false" data-cke-tooltip-text="Bold (Ctrl+B)" data-cke-tooltip-position="s"><svg class="ck ck-icon ck-reset_all-excluded ck-icon_inherit-color ck-button__icon" viewBox="0 0 20 20"><path d="M10.187 17H5.773c-.637 0-1.092-.138-1.364-.415-.273-.277-.409-.718-.409-1.323V4.738c0-.617.14-1.062.419-1.332.279-.27.73-.406 1.354-.406h4.68c.69 0 1.288.041 1.793.124.506.083.96.242 1.36.478.341.197.644.447.906.75a3.262 3.262 0 0 1 .808 2.162c0 1.401-.722 2.426-2.167 3.075C15.05 10.175 16 11.315 16 13.01a3.756 3.756 0 0 1-2.296 3.504 6.1 6.1 0 0 1-1.517.377c-.571.073-1.238.11-2 .11zm-.217-6.217H7v4.087h3.069c1.977 0 2.965-.69 2.965-2.072 0-.707-.256-1.22-.768-1.537-.512-.319-1.277-.478-2.296-.478zM7 5.13v3.619h2.606c.729 0 1.292-.067 1.69-.2a1.6 1.6 0 0 0 .91-.765c.165-.267.247-.566.247-.897 0-.707-.26-1.176-.778-1.409-.519-.232-1.31-.348-2.375-.348H7z"></path></svg><span class="ck ck-button__label" id="ck-editor__aria-label_e19d3883f55eb143f7622ad3ba1622c54">Bold</span></button><button class="ck ck-button ck-off" type="button" tabindex="-1" aria-labelledby="ck-editor__aria-label_e921639e6858717e23e9d6d9b2c70256f" aria-pressed="false" data-cke-tooltip-text="Italic (Ctrl+I)" data-cke-tooltip-position="s"><svg class="ck ck-icon ck-reset_all-excluded ck-icon_inherit-color ck-button__icon" viewBox="0 0 20 20"><path d="m9.586 14.633.021.004c-.036.335.095.655.393.962.082.083.173.15.274.201h1.474a.6.6 0 1 1 0 1.2H5.304a.6.6 0 0 1 0-1.2h1.15c.474-.07.809-.182 1.005-.334.157-.122.291-.32.404-.597l2.416-9.55a1.053 1.053 0 0 0-.281-.823 1.12 1.12 0 0 0-.442-.296H8.15a.6.6 0 0 1 0-1.2h6.443a.6.6 0 1 1 0 1.2h-1.195c-.376.056-.65.155-.823.296-.215.175-.423.439-.623.79l-2.366 9.347z"></path></svg><span class="ck ck-button__label" id="ck-editor__aria-label_e921639e6858717e23e9d6d9b2c70256f">Italic</span></button><span class="ck ck-toolbar__separator"></span><button class="ck ck-button ck-off" type="button" tabindex="-1" aria-labelledby="ck-editor__aria-label_ed9dc5c785e924d010c8f2ee44b54f904" aria-pressed="false" data-cke-tooltip-text="Link (Ctrl+K)" data-cke-tooltip-position="s"><svg class="ck ck-icon ck-reset_all-excluded ck-icon_inherit-color ck-button__icon" viewBox="0 0 20 20"><path d="m11.077 15 .991-1.416a.75.75 0 1 1 1.229.86l-1.148 1.64a.748.748 0 0 1-.217.206 5.251 5.251 0 0 1-8.503-5.955.741.741 0 0 1 .12-.274l1.147-1.639a.75.75 0 1 1 1.228.86L4.933 10.7l.006.003a3.75 3.75 0 0 0 6.132 4.294l.006.004zm5.494-5.335a.748.748 0 0 1-.12.274l-1.147 1.639a.75.75 0 1 1-1.228-.86l.86-1.23a3.75 3.75 0 0 0-6.144-4.301l-.86 1.229a.75.75 0 0 1-1.229-.86l1.148-1.64a.748.748 0 0 1 .217-.206 5.251 5.251 0 0 1 8.503 5.955zm-4.563-2.532a.75.75 0 0 1 .184 1.045l-3.155 4.505a.75.75 0 1 1-1.229-.86l3.155-4.506a.75.75 0 0 1 1.045-.184z"></path></svg><span class="ck ck-button__label" id="ck-editor__aria-label_ed9dc5c785e924d010c8f2ee44b54f904">Link</span></button><span class="ck-file-dialog-button"><button class="ck ck-button ck-off" type="button" tabindex="-1" aria-labelledby="ck-editor__aria-label_e623b5d3d73b5d7cbe38a2587bc529d12" data-cke-tooltip-text="Insert image" data-cke-tooltip-position="s"><svg class="ck ck-icon ck-reset_all-excluded ck-icon_inherit-color ck-button__icon" viewBox="0 0 20 20"><path d="M6.91 10.54c.26-.23.64-.21.88.03l3.36 3.14 2.23-2.06a.64.64 0 0 1 .87 0l2.52 2.97V4.5H3.2v10.12l3.71-4.08zm10.27-7.51c.6 0 1.09.47 1.09 1.05v11.84c0 .59-.49 1.06-1.09 1.06H2.79c-.6 0-1.09-.47-1.09-1.06V4.08c0-.58.49-1.05 1.1-1.05h14.38zm-5.22 5.56a1.96 1.96 0 1 1 3.4-1.96 1.96 1.96 0 0 1-3.4 1.96z"></path></svg><span class="ck ck-button__label" id="ck-editor__aria-label_e623b5d3d73b5d7cbe38a2587bc529d12">Insert image</span></button><input class="ck-hidden" type="file" tabindex="-1" accept="image/jpeg,image/png,image/gif,image/bmp,image/webp,image/tiff" multiple="true"></span><div class="ck ck-dropdown"><button class="ck ck-button ck-off ck-dropdown__button" type="button" tabindex="-1" aria-labelledby="ck-editor__aria-label_eb6460255805e729d9e1034878962895e" data-cke-tooltip-text="Insert table" data-cke-tooltip-position="s" aria-haspopup="true" aria-expanded="false"><svg class="ck ck-icon ck-reset_all-excluded ck-icon_inherit-color ck-button__icon" viewBox="0 0 20 20"><path d="M3 6v3h4V6H3zm0 4v3h4v-3H3zm0 4v3h4v-3H3zm5 3h4v-3H8v3zm5 0h4v-3h-4v3zm4-4v-3h-4v3h4zm0-4V6h-4v3h4zm1.5 8a1.5 1.5 0 0 1-1.5 1.5H3A1.5 1.5 0 0 1 1.5 17V4c.222-.863 1.068-1.5 2-1.5h13c.932 0 1.778.637 2 1.5v13zM12 13v-3H8v3h4zm0-4V6H8v3h4z"></path></svg><span class="ck ck-button__label" id="ck-editor__aria-label_eb6460255805e729d9e1034878962895e">Insert table</span><svg class="ck ck-icon ck-reset_all-excluded ck-icon_inherit-color ck-dropdown__arrow" viewBox="0 0 10 10"><path d="M.941 4.523a.75.75 0 1 1 1.06-1.06l3.006 3.005 3.005-3.005a.75.75 0 1 1 1.06 1.06l-3.549 3.55a.75.75 0 0 1-1.168-.136L.941 4.523z"></path></svg></button><div class="ck ck-reset ck-dropdown__panel ck-dropdown__panel_se"></div></div><button class="ck ck-button ck-off" type="button" tabindex="-1" aria-labelledby="ck-editor__aria-label_eb125dbad83fcb7f7a7c2ba092f69f369" aria-pressed="false" data-cke-tooltip-text="Block quote" data-cke-tooltip-position="s"><svg class="ck ck-icon ck-reset_all-excluded ck-icon_inherit-color ck-button__icon" viewBox="0 0 20 20"><path d="M3 10.423a6.5 6.5 0 0 1 6.056-6.408l.038.67C6.448 5.423 5.354 7.663 5.22 10H9c.552 0 .5.432.5.986v4.511c0 .554-.448.503-1 .503h-5c-.552 0-.5-.449-.5-1.003v-4.574zm8 0a6.5 6.5 0 0 1 6.056-6.408l.038.67c-2.646.739-3.74 2.979-3.873 5.315H17c.552 0 .5.432.5.986v4.511c0 .554-.448.503-1 .503h-5c-.552 0-.5-.449-.5-1.003v-4.574z"></path></svg><span class="ck ck-button__label" id="ck-editor__aria-label_eb125dbad83fcb7f7a7c2ba092f69f369">Block quote</span></button><div class="ck ck-dropdown"><button class="ck ck-button ck-off ck-dropdown__button" type="button" tabindex="-1" aria-labelledby="ck-editor__aria-label_eff1964a751f9659d7972f606e7313568" data-cke-tooltip-text="Insert media" data-cke-tooltip-position="s" aria-haspopup="true" aria-expanded="false"><svg class="ck ck-icon ck-reset_all-excluded ck-icon_inherit-color ck-button__icon" viewBox="0 0 20 20"><path d="M18.68 3.03c.6 0 .59-.03.59.55v12.84c0 .59.01.56-.59.56H1.29c-.6 0-.59.03-.59-.56V3.58c0-.58-.01-.55.6-.55h17.38zM15.77 15V5H4.2v10h11.57zM2 4v1h1V4H2zm0 2v1h1V6H2zm0 2v1h1V8H2zm0 2v1h1v-1H2zm0 2v1h1v-1H2zm0 2v1h1v-1H2zM17 4v1h1V4h-1zm0 2v1h1V6h-1zm0 2v1h1V8h-1zm0 2v1h1v-1h-1zm0 2v1h1v-1h-1zm0 2v1h1v-1h-1zM7.5 7.177a.4.4 0 0 1 .593-.351l5.133 2.824a.4.4 0 0 1 0 .7l-5.133 2.824a.4.4 0 0 1-.593-.35V7.176v.001z"></path></svg><span class="ck ck-button__label" id="ck-editor__aria-label_eff1964a751f9659d7972f606e7313568">Insert media</span><svg class="ck ck-icon ck-reset_all-excluded ck-icon_inherit-color ck-dropdown__arrow" viewBox="0 0 10 10"><path d="M.941 4.523a.75.75 0 1 1 1.06-1.06l3.006 3.005 3.005-3.005a.75.75 0 1 1 1.06 1.06l-3.549 3.55a.75.75 0 0 1-1.168-.136L.941 4.523z"></path></svg></button><div class="ck ck-reset ck-dropdown__panel ck-dropdown__panel_se"></div></div><span class="ck ck-toolbar__separator"></span><button class="ck ck-button ck-off" type="button" tabindex="-1" aria-labelledby="ck-editor__aria-label_ee29203f2f0512624f316aaafacddef5d" aria-pressed="false" data-cke-tooltip-text="Bulleted List" data-cke-tooltip-position="s"><svg class="ck ck-icon ck-reset_all-excluded ck-icon_inherit-color ck-button__icon" viewBox="0 0 20 20"><path d="M7 5.75c0 .414.336.75.75.75h9.5a.75.75 0 1 0 0-1.5h-9.5a.75.75 0 0 0-.75.75zm-6 0C1 4.784 1.777 4 2.75 4c.966 0 1.75.777 1.75 1.75 0 .966-.777 1.75-1.75 1.75C1.784 7.5 1 6.723 1 5.75zm6 9c0 .414.336.75.75.75h9.5a.75.75 0 1 0 0-1.5h-9.5a.75.75 0 0 0-.75.75zm-6 0c0-.966.777-1.75 1.75-1.75.966 0 1.75.777 1.75 1.75 0 .966-.777 1.75-1.75 1.75-.966 0-1.75-.777-1.75-1.75z"></path></svg><span class="ck ck-button__label" id="ck-editor__aria-label_ee29203f2f0512624f316aaafacddef5d">Bulleted List</span></button><button class="ck ck-button ck-off" type="button" tabindex="-1" aria-labelledby="ck-editor__aria-label_ee74a241f9a43c212ba17bdd03b4be25f" aria-pressed="false" data-cke-tooltip-text="Numbered List" data-cke-tooltip-position="s"><svg class="ck ck-icon ck-reset_all-excluded ck-icon_inherit-color ck-button__icon" viewBox="0 0 20 20"><path d="M7 5.75c0 .414.336.75.75.75h9.5a.75.75 0 1 0 0-1.5h-9.5a.75.75 0 0 0-.75.75zM3.5 3v5H2V3.7H1v-1h2.5V3zM.343 17.857l2.59-3.257H2.92a.6.6 0 1 0-1.04 0H.302a2 2 0 1 1 3.995 0h-.001c-.048.405-.16.734-.333.988-.175.254-.59.692-1.244 1.312H4.3v1h-4l.043-.043zM7 14.75a.75.75 0 0 1 .75-.75h9.5a.75.75 0 1 1 0 1.5h-9.5a.75.75 0 0 1-.75-.75z"></path></svg><span class="ck ck-button__label" id="ck-editor__aria-label_ee74a241f9a43c212ba17bdd03b4be25f">Numbered List</span></button><button class="ck ck-button ck-disabled ck-off" type="button" tabindex="-1" aria-labelledby="ck-editor__aria-label_ee81fd6626724d42f140f70c757262bc3" aria-disabled="true" data-cke-tooltip-text="Decrease indent" data-cke-tooltip-position="s"><svg class="ck ck-icon ck-reset_all-excluded ck-icon_inherit-color ck-button__icon" viewBox="0 0 20 20"><path d="M2 3.75c0 .414.336.75.75.75h14.5a.75.75 0 1 0 0-1.5H2.75a.75.75 0 0 0-.75.75zm5 6c0 .414.336.75.75.75h9.5a.75.75 0 1 0 0-1.5h-9.5a.75.75 0 0 0-.75.75zM2.75 16.5h14.5a.75.75 0 1 0 0-1.5H2.75a.75.75 0 1 0 0 1.5zm1.618-9.55L.98 9.358a.4.4 0 0 0 .013.661l3.39 2.207A.4.4 0 0 0 5 11.892V7.275a.4.4 0 0 0-.632-.326z"></path></svg><span class="ck ck-button__label" id="ck-editor__aria-label_ee81fd6626724d42f140f70c757262bc3">Decrease indent</span></button><button class="ck ck-button ck-disabled ck-off" type="button" tabindex="-1" aria-labelledby="ck-editor__aria-label_e8fc287402d91750869b309fc846b6e36" aria-disabled="true" data-cke-tooltip-text="Increase indent" data-cke-tooltip-position="s"><svg class="ck ck-icon ck-reset_all-excluded ck-icon_inherit-color ck-button__icon" viewBox="0 0 20 20"><path d="M2 3.75c0 .414.336.75.75.75h14.5a.75.75 0 1 0 0-1.5H2.75a.75.75 0 0 0-.75.75zm5 6c0 .414.336.75.75.75h9.5a.75.75 0 1 0 0-1.5h-9.5a.75.75 0 0 0-.75.75zM2.75 16.5h14.5a.75.75 0 1 0 0-1.5H2.75a.75.75 0 1 0 0 1.5zM1.632 6.95 5.02 9.358a.4.4 0 0 1-.013.661l-3.39 2.207A.4.4 0 0 1 1 11.892V7.275a.4.4 0 0 1 .632-.326z"></path></svg><span class="ck ck-button__label" id="ck-editor__aria-label_e8fc287402d91750869b309fc846b6e36">Increase indent</span></button></div></div></div></div></div><div class="ck ck-editor__main" role="presentation"><div class="ck-blurred ck ck-content ck-editor__editable ck-rounded-corners ck-editor__editable_inline" lang="en" dir="ltr" role="textbox" aria-label="Editor editing area: main" contenteditable="true" style="height: 180px;"><p><br data-cke-filler="true"></p></div></div></div>
                                            </div>
                                        </div>
                                    </div><!--end row-->
                                </div>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xxl-4">
                                            <h5 class="card-title mb-3">Images</h5>
                                            <p class="text-muted">Product Information refers to any information held by an organization about the products it produces, buys, sells or distributes.</p>
                                        </div><!--end col-->
                                        <div class="col-xxl-8">
                                            <div class="mb-3">
                                                <label class="form-label">Product Images <span class="text-danger">*</span></label>
                                                <div class="dropzone text-center dz-clickable">
                                                    
                                                    <div class="dz-message needsclick">
                                                        <div class="mb-3">
                                                            <i class="display-4 text-muted ri-upload-cloud-2-fill"></i>
                                                        </div>
                                                
                                                        <h4>Drop product images here or click to upload.</h4>
                                                    </div>
                                                </div>
                                                
                                                <ul class="list-unstyled mb-0" id="dropzone-preview">
                                                    
                                                </ul>
                                                <!-- end dropzon-preview -->
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Gallery Images <span class="text-danger">*</span></label>
                                                <div class="dropzone text-center dz-clickable" id="dropzone">
                                                    
                                                    <div class="dz-message needsclick">
                                                        <div class="mb-3">
                                                            <i class="display-4 text-muted ri-upload-cloud-2-fill"></i>
                                                        </div>
                                            
                                                        <h4>Drop gallery images here or click to upload.</h4>
                                                    </div>
                                                </div>
                                            
                                                <ul class="list-unstyled mb-0" id="dropzone-preview2">
                                                    
                                                </ul>
                                                <!-- end dropzon-preview -->
                                            </div>
                                        </div>
                                    </div><!--end row-->
                                </div>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xxl-4">
                                            <h5 class="card-title mb-3">General Info</h5>
                                            <p class="text-muted mb-0">An informational product can be a digital book (or e-book), a digital report, a white paper, a piece of software, audio or video files, a website, an e-zine or a newsletter.</p>
                                        </div><!--end col-->
                                        <div class="col-xxl-8">
                                            <div class="row gy-3">
                                                <div class="col-lg-6">
                                                    <div>
                                                        <label for="manufacturer-name-input" class="form-label">Manufacturer Name</label>
                                                        <input type="text" class="form-control" id="manufacturer-name-input" placeholder="Enter manufacturer name" required="">
                                                    </div>
                                                </div><!--end col-->
                                                <div class="col-lg-6">
                                                    <div>
                                                        <label class="form-label" for="manufacturer-brand-input">Manufacturer Brand</label>
                                                        <input type="text" class="form-control" id="manufacturer-brand-input" placeholder="Enter manufacturer brand">
                                                    </div>
                                                </div><!--end col-->
                                                <div class="col-lg-4">
                                                    <div>
                                                        <label for="productStocks" class="form-label">Stocks <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="productStocks" placeholder="Stocks" required="">
                                                    </div>
                                                </div><!--end col-->
                                                <div class="col-lg-4">
                                                    <div>
                                                        <label class="form-label" for="product-price-input">Price</label>
                                                        <div class="input-group has-validation">
                                                            <span class="input-group-text" id="product-price-addon">$</span>
                                                            <input type="text" class="form-control" id="product-price-input" placeholder="Enter price" aria-label="Price" aria-describedby="product-price-addon" required="">
                                                            <div class="invalid-feedback">Please Enter a product price.</div>
                                                        </div>
                                                    </div>
                                                </div><!--end col-->
                                                <div class="col-lg-4">
                                                    <div>
                                                        <label class="form-label" for="product-discount-input">Discount</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text" id="product-discount-addon">%</span>
                                                            <input type="text" class="form-control" id="product-discount-input" placeholder="Enter discount" aria-label="discount" aria-describedby="product-discount-addon">
                                                        </div>
                                                    </div>
                                                </div><!--end col-->
                                                <div class="col-lg-6">
                                                    <div>
                                                        <label for="choices-publish-status-input" class="form-label">Status</label>
                                                        <div class="choices" data-type="select-one" tabindex="0" role="listbox" aria-haspopup="true" aria-expanded="false"><div class="choices__inner"><select class="form-select choices__input" id="choices-publish-status-input" data-choices="" data-choices-search-false="" hidden="" tabindex="-1" data-choice="active"><option value="Published" data-custom-properties="[object Object]">Published</option></select><div class="choices__list choices__list--single"><div class="choices__item choices__item--selectable" data-item="" data-id="1" data-value="Published" data-custom-properties="[object Object]" aria-selected="true">Published</div></div></div><div class="choices__list choices__list--dropdown" aria-expanded="false"><div class="choices__list" role="listbox"><div id="choices--choices-publish-status-input-item-choice-1" class="choices__item choices__item--choice choices__item--selectable is-highlighted" role="option" data-choice="" data-id="1" data-value="Draft" data-select-text="Press to select" data-choice-selectable="" aria-selected="true">Draft</div><div id="choices--choices-publish-status-input-item-choice-2" class="choices__item choices__item--choice is-selected choices__item--selectable" role="option" data-choice="" data-id="2" data-value="Published" data-select-text="Press to select" data-choice-selectable="">Published</div><div id="choices--choices-publish-status-input-item-choice-3" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="3" data-value="Scheduled" data-select-text="Press to select" data-choice-selectable="">Scheduled</div></div></div></div>
                                                    </div>
                                                </div><!--end col-->
                                                <div class="col-lg-6">
                                                    <div>
                                                        <label for="choices-publish-visibility-input" class="form-label">Visibility</label>
                                                        <div class="choices" data-type="select-one" tabindex="0" role="listbox" aria-haspopup="true" aria-expanded="false"><div class="choices__inner"><select class="form-select choices__input" id="choices-publish-visibility-input" data-choices="" data-choices-search-false="" hidden="" tabindex="-1" data-choice="active"><option value="Public" data-custom-properties="[object Object]">Public</option></select><div class="choices__list choices__list--single"><div class="choices__item choices__item--selectable" data-item="" data-id="1" data-value="Public" data-custom-properties="[object Object]" aria-selected="true">Public</div></div></div><div class="choices__list choices__list--dropdown" aria-expanded="false"><div class="choices__list" role="listbox"><div id="choices--choices-publish-visibility-input-item-choice-1" class="choices__item choices__item--choice choices__item--selectable is-highlighted" role="option" data-choice="" data-id="1" data-value="Hidden" data-select-text="Press to select" data-choice-selectable="" aria-selected="true">Hidden</div><div id="choices--choices-publish-visibility-input-item-choice-2" class="choices__item choices__item--choice is-selected choices__item--selectable" role="option" data-choice="" data-id="2" data-value="Public" data-select-text="Press to select" data-choice-selectable="">Public</div></div></div></div>
                                                    </div>
                                                </div><!--end col-->
                                            </div><!--end row-->
                                        </div>
                                    </div><!--end row-->
                                </div>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->

                    <div class="hstack gap-2 justify-content-end mb-3">
                        <button class="btn btn-danger"><i class="ph-x align-middle"></i> Cancel</button>
                        <button class="btn btn-primary">Submit</button>
                    </div>

                </div>
                
<x-admin.footer />