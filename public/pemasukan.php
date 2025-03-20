<?php
session_start();
include "../app/control.php";

if (!isset($_SESSION["login"]) || !isset($_SESSION["user"])) {
  header("location: /findash/");
  exit();
}

$row = select("SELECT * FROM t_pemasukan_{$_SESSION["user"]}");
$check = mysqli_query(
  $koneksi,
  "SELECT * FROM t_pemasukan_{$_SESSION["user"]}"
);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Keuangan</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="/findash/public/css/style.css">
    
         <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
</head>
<body>
    <!-- Mobile Nav Toggle -->
    <button class="nav-toggle" id="navToggle">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Overlay -->
    <div class="overlay" id="overlay"></div>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="logo-container">
            <i class="fas fa-chart-line logo-icon"></i>
            <span class="logo-text">FinDash</span>
        </div>

        <div class="menu-section">
            <div class="menu-header">MENU UTAMA</div>
            <a href="/findash/dashboard" class="menu-item">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
            <a href="/findash/pemasukan" class="menu-item active">
                <i class="fas fa-wallet"></i>
                <span>Pemasukan</span>
            </a>
            <a href="/findash/pengeluaran" class="menu-item">
                <i class="fas fa-credit-card"></i>
                <span>Pengeluaran</span>
            </a>
        </div>

        <div class="menu-section">
            <div class="menu-header">LAPORAN</div>
            <div class="menu-item">
                <i class="fas fa-chart-bar"></i>
                <span>Statistik</span>
            </div>
            <div class="menu-item">
                <i class="fas fa-file-alt"></i>
                <span>Laporan Bulanan</span>
            </div>
        </div>

        <div class="menu-section">
            <div class="menu-header">PENGATURAN</div>
            <div class="menu-item">
                <i class="fas fa-cog"></i>
                <span>Pengaturan</span>
            </div>
            <div class="menu-item">
                <i class="fas fa-user"></i>
                <span>Profil</span>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <div class="welcome-text">Pemasukan</div>
            <div class="date-display" id="current-date"></div>
        </div>

        <div class="cards-containers">
            <div class="cards">
                <div class="card-headers">
                    <div class="card-titles">Total Pemasukan</div>
                    <div class="card-icons">
                        <i class="fas fa-arrow-up"></i>
                    </div>
                </div>
                <div class="card-amounts" id="total-income">Rp 0</div>
            </div>
        </div>
        
        <div class="cards-container">
          <div class="card">
            <div class="search-container">
              <input type="text" class="search-input" placeholder="Search...">
            </div>
            <div class="button-container">
              <button class="btn-add trigger-button">
                <span>Tambah</span>
                <span>
                  <i class="fa-solid fa-plus"></i>
                </span>
              </button>
            </div>
            <div class="table-wrapper">
              <table>
                <tr>
                  <th>#</th>
                  <th>Nama</th>
                  <th>Harga</th>
                  <th>Tanggal</th>
                  <th>Aksi</th>
                </tr>
                <?php $no = 1; ?>
                <?php if (mysqli_num_rows($check) > 0):
                  foreach ($row as $data): ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= $data["nama_barang"] ?></td>
                  <td><?= $data["harga"] ?></td>
                  <td><?= date("d/M/Y", strtotime($data["tanggal"])) ?></td>
                  <td>
                    <div class="aksi-group">
                      <a class="edit" href="">
                        <i class="fa-solid fa-pen-to-square"></i>
                      </a>
                      <a class="delete" href="">
                        <i class="fa-solid fa-trash"></i>
                      </a>
                    </div>
                  </td>
                </tr>
                <?php endforeach;
                else:
                   ?>
                <tr>
                  <td align="center" colspan="5">No data available in table</td>
                </tr>
                <?php
                endif; ?>
              </table>
            </div>
            <div class="pagination">
              <button>Previous</button>
              <button class="active">1</button>
              <button>2</button>
              <button>3</button>
              <button>Next</button>
            </div>
          </div>
        </div>
        
        <div class="modal-overlay">
          <div class="modal">
            <div class="modal-header">
                <h2 class="modal-title">Form Tambah Data</h2>
                <button class="close-button">&times;</button>
            </div>
            <form id="addForm" method="post">
                <div class="form-group">
                    <label class="form-label" for="nama">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="harga">Harga</label>
                    <input type="number" name="harga" id="harga" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="tanggal">Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-input" required>
                </div>
                <button type="submit" name="tambah" class="submit-button">
                  <span>Simpan</span>
                  <i class="fa-solid fa-floppy-disk"></i>
                </button>
            </form>
          </div>
        </div>
        <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        
    <script>
        // Disabel Confirm Resubmition
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
        
        const triggerButton = document.querySelector('.trigger-button');
        const modalOverlay = document.querySelector('.modal-overlay');
        const modal = document.querySelector('.modal');
        const closeButton = document.querySelector('.close-button');
        const form = document.getElementById('addForm');

        // Open modal
        triggerButton.addEventListener('click', () => {
            modalOverlay.style.display = 'block';
            setTimeout(() => {
                modal.classList.add('active');
            }, 10);
        });

        // Close modal functions
        const closeModal = () => {
            modal.classList.remove('active');
            setTimeout(() => {
                modalOverlay.style.display = 'none';
            }, 300);
        };

        closeButton.addEventListener('click', closeModal);

        // Close on outside click
        modalOverlay.addEventListener('click', (e) => {
            if (e.target === modalOverlay) {
                closeModal();
            }
        });

        // Close on Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeModal();
            }
        });
        
        // Pastikan jQuery dan SweetAlert2 sudah dimuat

// Fungsi untuk update tabel
function updateTable(data) {
    const tableBody = $('table tbody');
    
    // Cek apakah ada pesan "Tidak ada data"
    const noDataRow = tableBody.find('tr td[colspan="5"]');
    if (noDataRow.length) {
        tableBody.empty();
    }
    
    // Hitung jumlah baris untuk penomoran
    const rowCount = tableBody.find('tr').length + 1;
    
    // Buat baris baru
    const newRow = `
        <tr>
            <td>${rowCount}</td>
            <td>${data.nama_barang}</td>
            <td>${data.harga}</td>
            <td>${data.tanggal}</td>
            <td>
                <div class="aksi-group">
                    <a class="edit" href="">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                    <a class="delete" href="">
                        <i class="fa-solid fa-trash"></i>
                    </a>
                </div>
            </td>
        </tr>
    `;
    
    // Tambahkan di awal tabel
    tableBody.prepend(newRow);
}
    </script>
    <script src="/findash/public/js/main.js"></script>
</body>
</html>