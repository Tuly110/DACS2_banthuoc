<?php
    include "../connect.php";
   
    if(empty($GET['id_dm1']))
    {
        $id_dm1 = $_GET['id_dm1'];
        $delete_dm = mysqli_query($conn, "DELETE FROM `danhmuc` WHERE `ID`=".$id_dm1);
        // echo json_encode(array(
        //     'status' => '0',
        //     'message'=>'Delete success' 
        // ));
        header("location:ds_danhmuc.php?delete=1");
    }

?>



