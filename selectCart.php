<?php
error_reporting(E_ALL);
require 'database/connection.php';
$email = mysqli_real_escape_string($connect,$_GET["emailaddress"]);
$getProduct = $connect->query("SELECT *, 
    (SELECT SUM(price * quantity) FROM cart WHERE cart_status='not ordered' AND email='$email') as 'totalprice',
    (SELECT deliveryChange FROM tblsettings) AS 'deliveryChange' 
    FROM cart WHERE email='$email' AND cart_status='not ordered' ORDER BY id DESC");
$response = array();
while($fetch = $getProduct->fetch_array()){
    $response[] = $fetch;
  
}
echo json_encode($response);
?>