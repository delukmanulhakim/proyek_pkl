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

        $status = "A";
        $sql_periode = mysqli_query($con, "SELECT id FROM tb_periode WHERE stat='$status'") or die (mysqli_error($con));
        $data_periode = mysqli_fetch_assoc($sql_periode);
        $id_periode = $data_periode['id'];
        $id_klsmatkul = $_POST['id_klsmatkul'];

        for ($j=2; $j <= count($data_excel); $j++)
        {
          $nim      = $data_excel[$j]['B'];
          $empty     = "";

          $querycekmhs   =  mysqli_query($con, "SELECT nim FROM tb_mahasiswa WHERE nim='$nim'") or die (mysqli_eror($con));
          $querycekklsmkmhs   =  mysqli_query($con, "SELECT * FROM tb_pesertamatkul WHERE nim='$nim' AND id_klsmatkul='$id_klsmatkul'") or die (mysqli_eror($con));

          if ($nim != $empty && !(mysqli_num_rows($querycekklsmkmhs) > 0) && (mysqli_num_rows($querycekmhs) > 0)){
             mysqli_query($con, "INSERT INTO tb_pesertamatkul VALUES ('$id_klsmatkul','$nim','$empty')");
           }else{
           }
        }
    unlink($target_file);
    }
    ?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  swal("Berhasil", "Data Mahasiswa telah ditambahkan", "success");
  
  setTimeout(function(){ 
   window.location.href = "../admin_backend_kelas/kelasmatkul.php?id=<?=$id_klsmatkul;?>";

  }, 1000);
</script>
</body>
</html>