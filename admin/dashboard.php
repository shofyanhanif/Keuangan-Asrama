<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 font-weight-bold mb-0 text-gray-800">Dashboard</h1>
</div>

<div class="row">
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Santri Aktif</div>
            <?php
            $sql = "SELECT COUNT(ID_SANTRI) FROM santri WHERE STATUS = 'Aktif'";
            $result = mysqli_query($koneksi, $sql);
            $data = mysqli_fetch_array($result);
            ?>
            <div class="h5 mb-0 font-weight-bold text-gray-800">
              <?= $data[0]; ?> Santri
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-users fa-2x text-gray-300"></i>
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
            <?php
            $sql = "SELECT SUM(NOMINAL) FROM pembayaran WHERE YEAR(TGL_BAYAR) = YEAR(CURRENT_DATE()) AND MONTH(TGL_BAYAR) = MONTH(CURRENT_DATE()) AND STATUS IS NULL OR STATUS = 'Valid'";
            $result = mysqli_query($koneksi, $sql);
            $row = mysqli_fetch_array($result)
            ?>
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pemasukan (/bulan)</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">
              Rp <?= number_format($row['SUM(NOMINAL)'], '0', ',', '.') ?>
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-hand-holding-usd fa-2x text-gray-300"></i>
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
            <?php
            $sql = "SELECT SUM(NOMINAL) FROM pengeluaran WHERE YEAR(TANGGAL) = YEAR(CURRENT_DATE()) AND MONTH(TANGGAL) = MONTH(CURRENT_DATE())";
            $result = mysqli_query($koneksi, $sql);
            $row2 = mysqli_fetch_array($result)
            ?>
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pengeluaran (/bulan)</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">
              Rp <?= number_format($row2['SUM(NOMINAL)'], '0', ',', '.') ?>
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-file-invoice-dollar fa-2x text-gray-300"></i>
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
            <?php
            $sql = "SELECT (IFNULL((SELECT SUM(NOMINAL) FROM pembayaran WHERE YEAR(TGL_BAYAR) = YEAR(CURRENT_DATE()) AND MONTH(TGL_BAYAR) = MONTH(CURRENT_DATE()) AND STATUS IS NULL OR STATUS = 'Valid'), 0) - IFNULL((SELECT SUM(NOMINAL) FROM pengeluaran WHERE YEAR(TANGGAL) = YEAR(CURRENT_DATE()) AND MONTH(TANGGAL) = MONTH(CURRENT_DATE())), 0)) AS selisih";
            $result = mysqli_query($koneksi, $sql);
            $hasil = mysqli_fetch_array($result);
            ?>
            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Saldo (/bulan)</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">
              Rp <?= number_format($hasil['selisih'], '0', ',', '.') ?>
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-danger shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <?php
            $sql = "SELECT COUNT(STATUS) AS Jumlah FROM pembayaran WHERE STATUS = 'Menunggu'";
            $result = mysqli_query($koneksi, $sql);
            $request = mysqli_fetch_array($result);
            ?>
            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Permintaan Validasi</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $request['Jumlah'] ?> Permintaan</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-exclamation-circle fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row text-dark">
  <div class="col-xl-8 col-lg-7">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold">Grafik Keuangan</h6>
      </div>
      <div class="card-body">
        <div class="chart-bar">
          <canvas id="chartKeuangan"></canvas>
        </div>
        <hr>
        <span>*</span>grafik keuangan per bulan
      </div>
    </div>
  </div>

  <div class="col-xl-4 col-lg-5">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-dark">Grafik Tagihan Santri</h6>
        <div class="dropdown no-arrow">
          <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-500"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" href="index.php?page=lunas">Daftar Lunas</a>
            <a class="dropdown-item" href="index.php?page=belum-lunas">Daftar Belum Lunas</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="d-sm-flex align-items-center justify-content-between mb-3">
          <?php
          $tgl = date('M-Y');
          ?>
          <div class="m-0">Bulan: <?php echo $tgl ?></div>
        </div>
        <div class="chart-pie pt-1 pb-2">
          <canvas id="chartTagihan"></canvas>
        </div>
        <div class="mt-4 text-center small">
          <span class="mr-2">
            <i class="fas fa-circle text-primary"></i> Lunas
          </span>
          <span class="mr-1">
            <i class="fas fa-circle" style="color: #ffcf32;"></i> Belum Lunas
          </span>
        </div>
        <hr>
        <span>*</span>berdasarkan bulan
      </div>
    </div>
  </div>
</div>

<div class="row text-dark">
  <div class="col-xl-8 col-lg-7">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold">Grafik Jumlah Santri per Asrama</h6>
      </div>
      <div class="card-body">
        <div class="chart-bar" style="position: relative;">
          <canvas id="chartAsrama"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  // Grafik Keuangan
  <?php
  $queryPemasukan = "SELECT DATE_FORMAT(TGL_BAYAR, '%M %Y') AS Bulan, SUM(NOMINAL) AS Pemasukan FROM pembayaran GROUP BY Bulan";
  $resultPemasukan = mysqli_query($koneksi, $queryPemasukan);

  $bulanPemasukan = array();
  $nilaiPemasukan = array();

  while ($row = mysqli_fetch_assoc($resultPemasukan)) {
    $bulanPemasukan[] = $row['Bulan'];
    $nilaiPemasukan[] = $row['Pemasukan'];
  }

  // Query untuk mendapatkan data pengeluaran
  $queryPengeluaran = "SELECT DATE_FORMAT(TANGGAL, '%M %Y') AS Bulan, SUM(NOMINAL) AS Pengeluaran FROM pengeluaran GROUP BY Bulan";
  $resultPengeluaran = mysqli_query($koneksi, $queryPengeluaran);

  $nilaiPengeluaran = array();

  while ($row = mysqli_fetch_assoc($resultPengeluaran)) {
    $nilaiPengeluaran[] = $row['Pengeluaran'];
  }
  ?>

  // Chart bar keuangan
  var ctx = document.getElementById('chartKeuangan');
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?php echo "['" . implode("', '", $bulanPemasukan) . "']"; ?>,
      datasets: [{
          label: 'Pemasukan',
          data: <?php echo "['" . implode("', '", $nilaiPemasukan) . "']"; ?>,
          backgroundColor: [
            'rgba(0, 76, 220, 0.6)'
          ]
        },
        {
          label: 'Pengeluaran',
          data: <?php echo "['" . implode("', '", $nilaiPengeluaran) . "']"; ?>,
          backgroundColor: [
            'rgba(224, 60, 56, 0.6)'
          ]
        }
      ]
    },
    options: {
      maintainAspectRatio: false,
      layout: {
        padding: {
          left: 10,
          right: 25,
          top: 0,
          bottom: 0
        }
      },
      scales: {
        yAxes: [{
          ticks: {
            min: 0,
            max: 5000000,
            maxTicksLimit: 10,
            callback: function(value, index, values) {
              return 'Rp ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }
          }
        }]
      },
      tooltips: {
        titleMarginBottom: 10,
        titleFontColor: '#6e707e',
        titleFontSize: 14,
        backgroundColor: "rgb(236, 240, 255)",
        bodyFontColor: "#858796",
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        caretPadding: 10,
        callbacks: {
          label: function(tooltipItem, chart) {
            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
            var value = tooltipItem.yLabel;

            if (datasetLabel) {
              value = 'Rp ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
              return datasetLabel + ': ' + value;
            }
          }
        }
      }
    }
  });

  // Grafik Lunas dan Belum
  <?php
  $query = "SELECT SUM(CASE WHEN status = 'Lunas' THEN 1 ELSE 0 END) AS jumlah_lunas, GROUP_CONCAT(CASE WHEN status = 'Lunas' THEN id_santri END) AS id_santri_lunas, SUM(CASE WHEN status = 'Tunggakan' THEN 1 ELSE 0 END) AS jumlah_tunggakan, GROUP_CONCAT(CASE WHEN status = 'Tunggakan' THEN id_santri END) AS id_santri_tunggakan FROM (SELECT id_santri, MAX(status) AS status FROM tagihan GROUP BY id_santri) AS subquery";
  $result = mysqli_query($koneksi, $query);
  $data = mysqli_fetch_assoc($result);

  $lunas = $data['jumlah_lunas'];
  $belum = $data['jumlah_tunggakan'];
  ?>

  // Pie chart jumlah santri yang sudah lunas
  var ctx = document.getElementById("chartTagihan");
  var myPieChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ["Santri", "Santri"],
      datasets: [{
        data: [<?php echo $lunas; ?>, <?php echo $belum; ?>],
        backgroundColor: ['#4e73df', '#ffcf32'],
        hoverBackgroundColor: ['#2e59d9', '#ffc233'],
        hoverBorderColor: "rgba(234, 236, 244, 1)",
      }],
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        backgroundColor: "rgb(236, 240, 255)",
        bodyFontColor: "#858796",
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        caretPadding: 10
      },
      legend: {
        display: false
      },
      cutoutPercentage: 60,
    },
  });
</script>
<script>
  // Grafik Jumlah Santri per Asrama
  <?php
  $sql = "SELECT a.ASRAMA AS asrama, COUNT(s.ID_SANTRI) AS jumlah_santri FROM asrama a LEFT JOIN santri s ON a.ID_ASRAMA = s.ID_ASRAMA GROUP BY a.ID_ASRAMA";
  $result = mysqli_query($koneksi, $sql);

  $asrama = array();
  $santri = array();

  while ($row = mysqli_fetch_assoc($result)) {
    $asrama[] = $row['asrama'];
    $santri[] = $row['jumlah_santri'];
  }
  ?>

  // Chart bar keuangan
  var ctx = document.getElementById('chartAsrama');
  var myBarChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?php echo "['" . implode("', '", $asrama) . "']"; ?>,
      datasets: [{
        data: <?php echo "['" . implode("', '", $santri) . "']"; ?>,
        backgroundColor: [
          'rgba(0, 76, 220, 0.6)',
          'rgba(23, 166, 115, 0.6)',
          'rgba(44, 159, 175, 0.6)',
          'rgba(255, 207, 50, 0.6)'
        ]
      }]
    },
    options: {
      maintainAspectRatio: false,
      layout: {
        padding: {
          left: 10,
          right: 25,
          top: 0,
          bottom: 0
        }
      },
      scales: {
        yAxes: [{
          ticks: {
            min: 0,
            max: 50,
            maxTicksLimit: 10,
          }
        }]
      },
      legend: {
        display: false
      },
      tooltips: {
        titleMarginBottom: 10,
        titleFontColor: '#6e707e',
        titleFontSize: 14,
        backgroundColor: "rgb(236, 240, 255)",
        bodyFontColor: "#858796",
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        caretPadding: 10,
        callbacks: {
          label: function(tooltipItem, data) {
            var label = data.labels[tooltipItem.index] || '';
            var value = data.datasets[0].data[tooltipItem.index] || '';

            return label + ': ' + value + ' santri';
          }
        }
      }
    }
  });
</script>