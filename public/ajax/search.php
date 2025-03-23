<?php
session_start();
include "../../app/control.php";

if (!isset($_GET["keyword"])) {
  exit();
} else {
  $keyword = $_GET["keyword"];
    
    if (isset($_SESSION["pemasukan"])){
      $sql = "SELECT * FROM t_pemasukan_{$_SESSION["user"]} WHERE nama_barang LIKE '%$keyword%'";
      $tampilkan = select($sql);
    } else {
      $sql = "SELECT * FROM t_pengeluaran_{$_SESSION["user"]} WHERE nama_barang LIKE '%$keyword%'";
      $tampilkan = select($sql);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
  
  <table>
    <tr>
        <th>#</th>
        <th>Nama</th>
        <th>Harga</th>
        <th>Tanggal</th>
        <th>Aksi</th>
    </tr>
    <?php if (!empty($tampilkan)) : ?>
        <?php $i = 1; ?>
        <?php foreach ($tampilkan as $data) : ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= htmlspecialchars($data["nama_barang"]) ?></td>
                <td>Rp <?= number_format($data["harga"], 0, ",", ".") ?></td>
                <td><?= date("d/m/Y", strtotime($data["tanggal"])) ?></td>
                <td class="text-center">
                    <button class="btn edit"><i class="fa-solid fa-pen-to-square"></i></button>
                    <button class="btn delete"><i class="fa-solid fa-trash"></i></button>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php else : ?>
        <tr>
            <td colspan="5" class="text-center">Tidak ada data ditemukan</td>
        </tr>
        <?php endif; ?>
</table>
</body>
</html>

