@extends('layouts.base_admin.base_dashboard')
@section('judul', 'List Akun')
@section('script_head')
<link
    rel="stylesheet"
    type="text/css"
    href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Data Transfer Saldo</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="breadcrumb-item active">Akun</li>
                </ol>
            </div>
        </div>
    </div>
</section>

    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"></h3>
                <div class="card-tools">
                    <button
                        type="button"
                        class="btn btn-tool"
                        data-card-widget="collapse"
                        title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button
                        type="button"
                        class="btn btn-tool"
                        data-card-widget="remove"
                        title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0" style="margin: 20px">
            <form method="post" action="{{route('report.index')}}">
            @csrf
                <input type="submit" value="Cetak Word">
            </form>

            <form method="post" action="{{route('importtransfer.index')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="file">Upload Excel File:</label>
                    <input type="file" name="file" id="file" class="form-control">
                </div>
                <button type="submit" class="btn btn-info">Upload</button>
            </form>


            <a href="{{route('transfer_saldo.export')}}">
                <button>tset</button>
            </a>

            <a href="{{route('transfer_saldo.exportPdf')}}">
                <button>Save PDF</button>
            </a>
                <table
                    id="previewTransfer"
                    class="table table-striped table-bordered display"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th>Nomor</th>
                            <th>Sumber Rekening</th>
                            <th>Tujuan Transfer</th>
                            <th>Jumlah Transfer</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Biaya Admin</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </section>
@endsection

@section('script_footer')
<script
    type="text/javascript"
    src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script
    type="text/javascript"
    src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function () {
        $('#previewTransfer').DataTable({
            "serverSide": true,
            "processing": true,
            "ajax": {
                "url": "{{ route('transfer_saldo.dataTable') }}",
                "dataType": "json",
                "type": "POST",
                "data": {
                    _token: "{{ csrf_token() }}"
                }
            },
            "columns": [
                {
                    "data": "id"
                }, {
                    "data": "sumber_rekening"
                }, {
                    "data": "tujuan_transfer"
                }, {
                    "data": "jumlah_transfer"
                }, {
                    "data": "tanggal"
                }, {
                    "data": "jam"
                },{
                    "data": "biaya_admin"
                },{
                    "data": "options"
                }
            ],
            "language": {
                "decimal": "",
                "emptyTable": "Tak ada data yang tersedia pada tabel ini",
                "info": "Menampilkan _START_ hingga _END_ dari _TOTAL_ entri",
                "infoEmpty": "Menampilkan 0 hingga 0 dari 0 entri",
                "infoFiltered": "(difilter dari _MAX_ total entri)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Tampilkan _MENU_ entri",
                "loadingRecords": "Loading...",
                "processing": "Sedang Mengambil Data...",
                "search": "Pencarian:",
                "zeroRecords": "Tidak ada data yang cocok ditemukan",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Selanjutnya",
                    "previous": "Sebelumnya"
                },
                "aria": {
                    "sortAscending": ": aktifkan untuk mengurutkan kolom ascending",
                    "sortDescending": ": aktifkan untuk mengurutkan kolom descending"
                }
            }
        });

                // hapus data
                $('#previewTransfer').on('click', '.hapusData', function () {
                    var id = $(this).data("id");
                    var url = $(this).data("url");
                    Swal
                        .fire({
                            title: 'Apa kamu yakin?',
                            text: "Kamu tidak akan dapat mengembalikan ini!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, hapus!',
                            cancelButtonText: 'Batal'
                        })
                        .then((result) => {
                            if (result.isConfirmed) {
                                // console.log();
                                $.ajax({
                                    url: url,
                                    type: 'DELETE',
                                    data: {
                                        "id": id,
                                        "_token": "{{csrf_token()}}"
                                    },
                                    success: function (response) {
                                        // console.log();
                                        Swal.fire('Terhapus!', response.msg, 'success');
                                        $('#previewTransfer').DataTable().ajax.reload();
                                    }
                                });
                            }
                        })
                });
        });
</script>
@endsection
