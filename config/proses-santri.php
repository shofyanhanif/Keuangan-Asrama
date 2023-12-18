<?php

include 'koneksi.php';

if (isset($_GET['action'])) {
  $action = $_GET['action'];

  switch ($_GET['action']) {

      // Proses Bayar Tagihan Secara Online
    case 'tb_byr-on':
      // Mendapatkan tahun dan bulan sekarang
      $year = date('y');
      $month = date('m');
      $id_petugas = 0;
      $id_santri = $_POST['id_santri'];
      $idsantri_3 = substr($id_santri, -3);
      $id_asrama = substr($id_santri, 0, 2);

      // Mengambil urutan ID terakhir dari tabel pembayaran
      $sql = "SELECT MAX(ID_PEMBAYARAN) as max_id FROM pembayaran";
      $result = mysqli_query($koneksi, $sql);
      $row = mysqli_fetch_assoc($result);
      $max_id = $row['max_id'];

      // Membuat urutan ID baru
      if ($max_id) {
        $urutan = (int) substr($max_id, -3); // Mengambil 3 digit terakhir dari ID terakhir dan mengubahnya menjadi integer
        $urutan++; // Menambahkan 1 ke urutan
      } else {
        $urutan = 0; // Jika belum ada data, mulai dari 1
      }

      // Membuat ID pembayaran dengan format yang diinginkan
      $idPembayaran = "BPOD" . $id_petugas . $year . $month . $id_asrama . $idsantri_3 . str_pad($urutan, 3, '0', STR_PAD_LEFT);

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


          // Proses Utama
          $tgl = date('Y-m-d');
          $jumlah = $_POST['jumlah'];
          $status = 'Menunggu';
          $jenis = 'Online';

          $query = "INSERT INTO pembayaran (ID_PEMBAYARAN, ID_SANTRI, TGL_BAYAR, NOMINAL, JENIS_BAYAR, BUKTI, STATUS) VALUES ('$idPembayaran', '$id_santri', '$tgl', '$jumlah', 'Online', '$namaFile', '$status')";
          $result = mysqli_query($koneksi, $query);

          if ($result) {
            echo '<script>alert("Upload bukti pembayaran berhasil.");</script>';
            echo '<script>window.location="../santri/index.php?page=riwayat";</script>';
            exit;
          } else {
            echo '<script>alert("Terjadi kesalahan saat menyimpan data pembayaran.");</script>';
            echo '<script>window.location="../santri/index.php?page=tagihan";</script>';
            exit;
          }
        } else {
          $errorMessage = 'Terjadi kesalahan saat mengupload file.';
          echo '<script>alert("' . $errorMessage . '");</script>';
          echo '<script>window.location="../santri/index.php?page=tagihan";</script>';
          exit;
        }
      }

      break;

    case 'upd_bukti':
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

          // Proses Utama
          $id = $_POST['id_pembayaran'];
          $status = 'Menunggu';

          $query = "UPDATE pembayaran SET BUKTI = '$namaFile', STATUS = '$status' WHERE ID_PEMBAYARAN = '$id'";
          $result = mysqli_query($koneksi, $query);

          if ($result) {
            echo '<script>alert("Upload ulang bukti pembayaran berhasil");</script>';
            echo '<script>window.location="../santri/index.php?page=riwayat";</script>';
            exit;
          } else {
            echo '<script>alert("Upload ulang bukti pembayaran gagal");</script>';
            echo '<script>window.location="../santri/index.php?page=riwayat";</script>';
            exit;
          }
        } else {
          $errorMessage = 'Terjadi kesalahan saat mengupload file.';
          echo '<script>alert("' . $errorMessage . '");</script>';
          echo '<script>window.location="../santri/index.php?page=riwayat";</script>';
          exit;
        }
      }

      break;

      // Tambah Data Santri, proses ini digunakan pada halaman lengkapi profil
    case 'tb_santri':
      $id = $_POST['id_santri'];
      $nama = $_POST['nama'];
      $email = $_POST['email'];
      $tempat = ucwords($_POST['tempat']);
      $tgl = $_POST['date'];
      $jk = $_POST['jk'];
      $alamat = ucwords($_POST['alamat']);
      $provinsi = ucwords($_POST['provinsi']);
      $kota = ucwords($_POST['kota']);
      $hp = $_POST['no_hp'];
      // $thn = $_POST['thn_masuk'];
      // $asrama = $_POST['asrama'];
      $kamar = $_POST['kamar'];
      $lembaga = $_POST['lembaga'];
      $query = "UPDATE santri SET ID_KAMAR = '$kamar', ID_LEMBAGA = '$lembaga', NAMA = '$nama', EMAIL = '$email', TEMPAT_LHR = '$tempat', TGL_LAHIR = '$tgl', JK = '$jk', ALAMAT = '$alamat', ID_PROVINSI = '$provinsi', ID_KOTA = '$kota', NO_HP = '$hp' WHERE ID_SANTRI = '$id' ";
      $hsledit = mysqli_query($koneksi, $query);

      if ($hsledit) {
        echo ("<script>
        window.alert('Tambah Data User Berhasil');
        window.location='../santri/index.php?page=dashboard';
        </script>");
      } else {
        $error = mysqli_error($koneksi);
        echo ("<script>
        window.alert('Tambah Data User Gagal:" . $error . "');
        window.location='../santri/lengkapi-profil.php';
        </script>");
      }

      break;

      // Edit Data Santri
    case 'edit_santri':
      $id_santri = $_POST['id_santri'];
      $nama = $_POST['nama'];
      $email = $_POST['email'];
      $tempat = ucwords($_POST['tempat']);
      $tgl = $_POST['tgl'];
      $alamat = ucwords($_POST['alamat']);
      // $provinsi = $_POST['provinsi'];
      // $kota = $_POST['kota'];
      $hp = $_POST['no_hp'];
      $asrama = $_POST['asrama'];
      // $kamar = $_POST['kamar'];
      $lembaga = $_POST['lembaga'];
      $query = "UPDATE santri SET ID_ASRAMA = '$asrama', ID_LEMBAGA = '$lembaga', EMAIL = '$email', NAMA = '$nama', TEMPAT_LHR = '$tempat', TGL_LAHIR = '$tgl', ALAMAT = '$alamat', NO_HP = '$hp' WHERE ID_SANTRI = '$id_santri' ";
      $edstr = mysqli_query($koneksi, $query);

      if ($edstr) {
        echo ("<script>
        window.alert('Edit Data Berhasil');
        window.location='../pengurus/index.php?page=santri';
        </script>");
      } else {
        echo ("<script>
        window.alert('Edit Data Gagal');
        window.location='../pengurus/index.php?page=santri';
        </script>");
      }
      break;
  }
}
