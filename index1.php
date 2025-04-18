<!-- Nama : Ibnu Hanafi Assalam -->
<!-- NIM  : A12.2023.06994 -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Mahasiswa</title>
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

        .btn-success {
            background-color: var(--success-color);
            border-color: var(--success-color);
        }

        .btn-success:hover {
            background-color: #17a673;
            border-color: #169b6b;
        }

        .btn-danger {
            background-color: var(--danger-color);
            border-color: var(--danger-color);
        }

        .btn-danger:hover {
            background-color: #d54c3d;
            border-color: #cf4a38;
        }

        .btn-info {
            background-color: #36b9cc;
            border-color: #36b9cc;
            color: white;
        }

        .btn-info:hover {
            background-color: #2ea7b9;
            border-color: #2a96a5;
            color: white;
        }

        .btn-warning {
            background-color: #f6c23e;
            border-color: #f6c23e;
            color: white;
        }

        .btn-warning:hover {
            background-color: #e9b530;
            border-color: #e9b530;
            color: white;
        }

        .table {
            border-radius: 5px;
            overflow: hidden;
        }

        .table thead th {
            background-color: var(--primary-color);
            color: white;
            font-weight: 600;
            border: none;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(78, 115, 223, 0.05);
        }

        #loading {
            display: none;
            font-weight: bold;
            color: var(--primary-color);
        }

        .result-count {
            color: var(--secondary-color);
            font-size: 0.9rem;
            margin-bottom: 10px;
        }

        .search-wrapper {
            position: relative;
        }

        .search-icon {
            position: absolute;
            left: 15px;
            top: 10px;
            color: var(--secondary-color);
        }

        #search {
            padding-left: 40px;
            border-radius: 50px;
        }

        .export-buttons {
            text-align: right;
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

        .spinner-border {
            width: 1.5rem;
            height: 1.5rem;
            vertical-align: middle;
        }

        .no-results {
            text-align: center;
            padding: 30px;
            color: var(--secondary-color);
        }

        /* Pagination styles */
        .pagination {
            justify-content: center;
            margin-top: 20px;
        }

        .pagination .page-item.active .page-link {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
            /* This line adds white text color */
        }

        .pagination .page-link {
            color: var(--primary-color);
        }

        .pagination .page-link:hover {
            background-color: #eaecf4;
        }

        /* Action buttons */
        .btn-action {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
        }

        /* Alert styles */
        .alert {
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .alert-success {
            background-color: rgba(28, 200, 138, 0.2);
            border-color: rgba(28, 200, 138, 0.3);
            color: #19a97c;
        }

        .alert-danger {
            background-color: rgba(231, 74, 59, 0.2);
            border-color: rgba(231, 74, 59, 0.3);
            color: #d52d1a;
        }

        /* Modal styles */
        .modal-header.bg-warning {
            background: linear-gradient(to right, #f6c23e, #e9b530);
            color: white;
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
        <!-- Alert messages -->
        <?php if (isset($_GET['status']) && isset($_GET['message'])): ?>
            <div class="alert alert-<?php echo $_GET['status'] == 'success' ? 'success' : 'danger'; ?> alert-dismissible fade show" role="alert">
                <i class="fas <?php echo $_GET['status'] == 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'; ?> me-2"></i>
                <?php echo htmlspecialchars($_GET['message']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-search me-2"></i>Live Search Mahasiswa</h5>
            </div>
            <div class="card-body">
                <div class="row mb-4 align-items-center">
                    <div class="col-md-5">
                        <div class="search-wrapper">
                            <i class="fas fa-search search-icon"></i>
                            <input type="text" id="search" class="form-control" placeholder="Cari nama/NIM...">
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary me-2" id="tambahDataBtn">
                                <i class="fas fa-plus me-1"></i> Tambah Data
                            </button>
                            <button class="btn btn-info me-2" id="tampilkanDataBtn">
                                <i class="fas fa-eye me-1"></i> Tampilkan Data
                            </button>
                            <button class="btn btn-success me-2" id="exportExcelBtn" disabled>
                                <i class="fas fa-file-excel me-1"></i> Export Excel
                            </button>
                            <button class="btn btn-danger" id="exportPdfBtn" disabled>
                                <i class="fas fa-file-pdf me-1"></i> Export PDF
                            </button>
                        </div>
                    </div>
                </div>
                <div id="loading" class="text-center mb-3">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <span class="ms-2">Mencari data...</span>
                </div>

                <div class="result-count mb-2" id="resultCount"></div>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="15%">NIM</th>
                                <th width="40%">Nama</th>
                                <th width="30%">Jurusan</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="result">
                            <!-- Data akan ditampilkan di sini -->
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div id="pagination-container" class="d-none">
                    <ul id="pagination" class="pagination">
                        <!-- Pagination links akan dibuat dengan JavaScript -->
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div class="modal fade" id="konfirmasiHapusModal" tabindex="-1" aria-labelledby="konfirmasiHapusModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="konfirmasiHapusModalLabel">Konfirmasi Hapus Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Anda yakin ingin menghapus data mahasiswa dengan NIM: <strong id="nimToDelete"></strong>?</p>
                    <p class="text-danger mb-0"><i class="fas fa-exclamation-triangle me-2"></i>Tindakan ini tidak dapat dibatalkan!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a href="#" id="hapusDataBtn" class="btn btn-danger">Hapus Data</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Mahasiswa -->
    <div class="modal fade" id="editMahasiswaModal" tabindex="-1" aria-labelledby="editMahasiswaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="editMahasiswaModalLabel">Edit Data Mahasiswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editMahasiswaForm" action="edit_mahasiswa.php" method="post">
                        <div class="mb-3">
                            <label for="edit_nim" class="form-label">NIM</label>
                            <input type="text" class="form-control" id="edit_nim" name="nim" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="edit_nama" class="form-label">Nama Mahasiswa</label>
                            <input type="text" class="form-control" id="edit_nama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_jurusan" class="form-label">Jurusan</label>
                            <select class="form-select" id="edit_jurusan" name="jurusan" required>
                                <option value="">Pilih Jurusan</option>
                                <option value="Teknik Informatika">Teknik Informatika</option>
                                <option value="Sistem Informasi">Sistem Informasi</option>
                                <option value="Desain Komunikasi Visual">Desain Komunikasi Visual</option>
                                <option value="Ilmu Komunikasi">Ilmu Komunikasi</option>
                                <option value="Manajemen">Manajemen</option>
                                <option value="Akuntansi">Akuntansi</option>
                                <option value="Teknik Elektro">Teknik Elektro</option>
                                <option value="Teknik Industri">Teknik Industri</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" id="simpanEditBtn" class="btn btn-warning text-white">Simpan Perubahan</button>
                </div>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const searchBox = document.getElementById("search");
        const result = document.getElementById("result");
        const loading = document.getElementById("loading");
        const resultCount = document.getElementById("resultCount");
        const exportExcelBtn = document.getElementById("exportExcelBtn");
        const exportPdfBtn = document.getElementById("exportPdfBtn");
        const paginationContainer = document.getElementById("pagination-container");
        const pagination = document.getElementById("pagination");
        const hapusDataBtn = document.getElementById("hapusDataBtn");
        const nimToDelete = document.getElementById("nimToDelete");

        // Modal konfirmasi hapus
        const konfirmasiHapusModal = new bootstrap.Modal(document.getElementById('konfirmasiHapusModal'));

        // Modal edit mahasiswa
        const editMahasiswaModal = new bootstrap.Modal(document.getElementById('editMahasiswaModal'));
        const editMahasiswaForm = document.getElementById('editMahasiswaForm');
        const simpanEditBtn = document.getElementById('simpanEditBtn');

        // Dinonaktifkan sampai ada hasil pencarian
        exportExcelBtn.disabled = true;
        exportPdfBtn.disabled = true;

        // Variabel untuk pagination
        let currentPage = 1;
        let totalPages = 1;
        let itemsPerPage = 16;
        let allData = [];

        // Fungsi untuk menampilkan konfirmasi hapus
        function showDeleteConfirmation(nim, nama) {
            nimToDelete.textContent = nim;
            hapusDataBtn.href = `hapus_mahasiswa.php?nim=${nim}`;
            konfirmasiHapusModal.show();
        }

        // Fungsi untuk menampilkan modal edit
        function showEditForm(nim, nama, jurusan) {
            document.getElementById('edit_nim').value = nim;
            document.getElementById('edit_nama').value = nama;
            document.getElementById('edit_jurusan').value = jurusan;
            editMahasiswaModal.show();
        }

        // Event listener untuk tombol simpan perubahan
        simpanEditBtn.addEventListener('click', function() {
            // Validasi form sebelum submit
            if (editMahasiswaForm.checkValidity()) {
                editMahasiswaForm.submit();
            } else {
                // Trigger form validation
                editMahasiswaForm.reportValidity();
            }
        });

        searchBox.addEventListener("keyup", function() {
            const keyword = searchBox.value.trim();

            if (keyword.length === 0) {
                result.innerHTML = "";
                resultCount.innerHTML = "";
                exportExcelBtn.disabled = true;
                exportPdfBtn.disabled = true;
                paginationContainer.classList.add("d-none");
                return;
            }

            loading.style.display = "block";

            // Menggunakan setTimeout untuk memberi efek visual loading (min 300ms)
            setTimeout(() => {
                fetch("search.php?keyword=" + encodeURIComponent(keyword))
                    .then(res => res.json())
                    .then(data => {
                        loading.style.display = "none";
                        result.innerHTML = "";
                        allData = data;

                        if (data.length === 0) {
                            result.innerHTML = `
                        <tr>
                            <td colspan="4" class="no-results">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                Data tidak ditemukan
                            </td>
                        </tr>`;
                            resultCount.innerHTML = "";
                            exportExcelBtn.disabled = true;
                            exportPdfBtn.disabled = true;
                            paginationContainer.classList.add("d-none");
                        } else {
                            // Aktifkan tombol export jika ada data
                            exportExcelBtn.disabled = false;
                            exportPdfBtn.disabled = false;

                            // Tampilkan jumlah hasil
                            resultCount.innerHTML = `<i class="fas fa-info-circle me-1"></i> Ditemukan ${data.length} hasil pencarian`;

                            // Reset pagination
                            currentPage = 1;
                            totalPages = Math.ceil(data.length / itemsPerPage);

                            // Tampilkan data halaman pertama
                            displayDataForPage(currentPage);

                            // Jika ada lebih dari satu halaman, tampilkan pagination
                            if (totalPages > 1) {
                                updatePagination();
                                paginationContainer.classList.remove("d-none");
                            } else {
                                paginationContainer.classList.add("d-none");
                            }
                        }
                    })
                    .catch(error => {
                        loading.style.display = "none";
                        result.innerHTML = `
                    <tr>
                        <td colspan="4" class="text-center text-danger">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Terjadi kesalahan saat memuat data
                        </td>
                    </tr>`;
                        console.error("Error:", error);
                    });
            }, 300);
        });

        // Fungsi untuk menampilkan data berdasarkan halaman
        function displayDataForPage(page) {
            result.innerHTML = "";
            const startIndex = (page - 1) * itemsPerPage;
            const endIndex = Math.min(startIndex + itemsPerPage, allData.length);

            for (let i = startIndex; i < endIndex; i++) {
                const row = allData[i];
                const tr = document.createElement('tr');
                tr.className = 'fade-in';
                tr.innerHTML = `
                    <td>${row.nim}</td>
                    <td>${row.nama}</td>
                    <td>${row.jurusan}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <button class="btn btn-warning btn-sm btn-action me-1" onclick="showEditForm('${row.nim}', '${row.nama.replace(/'/g, "\\'")}', '${row.jurusan.replace(/'/g, "\\'")}')" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-danger btn-sm btn-action" onclick="showDeleteConfirmation('${row.nim}', '${row.nama.replace(/'/g, "\\'")}')" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                `;
                result.appendChild(tr);
            }
        }

        // Fungsi untuk update pagination
        function updatePagination() {
            pagination.innerHTML = '';

            // Previous button
            const prevLi = document.createElement('li');
            prevLi.className = `page-item ${currentPage === 1 ? 'disabled' : ''}`;
            prevLi.innerHTML = `<a class="page-link" href="#" data-page="${currentPage - 1}">Previous</a>`;
            pagination.appendChild(prevLi);

            // Page numbers
            const startPage = Math.max(1, currentPage - 2);
            const endPage = Math.min(totalPages, currentPage + 2);

            for (let i = startPage; i <= endPage; i++) {
                const pageLi = document.createElement('li');
                pageLi.className = `page-item ${i === currentPage ? 'active' : ''}`;
                pageLi.innerHTML = `<a class="page-link" href="#" data-page="${i}">${i}</a>`;
                pagination.appendChild(pageLi);
            }

            // Next button
            const nextLi = document.createElement('li');
            nextLi.className = `page-item ${currentPage === totalPages ? 'disabled' : ''}`;
            nextLi.innerHTML = `<a class="page-link" href="#" data-page="${currentPage + 1}">Next</a>`;
            pagination.appendChild(nextLi);

            // Add event listeners to pagination links
            const pageLinks = pagination.querySelectorAll('.page-link');
            pageLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const page = parseInt(this.getAttribute('data-page'));
                    if (page >= 1 && page <= totalPages && page !== currentPage) {
                        currentPage = page;
                        displayDataForPage(currentPage);
                        updatePagination();
                    }
                });
            });
        }

        // Event listener untuk tombol export Excel
        exportExcelBtn.addEventListener("click", function() {
            const keyword = searchBox.value.trim();
            if (keyword.length > 0) {
                window.open("export_excel.php?keyword=" + encodeURIComponent(keyword), "_blank");
            }
        });

        // Event listener untuk tombol export PDF
        exportPdfBtn.addEventListener("click", function() {
            const keyword = searchBox.value.trim();
            if (keyword.length > 0) {
                window.open("export_pdf.php?keyword=" + encodeURIComponent(keyword), "_blank");
            }
        });

        // Event listener untuk tombol tambah data mahasiswa
        document.getElementById("tambahDataBtn").addEventListener("click", function() {
            window.location.href = "tambah_mahasiswa.php";
        });

        // Event listener untuk tombol tampilkan daftar data
        document.getElementById("tampilkanDataBtn").addEventListener("click", function() {
            loading.style.display = "block";
            result.innerHTML = "";

            // Reset search box
            searchBox.value = "";

            // Fetch all data
            fetch("get_all_data.php")
                .then(res => res.json())
                .then(data => {
                    loading.style.display = "none";
                    allData = data;

                    if (data.length === 0) {
                        result.innerHTML = `
                        <tr>
                            <td colspan="4" class="no-results">
                                <i class="fas fa-database me-2"></i>
                                Belum ada data mahasiswa
                            </td>
                        </tr>`;
                        resultCount.innerHTML = "";
                        exportExcelBtn.disabled = true;
                        exportPdfBtn.disabled = true;
                        paginationContainer.classList.add("d-none");
                    } else {
                        // Aktifkan tombol export
                        exportExcelBtn.disabled = false;
                        exportPdfBtn.disabled = false;

                        // Tampilkan jumlah data
                        resultCount.innerHTML = `<i class="fas fa-info-circle me-1"></i> Menampilkan semua data mahasiswa (${data.length} data)`;

                        // Reset pagination
                        currentPage = 1;
                        totalPages = Math.ceil(data.length / itemsPerPage);

                        // Tampilkan data halaman pertama
                        displayDataForPage(currentPage);

                        // Jika ada lebih dari satu halaman, tampilkan pagination
                        if (totalPages > 1) {
                            updatePagination();
                            paginationContainer.classList.remove("d-none");
                        } else {
                            paginationContainer.classList.add("d-none");
                        }
                    }
                })
                .catch(error => {
                    loading.style.display = "none";
                    result.innerHTML = `
                    <tr>
                        <td colspan="4" class="text-center text-danger">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Terjadi kesalahan saat memuat data
                        </td>
                    </tr>`;
                    console.error("Error:", error);
                });
        });

        // Automatically close alerts after 5 seconds
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }, 5000);
        });

        // Make functions global
        window.showDeleteConfirmation = showDeleteConfirmation;
        window.showEditForm = showEditForm;
    </script>

</body>

</html>