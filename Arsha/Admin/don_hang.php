<?php
// session_start();
//  include "../connect.php";
 include "nav_admin.php";
 include "side_bar.php";
 $user = !empty($_SESSION['admin']) ? $_SESSION['admin'] :'';
//  echo $_SESSION['admin']; exit();
?>
<?php
  $num=0;
  if(isset($_SESSION['admin']))
  {
    $sql="SELECT oder.name_nguoi_mua, oder.cart_status, oder.id_user,  oder_details.sp_id, oder_details.oder_id 
    FROM oder INNER JOIN oder_details ON oder.id = oder_details.oder_id;";
    // echo $sql; exit();
    
    $request = mysqli_query($conn, $sql);
    // exit();
    $num_sp= mysqli_num_rows($request);
    $limit = 5;
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
    $kq= mysqli_query($conn," SELECT oder.name_nguoi_mua , oder.cart_status, oder.id_user,  oder_details.sp_id, oder_details.oder_id
    FROM oder INNER JOIN oder_details ON oder.id = oder_details.oder_id"." LIMIT $start,$limit" );

    // $kq= mysqli_query($conn, "SELECT * FROM sanpham WHERE ID_Danh_Muc" );
    
  }
  
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Danh sách sản phẩm</title>
  <meta content="" name="description">
  <meta content="" name="keywords">


  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

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

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<style>

#Paging{
    width: 100%;
    display: flex;
    justify-content: center;
}

#Paging a{
    text-decoration: none;
    border: 1px solid #2d3f6a;
    padding: 5px 10px;
    color: #132040;
    border-radius: 8px;
    margin: 0 5px;
}
    
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

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col">Họ & tên</th>
                        <th scope="col">ID sản phẩm</th>
                        <th scope="col">ID oder</th>
                        <th scope="col">Tình trạng đơn hàng</th>    
                      </tr>
                    </thead>
                    <tbody>
            <?php
                // include("../connect.php");
                 // 2. Truy vấn
                
                // 3. Hiển thị
                while ($row = mysqli_fetch_array($kq))
                { $start++
            ?>
                <tr class="success">
                    <td>
                          <?php
                            echo $row["name_nguoi_mua"];
                          ?>
                    </td>
                    <td>
                          <?php
                          echo $row["sp_id"]; 
                          ?>
                    </td>
                    <td>
                          <?php
                          echo $row["oder_id"]; 
                          ?>
                    </td>
                    
                    <td>
                      <!-- kkk -->
                      <?php
                        if($row['cart_status']==1)
                        {
                           echo "<a href='../cart/cart_status.php?id_oder= ".$row['oder_id']."&cart_status=0'>Xử lý đơn hàng</a>";
                        }
                        else
                        {
                           echo "<span style='color:red' >Đã xử lý</span>";
                          // echo "<a href='../cart/cart_status.php?id_oder= ".$row['oder_id']."&cart_status=0'>Xử lý đơn hàng</a>";

                        }
                      ?>
                     
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
      <div id="Paging" class="page">
        <?php
          if(isset($_SESSION['admin']))
          {
            if($page_ht > 2 && $total_page >1)
            {
              $pre_page = $page_ht -1;
              echo '<a href="don_hang.php?page='.$pre_page.'"><i class="fa-solid fa-angle-left"></i></a>';
              // '&iddm='.$_GET['iddm'].
            }
            
            if(!empty($total_page)){
                
              for ($i=1; $i <= $total_page; $i++) { 
                if($i != $page_ht){
                  if($i > $page_ht -2 && $i < $page_ht + 2){
                    echo "<a href='don_hang.php?page=$i&'>$i</a>";
                    // iddm=".$_GET['iddm']."
                    // echo "<a href='ds_sanpham.php?iddm='></a>"; 
                       
                  }
                }else{
                  echo "<a href='don_hang.php?page=$i'>$i</a>";
                }
              }
            }

            if($page_ht < $total_page - 1 && $total_page > 1){
              $next_page = $page_ht + 1;
              echo '<a href="don_hang.php?page='.$next_page.'"><i class="fa-solid fa-angle-right"></i></a>';
              // '&iddm='.$_GET['iddm'].'
            }
          }

        ?>
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

</body>

</html>