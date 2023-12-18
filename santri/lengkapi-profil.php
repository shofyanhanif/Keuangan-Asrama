<?php
include "../config/koneksi.php";

session_start();

if (!isset($_SESSION['ID_SANTRI']) || $_SESSION['LEVEL'] !== 'Santri') {

  header("Location:../login.php");
  exit();
}

$id_santri = $_SESSION['ID_SANTRI'];
$nama = $_SESSION['NAMA'];
$thn = $_SESSION['THN_MASUK'];


?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Keuangan Asrama
  </title>

  <!-- Custom fonts for this template-->
  <link href="../plugin/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">
  <link href="../plugin/select2/css/select2.min.css" rel="stylesheet" />
  <script src="../plugin/jquery/jquery-3.6.0.min.js"></script>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion text-lg" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $nama; ?></span>
                <img class="img-profile rounded-circle" src="../img/undraw_profile.svg">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid text-gray-900">
          <div class="card shadow" style="width: 80%;">
            <div class="card-header">
              <h4 class="m-0 font-weight-bold">Silakan Lengkapi Data Diri</h4>
            </div>
            <form role="form" action="../config/proses-santri.php?action=tb_santri" method="POST">
              <div class="card-body">
                <div class="form-group">
                  <label for="id_santri">ID Santri</label>
                  <input type="text" name="id_santri" id="id_santri" class="form-control form-control-sm" value="<?php echo $id_santri ?>" readonly>
                </div>
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label for="nama">Nama</label>
                      <input type="text" name="nama" id="nama" class="form-control form-control-sm" value="<?php echo $nama ?>" required>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" name="email" id="email" class="form-control form-control-sm" autocomplete="off" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label for="tempat">Tempat</label>
                      <input type="text" autocomplete="off" name="tempat" id="tempat" class="form-control form-control-sm" required>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="date">Tanggal Lahir</label>
                      <input type="date" autocomplete="off" name="date" id="date" class="form-control form-control-sm" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label for="jk">Jenis Kelamin</label>
                      <select name="jk" id="jk" class="custom-select custom-select-sm" required>
                        <option></option>
                        <?php
                        $enumValues = ['Laki-Laki', 'Perempuan'];
                        foreach ($enumValues as $value) {
                          echo "<option value='$value'>$value</option>";
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="alamat">Alamat</label>
                  <input type="text" autocomplete="off" name="alamat" id="alamat" class="form-control form-control-sm" required>
                </div>
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label for="provinsi">Provinsi</label>
                      <select name="provinsi" id="provinsi" class="custom-select prov-single" required>
                        <option></option>
                        <?php
                        $query = "SELECT * FROM tbl_provinsi";
                        $result = mysqli_query($koneksi, $query);
                        while ($row2 = mysqli_fetch_array($result)) {
                          echo "<option value='$row2[ID_PROV]'>$row2[NAMA_PROV]</option>";
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="kota">Kota/Kabupaten</label>
                      <select name="kota" id="kota" class="custom-select kota-single" required>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label for="no_hp">No. HP</label>
                      <input type="text" autocomplete="off" name="no_hp" id="no_hp" class="form-control form-control-sm" oninput="validasiAngka(this)" required>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="thn_masuk">Tahun Masuk</label>
                      <input type="text" autocomplete="off" name="thn_masuk" id="thn_masuk" class="form-control form-control-sm" value="<?php echo $thn ?>" readonly>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <?php
                      $sql = "SELECT a.ID_ASRAMA, a.ASRAMA FROM santri s JOIN asrama a ON s.ID_ASRAMA = a.ID_ASRAMA WHERE s.ID_SANTRI = $id_santri";
                      $result = mysqli_query($koneksi, $sql);
                      $row = mysqli_fetch_array($result);
                      $asrama = $row['ID_ASRAMA'];
                      ?>
                      <label for="asrama">Asrama</label>
                      <input type="text" autocomplete="off" name="thn_masuk" id="thn_masuk" class="form-control form-control-sm" value="<?php echo $row['ASRAMA'] ?>" readonly>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="kamar">Kamar</label>
                      <select name="kamar" id="kamar" class="custom-select kamar-single" required>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label for="lembaga">Lembaga Pendidikan</label>
                      <select name="lembaga" id="lembaga" class="custom-select custom-select-sm" required>
                        <option></option>
                        <?php
                        $query = "SELECT * FROM lembaga";
                        $result = mysqli_query($koneksi, $query);
                        while ($data = mysqli_fetch_array($result)) {
                          echo "<option value='$data[ID_LEMBAGA]'>$data[NAMA_LEMBAGA]</option>";
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <input type="submit" class="submit btn btn-primary" value="Simpan">
              </div>
            </form>
          </div>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-danger" href="../logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="../plugin/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../plugin/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>
  <script src="../plugin/select2/js/select2.min.js"></script>

  <script>
    // validasi inputan khusus angka
    function validasiAngka(input) {
      input.value = input.value.replace(/\D/g, '');
    }

    $(document).ready(function() {
      $('.prov-single, .kota-single, .kamar-single').select2();

      // Ajax panggil kota sesuai provinsi
      $('#provinsi').change(function() {
        var provinsiID = $(this).val();

        $.ajax({
          url: '../config/prosesGet-santri.php?get=kota',
          method: 'POST',
          data: {
            provinsiID: provinsiID
          },
          success: function(response) {
            $('#kota').html(response);
          }
        });
      });

      loadKamar();

      function loadKamar() {
        var asramaID = '<?php echo $asrama; ?>'; // Mengambil nilai asrama dari PHP

        // Mengosongkan pilihan kamar
        var kamarSelect = $('#kamar');
        kamarSelect.empty();
        kamarSelect.append($('<option disabled selected></option>').text('pilih kamar'));

        $.ajax({
          url: '../config/prosesGet-santri.php?get=kamar',
          type: 'POST',
          data: {
            asramaID: asramaID
          }, // Mengirim nilai asramaID ke skrip get-kamar.php
          success: function(response) {
            // Memasukkan opsi kamar ke dalam select
            if (response.length > 0) {
              kamarSelect.append(response);
            }
          },
          error: function(xhr, status, error) {
            // Menangani kesalahan jika permintaan AJAX gagal
            console.log(error);
          }
        });
      }
    });
  </script>

</body>

</html>