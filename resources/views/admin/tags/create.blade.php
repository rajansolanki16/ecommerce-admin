<x-admin.header :title="'product Tags create'" />
<!--datatable css-->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css">

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <div class="flex-grow-1">
                    <h5 class="mb-4 card-title">{{ __('tags.Tag_Management') }}</h5>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0 card-title">{{ __('tags.Create_Tag') }}</h4>
            </div>

            <div class="card-body">
                <p class="text-muted">{{ __('tags.Tag_Description') }}</p>
                <form action="{{ route('tags.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="tags" class="form-label">{{ __('tags.Tag_Title') }}<span class="text-danger">{{ __('tags.required_mark') }}</span></label>
                        <input type="text" name="name" id="tags" class="form-control @error('name') is-invalid @enderror" placeholder="Enter tag title">

                        @error('name')
                        <div class="invalid-response" style="display:flex">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-1 text-end">
                        <button type="submit" class="btn btn-primary">{{ __('tags.Create_Button') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<x-admin.footer />