<?php
function get_customers() {
  $mysql = new mysqli('localhost', 'root', '', 'course_work');
  $cokie = $_COOKIE['customer'];
  $query = $mysql->query("SELECT customer.*, internationalpassport.series,internationalpassport.number FROM customer
   LEFt JOIN internationalpassport ON customer.customer_id = internationalpassport.customer_id  WHERE customer.customer_id ='$cokie' ") or die ($mysql->error);
  $rows = mysqli_fetch_assoc($query);
    $mysql->close();
  return $rows;
}
function get_tours(){
  $mysql = new mysqli('localhost', 'root', '', 'course_work');
  $query = $mysql->query("SELECT tour.tour_id, CONCAT(country.country_name, ',',resort.resort_name)AS country,tour.excursions ,tour.arrival_date,tour.departure_date, accomodation.accomodation_type,
		food.food_type,transport.transport_type, CONCAT(employee.name,' ',employee.surname) AS employee_name, tour.tour_cost FROM tour
INNER JOIN accomodation ON tour.accomodation_id = accomodation.accomodation_id
INNER JOIN employee ON tour.employee_id = employee.employee_id
INNER JOIN food ON tour.food_id = food.food_id
INNER JOIN transport ON tour.transport_id = transport.transport_id
INNER JOIN resort ON tour.resort_id = resort.resort_id
INNER JOIN country ON resort.country_id = country.country_id ORDER BY tour.tour_id ASC") or die ($mysql->error);

  $mysql->close();
  return $query;
}
function get_status(){
  $mysql = new mysqli('localhost', 'root', '', 'course_work');

  $query = $mysql->query("SELECT status from orders ") or die ($mysql->error);

      $mysql->close();
  return $query;
}

function create_order_forauth($tour_id){
  $mysql = new mysqli('localhost', 'root', '', 'course_work');
  $cokie = $_COOKIE['customer'];
  $today = date("Y-m-d");
  $query1 = $mysql->query("SELECT * FROM orders WHERE tour_id = $tour_id AND customer_id = $cokie ") or die ($mysql->error);
  $numrows = mysqli_num_rows($query1);

  if($numrows == 0){
    $mysql->query("INSERT INTO orders(tour_id, customer_id,clearance_date,status) VALUES ($tour_id, $cokie,'$today','Новый заказ') ") or die ($mysql->error);
  }
  else{
    $message = "Вы уже заказали этот тур!";
  }
  ?>
  <div class="popup-overlay">
  <div class="popWindow  subscribe_window"><!-- //благодарственное окно после успешной отправки формы -->
    <?php if(empty($message)) {?>
    <p class="thank_you_title">Спасибо за заказ!</p>
    <p class="thank_you_body">Наш менеджер свяжеться с вами в ближайшее время!</p>
  <?php }else { ?>
    <p class="thank_you_title">Внимание</p>
    <p class="thank_you_body"><?=$message?></p>
  <?php } ?>
    <div class="close-btn">&times;</div>
  </div><!-- /thank_you_window -->
  </div>
  <?php
  $mysql->close();
}
function get_customer_orders(){
  $mysql = new mysqli('localhost', 'root', '', 'course_work');
  $cokie = $_COOKIE['customer'];
  $query = $mysql->query("SELECT orders.order_id,country.country_name, resort.resort_name, orders.clearance_date, CONCAT(employee.name, ' ', employee.surname) AS employee_name, orders.status,tour.tour_cost FROM
                    orders INNER JOIN tour ON orders.tour_id = tour.tour_id
                    INNER JOIN resort ON tour.resort_id = resort.resort_id
                    INNER JOIN country ON resort.country_id = country.country_id
                    INNER JOIN employee ON tour.employee_id = employee.employee_id WHERE customer_id = $cokie") or die ($mysql->error);
  $numrows = mysqli_num_rows($query);
    $mysql->close();
    if($numrows == 0){
      return 0;
    }else {
      return $query;
    }
}
function get_employee_orders(){
  $mysql = new mysqli('localhost', 'root', '', 'course_work');
  $cokie = $_COOKIE['employee'];
  $query = $mysql->query("SELECT orders.order_id,country.country_name, resort.resort_name, orders.clearance_date, CONCAT(customer.name,' ', customer.surname) AS customer_name,
   customer.phone,customer.email,  orders.status,tour.tour_cost,  CONCAT(internationalpassport.series, internationalpassport.number) AS passport FROM
orders INNER JOIN tour ON orders.tour_id = tour.tour_id
INNER JOIN resort ON tour.resort_id = resort.resort_id
INNER JOIN country ON resort.country_id = country.country_id
INNER JOIN customer ON orders.customer_id = customer.customer_id
INNER JOIN internationalpassport ON customer.customer_id = internationalpassport.customer_id WHERE employee_id = $cokie") or die ($mysql->error);
  $numrows = mysqli_num_rows($query);
    $mysql->close();
    if($numrows == 0){
      return 0;
    }else {
      return $query;
    }
}

function create_order_fornew($tour_id, $customer_id){
  $mysql = new mysqli('localhost', 'root', '', 'course_work');
  $query1 = $mysql->query("SELECT * FROM orders WHERE tour_id = $tour_id AND customer_id = $customer_id ") or die ($mysql->error);
  $numrows = mysqli_num_rows($query1);
  $today = date("Y-m-d");
  if($numrows == 0){
    $mysql->query("INSERT INTO orders(tour_id, customer_id,clearance_date,status) VALUES ($tour_id, $customer_id,'$today','Новый заказ') ") or die ($mysql->error);
    return 1;
  }
  else{
    return 0;
  }
}
function create_customer($name,$surname,$address,$email,$phone){
$mysql = new mysqli('localhost', 'root', '', 'course_work');
$name = filter_var(trim($_POST['Name']),FILTER_SANITIZE_STRING);
$surname = filter_var(trim($_POST['Surname']),FILTER_SANITIZE_STRING) ;
$address = filter_var(trim($_POST['Address']),FILTER_SANITIZE_STRING) ;
$phone =  filter_var(trim($_POST['Phone']),FILTER_SANITIZE_STRING);
$email =  filter_var(trim($_POST['Email']),FILTER_SANITIZE_STRING);

$query1 = $mysql->query("SELECT * FROM customer  WHERE email = '$email' ") or die ($mysql->error);

$numrows = mysqli_num_rows($query1);

if($numrows == 0){
  $mysql->query("INSERT INTO customer (name,surname,email,address,phone)
  VALUES('$name','$surname','$email','$address','$phone')") or die ($mysql->error);
  $query2 =   $mysql->query("SELECT customer_id FROM customer WHERE email = '$email'");
  $row = mysqli_fetch_assoc($query2);
    $mysql->close();
  return $row["customer_id"];
}
else{

  $mysql->close();
  return 0;
}
}
 function change_customer(  $name,$surname,$address,$phone,$email,$pass,$series,$number ){
  $name = filter_var(trim($name),FILTER_SANITIZE_STRING);
  $surname = filter_var(trim($surname),FILTER_SANITIZE_STRING) ;
  $address = filter_var(trim($address),FILTER_SANITIZE_STRING) ;
  $phone =  filter_var(trim($phone),FILTER_SANITIZE_STRING);
  $email =  filter_var(trim($email),FILTER_SANITIZE_STRING);
  $pass =  filter_var(trim($pass),FILTER_SANITIZE_STRING);
  $series = filter_var(trim($series),FILTER_SANITIZE_STRING);
  $number = filter_var(trim($number),FILTER_SANITIZE_STRING);
  $pass = md5($pass."dsfadfghs");
  $mysql = new mysqli('localhost', 'root', '', 'course_work');
  $cokie = $_COOKIE['customer'];
  if(empty($pass)){
    $mysql->query("UPDATE customer SET name = '$name', surname = '$surname',
                           address = '$address', phone = '$phone', email = '$email'
                            WHERE customer_id ='$cokie' ") or die ($mysql->error);
  }else{
    $mysql->query("UPDATE customer SET name = '$name', surname = '$surname',
                           address = '$address', phone = '$phone', email = '$email', pass = '$pass'
                            WHERE customer_id ='$cokie' ") or die ($mysql->error);
  }

 $mysql->query("UPDATE internationalpassport SET series = '$series', number = $number  WHERE internationalpassport.customer_id ='$cokie' ") or die ($mysql->error);
 $mysql->close();
}
function uploadImage($image)
{
  $name = $image['name'];
  $tmp_name = $image['tmp_name'];

  move_uploaded_file($tmp_name,"img/".$name);
}

function sendEmail($name, $email, $subject,$message){
  $subject = "=?utf-8?B".base64_encode($subject)."?=";
  $headers = "From: $name <$email> \r\nReply-to: $email\r\nContent-type: text/html;charset=utf-8\r\n";
  mail('ivanlichkovaxa@gmail.com', $subject,$message,$headers);
}
function update_tour($resort_id,$excursions,$arrivale_date,$departure_date,$accomodation_id,$food_id,$transport_id,$employee_id,$tour_cost,$tour_id){
  $mysql = new mysqli('localhost', 'root', '', 'course_work');

  $query = $mysql->query("UPDATE tour SET resort_id = $resort_id, excursions = '$excursions',arrival_date = '$arrivale_date',
                          departure_date = '$departure_date', accomodation_id = $accomodation_id, food_id = $food_id,
                            transport_id = $transport_id, employee_id = $employee_id, tour_cost = $tour_cost WHERE tour_id = $tour_id") or die ($mysql->error);
 $mysql->close();
}
function add_tour($resort_id,$excursions,$arrival_date,$departure_date,$accomodation_id,$food_id,$transport_id,$employee_id,$tour_cost,$supplier_id,$photo,$note){
  $mysql = new mysqli('localhost', 'root', '', 'course_work');

  $query = $mysql->query("INSERT INTO tour(resort_id,excursions,arrival_date,departure_date,accomodation_id,food_id,transport_id,employee_id,tour_cost,supplier_id,photo,note)
                        VALUES ($resort_id,'$excursions','$arrival_date','$departure_date',$accomodation_id,$food_id,$transport_id,$employee_id,$tour_cost,$supplier_id,'$photo','$note')") or die ($mysql->error);
 $mysql->close();
}
function get_tour_info($value){
  $mysql = new mysqli('localhost', 'root', '', 'course_work');
  if($value == "resort"){
      $query = $mysql->query("SELECT resort.resort_id,CONCAT(country.country_name,',',resort.resort_name) AS country_resort FROM resort
INNER JOIN country ON resort.country_id = country.country_id
 ") or die ($mysql->error);
}else{
  $query = $mysql->query("SELECT  * from $value ") or die ($mysql->error);
}


      $mysql->close();
  return $query;


}

function addFilterCondition($where, $add, $and = true) {
  if ($where) {
    if ($and) $where .= " AND $add";
    else $where .= " OR $add";
  }
  else $where = $add;
  return $where;
}
function get_tour($id){
  $mysql = new mysqli('localhost', 'root', '', 'course_work');
  $query = $mysql->query("SELECT tour.tour_id, country.country_name,resort.resort_name,accomodation.accomodation_type,food.food_type,transport.transport_type,
            tour.excursions, tour.arrival_date, tour.departure_date, tour.tour_cost, tour.photo, tour.note, supplier.supplier_name
            FROM tour INNER JOIN resort ON tour.resort_id = resort.resort_id
            INNER JOIN country ON resort.country_id = country.country_id
            INNER JOIN accomodation ON tour.accomodation_id = accomodation.accomodation_id
            INNER JOIN food ON tour.food_id = food.food_id
            INNER JOIN transport ON tour.transport_id = transport.transport_id
            INNER JOIN supplier ON tour.supplier_id = supplier.supplier_id WHERE tour.tour_id = $id") or die ($mysql->error);
  $row = mysqli_fetch_assoc($query);
  $mysql->close();
  return $row;
}
class Paginator {

        private $_conn;
        private $_limit;
        private $_page;
        private $_query;
        private $_total;
        public function __construct( $conn, $query ) {
          $this->_conn = $conn;
          $this->_query = $query;
          $rs= $this->_conn->query( $this->_query );
          $this->_total = $rs->num_rows;
        }

        public function getData( $limit = 10, $page = 1 ) {
          $this->_limit   = $limit;
          $this->_page    = $page;
          if ( $this->_limit == 'all' ) {
              $query = $this->_query;
          } else {
              $query = $this->_query . " LIMIT " . ( ( $this->_page - 1 ) * $this->_limit ) . ", $this->_limit";
          }
          $rs  = $this->_conn->query( $query );
            $result         = new stdClass();
          if(mysqli_num_rows($rs) != 0)
          {
            while ( $row = mysqli_fetch_assoc($rs) ) {
                $results[]  = $row;
            }
              $result->page   = $this->_page;
              $result->limit  = $this->_limit;
              $result->total  = $this->_total;
              $result->data   = $results;

          }
          else
          {
            $result->data = 0;
          }
            return $result;


        }

public  function createLinks( $links,$href) {
   if ( $this->_limit == 'all' ) {
       return '';
   }
   $last       = ceil( $this->_total / $this->_limit );
   $start      = ( ( $this->_page - $links ) > 0 ) ? $this->_page - $links : 1;
   $end        = ( ( $this->_page + $links ) < $last ) ? $this->_page + $links : $last;
     $filter = "";
     if(isset($_GET['inputCountry'] )) $filter .= "&inputCountry=".$_GET["inputCountry"]."";
     if(isset($_GET['inputTransport'])) $filter .= "&inputTransport=".$_GET["inputTransport"]."";
     if(isset($_GET['inputDateIn'] ))$filter .= "&inputDateIn=".$_GET["inputDateIn"]."";
     if(isset($_GET['inputDateOut'] )) $filter .= "&inputDateOut=".$_GET["inputDateOut"]."";
     if(isset($_GET['inputAccomodation']) ) $filter .= "&inputAccomodation=".$_GET["inputAccomodation"]."";
     if(isset($_GET['inputFood'] )) $filter .= "&inputFood=".$_GET["inputFood"]."";
     if(isset($_GET['inputSupplier'])) $filter .= "&inputSupplier=".$_GET["inputSupplier"]."";
     if(isset($_GET['Search'])) $filter .= "&Search=".$_GET["Search"]."";
     if (isset($_GET["checkExcursion"])) $filter .= "&checkExcursion=".$_GET["checkExcursion"]."";
     if(isset($_GET['inputMinPrice'])) $filter .= "&inputMinPrice=".$_GET["inputMinPrice"]."";
     if(isset($_GET['inputMaxPrice'])) $filter .= "&inputMaxPrice=".$_GET["inputMaxPrice"]."";?>
     <ul class="pagination pagination-sm">
       <?php $class      = ( $this->_page == 1 ) ? "disabled" : ""; ?>
       <li class=" <?=$class?>  page-item"><a class="page-link" href="<?=$href?>?limit=<?=$this->_limit?>&page=<?=( $this->_page - 1 )?><?=$filter?>">&laquo;</a></li>
       <?php   if ( $start > 1 ) {?>
         <li class="page-item"><a class="page-link" href="<?=$href?>?limit=<?=$this->_limit?>&page=1<?=$filter?>">1</a></li>
         <li class="disabled page-item"><span>...</span></li>
         <?php }
         for ( $i = $start ; $i <= $end; $i++ ) {
             $class  = ( $this->_page == $i ) ? "active" : ""; ?>
             <li class="<?=$class?> page-item"><a class="page-link" href="<?=$href?>?limit=<?=$this->_limit?>&page=<?=$i?><?=$filter?>"><?=$i?></a></li>
         <?php }
          if ( $end < $last ) {?>
            <li class="disabled page-item"><span>...</span></li>
            <li class="page-item"><a class="page-link" href="<?=$href?>?limit=<?=$this->_limit?>&page=<?=$last?><?=$filter?>"><?=$last?></a></li>
         <?php }
          $class      = ( $this->_page == $last ) ? "disabled" : ""; ?>
          <li class="<?=$class?> page-item"><a class="page-link" href="<?=$href?>?limit=<?=$this->_limit?>&page=<?=( $this->_page + 1 )?><?=$filter?>">&raquo;</a></li>
     </ul>
<?php
}
}
 ?>
