<?php
//require database
require_once('db.php');
header('Content-Type: application/json');

$userId = $_POST['userId'];

$query = "UPDATE users SET is_active='1' WHERE id = '$userId'";

$result = mysqli_query($conn,$query);

if ($result) {

    $resposne['error']=false;
    $resposne['message']="user is approved";


    $query = "INSERT INTO notification (user_id,message)
    VALUES ('$userId','Your instagram page is approved. Now your page will be visible to other user. Stay tune with us'
    )";
   
    $result = mysqli_query($conn, $query);
    if(!$result){ 
       $isError=true;  
    }


    echo json_encode($resposne);
} 
else{
    $resposne['error']=true;
    $resposne['message']="No influencer found";
    echo json_encode($resposne);
 }

 ?>
