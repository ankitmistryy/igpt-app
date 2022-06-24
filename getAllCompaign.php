<?php
//require database
require_once('db.php');
header('Content-Type: application/json');

$query = "SELECT * FROM compaign";
$result = mysqli_query($conn,$query);

if (mysqli_num_rows($result) > 0) {
    $resposne['error']=false;
    while($row = mysqli_fetch_assoc($result)){
        $userId = $row['sponsor_id'];
        $queryData = "SELECT * FROM users where id='$userId'";
        $queryResult = mysqli_query($conn,$queryData);
    
        if (mysqli_num_rows($queryResult) > 0) {
            $pageResult = mysqli_fetch_assoc($queryResult);
            
            $row['user']=$pageResult;
            //print_r($pageResult);
        }
        
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
