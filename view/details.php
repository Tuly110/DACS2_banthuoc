<?php
session_start();
    include "../Arsha/connect.php";
    include "nav_view.php";
    // include "../Arsha/Admin/nav_admin.php";
    $user = !empty($_SESSION['user']) ? $_SESSION['user'] :'';
    // echo  $user ;
    // exit();

    
    if(isset($_GET['idsp_details']))
    {
        $idsp_details = $_GET["idsp_details"];
        $details = mysqli_query($conn, "SELECT * FROM `sanpham` WHERE `ID`=".$idsp_details) ;
        $product= mysqli_fetch_assoc( $details);
    }


 ?>
<!doctype html>
<html lang="en">
  <head>
  <style>
        /* body{
            font-size: 50px;
        } */
        .container{
            margin-top: 10px;
            /* border: 1px solid #012970; */      
            font-family:Cambria;
            background: #f6f3ff;
            max-width: 750px;
        }
        .text{
            font-family:Cambria;
        }
        .submit {
            border: none;
            background-color: #2d3f6a;
            color: #fff;
            padding: 5px 10px;
            margin-right: 20px;
            border-radius: 8px;
        }
        .ip{
            /* padding: 20px 0 15px 0; */
            font-size: 18px;
            font-weight: 500;
            color: #012970;
            font-family: "Poppins", sans-serif;
            border-radius: 8px;
        }

        .color{
            /* background-color: #FFFFFF; */
            margin: 15px;
            padding: 15px;
            box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.12);

        }

        .img{
            display: flex;
            justify-content: center;
            padding: 12px 10px;

        }

        .img_con {
            padding: 12px 20px;
            box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.12);
            background-color: white;
            margin: 10px;
        }
        .cmt{
            border-radius: 12px;
            border: none;
            padding: 10px;
            width: 20%;
            background-color:#37517e ;
        }

        .cmt:hover{
            box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.12);
        }

        .cart{
            text-align: center;
            padding: 10px;
            margin: 10px;
            border: none;
            box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.12);
            border-radius: 12px;
            cursor: pointer;
        }

        .cart:hover{
            color: white;
            background-color:#37517e ;
        }
        hr{
            width:160vh;
        }
        
        .services .container a{
            text-decoration: none;
        }

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
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link href="assets/css/style.css" rel="stylesheet">
    
    
    
    

     <title><?php echo $product['Ten_SP'] ?></title>
    <h2 style="margin-top: 100px;">
        <?php echo $product['Ten_SP'] ?>
    </h2>
    <hr>
  </head>
  <body class="container">
    <div id="Chi_tiet" class="row">
        <div class="img col-md-4 col-12 p-3 ms-4">
            <div class="">
                <div>
                    <img class="img_con" src="../Arsha/IMG/SP/<?php echo $product['Hinh_Anh']?>"  width="100%" height="50%" alt=""><br>                
                </div>
            
                
                <?php if($product['SL'] >0) { ?>
                <form action="../Arsha/cart/cart.php?action=add" method="post">
                    <div class="add_cart d-flex justify-content-between">
                        <div class="ton_kho text-danger">
                            <b>Số lượng hiện có:</b> <?= $product['SL'] ?>
                        </div>
                        <div class="sl">
                            Số lượng:
                            <input style="width: 40px;" type="number" name="quantity[<?= $product['ID'] ?>]" size="2">
                        </div>
                        
                    </div>
                    <div class="d-flex justify-content-center">
                        <input class="cart" type="submit" name="them" id="" value="Thêm vào giỏ hàng">
                    </div>
                    
                </form>
                <?php } else { echo "<b>Hết hàng!</b>"; }?>
            </div>               
        </div>
        <!-- <a href="../Arsha/login.php"></a> -->
        <!-- <a href="D:\LapTrinhWeb\PHP\medicine\Arsha\cart"></a> -->
            

        <div class="info col-md-6 col-12">
            
            <label class="text text-primary color" for=""> 
                <h4>Giá: <?php echo $product['Gia'] ?>.000VND</h4>
                
            </label>
            <div class="text color">
                <label style="font-size: 20px ;" for=""><b>Mô tả:</b></label>
                <br>
                <?= $product['Mo_Ta'] ?>
            </div>
            <br>
            
            
            
        </div>
        
        <!-- ======= Services Section ======= -->
        <section id="services" class="services section-bg">
        <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Các sản phẩm khác</h2>
        </div>
      <!-- <div class="d-flex justify-content-between"> -->


      <div class="row">
      <?php
                
                // 2. Truy vấn
                $sql="SELECT * FROM `sanpham` ORDER BY RAND() LIMIT 4;";
                $kq = mysqli_query($conn, $sql);
                // 3. Hiển thị
                while ($row = mysqli_fetch_array($kq))
                {
                   
             
            ?>
          <div class="items-container col-xl-3 col-md-6 align-items-stretch mt-2 mt-md-0 pb-4" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-box w-100 h-100">
                <div class="icon w-30 h-40"><img class="h-100 w-100" src="../Arsha/IMG/SP/<?php echo $row['Hinh_Anh'];?>" alt=""></div>    
                <p><a href="../view/details.php?idsp_details=<?= $row['ID'] ?>"><?php
                        echo $row['Ten_SP'];
                        ?></a></p>
                                     
              <p><?php echo $row['Gia'];?>.000 VND </p>
              
              
            </div>
            <div class="button-holder"><button type="submit" name="btn_them" id="btn_them">THÊM VÀO GIỎ HÀNG</button></div>
          </div>
          <?php }?>

      </div>
     
      </section><!-- End Services Section -->

      
     </div>
        <div class=" col-md-8 col-12">
        <form action="details.php?idsp_details=<?php echo $product["ID"]; ?>" method="POST">
                    <div class="comment mt-2 text-info">
                        <h2>Đánh giá sản phẩm</h2>
                        <hr>
                        <textarea class="col-md-6 col-10" name="nd" id="nd"></textarea><br>
                        <input class="cmt text-white" type="submit" name="cmt" value="Gửi" id="btnGui">  <br><br>
                    </div>
                    <?php
                        if(isset($_GET['idsp_details'])&& isset($_POST['cmt']))
                        {    
                            $nd = $_POST['nd'];
                            $idsp_details = $_GET["idsp_details"];
                            $request = mysqli_query($conn, "INSERT INTO `cmt`( `id_user`, `id_sp`, `noidung`, `date`) 
                            VALUES ('".$user['id']."','". $idsp_details ."',' $nd ','".date('Y-m-d')."')");
                            }
                            // Lấy username từ bảng người dùng và lấy all từ bảng cmt from bảng user ND liên kết với bảng comment BL
                            // với điều kiện là ID từ bảng user và id-user từ bảng comment where cái idsp cần lấy cmt 
                            $sql_bl= "SELECT ND.name, BL.*
                            FROM user ND INNER JOIN cmt BL
                            ON ND.id = BL.id_user
                            WHERE id_sp =".$_GET['idsp_details'];
                            $kq=mysqli_query($conn,$sql_bl);
                
                            while($row=mysqli_fetch_array($kq))
                                { 
                    ?>
                                <div class="details_cmt" id="details_cmt">
                                    <p>Ngày:<?= $row['date']?></p>
                                    <p>Username:<?= $row['name']?> </p>
                                    <p>Nội dung:<?= $row['noidung'] ?></p>
                                </div>
                                    <hr>
                    <?php 
                                }
                    ?>
                </form> 
        </div>
    </div>
    <?php
        if(!isset($_SESSION['admin']))
        {
            echo isset($_SESSION['error']) ? $_SESSION['error'] :'';
        }
    ?>
        
        
        
        
    <!-- Optional JavaScript -->
    <!-- Popper.js first, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
    
    </script>
</body>
</html>