<?php
include("../connect.php");
    if(!empty($_GET['idsp1']))
    {
        $idsp1= $_GET['idsp1'];
        $delete_sp = mysqli_query($conn, "DELETE FROM `sanpham` WHERE `ID`=".$idsp1);
        header("location:ds_danhmuc.php?delete=2");
    }
?>