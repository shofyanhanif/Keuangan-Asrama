<?php
$id = $_GET['id_santri'];

$query = "SELECT * FROM santri s LEFT JOIN asrama a ON s.ID_ASRAMA = a.ID_ASRAMA LEFT JOIN kamar k ON s.ID_KAMAR = k.ID_KAMAR LEFT JOIN lembaga l ON s.ID_LEMBAGA = l.ID_LEMBAGA WHERE s.ID_SANTRI = '$id'";
$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_array($result);
?>

<!-- Halaman Edit Data Santri (Pengurus) -->
<div class="card card-primary">
  <div class="card-header">
    <h4 class="m-0 font-weight-bold">Edit Data Santri</h4>
  </div>
  <form role="form" action="../config/proses-pengurus.php?action=edit_santri" method="POST">
    <div class="card-body text-gray-900">
      <div class="row">
        <div class="col-6">
          <div class="form-group">
            <label for="id_santri">ID Santri</label>
            <input type="text" name="id_santri" id="id_santri" class="form-control form-control-sm" value="<?php echo $id ?>" readonly>
          </div>
        </div>
        <div class="col-6">
          <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control form-control-sm" autocomplete="off" value="<?php echo $row['NAMA'] ?>" required>
          </div>
        </div>
      </div>
      <!-- <div class="row">
        <div class="col-6">
          <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control form-control-sm" autocomplete="off" value="<?php echo $row['NAMA'] ?>" required>
          </div>
        </div>
        <div class="col-6">
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control form-control-sm" autocomplete="off" value="<?php echo $row['EMAIL'] ?>" required>
          </div>
        </div>
      </div> -->
      <div class="row">
        <div class="col-6">
          <div class="form-group">
            <label for="tempat">Tempat</label>
            <input type="text" name="tempat" id="tempat" class="form-control form-control-sm" autocomplete="off" value="<?php echo $row['TEMPAT_LHR'] ?>" required>
          </div>
        </div>
        <div class="col-6">
          <div class="form-group">
            <label for="tgl">Tanggal Lahir</label>
            <input type="date" name="tgl" id="tgl" class="form-control form-control-sm" autocomplete="off" value="<?php echo $row['TGL_LAHIR'] ?>" required>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-6">
          <div class="form-group">
            <label for="jk">Jenis Kelamin</label>
            <select name="status" id="status" class="custom-select custom-select-sm" required>
              <?php
              $jkSelected = $row['jk'];
              $jkPilihan = array("Laki-Laki", "Perempuan");

              foreach ($jkPilihan as $option) {
                $selected = ($jkSelected == $option) ? "selected" : "";
                echo "<option value=\"$option\" $selected>$option</option>";
              }
              ?>
            </select>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="alamat">Alamat</label>
        <input type="text" name="alamat" id="alamat" class="form-control form-control-sm" autocomplete="off" value="<?php echo $row['ALAMAT'] ?>" required>
      </div>
      <div class="row">
        <div class="col-6">
          <div class="form-group">
            <label for="provinsi">Provinsi</label>
            <select name="provinsi" id="provinsi" class="custom-select prov-single" required>
              <option></option>
              <?php
              $query = "SELECT * FROM tbl_provinsi";
              $result = mysqli_query($koneksi, $query);
              // Menampilkan opsi select dropdown provinsi
              while ($rowProvinsi = mysqli_fetch_array($result)) {
                $selected = ($rowProvinsi['ID_PROV'] == $row['ID_PROVINSI']) ? 'selected' : '';
                echo '<option value="' . $rowProvinsi['ID_PROV'] . '" ' . $selected . '>' . $rowProvinsi['NAMA_PROV'] . '</option>';
              }
              ?>
            </select>
          </div>
        </div>
        <div class="col-6">
          <div class="form-group">
            <label for="kota">Kota/Kabupaten</label>
            <select name="kota" id="kota" class="custom-select kota-single" required>
            </select>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-6">
          <div class="form-group">
            <label for="no_hp">No. HP</label>
            <input type="tel" name="no_hp" id="no_hp" class="form-control form-control-sm" autocomplete="off" value="<?php echo $row['NO_HP'] ?>" oninput="validasiAngka(this)" required>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-6">
          <div class="form-group">
            <label for="asrama">Asrama</label>
            <select name="asrama" id="asrama" class="custom-select asrama-single" required>
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
        <div class="col-6">
          <div class="form-group">
            <label for="kamar">Kamar</label>
            <select name="kamar" id="kamar" class="custom-select kamar-single" required>
            </select>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-6">
          <div class="form-group">
            <label for="lembaga">Lembaga</label>
            <select name="lembaga" id="lembaga" class="custom-select custom-select-sm">
              <?php
              $query = "SELECT * FROM lembaga";
              $result = mysqli_query($koneksi, $query);
              while ($data2 = mysqli_fetch_array($result)) {
                echo "<option value='" . $data2['ID_LEMBAGA'] . "'";
                if ($data2['ID_LEMBAGA'] == $row['ID_LEMBAGA']) {
                  echo "selected";
                }
                echo ">" . $data2['NAMA_LEMBAGA'] . "</option>";
              }
              ?>
            </select>
          </div>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <a href="index.php?page=santri" class="btn btn-danger">Kembali</a>
      <input type="submit" class="submit btn btn-primary" value="Simpan">
    </div>
  </form>
</div>

<script>
  // validasi inputan khusus angka
  function validasiAngka(input) {
    input.value = input.value.replace(/\D/g, '');
  }

  $(document).ready(function() {
    $('.prov-single, .kota-single, .asrama-single, .kamar-single').select2();

    // Event handler ketika nilai provinsi berubah
    $('#provinsi').on('change', function() {
      var idProvinsi = $(this).val();

      $.ajax({
        url: '../config/prosesGet-admin.php?get=kota',
        method: 'POST',
        data: {
          idProvinsi: idProvinsi
        },
        success: function(response) {
          $('#kota').html(response);
          $('.kota-single').select2();
        }
      });
    });

    // Event handler ketika nilai asrama berubah
    $('#asrama').on('change', function() {
      var idAsrama = $(this).val();

      $.ajax({
        url: '../config/prosesGet-admin.php?get=kamar',
        method: 'POST',
        data: {
          idAsrama: idAsrama
        },
        success: function(response) {
          $('#kamar').html(response);
          $('.kamar-single').select2();
        }
      });
    });

    // Menampilkan nama provinsi dan kota berdasarkan ID santri saat halaman dimuat
    var idSantri = "<?php echo isset($id) ? $id : ''; ?>"; // Mendapatkan nilai ID santri dari PHP
    if (idSantri !== '') {
      $.ajax({
        url: '../config/prosesGet-admin.php?get=alamatSantri',
        method: 'POST',
        data: {
          id_santri: idSantri
        },
        success: function(response) {
          var dataSantri = JSON.parse(response);

          // Menampilkan nama provinsi
          $('#provinsi').val(dataSantri.ID_PROVINSI).trigger('change');

          // Menampilkan nama kota
          var idProvinsi = dataSantri.ID_PROVINSI;
          $.ajax({
            url: '../config/prosesGet-admin.php?get=kota',
            method: 'POST',
            data: {
              idProvinsi: idProvinsi
            },
            success: function(response) {
              $('#kota').html(response);
              $('#kota').val(dataSantri.ID_KOTA).trigger('change');
              $('.kota-single').select2();
            }
          });
        }
      });
    }

    // Menampilkan nama asrama dan kamar berdasarkan ID santri saat halaman dimuat
    var idSantri = "<?php echo isset($id) ? $id : ''; ?>"; // Mendapatkan nilai ID santri dari PHP
    if (idSantri !== '') {
      $.ajax({
        url: '../config/prosesGet-admin.php?get=kamarSantri',
        method: 'POST',
        data: {
          id_santri: idSantri
        },
        success: function(response) {
          var dataSantri = JSON.parse(response);

          // Menampilkan nama asrama
          $('#asrama').val(dataSantri.ID_ASRAMA).trigger('change');

          // Menampilkan nama kamar
          var idAsrama = dataSantri.ID_ASRAMA;
          $.ajax({
            url: '../config/prosesGet-admin.php?get=kamar',
            method: 'POST',
            data: {
              idAsrama: idAsrama
            },
            success: function(response) {
              $('#kamar').html(response);
              $('#kamar').val(dataSantri.ID_KAMAR).trigger('change');
              $('.kamar-single').select2();
            }
          });
        }
      });
    }
  });
</script>