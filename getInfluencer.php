<?php
//require database
require_once('db.php');
header('Content-Type: application/json');
$userIdFromApp = $_POST['userid'];
$query = "SELECT * FROM users where is_active='1'";
$result = mysqli_query($conn,$query);

if (mysqli_num_rows($result) > 0) {
  
    $count= 0 ;
    while($row = mysqli_fetch_assoc($result)){
        $userId=$row['id'];
        if($userId != $userIdFromApp){
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
            


            $queryPrice = "SELECT * FROM influencer_price_details where user_id='$userId'";
            $queryPriceResult = mysqli_query($conn,$queryPrice);
          
            if (mysqli_num_rows($queryPriceResult) > 0) {
                while($rowPrice = mysqli_fetch_assoc($queryPriceResult)){
                    $row['pricing'][]=$rowPrice;
                }
               
                //print_r($pageResult);
            }
            



            if($canAdd)
               $resposne["data"][]=$row;

            $count++;
        } 

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
