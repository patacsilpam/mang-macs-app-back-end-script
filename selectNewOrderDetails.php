<?php
require 'database/connection.php';
$email = $_GET['email_address'];
$orderNumber = $_GET['order_number'];
$emailAddress = mysqli_real_escape_string($connect,$_GET['emailAddress']);
$selectNewOrders = $connect->query("SELECT tblcustomerorder.customer_name,tblcustomerorder.customer_address,
tblcustomerorder.label_address,tblcustomerorder.email,tblcustomerorder.phone_number,
tblcustomerorder.total_amount,tblcustomerorder.payment_photo,
tblorderdetails.order_number,tblorderdetails.recipient_name,tblorderdetails.product_name,
tblorderdetails.product_variation,tblorderdetails.quantity,tblorderdetails.price,
tblorderdetails.add_ons,tblorderdetails.product_image,tblorderdetails.order_type,
tblorderdetails.order_status
FROM tblcustomerorder LEFT JOIN tblorderdetails
ON tblcustomerorder.order_number = tblorderdetails.order_number
WHERE tblorderdetails.order_number = '$orderNumber' AND tblorderdetails.email = '$email'");
$response = array();
while($fetch = $selectNewOrders->fetch_assoc()){
    $response[] = $fetch;
}
echo json_encode($response);
?>