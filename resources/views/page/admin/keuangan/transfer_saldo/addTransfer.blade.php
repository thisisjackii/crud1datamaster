@extends('layouts.base_admin.base_dashboard') @section('judul', 'Tambah Transfer Saldo')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tambah Transfer Saldo</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="breadcrumb-item active">Tambah Transfer Saldo</li>
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
                        <h3 class="card-title">Informasi Transfer Saldo</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- <div class="form-group">
                            <label for="inputName">Sumber Rekening</label>
                            <input type="text" id="inputName" name="sumber_rekening"
                                class="form-control @error('sumber_rekening') is-invalid @enderror"
                                placeholder="Masukkan Nama" value="{{ old('sumber_rekening') }}" required="required"
                                autocomplete="sumber_rekening">
                            @error('sumber_rekening')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div> -->

                        <div class="form-group">
                            <label for="sumberRekening">Sumber Rekening</label>
                            <select name="sumber_rekening" id="sumberRekening"
                                class="form-control @error('sumber_rekening') is-invalid @enderror">
                                <option value="" disabled selected>Pilih Sumber Rekening</option>
                                <option value="GOPAY">GOPAY</option>
                                <option value="SHOPEE PAY">SHOPEE PAY</option>
                                <option value="OVO">OVO</option>
                                <option value="MISC">MISC</option>
                            </select>
                            @error('sumber_rekening')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div id="customNotes" class="form-group" style="display: none;">
                            <label for="customNotesInput">Custom Notes:</label>
                            <input type="text" id="customNotesInput" name="sumber_rekening"
                                class="form-control @error('sumber_rekening') is-invalid @enderror">
                            @error('sumber_rekening')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="inputName">Tujuan Transfer</label>
                            <input type="text" id="inputName" name="tujuan_transfer"
                                class="form-control @error('tujuan_transfer') is-invalid @enderror"
                                placeholder="Masukkan Nama" value="{{ old('tujuan_transfer') }}" required="required"
                                autocomplete="tujuan_transfer">
                            @error('tujuan_transfer')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="inputName">Jumlah Transfer</label>
                            <input type="number" id="inputName" name="jumlah_transfer"
                                class="form-control @error('jumlah_transfer') is-invalid @enderror"
                                placeholder="Masukkan Nama" value="{{ old('jumlah_transfer') }}" required="required"
                                autocomplete="jumlah_transfer">
                            @error('jumlah_transfer')
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
                        <div class="form-group">
                            <label for="inputName">Biaya Admin</label>
                            <input type="number" id="inputName" name="biaya_admin"
                                class="form-control @error('biaya_admin') is-invalid @enderror"
                                placeholder="Masukkan Nama" value="{{ old('biaya_admin') }}" required="required"
                                autocomplete="biaya_admin">
                            @error('biaya_admin')
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

<script>
    document.getElementById('sumberRekening').addEventListener('change', function () {
        var customNotesDiv = document.getElementById('customNotes');
        var customNotesInput = document.getElementById('customNotesInput');

        if (this.options[this.selectedIndex].value === 'MISC') {
            customNotesDiv.style.display = 'block';
            customNotesInput.setAttribute('required', 'required');
        } else {
            customNotesDiv.style.display = 'none';
            customNotesInput.removeAttribute('required');
        }
    });
</script>
@endsection