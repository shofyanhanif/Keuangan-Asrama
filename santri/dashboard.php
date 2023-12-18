<?php

if ($status == 'Aktif') {
  // Ambil data spp berdasarkan tahun sekarang dan asrama
  $currentYear = date('Y');
  $currentMonth = date('n'); // Mendapatkan bulan saat ini
  $querySpp = "SELECT * FROM spp WHERE TAHUN = '$currentYear' AND ID_ASRAMA = '$id_asrama'";
  $resultSpp = mysqli_query($koneksi, $querySpp);

  $successMessage = ""; // Variabel untuk menyimpan pesan peringatan

  if ($resultSpp) {
    $tagihanData = array(); // Variabel untuk menyimpan data spp yang akan digabungkan

    // Looping untuk setiap data spp
    while ($rowSpp = mysqli_fetch_assoc($resultSpp)) {
      $kategoriTagihan = $rowSpp['KATEGORI'];
      $nominalTagihan = $rowSpp['NOMINAL'];

      // Cek apakah ada data spp dengan bulan yang sama dalam $tagihanData
      $foundMatchingBulan = false;
      $indexFound = -1;

      foreach ($tagihanData as $index => $tagihan) {
        if ($tagihan['BULAN'] == $currentMonth) {
          $foundMatchingBulan = true;
          $indexFound = $index;
          break;
        }
      }

      if ($foundMatchingBulan) {
        // Jika ditemukan data spp dengan bulan yang sama, tambahkan kategori dan nominal ke data tersebut
        $tagihanData[$indexFound]['KATEGORI'] .= ' & ' . $kategoriTagihan;
        $tagihanData[$indexFound]['NOMINAL'] += $nominalTagihan;
      } else {
        // Jika tidak ditemukan, tambahkan data spp ke dalam $tagihanData
        $tagihanData[] = array(
          'BULAN' => $currentMonth,
          'KATEGORI' => $kategoriTagihan,
          'NOMINAL' => $nominalTagihan
        );
      }
    }

    // Setelah looping selesai, masukkan data spp yang sudah digabungkan ke dalam tabel tagihan
    foreach ($tagihanData as $tagihan) {
      $bulanTagihan = $tagihan['BULAN'];
      $kategoriTagihan = $tagihan['KATEGORI'];
      $nominalTagihan = $tagihan['NOMINAL'];

      // Cek apakah tagihan sudah ada untuk bulan ini dan kategori tagihan
      $queryCheckTagihan = "SELECT * FROM tagihan WHERE ID_SANTRI = '$id_santri' AND TAHUN = '$currentYear' AND BULAN = '$bulanTagihan' AND KATEGORI = '$kategoriTagihan'";
      $resultCheckTagihan = mysqli_query($koneksi, $queryCheckTagihan);

      if (mysqli_num_rows($resultCheckTagihan) == 0) {
        // Jika tagihan belum ada, buat tagihan baru dengan kategori yang digabungkan dan total nominal
        $queryInsertTagihan = "INSERT INTO tagihan (ID_SANTRI, TAHUN, BULAN, KATEGORI, NOMINAL) VALUES ('$id_santri', '$currentYear', '$bulanTagihan', '$kategoriTagihan', '$nominalTagihan')";
        $resultInsertTagihan = mysqli_query($koneksi, $queryInsertTagihan);

        if ($resultInsertTagihan) {
          if (empty($successMessage)) {
            $successMessage = "Tagihan bulan ini sudah keluar";
          }
        } else {
          echo "Gagal membuat tagihan: " . mysqli_error($koneksi);
        }
      }
    }

    if (!empty($successMessage)) {
      echo "<script>alert('$successMessage');</script>";
    }
  } else {
    echo "Gagal mengambil data spp: " . mysqli_error($koneksi);
  }
} else {
  echo "<script>alert('Status santri tidak aktif');</script>";
}

?>

<!-- Content Dashboard Santri -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
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
    <div class="card border-left-warning shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <?php
            $sql = "SELECT SUM(NOMINAL) FROM tagihan WHERE ID_SANTRI = '$id_santri' AND STATUS = 'Tunggakan'";
            $result = mysqli_query($koneksi, $sql);
            $row = mysqli_fetch_array($result)
            ?>
            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Tagihan</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">
              Rp <?= number_format($row['SUM(NOMINAL)'], '0', ',', '.') ?>
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-exclamation-circle fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6 mb-4">
    <?php
    $sql = "SELECT STATUS FROM pembayaran WHERE ID_SANTRI = '$id_santri' ORDER BY TGL_BAYAR DESC LIMIT 1";
    $result = mysqli_query($koneksi, $sql);
    $data = mysqli_fetch_array($result);

    // $status = $data['STATUS'];

    // Menentukan apakah card harus disembunyikan
    // $hideCard = ($status === 'Valid' || $status === NULL);

    if ($data) {
      $status = $data['STATUS'];
      $hideCard = ($status === 'Valid' || $status === null);
    } else {
      // Set default values if no data found
      $status = '';
      $hideCard = true;
    }
    ?>
    <div class="card border-left-danger shadow h-100 py-2 <?php if ($hideCard) echo 'd-none'; ?>">
      <div class="card-body" data-toggle="tooltip" data-placement="bottom" title="Proses Bukti Upload Terakhir">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Status Validasi</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">
              <?php echo $status ?>
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-spell-check fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>