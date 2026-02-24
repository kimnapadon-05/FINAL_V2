-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 17, 2026 at 07:08 AM
-- Server version: 10.11.14-MariaDB-0+deb12u2-log
-- PHP Version: 8.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `repair_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password_hash`, `created_at`) VALUES
(9, 'admin', '$2y$10$gCOLE7jPpGKmBdjqXDCIdeuA00LV88mDe6hSbafP/M4dIg69fWpiy', '2026-01-21 01:26:13');

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `id` int(11) NOT NULL,
  `asset_id` varchar(50) NOT NULL,
  `equipment_name` varchar(100) DEFAULT NULL,
  `model_name` varchar(255) NOT NULL,
  `equipment_type` varchar(50) DEFAULT NULL,
  `serial_no` varchar(100) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `qr_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipment`
--

INSERT INTO `equipment` (`id`, `asset_id`, `equipment_name`, `model_name`, `equipment_type`, `serial_no`, `location`, `image_path`, `qr_path`, `created_at`) VALUES
(22, '2026-01', 'COM-01', '(AIO) Acer Veriton Z VZ4870G', 'COMPUTER EQUIPMENT', 'DZVTQST00114004CA63000', 'ตึก 26 TC203', 'uploads/Img_2026-01.png', 'qrcodes/QR_2026-01.png', '2026-02-11 07:43:10'),
(23, '2026-02', 'COM-02', '(AIO) Acer Veriton Z VZ4870G', 'COMPUTER EQUIPMENT', 'DZVTQST00114004CA23000', 'ตึก 26 TC203', 'uploads/Img_2026-02.png', 'qrcodes/QR_2026-02.png', '2026-02-16 15:13:29'),
(24, '2026-03', 'COM-03', '(AIO) Acer Veriton Z VZ4870G', 'COMPUTER EQUIPMENT', 'DZVTQST00114004E3E3000', 'ตึก 26 TC203', 'uploads/Img_2026-03.png', 'qrcodes/QR_2026-03.png', '2026-02-16 15:18:42'),
(25, '2026-04', 'COM-04', '(AIO) Acer Veriton Z VZ4870G', 'COMPUTER EQUIPMENT', 'DZVTQST00114004E3F3000', 'ตึก 26 TC203', 'uploads/Img_2026-04.png', 'qrcodes/QR_2026-04.png', '2026-02-16 15:21:07'),
(28, '2026-05', 'COM-05', '(AIO) Acer Veriton Z VZ4870G', 'COMPUTER EQUIPMENT', 'DZVTQST00114004CD23000', 'ตึก 26 TC203', 'uploads/Img_2026-05.png', 'qrcodes/QR_2026-05.png', '2026-02-16 17:47:06'),
(29, '2026-06', 'COM-06', '(AIO) Acer Veriton Z VZ4870G', 'COMPUTER EQUIPMENT', 'DZVTQST001140005FB3000', 'ตึก 26 TC203', 'uploads/Img_2026-06.png', 'qrcodes/QR_2026-06.png', '2026-02-16 17:52:48'),
(30, '2026-07', 'COM-07', '(AIO) Acer Veriton Z VZ4870G', 'COMPUTER EQUIPMENT', 'DZVTQST00114004E373000', 'ตึก 26 TC203', 'uploads/Img_2026-07.png', 'qrcodes/QR_2026-07.png', '2026-02-16 17:53:55'),
(31, '2026-08', 'COM-08', '(AIO) Acer Veriton Z VZ4870G', 'COMPUTER EQUIPMENT', 'DZVTQST00114004D563000', 'ตึก 26 TC203', 'uploads/Img_2026-08.png', 'qrcodes/QR_2026-08.png', '2026-02-16 17:54:54'),
(32, '2026-09', 'COM-09', '(AIO) Acer Veriton Z VZ4870G', 'COMPUTER EQUIPMENT', 'DZVTQST00114004E5C3000', 'ตึก 26 TC203', 'uploads/Img_2026-09.png', 'qrcodes/QR_2026-09.png', '2026-02-16 17:55:37'),
(33, '2026-10', 'COM-10', '(AIO) Acer Veriton Z VZ4870G', 'COMPUTER EQUIPMENT', 'DZVTQST00114004D393000', 'ตึก 26 TC203', 'uploads/Img_2026-10.png', 'qrcodes/QR_2026-10.png', '2026-02-16 17:56:10'),
(34, '2026-11', 'COM-11', '(AIO) Acer Veriton Z VZ4870G', 'COMPUTER EQUIPMENT', 'DZVTQST00114004E363000', 'ตึก 26 TC203', 'uploads/Img_2026-11.png', 'qrcodes/QR_2026-11.png', '2026-02-16 17:56:44'),
(35, '2026-12', 'COM-12', '(AIO) Acer Veriton Z VZ4870G', 'COMPUTER EQUIPMENT', 'DZVTQST001140004A93000', 'ตึก 26 TC203', 'uploads/Img_2026-12.png', 'qrcodes/QR_2026-12.png', '2026-02-16 17:57:37'),
(36, '2026-13', 'COM-13', '(AIO) Acer Veriton Z VZ4870G', 'COMPUTER EQUIPMENT', 'DZVTQST00114004E383000', 'ตึก 26 TC203', 'uploads/Img_2026-13.png', 'qrcodes/QR_2026-13.png', '2026-02-16 17:58:33'),
(37, '2026-14', 'COM-14', '(AIO) Acer Veriton Z VZ4870G', 'COMPUTER EQUIPMENT', 'DZVTQST0011400054E3000', 'ตึก 26 TC203', 'uploads/Img_2026-14.png', 'qrcodes/QR_2026-14.png', '2026-02-16 17:59:05'),
(38, '2026-15', 'COM-15', '(AIO) Acer Veriton Z VZ4870G', 'COMPUTER EQUIPMENT', 'DZVTQST00114004CAC3000', 'ตึก 26 TC203', 'uploads/Img_2026-15.png', 'qrcodes/QR_2026-15.png', '2026-02-16 17:59:42'),
(39, '2026-16', 'COM-16', '(AIO) Acer Veriton Z VZ4870G', 'COMPUTER EQUIPMENT', 'DZVTQST00114004E2D3000', 'ตึก 26 TC203', 'uploads/Img_2026-16.png', 'qrcodes/QR_2026-16.png', '2026-02-16 18:00:50'),
(40, '2026-17', 'COM-17', '(AIO) Acer Veriton Z VZ4870G', 'COMPUTER EQUIPMENT', 'DZVTQST00114004E743000', 'ตึก 26 TC203', 'uploads/Img_2026-17.png', 'qrcodes/QR_2026-17.png', '2026-02-16 18:01:24'),
(41, '2026-18', 'COM-18', '(AIO) Acer Veriton Z VZ4870G', 'COMPUTER EQUIPMENT', 'DZVTQST00114004E2C3000', 'ตึก 26 TC203', 'uploads/Img_2026-18.png', 'qrcodes/QR_2026-18.png', '2026-02-16 18:01:52'),
(42, '2026-19', 'COM-19', '(AIO) Acer Veriton Z VZ4870G', 'COMPUTER EQUIPMENT', 'DZVTQST00114004C9E3000', 'ตึก 26 TC203', 'uploads/Img_2026-19.png', 'qrcodes/QR_2026-19.png', '2026-02-16 18:59:37'),
(43, '2026-20', 'COM-20', '(AIO) Acer Veriton Z VZ4870G', 'COMPUTER EQUIPMENT', 'DZVTQST001140004C43000', 'ตึก 26 TC203', 'uploads/Img_2026-20.png', 'qrcodes/QR_2026-20.png', '2026-02-16 19:01:47'),
(44, '2026-21', 'COM-21', '(AIO) Acer Veriton Z VZ4870G', 'COMPUTER EQUIPMENT', 'DZVTQST00114004E353000', 'ตึก 26 TC203', 'uploads/Img_2026-21.png', 'qrcodes/QR_2026-21.png', '2026-02-16 19:05:42'),
(45, '2026-22', 'COM-22', '(AIO) Acer Veriton Z VZ4870G', 'COMPUTER EQUIPMENT', 'DZVTQST00114004D4A3000', 'ตึก 26 TC203', 'uploads/Img_2026-22.png', 'qrcodes/QR_2026-22.png', '2026-02-16 19:06:08'),
(47, '2026-23', 'COM-01', 'ideacentre AIO 3-22IMB05', 'COMPUTER EQUIPMENT', 'MP1RQA3B', 'ตึก 26 TC205', 'uploads/Img_2026-23.jpg', 'qrcodes/QR_2026-23.png', '2026-02-16 23:33:34'),
(48, '2026-24', 'COM-02', 'ideacentre AIO 3-22IMB05', 'COMPUTER EQUIPMENT', 'MP1RQA3S', 'ตึก 26 TC205', 'uploads/Img_2026-24.jpg', 'qrcodes/QR_2026-24.png', '2026-02-16 23:35:08'),
(49, '2026-25', 'COM-03', 'ideacentre AIO 3-22IMB05', 'COMPUTER EQUIPMENT', 'MP1RQ322', 'ตึก 26 TC205', 'uploads/Img_2026-25.jpg', 'qrcodes/QR_2026-25.png', '2026-02-16 23:35:48'),
(50, '2026-26', 'COM-04', 'ideacentre AIO 3-22IMB05', 'COMPUTER EQUIPMENT', 'MP1RQ59L', 'ตึก 26 TC205', 'uploads/Img_2026-27.jpg', 'qrcodes/QR_2026-27.png', '2026-02-16 23:36:44'),
(51, '2026-27', 'COM-05', 'ideacentre AIO 3-22IMB05', 'COMPUTER EQUIPMENT', 'MP1RQYNW', 'ตึก 26 TC205', 'uploads/Img_2026-28.jpg', 'qrcodes/QR_2026-28.png', '2026-02-16 23:39:12'),
(52, '2026-28', 'COM-06', 'ideacentre AIO 3-22IMB05', 'COMPUTER EQUIPMENT', 'MP1RQYNH', 'ตึก 26 TC205', 'uploads/Img_2026-29.jpg', 'qrcodes/QR_2026-29.png', '2026-02-16 23:39:42'),
(53, '2026-29', 'COM-07', 'ideacentre AIO 3-22IMB05', 'COMPUTER EQUIPMENT', 'MP1RQYL0', 'ตึก 26 TC205', 'uploads/Img_2026-29.jpg', 'qrcodes/QR_2026-29.png', '2026-02-16 23:43:22'),
(54, '2026-30', 'COM-09', 'ideacentre AIO 3-22IMB05', 'COMPUTER EQUIPMENT', 'MP1RQA1Q', 'ตึก 26 TC205', 'uploads/Img_2026-30.jpg', 'qrcodes/QR_2026-30.png', '2026-02-16 23:43:52'),
(55, '2026-31', 'COM-10', 'ideacentre AIO 3-22IMB05', 'COMPUTER EQUIPMENT', 'MP1RQ7T', 'ตึก 26 TC205', 'uploads/Img_2026-31.jpg', 'qrcodes/QR_2026-31.png', '2026-02-16 23:45:09'),
(56, '2026-32', 'COM-11', 'HP ProOne 600 G2 Base Model', 'COMPUTER EQUIPMENT', 'SGH631RM90', 'ตึก 26 TC205', 'uploads/Img_2026-32.png', 'qrcodes/QR_2026-32.png', '2026-02-16 23:51:13'),
(57, '2026-33', 'COM-12', 'HP ProOne 600 G2 Base Model', 'COMPUTER EQUIPMENT', 'SGH631RM99\r\n', 'ตึก 26 TC205', 'uploads/Img_2026-33.png', 'qrcodes/QR_2026-33.png', '2026-02-16 23:52:54'),
(58, '2026-34', 'COM-13', 'HP ProOne 600 G2 Base Model', 'COMPUTER EQUIPMENT', 'SGH631RM7Q\r\n', 'ตึก 26 TC205', 'uploads/Img_2026-34.png', 'qrcodes/QR_2026-34.png', '2026-02-16 23:54:11'),
(59, '2026-35', 'COM-14', 'HP ProOne 600 G2 Base Model', 'COMPUTER EQUIPMENT', 'SGH631RM98\r\n', 'ตึก 26 TC205', 'uploads/Img_2026-35.png', 'qrcodes/QR_2026-35.png', '2026-02-16 23:54:34'),
(60, '2026-36', 'COM-15', 'HP ProOne 600 G2 Base Model', 'COMPUTER EQUIPMENT', 'SGH631RM94\r\n', 'ตึก 26 TC205', 'uploads/Img_2026-36.png', 'qrcodes/QR_2026-36.png', '2026-02-16 23:55:58'),
(61, '2026-37', 'COM-16', 'HP ProOne 600 G2 Base Model', 'COMPUTER EQUIPMENT', 'SGH631RM74\r\n', 'ตึก 26 TC205', 'uploads/Img_2026-37.png', 'qrcodes/QR_2026-37.png', '2026-02-16 23:57:28'),
(62, '2026-38', 'COM-17', 'HP ProOne 600 G2 Base Model', 'COMPUTER EQUIPMENT', 'SGH633SKDJ\r\n', 'ตึก 26 TC205', 'uploads/Img_2026-38.png', 'qrcodes/QR_2026-38.png', '2026-02-16 23:58:01'),
(63, '2026-39', 'COM-18', 'HP ProOne 600 G2 Base Model', 'COMPUTER EQUIPMENT', 'SGH629PZJ2\r\n', 'ตึก 26 TC205', 'uploads/Img_2026-39.png', 'qrcodes/QR_2026-39.png', '2026-02-16 23:59:04'),
(64, '2026-40', 'COM-19', 'HP ProOne 600 G2 Base Model', 'COMPUTER EQUIPMENT', 'SGH633SK9V', 'ตึก 26 TC205', 'uploads/Img_2026-40.png', 'qrcodes/QR_2026-40.png', '2026-02-17 00:04:50'),
(65, '2026-41', 'COM-20', 'HP ProOne 600 G2 Base Model', 'COMPUTER EQUIPMENT', 'SGH629PZ8N', 'ตึก 26 TC205', 'uploads/Img_2026-41.png', 'qrcodes/QR_2026-41.png', '2026-02-17 00:05:37');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `tracking_id` varchar(50) NOT NULL COMMENT 'ใช้สำหรับสร้าง QR Code เพื่อติดตามสถานะ',
  `status` varchar(50) NOT NULL DEFAULT 'Pending' COMMENT 'สถานะงาน (รอรับเรื่อง, \r\nกำลังซ่อม, เสร็จสิ้น)',
  `reported_by` varchar(100) NOT NULL COMMENT 'ชื่อผู้แจ้ง',
  `reporter_id` varchar(50) DEFAULT NULL,
  `asset_id` varchar(50) DEFAULT NULL COMMENT 'รหัสพนักงาน/นักศึกษา',
  `tel` varchar(20) NOT NULL COMMENT 'เบอร์โทรศัพท์',
  `reporter_email` varchar(100) DEFAULT NULL COMMENT 'อีเมล',
  `device_type` varchar(50) NOT NULL COMMENT 'ประเภทอุปกรณ์',
  `device_model` varchar(100) DEFAULT NULL,
  `serial_no` varchar(100) DEFAULT NULL,
  `device_name` varchar(100) DEFAULT NULL,
  `building` varchar(50) NOT NULL COMMENT 'ตึก',
  `room` varchar(50) DEFAULT NULL COMMENT 'ห้อง',
  `problem_description` text NOT NULL COMMENT 'รายละเอียดปัญหา',
  `img_path` varchar(255) DEFAULT NULL COMMENT 'พาธไฟล์รูปภาพ',
  `created_at` datetime DEFAULT current_timestamp() COMMENT 'เวลาที่แจ้ง',
  `updated_at` datetime DEFAULT NULL,
  `repair_started_at` datetime DEFAULT NULL,
  `completed_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `tracking_id`, `status`, `reported_by`, `reporter_id`, `asset_id`, `tel`, `reporter_email`, `device_type`, `device_model`, `serial_no`, `device_name`, `building`, `room`, `problem_description`, `img_path`, `created_at`, `updated_at`, `repair_started_at`, `completed_at`) VALUES
(14, 'REP-20251212-693', 'รอรับเรื่อง', 'นาธาน บุญสุภาพ', NULL, '009', '0991039926', '6708@lbtech.ac.th', 'Computer', NULL, NULL, NULL, 'ตึก 14', '1421', 'เสียมาก', 'uploads/REP-20251212-693.png', '2025-12-12 15:13:43', NULL, NULL, NULL),
(15, 'REP-20251212-427', 'กำลังซ่อม', 'นภดล สอนเจตน์', NULL, '67319090008', '0962863480', '67319090006@lbtech.ac.th', 'Other', NULL, NULL, NULL, 'Other', 'ห้อง IOT', 'หดหกหกดหกด', 'uploads/REP-20251212-427.png', '2025-12-12 15:22:03', NULL, NULL, NULL),
(16, 'REP-20251216-914', 'กำลังซ่อม', 'นภดล สอนเจตน์', NULL, '67319090008', '0962863480', '67319090006@lbtech.ac.th', 'Computer', NULL, NULL, NULL, 'ตึก 26', 'TC203', 'bluescreen', 'uploads/REP-20251216-914.png', '2025-12-16 10:03:45', '2026-01-01 14:31:22', '2026-01-01 14:31:22', '2026-01-01 14:25:48'),
(17, 'REP-20251216-973', 'กำลังซ่อม', 'TNK', NULL, 'TC10', '0822322992', 'waivers_potter.0i@lbtech.ac.th', 'AccessPoint', NULL, NULL, NULL, 'ตึก 14', '1425', 'No connection', 'uploads/REP-20251216-973.jpg', '2025-12-16 11:11:19', '2026-01-04 10:29:10', '2026-01-04 10:29:10', '2026-01-03 03:55:52'),
(18, 'REP-20260118-692', 'กำลังซ่อม', 'นาธาน บุญสุภาพ', NULL, '67319090009', '0991039926', '67319090009@lbtech.ac.th', 'Computer', NULL, NULL, NULL, 'ตึก 26', 'TC201', 'ทำน้ำหก, มดขึ้นจอ, ส่งเสียงดัง ติ๊ด ๆ 3 ครั้งติดต่อกัน', 'uploads/REP-20260118-692.JPG', '2026-01-18 20:42:11', '2026-02-09 12:42:57', '2026-02-09 12:42:57', '2026-01-18 21:27:53'),
(19, 'REP-20260118-340', 'รอรับเรื่อง', 'นาธาน บุญสุภาพ', NULL, '67319090009', '0991039926', '67319090009@lbtech.ac.th', 'Computer', NULL, NULL, NULL, 'ตึก 14', '1425', 'ปัญหาในอนาคต', 'uploads/REP-20260118-340.jpg', '2026-01-18 21:07:41', NULL, NULL, NULL),
(20, 'REP-20260118-136', 'กำลังซ่อม', 'นภดล สอนเจตน์', NULL, '67319090008', '0962863480', '67319090008@lbtech.ac.th', 'Computer', NULL, NULL, NULL, 'ตึก 26', 'TC203', 'ฟหกวสดืกานห่สดิ้หก่า้ิยรานสฟ้ืดาฟกวหดื', 'uploads/REP-20260118-136.jpg', '2026-01-18 21:20:58', '2026-01-18 21:29:58', '2026-01-18 21:29:58', NULL),
(21, 'REP-20260118-993', 'รอรับเรื่อง', 'นาธาน บุญสุภาพ', NULL, '67319090009', '0991039926', '67319090009@lbtech.ac.th', 'Computer', NULL, NULL, NULL, 'ตึก 14', '1415', 'หน้าจอเปิดไม่ติด', 'uploads/REP-20260118-993.png', '2026-01-18 21:38:40', NULL, NULL, NULL),
(22, 'REP-20260119-655', 'เสร็จสิ้น', 'นภดล สอนเจตน์', '6731909008', '22005-02', '0962863480', '67319090008@lbtech.ac.th', 'AccessPoint', ' UBIQUITI UniFi (U7-Lite) Wireless BE5000', 'PF16DC85', 'COM-02', 'ตึก 26', 'TC203', 'เชื่อมต่อไม่ได้', 'uploads/REP-20260119-655.jpg', '2026-01-20 02:11:59', '2026-01-26 22:09:07', NULL, '2026-01-26 22:09:07'),
(23, 'REP-20260126-881', 'เสร็จสิ้น', 'นาธาน บุญสุภาพ', '67319090009', '', '0991039926', '67319090009@lbtech.ac.th', 'Computer', '', '', '', 'ตึก 14', '1415', 'คอมเปิดไม่ติด', 'uploads/REP-20260126-881.jpg', '2026-01-26 21:55:36', '2026-02-09 12:43:11', NULL, '2026-02-09 12:43:11'),
(24, 'REP-20260211-611', 'รอรับเรื่อง', 'นาธาน บุญสุภาพ', '67319090009', '', '0991039926', '67319090009@lbtech.ac.th', 'Computer', '', '', '', 'ตึก 14', '1425', 'จอเสีย, มดขึ้น, น้ำเข้า, น้ำส้มหก, โค้กระเบิดใส่, ไฟฟ้าลัดวงจร, จอกรอบ, จอมีเส้น สีขาว สีเหลือง สีแดง สีเขียว แล้วขึ้นจอดำ, การ์ดจอหาย, แรมหาย', 'uploads/REP-20260211-611.jpg', '2026-02-11 14:28:58', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
