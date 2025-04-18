<?php
// Nama : Ibnu Hanafi Assalam
// NIM : A12.2023.06994
$host = "localhost";
$user = "root";
$pass = "";
$db = "kampus";

$koneksi = new mysqli($host, $user, $pass, $db);

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}
