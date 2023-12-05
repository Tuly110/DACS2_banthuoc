<?php
 // session_start();
 include "../connect.php";
 include "nav_admin.php";
 include "side_bar.php";
 // unset($_SESSION['user']);
 $user = !empty($_SESSION['user']) ? $_SESSION['user'] :'';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Danh sách danh mục</title>
  <meta content="" name="description">
  <meta content="" name="keywords">


  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files --> 
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <!-- JAVASCRIPT -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<style>
    
.ip{
  border: none;
  outline: none;
  border-bottom: 1px solid #899dbe;
  width: 150%;
  margin: 10px;
}
</style>
<body>


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dữ liệu</h1>
      <nav>
      </nav>
    </div><!-- End Page Title -->
    <form action="" id="submit_danhmuc">
      <section class="section">
        <div class="row">
          <div class="col-lg-12">

            <div class="card">
              <div class="card-body">
                  <table class="table table-hover">
                      <thead>
                        <tr>
                          <th scope="col">ID</th>
                          <th scope="col">Tên danh mục</th>
                          <th scope="col">Số lượng</th>
                          <th scope="col">Hình ảnh</th>
                          <th scope="col">Sửa</th>
                          <th scope="col">Xóa</th>
                          <th scope="col">Mô tả</th>
                        </tr>
                      </thead>
                      <tbody>
              <?php
                  include("../connect.php");
                  // 2. Truy vấn
                  $sql="SELECT * FROM danhmuc";
                  $kq = mysqli_query($conn, $sql);
                  // 3. Hiển thị
                  while ($row = mysqli_fetch_array($kq))
                  {
              ?>
                  <tr class="success">
                      <td>
                      <?php
                          echo $row['ID'];
                          
                          ?>
                      </td>
                      <td>
                          <?php
                          echo ' <a href="ds_sanpham.php?iddm='.$row['ID'].'">'.$row["ten_dm"].'</a>'; 
                          ?>
                      </td>
                      <td>
                      <?php
                          echo $row['SL'];
                          
                          ?>
                      </td> 
                      <td>
                          <img src="../IMG/DM/<?php 
                          echo $row['hinh_anh']?>" width="50px" height="60px" alt="">
                      </td>
                      
                      <td>
                          <!-- <input type="hidden" id="id_dm1" value="<?= $row['ID'] ?>">
                          <button type="submit">Xóa</button> -->
                          <a href="delete.php?id_dm1=<?php echo$row['ID']?>" class="btn_delete">Xóa</a>
                      </td>
                      <td>
                          <a href="update-cate.php?id_dm=
                          <?php echo$row['ID']?>
                          ">Sửa</a>
                      </td>
                      <td>
                        <?php echo $row['mo_ta']; ?>
                      </td>
                  </tr>            
              <?php }?>
              </tbody>
                    </table>
                
                <!-- End Table with stripped rows -->

              </div>
            </div>

          </div>
        </div>
      </section>
      <?php if(isset($_GET['delete'])) : ?>
          <div class="delete_data" data-flashdata=<?php echo $_GET['delete'] ?> ></div>
      <?php endif ?>
    </form>
    

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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="assets/js/main.js"></script>
  <script src="../Admin/assets/js/xoa_danhmuc.js"></script>

</body>

</html>