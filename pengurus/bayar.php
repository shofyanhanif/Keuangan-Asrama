<!-- Conten Pembayaran Tagihan Langsung Pengurus -->
<div class="card shadow mb-3">
  <div class="card-header">
    <h4 class="m-0 font-weight-bold">Pembayaran</h4>
  </div>
  <div class="card-body">
    <form role="form" id="formCari" class="flex-grow-1">
      <div class="row">
        <div class="col-12 col-md-3">
          <div class="form-group">
            <input type="text" name="id_santri" id="id_santri" class="form-control form-control-sm" placeholder="Masukkan ID Santri" autocomplete="off" oninput="validasiAngka(this)">
          </div>
        </div>
        <div class="col-12 col-md-3">
          <button type="submit" class="btn btn-sm btn-primary" id="btnCari"><i class="fas fa-fw fa-search"></i></button>
          <a href="" type="reset" class="btn btn-sm btn-secondary"><i class="fas fa-fw  fa-sync-alt"></i></a>
        </div>
      </div>
    </form>
  </div>
</div>
<div class="card shadow" id="cardData">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-sm table-bordered text-gray-700" id="pembayaran" style="width: 100%;">
        <thead>
          <tr>
            <th>No</th>
            <th>ID_Santri</th>
            <th>Nama</th>
            <th>Tahun</th>
            <th>Bulan</th>
            <th>Kategori</th>
            <th>Nominal</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
        <tfoot>
          <tr>
            <th colspan="6">TOTAL</th>
            <th id="total"></th>
          </tr>
        </tfoot>
      </table>
    </div>
    <div class="d-sm-flex justify-content-between">
      <div class="ml-auto">
        <button type="button" class="btn btn-danger mt-1" id="btnModal" data-toggle="modal" data-target="#modalBayar">
          Bayar
        </button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalBayar" tabindex="-1" aria-labelledby="modalBayarLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="modalBayarLabel">Pembayaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="../config/proses-pengurus.php?action=tb_bayar" role="form" method="POST">
        <div class="modal-body" style="font-size: 12px; padding: 5px">
          <div class="table-responsive">
            <table class="table table-bordered">
              <tr hidden>
                <th>ID Petugas</th>
                <td>
                  <input type="hidden" name="id_petugas" value="<?php echo $idPetugas ?>">
                  <?php echo $idPetugas ?>
                </td>
              </tr>
              <tr>
                <th>Tanggal</th>
                <td><?php echo date('d-m-Y') ?></td>
              </tr>
              <tr>
                <th>ID Santri</th>
                <td>
                  <input type="hidden" name="id_santri" id="modalIdSantriField">
                  <span id="modalIdSantri"></span>
                </td>
              </tr>
              <tr>
                <th>Nama</th>
                <td>
                  <input type="hidden" name="nama_santri" id="modalNamaField">
                  <span id="modalNama"></span>
                </td>
              </tr>
              <tr>
                <th>Tagihan</th>
                <td>
                  <input type="hidden" name="tagihan" id="modalTagihanField">
                  <span id="modalTagihan"></span>
                </td>
              </tr>
              <tr>
                <th>Bulan</th>
                <td>
                  <input type="hidden" name="bulan" id="modalBulanField">
                  <span id="modalBulan"></span>
                </td>
              </tr>
              <tr>
                <th>Jumlah</th>
                <td>
                  <input type="hidden" name="jumlah" id="modalJumlahField">
                  <span id="modalJumlah"></span>
                </td>
              </tr>
            </table>
          </div>
          <div class="modal-footer">
            <input type="submit" class="submit btn btn-danger btn-sm" value="Bayar">
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    // Fungsi untuk menyembunyikan tombol btnModal
    function hideBtnModal() {
      $('#btnModal').hide();
    }

    // Fungsi untuk menampilkan tombol btnModal
    function showBtnModal() {
      $('#btnModal').show();
    }

    hideBtnModal();

    // Fungsi untuk mengubah angka menjadi format mata uang IDR/Rp
    function formatCurrency(amount) {
      var formatter = new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0,
        maximumFractionDigits: 0,
      });
      return formatter.format(amount);
    }

    // Submit form cari
    $('#formCari').on('submit', function(e) {
      e.preventDefault();

      var idSantri = $('#id_santri').val();

      if (idSantri.trim() !== '') {
        $.ajax({
          url: '../config/prosesGet-pengurus.php?get=pembayaran',
          type: 'POST',
          data: {
            id_santri: idSantri
          },
          success: function(response) {
            if (response.trim() !== '') {
              // Berhasil mendapatkan data tagihan
              $('#pembayaran tbody').html(response);

              var total = 0;
              $('#pembayaran tbody tr').each(function() {
                var nominal = $(this).find('td:last').text().replace(/\D/g, ''); // Remove non-numeric characters
                if (nominal !== '') {
                  total += parseInt(nominal);
                }
              });

              // Tampilkan total
              $('#total').text(formatCurrency(total));
              // $('#pembayaran').DataTable({
              //   searching: false
              // });

              showBtnModal();

            } else {
              // Tampilkan peringatan jika tidak ada data tagihan
              $('#pembayaran tbody').empty();
              $('#total').text('');
              hideBtnModal();
              alert('Tidak ada data tagihan pada ID Santri tersebut.');
            }
          },
          error: function() {
            // Tampilkan peringatan jika terjadi kesalahan pada request ajax
            $('#pembayaran tbody').empty();
            $('#total').text('');
            hideBtnModal();
            alert('Terjadi kesalahan pada server. Mohon coba lagi.');
          }
        });
      } else {
        // Tampilkan peringatan jika ID Santri kosong
        $('#pembayaran tbody').empty();
        $('#total').text('');
        hideBtnModal();
        alert('Masukkan ID Santri terlebih dahulu.');
      }

      calculateTotal;
    });

    function validasiAngka(input) {
      input.value = input.value.replace(/\D/g, '');
    }
  });
</script>