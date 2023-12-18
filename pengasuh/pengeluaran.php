<!-- Halaman Pengeluaran (Pengasuh) -->
<div class="card shadow">
  <div class="card-header">
    <div class="d-sm-flex align-items-center justify-content-between">
      <h4 class="m-0 font-weight-bold">Data Pengeluaran</h4>
      <button type="button" class="btn btn-sm btn-primary ml-4" data-toggle="modal" data-target="#modalTambahData">
        Tambah
      </button>
    </div>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-sm table-bordered text-gray-700" id="tabel-pengeluaran" style="width: 100%;">
        <thead>
          <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Ketengan</th>
            <th>Nominal</th>
            <th>Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // Proses Menampilkan Data
          $query = "SELECT * FROM pengeluaran ORDER BY TANGGAL;";
          $result = mysqli_query($koneksi, $query);
          $no = 1;
          while ($row = mysqli_fetch_array($result)) {
            $tanggal = date('d-m-Y', strtotime($row['TANGGAL']));
            $formatPengeluaran = 'Rp ' . number_format($row['NOMINAL'], 0, ',', '.');
          ?>
            <tr>
              <td><?php echo $no++;  ?> </td>
              <td><?php echo $tanggal ?> </td>
              <td><?php echo $row['KETERANGAN'] ?> </td>
              <td><?php echo $formatPengeluaran ?> </td>
              <td>
                <a href="../config/proses-pengasuh.php?action=dl_pengeluaran&id_kel=<?php echo $row['ID_PENGELUARAN'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus Data ?')"><i class="fas fa-fw fa-trash"></i></a>
              </td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>

    <!-- Modal Tambah SPP-->
    <div class="modal fade" id="modalTambahData" tabindex="-1" aria-labelledby="modalTambahDataLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalTambahDataLabel">Tambah Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="../config/proses-pengasuh.php?action=tb_pengeluaran" method="POST" class="my-1">
              <?php
              // Ambil tanggal saat ini
              $tanggalSekarang = date('d-m-Y');
              ?>
              <div class="form-group">
                <div class="form-row">
                  <div class="form-group col-4">
                    <label for="tanggal">Tanggal</label>
                  </div>
                  <div class="form-group col-8">
                    <input type="text" autocomplete="off" name="tanggal" id="tanggal" class="form-control form-control-sm" value="<?php echo $tanggalSekarang; ?>" readonly>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-4">
                    <label for="keterangan">Keterangan</label>
                  </div>
                  <div class="form-group col-8">
                    <input type="text" autocomplete="off" name="keterangan" id="keterangan" class="form-control form-control-sm" required>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-4">
                    <label for="nominal">Nominal</label>
                  </div>
                  <div class="form-group col-8">
                    <input type="text" autocomplete="off" name="nominal" id="nominal" class="form-control form-control-sm" oninput="validasiAngka(this)" required>
                  </div>
                </div>
              </div>
              <div class="d-sm-flex justify-content-between">
                <div class="ml-auto">
                  <input type="submit" class="submit btn btn-sm btn-primary d-none d-sm-inline-block" value="Simpan">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Panggil Dialog -->
<script>
  // validasi inputan khusus angka
  function validasiAngka(input) {
    input.value = input.value.replace(/\D/g, '');
  }

  $(document).ready(function() {
    $('#tabel-pengeluaran').DataTable();

    $("#dl_pengeluaran").addClass("active");
  });
</script>