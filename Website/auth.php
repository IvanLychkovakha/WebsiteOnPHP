<?php
if(!empty($_COOKIE['customer']) ||!empty($_COOKIE['employee']) ||!empty($_COOKIE['admin'])){
    header('Location: index.php');
}
 ?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <meta name = "viewport" content="width=device-width, inital-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="/css/style.css">
</head>
<body class="text-center" >
  <?php require "blocks/header.php" ?>
  <div class="container mt-4 ">
    <form class="form-registration" action="" method="post">
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
      <input type="email" id="inputEmail" class="form-control" placeholder="Email" required="" autofocus="" name="Email"><br>
      <input type="password" id="inputPassword" class="form-control" placeholder="Password" required=""name="pass"><br>
      <button class="btn btn-lg btn-primary btn-block" type="submit" name="sign_in">Sign in</button>
      <a href="registration.php">First time on our website?</a>
      </form>
  </div>
  <?php
    if(isset($_POST['sign_in'])){
        $email =  filter_var(trim($_POST['Email']),FILTER_SANITIZE_STRING);
        $pass =  filter_var(trim($_POST['pass']),FILTER_SANITIZE_STRING);
        $pass2 = md5($pass."dsfadfghs");
        $mysql = new mysqli('localhost', 'root', '', 'course_work');

        $query1 = $mysql->query("SELECT customer_id, email FROM customer  WHERE email = '$email' AND pass = '$pass2' ") or die ($mysql->error);
        $query2 =  $mysql->query("SELECT employee_id, email FROM employee  WHERE email = '$email' AND pass = '$pass' ") or die ($mysql->error);
        $query3 =  $mysql->query("SELECT employee_id, email FROM employee  WHERE email = '$email' AND pass = '$pass' AND possition = 'Администратор' ") or die ($mysql->error);
        if(mysqli_num_rows($query1) == 1){
          $row = mysqli_fetch_assoc($query1);
          setcookie('customer', $row['customer_id'],time() + 3600 ,"/");
          $mysql->close();
          header('Location: index.php');
         }else{
           if(mysqli_num_rows($query3) == 1){
             $row = mysqli_fetch_assoc($query3);
             setcookie('admin', $row['employee_id'],time() + 3600 ,"/");
             $mysql->close();
             header('Location: index.php');
            }else{
              if(mysqli_num_rows($query2) == 1){
                $row = mysqli_fetch_assoc($query2);
                setcookie('employee', $row['employee_id'],time() + 3600 ,"/");
                $mysql->close();
                header('Location: index.php');
              }else{
                echo '<div class="alert alert-success container mt-4">MESSAGE: Such user was not found</div>';
                exit();
              }

              }
            }


    }
   ?>
</body>
</html>
