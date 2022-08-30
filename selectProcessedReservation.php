<?php
require 'database/connection.php';
date_default_timezone_set("Asia/Manila");
$emailAddress = mysqli_real_escape_string($connect,$_GET['emailAddress']);
$time = date('h:i a');
$selectNewOrders = $connect->query("SELECT tblreservation.id,tblreservation.refNumber,tblreservation.fname,tblreservation.lname,tblreservation.guests,
tblreservation.email,tblreservation.created_at,tblreservation.scheduled_date,tblreservation.scheduled_time,
tblreservation.status,tblreservation.totalAmount,tblreservation.payment_photo,
tblorderdetails.product_code,tblorderdetails.product_name,tblorderdetails.product_category,
tblorderdetails.product_variation,tblorderdetails.quantity,tblorderdetails.price,tblorderdetails.add_ons,
tblorderdetails.product_image,tblorderdetails.completed_time 
FROM tblreservation LEFT JOIN tblorderdetails
ON tblreservation.refNumber = tblorderdetails.order_number
WHERE STR_TO_DATE(CONCAT(scheduled_date,' ', scheduled_time),'%Y-%m-%d %h:%i %p') <= DATE_SUB(CURDATE(), INTERVAL 30 MINUTE) 
OR status='Cancelled' HAVING tblreservation.email='$emailAddress'
ORDER BY STR_TO_DATE(CONCAT(scheduled_date,' ', scheduled_time),'%Y-%m-%d %h:%i %p') ASC");
$response = array();
while($fetch = $selectNewOrders->fetch_assoc()){
    $response[] = $fetch;
}
echo json_encode($response);
?>

