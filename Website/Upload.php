<?php
require_once('functions.php');
if(isset($_POST['Upload']) && !empty($_FILES['image']['name'])){
  uploadImage($_FILES['image']);
  $mysql = new mysqli('localhost', 'root', '', 'course_work');
  $cokie = $_COOKIE['customer'];
  $photo ="img/".$_FILES['image']['name'];
  $query = $mysql->query("UPDATE customer SET photo = '$photo' WHERE customer_id ='$cokie' ") or die ($mysql->error);
 $mysql->close();
   header('Location: UserProfile.php');
}else {
 header('Location: UserProfile.php');
}
 ?>
