<?php
  // session_start();
  include "../connect.php";
  include "nav_admin.php";
  include "side_bar.php";
  // unset($_SESSION['user']);
  $user = !empty($_SESSION['user']) ? $_SESSION['user'] :'';
  // print_r($user);
  // exit();
  if(isset($_POST['them_sp']))
  {
      $ten_sp = $_POST['name'];
      $SL = $_POST['SL'];
      $Gia= $_POST['gia'];
      $IDDM= $_POST['iddm'];
      $mota = $_POST['content1'];
      // Lấy tên ảnh
      $img = $_FILES['img']['name'];
      // lấy đường dẫn ảnh
      $image_tmp_name = $_FILES['img']['tmp_name'];
      move_uploaded_file($image_tmp_name,'../IMG/SP/'.$img);

      $sql_sp = "INSERT INTO `sanpham` (`ID`, `Ten_SP`, `SL`, `Gia`, `ID_Danh_Muc`, `Hinh_Anh`, `Mo_Ta`) 
      VALUES (NULL,'$ten_sp','$SL', '$Gia','$IDDM','$img','$mota')";
      $kq_sp = mysqli_query($conn,$sql_sp);
      header("location:ds_danhmuc.php");

  }
?>
<title>Thêm sản phẩm</title>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Thêm sản phẩm</h1>
      <nav>
        <!-- <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Forms</li>
          <li class="breadcrumb-item active">Editors</li>
        </ol> -->
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="container">
        <div class="row">
        <form action="add-pd.php" method="POST" enctype="multipart/form-data">
        <div class="col-lg-8">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Information</h5>

              <!-- Quill Editor Bubble -->
              <table>
                <tr >
                    <td class="card-title">Tên thuốc:</td>
                    <td>
                        <input  class="ip" type="text" name="name">
                    </td>
                </tr>
                <tr >
                    <td class="card-title">Giá:</td>
                    <td>
                        <input  class="ip" type="text" name="gia">
                    </td>
                </tr>
                <tr >
                    <td class="card-title">Số lượng:</td>
                    <td>
                        <input class="ip" type="text" name="SL">
                    </td>
                </tr>
                <tr >
                    <td class="card-title">ID danh mục:</td>
                    <td>
                        <select name="iddm">
                          <?php 
                            $sql_iddm = "SELECT * FROM `danhmuc`";
                            $kq_iddm= mysqli_query($conn,$sql_iddm);
                            while($data = mysqli_fetch_array($kq_iddm))
                            {
                              echo 
                              '<option value="'.$data['ID'].'">'
                                .$data['ten_dm'].
                              '</option>';
                            }
                            
                            ;
                          ?>
                        </select>
                    </td>
                </tr>
                <tr >
                    <td class="card-title">Hình ảnh:</td>
                    <td>
                      <img src="" alt="" id="image" width="200px" height="200px">
                    </td>
                    <td>
                        <input type="file" name="img" id="img">
                    </td>
                </tr>
            </table>
              <!-- End Quill Editor Bubble -->

            </div>
          </div>

          <div class="card">
            <div class="card-body">
            <h5 class="card-title">Mô tả</h5>
                <div>
                    <textarea name="content1"></textarea>
                    <script>
                            CKEDITOR.replace( 'content1' );
                    </script>
                </div>
                <input class="btn" type="submit" name="them_sp" value="Add">   
            </div>                    
          </div>

        </div>
        </form>
      </div>
        </div>
    </section>

  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script src="assets/js/img.js"></script>

</body>

</html>