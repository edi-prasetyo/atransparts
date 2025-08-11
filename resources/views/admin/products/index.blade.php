@extends('layouts.admin')

@section('content')
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between align-items-start">
                <h4 class="my-auto">Products</h4>
                <a href="{{ url('admin/products/create') }}" class="btn btn-success text-white">Add Product</a>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th scope="col">Product</th>
                            <th scope="col">status</th>
                            <th width="30%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->slug }}</td>
                                <td>
                                    @if ($product->status == 1)
                                        <span class="badge bg-light-success text-success">Active</span>
                                    @else
                                        <span class="badge bg-light-danger text-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('products.parts', $product->id) }}"
                                        class="btn btn-sm btn-info text-white"><i
                                            class="fa-solid fa-screwdriver-wrench"></i>
                                        Part Number</a>
                                    <a href="{{ route('products.show', $product->id) }}"
                                        class="btn btn-sm btn-primary text-white"><i class="fa-solid fa-language"></i>
                                        Translate</a>
                                    <a href="{{ route('products.edit', $product->id) }}"
                                        class="btn btn-sm btn-primary text-white">Edit</a>
                                    <form id="delete-form-{{ $product->id }}"
                                        action="{{ route('products.destroy', $product->id) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDelete({{ $product->id }})"
                                            class="btn btn-sm btn-danger text-white">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No Product Available </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
            <div class="card-body">
                <div class="col-md-12 mt-5">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@pushOnce('scripts')
    <script>
        function confirmDelete(productId) {
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data produk akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // submit form delete
                    document.getElementById('delete-form-' + productId).submit();
                }
            });
        }
    </script>
@endPushOnce
