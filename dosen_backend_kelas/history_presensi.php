<?php
require_once '../database/config.php';
$hal = "kelas";
if (isset($_SESSION['peran'])) {
    if ($_SESSION['peran'] != 'dosen') {
        echo "<script>window.location='../auth/logout.php';</script>";
    } else {
    }
} else {
    echo "<script>window.location='../auth/logout.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dosen Panel I Presensi</title>
    <?php
    include '../linksheet.php';
    ?>

</head>
<!--
body tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-miniprs
-->

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <?php
        include '../navbar.php';
        ?>
        <!-- Main Sidebar Container -->

        <div class="sidebar">

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                    <?php
                    include '../sidebar_dosen.php';
                    ?>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
        </aside>





        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="content">
                <div class="container-fluid" style="padding-top:10px">

                    <div class="card">
                        <div class="card-header" style="background-color:#86090f">
                            <font color="ffffff">
                                <h3 class="card-title"><i class="nav-icon fas fa-history"></i> History Absensi mahasiswa </h3>
                            </font>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                           
                            <?php
                           $id_klsmatkul = @$_GET['id'];
           
                           $validasi = 0;
                           if (isset($_POST['cari']))
                           {
                             $postpertemuan= trim(mysqli_real_escape_string($con, $_POST['pertemuan']));
                           }else{
                             $tgl = @$_GET['tanggal'];
                             $querypertemuanke = mysqli_query($con, "SELECT pertemuan FROM tb_pertemuan WHERE id_klsmatkul='$id_klsmatkul' AND tanggal='$tgl'") or die (mysqli_error($con));
                             $data_pertemuan = mysqli_fetch_assoc($querypertemuanke);
                             $postpertemuan = $data_pertemuan['pertemuan'];
                           }
                           $pertemuan_ke = $postpertemuan;
                           $tgl = date('Y-m-d');

                            $sql_kelasmatkul = mysqli_query($con, "SELECT tb_periode.tahun as tahun,tb_periode.semester as semester, tb_periode.id as id_periode, tb_dosen.nama as nama_dosen,tb_matkul.nama_ind as nama_mk_ind,tb_matkul.nama_eng as nama_mk_ing,tb_kelasmatkul.kelas as kelas, tb_pertemuan.id_klsmatkul as id_klsmatkul, tb_pertemuan.pertemuan as pertemuan FROM tb_periode,tb_dosen,tb_matkul,tb_kelasmatkul,tb_pertemuan WHERE tb_kelasmatkul.id='$id_klsmatkul' AND tb_kelasmatkul.nid = tb_dosen.nid AND tb_periode.id=tb_kelasmatkul.id_periode AND tb_matkul.kode=tb_kelasmatkul.kode") or die(mysqli_error($con));
                            $dataklsmatkul = mysqli_fetch_assoc($sql_kelasmatkul);


                            $sql_datamhs = mysqli_query($con, "SELECT * FROM tb_pesertamatkul WHERE id_klsmatkul='$id_klsmatkul'") or die(mysqli_error($con));
                            if (mysqli_num_rows($sql_datamhs) > 0) {
                                $tgl = date('Y-m-d');
                                $kehadiran = "N";

                                while ($data = mysqli_fetch_array($sql_datamhs)) {
                                    $nim = $data['nim'];
                                    $sql_cekdata = mysqli_query($con, "SELECT * FROM tb_presensi WHERE id_klsmatkul='$id_klsmatkul' AND nim='$nim' AND tanggal='$tgl'") or die(mysqli_error($con));
                                    if (mysqli_num_rows($sql_cekdata) == 0) {
                                        $sql_createdatapresensi = mysqli_query($con, "INSERT INTO tb_presensi VALUES ('$id_klsmatkul','$tgl','$nim','$kehadiran')") or die(mysqli_error($con));
                                    }
                                }
                            }

                          

                            $sql_cektempdata = mysqli_query($con, "SELECT * FROM tb_temp WHERE id_klsmatkul='$id_klsmatkul'") or die(mysqli_error($con));
                            $ket = "ON";
                            if (mysqli_num_rows($sql_cektempdata) > 0) {
                                $sql_cektempdataon = mysqli_query($con, "SELECT * FROM tb_temp WHERE id_klsmatkul='$id_klsmatkul'AND ket='OFF'") or die(mysqli_error($con));
                                if (mysqli_num_rows($sql_cektempdata) > 0) {
                                    mysqli_query($con, "UPDATE tb_temp SET ket='$ket' WHERE id_klsmatkul='$id_klsmatkul'") or die(mysqli_error($con));
                                } else {
                                    echo "ppp";
                                }
                            } else {
                                mysqli_query($con, "INSERT INTO tb_temp VALUE ('$id_klsmatkul','$ket')") or die(mysqli_error($con));
                            }

                            //pertemuan
                $sql_cekpertemuan = mysqli_query($con, "SELECT tanggal FROM tb_pertemuan WHERE id_klsmatkul='$id_klsmatkul' AND pertemuan='$postpertemuan'") or die (mysqli_error($con));
                $sql_pertemuan = mysqli_query($con, "SELECT pertemuan FROM tb_pertemuan WHERE id_klsmatkul='$id_klsmatkul' GROUP BY tanggal") or die (mysqli_error($con));
                if(mysqli_num_rows($sql_cekpertemuan)>0){
                  $datapertemuan = mysqli_fetch_assoc($sql_cekpertemuan); 
                  $tgl = $datapertemuan['tanggal'];
                 
                }else{
                  $pertemuan_ke = "Belum Ada Pertemuan";
                  $tgl = "0000-00-00";
                }
                

                $display_tgl= date_format(date_create_from_format('Y-m-d', $tgl), 'd F Y');
                            ?>
                             <div class="row">
                                <div class="col-lg-12">
                                    Pertemuan Ke :
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-lg-4">
                                    <form class="form-horizontal" action="history_presensi.php?id=<?= $id_klsmatkul; ?>" method="POST">
                                        <div class="form-group">
                                            <select class="form-control" name="pertemuan" requried>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                                <option value="13">13</option>
                                                <option value="14">14</option>
                                                <option value="15">15</option>
                                                <option value="16">16</option>
                                            </select>
                                        </div>

                                </div>



                                <div class="col-lg-6">
                                    <label for="tahun akademik"></label>
                                    <button type="submit" class="btn btn-primary btn-md" name="cari">
                                        <i class="nav-icon fas fa-search"></i> Tampilkan
                                    </button>

                                </div>
                                </form>
                            </div>



                            <a href="../dosen_backend_kelas" class="btn btn-warning">
                                <i class="nav-icon fas fa-reply"></i> Kembali
                            </a>


                            <div class="row">
                                <div class="col-lg-6">

                                    <form role="form">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <table class="table table-bordered table-sm">
                                                    <thead>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><b>Tahun Akademik </b></td>
                                                            <td><?= $dataklsmatkul['tahun'] ?> - <?= $dataklsmatkul['semester'] ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Dosen Pengampu</b></td>
                                                            <td><?= $dataklsmatkul['nama_dosen'] ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Mata Kuliah</b></td>
                                                            <td><?= $dataklsmatkul['nama_mk_ind'] ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Kelas </th>
                                                            <td><?= $dataklsmatkul['kelas'] ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Pertemuan </th>
                                                            <td><?=$pertemuan_ke;?> <?php if($tgl!="0000-00-00")echo " [$display_tgl]"; ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>


                                        </div>
                                    </form>

                                </div>
                                <div class="col-lg-6">

                                    <br>
                                    <!-- general form elements -->
                                    <div class="card card-success">
                                        <div class="card-header">
                                            <h3 class="card-title">Data Mahasiswa</h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <!-- form start -->
                                        <form role="form">
                                            <div class="card-body">

                                                <div id='presensi'>

                                                </div>

                                            </div>
                                            <!-- /.card-body -->
                                        </form>
                                    </div>
                                    <!-- /.card -->


                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <?php
        include("../footer.php");
        ?>


        <!-- ./wrapper -->

        <!-- REQUIRED SCRIPTS -->
        <?php
        include '../script.php';
        ?>

        <script language="javascript">
            function getkey(e) {
                if (window.event)
                    return window.event.keyCode;
                else if (e)
                    return e.which;
                else
                    return null;
            }

            function goodchars(e, goods, field) {
                var key, keychar;
                key = getkey(e);
                if (key == null) return true;

                keychar = String.fromCharCode(key);
                keychar = keychar.toLowerCase();
                goods = goods.toLowerCase();

                // check goodkeys
                if (goods.indexOf(keychar) != -1)
                    return true;
                // control keys
                if (key == null || key == 0 || key == 8 || key == 9 || key == 27)
                    return true;

                if (key == 13) {
                    var i;
                    for (i = 0; i < field.form.elements.length; i++)
                        if (field == field.form.elements[i])
                            break;
                    i = (i + 1) % field.form.elements.length;
                    field.form.elements[i].focus();
                    return false;
                };
                // else return false
                return false;
            }
        </script>
        <script type="text/javascript">
            $(document).ready(function() {
                refreshTable();
            });

            function refreshTable() {
                $('#presensi').load('tabelpresensi_history.php?id_klsmk=<?= $id_klsmatkul; ?>&tanggal=<?= $tgl; ?>' , function() {
                    setTimeout(refreshTable, 10000);
                });
            }
        </script>


</body>

</html>