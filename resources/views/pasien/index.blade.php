@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Data Pasien</h2>
        <a href="{{ route('pasien.create') }}" class="btn btn-primary">Tambah Pasien</a>
    </div>

    <div class="row mb-4">
        <div class="col-md-4">
            <label>Filter Rumah Sakit</label>
            <select id="filter_rs" class="form-select">
                <option value="">-- Semua Rumah Sakit --</option>
                @foreach($rumahSakits as $rs)
                    <option value="{{ $rs->id }}">{{ $rs->nama }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div id="table-container">
        @include('pasien.partials.table')
    </div>

    {{ $pasien->links() }}
@endsection

@push('scripts')
    <script>
        $('#filter_rs').on('change', function () {
            const rsId = $(this).val();

            $.ajax({
                url: '/pasien/filter',
                data: { rumah_sakit_id: rsId },
                success: function (data) {
                    $('#table-container').html(data);
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                    alert('Gagal filter: ' + xhr.status);
                }
            });
        });

        $(document).on('click', '.delete-pasien', function () {
            if (!confirm('Hapus pasien ' + $(this).data('nama') + ' ?')) return;

            const id = $(this).data('id');

            $.ajax({
                url: `/pasien/${id}`,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    _method: 'DELETE'
                },
                success: function () {
                    location.reload();
                }
            });
        });
    </script>
@endpush
