<?php
    error_reporting(0);
    require 'database/connection.php';
    $getProduct = $connect->query("SELECT * FROM `tblproducts` WHERE productName='Lasagna' OR productName ='Bihon Guisado' 
    OR productName='Lomi' GROUP BY productName");
    $data = array();
    while($fetch = $getProduct->fetch_array()){
        $data[] = $fetch;
    }
    echo json_encode($data);

?>