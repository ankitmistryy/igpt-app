<?php
//require database
require_once('db.php');
header('Content-Type: application/json');

$userId=$_POST['userId'];
$instaProfile=$_POST['instagramApiData'];
 
$storyPrice=$_POST['storyPrice'];
$postPrice=$_POST['postPrice'];
$bothPrice=$_POST['bothPrice'];
$instagramId=$_POST['instagramId'];
$pageCategoray=$_POST['pageCategoray'];
$email=$_POST['email'];
$adminName=$_POST['adminName'];
$adminContact=$_POST['adminContact'];
$adminEmail=$_POST['adminEmail'];
$address=$_POST['address'];
$moreData=$_POST['moreData'];
//check for user exist or not          
$query = "select * from instagram_profile_details where user_id = '$userId' Limit 1";
$result = mysqli_query($conn, $query);
 
$IsUserExits=false;
if(mysqli_num_rows($result) > 0){     
    $IsUserExits= true;
    $row = mysqli_fetch_assoc($result);
   
}
if($IsUserExits){
    $resposne['error']=true;
    $resposne['message']="Your instagram page is already added";
    header('Content-Type: application/json');
    echo json_encode($resposne);
    
 }else{
     $isError=false;
     $query = "INSERT INTO instagram_profile_details
     (user_id,instagramId,page_category,gmail_id,admin_name,admin_contact,admin_email,address,post,extra_data,is_active)
     VALUES ('$userId','$instagramId','$pageCategoray','$email','$adminName','$adminContact','$adminEmail','$address','$instaProfile','$moreData','0')";
     //print_r($query);
     $result = mysqli_query($conn, $query);
     $error = mysqli_error($conn);
      print_r($error);

     if(!$result){ 
        $isError=true;  
     }

     if(!$isError){
            $query = "INSERT INTO influencer_price_details (user_id, type, price) VALUES ('$userId', 'post', '$postPrice')";
            $result = mysqli_query($conn, $query);
            if(!$result){ 
               $isError=true;  
            }

            $query = "INSERT INTO influencer_price_details (user_id, type, price) VALUES ('$userId', 'story', '$storyPrice')";
            $result = mysqli_query($conn, $query);
            if(!$result){ 
               $isError=true;  
            }
            
            $query = "INSERT INTO influencer_price_details (user_id, type, price) VALUES ('$userId', 'both', '$bothPrice')";
            $result = mysqli_query($conn, $query);
            if(!$result){ 
               $isError=true;  
            }
     }

     if($isError){
        $resposne['error']=true;
        $resposne['message']="There is something went wrong while adding your instagram page";
       
        echo json_encode($resposne);
     }else{
        $resposne['error']=false;
        $resposne['message']="Your instagram page added successfully";
         //check for user exist or not          
        $query = "select * from instagram_profile_details where user_id = '$userId' Limit 1";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            
            while($row = mysqli_fetch_assoc($result)){
                $priceQuery = "SELECT * FROM influencer_price_details where user_id='$userId'";
                $resultPrice = mysqli_query($conn, $priceQuery);
                $row['price']= mysqli_fetch_assoc($resultPrice);
            }
         } 
        echo json_encode($resposne);
   }
 }


 ?>