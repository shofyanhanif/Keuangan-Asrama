<?php
// Ambil data dari form (Anda harus menyesuaikannya dengan pengaturan form Anda)
$selectedOption = $_POST['jenis'];
$tglAwal = $_POST['tgl_awal'];
$tglAkhir = $_POST['tgl_akhir'];

// Fungsi untuk mengambil data dari database dan mengisi tabel sesuai kategori yang dipilih
function getTableData($selectedOption, $tglAwal, $tglAkhir) {
  // Lakukan koneksi ke database dan query sesuai dengan kategori yang dipilih
  // ...
  // Ambil data dari hasil query
  // ...

  // Tampilkan data dalam bentuk tabel HTML
  $html = '<table>';
  // Tambahkan baris judul laporan
  $html .= '<tr><td colspan="4">Laporan ' . $selectedOption . '</td></tr>';
  // Tambahkan baris range tanggal
  $html .= '<tr><td colspan="4">Tanggal: ' . $tglAwal . ' s/d ' . $tglAkhir . '</td></tr>';
  // Tambahkan baris header tabel
  $html .= '<tr><th>No</th><th>Tanggal</th><th>Keterangan</th><th>Nominal</th></tr>';
  // Tambahkan baris data dari hasil query
  // ...
  // ...
  $html .= '</table>';

  return $html;
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Print Preview</title>
  <!-- Gaya CSS untuk print preview -->
  <style>
    body {
      font-family: Arial, sans-serif;
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    table, th, td {
      border: 1px solid black;
      padding: 5px;
      text-align: center;
    }
  </style>
</head>
<body>

<?php
// Panggil fungsi untuk mengisi data tabel sesuai kategori yang dipilih
$tableData = getTableData($selectedOption, $tglAwal, $tglAkhir);

// Tampilkan tabel dalam print preview
echo $tableData;
?>

<!-- Tampilkan tanggal di bawah kanan pada print preview -->
<!-- <script type="text/javascript">
  function printPage() {
    window.print();
  }
</script> -->
<div style="position: absolute; bottom: 20px; right: 20px;">
  Tanggal: <?php echo $tglAwal . ' s/d ' . $tglAkhir; ?>
</div>
<!-- Tombol untuk print -->
<button type="button" onclick="printPage()">Print</button>

</body>
</html>
