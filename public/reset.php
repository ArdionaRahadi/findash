<?php
session_start();
include "../app/koneksi.php";
error_reporting(0);
$result = mysqli_query($koneksi, "SELECT * FROM users");
$row = mysqli_fetch_assoc($result);
$stringHash = hash_hmac("gost-crypto", $row["username"], "key_rahasia");

$allowed_keys = ["id", $stringHash];
$invalidkey = array_diff($_GET, $allowed_keys);

if (!empty($invalidkey)) {
  header("location: /findash/404");
} elseif (empty($_GET)) {
  header("location: ");
}

if (isset($_POST["forgot-password"])) {
  $email = $_POST["enter-email"];

  $check = mysqli_query(
    $koneksi,
    "SELECT * FROM users WHERE username = '$username' OR email = '$email'"
  );

  if (mysqli_num_rows($check) > 0) {
    echo "email sudah terdaftar";
  } else {
    $invalidEmail = true;
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
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    
  </head>
  <body>
    <div class="container">
      <div class="content">
        <!-- Form Login Start -->
        <form class="form-login" method="post">
          <div class="form-content-login">
            <h1>Reset Password</h1>
            
            <?php if (isset($invalidEmail)): ?>
            <div class="form-group" id="alert-danger">
              <div class="close-alert">
                <i class="bx bx-x" onclick="closeAlert()"></i>
              </div>
              <div class="alert alert-danger">
                  Incorrect Email Address
              </div>
            </div>
            <?php endif; ?>
    
            <div class="form-group">
              <label for="login-username">
                <i class="bx bxs-envelope"></i>
              </label>
              <input
                type="email"
                name="enter-email"
                id="enter-email"
                placeholder="Enter your email"
                required
              />
            </div>
          
            <button style="margin-top: 0;" type="submit" name="forgot-password" class="btn-login">Submit</button>
          </div>
        </form>
        <!-- Form Login End -->
      </div>
    </div>
    <script src="/findash/public/js/auth.js"></script>
  </body>
</html>