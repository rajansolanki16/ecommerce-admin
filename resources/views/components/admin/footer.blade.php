<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <script>
                    document.write(new Date().getFullYear())
                </script> © Knight Oasis .
            </div>
            <div class="col-sm-6">
                <div class="text-sm-end d-none d-sm-block">
                    Design & Develop by Vivid
                </div>
            </div>
        </div>
    </div>
</footer>
<script src="{{ publicPath('admin/libs/list.js/list.min.js') }}"></script>
<script src="{{ publicPath('admin/libs/list.pagination.js/list.pagination.min.js') }}"></script>
<script src="{{ publicPath('admin/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ publicPath('admin/libs/dropzone/dropzone-min.js') }}"></script>
{{-- <script src="{{ publicPath('admin/js/pages/ecommerce-product-list.init.js') }}"></script> --}}
<script src="{{ publicPath('admin/js/app.js') }}?version={{ rand(10,99) }}.{{ rand(10,99) }}.{{ rand(100,999) }}"></script>
<script src="{{ publicPath('assets/js/admin-script.js') }}?version={{ rand(10,99) }}.{{ rand(10,99) }}.{{ rand(100,999) }}"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="{{ publicPath("admin/js/pages/datatables.init.js") }}"></script>
</div>
</div>
</body>
</html>
