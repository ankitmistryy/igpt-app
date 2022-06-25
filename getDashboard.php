<?php
//require database
require_once('db.php');
header('Content-Type: application/json');

$userId = $_POST['userId'];
 
  $queryForPageDetails = "SELECT * FROM instagram_profile_details WHERE user_id = ".$userId;
  $resultIn = mysqli_query($conn,$queryForPageDetails);

  if (mysqli_num_rows($resultIn) > 0) {
            $data = mysqli_fetch_assoc($resultIn);
            if($data['post'] == ''){
                $resposne['error'] = true;
                $resposne["message"]="No profile found";   
            }else{
                $resposne['error'] = false;
                $resposne["data"]=$data;
            }
  }else{
    $resposne['error'] = true;
    $resposne["message"]="No profile found";   
  }

    echo json_encode($resposne);


    ?>