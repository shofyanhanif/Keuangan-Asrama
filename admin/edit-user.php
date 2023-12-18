<?php
$id = $_GET['id_santri'];

$query = "SELECT * FROM santri s JOIN level l ON s.ID_LEVEL = l.ID_LEVEL WHERE ID_SANTRI = '$id'";
$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_array($result);
?>

<!-- Content Edit User -->
<div class="card shadow">
  <div class="card-header">
    <h4 class="m-0 font-weight-bold">Edit Data Pengguna</h4>
  </div>
  <form role="form" action="../config/proses-admin.php?action=edit_user" method="POST">
    <div class="card-body text-gray-700">
      <div class="form-group">
        <div class="form-row">
          <div class="form-group col-6">
            <label for="id_santri">ID Santri</label>
            <input type="text" name="id_santri" id="id_santri" class="form-control form-control-sm" value="<?php echo $row['ID_SANTRI'] ?>" readonly>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-6">
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control form-control-sm" autocomplete="off" value="<?php echo $row['NAMA'] ?>" required>
          </div>
          <div class="form-group col-6">
            <label for="password">Password</label>
            <input type="text" autocomplete="off" name="password" id="password" class="form-control form-control-sm" value="<?php echo $row['PASSWORD'] ?>" required>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-6">
            <label for="level">Level</label>
            <select name="level" id="level" required class="custom-select custom-select-sm">
              <?php
              $query = "SELECT * FROM level";
              $result = mysqli_query($koneksi, $query);
              while ($data = mysqli_fetch_array($result)) {
                echo "<option value='" . $data['ID_LEVEL'] . "'";
                if ($data['ID_LEVEL'] == $row['ID_LEVEL']) {
                  echo "selected";
                }
                echo ">" . $data['LEVEL'] . "</option>";
              }
              ?>
            </select>
          </div>
          <div class="form-group col-6">
            <label for="status">Status</label>
            <select name="status" id="status" required class="custom-select custom-select-sm">
              <?php
              $enumValues = ['Aktif', 'Tidak Aktif'];
              foreach ($enumValues as $value) {
                echo "<option value='$value'>$value</option>";
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