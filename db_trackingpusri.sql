-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2017 at 07:10 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_trackingpusri`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_pengecer`
--

CREATE TABLE `data_pengecer` (
  `id_pengecer` int(11) NOT NULL,
  `kode_pengecer` varchar(25) NOT NULL,
  `nama_pengecer` varchar(50) NOT NULL,
  `nama_perusahaan` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `lat` varchar(30) NOT NULL,
  `lng` varchar(30) NOT NULL,
  `provinsi` varchar(25) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_pengecer`
--

INSERT INTO `data_pengecer` (`id_pengecer`, `kode_pengecer`, `nama_pengecer`, `nama_perusahaan`, `alamat`, `lat`, `lng`, `provinsi`, `status`) VALUES
(1, 'RT0000041599', 'HJ. KOMARIA A', 'MULIA TANI', 'DS TIMBANGAN', '-3.196422', '104.652952', 'SUMATERA SELATAN', 1),
(2, 'RT0000041597', 'RISUWIN', 'SAPRODI TUNAS MUDA', 'DS SERI TANJUNG', '-3.389001', '104.587379', 'SUMATERA SELATAN', 0),
(3, 'RT0000029651', 'WAWAN WIBOWO', 'WIBOWO BERJAYA', 'SUNGAI RAMBUTAN', '-3.103718', '104.670443', 'SUMATERA SELATAN', 0),
(4, 'RT0000023549', 'ZUHRI BIN KOSIM', 'TOKO MZ', 'DS TANJUNG BULAN', '-4.215354', '104.521834', 'SUMATERA SELATAN', 0),
(5, 'RT0000023523', 'M SYAHID', 'TOKO DINDA', 'DS TALANG SELEMAN', '-3.413747', '104.489800', 'SUMATERA SELATAN', 0),
(6, 'RT0000023496', 'H ABDUL KARIM', 'TAQWA TANI', 'DS SRI BANDING', '-3.1703288', '104.6818174', 'SUMATERA SELATAN', 0),
(7, 'RT0000023481', 'ABDUL RASYID', 'SUMBER TANI MULYA', 'DS LOROK', '-3.185468', '104.568441', 'SUMATERA SELATAN', 1),
(8, 'RT0000023460', 'ALI FAHMI', 'SETIA MURNI', 'DS SAKA TIGA\r\n', '-3.251995', '104.685020', 'SUMATERA SELATAN', 0),
(9, 'RT0000023458', 'RUSLI', 'SEJAHTERA TANI', 'DS SUNGAI BUAYA\r\n', '-3.041656', '104.766679', 'SUMATERA SELATAN', 0),
(10, 'RT0000023456', 'MAMAD SURYADI', 'SARITA', 'DS SERI KEMBANG III\r\n', '-3.393095', '104.559701', 'SUMATERA SELATAN', 0),
(11, 'RT0000023428', 'AHMAD SYARIFUDIN MADDIA', 'PP BINA TANI', 'DS SEJANGKO I\r\n', '-3.270456', '104.755011', 'SUMATERA SELATAN', 0),
(12, 'RT0000023427', 'HARYONO', 'PP BERINGIN INDAH', 'DS SUNGAI LEBUNG\r\n', '-3.226329', '104.772513', 'SUMATERA SELATAN', 0),
(13, 'RT0000023426', 'SYAFRUDIN', 'PP ANUGRAH', 'DS RANTAU PANJANG\r\n', '-3.277639', '104.763762', 'SUMATERA SELATAN', 0),
(14, 'RT0000023405', 'ANI LISTIANA', 'MITRA TANI ABADI', 'DS TANJUNG PULE\r\n', '-3.119213', '104.606319', 'SUMATERA SELATAN', 0),
(15, 'RT0000023401', 'APRIL YADI', 'MITRA TANI', 'DS BETUNG I\r\n', '-3.460915', '104.606319', 'SUMATERA SELATAN', 0),
(16, 'RT0000023400', 'APRIL YADI', 'MITRA TANI', 'DS BETUNG I\r\n', '-3.460915', '104.606319', 'SUMATERA SELATAN', 0),
(17, 'RT0000023399', 'APRIL YADI', 'MITRA TANI', 'DS BETUNG I\r\n', '-3.460915', '104.606319', 'SUMATERA SELATAN', 0),
(18, 'RT0000023394', 'MUHAMMAD H SERO', 'MITRA JAYA', 'DS ULAK KERBAU BARU\r\n', '-3.318402', '104.730219', 'SUMATERA SELATAN', 0),
(19, 'RT0000023393', 'MUHAMMAD H SERO', 'MITRA JAYA', 'DS ULAK KERBAU BARU\r\n', '-3.318402', '104.730219', 'SUMATERA SELATAN', 0),
(20, 'RT0000023304', 'AWALUDIN', 'KENANGA', 'DS TANJUNG BULAN\r\n', '-3.497152', '104.483976', 'SUMATERA SELATAN', 0),
(21, 'RT0000023279', 'MARWA', 'GLOBAL TANI', 'DS SEMBADAK\r\n', '-3.093870', '104.765220', 'SUMATERA SELATAN', 0),
(22, 'RT0000023262', 'ARDIANSYAH', 'DAYANG TANI', 'DS. TANJUNG DAYANG SELATAN\r\n', '-3.325014', '104.696683', 'SUMATERA SELATAN', 0),
(23, 'RT0000023221', 'H BUSRONI', 'BINA TANI', 'DS SENURO BARAT\r\n', '-3.334415', '104.559701', 'SUMATERA SELATAN', 0),
(24, 'RT0000016864', 'AWALUDDIN', 'KENANGA', 'DS TANJUNG BULAN\r\n', '-3.497152', '104.483976', 'SUMATERA SELATAN', 0),
(25, 'RT0000016863', 'SUMARNO', 'PUTRI PINANG MASAK', 'DS SENURO BARAT\r\n', '-3.334415', '104.559701', 'SUMATERA SELATAN', 0),
(26, 'RT0000016862', 'DRS H SYARIPUDDIN', 'TOKO QEYSHA BAROKAH', 'DS PAYARAMAN TIMUR\r\n', '-3.400838', '104.533484', 'SUMATERA SELATAN', 0),
(27, 'RT0000016861', 'AGUS SALIM', 'AGUS SALIM', 'DS PAYARAMAN TIMUR\r\n', '-3.400838', '104.533500', 'SUMATERA SELATAN', 1);

-- --------------------------------------------------------

--
-- Table structure for table `posisi`
--

CREATE TABLE `posisi` (
  `id_posisi` int(11) NOT NULL,
  `nama_posisi` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posisi`
--

INSERT INTO `posisi` (`id_posisi`, `nama_posisi`) VALUES
(1, 'Super Admin'),
(2, 'Manager'),
(3, 'Karyawan / Staff');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `email`, `status`, `foto`) VALUES
(1, 'jeryandrea', '$2y$10$CqMFwLD9LKntqfzKoFcLdObAHeMDHJ46daq1XIZQCr6F0jaxAZrzi', 'Jery Andreansyah', 'jeryandreansyah07@gmail.com', 1, '../assets/images/default.png'),
(2, 'sukirman', '$2y$10$IvOKeuacPw6Rx.1iAi.TFOtQ65o2.l9aFpowYL5sPuPy6dx5Wqht6', 'sukirman', 'sukirman@gmail.com', 1, '../assets/images/default.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_pengecer`
--
ALTER TABLE `data_pengecer`
  ADD PRIMARY KEY (`id_pengecer`);

--
-- Indexes for table `posisi`
--
ALTER TABLE `posisi`
  ADD PRIMARY KEY (`id_posisi`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_pengecer`
--
ALTER TABLE `data_pengecer`
  MODIFY `id_pengecer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `posisi`
--
ALTER TABLE `posisi`
  MODIFY `id_posisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
