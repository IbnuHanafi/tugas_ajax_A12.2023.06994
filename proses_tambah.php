<?php
// Nama : Ibnu Hanafi Assalam
// NIM : A12.2023.06994
include 'db.php';

// Cek apakah form sudah disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $nim = $koneksi->real_escape_string($_POST['nim']);
    $nama = $koneksi->real_escape_string($_POST['nama']);

    // Tentukan jurusan (dari dropdown atau input baru)
    if ($_POST['jurusan'] === 'lainnya') {
        $jurusan = $koneksi->real_escape_string($_POST['jurusanLainnya']);
    } else {
        $jurusan = $koneksi->real_escape_string($_POST['jurusan']);
    }

    // Validasi data
    $errors = [];

    // Validasi NIM (5 digit)
    if (!preg_match('/^\d{5}$/', $nim)) {
        $errors[] = "NIM harus terdiri dari 5 digit angka";
    }

    // Validasi nama (minimal 3 karakter)
    if (strlen($nama) < 3) {
        $errors[] = "Nama minimal 3 karakter";
    }

    // Validasi jurusan (tidak boleh kosong)
    if (empty($jurusan)) {
        $errors[] = "Jurusan tidak boleh kosong";
    }

    // Cek apakah NIM sudah terdaftar
    $check_nim = $koneksi->query("SELECT nim FROM mahasiswa WHERE nim = '$nim'");
    if ($check_nim->num_rows > 0) {
        $errors[] = "NIM $nim sudah terdaftar. Gunakan NIM lain.";
    }

    // Jika tidak ada error, simpan ke database
    if (empty($errors)) {
        $sql = "INSERT INTO mahasiswa (nim, nama, jurusan) VALUES ('$nim', '$nama', '$jurusan')";

        if ($koneksi->query($sql) === TRUE) {
            // Redirect ke halaman index dengan pesan sukses
            header("Location: index1.php?status=success&message=Data mahasiswa berhasil ditambahkan");
            exit;
        } else {
            // Redirect dengan pesan error
            $error_message = "Error: " . $koneksi->error;
            header("Location: tambah_mahasiswa.php?status=error&message=" . urlencode($error_message));
            exit;
        }
    } else {
        // Redirect dengan pesan error
        $error_messages = implode(", ", $errors);
        header("Location: tambah_mahasiswa.php?status=error&message=" . urlencode($error_messages));
        exit;
    }
} else {
    // Jika bukan form POST, redirect ke halaman tambah
    header("Location: tambah_mahasiswa.php");
    exit;
}
