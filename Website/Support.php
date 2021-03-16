<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <meta name = "viewport" content="width=device-width, inital-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</head>
<body>
  <?php require "blocks/header.php" ?>
  <div class="container mt-5 ">
    <h3> Контактная форма </h3><br>
    <div class="row">
        <div class="col-md-9">
          <?php if(isset($_POST['btnContactUs'])){ ?>
          <div class="alert alert-info alert-dismissable">
            <a class="panel-close close" data-dismiss="alert">×</a>
            <i class="fa fa-coffee"></i>
            <?php   if(strlen($_POST['message'])< 10){
                $message = "Message must be greater than 10 characters";
              }
              else if( $_POST['subject'] == "na"){
                $message = "Please, choose subject";
              }else{
              sendEmail($_POST['Name'],$_POST['Email'],$_POST['subject'],$_POST['message']);
                $message = "Message sent successfully";
              } ?>
            <?=$message?>
          </div>
        <?php } ?>
            <div class="card card-body bg-light  ">
                <form action="" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">
                                Name</label>
                            <input type="Name" class="form-control" id="name" placeholder="Enter name" required="required" name="Name">
                        </div>
                        <div class="form-group">
                            <label for="email">
                                Email Address</label>
                                <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">@</span>
                                  </div>
                                  <input type="email" class="form-control" placeholder="Username" aria-label="Username"name="Email" aria-describedby="basic-addon1">
                                </div>
                        </div>
                        <div class="form-group">
                            <label for="subject">
                                Subject</label>
                            <select id="subject" name="subject" class="form-control" required="required" name="subject">
                                <option value="na" selected="">Choose One:</option>
                                <option value="service">General Customer Service</option>
                                <option value="suggestions">Suggestions</option>
                                <option value="product">Product Support</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">
                                Message</label>
                            <textarea name="message" id="message" class="form-control" rows="9" cols="25" required="required" placeholder="Message"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary float-right" id="btnContactUs" name="btnContactUs">
                            Send Message</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <div class="col-md-3 ">
            <form>
            <legend><span class="glyphicon glyphicon-globe"></span>&nbsp;Our office</legend>
            <address>
                <strong>EasyTravelling, Inc.</strong><br>
                Pushkinska,79/1<br>
                Kharkiv, Ukraine<br>
                <abbr title="Phone">
                    P:</abbr>
                8(800)-555-35-35
            </address>
            <address>
                <strong>Full Name</strong><br>
                <a href="mailto:#">first.last@example.com</a>
            </address>
            </form>
        </div>
    </div>
  <?php require "blocks/footer.php" ?>
</body>
</html>
