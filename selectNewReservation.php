<?php
require 'database/connection.php';
date_default_timezone_set("Asia/Manila");
$time = date('h:i a');
$emailAddress = mysqli_real_escape_string($connect,$_GET['emailAddress']);
$selectNewOrders = $connect->query("SELECT * FROM tblreservation WHERE scheduled_date >= CURDATE() AND status != 'Cancelled' HAVING email='$emailAddress'");
$response = array();
while($fetch = $selectNewOrders->fetch_assoc()){
    $response[] = $fetch;

}
echo json_encode($response);
?>