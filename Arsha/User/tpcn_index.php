<?php 
  // session_start();
  include "../connect.php";
  include "nav_user.php";
  // $user = !empty($_SESSION['admin']) ? $_SESSION['admin'] :'';
?>

<?php
      // TÌM TỔNG SỐ RECORD  
      $result = mysqli_query($conn, "SELECT count(ID) as total from sanpham where ID_Danh_Muc='4'");
      $row = mysqli_fetch_assoc($result);
      // echo $row; exit();  
      $total_records = $row['total'];
      // BƯỚC 3: TÌM LIMIT VÀ CURRENT_PAGE
      $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
      $limit = 12;
      // BƯỚC 4: TÍNH TOÁN TOTAL_PAGE VÀ START
      // tổng số trang
      $total_page = ceil($total_records / $limit);
      // Giới hạn current_page trong khoảng 1 đến total_page
      if ($current_page > $total_page){
        $current_page = $total_page;
      }
      else if ($current_page < 1){
        $current_page = 1;
      }
      // Tìm Start
      $start = ($current_page - 1) * $limit;
      // BƯỚC 5: TRUY VẤN LẤY DANH SÁCH TIN TỨC
      // Có limit và start rồi thì truy vấn CSDL lấy danh sách tin tức
      $result = mysqli_query($conn, "SELECT * FROM sanpham LIMIT $start,$limit");
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Thực phẩm chức năng</title>
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
  <link href="./assets/css/style.css" rel="stylesheet">

  <style>
    
    
    .services .container .button-holder{
      position: relative;
      
    }
    .services .container .button-holder button#btn_them{
    font-size: small;
    background: #293c5d;
    height: 2.5em;
    border: 0;
    color: #ffff;
    position: absolute;
      left: 0;
      right: 0;
      bottom: 0;
      width: auto;
      transition: 0.4s;
    }
    .services .container .button-holder button#btn_them:hover{
    font-size: small;
    background: #47b2e4;
    height: 2.5em;
    border: 1px black;
    color: black;
    position: absolute;
      left: 0;
      right: 0;
      bottom: 0;
      width: auto;
      transition: 0.4s;
    }
</style>
</head>


<body>
    <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">

<div class="container">
  <div class="row">
    <div class="col-lg-6 d-flex flex-column justify-content-center  order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
      <h1>THỰC PHẨM CHỨC NĂNG</h1>
    </div>
    <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
          <img src="assets/img/LOGO.png" class="img-fluid animated" alt="">
    </div>
    
  </div>
</div>

</section><!-- End Hero -->

  <main id="main">

<!-- ======= Services Section ======= -->
<section id="services" class="services section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Thực phẩm chức năng</h2>
        </div>

        <div class="row">
        <?php
                include("../connect.php");
                // 2. Truy vấn
                $sql="SELECT * FROM sanpham WHERE ID_Danh_Muc='4'  LIMIT " .$start. ", " .$limit;
                $kq = mysqli_query($conn, $sql);
                // 3. Hiển thị
                while ($row = mysqli_fetch_array($kq))
                {
                   
             
            ?>
          <div class="items-container col-xl-2 col-md-6 align-items-stretch mt-2 mt-md-0 pb-4" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-box w-80 h-100">
                <div class="icon w-30 h-40"><img class="h-100 w-100" src="../IMG/SP/<?php echo $row['Hinh_Anh'];?>" alt=""></div>    
                <p><a href="../../view/details.php?idsp_details=<?= $row['ID'] ?>"><?php
                        echo $row['Ten_SP'];
                        ?></a></p>
                                     
              <p><?php echo $row['Gia'];?>.000 VND </p>
              
              
            </div>
            <div class="button-holder"><button type="submit" name="btn_them" id="btn_them">THÊM VÀO GIỎ HÀNG</button></div>
          </div>
          <?php }?>
          
          

      </div>
    </section><!-- End Services Section -->
    
<!-- Start Page Numbering  -->
  <nav name="pagenumber" >
  <ul class="pagination col-lg-12 d-flex justify-content-center">
    <li class="page-item">
      <?php
      if ($current_page >1){$i = $current_page -1;}
      else $i = $current_page;
      echo '<a class="page-link" href="tpcn_index.php?page=' .$i . '" aria-label="Previous">' ?>
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">Previous</span>
      </a>
    </li>
    <?php
        for ($i = 1; $i <= $total_page; $i++){
          echo '<li class="page-item"><a class="page-link" href="tpcn_index.php?page='.$i.'">'.$i.'</a></li>';
          }
      ?>
        <li class="page-item">
      <?php
      if ($current_page <$total_page){$i = $current_page + 1;}
      else $i = $current_page;
      
      echo '<a class="page-link" href="tpcn_index.php?page=' .$i . '" aria-label="Next">' ?>
        <span aria-hidden="true">&raquo;</span>
        <span class="sr-only">Next</span>
      </a>
    </li>
  </ul>
  </nav>
  <!-- End Page Numbering  --> 
    
    </main><!-- End #main -->

      <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>Arsha</h3>
            <p>
              A108 Adam Street <br>
              New York, NY 535022<br>
              United States <br><br>
              <strong>Phone:</strong> +1 5589 55488 55<br>
              <strong>Email:</strong> info@example.com<br>
            </p>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Social Networks</h4>
            <p>Cras fermentum odio eu feugiat lide par naso tierra videa magna derita valies</p>
            <div class="social-links mt-3">
              <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
              <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
              <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
              <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
              <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
            </div>
          </div>

        </div>
      </div>
    </div>
  </footer><!-- End Footer -->

  <!-- <div id="preloader"></div> -->
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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