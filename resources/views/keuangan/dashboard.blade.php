@extends('layouts.admin')

@section('title', 'Dashboard Keuangan')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard Keuangan</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Pembayaran</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data['total_pembayaran'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-money-bill fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Menunggu Verifikasi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data['menunggu_verifikasi'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Pembayaran Diterima</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data['pembayaran_diterima'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Nominal</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($data['total_nominal'], 0, ',', '.') }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Charts Row -->
    <div class="row">
        <!-- Pie Chart - Status Pembayaran -->
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Status Pembayaran</h6>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="statusPembayaranChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bar Chart - Pembayaran per Gelombang -->
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Pembayaran per Gelombang</h6>
                </div>
                <div class="card-body">
                    <div class="chart-bar">
                        <canvas id="gelombangBarChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Line Charts Row -->
    <div class="row">
        <!-- Line Chart - Pembayaran Harian -->
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Pembayaran Harian (14 Hari Terakhir)</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="pembayaranHarianChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Line Chart - Nominal per Hari -->
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Nominal Pembayaran per Hari (14 Hari Terakhir)</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="nominalHarianChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart - Status Pembayaran
var ctx1 = document.getElementById("statusPembayaranChart");
var statusChart = new Chart(ctx1, {
  type: 'doughnut',
  data: {
    labels: [@foreach($chartData['status_pembayaran'] as $item)"{{ $item->status_pembayaran == 'APPROVED' ? 'Pembayaran Diterima' : ($item->status_pembayaran == 'PENDING' ? 'Menunggu Verifikasi' : ($item->status_pembayaran == 'REJECTED' ? 'Pembayaran Ditolak' : 'Belum Upload')) }}",@endforeach],
    datasets: [{
      data: [@foreach($chartData['status_pembayaran'] as $item){{ $item->total }},@endforeach],
      backgroundColor: ['#1cc88a', '#f6c23e', '#e74a3b', '#858796'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: true,
      position: 'bottom'
    },
    cutoutPercentage: 80,
  },
});

// Bar Chart - Pembayaran per Gelombang
var ctx2 = document.getElementById("gelombangBarChart");
var gelombangChart = new Chart(ctx2, {
  type: 'bar',
  data: {
    labels: [@foreach($chartData['pembayaran_per_gelombang'] as $item)"{{ $item->nama_gelombang }}",@endforeach],
    datasets: [{
      label: "Jumlah Pembayaran",
      backgroundColor: "#4e73df",
      hoverBackgroundColor: "#2e59d9",
      borderColor: "#4e73df",
      data: [@foreach($chartData['pembayaran_per_gelombang'] as $item){{ $item->total }},@endforeach],
    }],
  },
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 6
        },
        maxBarThickness: 25,
      }],
      yAxes: [{
        ticks: {
          min: 0,
          maxTicksLimit: 5,
          padding: 10
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
  }
});

// Line Chart - Pembayaran Harian (with sample data if empty)
var pembayaranData = [@foreach($chartData['pembayaran_harian'] as $item){{ $item->total }},@endforeach];
if (pembayaranData.length === 0) {
    pembayaranData = [0, 0, 0, 0, 0, 0, 0];
}

var ctx3 = document.getElementById("pembayaranHarianChart");
var pembayaranChart = new Chart(ctx3, {
  type: 'line',
  data: {
    labels: [@if($chartData['pembayaran_harian']->count() > 0)@foreach($chartData['pembayaran_harian']->reverse() as $item)"{{ date('d/m', strtotime($item->tanggal)) }}",@endforeach @else "1", "2", "3", "4", "5", "6", "7" @endif],
    datasets: [{
      label: "Pembayaran Diverifikasi",
      lineTension: 0.3,
      backgroundColor: "rgba(28, 200, 138, 0.05)",
      borderColor: "rgba(28, 200, 138, 1)",
      pointRadius: 3,
      pointBackgroundColor: "rgba(28, 200, 138, 1)",
      pointBorderColor: "rgba(28, 200, 138, 1)",
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "rgba(28, 200, 138, 1)",
      pointHoverBorderColor: "rgba(28, 200, 138, 1)",
      pointHitRadius: 10,
      pointBorderWidth: 2,
      data: pembayaranData,
    }],
  },
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 7
        }
      }],
      yAxes: [{
        ticks: {
          maxTicksLimit: 5,
          padding: 10,
          min: 0
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      intersect: false,
      mode: 'index',
      caretPadding: 10,
    }
  }
});

// Line Chart - Nominal per Hari (with sample data if empty)
var nominalData = [@foreach($chartData['nominal_per_hari'] as $item){{ $item->total_nominal }},@endforeach];
if (nominalData.length === 0) {
    nominalData = [0, 0, 0, 0, 0, 0, 0];
}

var ctx4 = document.getElementById("nominalHarianChart");
var nominalChart = new Chart(ctx4, {
  type: 'line',
  data: {
    labels: [@if($chartData['nominal_per_hari']->count() > 0)@foreach($chartData['nominal_per_hari']->reverse() as $item)"{{ date('d/m', strtotime($item->tanggal)) }}",@endforeach @else "1", "2", "3", "4", "5", "6", "7" @endif],
    datasets: [{
      label: "Nominal (Rp)",
      lineTension: 0.3,
      backgroundColor: "rgba(246, 194, 62, 0.05)",
      borderColor: "rgba(246, 194, 62, 1)",
      pointRadius: 3,
      pointBackgroundColor: "rgba(246, 194, 62, 1)",
      pointBorderColor: "rgba(246, 194, 62, 1)",
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "rgba(246, 194, 62, 1)",
      pointHoverBorderColor: "rgba(246, 194, 62, 1)",
      pointHitRadius: 10,
      pointBorderWidth: 2,
      data: nominalData,
    }],
  },
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 7
        }
      }],
      yAxes: [{
        ticks: {
          maxTicksLimit: 5,
          padding: 10,
          min: 0
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      intersect: false,
      mode: 'index',
      caretPadding: 10,
    }
  }
});
</script>
@endpush