<?php
if(!empty($_COOKIE['customer']) && isset($_POST['logout'])){
    setcookie('customer', $row['customer_id'],time() - 3600 ,"/");
      header('Location: index.php');
}
if(!empty($_COOKIE['employee']) && isset($_POST['logout'])){
    setcookie('employee', $row['employee_id'],time() - 3600 ,"/");
      header('Location: index.php');
}
if(!empty($_COOKIE['admin']) && isset($_POST['logout'])){
    setcookie('admin', $row['employee_id'],time() - 3600 ,"/");
      header('Location: index.php');
}
 ?>
