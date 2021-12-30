<?php
    error_reporting(0);
    require 'database/connection.php';
    $getProduct = $connect->query("SELECT * FROM `tblproducts` WHERE productName='Cheesy Pepperoni' OR productName ='Bihon Guisado' 
    OR productName='Beef with mushroom Pizza' OR productName='Mang Macs Overload Pizza' GROUP BY productName");
    $data = array();
    while($fetch = $getProduct->fetch_array()){
        $data[] = $fetch;
    }
    echo json_encode($data);

?>