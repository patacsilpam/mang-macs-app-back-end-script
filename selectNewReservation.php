<?php
require 'database/connection.php';
date_default_timezone_set("Asia/Manila");
$time = date('h:i a');
$emailAddress = mysqli_real_escape_string($connect,$_GET['emailAddress']);
$selectNewOrders = $connect->query("SELECT id,refNumber,fname,lname,guests,email,created_at,DATE_FORMAT(scheduled_date,'%a,  %b %d, %Y') as 'scheduled_date',
scheduled_time,status,payment_photo FROM tblreservation 
WHERE STR_TO_DATE(CONCAT(scheduled_date,' ', scheduled_time),'%Y-%m-%d %h:%i %p') >= DATE_SUB(CURDATE(), INTERVAL 30 MINUTE) 
AND status != 'Cancelled' HAVING email='$emailAddress' 
ORDER BY STR_TO_DATE(CONCAT(scheduled_date,' ',scheduled_time),'%Y-%m-%d %h:%i %p') ASC,id DESC");
$response = array();
while($fetch = $selectNewOrders->fetch_assoc()){
    $response[] = $fetch;

}
echo json_encode($response);
/*
 DISTINCT(tblreservation.refNumber),tblreservation.id,tblreservation.fname,tblreservation.lname,tblreservation.guests,
tblreservation.email,tblreservation.created_at,DATE_FORMAT(tblreservation.scheduled_date,'%a,  %b %d, %Y') as 'scheduled_date',tblreservation.scheduled_time,
tblreservation.status,tblreservation.payment_photo,
tblorderdetails.product_code,tblorderdetails.product_name,tblorderdetails.product_category,tblorderdetails.product_code,
tblorderdetails.product_variation,tblorderdetails.quantity,tblorderdetails.price,tblorderdetails.add_ons,tblorderdetails.add_ons_fee,
tblorderdetails.special_request,tblorderdetails.product_image,tblorderdetails.completed_time
 */
?>
