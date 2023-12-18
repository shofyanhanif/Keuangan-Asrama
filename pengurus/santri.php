<!-- Halaman Data Santri (Pengurus) -->
<div class="card shadow">
  <div class="card-header">
    <h4 class="m-0 font-weight-bold">Data Santri</h4>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered text-gray-700" id="tabel-santri" style="width: 100%;">
        <thead>
          <tr>
            <th>No</th>
            <th>ID Santri</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Asrama</th>
            <th>Kamar</th>
            <th>Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // Proses Menampilkan Data
          $query = "SELECT * FROM santri s LEFT JOIN asrama a ON s.ID_ASRAMA = a.ID_ASRAMA LEFT JOIN kamar k ON s.ID_KAMAR = k.ID_KAMAR LEFT JOIN lembaga l ON s.ID_LEMBAGA = l.ID_LEMBAGA ORDER BY s.ID_SANTRI";
          $result = mysqli_query($koneksi, $query);
          $no = 1;
          while ($row = mysqli_fetch_array($result)) {
          ?>

            <tr>
              <td><?php echo $no++;  ?> </td>
              <td><?php echo $row['ID_SANTRI']; ?> </td>
              <td><?php echo $row['NAMA']; ?> </td>
              <td><?php echo $row['ALAMAT']; ?> </td>
              <td><?php echo $row['ASRAMA']; ?> </td>
              <td><?php echo $row['NO_KAMAR']; ?> </td>
              <td>
                <div class="btn-group">
                  <a href="index.php?page=info&id_santri=<?php echo $row['ID_SANTRI'] ?>" class="btn btn-sm btn-warning"><i class="fas fa-fw fa-info-circle"></i></a>
                  <a href="index.php?page=edit-santri&id_santri=<?php echo $row['ID_SANTRI'] ?>" class="btn btn-sm btn-success"><i class="fas fa-fw fa-edit"></i></a>
                  <a href="../config/proses-pengurus.php?action=dl_santri&id_santri=<?php echo $row['ID_SANTRI'] ?>" class="btn btn-sm btn-danger"><i class="fas fa-fw fa-trash"></i></a>
                </div>
              </td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('#tabel-santri').DataTable();

    $("#dl_santri").addClass("active");
  });
</script>