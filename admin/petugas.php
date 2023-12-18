<!-- Halaman Petugas (Admin) -->
<div class="card shadow">
  <div class="card-header">
    <div class="d-sm-flex align-items-center justify-content-between">
      <h4 class="m-0 font-weight-bold">Daftar Petugas</h4>
      <button type="button" class="btn btn-sm btn-primary ml-4" data-toggle="modal" data-target="#modalTambahPetugas">
        Tambah
      </button>
    </div>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-sm table-bordered text-gray-700" id="tabel-petugas" style="width: 100%;">
        <thead>
          <tr>
            <th>No</th>
            <th>Level</th>
            <th>Nama</th>
            <th>Username</th>
            <th>No HP</th>
            <th>Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // Proses Menampilkan Data
          $query = "SELECT * FROM petugas p JOIN level l ON p.ID_LEVEL = l.ID_LEVEL";
          $result = mysqli_query($koneksi, $query);
          $no = 1;
          while ($row = mysqli_fetch_array($result)) {
          ?>
            <tr>
              <td><?php echo $no++;  ?> </td>
              <td><?php echo $row['LEVEL']; ?> </td>
              <td><?php echo $row['NAMA_PETUGAS']; ?> </td>
              <td><?php echo $row['USERNAME']; ?> </td>
              <td><?php echo $row['NO_HP']; ?> </td>
              <td>
                <!-- <a href="index.php?page=info&id_santri=<?php echo $row['ID_SANTRI'] ?>" class="btn btn-sm btn-warning"><i class="fas fa-info-circle"></i></a> -->
                <a href="#" type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#editPetugas<?php echo $row['ID_PETUGAS'] ?>"><i class="fas fa-fw fa-edit"></i></a>
                <a href="../config/proses-admin.php?action=dl_petugas&id_petugas=<?php echo $row['ID_PETUGAS'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus Data ?')"><i class="fas fa-fw fa-trash"></i></a>
              </td>
            </tr>

            <!-- Modal Edit Data Petugas-->
            <div class="modal fade" id="editPetugas<?php echo $row['ID_PETUGAS'] ?>" tabindex="-1" aria-labelledby="editPetugasLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="editPetugasLabel">Edit Data Petugas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form action="../config/proses-admin.php?action=edit_petugas" method="POST" class="my-1">
                      <div class="form-group">
                        <div class="form-row">
                          <div class="form-group col-4">
                            <label for="id_petugas">ID Petugas</label>
                          </div>
                          <div class="form-group col-8">
                            <input type="text" name="id_petugas" id="id_petugas" class="form-control form-control-sm" value="<?php echo $row['ID_PETUGAS'] ?>" readonly>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-4">
                            <label for="nama">Nama Petugas</label>
                          </div>
                          <div class="form-group col-8">
                            <input type="text" autocomplete="off" name="nama" id="nama" class="form-control form-control-sm" value="<?php echo $row['NAMA_PETUGAS'] ?>" required>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-4">
                            <label for="username">Username</label>
                          </div>
                          <div class="form-group col-8">
                            <input type="text" autocomplete="off" name="username" id="username" class="form-control form-control-sm" value="<?php echo $row['USERNAME'] ?>" required>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-4">
                            <label for="password">Password</label>
                          </div>
                          <div class="form-group col-8">
                            <input type="text" autocomplete="off" name="password" id="password" class="form-control form-control-sm" value="<?php echo $row['PASSWORD'] ?>" required>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-4">
                            <label for="no_hp">No HP</label>
                          </div>
                          <div class="form-group col-8">
                            <input type="text" autocomplete="off" name="no_hp" id="no_hp" class="form-control form-control-sm" value="<?php echo $row['NO_HP'] ?>" oninput="validasiAngka(this)" required>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-4">
                            <label for="level">Level</label>
                          </div>
                          <div class="form-group col-8">
                            <select class="custom-select custom-select-sm" id="level" name="level">
                              <?php
                              $queryLevel = "SELECT * FROM level";
                              $resultLevel = mysqli_query($koneksi, $queryLevel);
                              while ($dataLevel = mysqli_fetch_array($resultLevel)) {
                                $selected = ($dataLevel['ID_LEVEL'] == $row['ID_LEVEL']) ? 'selected' : '';
                                echo "<option value='" . $dataLevel['ID_LEVEL'] . "' " . $selected . ">" . $dataLevel['LEVEL'] . "</option>";
                              }
                              ?>
                            </select>
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

            <?php
          }
            ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal Tambah Petugas-->
<div class="modal fade" id="modalTambahPetugas" tabindex="-1" role="dialog" aria-labelledby="tambahPetugasLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahPetugasLabel">Tambah Petugas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="../config/proses-admin.php?action=tb_petugas" method="POST" class="my-1">
          <div class="form-group">
            <div class="form-row">
              <div class="form-group col-4">
                <label for="nama">Nama Petugas</label>
              </div>
              <div class="form-group col-8">
                <input type="text" autocomplete="off" name="nama" id="nama" class="form-control form-control-sm" required>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-4">
                <label for="username">Username</label>
              </div>
              <div class="form-group col-8">
                <input type="text" autocomplete="off" name="username" id="username" class="form-control form-control-sm" required>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-4">
                <label for="password">Password</label>
              </div>
              <div class="form-group col-8">
                <input type="text" autocomplete="off" name="password" id="password" class="form-control form-control-sm" required>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-4">
                <label for="no_hp">No HP</label>
              </div>
              <div class="form-group col-8">
                <input type="text" autocomplete="off" name="no_hp" id="no_hp" class="form-control form-control-sm" oninput="validasiAngka(this)" required>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-4">
                <label for="level">Level</label>
              </div>
              <div class="form-group col-8">
                <select name="level" id="level" required class="custom-select custom-select-sm">
                  <option></option>
                  <?php
                  $query = "SELECT * FROM level";
                  $result = mysqli_query($koneksi, $query);
                  while ($data = mysqli_fetch_array($result)) {
                    echo "<option value='$data[ID_LEVEL]'>$data[LEVEL]</option>";
                  }
                  ?>
                </select>
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
    $('#tabel-petugas').DataTable();
  });

  $("#dl_petugas").addClass("active");

  // validasi inputan khusus angka
  function validasiAngka(input) {
    input.value = input.value.replace(/\D/g, '');
  }
</script>