<?php
if(!empty($_COOKIE['customer'])){
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

    <form action="registration.php" method="post" class="form-signin">
      <h1 class="h3 mb-3 font-weight-normal">Registration form</h1>
      <div class="row">
          <div class="col-md-6 mb-3">
            <input type="Name" id="inputName" class="form-control" placeholder="Name" required="" autofocus="" name="Name">
          </div>
          <div class="col-md-6 mb-3">
            <input type="Surname" id="inputSurname" class="form-control" placeholder="Surname" required="" autofocus="" name="Surname">
          </div>
        </div>
        <div class="row">
            <div class="col-md-2 mb-3">
              <input type="Name" id="inputSeries" class="form-control" placeholder="Series" required="" autofocus="" name="Series" min = "2" max = "2" >
            </div>
            <div class="col-md-10 mb-3">
              <input type="Surname" id="inputNumber" class="form-control" placeholder="Passport number" required="" autofocus="" name="Number"  min = "6" max = "6">
            </div>
          </div>
      <input type="Address" id="inputAddress" class="form-control" placeholder="Address" required="" autofocus="" name="Address"><br>
      <input type="Phone" id="inputPhone" class="form-control" placeholder="Phone" required="" autofocus="" name="Phone"><br>
      <input type="Email" id="inputEmail" class="form-control" placeholder="Email" required="" autofocus="" name="Email"><br>
      <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="" name="Password"><br>
      <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Sign up</button>
      </form>
  </div>
  <?php
  if(isset($_POST["submit"])){
      $name = filter_var(trim($_POST['Name']),FILTER_SANITIZE_STRING);
      $surname = filter_var(trim($_POST['Surname']),FILTER_SANITIZE_STRING) ;
      $address = filter_var(trim($_POST['Address']),FILTER_SANITIZE_STRING) ;
      $phone =  filter_var(trim($_POST['Phone']),FILTER_SANITIZE_STRING);
      $email =  filter_var(trim($_POST['Email']),FILTER_SANITIZE_STRING);
      $pass =  filter_var(trim($_POST['Password']),FILTER_SANITIZE_STRING);
      $series =  filter_var(trim($_POST['Series']),FILTER_SANITIZE_STRING);
      $number =  filter_var(trim($_POST['Number']),FILTER_SANITIZE_STRING);
      $mysql = new mysqli('localhost', 'root', '', 'course_work');
      $pass = md5($pass."dsfadfghs");
      $query = $mysql->query("SELECT * FROM customer  WHERE email = '$email' ") or die ($mysql->error);

      $numrows = mysqli_num_rows($query);

      if($numrows == 0){
        $mysql->query("INSERT INTO customer (name,surname,email,address,phone,pass)
        VALUES('$name','$surname','$email','$address','$phone','$pass')") or die ($mysql->error);
        $query =$mysql->query("SELECT customer_id FROM customer WHERE email = '$email' ") or die ($mysql->error);
        $row = mysqli_fetch_assoc($query);
        $id = $row['customer_id'];
        $mysql->query("INSERT INTO internationalpassport VALUES ($id, '$series', $number) ") or die ($mysql->error);
        $message = "Account Successfully Created";
      }
      else{
        $message = "That username already exists! Please try another one!";
      }
 if (!empty($message)) {echo '<div class="alert alert-success container mt-4">MESSAGE: '. $message . '</div>';}

  }

   ?>
</body>
</html>
