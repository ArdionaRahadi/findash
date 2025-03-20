<?php
include "koneksi.php";

function select($data)
{
  global $koneksi;
  $row = mysqli_query($koneksi, $data);
  $result = [];

  while ($results = mysqli_fetch_assoc($row)) {
    $result[] = $results;
  }

  return $result;
}

//Handle Tambah
if (isset($_POST["save-data"])) {
  $namaBarang = $_POST["nama-barang"];
  $harga = $_POST["harga"];
  $tanggal = $_POST["tanggal"];

  $sql = "INSERT INTO t_pengeluaran_{$_SESSION["user"]} VALUES (
      NULL,
      '$namaBarang',
      $harga,
      '$tanggal'
    );";
  mysqli_query($koneksi, $sql);
}
