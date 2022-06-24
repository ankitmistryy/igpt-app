<?php
//require database
require_once('db.php');
header('Content-Type: application/json');

$CompaignId = $_POST['compaignId'];
$query = "SELECT * FROM compaign WHERE id = ".$CompaignId;
$result = mysqli_query($conn,$query);

if (mysqli_num_rows($result) > 0) {
    $resposne['error']=false;
    while($row = mysqli_fetch_assoc($result)){
         

        $queryForPageDetails = "SELECT post FROM instagram_profile_details WHERE user_id = ".$row['sponsor_id'];
        $resultIn = mysqli_query($conn,$queryForPageDetails);

        if (mysqli_num_rows($resultIn) > 0) {
            $data = mysqli_fetch_assoc($resultIn);
            $row['page_details']=$data;
        }
         $resposne["data"][]=$row;
    }
    echo json_encode($resposne);
} 
else{
    $resposne['error']=true;
    $resposne['message']="No data found found";
    echo json_encode($resposne);
 }

 ?>
