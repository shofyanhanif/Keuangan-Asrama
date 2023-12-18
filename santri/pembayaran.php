<div class="card shadow">
  <div class="card-header">
    <h3 class="m-0 font-weight-bold">Pembayaran</h3>
  </div>
  <div class="card-body text-gray-700">
    <table class="table table-bordered" id="tagihan" style="width: 100%;">
      <thead>
        <tr>
          <th>No</th>
          <th>ID</th>
          <th>Tahun</th>
          <th>Bulan</th>
          <th>Nominal</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        $query = "SELECT ID_SANTRI, TAHUN, BULAN, SUM(NOMINAL), STATUS FROM tagihan WHERE ID_SANTRI = '$id_santri'";
        $result = mysqli_query($koneksi, $query);
        while ($data = mysqli_fetch_array($result)) {
        ?>
          <tr>
            <td><?php echo $no++;  ?> </td>
            <td><?php echo $data['ID_SANTRI']  ?> </td>
            <td><?php echo $data['TAHUN'] ?></td>
            <td><?php echo $data['BULAN'] ?></td>
            <td><?php echo $data['SUM(NOMINAL)'] ?></td>
            <td><?php echo $data['STATUS'] ?></td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Content Pembayaran -->
<div class="page-content">

  <div class="table-responsive">
    <table class="table table-bordered" id="tagihan" style="width: 100%;">
      <thead>
        <tr>
          <th>No</th>
          <th>ID</th>
          <th>Tahun</th>
          <th>Bulan</th>
          <th>Nominal</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        $query = "SELECT ID_SANTRI, TAHUN, BULAN, SUM(NOMINAL), STATUS FROM tagihan WHERE ID_SANTRI = '$id'";
        $result = mysqli_query($koneksi, $query);
        while ($data = mysqli_fetch_array($result)) {
        ?>
          <tr>
            <td><?php echo $no++;  ?> </td>
            <td><?php echo $data['ID_SANTRI']  ?> </td>
            <td><?php echo $data['TAHUN'] ?></td>
            <td><?php echo $data['BULAN'] ?></td>
            <td>Rp <?php echo $data['SUM(NOMINAL)'] ?></td>
            <td><?php echo $data['STATUS'] ?></td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </div>
  <div class="card m-auto mx-5 mt-2">
    <div class="card-primary">
      <form action="../config/proses.php?action=tb_byr-on" role="form" method="POST" enctype="multipart/form-data">
        <div class="card-body">
          <div class="form-group">
            <label for="tgl" class="mb-2">Tanggal</label>
            <input type="text" autocomplete="off" name="tgl" id="tgl" class="form-control mb-3" value="<?php echo date('m-d-Y') ?>" readonly>
          </div>
          <div class="form-group">
            <label for="id" class="mb-2">ID Santri</label>
            <input type="text" autocomplete="off" name="id" id="id" class="form-control mb-3" value="<?php echo $id ?>" readonly>
          </div>
          <div class="form-group">
            <label for="nama" class="mb-2">Nama</label>
            <input type="text" autocomplete="off" name="nama" id="nama" class="form-control mb-3" value="<?php echo $nama ?>" readonly>
          </div>
          <div class="form-group">
            <label for="jumlah" class="mb-2">Jumlah Tranfer<span class="text-danger">*</span></label>
            <input type="text" autocomplete="off" name="jumlah" id="jumlah" class="form-control mb-3" oninput="validasiAngka(this)" required>
          </div>
          <div class="form-group">
            <label for="bank" class="mb-2">Nama Bank<span class="text-danger">*</span></label>
            <input type="text" autocomplete="off" name="bank" id="bank" class="form-control mb-3" required>
          </div>
          <div class="form-group">
            <label for="image" class="mb-2">Upload Bukti Pembayaran<span class="text-danger">*</span></label>
            <input type="file" name="image" id="image" class="form-control mb-3" required>
          </div>
          <!-- <div class="form-group">
            <div id="preview" style="display: none;"></div>
          </div> -->
        </div>
        <div class="card-footer text-end">
          <a href="index.php?page=tagihan" class="btn btn-danger">Kembali</a>
          <input type="submit" class="submit btn btn-primary" value="Kirim">
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  // validasi inputan khusus angka
  function validasiAngka(input) {
    input.value = input.value.replace(/\D/g, '');
  }
</script>