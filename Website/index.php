<?php
require_once('functions.php');
if (!empty($_GET)) {
            $new_get = array_filter($_GET);

            if (count($new_get) < count($_GET)) {
                $request_uri = parse_url('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], PHP_URL_PATH);
                header('Location: ' . $request_uri . '?' . http_build_query($new_get));
                exit;
            }
        }
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="utf-8">
<meta name = "viewport" content="width=device-width, inital-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <link href="css/style.css" rel="stylesheet">
</head>
<body>
<?php require "blocks/header.php" ?>
  <form class=""  method="get" action="">
<div class="container-fluid bg-light ">
    <div class="row align-items-center justify-content-center">
      <div class="col-md-2 pt-2">
        <div class="form-group ">
        <label for="inputState">
          Страна, курорт</label>
          <select id="inputState " class="form-control" name="inputCountry" placeholder="Выберите">
            <?php if(!empty($_GET['inputCountry'] )) {?>
                  <option value="">Выберите</option>
              <<?php }else{ ?>
            <option selected value="">Выберите</option>
          <?php } ?>
            <?php $query = get_tour_info("country");
            while($row = mysqli_fetch_assoc($query)){
              if($row['country_name'] == $_GET['inputCountry']){
             ?>
            <option selected><?=$row['country_name']?></option>
            <?php
          }else{?>
            <option ><?=$row['country_name']?></option>
        <?php  }
            } ?>
          </select>
        </div>
      </div>
      <div class="col-md-2 pt-2">
        <div class="form-group">
          <label for="inputState">
            Транспорт</label>
            <select id="inputState" class="form-control" name="inputTransport">
              <?php if(!empty($_GET['inputTransport'] )) {?>
                    <option value="" >Выберите</option>
                <<?php }else{ ?>
              <option selected value="">Выберите</option>
            <?php } ?>
              <?php $query = get_tour_info("transport");
              while($row = mysqli_fetch_assoc($query)){
                if($row['transport_type'] == $_GET['inputTransport']){
               ?>
              <option selected><?=$row['transport_type']?></option>
              <?php
            }else{?>
              <option><?=$row['transport_type']?></option>
          <?php  }
              } ?>
            </select>
          </div>
        </div>
        <div class="col-md-2 pt-2">
          <div class="form-group">
            <label for="inputState">
              Дата отправления</label>
              <?php if(!empty($_GET['inputDateIn'] )) {?>
                <input type="date"class="form-control datepicker " id="date" name="inputDateIn" value="<?=$_GET['inputDateIn'] ?>"/>
                <?php }else{ ?>
                <input type="date"class="form-control datepicker " id="date" name="inputDateIn" />
            <?php } ?>


            </div>
          </div>
          <div class="col-md-2 pt-2">
            <div class="form-group">
              <label for="inputState">
                Дата прибытия</label>
                <?php if(!empty($_GET['inputDateOut'] )) {?>
                  <input type="date"class="form-control datepicker " id="date" name="inputDateOut" value="<?=$_GET['inputDateOut'] ?>"/>
                  <?php }else{ ?>
                  <input type="date"class="form-control datepicker " id="date" name="inputDateOut" />
              <?php } ?>
            </div>
            </div>
          </div>
          <div class="row align-items-center justify-content-center">
            <div class="col-md-2 ">
              <div class="form-group">
                <label for="inputState">
                  Класс отеля</label>
                  <select id="inputState" class="form-control" name="inputAccomodation">
                    <?php if(!empty($_GET['inputAccomodation'] )) {?>
                          <option value="">Выберите</option>
                      <<?php }else{ ?>
                    <option selected value="">Выберите</option>
                  <?php } ?>
                    <?php $query = get_tour_info("accomodation");
                    while($row = mysqli_fetch_assoc($query)){
                      if($row['accomodation_type'] == $_GET['inputAccomodation']){
                     ?>
                    <option selected><?=$row['accomodation_type']?></option>
                    <?php
                  }else{?>
                    <option><?=$row['accomodation_type']?></option>
                <?php  }
                    } ?>
                  </select>
                </div>
              </div>
              <div class="col-md-2 ">
                <div class="form-group">
                  <label for="inputState">
                    Питание</label>
                    <select id="inputState" class="form-control" name="inputFood">
                      <?php if(!empty($_GET['inputFood'] )) {?>
                            <option value="">Выберите</option>
                        <<?php }else{ ?>
                      <option selected value="">Выберите</option>
                    <?php } ?>
                      <?php $query = get_tour_info("food");
                      while($row = mysqli_fetch_assoc($query)){
                        if($row['food_type'] == $_GET['inputFood']){
                       ?>
                      <option selected><?=$row['food_type']?></option>
                      <?php
                    }else{?>
                      <option><?=$row['food_type']?></option>
                  <?php  }
                      } ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-2 ">
                  <div class="form-group">
                    <label for="inputState">
                      Туроператор</label>
                      <select id="inputState" class="form-control" name="inputSupplier">
                        <?php if(!empty($_GET['inputSupplier'] )) {?>
                              <option value="">Выберите</option>
                          <<?php }else{ ?>
                        <option selected value="">Выберите</option>
                      <?php } ?>
                        <?php $query = get_tour_info("supplier");
                        while($row = mysqli_fetch_assoc($query)){
                          if($row['supplier_name'] == $_GET['inputSupplier']){
                         ?>
                        <option selected><?=$row['supplier_name']?></option>
                        <?php
                      }else{?>
                        <option><?=$row['supplier_name']?></option>
                    <?php  }
                        } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-2 pt-3">
                    <button type="submit" class="btn btn-primary btn-block" name="Search" value="1">Искать</button>
                  </div>
                </div>

  </div>
  <div class="container-fluid mt-5" >
      <div id="products" class="row view-group justify-content-start" >
                  <div class="col col-md-4 col-lg-2  col-xs-4" id="mainbody">
          <div class="card">
          <article class="card-group-item">
            <header class="card-header">
              <h6 class="title">Стоимость тура</h6>
            </header>
            <div class="filter-content">
              <div class="card-body">
              <div class="form-row">
              <div class="form-group col-md-6">
                <label>Мин</label>
                <?php if(!empty($_GET['inputMinPrice'] )) {?>
                  <input type="number" class="form-control"  placeholder="$0" name="inputMinPrice" value="<?=$_GET['inputMinPrice'] ?>">
                  <?php }else{ ?>
                <input type="number" class="form-control"  placeholder="$0" name="inputMinPrice">
              <?php } ?>

              </div>
              <div class="form-group col-md-6 text-right">
                <label>Макс</label>
                <?php if(!empty($_GET['inputMaxPrice'] )) {?>
                  <input type="number" class="form-control"  placeholder="$0" name="inputMinPrice" value="<?=$_GET['inputMaxPrice'] ?>">
                  <?php }else{ ?>
                  <input type="number" class="form-control" placeholder="$5,0000" name="inputMaxPrice">
              <?php } ?>
              </div>
              </div>
              </div> <!-- card-body.// -->
            </div>
          </article> <!-- card-group-item.// -->
          <article class="card-group-item">
            <header class="card-header">
              <h6 class="title">Выбор </h6>
            </header>
            <div class="filter-content">
              <div class="card-body">
                <div class="custom-control custom-checkbox">
                  <?php  if (isset($_GET["checkExcursion"])) {?>
                    <input type="checkbox" class="custom-control-input" id="Check1" name="checkExcursion" value="1"checked>
                    <label class="custom-control-label" for="Check1">Экскурсии</label>
                    <?php }else{ ?>
                      <input type="checkbox" class="custom-control-input" id="Check1" name="checkExcursion" value="1" >
                      <label class="custom-control-label" for="Check1">Экскурсии</label>
                <?php } ?>

                </div> <!-- form-check.// -->


              </div> <!-- card-body.// -->
            </div>
          </article> <!-- card-group-item.// -->
          </div> <!-- card.// -->
        </div>
              <div class=" col col-md-8 col-lg-8 col-xs-4">

                  <?php
                         $where = "";
                         if(isset($_GET['inputCountry'] )) $where = addFilterCondition($where, "country_name = '".htmlspecialchars($_GET["inputCountry"]))."'";
                         if(isset($_GET['inputTransport'])) $where = addFilterCondition($where, "transport_type = '".htmlspecialchars($_GET["inputTransport"]))."'";
                         if(isset($_GET['inputDateIn'] )) $where = addFilterCondition($where, "DATE_FORMAT(arrival_date, '%Y-%m-%d') = '".htmlspecialchars($_GET["inputDateIn"]))."'";
                         if(isset($_GET['inputDateOut'] )) $where = addFilterCondition($where, "DATE_FORMAT(departure_date, '%Y-%m-%d') = '".htmlspecialchars($_GET["inputDateOut"]))."'";
                         if(isset($_GET['inputAccomodation']) ) $where = addFilterCondition($where, "accomodation_type = '".htmlspecialchars($_GET["inputAccomodation"]))."'";
                         if(isset($_GET['inputFood'] )) $where = addFilterCondition($where, "food_type = '".htmlspecialchars($_GET["inputFood"]))."'";
                         if(isset($_GET['inputSupplier'])) $where = addFilterCondition($where, "supplier_name = '".htmlspecialchars($_GET["inputSupplier"]))."'";
                         if (isset($_GET["checkExcursion"])) $where = addFilterCondition($where, "excursions = 'YES'");
                         if(isset($_GET['inputMinPrice'])) $where = addFilterCondition($where, "tour_cost >= '".htmlspecialchars($_GET["inputMinPrice"]))."'";
                         if(isset($_GET['inputMaxPrice'])) $where = addFilterCondition($where, "tour_cost <= '".htmlspecialchars($_GET["inputMaxPrice"]))."'";
                         $sql = 'SELECT tour.tour_id, country.country_name,resort.resort_name,accomodation.accomodation_type,food.food_type,transport.transport_type,
                                   tour.excursions, tour.arrival_date, tour.departure_date, tour.tour_cost, tour.photo, tour.note, supplier.supplier_name
                                   FROM tour INNER JOIN resort ON tour.resort_id = resort.resort_id
                                   INNER JOIN country ON resort.country_id = country.country_id
                                   INNER JOIN accomodation ON tour.accomodation_id = accomodation.accomodation_id
                                   INNER JOIN food ON tour.food_id = food.food_id
                                   INNER JOIN transport ON tour.transport_id = transport.transport_id
                                   INNER JOIN supplier ON tour.supplier_id = supplier.supplier_id';
                         if ($where) $sql .= " WHERE $where";
                         $conn = new mysqli('localhost', 'root', '', 'course_work');
                         $limit = ( isset( $_GET['limit'] ) ) ? $_GET['limit'] : 7;
                         $page = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 1;
                         $links = ( isset( $_GET['links'] ) ) ? $_GET['links'] : 5;

                         $Paginator  = new Paginator( $conn, $sql );

                         $results    = $Paginator->getData( $limit ,  $page);
                         if($results->data == 0){
                           $message = "Тур не найден";


                           if((isset($_GET['inputDateIn']) && isset($_GET['inputDateOut']) && $_GET['inputDateIn'] >= $_GET['inputDateOut'] )
                           || (isset($_GET['inputDateIn']) && $_GET['inputDateIn'] == date("Y-m-d")) ||  (isset($_GET['inputDateOut']) && $_GET['inputDateOut'] == date("Y-m-d"))){
                              $message = "Неправильно введена дата тура";
                           }
                           if(isset($_GET['inputMinPrice']) && isset($_GET['inputMaxPrice']) && $_GET['inputMinPrice'] >= $_GET['inputMaxPrice'] ){
                               $message = "Минимальная цена тура не может быть больше максимальной";
                           }
                          ?>
                          <div class="text-center">
                            <h4><?=$message?></h4><br>
                            <img src="img/order.png" alt=""><br>

                          </div>
                        <?php }else{
                         for( $i = 0; $i < count( $results->data ); $i++ ){
                    ?>
                    <div class="item col-xs-4 col-lg-4 list-group-item">
                        <div class="thumbnail card">
                            <div class="img-event">
                                <img class="group list-group-image img-fluid" src="<?=$results->data[$i]['photo']?>" alt="">
                            </div>
                            <div class="caption card-body">
                                <h4 class="group card-title inner list-group-item-heading">
                                    <?=$results->data[$i]['country_name'],', ',$results->data[$i]['resort_name']?></h4>
                                <p class="group inner list-group-item-text">
                                   "<?=$results->data[$i]['note']?></p>
                                <div class="row">
                                    <div class="col-xs-12 col-md-6">
                                        <p class="lead">
                                           <?='$',$results->data[$i]['tour_cost']?></p>
                                    </div>
                                    <div class="col-xs-12 col-md-6">
                                        <a class="btn btn-success" href="ProductPage.php?tour_id=<?=$results->data[$i]['tour_id']?>">Подробнее</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }?>
                    <div class="row row align-items-center justify-content-center ">
                        <?php $Paginator->createLinks( $links,"index.php");  ?>
                    </div>
                  <?php } ?>
                  </div>

              </div>
  </div>
</form>

  <?php require "blocks/footer.php" ?>
</body>
</html>
