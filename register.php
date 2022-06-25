<?php
//require database
require_once('db.php');

//getting user values
$username=$_POST['name'];
$emailId=$_POST['emailId'];
$contactNumber=$_POST['contactNumber'];
$passwordF=$_POST['password'];
 
//check for user exist or not          
$query = "select * from users where contact_no = '$contactNumber' Limit 1";
$result = mysqli_query($conn, $query);
 
$IsUserExits=false;
if(mysqli_num_rows($result) > 0){     
    $IsUserExits= true;
   
}

if($IsUserExits){
   $resposne['error']=true;
   $resposne['message']="Contact number is already exist.";
   header('Content-Type: application/json');
   echo json_encode($resposne);
}else{

    //is_active 0 for not and 1 for activated
    
    $query = "INSERT INTO users (name, email_id, contact_no,password,is_active)
    VALUES ('$username', '$emailId', '$contactNumber','$passwordF',0)";
    
    $result = mysqli_query($conn, $query);
    if($result){ 
        $resposne['error']=false;
        $resposne['message']="Thank you for registration.";
        header('Content-Type: application/json');
        echo json_encode($resposne); 
    }else{
        $resposne['error']=true;
        $resposne['message']="Error occured while inserting";
        header('Content-Type: application/json');
        echo json_encode($resposne);
    }
      
}



?>