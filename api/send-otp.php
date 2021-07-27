<?php
    if(isset($_POST['phoneNumber'])){
        session_start();
        $_SESSION['otp'] = "12345";
        $response['status'] = true;
        echo json_encode($response);
    }else{
        $response['status'] = false;
        echo json_encode($response);
    }


?>