<?php
    error_reporting(0);
    require 'database/connection.php';
    $getProduct = $connect->query("SELECT tblproducts.productName,tblproducts.productCategory,tblproducts.preparationTime,
    tblproducts.productImage,tblproducts.price,tblproducts.mainIngredients,tblproducts.stocks,tblproducts.code,
   	(SELECT GROUP_CONCAT(tbladdons.add_ons ORDER BY tbladdons.id ASC SEPARATOR ',') 
     FROM tbladdons  WHERE tbladdons.add_ons_category='Sizzling Plates') as 'add_ons',
     (SELECT GROUP_CONCAT(tbladdons.add_ons_price ORDER BY tbladdons.id ASC SEPARATOR ',') 
     FROM tbladdons  WHERE tbladdons.add_ons_category='Sizzling Plates') as 'add_ons_price'
    FROM `tbladdons` RIGHT JOIN tblproducts
    On tblproducts.productCategory = tbladdons.add_ons_category
    WHERE tblproducts.productCategory='Sizzling Plates'");
    $data = array();
    while($fetch = $getProduct->fetch_array()){
        $data[] = $fetch;
    }
    echo json_encode($data);
?>