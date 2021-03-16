<?php if(empty($_COOKIE['employee'])){
    header('Location: auth.php');
} ?>
<?php require_once('functions.php'); ?>
<!DOCTYPE html>
<html lang="ru" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name = "viewport" content="width=device-width, inital-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css" integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons">
    <script>
function handle(object){
     var inp = document.createElement("input");
     inp.type = "text";
     inp.value = object.innerText;

     object.innerText = "";
     object.appendChild(inp);

     var _event = object.onclick;
     object.onclick = null;

     inp.onkeydown = function(e){

         if(e.keyCode === 13){
               object.innerText = inp.value;
               object.onclick = _event;
               object.removeChild(inp);
         }

     };

}

</script>
</head>
<body>
  <?php require "blocks/header.php";
  $mysql = new mysqli('localhost', 'root', '', 'course_work');
  $cookie =  $_COOKIE['employee'];
    $query = $mysql->query("SELECT CONCAT(name,' ',surname) AS employee_name FROM employee WHERE employee_id = $cookie") or die ($mysql->error);
    $row = mysqli_fetch_assoc($query);
  $mysql->close();?>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-10">
          <h4>Здравствуйте, <?=$row['employee_name']?></h4>
        </div>
        <div class="col-md-2">
          <form method="post" action="logout.php">
              <input type="submit" class="btn  float-right" name="logout" value="Log out">
          </form>
        </div>
      </div>

      <?php
         if(!($rows = get_employee_orders()) ){?>
           <br><br>
           <div class="text-center">
             <h4>Кажеться у кого-то сегодня свободный день</h4>

           </div>

       <?php  }else {?>
<br>
    	<div class="row">

                <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Страна</th>
                            <th>Курорт</th>
                            <th>Дата заказа</th>
                            <th>Клиент</th>
                            <th>Номер</th>
                            <th>Почта</th>
                            <th>Паспорт</th>
                            <th >Стоимость</th>
                            <th>Статус</th>
                            <th class="text-right" >Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php while($row = mysqli_fetch_assoc($rows)){?>
                           <form  action="ActionsForEmployee.php" method="post">
                        <tr>
                            <td ><?=$row['order_id']?></td>
                            <td><?=$row['country_name']?></td>
                            <td><?=$row['resort_name']?></td>
                            <td><?=$row['clearance_date']?></td>
                            <td><?=$row['customer_name']?></td>
                            <td><?=$row['phone']?></td>
                            <td><?=$row['email']?></td>
                            <td><?=$row['passport']?></td>
                            <td>$<?=$row['tour_cost']?></td>
                            <td  >
                              <select id="inputState " class="form-control" name="inputStatus" placeholder="Выберите">
                                <?php $arr = array('Новый заказ', 'Согласован','Скомплектован','Выполнен' );
                              for($i = 0; $i < count($arr); $i++ ){
                                  if($arr[$i] == $row['status']){
                                 ?>
                                <option selected><?=$arr[$i]?></option>
                                <?php
                              }else{?>
                                <option ><?=$arr[$i]?></option>
                            <?php  }
                                } ?>
                              </select>
                            </td>
                            <td class="td-actions text-right">

                                <button type="submit" rel="tooltip" class="btn btn-success btn-just-icon btn-sm" data-original-title="" title="" name="edit" value=<?=$row['order_id']?>>
                                    <i class="material-icons">edit</i>
                                </button>
                                <button type="submit" rel="tooltip" class="btn btn-danger btn-just-icon btn-sm" data-original-title="" title=""name="delete" value=<?=$row['order_id']?>>
                                    <i class="material-icons">close</i>
                                </button>
                              </form>

                            </td>
                        </tr>
                         <?php } ?>
                    </tbody>
                </table>
                </div>

            </div>
             <?php } ?>
           </div>
    </body>
</html>
