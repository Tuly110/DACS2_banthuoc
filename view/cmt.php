
<?php
    session_start();
    include "../Arsha/connect.php"; 
    $user = !empty($_SESSION['user']) ? $_SESSION['user'] :'';
    if(isset($_GET['idsp_details'])&& isset($_POST['cmt']))
    {    
        $nd = $_POST['nd'];
        $idsp_details = $_GET["idsp_details"];
        if(empty($_SESSION['user']) )
        { 
            echo json_encode(array(
                'status' => '1',
                'message'=>'Bạn chưa đăng nhập'
            ));
        }
        else if(empty($nd) || empty($idsp_details))
        {
            echo json_encode(array(
                'status' => '2',
                'message'=>'Vui lòng điền thông tin'
            )); 
        }
        else
        {
            $request = mysqli_query($conn, "INSERT INTO `cmt`( `id_user`, `id_sp`, `noidung`, `date`) 
            VALUES ('".$user['id']."','$idsp_details',' $nd ','".date("Y-m-d H:i:s")."')");
            echo json_encode(array(
                'status' => '0',
                'message'=>'Success' 
            ));     
        }
            

    }
?>