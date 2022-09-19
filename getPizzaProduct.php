<?php
   //error_reporting(0);
   $data = array();
   function fetchPizzaDb(){
      require 'database/connection.php';
      $getProduct = $connect->query("SELECT productName,productCategory,preparationTime,productImage,price,mainIngredients,
		add_ons AS 'groupAddOns',add_ons_price AS 'groupAddOnsPrice',
      GROUP_CONCAT(DISTINCT(productVariation) ORDER BY tblproducts.id ASC SEPARATOR ',') AS 'productVariation',
      GROUP_CONCAT(DISTINCT(price) ORDER BY tblproducts.id SEPARATOR ',') AS 'groupPrice',
      GROUP_CONCAT(DISTINCT(code) SEPARATOR ',') AS 'groupCode',
      GROUP_CONCAT(stocks SEPARATOR ',') AS 'stocks',
      GROUP_CONCAT(preparationTime SEPARATOR ',') AS 'groupPreparationTime'
      FROM tblproducts WHERE productCategory='Pizza'
      GROUP BY productName ORDER BY id");
      //$data = array();
      while($fetch = $getProduct->fetch_array()){
         $data[] = $fetch;
      }
       echo json_encode($data);
   }
   fetchPizzaDb();
?>
