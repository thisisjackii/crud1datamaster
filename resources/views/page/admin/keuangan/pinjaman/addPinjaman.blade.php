<!-- resources/views/page/admin/keuangan/pinjaman/addPinjaman.blade.php -->

@extends('layouts.base_admin.base_dashboard') @section('judul', 'Tambah Pinjaman')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tambah Pinjaman</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="breadcrumb-item active">Tambah Pinjaman</li>
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
                        <h3 class="card-title">Informasi Pinjaman</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
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
                            <label for="inputName">Jumlah Pinjaman</label>
                            <input type="text" id="inputName" name="jumlah_pinjaman"
                                class="form-control @error('jumlah_pinjaman') is-invalid @enderror"
                                placeholder="Masukkan Jumlah Pinjaman" value="{{ old('jumlah_pinjaman') }}" required="required"
                                autocomplete="jumlah_pinjaman">
                            @error('jumlah_pinjaman')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="inputName">Nama Diberi Pinjaman</label>
                            <input type="text" id="inputName" name="nama_diberi_pinjaman"
                                class="form-control @error('nama_diberi_pinjaman') is-invalid @enderror"
                                placeholder="Masukkan Nama Pemberi Pinjaman" value="{{ old('nama_diberi_pinjaman') }}" required="required"
                                autocomplete="nama_diberi_pinjaman">
                            @error('nama_diberi_pinjaman')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="inputName">Catatan Pinjaman</label>
                            <textarea id="inputName" name="catatan_pinjaman"
                                class="form-control @error('catatan_pinjaman') is-invalid @enderror"
                                placeholder="Masukkan Catatan Pinjaman" required="required"
                                autocomplete="catatan_pinjaman">{{ old('catatan_pinjaman') }}</textarea>
                            @error('catatan_pinjaman')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="inputName">Tanggal Pinjaman</label>
                            <input type="date" id="inputName" name="tanggal_pinjaman"
                                class="form-control @error('tanggal_pinjaman') is-invalid @enderror"
                                placeholder="Masukkan Tanggal Pinjaman" value="{{ old('tanggal_pinjaman') }}" required="required"
                                autocomplete="tanggal_pinjaman">
                            @error('tanggal_pinjaman')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="inputName">Jam Pinjaman</label>
                            <input type="time" id="inputName" name="jam_pinjaman"
                                class="form-control @error('jam_pinjaman') is-invalid @enderror"
                                placeholder="Masukkan Jam Pinjaman" value="{{ old('jam_pinjaman') }}" required="required"
                                autocomplete="jam_pinjaman">
                            @error('jam_pinjaman')
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
                            <label for="inputStatus">Status</label>
                            <select id="inputStatus" name="status" class="form-control @error('status') is-invalid @enderror" required>
                                <option value="Belum Lunas" {{ old('status') == 'Belum Lunas' ? 'selected' : '' }}>Belum Lunas</option>
                                <option value="Sudah Lunas" {{ old('status') == 'Sudah Lunas' ? 'selected' : '' }}>Sudah Lunas</option>
                            </select>
                            @error('status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <a href="{{ route('home') }}" class="btn btn-secondary">Cancel</a>
                        <input type="submit" value="Tambah Pinjaman" class="btn btn-success float-right">
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
