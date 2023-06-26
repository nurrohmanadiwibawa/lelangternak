<?php

session_start();

if ((!isset($_SESSION['username']) || (!isset($_SESSION['id_penjual'])))) {
  header("Location: login.php");
}

require 'config.php';

$x = 0;
$sqlLelang = 'SELECT *, DATE_FORMAT(deadline, "%Y-%m-%d %H:%i:%s") AS formatted_deadline FROM produk_lelang';
$resultLelang = mysqli_query($conn, $sqlLelang);
$Lelang = mysqli_num_rows($resultLelang);
$JmlLelang = array();

?>

<!DOCTYPE php>
<php lang="en">

  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>Farm Mart Hewan Lelang</title>
    <meta content="" name="description" />
    <meta content="" name="keywords" />

    <!-- Favicons -->
    <link href="assets/img/faviconfarm.png" rel="icon" />


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
        <!-- <h1 class="logo me-auto"><a href="index.php">Farm Mart</a></h1> -->

        <!-- Uncomment below if you prefer to use an image logo -->
        <a href="index.php" class="logo me-auto"><img src="assets/img/farmmarthorizontal.png" alt="" class="img-fluid" /></a>

        <nav id="navbar" class="navbar order-last order-lg-0">
          <ul>
            <li><a href="homepenjual.php">Home</a></li>
            <li><a href="contactpenjual.php">Kontak</a></li>
            <li><a class="active" href="hewanlelangpenjual.php">Lelang</a></li>
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

    <main id="main" data-aos="fade-in">
      <!-- ======= Breadcrumbs ======= -->

      <div style="align-items: center; text-align: center; margin-top: 100px" class="tbh-produk">
        <a style="width: 500px; font-size: 20px; background-color: gold" href="tambahproduk.php" class="get-started-btn">POSTING PRODUK</a>
      </div>
      <!-- End Breadcrumbs -->

      <!-- ======= Courses Section ======= -->
      <section id="courses" class="courses">
        <div class="container" data-aos="fade-up">
          <div class="row" data-aos="zoom-in" data-aos-delay="100">
            <?php while ($JmlLelang[] = mysqli_fetch_array($resultLelang)) { ?>
              <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                <div class="course-item">
                  <img src="assets/img/<?php echo $JmlLelang[$x]['gambar_produk'] ?>" class="img-fluid" alt="..." />
                  <div class="course-content">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                      <p class="price" style="font-size: 12px;">Last Bid: Rp <?php echo number_format($JmlLelang[$x]['hrgawal_produk'], 0, ',', '.') ?></p>
                      <p class="price" style="font-size: 12px;">Harga jual: Rp <?php echo number_format($JmlLelang[$x]['hrgjual_produk'], 0, ',', '.') ?></p>
                    </div>

                    <h3><?php echo $JmlLelang[$x]['nm_produk'] ?></h3>
                    <p><?php echo $JmlLelang[$x]['deskripsi_produk'] ?></p>
                    <div class="trainer d-flex justify-content-between align-items-center">
                      <div class="trainer-profile d-flex align-items-center">
                        <img src="assets/img/trainers/location.png" class="img-fluid" alt="" />
                        <span><?php echo $JmlLelang[$x]['lokasi'] ?></span>
                      </div>
                      <div>
                        <h4 id="countdown-<?php echo $x ?>"><?php echo $JmlLelang[$x]['formatted_deadline'] ?></h4>
                        <script>
                          // Mendapatkan elemen-elemen yang dibutuhkan
                          var countdownElements = document.querySelectorAll('[id^="countdown-"]');

                          // Memulai countdown untuk setiap elemen
                          countdownElements.forEach(function(element) {
                            var countdownDate = new Date(element.innerText).getTime();

                            // Memperbarui countdown setiap 1 detik
                            var countdownInterval = setInterval(function() {
                              var now = new Date().getTime();
                              var distance = countdownDate - now;

                              // Menghitung waktu yang tersisa
                              var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                              var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                              var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                              var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                              // Menampilkan waktu yang tersisa
                              element.innerText = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";

                              // Menghentikan countdown saat waktu telah habis
                              if (distance < 0) {
                                clearInterval(countdownInterval);
                                element.innerText = "Waktu Habis";
                              }
                            }, 1000);
                          });
                        </script>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php $x++;
            } ?>
            <!-- End Course Item-->
          </div>
        </div>
      </section>
      <!-- End Courses Section -->
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