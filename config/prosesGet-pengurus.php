<?php

include 'koneksi.php';

if (isset($_GET['get'])) {
  $get = $_GET['get'];

  switch ($_GET['get']) {

      // Proses get kota berdasarkan provinsi
    case 'kota':
      if (isset($_POST['idProvinsi'])) {
        $idProvinsi = $_POST['idProvinsi'];

        $query = "SELECT * FROM tbl_kabupaten WHERE ID_PROV = '$idProvinsi'";
        $result = mysqli_query($koneksi, $query);

        $dataKota = '';
        while ($row = mysqli_fetch_assoc($result)) {
          $dataKota .= '<option value="' . $row['ID_KAB'] . '">' . $row['NAMA_KAB'] . '</option>';
        }

        echo $dataKota;
      }

      break;

      // Proses get data kota berdasarkan id_santri
    case 'alamatSantri':
      $idSantri = $_POST['id_santri'];

      // Query untuk mendapatkan data santri berdasarkan id_santri
      $querySantri = "SELECT s.*, p.NAMA_PROV, k.NAMA_KAB
                FROM santri s
                LEFT JOIN tbl_provinsi p ON s.ID_PROVINSI = p.ID_PROV
                LEFT JOIN tbl_kabupaten k ON s.ID_KOTA = k.ID_KAB
                WHERE s.ID_SANTRI = '$idSantri'";
      $resultSantri = mysqli_query($koneksi, $querySantri);
      $dataSantri = mysqli_fetch_assoc($resultSantri);

      echo json_encode($dataSantri);

      break;

      // Proses get kamar berdasarkan asrama
    case 'kamar':
      if (isset($_POST['idAsrama'])) {
        $idAsrama = $_POST['idAsrama'];

        $query = "SELECT * FROM kamar WHERE ID_ASRAMA = '$idAsrama'";
        $result = mysqli_query($koneksi, $query);

        $dataKamar = '';
        while ($row = mysqli_fetch_assoc($result)) {
          $dataKamar .= '<option value="' . $row['ID_KAMAR'] . '">' . $row['NO_KAMAR'] . '</option>';
        }

        echo $dataKamar;
      }
      break;

    case 'kamarSantri':
      $idSantri = $_POST['id_santri'];

      // Query untuk mendapatkan data santri berdasarkan id_santri
      $querySantri = "SELECT s.*, a.ASRAMA, k.NO_KAMAR
                FROM santri s
                LEFT JOIN asrama a ON s.ID_ASRAMA = a.ID_ASRAMA
                LEFT JOIN kamar k ON s.ID_KAMAR = k.ID_KAMAR
                WHERE s.ID_SANTRI = '$idSantri'";
      $resultSantri = mysqli_query($koneksi, $querySantri);
      $dataSantri = mysqli_fetch_assoc($resultSantri);

      echo json_encode($dataSantri);

      break;

      // Proses get pembayaran langsung 
    case 'pembayaran':
      if (isset($_POST['id_santri'])) {
        $idSantri = $_POST['id_santri'];

        $query = "SELECT * FROM tagihan t JOIN santri s ON t.ID_SANTRI = s.ID_SANTRI WHERE t.ID_SANTRI = '$idSantri' AND t.STATUS = 'Tunggakan'";
        $result = mysqli_query($koneksi, $query);

        if (mysqli_num_rows($result) > 0) {
          $tableHTML = '';

          $no = 1;
          $total = 0;

          while ($row = mysqli_fetch_array($result)) {
            $nominal = 'Rp ' . number_format($row['NOMINAL'], 0, ',', '.');
            $tableHTML .= "<tr>
                            <td>{$no}</td>
                            <td>{$row['ID_SANTRI']}</td>
                            <td>{$row['NAMA']}</td>
                            <td>{$row['TAHUN']}</td>
                            <td>{$row['BULAN']}</td>
                            <td>{$row['KATEGORI']}</td>
                            <td>{$nominal}</td>
                          </tr>";

            $no++;
          }

          echo $tableHTML;
        }
      }

      break;

    case 'detail-pembayaran':
      
      break;

      // Proses get laporan semua kategori
    case 'laporan':
      $tgl_awal = $_POST['tgl_awal'];
      $tgl_akhir = $_POST['tgl_akhir'];

      // Query untuk mengambil data dari tabel pembayaran
      $queryPemasukan = "SELECT * FROM pembayaran p JOIN santri s ON p.ID_SANTRI = s.ID_SANTRI WHERE p.TGL_BAYAR BETWEEN '$tgl_awal' AND '$tgl_akhir' AND p.STATUS IS NULL OR p.STATUS = 'Valid'";
      $resultPemasukan = mysqli_query($koneksi, $queryPemasukan);

      // Query untuk mengambil data dari tabel pengeluaran
      $queryPengeluaran = "SELECT * FROM pengeluaran WHERE TANGGAL BETWEEN '$tgl_awal' AND '$tgl_akhir'";
      $resultPengeluaran = mysqli_query($koneksi, $queryPengeluaran);

      $cekPemasukan = mysqli_num_rows($resultPemasukan);
      $cekPengeluaran = mysqli_num_rows($resultPengeluaran);

      if ($cekPemasukan > 0 || $cekPengeluaran > 0) {
        // Variabel untuk menyimpan hasil HTML
        $html = '';

        // Variabel untuk menyimpan total pemasukan dan pengeluaran
        $totalPemasukan = 0;
        $totalPengeluaran = 0;

        $no = 1;

        while ($dataPemasukan = mysqli_fetch_array($resultPemasukan)) {
          $tanggal = date('d-m-Y', strtotime($dataPemasukan['TGL_BAYAR']));
          $nama_santri = $dataPemasukan['NAMA'];
          $keterangan = "Pembayaran tagihan bulanan a/n $nama_santri";
          $pemasukan = $dataPemasukan['NOMINAL'];
          $formatPemasukan = 'Rp ' . number_format($pemasukan, 0, ',', '.');

          $html .= "<tr>
                      <td>$no</td>
                      <td>$tanggal</td>
                      <td>$keterangan</td>
                      <td>$formatPemasukan</td>
                      <td>-</td>
                    </tr>";

          $totalPemasukan += $pemasukan;

          $no++;
        }

        while ($dataPengeluaran = mysqli_fetch_array($resultPengeluaran)) {
          $tanggal = date('d-m-Y', strtotime($dataPengeluaran['TANGGAL']));
          $keterangan = $dataPengeluaran['KETERANGAN'];
          $pengeluaran = $dataPengeluaran['NOMINAL'];
          $formatPengeluaran = 'Rp ' . number_format($pengeluaran, 0, ',', '.');

          $html .= "<tr>
                      <td>$no</td>
                      <td>$tanggal</td>
                      <td>$keterangan</td>
                      <td>-</td>
                      <td>$formatPengeluaran</td>
                    </tr>";

          $totalPengeluaran += $pengeluaran;

          $no++;
        }

        // Hitung total saldo (pemasukan - pengeluaran)
        $totalSaldo = $totalPemasukan - $totalPengeluaran;
        $formatTotal = 'Rp ' . number_format($totalSaldo, 0, ',', '.');

        $html .= "<tr>
                    <td colspan='3'><strong>Total Pemasukan</strong></td>
                    <td>" . ($totalPemasukan > 0 ? 'Rp ' . number_format($totalPemasukan, 0, ',', '.') : '-') . "</td>
                    <td>-</td>
                  </tr>";

        $html .= "<tr>
                    <td colspan='3'><strong>Total Pengeluaran</strong></td>
                    <td>-</td>
                    <td>" . ($totalPengeluaran > 0 ? 'Rp ' . number_format($totalPengeluaran, 0, ',', '.') : '-') . "</td>
                  </tr>";

        $html .= "<tr>
                    <td colspan='3'><strong>TOTAL SALDO</strong></td>
                    <td colspan='2'><strong>$formatTotal</strong></td>
                  </tr>";

        echo $html;
      } else {
        echo '<tr><td colspan="5">Tidak ada transaksi</td></tr>';
      }

      break;

      // Proses get laporan kategori pemasukan
    case 'laporan-pemasukan':
      // Ambil nilai tanggal awal dan akhir dari request POST
      $tgl_awal = $_POST['tgl_awal'];
      $tgl_akhir = $_POST['tgl_akhir'];

      // Lakukan query untuk mengambil data dari tabel pembayaran
      $query = "SELECT * FROM pembayaran p JOIN santri s ON p.ID_SANTRI = s.ID_SANTRI WHERE p.TGL_BAYAR BETWEEN '$tgl_awal' AND '$tgl_akhir' AND p.STATUS IS NULL OR p.STATUS = 'Valid'";
      $result = mysqli_query($koneksi, $query);

      $cekPemasukan = mysqli_num_rows($result);

      if ($cekPemasukan > 0) {
        // Buat variabel untuk menyimpan hasil HTML
        $html = '';

        // Buat variabel untuk menyimpan total pemasukan
        $total = 0;

        // Buat nomor urut
        $no = 1;

        // Loop untuk menambahkan data pemasukan ke dalam HTML dan menghitung total pemasukan
        while ($data = mysqli_fetch_array($result)) {
          $tanggal = date('d-m-Y', strtotime($data['TGL_BAYAR']));
          $nama_santri = $data['NAMA'];
          $keterangan = "Pembayaran tagihan bulanan a/n $nama_santri";
          $pemasukan = $data['NOMINAL'];
          $formatPemasukan = 'Rp ' . number_format($pemasukan, 0, ',', '.');

          $html .= "<tr>
                      <td>$no</td>
                      <td>$tanggal</td>
                      <td>$keterangan</td>
                      <td>$formatPemasukan</td>
                    </tr>";

          $total += $pemasukan;
          $formatTotal = 'Rp ' . number_format($total, 0, ',', '.');

          $no++;
        }

        // Buat baris total pemasukan
        $html .= "<tr>
                    <td colspan='3'><strong>TOTAL</strong></td>
                    <td><strong>$formatTotal</strong></td>
                  </tr>";

        // Mengembalikan HTML sebagai response
        echo $html;
      } else {
        echo '<tr><td colspan="4">Tidak ada transaksi</td></tr>';
      }

      break;

      // Proses get laporan kategori pengeluaran
    case 'laporan-pengeluaran':
      // Ambil nilai tanggal awal dan akhir dari request POST
      $tgl_awal = $_POST['tgl_awal'];
      $tgl_akhir = $_POST['tgl_akhir'];

      // Lakukan query untuk mengambil data dari tabel pengeluaran
      $query = "SELECT * FROM pengeluaran WHERE TANGGAL BETWEEN '$tgl_awal' AND '$tgl_akhir'";
      $result = mysqli_query($koneksi, $query);

      $cekPengeluaran = mysqli_num_rows($result);

      if ($cekPengeluaran > 0) {
        // Buat variabel untuk menyimpan hasil HTML
        $html = '';

        // Buat variabel untuk menyimpan total pengeluaran
        $total = 0;

        // Buat nomor urut
        $no = 1;

        // Loop untuk menambahkan data pengeluaran ke dalam HTML dan menghitung total pengeluaran
        while ($data = mysqli_fetch_array($result)) {
          $tanggal = date('d-m-Y', strtotime($data['TANGGAL']));
          $keterangan = $data['KETERANGAN'];
          $pengeluaran = $data['NOMINAL'];
          $formatPengeluaran = 'Rp ' . number_format($pengeluaran, 0, ',', '.');

          $html .= "<tr>
              <td>$no</td>
              <td>$tanggal</td>
              <td>$keterangan</td>
              <td>$formatPengeluaran</td>
            </tr>";

          $total += $pengeluaran;
          $formatTotal = 'Rp ' . number_format($total, 0, ',', '.');

          $no++;
        }

        // Buat baris total pengeluaran
        $html .= "<tr>
            <td colspan='3'><strong>TOTAL</strong></td>
            <td><strong>$formatTotal</strong></td>
          </tr>";

        // Mengembalikan HTML sebagai response
        echo $html;
      } else {
        echo '<tr><td colspan="4">Tidak ada transaksi</td></tr>';
      }

      break;

    default:
      # code...
      break;
  }
}
