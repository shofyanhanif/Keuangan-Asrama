<!-- Content Tagihan Santri -->
<div class="card shadow">
  <div class="card-header">
    <?php
    $sql = "SELECT * FROM tagihan WHERE ID_SANTRI = '$id_santri' AND STATUS = 'Tunggakan'";
    $result = mysqli_query($koneksi, $sql);
    $data = mysqli_num_rows($result) > 0;

    $query = "SELECT * FROM pembayaran WHERE ID_SANTRI = '$id_santri' AND STATUS IN ('Menunggu', 'Tidak Valid', 'Valid')";
    $hasil = mysqli_query($koneksi, $query);
    $data2 = mysqli_num_rows($hasil) > 0;
    ?>
    <div class="d-sm-flex align-items-center justify-content-between">
      <h4 class="m-0 font-weight-bold">Tagihan</h4>
      <button type="button" class="btn btn-sm btn-danger ml-5" id="btnModal" data-toggle="modal" data-target="#modalBayar" <?php if (!$data || $data2) echo 'disabled'; ?>>
        Bayar
      </button>
    </div>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-sm table-bordered text-gray-700" id="tabel-tagihan" style="width: 100%;">
        <thead>
          <tr>
            <th>No</th>
            <th>Tahun</th>
            <th>Bulan</th>
            <th>Kategori</th>
            <th>Nominal</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // Proses Menampilkan Data
          $query = "SELECT * FROM tagihan WHERE ID_SANTRI = '$id_santri' AND STATUS = 'Tunggakan'";
          $result = mysqli_query($koneksi, $query);
          $no = 1;
          while ($row = mysqli_fetch_array($result)) {
            $formatNominal = 'Rp ' . number_format($row['NOMINAL'], 0, ',', '.');
          ?>
            <tr>
              <td><?php echo $no++; ?> </td>
              <td><?php echo $row['TAHUN']; ?> </td>
              <td><?php echo $row['BULAN']; ?> </td>
              <td><?php echo $row['KATEGORI']; ?> </td>
              <td><?php echo $formatNominal; ?> </td>
              <td><?php echo $row['STATUS'] ?></td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="modal fade" id="modalBayar" tabindex="-1" aria-labelledby="modalBayarLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalBayarLabel">Rincian Pembayaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="font-size: 14px; padding: 5px">
        <!-- Rincian data tagihan -->
        <div class="table-responsive">
          <table class="table table-striped text-gray-700">
            <?php
            $result = mysqli_query($koneksi, $query);
            $row = mysqli_fetch_array($result);
            $NAMA = strtoupper($nama);
            ?>
            <tr>
              <th>Tanggal</th>
              <td><?php echo date('d-m-Y') ?></td>
            </tr>
            <tr>
              <th>Nama</th>
              <td><?php echo $id_santri ?> <?php echo $NAMA ?></td>
            </tr>
            <!-- <tr>
              <th>Bulan</th>
              <td>
                <?php
                $result = mysqli_query($koneksi, $query);
                $bulanArr = array();
                while ($row = mysqli_fetch_array($result)) {
                  if (!in_array($row['BULAN'], $bulanArr)) {
                    $bulanArr[] = $row['BULAN'];
                  }
                }
                echo implode(', ', $bulanArr);
                ?>
              </td>
            </tr> -->
            <!-- <tr>
              <th>Kategori</th>
              <td>
                <?php
                $result = mysqli_query($koneksi, $query);
                $kategoriArr = array();
                while ($row = mysqli_fetch_array($result)) {
                  if (!in_array($row['KATEGORI'], $kategoriArr)) {
                    $kategoriArr[] = $row['KATEGORI'];
                  }
                }
                echo implode(', ', $kategoriArr);
                ?>
              </td>
            </tr> -->
            <tr>
              <th>Total Nominal</th>
              <td>
                <?php
                $result = mysqli_query($koneksi, $query);
                $totalNominal = 0;
                while ($row = mysqli_fetch_array($result)) {
                  $totalNominal += (int)$row['NOMINAL'];
                }

                // Format totalNominal menjadi IDR/Rp
                $formattedTotalNominal = 'Rp ' . number_format($totalNominal, 0, ',', '.');
                echo $formattedTotalNominal;
                ?>
              </td>
            </tr>
          </table>
          <p style="padding: 3px;">
            <strong>Panduan</strong>
            <br>
            1. Silakan Transfer ke Rekening berikut: BSI XXXXXXXXXX a/n Asrama Induk
            <br>
            2. Jika Sudah Transfer, Upload Bukti Pembayaran
            <br>
            3. Sertakan Nama dan ID Santri
          </p>
        </div>

        <!-- Form upload bukti pembayaran -->
        <form action="../config/proses-santri.php?action=tb_byr-on" method="POST" enctype="multipart/form-data" style="padding: 3px;">
          <div class="form-group">
            <label for="buktiPembayaran">Bukti Pembayaran</label>
            <input type="file" class="form-control-file" id="buktiPembayaran" name="buktiPembayaran" accept="image/*" required>
          </div>
          <input type="hidden" name="id_santri" value="<?php echo $id_santri; ?>">
          <input type="hidden" name="jumlah" value="<?php echo $totalNominal; ?>">
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('#tabel-tagihan').DataTable();
  });
</script>