<?php
if(empty($_COOKIE['customer'])){
    header('Location: auth.php');
}
 ?>
<?php require_once('functions.php'); ?>
<!DOCTYPE html>
<html lang="ru" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name = "viewport" content="width=device-width, inital-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
   <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  </head>
  <body>
    <?php require "blocks/header.php" ?>
    <div class="container">

   <?php
      if(!($rows = get_customer_orders()) ){?>
        <br><br>
        <div class="text-center">
          <h4>У вас пока еще нет покупок.</h4>
          <img src="img/order.png" alt=""><br>
          <p >Давайте исправим это!</p>
          <p >Сделайте свой первый заказ на нашем сайте прямо сейчас!</p>
        </div>

    <?php  }else {?>

            <div class="title">
              <h3>Заказы</h3>
            </div>
   <div class="row">
         <div class="col-lg-8 col-md-10 ml-auto mr-auto">
             <div class="table-responsive">
             <table class="table">
                 <thead>
                     <tr>
                         <th class="text-center">#</th>
                         <th>Страна</th>
                         <th>Курорт</th>
                         <th>Дата оформления</th>
                         <th>Вас обслуживает</th>
                         <th class="text-right">Статус</th>
                         <th class="text-right">Стоимость</th>
                     </tr>
                 </thead>
                 <tbody>
                   <?php while($row = mysqli_fetch_assoc($rows)){?>
                     <tr>
                       <td class="text-center"><?=$row['order_id']?></td>
                       <td><?=$row['country_name']?></td>
                       <td><?=$row['resort_name']?></td>
                       <td><?=$row['clearance_date']?></td>
                       <td><?=$row['employee_name']?></td>
                       <td class="text-right"><?=$row['status']?></td>
                       <td class="text-right"><?=$row['tour_cost']?></td>

                     </tr>
                     <?php } ?>
                 </tbody>
             </table>
             </div>
           </div>
         </div>
       <?php } ?>
   </div><br><br><br><br><br>
         <?php require "blocks/footer.php" ?>
  </body>
</html>
