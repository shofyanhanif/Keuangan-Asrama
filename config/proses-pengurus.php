<?php

include 'koneksi.php';

if (isset($_GET['action'])) {
  $action = $_GET['action'];

  switch ($_GET['action']) {

      // Tambah Data Asrama
    case 'tb_asrama':
      $id_asrama = $_POST['id_asrama'];
      $asrama = ucwords($_POST['asrama']);
      // Periksa apakah kode asrama sudah ada atau sama
      $cekQuery = "SELECT * FROM asrama WHERE ID_ASRAMA = '$id_asrama'";
      $cekResult = mysqli_query($koneksi, $cekQuery);

      if (mysqli_num_rows($cekResult) > 0) {
        // Jika kode asrama sudah ada, tampilkan pesan peringatan
        echo ("<script>
          alert('Kode Asrama sudah ada. Mohon gunakan kode asrama lain.');
          window.location='../pengurus/index.php?page=asrama';
          </script>");
        exit;
      }

      $query = "INSERT INTO asrama VALUES ('$id_asrama', '$asrama')";
      $tbasr = mysqli_query($koneksi, $query);

      if ($tbasr) {
        echo ("<script>
        window.alert('Tambah Data Berhasil');
        window.location='../pengurus/index.php?page=asrama';
        </script>");
      } else {
        ("<script>
        window.alert('Tambah Data Gagal');
        window.location='../pengurus/index.php?page=asrama';
        </script>");
      }

      break;

      // Edit Data Asrama
    case 'edit_asrama':
      $id_asrama = $_POST['id_asrama'];
      $asrama = ucwords($_POST['edit_asrama']);
      $query = "UPDATE asrama SET ASRAMA = '$asrama' WHERE ID_ASRAMA = '$id_asrama';";
      $hsledit = mysqli_query($koneksi, $query);

      if ($hsledit) {
        echo ("<script>
        window.alert('Edit Data Berhasil');
        window.location='../pengurus/index.php?page=asrama';
        </script>");
      } else {
        echo ("<script>
        window.alert('Edit Data Gagal');
        window.location='../pengurus/index.php?page=asrama';
        </script>");
      }
      break;

      // Hapus Data Asrama
    case 'dl_asrama':
      $id_asrama = $_GET['id_asrama'];
      $query = "DELETE FROM asrama WHERE ID_ASRAMA = '$id_asrama'";
      $dlasr = mysqli_query($koneksi, $query);

      if ($dlasr) {
        echo ("<script>
        window.location='../pengurus/index.php?page=asrama';
        </script>");
      } else {
        echo ("<script>
        window.location='../pengurus/index.php?page=asrama';
        </script>");
      }

      break;

      // Tambah Data Kamar
    case 'tb_kamar':
      $asrama = $_POST['asrama'];
      $kamar = ucwords($_POST['kamar']);
      $query = "INSERT INTO kamar (ID_ASRAMA, NO_KAMAR) VALUES ('$asrama' ,'$kamar')";
      $tbkmr = mysqli_query($koneksi, $query);

      if ($tbkmr) {
        echo ("<script>
          window.alert('Tambah Data Berhasil');
          window.location='../pengurus/index.php?page=kamar';
          </script>");
      } else {
        ("<script>
          window.alert('Tambah Data Gagal');
          window.location='../pengurus/index.php?page=kamar';
          </script>");
      }

      break;

      // Edit Data Kamar
    case 'edit_kamar':
      $id_kamar = $_POST['id_kamar'];
      $asrama = $_POST['asrama'];
      $kamar = ucwords($_POST['kamar']);
      $query = "UPDATE kamar SET ID_ASRAMA = '$asrama', NO_KAMAR = '$kamar' WHERE ID_KAMAR = '$id_kamar';";
      $hsledit = mysqli_query($koneksi, $query);

      if ($hsledit) {
        echo ("<script>
        window.alert('Edit Data Kamar Berhasil');
        window.location='../pengurus/index.php?page=kamar';
        </script>");
      } else {
        echo ("<script>
        window.alert('Edit Data Kamar Gagal');
        window.location='../pengurus/index.php?page=kamar';
        </script>");
      }
      break;

      // Hapus Data Kamar
    case 'dl_kamar':
      $id_kamar = $_GET['id_kamar'];
      $query = "DELETE FROM kamar WHERE ID_KAMAR = '$id_kamar'";
      $dlkmr = mysqli_query($koneksi, $query);

      if ($dlkmr) {
        echo ("<script>
          window.alert('Hapus Data Kamar Berhasil');
          window.location='../pengurus/index.php?page=kamar';
          </script>");
      } else {
        echo ("<script>
          window.alert('Hapus Data Kamar Gagal');
          window.location='../pengurus/index.php?page=kamar';
          </script>");
      }

      break;

      // Tambah Data Lembaga
    case 'tb_lembaga':
      $lembaga = strtoupper($_POST['lembaga']);
      $query = "INSERT INTO lembaga (NAMA_LEMBAGA) VALUES ('$lembaga')";
      $tblmb = mysqli_query($koneksi, $query);

      if ($tblmb) {
        echo ("<script>
          window.alert('Tambah Data Berhasil');
          window.location='../pengurus/index.php?page=lembaga';
          </script>");
      } else {
        ("<script>
          window.alert('Tambah Data Gagal');
          window.location='../pengurus/index.php?page=lembaga';
          </script>");
      }

      break;

      // Edit Data Lembaga
    case 'edit_lembaga':
      $id = $_POST['id_lembaga'];
      $lembaga = strtoupper($_POST['lembaga']);
      $query = "UPDATE lembaga SET NAMA_LEMBAGA = '$lembaga' WHERE ID_LEMBAGA = '$id'";
      $edlmb = mysqli_query($koneksi, $query);

      if ($edlmb) {
        echo ("<script>
          window.alert('Edit Data Berhasil');
          window.location='../pengurus/index.php?page=lembaga';
          </script>");
      } else {
        ("<script>
          window.alert('Edit Data Gagal');
          window.location='../pengurus/index.php?page=lembaga';
          </script>");
      }

      break;

      // Hapus Data Lembaga
    case 'dl_lembaga':
      $id_lembaga = $_GET['id_lembaga'];
      $query = "DELETE FROM lembaga WHERE ID_LEMBAGA = '$id_lembaga'";
      $dllmb = mysqli_query($koneksi, $query);

      if ($dllmb) {
        echo ("<script>
          window.alert('Hapus Data Berhasil');
          window.location='../pengurus/index.php?page=lembaga';
          </script>");
      } else {
        ("<script>
          window.alert('Hapus Data Gagal');
          window.location='../pengurus/index.php?page=lembaga';
          </script>");
      }

      break;

      // Tambah Data Biaya
    case 'tb_biaya':
      $asrama = $_POST['asrama'];
      $tahun = $_POST['tahun'];
      $kategori = ucwords($_POST['kategori']);
      $nominal = $_POST['nominal'];
      $query = "INSERT INTO spp (TAHUN, ID_ASRAMA, KATEGORI, NOMINAL) VALUES ('$tahun', '$asrama', '$kategori', '$nominal')";
      $tmbspp = mysqli_query($koneksi, $query);

      if ($tmbspp) {
        echo ("<script>
        window.alert('Tambah Data Berhasil');
        window.location='../pengurus/index.php?page=biaya';
        </script>");
      } else {
        ("<script>
        window.alert('Tambah Data Gagal');
        window.location='../pengurus/index.php?page=biaya';
        </script>");
      }

      break;

      // Edit Data Biaya
    case 'edit_biaya':
      $id_spp = $_POST['id_spp'];
      $tahun = $_POST['tahun'];
      $kategori = ucwords($_POST['kategori']);
      $nominal = $_POST['nominal'];
      $query = "UPDATE spp SET TAHUN = '$tahun', KATEGORI = '$kategori', NOMINAL = '$nominal' WHERE ID_SPP = '$id_spp' ";
      $edspp = mysqli_query($koneksi, $query);

      if ($edspp) {
        echo ("<script>
            window.alert('Edit Data Berhasil');
            window.location='../pengurus/index.php?page=biaya';
            </script>");
      } else {
        echo ("<script>
            window.alert('Edit Data Gagal');
            window.location='../pengurus/index.php?page=biaya';
            </script>");
      }

      break;

      // Hapus Data Biaya
    case 'dl_biaya':
      $idspp = $_GET['id_spp'];
      $query = "DELETE FROM spp WHERE ID_SPP = '$idspp'";
      $dlspp = mysqli_query($koneksi, $query);

      if ($dlspp) {
        echo ("<script>
          window.alert('Hapus Data Berhasil');
          window.location='../pengurus/index.php?page=biaya';
          </script>");
      } else {
        echo ("<script>
          window.alert('Hapus Data Gagal');
          window.location='../pengurus/index.php?page=biaya';
          </script>");
      }

      break;

      // Buat Pembayaran
    case 'tb_bayar':
      // Mendapatkan tahun dan bulan sekarang
      $year = date('y');
      $month = date('m');
      $id_petugas = $_POST['id_petugas'];
      $id_santri = $_POST['id_santri'];
      $idsantri_3 = substr($id_santri, -3);
      $id_asrama = substr($id_santri, 0, 2);

      // Mengambil urutan ID terakhir dari tabel pembayaran
      $query = "SELECT MAX(ID_PEMBAYARAN) as max_id FROM pembayaran";
      $result = mysqli_query($koneksi, $query);
      $row = mysqli_fetch_assoc($result);
      $max_id = $row['max_id'];

      // Membuat urutan ID baru
      if ($max_id) {
        $urutan = (int) substr($max_id, -3); // Mengambil 3 digit terakhir dari ID terakhir dan mengubahnya menjadi integer
        $urutan++; // Menambahkan 1 ke urutan
      } else {
        $urutan = 1; // Jika belum ada data, mulai dari 1
      }

      // Membuat ID pembayaran dengan format yang diinginkan
      $idPembayaran = "BPLD" . $id_petugas . $year . $month . $id_asrama . $idsantri_3 . str_pad($urutan, 3, '0', STR_PAD_LEFT);

      $id = $idPembayaran;
      $tgl = date('Y-m-d');
      $nominal = $_POST['jumlah'];
      $update = "UPDATE tagihan SET STATUS = 'Lunas' WHERE ID_SANTRI = '$id_santri'";
      $insert = "INSERT INTO pembayaran (ID_PEMBAYARAN, ID_PETUGAS, ID_SANTRI, TGL_BAYAR, NOMINAL, JENIS_BAYAR) VALUES ('$id', '$id_petugas', '$id_santri', '$tgl', '$nominal', 'Langsung')";
      $upbyr = mysqli_query($koneksi, $update);
      $tbbyr = mysqli_query($koneksi, $insert);

      if ($upbyr) {
        echo ("<script>
            window.alert('Pembayaran Berhasil');
            window.location='../pengurus/index.php?page=bayar';
            </script>");
      } else {
        echo ("<script>
            window.alert('Pembayaran Gagal');
            window.location='../pengurus/index.php?page=bayar';
            </script>");
      }

      if ($tbbyr) {
        echo ("<script>
            window.alert('Pembayaran Berhasil');
            window.location='../pengurus/index.php?page=riwayat';
            </script>");
      } else {
        echo ("<script>
            window.alert('Pembayaran Gagal');
            window.location='../pengurus/index.php?page=bayar';
            </script>");
      }

      break;

      // Proses Validasi Valid
    case 'validasi':
      $id_santri = $_POST['id_santri'];
      $validasi = $_POST['validasi'];
      $message = $_POST['message'];

      if ($validasi == 'Tidak Valid') {
        $query = "UPDATE pembayaran SET STATUS = '$validasi', KET = '$message' WHERE ID_SANTRI = '$id_santri'";
        $result = mysqli_query($koneksi, $query);

        if ($result) {
          echo ("<script>
            window.alert('Proses Berhasil');
            window.location='../pengurus/index.php?page=validasi';
            </script>");
        } else {
          echo ("<script>
            window.alert('Proses Gagal');
            window.location='../pengurus/index.php?page=validasi';
            </script>");
        }
      } elseif ($validasi == 'Valid') {
        $query = "UPDATE pembayaran SET STATUS = '$validasi', KET = NULL WHERE ID_SANTRI = '$id_santri'";
        $sql = "UPDATE tagihan SET STATUS = 'Lunas' WHERE ID_SANTRI = '$id_santri'";
        $up1 = mysqli_query($koneksi, $query);
        $up2 = mysqli_query($koneksi, $sql);

        if ($up1 && $up2) {
          echo ("<script>
            window.alert('Validasi Berhasil');
            window.location='../pengurus/index.php?page=validasi';
            </script>");
        } else {
          echo ("<script>
            window.alert('Validasi Gagal');
            window.location='../pengurus/index.php?page=validasi';
            </script>");
        }
      }

      break;

      // Proses Validasi Invalid
    case 'invalid':
      $id_santri = $_GET['id_santri'];
      $message = $_POST['message'];
      $query = "UPDATE pembayaran SET STATUS = 'Tidak Valid', KET = '$message' WHERE ID_SANTRI = '$id_santri'";
      $invld = mysqli_query($koneksi, $query);

      if ($invld) {
        echo ("<script>
            window.alert('Proses Berhasil');
            window.location='../pengurus/index.php?page=validasi';
            </script>");
      } else {
        echo ("<script>
            window.alert('Proses Gagal');
            window.location='../pengurus/index.php?page=validasi';
            </script>");
      }

      break;

      // Tambah Data Pengeluaran
    case 'tb_pengeluaran':
      $tgl = date('Y-m-d');
      $ket = ucwords($_POST['keterangan']);
      $jml = $_POST['nominal'];
      $query = "INSERT INTO pengeluaran (TANGGAL, KETERANGAN, NOMINAL) VALUES ('$tgl', '$ket', '$jml');";
      $tbkel = mysqli_query($koneksi, $query);

      if ($tbkel) {
        echo ("<script>
            window.alert('Tambah Data Berhasil');
            window.location='../pengurus/index.php?page=pengeluaran';
            </script>");
      } else {
        echo ("<script>
            window.alert('Tambah Data Gagal');
            window.location='../pengurus/index.php?page=pengeluaran';
            </script>");
      }

      break;

      // Hapus Data Pengeluaran
    case 'dl_pengeluaran':
      $idkel = $_GET['id_kel'];
      $query = "DELETE FROM pengeluaran WHERE ID_PENGELUARAN = '$idkel'";
      $dlkel = mysqli_query($koneksi, $query);

      if ($dlkel) {
        echo ("<script>
          window.alert('Hapus Data Berhasil');
          window.location='../pengurus/index.php?page=pengeluaran';
          </script>");
      } else {
        echo ("<script>
          window.alert('Hapus Data Gagal');
          window.location='../pengurus/index.php?page=pengeluaran';
          </script>");
      }
      break;

      // Edit Data Santri
    case 'edit_santri':
      $id_santri = $_POST['id_santri'];
      $nama = $_POST['nama'];
      // $email = $_POST['email'];
      $tempat = ucwords($_POST['tempat']);
      $tgl = $_POST['tgl'];
      $alamat = ucwords($_POST['alamat']);
      $provinsi = $_POST['provinsi'];
      $kota = $_POST['kota'];
      $hp = $_POST['no_hp'];
      $asrama = $_POST['asrama'];
      $kamar = $_POST['kamar'];
      $lembaga = $_POST['lembaga'];
      $query = "UPDATE santri SET ID_ASRAMA = '$asrama', ID_KAMAR = '$kamar', ID_LEMBAGA = '$lembaga', NAMA = '$nama', TEMPAT_LHR = '$tempat', TGL_LAHIR = '$tgl', ALAMAT = '$alamat', ID_PROVINSI = '$provinsi', ID_KOTA = '$kota', NO_HP = '$hp' WHERE ID_SANTRI = '$id_santri' ";
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

      // Hapus Data Santri
    case 'dl_santri':
      $id_santri = $_GET['id_santri'];
      $query = "UPDATE santri SET ID_ASRAMA = NULL, ID_LEMBAGA = NULL, TGL_LAHIR = NULL, ALAMAT = NULL, NO_HP = NULL WHERE ID_SANTRI = '$id_santri'";
      $dldt = mysqli_query($koneksi, $query);

      if ($dldt) {
        echo ("<script>
        window.alert('Hapus Data Berhasil');
        window.location='../pengurus/index.php?page=santri';
        </script>");
      } else {
        echo ("<script>
        window.alert('Hapus Data Gagal');
        window.location='../pengurus/index.php?page=santri';
        </script>");
      }

      break;
  }
}
