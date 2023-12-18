<!-- Modal Struk Pembayaran Online -->
<?php
$sql = "SELECT *, p.NOMINAL AS jumlah FROM pembayaran p JOIN santri s ON p.ID_SANTRI = s.ID_SANTRI JOIN tagihan t ON p.ID_SANTRI = t.ID_SANTRI WHERE p.STATUS IS NULL OR p.STATUS = 'Valid'";
$result2 = mysqli_query($koneksi, $sql);
while ($row = mysqli_fetch_array($result2)) {
  $NAMA = strtoupper($row['NAMA']);
  $jumlah = 'Rp ' . number_format($row['jumlah'], 0, ',', '.');
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
                  $result = mysqli_query($koneksi, $sql);

                  $bulanArr = array();
                  $kategoriArr = array();

                  while ($row3 = mysqli_fetch_array($result)) {
                    if (!in_array($row3['BULAN'], $bulanArr)) {
                      $bulanArr[] = $row3['BULAN'];
                    }

                    if (!in_array($row3['KATEGORI'], $kategoriArr)) {
                      $kategoriArr[] = $row3['KATEGORI'];
                    }
                  }

                  $kategori = implode(', ', $kategoriArr);
                  $bulan = implode(', ', $bulanArr);

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
$result3 = mysqli_query($koneksi, $sql);
while ($row2 = mysqli_fetch_array($result3)) {
  $NAMA = strtoupper($row2['NAMA']);
  $jumlah = 'Rp ' . number_format($row2['jumlah'], 0, ',', '.');
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
                  $result = mysqli_query($koneksi, $sql);

                  $bulanArr = array();
                  $kategoriArr = array();

                  while ($row4 = mysqli_fetch_array($result)) {
                    if (!in_array($row4['BULAN'], $bulanArr)) {
                      $bulanArr[] = $row4['BULAN'];
                    }

                    if (!in_array($row4['KATEGORI'], $kategoriArr)) {
                      $kategoriArr[] = $row4['KATEGORI'];
                    }
                  }

                  $kategori = implode(', ', $kategoriArr);
                  $bulan = implode(', ', $bulanArr);

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