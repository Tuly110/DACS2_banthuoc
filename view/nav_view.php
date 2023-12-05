<?php 
  //session_start();
  include "../Arsha/connect.php";
  // unset($_SESSION['user']);
  $user = !empty($_SESSION['user']) ? $_SESSION['user'] :'';
  // $nav_request = mysqli_query($conn," SELECT * FROM `danhmuc`");

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <style>
  .toggle-sidebar-btn {
    font-size: 32px;
    padding-left: 10px;
    cursor: pointer;
    color: #012970;
  }

  .search-bar {
    min-width: 360px;
    padding: 0 20px;
  }

  @media (max-width: 1199px) {
    .search-bar {
      position: fixed;
      top: 50px;
      left: 0;
      right: 0;
      padding: 20px;
      box-shadow: 0px 0px 15px 0px rgba(1, 41, 112, 0.1);
      background: white;
      z-index: 9999;
      transition: 0.3s;
      visibility: hidden;
      opacity: 0;
    }

    .search-bar-show {
      top: 60px;
      visibility: visible;
      opacity: 1;
    }
  }

  .search-form {
    width: 100%;
  }

  .search-form input {
    border: 0;
    font-size: 14px;
    color: #012970;
    border: 1px solid rgba(1, 41, 112, 0.2);
    padding: 7px 38px 7px 8px;
    border-radius: 3px;
    transition: 0.3s;
    width: 100%;
  }

  .search-form input:focus,
  .search-form input:hover {
    outline: none;
    box-shadow: 0 0 10px 0 rgba(1, 41, 112, 0.15);
    border: 1px solid rgba(1, 41, 112, 0.3);
  }

  .search-form button {
    border: 0;
    padding: 0;
    margin-left: -30px;
    background: none;
  }

  .search-form button i {
    color: #012970;
  }
  </style>
  
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top " style="    background: #37517e;">
    <div class="container d-flex align-items-center " style="    background: #37517e;">

<!-- <div class="bg-0"> -->
    <div class="search-bar">
          <form class="search-form d-flex align-items-center" method="GET" action="../Arsha/User/search_user.php">
            <input type="text" name="query" placeholder="Search" title="Enter search keyword">
            <button  type="submit" title="Search"><i class="bi bi-search"></i></button>
          </form>
        </div><!-- End Search Bar -->

          <nav id="navbar" class="navbar">
            <ul>
              <li><a class="nav-link scrollto " href="../Arsha/index.php">Trang chủ</a></li>
              <li><a class="nav-link scrollto" href="../Arsha/User/tkkd_index.php">Thuốc không kê đơn</a></li>
              <li><a class="nav-link scrollto" href="../Arsha/User/hmp_index.php">Hóa mỹ phẩm</a></li>
              <li><a class="nav-link scrollto" href="../Arsha/User/tpcn_index.php">Thực phẩm chức năng</a></li>
              <li class="nav-item dropdown pe-3">
              <?php
                  if(isset( $_SESSION['user']))
                  {  
              ?>
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                  <span class="d-none d-md-block dropdown-toggle ps-2">
                    <?=  $user['email']?>
                  </span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                  <li>
                    <a class="dropdown-item d-flex align-items-center" href="../Arsha/logout.php">
                      <i class="bi bi-box-arrow-right"></i>
                      <span>Log out</span>
                    </a>
                  </li>
                </ul><!-- End Profile Dropdown Items -->
                <li>
                    <a class=" scrollto" href="../Arsha/cart/cart.php">
                        <i style="font-size: 1.25em;"  class=" fa-solid fa-cart-shopping fa-2xl"></i>
                    </a>
                </li>
                <li>
                    <a class=" scrollto" href="#contact">
                    <i style="font-size: 1.25em;" class="fa-regular fa-address-book"></i>
                    </a>
                </li>
              </li><!-- End Profile Nav -->
            
            <?php } 
                else 
                { ?>
              <li><a class="nav-link scrollto" href="../Arsha/register.php">Đăng ký</a></li>          
              <li><a class="nav-link scrollto" href="../Arsha/login.php">Đăng nhập</a></li>
              
            <?php } ?>
              
            </ul>
          </nav><!-- .navbar -->
    </div>

    <!-- </div> -->
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <!-- <section id="hero" class="d-flex align-items-center">
  </section>End Hero -->

  <!-- <main id="main"> -->

  <!-- </main>End #main -->


  <!-- <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a> -->

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>