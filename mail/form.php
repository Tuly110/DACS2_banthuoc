<?php
    include "../Arsha/connect.php";
    $oder_id = $_GET['oder_id'];
    // echo  $oder_id; exit();
    $sql= "SELECT sanpham.Ten_SP, oder_details.sl, oder_details.gia , oder.tong_tien, oder.id_user 
    FROM oder 
    INNER JOIN oder_details ON oder.id = oder_details.oder_id 
    INNER JOIN sanpham ON sanpham.ID = oder_details.sp_id WHERE oder_id=".$oder_id;
    $request= mysqli_query($conn,$sql);
    
?>
<!DOCTYPE html>
<html>
<head>
    <title>Contact</title>
    <meta charset="UTF-8">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <h1>Contact</h1>
    
    <form  method="post" action="sent.php">
        <?php
            $request_nguoi_mua = mysqli_query($conn,
            "SELECT user.email, oder.name_nguoi_mua from user inner join oder on oder.id_user = user.id WHERE oder.id=".$oder_id);
            $row=mysqli_fetch_assoc($request_nguoi_mua);
        ?>
        <label for="name">Name</label>
        <input type="text" name="name" id="name" required value="<?= $row['name_nguoi_mua'] ?>">
        
        <label for="email">email</label>
        <input type="email" name="email" id="email" required value="<?= $row['email'] ?>">
        
        <label for="subject">Subject</label>
        <input style="width: 500px;" type="text" name="subject" id="subject" value="CẢM ƠN BẠN VÌ ĐÃ ĐẶT HÀNG Ở LMmedicine SHOP" required>
        
        <label for="message">Message</label>
        <textarea name="message" id="message" required>
            Đơn hàng của bạn gồm có:
            <?php  while($data = mysqli_fetch_array( $request)) 
            {
            ?>
                Sản phẩm: <?= $data['Ten_SP'] ?> 
                Số lượng: <?= $data['sl'] ?> 
                Tổng tiền: <?= $data['tong_tien'] ?>
            <?php } ?>    
        </textarea>
        
        <br>
        
        <button type="submit">Send</button>
    </form>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="../Arsha/Admin/assets/js/form_sent_email.js"></script>

</body>
</html>