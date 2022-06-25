<?php
//require database
require_once('db.php');
header('Content-Type: application/json');

$title=$_POST['title'];
$emailId=$_POST['emailId'];
$userid=$_POST['user_id'];
$feedback=$_POST['feedback'];



     $isError=false;
     $query = "INSERT INTO feedback (user_id,title,email_id,feedback)
     VALUES ('$userid','$title','$emailId','$feedback')";
    
     $result = mysqli_query($conn, $query);
     if(!$result){ 
        $isError=true;  
     }

     if($isError){
        $resposne['error']=true;
        $resposne['message']="There is something went wrong while adding feedback";
       
        echo json_encode($resposne);
     }else{
        $resposne['error']=false;
        $resposne['message']="Your feedback added successfully";
        echo json_encode($resposne);
    }
