<?php
if(empty($_COOKIE['customer'])){
    header('Location: auth.php');
}
 ?>
 <?php
 require_once('functions.php');
 ?>
<!DOCTYPE html>
  <html lang="ru"><head>
      <meta charset="utf-8">
      <meta name = "viewport" content="width=device-width, inital-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <link href="css/style.css" rel="stylesheet">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        window.alert = function(){};
        var defaultCSS = document.getElementById('bootstrap-css');
        function changeCSS(css){
            if(css) $('head > link').filter(':first').replaceWith('<link rel="stylesheet" href="'+ css +'" type="text/css" />');
            else $('head > link').filter(':first').replaceWith(defaultCSS);
        }
        $( document ).ready(function() {
          var iframe_height = parseInt($('html').height());
          window.parent.postMessage( iframe_height, 'https://bootsnipp.com');
        });
    </script>
</head>

<body>
    <?php require "blocks/header.php" ?>
      <?php $temp = get_customers(); ?>
    <div class="container" style="padding-top: 60px;">
  <h1 class="page-header">Edit Profile</h1>
  <div class="row">
    <!-- left column -->

    <div class="col-md-4 col-sm-6 col-xs-12">
      <form action="Upload.php" method="post" enctype="multipart/form-data">
        <div class="text-center">
          <?php if(empty($temp['photo'])) {?>
          <img src="https://x1.xingassets.com/assets/frontend_minified/img/users/nobody_m.original.jpg" class="avatar img-circle img-thumbnail" alt="avatar">
          <?php }else { ?>
          <img src="<?=$temp['photo']?>" class="avatar img-circle img-thumbnail img-fluid" alt="avatar">
          <?php } ?>
          <h6>Upload a different photo...</h6>
          <input type="file" class="text-center center-block well well-sm" name="image">
            <input class="btn" value="Upload" type="submit" name="Upload">
        </div>
      </form>
    </div>

    <!-- edit form column -->
    <div class="col-md-6 col-sm-6 col-xs-12 personal-info">
        <?php if(isset($_POST['SaveChanges'])) {?>
      <div class="alert alert-info alert-dismissable">
        <a class="panel-close close" data-dismiss="alert">×</a>
        <i class="fa fa-coffee"></i>
        Data updated successfully!
      </div>
      <?php } ?>
      <h3>Personal info</h3>
      <form class="form-horizontal" role="form" action="" method="post">

        <div class="form-group">
          <label class="col-lg-3 control-label">First name:</label>
          <div class="col-lg-8">
            <input class="form-control" value="<?=$temp['name']?>" type="Name"  name="Name" required="">
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-3 control-label">Passport:</label>
          <div class="row">
    
            <div class="col-lg-2">
              <input class="form-control" value="<?=$temp['series']?>" type="Series" name="Series"  required="">
            </div>
            <div class="col-lg-6">
              <input class="form-control" value="<?=$temp['number']?>" type="Series" name="Number"  required="">
            </div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-3 control-label">Last name:</label>
          <div class="col-lg-8">
            <input class="form-control" value="<?=$temp['surname']?>" type="Surname" name="Surname"  required="">
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-3 control-label">Email:</label>
          <div class="col-lg-8">
            <input class="form-control" value="<?=$temp['email']?>" type="Email" name="Email" required="">
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-3 control-label">Phone:</label>
          <div class="col-md-8">
            <input class="form-control" value="<?=$temp['phone']?>" type="Phone" name="Phone" required="">
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-3 control-label">Address:</label>
          <div class="col-md-8">
            <input class="form-control" value="<?=$temp['address']?>" type="Address" name="Address" required="">
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-3 control-label">Password:</label>
          <div class="col-md-8">

            <input class="form-control" value="" type="password" name="Password" >
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-3 control-label"></label>
          <div class="col-md-8">
            <input class="btn btn-primary" value="Save Changes" type="submit" name="SaveChanges">
            <span></span>

          </div>
        </div>
      </form>
    </div>
    <div class="col-md-2">
      <form method="post" action="logout.php">
          <input type="submit" class="profile-edit-btn" name="logout" value="Log out">
      </form>
    </div>
  </div>
</div>
</body></html>

<?php
if(isset($_POST['SaveChanges'])){
  change_customer($_POST['Name'],$_POST['Surname'],$_POST['Address'],$_POST['Phone'],$_POST['Email'],$_POST['Password'],$_POST['Series'],$_POST['Number']);

} ?>
