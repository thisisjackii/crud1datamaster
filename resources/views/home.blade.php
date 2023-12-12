@extends('layouts.base_admin.base_dashboard')
@section('judul', 'Halaman Dashboard')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Dashboard</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Beranda</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<section class="content">
  <div class="container-fluid">

    <h5 class="mb-2">Info Box</h5>
    <div class="row">
      <div class="col-md-6 col-sm-6 col-12">
        <div class="info-box">
          <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Pemasukan</span>
            <span class="info-box-number">{{ $formattedAkhirPemasukan }}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-6 col-sm-6 col-12">
        <div class="info-box">
          <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Pengeluaran</span>
            <span class="info-box-number">{{ $formattedAkhirPengeluaran }}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
    </div>

    <div class="row">

      <div class="col-md-6 col-sm-6 col-12">
        <!-- DONUT CHART -->
        <div class="card card-danger">
          <div class="card-header">
            <h3 class="card-title">Pemasukan</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <canvas id="myChartPemasukan" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>

      <div class="col-md-6 col-sm-6 col-12">
        <!-- DONUT CHART -->
        <div class="card card-danger">
          <div class="card-header">
            <h3 class="card-title">Pengeluaran</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <canvas id="myChartPengeluaran" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>

      <div class="col-12">
        <!-- DONUT CHART -->
        <div class="card card-danger">
          <div class="card-header">
            <h3 class="card-title">Transfer Saldo</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <canvas id="myChartTransfer" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>


    </div>
  </div>
</section>
<script src="{{ asset('vendor/adminlte3/plugins/chart.js/Chart.min.js') }}"></script>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    var ctx = document.getElementById('myChartPemasukan').getContext('2d');
    var data = {!! $categoryTotalsPemasukan !!};

  console.log('Original data:', data);

  var labels = data.map(function (item) {
    return item.nama_kategori;
  });

  console.log('Labels:', labels);

  var values = data.map(function (item) {
    return item.total;
  });

  var randomColors = Array.from({ length: data.length }, () => getRandomColor());

  console.log('Values:', values);

  var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: labels,
      datasets: [{
        data: values,
        backgroundColor: randomColors,
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
    }
  });

  function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++) {
      color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
  }
    });
</script>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    var ctx = document.getElementById('myChartPengeluaran').getContext('2d');
    var data = {!! $categoryTotalsPengeluaran !!};

  console.log('Original data:', data);

  var labels = data.map(function (item) {
    return item.nama_kategori;
  });

  console.log('Labels:', labels);

  var values = data.map(function (item) {
    return item.total;
  });

  var randomColors = Array.from({ length: data.length }, () => getRandomColor());

  console.log('Values:', values);

  var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: labels,
      datasets: [{
        data: values,
        backgroundColor: randomColors,
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
    }
  });

  function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++) {
      color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
  }
    });
</script>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    var ctx = document.getElementById('myChartTransfer').getContext('2d');
    var data = {!! $categoryTotalsTransfer !!};

  console.log('Original data:', data);

  var labels = data.map(function (item) {
    return item.nama_kategori;
  });

  console.log('Labels:', labels);

  var values = data.map(function (item) {
    return item.total;
  });

  var randomColors = Array.from({ length: data.length }, () => getRandomColor());

  console.log('Values:', values);

  var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: labels,
      datasets: [{
        data: values,
        backgroundColor: randomColors,
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
    }
  });

  function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++) {
      color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
  }
    });
</script>
@endsection