{{-- resources/views/admin/brands/index.blade.php --}}

<x-admin.header :title="'Brands'" />

<x-page-title
    title="Brands"
    :breadcrumbs="['Admin', 'Catalog', 'Brands']"
/>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0 card-title">{{ __('brand.Brands_List') }}</h4>
                <a href="{{ route('brands.create') }}" class="btn btn-primary">
                    <i class="ri-add-line align-middle me-1"></i>{{ __('brand.Add_Brand') }}
                </a>
            </div>
            <div class="card-body">
                <p class="text-muted mb-4">{{ __('brand.Brand_Description') }}</p>

                @if($brands->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>{{ __('brand.Name') }}</th>
                                <th>{{ __('brand.Slug') }}</th>
                                <th>{{ __('brand.Status') }}</th>
                                <th>{{ __('brand.Created') }}</th>
                                <th>{{ __('brand.Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($brands as $brand)
                            <tr>
                                <td>{{ $brand->id }}</td>
                                <td>{{ $brand->name }}</td>
                                <td><span class="badge bg-info">{{ $brand->slug }}</span></td>
                                <td>
                                    @if($brand->is_active)
                                        <span class="badge bg-success">{{ __('brand.Active') }}</span>
                                    @else
                                        <span class="badge bg-danger">{{ __('brand.Inactive') }}</span>
                                    @endif
                                </td>
                                <td>{{ $brand->created_at->format('M d, Y') }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-subtle-secondary btn-sm btn-icon" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('brands.edit', $brand->id) }}">
                                                    <i class="ri-edit-line align-middle me-1"></i>{{ __('brand.Edit') }}
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="javascript:void(0);" onclick="setDeleteFormAction(this)" data-delete-url="{{ route('brands.destroy', $brand->id) }}">
                                                    <i class="ri-delete-bin-line align-middle me-1"></i>{{ __('brand.Delete') }}
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    {{ __('brand.No_Brands_Found') }}
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center py-5">
                    <p class="text-muted mb-3">{{ __('brand.No_Brands_Yet') }}</p>
                    <a href="{{ route('brands.create') }}" class="btn btn-primary">
                        <i class="ri-add-line align-middle me-1"></i>{{ __('brand.Create_First_Brand') }}
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteRecordModal" tabindex="-1" role="dialog" aria-labelledby="deleteRecordLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteRecordLabel">{{ __('brand.Confirm_Delete') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ __('brand.Delete_Confirm_Message') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ __('brand.Cancel') }}</button>
                <form id="deleteForm" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{ __('brand.Delete') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>

<x-admin.footer />

@push('scripts')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
@endpush
