<?php
 // session_start();
    include "../connect.php";
     include "nav_admin.php";
    include "side_bar.php";
    // unset($_SESSION['user']);
    $user = !empty($_SESSION['admin']) ? $_SESSION['admin'] :'';
    $id_dm= $_GET['id_dm'];
    $request_dm = mysqli_query($conn, "SELECT * FROM `danhmuc` WHERE `ID`=".$id_dm);
    $data = mysqli_fetch_assoc($request_dm);
    if(isset($_POST['update_dm']))
    {
        $ten_dm = $_POST['name'];
        $SL = $_POST['SL'];
        $mota = $_POST['content'];
        // Lấy tên ảnh
        $img = $_FILES['imgFile']['name'];
        // lấy đường dẫn ảnh
        $image_tmp_name = $_FILES['imgFile']['tmp_name'];
        move_uploaded_file($image_tmp_name,'../IMG/DM/'.$img);
        $update_dm = mysqli_query($conn, "UPDATE `danhmuc` SET `ten_dm`='$ten_dm',`SL`='$SL',`hinh_anh`='$img ',`mo_ta`='$mota ' WHERE `ID`=".$id_dm);
        if($update_dm)
        {
            // header("location:ds_danhmuc.php");
        }
        
    }

    
?>
<title>Cập nhật danh mục</title>
<script src="assets/js/img.js"></script>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Cập nhật danh mục</h1>
    </div><!-- End Page Title -->

    <form action="" method="POST" enctype="multipart/form-data">
        <section class="section">
            <div class="container">
            <div class="row">
            <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                <h5 class="card-title">Information</h5>

                <!-- Quill Editor Bubble -->
                <table>
                    <tr >
                        <td class="card-title">Tên thuốc:</td>
                        <td>
                            <input  class="ip" type="text" name="name" value="<?= $data['ten_dm']?>">
                        </td>
                    </tr>
                    <tr >
                        <td class="card-title">Số lượng:</td>
                        <td>
                            <input class="ip" type="text" name="SL" value="<?= $data['SL']?>">
                        </td>
                    </tr>
                    <tr >
                        <td class="card-title">Hình ảnh:</td>
                        <td>
                            <span>
                                <img src="../IMG/DM/<?php echo$data['hinh_anh'] ?>" width="100px" height="100px" id="img">
                            </span>
                            <input type="file" name="imgFile" id="imgFile">
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
                            <?= $data['mo_ta'] ?>
                        </textarea>
                        <script>
                                CKEDITOR.replace( 'content' );
                        </script>
                    </div>
                    <input class="btn" type="submit" name="update_dm" value="Update">   
                </div>                    
            </div>

            </div>
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

</body>

</html>