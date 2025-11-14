@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Tambah Pasien Baru</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('pasien.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nama Pasien <span class="text-danger">*</span></label>
                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                       value="{{ old('nama') }}" placeholder="Nama lengkap pasien" required>
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat <span class="text-danger">*</span></label>
                <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="3"
                          placeholder="Alamat pasien" required>{{ old('alamat') }}</textarea>
                @error('alamat')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">No Telepon <span class="text-danger">*</span></label>
                <input type="text" name="telepon" class="form-control @error('telepon') is-invalid @enderror"
                       value="{{ old('telepon') }}" placeholder="08123456789" required>
                @error('telepon')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Rumah Sakit <span class="text-danger">*</span></label>
                <select name="rumah_sakit_id" class="form-select @error('rumah_sakit_id') is-invalid @enderror" required>
                    <option value="">-- Pilih Rumah Sakit --</option>
                    @foreach($rumahSakits as $rs)
                        <option value="{{ $rs->id }}"
                            {{ old('rumah_sakit_id') == $rs->id ? 'selected' : '' }}>
                            {{ $rs->nama }}
                        </option>
                    @endforeach
                </select>
                @error('rumah_sakit_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('pasien.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
