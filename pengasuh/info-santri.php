<?php
$id = $_GET['id_santri'];
$query = "SELECT * FROM santri s LEFT JOIN asrama a ON s.ID_ASRAMA = a.ID_ASRAMA LEFT JOIN kamar k ON s.ID_KAMAR = k.ID_KAMAR LEFT JOIN lembaga l ON s.ID_LEMBAGA = l.ID_LEMBAGA WHERE s.ID_SANTRI = '$id'";
$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_array($result);
$tanggal = date('d-m-Y', strtotime($row['TGL_LAHIR']));
?>

<!-- Halaman Info Santri (Pengasuh) -->
<div class="card shadow">
  <div class="card-header">
    <h4 class="m-0 font-weight-bold">Data Santri</h4>
  </div>
  <div class="card-body text-gray-700">
    <div class="table-responsive">
      <table class="table table-sm" id="info" style="width: 70%;">
        <tr>
          <th>NOMOR INDUK SANTRI</th>
          <td><?php echo $row['ID_SANTRI'] ?></td>
        </tr>
        <tr>
          <th>NAMA</th>
          <td><?php echo $row['NAMA'] ?></td>
        </tr>
        <tr>
          <th>TEMPAT, TANGGAL LAHIR</th>
          <td><?php echo $row['TEMPAT_LHR'] ?>, <?php echo $tanggal ?></td>
        </tr>
        <tr>
          <th>JENIS KELAMIN</th>
          <td><?php echo $row['JK'] ?></td>
        </tr>
        <tr>
          <th>ALAMAT</th>
          <td><?php echo $row['ALAMAT'] ?></td>
        </tr>
        <tr>
          <th>NO. HP</th>
          <td><?php echo $row['NO_HP'] ?></td>
        </tr>
        <tr>
          <th>ASRAMA</th>
          <td><?php echo $row['ASRAMA'] ?></td>
        </tr>
        <tr>
          <th>KAMAR</th>
          <td><?php echo $row['NO_KAMAR'] ?></td>
        </tr>
        <tr>
          <th>LEMBAGA</th>
          <td><?php echo $row['NAMA_LEMBAGA'] ?></td>
        </tr>
      </table>
    </div>
  </div>
  <div class="card-footer">
    <a href="index.php?page=santri" class="btn btn-danger">Kembali</a>
    <a href="index.php?page=edit-santri&id_santri=<?php echo $row['ID_SANTRI'] ?>" class="btn btn-success">Edit</a>
  </div>
</div>