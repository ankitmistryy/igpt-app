<?php
//require database
require_once('db.php');

//getting user values
$mobile=$_POST['mobile'];
$password=$_POST['password'];
$query = "SELECT * FROM users  where contact_no='$mobile'";
$result = mysqli_query($conn,$query);

if (mysqli_num_rows($result) > 0) {
    // AND password='$password'
    
    $queryIn = "SELECT * FROM users  where contact_no='$mobile' AND password='$password'";
    $resultIn = mysqli_query($conn,$queryIn);
    
   // print_r($resultIn);
    if (mysqli_num_rows($resultIn) > 0) {
        $row1 = mysqli_fetch_assoc($resultIn);
        $resposne['error']=false;
        $resposne['message']="Login success";
        $resposne["data"]=$row1;
        header('Content-Type: application/json');
        echo json_encode($resposne);
    }else{
        $resposne['error']=true;
        $resposne['message']="Please enter valid password";
        header('Content-Type: application/json');
        echo json_encode($resposne);
     }
} 
else{
    $resposne['error']=true;
    $resposne['message']="Contact number is not registerd.";
    header('Content-Type: application/json');
    echo json_encode($resposne);
 }


 
?>
