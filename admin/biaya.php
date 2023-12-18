<!-- Halaman Data Biaya (Admin)-->
<div class="card shadow">
  <div class="card-header">
    <div class="d-sm-flex align-items-center justify-content-between">
      <h4 class="m-0 font-weight-bold">Data Biaya Bulanan</h4>
      <button type="button" class="btn btn-primary btn-sm ml-4" data-toggle="modal" data-target="#modalTambahSPP">
        Tambah
      </button>
    </div>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-sm table-bordered text-gray-700" id="tabel-biaya" style="width: 100%;">
        <thead>
          <tr>
            <th>No</th>
            <th>Asrama</th>
            <th>Tahun</th>
            <th>Kategori</th>
            <th>Nominal</th>
            <th>Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // Proses Menampilkan Data
          $query = "SELECT * FROM spp s JOIN asrama a ON s.ID_ASRAMA = a.ID_ASRAMA";
          $result = mysqli_query($koneksi, $query);
          $no = 1;
          while ($row = mysqli_fetch_array($result)) {
            $nominal = 'Rp ' . number_format($row['NOMINAL'], 0, ',', '.');
          ?>
            <tr>
              <td><?php echo $no++; ?></td>
              <td><?php echo $row['ASRAMA']; ?></td>
              <td><?php echo $row['TAHUN']; ?></td>
              <td><?php echo $row['KATEGORI']; ?></td>
              <td><?php echo $nominal ?></td>
              <td>
                <a href="#" type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#editSPP<?php echo $row['ID_SPP'] ?>"><i class="fas fa-fw fa-edit"></i></a>
                <a href="../config/proses-admin.php?action=dl_biaya&id_spp=<?php echo $row['ID_SPP'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus Data ?')"><i class="fas fa-fw fa-trash"></i></a>
              </td>
            </tr>

            <!-- Modal Edit Data SPP -->
            <div class="modal fade" id="editSPP<?php echo $row['ID_SPP'] ?>" tabindex="-1" aria-labelledby="editAsramaLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="editAsramaLabel">Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form action="../config/proses-admin.php?action=edit_biaya" method="POST" class="my-1">
                      <div class="form-group" hidden>
                        <div class="form-row">
                          <div class="form-group col-4">
                            <label for="id_spp">ID SPP</label>
                          </div>
                          <div class="form-group col-8">
                            <input type="text" name="id_spp" id="id_spp" class="form-control form-control-sm" value="<?php echo $row['ID_SPP'] ?>" readonly>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="form-row">
                          <div class="form-group col-4">
                            <label for="asrama">Asrama</label>
                          </div>
                          <div class="form-group col-8">
                            <select name="asrama" id="asrama" class="custom-select custom-select-sm" required>
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
                            <label for="tahun">Tahun</label>
                          </div>
                          <div class="form-group col-8">
                            <input type="text" name="tahun" id="tahun" class="form-control form-control-sm" value="<?php echo $row['TAHUN'] ?>" oninput="validasiAngka(this)" required>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-4">
                            <label for="kategori">Kategori</label>
                          </div>
                          <div class="form-group col-8">
                            <input type="text" autocomplete="off" name="kategori" id="kategori" class="form-control form-control-sm" value="<?php echo $row['KATEGORI'] ?>" required>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-4">
                            <label for="nominal">Nominal</label>
                          </div>
                          <div class="form-group col-8">
                            <input type="text" autocomplete="off" name="nominal" id="nominal" class="form-control form-control-sm" value="<?php echo $row['NOMINAL'] ?>" oninput="validasiAngka(this)" required>
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

    <!-- Modal Tambah SPP-->
    <div class="modal fade" id="modalTambahSPP" tabindex="-1" aria-labelledby="modalTambahSPPLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalTambahSPPLabel">Tambah Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="../config/proses-admin.php?action=tb_biaya" method="POST" class="my-1">
              <div class="form-group">
                <div class="form-row">
                  <div class="form-group col-4">
                    <label for="asrama">Asrama</label>
                  </div>
                  <div class="form-group col-8">
                    <select name="asrama" id="asrama" class="custom-select custom-select-sm" required>
                      <option></option>
                      <?php
                      $query = "SELECT * FROM asrama";
                      $result = mysqli_query($koneksi, $query);
                      while ($data = mysqli_fetch_array($result)) {
                        echo "<option value='$data[ID_ASRAMA]'>$data[ASRAMA]</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-4">
                    <label for="tahun">Tahun</label>
                  </div>
                  <div class="form-group col-8">
                    <input type="text" autocomplete="off" name="tahun" id="tahun" class="form-control form-control-sm" oninput="validasiAngka(this)" required>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-4">
                    <label for="kategori">Kategori</label>
                  </div>
                  <div class="form-group col-8">
                    <input type="text" autocomplete="off" name="kategori" id="kategori" class="form-control form-control-sm" required>
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

<script>
  $(document).ready(function() {
    $('#tabel-biaya').DataTable();
  });

  // validasi inputan khusus angka
  function validasiAngka(input) {
    input.value = input.value.replace(/\D/g, '');
  }
</script>