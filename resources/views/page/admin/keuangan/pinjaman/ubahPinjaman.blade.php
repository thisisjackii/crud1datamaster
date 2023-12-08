<!-- resources/views/page/admin/keuangan/pinjaman/ubahPinjaman.blade.php -->

@extends('layouts.base_admin.base_dashboard')
@section('judul', 'Edit Pinjaman')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Pinjaman</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">Beranda</a>
                        </li>
                        <li class="breadcrumb-item active">Edit Pinjaman</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('pinjaman.edit', ['id' => $pinjaman->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="Rekening">Rekening</label>
                        <select name="rekening" id="Rekening" class="form-control @error('rekening') is-invalid @enderror">
                            <option value="" disabled selected>Pilih Rekening</option>
                            <option value="BCA" @if($pinjaman->rekening == 'BCA') selected @endif>BCA (Bank Central Asia)</option>
                            <option value="BRI" @if($pinjaman->rekening == 'BRI') selected @endif>BRI (Bank Rakyat Indonesia)</option>
                            <option value="BNI" @if($pinjaman->rekening == 'BNI') selected @endif>BNI (Bank Negara Indonesia)</option>
                            <option value="Mandiri" @if($pinjaman->rekening == 'Mandiri') selected @endif>Mandiri (Bank Mandiri)</option>
                            <option value="CIMB" @if($pinjaman->rekening == 'CIMB') selected @endif>CIMB Niaga</option>
                            <option value="Maybank" @if($pinjaman->rekening == 'Maybank') selected @endif>Maybank Indonesia</option>
                            <option value="GOPAY" @if($pinjaman->rekening == 'GOPAY') selected @endif>Gopay</option>
                            <option value="SHOPEE PAY" @if($pinjaman->rekening == 'SHOPEE PAY') selected @endif>Shopee Pay</option>
                            <option value="OVO" @if($pinjaman->rekening == 'OVO') selected @endif>OVO</option>
                            <option value="Lainnya" {{ !in_array($pinjaman->rekening, ['BCA', 'BRI', 'BNI', 'Mandiri', 'CIMB', 'Maybank', 'GOPAY', 'SHOPEE PAY', 'OVO']) ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('rekening')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div id="customNotes2" class="form-group" style="{{ !in_array($pinjaman->rekening, ['BCA', 'BRI', 'BNI', 'Mandiri', 'CIMB', 'Maybank', 'GOPAY', 'SHOPEE PAY', 'OVO']) ? 'display: block;' : 'display: none;' }}">
                        <label for="customNotesInput2">Rekening Lainnya:</label>
                        <input type="text" id="customNotesInput2" name="custom_notes2"
                            class="form-control @error('custom_notes2') is-invalid @enderror"
                            value="{{ !in_array($pinjaman->rekening, ['BCA', 'BRI', 'BNI', 'Mandiri', 'CIMB', 'Maybank', 'GOPAY', 'SHOPEE PAY', 'OVO']) ? $pinjaman->rekening : '' }}">
                        @error('custom_notes2')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="jumlah_pinjaman">Jumlah Pinjaman</label>
                        <input type="text" class="form-control" id="jumlah_pinjaman" name="jumlah_pinjaman" value="{{ $pinjaman->jumlah_pinjaman }}" required>
                    </div>
                    <div class="form-group">
                        <label for="nama_diberi_pinjaman">Nama Pemberi Pinjaman</label>
                        <input type="text" class="form-control" id="nama_diberi_pinjaman" name="nama_diberi_pinjaman" value="{{ $pinjaman->nama_diberi_pinjaman }}" required>
                    </div>
                    <div class="form-group">
                        <label for="catatan_pinjaman">Catatan Pinjaman</label>
                        <textarea class="form-control" id="catatan_pinjaman" name="catatan_pinjaman" required>{{ $pinjaman->catatan_pinjaman }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_pinjaman">Tanggal Pinjaman</label>
                        <input type="date" class="form-control" id="tanggal_pinjaman" name="tanggal_pinjaman" value="{{ $pinjaman->tanggal_pinjaman }}" required>
                    </div>
                    <div class="form-group">
                        <label for="jam_pinjaman">Jam Pinjaman</label>
                        <input type="time" class="form-control" id="jam_pinjaman" name="jam_pinjaman" value="{{ $pinjaman->jam_pinjaman }}" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_jatuh_tempo">Tanggal Jatuh Tempo</label>
                        <input type="date" class="form-control" id="tanggal_jatuh_tempo" name="tanggal_jatuh_tempo" value="{{ $pinjaman->tanggal_jatuh_tempo }}" required>
                    </div>
                    <div class="form-group">
                        <label for="jam_jatuh_tempo">Jam Jatuh Tempo</label>
                        <input type="time" class="form-control" id="jam_jatuh_tempo" name="jam_jatuh_tempo" value="{{ $pinjaman->jam_jatuh_tempo }}" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="Belum Lunas" {{ $pinjaman->status == 'Belum Lunas' ? 'selected' : '' }}>
                                Belum Lunas
                            </option>
                            <option value="Sudah Lunas" {{ $pinjaman->status == 'Sudah Lunas' ? 'selected' : '' }}>
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

