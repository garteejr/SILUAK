-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping data for table siluak.atk: ~0 rows (approximately)

-- Dumping data for table siluak.barang_atks: ~52 rows (approximately)siluaksiluak
INSERT INTO `barang_atks` (`id`, `nama_barang`, `satuan`, `stok`, `kategori`, `stok_minimal`, `created_at`, `updated_at`) VALUES
	(1, 'Tinta Epson 664', 'Pcs', 2, 'Alat Tulis', 1, '2026-03-04 04:15:07', '2026-03-04 04:15:07'),
	(2, 'Plakat', 'Unit', 5, 'Lain-lain', 1, '2026-03-04 04:15:35', '2026-03-04 04:15:35'),
	(3, 'Tinta Epson 003', 'Pcs', 1, 'Alat Tulis', 1, '2026-03-04 04:16:17', '2026-03-04 04:16:17'),
	(4, 'Lampu In-Lite 7W Kuning', 'Unit', 11, 'Lain-lain', 1, '2026-03-04 04:16:39', '2026-03-04 04:16:39'),
	(5, 'Penggaris Butterfly 60 cm', 'Pcs', 2, 'Alat Tulis', 1, '2026-03-04 04:16:42', '2026-03-04 04:16:42'),
	(6, 'Lampu MegaMan 12 W', 'Unit', 1, 'Lain-lain', 1, '2026-03-04 04:17:30', '2026-03-04 04:17:30'),
	(7, 'Replace Starter Lampu Philips', 'Pcs', 10, 'Lain-lain', 1, '2026-03-04 04:18:09', '2026-03-04 04:18:09'),
	(8, 'Galon Java 19L', 'Unit', 15, 'Lain-lain', 1, '2026-03-04 04:19:09', '2026-03-04 04:19:09'),
	(9, 'Galon Aqua 19L', 'Unit', 15, 'Lain-lain', 1, '2026-03-04 04:19:29', '2026-03-04 04:19:29'),
	(10, 'Staples Great Wall no.369', 'Pack', 83, 'Alat Tulis', 1, '2026-03-04 04:21:35', '2026-03-04 04:21:35'),
	(11, 'Staples Kangaro', 'Pack', 12, 'Alat Tulis', 1, '2026-03-04 04:24:34', '2026-03-04 04:24:34'),
	(12, 'Staples Atom', 'Pack', 5, 'Alat Tulis', 1, '2026-03-04 04:24:53', '2026-03-04 04:24:53'),
	(13, 'Gunting', 'Pcs', 1, 'Alat Tulis', 1, '2026-03-04 04:25:26', '2026-03-04 04:25:26'),
	(14, 'Lem Cair', 'Pcs', 31, 'Alat Tulis', 1, '2026-03-04 04:25:48', '2026-03-04 04:25:48'),
	(15, 'Penghapus Staedler Kecil', 'Pcs', 5, 'Alat Tulis', 1, '2026-03-04 04:26:36', '2026-03-04 04:26:36'),
	(16, 'Penghapus BIG 4B', 'Pcs', 23, 'Alat Tulis', 1, '2026-03-04 04:27:08', '2026-03-04 04:27:08'),
	(17, 'Lakban Coklat Besar', 'Pcs', 1, 'Alat Tulis', 1, '2026-03-04 04:28:10', '2026-03-04 04:28:10'),
	(18, 'Cutter Kenko A-300A', 'Pcs', 16, 'Alat Tulis', 1, '2026-03-04 04:28:52', '2026-03-04 04:28:52'),
	(19, 'Cutter Kenko A-300', 'Pcs', 2, 'Alat Tulis', 1, '2026-03-04 04:29:17', '2026-03-04 04:29:17'),
	(20, 'Cutter ZRM A-300', 'Pcs', 2, 'Alat Tulis', 1, '2026-03-04 04:29:41', '2026-03-04 04:29:41'),
	(21, 'Cutter Kenko A-500', 'Pcs', 13, 'Alat Tulis', 1, '2026-03-04 04:30:02', '2026-03-04 04:30:02'),
	(22, 'Isi Cutter Kenko A-100', 'Pcs', 47, 'Alat Tulis', 1, '2026-03-04 04:31:22', '2026-03-04 04:31:22'),
	(23, 'Isi Cutter Snap Blades', 'Pcs', 8, 'Alat Tulis', 1, '2026-03-04 04:32:06', '2026-03-04 04:32:06'),
	(24, 'Trigonal Clips ATOM', 'Pack', 4, 'Alat Tulis', 1, '2026-03-04 04:32:38', '2026-03-04 04:32:38'),
	(25, 'Paper Clips Jumbo Kenko', 'Pack', 1, 'Alat Tulis', 1, '2026-03-04 04:33:03', '2026-03-04 04:33:03'),
	(26, 'Buku Kwitansi', 'Pcs', 20, 'Alat Tulis', 1, '2026-03-04 04:33:23', '2026-03-04 04:33:23'),
	(27, 'Buku Ekspedisi', 'Pcs', 17, 'Alat Tulis', 1, '2026-03-04 04:33:46', '2026-03-04 04:33:46'),
	(28, 'Kertas Doorslag Folio Laba-laba', 'Rim', 9, 'Kertas', 1, '2026-03-04 04:34:16', '2026-03-04 04:34:16'),
	(29, 'Kertas Stensil Garuda', 'Rim', 2, 'Kertas', 1, '2026-03-04 04:34:33', '2026-03-04 04:34:33'),
	(30, 'Penggaris Butterfly 30 cm', 'Pcs', 3, 'Alat Tulis', 1, '2026-03-04 04:34:51', '2026-03-04 04:34:51'),
	(31, 'Amplop Merpati (162x114mm)', 'Pack', 1, 'Alat Tulis', 1, '2026-03-04 04:35:13', '2026-03-04 04:35:13'),
	(32, 'Amplop Paperline (110x320mm)', 'Pack', 1, 'Alat Tulis', 1, '2026-03-04 04:35:33', '2026-03-04 04:35:33'),
	(33, 'Pensil Staedtler', 'Pack', 34, 'Alat Tulis', 1, '2026-03-04 04:35:58', '2026-03-04 04:35:58'),
	(34, 'Amplop Coklat Dinas', 'Pcs', 153, 'Arsip', 10, '2026-03-04 04:36:00', '2026-03-04 04:37:06'),
	(35, 'Stopmap Dinas Kop', 'Pcs', 430, 'Arsip', 10, '2026-03-04 04:36:36', '2026-03-04 04:36:58'),
	(36, 'Pensil Faber Castell 2B', 'Pack', 3, 'Alat Tulis', 1, '2026-03-04 04:37:28', '2026-03-04 04:37:28'),
	(37, 'Pulpen Tizo Black', 'Pcs', 1, 'Alat Tulis', 1, '2026-03-04 04:37:38', '2026-03-04 04:37:38'),
	(38, 'Pulpen Tizo Blue', 'Pcs', 7, 'Alat Tulis', 1, '2026-03-04 04:37:54', '2026-03-04 04:37:54'),
	(39, 'Pulpen Zuixua Blue (Gel Pen)', 'Pcs', 3, 'Alat Tulis', 1, '2026-03-04 04:39:02', '2026-03-04 04:39:02'),
	(40, 'Pulpen Ball Liner', 'Pcs', 2, 'Alat Tulis', 1, '2026-03-04 04:39:23', '2026-03-04 04:39:23'),
	(41, 'Pulpen Pilot Ball Point', 'Pcs', 5, 'Alat Tulis', 1, '2026-03-04 04:39:47', '2026-03-04 04:39:47'),
	(42, 'Spidol Permanen', 'Pcs', 4, 'Alat Tulis', 1, '2026-03-04 04:40:04', '2026-03-04 04:40:04'),
	(43, 'Pulpen Zebra Pencilitic Green', 'Pcs', 24, 'Alat Tulis', 1, '2026-03-04 04:40:16', '2026-03-04 04:40:16'),
	(44, 'Spidol White Board', 'Pcs', 2, 'Alat Tulis', 1, '2026-03-04 04:40:25', '2026-03-04 04:40:25'),
	(45, 'Buku Folio', 'Pcs', 2, 'Alat Tulis', 1, '2026-03-04 04:40:46', '2026-03-04 04:40:46'),
	(46, 'Stopmap Kecil', 'Pcs', 250, 'Arsip', 1, '2026-03-04 04:41:03', '2026-03-04 04:41:03'),
	(47, 'Pulpen Standard AE7 0.5', 'Pcs', 4, 'Alat Tulis', 1, '2026-03-04 04:41:53', '2026-03-04 04:41:53'),
	(48, 'Tipex', 'Pcs', 2, 'Alat Tulis', 1, '2026-03-04 04:43:43', '2026-03-04 04:43:43'),
	(49, 'Amplop Kecil', 'Pack', 2, 'Alat Tulis', 1, '2026-03-04 04:44:29', '2026-03-04 04:44:29'),
	(50, 'Isi Tinta Stempel', 'Pcs', 4, 'Alat Tulis', 1, '2026-03-04 04:44:59', '2026-03-04 04:44:59'),
	(51, 'Kertas SIDU A3', 'Rim', 2, 'Kertas', 1, '2026-03-04 04:45:26', '2026-03-04 04:45:26'),
	(52, 'Kertas SIDU F4 Warna Ungu', 'Rim', 2, 'Kertas', 1, '2026-03-04 04:45:51', '2026-03-04 04:45:51'),
	(53, 'Kertas PaperOne F4', 'Rim', 19, 'Kertas', 1, '2026-03-04 04:46:19', '2026-03-04 04:46:19'),
	(54, 'Kertas PaperOne A4', 'Rim', 1, 'Kertas', 1, '2026-03-04 04:46:39', '2026-03-04 04:46:39'),
	(55, 'Kertas Bufallo Tosca F4', 'Pcs', 60, 'Kertas', 10, '2026-03-04 04:48:26', '2026-03-04 04:48:26'),
	(56, 'Re-Type Set', 'Pcs', 4, 'Alat Tulis', 1, '2026-03-04 04:51:27', '2026-03-04 04:51:27'),
	(57, 'Spidol Snowman Marker Kecil Blue', 'Pcs', 30, 'Alat Tulis', 1, '2026-03-04 04:51:57', '2026-03-04 04:51:57'),
	(58, 'Spidol Snowman Marker Kecil Black', 'Pcs', 40, 'Alat Tulis', 1, '2026-03-04 04:52:24', '2026-03-04 04:52:24');

-- Dumping data for table siluak.cache: ~0 rows (approximately)

-- Dumping data for table siluak.cache_locks: ~0 rows (approximately)

-- Dumping data for table siluak.failed_jobs: ~0 rows (approximately)

-- Dumping data for table siluak.jobs: ~0 rows (approximately)

-- Dumping data for table siluak.job_batches: ~0 rows (approximately)

-- Dumping data for table siluak.kerusakan_alats: ~13 rows (approximately)
REPLACE INTO `kerusakan_alats` (`id`, `nama`, `bidang`, `jenis_alat`, `nama_alat`, `kerusakan`, `status`, `prioritas`, `created_at`, `updated_at`) VALUES
	(1, 'Isa Thoriq', 'LPA', 'Lainnya (Tulis di Nama Barang)', 'AC, kursi', 'Sudah lama AC tidak menyala, mekanik kursi tidak berfungsi', 'Menunggu', 'Rendah', '2026-03-05 02:21:00', '2026-03-16 00:34:48'),
	(2, 'Eddy Yuniantoro, A.Md.', 'Keuangan (Sekretariat)', 'Lainnya (Tulis di Nama Barang)', 'Mesin Ketik Manual', 'Servis, ganti pita', 'Menunggu', 'Rendah', '2026-03-09 04:15:39', '2026-03-16 00:35:42'),
	(3, 'Eddy Yuniantoro, A.Md.', 'Keuangan (Sekretariat)', 'Lainnya (Tulis di Nama Barang)', 'Mesin Ketik Manual', 'Servis, ganti pita', 'Menunggu', 'Rendah', '2026-03-09 04:15:56', '2026-03-16 00:35:49'),
	(4, 'Eddy Yuniantoro, A.Md.', 'Keuangan (Sekretariat)', 'Laptop', 'Laptop Toshiba', 'Keyboard rusak,Batrai tidak menyimpan daya', 'Disetujui', 'Sedang', '2026-03-09 04:17:03', '2026-03-16 00:38:02'),
	(5, 'Eddy Yuniantoro, A.Md.', 'Keuangan (Sekretariat)', 'Laptop', 'Laptop Asus', 'Keyboard rusak', 'Disetujui', 'Sedang', '2026-03-09 04:17:33', '2026-03-16 00:37:53'),
	(6, 'Eddy Yuniantoro, A.Md.', 'Keuangan (Sekretariat)', 'Laptop', 'Laptop Dell', 'Upgrade OS, Batrai tidak menyimpan daya', 'Disetujui', 'Rendah', '2026-03-09 04:17:50', '2026-03-16 00:39:57'),
	(7, 'Eddy Yuniantoro, A.Md.', 'Keuangan (Sekretariat)', 'Laptop', 'Laptop Lenovo', 'Keyboard rusak, upgrade RAM', 'Selesai', 'Tinggi', '2026-03-09 04:18:09', '2026-03-09 04:52:49'),
	(8, 'Eddy Yuniantoro, A. Md.', 'Keuangan (Sekretariat)', 'Laptop', 'Lenovo', 'Keyboard rusak upgrade RAM', 'Ditolak', 'Tinggi', '2026-03-09 04:52:25', '2026-03-16 00:36:27'),
	(9, 'Eddy Yuniantoro, A.Md.', 'Keuangan (Sekretariat)', 'Lainnya (Tulis di Nama Barang)', 'AC split', 'Suhu tidak dingin', 'Menunggu', 'Belum Diatur', '2026-03-26 03:20:08', '2026-03-26 03:20:08'),
	(10, 'Eddy Yuniantoro, A.Md.', 'Keuangan (Sekretariat)', 'Lainnya (Tulis di Nama Barang)', 'AC split', 'Suhu tidak dingin', 'Menunggu', 'Belum Diatur', '2026-03-26 03:20:32', '2026-03-26 03:20:32'),
	(11, 'Eddy Yuniantoro, A.Md.', 'Keuangan (Sekretariat)', 'Printer', 'Printer Espon L3110', 'Tidak bisa cetak, lampu indikator kedip', 'Menunggu', 'Belum Diatur', '2026-03-26 03:22:03', '2026-03-26 03:22:03'),
	(12, 'Eddy Yuniantoro, A.Md.', 'Keuangan (Sekretariat)', 'Komputer', 'PC unit Mugen', 'Tidak bisa booting', 'Menunggu', 'Belum Diatur', '2026-03-26 03:22:27', '2026-03-26 03:22:27'),
	(13, 'Eddy Yuniantoro, A.Md.', 'Keuangan (Sekretariat)', 'Printer', 'Printer HP PI102', 'Hasil cetak buruk dan luntur', 'Menunggu', 'Belum Diatur', '2026-03-26 03:22:54', '2026-03-26 03:22:54'),
	(14, 'Welas yulianto', 'Umum dan Kepegawaian (Sekretariat)', 'Lainnya (Tulis di Nama Barang)', 'AC split 2 LG, 2 panasonic', 'AC kurang dingin', 'Menunggu', 'Belum Diatur', '2026-04-24 06:45:21', '2026-04-24 06:45:21'),
	(15, 'Djatmiko Adi Saputro, S.Hum', 'Pengembangan Perpustakaan', 'Komputer', 'Lenovo', 'Power tidak hidup (mati total)', 'Menunggu', 'Belum Diatur', '2026-05-04 04:13:22', '2026-05-04 04:13:22');

-- Dumping data for table siluak.kerusakan_gedungs: ~0 rows (approximately)

-- Dumping data for table siluak.menus: ~0 rows (approximately)

-- Dumping data for table siluak.migrations: ~0 rows (approximately)
REPLACE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2026_01_05_072222_create_pengajuan_bmds_table', 1),
	(5, '2026_01_05_072250_create_kerusakan_alats_table', 1),
	(6, '2026_01_05_072311_create_kerusakan_gedungs_table', 1),
	(7, '2026_01_05_072318_create_peminjaman_kendaraans_table', 1),
	(8, '2026_01_05_072327_create_peminjaman_ruangans_table', 1),
	(9, '2026_01_07_050443_create_menus_table', 1),
	(10, '2026_01_08_204106_add_prioritas_to_kerusakan_alats_table', 1),
	(11, '2026_01_09_031901_create_atk_table', 1),
	(12, '2026_01_09_061214_add_prioritas_to_kerusakan_gedungs_table', 1),
	(13, '2026_01_13_073442_create_barang_atks_table', 1);

-- Dumping data for table siluak.password_reset_tokens: ~0 rows (approximately)

-- Dumping data for table siluak.peminjaman_kendaraans: ~7 rows (approximately)
REPLACE INTO `peminjaman_kendaraans` (`id`, `nama`, `nip`, `telepon`, `bidang`, `jenis_kendaraan`, `tujuan`, `kegiatan`, `tgl_pinjam`, `tgl_kembali`, `status`, `surat_permohonan`, `created_at`, `updated_at`) VALUES
	(1, 'Sambunhno', '197401081996031002', '087833070724', 'Program (Sekretariat)', 'Pilih Kendaraan (H 9922 PA)', 'Kab semarang', 'Koordinasi bantuan tanaman untuk desa dampingn', '2026-04-02', '2026-04-02', 'Selesai', NULL, '2026-04-02 00:34:00', '2026-04-14 01:21:09'),
	(2, 'Eddy Yuniantoro, A.Md.', '198906292025211025', '085641141525', 'Keuangan (Sekretariat)', 'Mobil (H 1029 QA)', 'Surakarta', 'Rakor penyusunan rencana anggaran pendapatan tahun 2027', '2027-04-07', '2027-04-07', 'Selesai', NULL, '2026-04-07 01:30:23', '2026-04-14 01:21:08'),
	(3, 'Sambungno', '197401081996031002', '087833070724', 'Program (Sekretariat)', 'Mobil (H 9922 PA)', 'Bangda Prov. Jateng', 'rapat evaluasi desk program 136 Gubernur', '2026-04-08', '2026-04-08', 'Selesai', NULL, '2026-04-08 01:20:11', '2026-04-14 01:21:06'),
	(4, 'Muhammad Amir Setioko, S.Hum.', '199403152023211018', '085747079197', 'Pengembangan Perpustakaan', 'Pilih Kendaraan (H 9922 PA)', 'Temanggung', 'Validasi Penyusunan Data dan Informasi', '2026-04-17', '2026-04-17', 'Selesai', NULL, '2026-04-14 08:36:18', '2026-04-23 00:28:59'),
	(5, 'Sambungno', '197401081996031082', '087833070724', 'Program (Sekretariat)', 'Mobil (H 9922 PA)', 'Salatiga dan surajarta', 'Desk e controling dan desk capaian kinerja tw 1', '2026-04-15', '2026-04-16', 'Selesai', NULL, '2026-04-14 09:09:40', '2026-04-23 00:29:03'),
	(6, 'Sambungno', '197401081996031002', '087833070724', 'Program (Sekretariat)', 'Mobil (H 9922 PA)', 'Bappeda', 'Desk renja 2027', '2026-04-20', '2026-04-20', 'Selesai', NULL, '2026-04-20 01:18:25', '2026-04-23 00:29:01'),
	(7, 'Muhammad Amir Setioko, S.Hum.', '199403152023211018', '085747079197', 'Pengembangan Perpustakaan', 'Mobil (H 9922 PA)', 'Klaten', 'Pembinaan Perpustakaan Sekolah', '2026-04-21', '2026-04-21', 'Selesai', NULL, '2026-04-20 04:15:38', '2026-04-23 01:14:25');

-- Dumping data for table siluak.peminjaman_ruangans: ~23 rows (approximately)
REPLACE INTO `peminjaman_ruangans` (`id`, `nama`, `nip`, `telepon`, `bidang`, `ruangan`, `acara`, `tanggal`, `waktu_mulai`, `waktu_selesai`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'NURUL HIDAYAH, SE', '199503262020122004', '087736408629', 'Program (Sekretariat)', 'Ruang Rapat Lantai 1-Dinas Srondol', 'Forum Perangkat Daerah Penyusunan Renja 2027', '2026-03-09', '09:00:00', '12:00:00', 'Selesai', '2026-02-27 07:02:30', '2026-03-04 09:24:09'),
	(2, 'Risca Nurlaili', '19920203202521076', '085640188394', 'LPA', 'Ruang Rapat Lantai 2-Dinas Srondol', 'Rapat Persiapan Sosialisasi Kearsipan', '2026-03-10', '09:00:00', '13:00:00', 'Selesai', '2026-03-05 02:22:48', '2026-03-13 00:50:20'),
	(3, 'Risca Nurlaili', '199202032025212076', '085640188394', 'LPA', 'Ruang Rapat Lantai 1-Dinas Srondol', 'Sosialisasi Kearsipan Peraturan Daerah Provinsi Jawa Tengah No 10 Tahun 2025', '2026-03-31', '08:00:00', '14:00:00', 'Selesai', '2026-03-05 02:24:53', '2026-04-09 01:48:02'),
	(4, 'Sekar Ayu A', '199607092022032008', '+62 877-4786-5432', 'LPA', 'Ruang Rapat Lantai 1-Dinas Srondol', 'Kunjungan dari Universitas Diponegoro sebanyak 185 mahasiswa', '2026-03-30', '08:00:00', '14:00:00', 'Selesai', '2026-03-26 07:15:57', '2026-04-09 01:48:07'),
	(5, 'Risca Nurlaili', '199202032025212076', '085640188394', 'LPA', 'Ruang Rapat Lantai 2-Dinas Srondol', 'Rapat Persiapan penyusunan bahan paparan dan pembuatan film pendek Kegiatan MKB', '2026-04-07', '09:00:00', '13:00:00', 'Selesai', '2026-04-02 01:00:08', '2026-04-09 01:48:11'),
	(6, 'Sekar Ayu A', '199607092022032008', '+62 877-4786-5432', 'LPA', 'Ruang Rapat Lantai 1-Dinas Srondol', 'Kunjungan dari Demak', '2026-04-08', '08:00:00', '15:00:00', 'Selesai', '2026-04-02 02:08:26', '2026-04-09 01:48:15'),
	(7, 'Sekar Ayu A', '199607092022032008', '+62 877-4786-5432', 'LPA', 'Ruang Rapat Lantai 1-Dinas Srondol', 'Kunjungan dari SMK YPE Nusantara Slawi Tegal', '2026-04-14', '08:00:00', '14:30:00', 'Selesai', '2026-04-02 02:09:58', '2026-04-16 06:16:10'),
	(8, 'Sekar Ayu A', '199607092022032008', '+62 877-4786-5432', 'LPA', 'Ruang Rapat Lantai 1-Dinas Srondol', 'Kunjungan dari SMK Batealit Jepara', '2026-04-22', '08:00:00', '14:30:00', 'Selesai', '2026-04-02 02:11:15', '2026-04-23 00:28:36'),
	(9, 'Sekar Ayu A', '199607092022032008', '+62 877-4786-5432', 'LPA', 'Ruang Rapat Lantai 2-Dinas Srondol', 'Kunjungan DKI Jakarta', '2026-04-09', '08:00:00', '14:00:00', 'Selesai', '2026-04-06 04:07:35', '2026-04-16 06:16:02'),
	(10, 'Sekar Ayu A', '199607092022032008', '+62 877-4786-5432', 'LPA', 'Ruang Rapat Lantai 1-Dinas Srondol', 'Kunjungan dari SMK Kristen Gergaji Semarang dan Paparan MKB', '2026-04-16', '07:00:00', '15:30:00', 'Selesai', '2026-04-10 02:07:05', '2026-04-16 08:56:18'),
	(11, 'Sekar Ayu A', '199607092022032008', '+62 877-4786-5432', 'LPA', 'Ruang Rapat Lantai 1-Dinas Srondol', 'Paparan MKB', '2026-04-16', '08:00:00', '15:30:00', 'Selesai', '2026-04-15 06:47:07', '2026-04-16 08:55:10'),
	(12, 'Uuk Farina Ulfah Abror', '198006132025212020', '081326299908', 'PPA', 'Ruang Rapat Lantai 4-Dinas Srondol', 'Rapat Kerja Kegiatan percepatan pengelolaan arsip depo barat', '2026-04-21', '09:00:00', '12:00:00', 'Selesai', '2026-04-16 06:16:09', '2026-04-24 07:54:44'),
	(13, 'Risca Nurlaili', '199202032025212076', '085640188394', 'LPA', 'Ruang Rapat Lantai 1-Dinas Srondol', 'Kunjungan dari Undip', '2026-04-27', '07:30:00', '14:00:00', 'Selesai', '2026-04-21 00:38:54', '2026-05-04 05:43:07'),
	(14, 'Risca Nurlaili', '199202032025212076', '085640188394', 'LPA', 'Ruang Rapat Lantai 1-Dinas Srondol', 'Verivikasi Lapangan pengajuan MKB', '2026-04-24', '07:00:00', '14:00:00', 'Ditolak', '2026-04-21 00:39:53', '2026-04-21 02:11:46'),
	(15, 'LILIN SUBIYANTI, S.Hum', '199404272025212008', '082326698353', 'Pengembangan Perpustakaan', 'Ruang Rapat Lantai 1-Dinas Srondol', 'Kegiatan Pembekalan Nominasi Lomba Video Konten Literasi Tingkat Provinsi Jawa Tengah Tahun 2026', '2026-04-24', '07:30:00', '15:00:00', 'Selesai', '2026-04-21 02:06:35', '2026-04-21 05:19:08'),
	(16, 'Djatmiko Adi Saputro', '199112082022031003', '0898-5479-127', 'Pengembangan Perpustakaan', 'Ruang Rapat Lantai 1-Dinas Srondol', 'Kegiatan Rapat Koordinasi Pembinaan Perpustakaan Umum dan Khusus', '2026-04-15', '08:00:00', '12:30:00', 'Selesai', '2026-04-21 03:28:50', '2026-04-21 03:29:18'),
	(17, 'NURAINI SETYOWATI RAHAYU, A.Md', '198704062020122003', '0813-2711-7299', 'Pengembangan Perpustakaan', 'Ruang Rapat Lantai 1-Dinas Srondol', 'Kegiatan Uji Sertifikasi Pustakawan', '2026-05-21', '08:00:00', '15:30:00', 'Disetujui', '2026-04-21 03:34:17', '2026-04-21 03:36:09'),
	(18, 'NURAINI SETYOWATI RAHAYU, A.Md', '198704062020122003', '0813-2711-7299', 'Pengembangan Perpustakaan', 'Ruang Rapat Lantai 1-Dinas Srondol', 'Kegiatan Uji Sertifikasi Pustakawan', '2026-05-22', '08:00:00', '15:30:00', 'Disetujui', '2026-04-21 03:35:51', '2026-04-21 03:36:06'),
	(19, 'Risca Nurlaili', '199202032025212076', '0856-4018-8394', 'LPA', 'Ruang Rapat Lantai 1-Dinas Srondol', 'Kunjungan dri UNY', '2026-05-05', '09:00:00', '13:00:00', 'Selesai', '2026-04-21 05:13:22', '2026-05-07 04:00:42'),
	(20, 'LILIN SUBIYANTI, S.Hum', '199404272025212008', '0823-2669-8353', 'Pengembangan Perpustakaan', 'Ruang Rapat Lantai 4-Dinas Srondol', 'Kegiatan Pembekalan Nominasi Lomba Video Konten Literasi Tingkat Provinsi Jawa Tengah Tahun 2026', '2026-04-24', '07:30:00', '15:30:00', 'Selesai', '2026-04-21 05:22:28', '2026-04-24 07:54:53'),
	(21, 'Risca Nurlaili', '199202032025212076', '0856-4018-8394', 'LPA', 'Ruang Rapat Lantai 1-Dinas Srondol', 'Verivikasi Lapangan pengajuan MKB', '2026-04-24', '09:00:00', '14:00:00', 'Selesai', '2026-04-21 05:24:54', '2026-04-24 07:55:01'),
	(22, 'ANI SETIJAWATI, SE', '196710101994032010', '0813-2748-0016', 'Pengembangan Perpustakaan', 'Ruang Rapat Lantai 4-Dinas Srondol', 'Wawancara dan presentasi lomba duta,puisi,pidato dan artikel', '2026-05-05', '08:00:00', '15:30:00', 'Selesai', '2026-04-21 05:36:21', '2026-05-07 04:00:34'),
	(23, 'ANI SETIJAWATI, SE', '196710101994032010', '0813-2748-0016', 'Pengembangan Perpustakaan', 'Ruang Rapat Lantai 1-Dinas Srondol', 'Wawancara dan presentasi lomba duta,puisi,pidato dan artikel', '2026-05-06', '08:00:00', '15:30:00', 'Selesai', '2026-04-21 05:38:11', '2026-05-07 04:00:31'),
	(24, 'Sekar Ayu A', '199607092022032008', '+62 877-4786-5432', 'LPA', 'Ruang Rapat Lantai 1-Dinas Srondol', 'Kunjungan SMK N 1 petarukan', '2026-05-18', '08:30:00', '14:30:00', 'Disetujui', '2026-04-22 04:57:39', '2026-04-23 00:28:17'),
	(25, 'Chandra Bayu, S.IP', '198708122011011002', '0878-4456-3877', 'Program (Sekretariat)', 'Ruang Rapat Lantai 2-Dinas Srondol', 'Rapat POK s.d April TA. 2026', '2026-05-05', '09:00:00', '12:00:00', 'Selesai', '2026-05-04 03:08:27', '2026-05-07 04:00:25'),
	(26, 'Risca Nurlaili', '199202032025212076', '085640188394', 'LPA', 'Ruang Rapat Lantai 1-Dinas Srondol', 'Kunjungan dari Universitas Diponegoro Semarang', '2026-05-19', '08:30:00', '13:00:00', 'Disetujui', '2026-05-13 02:41:25', '2026-05-13 06:37:40'),
	(27, 'Risca Nurlaili', '199202032025212076', '085640188394', 'LPA', 'Ruang Rapat Lantai 1-Dinas Srondol', 'Kunjungan dari SMK N 1 Slawi (138 Orang)', '2026-06-08', '13:00:00', '14:30:00', 'Disetujui', '2026-05-13 03:35:39', '2026-05-13 06:37:20'),
	(28, 'Risca Nurlaili', '199202032025212076', '085640188394', 'LPA', 'Ruang Rapat Lantai 1-Dinas Srondol', 'SMK Maarif Tegal', '2026-06-10', '13:00:00', '14:30:00', 'Disetujui', '2026-05-13 03:37:17', '2026-05-13 06:37:14');

-- Dumping data for table siluak.pengajuan_bmds: ~0 rows (approximately)
REPLACE INTO `pengajuan_bmds` (`id`, `nama`, `email`, `bidang`, `kode`, `program`, `kegiatan`, `output`, `keterangan`, `items`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'Syahrul Gunawan', 'syahrul.arpusda@gmail.com', 'Umum dan Kepegawaian (Sekretariat)', NULL, '-', '-', '-', 'Penggantian perangkat jaringan', '{"0": {"jumlah": "1", "satuan": "Unit", "nama_barang": "Mikrotik (CCR1016-12G)"}, "2": {"jumlah": "4", "satuan": "Unit", "nama_barang": "TP-Link 8-Port Gigabit Switch"}, "3": {"jumlah": "2", "satuan": "Unit", "nama_barang": "TP-Link 16-Port Gigabit Switch"}, "4": {"jumlah": "2", "satuan": "Unit", "nama_barang": "UniFI AP AC LR"}}', 'Disetujui', '2026-03-30 07:58:43', '2026-04-09 01:52:33');

-- Dumping data for table siluak.sessions: ~5 rows (approximately)
REPLACE INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('GQNfTKc2epj4EJ40MstzHPLKWZX9Mv7qcMBSWjDq', NULL, '10.44.10.215', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidlhvdFd2ODZ4TnJ4ZzNFZ25reXZFSTJXRWc5VGdsbFl2ejJCRW5WaCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTM6Imh0dHA6Ly8xMC40NC4xMC4xNjQ6MzIxNC91bXBlZy9sYXBvcmFuL3BpbmphbV9ydWFuZ2FuIjtzOjU6InJvdXRlIjtzOjI4OiJ1bXBlZy5sYXBvcmFuLnBpbmphbV9ydWFuZ2FuIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1778643904),
	('jdhPEQS64TWt1VkNbA7UaxxN6WJGwVx5FYPdJQtA', NULL, '10.44.10.1', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiR0JxeTRaWG1sV1Vrc1YzQ216dWN6TkJnckhVdlc1a0pzQnJJUjhucCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjQ6Imh0dHA6Ly8xMC40NC4xMC4xNjQ6MzIxNCI7czo1OiJyb3V0ZSI7czo3OiJ3ZWxjb21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1778638623),
	('QgVOJsl8R4y2zIjXHWyJNfK4V9fh8x7lvXNK8hNt', NULL, '10.44.10.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRHlLQ0N5dlJjak84TkpBR0hYazNTcTlpNUlLQlFzSjB2bXRNYjNGZyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTM6Imh0dHA6Ly8xMC40NC4xMC4xNjQ6MzIxNC91bXBlZy9sYXBvcmFuL3BpbmphbV9ydWFuZ2FuIjtzOjU6InJvdXRlIjtzOjI4OiJ1bXBlZy5sYXBvcmFuLnBpbmphbV9ydWFuZ2FuIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1778652565),
	('TkQPIkUmW34Pr2ehkQ4vFems0oEcAkl7Ds3F1rko', NULL, '10.44.10.1', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTWw1MWxnNFdHa1MwR2lqRWh2OWczV3NxTU5EaUI3R0lPRDZXdENINCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjQ6Imh0dHA6Ly8xMC40NC4xMC4xNjQ6MzIxNCI7czo1OiJyb3V0ZSI7czo3OiJ3ZWxjb21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1778649847),
	('uCCZxw7HJsKXF8OjYiafdCbjcY6db5SE4Q7Zrfn7', 1, '10.44.10.70', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSlIyWDQxNHVKdmtWR3N4WE41ekxZVGNjZ2FqSkw1UXdYNkVvMVhsciI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly8xMC40NC4xMC4xNjQ6MzIxNC9wZW1pbmphbWFuL3J1YW5nIjtzOjU6InJvdXRlIjtzOjIyOiJhZG1pbi5wZW1pbmphbWFuLnJ1YW5nIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1778654260);

-- Dumping data for table siluak.users: ~0 rows (approximately)
REPLACE INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Admin UMPEG', 'umpeg@example.com', NULL, '$2y$12$uTlTMLmXVfxwWyhfCSmGeOUlAXT.vY6D6K1re3saUWVUKtxeRMBY.', 'umpeg', NULL, '2026-02-24 03:35:41', '2026-02-24 03:35:41');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
siluaksiluak