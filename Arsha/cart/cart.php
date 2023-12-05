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
</style>
<body class="container">
    <h1>Giỏ hàng của bạn</h1>
    <?php if( $GLOBALS['change_quantity'] ){?>
        <h3>Sản phẩm bạn muốn mua vượt quá số lượng sản phẩm chúng tôi hiện có. Vui lòng <a href="../cart/cart.php">tải lại</a> giở hàng</h3>
    <?php }else { ?>
    <hr>
    <form action="cart.php?action=submit" method="POST">
        <div id="Chi_tiet" class="row">
            <div class="danhsach col-md-8 col-12 ">
                <div class="cart">
                    <h3>Giỏ hàng của bạn</h3>
                </div>
                <div class="cart">
                    <table class="table table-hover">
                        <tr>
                            <th>STT</th>
                            <th>Hình ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                            <th><i class="far fa-trash-alt"></i></th>
                        </tr>
                        <?php
                            $num=1;
                            $total=0;
                            if(isset($kq))
                            {
                                while($row=mysqli_fetch_array($kq)){ 
                                    $total= $total+intval($row["Gia"]) * intval($_SESSION["cart"][$row['ID']]) ;
                            ?>
                            
                            <tr>
                                <td>
                                    <?= $num++; ?>
                                </td>
                                <td>
                                    <img src="../IMG/SP/<?= $row['Hinh_Anh'] ?>" alt="" width="50px" height="50px">
                                    
                                </td>
                                <td>
                                    <?= $row['Ten_SP'] ?>
                                </td>
                                <td>
                                <?= number_format($row["Gia"], 0, ",", ".") ?> 
                                </td>
                                <!-- Lấy SL từ details sang giỏ hàng -->
                                <td>
                                    <input style="width: 40px;" value="<?= $_SESSION["cart"][$row['ID']]  ?>" type="number" name="quantity[<?= $row['ID']?>]">
                                </td>
                                <td>
                                    <?= number_format($row["Gia"] *$_SESSION["cart"][$row['ID']], 0, ",", ".")?>
                                    
                                </td>
                                <td>
                                    <a href="cart.php?action=delete&id=<?= $row['ID'] ?>">
                                        <i class="far fa-trash-alt"></i>
                                    </a>     
                                </td>
                            </tr>
                            <?php  }
                            } ?>
                        <tr style="text-align: right;">
                            <td colspan="6" ><input type="submit" name="update" value="Cập nhật"></td>
                        </tr>
                        <tr>
                            <td colspan="6"><b>Tổng tiền:</b>
                                <?= number_format($total, 0, ",", ".") ?>vnd
                            </td>
                        </tr>
                    </table>
                    
                    <br>
                    
                </div>
            </div>
            <div class="info col-md-4 col-12">
                <div class="address cart ">
                    <p>Giao đến:</p><hr>
                    <p>name</p>
                    <p>địa chỉ</p>
                </div>
                <div class="tongtien cart d-flex justify-content-between">
                    <p>Tổng tiền</p>
                    <p><?= number_format($total, 0, ",", ".") ?>vnd</p>
                </div>
                <div class="buy_now d-flex justify-content-center">
                    <input class="btn" name="buy" type="submit" value="Mua ngay">
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