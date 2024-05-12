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
        $file         = $_FILES['file']['name'];
        $ekstensi     = explode (".", $file);
        $file_name    = "file".round(microtime(true)).".".end($ekstensi);
        $sumber       = $_FILES['file']['tmp_name'];
        $target_dir   ="template/";
        $target_file  = $target_dir.$file_name;
        $upload       = move_uploaded_file($sumber, $target_file);      

        $file_excel = PHPExcel_IOFactory::load($target_file);
        $data_excel = $file_excel->getActiveSheet()->toArray(null, true,true,true);

        for ($i=2; $i <= count($data_excel); $i++)
        {
       $nim       = $data_excel[$i]['B'];
       $nama      = addslashes($data_excel[$i]['C']);
       $nohp      = $data_excel[$i]['D'];
       $kelamin   = $data_excel[$i]['E'];
       $stat      = $data_excel[$i]['F'];
       $encpass   = 'pass'.$nim;
       $pass      = sha1($encpass);
       $peran     = 'mhs';
       $empty     = "";
    
        $query_nim = mysqli_query($con,"SELECT nim FROM tb_mahasiswa WHERE nim='$nim'") or die (mysqli_error($con));

        if(mysqli_num_rows($query_nim)==0)
        {
          mysqli_query($con, "INSERT INTO tb_mahasiswa VALUES ('$nim','$nama','$kelamin','$nohp','$stat','$empty')") or die (mysqli_error($con));
          mysqli_query($con, "INSERT INTO tb_pengguna VALUES ('','$nim','$pass','$peran','$nama')") or die (mysqli_error($con));     
          mysqli_query($con, "DELETE FROM tb_mahasiswa WHERE nim='$empty'") or die (mysqli_error($con)); 
          mysqli_query($con, "DELETE FROM tb_pengguna WHERE username='$empty'") or die (mysqli_error($con)); 
        }
        else{
                
        }
        }
    // unlink($target_file);
    }
    ?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  swal("Berhasil", "Data mahasiswa telah ditambahkan", "success");
  
  setTimeout(function(){ 
   window.location.href = "../admin_backend_mahasiswa";

  }, 1000);
</script>
</body>
</html>