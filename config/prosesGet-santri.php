<?php

include 'koneksi.php';

if (isset($_GET['get'])) {
  $get = $_GET['get'];

  switch ($_GET['get']) {

      // Proses get kota berdasarkan provinsi
    case 'kota':
      if (isset($_POST['provinsiID'])) {
        $provinsiID = $_POST['provinsiID'];

        // Query untuk mendapatkan data kota berdasarkan ID Provinsi
        $query = "SELECT * FROM tbl_kabupaten WHERE ID_PROV = '$provinsiID'";
        $result = mysqli_query($koneksi, $query);

        $option = ''; //Opsi kosong
        while ($data = mysqli_fetch_assoc($result)) {
          $options .= '<option value="' . $data['ID_KAB'] . '">' . $data['NAMA_KAB'] . '</option>';
        }

        // Mengembalikan opsi kota
        echo $options;
      }

      break;

      // Proses get kamar berdasarkan asrama
    case 'kamar':
      if (isset($_POST['asramaID'])) {
        $asramaID = $_POST['asramaID'];

        // Query untuk mendapatkan data kota berdasarkan ID Asrama
        $query = "SELECT * FROM kamar WHERE ID_ASRAMA = '$asramaID'";
        $result = mysqli_query($koneksi, $query);

        while ($data = mysqli_fetch_assoc($result)) {
          $options .= '<option value="' . $data['ID_KAMAR'] . '">' . $data['NO_KAMAR'] . '</option>';
        }

        // Mengembalikan opsi kota
        echo $options;
      }

      break;

    default:
      # code...
      break;
  }
}
