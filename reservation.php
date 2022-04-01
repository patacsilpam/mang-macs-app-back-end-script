<?php
    error_reporting(0);
    require_once 'database/connection.php';
    date_default_timezone_set('Asia/Manila');
    $id = "";
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $guests = $_POST['guests'];
    $email = $_POST['email'];
    $dateCode = date('Ymd');
    $refNumber = $dateCode.bin2hex(openssl_random_pseudo_bytes(5));
    $created_at = date('y-m-d h:i s');
    $scheduled_date = $_POST['scheduled_date'];
    $scheduled_time = $_POST['scheduled_time'];
    $status = "Pending";
    //insert
    $reservation = $connect->prepare("INSERT INTO tblreservation(id,refNumber,fname,lname,guests,email,created_at,scheduled_date,scheduled_time,status)
    VALUES(?,?,?,?,?,?,?,?,?,?)");
    $reservation->bind_param('isssisssss',$id,$refNumber,$fname,$lname,$guests,$email,$created_at,$scheduled_date,$scheduled_time,$status);
    $reservation->execute();
    if($reservation){
        $response = array();
        $response['success'] = "1";
        $response['message'] = "Success";
    }
    echo json_encode($response);
?>