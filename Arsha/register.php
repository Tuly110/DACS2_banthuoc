<?php
  session_start();
  include "connect.php";
  $err ='';
  if(isset($_POST['signup']))
  {        
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $fullname = trim($_POST['name']);
    $pass = trim($_POST['password']);
    if(!empty($fullname) || !empty($email) || !empty($username) || !empty($password))
    {
      
      $request_email = mysqli_query($conn, "SELECT * FROM `user` WHERE `email`='$email'");
      $kt_email = mysqli_num_rows($request_email);
      if($kt_email > 0)
      {
        $err = "Tài khoản đã tồn tại";
      }
      else
      {
        $pass_mh= md5($pass);
        $sql= " INSERT INTO `user`(`id`, `name`, `email`, `fullname`, `pass`, `role`)
        VALUES (NULL,'$username','$email','$fullname','$pass_mh','user')";
        $kq= mysqli_query($conn,$sql);
        if($kq)
        {
          header("location:login.php");
        }
      }
      
    }
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>REGISTER</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

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

  <!-- Font Icon -->

  <link rel="stylesheet" href="./assets/css/login_signup/fonts/material-icon/css/material-design-iconic-font.min.css">
  <!-- Main css -->

  <link rel="stylesheet" href="./assets/css/login_signup/css/style.css">
</head>
<!-- <style>
body{
  background-color: #f3f5fa;
  padding: 10px;
  margin: 15px;
}
.card-header,
.card-footer {
  border-color: #ebeef4;
  background-color: #fff;
  color: #798eb3;
  padding: 15px;
}

.card-title {
  padding: 20px 0 15px 0;
  font-size: 18px;
  font-weight: 500;
  color: #012970;
  font-family: "Poppins", sans-serif;
}

.card-title span {
  color: #899bbd;
  font-size: 14px;
  font-weight: 400;
}

.card-body {
  padding: 0 20px 20px 20px;
}

</style> -->
<body>

  <main>
  <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Đăng ký </h2> 
                        <span style="color: red;">
                          <?= $err; ?>
                        </span>
                        <form action="register.php" method="POST" class="register-form" id="register-form">
                            <div class="form-group">
                                <label for="yourName"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="name" id="yourName" class="form-control" placeholder="  Họ tên" required/>
                            </div>
                            <div class="form-group">
                                <label for="yourEmail"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="yourEmail" class="form-control" placeholder="  Địa chỉ email" required/>
                            </div>
                            <div class="form-group">
                                <label for="yourUsername"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="text" name="username" class="form-control" id="yourUsername" required placeholder="  Tên tài khoản">
                            </div>
                            <div class="form-group">
                                <label for="yourPassword"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" class="form-control" id="yourPassword" required placeholder="  Mật khẩu"
                                    pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$" title="Mật khẩu phải bao gồm 1 chữ cái hoa, 1 chữ cái thường và 1 chữ số"
                                    required/>
                            </div>
                            
                            <div class="form-group">
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>Tôi đồng ý với tất cả các <a href="#" class="term-service">Điều khoản</a></label>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="ĐĂNG KÝ"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="./assets/img/register.png" alt="image"></figure>
                        <a href="login.php" class="signup-image-link">Bạn đã có tài khoản?</a>
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