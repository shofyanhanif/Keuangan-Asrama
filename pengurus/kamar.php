<!-- Content Kamar -->
<div class="card shadow">
  <div class="card-header">
    <div class="d-sm-flex align-items-center justify-content-between">
      <h4 class="m-0 font-weight-bold">Data Kamar</h4>
      <button type="button" class="btn btn-primary btn-sm ml-4" data-toggle="modal" data-target="#modalTambahKamar">
        Tambah
      </button>
    </div>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-sm table-bordered text-gray-700" id="tabel-kamar" style="width: 100%;">
        <thead>
          <tr>
            <th>No</th>
            <th>Kamar</th>
            <th>Asrama</th>
            <th>Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // Proses Menampilkan Data
          $query = "SELECT * FROM kamar k JOIN asrama a ON k.ID_ASRAMA = a.ID_ASRAMA ORDER BY ID_KAMAR";
          $result = mysqli_query($koneksi, $query);
          $no = 1;
          while ($row = mysqli_fetch_array($result)) {
          ?>
            <tr>
              <td><?php echo $no++;  ?> </td>
              <td><?php echo $row['NO_KAMAR']; ?> </td>
              <td><?php echo $row['ASRAMA']; ?> </td>
              <td>
                <a href="#" type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#editKamar<?php echo $row['ID_KAMAR'] ?>"><i class="fas fa-fw fa-edit"></i></a>
                <a href="../config/proses-pengurus.php?action=dl_kamar&id_kamar=<?php echo $row['ID_KAMAR']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus Data ?')"><i class="fas fa-fw fa-trash"></i></a>
              </td>
            </tr>

            <!-- Modal Edit Data Kamar -->
            <div class="modal fade" id="editKamar<?php echo $row['ID_KAMAR'] ?>" tabindex="-1" role="dialog" aria-labelledby="editKamarLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="editKamarLabel">Edit Data Asrama</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form action="../config/proses-pengurus.php?action=edit_kamar" method="POST" class="my-1">
                      <div class="form-group" hidden>
                        <div class="form-row">
                          <div class="form-group col-4">
                            <label for="id_kamar">ID Kamar</label>
                          </div>
                          <div class="form-group col-8">
                            <input type="text" autocomplete="off" name="id_kamar" id="id_kamar" class="form-control form-control-sm" value="<?php echo $row['ID_KAMAR'] ?>" readonly>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="form-row">
                          <div class="form-group col-4">
                            <label for="asrama">Nama Asrama</label>
                          </div>
                          <div class="form-group col-8">
                            <select name="asrama" id="asrama" class="custom-select custom-select-sm " required>
                              <option></option>
                              <?php
                              $queryAsrama = "SELECT * FROM asrama";
                              $resultAsrama = mysqli_query($koneksi, $queryAsrama);
                              while ($dataAsrama = mysqli_fetch_array($resultAsrama)) {
                                $selected = ($dataAsrama['ID_ASRAMA'] == $row['ID_ASRAMA']) ? 'selected' : '';
                                echo "<option value='" . $dataAsrama['ID_ASRAMA'] . "' " . $selected . ">" . $dataAsrama['ASRAMA'] . "</option>";
                              }
                              ?>
                            </select>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-4">
                            <label for="kamar">Nama kamar</label>
                          </div>
                          <div class="form-group col-8">
                            <input type="text" autocomplete="off" name="kamar" id="kamar" class="form-control form-control-sm" value="<?php echo $row['NO_KAMAR'] ?>" required>
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

<!-- Modal Tambah Kamar-->
<div class="modal fade" id="modalTambahKamar" tabindex="-1" role="dialog" aria-labelledby="tambahKamarLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahKamarLabel">Tambah Data Asrama</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="../config/proses-pengurus.php?action=tb_kamar" method="POST" class="my-1">
          <div class="form-group">
            <div class="form-row">
              <div class="form-group col-4">
                <label for="asrama">Nama Asrama</label>
              </div>
              <div class="form-group col-8">
                <select name="asrama" id="asrama" class="custom-select custom-select-sm" required>
                  <option></option>
                  <?php
                  $query = "SELECT * FROM asrama";
                  $result = mysqli_query($koneksi, $query);
                  while ($row2 = mysqli_fetch_array($result)) {
                    echo "<option value='$row2[ID_ASRAMA]'>$row2[ASRAMA]</option>";
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-4">
                <label for="kamar">Nama kamar</label>
              </div>
              <div class="form-group col-8">
                <input type="text" autocomplete="off" name="kamar" id="kamar" class="form-control form-control-sm" required>
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

<script>
  $(document).ready(function() {
    $('#tabel-kamar').DataTable();

    $("#dl_lembaga").addClass("active");
  });
</script>