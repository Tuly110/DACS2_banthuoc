<?php
    session_start();
    include "../connect.php";
    $err='';
    $GLOBALS['change_quantity'] =false;
    if(isset($_POST["dat_hang"]))
    {
        // var_dump($quality) ; exit();
        $user= isset($_SESSION['user'])?$_SESSION['user'] :'';
        if(empty($_POST['name']) || empty($_POST['sdt']) || empty($_POST['flatform']) || empty($_POST['note']))
        {
            $err = "Không được để trống";
        }
        // Xử lí lưu giỏ hàng vào DB
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
                    unset($_SESSION['cart']);
                    // header("location:../cart/pay.php");
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

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
  </head>
  <style>
    .err{
        color: red;
    }
  </style>
  <body>
    <h1>Thông tin đặt hàng</h1>
    <?php if( $GLOBALS['change_quantity'] ){?>
        <h3>Sản phẩm bạn muốn mua vượt quá số lượng sản phẩm chúng tôi hiện có. Vui lòng <a href="../cart/cart.php">tải lại</a> giở hàng</h3>
    <?php }else { ?>
   <form action="../cart/info_dh.php" method="POST">
        <table>
            <span class="err">
                <?= $err ?>
            </span>
            <tr>
                <td>Họ tên</td>
                <td class="err">
                    <input  type="text" name="name" id="">*
                </td>
            </tr>
            <tr>
                <td>Số điện thoại</td>
                <td class="err">
                    <input type="text" name="sdt" id="">*
                </td>   
            </tr>
            <tr>
                <td>Tỉnh/ Thành phố</td>
                <td>
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
                        <option value="Bình Thuận">Bình Thuận
                        <option value="Cà Mau">Cà Mau
                        <option value="Cao Bằng">Cao Bằng
                        <option value="Đắk Lắk">Đắk Lắk
                        <option value="Đắk Nông">Đắk Nông
                        <option value="Điện Biên">Điện Biên
                        <option value="Đồng Nai">Đồng Nai
                        <option value="Đồng Tháp">Đồng Tháp
                        <option value="Đồng Tháp">Đồng Tháp
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
                        <option value="Quảng Bình">Quảng Bình
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
                </td>
            </tr>
            <tr>
                <td>Ghi chú</td>
                <td class="err">
                    <input type="text" name="note" id="">*
                </td>  
            </tr>
            <tr>
                <td colspan="2">
                    <a href="../cart/pay.php"> <input type="submit" name="dat_hang" value="Đặt hàng"></a>
                   
                </td>
            </tr>
        </table>
   </form>
   <?php } ?>
    <!-- Optional JavaScript -->
    <!-- Popper.js first, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
  </body>
</html>