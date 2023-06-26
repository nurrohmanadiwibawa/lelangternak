<?php

session_id();
session_start();
if ((!isset($_SESSION['username']) || (!isset($_SESSION['id_pembeli'])))) {
  header("Location: login.php");
}
if (!isset($_SESSION['id_produk'])) {
  header("Location: hewanlelang.php");
}
require 'config.php';

$x = $_SESSION['id_produk'];
$id = $_SESSION['id_pembeli'];
$sqlLelang = "SELECT *, DATE_FORMAT(deadline, '%Y-%m-%d %H:%i:%s') AS formatted_deadline FROM produk_lelang WHERE id_produk='$x'";
$resultLelang = mysqli_query($conn, $sqlLelang);
$Lelang = mysqli_fetch_object($resultLelang);

$idjual = $Lelang->id_penjual;
$sqlUJ = "SELECT * FROM user_penjual WHERE id_penjual='$idjual'";
$resultUJ = mysqli_query($conn, $sqlUJ);
$UJ = mysqli_fetch_object($resultUJ);

$idbeli = $Lelang->id_pembeli;
$sqlUB = "SELECT * FROM user_pembeli WHERE id_pembeli='$idbeli'";
$resultUB = mysqli_query($conn, $sqlUB);
$UB = mysqli_fetch_object($resultUB);

if (isset($_POST['update'])) {
  $OldPrice = $Lelang->hrgawal_produk;
  $AddPrice = $_POST['addprice'];
  $sqlUpdate1 = "UPDATE produk_lelang SET `hrgawal_produk`='$AddPrice' WHERE id_produk='$x'";
  $resultUpdate1 = mysqli_query($conn, $sqlUpdate1);
  $sqlUpdate2 = "UPDATE produk_lelang SET `id_pembeli`='$id' WHERE id_produk='$x'";
  $resultUpdate2 = mysqli_query($conn, $sqlUpdate2);
  if ($AddPrice > $OldPrice) {
    if ($resultUpdate1) {
      if ($resultUpdate2) {
        echo "<script language='javascript'>";
        echo 'alert("Selamat Harga Tawaran Anda telah masuk");';
        echo 'window.location.replace("detaillelang.php");';
        echo "</script>";
      } else {
        echo "<script>alert(' Anda gagal masuk.')</script>";
      }
    } else {
      echo "<script>alert('Harga Tawaran Anda gagal masuk.')</script>";
    }
  } else {
    echo "<script>alert('Nilai Tawaran Anda harus lebih tinggi dari Nilai Tawaran tertinggi.')</script>";
  }
}
?>

<!DOCTYPE php>
<php lang="en">

  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>Nama Produk Lelang</title>
    <meta content="" name="description" />
    <meta content="" name="keywords" />

    <!-- Favicons -->
    <link href="assets/img/faviconfarm.png" rel="icon" />
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet" />

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet" />
    <link href="assets/vendor/aos/aos.css" rel="stylesheet" />
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet" />
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet" />
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">


    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet" />

    <!-- =======================================================
  * Template Name: Mentor
  * Updated: May 30 2023 with Bootstrap v5.3.0
  * Template URL: https://bootstrapmade.com/mentor-free-education-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  </head>

  <body>
    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top">
      <div class="container d-flex align-items-center">
        <!-- Uncomment below if you prefer to use an image logo -->
        <a href="index.php" class="logo me-auto"><img src="assets/img/farmmarthorizontal.png" alt="" class="img-fluid" /></a>
        <nav id="navbar" class="navbar order-last order-lg-0">
          <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="contact.php">Kontak</a></li>
            <li><a class="active" href="hewanlelang.php">Lelang</a></li>
            <li class="dropdown">
              <a href="#"><span>Akun</span> <i class="bi bi-chevron-down"></i></a>
              <ul>
                <li><a href="#">Pengaturan Akun</a></li>
                <li><a href="index.php">Logout</a></li>
                <li class="dropdown">
              </ul>
            </li>
          </ul>
          <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>

        <!-- .navbar -->

        <a href="#" class="get-started-btn">Halo, <?php echo $_SESSION['username'] ?>!</a>
      </div>
    </header>
    <!-- End Header -->

    <a href="courses.php" class="get-started-btn">Get Started</a>
    </div>
    </header>
    <!-- End Header -->

    <main id="main">


      <!-- ======= Cource Details Section ======= -->
      <section id="course-details" class="course-details">
        <div class="container" data-aos="fade-up">
          <div class="row">
            <div class="col-lg-8">
              <img src="assets/img/<?php echo $Lelang->gambar_produk ?>" class="img-fluid" alt="" />
              <h3>Deskripsi</h3>
              <p>
                <?php echo $Lelang->deskripsi_produk ?>
              </p>
            </div>
            <div class="col-lg-4">
              <div class="course-info d-flex justify-content-between align-items-center">
                <h5>Pemilik</h5>
                <p><a href="#"><?php echo $UJ->username ?></a></p>
              </div>
              <div class="course-info d-flex justify-content-between align-items-center">
                <h5>Lokasi</h5>
                <p><?php echo $Lelang->lokasi ?></p>
              </div>

              <div class="course-info d-flex justify-content-between align-items-center">
                <h5>Tawaran Terakhir</h5>
                <p>Rp <?php echo number_format($Lelang->hrgawal_produk, 0, ',', '.') ?></p>
              </div>
              <div class="course-info d-flex justify-content-between align-items-center">
                <h5>Penawar Tertinggi</h5>
                <p><a href="#"><?php echo (isset($UB) && isset($UB->username)) ? $UB->username : "Belum Ada"; ?></a></p>
              </div>
              <div class="course-info d-flex justify-content-between align-items-center">
                <h5>Harga Jual</h5>
                <p>Rp <?php echo number_format($Lelang->hrgjual_produk, 0, ',', '.') ?></p>
              </div>
              <div class="course-info d-flex justify-content-between align-items-center">
                <h5>Batas Waktu Lelang</h5>
                <p id="countdown"><?php echo $Lelang->deadline ?></p>
                <script>
                  // Mengambil elemen dengan ID "countdown"
                  const countdownElement = document.getElementById("countdown");

                  // Mendapatkan tanggal dan waktu deadline dari PHP
                  const deadline = new Date("<?php echo $Lelang->deadline ?>").getTime();

                  // Memperbarui hitungan mundur setiap 1 detik
                  const countdownInterval = setInterval(() => {
                    // Mendapatkan tanggal dan waktu saat ini
                    const now = new Date().getTime();

                    // Menghitung selisih waktu antara sekarang dengan deadline
                    const timeDifference = deadline - now;

                    // Menghitung hari, jam, menit, dan detik yang tersisa
                    const days = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((timeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);

                    // Format waktu yang tersisa menjadi string
                    const countdownString = `${days} H ${hours} J ${minutes} M ${seconds} D`;

                    // Memperbarui nilai pada elemen countdown
                    countdownElement.innerHTML = countdownString;

                    // Menghentikan hitungan mundur jika waktu telah habis
                    if (timeDifference <= 0) {
                      clearInterval(countdownInterval);
                      countdownElement.innerHTML = "Waktu lelang telah berakhir";
                    }
                  }, 1000);
                </script>

              </div>
              <div class="btn-tbhtawaran">

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  Berikan Tawaran
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <form method="post">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Tambahkan Tawaran</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <div class="form-group">
                            <label for="hrg_awal">Masukkan jumlah tawaran:</label>
                            <input name="addprice" type="number" class="form-control" id="hrg_awal" placeholder="Pastikan lebih besar dari tawaran sebelumnya!">
                          </div>
                          <!-- Tambahkan elemen formulir lainnya di sini -->
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                          <button name="update" value="update" type="submit" class="btn btn-primary">Tambahkan</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>


            </div>
          </div>
        </div>
        </div>
      </section>
      <!-- End Cource Details Section -->


    </main>
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">
      <div class="footer-top">
        <div class="container">
          <div class="row">
            <div class="col-lg-3 col-md-6 footer-contact">
              <h3>Farm Mart</h3>
              <p>
                Jl. Imam Bonjol No.207, Pendrikan Kidul <br />
                Semarang<br />
                Jawa Tengah <br /><br />
                <strong>Phone:</strong> +62 813-2509-4529<br />
                <strong>Email:</strong> farmmartindo@gmail.com<br />
              </p>
            </div>
          </div>
        </div>
      </div>

      <div class="container d-md-flex py-4">
        <div class="me-md-auto text-center text-md-start">
          <div class="copyright">
            &copy; Copyright <strong><span>Farm Mart</span></strong>. All Rights Reserved
            <script type="text/javascript">
              document.write(new Date().getFullYear());
            </script>
          </div>
          <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/mentor-free-education-bootstrap-theme/ -->
            Designed by <a href="https://bootstrapmade.com/">Farm Mart</a>
          </div>
        </div>
        <div class="social-links text-center text-md-right pt-3 pt-md-0">
          <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
          <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
          <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
          <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
          <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
        </div>
      </div>
    </footer>
    <!-- End Footer -->

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
  </body>
</php>