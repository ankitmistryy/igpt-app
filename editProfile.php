<?php
//require database
require_once('db.php');
$userId=$_POST['userId'];
//getting user values
 
 

//check for user exist or not          
 
$IsUserExits=false;


if(isset($_POST['contactNumber'])){
    $contactNumber = $_POST['contactNumber'];

    $query = "select * from users where contact_no = '$contactNumber' Limit 1";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0){     
        $IsUserExits= true;
    }
}

 
$IsEmailExits=false;
if(isset($_POST['emailId'])){
    $emailId = $_POST['emailId'];

    $query = "select * from users where email_id = '$emailId' Limit 1";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0){     
        $IsEmailExits= true;
    }
}
 $isPhoto=false;
if(isset($_FILES['photo'])){
    $isPhoto =true;

   // $name = "images/" .time().$_FILES['photo']['name'];
    // move_uploaded_file($_FILES['photo']['tmp_name'],$name );
   // echo $name;
}

 

    if(isset($_POST['name'])){
        $name = $_POST['name'];
        $query = "UPDATE users SET name='$name' WHERE id = '$userId'";
        $result = mysqli_query($conn,$query);
    }

    if(isset($_POST['contactNumber'])){
        $contactNumber = $_POST['contactNumber'];
        $query = "UPDATE users SET contact_no='$contactNumber' WHERE id = '$userId'";
        $result = mysqli_query($conn,$query);
    }

    if(isset($_POST['email'])){
        $emailId = $_POST['emailId'];
        $query = "UPDATE users SET email_id='$emailId' WHERE id = '$userId'";
        $result = mysqli_query($conn,$query);
    }

    if(isset($_FILES['photo'])){
        
        $name = "images/" .time().$_FILES['photo']['name'];
        move_uploaded_file($_FILES['photo']['tmp_name'],$name );
      //  echo $name;
        $query = "UPDATE users SET profile_pic='$name' WHERE id = '$userId'";
        $result = mysqli_query($conn,$query);
    }
    //is_active 0 for not and 1 for activated
    
    $resposne['error']=false;
    $resposne['message']="Thank you for registration.";
    header('Content-Type: application/json');
    echo json_encode($resposne); 
      
 



?>