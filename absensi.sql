-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Jan 2021 pada 02.48
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absensi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensis`
--

CREATE TABLE `absensis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `jam_masuk` time DEFAULT NULL,
  `jam_keluar` time DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan_pulang` varchar(1024) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `absensis`
--

INSERT INTO `absensis` (`id`, `tanggal`, `jam_masuk`, `jam_keluar`, `keterangan`, `keterangan_pulang`, `user_id`) VALUES
(34, '2020-11-30', '09:53:30', '15:12:17', 'Telat', 'Pulang', 1),
(35, '2020-11-30', '09:53:30', NULL, 'Alpha', '', 2),
(36, '2020-11-30', '09:53:30', NULL, 'Alpha', '', 3),
(37, '2020-12-07', '11:49:54', NULL, 'Telat', NULL, 1),
(38, '2020-12-07', '11:49:54', NULL, 'Alpha', NULL, 2),
(39, '2020-12-07', '11:49:54', NULL, 'Alpha', NULL, 3),
(40, '2020-12-17', '12:13:09', NULL, 'Telat', NULL, 1),
(41, '2020-12-17', '12:13:09', NULL, 'Alpha', NULL, 2),
(42, '2020-12-17', '12:13:09', NULL, 'Alpha', NULL, 3),
(43, '2021-01-04', '10:29:38', NULL, 'Telat', NULL, 1),
(44, '2021-01-04', '10:29:38', NULL, 'Alpha', NULL, 2),
(45, '2021-01-04', '10:29:38', NULL, 'Alpha', NULL, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cuti`
--

CREATE TABLE `cuti` (
  `id_cuti` int(100) NOT NULL,
  `nomor` char(10) NOT NULL DEFAULT 'PC20200',
  `user_id` int(255) NOT NULL,
  `tanggal` datetime NOT NULL,
  `alasan` text NOT NULL,
  `tgl_awal` date NOT NULL,
  `tgl_akhir` date NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'sedang menunggu persetujuan',
  `jumlah_cuti` decimal(3,1) NOT NULL,
  `approve` enum('Y','N') NOT NULL DEFAULT 'N',
  `tgl_approve` datetime NOT NULL DEFAULT '2020-01-01 00:00:00',
  `ket_approve` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `cuti`
--

INSERT INTO `cuti` (`id_cuti`, `nomor`, `user_id`, `tanggal`, `alasan`, `tgl_awal`, `tgl_akhir`, `status`, `jumlah_cuti`, `approve`, `tgl_approve`, `ket_approve`) VALUES
(1, 'PC20200', 2, '2021-01-02 00:00:00', 'popopoopopop', '2021-01-18', '2021-01-14', 'sedang menunggu persetujuan', '-3.0', 'N', '2020-01-01 00:00:00', NULL),
(2, 'PC20200', 2, '2021-01-02 00:00:00', 'polip', '2021-01-18', '2021-01-14', 'sedang menunggu persetujuan', '-3.0', 'N', '2020-01-01 00:00:00', NULL),
(3, 'PC20200', 2, '2021-01-03 00:00:00', 'palasoslsoadas', '2021-01-14', '2021-01-18', 'sedang menunggu persetujuan', '3.0', 'N', '2020-01-01 00:00:00', NULL),
(4, 'PC20200', 2, '2021-01-04 00:00:00', 'gatau', '2021-01-15', '2021-01-18', 'sedang menunggu persetujuan', '2.0', 'N', '2020-01-01 00:00:00', NULL),
(5, 'PC20200', 2, '2021-01-04 00:00:00', 'polssssss', '2021-01-22', '2021-01-25', 'sedang menunggu persetujuan', '2.0', 'N', '2020-01-01 00:00:00', NULL),
(6, 'PC20200', 2, '2021-01-04 00:00:00', 'cutiii', '2021-01-22', '2021-01-25', 'sedang menunggu persetujuan', '2.0', 'N', '2020-01-01 00:00:00', NULL),
(7, 'PC20200', 2, '2021-01-04 00:00:00', 'hulalalal', '2021-01-22', '2021-01-25', 'Telah dikonfirmasi dan disetujui.', '2.0', 'Y', '2020-01-01 00:00:00', 'Sudah sering dalam beberapa bulan'),
(8, 'PC20200', 2, '2021-01-04 00:00:00', 'plisksksksksks', '2021-01-28', '2021-02-01', 'sedang menunggu persetujuan', '3.0', 'N', '2020-01-01 00:00:00', NULL),
(9, 'PC20200', 3, '2021-01-07 00:00:00', 'cuti capek', '2021-01-22', '2021-01-25', 'sedang menunggu persetujuan', '2.0', 'N', '2020-01-01 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `divisis`
--

CREATE TABLE `divisis` (
  `id_divisi` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `divisis`
--

INSERT INTO `divisis` (`id_divisi`, `nama`) VALUES
(1, 'Dosen'),
(2, 'Tata Usaha'),
(3, 'Kebersihan'),
(4, 'Keamanan'),
(5, 'Administrator');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jatah_cuti`
--

CREATE TABLE `jatah_cuti` (
  `id` int(10) UNSIGNED NOT NULL,
  `tahun` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jatah_cuti`
--

INSERT INTO `jatah_cuti` (`id`, `tahun`, `jumlah`, `user_id`) VALUES
(1, '2020', '6', '1'),
(2, '2020', '20', '2'),
(3, '2020', '20', '3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keputusan`
--

CREATE TABLE `keputusan` (
  `id_keputusan` int(128) NOT NULL,
  `jenis` varchar(255) NOT NULL DEFAULT 'cuti',
  `user_id` int(255) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `keterangan` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `keputusan`
--

INSERT INTO `keputusan` (`id_keputusan`, `jenis`, `user_id`, `tanggal`, `keterangan`, `status`) VALUES
(1, 'cuti', 2, '2021-01-09 07:09:07', 'Sudah sering dalam beberapa bulan', 'Menyetujui');

-- --------------------------------------------------------

--
-- Struktur dari tabel `libur`
--

CREATE TABLE `libur` (
  `no_urut` int(11) NOT NULL,
  `tgl_libur` date NOT NULL,
  `keterangan` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `tahun` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `libur`
--

INSERT INTO `libur` (`no_urut`, `tgl_libur`, `keterangan`, `tahun`) VALUES
(43, '2020-01-01', 'Tahun baru Masehi', '2020'),
(45, '2020-01-25', 'TAHUN BARU IMLEK 2571', '2020'),
(46, '2020-03-22', 'ISRA MIKRAJ NABI MUHAMMAD SAW', '2020'),
(47, '2020-03-25', 'HARI RAYA NYEPI TAHUN BARU SAKA 1942', '2020'),
(48, '2020-04-10', 'WAFAT ISA ALMASIH', '2020'),
(49, '2020-05-01', 'HARI BURUH INTERNASIONAL', '2020'),
(50, '2020-05-07', 'HARI RAYA WAISAK 2562', '2020'),
(51, '2020-05-21', 'KENAIKAN ISA AL MASIH', '2020'),
(52, '2020-05-24', 'HARI RAYA IDUL FITRI 1441 HIJRIAH', '2020'),
(53, '2020-05-25', 'HARI RAYA IDUL FITRI 1441 HIJRIAH', '2020'),
(54, '2020-06-01', 'HARI LAHIR PANCASILA', '2020'),
(56, '2020-07-31', 'HARI RAYA IDUL ADHA 1441  HIJRIAH', '2020'),
(57, '2020-08-17', 'HARI KEMERDEKAAN REPUBLIK INDONESIA 75 TH', '2020'),
(58, '2020-08-20', 'TAHUN BARU ISLAM 1442 HIJRIYAH', '2020'),
(59, '2020-10-29', 'MAULID NABI MUHAMMAD SAW', '2020'),
(60, '2020-12-25', 'HARI RAYA NATAL', '2020'),
(61, '2020-05-22', 'CUTI MASSAL MENYAMBUT HARI RAYA IDUL FITRI', '2020'),
(62, '2020-05-23', 'CUTI MASSAL MENYAMBUT HARI RAYA IDUL FITRI', '2020'),
(63, '2020-05-26', 'CUTI MASSAL MENYAMBUT HARI RAYA IDUL FITRI', '2020'),
(64, '2020-05-27', 'CUTI MASSAL MENYAMBUT HARI RAYA IDUL FITRI', '2020'),
(65, '2020-12-26', 'CUTI MASSAL MENYAMBUT HARI RAYA NATAL', '2020'),
(66, '2021-01-02', 'CUTI MASSAL MENYAMBUT TAHUN BARU 2021', '2021'),
(67, '2021-02-12', 'Tahun Baru Imlek', '2021'),
(68, '2021-03-11', 'Isra Mi\'raj', '2021'),
(69, '2021-03-12', 'Cuti Bersama Isra Mi\'raj', '2021'),
(70, '2021-02-14', 'Hari Suci Nyepi', '2021'),
(71, '2021-04-02', 'Jumat Agung', '2021'),
(72, '2021-05-01', 'Hari Buruh', '2021'),
(73, '2021-05-12', 'Cuti Bersama Lebaran', '2021'),
(74, '2020-12-13', 'Kenaikan Isa Almasih dan Hari Raya Idul Fitri', '2021'),
(75, '2020-12-14', 'Hari Raya Idul Fitri', '2021'),
(76, '2021-05-17', 'Cuti Bersama Lebaran', '2021');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_11_08_234326_create_absensis_table', 2),
(5, '2020_11_08_234348_create_divisis_table', 3),
(6, '2018_06_28_192046_create_table_divisi', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengajuan`
--

CREATE TABLE `pengajuan` (
  `id_pengajuan` int(50) NOT NULL,
  `id_cuti` int(100) NOT NULL,
  `read` enum('Y','N') NOT NULL DEFAULT 'N',
  `tanggal` datetime NOT NULL,
  `keterangan` text NOT NULL,
  `jenis` char(50) NOT NULL,
  `user_id` int(255) NOT NULL,
  `status` enum('None','Menyetujui','Menolak') NOT NULL DEFAULT 'None'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `pengajuan`
--

INSERT INTO `pengajuan` (`id_pengajuan`, `id_cuti`, `read`, `tanggal`, `keterangan`, `jenis`, `user_id`, `status`) VALUES
(1, 0, 'N', '2021-01-02 00:00:00', 'polsasadaddadadasas', 'cuti', 2, 'None'),
(2, 1, 'N', '2021-01-02 00:00:00', 'popopoopopop', 'cuti', 2, 'None'),
(3, 2, 'N', '2021-01-02 00:00:00', 'polip', 'cuti', 2, 'None'),
(4, 3, 'N', '2021-01-03 00:00:00', 'palasoslsoadas', 'cuti', 2, 'None'),
(5, 4, 'N', '2021-01-04 00:00:00', 'gatau', 'cuti', 2, 'None'),
(6, 5, 'N', '2021-01-04 00:00:00', 'polssssss', 'cuti', 2, 'None'),
(7, 6, 'N', '2021-01-04 00:00:00', 'cutiii', 'cuti', 2, 'None'),
(8, 7, 'Y', '2021-01-04 00:00:00', 'hulalalal', 'cuti', 2, 'Menyetujui'),
(9, 8, 'N', '2021-01-04 00:00:00', 'plisksksksksks', 'cuti', 2, 'None'),
(10, 9, 'N', '2021-01-07 00:00:00', 'cuti capek', 'cuti', 3, 'None');

-- --------------------------------------------------------

--
-- Struktur dari tabel `post`
--

CREATE TABLE `post` (
  `id` int(255) NOT NULL,
  `judul` varchar(2160) NOT NULL,
  `desc` varchar(2160) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `post`
--

INSERT INTO `post` (`id`, `judul`, `desc`, `tanggal`) VALUES
(1, 'Tanggal Masuk Kantor', 'Masuk kantor tanggal 4 Januari 2021, menggunakan pakaian kurung sesuai dengan perintah dinas pendidikan provinsi dalam rangka memeriahkan hari ulang tahun kota Tanjungpinang', '2021-01-09 04:21:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `divisi` bigint(20) NOT NULL,
  `jk` enum('Pria','Wanita') COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` enum('karyawan','manajer','admin') COLLATE utf8mb4_unicode_ci NOT NULL,
  `notif` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `telp`, `divisi`, `jk`, `alamat`, `level`, `notif`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Nurhaq Halim', 'admin@gmail.com', NULL, '$2y$10$843cfVxwTsAb.W1SO7RokO54SqZ52tnykdqWuUobK9hvHKZ8w80U.', '822331122', 5, 'Pria', 'Jalan Sei Serai wedindra regency', 'admin', '1', 'Fud4Oo0v2SEmDEtpPKnue7fPAxzmdjVrEX5S1jxV9TtEh3m9GJAsCh6nfTcL', '2020-11-07 17:00:00', '2020-11-07 17:00:00'),
(2, 'Saya', 'saya@punya.com', NULL, '$2y$10$r6yZop.cqz3IBu8nd/DLl.LNJcyFX0Y9ZguDsGQ79HguMKgKws8pC', '628811881', 3, 'Pria', 'jalan damai', 'karyawan', '0', 'cKpCtJsSLmi399jjMVRPB3Ruds09j0LtR1bc1I8mF5wkoyty0fGHtvNsiILZ', '2020-11-11 17:00:00', '2020-11-11 17:00:00'),
(3, 'saya', 'apasaja@gmail.com', NULL, '$2y$10$r6yZop.cqz3IBu8nd/DLl.LNJcyFX0Y9ZguDsGQ79HguMKgKws8pC', '8888833322', 5, 'Pria', 'jalan serai', 'karyawan', '0', NULL, NULL, NULL),
(20, 'Sakila', 'Kilasakila900@gmail.com', NULL, '$2y$10$8E0zi7/T79OZaQ/yxRi.ZOrUdkjK1YrTl/PqvRxbF6LSKwyhA5j5m', '085263263983', 1, 'Wanita', 'jalan pandjaitan km9', 'karyawan', '0', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `waktu`
--

CREATE TABLE `waktu` (
  `id` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `mulai` time NOT NULL,
  `batas` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `waktu`
--

INSERT INTO `waktu` (`id`, `keterangan`, `mulai`, `batas`) VALUES
(1, 'Masuk', '05:00:00', '07:00:00'),
(2, 'Pulang', '15:00:00', '19:00:00');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensis`
--
ALTER TABLE `absensis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cuti`
--
ALTER TABLE `cuti`
  ADD PRIMARY KEY (`id_cuti`,`nomor`) USING BTREE;

--
-- Indeks untuk tabel `divisis`
--
ALTER TABLE `divisis`
  ADD PRIMARY KEY (`id_divisi`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jatah_cuti`
--
ALTER TABLE `jatah_cuti`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `keputusan`
--
ALTER TABLE `keputusan`
  ADD PRIMARY KEY (`id_keputusan`);

--
-- Indeks untuk tabel `libur`
--
ALTER TABLE `libur`
  ADD PRIMARY KEY (`no_urut`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD PRIMARY KEY (`id_pengajuan`);

--
-- Indeks untuk tabel `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeks untuk tabel `waktu`
--
ALTER TABLE `waktu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absensis`
--
ALTER TABLE `absensis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT untuk tabel `cuti`
--
ALTER TABLE `cuti`
  MODIFY `id_cuti` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `divisis`
--
ALTER TABLE `divisis`
  MODIFY `id_divisi` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jatah_cuti`
--
ALTER TABLE `jatah_cuti`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `keputusan`
--
ALTER TABLE `keputusan`
  MODIFY `id_keputusan` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `libur`
--
ALTER TABLE `libur`
  MODIFY `no_urut` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pengajuan`
--
ALTER TABLE `pengajuan`
  MODIFY `id_pengajuan` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `post`
--
ALTER TABLE `post`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `waktu`
--
ALTER TABLE `waktu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
