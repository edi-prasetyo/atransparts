@extends('layouts.admin')

@section('content')
    <div class="container">


        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center bg-white">
                <h4>Province: {{ $province->name }}</h4>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCityModal">
                    + Tambah Kota
                </button>
                <!-- Modal -->
                <div class="modal fade" id="addCityModal" tabindex="-1" aria-labelledby="addCityModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ route('provinces.cities.store', $province->id) }}" method="POST">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addCityModalLabel">Tambah Kota Baru</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="cityName" class="form-label">Nama Kota</label>
                                        <input type="text" class="form-control" id="cityName" name="name" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th width="200px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cities as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>
                                <!-- Edit button -->
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#editCityModal{{ $item->id }}">
                                    Edit
                                </button>

                                <!-- Delete button -->
                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteCityModal{{ $item->id }}">
                                    Delete
                                </button>
                            </td>
                        </tr>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editCityModal{{ $item->id }}" tabindex="-1"
                            aria-labelledby="editCityModalLabel{{ $item->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="{{ route('provinces.cities.update', [$province->id, $item->id]) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editCityModalLabel{{ $item->id }}">Edit Kota
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="name{{ $item->id }}" class="form-label">Nama Kota</label>
                                                <input type="text" class="form-control" id="name{{ $item->id }}"
                                                    name="name" value="{{ $item->name }}" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Batal</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteCityModal{{ $item->id }}" tabindex="-1"
                            aria-labelledby="deleteCityModalLabel{{ $item->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="{{ route('provinces.cities.destroy', [$province->id, $item->id]) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteCityModalLabel{{ $item->id }}">Hapus Kota
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah kamu yakin ingin menghapus kota <strong>{{ $item->name }}</strong>?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Batal</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    @empty
                        <tr>
                            <td colspan="3" class="text-center">No cities found for this province.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
