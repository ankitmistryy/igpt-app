<?php
//require database
require_once('db.php');
header('Content-Type: application/json');

$title=$_POST['title'];
$budget_from=$_POST['budget_from'];
 
$budget_to=$_POST['budget_to'];
$influencer_target=$_POST['influencer_target'];
$compaign_type=$_POST['compaign_type'];
$category_id=$_POST['category_id'];
$min_followers=$_POST['min_followers'];
$max_followers=$_POST['max_followers'];
$email=$_POST['email'];
$contact_no=$_POST['contact_no'];
$sponsor_id=$_POST['sponsor_id'];

     $isError=false;
     $query = "INSERT INTO compaign (sponsor_id,title,budget_from,budget_to,influencer_target,compaign_type,category_id,min_followers,max_followers,email,contact_no)
     VALUES ('$sponsor_id','$title','$budget_from','$budget_to','$influencer_target','$compaign_type',
     '$category_id','$min_followers','$max_followers','$email','$contact_no'
     )";
    
     $result = mysqli_query($conn, $query);
     if(!$result){ 
        $isError=true;  
     }

     if($isError){
        $resposne['error']=true;
        $resposne['message']="There is something went wrong while adding compaign";
       
        echo json_encode($resposne);
     }else{
        $resposne['error']=false;
        $resposne['message']="Your compaign added successfully";
        echo json_encode($resposne);
    }
