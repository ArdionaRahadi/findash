<?php
session_start();
include "../app/koneksi.php";
error_reporting(1);

if (isset($_SESSION["logim"]) || isset($_SESSION["user"])) {
  header("location: /findash/dashboard");
  exit();
}

if (isset($_POST["btn-register"])) {
  $email = strtolower($_POST["register-email"]);
  $username = strtolower($_POST["register-username"]);
  $password = password_hash($_POST["register-password"], PASSWORD_DEFAULT);
  $retypePassword = password_hash($_POST["retype-password"], PASSWORD_DEFAULT);

  if ($retypePassword != $retypePassword) {
    echo "password tidak sama";
    exit();
  }

  $check = mysqli_query(
    $koneksi,
    "SELECT * FROM users WHERE username = '$username' OR email = '$email'"
  );

  if (mysqli_num_rows($check) > 0) {
    echo "<script>
            setTimeout(function(){
              Swal.fire({
                title: 'ERROR',
                text: 'Email has already use',
                icon: 'error',
                allowOutsideClick: false
              })
            },100)
          </script>";
  } else {
    $createTablePengeluaran = mysqli_query(
      $koneksi,
      "CREATE TABLE t_pengeluaran_{$username} (id INT PRIMARY KEY AUTO_INCREMENT, nama_barang VARCHAR(250), harga VARCHAR(250), tanggal DATE)"
    );

    $createTablePemasukan = mysqli_query(
      $koneksi,
      "CREATE TABLE t_pemasukan_{$username} (id INT PRIMARY KEY AUTO_INCREMENT, nama_barang VARCHAR(250), harga VARCHAR(250), tanggal DATE)"
    ); 

    $insert = mysqli_query(
      $koneksi,
      "INSERT INTO users VALUES(NULL, '$email', '$username', '$password');"
    );
  }
}

if (isset($_POST["btn-login"])) {
  $username = $_POST["login-username"];
  $email = $_POST["login-username"];
  $password = $_POST["login-password"];

  $check = mysqli_query(
    $koneksi,
    "SELECT * FROM users WHERE username = '$username' OR email = '$email'"
  );

  $row = mysqli_fetch_assoc($check);

  if (mysqli_num_rows($check) > 0) {
    if (password_verify($password, $row["password"])) {
      $_SESSION["login"] = $row["email"];
      $_SESSION["user"] = $row["username"];
      header("location: /findash/dashboard");
    } else {
      $incorrectEmailOrUsername = true;
    }
  } else {
    $incorrectEmailOrUsername = true;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Page</title>

    <!-- css -->
    <link rel="stylesheet" href="/findash/public/css/style.css" />

    <!-- boxicon -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
</head>

<body>
    <div class="container">
        <div class="content">
            <!-- Form Login Start -->
            <form class="form-login" method="post">
                <div class="form-content-login">
                    <h1>Login</h1>
                    <?php if (isset($incorrectEmailOrUsername)): ?>
                    <div class="form-group" id="alert-danger">
                        <div class="close-alert">
                            <i class="bx bx-x" onclick="closeAlert()"></i>
                        </div>
                        <div class="alert alert-danger">
                            Incorrect Email Address <br>
                            or Username
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="login-username">
                            <i class="bx bxs-user"></i>
                        </label>
                        <input type="text" name="login-username" id="username" placeholder="Username" required />
                    </div>
                    <div class="form-group">
                        <label for="login-password">
                            <i class="bx bxs-lock-alt"></i>
                        </label>
                        <input type="password" name="login-password" id="password" placeholder="Password" required />
                    </div>
                    <?php
            $result = mysqli_query($koneksi, "SELECT * FROM users");
            $row = mysqli_fetch_assoc($result);
            $stringHash = hash_hmac(
              "gost-crypto",
              $row["username"],
              "key_rahasia"
            );
            ?>
                    <p><a href="/findash/public/reset.php?id=<?= $stringHash ?>">Forgot Password?</a></p>
                    <button type="submit" name="btn-login" class="btn-login">Login</button>
                    <p>or login with socials platform</p>
                    <div class="login-third-party">
                        <a href="#">
                            <button type="button" class="google">
                                <i class="bx bxl-google"></i>
                            </button>
                        </a>
                        <a href="#">
                            <button type="button" class="facebook">
                                <i class="bx bxl-facebook"></i>
                            </button>
                        </a>
                        <a href="#">
                            <button type="button" class="github">
                                <i class="bx bxl-github"></i>
                            </button>
                        </a>
                        <a href="#">
                            <button type="button" class="linkedin">
                                <i class="bx bxl-linkedin"></i>
                            </button>
                        </a>
                    </div>
                </div>
            </form>
            <!-- Form Login End -->

            <!-- Form Register Start -->
            <form class="form-register" method="post">
                <div class="form-content-register">
                    <h1>Register</h1>
                    <div class="form-group">
                        <label for="email">
                            <i class="bx bxs-envelope"></i>
                        </label>
                        <input type="text" name="register-email" id="email" placeholder="Email" required />
                    </div>
                    <div class="form-group">
                        <label for="username">
                            <i class="bx bxs-user"></i>
                        </label>
                        <input type="text" name="register-username" id="username" placeholder="Username" required />
                    </div>
                    <div class="form-group">
                        <label for="password">
                            <i class="bx bxs-lock-alt"></i>
                        </label>
                        <input type="password" name="register-password" id="password" placeholder="Password" required />
                    </div>
                    <div class="form-group">
                        <label for="retype-password">
                            <i class="bx bxs-lock-alt"></i>
                        </label>
                        <input type="password" name="retype-password" id="retype-password" placeholder="Retype Password"
                            required />
                    </div>
                    <button type="submit" name="btn-register" class="btn-register">Register</button>
                    <p>or register with socials platform</p>
                    <div class="register-third-party">
                        <a href="#">
                            <button type="button" class="google">
                                <i class="bx bxl-google"></i>
                            </button>
                        </a>
                        <a href="#">
                            <button type="button" class="facebook">
                                <i class="bx bxl-facebook"></i>
                            </button>
                        </a>
                        <a href="#">
                            <button type="button" class="github">
                                <i class="bx bxl-github"></i>
                            </button>
                        </a>
                        <a href="#">
                            <button type="button" class="linkedin">
                                <i class="bx bxl-linkedin"></i>
                            </button>
                        </a>
                    </div>
                </div>
            </form>
            <!-- Form Register End -->

            <div class="form-side">
                <div class="register-content">
                    <h1>Hello, Welcome!</h1>
                    <p>Don't have an account?</p>
                    <button type="submit" class="register">Register</button>
                </div>

                <div class="login-content">
                    <h1>Welcome Back</h1>
                    <p>Already have an account?</p>
                    <button type="submit" class="login">Login</button>
                </div>
            </div>
        </div>
    </div>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/findash/public/js/auth.js"></script>
</body>

</html>