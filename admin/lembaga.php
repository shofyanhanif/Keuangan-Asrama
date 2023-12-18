<!-- Halaman Lembaga (Pengurus) -->
<div class="card shadow">
  <div class="card-header">
    <div class="d-sm-flex align-items-center justify-content-between">
      <h4 class="m-0 font-weight-bold">Data Lembaga</h4>
      <button type="button" class="btn btn-primary btn-sm ml-4" data-toggle="modal" data-target="#modalTambahLembaga">
        Tambah
      </button>
    </div>
  </div>
  <div class="card-body">
    <!-- Tabel Data -->
    <div class="table-responsive">
      <table class="table table-sm table-bordered text-gray-700" id="tabel-lembaga" style="width: 100%;">
        <thead>
          <tr>
            <th>No</th>
            <th>ID Lembaga</th>
            <th>Nama Lembaga Pendidikan</th>
            <th>Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // Proses Menampilkan Data
          $query = "SELECT * FROM lembaga";
          $result = mysqli_query($koneksi, $query);
          $no = 1;
          while ($row = mysqli_fetch_array($result)) {
          ?>
            <tr>
              <td><?php echo $no++;  ?> </td>
              <td><?php echo $row['ID_LEMBAGA']; ?> </td>
              <td><?php echo $row['NAMA_LEMBAGA']; ?> </td>
              <td>
                <a href="#" type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#editLembaga<?php echo $row['ID_LEMBAGA'] ?>"><i class="fas fa-fw fa-edit"></i></a>
                <a href="../config/proses-admin.php?action=dl_lembaga&id_lembaga=<?php echo $row['ID_LEMBAGA']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus Data ?')"><i class="fas fa-fw fa-trash"></i></a>
              </td>
            </tr>

            <!-- Modal Edit Lembaga-->
            <div class="modal fade" id="editLembaga<?php echo $row['ID_LEMBAGA'] ?>" tabindex="-1" aria-labelledby="editLembagaLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="editLembagaLabel">Edit Data Lembaga</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form action="../config/proses-admin.php?action=edit_lembaga" method="POST" class="my-1">
                      <div class="form-group">
                        <div class="form-row">
                          <div class="form-group col-4">
                            <label for="id_lembaga">ID Lembaga</label>
                          </div>
                          <div class="form-group col-8">
                            <input type="text" name="id_lembaga" id="id_lembaga" class="form-control form-control-sm" value="<?php echo $row['ID_LEMBAGA'] ?>" readonly>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-4">
                            <label for="lembaga">Nama Lembaga</label>
                          </div>
                          <div class="form-group col-8">
                            <input type="text" autocomplete="off" name="lembaga" id="lembaga" class="form-control form-control-sm" value="<?php echo $row['NAMA_LEMBAGA'] ?>" required>
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

          <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal Tambah Lembaga -->
<div class="modal fade" id="modalTambahLembaga" tabindex="-1" aria-labelledby="tambahLembagaLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahLembagaLabel">Tambah Data Lembaga</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="../config/proses-admin.php?action=tb_lembaga" method="POST">
          <div class="form-group">
            <div class="form-row">
              <div class="form-group col-4">
                <label for="lembaga">Nama Lembaga</label>
              </div>
              <div class="form-group col-8">
                <input type="text" autocomplete="off" name="lembaga" id="lembaga" class="form-control form-control-sm" required>
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

<!-- Panggil Dialog -->
<script>
  $(document).ready(function() {
    $('#tabel-lembaga').DataTable();
  });

  // $("#dl_lembaga").addClass("active");
</script>