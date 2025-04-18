<?php
// Nama : Ibnu Hanafi Assalam
// NIM : A12.2023.06994
require 'vendor/autoload.php';
require 'db.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Ambil keyword dari URL
$keyword = isset($_GET['keyword']) ? $koneksi->real_escape_string($_GET['keyword']) : '';

if (!empty($keyword)) {
    $sql = "SELECT nim, nama, jurusan FROM mahasiswa
            WHERE nim LIKE '%$keyword%' OR nama LIKE '%$keyword%' OR jurusan LIKE '%$keyword%'";
} else {
    $sql = "SELECT nim, nama, jurusan FROM mahasiswa ORDER BY nim ASC";
}

$result = $koneksi->query($sql);

// Set opsi untuk DOMPDF
$options = new Options();
$options->set('defaultFont', 'Helvetica');
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true);

// Buat instance Dompdf
$dompdf = new Dompdf($options);

// Bangun HTML untuk PDF
$html = '
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Data Mahasiswa</title>
    <style>
        body {
            font-family: "Helvetica", sans-serif;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        h1 {
            color: #4e73df;
            margin-bottom: 5px;
        }
        .subtitle {
            font-size: 14px;
            color: #555;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border: 2px solid #000; /* Buat border utama tabel lebih tebal */
        }
        th {
            background-color: #4e73df;
            color: white;
            font-weight: bold;
            text-align: left;
            padding: 10px;
            border: 1px solid #000; /* Border hitam solid untuk header */
        }
        td {
            padding: 8px 10px;
            border: 1px solid #000; /* Border hitam solid untuk semua cell */
        }
        tr:nth-child(even) {
            background-color: #f8f9fc;
        }
        .footer {
            margin-top: 30px;
            font-size: 12px;
            text-align: center;
            color: #666;
        }
        .no-data {
            text-align: center;
            padding: 20px;
            color: #666;
            border: 1px solid #000; /* Border untuk pesan tidak ada data */
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>DATA MAHASISWA</h1>
        <div class="subtitle">' . (!empty($keyword) ? 'Hasil Pencarian: ' . htmlspecialchars($keyword) : 'Semua Data Mahasiswa') . '</div>
    </div>';

// Tambahkan tabel data
$html .= '
    <table>
        <thead>
            <tr>
                <th width="20%">NIM</th>
                <th width="40%">Nama</th>
                <th width="40%">Jurusan</th>
            </tr>
        </thead>
        <tbody>';

// Check if there are any results
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $html .= '
            <tr>
                <td>' . htmlspecialchars($row['nim']) . '</td>
                <td>' . htmlspecialchars($row['nama']) . '</td>
                <td>' . htmlspecialchars($row['jurusan']) . '</td>
            </tr>';
    }
} else {
    $html .= '
            <tr>
                <td colspan="3" class="no-data">Tidak ada data yang ditemukan</td>
            </tr>';
}

$html .= '
        </tbody>
    </table>
    
    <div class="footer">
        Dicetak pada: ' . date('d-m-Y H:i:s') . '
    </div>
</body>
</html>';

// Load HTML ke Dompdf
$dompdf->loadHtml($html);

// Set ukuran dan orientasi kertas
$dompdf->setPaper('A4', 'portrait');

// Render PDF
$dompdf->render();

// Set nama file
$filename = "data_mahasiswa_" . date('Y-m-d_H-i-s') . ".pdf";

// Kirim output ke browser
$dompdf->stream($filename, ["Attachment" => true]);
exit;
