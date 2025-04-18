<?php
// Nama : Ibnu Hanafi Assalam
// NIM : A12.2023.06994
require 'vendor/autoload.php'; // autoload dari Composer
require 'db.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

$keyword = isset($_GET['keyword']) ? $koneksi->real_escape_string($_GET['keyword']) : '';

if (!empty($keyword)) {
    $sql = "SELECT nim, nama, jurusan FROM mahasiswa
            WHERE nim LIKE '%$keyword%' OR nama LIKE '%$keyword%' OR jurusan LIKE '%$keyword%'";
} else {
    $sql = "SELECT nim, nama, jurusan FROM mahasiswa ORDER BY nim ASC";
}

$result = $koneksi->query($sql);

// Buat spreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set judul
$sheet->setCellValue('A1', 'DATA MAHASISWA');
$sheet->mergeCells('A1:C1');

// Set subtitle
if (!empty($keyword)) {
    $sheet->setCellValue('A2', 'Hasil Pencarian: ' . $keyword);
} else {
    $sheet->setCellValue('A2', 'Semua Data Mahasiswa');
}
$sheet->mergeCells('A2:C2');

// Format header
$sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
$sheet->getStyle('A2')->getFont()->setBold(true)->setSize(12);
$sheet->getStyle('A1:A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

// Header kolom (baris 4)
$sheet->setCellValue('A4', 'NIM');
$sheet->setCellValue('B4', 'Nama');
$sheet->setCellValue('C4', 'Jurusan');

// Format header kolom
$headerStyle = [
    'font' => [
        'bold' => true,
        'color' => ['rgb' => 'FFFFFF'],
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => ['rgb' => '4E73DF'],
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER,
    ],
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN,
        ],
    ],
];

$sheet->getStyle('A4:C4')->applyFromArray($headerStyle);
$sheet->getRowDimension(4)->setRowHeight(20);

// Set data
$row = 5;
while ($data = $result->fetch_assoc()) {
    $sheet->setCellValue('A' . $row, $data['nim']);
    $sheet->setCellValue('B' . $row, $data['nama']);
    $sheet->setCellValue('C' . $row, $data['jurusan']);

    // Border untuk data
    $sheet->getStyle('A' . $row . ':C' . $row)->applyFromArray([
        'borders' => [
            'allBorders' => [
                'borderStyle' => Border::BORDER_THIN,
            ],
        ],
    ]);

    $row++;
}

// Auto-width kolom
$sheet->getColumnDimension('A')->setWidth(15);
$sheet->getColumnDimension('B')->setWidth(30);
$sheet->getColumnDimension('C')->setWidth(25);

// Set nama file
$filename = "data_mahasiswa_" . date('Y-m-d_H-i-s') . ".xlsx";

// Output ke browser
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
