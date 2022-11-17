<?php
require 'database/connection.php';
date_default_timezone_set('Asia/Manila');
$orderId="";
$customerIDS="";
//$customer_id = $_POST['customerID'];
$dateCode = date('Ymd');
$orderNumber = $dateCode.rand(1000,9999);
$ids = "#".substr(str_shuffle("0123456789ABCDEFGHIJKLmnopqrstvwxyz"), 0, 14);
$token = $_POST['token'];
$productCode = $_POST['productCode'];//array
$orderDate = date('y-m-d');
$requiredDate = $_POST['requiredDate'];
$requiredTime = $_POST['requiredTime'];
$accountName = $_POST['accountName'];
$recipientName = $_POST['recipientName'];
$address = $_POST['customer_address'];
$labelAddreess = $_POST['labelAddress'];
$email = $_POST['email'];
$phoneNumber = $_POST['phoneNumber'];
$product = $_POST['product'];//array
$category = $_POST['productCategory'];//array
$variation = $_POST['variation'];//array
$quantity = $_POST['quantity'];//array
$add_ons = $_POST['addOns'];//array
$addOnsFee = $_POST['addOnsFee'];//array
$specialRequest = $_POST['specialRequest'];
$price = $_POST['price'];//array
$subTotal =  $_POST['subTotal'];//array
$totalAmount = $_POST['totalAmount'];
$paymentPhoto = $_POST['paymentPhoto'];
$paymentType = $_POST['paymentType'];
$imgProduct= $_POST['imgProduct'];//array
$preparationTime = $_POST['preparationTime'];//array
$orderType = $_POST['orderType'];
$orderStatus = $_POST['orderStatus'];
$deliveryFee = $_POST['deliveryFee'];
$waitingTime = $_POST['waitingTime'];
$notifDate = date('y-m-d h:i');
$customerId = $_POST['customerId'];
$completedTime = "";
$courier = "";
$response = array();

foreach($productCode as $index => $code){
        $productCodeList = $code;
        $productList = $product[$index];
        $categoryList = $category[$index];
        $variationList = $variation[$index];
        $quantityList = $quantity[$index];
        $addOnsList = $add_ons[$index];
        $addOnsFeeList = $addOnsFee[$index];
        $specialRequestList = $specialRequest[$index];
        $priceList = $price[$index];
        $subTotalList = $subTotal[$index];
        $imgProductList = $imgProduct[$index];
        $preparationTimeList = $preparationTime[$index];
        $insertOrderDetails = $connect->prepare("INSERT INTO tblorderdetails(id,order_number,customer_id,recipient_name,product_code,order_id,email,product_name,product_category,product_variation,quantity,price,add_ons,add_ons_fee,special_request,product_image,order_type,order_status,created_at,required_date,required_time,completed_time,notif_date,preparation_time) 
        VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $insertOrderDetails->bind_param('isssssssssiisissssssssss',$orderId,$orderNumber,$customerIDS,$recipientName,$productCodeList,$ids,$email,$productList,$categoryList,$variationList,$quantityList,$priceList,$addOnsList,$addOnsFeeList,$specialRequestList,$imgProductList,$orderType,$orderStatus,$orderDate,$requiredDate,$requiredTime,$completedTime,$notifDate,$preparationTimeList);
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
    //insert user infomation
    $insertCustomerOrder = $connect->prepare("INSERT INTO tblcustomerorder(id,token,order_number,customer_id,customer_name,customer_address,label_address,email,phone_number,total_amount,payment_photo,payment_type,delivery_fee,waiting_time,courier) 
    VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
    echo $connect->error;
    $insertCustomerOrder->bind_param('issssssssisssss',$orderId,$token,$orderNumber,$customerId,$accountName,$address,$labelAddreess,$email,$phoneNumber,$totalAmount,$paymentPhoto,$paymentType,$deliveryFee,$waitingTime,$courier);
    $insertCustomerOrder->execute();
//notiy user if he selects "now" tab in pick up

if(strpos($waitingTime,"Pick Up anytime") !== false){
    if(strpos($requiredTime,"now") !== false){
        function pushNotifcation($token,$data){
            $apiKey = "AAAAozYNVDs:APA91bFDRuJDQZCnFaAmQFP_uTUUzp9fYQZRJI01XtZ34XYr1ifB2f7jDa1R7WVxavsv-hSZZ7qivrEUk37O7-s1VcB8wMJuhIW0R6-ldwv9UQnxlJssMGvEdOq7admem2vfrCkAUqo2";
            $url = "https://fcm.googleapis.com/fcm/send";
            $fields = json_encode(array('to'=>$token,'notification'=>$data));
            // Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,($fields));
        
            $headers = array();
            $headers[] = 'Authorization:key='.$apiKey;
            $headers[] = 'Content-Type: application/json';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            }
            curl_close($ch);
        }
        $data = array(
            'title'=>"Pick Up",
            'body'=>"Hello $accountName,\nyou can pick up your order anytime."
        );
        pushNotifcation($token,$data);
    } 
}
else{
}    
?>