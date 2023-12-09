<?php
    session_start();
    include "../connect.php";
    $user = !empty($_SESSION['user']) ? $_SESSION['user'] :'';
    if(empty($_SESSION["cart"]))
    {
        $_SESSION["cart"]= array();
        // echo "a";exit;
    }
    $GLOBALS['change_quantity'] =false;
    function update($conn,$add=false)
    {
        
        foreach($_POST["quantity"] as $id => $quantity)
        {
            if($quantity < 1)
            {
                unset($_SESSION["cart"][$id]);
            }
            else
            {
                if(!isset($_SESSION["cart"][$id]))
                {
                    $_SESSION["cart"][$id]=0;
                }   
                if($add)
                {
                    $_SESSION["cart"][$id] += $quantity;
                }
                else
                {
                    $_SESSION["cart"][$id] = $quantity;
                }
                // Kiểm tra số lượng mua hàng với số lượng tồn kho, nếu SL mua lớn hơn SL tồn kho thì sẽ tự động giảm về SL còn trong kho
                $request_sl = mysqli_query($conn,"SELECT `SL` FROM `sanpham` WHERE `ID`=".$id);
                $request_sl = mysqli_fetch_assoc($request_sl);
                if($_SESSION["cart"][$id] > $request_sl['SL'] )
                {
                    $_SESSION["cart"][$id]=$request_sl['SL'];
                    $GLOBALS['change_quantity'] = true;
                }
            }
        }
    }
    if(isset($_SESSION['user']))
    {
        if(isset($_GET['action']))
        {
    
            switch($_GET['action'])
            {  
                case "add":
                    update($conn,true);
                    if( $GLOBALS['change_quantity'] == false ){
                    header("location:cart.php");}
                    break;
                case "delete":
                    if(isset($_GET['id']))
                    {
                        unset($_SESSION["cart"][$_GET['id']]);
                        header("location:cart.php");
                    }
                    break;
                case "submit":
                    // cập nhật
                    if(isset($_POST["update"] ))
                    {
                        update($conn);
                        // echo "ọ"; exit();
                        header("location:cart.php");
                    }
                    // Mua hàng
                    else if(isset($_POST["buy"]) )
                    {
                        if(empty($_SESSION["cart"]))
                        {
                            header("location:../index.php");
                        }
                        else
                        {
                            header("location:info_dh.php");
                        }
                        
                    }
                    break;
            }
        }
    }else
    {
        header("location:../login.php");
    }
    

    if(!empty($_SESSION["cart"]))
    {
        $kq= mysqli_query($conn,"SELECT * FROM `sanpham` WHERE `ID` IN (".implode(",", array_keys($_SESSION['cart'])).")");
    }
    
?>
<a href="../login.php"></a>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">

    <title>Giỏ hàng của bạn</title>
  </head>
  <style>
    .container{
            margin-top: 10px;
            /* border: 1px solid #012970; */      
            font-family:Cambria;
            background: #f6f3ff;
            /* max-width: 750px; */
        }
    .cart {
        padding: 5px;
        box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.12);
        background-color: white;
        margin: 5px;
    }
    .btn{
        text-align: center;
        padding: 5px;
        margin: 5px;
        border: none;
        box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.12);
        border-radius: 12px; 
        cursor: pointer;
        } 

    .btn:hover{
        color: white;
        background-color:#37517e ;

    }
    .ui-w-40 {
    width: 40px !important;
    height: auto;
}

.card{
    box-shadow: 0 1px 15px 1px rgba(52,40,104,.08);    
}

.ui-product-color {
    display: inline-block;
    overflow: hidden;
    margin: .144em;
    width: .875rem;
    height: .875rem;
    border-radius: 10rem;
    -webkit-box-shadow: 0 0 0 1px rgba(0,0,0,0.15) inset;
    box-shadow: 0 0 0 1px rgba(0,0,0,0.15) inset;
    vertical-align: middle;
}
a{
    text-decoration: none;
}
.media-body a#TenSP{
    color:black !important;
    word-wrap: break-word;      
    white-space: -moz-pre-wrap; 
    white-space: pre-wrap;
}
.media-body a#TenSP:hover{
    color:#37517e !important;
}
    
</style>
<body class="container">
    
    <?php if( $GLOBALS['change_quantity'] ){?>
        <h3>Sản phẩm bạn muốn mua vượt quá số lượng sản phẩm chúng tôi hiện có. Vui lòng <a href="../cart/cart.php">tải lại</a> giở hàng</h3>
    <?php }else { ?>
    <hr>
    <form action="cart.php?action=submit" method="POST">
    <div class="container px-3 my-5 clearfix">
        <div class="card">
            <div class="card-header">
                <h2>Giỏ hàng của bạn</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">

                    <table class="table table-hover  m-0">
                        <thead>
                            <tr>
                                <th class="text-center align-middle py-3 px-0" style="width: 2em;">STT</th>
                                <th class="text-center py-3 px-4" style="min-width: 400px;">Thông tin sản phẩm</th>
                                <th class="text-right py-3 px-4" style="width: 10em;">Giá</th>
                                <th class="text-center align-middle py-3 px-0" style="width: 8em;">Số lượng</th>
                                <th class="text-right py-3 px-4" style="width: 14em;">Thành tiền</th>
                                <th class="text-center align-middle py-3 px-0" style="width: 2em;"><a href="#" class="shop-tooltip float-none text-light" title data-original-title="Clear cart"><i class="ino ion-md-trash"></i></a></th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <?php
                                                $num=1;
                                                $total=0;
                                                if(isset($kq))
                                                {
                                                while($row=mysqli_fetch_array($kq)){ 
                                                $total= $total+intval($row["Gia"]) * intval($_SESSION["cart"][$row['ID']]) ;
                            ?>
                            <td class="p-4 align-items-center"><?= $num++; ?></td>
                            <td class="p-4">
                            <div class="media align-items-center">
                            <img src="../IMG/SP/<?= $row['Hinh_Anh'] ?>" class="d-block ui-w-40 ui-bordered mr-4" alt>
                            <div class="media-body">
                            <a href="http://localhost/DoAnCS2/medicine/view/details.php?idsp_details=<?= $row['ID'] ?>" class="d-block text-dark" id="TenSP"><?= $row['Ten_SP'] ?></a>
                            
                            </div>
                            </div>
                            </td>
                            <td class="text-right font-weight-semibold align-middle p-4"><?= number_format($row["Gia"], 0, ",", ".") ?>.000 VND </td>
                            <td class="align-middle align-items-center p-4"><input style="width: 40px;" value="<?= $_SESSION["cart"][$row['ID']]  ?>" type="number" name="quantity[<?= $row['ID']?>]"></td>
                            <td class="text-right font-weight-semibold align-middle p-4"><?= number_format($row["Gia"] *$_SESSION["cart"][$row['ID']], 0, ",", ".")?>.000 VND</td>
                            <td class="text-center align-middle px-0"><a href="cart.php?action=delete&id=<?= $row['ID'] ?>" class="shop-tooltip close float-none text-danger" title data-original-title="Remove">×</a></td>
                        </tr>
                        
                        <?php  }
                                } ?>    
                        </tbody>
                        <tfoot>
                        <tr style="text-align: right;">
                                                <td colspan="6" ><input class="btn p-2 m-1" type="submit" name="update" value="Cập nhật"></td>
                        </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="d-flex flex-wrap justify-content-between align-items-center pb-4">  
                    <div class="mt-4">
                        <label class="text-muted font-weight-normal">Mã giảm giá</label>
                        <input type="text" placeholder="Nhập mã giảm giá" class="form-control">
                    </div>
                <div class="d-flex">

                <div class="text-right mt-4">
                <label class="text-muted font-weight-normal m-0">Tổng tiền</label>
                <div class="text-large"><strong><?= number_format($total, 0, ",", ".") ?>.000 VND</strong></div>
                </div>
                </div>
                </div>
                <div class="float-right">
                    <a href="../index.php">
                        <button type="button" class="btn">&leftarrow; Trở lại</button>
                    </a>

                <!-- <button type="button" class="btn btn-lg btn-primary mt-2">Thanh toán</button> -->
                <input class="btn" name="buy" type="submit" value="Mua ngay">
                </div>
            </div>
        </div>
    </div>

</form> 
<?php } ?>
    <!-- Optional JavaScript -->
    <!-- Popper.js first, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
</body>
</html>