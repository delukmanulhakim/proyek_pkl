  
  <li class="nav-item">
    <a href="../admin_backend_dasbor" class="nav-link <?php if ($hal=='dasbor') { echo 'active';}?>">
      <i class="nav-icon fas fa-tachometer-alt"></i>
      <p>
       Dashboard
      </p>
    </a>
  </li>
  <li class="nav-item">
    <a href="../admin_backend_administrator" class="nav-link <?php if ($hal=='administrator') { echo 'active';}?>">
      <i class="nav-icon fas fa-user"></i>
      <p>
       Administrator
      </p>
    </a>
  </li>
  <li class="nav-item">
    <a href="../admin_backend_periode" class="nav-link <?php if ($hal=='periode') { echo 'active';}?>">
      <i class="nav-icon fas fa-calendar-alt"></i>
      <p>
       Periode Akademik
      </p>
    </a>
  </li>
  <li class="nav-item">
    <a href="../admin_backend_mahasiswa" class="nav-link <?php if ($hal=='mahasiswa') { echo 'active';}?>">
      <i class="nav-icon fas fa-users"></i>
      <p>
       Data Mahasiswa
      </p>
    </a>
  </li>
  <li class="nav-item">
    <a href="../admin_backend_dosen" class="nav-link <?php if ($hal=='dosen') { echo 'active';}?>">
      <i class="nav-icon fas fa-user"></i>
      <p>
       Data Dosen
      </p>
    </a>
  </li>
  <li class="nav-item">
    <a href="../admin_backend_matakuliah" class="nav-link <?php if ($hal=='matakuliah') { echo 'active';}?>">
      <i class="nav-icon fas fa-archway"></i>
      <p>
       Mata Kuliah
      </p>
    </a>
  </li>
  <li class="nav-item">
    <a href="../admin_backend_kelas" class="nav-link <?php if ($hal=='kelasmatkul') { echo 'active';}?>">
      <i class="nav-icon fas fa-book"></i>
      <p>
       Kelas Mata Kuliah
      </p>
    </a>
  </li>
  <li class="nav-item">
    <a href="../admin_presensi" class="nav-link <?php if ($hal=='presensi') { echo 'active';} ?>">
      <i class="nav-icon fas fa-clipboard "></i>
      <p>
      Presensi
      </p>
    </a>
  </li>
  <li class="nav-item">
    <a href="../admin_laporan_presensi" class="nav-link <?php if ($hal == 'laporanpresensi') { echo 'active'; } ?>">
    <i class="fas fa-chart-line"></i>
      <p>
     Grafik Presensi
      </p>
    </a>
  </li>
  <li class="nav-item">
    <a href="../gantipass" class="nav-link <?php if ($hal == 'gantipass') { echo 'active'; } ?>">
      <i class="nav-icon fas fa-lock "></i>
      <p>
      Ganti Password
      </p>
    </a>
  </li>
  <li class="nav-item">
    <a href="../auth/logout.php" class="nav-link">
      <i class="nav-icon fas fa-sign-out-alt "></i>
      <p>
      Keluar
      </p>
  </a>
  </li>