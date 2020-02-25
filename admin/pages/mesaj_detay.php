<?php
require_once 'inc-functions.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Mesaj Oku | Panel</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" type="image/png" href="../../img/fav-icon.png">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="../js/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
  tinymce.init({
    selector: '#mytextarea'
  });
  </script>

</head>

<body>

<?php
@$id=$_GET["id"];
//mesaj okundu bilgisi bu sayfayı açmışsa zaten okumuştur.
$okundu=$db->prepare("UPDATE `iletisim` SET `okundu` = :okundu WHERE `id` = :id ");
$okundu->bindValue(":okundu",1,PDO::PARAM_INT);
$okundu->bindValue(":id",$id,PDO::PARAM_INT);
$okundu->execute();
$cek=$db->prepare("SELECT * FROM `iletisim` WHERE `id`=:id");
$cek->bindValue(":id",$id,PDO::PARAM_INT);
$cek->execute();
$row=$cek->fetch(PDO::FETCH_ASSOC);







?>

    <div id="wrapper">

        <?php

 include_once "inc-menu.php";
?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">MESAJ(<?=$id?>)</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                         <a href="mesajlar.php"  class="btn btn-primary"> < Geri Dön</a>
                        <?php
                          if(@$_GET["i"]=="updt"){
    
    echo "<span class='text-success'> Güncellenme İşlemi Başarılı! </span>";
}
elseif(@$_GET["i"]=="hata2"){
    echo "<span class='text-danger'>Güncellenme İşleminde HATA Oluştu! </span>";
  }?>

                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form >
                                    <div class="form-group">
                                           <p><b>AD-SOYAD:<?=$row["ad"]?></b></p>
                                           <p><b>EMAİL:<?=$row["email"]?></b></p>
                                           <p><b>MESAJ:<?=$row["mesaj"]?></b></p>
                                           <p><b>TARİH:<?=$row["tarih"]?></b></p>
                                            </div>
                                           
                                        </div>
            
                             <a href="mesajlar.php?is=sil&id=<?=$row["id"]?> " onclick="return confirm('Silmek İstediğinize Emin misiniz?')"
                             class="btn btn-danger btn-xs" style="margin-right: 15px"> SİL </a> 
                                        
                                       
                                    </form>
                                </div>
                              
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
