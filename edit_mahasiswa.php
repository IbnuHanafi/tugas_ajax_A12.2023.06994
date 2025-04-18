<?php
// Koneksi ke database
include('db.php');

// Validasi data yang diterima
if (isset($_POST['nim']) && isset($_POST['nama']) && isset($_POST['jurusan'])) {
    // Ambil data dari form
    $nim = $_POST['nim'];
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $jurusan = mysqli_real_escape_string($koneksi, $_POST['jurusan']);

    // Query untuk update data
    $query = "UPDATE mahasiswa SET nama='$nama', jurusan='$jurusan' WHERE nim='$nim'";

    // Eksekusi query
    if (mysqli_query($koneksi, $query)) {
        // Jika berhasil, redirect dengan pesan sukses
        header("Location: index1.php?status=success&message=Data mahasiswa dengan NIM $nim berhasil diperbarui");
    } else {
        // Jika gagal, redirect dengan pesan error
        header("Location: index1.php?status=error&message=Gagal memperbarui data: " . mysqli_error($koneksi));
    }
} else {
    // Jika data tidak lengkap, redirect dengan pesan error
    header("Location: index1.php?status=error&message=Data tidak lengkap");
}

// Tutup koneksi database
mysqli_close($koneksi);
