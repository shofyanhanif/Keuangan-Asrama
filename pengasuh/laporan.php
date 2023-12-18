<!-- Halaman Laporan (Pengasuh) -->
<div class="card shadow mb-3">
  <div class="card-header">
    <h4 class="m-0 font-weight-bold">Laporan Keuangan</h4>
  </div>
  <div class="card-body">
    <form role="form" id="formTampil">
      <div class="row">
        <div class="col-12 col-sm-6 col-md-4">
          <div class="form-group">
            <label for="tgl_awal">Tanggal Awal</label>
            <input type="date" name="tgl_awal" id="tgl_awal" class="form-control form-control-sm tglAwal-basic-single" required>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
          <div class="form-group">
            <label for="tgl_akhir">Tanggal Akhir</label>
            <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control form-control-sm" required>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
          <div class="form-group">
            <label for="jenis">Kategori</label>
            <select class="custom-select custom-select-sm" id="jenis" name="jenis" style="vertical-align: middle;" required>
              <option>-- Semua Kategori --</option>
              <option>Pemasukan</option>
              <option>Pengeluaran</option>
            </select>
          </div>
        </div>
        <!-- <div class="col-3">
          <div class="form-group">
            <label for="kategori">Kategori</label>
            <select class="custom-select" id="kategori" name="kategori">
              <option>-- Semua Kategori --</option>
              <?php
              $query = "SELECT * FROM asrama";
              $result = mysqli_query($koneksi, $query);
              while ($row2 = mysqli_fetch_array($result)) {
                echo "<option value='$row2[ID_ASRAMA]'>$row2[ASRAMA]</option>";
              }
              ?>
            </select>
          </div>
        </div> -->
      </div>
      <div class="d-sm-flex justify-content-between">
        <div class="ml-auto">
          <button type="submit" class="btn btn-sm btn-danger px-3" id="tampil">Cari</button>
          <a href="" type="reset" class="btn btn-sm btn-secondary">Reset</a>
        </div>
      </div>
    </form>
  </div>
</div>

<div class="card shadow" id="semuaDefault">
  <div class="card-body">
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
      <?php
      // Ambil tanggal saat ini
      $tanggalSekarang = date('d-m-Y');
      ?>
      <h5 class="m-0 font-weight-bold">Laporan Hari Ini (<?php echo $tanggalSekarang ?>)</h5>
    </div>
    <div class="table-responsive">
      <table class="table table-sm table-bordered text-gray-700">
        <thead>
          <tr>
            <th>No</th>
            <th>Tanggal</th>
            <!-- <th>Kategori</th> -->
            <th>Keterangan</th>
            <th>Pemasukan</th>
            <th>Pengeluaran</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sqlMasuk = "SELECT * FROM pembayaran p JOIN santri s ON p.ID_SANTRI = s.ID_SANTRI WHERE p.TGL_BAYAR = CURRENT_DATE() AND p.STATUS IS NULL OR p.TGL_BAYAR = CURRENT_DATE() AND p.STATUS = 'Valid'";
          $sqlKeluar = "SELECT * FROM pengeluaran WHERE TANGGAL = CURRENT_DATE()";
          $resultMasuk = mysqli_query($koneksi, $sqlMasuk);
          $resultKeluar = mysqli_query($koneksi, $sqlKeluar);

          $no = 1;
          $totalPemasukan = 0;
          $totalPengeluaran = 0;
          while ($rowMasuk = mysqli_fetch_array($resultMasuk)) {
            $tanggalMasuk = date('d-m-Y', strtotime($rowMasuk['TGL_BAYAR']));
            $nama_santri = $rowMasuk['NAMA'];
            $keteranganMasuk = "Pembayaran tagihan bulanan a/n $nama_santri";
            $nominalMasuk = $rowMasuk['NOMINAL'];
            $formatPemasukan = 'Rp ' . number_format($nominalMasuk, 0, ',', '.');
            $totalPemasukan += $nominalMasuk;
          ?>

            <!-- Tampilkan data pemasukan -->
            <tr>
              <td><?php echo $no ?></td>
              <td><?php echo $tanggalMasuk ?></td>
              <!-- <td>Kategori</td> -->
              <td><?php echo $keteranganMasuk ?></td>
              <td><?php echo $formatPemasukan ?></td>
              <td>-</td>
            </tr>

          <?php
            $no++;
          }


          while ($rowKeluar = mysqli_fetch_array($resultKeluar)) {
            $tanggalKeluar = date('d-m-Y', strtotime($rowKeluar['TANGGAL']));
            $keteranganKeluar = $rowKeluar['KETERANGAN'];
            $nominalKeluar = $rowKeluar['NOMINAL'];
            $formatPengeluaran = 'Rp ' . number_format($nominalKeluar, 0, ',', '.');
            $totalPengeluaran += $nominalKeluar;
          ?>

            <!-- Tampilkan data pengeluaran -->
            <tr>
              <td><?php echo $no ?></td>
              <td><?php echo $tanggalKeluar ?></td>
              <!-- <td>Kategori</td> -->
              <td><?php echo $keteranganKeluar ?></td>
              <td>-</td>
              <td><?php echo $formatPengeluaran ?></td>
            </tr>

          <?php
            $no++;
          }

          // echo "<tr>";
          // echo "<td colspan='3' style='text-align: right; font-weight: bold;'>Total Pemasukan:</td>";
          // echo "<td><strong>Rp " . number_format($totalPemasukan, 0, ',', '.') . "</strong></td>";
          // echo "<td>-</td>";
          // echo "</tr>";

          // echo "<tr>";
          // echo "<td colspan='3' style='text-align: right; font-weight: bold;'>Total Pengeluaran:</td>";
          // echo "<td>-</td>";
          // echo "<td><strong>Rp " . number_format($totalPengeluaran, 0, ',', '.') . "</strong></td>";
          // echo "</tr>";
          ?>
          <tr>
            <td colspan="3" style="text-align: right; font-weight: bold;">Total Pemasukan:</td>
            <td><strong>Rp <?php echo number_format($totalPemasukan, 0, ',', '.'); ?></strong></td>
            <td>-</td>
          </tr>

          <tr>
            <td colspan="3" style="text-align: right; font-weight: bold;">Total Pengeluaran:</td>
            <td>-</td>
            <td><strong>Rp <?php echo number_format($totalPengeluaran, 0, ',', '.'); ?></strong></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="card shadow" id="semuaKategori">
  <div class="card-body">
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
      <h5 class="m-0 font-weight-bold">Tanggal :</h5>
      <div class="d-sm-flex">
        <button type="submit" class="btn btn-sm btn-success ml-auto mr-1" onclick="exportToExcel()"><i class="fas fa-print fa-fw"></i>Excel</button>
        <button type="submit" class="btn btn-sm btn-warning ml-auto mr-1" onclick="printPDF()"><i class="fas fa-print fa-fw"></i>PDF</button>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-sm table-bordered text-gray-700" id="tabel-semua">
        <thead>
          <tr>
            <th>No</th>
            <th>Tanggal</th>
            <!-- <th>Kategori</th> -->
            <th>Keterangan</th>
            <th>Pemasukan</th>
            <th>Pengeluaran</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="card shadow" id="kategoriPemasukan">
  <div class="card-body">
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
      <h5 class="m-0 font-weight-bold">Tanggal :</h5>
      <div class="d-sm-flex">
        <button type="submit" class="btn btn-sm btn-success ml-auto mr-1" onclick="exportToExcel()"><i class="fas fa-print fa-fw"></i>Excel</button>
        <button type="submit" class="btn btn-sm btn-warning ml-auto mr-1" onclick="printPDF()"><i class="fas fa-print fa-fw"></i>PDF</button>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-sm table-bordered text-gray-700" id="tabel-pemasukan">
        <thead>
          <tr>
            <th>No</th>
            <th>Tanggal</th>
            <!-- <th>Kategori</th> -->
            <th>Keterangan</th>
            <th>Pemasukan</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="card shadow" id="kategoriPengeluaran">
  <div class="card-body">
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
      <h5 class="m-0 font-weight-bold">Tanggal :</h5>
      <div class="d-sm-flex">
        <button type="submit" class="btn btn-sm btn-success ml-auto mr-1" onclick="exportToExcel()"><i class="fas fa-print fa-fw"></i>Excel</button>
        <button type="submit" class="btn btn-sm btn-warning ml-auto mr-1" onclick="printPDF()"><i class="fas fa-print fa-fw"></i>PDF</button>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-sm table-bordered text-gray-700" id="tabel-pengeluaran">
        <thead>
          <tr>
            <th>No</th>
            <th>Tanggal</th>
            <!-- <th>Kategori</th> -->
            <th>Keterangan</th>
            <th>Pengeluaran</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    // Menyembunyikan semua tabel saat halaman dimuat
    $("#semuaDefault, #semuaKategori, #kategoriPemasukan, #kategoriPengeluaran").hide();

    $("#semuaDefault").show();

    // Ketika tombol ditekan
    $("#tampil").click(function(e) {
      e.preventDefault();

      // Mengambil nilai kategori yang dipilih
      var selectedOption = $("#jenis").val();

      // Mengambil nilai tanggal awal dan akhir
      var tgl_awal = formatDate($("#tgl_awal").val());
      var tgl_akhir = formatDate($("#tgl_akhir").val());

      var tglAwal = $("#tgl_awal").val();
      var tglAkhir = $("#tgl_akhir").val();

      // Memeriksa apakah inputan tanggal kosong
      if (tglAwal.trim() === '' || tglAkhir.trim() === '') {
        alert("Silakan masukkan tanggal awal dan akhir");
        return;
      }

      // Menampilkan tabel yang sesuai dengan kategori yang dipilih
      if (selectedOption === "-- Semua Kategori --") {
        $("#semuaKategori").show();
        $("#semuaDefault, #kategoriPemasukan, #kategoriPengeluaran").hide();

        // Ambil data untuk semua kategori dari tabel tagihan dan pengeluaran
        $.ajax({
          url: "../config/prosesGet-admin.php?get=laporan",
          method: "POST",
          data: {
            tgl_awal: tglAwal,
            tgl_akhir: tglAkhir
          },
          success: function(response) {
            // Tampilkan data ke dalam tabel semua kategori
            $("#semuaKategori tbody").html(response);
          }
        });
      } else if (selectedOption === "Pemasukan") {
        $("#semuaDefault, #semuaKategori").hide();
        $("#kategoriPemasukan").show();
        $("#kategoriPengeluaran").hide();

        // Ambil data pemasukan dari tabel tagihan
        $.ajax({
          url: "../config/prosesGet-admin.php?get=laporan-pemasukan",
          method: "POST",
          data: {
            tgl_awal: tglAwal,
            tgl_akhir: tglAkhir
          },
          success: function(response) {
            // Tampilkan data ke dalam tabel kategori pemasukan
            $("#kategoriPemasukan tbody").html(response);
          }
        });
      } else if (selectedOption === "Pengeluaran") {
        $("#semuaDefault, #semuaKategori").hide();
        $("#kategoriPemasukan").hide();
        $("#kategoriPengeluaran").show();

        // Ambil data pengeluaran dari tabel pengeluaran
        $.ajax({
          url: "../config/prosesGet-admin.php?get=laporan-pengeluaran",
          method: "POST",
          data: {
            tgl_awal: tglAwal,
            tgl_akhir: tglAkhir
          },
          success: function(response) {
            // Tampilkan data ke dalam tabel kategori pengeluaran
            $("#kategoriPengeluaran tbody").html(response);
          }
        });
      }

      var tanggalText = "Tanggal: " + tgl_awal + " s/d " + tgl_akhir;
      $(".card-body h5").text(tanggalText);
    });

    // Submit form
    $("#formTampil").submit(function(e) {
      e.preventDefault();
      $("#tampil").click();
    });
  });

  function formatDate(dateString) {
    var date = new Date(dateString);
    var day = date.getDate();
    var month = date.getMonth() + 1;
    var year = date.getFullYear();

    // Menggabungkan day, month, dan year dengan tanda strip (-) di antara mereka
    var formattedDate = ('0' + day).slice(-2) + '-' + ('0' + month).slice(-2) + '-' + year;

    return formattedDate;
  }

  // Fungsi print Excel
  function exportToExcel() {
    var selectedOption = $("#jenis").val();
    var table;

    // Cek kategori laporan yang dipilih
    if (selectedOption === "-- Semua Kategori --") {
      table = document.getElementById("tabel-semua");
    } else if (selectedOption === "Pemasukan") {
      table = document.getElementById("tabel-pemasukan");
    } else if (selectedOption === "Pengeluaran") {
      table = document.getElementById("tabel-pengeluaran")
    }

    var data = [];

    // Judul laporan
    data.push(["Laporan " + selectedOption]);

    // Range tanggal
    var tglAwal = $("#tgl_awal").val();
    var tglAkhir = $("#tgl_akhir").val();
    data.push(["Tanggal:", tglAwal, "s/d", tglAkhir]);

    // Nama kolom
    var headers = [];
    for (var h = 0; h < table.rows[0].cells.length; h++) {
      headers.push(table.rows[0].cells[h].innerText);
    }
    data.push(headers);

    // Loopi setiap baris dalam tabel kecuali header
    for (var i = 1; i < table.rows.length; i++) {
      var rowData = [];
      var row = table.rows[i];
      // Loopi setiap sel dalam baris
      for (var j = 0; j < row.cells.length; j++) {
        rowData.push(row.cells[j].innerText);
      }
      // Tambahkan data baris ke dalam data yang akan diekspor
      data.push(rowData);
    }

    // Buat workbook baru
    var wb = XLSX.utils.book_new();

    // Buat worksheet baru
    var ws = XLSX.utils.aoa_to_sheet(data);

    // Tambahkan worksheet ke dalam workbook
    XLSX.utils.book_append_sheet(wb, ws, "Data " + selectedOption);

    // Menyesuaikan lebar kolom
    var colWidths = [];
    for (var col = 0; col < data[2].length; col++) {
      var maxLength = 0;
      for (var row = 2; row < data.length; row++) {
        var cellLength = data[row][col] ? data[row][col].toString().length : 10;
        if (cellLength > maxLength) {
          maxLength = cellLength;
        }
      }
      var colWidth = maxLength;
      colWidths.push({
        wch: colWidth
      });
    }
    ws['!cols'] = colWidths;

    // Ekspor data ke dalam file Excel
    var fileName = "Laporan " + selectedOption + " (" + tglAwal + " sd " + tglAkhir + ").xlsx";
    XLSX.writeFile(wb, fileName);
  }

  // Fungsi print PDF
  function printPDF() {
    var selectedOption = $("#jenis").val();
    var table;

    // Cek kategori laporan yang dipilih
    if (selectedOption === "-- Semua Kategori --") {
      table = document.getElementById("tabel-semua");
    } else if (selectedOption === "Pemasukan") {
      table = document.getElementById("tabel-pemasukan");
    } else if (selectedOption === "Pengeluaran") {
      table = document.getElementById("tabel-pengeluaran");
    }

    // Judul laporan
    var judulLaporan = "Laporan " + selectedOption;

    // Range tanggal
    var tglAwal = formatDate($("#tgl_awal").val());
    var tglAkhir = formatDate($("#tgl_akhir").val());
    var rangeTanggal = "Tanggal: " + tglAwal + " s/d " + tglAkhir;

    // Membuat tabel data untuk cetak
    var dataToPrint = "<table>" + table.innerHTML + "</table>";

    // Membuat halaman untuk dicetak
    var content = "<h2>" + judulLaporan + "</h2>";
    content += "<p>" + rangeTanggal + "</p>";
    content += dataToPrint;

    // Membuka modal print browser
    var printWindow = window.open("", );
    printWindow.document.open();
    printWindow.document.write("<html><head><title>Cetak Laporan</title></head><body>" + content + "</body></html>");
    printWindow.document.close();

    // Menunggu halaman selesai dimuat sebelum mencetak
    printWindow.onload = function() {
      printWindow.print();
      // printWindow.close();
    };
  }

  // Fungsi format tanggal
  function formatDate(dateString) {
    var date = new Date(dateString);
    var day = date.getDate();
    var month = date.getMonth() + 1;
    var year = date.getFullYear();

    // Menggabungkan day, month, dan year dengan tanda strip (-) di antara mereka
    var formattedDate = ('0' + day).slice(-2) + '-' + ('0' + month).slice(-2) + '-' + year;

    return formattedDate;
  }
</script>