<?php
//   session_start();
  include "../connect.php";
  include "nav_admin.php";
  include "side_bar.php";
  // unset($_SESSION['user']);
  $user = !empty($_SESSION['admin']) ? $_SESSION['admin'] :'';
  if(isset($_POST['search']))
  {
    $text = $_POST['query'];
    $request_search = mysqli_query($conn, "SELECT * FROM `sanpham` WHERE `Ten_SP` LIKE '%$text%';");
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
        <!-- <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Forms</li>
          <li class="breadcrumb-item active">Editors</li>
        </ol> -->
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
                        <th scope="col">ID</th>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Giá</th>
                        <th scope="col">Hình ảnh</th>
                        <th scope="col">Xóa</th>
                        <th scope="col">Sửa</th>
                        <th scope="col">Mô tả sản phẩm</th>
                        
                      </tr>
                    </thead>
                    <tbody>
            <?php
                // include("../connect.php");
                 // 2. Truy vấn
                
                // 3. Hiển thị
                while ($row = mysqli_fetch_assoc($request_search))
                {
            ?>
                <tr class="success">
                    <td>
                    <?php
                        echo $row["ID"];
                        ?>
                    </td>
                    <td>
                        <a href="../../view/details.php?idsp_details=<?php echo $row["ID"]; ?>">
                          <?php
                          echo $row["Ten_SP"]; 
                          ?>
                        </a>
                        
                    </td>
                    <td>
                        <?php
                        echo $row["SL"]; 
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $row["Gia"]; 
                        ?>
                    </td>
                    <td>
                        <img src="../IMG/SP/<?php 
                        echo $row['Hinh_Anh']?>" 
                        width="40px" height="60px" alt="">
                     </td>
                    <td>
                        <a href="delete-pd.php?idsp1=
                        <?php echo$row['ID']?>
                        ">Xóa</a>
                    </td>
                    <td>
                        <a href="update-pd.php?idsp=
                        <?php echo$row['ID']?>
                        ">Sửa</a>
                    </td>
                    <td>
                        <?php echo $row['Mo_Ta']; ?>
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