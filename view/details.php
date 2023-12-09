<?php
session_start();
ob_start();
    include "../Arsha/connect.php";
    include "nav_view.php";
    $user = !empty($_SESSION['user']) ? $_SESSION['user'] :'';
    
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

#gridview {
    text-align: center;
}

div.image {
    margin: 10px;
    display: inline-block;
    position: relative;
}

div.image img {
    width: 100%;
    max-width: 300px;
    height: auto;
    border: 1px solid #ccc;
}

div.preview-image {
    float: left;
    padding: 0px 0px 20px 20px;
}

div.preview-image img {
    width: 100%;
    max-width: 450px;
    height: auto;
    border: 1px solid #ccc;
}

div.preview-image img.focused {
    border: #fbb20f 2px solid;
}

div.image img:hover {
    box-shadow: 0 5px 5px 0 rgba(0, 0, 0, 0.32), 0 0 0 0px
        rgba(0, 0, 0, 0.16);
        
}

.heading {
    padding: 10px 10px;
    margin-bottom: 10px;
    font-size: 1.2em;
}

#grid {
    margin-bottom: 30px;
}

.quick_look {
    display: none;
    position: absolute;
    bottom: 20px;
    left: 50%;
    margin-left: -51px;
    background: transparent;
    border: #FFF 2px solid;
    padding: 8px 25px;
    color: #FFF;
    font-size: 14px;
    cursor: pointer;
}

.quick_look:hover {
    background: #FFF;
    color: #333;
}

.product-info {
    float: left;
    margin-left: 20px;
}

div.product-info ul {
    margin: 10px 0px;
    padding: 0;
}

div.product-info li {
    cursor: pointer;
    list-style-type: none;
    display: inline-block;
    color: #F0F0F0;
    text-shadow: 0 0 1px #666666;
    font-size: 14px;
}

div.product-info .selected {
    color: #e4a400;
    text-shadow: 0 0 5px #ffb900;
}

.product-title {
    font-size: 1.5em;
}

.product-category {
    margin: 20px 0px;
    font-size: 0.9em;
    color: #c4c4c5;
    text-transform: uppercase;
    border-left: #c4c4c5 3px solid;
    padding: 0px 5px 0px 5px;
    text-transform: uppercase;
}

button.btn-info {
    padding: 10px;
    margin: 20px 20px 10px 0px;
    padding: 10px 20px;
    background: #67bdf7;
    border: #60b2e8 1px solid;
    border-radius: 3px;
    color: #FFF;
}

.ui-widget-header {
    border: none !important;
    background: none !important;
}

#product-view {
    
    overflow: auto;
    display: inline-block;
    padding-top: 20px;
    margin-top: 30px;
    text-align:left;
}
div.preview-image img.thumbnail {
    border: #fbb20f 2px solid;
    width: 50px;
    margin-bottom: 10px;
    padding: 5px;
}

#thumbnail-container {
    
    width: 70px;
    float: left;
}

#preview-enlarged {
    
    float: right;
}

/* Responsive Styles */
@media screen and (min-width: 1224px) {
    div.image {
        width: 300px;
    }
}

@media screen and (min-width: 1044px) and (max-width: 1224px) {
    div.image {
        width: 250px;
    }
}

@media screen and (min-width: 845px) and (max-width: 1044px) {
    div.image {
        width: 200px;
    }
}
@media screen and (max-width: 560px) {
    #preview-enlarged {
        float: none;
    }
    #thumbnail-container {
        width: auto;
        margin-top: 10px;
    }
}
        body{
            font-family: Nunito, sans-serif;

        }
        .container{
            margin-top: 10px;
            /* border: 1px solid #012970; */      
            font-family: Nunito, sans-serif;

            background: #f6f3ff;
            max-width: 750px;
        }
        .text{
            font-family: Nunito, sans-serif;

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
            /* font-family: "Poppins", sans-serif; */
            font-family: Nunito, sans-serif;
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
        input#them{
            border: none;
            padding: 10px;
            border-radius: 10px;
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
    section#mota{
        margin-left:  5%;
        margin-right:5%;
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
    #comment{
        margin: 30px;
    }
    .comment{
    max-width: 100%;
    height: auto;
    padding: 10px;
    /* background-color: white;
    box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.12); */
    /* border-radius: 10px; */
    margin: 30px 0;

}
#commentcontainer{
    margin-left: 50px;
}
#commentcontent{
    overflow: hidden;
}
.comment h5{
    color: #67bdf7;
    font-weight: 700;
    font-size: 25px;
}

.comment .input_comments{
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: relative;
}

.comment .input_comments input[type ='text']{
    width: 100%;
    height: 50px;
    border: none;
    border-bottom: 2px solid #eee;
    /* background: #eee; */
    padding: 0 20px;
    outline: none;
    border-radius: 8px;
}

.comment .input_comments .under_coment{
    position: absolute;
    bottom: 0;
    width: 0;
    height: 2px;
    background-color: #67bdf7;
    transition: all .3s ease;
}

.comment .input_comments input[type ='text']:focus ~ .under_coment{
    width: 100%;
}

.comment .input_comments button[type ='submit']{
    border: none;
    height: 50px;
    margin: 0 5px;
    padding: 0 30px;
    font-size: 19px;
    font-weight: 500;
    color: #fff;
    background-color: #67bdf7;
    border-radius: 8px;
}

.comment .show_comments .comments_user .user_info small{
    color: darkgray;
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
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    

    <title><?php echo $product['Ten_SP'] ?></title>
    <h2><?php echo $product['Ten_SP'] ?></h2>
    <hr>
  </head>
  
        
        <!-- Template -->

        <div class="row col-12" id="product-view">  
            <div class="preview-image col-md-5 col-12">
            <div id="preview-enlarged">
            <img src="../Arsha/IMG/SP/<?php echo $product['Hinh_Anh'] ; ?>" />
            </div>
            
            <div id="thumbnail-container">
            
                <img class="thumbnail" src="../Arsha/IMG/SP/<?php echo $product['Hinh_Anh'] ; ?>" />
            
            </div>
            </div>
        
            <div class="product-info col-md-6 col-12">
                            <div class="product-title"><?php echo $product['Ten_SP'] ; ?></div>
                            <?php
                            $infor = mysqli_query($conn, "SELECT * FROM `danhmuc`,`sanpham` WHERE danhmuc.ID=sanpham.ID_Danh_Muc AND sanpham.ID=".$idsp_details) ;
                            $productcategory= mysqli_fetch_assoc( $infor);
                            ?>
                            <div class="product-category"><?php echo $productcategory['ten_dm'] ; ?>
                            
                            </div>
                            <div>Giá: <?php echo $product['Gia'] ; ?>.000 VND</div>
                            
                            <div>
                            <?php if($product['SL'] >0) { ?>
                            <form action="../Arsha/cart/cart.php?action=add" method="post">
                                <div class="add_cart d-flex justify-content-between">
                                    <div class="ton_kho text-danger">
                                        <b>Số lượng hiện có:</b> <?= $product['SL'] ?>
                                    </div>
                                    
                                </div>
                                <div>
                                    <!-- Số lượng: -->
                                    <!-- <input style="width: 40px;" type="number" name="quantity[<?= $product['ID'] ?>]" size="2"> -->
                                    <input type="hidden" name="quantity[<?= $product['ID'] ?>]" value="1">
                                </div>
                                    
                                
                                <div class="mt-2">
                                    
                                    <div>
                                        <input class="btn-info" type="submit" name="them" id="them" value="Thêm vào giỏ hàng">
                                    </div>
                                
                                </div>
                                
                                
                            </form>
                            <?php } else { echo "<b style='color:red'>Hết hàng!</b>"; }?>
                            </div>
            </div>      
        </div>
<!-- ======= Mota Section ======= -->
        <section id="mota">
            <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 style="font-size:1.5em" class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <b>MÔ TẢ</b>
                                </button>
                                </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <?= $product['Mo_Ta'] ?>
                                </div>
                            </div>
                            </div>
                                    
                            </div>
            
        </section>
<!-- End Mota Section -->


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
            <div class="button-holder">
                <a href="../view/details.php?idsp_details=<?= $row['ID'] ?>">
                    <button type="submit" name="btn_them" id="btn_them">THÊM VÀO GIỎ HÀNG</button>
                </a>
                <!-- <a name="btn_them" id="btn_them" href="">THÊM VÀO GIỎ HÀNG</a> -->
                <!-- <button type="submit" name="btn_them" id="btn_them">THÊM VÀO GIỎ HÀNG</button> -->
            </div>
          </div>
          <?php }?>

      </div>
     
      </section><!-- End Services Section -->
    
    <div>
     <!-- Comment -->
        <div class=" col-md-8 col-12" id="comment">
        <form id="form_cmt">
            <div class="row" id="commentcontainer">
                <div class="comment text-info">
                <h2>Đánh giá sản phẩm</h2>
                <hr>
                </div>
            
                <div class="comment mt-2 col-md-6 col-12 text-info">
                    
                    <div class="comment col-12 mt-5">
                    <h5 class=" mb-4 "><i class="fa-regular fa-comment "></i> Comments</h5>
                    <input type="hidden" name="idsp_details" id="idsp_details" value="<?=$_GET['idsp_details'] ?>">
                    <div class="input_comments">
                        <input type="text" name="nd" id="nd" class="enter_comment"  placeholder="Nhập bình luận...">
                        <input type="hidden" name="cmt" id="nick_name" value="<?=!empty($user['name'] )?$user['name'] :'' ?>">
                        <!-- <input type="submit" name="cmt" id="btn_send_coment"> -->
                        <button type="submit" name="cmt" id="btn_send_coment" >Gửi</button>
                        <div class="under_coment"></div>
                    </div>
                    </div>
        <!-- </form> -->
                </div>
                <div style="margin-top: 80px !important;" class="show_comments col-md-6 col-12" id="commentcontent">
                    <?php
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
                            <p>Người dùng:<?= $row['name']?> </p>
                            <p>Nội dung:<?= $row['noidung'] ?></p>
                        </div>
                            <hr>
                    <?php 
                        }
                    ?>
            
                </div>
            
            </div>
        </form> 
        </div>
    </div>
    <!-- End Comment  -->
        
        
        
    <!-- Optional JavaScript -->
    <!-- Popper.js first, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
    <script src="../Arsha/assets/js/cmt.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- <script src="/view/assets/js/cmt.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script>
            $("#thumbnail-container img").click(function() {
                $("#thumbnail-container img").css("border", "1px solid #ccc");
                var src = $(this).attr("src");
                $("#preview-enlarged img").attr("src", src);
                $(this).css("border", "#fbb20f 2px solid");
                
            });
    </script>
</body>
</html>


