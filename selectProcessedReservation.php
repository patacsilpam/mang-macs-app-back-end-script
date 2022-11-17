<?php
require 'database/connection.php';
date_default_timezone_set("Asia/Manila");
$emailAddress = mysqli_real_escape_string($connect,$_GET['emailAddress']);
$time = date('h:i a');
$selectNewOrders = $connect->query("SELECT id,refNumber,fname,lname,guests,email,created_at,
DATE_FORMAT(scheduled_date,'%a,  %b %d, %Y') as 'scheduled_date',scheduled_time,status,payment_photo FROM tblreservation
WHERE STR_TO_DATE(CONCAT(scheduled_date,' ', scheduled_time),'%Y-%m-%d %h:%i %p') <= DATE_SUB(CURDATE(), INTERVAL 30 MINUTE) 
OR status='Cancelled' HAVING email='$emailAddress'
ORDER BY STR_TO_DATE(CONCAT(scheduled_date,' ', scheduled_time),'%Y-%m-%d %h:%i %p') ASC,id DESC");
$response = array();
while($fetch = $selectNewOrders->fetch_assoc()){
    $response[] = $fetch;
}
echo json_encode($response);
?>

