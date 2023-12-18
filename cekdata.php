<?php
session_start();

include 'config/koneksi.php';
// Cek apakah pengguna sudah login
if (!isset($_SESSION['ID_SANTRI']) || $_SESSION['LEVEL'] !== 'Santri') {

  $id = $_SESSION['ID_SANTRI'];

  // Periksa data lengkap berdasarkan ID pengguna
    $sql = "SELECT * FROM santri s LEFT JOIN asrama a ON s.ID_ASRAMA = a.ID_ASRAMA LEFT JOIN kamar k ON s.ID_KAMAR = k.ID_KAMAR LEFT JOIN lembaga l ON s.ID_LEMBAGA = l.ID_LEMBAGA WHERE s.ID_SANTRI = '$id' ";
    $result = mysqli_query($koneksi, $sql);
  
  if ($result) {
    $user = mysqli_fetch_assoc($result);

    // Cek apakah data lengkap
    if (empty($user['TGL_LAHIR'])) {
      // Data belum lengkap, arahkan ke halaman lengkapi data diri
      header("Location:santri/tmb-profil.php");
      exit;
    } else {
      header("Location:santri");
      // Data sudah lengkap, lanjutkan proses login atau tampilkan halaman beranda
      // ...
    }
  } else {
    echo "Error: " . mysqli_error($koneksi);
  }
} else {
  // Pengguna belum login, arahkan ke halaman login
  header("Location:login.php");
  exit;
}
