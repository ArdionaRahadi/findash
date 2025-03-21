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
// Tambah Pengeluaran
if (isset($_POST["save-data-pengeluaran"]) AND $_SERVER['REQUEST_METHOD'] === 'POST') {
  $namaBarang = htmlspecialchars($_POST["nama_barang"]);
  $harga = $_POST["harga"];
  $tanggal = $_POST["tanggal"];

  if (empty($namaBarang) || empty($harga) || empty($tanggal)) {
    echo "<script>
                  setTimeout(function(){
                      Swal.fire({
                          title: 'ERROR',
                          text: 'Form Tidak Boleh Kosong',
                          icon: 'error',
                          allowOutsideClick: false
                      }).then(function(){
                          window.location.href = '/findash/pengeluaran';
                      })
                  },100)
                </script>";
  } elseif (!ctype_digit($harga)) {
    echo "<script>
                  setTimeout(function(){
                      Swal.fire({
                          title: 'ERROR',
                          text: 'Harga Harus Berupa Angka',
                          icon: 'error',
                          allowOutsideClick: false
                      }).then(function(){
                          window.location.href = '/findash/pengeluaran';
                      })
                  },100)
                </script>";
  } else {
    $sql = "INSERT INTO t_pengeluaran_{$_SESSION["user"]} VALUES (
      NULL,
      '$namaBarang',
      $harga,
      '$tanggal'
    );";

    

    if (mysqli_query($koneksi, $sql)) {
      echo "<script>
                  setTimeout(function(){
                      Swal.fire({
                          title: 'Berhasil',
                          text: 'Data Berhasil Ditambahkan',
                          icon: 'success',
                          allowOutsideClick: false
                      }).then(function(){
                          window.location.href = '/findash/pengeluaran';
                      })
                  },100)
                </script>";
    } else {
      echo "<script>
                  setTimeout(function(){
                      Swal.fire({
                          title: 'ERROR',
                          text: 'Data Gagal Ditambahkan',
                          icon: 'error',
                          allowOutsideClick: false
                      }).then(function(){
                          window.location.href = '/findash/pengeluaran';
                  },100)
                </script>";
    }
  }
}
// Tambah Pemasukan
if(isset($_POST["save-data-pemasukan"])){
  $namaBarang = htmlspecialchars($_POST["nama_barang"]);
  $harga = $_POST["harga"];
  $tanggal = $_POST["tanggal"];

  if (empty($namaBarang) || empty($harga) || empty($tanggal)) {
    echo "<script>
                  setTimeout(function(){
                      Swal.fire({
                          title: 'ERROR',
                          text: 'Form Tidak Boleh Kosong',
                          icon: 'error',
                          allowOutsideClick: false
                      }).then(function(){
                          window.location.href = '/findash/pemasukan';
                      })
                  },100)
                </script>";
  } elseif (!ctype_digit($harga)) {
    echo "<script>
                  setTimeout(function(){
                      Swal.fire({
                          title: 'ERROR',
                          text: 'Harga Harus Berupa Angka',
                          icon: 'error',
                          allowOutsideClick: false
                      }).then(function(){
                          window.location.href = '/findash/pemasukan';
                      })
                  },100)
                </script>";
  } else {
    $sql = "INSERT INTO t_pemasukan_{$_SESSION["user"]} VALUES (
      NULL,
      '$namaBarang',
      $harga,
      '$tanggal',
      NULL
    );";

    if (mysqli_query($koneksi, $sql)) {
      echo "<script>
                  setTimeout(function(){
                      Swal.fire({
                          title: 'Berhasil',
                          text: 'Data Berhasil Ditambahkan',
                          icon: 'success',
                          allowOutsideClick: false
                      }).then(function(){
                          window.location.href = '/findash/pemasukan';
                      })
                  },100)
                </script>";
    } else {
      echo "<script>
                  setTimeout(function(){
                      Swal.fire({
                          title: 'ERROR',
                          text: 'Data Gagal Ditambahkan',
                          icon: 'error',
                          allowOutsideClick: false
                      }).then(function(){
                          window.location.href = '/findash/pemasukan';
                      })
                  },100)
                </script>";
    }
  }
}

// Handle Edit
// Edit Pengeluaran
if (isset($_POST["edit-data-pengeluaran"])) {
  $id = $_POST["id_barang"];
  $namaBarang = htmlspecialchars($_POST["nama_barang"]);
  $harga = $_POST["harga"];
  $tanggal = $_POST["tanggal"];

  if (empty($namaBarang) || empty($harga) || empty($tanggal)) {
    echo "<script>
                  setTimeout(function(){
                      Swal.fire({
                          title: 'ERROR',
                          text: 'Form Tidak Boleh Kosong',
                          icon: 'error',
                          allowOutsideClick: false
                      }).then(function(){
                          window.location.href = '/findash/pengeluaran';
                      })
                  },100)
                </script>";
  } elseif (!ctype_digit($harga)) {
    echo "<script>
                  setTimeout(function(){
                      Swal.fire({
                          title: 'ERROR',
                          text: 'Harga Harus Berupa Angka',
                          icon: 'error',
                          allowOutsideClick: false
                      }).then(function(){
                          window.location.href = '/findash/pengeluaran';
                      })
                  },100)
                </script>";
  } else {
    $sql = "UPDATE t_pengeluaran_{$_SESSION["user"]} SET
      nama_barang = '$namaBarang',
      harga = $harga,
      tanggal = '$tanggal'
      WHERE id = $id;
    ";

    if (mysqli_query($koneksi, $sql)) {
      echo "<script>
                  setTimeout(function(){
                      Swal.fire({
                          title: 'Berhasil',
                          text: 'Data Berhasil Diubah',
                          icon: 'success',
                          allowOutsideClick: false
                      }).then(function(){
                          window.location.href = '/findash/pengeluaran';
                      })
                  },100)
                </script>";
    } else {
      echo "<script>
                  setTimeout(function(){
                      Swal.fire({
                          title: 'ERROR',
                          text: 'Data Gagal Diubah',
                          icon: 'error',
                          allowOutsideClick: false
                      }).then(function(){
                          window.location.href = '/findash/pengeluaran';
                  },100)
                </script>";
    }
  }
}
// Edit Pemasukan
if(isset($_POST["edit-data-pemasukan"])){
  $id = $_POST["id_barang"];
  $namaBarang = htmlspecialchars($_POST["nama_barang"]);
  $harga = $_POST["harga"];
  $tanggal = $_POST["tanggal"];

  if (empty($namaBarang) || empty($harga) || empty($tanggal)) {
    echo "<script>
                  setTimeout(function(){
                      Swal.fire({
                          title: 'ERROR',
                          text: 'Form Tidak Boleh Kosong',
                          icon: 'error',
                          allowOutsideClick: false
                      }).then(function(){
                          window.location.href = '/findash/pemasukan';
                      })
                  },100)
                </script>";
  } elseif (!ctype_digit($harga)) {
    echo "<script>
                  setTimeout(function(){
                      Swal.fire({
                          title: 'ERROR',
                          text: 'Harga Harus Berupa Angka',
                          icon: 'error',
                          allowOutsideClick: false
                      }).then(function(){
                          window.location.href = '/findash/pemasukan';
                      })
                  },100)
                </script>";
  } else {
    $sql = "UPDATE t_pemasukan_{$_SESSION["user"]} SET
      nama_barang = '$namaBarang',
      harga = $harga,
      tanggal = '$tanggal'
      WHERE id = $id;
    ";

    if (mysqli_query($koneksi, $sql)) {
      echo "<script>
                  setTimeout(function(){
                      Swal.fire({
                          title: 'Berhasil',
                          text: 'Data Berhasil Diubah',
                          icon: 'success',
                          allowOutsideClick: false
                      }).then(function(){
                          window.location.href = '/findash/pemasukan';
                      })
                  },100)
                </script>";
    } else {
      echo "<script>
                  setTimeout(function(){
                      Swal.fire({
                          title: 'ERROR',
                          text: 'Data Gagal Diubah',
                          icon: 'error',
                          allowOutsideClick: false
                      }).then(function(){
                          window.location.href = '/findash/pemasukan';
                  },100)
                </script>";
    }
  }
}


// Hendle Delete
// Hapus Pengeluaran
if (isset($_POST["delete-data-pengeluaran"])) {
  $id = $_POST["id_barang"];

  $sql = "DELETE FROM t_pengeluaran_{$_SESSION["user"]} WHERE id = $id;";
  if (mysqli_query($koneksi, $sql)) {
    echo "<script>
                  setTimeout(function(){
                      Swal.fire({
                          title: 'Berhasil',
                          text: 'Data Berhasil Dihapus',
                          icon: 'success',
                          allowOutsideClick: false
                      }).then(function(){
                          window.location.href = '/findash/pengeluaran';
                      })
                  },100)
                </script>";
  } else {
    echo "<script>
                  setTimeout(function(){
                      Swal.fire({
                          title: 'ERROR',
                          text: 'Data Gagal Dihapus',
                          icon: 'error',
                          allowOutsideClick: false
                      }).then(function(){
                          window.location.href = '/findash/pengeluaran';
                  },100)
                </script>";
  }
}
// Hapus Pemasukan
if(isset($_POST["delete-data-pemasukan"])) {
  $id = $_POST["id_barang"];

  $sql = "DELETE FROM t_pemasukan_{$_SESSION["user"]} WHERE id = $id;";
  if (mysqli_query($koneksi, $sql)) {
    echo "<script>
                  setTimeout(function(){
                      Swal.fire({
                          title: 'Berhasil',
                          text: 'Data Berhasil Dihapus',
                          icon: 'success',
                          allowOutsideClick: false
                      }).then(function(){
                          window.location.href = '/findash/pemasukan';
                      })
                  },100)
                </script>";
  } else {
    echo "<script>
                  setTimeout(function(){
                      Swal.fire({
                          title: 'ERROR',
                          text: 'Data Gagal Dihapus',
                          icon: 'error',
                          allowOutsideClick: false
                      }).then(function(){
                          window.location.href = '/findash/pemasukan';
                  },100)
                </script>";
  }
}