<?php
//require database
require_once('db.php');
header('Content-Type: application/json');

$query = "SELECT * FROM feedback";
$result = mysqli_query($conn,$query);

if (mysqli_num_rows($result) > 0) {
    $resposne['error']=false;
    while($row = mysqli_fetch_assoc($result)){
            
          $resposne["data"][]=$row;
    }
    echo json_encode($resposne);
} 
else{
    $resposne['error']=true;
    $resposne['message']="No feedback found";
    echo json_encode($resposne);
 }

 ?>
