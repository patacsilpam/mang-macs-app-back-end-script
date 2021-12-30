<?php
require_once 'database/connection.php';
$imageFile = $_POST['image'];
$email = $_POST['emailAddress'];
$imageURL = "http://192.168.1.7/Mang-Macs-Mobile-App/uploadImage.php";
$uploadImage = $connect->prepare("UPDATE tblcustomers SET customer_image=? WHERE email_address=?");
$uploadImage->bind_param('ss',$imageURL,$email);
$uploadImage->execute();
$response = array();
if($uploadImage){
    $response['success'] = "1";
}
else{
    $response['success'] = "0";
    $response['message'] = "Error"; 
}
echo json_encode($response);

?>