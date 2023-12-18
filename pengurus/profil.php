<?php
$id = $idPetugas;
$query = "SELECT * FROM petugas p JOIN level l ON p.ID_LEVEL = l.ID_LEVEL WHERE ID_PETUGAS = '$id'";
$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_array($result);
?>

<!-- Halaman Profil (Pengurus) -->
<div class="card shadow">
  <div class="card-header">
    <h4 class="m-0 font-weight-bold">Data Profil</h4>
  </div>
  <div class="card-body text-gray-700">
    <div class="table-responsive">
      <table class="table table-sm" id="info" style="width: 70%;">
        <tr>
          <th>ID Petugas</th>
          <td><?php echo $id ?></td>
        </tr>
        <tr>
          <th>NAMA</th>
          <td><?php echo $row['NAMA_PETUGAS'] ?></td>
        </tr>
        <tr>
          <th>NO. HP</th>
          <td><?php echo $row['NO_HP'] ?></td>
        </tr>
        <tr>
          <th>LEVEL</th>
          <td><?php echo $row['LEVEL'] ?></td>
        </tr>
      </table>
    </div>
  </div>
  <div class="card-footer">
    <a href="index.php?page=dashboard" class="btn btn-sm btn-danger">Kembali</a>
    <!-- <a href="#" class="btn btn-success">Edit</a> -->
  </div>
</div>