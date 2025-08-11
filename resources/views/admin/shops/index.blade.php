@extends('layouts.admin')

@section('content')
    <div class="container">

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center bg-white">
                <h1>Daftar Toko</h1>
                <a href="{{ route('shops.create') }}" class="btn btn-primary">Add Shop</a>
            </div>

            <table class="table mt-3">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Province</th>
                        <th>City</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($shops as $shop)
                        <tr>
                            <td>{{ $shop->name }}</td>
                            <td>{{ $shop->province->name }}</td>
                            <td>{{ $shop->city->name }}</td>
                            <td>{{ $shop->phone }}</td>
                            <td>{{ $shop->email }}</td>
                            <td>
                                <a href="{{ route('shops.edit', $shop->id) }}" class="btn btn-sm btn-warning">Edit</a>

                                <form action="{{ route('shops.destroy', $shop->id) }}" method="POST"
                                    class="d-inline delete-form">
                                    @csrf @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-danger btn-delete"
                                        data-name="{{ $shop->name }}">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No shops found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>
@endsection

@pushOnce('scripts')
    {{-- Include SweetAlert --}}
    <script>
        document.querySelectorAll('.btn-delete').forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault();

                const form = this.closest('form');
                const shopName = this.getAttribute('data-name');

                Swal.fire({
                    title: 'Are you sure?',
                    text: `You are about to delete shop "${shopName}". This action cannot be undone.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpushOnce
