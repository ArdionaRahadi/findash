<?php
session_start();
include "../app/koneksi.php";

if(!isset($_SESSION["login"]) || !isset($_SESSION["user"])){
  header("location: /findash/");
  exit();
}

?>



<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Keuangan</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
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
            <a href="/findash/dashboard" class="menu-item active">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
            <a href="/findash/pemasukan" class="menu-item">
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
            <div class="welcome-text">Selamat Datang, <?= $_SESSION[
              "user"
            ] ?></div>
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

            <div class="cards">
                <div class="card-headers">
                    <div class="card-titles">Total Pengeluaran</div>
                    <div class="card-icons">
                        <i class="fas fa-arrow-down"></i>
                    </div>
                </div>
                <div class="card-amounts" id="total-expenses">Rp 0</div>
            </div>

            <div class="cards">
                <div class="card-headers">
                    <div class="card-titles">Saldo</div>
                    <div class="card-icons">
                        <i class="fas fa-wallet"></i>
                    </div>
                </div>
                <div class="card-amounts" id="balance">Rp 0</div>
            </div>
        </div>

    <script src="/findash/public/js/main.js">

    </script>
</body>
</html>