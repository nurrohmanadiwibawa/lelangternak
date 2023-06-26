<?php

require 'config.php';

error_reporting(0);

session_start();

if (isset($_POST['daftar'])) {
  $nama = $_POST['nama'];
  $nik = $_POST['nik'];
  $email = $_POST['email'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $role = $_POST['role'];
  $sql = "SELECT * FROM user_" . $role . " WHERE nik='$nik'";
  $result = mysqli_query($conn, $sql);
  if (!empty($nama)){
    if (!empty($nik)){
      if (!empty($email)){
        if (!empty($username)){
          if (!empty($password)){
            if (!empty($role)){
              if (!$result->num_rows > 0) {
                $sql1 = "SELECT * FROM user_" . $role . " WHERE email='$email'";
                $result1 = mysqli_query($conn, $sql1);
                if (!$result1->num_rows > 0) {
                  $sql2 = "SELECT * FROM user_" . $role . " WHERE username='$username'";
                  $result2 = mysqli_query($conn, $sql2);
                  if (!$result2->num_rows > 0) {
                    $sql3 = "INSERT INTO user_" . $role . " (nm_lengkap, nik, email, username, password, role)
                            VALUES ('$nama', '$nik', '$email', '$username', '$password', '$role')";
                    $result3 = mysqli_query($conn, $sql3);
                    if ($result3) {
                      echo "<script>alert('Selamat, registrasi berhasil!')</script>";
                      $nama = "";
                      $nik = "";
                      $email = "";
                      $username = "";
                      $password = "";
                      $role = "";
                    } else {
                      echo "<script>alert('Woops! Terjadi kesalahan.')</script>";
                    }
                  } else {
                    echo "<script>alert('Woops! Username Sudah Terdaftar.')</script>";
                  }
                } else {
                  echo "<script>alert('Woops! Email Sudah Terdaftar.')</script>";
                }
              } else {
                echo "<script>alert('Woops! NIK Sudah Terdaftar.')</script>";
              }
            } else {
              echo "<script>alert('Profesi harus diisi. Silahkan coba lagi!')</script>";
            }
          } else {
            echo "<script>alert('Password harus diisi. Silahkan coba lagi!')</script>";
          }  
        } else {
          echo "<script>alert('Username harus diisi. Silahkan coba lagi!')</script>";
        } 
      } else {
        echo "<script>alert('Email harus diisi. Silahkan coba lagi!')</script>";
      }
    } else {
      echo "<script>alert('NIK harus diisi. Silahkan coba lagi!')</script>";
    }  
  } else {
    echo "<script>alert('Nama harus diisi. Silahkan coba lagi!')</script>";
  } 
}

if (isset($_POST['masuk'])) {
  header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!--  meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet" />
  <link href="assets/img/faviconfarm.png" rel="icon" />

  <link rel="stylesheet" href="fonts/icomoon/style.css" />

  <link rel="stylesheet" href="assets/css/owl.carousel.min.css" />

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" />

  <!-- Style -->
  <link rel="stylesheet" href="assets/css/login-register.css" />

  <title>Daftar Farm Mart</title>
</head>

<body>
  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-6 order-md-2">
          <div class="form-img">

            <img src="assets/img/farm mart.png" alt="Image" class="img-fluid" />
          </div>
        </div>
        <div class="col-md-6 contents">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="mb-4">
                <h3>Buat akun baru <strong></strong></h3>
                <p class="mb-4">Silahkan masukkan data di bawah ini </p>
              </div>
              <form action="#" method="post">
                <div class="form-group first">
                  <label for="namalengkap">Nama Lengkap</label>
                  <input type="text" class="form-control" id="namalengkap" name="nama"  />
                </div>
                <form action="#" method="post">
                  <div class="form-group first">
                    <label for="nik">Nomor Induk Kependudukan</label>
                    <input type="text" class="form-control" id="nik" name="nik"  />
                  </div>
                  <form action="#" method="post">
                    <div class="form-group first">
                      <label for="email">Email</label>
                      <input type="email" class="form-control" id="email" name="email"  />
                    </div>
                    <form action="#" method="post">
                      <div class="form-group first">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username"  />
                      </div>
                      <div class="form-group last mb-4">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password"  />
                      </div>

                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="role" id="inlineRadio1" value="pembeli" />
                        <label class="form-check-label" for="inlineRadio1">Pembeli</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="role" id="inlineRadio2" value="penjual" />
                        <label class="form-check-label" for="inlineRadio2">Penjual</label>
                      </div>
                      <div class="form-check form-check-inline"></div>

                      <div class="form-button">
                        <button type="submit" value="Daftar" name="daftar" class="btn text-white btn-block btn-primary">Daftar</button>
                        <button type="submit" value="Masuk" name="masuk" class="btn text-white btn-block btn-primary">Masuk</button>
                      </div>
                    </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
</body>

</html>