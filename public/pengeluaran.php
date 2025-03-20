<?php
session_start();
include "../app/control.php";

if (!isset($_SESSION["login"]) || !isset($_SESSION["user"])) {
  header("location: /findash/");
  exit();
}

$checkDataKosong = mysqli_query(
  $koneksi,
  "SELECT * FROM `t_pengeluaran_{$_SESSION["user"]}`"
);

$tampilkan = select("SELECT * FROM `t_pengeluaran_{$_SESSION["user"]}`");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Keuangan</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
    
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  
      <link rel="stylesheet" href="/findash/public/css/style.css">
    
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
            <a href="/findash/pemasukan" class="menu-item">
                <i class="fas fa-wallet"></i>
                <span>Pemasukan</span>
            </a>
            <a href="/findash/pengeluaran" class="menu-item active">
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
            <div class="welcome-text">Pengeluaran</div>
            <div class="date-display" id="current-date"></div>
        </div>

        <div class="cards-containers">
            <div class="cards">
                <div class="card-headers">
                    <div class="card-titles">Total Pengeluaran</div>
                    <div class="card-icons">
                        <i class="fas fa-arrow-down"></i>
                    </div>
                </div>
                <div class="card-amounts" id="total-expenses">Rp 0</div>
            </div>
        </div>
        
        <div class="cards-containers">
          <div class="cards">
            <div class="search-container">
              <input type="text" class="search-input" placeholder="Search...">
            </div>
            <div class="button-container">
              <button type="button" class="btn btn-add" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                <span>Tambah</span>
                <span><i class="fa fa-plus"></i></span>
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
                <?php if (mysqli_num_rows($checkDataKosong) > 0):
                  foreach ($tampilkan as $data):
                    $i = 1; ?>
                
                <tr>
                  <td><?= $i++ ?></td>
                  <td><?= $data["nama_barang"] ?></td>
                  <td><?= $data["harga"] ?></td>
                  <td><?= $data["tanggal"] ?></td>
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
                <?php
                  endforeach;
                else:
                   ?>
                <tr>
                  <td colspan="5" class="text-center">Tidak ada data yang tersedia di tabel ini</td>
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

<!-- Modal Tambah -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Data</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form method="post" autocomplete="off">
              <div class="form-floating mb-3">
                <input name="nama-barang" type="text" class="form-control" id="nama-barang" placeholder="nama barang">
                <label for="nama-barang">Nama Barang</label>
              </div>
              <div class="form-floating mb-3">
                <input name="harga" type="text" class="form-control" id="harga" placeholder="harga">
                <label for="harga">Harga</label>
              </div>
              <div class="form-floating mb-3">
                <input name="tanggal" type="date" class="form-control" id="tanggal" placeholder="tanggal keluar" value="<?= date(
                  "Y-m-d"
                ) ?>">
                <label for="tanggal">Tanggal Keluar</label>
              </div>
              <button type="submit" name="save-data" class="btn btn-success w-100">
                <span>Save</span>
                <span><i class="fa fa-save"></i></span>
              </button>
            </form>
          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>
        

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  
    
<script src="/findash/public/js/main.js"></script>
</body>
</html>