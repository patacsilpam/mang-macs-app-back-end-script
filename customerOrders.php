<?php

require 'database/connection.php';
$orderId;
$customer_id = $_POST['customerID'];
$customerIDS;
$productCode = $_POST['productCode'];//array
$orderDate = $_POST['orderDate'];
$requiredDate = $_POST['requiredDate'];
$requiredTime = $_POST['requiredTime'];
$customerName = $_POST['customerName'];
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
$imgProduct= $_POST['imgProduct'];//array
$orderType = $_POST['orderType'];
$orderStatus = $_POST['orderStatus'];
$response = array();
$ids = "#".substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 15);
//
$getCode = $connect->prepare("SELECT customer_id FROM tbladdress WHERE email=?");
$getCode->bind_param('s',$email);
$getCode->execute();
$getCode->store_result();
$getCode->bind_result($id);
$getCode->fetch();
$customerIDS = $id;
foreach($productCode as $index => $id){
    $productCodeList = $id;
    $productList = $product[$index];
    $variationList = $variation[$index];
    $quantityList = $quantity[$index];
    $addOnsList = $add_ons[$index];
    $priceList = $price[$index];
    $subTotalList = $subTotal[$index];
    $imgProductList = $imgProduct[$index];
    $insertOrderDetails = $connect->prepare("INSERT INTO tblorderdetails(id,customer_id,product_code,order_id,email,product_name,product_variation,quantity,price,add_ons,product_image,order_type,order_status) 
    VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $insertOrderDetails->bind_param('issssssiissss',$orderId,$customerIDS,$productCodeList,$ids,$email,$productList,$variationList,$quantityList,$priceList,$addOnsList,$imgProductList,$orderType,$orderStatus);
    $insertOrderDetails->execute();
    if($insertOrderDetails)
        $response['success'] = "1";
        $cartStatus = "ordered";
        $updateCart = $connect->prepare("UPDATE cart SET cart_status=? WHERE email=?");
        $updateCart->bind_param('ss',$cartStatus,$email);
        $updateCart->execute();
        echo json_encode($response);
}
$insertCustomerOrder = $connect->prepare("INSERT INTO tblcustomerorder(id,customer_id,order_id,created_at,required_date,required_time,customer_name,customer_address,label_address,email,phone_number,total_amount,payment_photo) 
VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");
echo $connect->error;
$insertCustomerOrder->bind_param('issssssssssis',$orderId,$customerIDS,$ids,$orderDate,$requiredDate,$requiredTime,$customerName,$address,$labelAddreess,$email,$phoneNumber,$totalAmount,$paymentPhoto);
$insertCustomerOrder->execute();
?>