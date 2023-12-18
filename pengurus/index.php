<?php
include '../config/koneksi.php';

session_start();

if (!isset($_SESSION['ID_PETUGAS']) || $_SESSION['LEVEL'] !== 'Pengurus') {

  header("Location:../login.php");
  exit();
}

$idPetugas = $_SESSION['ID_PETUGAS'];
$nama = $_SESSION['NAMA_PETUGAS'];
$level = $_SESSION['LEVEL'];

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
  <!-- <link href="../plugin/datatables/DataTables-1.13.4/css/dataTables.bootstrap4.min.css" rel="stylesheet"> -->
  <link href="../plugin/datatables/datatables.min.css" rel="stylesheet">
  <link href="../plugin/select2/css/select2.min.css" rel="stylesheet" />
  <script src="../plugin/jquery/jquery-3.6.0.min.js"></script>
  <!-- <script src="../plugin/datatables/DataTables-1.13.4/js/jquery.dataTables.min.js"></script> -->
  <!-- <script src="../plugin/datatables/DataTables-1.13.4/js/dataTables.bootstrap4.min.js"></script> -->
  <script src="../plugin/datatables/datatables.min.js"></script>
  <script src="../plugin/chart.js/Chart.min.js"></script>
  <!-- <script src="../plugin/xlsx/xlsx.js"></script> -->
  <script src="../plugin/xlsx/dist/xlsx.full.min.js"></script>
  <script src="../plugin/jspdf/dist/jspdf.umd.min.js"></script>
  <script src="../plugin/jspdf-autotable/dist/jspdf.plugin.autotable.min.js"></script>
  <style>
    @media (max-width: 767px) {
      .sidebar {
        display: none;
      }
    }
  </style>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion text-lg" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php?page=dashboard">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-book-reader"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SAKA-DU</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="index.php?page=dashboard">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Data Master Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseData" aria-expanded="true" aria-controls="collapseData">
          <i class="fas fa-fw fa-server"></i>
          <span>Data Master</span>
        </a>
        <div id="collapseData" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="index.php?page=santri">Santri</a>
            <a class="collapse-item" href="index.php?page=asrama">Asrama</a>
            <a class="collapse-item" href="index.php?page=kamar">Kamar</a>
            <a class="collapse-item" href="index.php?page=lembaga">Lembaga</a>
          </div>
        </div>
      </li>

      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Transaksi Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTransakasi" aria-expanded="true" aria-controls="collapseTransakasi">
          <i class="fas fa-fw fa-money-check"></i>
          <span>Transaksi</span>
        </a>
        <div id="collapseTransakasi" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="index.php?page=biaya">Data Biaya</a>
            <a class="collapse-item" href="index.php?page=pengeluaran">Pengeluaran</a>
            <a class="collapse-item" href="index.php?page=bayar">Pembayaran</a>
            <a class="collapse-item" href="index.php?page=validasi">Validasi</a>
            <a class="collapse-item" href="index.php?page=riwayat">Riwayat</a>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Laporan -->
      <li class="nav-item">
        <a class="nav-link" href="index.php?page=laporan">
          <i class="fas fa-fw fa-file-alt"></i>
          <span>Laporan</span></a>
      </li>

      <!-- Divider -->
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
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $nama; ?> (<?php echo $level; ?>)</span>
                <img class="img-profile rounded-circle" src="../img/undraw_profile.svg">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="index.php?page=profil">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <div class="dropdown-divider"></div>
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
          <?php
          if (isset($_GET['page'])) {
            $page = $_GET['page'];

            switch ($page) {
              case 'dashboard':
                include "dashboard.php";
                break;
              case 'profil':
                include 'profil.php';
                break;
              case 'lunas':
                include 'daftar-lunas.php';
                break;
              case 'belum-lunas':
                include 'daftar-belum.php';
                break;
              case 'santri':
                include 'santri.php';
                break;
              case 'info':
                include 'info-santri.php';
                break;
              case 'edit-santri':
                include 'edit-santri.php';
                break;
              case 'asrama':
                include 'asrama.php';
                break;
              case 'kamar':
                include 'kamar.php';
                break;
              case 'edit-kamar':
                include 'edit-kamar.php';
                break;
              case 'lembaga':
                include 'lembaga.php';
                break;
              case 'biaya':
                include "biaya.php";
                break;
              case 'bayar':
                include 'bayar.php';
                break;
              case 'pengeluaran':
                include 'pengeluaran.php';
                break;
              case 'validasi':
                include 'validasi.php';
                break;
              case 'riwayat':
                include 'riwayat.php';
                break;
              case 'laporan':
                include 'laporan.php';
                break;
              default:
                include '../404.php';
                break;
            }
          } else {
            include "dashboard.php";
          }
          ?>

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

  <script src="../plugin/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../plugin/jquery-easing/jquery.easing.min.js"></script>
  <script src="../js/sb-admin-2.min.js"></script>
  <script src="../plugin/select2/js/select2.min.js"></script>
  <script>
    document.getElementById('sidebarToggleTop').addEventListener('click', function() {
      var sidebar = document.getElementById('accordionSidebar');
      if (sidebar.style.display === 'none') {
        sidebar.style.display = 'block';
      } else {
        sidebar.style.display = 'none';
      }
    });
  </script>

</body>

</html>