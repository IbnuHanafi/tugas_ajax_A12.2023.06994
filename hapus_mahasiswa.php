<?php
// Nama : Ibnu Hanafi Assalam
// NIM : A12.2023.06994
include 'db.php';

// Cek apakah parameter nim tersedia
if (isset($_GET['nim'])) {
    $nim = $koneksi->real_escape_string($_GET['nim']);

    // Hapus data mahasiswa berdasarkan NIM
    $sql = "DELETE FROM mahasiswa WHERE nim = '$nim'";

    if ($koneksi->query($sql) === TRUE) {
        // Redirect dengan pesan sukses
        header("Location: index1.php?status=success&message=Data mahasiswa berhasil dihapus");
        exit;
    } else {
        // Redirect dengan pesan error
        $error_message = "Error: " . $koneksi->error;
        header("Location: index1.php?status=error&message=" . urlencode($error_message));
        exit;
    }
} else {
    // Redirect jika tidak ada parameter nim
    header("Location: index1.php?status=error&message=NIM tidak ditemukan");
    exit;
}
