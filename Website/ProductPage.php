<?php
require_once('functions.php');
?>
<!DOCTYPE html>
<html lang="ru" dir="ltr">
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
  </head>
  <body>
    <?php require "blocks/header.php"  ?>
    <?php   $row = get_tour($_GET['tour_id']); ?>
    <div class="container ">
      <?php
            if(isset($_POST['reg_order'])){
              $temp = create_customer($_POST['Name'],$_POST['Surname'],$_POST['Address'],$_POST['Email'],$_POST['Phone']);
              if($temp == 0){
                $message1 = "Внимание";
                $message2 = "Вы уже были зарегистрированы на этом сайте, авторизуйтесь и сделайте заказ!";
              }
              else{
                $temp = create_order_fornew($_GET['tour_id'], $temp);
                if($temp == 0) {
                  $message1 = "Внимание";
                  $message2 = "Вы уже заказали этот тур!";
                }
                else{
                  $message1 = "Спасибо за заказ!";
                  $message2 = "Наш менеджер свяжеться с вами в ближайшее время!";
                }
              }?>
              <div class="popup-overlay">
              <div class="popWindow  subscribe_window"><!-- //благодарственное окно после успешной отправки формы -->

                <p class="thank_you_title"><?=$message1?></p>
                <p class="thank_you_body"><?=$message2?></p>

                <div class="close-btn">&times;</div>
              </div><!-- /thank_you_window -->
              </div>
              <?php  }  ?>
	<div class="row">
		<aside class="col-sm-5 ">
<article class="gallery-wrap">
  <div class="img-big-wrap">
    <img src="<?=$row['photo']?>">
  </div> <!-- slider-product.// -->
</article> <!-- gallery-wrap .end// -->
		</aside>
		<aside class="col-sm-7">
<article class="card-body ">
	<h3 class="title mb-3"><?=$row['country_name'],', ',$row['resort_name']?></h3>

<p class="price-detail-wrap">
	<span class="price h3 text-warning">
		<span class="currency">US $</span><span class="num"><?=$row['tour_cost']?></span>
	</span>
</p> <!-- price-detail-wrap .// -->
<dl class="item-property">
  <dt>Описание</dt>
  <dd><p><?=$row['note']?> </p></dd>
</dl>
<div class="row">
    <div class="col-md-6">
      <dl class="param param-feature">
        <dt>Класс Отеля</dt>
        <dd><?=$row['accomodation_type']?></dd>
      </dl>
    </div>
    <div class="col-md-6">
      <dl class="param param-feature">
        <dt>Питание</dt>
        <dd><?=$row['food_type']?></dd>
      </dl>  <!-- item-property-hor .// -->
    </div>
  </div>
  <div class="row">
      <div class="col-md-6">
        <dl class="param param-feature">
          <dt>Транспорт</dt>
          <dd><?=$row['transport_type']?></dd>
        </dl>
      </div>
      <div class="col-md-6">
        <dl class="param param-feature">
          <dt>Туроператор</dt>
          <dd><?=$row['supplier_name']?></dd>
        </dl>  <!-- item-property-hor .// -->
      </div>
    </div>
    <div class="row">
        <div class="col-md-6">
          <dl class="param param-feature">
            <dt>Дата отправления</dt>
            <dd><?=$row['arrival_date']?></dd>
          </dl>
        </div>
        <div class="col-md-6">
          <dl class="param param-feature">
            <dt>Дата прибытия</dt>
            <dd><?=$row['departure_date']?></dd>
          </dl>  <!-- item-property-hor .// -->
        </div>
      </div>
      <dl class="param param-feature">
        <dt>Экскурсии</dt>
        <dd><?=$row['excursions']?></dd>
      </dl>  <!-- item-property-hor .// -->
<form  action="" method="post">
  	<button type="submit"class="btn btn-lg btn-outline-primary text-uppercase" name="order">  Заказать </button>
</form>
</article> <!-- card-body.// -->
		</aside> <!-- col.// -->
	</div> <!-- row.// -->
</div>
  <?php if(isset($_POST['order']) && empty($_COOKIE['customer']) && empty($_COOKIE['employee']) && empty($_COOKIE['admin'])){ ?>
  <div class="popup-overlay"><!-- //оверлей - отображение формы на затемненном фоне -->
    <div class="popWindow subscribe_window"><!-- //основное окно формы Подписки -->
        <h1 class="h3 mb-3 font-weight-normal">Заполните данные</h1>
      <form class="subscribe-form" autocomplete="off" method="post" >
        <div class="form-group">
          <div class="row">
              <div class="col-md-6 mb-3">
                <input type="Name"  class="form-control" placeholder="Name" required="" autofocus="" name="Name">
              </div>
              <div class="col-md-6 mb-3">
                <input type="Surname"  class="form-control" placeholder="Surname" required="" autofocus="" name="Surname">
              </div>
            </div>
          <input type="Address"  class="form-control" placeholder="Address" required="" autofocus="" name="Address"><br>
          <input type="Phone"  class="form-control" placeholder="Phone" required="" autofocus="" name="Phone"><br>
          <input type="email" class="form-control" placeholder="Email" required="" autofocus="" name="Email"><br>
        <div class="aligncenter">
          <button type="submit" class="btn btn-primary" name="reg_order"> Заказать</button>
        </div>
      </div>
      </form>
      <div class="close-btn">&times;</div>
    </div><!-- /subscribe_window -->
</div>
<?php }else {
  if(!empty($_COOKIE['customer']) && isset($_POST['order'])){
    create_order_forauth($_GET['tour_id']);
  }
} ?>

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
       var th = $(this);
       $.ajax({
         type: "POST",
         url: "ProductPage.php",
         data: th.serialize()
       })

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
  <br><br>

    <?php require "blocks/footer.php" ?>
  </body>
</html>
