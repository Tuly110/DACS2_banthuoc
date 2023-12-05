<?php
    $database = 'doan';
    $user='root';
    $pass='';
    $server = 'localhost';
    $conn = new mysqli($server, $user, $pass, $database);
    if($conn)
    {
        mysqli_query($conn, "SET NAMES 'utf8'");
        // echo 'connect';
    }
    else{
        echo 'disconect';
    }
?>