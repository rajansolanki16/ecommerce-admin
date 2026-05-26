@if(session('success') || session('error') || session('warning') || session('info'))

    <div class="position-fixed top-0 end-0 p-3"
         style="z-index: 1080">

        {{-- Success --}}
        @if(session('success'))
            <div class="toast align-items-center text-bg-success border-0 show mb-2"
                 role="alert">

                <div class="d-flex">
                    <div class="toast-body">
                        <i class="ph-check-circle me-1"></i>
                        {{ session('success') }}
                    </div>

                    <button type="button"
                            class="btn-close btn-close-white me-2 m-auto"
                            data-bs-dismiss="toast">
                    </button>
                </div>
            </div>
        @endif

        {{-- Error --}}
        @if(session('error'))
            <div class="toast align-items-center text-bg-danger border-0 show mb-2"
                 role="alert">

                <div class="d-flex">
                    <div class="toast-body">
                        <i class="ph-x-circle me-1"></i>
                        {{ session('error') }}
                    </div>

                    <button type="button"
                            class="btn-close btn-close-white me-2 m-auto"
                            data-bs-dismiss="toast">
                    </button>
                </div>
            </div>
        @endif

        {{-- Warning --}}
        @if(session('warning'))
            <div class="toast align-items-center text-bg-warning border-0 show mb-2"
                 role="alert">

                <div class="d-flex">
                    <div class="toast-body">
                        <i class="ph-warning me-1"></i>
                        {{ session('warning') }}
                    </div>

                    <button type="button"
                            class="btn-close me-2 m-auto"
                            data-bs-dismiss="toast">
                    </button>
                </div>
            </div>
        @endif

        {{-- Info --}}
        @if(session('info'))
            <div class="toast align-items-center text-bg-info border-0 show mb-2"
                 role="alert">

                <div class="d-flex">
                    <div class="toast-body">
                        <i class="ph-info me-1"></i>
                        {{ session('info') }}
                    </div>

                    <button type="button"
                            class="btn-close me-2 m-auto"
                            data-bs-dismiss="toast">
                    </button>
                </div>
            </div>
        @endif

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const toastElList = [].slice.call(document.querySelectorAll('.toast'));

            toastElList.map(function (toastEl) {

                const toast = new bootstrap.Toast(toastEl, {
                    delay: 3000
                });

                toast.show();

            });
        });
    </script>

@endif