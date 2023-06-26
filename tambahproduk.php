<?php 

session_start();

require 'config.php';

if (isset($_POST['tambah'])) {
  $nama = $_POST['nama'];
  $hjual = $_POST['hjual'];
  $hawal= $_POST['hawal'];
  $desk = $_POST['desk'];
  $dead = $_POST['dead'];
  $lok = $_POST['lok'];
  $idjual = $_SESSION['id_penjual'];
  $nama_file = $_FILES['gambar']['name'];
  $tmp_file = $_FILES['gambar']['tmp_name'];
  $path = "assets/img/".$nama_file;
  $sql1 = "INSERT INTO produk_lelang(nm_produk, hrgjual_produk, hrgawal_produk, deskripsi_produk, gambar_produk, deadline, lokasi, id_penjual)
          VALUES('$nama', '$hjual', '$hawal', '$desk', '$nama_file', '$dead', '$lok', '$idjual')";
  $result1 = mysqli_query($conn, $sql1); 
  if ($result1) {
    if(move_uploaded_file($tmp_file, $path)){ 
      echo "<script>alert('Selamat Anda berhasil untuk menyimpan data ke database.')</script>";
    } else{
      echo "<script>alert('Maaf, Gambar produk gagal untuk diupload.')</script>";
    }
  } else {
    echo "<script>alert('Maaf, Data produk gagal untuk diupload.')</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>TAMBAH PRODUK BARU</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

    <link rel="stylesheet" href="assets/css/loginstyle.css" />
  </head>
  <body>
    <section class="ftco-section">
      <div class="container">
        <div class="row justify-content-center"></div>
        <div class="row justify-content-center">
          <div class="col-md-7 col-lg-5">
            
                <div class="d-flex">
                  <div class="w-100">
                    <h3 class="mb-4">TAMBAH PRODUK BARU</h3>
                  </div>
                  
                </div>
                <form class="signin-form" method="post" enctype="multipart/form-data">
                  <div class="form-group mt-3">
                    <input type="text" class="form-control" name="nama" required />
                    <label class="form-control-placeholder" for="nm_produk">Nama Produk</label>
                  </div>
                  <div class="form-group">
                    <input id="password-field" type="text" class="form-control" name="hjual" required />
                    <label class="form-control-placeholder" for="hrg_jual">Harga Jual</label>
                  </div>
                  <div class="form-group">
                    <input id="password-field" type="text" class="form-control" name="hawal" required />
                    <label class="form-control-placeholder" for="hrg_awal">Harga Awal</label>
                  </div>
                  <div class="form-group">
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Deskripsi Produk" id="floatingTextarea" name="desk"></textarea>
                    </div>
                  </div>
                  <div class="mb-3">
                    <label for="formFileSm" class="form-label">Pilih Gambar Produk</label>
                    <input class="form-control form-control-sm" id="formFileSm" type="file" name="gambar" required>
                  </div>
                  <div class="form-group">
                    <input id="date" type="date" class="form-control" name="dead" required />
                    <label class="form-control-placeholder" for="deadline"></label>
                  </div>
                  <div class="form-group mt-3">
                    <input type="text" class="form-control" name="lok" required />
                    <label class="form-control-placeholder" for="lokasi">Lokasi</label>
                  </div>
                  <div class="form-group">
                    <button type="submit" name="tambah" class="form-control btn btn-primary rounded submit px-3">TAMBAHKAN</button>
                  </div>
                </form>
                
            </div>
          </div>
        </div>
      </div>
    </section>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>
