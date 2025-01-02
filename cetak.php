<?php
require_once __DIR__ . '/assets/mpdf/vendor/autoload.php';  // Pastikan sudah terinstal mPDF

// Ambil bulan dari parameter GET
$bulan = isset($_GET['bulan']) ? $_GET['bulan'] : '';

// Koneksi ke database
include 'assets/conn/koneksi.php';

// Periksa koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Query untuk ambil data berdasarkan bulan, jika bulan tidak dipilih, ambil semua data
$query = "SELECT * FROM tbl_pembukuan";
if ($bulan != '') {
    $query .= " WHERE bulan = '$bulan'";  // Filter berdasarkan bulan
}
$result = mysqli_query($koneksi, $query);

// Cek apakah data ditemukan
if (mysqli_num_rows($result) == 0) {
    echo "Tidak ada data untuk bulan: " . htmlspecialchars($bulan);
    exit;
}

// Membuat instance mPDF
$mpdf = new \Mpdf\Mpdf();

// Membuat HTML untuk tabel
$html = '<h1>Data Pembukuan</h1>';
if ($bulan != '') {
    $html .= '<h3>Bulan: ' . htmlspecialchars($bulan) . '</h3>';
} else {
    $html .= '<h3>Semua Data Pembukuan</h3>';
}
$html .= '<table border="1" cellpadding="10">
            <tr>
                <th>No</th>
                <th>Periode</th>
                <th>Bulan</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>SOH</th>
                <th>Fisik</th>
            </tr>';

$no = 1;
while ($row = mysqli_fetch_assoc($result)) {
    $html .= '<tr>
                <td>' . $no++ . '</td>
                <td>' . htmlspecialchars($row['periode']) . '</td>
                <td>' . htmlspecialchars($row['bulan']) . '</td>
                <td>' . htmlspecialchars($row['kode_barang']) . '</td>
                <td>' . htmlspecialchars($row['nama_barang']) . '</td>
                <td>' . htmlspecialchars($row['soh']) . '</td>
                <td>' . htmlspecialchars($row['fisik']) . '</td>
              </tr>';
}

$html .= '</table>';

// Tulis HTML ke mPDF
$mpdf->WriteHTML($html);
$nama_file = "Rekap_Pembukuan_" . date('d-m-Y_H-i-s') . ".pdf";
// Output PDF ke browser
$mpdf->Output($nama_file, \Mpdf\Output\Destination::INLINE);
?>