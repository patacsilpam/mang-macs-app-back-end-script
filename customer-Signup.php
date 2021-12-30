<?php
    error_reporting(0);
    require_once 'database/connection.php';
    $response = array();
    date_default_timezone_set('Asia/Manila');
    $id = null;
    $customer_id = bin2hex(openssl_random_pseudo_bytes(11));
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email_address'];
    $password = $_POST['user_password'];
    $pwordHash = password_hash($password, PASSWORD_DEFAULT);
    $gender = "Male";
    $birthdate = "not set";
    $province = "not set";
    $municipality = "not set";
    $house_no = "not set";
    $streetName = "not set";
    $profileImage = "not set";
    $createdAt = date('y-m-d');
    $status = "not verified";
    $vercode = $_POST['code'];
    //check email if already exists
    $select = $connect->prepare("SELECT * FROM tblcustomers WHERE email_address=?");
    $select->bind_param('s',$email);
    $select->execute();
    $rows = $select->get_result();
    $fetchUser = $rows->fetch_array();
    echo $connect->error;
    if($rows->num_rows == 1){
      if($email == $fetchUser['email_address']){
        $response['success'] = "2";
        $response['message'] = "Email already exists";
      }
    }
    //insert
    else{
        $insertCustomer = $connect->prepare("INSERT INTO tblcustomers(`id`,`customer_id`,`fname`,`lname`,`email_address`,`user_password`,`gender`,`birthdate`,`customer_image`,`created_account`,`user_status`,`code`)
        VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
        echo $connect->error;
       $insertCustomer->bind_param('issssssssssi',$id,$customer_id,$fname,$lname,$email,$pwordHash,$gender,$birthdate,$profileImage,$createdAt,$status,$vercode);
        $insertCustomer->execute();
        if($insertCustomer){
            $response['success'] = "1";
        }
        else{
            $response['success'] = "0";
            $response['message'] = "Error";
        }
    }
    echo json_encode($response);
?>