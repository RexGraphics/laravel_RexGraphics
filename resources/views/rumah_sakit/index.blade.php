@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Data Rumah Sakit</h2>
    <a href="{{ route('rumah-sakit.create') }}" class="btn btn-primary">Tambah</a>
</div>

<table class="table table-hover">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Email</th>
            <th>Telepon</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($rumahSakits as $rs)
        <tr>
            <td>{{ $rs->id }}</td>
            <td>{{ $rs->nama }}</td>
            <td>{{ $rs->alamat }}</td>
            <td>{{ $rs->email }}</td>
            <td>{{ $rs->telepon }}</td>
            <td>
                <a href="{{ route('rumah-sakit.edit', $rs) }}" class="btn btn-sm btn-warning">Edit</a>
                <button class="btn btn-sm btn-danger delete-btn" data-id="{{ $rs->id }}" data-name="{{ $rs->nama }}">Hapus</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $rumahSakits->links() }}
@endsection

@push('scripts')
<script>
$(document).on('click', '.delete-btn', function () {
    if (!confirm('Yakin hapus Rumah Sakit "' + $(this).data('name') + '" ?')) return;

    const id = $(this).data('id');
    $.ajax({
        url: `/rumah-sakit/${id}`,
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            _method: 'DELETE'
        },
        success: function () {
            location.reload();
        },
        error: function () {
            alert('Gagal menghapus');
        }
    });
});
</script>
@endpush
