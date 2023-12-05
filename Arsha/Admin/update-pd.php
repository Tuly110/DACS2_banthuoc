<?php
ob_start();
  // session_start();
  include "../connect.php";
  include "nav_admin.php";
  include "side_bar.php";
  // unset($_SESSION['user']);
  $user = !empty($_SESSION['user']) ? $_SESSION['user'] :'';
  $idsp = $_GET['idsp'];
  $request_sp = mysqli_query($conn, "SELECT * FROM `sanpham` WHERE `ID`=". $idsp);
  $row= mysqli_fetch_assoc($request_sp);
  if(isset($_POST['update_sp']))
  {
    $idsp = $_GET['idsp'];
    $ten_sp = $_POST['name'];
    $SL = $_POST['SL'];
    $Gia= $_POST['gia'];
    $IDDM= $_POST['iddm'];
    $mota = $_POST['content'];
    // Lấy tên ảnh
    $img = $_FILES['img']['name'];
    // lấy đường dẫn ảnh
    $image_tmp_name = $_FILES['img']['tmp_name'];
    
    $update_sp = mysqli_query($conn, "UPDATE `sanpham` SET
    `Ten_SP`='$ten_sp',`SL`=' $SL',`Gia`='$Gia',`ID_Danh_Muc`=' $IDDM',`Hinh_Anh`='$img ',`Mo_Ta`='$mota' WHERE `ID`=".$idsp);
    $founder = "../IMG/SP/";
    $element = $founder .basename($image_tmp_name);
  
    if(!file_exists($element)){
      move_uploaded_file($image_tmp_name,'../IMG/SP/'.$img);;
    }
    header("location: ds_danhmuc.php");
  }

        
  
?>
<title>Cập nhật sản phẩm</title>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Cập nhật sản phẩm</h1>
      <nav>
        <!-- <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Forms</li>
          <li class="breadcrumb-item active">Editors</li>
        </ol> -->
      </nav>
    </div><!-- End Page Title -->

    <form action="" method="POST" enctype="multipart/form-data">
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
                          <input  class="ip" type="text" name="name" value="<?= $row['Ten_SP'] ?>">
                      </td>
                  </tr>
                  <tr >
                      <td class="card-title">Giá:</td>
                      <td>
                          <input  class="ip" type="text" name="gia" value="<?= $row['Gia'] ?>">
                      </td>
                  </tr>
                  <tr >
                      <td class="card-title">Số lượng:</td>
                      <td>
                          <input class="ip" type="text" name="SL" value="<?= $row['SL'] ?>">
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
                          <span>
                            <img src="../IMG/SP/<?= $row['Hinh_Anh'] ?>" alt=""  width="100px" height="100px" id="image">
                          </span>
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
                      <textarea name="content">
                        <?= $row['Mo_Ta'] ?>
                      </textarea>
                      <script>
                              CKEDITOR.replace( 'content' );
                      </script>
                  </div>
                  <input class="btn" type="submit" name="update_sp" value="Update">   
              </div>                    
            </div>

          </div>
          </form>
        </div>
          </div>
      </section>
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
  <script src="assets/js/main.js"></script>
  <script src="assets/js/img.js"></script>
<?php ob_end_flush(); ?>
</body>

</html>