@extends('layouts.base_admin.base_dashboard')
@section('judul', 'Tambah Pemasukan')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Pemasukan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">Beranda</a>
                        </li>
                        <li class="breadcrumb-item active">Tambah Pemasukan</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('pemasukan.add') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nama_kategori">Nama Kategori Pemasukan</label>
                        <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" required>
                    </div>
                    <div class="form-group">
                        <label for="rekening">Pilih Rekening</label>
                        <select class="form-control" id="rekening" name="rekening" required>
                            <option value="BCA">BCA (Bank Central Asia)</option>
                            <option value="BRI">BRI (Bank Rakyat Indonesia)</option>
                            <option value="BNI">BNI (Bank Negara Indonesia)</option>
                            <option value="Mandiri">Mandiri (Bank Mandiri)</option>
                            <option value="CIMB">CIMB Niaga</option>
                            <option value="Maybank">Maybank Indonesia</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jumlah_pemasukan">Jumlah Pemasukan</label>
                        <input type="text" class="form-control" id="jumlah_pemasukan" name="jumlah_pemasukan" required>
                    </div>
                    <div class="form-group">
                        <label for="catatan_pemasukan">Catatan Pemasukan</label>
                        <textarea class="form-control" id="catatan_pemasukan" name="catatan_pemasukan" rows="4" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                    </div>
                    <div class="form-group">
                        <label for="jam">Jam</label>
                        <input type="time" class="form-control" id="jam" name="jam" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </section>
@endsection
