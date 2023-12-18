<!-- Halaman Santri Tagihan Belum Lunas (Pengurus) -->
<div class="card shadow">
  <div class="card-header">
    <div class="d-sm-flex align-items-center justify-content-between">
      <h4 class="m-0 font-weight-bold">Daftar Santri (Tagihan Belum Lunas)</h4>
    </div>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-sm table-bordered text-gray-700" id="tabel-belum">
        <thead>
          <tr>
            <th>No</th>
            <th>ID Santri</th>
            <th>Nama</th>
            <th>Asrama</th>
            <th>Kamar</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $query = "SELECT DISTINCT s.ID_SANTRI, s.NAMA, a.ASRAMA, k.NO_KAMAR FROM tagihan t JOIN santri s ON t.ID_SANTRI = s.ID_SANTRI JOIN asrama a ON s.ID_ASRAMA = a.ID_ASRAMA JOIN kamar k ON s.ID_KAMAR = k.ID_KAMAR WHERE t.STATUS = 'Tunggakan' AND t.TAHUN = YEAR(CURRENT_DATE()) AND t.BULAN = MONTH(CURRENT_DATE())";
          $result = mysqli_query($koneksi, $query);
          if (mysqli_num_rows($result) > 0) {
            $no = 1;
            while ($row = mysqli_fetch_assoc($result)) {
              echo '<tr>';
              echo '<td>' . $no . '</td>';
              echo '<td>' . $row['ID_SANTRI'] . '</td>';
              echo '<td>' . $row['NAMA'] . '</td>';
              echo '<td>' . $row['ASRAMA'] . '</td>';
              echo '<td>' . $row['NO_KAMAR'] . '</td>';
              echo '</tr>';

              $no++;
            }
          } else {
            echo '<tr><td colspan="5">Tidak ada data tagihan lunas.</td></tr>';
          }
          ?>
        </tbody>
      </table>
      <hr>
      <div class="d-sm-flex align-items-center justify-content-between">
        <p>
          <span>*</span>Data santri yang sudah lunas bulan ini
        </p>
        <a href="index.php?page=dashboard" class="btn btn-sm btn-danger">Kembali</a>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('#tabel-belum').DataTable();
  })
</script>