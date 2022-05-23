<?php
require 'database/connection.php';
date_default_timezone_set('Asia/Manila');
$orderId;
$customerIDS;
//$customer_id = $_POST['customerID'];
$dateCode = date('Ymd');
$orderNumber = $dateCode.bin2hex(openssl_random_pseudo_bytes(10));
$ids = $ids = "#".substr(str_shuffle("0123456789ABCDEFGHIJKLmnopqrstvwxyz"), 0, 14);
$productCode = $_POST['productCode'];//array
$orderDate = date('y-m-d h:i:s');
$requiredDate = $_POST['requiredDate'];
$requiredTime = $_POST['requiredTime'];
$accountName = $_POST['accountName'];
$recipientName = $_POST['recipientName'];
$address = $_POST['customer_address'];
$labelAddreess = $_POST['labelAddress'];
$email = $_POST['email'];
$phoneNumber = $_POST['phoneNumber'];
$product = $_POST['product'];//array
$variation = $_POST['variation'];//array
$quantity = $_POST['quantity'];//array
$add_ons = $_POST['addOns'];//array
$price = $_POST['price'];//array
$subTotal =  $_POST['subTotal'];//array
$totalAmount = $_POST['totalAmount'];
$paymentPhoto = $_POST['paymentPhoto'];
$paymentType = $_POST['paymentType'];
$imgProduct= $_POST['imgProduct'];//array
$orderType = $_POST['orderType'];
$orderStatus = $_POST['orderStatus'];
$deliveryFee = $_POST['deliveryFee'];
$completedTime = "";
$response = array();
//get the customer id of the user
$getCode = $connect->prepare("SELECT customer_id FROM tbladdress WHERE email=?");
$getCode->bind_param('s',$email);
$getCode->execute();
$getCode->store_result();
$getCode->bind_result($id);
$getCode->fetch();
$customerIDS = $id;
//insert multiple of orders from users
foreach($productCode as $index => $code){
    $productCodeList = $code;
    $productList = $product[$index];
    $variationList = $variation[$index];
    $quantityList = $quantity[$index];
    $addOnsList = $add_ons[$index];
    $priceList = $price[$index];
    $subTotalList = $subTotal[$index];
    $imgProductList = $imgProduct[$index];
    $insertOrderDetails = $connect->prepare("INSERT INTO tblorderdetails(id,order_number,customer_id,recipient_name,product_code,order_id,email,product_name,product_variation,quantity,price,add_ons,product_image,order_type,order_status,created_at,required_date,required_time,completed_time) 
    VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $insertOrderDetails->bind_param('issssssssiissssssss',$orderId,$orderNumber,$customerIDS,$recipientName,$productCodeList,$ids,$email,$productList,$variationList,$quantityList,$priceList,$addOnsList,$imgProductList,$orderType,$orderStatus,$orderDate,$requiredDate,$requiredTime,$completedTime);
    $insertOrderDetails->execute();
    if($insertOrderDetails)
        $response['success'] = "1";
        $cartStatus = "Ordered";
        $updateCart = $connect->prepare("UPDATE cart SET cart_status=? WHERE email=?");
        $updateCart->bind_param('ss',$cartStatus,$email);
        $updateCart->execute();
        echo json_encode($response);
}
//insert user infomation
$insertCustomerOrder = $connect->prepare("INSERT INTO tblcustomerorder(id,order_number,customer_id,customer_name,customer_address,label_address,email,phone_number,total_amount,payment_photo,payment_type,delivery_fee) 
VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
echo $connect->error;
$insertCustomerOrder->bind_param('isssssssisss',$orderId,$orderNumber,$customerIDS,$accountName,$address,$labelAddreess,$email,$phoneNumber,$totalAmount,$paymentPhoto,$paymentType,$deliveryFee);
$insertCustomerOrder->execute();

?>