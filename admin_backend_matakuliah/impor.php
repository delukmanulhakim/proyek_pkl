<?php 
require_once "../database/config.php";
require "../assets_adminlte/dist/phpexcel-xls-library/vendor/phpoffice/phpexcel/Classes/PHPExcel.php";
error_reporting(0);
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<div class="wrapper" style="zoom:90%" !important>
  <?php

    if (isset($_POST['impor']))
    {
        $file = $_FILES['file']['name'];
        $ekstensi = explode (".", $file);
        $file_name = "file".round(microtime(true)).".".end($ekstensi);
        $sumber = $_FILES['file']['tmp_name'];
        $target_dir ="template/";
        $target_file = $target_dir.$file_name;
        $upload = move_uploaded_file($sumber, $target_file);      

        $file_excel = PHPExcel_IOFactory::load($target_file);
        $data_excel = $file_excel->getActiveSheet()->toArray(null, true,true,true);

        for ($j=2; $j <= count($data_excel); $j++)
        {
       $kode      = $data_excel[$j]['B'];
       $namaid    = $data_excel[$j]['C'];
       $namaeng   = $data_excel[$j]['D'];
       $sks       = $data_excel[$j]['E'];
       $empty     = "";

       
         mysqli_query($con, "INSERT INTO tb_matkul VALUES ('','$kode','$namaid','$namaeng','$sks')");       
        }
    unlink($target_file);
    }
    ?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  swal("Berhasil", "Data Mata kuliah telah ditambahkan", "success");
  
  setTimeout(function(){ 
   window.location.href = "../admin_backend_matakuliah";

  }, 1000);
</script>
</body>
</html>