<!-- Content Pembayaran -->
<div class="card shadow">
  <div class="card-header">
    <h3 class="m-0 font-weight-bold">Pembayaran</h3>
  </div>
  <div class="card-body">
    <form action="" role="form" method="POST">
      <div class="row">
        <div class="col-3">
          <div class="form-group">
            <input type="text" name="id_santri" id="id_santri" class="form-control" placeholder="Masukkan ID Santri" oninput="validasiAngka(this)">
          </div>
        </div>
        <div class="col-3">
          <button type="submit" class="btn btn-primary" id="btnCari"><i class="fas fa-search"></i></button>
        </div>
      </div>
    </form>
  </div>
</div>

<div class="page-content">
  <div class="card card-primary mb-2">
    <div class="card-body">
      <div class="form-group">
        <label for="nama" class="mb-2">Nama</label>
        <input type="text" name="nama" id="nama" class="form-control mb-3" readonly>
      </div>
      <div class="table-responsive m-auto mx-1 mb-2">
        <table class="table table-striped" id="pembayaran" style="width: 100%;">
          <thead>
            <tr>
              <th>NO</th>
              <th>ID Santri</th>
              <th>Tahun</th>
              <th>Bulan</th>
              <th>Kategori</th>
              <th>Nominal</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
          <tfoot>
            <th colspan="5">TOTAL</th>
            <th id="total"></th>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Pembayaran</h3>
    </div>
    <form action="../config/proses.php?action=tb_bayar" role="form" method="POST">
      <div class="card-body">
        <div class="row">
          <div class="col-6">
            <div class="form-group">
              <label for="tgl" class="mb-2">Tanggal</label>
              <input type="text" name="tgl" id="tgl" class="form-control mb-3" value="<?php echo date('d-m-Y') ?>" readonly>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <div class="form-group">
              <label for="id_santri" class="mb-2">ID Santri<span class="text-danger">*</span></label>
              <input type="text" name="id_santri" id="id_santri" class="form-control mb-3" oninput="validasiAngka(this)">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <div class="form-group">
              <label for="tahun" class="mb-2">Tahun<span class="text-danger">*</span></label>
              <input type="text" name="tahun" id="tahun" class="form-control mb-3" oninput="validasiAngka(this)" required>
            </div>
          </div>
          <div class="col-6">
            <div class="form-group">
              <label for="bulan" class="mb-2">Bulan<span class="text-danger">*</span></label>
              <input type="text" name="bulan" id="bulan" class="form-control mb-3" placeholder="Tulis seperti pada tabel diatas" oninput="validasiAngka(this)" required>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-3">
            <h4><strong>Jumlah Tagihan<span class="text-danger">*</span></strong></h4>
          </div>
          <div class="col-9">
            <input type="text" name="nominal" id="nominal" class="form-control mb-3" oninput="validasiAngka(this)" required>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <input type="submit" class="submit btn btn-danger" value="BAYAR">
      </div>
    </form>
  </div>
  <div class="card mt-2"></div>
</div>


<script>
  // Panggil Datatable
  $(document).ready(function() {
    $('#pembayaran').DataTable({
      "bFilter": false,
    });

    $('#formCari').on('submit', function(e) {
      e.preventDefault(); // Mencegah reload halaman

      var idSantri = $('#id_santri').val();

      $.ajax({
        url: '../config/prosesGet-admin.php?get=tagihan', // Ganti dengan URL yang sesuai untuk mengambil data tagihan
        method: 'POST',
        data: {
          id_santri: idSantri
        },
        beforeSend: function() {
          // Menampilkan pesan loading saat data sedang diambil
          $('#loading').text('Mengambil data...');
        },
        success: function(response) {
          // Mengganti isi tabel dengan data yang diterima
          $('#pembayaran tbody').html(response);

          // Menghitung total nominal
          var total = 0;
          $('#pembayaran tbody tr').each(function() {
            var nominal = parseInt($(this).find('td:eq(5)').text());
            if (!isNaN(nominal)) {
              total += nominal;
            }
          });

          // Menampilkan total nominal
          $('#total').text(total);
        },
        error: function() {
          // Menampilkan pesan error jika terjadi kesalahan
          $('#loading').text('Terjadi kesalahan. Silakan coba lagi.');
        }
      });
    });
  });

  // validasi inputan khusus angka
  function validasiAngka(input) {
    input.value = input.value.replace(/\D/g, '');
  }
</script>