@extends('layouts.base_admin.base_dashboard') @section('judul', 'Tambah Pemasukan')
@section('content')
<!-- Content Header (Page header) -->
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
                        <h3 class="card-title">Informasi Pemasukan</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="NamaKategori">Nama Kategori</label>
                            <select name="nama_kategori" id="NamaKategori"
                                class="form-control @error('nama_kategori') is-invalid @enderror">
                                <option value="" disabled selected>Pilih Kategori Pemasukan</option>  
                                <option value="Gaji">Gaji</option>
                                <option value="Kiriman">Kiriman</option>
                                <option value="Pekerjaan">Pekerjaan</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                            @error('nama_kategori')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div id="customNotes" class="form-group" style="display: none;">
                            <label for="customNotesInput">Kategori Pemasukan Lainnya:</label>
                            <input type="text" id="customNotesInput" name="custom_notes"
                                class="form-control @error('custom_notes') is-invalid @enderror">
                            @error('custom_notes')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="Rekening">Rekening</label>
                            <select name="rekening" id="Rekening"
                                class="form-control @error('rekening') is-invalid @enderror">
                                <option value="" disabled selected>Pilih Rekening</option>  
                                <option value="BCA">BCA (Bank Central Asia)</option>
                                <option value="BRI">BRI (Bank Rakyat Indonesia)</option>
                                <option value="BNI">BNI (Bank Negara Indonesia)</option>
                                <option value="Mandiri">Mandiri (Bank Mandiri)</option>
                                <option value="CIMB">CIMB Niaga</option>
                                <option value="Maybank">Maybank Indonesia</option>
                                <option value="GOPAY">GOPAY</option>
                                <option value="SHOPEE PAY">SHOPEE PAY</option>
                                <option value="OVO">OVO</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                            @error('rekening')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div id="customNotes2" class="form-group" style="display: none;">
                            <label for="customNotesInput2">Rekening Lainnya:</label>
                            <input type="text" id="customNotesInput2" name="custom_notes2"
                                class="form-control @error('custom_notes2') is-invalid @enderror">
                            @error('custom_notes2')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="inputName">Jumlah Pemasukan</label>
                            <input type="number" id="inputName" name="jumlah_pemasukan"
                                class="form-control @error('jumlah_pemasukan') is-invalid @enderror"
                                placeholder="Masukkan Jumlah Pemasukkan" value="{{ old('jumlah_pemasukan') }}"
                                required="required" autocomplete="jumlah_pemasukan">
                            @error('jumlah_pemasukan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputName">Catatan Pemasukan</label>
                            <input type="text" id="inputName" name="catatan_pemasukan"
                                class="form-control @error('catatan_pemasukan') is-invalid @enderror"
                                placeholder="Masukkan Catatan" value="{{ old('catatan_pemasukan') }}"
                                required="required" autocomplete="catatan_pemasukan">
                            @error('catatan_pemasukan')
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
    document.getElementById('NamaKategori').addEventListener('change', function () {
        var customNotesDiv = document.getElementById('customNotes');
        var customNotesInput = document.getElementById('customNotesInput');

        if (this.options[this.selectedIndex].value === 'Lainnya') {
            customNotesDiv.style.display = 'block';
            customNotesInput.setAttribute('required', 'required');
        } else {
            customNotesDiv.style.display = 'none';
            customNotesInput.removeAttribute('required');
        }
    });
</script>

<script>
    document.getElementById('Rekening').addEventListener('change', function () {
        var customNotesDiv = document.getElementById('customNotes2');
        var customNotesInput = document.getElementById('customNotesInput2');

        if (this.options[this.selectedIndex].value === 'Lainnya') {
            customNotesDiv.style.display = 'block';
            customNotesInput.setAttribute('required', 'required');
        } else {
            customNotesDiv.style.display = 'none';
            customNotesInput.removeAttribute('required');
        }
    });
</script>


@endsection