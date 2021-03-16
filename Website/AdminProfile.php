<?php if(empty($_COOKIE['admin'])){
    header('Location: auth.php');
} ?>
<?php
require_once('functions.php');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <meta name = "viewport" content="width=device-width, inital-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css" integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons">

</head>
<body class="">
  <?php require "blocks/header.php" ?>
    <div class="container-fluid">

           <div class="table-title">
               <div class="row">
                   <div class="col-sm-10 col-md-10"><h2>Список <b>туров</b></h2></div>
                   <div class="col-sm-2 col-md-1">
                     <form class="" action="" method="post">
                       <button type="submit" name="addNew"class="btn btn-info float-right add-new"><i class="fa fa-plus"></i> Add New</button>
                     </form>
                   </div>
                   <div class="col-md-1">
                     <form method="post" action="logout.php">
                         <input type="submit" class="btn  " name="logout" value="Log out">
                     </form>
                   </div>
               </div>
           </div>
  <div class="table-hover table-responsive">
		<table class="table ">
		    <thead>
		        <tr >
		            <th >ID</th>
		            <th>Страна,курорт</th>
		            <th>Екскурсии</th>
		            <th>Дата отправления</th>
		            <th>Дата прибытия</th>
                <th>Тип проживания</th>
                <th>Тип питания</th>
                <th>Транспорт</th>
                <th>Сотрудник</th>
                <th>Стоимость</th>
                <th>Actions</th>

		        </tr>
		    </thead>
		    <tbody>

          <?php
           $sql = "SELECT tour.tour_id, CONCAT(country.country_name, ',',resort.resort_name)AS country,tour.excursions ,tour.arrival_date,tour.departure_date, accomodation.accomodation_type,
         		food.food_type,transport.transport_type, CONCAT(employee.name,' ',employee.surname) AS employee_name, tour.tour_cost FROM tour
         INNER JOIN accomodation ON tour.accomodation_id = accomodation.accomodation_id
         INNER JOIN employee ON tour.employee_id = employee.employee_id
         INNER JOIN food ON tour.food_id = food.food_id
         INNER JOIN transport ON tour.transport_id = transport.transport_id
         INNER JOIN resort ON tour.resort_id = resort.resort_id
         INNER JOIN country ON resort.country_id = country.country_id ORDER BY tour.tour_id ASC";
             $conn = new mysqli('localhost', 'root', '', 'course_work');
             $limit = ( isset( $_GET['limit'] ) ) ? $_GET['limit'] : 7;
             $page = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 1;
             $links = ( isset( $_GET['links'] ) ) ? $_GET['links'] : 5;

             $Paginator  = new Paginator( $conn, $sql );

             $results    = $Paginator->getData( $limit ,  $page);

             for( $i = 0; $i < count( $results->data ); $i++ ){

               if($results->data[$i]['arrival_date'] >= date("Y-m-d")){

        ?>
		        <tr >
            <?php }else{ ?>
               <tr class="alert alert-danger" >
               <?php } ?>
		            <td><?=$results->data[$i]['tour_id']?></td>
                <td><?=$results->data[$i]['country']?></td>
                <?php $temp = $i?>
                <?php if($results->data[$i]['excursions'] == 'YES') {?>
                <td ><input type="checkbox" name="" value="" checked></td>
              <?php }else{ ?>
                <td ><input type="checkbox" name="" value="" ></td>
              <?php } ?>
		            <td ><?=$results->data[$i]['arrival_date']?></td>
                <td ><?=$results->data[$i]['departure_date']?></td>
                <td ><?=$results->data[$i]['accomodation_type']?></td>
                <td ><?=$results->data[$i]['food_type']?></td>
                <td ><?=$results->data[$i]['transport_type']?></td>
                <td ><?=$results->data[$i]['employee_name']?></td>
                <td ><?=$results->data[$i]['tour_cost']?></td>
		            <td>
                  <div class="row">
                    <div class="col-md-1 col-lg-1">
                      <form  action="" method="post">
                      <button type="submit" rel="tooltip" class="btn btn-success btn-just-icon btn-sm" data-original-title="" title="" name="edit2" value="<?=$i?>">
                          <i class="material-icons">edit</i>
                      </button>
                    </form>
                    </div>
                    <div class="col-md-1 col-lg-1">
                      <form class="" action="ActionsForAdmin.php" method="post">
                        <button type="submit" rel="tooltip" class="btn btn-danger btn-just-icon btn-sm" data-original-title="" title=""name="delete2" value="<?=$results->data[$i]['tour_id']?>">
                             <i class="material-icons">close</i>
                         </button>
                      </form>
                    </div>
                  </div>



                   </form>


                  </td>
		        </tr>


          <?php } ?>
		    </tbody>

		</table>
    <?php if(isset($_POST['edit2'])){?>
       <div class="popup-overlay"><!-- //оверлей - отображение формы на затемненном фоне -->
         <div class="popWindow subscribe_window"><!-- //основное окно формы Подписки -->
             <h1 class="h3 mb-3 font-weight-normal">Заполните данные</h1>
           <form class="subscribe-form" autocomplete="off" method="post"  action="ActionsForAdmin.php">
             <div class="form-group">
               <label for="inputState">
                 Страна, курорт</label>
                 <select class="form-control" name="updateCountry" placeholder="Выберите">
                   <?php $query = get_tour_info("resort");
                   while($row = mysqli_fetch_assoc($query)){
                     if($row['country_resort'] == $results->data[$_POST['edit2']]['country']){?>
                     <option value="<?=$row['resort_id']?>" selected><?=$row['country_resort']?></option>
                   <?php }else{ ?>
                      <option value="<?=$row['resort_id']?>" ><?=$row['country_resort']?></option>
                   <?php
                 }
                } ?>
                 </select>
                 <div class="row">
                   <div class="col-md-6">
                     <label for="inputState">
                       Дата отправления</label>
                       <?php if(!empty($results->data[$_POST['edit2']]['arrival_date'])) {?>
                         <input type="date"class="form-control datepicker " id="date" name="updateDateIn" value="<?=$results->data[$_POST['edit2']]['arrival_date' ]?>"/>
                         <?php }else{ ?>
                         <input type="date"class="form-control datepicker " id="date" name="updateDateIn" />
                     <?php } ?>
                   </div>
                   <div class="col-md-6">
                     <label for="inputState">
                       Дата прибытия</label>
                       <?php if(!empty($results->data[$_POST['edit2']]['departure_date'])) {?>
                         <input type="date"class="form-control datepicker " id="date" name="updateDateOut" value="<?=$results->data[$_POST['edit2']]['departure_date'] ?>"/>
                         <?php }else{ ?>
                         <input type="date"class="form-control datepicker " id="date" name="updateDateOut" />
                     <?php } ?>
                   </div>
                 </div>

                 <label for="inputState">
                   Класс отеля</label>
                   <select id="inputState" class="form-control" name="updateAccomodation">
                     <?php $query = get_tour_info("accomodation");
                     while($row = mysqli_fetch_assoc($query)){
                       if($row['accomodation_type'] == $results->data[$_POST['edit2']]['accomodation_type']){
                      ?>
                     <option value="<?=$row['accomodation_id']?>" selected><?=$row['accomodation_type']?></option>
                     <?php
                   }else{?>
                     <option value="<?=$row['accomodation_id']?>"><?=$row['accomodation_type']?></option>
                 <?php  }
                     } ?>
                   </select>
                   <label for="inputState">
                     Питание</label>
                     <select id="inputState" class="form-control" name="updateFood">
                       <?php $query = get_tour_info("food");
                       while($row = mysqli_fetch_assoc($query)){
                         if($row['food_type'] == $results->data[$_POST['edit2']]['food_type']){
                        ?>
                       <option value="<?=$row['food_id']?>" selected><?=$row['food_type']?></option>
                       <?php
                     }else{?>
                       <option value="<?=$row['food_id']?>"><?=$row['food_type']?></option>
                   <?php  }
                       } ?>
                     </select>
                     <label for="inputState">
                       Транспорт</label>
                       <select id="inputState" class="form-control" name="updateTransport">
                         <?php $query = get_tour_info("transport");
                         while($row = mysqli_fetch_assoc($query)){
                           if($row['transport_type'] ==$results->data[$_POST['edit2']]['transport_type']){
                          ?>
                         <option value="<?=$row['transport_id']?>" selected><?=$row['transport_type']?></option>
                         <?php
                       }else{?>
                         <option value="<?=$row['transport_id']?>"><?=$row['transport_type']?></option>
                     <?php  }
                         } ?>
                       </select>
                       <label for="inputState">
                         Сотрудник</label>
                         <select id="inputState" class="form-control" name="updateEmployee">
                           <?php $query = get_tour_info("employee");
                           while($row = mysqli_fetch_assoc($query)){
                             $l = $row['name']." ".$row['surname'] ;
                             if($row['name']." ".$row['surname'] == $results->data[$_POST['edit2']]['employee_name']){

                            ?>

                           <option value="<?=$row['employee_id']?>" selected><?=$l?></option>
                           <?php
                         }else{?>
                           <option value="<?=$row['employee_id']?>"><?=$l?></option>
                       <?php  }
                           } ?>
                         </select>
                         <label for="inputState">
                           Екскурсии</label>
                           <select id="inputState" class="form-control" name="updateExcursions">
                             <?php if($results->data[$_POST['edit2']]['excursions'] == 'YES') {?>
                              <option selected>YES</option>
                              <option >NO</option>
                           <?php }else{ ?>
                            <option>YES</option>
                             <option  selected >NO</option>
                           <?php } ?>
                       </select>
                        <label>
                           Стоимость</label>
                       <input type="number" class="form-control" id="tour_cost"  placeholder="$0" name="updatePrice" value="<?=$results->data[$_POST['edit2']]['tour_cost']?>">
             <div class="aligncenter">
               <br>
               <button type="submit" class="btn btn-primary" name="UpdateTour" value="<?=$results->data[$_POST['edit2']]['tour_id']?>"> Изменить</button>
             </div>
           </div>
           </form>
           <div class="close-btn">&times;</div>
         </div><!-- /subscribe_window -->
     </div>
   <?php }?>
   <?php if(isset($_POST['addNew'])){?>
      <div class="popup-overlay"><!-- //оверлей - отображение формы на затемненном фоне -->
        <div class="popWindow subscribe_window"><!-- //основное окно формы Подписки -->
            <h1 class="h3 mb-3 font-weight-normal">Заполните данные</h1>
          <form class="subscribe-form" autocomplete="off" method="post"  action="ActionsForAdmin.php" enctype="multipart/form-data">
            <div class="form-group">
              <label for="inputState">
                Страна, курорт</label>
                <select class="form-control" name="addCountry" placeholder="Выберите">
                    <option selected value="">Выберите</option>
                  <?php $query = get_tour_info("resort");
                  while($row = mysqli_fetch_assoc($query)){?>
                     <option value="<?=$row['resort_id']?>" ><?=$row['country_resort']?></option>
              <?php  } ?>
                </select>
                <div class="row">
                  <div class="col-md-6">
                    <label for="inputState">
                      Дата отправления</label>
                        <input type="date"class="form-control datepicker " id="date" name="addDateIn" />
                  </div>
                  <div class="col-md-6">
                    <label for="inputState">
                      Дата прибытия</label>
                        <input type="date"class="form-control datepicker " id="date" name="addDateOut" />
                  </div>
                </div>

                <label for="inputState">
                  Класс отеля</label>
                  <select id="inputState" class="form-control" name="addAccomodation">
                      <option selected value="">Выберите</option>
                    <?php $query = get_tour_info("accomodation");
                    while($row = mysqli_fetch_assoc($query)){?>
                    <option value="<?=$row['accomodation_id']?>"><?=$row['accomodation_type']?></option>
                <?php  } ?>
                  </select>
                  <label for="inputState">
                    Питание</label>
                    <select id="inputState" class="form-control" name="addFood">
                        <option selected value="">Выберите</option>
                      <?php $query = get_tour_info("food");
                      while($row = mysqli_fetch_assoc($query)){?>
                      <option value="<?=$row['food_id']?>"><?=$row['food_type']?></option>
                  <?php  }?>
                    </select>
                    <label for="inputState">
                      Транспорт</label>
                      <select id="inputState" class="form-control" name="addTransport">
                          <option selected value="">Выберите</option>
                        <?php $query = get_tour_info("transport");
                        while($row = mysqli_fetch_assoc($query)){?>
                        <option value="<?=$row['transport_id']?>"><?=$row['transport_type']?></option>
                      <?php  }?>
                      </select>
                      <label for="inputState">
                        Сотрудник</label>
                        <select id="inputState" class="form-control" name="addEmployee">
                            <option selected value="">Выберите</option>
                          <?php $query = get_tour_info("employee");
                          while($row = mysqli_fetch_assoc($query)){
                            $l = $row['name']." ".$row['surname'] ;?>
                          <option value="<?=$row['employee_id']?>"><?=$l?></option>
                      <?php  }?>
                        </select>
                        <label for="inputState">
                          Поставщик</label>
                          <select id="inputState" class="form-control" name="addSupplier">
                              <option selected value="">Выберите</option>
                            <?php $query = get_tour_info("supplier");
                            while($row = mysqli_fetch_assoc($query)){?>
                            <option value="<?=$row['supplier_id']?>"><?=$row['supplier_name']?></option>
                        <?php  }?>
                          </select>
                        <label for="inputState">
                          Екскурсии</label>
                          <select id="inputState" class="form-control" name="addExcursions">
                            <option>YES</option>
                            <option  selected >NO</option>
                          </select>
                       <label>
                          Стоимость</label>
                      <input type="number" class="form-control" id="tour_cost"  placeholder="$0" name="addPrice" value="">
                    <label>Загрузите фотографию</label><br>
                        <input type="file" class="text-center center-block well well-sm" name="addimage">
                        <br>
                        <label for="note">
                          Сведения</label>
                      <textarea name="note" id="note" class="form-control" rows="5" cols="25" required="required" placeholder="Message"></textarea>
            <div class="aligncenter">
              <br>
              <button type="submit" class="btn btn-primary" name="add_tour" > Создать</button>
            </div>
          </div>
          </form>
          <div class="close-btn">&times;</div>
        </div><!-- /subscribe_window -->
    </div>
  <?php }?>
  </div>
  <div class="row row align-items-center justify-content-center ">
      <?php $Paginator->createLinks( $links,"AdminProfile.php");  ?>
  </div>
</div>

         </div>
     </div>
 </div>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
 <script>
    // PopUp Form and thank you popup after sending message
    var $popOverlay = $(".popup-overlay");
    var $popWindow = $(".popWindow");
    var $subscribeWindow = $(".subscribe_window");
    var $popClose = $(".close-btn");

    $(function() {
      // Close Pop-Up after clicking on the button "Close"
      $popClose.on("click", function() {
        $popOverlay.fadeOut();
        $popWindow.fadeOut();
      });

      // Close Pop-Up after clicking on the Overlay
      $(document).on("click", function(event) {
        if ($(event.target).closest($popWindow).length) return;
        $popOverlay.fadeOut();
        $popWindow.fadeOut();
        event.stopPropagation();
      });

      // Form Subscribe
      $(".subscribe-form").submit(function() {
        e.preventDefault();
    $.ajax({
        type: "POST",
        url: 'ActionsForAdmin.php',
        data: $(this).serialize(),
        success: function(response)
        {
            var jsonData = JSON.parse(response);

            // user is logged in successfully in the back-end
            // let's redirect
            if (jsonData.success == "1")
            {
                location.href = 'AdminProfile.php';
            }
            else
            {
                alert('Invalid Credentials!');
            }
       }
   });

      });
    });

    // используйте этот код, если нужно появление формы с куки и вы подключали jquery.cookie.min.js
    // используйте этот код, если нужно появление формы без куки
    $(window).load(function() {
      setTimeout(function() {
        $popOverlay.fadeIn();
        $subscribeWindow.fadeIn();
      }, );
    });
  </script>


</body>
</html>
