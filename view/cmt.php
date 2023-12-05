
<?php
 session_start();
 include "../Arsha/connect.php";
 $user = !empty($_SESSION['admin']) ? $_SESSION['admin'] :'';
 if(isset($_GET['idsp'])&&($_POST['btnGui']))
 {
    echo "s";
    exit();
    $nd = $_POST['nd'];
    echo $nd;
    exit();
    $idsp_details = $_GET["idsp"];
    $request = mysqli_query($conn, "INSERT INTO `cmt`( `id_user`, `id_sp`, `noidung`, `date`) 
    VALUES ('".$user['id']."','". $idsp_details ."',' $nd ','".time()."')");
 }
 
//  mysqli_query($conn,"INSERT INTO `comment`( `id_user`, `id_sp`, `noidung`, `date`)
//   VALUES ('".$user['ID']."','".$_POST['id']."','".$_POST['noidung']."', '".date('Y-m-d')."')");

 ?>
 <!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="/js/jquery.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Bình luận</title>
  </head>
  <body>

    <!-- Optional JavaScript -->
    <!-- Popper.js first, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
  </body>
</html>