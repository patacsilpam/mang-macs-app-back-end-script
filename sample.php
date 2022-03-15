<?php
    require 'database/connection.php';
    $id = array("");
    $customerId = ["a5d6s29403"];
    $fullname = ["Harold Patacsil"];
    $email = ["harold@gmail.com"];
    $street = ["Zone 4"];
    $barangay = ["D. Alarcio"];
    $city = ["Laoac"];
    $province = ["Pangasinan","Pangasinan"];
    $labelAddress = ["Office"];
    $phoneNumber = ["093059444356"];
    foreach($id as $index => $code){
            $newId = $code;
            $newCustomerId = $customerId[$index];
            $newFullname = $fullname[$index];
            $newEmail = $email[$index];
            $newStreet = $street[$index];
            $newBrgy = $barangay[$index];
            $newCity = $city[$index];
            $newProvince = $province[$index];
            $newLabelAddress = $labelAddress[$index];
            $newPhoneNumber = $phoneNumber[$index];
            $insert = $connect->prepare("INSERT INTO tbladdress (id,customer_id,fullname,email,street,barangay,city,province,label_address,phone_no) VALUES(?,?,?,?,?,?,?,?,?,?)");
            $insert->bind_param('isssssssss',$newId,$newCustomerId,$newFullname,$newEmail,$newStreet,$newBrgy,$newCity,$newProvince,$newLabelAddress,$newPhoneNumber);
            $insert->execute();
            if($insert){
                echo "Inserted";
            }
    }
   /*require 'database/connection.php';
   $arrays = array(
       "0" => array('','a5d6s29403','Pamela Patacsil','patacsil@gmail.com','Zone 4','D.Alarcio','Laoac','Pangasinan','Home','09174371664')
   );
   foreach($arrays as $row => $value){
       $id = $value[0];
       $customerId = $value[1];
       $fullname = $value[2];
       $email = $value[3];
       $street = $value[4];
       $brgy = $value[5];
       $city = $value[6];
       $province = $value[7];
       $labelAddress = $value[8];
       $phoneNumber = $value[9];
       $insert = $connect->prepare("INSERT INTO tbladdress (id,customer_id,fullname,email,street,barangay,city,province,label_address,phone_no) VALUES(?,?,?,?,?,?,?,?,?,?)");
       $insert->bind_param('isssssssss',$id,$customerId,$fullname,$email,$street,$brgy,$city,$province,$labelAddress,$phoneNumber);
       $insert->execute();
       if($insert){
           echo "Inserted";
       }
   }*/
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
  
</table>
</div>
</body>
</html>