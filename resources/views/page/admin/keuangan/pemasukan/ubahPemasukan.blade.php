@extends('layouts.base_admin.base_dashboard')
@section('judul', 'Edit Pemasukan')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Pemasukan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">Beranda</a>
                        </li>
                        <li class="breadcrumb-item active">Edit Pemasukan</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        @if(session('status'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
            {{ session('status') }}
        </div>
        @endif

        <div class="card">
            <div class="card-body">
                <form action="{{ route('pemasukan.edit', ['id' => $pemasukan->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="NamaKategori">Nama Pemasukan</label>
                        <select name="nama_kategori" id="NamaKategori" class="form-control @error('nama_kategori') is-invalid @enderror">
                            <option value="" disabled selected>Pilih Kategori Pemasukan</option>
                            <option value="Gaji" @if($pemasukan->nama_kategori == 'Gaji') selected @endif>Gaji</option>
                            <option value="Kiriman" @if($pemasukan->nama_kategori == 'Kiriman') selected @endif>Kiriman</option>
                            <option value="Pekerjaan" @if($pemasukan->nama_kategori == 'Pekerjaan') selected @endif>Pekerjaan</option>
                            <option value="Lainnya" {{ !in_array($pemasukan->nama_kategori, ['Gaji', 'Kiriman', 'Pekerjaan']) ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('nama_kategori')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div id="customNotes" class="form-group" style="{{ !in_array($pemasukan->nama_kategori, ['Gaji', 'Kiriman', 'Pekerjaan']) ? 'display: block;' : 'display: none;' }}">
                        <label for="customNotesInput">Kategori Pemasukan Lainnya:</label>
                        <input type="text" id="customNotesInput" name="custom_notes"
                            class="form-control @error('custom_notes') is-invalid @enderror"
                            value="{{ !in_array($pemasukan->nama_kategori, ['Gaji', 'Kiriman', 'Pekerjaan']) ? $pemasukan->nama_kategori : '' }}">
                        @error('custom_notes')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="Rekening">Rekening</label>
                        <select name="rekening" id="Rekening" class="form-control @error('rekening') is-invalid @enderror">
                            <option value="" disabled selected>Pilih Rekening</option>
                            <option value="BCA" @if($pemasukan->rekening == 'BCA') selected @endif>BCA (Bank Central Asia)</option>
                            <option value="BRI" @if($pemasukan->rekening == 'BRI') selected @endif>BRI (Bank Rakyat Indonesia)</option>
                            <option value="BNI" @if($pemasukan->rekening == 'BNI') selected @endif>BNI (Bank Negara Indonesia)</option>
                            <option value="Mandiri" @if($pemasukan->rekening == 'Mandiri') selected @endif>Mandiri (Bank Mandiri)</option>
                            <option value="CIMB" @if($pemasukan->rekening == 'CIMB') selected @endif>CIMB Niaga</option>
                            <option value="Maybank" @if($pemasukan->rekening == 'Maybank') selected @endif>Maybank Indonesia</option>
                            <option value="GOPAY" @if($pemasukan->rekening == 'GOPAY') selected @endif>Gopay</option>
                            <option value="SHOPEE PAY" @if($pemasukan->rekening == 'SHOPEE PAY') selected @endif>Shopee Pay</option>
                            <option value="OVO" @if($pemasukan->rekening == 'OVO') selected @endif>OVO</option>
                            <option value="Lainnya" {{ !in_array($pemasukan->rekening, ['BCA', 'BRI', 'BNI', 'Mandiri', 'CIMB', 'Maybank', 'GOPAY', 'SHOPEE PAY', 'OVO']) ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('rekening')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div id="customNotes2" class="form-group" style="{{ !in_array($pemasukan->rekening, ['BCA', 'BRI', 'BNI', 'Mandiri', 'CIMB', 'Maybank', 'GOPAY', 'SHOPEE PAY', 'OVO']) ? 'display: block;' : 'display: none;' }}">
                        <label for="customNotesInput2">Rekening Lainnya:</label>
                        <input type="text" id="customNotesInput2" name="custom_notes2"
                            class="form-control @error('custom_notes2') is-invalid @enderror"
                            value="{{ !in_array($pemasukan->rekening, ['BCA', 'BRI', 'BNI', 'Mandiri', 'CIMB', 'Maybank', 'GOPAY', 'SHOPEE PAY', 'OVO']) ? $pemasukan->rekening : '' }}">
                        @error('custom_notes2')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="jumlah_pemasukan">Jumlah Pemasukan</label>
                        <input type="text" class="form-control" id="jumlah_pemasukan" name="jumlah_pemasukan" value="{{ $pemasukan->jumlah_pemasukan }}" required>
                    </div>
                    <div class="form-group">
                        <label for="catatan_pemasukan">Catatan Pemasukan</label>
                        <textarea class="form-control" id="catatan_pemasukan" name="catatan_pemasukan" rows="4" required>{{ $pemasukan->catatan_pemasukan }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $pemasukan->tanggal }}" required>
                    </div>
                    <div class="form-group">
                        <label for="jam">Jam</label>
                        <input type="time" class="form-control" id="jam" name="jam" value="{{ $pemasukan->jam }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </section>

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
