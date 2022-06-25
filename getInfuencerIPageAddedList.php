<?php
//require database
require_once('db.php');
header('Content-Type: application/json');
 $query = "SELECT * FROM users where is_active='0'";
$result = mysqli_query($conn,$query);

if (mysqli_num_rows($result) > 0) {
  
    $count= 0 ;
    while($row = mysqli_fetch_assoc($result)){
        $userId=$row['id'];
         
            $queryData = "SELECT * FROM instagram_profile_details where user_id='$userId'";
            $queryResult = mysqli_query($conn,$queryData);
            $canAdd=false;
            if (mysqli_num_rows($queryResult) > 0) {
                $pageResult = mysqli_fetch_assoc($queryResult);
                if($pageResult['post'] != ''){
                    $canAdd = true;
                }
                $row['page_details']=$pageResult;
                //print_r($pageResult);
            }
            

            if($canAdd)
               $resposne["data"][]=$row;

            $count++;
       

    }
  
    $resposne['error']=false;
    
    echo json_encode($resposne);
} 
else{
    $resposne['error']=true;
    $resposne['message']="No influencer found";

    echo json_encode($resposne);
 }

 ?>
