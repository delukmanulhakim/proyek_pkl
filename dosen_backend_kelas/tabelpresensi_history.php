<?php
require_once "../database/config.php";
?>
<table class="table table-bordered table-striped table-sm">
    <thead>
        <tr>
        <th style="width:5%;">No</th>
        <th><center>Mahasiswa</center></th>
        <th><center>Ket</center></th>
        <th><center>Aksi</center></th>
        </tr>
    </thead>
<tbody>
    <?php
        $id_klsmatkul = @$_GET['id_klsmk'];
        $no = 1;
        $tgl = @$_GET['tanggal'];
        $query_peserta = mysqli_query($con, "SELECT tb_presensi.id_klsmatkul, tb_presensi.nim, tb_presensi.kehadiran, tb_mahasiswa.nama FROM tb_presensi,tb_mahasiswa WHERE tb_presensi.nim = tb_mahasiswa.nim AND tb_presensi.id_klsmatkul = '$id_klsmatkul' AND tb_presensi.tanggal = '$tgl' ORDER BY nim ASC") or die(mysqli_error($con));
        if (mysqli_num_rows($query_peserta) > 0)
        {
            while($data = mysqli_fetch_array($query_peserta))
            {
                $nim = $data['nim'];
                $nama = $data['nama'];
            
    ?>
        <tr>
            <td>
                <?=$no++;?>
            </td>
            <td>
               <h6>
               [ <b><?= $data['nim'];?></b> ] <?= $data['nama'];?> 
               </h6>  
            </td>
            <td>
                <center>
                    <?php
                        $ket = $data['kehadiran'];
                        if ($ket == 'N')
                        {
                        echo '
                        <h6>
                        <img src="tanda/not.png" alt="tidak absen" width="20px">
                        </h6>
                        ';
                        }
                        else
                        {
                        echo '
                        <h6>
                        <img src="tanda/ya.png" alt="sudah absen" width="20px">
                        </h6>';
                        }
                    ?>
                </center>

                <td>
                        <center>
                        <?php
                                    if ($ket == 'N'){
                                      echo '
                                      <a class="btn btn-success" href="updatehadir.php?id='.$id_klsmatkul.'&nim='.$nim.'&tanggal='.$tgl.'"><i class="nav-icon fas fa-check"></i>Hadir</a>
                                      ';
                                    
                                    } else {
                                       echo '
                                      <h6>
                                      <a class="btn btn-danger" href="updatealfa.php?id='.$id_klsmatkul.'&nim='.$nim.'&tanggal='.$tgl.'" style="background-color:#86090f"><i class="nav-icon fas fa-times"></i>Alfa</a>
                                   </h6>';
                                    }
                                    ?>

                        </center>
                    </td>
            </td>
        </tr>
    <?php
    }
    }else
    {
      echo "<tr><td colspan=\"5\" align=\"center\"><h6>Data Tidak Ditemukan!</h6></td></tr>";
    }
    ?>
    </tbody>
    <tfoot>

    </tfoot>
</table>