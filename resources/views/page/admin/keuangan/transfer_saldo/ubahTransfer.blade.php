@extends('layouts.base_admin.base_dashboard') @section('judul', 'Edit Transfer Saldo')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Transfer Saldo</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Transfer Saldo</li>
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
    <form method="post" action="{{ route('transfer_saldo.edit', ['id' => $transfer->id]) }}" enctype="multipart/form-data">
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
                                placeholder="Masukkan Nama" required="required"
                                autocomplete="sumber_rekening" value="{{ $transfer->sumber_rekening }}">
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
                                <option value="GOPAY" {{$transfer->sumber_rekening == 'GOPAY' ? 'selected' : '' }}>Gopay</option>
                                <option value="SHOPEE PAY"  {{$transfer->sumber_rekening == 'SHOPEE PAY' ? 'selected' : '' }} >Shopee Pay</option>
                                <option value="OVO" {{$transfer->sumber_rekening == 'OVO' ? 'selected' : '' }}>OVO</option>
                                <option value="MISC" {{ !in_array($transfer->sumber_rekening, ['GOPAY', 'SHOPEE PAY', 'OVO']) ? 'selected' : '' }}>Lain-Lain</option>
                            </select>
                            @error('sumber_rekening')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div id="customNotes" class="form-group" style="{{ !in_array($transfer->sumber_rekening, ['GOPAY', 'SHOPEE PAY', 'OVO']) ? 'display: block;' : 'display: none;' }}">
                            <label for="customNotesInput">Opsi Lain:</label>
                            <input type="text" id="customNotesInput" name="custom_notes"
                                class="form-control @error('custom_notes') is-invalid @enderror"
                                value="{{ !in_array($transfer->sumber_rekening, ['GOPAY', 'SHOPEE PAY', 'OVO']) ? $transfer->sumber_rekening : '' }}">
                            @error('custom_notes')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <!-- <div class="form-group">
                            <label for="inputName">Tujuan Transfer</label>
                            <input type="text" id="inputName" name="tujuan_transfer"
                                class="form-control @error('tujuan_transfer') is-invalid @enderror"
                                placeholder="Masukkan Nama" required="required"
                                autocomplete="tujuan_transfer" value="{{ $transfer->tujuan_transfer }}">
                            @error('tujuan_transfer')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div> -->

                        <div class="form-group">
                            <label for="tujuanTransfer">Tujuan Transfer</label>
                            <select name="tujuan_transfer" id="tujuanTransfer"
                                class="form-control @error('tujuan_transfer') is-invalid @enderror">
                                <option value="" disabled selected>Pilih Sumber Rekening</option>
                                <option value="GOPAY" {{$transfer->tujuan_transfer == 'GOPAY' ? 'selected' : '' }}>Gopay</option>
                                <option value="SHOPEE PAY"  {{$transfer->tujuan_transfer == 'SHOPEE PAY' ? 'selected' : '' }} >Shopee Pay</option>
                                <option value="OVO" {{$transfer->tujuan_transfer == 'OVO' ? 'selected' : '' }}>OVO</option>
                                <option value="MISC" {{ !in_array($transfer->tujuan_transfer, ['GOPAY', 'SHOPEE PAY', 'OVO']) ? 'selected' : '' }}>Lain-Lain</option>
                            </select>
                            @error('tujuan_transfer')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div id="customNotes2" class="form-group" style="{{ !in_array($transfer->tujuan_transfer, ['GOPAY', 'SHOPEE PAY', 'OVO']) ? 'display: block;' : 'display: none;' }}">
                            <label for="customNotesInput2">Opsi Lain:</label>
                            <input type="text" id="customNotesInput2" name="custom_notes2"
                                class="form-control @error('custom_notes2') is-invalid @enderror"
                                value="{{ !in_array($transfer->tujuan_transfer, ['GOPAY', 'SHOPEE PAY', 'OVO']) ? $transfer->tujuan_transfer : '' }}">
                            @error('custom_notes2')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="inputName">Jumlah Transfer</label>
                            <input type="number" id="inputName" name="jumlah_transfer"
                                class="form-control @error('jumlah_transfer') is-invalid @enderror"
                                placeholder="Masukkan Nama" required="required"
                                autocomplete="jumlah_transfer" value="{{ $transfer->jumlah_transfer }}">
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
                                placeholder="Masukkan Tanggal" required="required"
                                autocomplete="tanggal" value="{{ $transfer->tanggal }}">
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
                                required="required" autocomplete="jam" value="{{ $transfer->jam }}">
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
                                placeholder="Masukkan Nama" required="required"
                                autocomplete="biaya_admin" value="{{ $transfer->biaya_admin }}">
                            @error('biaya_admin')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>   

                        <a href="{{ route('home') }}" class="btn btn-secondary">Cancel</a>
                        <input type="submit" value="Edit Pemasukan" class="btn btn-success float-right">
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

<script>
    document.getElementById('tujuanTransfer').addEventListener('change', function () {
        var customNotesDiv = document.getElementById('customNotes2');
        var customNotesInput = document.getElementById('customNotesInput2');

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