
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
<nav class="my-0 mr-md-auto font-weight-normal">
<a href="index.php" title="EasyTravelling">
  <img src="img/Снимок.PNG">
</a>
</nav>
  <nav class="my-2 my-md-0 mr-md-3">
    <a class="p-2 text-dark" href="Support.php">Поддержка</a>
    <a class="p-2 text-dark" href="Myorders.php">Мои заказы</a>
  </nav>
<?php if(empty($_COOKIE['customer']) && empty($_COOKIE['employee']) && empty($_COOKIE['admin'])) { ?>
  <a class="btn btn-outline-primary" href="auth.php">Войти</a>

<?php
}else {
  if(!empty($_COOKIE['employee'])){?>
      <a class="btn btn-outline-primary" href="EmployeeProfile.php">Кабинет работника</a>


<?php
  }else {
    if(!empty($_COOKIE['customer'])){?>
    <a class="btn btn-outline-primary" href="UserProfile.php">Кабинет пользователя</a>
<?php
}else{?>
    <a class="btn btn-outline-primary" href="AdminProfile.php">Кабинет администратора</a>

  <?php
}
}
}
 ?>
</div>
