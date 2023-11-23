<!-- resources/views/page/admin/keuangan/hutang/ubahHutang.blade.php -->

@extends('layouts.base_admin.base_dashboard')
@section('judul', 'Edit Hutang')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Hutang</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">Beranda</a>
                        </li>
                        <li class="breadcrumb-item active">Edit Hutang</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('hutang.edit', ['id' => $hutang->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="rekening">Rekening</label>
                        <input type="text" class="form-control" id="rekening" name="rekening" value="{{ $hutang->rekening }}" required>
                    </div>
                    <div class="form-group">
                        <label for="jumlah_hutang">Jumlah Hutang</label>
                        <input type="text" class="form-control" id="jumlah_hutang" name="jumlah_hutang" value="{{ $hutang->jumlah_hutang }}" required>
                    </div>
                    <div class="form-group">
                        <label for="nama_pemberi_hutang">Nama Pemberi Hutang</label>
                        <input type="text" class="form-control" id="nama_pemberi_hutang" name="nama_pemberi_hutang" value="{{ $hutang->nama_pemberi_hutang }}" required>
                    </div>
                    <div class="form-group">
                        <label for="catatan_hutang">Catatan Hutang</label>
                        <textarea class="form-control" id="catatan_hutang" name="catatan_hutang" required>{{ $hutang->catatan_hutang }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_hutang">Tanggal Hutang</label>
                        <input type="date" class="form-control" id="tanggal_hutang" name="tanggal_hutang" value="{{ $hutang->tanggal_hutang }}" required>
                    </div>
                    <div class="form-group">
                        <label for="jam_hutang">Jam Hutang</label>
                        <input type="time" class="form-control" id="jam_hutang" name="jam_hutang" value="{{ $hutang->jam_hutang }}" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_jatuh_tempo">Tanggal Jatuh Tempo</label>
                        <input type="date" class="form-control" id="tanggal_jatuh_tempo" name="tanggal_jatuh_tempo" value="{{ $hutang->tanggal_jatuh_tempo }}" required>
                    </div>
                    <div class="form-group">
                        <label for="jam_jatuh_tempo">Jam Jatuh Tempo</label>
                        <input type="time" class="form-control" id="jam_jatuh_tempo" name="jam_jatuh_tempo" value="{{ $hutang->jam_jatuh_tempo }}" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="Belum Lunas" {{ $hutang->status == 'Belum Lunas' ? 'selected' : '' }}>
                                Belum Lunas
                            </option>
                            <option value="Sudah Lunas" {{ $hutang->status == 'Sudah Lunas' ? 'selected' : '' }}>
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

