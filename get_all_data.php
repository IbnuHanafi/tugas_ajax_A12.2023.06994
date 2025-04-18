<?php
// Nama : Ibnu Hanafi Assalam
// NIM : A12.2023.06994
header('Content-Type: application/json');
include 'db.php';

$sql = "SELECT nim, nama, jurusan FROM mahasiswa ORDER BY nim ASC";
$result = $koneksi->query($sql);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
