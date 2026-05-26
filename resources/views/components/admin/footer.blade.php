<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <script>
                    document.write(new Date().getFullYear())
                </script> 
            </div>
            <div class="col-sm-6">
                <div class="text-sm-end d-none d-sm-block">
                    Design & Develop by Vivid
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Core JS -->
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="{{ asset('admin/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('admin/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/js/admin-script.js') }}"></script>
<script src="{{ asset('admin/js/app.js') }}"></script>

<!-- Plugins -->
<script src="{{ asset('admin/libs/list.js/list.min.js') }}"></script>
<script src="{{ asset('admin/libs/list.pagination.js/list.pagination.min.js') }}"></script>
<script src="{{ asset('admin/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('admin/libs/dropzone/dropzone-min.js') }}"></script>
<script src="{{ asset('admin/libs/flatpickr/flatpickr.min.js') }}"></script>


<!-- DataTables -->

<script src="{{ asset('admin/js/pages/datatables.init.js') }}"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script>

    $(document).ready(function () {

        $('#categoryTable').DataTable({

            responsive: true,

            pageLength: 10,

            lengthMenu: [
                [10, 25, 50, 100],
                [10, 25, 50, 100]
            ],

            dom:
                "<'row align-items-center mb-3'<'col-md-6'B><'col-md-6'f>>" +
                "<'row'<'col-12'tr>>" +
                "<'row align-items-center mt-3'<'col-md-5'i><'col-md-7'p>>",

            buttons: [

                {
                    extend: 'copy',
                    className: 'btn btn-light btn-sm'
                },

                {
                    extend: 'excel',
                    className: 'btn btn-success btn-sm'
                },

                {
                    extend: 'pdf',
                    className: 'btn btn-danger btn-sm'
                },

                {
                    extend: 'print',
                    className: 'btn btn-primary btn-sm'
                }

            ],

            language: {

                search: "",
                searchPlaceholder: "Search categories...",

                paginate: {
                    previous: "<i class='ri-arrow-left-s-line'></i>",
                    next: "<i class='ri-arrow-right-s-line'></i>"
                }

            }

        });

    });

</script>
<x-admin.toast />


@stack('scripts')

</div>
</div>
</body>
</html>
