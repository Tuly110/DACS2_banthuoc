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
        $sql_cart_status= 
        mysqli_query($conn,
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
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons'>
    <title>Thông Tin Đơn Hàng</title>
    <style>
    html {
      width: 100%;
      height: 100%;
    }
    
    body {
      background: -webkit-linear-gradient(45deg, rgba(66, 183, 245, 0.8) 0%, rgba(66, 245, 189, 0.4) 100%);
      background: linear-gradient(45deg, rgba(66, 183, 245, 0.8) 0%, rgba(66, 245, 189, 0.4) 100%);
      color: rgba(0, 0, 0, 0.6);
      font-family: "Roboto", sans-serif;
      font-size: 14px;
      line-height: 1.6em;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
      display: inline;
    }
    
    .overlay, .form-panel.one:before {
      position: absolute;
      top: 0;
      left: 0;
      display: none;
      background: rgba(0, 0, 0, 0.8);
      width: 100%;
      height: 100%;
    }
    
    .form {
      z-index: 15;
      position: relative;
      background: #FFFFFF;
      width: 600px;
      border-radius: 4px;
      box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
      box-sizing: border-box;
      margin: 100px auto 10px;
      overflow: hidden;
      
    }
    .form-toggle {
      z-index: 10;
      position: absolute;
      top: 60px;
      right: 60px;
      background: #FFFFFF;
      width: 60px;
      height: 60px;
      border-radius: 100%;
      -webkit-transform-origin: center;
              transform-origin: center;
      -webkit-transform: translate(0, -25%) scale(0);
              transform: translate(0, -25%) scale(0);
      opacity: 0;
      cursor: pointer;
      -webkit-transition: all 0.3s ease;
      transition: all 0.3s ease;
    }
    .form-toggle:before, .form-toggle:after {
      content: '';
      display: block;
      position: absolute;
      top: 50%;
      left: 50%;
      width: 30px;
      height: 4px;
      background: #4285F4;
      -webkit-transform: translate(-50%, -50%);
              transform: translate(-50%, -50%);
    }
    .form-toggle:before {
      -webkit-transform: translate(-50%, -50%) rotate(45deg);
              transform: translate(-50%, -50%) rotate(45deg);
    }
    .form-toggle:after {
      -webkit-transform: translate(-50%, -50%) rotate(-45deg);
              transform: translate(-50%, -50%) rotate(-45deg);
    }
    .form-toggle.visible {
      -webkit-transform: translate(0, -25%) scale(1);
              transform: translate(0, -25%) scale(1);
      opacity: 1;
    }
    .form-group {
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      -ms-flex-wrap: wrap;
          flex-wrap: wrap;
      -webkit-box-pack: justify;
          -ms-flex-pack: justify;
              justify-content: space-between;
      margin: 0 0 20px;
    }
    .form-group:last-child {
      margin: 0;
    }
    .form-group label {
      display: block;
      margin: 0 0 10px;
      color: rgba(0, 0, 0, 0.6);
      font-size: 12px;
      font-weight: 500;
      line-height: 1;
      text-transform: uppercase;
      letter-spacing: .2em;
    }
    .two .form-group label {
      color: #FFFFFF;
    }
    .form-group textarea {
      outline: none;
      display: block;
      background: rgba(0, 0, 0, 0.1);
      width: 100%;
      border: 0;
      border-radius: 4px;
      box-sizing: border-box;
      padding: 12px 20px;
      color: rgba(0, 0, 0, 0.6);
      font-family: inherit;
      font-size: inherit;
      font-weight: 500;
      line-height: inherit;
      -webkit-transition: 0.3s ease;
      transition: 0.3s ease;
      overflow: hidden;
      resize: none;
    }
    .form-group textarea:focus {
      color: rgba(0, 0, 0, 0.8);
    }
    .two .form-group textarea {
      color: #FFFFFF;
    }
    .two .form-group textarea:focus {
      color: #FFFFFF;
    }
    .form-group button {
      outline: none;
      background: #4285F4;
      width: 100%;
      border: 0;
      border-radius: 4px;
      padding: 12px 20px;
      color: #FFFFFF;
      font-family: inherit;
      font-size: inherit;
      font-weight: 500;
      line-height: inherit;
      text-transform: uppercase;
      cursor: pointer;
    }
    .two .form-group button {
      background: #FFFFFF;
      color: #4285F4;
    }
    .form-group .form-remember {
      font-size: 12px;
      font-weight: 400;
      letter-spacing: 0;
      text-transform: none;
    }
    .form-group .form-remember input[type='checkbox'] {
      display: inline-block;
      width: auto;
      margin: 0 10px 0 0;
    }
    .form-group .form-recovery {
      color: #4285F4;
      font-size: 12px;
      text-decoration: none;
    }
    .form-panel {
      padding: 60px calc(5% + 60px) 60px 60px;
      box-sizing: border-box;
    }
    .form-panel.one:before {
      content: '';
      display: block;
      opacity: 0;
      visibility: hidden;
      -webkit-transition: 0.3s ease;
      transition: 0.3s ease;
    }
    .form-panel.one.hidden:before {
      display: block;
      opacity: 1;
      visibility: visible;
    }
    .form-panel.two {
      z-index: 5;
      position: absolute;
      top: 0;
      left: 95%;
      background: #4285F4;
      width: 100%;
      min-height: 100%;
      padding: 60px calc(10% + 60px) 60px 60px;
      -webkit-transition: 0.3s ease;
      transition: 0.3s ease;
      cursor: pointer;
    }
    .form-panel.two:before, .form-panel.two:after {
      content: '';
      display: block;
      position: absolute;
      top: 60px;
      left: 1.5%;
      background: rgba(255, 255, 255, 0.2);
      height: 30px;
      width: 2px;
      -webkit-transition: 0.3s ease;
      transition: 0.3s ease;
    }
    .form-panel.two:after {
      left: 3%;
    }
    .form-panel.two:hover {
      left: 93%;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }
    .form-panel.two:hover:before, .form-panel.two:hover:after {
      opacity: 0;
    }
    .form-panel.two.active {
      left: 10%;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
      cursor: default;
    }
    .form-panel.two.active:before, .form-panel.two.active:after {
      opacity: 0;
    }
    .form-header {
      margin: 0 0 40px;
    }
    .form-header h1 {
      padding: 4px 0;
      color: #4285F4;
      font-size: 24px;
      font-weight: 700;
      text-transform: uppercase;
    }
    .two .form-header h1 {
      position: relative;
      z-index: 40;
      color: #FFFFFF;
    }
    
    .pen-footer {
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      -webkit-box-orient: horizontal;
      -webkit-box-direction: normal;
          -ms-flex-direction: row;
              flex-direction: row;
      -webkit-box-pack: justify;
          -ms-flex-pack: justify;
              justify-content: space-between;
      width: 600px;
      margin: 20px auto 100px;
    }
    .pen-footer a {
      color: #FFFFFF;
      font-size: 12px;
      text-decoration: none;
      text-shadow: 1px 2px 0 rgba(0, 0, 0, 0.1);
    }
    .pen-footer a .material-icons {
      width: 12px;
      margin: 0 5px;
      vertical-align: middle;
      font-size: 12px;
    }
    
    .cp-fab {
      background: #FFFFFF !important;
      color: #4285F4 !important;
    }
    
  </style>
  
  </head>
  <body>
    
  <div class="form">
  <div class="form-toggle"></div>
  <div class="form-panel one">
    <div class="form-header">
      <h1>thông tin đơn hàng</h1>
    </div>
    <div class="form-content">
      <form method="post" action="send_email.php">
        <div class="form-group">
          <label for="username">Tên người mua</label>
          <!-- <input type="text" id="username" name="username" required="required"/> -->
          <textarea rows="1" name="message" id="message" required>
            <?= $data['name_nguoi_mua'] ?>
          </textarea>

          <?php 
            $request_tenSP = mysqli_query($conn, "SELECT oder_details.sl, oder_details.gia, sanpham.Ten_SP FROM sanpham INNER JOIN oder_details ON sanpham.ID = oder_details.sp_id WHERE oder_id=".$oder_id);
            // echo "SELECT oder_details.sl, sanpham.Ten_SP FROM sanpham INNER JOIN oder_details ON sanpham.ID = oder_details.sp_id WHERE oder_id=".$oder_id;
            ?>
        </div>
        <div class="form-group">
          <label for="message">Tên sản phẩm | Số lượng</label>
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
        </div>
        <div class="form-group">
          <label for="message">Số điện thoại</label>
          <textarea rows="1" name="message" id="message" required>
            <?= $data['sdt'] ?>
            </textarea>

        </div>

        <div class="form-group">
          <label for="message">Tỉnh/ Thành phố</label>
          <textarea rows="1" name="message" id="message" required>
            <?= $data['dia_chi'] ?>
            </textarea>

        </div>

        <div class="form-group">
          <label for="message">Địa chỉ</label>
          <textarea rows="1" name="message" id="message" required>
            <?= $data['note'] ?>
            </textarea>

        </div>

        <div class="form-group">
          <label for="message">Thời gian đặt</label>
          <textarea rows="1" name="message" id="message" required>
            <?= date("Y-m-d H:i:s",$data['tg_dat'] ) ?>
            
            </textarea>

        </div>

        <div class="form-group">
         
          <button type="button" onclick="location.href='../../mail/form.php?oder_id=<?= $data['oder_id']?>';">Giao hàng</button>
        </div>
      </form>
    </div>
  </div>
  
</div>
    <!-- Optional JavaScript -->
    <!-- Popper.js first, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
  </body>
</html>