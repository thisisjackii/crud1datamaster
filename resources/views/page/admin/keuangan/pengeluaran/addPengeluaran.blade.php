@extends('layouts.base_admin.base_dashboard') @section('judul', 'Tambah Pengeluaran')
@section('content')
<!-- Content Header (Page header) -->
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
    <!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    @if(session('status'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
        {{ session('status') }}
    </div>
    @endif
    <form method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Informasi Pengeluaran</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputName">Nama Kategori</label>
                            <input type="text" id="inputName" name="nama_kategori"
                                class="form-control @error('nama_kategori') is-invalid @enderror"
                                placeholder="Masukkan Nama" value="{{ old('nama_kategori') }}" required="required"
                                autocomplete="nama_kategori">
                            @error('nama_kategori')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="inputName">Nama Pengeluaran</label>
                            <input type="text" id="inputName" name="nama_pengeluaran"
                                class="form-control @error('nama_pengeluaran') is-invalid @enderror"
                                placeholder="Masukkan Nama Pengeluaran" value="{{ old('nama_pengeluaran') }}" required="required"
                                autocomplete="nama_pengeluaran">
                            @error('nama_pengeluaran')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="inputName">Tujuan Transaksi</label>
                            <input type="text" id="inputName" name="tujuan_transaksi"
                                class="form-control @error('tujuan_transaksi') is-invalid @enderror"
                                placeholder="Masukkan Tujuan Transaksi" value="{{ old('tujuan_transaksi') }}" required="required"
                                autocomplete="tujuan_transaksi">
                            @error('tujuan_transaksi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="inputName">Kuantitas</label>
                            <input type="text" id="inputName" name="kuantitas"
                                class="form-control @error('kuantitas') is-invalid @enderror"
                                placeholder="Masukkan Kuantitas" value="{{ old('kuantitas') }}" required="required"
                                autocomplete="kuantitas">
                            @error('kuantitas')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="inputName">Harga Per item</label>
                            <input type="text" id="inputName" name="harga_peritem"
                                class="form-control @error('harga_peritem') is-invalid @enderror"
                                placeholder="Masukkan Harga Per item" value="{{ old('harga_peritem') }}" required="required"
                                autocomplete="harga_peritem">
                            @error('harga_peritem')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                       
                        <div class="form-group">
                            <label for="inputName">Tanggal</label>
                            <input type="date" id="inputName" name="tanggal"
                                class="form-control @error('tanggal') is-invalid @enderror"
                                placeholder="Masukkan Tanggal" value="{{ old('tanggal') }}" required="required"
                                autocomplete="tanggal">
                            @error('tanggal')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputName">Jam</label>
                            <input type="time" id="inputName" name="jam"
                                class="form-control @error('jam') is-invalid @enderror" placeholder="Masukkan Jam"
                                value="{{ old('jam') }}" required="required" autocomplete="jam">
                            @error('jam')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <a href="{{ route('home') }}" class="btn btn-secondary">Cancel</a>
                        <input type="submit" value="Tambah Pemasukan" class="btn btn-success float-right">
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </form>
</section>
<!-- /.content -->

@endsection @section('script_footer')
<script>
    inputFoto.onchange = evt => {
        const [file] = inputFoto.files
        if (file) {
            prevImg.src = URL.createObjectURL(file)
        }
    }
</script>
@endsection