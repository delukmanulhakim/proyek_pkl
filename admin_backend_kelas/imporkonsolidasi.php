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

    if (isset($_POST['imporkonsolidasi']))
    {
        $file = $_FILES['file']['name'];
        $ekstensi = explode (".", $file);
        $file_name = "file".round(microtime(true)).".".end($ekstensi);
        $sumber = $_FILES['file']['tmp_name'];
        $target_dir ="template/import/";
        $target_file = $target_dir.$file_name;
        $upload = move_uploaded_file($sumber, $target_file);      

        $file_excel = PHPExcel_IOFactory::load($target_file);
        $data_excel = $file_excel->getActiveSheet()->toArray(null, true,true,true);

        $data_excel2 = $file_excel->getActiveSheet()->toArray(null, true,true,true);


        $status = "A";
        $sql_periode = mysqli_query($con, "SELECT id FROM tb_periode WHERE stat='$status'") or die (mysqli_error($con));
        $data_periode = mysqli_fetch_assoc($sql_periode);
        $id_periode = $data_periode['id'];

        for ($j=2; $j <= count($data_excel); $j++)
        {
          $nid              = $data_excel[$j]['B'];
          $kode_matkul      = $data_excel[$j]['C'];
          $kelas            = $data_excel[$j]['D'];
          $nim              = $data_excel[$j]['E'];
          $empty            = "";

          $cekkm= mysqli_query($con, "SELECT nid,kode,id_periode,kelas FROM tb_kelasmatkul WHERE nid = '$nid' AND kode = '$kode_matkul' AND id_periode = '$id_periode' AND kelas = '$kelas'") or die (mysqli_error($con));
          $isthereany = mysqli_num_rows($cekkm);

          if ($isthereany==0){
              $cekdosen = mysqli_query($con, "SELECT nid FROM tb_dosen WHERE nid='$nid'") or die (mysqli_error($con));
              $cekmakul = mysqli_query($con, "SELECT kode FROM tb_matkul WHERE kode='$kode_matkul'") or die (mysqli_error($con));
               
              $anydosen = mysqli_num_rows($cekdosen);
              $anymk    = mysqli_num_rows($cekmakul);

              if ($anydosen==1 && $anymk==1){
                mysqli_query($con, "INSERT INTO tb_kelasmatkul VALUES ('','$nid','$kode_matkul','$id_periode','$kelas')") or die (mysqli_error($con));
                mysqli_query($con, "DELETE FROM tb_kelasmatkul WHERE nid='$empty'") or die (mysqli_error($con));
              }
              else{

              }
            }
          else{
          }
         
        }

        for ($h=2; $h <= count($data_excel2); $h++)
        {
          $nid2              = $data_excel2[$h]['B'];
          $kode_matkul2      = $data_excel2[$h]['C'];
          $kelas2            = $data_excel2[$h]['D'];
          $nim2              = $data_excel2[$h]['F'];
          $empty2            = "";

          $cekkls  = mysqli_query($con, "SELECT id FROM tb_kelasmatkul WHERE nid = '$nid2' AND kode = '$kode_matkul2' AND id_periode = '$id_periode' AND kelas = '$kelas2'") or die (mysqli_error($con));
          $arr     = mysqli_fetch_assoc($cekkls);
          $idkelas = $arr['id'];
          $isthereanykls = mysqli_num_rows($cekkls);
          if ($isthereanykls==1)
          {
            $nimmhs = $nim2;
            $query_cek_mhs = mysqli_query($con,"SELECT nim FROM tb_mahasiswa WHERE nim='$nimmhs'") or die (mysqli_error($con));
            $anymhs = mysqli_num_rows($query_cek_mhs);
            if ($anymhs==1){
              $query_cek_peserta_matkul = mysqli_query($con,"SELECT * FROM tb_pesertamatkul WHERE id_klsmatkul='$idkelas' AND nim='$nimmhs'") or die (mysqli_error($con));
              $anypeserta = mysqli_num_rows($query_cek_peserta_matkul);
                if($anypeserta==0){
                  mysqli_query($con, "INSERT INTO tb_pesertamatkul VALUES ('$idkelas','$nimmhs','$id_periode')") or die (mysqli_error($con));
                }else{ 
                }
              }else{

            }
          }
          else{

          }
         
        }
    unlink($target_file);
    }
    ?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  swal("Berhasil", "Data Mata kuliah telah ditambahkan", "success");
  
  setTimeout(function(){ 
   window.location.href = "../admin_backend_kelas";

  }, 1000);
</script>
</body>
</html>