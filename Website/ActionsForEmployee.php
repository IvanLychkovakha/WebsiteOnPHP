<?php if(isset($_POST['delete'])){
  $mysql = new mysqli('localhost', 'root', '', 'course_work');
  $order =  ($_POST['delete']);

  $mysql->query("DELETE FROM orders WHERE order_id = $order") or die ($mysql->error);
  $mysql->close();
  header('Location: EmployeeProfile.php');
}
 if(isset($_POST['edit'])){
  $mysql = new mysqli('localhost', 'root', '', 'course_work');
  $status = $_POST['inputStatus'];
  $order =  $_POST['edit'];
  $mysql->query("UPDATE orders SET status = '$status' WHERE order_id = $order") or die ($mysql->error);
  $mysql->close();
  header('Location: EmployeeProfile.php');
}

?>
