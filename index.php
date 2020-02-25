<?php
require_once "admin/pages/inc-functions.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>ANA SAYFA</title>

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
  <header class="masthead" style="background-image: url('img/home-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            
            <h1>HOŞGELDİNİZ!</h1>
            
            <span class="subheading"></span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        
     <?php
     @$kelime=$_GET["ara"];
     if($kelime!=""){
       //eger arama yapıldıysa
       echo "<p>Aranan Kelime: $kelime</p>";
       echo "<p> <a href='index.php' style='color:rgb(0, 125, 170)' ><- Ana Sayfaya geri dön </a></p>";
       echo "<u><p style'color:rgb(0, 125, 210);'><b>BULUNAN SONUÇLAR</b></p></u>";
       $cek=$db->prepare("SELECT * FROM `blog` WHERE `aktiflik`=:aktiflik && `baslik`  LIKE :aranan ORDER BY `id` DESC");
       $cek->bindValue(":aktiflik",1,PDO::PARAM_INT);
       $cek->bindValue(":aranan","%$kelime%",PDO::PARAM_STR);
      
     }
     else{
       //eger arama yapılmadıysa varsayılan kayıtlar gelecek
      $cek=$db->prepare("SELECT *FROM `blog` WHERE `aktiflik`=:aktiflik ORDER BY `id` DESC " );
      $cek->bindValue(":aktiflik",1,PDO::PARAM_INT);
      
      }
      $cek->execute();
      while($row=$cek->fetch(PDO::FETCH_ASSOC)){




     ?>


        <div class="post-preview">
          <a href="blog-detay.php?id=<?=$row["id"]?>">
          <?php
        
      
      ?>
            <h2 class="post-title">
             <?=$row["baslik"] ?>
            </h2>
            <h3 class="post-subtitle">
            <?=$row["alt_baslik"] ?>
            </h3>
          </a>
          <p class="post-meta">YAZAR:
            <a href="hakkimizda.php">ÖMER MİRAÇ KÖKÇAM</a>
            Tarih:<?= $row["tarih"] 
        ?>
           Okunma Sayısı:<?=$row["okunma"] ?>
           
             
        </div>
        <hr>
     <?php
      }
     ?>
        <!-- Pager -->
     
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
