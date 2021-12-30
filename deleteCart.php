<?php
require_once 'database/connection.php';
$id = count($_POST['id']);
$response = array();
for($i=0; $i<$id; $i++){
    $deleteAddress = $connect->prepare("DELETE FROM cart WHERE id=?");
    $deleteAddress->bind_param('i',$id);
    $deleteAddress->execute();
    $response = array();
    if($deleteAddress){
        $response['success'] = "1";
    }
    else{
        $response['success'] = "0";
        $response['message'] = "Error";
    }
}
echo json_encode($response);
?>