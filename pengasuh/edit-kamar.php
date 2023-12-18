<?php
$id = $_GET['id_kamar'];

$query = "SELECT * FROM kamar k JOIN asrama a ON k.ID_ASRAMA = a.ID_ASRAMA WHERE ID_KAMAR = '$id'";
$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_array($result);
?>

<!-- Halaman Edit Kamar (Pengasuh) -->
<div class="card shadow">
  <div class="card-header">
  <h3 class="m-0 font-weight-bold">Edit Data Kamar</h3>
  </div>
  <form role="form" action="../config/proses-pengasuh.php?action=edit_kamar" method="POST">
    <div class="card-body text-gray-700">
      <div class="form-group">
        <label for="id_kamar" class="mb-2">ID Kamar</label>
        <input type="text" name="id_kamar" id="id_kamar" class="form-control mb-3" value="<?php echo $row['ID_KAMAR'] ?>" readonly>
      </div>
      <div class="form-group">
        <label for="edit_kamar" class="mb-2">No Kamar</label>
        <input type="text" autocomplete="off" name="edit_kamar" id="edit_kamar" class="form-control mb-3" value="<?php echo $row['NO_KAMAR'] ?>" required>
      </div>
      <div class="form-group">
        <label for="asrama" class="mb-2">Nama Asrama</label>
        <select name="asrama" id="asrama" class="custom-select mb-3" required>
          <?php
          $query = "SELECT * FROM asrama";
          $result = mysqli_query($koneksi, $query);
          while ($data = mysqli_fetch_array($result)) {
            echo "<option value='" . $data['ID_ASRAMA'] . "'";
            if ($data['ID_ASRAMA'] == $row['ID_ASRAMA']) {
              echo "selected";
            }
            echo ">" . $data['ASRAMA'] . "</option>";
          }
          ?>
        </select>
      </div>
    </div>
    <div class="modal-footer">
      <a href="index.php?page=kamar" class="btn btn-danger">Kembali</a>
      <input type="submit" class="submit btn btn-primary" value="Simpan">
    </div>
  </form>
</div>