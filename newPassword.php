<?php
//require database
require_once('db.php');
header('Content-Type: application/json');
$password = $_POST['password'];
$mobile = $_POST['mobile'];

if(mysqli_query($conn,"UPDATE users SET password='$password'  WHERE contact_no='$mobile'")){
    $output['error'] = false;
    $output['message'] = "Your Password Changed Successfully.";       
    echo json_encode($output);
}else{
    $output['error'] = true;
    $output['message'] = "There is something while changing your password";       
    echo json_encode($output);
}

?>