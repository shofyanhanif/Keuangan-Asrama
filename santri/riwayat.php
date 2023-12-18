<!-- Halaman RIwayat (Santri) -->
<div class="card shadow">
  <div class="card-header">
    <h4 class="m-0 font-weight-bold">Riwayat Pembayaran</h4>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-sm table-bordered text-gray-700" id="tabel-riwayat" style="width: 100%;">
        <thead>
          <tr>
            <th>No</th>
            <th>ID Pembayaran</th>
            <th>Tanggal Bayar</th>
            <th>Status</th>
            <th>Keterangan</th>
            <th>Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $query = "SELECT *, p.STATUS AS status FROM pembayaran p JOIN santri s ON p.ID_SANTRI = s.ID_SANTRI WHERE p.ID_SANTRI = '$id_santri' ORDER BY p.ID_PEMBAYARAN DESC";
          $result = mysqli_query($koneksi, $query);
          $no = 1;
          while ($data = mysqli_fetch_array($result)) {
            $tanggal = date('d-m-Y', strtotime($data['TGL_BAYAR']));
            // $formatNominal = 'Rp ' . number_format($data['NOMINAL'], 0, ',', '.');
          ?>
            <tr>
              <td><?php echo $no++ ?></td>
              <td><?php echo $data['ID_PEMBAYARAN'] ?></td>
              <td><?php echo $tanggal ?></td>
              <!-- <td><?php echo $formatNominal ?></td> -->
              <!-- <td><?php echo $data['JENIS_BAYAR'] ?></td> -->
              <td><?php echo $data['status'] ?></td>
              <td><?php echo $data['KET'] ?></td>
              <td>
                <?php if ($data['status'] == 'Tidak Valid') : ?>
                  <a href="#" type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#uploadUlang<?php echo $data['ID_PEMBAYARAN'] ?>"><i class="fas fa-edit"></i></a>
                <?php elseif ($data['status'] == 'Valid') : ?>
                  <a href="#" type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#strukOnline<?php echo $data['ID_PEMBAYARAN'] ?>"><i class="fas fa-info-circle"></i></a>
                <?php elseif ($data['JENIS_BAYAR'] == 'Langsung') : ?>
                  <a href="#" type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#strukLangsung<?php echo $data['ID_PEMBAYARAN'] ?>"><i class="fas fa-info-circle"></i></a>
                <?php endif ?>
              </td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal Upload Ulang Bukti Pembayaran -->
<?php
$result = mysqli_query($koneksi, $query);
while ($row = mysqli_fetch_array($result)) {
  $tanggal = date('d-m-Y', strtotime($row['TGL_BAYAR']));
  $formatNominal = 'Rp ' . number_format($row['NOMINAL'], 0, ',', '.');
?>
  <div class="modal fade" id="uploadUlang<?php echo $row['ID_PEMBAYARAN'] ?>" tabindex="-1" aria-labelledby="uploadUlangLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="uploadUlangLabel">Upload Ulang Bukti</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="font-size: 12px; padding: 5px">
          <!-- Rincian data tagihan -->
          <div class="table-responsive">
            <table class="table table-striped text-gray-700">
              <tr>
                <th>Tanggal</th>
                <td><?php echo $tanggal ?></td>
              </tr>
              <tr>
                <th>ID Santri</th>
                <td><?php echo $row['ID_SANTRI'] ?></td>
              </tr>
              <tr>
                <th>Nama</th>
                <td><?php echo $row['NAMA'] ?></td>
              </tr>
              <!-- <tr>
              <th>Bulan</th>
              <td>

              </td>
            </tr>
            <tr>
              <th>Kategori</th>
              <td>

              </td>
            </tr>
            <tr> -->
              <th>Total Nominal</th>
              <td><?php echo $formatNominal ?></td>
              </tr>
            </table>
          </div>

          <!-- Form upload bukti pembayaran -->
          <form action="../config/proses-santri.php?action=upd_bukti" method="POST" enctype="multipart/form-data">
            <div class="form-group p-auto" style="padding: 4px;">
              <label for="buktiPembayaran">Bukti Pembayaran</label>
              <input type="file" class="form-control-file" id="buktiPembayaran" name="buktiPembayaran" accept="image/*" required>
            </div>
            <input type="hidden" name="id_pembayaran" value="<?php echo $row['ID_PEMBAYARAN'] ?>">
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary btn-sm">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php
}
?>

<!-- Modal Struk Pembayaran Online -->
<?php
$sql = "SELECT *, p.NOMINAL AS jumlah FROM pembayaran p JOIN santri s ON p.ID_SANTRI = s.ID_SANTRI JOIN tagihan t ON p.ID_SANTRI = t.ID_SANTRI";
$result = mysqli_query($koneksi, $sql);
while ($row = mysqli_fetch_array($result)) {
  $NAMA = strtoupper($row['NAMA']);
  $jumlah = 'Rp ' . number_format($row['jumlah'], 0, ',', '.');

  $idSantri = $row['ID_SANTRI']; // Simpan ID_SANTRI untuk digunakan dalam query

  // Query untuk memperoleh kategori dan bulan berdasarkan ID_SANTRI
  $kategoriQuery = "SELECT DISTINCT KATEGORI, BULAN FROM tagihan WHERE ID_SANTRI = '$idSantri'";

  $kategoriResult = mysqli_query($koneksi, $kategoriQuery);

  $kategoriArr = array();
  $bulanArr = array();
  while ($kategoriRow = mysqli_fetch_array($kategoriResult)) {
    $kategoriArr[] = $kategoriRow['KATEGORI'];
    $bulanArr[] = $kategoriRow['BULAN'];
  }
  $kategoriArr = array_unique($kategoriArr);
  $kategori = implode(', ', $kategoriArr);

  $bulanArr = array_unique($bulanArr);
  $bulan = implode(', ', $bulanArr);
?>
  <div class="modal fade" id="strukOnline<?php echo $row['ID_PEMBAYARAN'] ?>" tabindex="-1" aria-labelledby="strukOnlineLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="strukOnlineLabel"><?php echo $row['ID_PEMBAYARAN'] ?></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="font-size: 12px; padding: 5px">
          <!-- Rincian data tagihan -->
          <div class="table-responsive">
            <table class="table table-striped text-gray-700">
              <tr>
                <th>Tanggal</th>
                <td><?php echo $tanggal ?></td>
              </tr>
              <tr>
                <th>Nama</th>
                <td><?php echo $row['ID_SANTRI'] ?> <?php echo $NAMA ?></td>
              </tr>
              <tr>
                <th>Keterangan</th>
                <td>
                  <?php
                  echo "$kategori (Bulan: $bulan)";
                  ?>
                </td>
              </tr>
              <tr>
                <th>Jumlah</th>
                <td><?php echo $jumlah ?></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php
}
?>

<!-- Modal Struk Pembayaran Langsung -->
<?php
$result2 = mysqli_query($koneksi, $sql);
while ($row2 = mysqli_fetch_array($result2)) {
  $NAMA = strtoupper($row2['NAMA']);
  $jumlah = 'Rp ' . number_format($row2['jumlah'], 0, ',', '.');

  $idSantri = $row2['ID_SANTRI'];

  // Query untuk memperoleh kategori dan bulan berdasarkan ID_SANTRI
  $kategoriQuery = "SELECT DISTINCT KATEGORI, BULAN FROM tagihan WHERE ID_SANTRI = '$idSantri'";

  $kategoriResult = mysqli_query($koneksi, $kategoriQuery);

  $kategoriArr = array();
  $bulanArr = array();
  while ($kategoriRow = mysqli_fetch_array($kategoriResult)) {
    $kategoriArr[] = $kategoriRow['KATEGORI'];
    $bulanArr[] = $kategoriRow['BULAN'];
  }
  $kategoriArr = array_unique($kategoriArr);
  $kategori = implode(', ', $kategoriArr);

  $bulanArr = array_unique($bulanArr);
  $bulan = implode(', ', $bulanArr);
?>
  <div class="modal fade" id="strukLangsung<?php echo $row2['ID_PEMBAYARAN'] ?>" tabindex="-1" aria-labelledby="strukLangsungLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="strukLangsungLabel"><?php echo $row2['ID_PEMBAYARAN'] ?></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="font-size: 12px; padding: 5px">
          <div class="table-responsive">
            <table class="table table-striped text-gray-700">
              <tr>
                <th>Tanggal</th>
                <td><?php echo $tanggal ?></td>
              </tr>
              <tr>
                <th>Nama</th>
                <td><?php echo $row2['ID_SANTRI'] ?> <?php echo $NAMA ?></td>
              </tr>
              <tr>
                <th>Keterangan</th>
                <td>
                  <?php
                  echo "$kategori (Bulan: $bulan)";
                  ?>
                </td>
              </tr>
              <tr>
                <th>Jumlah</th>
                <td><?php echo $jumlah ?></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php
}
?>

<script>
  $(document).ready(function() {
    $('#tabel-riwayat').DataTable();
  });
</script>