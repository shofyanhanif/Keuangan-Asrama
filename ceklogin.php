<?php

include 'config/koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

$queryPetugas = "SELECT * FROM petugas p JOIN level l ON p.ID_LEVEL = l.ID_LEVEL WHERE USERNAME = '$username'";
$resultPetugas = mysqli_query($koneksi, $queryPetugas);
$rowPetugas = mysqli_fetch_array($resultPetugas);

$querySantri = "SELECT * FROM santri s JOIN level l ON s.ID_LEVEL = l.ID_LEVEL WHERE s.ID_SANTRI = '$username'";
$resultSantri = mysqli_query($koneksi, $querySantri);
$rowSantri = mysqli_fetch_assoc($resultSantri);

// const myName = "Hanif";

if ($rowPetugas) {
  if ($rowPetugas['PASSWORD'] == $password) {
    session_start();
    $_SESSION['ID_PETUGAS'] = $rowPetugas['ID_PETUGAS'];
    $_SESSION['NAMA_PETUGAS'] = $rowPetugas['NAMA_PETUGAS'];
    $_SESSION['USERNAME'] = $rowPetugas['USERNAME'];
    $_SESSION['LEVEL'] = $rowPetugas['LEVEL'];

    // Redirect ke halaman sesuai level petugas
    if ($rowPetugas['LEVEL'] == 'Admin') {
      header("Location: admin");
      exit();
    } elseif ($rowPetugas['LEVEL'] == 'Pengasuh') {
      header("Location: pengasuh");
      exit();
    } elseif ($rowPetugas['LEVEL'] == 'Pengurus') {
      header("Location: pengurus");
      exit();
    }
  } else {
    // Password salah
    echo "<script>alert('Username atau password salah.'); window.location='login.php';</script>";
    exit();
  }
} elseif ($rowSantri) {
  if ($rowSantri['PASSWORD'] == $password) {
    session_start();
    $_SESSION['ID_SANTRI'] = $rowSantri['ID_SANTRI'];
    $_SESSION['LEVEL'] = $rowSantri['LEVEL'];
    $_SESSION['NAMA'] = $rowSantri['NAMA'];
    $_SESSION['ID_ASRAMA'] = $rowSantri['ID_ASRAMA'];
    $_SESSION['THN_MASUK'] = $rowSantri['THN_MASUK'];
    $_SESSION['STATUS'] = $rowSantri['STATUS'];

    // Pengecekan kelengkapan data santri
    if (empty($rowSantri['TEMPAT_LHR']) || empty($rowSantri['TGL_LAHIR']) || empty($rowSantri['JK'])) {
      // Data santri belum lengkap, redirect ke halaman lengkapi_data
      header("Location: santri/lengkapi-profil.php");
      exit();
    }

    // Redirect ke halaman santri
    header("Location: santri");
    exit();
  } else {
    // Password salah
    echo "<script>alert('Username atau password salah.'); window.location='login.php';</script>";
    exit();
  }
} else {
  // Tidak ada data yang sesuai
  echo "<script>alert('Username tidak ditemukan.'); window.location='login.php';</script>";
  exit();
}