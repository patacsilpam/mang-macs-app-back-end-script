<?php
require 'database/connection.php';
date_default_timezone_set("Asia/Manila");
$emailAddress = mysqli_real_escape_string($connect,$_GET['emailAddress']);
$time = date('h:i a');
$selectNewOrders = $connect->query("SELECT * FROM tblreservation WHERE scheduled_date < CURDATE() OR status='Cancelled' ORDER BY created_at DESC");
$response = array();
while($fetch = $selectNewOrders->fetch_assoc()){
    $response[] = $fetch;
}
echo json_encode($response);
?>