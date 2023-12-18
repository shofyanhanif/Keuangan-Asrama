<!-- Halaman Tambah Pengguna (Pengasuh) -->
<div class="card shadow">
  <div class="card-header">
    <h4 class="m-0 font-weight-bold">Tambah Pengguna</h4>
  </div>
  <form role="form" action="../config/proses-pengasuh.php?action=tb_user" method="POST">
    <div class="card-body text-gray-700">
      <div class="form-group">
        <label for="nama">Nama</label>
        <input type="text" name="nama" id="nama" class="form-control form-control-sm" autocomplete="off" required>
      </div>
      <div class="form-group">
        <div class="form-row">
          <div class="form-group col-9">
            <label for="password">Password</label>
            <input type="text" autocomplete="off" name="password" id="password" class="form-control form-control-sm" required>
          </div>
          <div class="form-group col-3">
            <label for="tahun">Tahun Masuk</label>
            <select name="tahun" id="tahun" class="custom-select custom-select-sm" required>
              <option></option>
              <?php
              $tahunSekarang = date('Y');
              $tahunAwal = 2000;

              for ($tahun = $tahunAwal; $tahun <= $tahunSekarang; $tahun++) {
                echo "<option value='$tahun'>$tahun</option>";
              }
              ?>
            </select>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-6">
            <label for="asrama">Asrama</label>
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
          <div class="form-group col-6">
            <label for="level">Level</label>
            <select name="level" id="level" class="custom-select custom-select-sm" required>
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
          <a href="index.php?page=user" class="btn btn-sm btn-danger d-none d-sm-inline-block">Kembali</a>
          <input type="submit" class="submit btn btn-sm btn-primary d-none d-sm-inline-block" value="Simpan">
        </div>
      </div>
    </div>
  </form>
</div>