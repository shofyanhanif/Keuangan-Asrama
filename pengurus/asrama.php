<!-- Halaman Asrama (Pengurus) -->
<div class="card shadow">
  <div class="card-header">
    <div class="d-sm-flex align-items-center justify-content-between">
      <h4 class="m-0 font-weight-bold">Data Asrama</h4>
      <button type="button" class="btn btn-primary btn-sm ml-4" data-toggle="modal" data-target="#modalTambahAsrama">
        Tambah
      </button>
    </div>
  </div>

  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-sm table-bordered text-gray-700" id="tabel-asrama" style="width: 100%;">
        <thead>
          <tr>
            <th>No</th>
            <th>ID Asrama</th>
            <th>Asrama</th>
            <th>Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // Proses Menampilkan Data
          $query = "SELECT * FROM asrama";
          $result = mysqli_query($koneksi, $query);
          $no = 1;
          while ($row = mysqli_fetch_array($result)) {
          ?>
            <tr>
              <td><?php echo $no++;  ?> </td>
              <td><?php echo $row['ID_ASRAMA']; ?> </td>
              <td><?php echo $row['ASRAMA']; ?> </td>
              <td>
                <a href="#" type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#editAsrama<?php echo $row['ID_ASRAMA'] ?>"><i class="fas fa-fw fa-edit"></i></a>
                <a href="../config/proses-pengurus.php?action=dl_asrama&id_asrama=<?php echo $row['ID_ASRAMA']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus Data ?')"><i class="fas fa-fw fa-trash"></i></a>
              </td>
            </tr>

            <!-- Modal Edit Data Asrama-->
            <div class="modal fade" id="editAsrama<?php echo $row['ID_ASRAMA'] ?>" tabindex="-1" aria-labelledby="editAsramaLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="editAsramaLabel">Edit Data Asrama</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form action="../config/proses-pengurus.php?action=edit_asrama" method="POST" class="my-1">
                    <div class="modal-body">
                      <div class="form-group">
                        <div class="form-row">
                          <div class="form-group col-4">
                            <label for="id_asrama">ID Asrama</label>
                          </div>
                          <div class="form-group col-8">
                            <input type="text" name="id_asrama" id="id_asrama" class="form-control form-control-sm" value="<?php echo $row['ID_ASRAMA'] ?>" readonly>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-4">
                            <label for="edit_asrama">Nama Asrama</label>
                          </div>
                          <div class="form-group col-8">
                            <input type="text" autocomplete="off" name="edit_asrama" id="edit_asrama" class="form-control form-control-sm" value="<?php echo $row['ASRAMA'] ?>" required>
                          </div>
                        </div>
                      </div>
                      <div class="d-sm-flex justify-content-between">
                        <div class="ml-auto">
                          <input type="submit" class="submit btn btn-sm btn-primary d-none d-sm-inline-block" value="Simpan">
                        </div>
                      </div>
                    </div>
                  </form>
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

  <!-- Modal Tambah Asrama-->
  <div class="modal fade" id="modalTambahAsrama" tabindex="-1" aria-labelledby="tambahAsramaLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tambahAsramaLabel">Tambah Data Asrama</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="../config/proses-pengurus.php?action=tb_asrama" method="POST" class="my-1">
            <div class="form-group">
              <div class="form-row">
                <div class="form-group col-4">
                  <label for="id_asrama">ID Asrama</label>
                </div>
                <div class="form-group col-8">
                  <input type="text" autocomplete="off" name="id_asrama" id="id_asrama" class="form-control form-control-sm" oninput="validasiAngka(this)" maxlength="2" placeholder="Maks. 2 digit" required>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-4">
                  <label for="asrama">Nama Asrama</label>
                </div>
                <div class="form-group col-8">
                  <input type="text" autocomplete="off" name="asrama" id="asrama" class="form-control form-control-sm" required>
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

<!-- Panggil Dialog -->
<script>
  function validasiAngka(input) {
    // Validasi inputan khusus angka
    input.value = input.value.replace(/\D/g, '');

    // Membatasi panjang karakter
    if (input.value.lenght > 2) {
      input.value = input.value.slice(0, 2);
    }
  }

  $(document).ready(function() {
    $('#tabel-asrama').DataTable();

    $("#dl_asrama").addClass("active");
  });
</script>