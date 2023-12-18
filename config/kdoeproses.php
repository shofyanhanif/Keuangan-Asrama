<?php

// Proses Cek Upload Foto
$targetDir = '../bukti-img/'; // Direktori tempat menyimpan file
$targetFile = $targetDir . basename($_FILES['buktiPembayaran']['name']);
$uploadOk = true;
$errorMessage = '';

// Periksa apakah file sudah diupload dengan benar
if (!isset($_FILES['buktiPembayaran']) || $_FILES['buktiPembayaran']['error'] !== UPLOAD_ERR_OK) {
  $errorMessage = 'Terjadi kesalahan saat mengupload file.';
  $uploadOk = false;
}

// Jika semua validasi sukses, lakukan upload file
if ($uploadOk) {
  if (move_uploaded_file($_FILES['buktiPembayaran']['tmp_name'], $targetFile)) {
    // File berhasil diupload, simpan nama file ke dalam database
    $namaFile = basename($_FILES['buktiPembayaran']['name']);

    // Proses Cek Upload Bukti Pembayaran
    $query = "SELECT * FROM pembayaran WHERE ID_SANTRI = '$id_santri' AND YEAR(TGL_BAYAR) = '$year' AND MONTH(TGL_BAYAR) = '$month'";
    $result = mysqli_query($koneksi, $query);

    // Jika bukti pembayaran sudah pernah diupload
    if (mysqli_num_rows($result) > 0) {
      echo '<script>alert("Bukti pembayaran sudah pernah diupload untuk bulan ini.");</script>';
      echo '<script>window.location="../santri/index.php?page=tagihan";</script>';
      exit;
    } else {
      // Proses Utama
      $id = $idPembayaran;
      $tgl = date('Y-m-d');
      $jumlah = $_POST['jumlah'];
      $status = 'Menunggu';
      $jenis = 'Online';

      $query = "INSERT INTO pembayaran (ID_PEMBAYARAN, ID_SANTRI, TGL_BAYAR, NOMINAL, JENIS_BAYAR, BUKTI, STATUS) VALUES ('$id', '$id_santri', '$tgl', '$jumlah', '$jenis', '$namaFile', '$status')";
      $result = mysqli_query($koneksi, $query);

      if ($result) {
        echo '<script>alert("Upload Bukti Berhasil");</script>';
        echo '<script>window.location="../santri/index.php?page=riwayat";</script>';
        exit;
      } else {
        echo '<script>alert("Upload Bukti Gagal saat menyimpan data pembayaran");</script>';
        echo '<script>window.location="../santri/index.php?page=tagihan";</script>';
        exit;
      }
    }
  } else {
    $errorMessage = 'Terjadi kesalahan saat mengupload file.';
    echo '<script>alert("' . $errorMessage . '");</script>';
    echo '<script>window.location="../santri/index.php?page=tagihan";</script>';
    exit;
  }
}
