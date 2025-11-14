<table class="table table-hover">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nama Pasien</th>
            <th>Alamat</th>
            <th>No Telepon</th>
            <th>Rumah Sakit</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($pasien as $pasien)
        <tr>
            <td>{{ $pasien->id }}</td>
            <td>{{ $pasien->nama }}</td>
            <td>{{ $pasien->alamat }}</td>
            <td>{{ $pasien->telepon }}</td>
            <td>{{ $pasien->rumahSakit->nama ?? '-' }}</td>
            <td>
                <a href="{{ route('pasien.edit', $pasien) }}" class="btn btn-sm btn-warning">Edit</a>
                <button class="btn btn-sm btn-danger delete-pasien" data-id="{{ $pasien->id }}" data-nama="{{ $pasien->nama }}">Hapus</button>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center">Tidak ada data</td>
        </tr>
        @endforelse
    </tbody>
</table>
