<?php
//require database
require_once('db.php');
header('Content-Type: application/json');
//getting user values
$mobile=$_POST['mobile'];
$query = "SELECT * FROM users  where contact_no='$mobile'";
$result = mysqli_query($conn,$query);

if (mysqli_num_rows($result) > 0) {
     
    $resposne['error']=false;
    $resposne['message']="User found";
    $resposne["isExist"]=true;
    header('Content-Type: application/json');
    echo json_encode($resposne);
} 
else{
    $resposne['error']=true;
    $resposne['message']="User not found";
    header('Content-Type: application/json');
    echo json_encode($resposne);
 }
?>
