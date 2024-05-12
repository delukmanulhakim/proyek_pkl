<?php
require_once "../database/config.php";

$id = @$_GET['id'];
$nim = @$_GET['nim'];
$tgl = date('Y-m-d');
$kehadiran = "N";
mysqli_query($con,"UPDATE tb_presensi SET kehadiran='$kehadiran' WHERE id_klsmatkul='$id' AND nim='$nim' AND tanggal='$tgl'") or die (mysqli_error($con));
echo '<script>window.location.href = "presensi.php?id='.$id.'";</script>';
?>