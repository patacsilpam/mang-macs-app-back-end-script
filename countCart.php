<?php
error_reporting(E_ALL);
require 'database/connection.php';
$email = mysqli_real_escape_string($connect,$_GET["emailaddress"]);
$getProduct = $connect->query("SELECT COUNT(*) as 'totalCart' FROM cart WHERE email='$email'");
$response = array();
while($fetch = $getProduct->fetch_array()){
    $response['success'] = "1";
    $response[] = $fetch;

  
}
echo json_encode($response);
?>