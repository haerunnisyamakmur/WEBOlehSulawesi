-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2023 at 01:13 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `olehsulawesi1`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `notelp` varchar(15) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama`, `email`, `notelp`, `password`) VALUES
(1, 'Mita', 'mita25@gmail.com', '082134579654', '827ccb0eea8a706c4c34a16891f84e7b');

-- --------------------------------------------------------

--
-- Table structure for table `alamat`
--

CREATE TABLE `alamat` (
  `id_alamat` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `notelp` varchar(20) NOT NULL,
  `provinsi` varchar(50) NOT NULL,
  `kota` varchar(50) NOT NULL,
  `kecamatan` varchar(50) NOT NULL,
  `kodepos` varchar(10) NOT NULL,
  `alamatdetail` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alamat`
--

INSERT INTO `alamat` (`id_alamat`, `id_user`, `username`, `notelp`, `provinsi`, `kota`, `kecamatan`, `kodepos`, `alamatdetail`) VALUES
(1, 1, 'Mita25', '082356748991', 'Sulawesi Selatan', 'Luwu', 'Larompong Selatan', '91998', 'Jl.Telkom, Desa Babang, Kecamatan Larompong Selatan, Kabupaten Luwu, Provinsi Sulawesi Selatan'),
(2, 2, 'Wulan05', '082345675834', 'Sulawesi Selatan', 'Takalar', 'Galesong Utara', '90991', 'Jl.Mana, Desa Galesong, Kecamatan Galesong Utara, Kabupaten Takalar, Provinsi Sulawesi Selatan'),
(3, 3, 'Cica03', '082463748991', 'Sulawesi Selatan', 'Pare-pare', 'Kecamatan Ujung', '91992', 'Jl. Jendral Ahmad Yani, Kecamatan Ujung, Kota Pare-pare, Provinsi Sulawesi Selatan'),
(4, 4, 'Utta08', '082345675645', 'Sulawesi Selatan', 'Wajo', 'Keera', '91995', 'Jl.Sabar, Desa Pasrah, Kecamatan Keera, Kabupaten Wajo, Provinsi Sulawesi Selatan');

-- --------------------------------------------------------

--
-- Table structure for table `cabang`
--

CREATE TABLE `cabang` (
  `id_cabang` int(50) NOT NULL,
  `nama_cabang` varchar(1000) NOT NULL,
  `jam_buka` varchar(50) NOT NULL,
  `alamat_cabang` text NOT NULL,
  `gambar_cabang` varchar(1000) NOT NULL,
  `link_cabang` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cabang`
--

INSERT INTO `cabang` (`id_cabang`, `nama_cabang`, `jam_buka`, `alamat_cabang`, `gambar_cabang`, `link_cabang`) VALUES
(1, 'Cabang Sulawesi Selatan - Makassar', '08.00 - 21.00 WITA', 'Jl. Pettarani Raya No.26 – Tidung, Rappocini, Makassar, Sulawesi Selatan, 90222', 'cabang1.jpg', 'https://maps.app.goo.gl/348fzbZDdfzynN748'),
(2, 'Cabang Gorontalo - Gorontalo', '08.00 - 21.00 WITA', 'Jl. S. Parman No.45, Biawao, Kota Selatan, Gorontalo, 96111', 'cabang2.jpg', 'https://goo.gl/maps/4vFYx617qNopgLcz5?coh=178571&entry=tt'),
(3, 'Cabang Sulawesi Barat - Pasangkayu', '08.00 - 21.00', 'Jl. Ir. Soekarno No. 65, Pasangkayu, Sulawesi Barat, 96111', 'cabang sulbar.png', 'https://goo.gl/maps/qLqpcU24YJKkmuwQ8?coh=178571&entry=tt'),
(4, 'Cabang Sulawesi Tengah - Palu', '08.00 - 21.00', 'Jl. Soekarno Hatta No. 2, Palu Timur, Sulawesi Tengah, 94118', 'sulteng.png', 'https://goo.gl/maps/JF8o1rCwfnbhQyVb9?coh=178571&entry=tt'),
(5, 'Cabang Sulawesi Utara - Manado', '08.00 - 21.00', 'Jalan Sam Ratulangi No.6, Wenang Utara, Wenang, Jl. Dotulolong Lasut No.37, Pinaesaan, Kec. Wenang, Kota Manado, Sulawesi Utara', 'sulawesi utara.png', 'https://goo.gl/maps/SsFNGhdHAwGnXHQm8?coh=178571&entry=tt'),
(6, 'Cabang Sulawesi Tenggara - Kendari', '08.00 - 21.00', 'Jl. Lasandara No.14c, Korumba, Kec. Mandonga, Kota Kendari, Sulawesi Tenggara 93111', 'sulawesi tenggara.png', 'https://goo.gl/maps/L3moXfYuq7dBTjqh7?coh=178571&entry=tt');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pesanan`
--

CREATE TABLE `detail_pesanan` (
  `id_detail_pesanan` int(10) NOT NULL,
  `id_pesanan` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  `id_produk` int(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jumlah` int(10) NOT NULL,
  `harga_asli` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_pesanan`
--

INSERT INTO `detail_pesanan` (`id_detail_pesanan`, `id_pesanan`, `id_user`, `id_produk`, `nama`, `jumlah`, `harga_asli`) VALUES
(1, 1, 3, 3, 'Bannang-Bannang', 2, 15000),
(2, 2, 4, 41, 'Lipa sabbe', 3, 50000),
(3, 3, 1, 8, 'Baje Canggoreng', 1, 8000),
(4, 4, 2, 6, 'Kacipo', 2, 10000),
(5, 4, 2, 9, 'Kue Baruasa', 2, 20000),
(7, 5, 2, 42, 'Songko Bone', 1, 45000),
(11, 7, 6, 5, 'Kopi Toraja', 4, 15000),
(12, 7, 6, 9, 'Kue Baruasa', 3, 20000),
(14, 8, 6, 2, 'Roti Maros', 2, 25000);

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `id_user` int(100) NOT NULL,
  `id_produk` int(100) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` double NOT NULL,
  `harga_asli` double NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `pilih` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id_pesan` int(11) NOT NULL,
  `id_user` int(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tanggal` varchar(100) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id_pesan`, `id_user`, `username`, `email`, `tanggal`, `message`) VALUES
(1, 2, 'Wulan05', 'bulbul2@gmail.com', '22-05-2023', 'halooo'),
(2, 2, 'Wulan05', 'bulbul@gmail.com', '22-05-2023', 'cieee'),
(3, 2, 'Wulan05', 'bulbul2@gmail.com', '22-05-2023', '123');

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `id_penilaian` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `tanggal` varchar(200) NOT NULL,
  `penilaian` varchar(200) NOT NULL,
  `rating` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penilaian`
--

INSERT INTO `penilaian` (`id_penilaian`, `id_user`, `id_pesanan`, `username`, `tanggal`, `penilaian`, `rating`) VALUES
(7, 3, 1, 'Cica03', '22-05-2023', 'Pengiriman cepat dan produk yang dijual sangat enak, murah, dan berkualitas. Pengemasan produk sangat rapi sehingga barang sampai dengan baik dan tidak rusak. Terima kasih olehSulawesi', '5.0'),
(8, 4, 2, 'Utta08', '22-05-2023', 'Produk bagus dan dikirim dengan cepat. Namun warna yang dikirim tidak sesuai. Pengemasan rapi dan admin mudah dihubungi dan cepat tanggap. ', '4.0'),
(9, 1, 3, 'Mita25', '22-05-2023', 'Pengemasannya rapi jadi kue yang dipesan tidak rusak karena terkena udara luar serta admin juga tanggap namun pas produk sudah sampai, baje nya masih ada kurang matang jadi saya kasi bintang 3 dulu ya', '3.0'),
(10, 2, 4, 'Wulan05', '22-05-2023', 'Harganya lumayan murah, dan produk sesuai dengan ekspektasi. Admin ramah dan fast response sehingga pengiriman cepat dan barang dapat sampai tepat waktu. Barang juga dikemas dengan sangat baik', '5.0'),
(12, 6, 7, 'hrnsyaaaa', '22-05-2023', 'Produk yang dijual sangat baik. Pengiriman cepat dan admin sangat ramah', '5.0');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `id_user` int(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `notelp` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `total_belanja` double NOT NULL,
  `total_diskon` double DEFAULT NULL,
  `tanggal_pemesanan` datetime NOT NULL DEFAULT current_timestamp(),
  `tanggal_pembayaran` datetime DEFAULT NULL,
  `tanggal_pengiriman` datetime DEFAULT NULL,
  `tanggal_selesai` datetime DEFAULT NULL,
  `status_pembayaran` varchar(30) NOT NULL DEFAULT 'Belum bayar',
  `metode_pembayaran` varchar(50) NOT NULL,
  `kode_pembayaran` varchar(100) NOT NULL,
  `catatan` varchar(200) DEFAULT NULL,
  `status_pemesanan` varchar(50) NOT NULL DEFAULT 'Diproses',
  `bukti_pembayaran` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `id_user`, `username`, `notelp`, `alamat`, `total_belanja`, `total_diskon`, `tanggal_pemesanan`, `tanggal_pembayaran`, `tanggal_pengiriman`, `tanggal_selesai`, `status_pembayaran`, `metode_pembayaran`, `kode_pembayaran`, `catatan`, `status_pemesanan`, `bukti_pembayaran`) VALUES
(1, 3, 'Cica03', '082463748991', 'Jl. Jendral Ahmad Yani, Kecamatan Ujung, Kota Pare-pare, Provinsi Sulawesi Selatan, Kecamatan Ujung,', 64000, 6000, '2023-05-22 14:18:22', NULL, NULL, '2023-05-22 14:18:59', 'Belum bayar', 'Transfer OVO', 'NO OVO 081231178921 A.N. olehSulawesi', '', 'Selesai', NULL),
(2, 4, 'Utta08', '082345675645', 'Jl.Sabar, Desa Pasrah, Kecamatan Keera, Kabupaten Wajo, Provinsi Sulawesi Selatan, Keera, Wajo,  Sul', 182500, 7500, '2023-05-22 14:26:06', NULL, NULL, NULL, 'Belum bayar', 'Transfer DANA', 'NO DANA 081231178921 A.N. olehSulawesi', '', 'Selesai', NULL),
(3, 1, 'Mita25', '082356748991', 'Jl.Telkom, Desa Babang, Kecamatan Larompong Selatan, Kabupaten Luwu, Provinsi Sulawesi Selatan, Laro', 48000, 0, '2023-05-22 14:29:40', '2023-05-22 14:31:06', '2023-05-22 14:33:04', NULL, 'Sudah bayar', 'Transfer DANA', 'NO DANA 081231178921 A.N. olehSulawesi', '', 'Selesai', 'Screenshot_20230514-053121_Clock.jpg'),
(4, 2, 'Wulan05', '082345675834', 'Jl.Mana, Desa Galesong, Kecamatan Galesong Utara, Kabupaten Takalar, Provinsi Sulawesi Selatan, Gale', 100000, 0, '2023-05-22 14:39:06', NULL, '2023-05-22 14:39:19', '2023-05-22 14:39:29', 'COD (Bayar di Tempat)', 'COD (Bayar di Tempat)', 'COD (Bayar di Tempat)', 'Mohon dikemas dengan baik yah...', 'Selesai', NULL),
(5, 2, 'Wulan05', '082345675834', 'Jl.Mana, Desa Galesong, Kecamatan Galesong Utara, Kabupaten Takalar, Provinsi Sulawesi Selatan, Gale', 82750, 2250, '2023-05-22 14:42:20', NULL, NULL, NULL, 'COD (Bayar di Tempat)', 'COD (Bayar di Tempat)', 'COD (Bayar di Tempat)', '', 'Diproses', NULL),
(7, 6, 'hrnsyaaaa', '085461321679', 'Jl. Buldozer Blok I no 7K, Panampu, Makassar,  Sulawesi Selatan, 91113', 136000, 24000, '2023-05-22 15:19:21', '2023-05-22 15:19:44', '2023-05-22 15:20:09', '2023-05-22 15:20:25', 'Sudah bayar', 'Transfer Bank BRI', 'Rek BRI 564389127652982 A.N. olehSulawesi', 'Tolong dikemas dengan baik', 'Selesai', '20230522_134952.jpg'),
(8, 6, 'hrnsya', '08536492876', 'Jl. Buldozer Blok I no 9A, Tamalate, Makassar,  Sulawesi Selatan, 91114', 90000, 0, '2023-05-22 15:22:33', NULL, NULL, NULL, 'COD (Bayar di Tempat)', 'COD (Bayar di Tempat)', 'COD (Bayar di Tempat)', 'Barang tolong dikemas dengan baik', 'Diproses', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `harga_produk` int(100) NOT NULL,
  `gambar_produk` varchar(100) NOT NULL,
  `berat_produk` int(11) NOT NULL,
  `deskripsi_produk` text NOT NULL,
  `diskon_produk` int(3) NOT NULL,
  `khas_produk` varchar(50) NOT NULL,
  `stok_produk` int(10) NOT NULL,
  `total_penjualan` int(10) NOT NULL,
  `asal_wilayah` varchar(100) NOT NULL,
  `masa_penyimpanan` varchar(100) NOT NULL,
  `no_izin_edar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `harga_produk`, `gambar_produk`, `berat_produk`, `deskripsi_produk`, `diskon_produk`, `khas_produk`, `stok_produk`, `total_penjualan`, `asal_wilayah`, `masa_penyimpanan`, `no_izin_edar`) VALUES
(1, 'Bawang Goreng', 30000, 'pict_10.jpg', 400, 'Bawang goreng Narasa yang terbuat dari bawang merah kualitas terbaik asli Palu, Sulawesi Tengah. Bawang goreng kualitas PREMIUM yang dikupas secara manual dan TANPA CAMPURAN TEPUNG. Dijamin gurih, renyah dan tidak gosong. Cocok untuk campuran nasi goreng, sayur, bakso, dll, Bahkan sekadar campuran nasi panas. Dicemil langsung juga mantap kriuknya. Ada manis-manisnya gitu', 20, 'Sulawesi Barat', 100, 0, 'Palu', '1 Bulan', '77812577'),
(2, 'Roti Maros', 25000, 'pict_6.jpg', 500, 'Bahan dalam membuat Roti Maros dibagi menjadi dua yaitu bagian roti dan bagian isian yang berupa selai. Pada bagian rotinya terbuat dari tepung terigu, kuning telur, santan, dan gula pasir, sedangkan pada bagian pokoknya berupa selai srikaya.  Roti ini memiliki rasa gurih, manis dan pastinya enak karena selai isiannya dibuat dari selai kaya, santan, gula dan kuning telur. Saat dimakan, Anda akan merasakan lembutnya roti dan manisnya kaya.', 0, 'Sulawesi Selatan', 97, 3, 'Maros', '3 Hari', '6634590'),
(3, 'Bannang-Bannang', 15000, 'pict_1.jpg', 500, 'Kuliner ini terbuat dari gula merah dan tepung beras. Di sebut Bannang-Bannang karena bentuknya yang halus di gulung hingga membentuk kue seperti menyerupai benang kain pada umumnya. Kue Bannang-Bannang menjadi kuliner khas yang paling di gemari  warga Kabupaten Jeneponto', 20, 'Sulawesi Selatan', 96, 4, 'Jeneponto', '1 Minggu', '1234567'),
(4, 'Mantao Pare', 40000, 'pict_2.jpg', 400, 'Roti yang satu ini merupakan jajanan khas kota Pare-pare, Sulawesi Selatan. Roti berwarna putih ini awalnya berasal dari makanan dari Taiwan (Mantou), tetapi resepnya diolah kembali oleh produksi lokal.  Terbuat dari tepung terigu dan campuran beberapa bahan lain, jika dilihat bentuknya sangat mirip dengan penganan bakpao, itulah roti Mantao Pare. Bisa disajikan langsung atau pun digoreng. Meskipun sekilas sama, tetapi memiliki citarasa yang berbeda.', 10, 'Sulawesi Selatan', 98, 2, 'Pare-Pare', '5 Hari', '4444444'),
(5, 'Kopi Toraja', 15000, 'pict_3.jpg', 100, 'Kopi asli daerah Toraja ini memiliki rasa dan aroma rempah yang khas. Ciri khas kopi robusta Toraja ini adalah rasanya yang lebih pahit dibanding kopi lainnya namun dengan tingkat keasaman yang rendah. Kopi Toraja ini ditanam di area pegunungan dengan ketinggian 1400 sampai dengan 2100 mdpl di Pegunungan Sesean, Toraja, Sulawesi Selatan. Pegunungan Sesean ini terkenal sebagai kawasan tanah vulkanik, dimana pohon-pohon kopi Toraja ini tumbuh beriringan dengan tanaman rempah.', 40, 'Sulawesi Selatan', 96, 4, 'Toraja', '2 Bulan', '7777777'),
(6, 'Kacipo', 10000, 'pict_4.jpg', 200, 'Kacipo merupakan cemilan kota Parepare yang biasanya sering ditemukan di banyak toko kue di kawasan tersebut. Bentuk kue ini mirip dengan onde-onde yang berukuran kecil.   Kue ini memiliki cita rasa manis dan gurih, sehingga membuat lidah selalu ketagihan dengan cemilan tersebut. Jajanan kering ini, terbuat dari tepung terigu dan wijen. Di daerah lain, Kacipo lebih dikenal dengan sebutan kue keciput. ', 0, 'Sulawesi Selatan', 98, 2, 'Pare-Pare', '3 Minggu', '8976578'),
(7, 'Kerupuk Jintan', 25000, 'pict_5.jpg', 500, 'Jintan merupakan jenis kue kering khas Makassar yang memiliki rasa gurih manis yang khas. Disebut kerupuk karena proses pembuatan kue yang dilakukan dengan cara digoreng mirip dengan pembuatan kerupuk.  Kue kerupuk jintan terbuat dari adonan tepung terigu, gula pasir, margarin, santan, dan juga jintan hitam. Setelah semua adonan tercampur dan mengembang barulah adonan tersebut digoreng dalam ukuran kecil berbentuk jajar genjang.', 10, 'Sulawesi Selatan', 99, 6, 'Makassar', '3 Minggu', '4563876'),
(8, 'Baje Canggoreng', 8000, 'pict_7.jpg', 200, 'Permen tradisional khas Sulawesi Selatan. Selain dikenal dengan nama Baje Kacang atau Baje Canggoreng, dikenal pula dengan nama Tenteng Kacang. Berbahan dasar kacang tanah dan gula merah. Baje canggoreng mudah ditemukan di Sulawesi terutama di Kota Pare – Pare.', 0, 'Sulawesi Selatan', 98, 4, 'Pare-Pare', '1 Bulan', '43765900'),
(9, 'Kue Baruasa', 20000, 'pict_8.jpg', 300, 'Baruasa termasuk salah satu kue kering khas Makassar yang sering dijumpai pada acara pernikahan adat suku Bugis. Bentuk kue ini pipih bulat mirip seperti roti bayi namun dengan tekstur yang lebih renyah dan memiliki rasa gurih.  Bahan utama kue baruasa terbuat dari tepung beras dan kelapa parut yang tidak memiliki kadar lemak sama sekali. Kue tradisional ini sangat cocok dinikmati saat bersantai bersama segelas kopi atau teh.', 0, 'Sulawesi selatan', 95, 5, 'Pangkep', '1 Bulan', '3354786'),
(10, 'Dange ', 25000, 'pict_9.jpg', 300, 'Bahan dasar dari Kue Dange ini ialah beras ketan hitam (untuk Kue Dange hitam) atau putih (untuk Kue Dange putih), parutan kelapa muda, serta gula merah. Sementara untuk alat yang dibutuhkan pada pembuatan Kue Dange diantaranya daun pisang, arang atau kayu bakar, dapo’ atau alat pembakaran dari tanah liat, serta cetakan Dange. Kue Dange kini menjadi salah satu oleh oleh yang diburu oleh para wisatawan yang bertandang ke Pangkep karena rasanya yang enak', 10, 'Sulawesi Selatan', 100, 0, 'Pangkajene', '3 Minggu', '9873567'),
(11, 'Duduli', 10000, 'duduligorontalo.jpg', 500, 'Duduli merupakan dodol khas dari Gorontalo. Duduli juga termasuk dalam kriteria makanan tradisional Gorontalo, karena proses pembuatannya yang masih tradisional. Terbuat dari ketan, santan serta gula merah. Jika dodol Garut dibungkus kecil-kecil menggunakan plastik. Dodol khas Gorontalo ini berbeda, dibungkus menggunakan daun woka. Ada dua varian rasa, yaitu biasa dan durian, kekhasannya tampak dengan adanya buah kenari didalamnya. Duduli sendiri melambangkan selamat datang serta selamat berpisah bagi warga Gorontalo untuk beberapa tamunya. Hal semacam ini melambangkan persahabatan atau bersilahturahmi yang lengket serta manis yang pantas untuk dikenang.', 0, 'Gorontalo', 100, 0, 'Gorontalo', '1 Minggu', '5647839'),
(12, 'Ilabulo', 15000, 'ilabulo.jpg', 500, 'Ilabulo merupakan salah satu produk makanan khas yang ada di daerah Gorontalo dibuat melalui proses pemasakan adonannya. Adonan terdiri, jeroan (hati dan ampela), dan kulit ayam. Ilabulo mempunyai kadar  air  73,96%,  kadar abu  0,22%,  kadar karbohidrat  21,49%. Komposisi gizi tersebut diperoleh dari data  penelitian laboratorium untuk pembuatan ilabulo dari jeroan ayam dan menggunakan tepung sagu. Data  untuk kadar lemak dan kadar protein belum dianalisis karena keterbatasan  peralatan yang dimiliki.', 0, 'Gorontalo', 100, 0, 'Gorontalo', '3 Hari', '9876577'),
(13, 'Kain Karawo', 50000, 'kainkarawo.jpg', 10000, ' Karawo adalah kain tradisional khas Gorontalo yang pembuatannya merupakan hasil kerajinan tangan. Tak ada kain karawo yang bukan hasil kerajinan tangan  Kerajinan karawo adalah kerajinan menghias berbagai jenis kain dengan berbagai motif sulaman menggunakan benang polos maupun warna-warni.     Kain Karawo merupakan sebuah produk seni budaya khas provinsi Gorontalo yang memiliki nilai seni sangat tinggi karena dibuat melalui proses penyulaman manual yang sangat rumit. Prinsip dasar yang diterapkan untuk membentuk ornamen karawo pada bahan tekstil sendiri dapat dilakukan melalui proses pendesainan, pengirisan dan pencabutan bagian tertentu serat tekstil untuk membuat bidang dasar dan penyulaman kembali serat tekstil yang dicabut untuk membentuk motif-motif tertentu.', 25, 'Gorontalo', 500, 0, 'Gorontalo', 'Seumur Hidup', '1234567'),
(14, 'Kopi Pinogu', 40000, 'kopipinogu.jpg', 200, 'Kopi Pinogu adalah kopi organik yang menjadi produk unggulan di Kabupaten Bone Bolango, Provinsi Gorontalo. Kopi Pinogu berasal dari Kecamatan Pinogu yang merupakan sebuah kawasan yang sangat kaya dengan komoditas pertanian. Kopi pinogu berasal dari campuran kopi robusta dan kopi liberika.', 15, 'Gorontalo', 100, 0, 'Bone Bolango', '1 Tahun', '6473538'),
(15, 'Kopiah Keranjang Gorontalo', 35000, 'kopiahgorontalo.jpg', 150, 'Kopiah keranjang adalah anyaman khas Gorontalo atau yang dalam bahasa daerah sering juga disebut sebagai upiah karanji. Upiya Karanji terbuat dari anyaman Pohon Mintu (sejenis rotan) yang tumbuh liar dan lebat di dalam hutan, terhampar luas di semenanjung Gorontalo. Upiya Karanji sangat nyaman digunakan ketika beribadah (sholat) maupun dalam beraktivitas sehari-hari. Upiya Karanji atau Peci Gorontalo ini tidak membuat pemakainya gerah karena memiliki sirkulasi udara yang sangat baik.', 0, 'Gorontalo', 100, 0, 'Gorontalo', 'Seumur Hidup', '5432875'),
(16, 'Pia Putra Kusuma', 40000, 'piaputa.jpg', 300, 'Pia Putra Kusuma adalah Kue Pia Khas Gorontalo sejak tahun 1999. Pia Putra Kusuma adalah Pia Terlama di kota Gorontalo. tersedia varian rasa : coklat,keju,kacang,isi ikan tuna,kacang hijau.', 0, 'Gorontalo', 100, 0, 'Gorontalo', '1 Minggu', '987065'),
(17, 'Kacang Goyang', 25000, 'kacanggoyang.jpg', 300, 'Nama kacang goyang sendiri menurut cerita orang Minahasa dihasilkan dari proses pembuatannya. Kacang tanah yang masih di dalam kulit lalu disangrai menggunakan pasir kemudian digoyang-goyangkan. Dari proses mengoyang-goyang kacang inilah nama kacang goyang berasal. Kacang goyang memiliki citarasa manis dan sedikit agak pahit. Teksturnya sedikit keras diluar namun ketika digigit akan terasa begitu lembut. Sekali makan kacang ini bisa membuat mulut Anda enggan untuk berhenti.', 0, 'Sulawesi Utara', 100, 0, 'Minahasa', '4 Hari', '564786'),
(18, 'Dodol Amurang', 20000, 'dodolamurang.jpg', 450, 'Dodol Amurang merupakan makanan tradisional yang khas dari Manado yang berasal dari daerah Amurang, Minahasa Selatan yang juga disebut dodol kenari. Dodol Amurang banyak diproduksi di Kabupaten Minahasa Selatan, seperti Amurang, Motoling, Tenga, Tumpaan, Tareran, Tompasobaru hingga Kabupaten Minahasa Tenggara.', 0, 'Sulawesi Utara', 98, 2, 'Amurang', '5 Hari', '5648976'),
(19, 'Batik Minahasa', 200000, 'batikmanado.jpg', 560, 'Batik Minahasa adalah kain batik yang menggunakan motif tradisional atau ragam hias dari tanah adat Minahasa, Sulawesi Utara, Indonesia. Kain batik sendiri adalah kain yang diproses dengan cara membatik, yaitu membuat motif dengan melakukan perintang warna menggunakan lilin atau malam. Dengan proses batik ini, lalu diangkatlah motif-motif ragam hias bangsa Minahasa. Minahasa adalah etnis besar (bangsa) yang terdiri dari beberapa sub etnis seperti Tonsea, Tolour, Tombulu, Tountemboan, Tonsawang, Batik, Pasan, Ponosakan, Borgo Babontehu.', 20, 'Sulawesi Utara', 100, 0, 'Minahasa', '-', '3456785'),
(20, 'Halua kenari', 40000, 'haluakenari.jpg', 300, 'Sesuai namanya, halua kenari dibuat menggunakan bahan utama kacang kenari yang tumbuh subur di Sulawesi Utara. Kacang ini dibungkus dengan gula merah yang telah dilebur kemudian dilapisi ke dalam kacang. .Batik Minahasa adalah kain batik yang menggunakan motif tradisional atau ragam hias dari tanah adat Minahasa, Sulawesi Utara, Indonesia. Kain batik sendiri adalah kain yang diproses dengan cara membatik, yaitu membuat motif dengan melakukan perintang warna menggunakan lilin atau malam. Dengan proses batik ini, lalu diangkatlah motif-motif ragam hias bangsa Minahasa. Minahasa adalah etnis besar (bangsa) yang terdiri dari beberapa sub etnis seperti Tonsea, Tolour, Tombulu, Tountemboan, Tonsawang, Batik, Pasan, Ponosakan, Borgo Babontehu.', 5, 'Sulawesi Utara', 100, 0, 'Manado', '1 Minggu', '4530976'),
(21, 'Souvenir Oli', 50000, 'oli.jpg', 500, 'Oli di sini bukanlah oli sebagai pelumas untuk kendaraan melainkan alat musik tradisional khas Sulawesi Utara. Alat musik ini terbuat dari bambu. Kamu bisa membeli ini untuk diberikan kepada orang tersayang. Nah, biasanya oli dijadikan pajangan untuk di rumah sehingga nuansa Manado bisa terasa.', 10, 'Sulawesi Utara', 100, 0, 'Manado', '-', '5397684'),
(22, 'Sambal Roa', 65000, 'sambalroa.jpg', 300, 'Sambal roa adalah salah satu sambal khas dari kota Manado, Indonesia. Sambal ini memiliki rasa yang khas karena selain cabai, bahan utamanya adalah ikan roa asap. Di Manado sendiri, sambal roa biasanya dinikmati dengan bubur Manado.\r\n\r\nSambal ini bisa bertahan hingga enam bulan jika berada dalam suhu ruangan dan bisa mencapai satu tahun jika disimpan di dalam kulkas.', 0, 'Sulawesi Utara', 100, 4, 'Manado', '3 Minggu', '809643'),
(23, 'Panada Manado', 5000, 'panadamanado.jpg', 5, 'Panada merupakan kuliner khas Manado yang memiliki tekstur yang lembut, isiannya ini berupa pampis yang terbuat dari parutan papaya muda dicampur ikan Khas Sulawesi Utara cakalang yang dimasak pedas.', 0, 'Sulawesi Utara', 98, 2, 'Manado', '2 Hari', '777755'),
(24, 'Bolu Paranggi', 10000, 'boluparanggi.jpg', 5, 'Bolu paranggi merupakan salah satu kue khas suku Mandar dengan tekstur lembut namun nikmat. Rasanya makin mantap apbila disantap dalam kondisi masih hangat. Bahan utama dari kue ini ialah tepung terigu, gula merah, air dan pengembang. Ketiganya dicampur hingga menyerupai adonan dodol.', 0, 'Sulawesi Barat', 100, 0, 'Majene', '3 Hari', '553366'),
(25, 'Golla Kambu', 10000, 'gollakambu.jpg', 6, 'Golla Kambu adalah makanan khas Suku Mandar yang juga menjadi kekayaan wisata kuliner Polewali Mandar. Penganan yang terbuat dari bahan beras ketan, kelapa muda, kacang tanah, dan gula merah.\r\n\r\nPenganan dengan tekstur berserat padat ini memiliki rasa manis yang sangat khas. Sepintas kita lihat, bentuknya seperti wajik dari Jawa.', 0, 'Sulawesi Barat', 98, 2, 'Mandar', '1 Minggu', '987653'),
(26, 'Kue Bikang', 5000, 'kuebikang.jpg', 5, 'Kue bikang ini merupakan makanan khas Mandar Sulawesi Barat. Terbuat dari tepung beras dian air santan. Jika sudah matang, diguyur pakai gula areng yang sudah dicairkan. Ini nih yang bikin lumerrrr di mulut.\r\n\r\nDari tekaturnya, kue bikang memilki banyak pori. Nah, pori ini fungsinya adalah ketika disiram gula areng, langsung meresap ke dalam kue. Lumerrrr.', 0, 'Sulawesi Barat', 100, 0, 'Mandar', '3 Hari', '876954'),
(27, 'Sambusa', 15000, 'sambusa.jpg', 300, 'Sambusa merupakan salah satu kuliner khas Sulawesi Barat, berbentuk segitiga dengan isian yang beragam. Mulai dari ikan tuna yang digiling dan dihaluskan, daun bawang, serta bumbu lain seperti daun seledri, merica, bawang putih, bawang merah yang diramu menjadi jajanan lezat.', 0, 'Sulawesi Barat', 100, 0, 'Mamuju', '3 Hari', '675324'),
(28, 'Tumpi-Tumpi', 15000, 'tumpi.jpg', 300, 'Kuliner Tumpi-tumpi adalah makanan tradisional Sulawesi Barat yang berasal dari suku Mandar. Tumpi-tumpi ini merupakan hidangan warisan leluhur yang telah dikenal sejak lama secara turun-menurun. Penyajian makanan ini ditujukan untuk kegiatan-kegiatan yang berkaitan dengan tradisi masyarakat setempat seperti kegiatan keagamaan, pernikahan, pertemuan keluarga, syukuran dan khitanan. Dalam pengolahannya, daging ikan layang dihaluskan kemudian dicampur kelapa parut.', 0, 'Sulawesi Barat', 100, 0, 'Mandar', '3 hari', '5643876'),
(29, 'Bingga /Tonda', 20000, 'bingga.jpg', 300, 'Bingga dalam bahasa Indonesia disebut ‘Bakul’. Bingga merupakan anyaman yang terbuat dari batang bambu yang sudah di potong, dibelah dan di iris sesuai ukurannya kemudian dianyam sedemikian rupa hingga membentuk sebuah bakul. Ukuran dan bentuk dari bakul khas Sulawesi Tengan ini beragam, bakul bisa dibuat baik dalam ukuran yang besar ataupun kecil sesuai keinginan pembuatnya.\r\n\r\nManfaat dari bakul ini adalah bisa mengisi/menyimpan benda – benda apa saja, seperti hasil komoditi dan lain sebagainya. Selain itu, dalam tradisi adat seperti ‘posusa’ (partisipasi dan sumbangsi untuk keluarga besar), bakul juga kerap digunahkan sebagai tempat menyimpan gabah atau beras untuk diantarkan kepada penyelenggara acara misalnya perkawinan, kematian dan sebagainya.', 0, 'Sulawesi Tengah', 100, 2, 'Palu', '-', '8563827'),
(30, 'Tapi Beras', 30000, 'tapiberas.jpg', 300, 'Tapi jika diterjemahkan kedalam bahasa Indonesia artinya Nyiru. Tapi juga merupakan sebuah kerajinan yang juga terbuat dari Bambu yang dianyam dan bermanfaat untuk menampi/menyaring beras supaya bisa dimasak.', 0, 'Sulawesi Tengah', 100, 0, 'Palu', '-', '645397'),
(31, 'Keripik Buah Naga', 20000, 'kripiknaga.jpg', 300, 'Keripik Buah Naga merupakan salah satu cemilan yang berbahan dasar buah naga. Keripik buah naga memberikan keunikan tersendiri saat dikonsumsi. Selain nikmat dijadikan sebagai cemilan, keripik ini juga memiliki manfaat baik. Buah naga memiliki kandungan vitamin dan mineral. Kandungan baik buah naga antara lain protein, karbohidrat, kalium, fosfor, zat besi, vitamin B1, B3, dan B12.', 0, 'Sulawesi Tengah', 97, 3, 'Palu Selatan', '3 Bualn', '888765'),
(32, 'Keripik Pisang Donggala', 15000, 'kripikpisangdonggala.jpg', 0, 'Keripik Pisang Donggala ini sob merupakan makanan khas yang cukup populer dan cocok dijadikan oleh-oleh. Keripik donggala ini merupakan buatan dari kabupaten Dinggala yang sudah terkenal di Kota Palu dengan rasanya yang gurih, manis, dan renyah.', 0, 'Sulawesi Tengah', 100, 0, 'Donggala', '4 Bulan', '568923'),
(33, 'Ompa / Tikar', 50000, 'ompa.jpg', 1000, 'Ompa ini adalah anyaman yang terbuat dari semacam Daun Rami yang biasa tumbuh di pinggiran kali. Tentu tikar bermanfaat untuk alas tidur didalam rumah ataupun diluar rumah. Tikar dibuat sangat bervariasi karena dapat juga diwarnai menggunakan pewarna pakaian. Sama seperti \'Bakul\', Tikar juga dibawah oleh bangsa Melayu ketanah kaili beberapa abad silam.', 0, 'Sulawesi Tengah', 100, 0, 'Palu', '-', '239854'),
(34, 'Pia Khas Palu', 15000, 'piapalu.jpg', 300, 'Kue pia khas Palu ini juga bisa jadi oleh-oleh khas Palu karena rasanya enak dan bikin nagih. Sobat Kuliner bisa memilih rasa yang tersedia sesuai selera, diantaranya ada rasa cokelat, kacang, dan keju. Pia khas Palu ini pas banget buat dijadikan oleh-oleh khas Palu karena selain harganya yang murah, untuk menemukan pia khas Palu ini cukup mudah karena banyak ditemukan di hampir seluruh pusat oleh-oleh khas Palu.', 0, 'Sulawesi Tengah', 98, 2, 'Palu', '3 Bulan', '4433667'),
(35, 'Karasi', 30000, 'karasi.jpg', 300, 'Karasi merupakan makanan khas Sulawesi Tenggara yang memiliki cita rasa khas manis. Sebab, makanan ini terbuat dari bahan dasar jagung muda yang dicampur dengan gula merah cair atau yang dikenal dengan sebutan gola bone lonsa.', 0, 'Sulawesi Tenggara', 100, 3, 'Wakatobi', '3 Hari', '346785'),
(36, 'Kerajinan Perak', 0, 'kerajinanperak.jpg', 0, 'Kerajinan perak merupakan salah satu produk andalan khas Kota Kendari yang bernilai tinggi dan sudah ada sejak zaman penjajahan belanda.\r\n\r\nKerajinan perak legendaris dari Kota Kendari, Sulawesi Tenggara (Sultra) ini juga dikenal dengan sebutan ”Kendari Werk” atau yang berarti ”Karya Kendari” dalam bahasa Belanda, merupakan salah satu jenis kerajinan perak dengan teknik filigree, metode yang jarang ditemui di sentra kerajinan perak lainnya di Tanah Air.', 0, 'Sulawesi Tenggara', 100, 0, 'Kendari', '-', '294657'),
(37, 'Keripik Mete', 35000, 'kripikmete.jpg', 300, 'Tentu sudah tidak asing lagi dengan olahan kcang mete yang memiliki banyak manfaat untuk tubuh. Keripik mete ini dibuat dari kacang mete pilihan yang sudah tentu aman dikonsumsi dan baik untuk kesehatan tubuh. Tekstur nya yang crunchy dan rasa nya yang gurih membuat Kripik Mete ini sangat pas disantap disela - sela aktivitas anda.', 0, 'Sulawesi Tenggara', 98, 2, 'Kendari', '3 Bulan', '904536'),
(38, 'Kain Tenun Tolaki', 50000, 'tenuntolaki.jpg', 300, 'Batik tenun Tolaki ini merupakan primadona kain tenun khas Sulawesi Tenggara. Motif Tolaki ini memiliki ciri khas benang emas yang membentuk garis halus dan ada aksen bunga kecil-kecil.\r\n\r\nMotif yang terkenal di masyarakat Tolaki adalah ragam hias mua. Dan pewarnaannya meliputi jingga muda, biru laut, kuning susu dan merah samar. Hingga saat ini tradisi menenun masih berkembang karena kecintaan masyarakatnya terhadap kain tradisional tersebut.', 10, 'Sulawesi Tenggara', 100, 0, 'Kendari', '-', '674837'),
(39, 'Kain Tenun Buton', 40000, 'tenunbuton.jpg', 300, 'Kerajinan tenun dari Kabupaten Buton, Sulawesi Tenggara biasanya menggambarkan obyek alam yang mereka temukan di sekitarnya. Tenun Buton juga kaya akan warna-warna. Inilah yang menjadi kekhasan kerajinan tenun dari Buton.\r\n\r\nOleh masyarakat Buton, kerajinan tenun ini dianggap mampu menjadi perekat sosial bagi masyarakat Buton, sebab tenun Buton adalah pengejawantahan orang-orang Buton memahami lingkungan alamnya.', 5, 'Sulawesi Tenggara', 100, 0, 'Buton', '-', '562437'),
(40, 'Batik Toraja', 55000, 'batiktoraja.jpg', 500, 'Batik Toraja merupakan hasil perkembangan budaya yang pada mulanya hanya dapat dinikmati sebagai ukiran di rumah-rumah adat, namun seiring berjalannya waktu dan peradaban berkembang menjadi bentuk batik. \r\n\r\n Warna khas Batik Toraja adalah hitam, merah, putih dan kuning. Dalam kombinasi warna, kain diwarnai dengan warna  setelah  dicap, kemudian  beberapa garis pola ditutup dengan warna  berbeda. ', 10, 'Sulawesi Selatan', 98, 2, 'Toraja', '-', '569823'),
(41, 'Lipa sabbe', 50000, 'sarungtenunbugis.jpg', 30, 'Lipa Sabbe adalah sarung tenun yang terbuat dari kain Sutera. Sentra produksi Lipa Sabbe di Sulawesi Selatan saat ini terletak di Kota Sengkang, Kabupaten Wajo. Produksi Lipa Sabbe di Wajo ini masih menggunakan cara tradisional. Bagi masyarakat Wajo, menjadi penenun bukan saja sebagai mata pencaharian.', 5, 'Sulawesi Selatan', 95, 5, 'Wajo', '-', '987654'),
(42, 'Songko Bone', 45000, 'songkobone.jpg', 300, 'Songkok to Bone ialah penutup kepala khas yang berasal dari Kabupaten Bone yang biasanya dipakai oleh kaum lelaki. Di mana selain mencerminkan kegagahan bagi si pemakai, juga merupakan sebuah simbol identitas adat dan kultur suatu daerah.', 5, 'Sulawesi Selatan', 99, 1, 'Bone', '-', '432561');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `notelp` varchar(15) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `foto_user` varchar(100) DEFAULT 'avatar.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `email`, `notelp`, `password`, `foto_user`) VALUES
(1, 'Mita25', 'mita25@gmail.com', '082356748991', '12345', 'avatar.png'),
(2, 'Wulan05', 'wulan05@gmail.com', '082345675834', '12345', 'avatar.png'),
(3, 'Cica03', 'cica03@gmail.com', '082463748991', '12345', 'avatar.png'),
(4, 'Utta08', 'utta08@gmail.com', '082345675645', '12345', 'avatar.png'),
(6, 'hrnsyaaaa', 'hrnsya.story1@gmail.com', '085369421673', '123457', 'IMG_20230121_080447_653.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `alamat`
--
ALTER TABLE `alamat`
  ADD PRIMARY KEY (`id_alamat`);

--
-- Indexes for table `cabang`
--
ALTER TABLE `cabang`
  ADD PRIMARY KEY (`id_cabang`);

--
-- Indexes for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD PRIMARY KEY (`id_detail_pesanan`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id_pesan`);

--
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id_penilaian`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `alamat`
--
ALTER TABLE `alamat`
  MODIFY `id_alamat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cabang`
--
ALTER TABLE `cabang`
  MODIFY `id_cabang` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  MODIFY `id_detail_pesanan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id_pesan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id_penilaian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
