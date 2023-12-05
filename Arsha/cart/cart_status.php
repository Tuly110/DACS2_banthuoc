<?php
    session_start();
     include "../connect.php";
    // include "nav_admin.php";
    // include "side_bar.php";
    $user = !empty($_SESSION['admin']) ? $_SESSION['admin'] :'';
    $oder_id = $_GET['id_oder'];
    // echo $id_user;
    if(isset($_SESSION['admin']))
    {   
        $sql_cart_status= mysqli_query($conn,
        "SELECT oder.name_nguoi_mua, oder.dia_chi, oder.tg_dat, oder.sdt, oder.note, oder_details.*, sanpham.Ten_SP 
        FROM oder 
        INNER JOIN oder_details ON oder.id = oder_details.oder_id 
        INNER JOIN sanpham ON sanpham.ID = oder_details.sp_id WHERE oder_id=".$oder_id) ;
        $data = mysqli_fetch_assoc($sql_cart_status);
        if(isset($_GET['cart_status']))
        {
          $update_cart_status= mysqli_query($conn, "UPDATE `oder` SET `cart_status`='0' WHERE `id`=".$oder_id);
          // var_dump("UPDATE `oder` SET `cart_status`='0' WHERE `id_user`=".$id_user); exit();
        }
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
  </head>
  <body>
    
    <form method="post" action="send_email.php">
        <label for="name">Tên người mua</label>
        <textarea rows="1" name="message" id="message" required>
          <?= $data['name_nguoi_mua'] ?>
        </textarea>
        
        <?php 
            $request_tenSP = mysqli_query($conn, "SELECT oder_details.sl, oder_details.gia, sanpham.Ten_SP FROM sanpham INNER JOIN oder_details ON sanpham.ID = oder_details.sp_id WHERE oder_id=".$oder_id);
            // echo "SELECT oder_details.sl, sanpham.Ten_SP FROM sanpham INNER JOIN oder_details ON sanpham.ID = oder_details.sp_id WHERE oder_id=".$oder_id;
            ?>
                <label for="message">Tên sản phẩm & số lượng</label>
                <textarea  name="message" id="message" required>
            <?php
            while($row = mysqli_fetch_array($request_tenSP))
            {
        ?>         
              <?= $row['Ten_SP'] ?>          Số lượng:<?= $row['sl']?>        Giá: <?= $row['gia']?>
        <?php
            }      
        ?>
              </textarea> 
        <label for="email">Số điện thoại</label>
        <textarea rows="1" name="message" id="message" required>
        <?= $data['sdt'] ?>
        </textarea>
        
        
        <label for="subject">Tỉnh/ Thành phố</label>
        <textarea rows="1" name="message" id="message" required>
        <?= $data['dia_chi'] ?>
        </textarea>
        
        
        <label for="message">Ghi chú</label>
        <textarea rows="1" name="message" id="message" required>
        <?= $data['note'] ?>
        </textarea>

        <!-- <label for="message">Tổng tiền</label>
        <textarea rows="1" name="message" id="message" required>
        <?= $data['gia'] ?>
        </textarea> -->
<!-- 
        <label for="message">Số lượng</label>
        <textarea rows="1" name="message" id="message" required>
      
        </textarea> -->

        <label for="message">Thời gian đặt</label>
        <textarea rows="1" name="message" id="message" required>
        <?= date("Y-m-d H:i:s",$data['tg_dat'] ) ?>
        
        </textarea>
        
        <br>
        <a href="../../mail/form.php?oder_id=<?= $data['oder_id']?>">Giao hàng</a>
        
        <!-- <a href="">
          <button>Đã xử lý</button>
        </a> -->
    </form>
    <!-- Optional JavaScript -->
    <!-- Popper.js first, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
  </body>
</html>