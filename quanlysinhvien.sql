-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2026 at 10:32 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quanlysinhvien`
--

-- --------------------------------------------------------

--
-- Table structure for table `bangdiem`
--

CREATE TABLE `bangdiem` (
  `id` int(11) NOT NULL,
  `sinhvien_id` int(11) DEFAULT NULL,
  `monhoc_id` int(11) DEFAULT NULL,
  `diem_chuyencan` float DEFAULT NULL,
  `diem_giua_ky` float DEFAULT NULL,
  `diem_cuoi_ky` float DEFAULT NULL,
  `diem_ren_luyen` float DEFAULT NULL,
  `diem_tong` float DEFAULT NULL,
  `diem_he4` float DEFAULT NULL,
  `diem_chu` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bangdiem`
--

INSERT INTO `bangdiem` (`id`, `sinhvien_id`, `monhoc_id`, `diem_chuyencan`, `diem_giua_ky`, `diem_cuoi_ky`, `diem_ren_luyen`, `diem_tong`, `diem_he4`, `diem_chu`) VALUES
(1, 1, 1, 9, 8, 9, 8, 8.7, 4, 'A'),
(2, 1, 3, 8, 7, 7, 8, 7.3, 3, 'B'),
(7, 5, 4, 9, 9, 9, 9, 9, 4, 'A'),
(8, 5, 3, 8, 8, 8, 8, 8, 3.5, 'B+'),
(9, 6, 1, 4, 4, 3, 5, 3.7, 0, 'F'),
(10, 6, 6, 6, 5, 4, 6, 4.8, 1, 'D'),
(11, 2, 1, 8, 7, 7, 8, 7.3, 3, 'B'),
(12, 2, 3, 7, 6, 6, 7, 6.3, 2.5, 'C+'),
(13, 7, 4, 9, 8, 8, 9, 8.3, 3.5, 'B+'),
(14, 7, 3, 8, 7, 7, 8, 7.3, 3, 'B'),
(15, 8, 2, 7, 6, 5, 7, 5.6, 2, 'C'),
(16, 8, 5, 6, 5, 4, 6, 4.6, 1, 'D'),
(17, 9, 1, 5, 4, 3, 5, 3.6, 0, 'F'),
(18, 9, 3, 6, 5, 4, 6, 4.8, 1, 'D'),
(19, 10, 4, 9, 9, 10, 9, 9.4, 4, 'A'),
(20, 10, 3, 8, 8, 9, 8, 8.6, 4, 'A'),
(21, 11, 2, 4, 4, 3, 4, 3.6, 0, 'F'),
(22, 11, 6, 5, 5, 4, 5, 4.5, 1, 'D'),
(23, 12, 3, 8, 7, 7, 8, 7.3, 3, 'B'),
(24, 12, 4, 7, 7, 7, 7, 7, 3, 'B'),
(25, 13, 1, 7, 6, 6, 7, 6.3, 2.5, 'C+'),
(26, 13, 2, 6, 5, 5, 6, 5.5, 2, 'C'),
(27, 14, 3, 5, 4, 3, 5, 3.6, 0, 'F'),
(28, 14, 4, 6, 5, 4, 6, 4.8, 1, 'D'),
(29, 15, 4, 10, 9, 10, 10, 9.7, 4, 'A'),
(30, 15, 3, 9, 9, 9, 9, 9, 4, 'A'),
(31, 16, 1, 4, 4, 3, 4, 3.6, 0, 'F'),
(32, 16, 6, 5, 4, 4, 5, 4.4, 1, 'D'),
(33, 17, 3, 10, 8, 8.5, 9, 8.6, 4, 'A'),
(34, 11, 1, 8, 5, 5, 9, 5.7, 2, 'C');

-- --------------------------------------------------------

--
-- Table structure for table `hocky`
--

CREATE TABLE `hocky` (
  `id` int(11) NOT NULL,
  `tenhocky` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hocky`
--

INSERT INTO `hocky` (`id`, `tenhocky`) VALUES
(1, 'Học kỳ 1 - 2024-2025'),
(2, 'Học kỳ 2 - 2024-2025');

-- --------------------------------------------------------

--
-- Table structure for table `khoa`
--

CREATE TABLE `khoa` (
  `id` int(11) NOT NULL,
  `tenkhoa` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `khoa`
--

INSERT INTO `khoa` (`id`, `tenkhoa`) VALUES
(1, 'Công nghệ thông tin'),
(2, 'Kỹ thuật điện'),
(3, 'Kinh tế');

-- --------------------------------------------------------

--
-- Table structure for table `lop`
--

CREATE TABLE `lop` (
  `id` int(11) NOT NULL,
  `tenlop` varchar(20) NOT NULL,
  `khoa_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lop`
--

INSERT INTO `lop` (`id`, `tenlop`, `khoa_id`) VALUES
(1, '74DCTT24', 1),
(2, '74DCTT25', 1),
(3, '74DCTT26', 1);

-- --------------------------------------------------------

--
-- Table structure for table `monhoc`
--

CREATE TABLE `monhoc` (
  `id` int(11) NOT NULL,
  `ma_mon` varchar(20) DEFAULT NULL,
  `ten_mon` varchar(100) DEFAULT NULL,
  `so_tin_chi` int(11) DEFAULT NULL,
  `bat_buoc` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `monhoc`
--

INSERT INTO `monhoc` (`id`, `ma_mon`, `ten_mon`, `so_tin_chi`, `bat_buoc`) VALUES
(1, 'MH001', 'Lập trình C', 3, 1),
(2, 'MH002', 'Cấu trúc dữ liệu', 3, 1),
(3, 'MH003', 'Cơ sở dữ liệu', 3, 1),
(4, 'MH004', 'Lập trình Java', 3, 1),
(5, 'MH005', 'Toán rời rạc', 2, 1),
(6, 'MH006', 'Kỹ năng mềm', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sinhvien`
--

CREATE TABLE `sinhvien` (
  `id` int(11) NOT NULL,
  `msv` varchar(20) NOT NULL,
  `hovaten` varchar(100) NOT NULL,
  `ngaysinh` date DEFAULT NULL,
  `gioitinh` varchar(10) DEFAULT NULL,
  `dienthoai` varchar(20) DEFAULT NULL,
  `diachi` varchar(255) DEFAULT NULL,
  `tongtinchi` int(11) DEFAULT 0,
  `gpa` decimal(3,2) DEFAULT NULL,
  `trangthai` varchar(50) DEFAULT NULL,
  `lop_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sinhvien`
--

INSERT INTO `sinhvien` (`id`, `msv`, `hovaten`, `ngaysinh`, `gioitinh`, `dienthoai`, `diachi`, `tongtinchi`, `gpa`, `trangthai`, `lop_id`) VALUES
(1, 'SV001', 'Lê Ngọc Duy', '2004-06-15', 'Nam', '0987654321', 'Hà Nội', 90, 3.40, 'Đang học', 1),
(2, 'SV002', 'Nguyễn Thị Lan', '2004-09-20', 'Nữ', '0978123456', 'Hải Phòng', 75, 3.10, 'Đang học', 2),
(5, 'SV003', 'Lê Văn Sơn', '2004-01-15', 'Nam', '', 'Hà Nội', 120, 3.70, 'Đang học', 1),
(6, 'SV004', 'Phạm Thị Thùy Linh', '2004-09-01', 'Nữ', '', 'Thanh Hóa', 60, 1.90, 'Thôi học', 1),
(7, 'SV2501', 'Nguyễn Văn Bình', '2004-03-12', 'Nam', '', 'Hà Nội', 95, 3.45, 'Đang học', 2),
(8, 'SV2502', 'Trần Thị Lan', '2004-07-20', 'Nữ', '', 'Hà Nội', 88, 3.10, 'Bảo lưu', 2),
(9, 'SV2503', 'Phạm Văn Quân', '2004-11-02', 'Nam', '', 'Thanh Hóa', 80, 2.40, 'Thôi học', 2),
(10, 'SV2504', 'Lê Thị Mai', '2004-01-15', 'Nữ', '', 'Thanh Hóa', 105, 3.70, 'Đang học', 2),
(11, 'SV2505', 'Hoàng Minh Đức', '2004-09-09', 'Nam', '', 'Hà Nội', 60, 1.85, 'Thôi học', 2),
(12, 'SV2601', 'Đỗ Văn Nam', '2004-05-18', 'Nam', '', 'Hà Nội', 92, 3.25, 'Đang học', 3),
(13, 'SV2602', 'Vũ Thị Hạnh', '2004-08-10', 'Nữ', '', 'Hải Phòng', 85, 2.75, 'Đang học', 3),
(14, 'SV2603', 'Nguyễn Đức Long', '2004-02-22', 'Nam', '', 'Vĩnh Phúc', 78, 2.10, 'Thôi học', 3),
(15, 'SV2604', 'Phan Thị Hoa', '2004-12-30', 'Nữ', '', 'Hà Nội', 110, 3.90, 'Đang học', 3),
(16, 'SV2605', 'Bùi Minh Tuấn', '2004-06-06', 'Nam', '', 'Hải Dương', 50, 1.60, 'Bảo lưu', 3),
(17, '74DCTT22277', 'Nguyễn Đình Chí Kim', '2003-12-12', 'Nam', '0981366714', 'Hà Nội', 41, 3.20, 'Đã tốt nghiệp', 2),
(19, '74DCTT21986', 'Lê Công Hồng Phúc', '2005-03-08', 'Nam', '0377792678', 'Thanh Hóa', 0, NULL, 'Đang học', 3),
(20, '73DCTT27819', 'Lê Thị Mịn', '2004-09-04', 'Nữ', '0971950633', 'Thanh Hóa', 0, NULL, 'Đang học', 2);

-- --------------------------------------------------------

--
-- Table structure for table `thongbao`
--

CREATE TABLE `thongbao` (
  `id` int(11) NOT NULL,
  `tieude` varchar(255) NOT NULL,
  `noidung` text NOT NULL,
  `loaitin` enum('Học tập','Thông báo chung','Tài chính') DEFAULT 'Thông báo chung',
  `lop` enum('Tất cả','74DCTT24','74DCTT25','74DCTT26') DEFAULT 'Tất cả',
  `ngaydang` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `thongbao`
--

INSERT INTO `thongbao` (`id`, `tieude`, `noidung`, `loaitin`, `lop`, `ngaydang`) VALUES
(1, 'Thông báo kiểm tra giữa kỳ', 'Sinh viên lớp 74DCTT24 chuẩn bị kiểm tra giữa kỳ môn PHP', 'Học tập', '74DCTT24', '2025-12-28 17:53:47'),
(2, 'Thông báo đóng học phí', 'Sinh viên hoàn thành học phí học kỳ 2. Quá hạn sẽ không được dự thi.', 'Tài chính', 'Tất cả', '2025-12-28 17:54:31'),
(3, 'Bổ sung hồ sơ sinh viên', 'Sinh viên lớp 74DCTT25 nộp bổ sung hồ sơ còn thiếu.', 'Thông báo chung', '74DCTT25', '2025-12-28 17:55:08'),
(4, 'Thay đổi phòng học', 'Lớp 74DCTT26 chuyển sang học tại phòng A305 kể từ tuần sau.', 'Học tập', '74DCTT26', '2025-12-28 17:55:08'),
(5, 'Học bù', 'Sáng mai lớp học bù môn Lập trình trên môi trường Web!!!', 'Học tập', '74DCTT25', '2025-12-28 18:05:55'),
(6, 'Thi lại', 'Sáng mai lớp mình thi lại môn CSDL', 'Học tập', '', '2025-12-29 03:27:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `created_at`) VALUES
(3, 'admin@gmail.com', '$2y$10$rrZnYg5loEssYyb8BqsMKupQgTZb9khw5oMNYF1n9YWCpox6xPjGK', '2025-12-28 17:10:24'),
(4, 'nduy@gmail.com', '$2y$10$yZEfCZOnIb1G8V/oihrhrOFJpyJonF.6wgktt1IS5wmXCb1liWbTy', '2025-12-28 17:11:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bangdiem`
--
ALTER TABLE `bangdiem`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sinhvien_id` (`sinhvien_id`),
  ADD KEY `monhoc_id` (`monhoc_id`);

--
-- Indexes for table `hocky`
--
ALTER TABLE `hocky`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `khoa`
--
ALTER TABLE `khoa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lop`
--
ALTER TABLE `lop`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_lop_khoa` (`khoa_id`);

--
-- Indexes for table `monhoc`
--
ALTER TABLE `monhoc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_sv_lop` (`lop_id`);

--
-- Indexes for table `thongbao`
--
ALTER TABLE `thongbao`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bangdiem`
--
ALTER TABLE `bangdiem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `hocky`
--
ALTER TABLE `hocky`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `khoa`
--
ALTER TABLE `khoa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lop`
--
ALTER TABLE `lop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `monhoc`
--
ALTER TABLE `monhoc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sinhvien`
--
ALTER TABLE `sinhvien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `thongbao`
--
ALTER TABLE `thongbao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bangdiem`
--
ALTER TABLE `bangdiem`
  ADD CONSTRAINT `bangdiem_ibfk_1` FOREIGN KEY (`sinhvien_id`) REFERENCES `sinhvien` (`id`),
  ADD CONSTRAINT `bangdiem_ibfk_2` FOREIGN KEY (`monhoc_id`) REFERENCES `monhoc` (`id`);

--
-- Constraints for table `lop`
--
ALTER TABLE `lop`
  ADD CONSTRAINT `fk_lop_khoa` FOREIGN KEY (`khoa_id`) REFERENCES `khoa` (`id`);

--
-- Constraints for table `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD CONSTRAINT `fk_sv_lop` FOREIGN KEY (`lop_id`) REFERENCES `lop` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
