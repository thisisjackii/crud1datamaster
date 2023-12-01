<!-- resources/views/page/admin/keuangan/pinjaman/ubahPinjaman.blade.php -->

@extends('layouts.base_admin.base_dashboard')
@section('judul', 'Edit Pinjaman')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Pinjaman</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">Beranda</a>
                        </li>
                        <li class="breadcrumb-item active">Edit Pinjaman</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('pinjaman.edit', ['id' => $pinjaman->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="rekening">Rekening</label>
                        <input type="text" class="form-control" id="rekening" name="rekening" value="{{ $pinjaman->rekening }}" required>
                    </div>
                    <div class="form-group">
                        <label for="jumlah_pinjaman">Jumlah Pinjaman</label>
                        <input type="text" class="form-control" id="jumlah_pinjaman" name="jumlah_pinjaman" value="{{ $pinjaman->jumlah_pinjaman }}" required>
                    </div>
                    <div class="form-group">
                        <label for="nama_diberi_pinjaman">Nama Pemberi Pinjaman</label>
                        <input type="text" class="form-control" id="nama_diberi_pinjaman" name="nama_diberi_pinjaman" value="{{ $pinjaman->nama_diberi_pinjaman }}" required>
                    </div>
                    <div class="form-group">
                        <label for="catatan_pinjaman">Catatan Pinjaman</label>
                        <textarea class="form-control" id="catatan_pinjaman" name="catatan_pinjaman" required>{{ $pinjaman->catatan_pinjaman }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_pinjaman">Tanggal Pinjaman</label>
                        <input type="date" class="form-control" id="tanggal_pinjaman" name="tanggal_pinjaman" value="{{ $pinjaman->tanggal_pinjaman }}" required>
                    </div>
                    <div class="form-group">
                        <label for="jam_pinjaman">Jam Pinjaman</label>
                        <input type="time" class="form-control" id="jam_pinjaman" name="jam_pinjaman" value="{{ $pinjaman->jam_pinjaman }}" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_jatuh_tempo">Tanggal Jatuh Tempo</label>
                        <input type="date" class="form-control" id="tanggal_jatuh_tempo" name="tanggal_jatuh_tempo" value="{{ $pinjaman->tanggal_jatuh_tempo }}" required>
                    </div>
                    <div class="form-group">
                        <label for="jam_jatuh_tempo">Jam Jatuh Tempo</label>
                        <input type="time" class="form-control" id="jam_jatuh_tempo" name="jam_jatuh_tempo" value="{{ $pinjaman->jam_jatuh_tempo }}" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="Belum Lunas" {{ $pinjaman->status == 'Belum Lunas' ? 'selected' : '' }}>
                                Belum Lunas
                            </option>
                            <option value="Sudah Lunas" {{ $pinjaman->status == 'Sudah Lunas' ? 'selected' : '' }}>
                                Sudah Lunas
                            </option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </section>
@endsection

