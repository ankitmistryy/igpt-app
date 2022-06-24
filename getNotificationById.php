<?php
//require database
require_once('db.php');
header('Content-Type: application/json');
 

$userId = $_POST['userId'];
$query = "SELECT * FROM notification WHERE user_id='$userId'";
$result = mysqli_query($conn,$query);

if (mysqli_num_rows($result) > 0) {
    $resposne['error']=false;
    $count= 0 ;
    while($row = mysqli_fetch_assoc($result)){
        $userId=$row['id'];
       $resposne["data"][]=$row;
    }
  
   
    
    echo json_encode($resposne);
} 
else{
    $resposne['error']=true;
    $resposne['message']="No influencer found";

    echo json_encode($resposne);
 }

 ?>
