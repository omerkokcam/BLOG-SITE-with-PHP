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

    <title>Blog Ekle | Panel</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="../ckeditor/ckeditor.js" ></script>
    <link rel="shortcut icon" type="image/png" href="../../img/fav-icon.png">

</head>

<body>

<?php
if(@$_POST["submit"]){
//eger kaydete tıklanırsa işlemler başlasın.
$baslik =htmlspecialchars($_POST["baslik"],ENT_QUOTES,'UTF-8');
$alt_baslik =htmlspecialchars($_POST["alt_baslik"],ENT_QUOTES,'UTF-8');
$aciklama =htmlspecialchars($_POST["aciklama"],ENT_QUOTES,'UTF-8');
$aktiflik =htmlspecialchars($_POST["aktiflik"],ENT_QUOTES,'UTF-8');
$ekle = $db->prepare("INSERT INTO  `blog`(`baslik`,`alt_baslik`,`aciklama`,`aktiflik`)VALUES (:baslik,:alt_baslik,:aciklama,:aktiflik)");
$ekle->bindValue(":baslik",$baslik,PDO::PARAM_STR);
$ekle->bindValue(":alt_baslik",$alt_baslik,PDO::PARAM_STR);
$ekle->bindValue(":aciklama",$aciklama,PDO::PARAM_STR);
$ekle->bindValue(":aktiflik",$aktiflik,PDO::PARAM_INT);
if($ekle->execute()){

    header("Location:blog.php?i=ekle");
}
else{
    //print_r($ekle->errorInfo());
    header("Location:blog.php?i=hata");
}
}



?>

    <div id="wrapper">

        <?php

 include_once "inc-menu.php";
?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Yeni Ekle</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                         <a href="blog.php"  class="btn btn-primary"> < Geri Dön</a>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action="" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                            <label>Başlık</label>
                                            <input class="form-control" name="baslik" placeholder="Başlık Giriniz...">
                                        </div>
                                        <div class="form-group">
                                            <label>Alt Başlık</label>
                                            <input class="form-control" name="alt_baslik" placeholder="Alt başlık Giriniz...">
                                        </div>
                                        <div class="form-group">
                                            <label>Açıklama</label>
                                            <textarea class="form-control" rows="3" name="aciklama" placeholder="Açıklama..." id="mytextarea"></textarea>
                                        </div>
                                       
                                        <div class="form-group">
                                            <label>Aktiflik
                                            </label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="aktiflik"  value="1" checked>Aktif
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="aktiflik"  value="0">İnaktif
                                                </label>
                                            </div>
                                           
                                        </div>
                                        <input type="submit" name="submit" class="btn btn-default" value="KAYDET">
                                        <input type="reset" name="submit" class="btn btn-default" value="TEMİZLE">
                                       
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
    <script >CKEDITOR.replace('mytextarea') </script>
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
