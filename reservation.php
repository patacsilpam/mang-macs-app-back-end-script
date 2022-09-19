<?php
   
    require_once 'database/connection.php';
    date_default_timezone_set('Asia/Manila');
    //insert reservation
    $id = null;
    $customerId = $_POST['customerId'];
    $token = $_POST['token'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $guests = $_POST['guests'];
    $email = $_POST['email'];
    $dateCode = date('Ymd');
    $orderNumber = $dateCode.bin2hex(openssl_random_pseudo_bytes(5));
    $created_at = date('y-m-d h:i s');
    $scheduled_date = $_POST['scheduled_date'];
    $scheduled_time = $_POST['scheduled_time'];
    $paymentPhoto = $_POST['paymentPhoto'];
    $totalAmount = $_POST['totalAmount'];
    $status = "Pending";
    $notifDate = date('y-m-d h:i:s');
    $remove = 'Not Removed';
    $response = array();
    //insert
    $reservation = $connect->prepare("INSERT INTO tblreservation(id,token,customer_id,refNumber,fname,lname,guests,email,created_at,scheduled_date,scheduled_time,status,totalAmount,payment_photo)
    VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $reservation->bind_param('isssssisssssis',$id,$token,$customerId,$orderNumber,$fname,$lname,$guests,$email,$created_at,$scheduled_date,$scheduled_time,$status,$totalAmount,$paymentPhoto);
    $reservation->execute();
    if($reservation){
        $response['success'] = "1";
        $response['message'] = "Success";
    }
    echo json_encode($response);
    //insert order details
    $ids = "#".substr(str_shuffle("0123456789ABCDEFGHIJKLmnopqrstvwxyz"), 0, 14);
    $token = $_POST['token'];
    $productCode = $_POST['productCode'];//array
    $orderDate = date('y-m-d');
    $recipientName = "";
    $accountName = $fname + " " + $lname;
    $product = $_POST['product'];//array
    $category = $_POST['productCategory'];//array
    $variation = $_POST['variation'];//array
    $quantity = $_POST['quantity'];//array
    $add_ons = $_POST['addOns'];//array
    $addOnsFee = $_POST['addOnsFee'];//array
    $specialRequest = $_POST['specialRequest'];//array
    $price = $_POST['price'];//array
    $subTotal =  $_POST['subTotal'];//array
    $totalAmount = $_POST['totalAmount'];
    $paymentType = $_POST['paymentType'];
    $imgProduct= $_POST['imgProduct'];//array
    $preparationTime = $_POST['preparationTime'];//array
    $orderType = $_POST['orderType'];
    $orderStatus = $_POST['orderStatus'];
    $notifDate = date('y-m-d h:i');
    $completedTime = "";
    $response = array();
    foreach($productCode as $index => $code){
        $productCodeList = $code;
        $productList = $product[$index];
        $categoryList = $category[$index];
        $variationList = $variation[$index];
        $quantityList = $quantity[$index];
        $addOnsList = $add_ons[$index];
        $addOnsFeeList = $addOnsFee[$index];
        $specialReqList = $specialRequest[$index];
        $priceList = $price[$index];
        $subTotalList = $subTotal[$index];
        $imgProductList = $imgProduct[$index];
        $preparationTimeList = $preparationTime[$index];
        $insertOrderDetails = $connect->prepare("INSERT INTO tblorderdetails(id,order_number,customer_id,recipient_name,product_code,order_id,email,product_name,product_category,product_variation,quantity,price,add_ons,add_ons_fee,special_request,product_image,order_type,order_status,created_at,required_date,required_time,completed_time,notif_date,preparation_time) 
        VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $insertOrderDetails->bind_param('isssssssssiisissssssssss',$orderId,$orderNumber,$customerId,$recipientName,$productCodeList,$ids,$email,$productList,$categoryList,$variationList,$quantityList,$priceList,$addOnsList,$addOnsFeeList,$specialReqList,$imgProductList,$orderType,$orderStatus,$orderDate,$scheduled_date,$scheduled_time,$completedTime,$notifDate,$preparationTimeList);
        $insertOrderDetails->execute();
        if($insertOrderDetails){
            $response['success'] = "1";
            $cartStatus = "Ordered";
            $updateCart = $connect->prepare("UPDATE cart SET cart_status=? WHERE email=?");
            $updateCart->bind_param('ss',$cartStatus,$email);
            $updateCart->execute();
            echo json_encode($response);
        }
    }
?>