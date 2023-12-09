<?php
    session_start();
    include "../connect.php";
    // include "../User/nav_user.php";
    $err='';
    $GLOBALS['change_quantity'] =false;
    if(isset($_POST["dat_hang"]))
    {
        // var_dump($quality) ; exit();
        $user= isset($_SESSION['user'])?$_SESSION['user'] :'';
        if(empty($_POST['name']) || empty($_POST['sdt']) || empty($_POST['flatform']) || empty($_POST['note']))
        {
            $err = "*KHÔNG ĐƯỢC ĐỂ TRỐNG*";
        }
        if(empty( $err ))
        {
            $total=0;
            $oder_product = array();
            $update_slString= "";
            $product =mysqli_query($conn,"SELECT * FROM `sanpham` WHERE `ID`IN (".implode(",", array_keys($_SESSION['cart'])).")" ) ;
            echo "<pre>";
            
            while($data = mysqli_fetch_array($product))
            { 
                // var_dump($_SESSION["cart"][$data['ID']]);
                // var_dump($data['SL']); 
                // KT số lượng mua và số lượng tồn 
                $oder_product[] = $data;
                if( $_SESSION["cart"][$data['ID']] > $data['SL']  )
                {
                    $_SESSION["cart"][$data['ID']]=$data['SL'];
                    // var_dump($_SESSION["cart"][$data['ID']]=$data['SL']); exit();
                    $GLOBALS['change_quantity'] = true;
                }
                else
                {
                    $total = $total +$data['Gia']*$_SESSION['cart'][$data['ID']]; 
                    // var_dump(" WHEN `ID`=".$data['ID']." THEN `SL`- ".$_SESSION["cart"][$data['ID']]);
                    $update_slString .= " WHEN `ID`=".$data['ID']." THEN `SL`- ".$_SESSION["cart"][$data['ID']]; 
                }
            }
            // var_dump(" WHEN `ID`=".$data['ID']." THEN `SL`- ".$_SESSION["cart"][$data['ID']]); exit();
            if( $GLOBALS['change_quantity']==false)
            {
                //  xử lí update sl trong db
                $update_sl = mysqli_query($conn, "UPDATE `sanpham` SET `SL` = CASE".$update_slString." END WHERE `ID` IN (".implode(",", array_keys($_SESSION['cart'])).")");
                $name=$_POST['name'];
                $phone=$_POST['sdt'];
                $address=$_POST['flatform'];
                $note =$_POST['note'];
            //     echo date("Y-m-d H:i:s",1699847411 );
            //     exit();
                $insert_od= mysqli_query($conn, "INSERT INTO `oder`(`id`, `name_nguoi_mua`, `sdt`, `dia_chi`, `tg_dat`, `note`, `tong_tien`, `id_user`, `cart_status`) 
                VALUES (NULL,' $name','$phone','$address','".time()."','$note','$total','".$user['id']."','1')");
                // Lấy id order để insert vào db oder deatails
                $oder_ID = $conn->insert_id;
                $insertString='';
                foreach($oder_product as $key => $products)
                {
                    $insertString .= "(NULL,'$oder_ID',".$products['ID'].",".$_SESSION['cart'][$products['ID']].",".$products['Gia'].",'".time()."','".time()."')";
                    if($key != count($oder_product)-1)
                    {
                        $insertString .= ",";
                    }
                }
                $inser_od_details= mysqli_query($conn, "INSERT INTO `oder_details`(`ID`, `oder_id`, `sp_id`, `sl`, `gia`, `create_time`, `update_time`) 
                VALUES ".$insertString."");
                if($inser_od_details)
                {
                    header("location:../index.php");

                    unset($_SESSION['cart']);
                }
            }    
        }
    }
    
?>
<!doctype html>
<html lang="en">
  <head>
    
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<a href="../index.php"></a>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    
    
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="fonts/icomoon/style.css">


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Style -->
    <link rel="stylesheet" href="css/style.css">
    <title>Thông tin đặt hàng</title>
</head>
  <style>
    .container{
    padding-top: 80px;
  }
    .err{
        color: red;
    }
  </style>
  <body>
    
    <?php if( $GLOBALS['change_quantity'] ){?>
        <h3>Sản phẩm bạn muốn mua vượt quá số lượng sản phẩm chúng tôi hiện có. Vui lòng <a href="../cart/cart.php">tải lại</a> giỏ hàng</h3>
    <?php }else { ?>
   
   
   
    <!-- Form -->
    <div class="container">
      <div class="row align-items-stretch justify-content-center no-gutters">
        <div class="col-md-7">
          <div class="form h-100 contact-wrap p-5">
            <h3 class="text-center">Thông tin đặt hàng</h3>
            <form class="mb-5" action="../cart/info_dh.php" method="post" id="contactForm" name="contactForm">
              

              <div class="row">
                <div class="col-md-6 form-group mb-3">
                  <label for="" class="col-form-label">Họ tên *</label>
                  <input type="text" class="form-control" name="name" id="name" placeholder="Nhập họ tên">
                  
                </div>
                <div class="col-md-6 form-group mb-3">
                  <label for="" class="col-form-label">Số điện thoại *</label>
                  <input type="text" class="form-control" name="sdt" id="email"  placeholder="Nhập số điện thoại">
                  
                </div>
              </div>

              <div class="row">
                <div class="col-md-12 form-group mb-3">
                  <label for="" class="col-form-label">Tỉnh/Thành phố</label>
                  <select name= "flatform">
                    <option value="An Giang">An Giang
                    <option value="Bà Rịa - Vũng Tàu">Bà Rịa - Vũng Tàu
                    <option value="Bắc Giang">Bắc Giang
                    <option value="Bắc Kạn">Bắc Kạn
                    <option value="Bạc Liêu">Bạc Liêu
                    <option value="Bắc Ninh">Bắc Ninh
                    <option value="Bến Tre">Bến Tre
                    <option value="Bình Định">Bình Định
                    <option value="Bình Dương">Bình Dương
                    <option value="Bình Phước">Bình Phước
                    <option value="Bình Thuận">Bình Thuận
                    <option value="Ninh Thuận">Ninh Thuận
                    <option value="Cà Mau">Cà Mau
                    <option value="Cao Bằng">Cao Bằng
                    <option value="Đắk Lắk">Đắk Lắk
                    <option value="Đắk Nông">Đắk Nông
                    <option value="Điện Biên">Điện Biên
                    <option value="Đồng Nai">Đồng Nai
                    <option value="Đồng Tháp">Đồng Tháp
                    <!-- <option value="Đồng Tháp">Đồng Tháp -->
                    <option value="Gia Lai">Gia Lai
                    <option value="Hà Giang">Hà Giang
                    <option value="Hà Nam">Hà Nam
                    <option value="Hà Tĩnh">Hà Tĩnh
                    <option value="Hải Dương">Hải Dương
                    <option value="Hậu Giang">Hậu Giang
                    <option value="Hòa Bình">Hòa Bình
                    <option value="Hưng Yên">Hưng Yên
                    <option value="Khánh Hòa">Khánh Hòa
                    <option value="Kiên Giang">Kiên Giang
                    <option value="Kon Tum">Kon Tum
                    <option value="Lai Châu">Lai Châu
                    <option value="Lâm Đồng">Lâm Đồng
                    <option value="Lạng Sơn">Lạng Sơn
                    <option value="Lào Cai">Lào Cai
                    <option value="Long An">Long An
                    <option value="Nam Định">Nam Định
                    <option value="Nghệ An">Nghệ An
                    <option value="Ninh Bình">Ninh Bình
                    <option value="Ninh Thuận">Ninh Thuận
                    <option value="Phú Thọ">Phú Thọ
                    <option value="Quảng Bình">Quảng Bình
                    <option value="Quảng Nam">Quảng Nam
                    <option value="Quảng Ngãi">Quảng Ngãi
                    <option value="Quảng Ninh">Quảng Ninh
                    <option value="Quảng Trị">Quảng Trị
                    <option value="Sóc Trăng">Sóc Trăng
                    <option value="Sơn La">Sơn La
                    <option value="Tây Ninh">Tây Ninh
                    <option value="Thái Bình">Thái Bình
                    <option value="Thái Nguyên">Thái Nguyên
                    <option value="Thanh Hóa">Thanh Hóa
                    <option value="Thừa Thiên Huế">Thừa Thiên Huế
                    <option value="Tiền Giang">Tiền Giang
                    <option value="Trà Vinh">Trà Vinh
                    <option value="Tuyên Quang">Tuyên Quang
                    <option value="Vĩnh Long">Vĩnh Long
                    <option value="Vĩnh Phúc">Vĩnh Phúc
                    <option value="Yên Bái">Yên Bái
                    <option value="Phú Yên">Phú Yên
                    <option value="Tp.Cần Thơ">Tp.Cần Thơ
                    <option value="Tp.Đà Nẵng">Tp.Đà Nẵng
                    <option value="Tp.Hải Phòng">Tp.Hải Phòng
                    <option value="Tp.Hà Nội">Tp.Hà Nội
                    <option value="TP  HCM">TP HCM
                  </select>
                </div>
              </div>

              <div class="row mb-5">
                <div class="col-md-12 form-group mb-3">
                  <label for="" class="col-form-label">Địa chỉ *</label>
                  <input type="text" class="form-control" name="note" id="email"  placeholder="Nhập địa chỉ">
                  
                </div>
              </div>

              <label id="name-error" class="error"><?= $err ?></label>
                
              
              <div class="row justify-content-center">
                <div class="col-md-5 form-group text-center">
                  <input type="submit" value="Đặt hàng" name="dat_hang" class="btn btn-block btn-primary rounded-0 py-2 px-4">
                  <span class="submitting"></span>
                </div>
              </div>
            </form>

            

          </div>
        </div>
      </div>
    </div>



   <!-- End Form -->

   <?php } ?>
    <!-- Optional JavaScript -->
    <!-- Popper.js first, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
  </body>
</html>