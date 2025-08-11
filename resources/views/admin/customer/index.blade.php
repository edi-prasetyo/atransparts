@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-start">
            <h2>Daftar Pelanggan</h2>
            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createCustomerModal">Add
                Pelanggan</button>
        </div>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Phone</th>
                        <th>Langganan Toko</th>
                        <th>total Order</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                        <tr>
                            <td>{{ $customer->full_name }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>{{ $customer->shop->name ?? '' }}</td>
                            <td>{{ $customer->orders_count ?? '' }}</td>
                            <td>
                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#editCustomerModal{{ $customer->id }}">Edit</button>

                                <form action="{{ route('customers.destroy', $customer->id) }}" method="POST"
                                    class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-danger btn-delete"
                                        data-name="{{ $customer->full_name }}">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editCustomerModal{{ $customer->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="{{ route('customers.update', $customer->id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Customer</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label>Full Name</label>
                                                <input type="text" name="full_name" class="form-control"
                                                    value="{{ $customer->full_name }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label>Phone</label>
                                                <input type="text" name="phone" class="form-control"
                                                    value="{{ $customer->phone }}">
                                            </div>
                                            <div class="mb-3">
                                                <label>Address</label>
                                                <textarea name="address" class="form-control">{{ $customer->address }}</textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancel</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
            <div class="card-footer bg-white">
                {{ $customers->links() }}
            </div>
        </div>



    </div>

    <!-- Create Modal -->
    <div class="modal fade" id="createCustomerModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('customers.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Customer</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Full Name</label>
                            <input type="text" name="full_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Phone</label>
                            <input type="text" name="phone" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Address</label>
                            <textarea name="address" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Create</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@pushOnce('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.btn-delete').forEach(button => {
                button.addEventListener('click', function() {
                    const form = this.closest('form');
                    const name = this.getAttribute('data-name') || 'this item';

                    Swal.fire({
                        title: `Delete "${name}"?`,
                        text: "This action cannot be undone.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endPushOnce
