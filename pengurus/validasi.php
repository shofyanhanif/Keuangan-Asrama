<style>
  .gambar-container {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: rgba(0, 0, 0, 0.7);
    z-index: 9999;
  }

  .gambar-container img {
    max-width: 80%;
    max-height: 80%;
  }

  .gambar-container .close-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    color: #fff;
    font-size: 24px;
    cursor: pointer;
  }

  #table-form th {
    width: 40%;
  }
</style>

<!-- Halaman Validasi (Pengurus) -->
<div class="card shadow">
  <div class="card-header">
  <h4 class="m-0 font-weight-bold">Validasi Pembayaran</h4>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-sm table-bordered text-gray-700" id="tabel-validasi" style="width: 100%;">
        <thead>
          <tr>
            <th>No</th>
            <th>ID Pembayaran</th>
            <th>Tanggal Bayar</th>
            <th>ID Santri</th>
            <th>Nominal</th>
            <th>Status</th>
            <th>Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          $query = "SELECT p.ID_PEMBAYARAN, p.TGL_BAYAR, p.ID_SANTRI, s.NAMA, p.NOMINAL, p.JENIS_BAYAR, p.STATUS, p.BUKTI FROM pembayaran p JOIN santri s ON p.ID_SANTRI = s.ID_SANTRI WHERE p.STATUS = 'Menunggu'";
          $result = mysqli_query($koneksi, $query);
          while ($data = mysqli_fetch_array($result)) {
            $tanggal = date('d-m-Y', strtotime($data['TGL_BAYAR']));
            $formatNominal = 'Rp ' . number_format($data['NOMINAL'], 0, ',', '.');
          ?>
            <tr>
              <td><?php echo $no++ ?></td>
              <td><?php echo $data['ID_PEMBAYARAN'] ?></td>
              <td><?php echo $tanggal ?></td>
              <td><?php echo $data['ID_SANTRI'] ?></td>
              <td><?php echo $formatNominal ?></td>
              <td><?php echo $data['STATUS'] ?></td>
              <td>
                <a href="#" type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#validasi<?php echo $data['ID_PEMBAYARAN'] ?>"><i class="fas fa-info-circle"></i></a>
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

<?php
$result = mysqli_query($koneksi, $query);
while ($data = mysqli_fetch_array($result)) {
  $tanggal = date('d-m-Y', strtotime($data['TGL_BAYAR']));
  $formatNominal = 'Rp ' . number_format($data['NOMINAL'], 0, ',', '.');
?>
  <!-- Modal Validasi-->
  <div class="modal fade" id="validasi<?php echo $data['ID_PEMBAYARAN'] ?>" tabindex="-1" aria-labelledby="validasiLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="validasiLabel">Proses Validasi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="../config/proses-pengurus.php?action=validasi" method="POST">
          <div class="modal-body" style="font-size: 12px; padding: 5px">
            <div class="table-responsive">
              <table class="table table-borderless text-gray-700" id="table-form">
                <tr>
                  <th>ID Pembayaran</th>
                  <td><?php echo $data['ID_PEMBAYARAN'] ?></td>
                </tr>
                <tr>
                  <th>Tanggal</th>
                  <td><?php echo $tanggal ?></td>
                </tr>
                <tr>
                  <th>ID Santri</th>
                  <td><?php echo $data['ID_SANTRI'] ?></td>
                </tr>
                <tr>
                  <th>Nama</th>
                  <td><?php echo $data['NAMA'] ?></td>
                </tr>
                <tr>
                  <th>Nominal</th>
                  <td><?php echo $formatNominal ?></td>
                </tr>
                <tr>
                <tr>
                  <th>Bukti Pembayaran</th>
                  <td>
                    <?php
                    // Ambil nama file bukti pembayaran dari database berdasarkan ID_PEMBAYARAN
                    $id_pembayaran = $data['ID_PEMBAYARAN'];
                    $sqlModal = "SELECT * FROM pembayaran WHERE ID_PEMBAYARAN = '$id_pembayaran'";
                    $resultModal = mysqli_query($koneksi, $sqlModal);

                    if ($resultModal && mysqli_num_rows($resultModal) > 0) {
                      $row = mysqli_fetch_assoc($resultModal);
                      $namaBuktiPembayaran = $row['BUKTI'];

                      if (!empty($namaBuktiPembayaran)) {
                        echo '<a href="#" class="gambarLink" data-image="../bukti-img/' . $namaBuktiPembayaran . '" data-nama="' . $namaBuktiPembayaran . '">' . $namaBuktiPembayaran . '</a>';
                      } else {
                        echo 'Bukti pembayaran tidak tersedia.';
                      }
                    } else {
                      echo 'Bukti pembayaran tidak tersedia.';
                    }
                    ?>
                  </td>
                </tr>
                <tr>
                  <th>
                    <label for="validasi" class="mb-2">Validasi</label>
                  </th>
                  <td>
                    <select name="validasi" id="validasi" class="control-select" required>
                      <option></option>
                      <option>Valid</option>
                      <option>Tidak Valid</option>
                    </select>
                  </td>
                </tr>
                <tr id="pesan-row" style="display: none;">
                  <th>
                    Pesan
                  </th>
                  <td>
                    <div class="form-group">
                      <textarea class="form-control" id="message" name="message" rows="3" style="font-size: 12px;"></textarea>
                    </div>
                  </td>
                </tr>
                <tr hidden>
                  <td>
                    <input name="id_santri" value="<?php echo $data['ID_SANTRI'] ?>">
                  </td>
                </tr>
              </table>
            </div>
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

<script>
  $(document).ready(function() {
    $('#tabel-validasi').DataTable();

    $('.gambarLink').click(function() {
      var imagePath = $(this).data('image');
      var imageNama = $(this).data('nama');
      var imageHtml = '<div class="gambar-container">' +
        '<span class="close-btn">&times;</span>' +
        '<img src="' + imagePath + '" alt="Gambar Pembayaran">' +
        '</div>';

      $('body').append(imageHtml);

      $('.close-btn').click(function() {
        $('.gambar-container').remove();
      });

      // $(document).keyup(function(e) {
      //   if (e.key === "Escape") {
      //     $('.gambar-container').remove();
      //   }
      // });
    });

    var validasiSelect = document.getElementById('validasi');
    var pesanRow = document.getElementById('pesan-row');

    validasiSelect.addEventListener('change', function() {
      if (validasiSelect.value === 'Tidak Valid') {
        pesanRow.style.display = 'table-row';
      } else {
        pesanRow.style.display = 'none';
      }
    });
  });
</script>