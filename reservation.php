<?php
    error_reporting(0);
    require_once 'database/connection.php';
    date_default_timezone_set('Asia/Manila');
    $id = null;
    $customerId = "";
    $token = $_POST['token'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $guests = $_POST['guests'];
    $email = $_POST['email'];
    $dateCode = date('Ymd');
    $refNumber = $dateCode.bin2hex(openssl_random_pseudo_bytes(5));
    $created_at = date('y-m-d h:i s');
    $scheduled_date = $_POST['scheduled_date'];
    $scheduled_time = $_POST['scheduled_time'];
    $phoneNumber = $_POST['phoneNumber'];
    $status = "Pending";
    $notifDate = date('y-m-d h:i:s');
    $remove = 'Not Removed';
    //get the customer id
    $getCustomerID = $connect->prepare("SELECT customer_id FROM tblcustomers WHERE email_address=?");
    $getCustomerID->bind_param('s',$email);
    $getCustomerID->execute();
    $getCustomerID->store_result();
    $getCustomerID->bind_result($ids);
    $getCustomerID->fetch();
    $customerId = $ids;
    //insert
    $reservation = $connect->prepare("INSERT INTO tblreservation(id,token,customer_id,refNumber,fname,lname,guests,email,phone_number,created_at,scheduled_date,scheduled_time,status,notif_date,remove_status)
    VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $reservation->bind_param('isssssissssssss',$id,$token,$customerId,$refNumber,$fname,$lname,$guests,$email,$phoneNumber,$created_at,$scheduled_date,$scheduled_time,$status,$notifDate,$remove);
    $reservation->execute();
    if($reservation){
        $response = array();
        $response['success'] = "1";
        $response['message'] = "Success";
    }
    echo json_encode($response);
?>