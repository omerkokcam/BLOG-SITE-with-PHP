<?php

require_once "admin/pages/inc-functions.php";
$cek=$db->prepare("SELECT * FROM `hakkimizda`");
$cek->execute();
$row=$cek->fetch(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  

  <title>HAKKIMDA</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

  <!-- Custom styles for this template -->
  <link href="css/clean-blog.min.css" rel="stylesheet">
   <link rel="shortcut icon" type="image/png" href="img/fav-icon.png">
</head>

<body>
  <?php
require_once "includes/inc-menu.php";
?>
  <!-- Page Header -->
  <header class="masthead" style="background-image: url('img/about-bg.jpg');>
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="page-heading">
            <h1>HAKKIMDA</h1>
            <span class="subheading">İŞİM NE?</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
      <center><img style='border:2px solid #999; -webkit-border-radius:8px; -moz-border-radius:8px; border-radius:8px;' src='img/about-me-photo.jpg'> </center>
        <?=htmlspecialchars_decode($row["aciklama"])?>
      </div>
    </div>
  </div>

  <hr>

  <?php
  //footer
   require_once "includes/inc-footer.php";

?>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/clean-blog.min.js"></script>

</body>

</html>
