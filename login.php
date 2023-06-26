<?php

require 'config.php';

error_reporting(0);

session_start();

if (isset($_POST['masuk'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $role = $_POST['role'];
  if (!empty($username)){
    if (!empty($password)){
      if (!empty($role)){
        $sql = "SELECT * FROM user_" . $role . " WHERE username='$username'AND password='$password' AND role='$role'";
        $result = mysqli_query($conn, $sql);
        if ($result->num_rows > 0) {
          $row = mysqli_fetch_assoc($result);
          if ($role == "pembeli"){
            $_SESSION['username'] = $row['username'];
            $_SESSION['id_pembeli'] = $row['id_pembeli'];
            header("Location: hewanlelang.php");
          } else if ($role == "penjual"){
            $_SESSION['username'] = $row['username'];
            $_SESSION['id_penjual'] = $row['id_penjual'];
            header("Location: hewanlelangpenjual.php");
          }
        } else {
          echo "<script>alert('Username atau password atau profesi Anda salah. Silahkan coba lagi!')</script>";
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
}

if (isset($_POST['daftar'])) {
  header("Location: register.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
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

  <title>Masuk Farm Mart</title>
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
                <h3>Masuk <strong>Farm Mart</strong></h3>
                <p class="mb-4">Pastikan username dan password yang diinput sudah terdaftar</p>
              </div>
              <form action="#" method="post">
                <div class="form-group first">
                  <label for="username">Username</label>
                  <input type="text" class="form-control" id="username" name="username" />
                </div>
                <div class="form-group last mb-4">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="password" name="password" />
                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="role" id="inlineRadio1" value="pembeli"/>
                  <label class="form-check-label" for="inlineRadio1">Pembeli</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="role" id="inlineRadio2" value="penjual"/>
                  <label class="form-check-label" for="inlineRadio2">Penjual</label>
                </div>
                <div class="form-check form-check-inline"></div>

                <div class="ingat-saya">
                  <div class="d-flex mb-5 align-items-center">
                    <label class="control control--checkbox mb-0"><span class="caption">Ingat saya</span>
                      <input type="checkbox" name="ingat" />
                      <div class="control__indicator"></div>
                    </label>
                    <span class="ml-auto"><a href="#" class="forgot-pass">Lupa Password</a></span>
                  </div>
                </div>

                <button type="submit" value="Masuk" name="masuk" class="btn text-white btn-block btn-primary">Masuk</button>

                <button type="submit" value="daftar" name="daftar" class="btn text-white btn-block btn-primary">Daftar</button>
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