@extends('layouts.base_admin.base_dashboard')
@section('judul', 'Tambah Pengeluaran')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Pengeluaran</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">Beranda</a>
                        </li>
                        <li class="breadcrumb-item active">Tambah Pengeluaran</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('pengeluaran.add') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nama_kategori">Nama Kategori</label>
                        <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" required>
                    </div>
                    <div class="form-group">
                        <label for="nama_pengeluaran">Nama Pengeluaran</label>
                        <input type="text" class="form-control" id="nama_pengeluaran" name="nama_pengeluaran" required>
                    </div>
                    <div class="form-group">
                        <label for="tujuan_transaksi">Tujuan Transaksi</label>
                        <input type="text" class="form-control" id="tujuan_transaksi" name="tujuan_transaksi" required>
                    </div>
                    <div class="form-group">
                        <label for="frekuensi">Frekuensi/Jumlah Barang</label>
                        <input type="text" class="form-control" id="frekuensi" name="frekuensi" required>
                    </div>
                    <div class="form-group">
                        <label for="harga_peritem">Harga Peritem</label>
                        <input type="text" class="form-control" id="harga_peritem" name="harga_peritem" required>
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
