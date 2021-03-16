<<?php
require_once('functions.php');
if(isset($_POST['btnContactUs'])){
  if(strlen($_POST['Message'])< 10){
    $message = "Message must be greater than 10 characters";
  }
  else if( $_POST['subject'] == "Choose One:"){
    $message = "Please, choose subject";
  }else{
  sendEmail($_POST['Name'],$_POST['Email'],$_POST['subject'],$_POST['message']);
    $message = "Message sent successfully";
  }
header('Location: Support.php');
}

 ?>
