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

    <title>Bloglar | Panel</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

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
    <link rel="shortcut icon" type="image/png" href="../../img/fav-icon.png">
</head>

<body>

<?php
//aktiflik değiştirme
@$id=intval(@$_GET["id"]);
if(@$_GET["is"]=="aktif"){
    if($_GET["durum"]==1){
        $durum=0;
    }
    else{
        $durum=1;
    }

   
    
    $aktif = $db->prepare("UPDATE `blog` SET `aktiflik` = :a WHERE `id` = :id ");
    $aktif->bindValue(":a",$durum,PDO::PARAM_INT);
    $aktif->bindValue(":id",$id,PDO::PARAM_INT);
    if($aktif->execute()){
        header("Location:blog.php?i=aktf");

    }
    else{
        header("Location:blog.php?i=hata");
       // print_r($aktif->errorInfo());

    }

}
if(@$_GET["is"]=="sil"){
    $sil=$db->prepare("DELETE FROM `blog` WHERE `id`= :id ");
    $sil->bindValue(":id",$id,PDO::PARAM_INT);
    if($sil->execute()){
        header("Location:blog.php?i=sil");

    }
    else{
        header("Location:blog.php?i=hata1");
       // print_r($aktif->errorInfo());

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
                    <h1 class="page-header">Bloglar</h1>
                   
                </div>
               
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" > <a href="blog-ekle.php" class="btn btn-primary" style="margin-right: 15px">
                            YENİ BLOG EKLE + 
                            </a> 
                            <?php
                      if(@$_GET["i"]=="ekle"){
                          echo "<span class='text-success'>Ekleme İşlemi Başarılı! </span>";
                      }   
                      elseif(@$_GET["i"]=="hata"){
                        echo "<span class='text-danger'>Ekleme İşleminde HATA Oluştu! </span>";
                      }
                     elseif(@$_GET["i"]=="sil"){
                        echo "<span class='text-success'>Silme İşlemi Başarılı! </span>";
                     }
                     elseif(@$_GET["i"]=="hata1"){
                        echo "<span class='text-danger'>Silme İşleminde HATA Oluştu! </span>";
                      }
                      elseif(@$_GET["i"]=="aktf"){
                        echo "<span class='text-success'> Aktiflik Ayarlandı! </span>";
                      }
                      

                     ?></div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Başlık</th>
                                            <th>Tarih</th>
                                            <th>Aktif</th>
                                            <th>Düzenle | Sil</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $cek = $db->prepare("SELECT * FROM `blog` ORDER BY 'id' DESC");
                                        $cek->execute();
                                        while($row=$cek->FETCH(PDO::FETCH_ASSOC)){

                                        
                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?=$row["id"]?></td>
                                            <td><?=$row["baslik"]?></td>
                                            <td><?=$row["tarih"]?></td>
                                            <td>
                                 
                                 <?php
                                 //aktiflik kontrol ediyor. 
                             if($row["aktiflik"]==1){?>
                             <a href="blog.php?is=aktif&id=<?=$row["id"]?>&durum=<?=$row["aktiflik"]?> " onclick="return confirm('Aktiflik Durumu Değiştirilsin mi?')"
                             class="btn btn-success btn-xs" style="margin-right: 15px  "> AKTİF</a>
                             <?php
                             }
                             else{?>
                             <a href="blog.php?is=aktif&id=<?=$row["id"]?>&durum=<?=$row["aktiflik"]?> " onclick="return confirm('Aktiflik Durumu Değiştirilsin mi?')"
                              class="btn btn-danger btn-xs" style="margin-right: 15px  "> İNAKTİF</a>

                             <?php
                              

                             }

                             ?> </a> </td>
                                            <td class="center">
                                           <a href="blog_duzenle.php?id=<?=$row["id"]?>" class="btn btn-warning btn-xs" style="margin-right: 15px "> DÜZENLE </a> 
                             <a href="blog.php?is=sil&id=<?=$row["id"]?> " onclick="return confirm('Silmek İstediğinize Emin misiniz?')"
                             class="btn btn-danger btn-xs" style="margin-right: 15px"> SİL </a> 
                            </td>
                                        </tr>
                                        <?php
                                        }//aktiflik işlemi bitiyor.
                                        ?>
                                    
                                        
                                    </tbody>
                                </table>
                           
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
           
                     
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

    <!-- DataTables JavaScript -->
    <script src="../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
    <script src="../bower_components/datatables-responsive/js/dataTables.responsive.js"></script>
    
    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>

</body>

</html>
