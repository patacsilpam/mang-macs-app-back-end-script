<?php
     error_reporting(0);
    require 'database/connection.php';
    $getProduct = $connect->query("SELECT productName,productCategory,preparationTime,productImage,price,mainIngredients,stocks,code,tbladdons.*
    FROM `tblproducts` LEFT JOIN tbladdons
    On tblproducts.productCategory = tbladdons.add_ons_category
    WHERE productCategory='Noodles' OR productCategory='Pancit'");
    $data = array();
    while($fetch = $getProduct->fetch_array()){
        $data[] = $fetch;
    }
    echo json_encode($data);
?>