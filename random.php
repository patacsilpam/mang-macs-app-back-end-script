<?php
$ID = bin2hex(openssl_random_pseudo_bytes(5));
echo "$ID"."<br>";
echo $ID;
?>