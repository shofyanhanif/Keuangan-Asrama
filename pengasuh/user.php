<!-- Halaman Pengguna (Pengasuh) -->
<div class="card shadow">
  <div class="card-header">
    <div class="d-sm-flex align-items-center justify-content-between">
      <h4 class="m-0 font-weight-bold">Daftar Pengguna</h4>
      <a href="index.php?page=tb-user" class="btn btn-sm btn-primary ml-4">Tambah</a>
    </div>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-sm table-bordered text-gray-700" id="tabel-user" style="width: 100%;">
        <thead>
          <tr>
            <th>No</th>
            <th>ID Santri</th>
            <th>Nama</th>
            <th>Level</th>
            <th>Status</th>
            <th>Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // Proses Menampilkan Data
          $query = "SELECT * FROM santri s JOIN level l ON s.ID_LEVEL = l.ID_LEVEL ORDER BY s.ID_SANTRI";
          $result = mysqli_query($koneksi, $query);
          $no = 1;
          while ($row = mysqli_fetch_array($result)) {
          ?>
            <tr>
              <td><?php echo $no++; ?> </td>
              <td><?php echo $row['ID_SANTRI']; ?> </td>
              <td><?php echo $row['NAMA']; ?> </td>
              <td><?php echo $row['LEVEL']; ?> </td>
              <td><?php echo $row['STATUS']; ?> </td>
              <td>
                <a href="index.php?page=edit-user&id_santri=<?php echo $row['ID_SANTRI'] ?>" class="btn btn-sm btn-success"><i class="fas fa-fw fa-edit"></i></a>
                <a href="../config/proses-pengasuh.php?action=dl_user&id_santri=<?php echo $row['ID_SANTRI'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus Data ?')"><i class="fas fa-fw fa-trash"></i></a>
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

<!-- Panggil Dialog -->
<script>
  $(document).ready(function() {
    $('#tabel-user').DataTable();
  });
  // $("#dl_user").addClass("active");
</script>