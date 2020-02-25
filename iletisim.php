<?php
require_once "admin/pages/inc-functions.php";
ob_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>İLETİŞİM</title>

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
  <header class="masthead" style="background-image: url('img/contact-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="page-heading">
            <h1>İletişime Geçin</h1>
            <span class="subheading">Sorunuz mu var? Gönderin gelsin.</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <p>Benimle alakalı eleştri ve yorum ya da öneri ve şikayetler için mesaj gönderebilirsiniz.</p>
        <!-- Contact Form - Enter your email address on line 19 of the mail/contact_me.php file to make this form work. -->
        <!-- WARNING: Some web hosts do not allow emails to be sent through forms to common mail hosts like Gmail or Yahoo. It's recommended that you use a private domain email address! -->
        <!-- To use the contact form, your site must be on a live web host with PHP! The form will not work locally! -->
        <form name="sentMessage"  method="POST" action="iletisim.php#bildiri">
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Adınız ve Soyadınız</label>
              <input type="text" class="form-control" name="name" placeholder="Adınız ve Soyadınız" id="name" required>
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Email Adresiniz</label>
              <input type="email" name="email" class="form-control" placeholder="ornek@ornek.com" id="email" required >
              <p class="help-block text-danger"></p>
            </div>
          </div>
         
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Mesajınız</label>
              <textarea rows="5" class="form-control" name="message" placeholder="Mesajınız..." id="message" required ></textarea>
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <br>
          
          <div class="form-group">
       <b><em style="color:rgb(56, 109, 167)"><?= $kontrol=rand(10000,99999); ?></em></b>
            <input style="width: 290px; height: 50px;" type="text" name="captcha" class="form-control " placeholder="Lütfen Doğrulama Kodunu Giriniz..." required>
            
            <br>
            <input type="submit" name="submit" value="GÖNDER" class="btn btn-primary">
            <input type="hidden" name="hcaptcha" value="<?=$kontrol?>">
          </div>
          
          
        </form>
        <?php
        if(@$_POST["submit"]){
          //eger göndere basıldıysa işlemler başlasın.
          @$ad=htmlspecialchars(@$_POST["name"],ENT_QUOTES,'UTF-8');
          $email=htmlspecialchars(@$_POST["email"],ENT_QUOTES,'UTF-8');
          $mesaj=htmlspecialchars(@$_POST["message"],ENT_QUOTES,'UTF-8');
          $ekle=$db->prepare("INSERT INTO `iletisim` (`ad`,`email`,`mesaj`) VALUES (:ad,:email,:mesaj)");
          $ekle->bindValue(":ad",$ad,PDO::PARAM_STR);
          $ekle->bindValue(":email",$email,PDO::PARAM_STR);
          $ekle->bindValue(":mesaj",$mesaj,PDO::PARAM_STR);
          
          
          if(@$_POST["captcha"]==@$_POST["hcaptcha"]){
            if($ekle->execute()){
        
              header("Location:iletisim.php?i=basari&ad=$ad");
              ob_end_clean();
            }
            else{
              header("Location:iletisim.php?i=hata&ad=$ad");
            }
        
          }
          else{
            echo  " <p class='text-center  alert alert-danger'> Lütfen doğrulama kodunuzu kontrol ediniz.    </p>";
          }
        
        }
        
        
        
        
        ?>
       <?php
             echo " <div id='bildiri'></div>";
              if(@$_GET["i"]=="basari"){
               echo "<p  class='text-center alert alert-success'>Mesajınız bana ulaştı ".@$_GET["ad"]." . Mesajınız için teşekkür ederim.</p>";
              }
              elseif(@$_GET["i"]=="hata"){
               echo " <p class='text-center  alert alert-danger'>Özür dileriz ".@$_GET["ad"]." , elektronik mail sunucum cevap vermiyor gibi görünüyor. Lütfen daha sonra tekrar deneyin!</p>";
               }
               ?>
            


         
          
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

  <!-- Contact Form JavaScript -->
  <script src="js/jqBootstrapValidation.js"></script>
  <!--<script src="js/contact_me.js"></script>-->

  <!-- Custom scripts for this template -->
  <script src="js/clean-blog.min.js"></script>

</body>

</html>
