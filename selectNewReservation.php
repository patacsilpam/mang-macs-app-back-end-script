<?php
require 'database/connection.php';
$emailAddress = mysqli_real_escape_string($connect,$_GET['emailAddress']);
$selectNewOrders = $connect->query("SELECT * FROM tblreservation WHERE remove_status='Not Removed' HAVING email='$emailAddress'");
$response = array();
while($fetch = $selectNewOrders->fetch_assoc()){
    $response[] = $fetch;

}
echo json_encode($response);
?>