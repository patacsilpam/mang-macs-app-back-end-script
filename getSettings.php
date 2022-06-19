<?php
    error_reporting(0);
    require 'database/connection.php';
    $getProduct = $connect->query("SELECT waitingTime FROM `tblsettings` WHERE id='1'");
    $data = array();
    while($fetch = $getProduct->fetch_array()){
        $data[] = $fetch;
    }
    echo json_encode($data);
?>