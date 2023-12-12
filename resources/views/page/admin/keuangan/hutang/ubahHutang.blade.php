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
                        <label for="Rekening">Rekening</label>
                        <select name="rekening" id="Rekening" class="form-control @error('rekening') is-invalid @enderror">
                            <option value="" disabled selected>Pilih Rekening</option>
                            <option value="BCA" @if($hutang->rekening == 'BCA') selected @endif>BCA (Bank Central Asia)</option>
                            <option value="BRI" @if($hutang->rekening == 'BRI') selected @endif>BRI (Bank Rakyat Indonesia)</option>
                            <option value="BNI" @if($hutang->rekening == 'BNI') selected @endif>BNI (Bank Negara Indonesia)</option>
                            <option value="Mandiri" @if($hutang->rekening == 'Mandiri') selected @endif>Mandiri (Bank Mandiri)</option>
                            <option value="CIMB" @if($hutang->rekening == 'CIMB') selected @endif>CIMB Niaga</option>
                            <option value="Maybank" @if($hutang->rekening == 'Maybank') selected @endif>Maybank Indonesia</option>
                            <option value="GOPAY" @if($hutang->rekening == 'GOPAY') selected @endif>Gopay</option>
                            <option value="SHOPEE PAY" @if($hutang->rekening == 'SHOPEE PAY') selected @endif>Shopee Pay</option>
                            <option value="OVO" @if($hutang->rekening == 'OVO') selected @endif>OVO</option>
                            <option value="Lainnya" {{ !in_array($hutang->rekening, ['BCA', 'BRI', 'BNI', 'Mandiri', 'CIMB', 'Maybank', 'GOPAY', 'SHOPEE PAY', 'OVO']) ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('rekening')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div id="customNotes2" class="form-group" style="{{ !in_array($hutang->rekening, ['BCA', 'BRI', 'BNI', 'Mandiri', 'CIMB', 'Maybank', 'GOPAY', 'SHOPEE PAY', 'OVO']) ? 'display: block;' : 'display: none;' }}">
                        <label for="customNotesInput2">Rekening Lainnya:</label>
                        <input type="text" id="customNotesInput2" name="custom_notes2"
                            class="form-control @error('custom_notes2') is-invalid @enderror"
                            value="{{ !in_array($hutang->rekening, ['BCA', 'BRI', 'BNI', 'Mandiri', 'CIMB', 'Maybank', 'GOPAY', 'SHOPEE PAY', 'OVO']) ? $hutang->rekening : '' }}">
                        @error('custom_notes2')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
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

