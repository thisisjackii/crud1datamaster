@extends('layouts.base_admin.base_dashboard')
@section('judul', 'Edit Pengeluaran')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Pengeluaran</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">Beranda</a>
                        </li>
                        <li class="breadcrumb-item active">Edit Pengeluaran</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('pengeluaran.edit', ['id' => $pengeluaran->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="NamaKategori">Nama pengeluaran</label>
                        <select name="nama_kategori" id="NamaKategori" class="form-control @error('nama_kategori') is-invalid @enderror">
                            <option value="" disabled selected>Pilih Kategori pengeluaran</option>
                            <option value="Air" @if($pengeluaran->nama_kategori == 'Air') selected @endif>Air</option>
                            <option value="Belanja" @if($pengeluaran->nama_kategori == 'Belanja') selected @endif>Belanja</option>
                            <option value="Bensin" @if($pengeluaran->nama_kategori == 'Bensin') selected @endif>Bensin</option>
                            <option value="Bus" @if($pengeluaran->nama_kategori == 'Bus') selected @endif>Bus</option>
                            <option value="Dapur" @if($pengeluaran->nama_kategori == 'Dapur') selected @endif>Dapur</option>
                            <option value="Elektronik" @if($pengeluaran->nama_kategori == 'Elektronik') selected @endif>Elektronik</option>
                            <option value="Film" @if($pengeluaran->nama_kategori == 'Film') selected @endif>Film</option>
                            <option value="Kereta" @if($pengeluaran->nama_kategori == 'Kereta') selected @endif>Kereta</option>
                            <option value="Kesehatan" @if($pengeluaran->nama_kategori == 'Kesehatan') selected @endif>Kesehatan</option>
                            <option value="Lampu" @if($pengeluaran->nama_kategori == 'Lampu') selected @endif>Lampu</option>
                            <option value="Listrik" @if($pengeluaran->nama_kategori == 'Listrik') selected @endif>Listrik</option>
                            <option value="Makanan" @if($pengeluaran->nama_kategori == 'Makanan') selected @endif>Makanan</option>
                            <option value="Minuman" @if($pengeluaran->nama_kategori == 'Minuman') selected @endif>Minuman</option>
                            <option value="Mobil" @if($pengeluaran->nama_kategori == 'Mobil') selected @endif>Mobil</option>
                            <option value="Motor" @if($pengeluaran->nama_kategori == 'Motor') selected @endif>Motor</option>
                            <option value="Olahraga" @if($pengeluaran->nama_kategori == 'Olahraga') selected @endif>Olahraga</option>
                            <option value="Peliharaan" @if($pengeluaran->nama_kategori == 'Peliharaan') selected @endif>Peliharaan</option>
                            <option value="Pendidikan" @if($pengeluaran->nama_kategori == 'Pendidikan') selected @endif>Pendidikan</option>
                            <option value="Penerbangan" @if($pengeluaran->nama_kategori == 'Penerbangan') selected @endif>Penerbangan</option>
                            <option value="Perabotan" @if($pengeluaran->nama_kategori == 'Perabotan') selected @endif>Perabotan</option>
                            <option value="Permainan" @if($pengeluaran->nama_kategori == 'Permainan') selected @endif>Permainan</option>
                            <option value="Tiket" @if($pengeluaran->nama_kategori == 'Tiket') selected @endif>Tiket</option>
                            <option value="Lainnya" {{ !in_array($pengeluaran->nama_kategori, ['Air', 'Belanja', 'Bensin', 'Bus', 'Dapur', 'Elektronik', 'Film', 'Kereta', 'Kesehatan', 'Lampu', 'Listrik', 'Makanan', 'Minuman', 'Mobil', 'Motor', 'Olahraga', 'Peliharaan', 'Pendidikan', 'Penerbangan', 'Perabotan', 'Permainan', 'Tiket']) ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('nama_kategori')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div id="customNotes" class="form-group" style="{{ !in_array($pengeluaran->nama_kategori, ['Air', 'Belanja', 'Bensin', 'Bus', 'Dapur', 'Elektronik', 'Film', 'Kereta', 'Kesehatan', 'Lampu', 'Listrik', 'Makanan', 'Minuman', 'Mobil', 'Motor', 'Olahraga', 'Peliharaan', 'Pendidikan', 'Penerbangan', 'Perabotan', 'Permainan', 'Tiket']) ? 'display: block;' : 'display: none;' }}">
                        <label for="customNotesInput">Kategori pengeluaran Lainnya:</label>
                        <input type="text" id="customNotesInput" name="custom_notes"
                            class="form-control @error('custom_notes') is-invalid @enderror"
                            value="{{ !in_array($pengeluaran->nama_kategori, ['Air', 'Belanja', 'Bensin', 'Bus', 'Dapur', 'Elektronik', 'Film', 'Kereta', 'Kesehatan', 'Lampu', 'Listrik', 'Makanan', 'Minuman', 'Mobil', 'Motor', 'Olahraga', 'Peliharaan', 'Pendidikan', 'Penerbangan', 'Perabotan', 'Permainan', 'Tiket']) ? $pengeluaran->nama_kategori : '' }}">
                        @error('custom_notes')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nama_pengeluaran">Nama Pengeluaran</label>
                        <input type="text" class="form-control" id="nama_pengeluaran" name="nama_pengeluaran" value="{{ $pengeluaran->nama_pengeluaran }}" required>
                    </div>
                    <div class="form-group">
                        <label for="tujuan_transaksi">Tujuan Transaksi</label>
                        <input type="text" class="form-control" id="tujuan_transaksi" name="tujuan_transaksi" value="{{ $pengeluaran->tujuan_transaksi }}" required>
                    </div>
                    <div class="form-group">
                        <label for="kuantitas">Frekuensi/Jumlah Barang</label>
                        <input type="text" class="form-control" id="kuantitas" name="kuantitas" value="{{ $pengeluaran->kuantitas }}" required>
                    </div>
                    <div class="form-group">
                        <label for="harga_peritem">Harga Peritem</label>
                        <input type="text" class="form-control" id="harga_peritem" name="harga_peritem" value="{{ $pengeluaran->harga_peritem }}" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $pengeluaran->tanggal }}" required>
                    </div>
                    <div class "form-group">
                        <label for="jam">Jam</label>
                        <input type="time" class="form-control" id="jam" name="jam" value="{{ $pengeluaran->jam }}" required>
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
@endsection
