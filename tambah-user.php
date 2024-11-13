<?php 
include 'koneksi.php' ;
session_start();
if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    if(!empty($_FILES['foto']['name'])) {
        $nama_foto = $_FILES['foto']['name'];
        $ukuran_foto = $_FILES['foto']['size'];

        //img extension
        $ext = array('png','jpg','jpeg');
        $extFoto = pathinfo($nama_foto, PATHINFO_EXTENSION);

        //Jika Extensi Foto tidak ada yang terdaftar di array extension
    if(!in_array($extFoto, $ext)) {
            echo 'Extention Tidak Ditemukan';
            die();
        }else{
            // pindahkan gambar 
            move_uploaded_file($_FILES['foto']['tmp_name'], 'upload/'.$nama_foto);
            $sql = "INSERT INTO users (nama,email,password,foto) VALUES ('$nama','$email','$password','$nama_foto')";
            $result = mysqli_query($koneksi, $sql);
        }
    }else{
        $sql = "INSERT INTO users (nama,email,password) VALUES ('$nama','$email','$password')";
        $result = mysqli_query($koneksi, $sql);
    }
    if ($result) {
        header("Location: user.php");
    }else {
        echo "Error disimpan";
        echo mysqli_error($koneksi);
    }


}
// Parameter Edit
$id = isset($_GET['edit']) ? $_GET['edit']: '';
$queryEdit = mysqli_query($koneksi, "SELECT * FROM users WHERE id = '$id'");
$rowEdit = mysqli_fetch_assoc($queryEdit);

if (isset($_POST['edit'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    //jika password di isi oleh user
    if($_POST['password']){
        $password = $_POST['password'];
    }else{
        $password = $rowEdit['password'];
    }

    $update = mysqli_query($koneksi,"UPDATE users SET nama='$nama', email='$email', password='$password' WHERE id='$id'");
    header("location:user.php?ubah=berhasil");

}
?>

<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../asset/admin/assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Dashboard - Analytics | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <?php include 'inc/head.php' ?>
  </head>
    <style>
        placeholder{
            margin-top: 2rem;
        }
    </style>
  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

       <?php include 'inc/sidebar.php'?>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

         <?php include 'inc/nav.php' ?>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
              <div class="container">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="card mt-5">
                      <div class="card-header"><?php echo isset($_GET['edit']) ? 'Edit' : 'Tambah' ?> User</div>
                      <div class="card-body">
                      <?php if(isset($_GET['hapus'])) : ?>
                        <div class="alert alert-success" role="alert">
                         Data berhasil Di hapus
                        </div>
                      <?php endif ; ?>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="mb-3 row">
                              <div class="col-sm-6">
                              <label for="">Nama Pengguna</label>
                              <input type="text" class="form-control" name="nama" id="" placeholder="Masukan Nama anda" value="<?php echo isset($_GET['edit']) ? $rowEdit['nama'] : '' ?>" required>
                              </div>
                              <div class="col-sm-6 mb-4">
                              <label for="">Masukan Email</label>
                              <input type="email" class="form-control" name="email" id="" placeholder="Masukan email anda" value="<?php echo isset($_GET['edit']) ? $rowEdit['email'] : '' ?>" required>
                              </div>
                              <div class="col-sm-6">
                              <label for="">Password</label>
                              <input type="password" class="form-control" name="password" id="" placeholder="Masukan password anda" >
                              </div>
                              <div class="col-sm-6">
                              <label for="">Uplode Foto</label>
                              <input type="file" class="form-control" name="foto" id="" >
                              </div>
                              <div class="col-sm-6">
                              <button type="submit" class=" btn btn-primary" name="<?php echo isset($_GET['edit']) ? 'edit' : 'simpan' ?>">Simpan</button>
                              </div>
                            </div>
                        </form>
                          
                      </div>
                    </div>
                  </div>
                </div>
              </div>
         
            <!-- / Content -->

            <!-- Footer -->
             <div class="container">
              <div class="row ">
              <?php include 'inc/footer.php'?>
              </div>
             </div>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- <div class="buy-now">
      <a
        href="https://themeselection.com/products/sneat-bootstrap-html-admin-template/"
        target="_blank"
        class="btn btn-danger btn-buy-now"
        >Upgrade to Pro</a
      >
    </div> -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../asset/admin/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../asset/admin/assets/vendor/libs/popper/popper.js"></script>
    <script src="../asset/admin/assets/vendor/js/bootstrap.js"></script>
    <script src="../asset/admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../asset/admin/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../asset/admin/assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="../asset/admin/assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../asset/admin/assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
