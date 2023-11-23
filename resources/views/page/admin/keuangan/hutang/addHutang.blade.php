<!-- resources/views/page/admin/keuangan/hutang/addHutang.blade.php -->

@extends('layouts.base_admin.base_dashboard') @section('judul', 'Tambah Hutang')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tambah Hutang</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="breadcrumb-item active">Tambah Hutang</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>

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
                        <h3 class="card-title">Informasi Hutang</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputName">Rekening</label>
                            <input type="text" id="inputName" name="rekening"
                                class="form-control @error('rekening') is-invalid @enderror"
                                placeholder="Masukkan Nama Rekening" value="{{ old('rekening') }}" required="required"
                                autocomplete="rekening">
                            @error('rekening')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="inputName">Jumlah Hutang</label>
                            <input type="text" id="inputName" name="jumlah_hutang"
                                class="form-control @error('jumlah_hutang') is-invalid @enderror"
                                placeholder="Masukkan Jumlah Hutang" value="{{ old('jumlah_hutang') }}" required="required"
                                autocomplete="jumlah_hutang">
                            @error('jumlah_hutang')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="inputName">Nama Pemberi Hutang</label>
                            <input type="text" id="inputName" name="nama_pemberi_hutang"
                                class="form-control @error('nama_pemberi_hutang') is-invalid @enderror"
                                placeholder="Masukkan Nama Pemberi Hutang" value="{{ old('nama_pemberi_hutang') }}" required="required"
                                autocomplete="nama_pemberi_hutang">
                            @error('nama_pemberi_hutang')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="inputName">Catatan Hutang</label>
                            <textarea id="inputName" name="catatan_hutang"
                                class="form-control @error('catatan_hutang') is-invalid @enderror"
                                placeholder="Masukkan Catatan Hutang" required="required"
                                autocomplete="catatan_hutang">{{ old('catatan_hutang') }}</textarea>
                            @error('catatan_hutang')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="inputName">Tanggal Hutang</label>
                            <input type="date" id="inputName" name="tanggal_hutang"
                                class="form-control @error('tanggal_hutang') is-invalid @enderror"
                                placeholder="Masukkan Tanggal Hutang" value="{{ old('tanggal_hutang') }}" required="required"
                                autocomplete="tanggal_hutang">
                            @error('tanggal_hutang')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="inputName">Jam Hutang</label>
                            <input type="time" id="inputName" name="jam_hutang"
                                class="form-control @error('jam_hutang') is-invalid @enderror"
                                placeholder="Masukkan Jam Hutang" value="{{ old('jam_hutang') }}" required="required"
                                autocomplete="jam_hutang">
                            @error('jam_hutang')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="inputName">Tanggal Jatuh Tempo</label>
                            <input type="date" id="inputName" name="tanggal_jatuh_tempo"
                                class="form-control @error('tanggal_jatuh_tempo') is-invalid @enderror"
                                placeholder="Masukkan Tanggal Jatuh Tempo" value="{{ old('tanggal_jatuh_tempo') }}" required="required"
                                autocomplete="tanggal_jatuh_tempo">
                            @error('tanggal_jatuh_tempo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="inputName">Jam Jatuh Tempo</label>
                            <input type="time" id="inputName" name="jam_jatuh_tempo"
                                class="form-control @error('jam_jatuh_tempo') is-invalid @enderror"
                                placeholder="Masukkan Jam Jatuh Tempo" value="{{ old('jam_jatuh_tempo') }}" required="required"
                                autocomplete="jam_jatuh_tempo">
                            @error('jam_jatuh_tempo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="inputName">Status</label>
                            <select id="inputName" name="status"
                                class="form-control @error('status') is-invalid @enderror" required>
                                <option value="Belum Lunas" {{ old('status') == 'Belum Lunas' ? 'selected' : '' }}>
                                    Belum Lunas
                                </option>
                                <option value="Sudah Lunas" {{ old('status') == 'Sudah Lunas' ? 'selected' : '' }}>
                                    Sudah Lunas
                                </option>
                            </select>
                            @error('status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <a href="{{ route('home') }}" class="btn btn-secondary">Cancel</a>
                        <input type="submit" value="Tambah Hutang" class="btn btn-success float-right">
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </form>
</section>
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
