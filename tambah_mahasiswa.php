<?php
// Nama : Ibnu Hanafi Assalam
// NIM : A12.2023.06994
include 'db.php';

// Ambil daftar jurusan untuk dropdown
$sql_jurusan = "SELECT DISTINCT jurusan FROM mahasiswa ORDER BY jurusan";
$result_jurusan = $koneksi->query($sql_jurusan);

$jurusan_list = [];
while ($row = $result_jurusan->fetch_assoc()) {
    $jurusan_list[] = $row['jurusan'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Mahasiswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #858796;
            --success-color: #1cc88a;
            --danger-color: #e74a3b;
        }

        body {
            background-color: #f8f9fc;
            font-family: 'Nunito', sans-serif;
        }

        .navbar {
            background: linear-gradient(135deg, var(--primary-color), #224abe);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: 700;
            color: white !important;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            margin-bottom: 30px;
        }

        .card-header {
            background: linear-gradient(to right, var(--primary-color), #224abe);
            color: white;
            font-weight: 700;
            padding: 1rem;
            border-top-left-radius: 10px !important;
            border-top-right-radius: 10px !important;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: #2e59d9;
            border-color: #2653d4;
        }

        .btn-secondary {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }

        .btn-secondary:hover {
            background-color: #717585;
            border-color: #6c757d;
        }

        .form-label {
            font-weight: 600;
            color: var(--secondary-color);
        }

        .input-group-text {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        /* Animations */
        .fade-in {
            animation: fadeIn 0.5s;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-control {
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
        }

        .form-select {
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
        }

        .back-btn {
            text-decoration: none;
            color: var(--secondary-color);
            display: inline-flex;
            align-items: center;
            transition: color 0.3s;
        }

        .back-btn:hover {
            color: var(--primary-color);
        }

        .validation-error {
            color: var(--danger-color);
            font-size: 0.85rem;
            margin-top: 0.25rem;
        }

        .shake {
            animation: shake 0.5s;
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            10%,
            30%,
            50%,
            70%,
            90% {
                transform: translateX(-5px);
            }

            20%,
            40%,
            60%,
            80% {
                transform: translateX(5px);
            }
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-university me-2"></i>
                Sistem Informasi Mahasiswa
            </a>
        </div>
    </nav>

    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <a href="index1.php" class="back-btn">
                    <i class="fas fa-arrow-left me-2"></i> Kembali ke Pencarian
                </a>
            </div>
        </div>

        <div class="card fade-in">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-user-plus me-2"></i>Tambah Data Mahasiswa</h5>
            </div>
            <div class="card-body">
                <form id="formTambahMahasiswa" action="proses_tambah.php" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nim" class="form-label">NIM</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                    <input type="text" class="form-control" id="nim" name="nim" placeholder="Masukkan NIM" required>
                                </div>
                                <div id="nimError" class="validation-error"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama" class="form-label">Nama Lengkap</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Lengkap" required>
                                </div>
                                <div id="namaError" class="validation-error"></div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="jurusan" class="form-label">Jurusan</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
                            <select class="form-select" id="jurusan" name="jurusan" required>
                                <option value="" selected disabled>Pilih Jurusan</option>
                                <?php foreach ($jurusan_list as $jurusan): ?>
                                    <option value="<?= htmlspecialchars($jurusan) ?>"><?= htmlspecialchars($jurusan) ?></option>
                                <?php endforeach; ?>
                                <option value="lainnya">Jurusan Lainnya</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group" id="jurusanLainnyaGroup" style="display:none;">
                        <label for="jurusanLainnya" class="form-label">Jurusan Lainnya</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-edit"></i></span>
                            <input type="text" class="form-control" id="jurusanLainnya" name="jurusanLainnya" placeholder="Masukkan Jurusan Baru">
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="button" class="btn btn-secondary me-2" onclick="window.location.href='index1.php'">
                            <i class="fas fa-times me-1"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer section to be added before the closing body tag -->
    <footer class="mt-5 py-4">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-university me-3 text-primary" style="font-size: 2rem;"></i>
                        <h5 class="mb-0 fw-bold">Sistem Informasi Mahasiswa</h5>
                    </div>
                    <p class="text-muted long-description">
                        Sistem pengelolaan data mahasiswa yang memudahkan pencarian, penambahan, dan ekspor data mahasiswa secara efisien.
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <hr>
    <footer class="mt-5 py-4">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-md-6">
                    <p class="mb-0 text-muted d-inline-block">&copy; 2025 Sistem Informasi Mahasiswa. Hak Cipta Dilindungi.</p>
                    <p class="mb-0 text-muted d-inline-block">Dimiliki Oleh: <span class="fw-bold">Ibnu Hanafi Assalam - A12.2023.06994</span></p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="#" class="text-decoration-none me-3 text-primary"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-decoration-none me-3 text-primary"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-decoration-none me-3 text-primary"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-decoration-none me-3 text-primary"><i class="fab fa-linkedin-in"></i></a>
                    <a href="https://github.com/IbnuHanafi" class="text-decoration-none text-primary"><i class="fab fa-github"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const jurusanSelect = document.getElementById('jurusan');
            const jurusanLainnyaGroup = document.getElementById('jurusanLainnyaGroup');
            const jurusanLainnyaInput = document.getElementById('jurusanLainnya');
            const formTambahMahasiswa = document.getElementById('formTambahMahasiswa');
            const nimInput = document.getElementById('nim');
            const namaInput = document.getElementById('nama');
            const nimError = document.getElementById('nimError');
            const namaError = document.getElementById('namaError');

            // Toggle jurusan lainnya input
            jurusanSelect.addEventListener('change', function() {
                if (this.value === 'lainnya') {
                    jurusanLainnyaGroup.style.display = 'block';
                    jurusanLainnyaInput.setAttribute('required', true);
                } else {
                    jurusanLainnyaGroup.style.display = 'none';
                    jurusanLainnyaInput.removeAttribute('required');
                }
            });

            // Form validation
            formTambahMahasiswa.addEventListener('submit', function(e) {
                let isValid = true;

                // Reset errors
                nimError.textContent = '';
                namaError.textContent = '';
                nimInput.classList.remove('is-invalid', 'shake');
                namaInput.classList.remove('is-invalid', 'shake');

                // Validate max NIM
                if (!/^\d{5}$/.test(nimInput.value.trim())) {
                    nimError.textContent = 'NIM harus terdiri dari 5 digit angka';
                    nimInput.classList.add('is-invalid', 'shake');
                    isValid = false;
                }

                // Validate Nama
                if (namaInput.value.trim().length < 3) {
                    namaError.textContent = 'Nama minimal 3 karakter';
                    namaInput.classList.add('is-invalid', 'shake');
                    isValid = false;
                }

                // Validate Jurusan
                if (jurusanSelect.value === 'lainnya' && jurusanLainnyaInput.value.trim() === '') {
                    jurusanLainnyaInput.classList.add('is-invalid', 'shake');
                    isValid = false;
                }

                if (!isValid) {
                    e.preventDefault();
                }
            });

            // Fix for any remaining links to index1.php
            const backToSearchLinks = document.querySelectorAll('a[href="index1.php"]');
            backToSearchLinks.forEach(link => {
                link.href = "index1.php";
            });

            // Fix for any remaining buttons with index1.php
            const cancelBtns = document.querySelectorAll('button[onclick*="index1.php"]');
            cancelBtns.forEach(btn => {
                btn.onclick = function() {
                    window.location.href = 'index1.php';
                    return false;
                };
            });
        });
    </script>

</body>

</html>