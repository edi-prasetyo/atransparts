@extends('layouts.admin')

@section('content')
@endsection

@pushOnce('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: '403 Forbidden',
                text: '{{ $message }}',
                confirmButtonText: 'Kembali',
                allowOutsideClick: false,
                allowEscapeKey: false,
            }).then((result) => {
                if (result.isConfirmed) {
                    window.history.back(); // Redirect ke halaman sebelumnya
                }
            });
        });
    </script>
@endPushOnce
