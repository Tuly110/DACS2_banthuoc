<?php
  include "nav_user.php";
  ob_start();
  $user = !empty($_SESSION['user']) ? $_SESSION['user'] :'';
  // echo $_SESSION['user'];
  // exit();
  $search = !empty($_GET['query']) ? $_GET['query'] :'';
  // if(empty($search))
  // {
  //   echo "lỗi";
  // }
?>
<?php
  $num=0;
  // echo "A";
  // exit();
  if(!empty($_SESSION['user']))
  {
    if($search)
    {
      $sql="SELECT * FROM `sanpham` WHERE `Ten_SP` LIKE '%$search%'";
      $request = mysqli_query($conn, $sql);
      // exit();
      $num_sp= mysqli_num_rows($request);
      // echo $num_sp;
      // exit();
      $limit = 6;
      $total_page = ceil($num_sp/$limit);
      $page_ht = isset($_GET['page']) ? $_GET['page']:1 ;
      if($page_ht > $total_page)
      {
        $page_ht = $total_page;
      }
      else if($page_ht < 1)
      {
        $page_ht = 1;
      }
      $start = (($page_ht-1)* $limit);
      if( $num_sp >= 1)
      {
        $kq= mysqli_query($conn,"SELECT * FROM `sanpham` WHERE `Ten_SP` LIKE '%$search%' LIMIT $start,$limit" );
        // echo "SELECT * FROM `sanpham` WHERE `Ten_SP` LIKE '%$search%' LIMIT $start,$limit";
        // exit();
      }      
    }
  }


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <a href="../login.php"></a>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title></title>
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
                <h1>MEDICINE SHOP</h1>
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
              <h2>Sản phẩm bạn đang tìm kiếm</h2>
            </div>

            <div class="row">
                <?php
                if(!empty($_SESSION['user']) )
                {
                  if(($search) && ($num_sp >= 1) ) 
                  {
                    $request_search = mysqli_query($conn, "SELECT * FROM `sanpham` WHERE `Ten_SP` LIKE '%$search%';");
                    // echo "SELECT * FROM `sanpham` WHERE `Ten_SP` LIKE '%$search%'";
                    // exit();
                    // 3. Hiển thị
                    while ($row = mysqli_fetch_assoc($kq))
                    { 
                ?>
                      <div class="items-container col-xl-2 col-md-6 align-items-stretch mt-2 mt-md-0 pb-4" data-aos="zoom-in" data-aos-delay="100">
                          <div class="icon-box w-80 h-100">
                              <div class="icon w-30 h-40"><img class="h-100 w-100" src="../IMG/SP/<?php echo $row['Hinh_Anh'];?>" alt=""></div>    
                              <p><a href="../../view/details.php?idsp_details=<?= $row['ID'] ?>"><?php
                                      echo $row['Ten_SP'];
                                      ?></a></p>
                                      <!-- <a href=""></a>              -->
                          <p><?php echo $row['Gia'];?>.000 VND </p>
                          </div>
                          <div class="button-holder"><button type="submit" name="btn_them" id="btn_them">THÊM VÀO GIỎ HÀNG</button></div>
                      </div> 
                <?php  }
                  }else 
                  {            
                ?>
                <!-- if(($num_sp < 1) || empty($search)) -->
                   <!-- if(("SELECT * FROM `sanpham` WHERE `Ten_SP` LIKE '%$search%'" == '') && empty($search)) -->
                   <div style="color: red; font-size: 32px; font-weight: bold; text-align: center;">
                      <?php include "../404notfound/404.php" ?>
                    </div>
                <?php }
                } else {
                  echo "Vui lòng đăng nhập!";
                  header("location:../login.php");
                }?>
               
                
                  <!-- <a href="../login.php"></a> -->
            </div>
            <div id="Paging" class="page">
              <?php
              if(!empty($_SESSION['user']))
              {
                if($search)
                {
                  if($page_ht > 2 && $total_page >1)
                  {
                    $pre_page = $page_ht -1;
                    echo '<a href="search_user.php?page='.$pre_page.'&query='.$search.'"><i class="fa-solid fa-angle-left"></i></a>';
                  }
                  
                  if(!empty($total_page>1)){
                      
                    for ($i=1; $i <= $total_page; $i++) { 
                      if($i != $page_ht){
                        if($i > $page_ht -2 && $i < $page_ht + 2){
                          echo "<a href='search_user.php?page=$i&query=".$search."'>$i</a>";
                          // exit();
                          // echo "<a href='ds_sanpham.php?iddm='></a>"; 
                            
                        }
                      }else{
                        echo "<a href='search_user.php?page=$i'>$i</a>";
                      }
                    }
                  }

                  if($page_ht < $total_page - 1 && $total_page > 1){
                    $next_page = $page_ht + 1;
                    echo '<a href="search_user.php?page='.$next_page.'&query='.$search.'"><i class="fa-solid fa-angle-right"></i></a>';
                  }
                }
              }
              

              ?>
            </div>
        </div>


    </section><!-- End Services Section -->
    
    </main><!-- End #main -->



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