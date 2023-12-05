<?php
//   session_start();
  include "../connect.php";
  // unset($_SESSION['user']);
//   $user = !empty($_SESSION['user']) ? $_SESSION['user'] :'';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <!-- <title>Thêm danh mục</title> -->
  <meta content="" name="description">
  <meta content="" name="keywords">


  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
  <!-- Vendor CSS Files -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

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
  width: 90%;
  margin: 10px;
}

.btn{
  font-size: 18px;
  /* width: 70px; */
  color: #012970;
  font-weight: 500;
  font-family: "Poppins", sans-serif;
  margin-top: 20px;
}
.btn:hover{
    color:#798eb3 ;
}
</style>
<body>
  
  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="index_admin.php">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->
    <!-- START ADD products -->
        <li class="nav-item">
            <a class="nav-link collapsed"  href="add-pd.php">
                <i class="bi bi-menu-button-wide"></i><span>Add Product</span>
            </a>
        </li><!-- End Forms Nav -->
    <!-- START ADD category -->
        <li class="nav-item">
            <a class="nav-link collapsed"  href="add_cate.php">
                <i class="bi bi-menu-button-wide"></i><span>Add Category</span>
            </a>
        </li><!-- End Forms Nav -->
    <!-- START UPDATE -->
        <!-- End Forms Nav -->
        <!-- Dữ liệu -->
        <li class="nav-item">
            <a class="nav-link collapsed"  href="ds_danhmuc.php">
                <i class="bi bi-layout-text-window-reverse"></i><span>Dữ liệu</span>
            </a>
        </li><!-- End Tables Nav -->
        <li class="nav-item">
            <a class="nav-link collapsed"  href="don_hang.php">
                <i class="fa-solid fa-people-carry-box"></i><span>Đơn hàng</span>
            </a>
        </li><!-- End Tables Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="#">
                <i class="bi bi-bar-chart"></i><span>Charts</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
        <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="charts-chartjs.html">
                    <i class="bi bi-circle"></i><span>Chart.js</span>
                </a>
            </li>
            <li>
                <a href="charts-apexcharts.html">
                    <i class="bi bi-circle"></i><span>ApexCharts</span>
                </a>
            </li>
            <li>
            <a href="charts-echarts.html">
                <i class="bi bi-circle"></i><span>ECharts</span>
            </a>
            </li>
        </ul>
        </li><!-- End Charts Nav -->


        <li class="nav-heading">Pages</li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="pages-error-404.html">
                <i class="bi bi-dash-circle"></i>
                <span>Error 404</span>
            </a>
        </li><!-- End Error 404 Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="pages-blank.html">
                <i class="bi bi-file-earmark"></i>
                <span>Blank</span>
            </a>
        </li><!-- End Blank Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->