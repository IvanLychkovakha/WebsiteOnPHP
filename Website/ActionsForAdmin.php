
<?php
require_once('functions.php');

if(isset($_POST['UpdateTour'])){
  update_tour($_POST['updateCountry'],$_POST['updateExcursions'] ,$_POST['updateDateIn'],$_POST['updateDateOut'],$_POST['updateAccomodation'],
              $_POST['updateFood'],$_POST['updateTransport'], $_POST['updateEmployee'],$_POST['updatePrice'],$_POST['UpdateTour']);

              header('Location: AdminProfile.php');
}
if(isset($_POST['delete2'])){
  $mysql = new mysqli('localhost', 'root', '', 'course_work');
  $tour_id =  $_POST['delete2'];

  $mysql->query("DELETE FROM tour WHERE tour_id = $tour_id") or die ($mysql->error);
  $mysql->close();
  header('Location: AdminProfile.php');
}
if(isset($_POST['add_tour'])){
  if(!empty($_FILES['addimage']['name'])){
    uploadImage($_FILES['addimage']);
  }
  $photo ="img/".$_FILES['addimage']['name'];
  add_tour($_POST['addCountry'],$_POST['addExcursions'] ,$_POST['addDateIn'],$_POST['addDateOut'],$_POST['addAccomodation'],
              $_POST['addFood'],$_POST['addTransport'], $_POST['addEmployee'],$_POST['addPrice'],$_POST['addSupplier'],$photo,$_POST['note']);
  header('Location: AdminProfile.php');
}
 ?>
