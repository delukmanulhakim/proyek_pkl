-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Bulan Mei 2024 pada 15.20
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sipesi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_dosen`
--

CREATE TABLE `tb_dosen` (
  `nid` varchar(10) NOT NULL,
  `nama` text NOT NULL,
  `nohp` varchar(15) NOT NULL,
  `kelamin` varchar(1) NOT NULL,
  `stat` varchar(1) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_dosen`
--

INSERT INTO `tb_dosen` (`nid`, `nama`, `nohp`, `kelamin`, `stat`, `foto`) VALUES
('812', 'Fathulloh, M.Kom', '082356', 'L', 'A', ''),
('813', 'Sorikhi, M.Kom', '082356', 'L', 'A', ''),
('814', 'Khurotul, M.Kom', '082356', 'P', 'A', ''),
('815', 'Asep M.Kom', '082356', 'L', 'A', ''),
('816', 'Mega, M.Kom', '082356', 'P', 'A', ''),
('817', 'Eko, M.Kom', '082356', 'L', 'A', ''),
('818', 'Nabyla, M.Kom', '082356', 'P', 'A', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jurusan`
--

CREATE TABLE `tb_jurusan` (
  `kode` varchar(10) NOT NULL,
  `nama` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_jurusan`
--

INSERT INTO `tb_jurusan` (`kode`, `nama`) VALUES
('FST001', 'Informatika'),
('FST002', 'Sistem Informasi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kelasmatkul`
--

CREATE TABLE `tb_kelasmatkul` (
  `id` int(11) NOT NULL,
  `nid` varchar(10) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `id_periode` int(11) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `kode_jurusan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kelasmatkul`
--

INSERT INTO `tb_kelasmatkul` (`id`, `nid`, `kode`, `id_periode`, `kelas`, `kode_jurusan`) VALUES
(1, '815', 'A01', 4, 'A', 'FST001'),
(2, '812', 'A02', 4, 'B', 'FST002'),
(6, '816', 'A05', 4, 'A', 'FST002');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_mahasiswa`
--

CREATE TABLE `tb_mahasiswa` (
  `nim` varchar(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `kelamin` varchar(1) NOT NULL,
  `nohp` varchar(15) NOT NULL,
  `stat` varchar(1) NOT NULL,
  `foto` text NOT NULL,
  `kode_jurusan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_mahasiswa`
--

INSERT INTO `tb_mahasiswa` (`nim`, `nama`, `kelamin`, `nohp`, `stat`, `foto`, `kode_jurusan`) VALUES
('42421020', 'Izmi panji  gumilang', 'L', '82168890123', 'A', '', 'FST001'),
('42421021', 'Tedi Maulana', 'P', '82168890124', 'A', '', 'FST001'),
('42421023', 'Dede Lukmanul Hakim', 'L', '82168890125', 'A', '', 'FST001'),
('42421024', 'Maliki', 'L', '82168890126', 'A', '', 'FST001'),
('42421059', 'Farchanul Umam', 'L', '82168890123', 'A', '', 'FST001'),
('42421060', 'Matien Hakim', 'L', '82168890127', 'A', '', 'FST002'),
('42421061', 'Muarif', 'P', '82168890123', 'A', '', 'FST002'),
('42421063', 'Syafik', 'L', '82168890123', 'A', '', 'FST002'),
('42421088', 'Ricky Andri', 'P', '82168890123', 'A', '', 'FST002');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_matkul`
--

CREATE TABLE `tb_matkul` (
  `id` int(11) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `nama_ind` varchar(200) NOT NULL,
  `nama_eng` varchar(200) NOT NULL,
  `sks` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_matkul`
--

INSERT INTO `tb_matkul` (`id`, `kode`, `nama_ind`, `nama_eng`, `sks`) VALUES
(1, 'A01', 'Pemrograman Berorientasi Objek', 'Objek Oriented Programing', '3'),
(2, 'A02', 'Pemrograman Klien Server', 'Client Server Programing', '3'),
(3, 'A03', 'Kecerdasan Buatan', 'Artificial Inteligent', '3'),
(4, 'A04', 'Data Sains', 'Data Science', '3'),
(5, 'A05', 'Data Mining', 'Data Mining', '3'),
(6, 'B01', 'Pemrograman Dasar', 'Basic Programing', '3'),
(7, 'B02', 'Multimedia', 'Multimedia', '2'),
(8, 'B03', 'Jaringan Komputer', 'Computer Network', '3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengguna`
--

CREATE TABLE `tb_pengguna` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `peran` varchar(50) NOT NULL,
  `nama` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pengguna`
--

INSERT INTO `tb_pengguna` (`id`, `username`, `pass`, `peran`, `nama`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin', 'Dede Lukmanul Hakim'),
(33, 'lukmana', 'e0b1882853a03ccd9f1c5b17119c06ff2d0e8ff5', 'admin', 'lukmana juga'),
(34, '42421020', '0d5eceb0c1c0bc1b5957a2858cb19548d727ed7f', 'mhs', 'Izmi panji  gumilang'),
(35, '42421021', '12da0e9360709de0f80f2e0159456b865d0e08df', 'mhs', 'Tedi Maulana'),
(36, '42421023', '472b07b9fcf2c2451e8781e944bf5f77cd8457c8', 'mhs', 'Dede Lukmanul Hakim'),
(37, '42421024', '1e93493de00cbe67ca74400f3d3abb98b323becc', 'mhs', 'Maliki'),
(38, '42421059', '6ba2f01349145c2cc8e71b887fe7173c19547ba4', 'mhs', 'Farchanul Umam'),
(39, '42421060', '1cbbbbaf1633f232eba723838ccca7b0244677fc', 'mhs', 'Matien Hakim'),
(40, '42421061', 'e1292115ffc04d32a9452bd19daf22c12b1b9516', 'mhs', 'Muarif'),
(41, '42421088', '248ee961307a57162016ba8f5085547a44281467', 'mhs', 'Ricky Andri'),
(42, '42421063', '0927d5de0d3c9e62156becc49eda7dca0dff9718', 'mhs', 'Syafik'),
(56, '812', '872a319ee7a24a0ea855777702e15aae09deb042', 'dosen', 'Fathulloh, M.Kom'),
(57, '813', 'e5373e55562b932ccb1bc770bf77e4bf3f5fc052', 'dosen', 'Sorikhi, M.Kom'),
(58, '814', '3a4b1b6137b78d3a78d80b1d6b447e8d005045b1', 'dosen', 'Khurotul, M.Kom'),
(59, '815', '815', 'dosen', 'Asep M.Kom'),
(60, '816', '9299a81ee29fbf68206ac74ddfe861358b386129', 'dosen', 'Mega, M.Kom'),
(61, '817', '7826a3f53385e8f652684c1e0a12c92635e557cb', 'dosen', 'Eko, M.Kom'),
(62, '818', 'a534b91545ecf43a4fa96174699c71ce95597b03', 'dosen', 'Nabyla, M.Kom');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_periode`
--

CREATE TABLE `tb_periode` (
  `id` int(11) NOT NULL,
  `tahun` varchar(5) NOT NULL,
  `semester` varchar(10) NOT NULL,
  `stat` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_periode`
--

INSERT INTO `tb_periode` (`id`, `tahun`, `semester`, `stat`) VALUES
(2, '2023', 'Genap', 'T'),
(3, '2024', 'Ganjil', 'T'),
(4, '2024', 'Genap', 'A');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pertemuan`
--

CREATE TABLE `tb_pertemuan` (
  `id_klsmatkul` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `pertemuan` int(2) NOT NULL,
  `validasi` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pertemuan`
--

INSERT INTO `tb_pertemuan` (`id_klsmatkul`, `tanggal`, `pertemuan`, `validasi`) VALUES
(2, '2024-04-02', 1, 0),
(2, '2024-04-03', 2, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pesertamatkul`
--

CREATE TABLE `tb_pesertamatkul` (
  `id_klsmatkul` int(11) NOT NULL,
  `nim` varchar(10) NOT NULL,
  `id_periode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pesertamatkul`
--

INSERT INTO `tb_pesertamatkul` (`id_klsmatkul`, `nim`, `id_periode`) VALUES
(1, '42421020', 4),
(1, '42421021', 4),
(1, '42421023', 4),
(1, '42421024', 4),
(1, '42421059', 4),
(6, '42421060', 4),
(6, '42421061', 4),
(6, '42421063', 4),
(6, '42421088', 4),
(2, '42421060', 4),
(2, '42421061', 4),
(2, '42421063', 4),
(2, '42421088', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_presensi`
--

CREATE TABLE `tb_presensi` (
  `id_klsmatkul` int(10) NOT NULL,
  `tanggal` date NOT NULL,
  `nim` int(10) NOT NULL,
  `kehadiran` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_presensi`
--

INSERT INTO `tb_presensi` (`id_klsmatkul`, `tanggal`, `nim`, `kehadiran`) VALUES
(2, '2024-04-02', 42421060, 'Y'),
(2, '2024-04-02', 42421061, 'N'),
(2, '2024-04-02', 42421063, 'N'),
(2, '2024-04-02', 42421088, 'N'),
(1, '2024-04-03', 42421020, 'Y'),
(1, '2024-04-03', 42421021, 'Y'),
(1, '2024-04-03', 42421023, 'Y'),
(1, '2024-04-03', 42421024, 'N'),
(1, '2024-04-03', 42421059, 'N'),
(2, '2024-04-03', 42421060, 'N'),
(2, '2024-04-03', 42421061, 'Y'),
(2, '2024-04-03', 42421063, 'Y'),
(2, '2024-04-03', 42421088, 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_temp`
--

CREATE TABLE `tb_temp` (
  `id_klsmatkul` int(11) NOT NULL,
  `ket` enum('ON','OFF') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_temp`
--

INSERT INTO `tb_temp` (`id_klsmatkul`, `ket`) VALUES
(2, 'ON'),
(1, 'OFF'),
(0, 'ON');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tgl_presensi`
--

CREATE TABLE `tgl_presensi` (
  `id` int(11) NOT NULL,
  `id_klsmatkul` int(11) NOT NULL,
  `tgl_presensi` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_dosen`
--
ALTER TABLE `tb_dosen`
  ADD PRIMARY KEY (`nid`);

--
-- Indeks untuk tabel `tb_kelasmatkul`
--
ALTER TABLE `tb_kelasmatkul`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_mahasiswa`
--
ALTER TABLE `tb_mahasiswa`
  ADD PRIMARY KEY (`nim`);

--
-- Indeks untuk tabel `tb_matkul`
--
ALTER TABLE `tb_matkul`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_periode`
--
ALTER TABLE `tb_periode`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_kelasmatkul`
--
ALTER TABLE `tb_kelasmatkul`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_matkul`
--
ALTER TABLE `tb_matkul`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT untuk tabel `tb_periode`
--
ALTER TABLE `tb_periode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
