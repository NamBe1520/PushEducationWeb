-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th12 30, 2024 lúc 03:47 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `cnpm`
--
CREATE DATABASE IF NOT EXISTS `cnpm` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `cnpm`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ab`
--

CREATE TABLE `ab` (
  `idab` int(255) NOT NULL,
  `nameab` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `ab`
--

INSERT INTO `ab` (`idab`, `nameab`) VALUES
(1, 'rf');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `class`
--

CREATE TABLE `class` (
  `classId` varchar(255) NOT NULL,
  `classname` varchar(255) DEFAULT NULL,
  `schedule` varchar(255) DEFAULT NULL,
  `startDate` datetime DEFAULT NULL,
  `semester` year(4) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `classFee` decimal(13,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `class`
--

INSERT INTO `class` (`classId`, `classname`, `schedule`, `startDate`, `semester`, `duration`, `classFee`) VALUES
('c001', 'English-L12', 'Mon-Wed-Fri 6:00-7:30', '2023-09-01 00:00:00', '2023', 'a month', 500000.00),
('c002', 'English-L9', 'Mon-Wed-Fri 7:30-9:00', '2023-09-01 00:00:00', '2023', 'a month', 500000.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `classShift`
--

CREATE TABLE `classShift` (
  `shiftId` varchar(255) NOT NULL,
  `teacherAssistant` varchar(255) DEFAULT NULL,
  `teacherId` varchar(255) DEFAULT NULL,
  `classId` varchar(255) DEFAULT NULL,
  `startTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `classShift`
--

INSERT INTO `classShift` (`shiftId`, `teacherAssistant`, `teacherId`, `classId`, `startTime`) VALUES
('sh001', NULL, 't001', 'c001', '2023-09-01 18:00:00'),
('sh002', 't003', 't002', 'c002', '2023-09-01 19:30:00'),
('sh003', NULL, 't001', 'c001', '2023-09-04 18:00:00'),
('sh004', 't003', 't002', 'c002', '2023-09-04 19:30:00'),
('sh005', NULL, 't001', 'c001', '2023-09-06 18:00:00'),
('sh006', 't003', 't002', 'c002', '2023-09-06 19:30:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payment`
--

CREATE TABLE `payment` (
  `transaction` varchar(255) NOT NULL,
  `receiptId` varchar(255) DEFAULT NULL,
  `paymentType` varchar(255) DEFAULT NULL,
  `paymentContent` varchar(255) DEFAULT NULL,
  `paymentDate` datetime DEFAULT NULL,
  `amount` decimal(13,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `payment`
--

INSERT INTO `payment` (`transaction`, `receiptId`, `paymentType`, `paymentContent`, `paymentDate`, `amount`) VALUES
('trx001', 'sc001', 'Banking', 'Nguyễn Thu Thủy chuyển khoản', '2023-09-02 00:00:00', 500000.00),
('trx002', 'sc002', 'Banking', 'Đỗ Minh Trí chuyển khoản', '2023-09-02 00:00:00', 500000.00),
('trx003', 'sc003', 'Banking', 'Lê Minh Quân chuyển khoản', '2023-09-02 00:00:00', 500000.00),
('trx004', 'sc004', 'Banking', 'Trình Khánh Băng chuyển khoản', '2023-09-03 00:00:00', 500000.00),
('trx005', 'sc005', 'Banking', 'Ngô Đức Anh chuyển khoản', '2023-09-04 00:00:00', 500000.00),
('trx006', 'sc006', 'Cash', 'tiền mặt', '2023-09-05 00:00:00', 500000.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `referralDetails`
--

CREATE TABLE `referralDetails` (
  `referralId` varchar(255) NOT NULL,
  `discountCode` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `referralDetails`
--

INSERT INTO `referralDetails` (`referralId`, `discountCode`) VALUES
('r002', '1DISC20'),
('r003', '2DISC20'),
('r004', '3DISC20'),
('r005', '4DISC20'),
('r001', 'DISC10');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `role`
--

CREATE TABLE `role` (
  `roleId` varchar(255) NOT NULL,
  `roleName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `role`
--

INSERT INTO `role` (`roleId`, `roleName`) VALUES
('1', 'Admin'),
('2', 'Teacher'),
('3', 'Student');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `studentClass`
--

CREATE TABLE `studentClass` (
  `id` varchar(255) NOT NULL,
  `classId` varchar(255) DEFAULT NULL,
  `studentId` varchar(255) DEFAULT NULL,
  `dateJoin` datetime DEFAULT NULL,
  `paymentId` varchar(255) DEFAULT NULL,
  `isPaid` binary(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `studentClass`
--

INSERT INTO `studentClass` (`id`, `classId`, `studentId`, `dateJoin`, `paymentId`, `isPaid`) VALUES
('sc001', 'c001', 's001', '2023-09-01 00:00:00', 'trx001', 0x31),
('sc002', 'c001', 's002', '2023-09-01 00:00:00', 'trx002', 0x31),
('sc003', 'c001', 's003', '2023-09-01 00:00:00', 'trx003', 0x31),
('sc004', 'c001', 's004', '2023-09-01 00:00:00', 'trx004', 0x31),
('sc005', 'c001', 's005', '2023-09-01 00:00:00', 'trx005', 0x31),
('sc006', 'c001', 's006', '2023-09-01 00:00:00', 'trx006', 0x31),
('sc007', 'c001', 's007', '2023-09-01 00:00:00', NULL, 0x30),
('sc008', 'c002', 's008', '2023-09-01 00:00:00', NULL, 0x31),
('sc009', 'c002', 's009', '2023-09-01 00:00:00', NULL, 0x32),
('sc010', 'c002', 's010', '2023-09-01 00:00:00', NULL, 0x33);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `studentDecision`
--

CREATE TABLE `studentDecision` (
  `id` varchar(255) NOT NULL,
  `studentId` varchar(255) DEFAULT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `dateOfIssue` datetime DEFAULT NULL,
  `newState` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `studentDecision`
--

INSERT INTO `studentDecision` (`id`, `studentId`, `reason`, `dateOfIssue`, `newState`) VALUES
('sd001', 's001', 'Joined', '2023-09-01 00:00:00', 1),
('sd002', 's002', 'Joined', '2023-09-01 00:00:00', 1),
('sd003', 's003', 'Joined', '2023-09-01 00:00:00', 1),
('sd004', 's004', 'Joined', '2023-09-01 00:00:00', 1),
('sd005', 's005', 'Joined', '2023-09-01 00:00:00', 1),
('sd006', 's006', 'Joined', '2023-09-01 00:00:00', 1),
('sd007', 's007', 'Joined', '2023-09-01 00:00:00', 1),
('sd008', 's008', 'Joined', '2023-09-01 00:00:00', 1),
('sd009', 's009', 'Joined', '2023-09-01 00:00:00', 1),
('sd010', 's010', 'Joined', '2023-09-01 00:00:00', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `studentDetails`
--

CREATE TABLE `studentDetails` (
  `userId` varchar(255) DEFAULT NULL,
  `studentId` varchar(255) NOT NULL,
  `guardianPhone` varchar(255) DEFAULT NULL,
  `referralId` varchar(255) DEFAULT NULL,
  `namestudent` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `studentDetails`
--

INSERT INTO `studentDetails` (`userId`, `studentId`, `guardianPhone`, `referralId`, `namestudent`) VALUES
('u005', 's001', '2233445566', 'r001', 'NVA'),
('u006', 's002', '18282232', NULL, 'DCV'),
('u007', 's003', '0182827392', NULL, 'GHJ'),
('u008', 's004', '01828282', 'r004', 'EDD'),
('u009', 's005', '06747574343', 'r005', 'GDS'),
('u010', 's006', '0448737583', 'r002', 'HGH'),
('u011', 's007', '0387463755', 'r003', 'BGR'),
('u012', 's008', '0737483535', NULL, 'FER'),
('u013', 's009', '0837573843', 'r004', 'VGH'),
('u014', 's010', '0834737435', 'r005', 'HYT');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `studentReport`
--

CREATE TABLE `studentReport` (
  `reportId` varchar(255) DEFAULT NULL,
  `studentId` varchar(255) DEFAULT NULL,
  `attendanceStatus` varchar(255) DEFAULT NULL,
  `assessment` varchar(255) DEFAULT NULL,
  `points` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `studentReport`
--

INSERT INTO `studentReport` (`reportId`, `studentId`, `attendanceStatus`, `assessment`, `points`) VALUES
('sh001', 's001', 'comat', 'tiếp thu nhanh', NULL),
('sh001', 's002', 'comat', 'tiếp thu nhanh', NULL),
('sh001', 's003', 'comat', 'tiếp thu nhanh', NULL),
('sh001', 's004', 'muon', 'chưa hiểu bài', NULL),
('sh001', 's005', 'comat', 'chưa hiểu bài', NULL),
('sh001', 's006', 'comat', 'tiếp thu nhanh', NULL),
('sh001', 's007', 'comat', 'tiếp thu nhanh', NULL),
('sh002', 's008', 'comat', 'tiếp thu nhanh', NULL),
('sh002', 's009', 'comat', 'tiếp thu nhanh', NULL),
('sh002', 's010', 'comat', 'tiếp thu nhanh', NULL),
('sh003', 's001', 'comat', 'chưa làm BTVN', '6'),
('sh003', 's002', 'comat', 'chưa làm BTVN', '6'),
('sh003', 's003', 'comat', 'mất tập trung trong giờ', '7'),
('sh003', 's004', 'comat', 'chưa hiểu bài', '6'),
('sh003', 's005', 'comat', NULL, '7'),
('sh003', 's006', 'comat', NULL, '7'),
('sh003', 's007', 'comat', 'hoàn thành đủ BTVN', '8'),
('sh004', 's008', 'comat', 'hoàn thành đủ BTVN', '8'),
('sh004', 's009', 'comat', 'hoàn thành đủ BTVN', '6'),
('sh004', 's010', 'comat', 'hoàn thành đủ BTVN', '6'),
('sh005', 's001', 'comat', 'hoàn thành đủ BTVN', NULL),
('sh005', 's002', 'comat', 'hoàn thành đủ BTVN', NULL),
('sh005', 's003', 'comat', 'hoàn thành đủ BTVN', NULL),
('sh005', 's004', 'comat', 'Thiếu BTVN', NULL),
('sh005', 's005', 'comat', 'Thiếu BTVN', NULL),
('sh005', 's006', 'vang', NULL, NULL),
('sh005', 's007', 'comat', 'Thiếu BTVN', NULL),
('sh006', 's008', 'comat', 'hoàn thành đủ BTVN', NULL),
('sh006', 's009', 'comat', 'hoàn thành đủ BTVN', NULL),
('sh006', 's010', 'comat', 'hoàn thành đủ BTVN', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `teacherDetails`
--

CREATE TABLE `teacherDetails` (
  `userId` varchar(255) DEFAULT NULL,
  `teacherId` varchar(255) NOT NULL,
  `dateJoin` datetime DEFAULT NULL,
  `isActive` binary(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `teacherDetails`
--

INSERT INTO `teacherDetails` (`userId`, `teacherId`, `dateJoin`, `isActive`) VALUES
('u002', 't001', '2023-08-01 00:00:00', 0x31),
('u003', 't002', '2022-08-10 00:00:00', 0x31),
('u004', 't003', '2024-07-01 00:00:00', 0x31);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `userId` varchar(255) NOT NULL,
  `userName` varchar(255) DEFAULT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `roleId` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`userId`, `userName`, `firstName`, `lastname`, `email`, `password`, `phone`, `roleId`) VALUES
('u001', 'adminUser', 'Alice', 'Admin', 'admin@example.com', 'password_hash_1', '0599674584', '1'),
('u002', 'teacherUser1', 'Phong', 'Nguyễn Minh', 'email1@example.com', 'password_hash_2', '032903322', '2'),
('u003', 'teacherUser2', 'Vũ', 'Nguyễn Long', 'email2@example.com', 'password_hash_3', '0999933271', '2'),
('u004', 'teacherUser3', 'Bảo', 'Lê Vy', 'email3@example.com', 'password_hash_4', '0196202213', '2'),
('u005', 'studentUser1', 'Thủy', 'Nguyễn Thu', 'studentUser1@example.com', 'password_hash_5', '0994852162', '3'),
('u006', 'studentUser2', 'Trí', 'Đỗ Minh', 'studentUser2@example.com', 'password_hash_6', '0871276347', '3'),
('u007', 'studentUser3', 'Quân', 'Lê Minh', 'studentUser3@example.com', 'password_hash_7', '0680757763', '3'),
('u008', 'studentUser4', 'Băng', 'Trình Khánh', 'studentUser4@example.com', 'password_hash_8', '0874995783', '3'),
('u009', 'studentUser5', 'Đức Anh', 'Ngô', 'studentUser5@example.com', 'password_hash_9', '0304020168', '3'),
('u010', 'studentUser6', 'Vy', 'Nguyễn Bảo', 'studentUser6@example.com', 'password_hash_10', '0719228654', '3'),
('u011', 'studentUser7', 'Hải', 'Ngô Đăng', 'studentUser7@example.com', 'password_hash_11', '0939034435', '3'),
('u012', 'studentUser8', 'Đạt', 'Phạm Khánh', 'studentUser8@example.com', 'password_hash_12', '0516076808', '3'),
('u013', 'studentUser9', 'Ngọc', 'Cao Hồng', 'studentUser9@example.com', 'password_hash_13', '0301517169', '3'),
('u014', 'studentUser10', 'Hòa', 'Đặng Hương', 'studentUser10@example.com', 'password_hash_14', '0752902959', '3');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `ab`
--
ALTER TABLE `ab`
  ADD PRIMARY KEY (`idab`);

--
-- Chỉ mục cho bảng `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`classId`);

--
-- Chỉ mục cho bảng `classShift`
--
ALTER TABLE `classShift`
  ADD PRIMARY KEY (`shiftId`),
  ADD KEY `classId` (`classId`),
  ADD KEY `teacherId` (`teacherId`),
  ADD KEY `teacherAssistant` (`teacherAssistant`);

--
-- Chỉ mục cho bảng `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`transaction`),
  ADD KEY `receiptId` (`receiptId`);

--
-- Chỉ mục cho bảng `referralDetails`
--
ALTER TABLE `referralDetails`
  ADD PRIMARY KEY (`referralId`),
  ADD UNIQUE KEY `discountCode` (`discountCode`);

--
-- Chỉ mục cho bảng `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`roleId`);

--
-- Chỉ mục cho bảng `studentClass`
--
ALTER TABLE `studentClass`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `paymentId` (`paymentId`),
  ADD KEY `studentId` (`studentId`),
  ADD KEY `classId` (`classId`);

--
-- Chỉ mục cho bảng `studentDecision`
--
ALTER TABLE `studentDecision`
  ADD PRIMARY KEY (`id`),
  ADD KEY `studentId` (`studentId`);

--
-- Chỉ mục cho bảng `studentDetails`
--
ALTER TABLE `studentDetails`
  ADD PRIMARY KEY (`studentId`);

--
-- Chỉ mục cho bảng `studentReport`
--
ALTER TABLE `studentReport`
  ADD KEY `reportId` (`reportId`);

--
-- Chỉ mục cho bảng `teacherDetails`
--
ALTER TABLE `teacherDetails`
  ADD PRIMARY KEY (`teacherId`),
  ADD KEY `userId` (`userId`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `userName` (`userName`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `roleId` (`roleId`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `ab`
--
ALTER TABLE `ab`
  MODIFY `idab` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `classShift`
--
ALTER TABLE `classShift`
  ADD CONSTRAINT `classshift_ibfk_1` FOREIGN KEY (`classId`) REFERENCES `class` (`classId`),
  ADD CONSTRAINT `classshift_ibfk_2` FOREIGN KEY (`teacherId`) REFERENCES `teacherDetails` (`teacherId`),
  ADD CONSTRAINT `classshift_ibfk_3` FOREIGN KEY (`teacherAssistant`) REFERENCES `teacherDetails` (`teacherId`);

--
-- Các ràng buộc cho bảng `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`receiptId`) REFERENCES `studentClass` (`id`);

--
-- Các ràng buộc cho bảng `studentClass`
--
ALTER TABLE `studentClass`
  ADD CONSTRAINT `studentclass_ibfk_1` FOREIGN KEY (`studentId`) REFERENCES `studentDetails` (`studentId`),
  ADD CONSTRAINT `studentclass_ibfk_2` FOREIGN KEY (`classId`) REFERENCES `class` (`classId`);

--
-- Các ràng buộc cho bảng `studentDecision`
--
ALTER TABLE `studentDecision`
  ADD CONSTRAINT `studentdecision_ibfk_1` FOREIGN KEY (`studentId`) REFERENCES `studentDetails` (`studentId`);

--
-- Các ràng buộc cho bảng `studentDetails`
--
ALTER TABLE `studentDetails`
  ADD CONSTRAINT `studentdetails_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`),
  ADD CONSTRAINT `studentdetails_ibfk_2` FOREIGN KEY (`referralId`) REFERENCES `referralDetails` (`referralId`);

--
-- Các ràng buộc cho bảng `studentReport`
--
ALTER TABLE `studentReport`
  ADD CONSTRAINT `studentreport_ibfk_1` FOREIGN KEY (`reportId`) REFERENCES `classShift` (`shiftId`);

--
-- Các ràng buộc cho bảng `teacherDetails`
--
ALTER TABLE `teacherDetails`
  ADD CONSTRAINT `teacherdetails_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`);

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`roleId`) REFERENCES `role` (`roleId`);
--
-- Cơ sở dữ liệu: `cnpm1`
--
CREATE DATABASE IF NOT EXISTS `cnpm1` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `cnpm1`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `class`
--

CREATE TABLE `class` (
  `idclass` int(255) NOT NULL,
  `nameClass` varchar(255) NOT NULL,
  `schedule` varchar(255) NOT NULL,
  `startDate` date NOT NULL,
  `duration` varchar(255) NOT NULL,
  `classFee` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `class`
--

INSERT INTO `class` (`idclass`, `nameClass`, `schedule`, `startDate`, `duration`, `classFee`) VALUES
(17, 'Hệ Thống Thông Tin', 'full tuần', '2024-09-11', '9', 2300000),
(45, 'Công nghệ phần mềm', 'thứ 7', '2024-09-03', '68', 3600000),
(686, 'Kĩ năng sống', 'thứ 4 full ngày', '2024-09-11', '9', 1300000),
(555789, 'Công Nghệ Phần mềm', '5', '2024-09-11', '9', 100);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `classShift`
--

CREATE TABLE `classShift` (
  `idShift` int(255) NOT NULL,
  `idTeacher` int(255) NOT NULL,
  `idClass` int(255) NOT NULL,
  `startTime` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payment`
--

CREATE TABLE `payment` (
  `idclass` int(11) NOT NULL,
  `idStudent` int(11) NOT NULL,
  `paymentId` varchar(255) NOT NULL,
  `isPaid` tinyint(1) NOT NULL DEFAULT 0,
  `notePayment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `payment`
--

INSERT INTO `payment` (`idclass`, `idStudent`, `paymentId`, `isPaid`, `notePayment`) VALUES
(17, 44644, 't56', 1, 'đã thanh toán đúng hạn'),
(17, 678, 't65', 1, 'Đã thanh toán'),
(17, 44254, 't4t44', 1, 'chưa thanh toán'),
(555789, 78989, 't445', 1, 'đã thanh toán');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `rollcall`
--

CREATE TABLE `rollcall` (
  `idRollCall` int(255) NOT NULL,
  `idStudent` int(255) NOT NULL,
  `idclass` int(255) NOT NULL,
  `dateRollCall` date NOT NULL,
  `note` varchar(2555) NOT NULL,
  `statusRollCall` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `rollcall`
--

INSERT INTO `rollcall` (`idRollCall`, `idStudent`, `idclass`, `dateRollCall`, `note`, `statusRollCall`) VALUES
(1, 44644, 17, '2024-09-11', 'đi học đầy đủ 10 điểm', 1),
(2, 678, 17, '2024-09-11', 'đi học chăm', 1),
(3, 78989, 555789, '2024-09-13', 'Đi học muộn', 0),
(4, 44254, 17, '2024-09-19', 'đi đầy đủ', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `student`
--

CREATE TABLE `student` (
  `idStudent` int(255) NOT NULL,
  `idUser` varchar(255) NOT NULL,
  `passwordUser` varchar(25) NOT NULL,
  `nameStudent` varchar(255) NOT NULL,
  `guardianPhone` varchar(255) NOT NULL,
  `referralId` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `student`
--

INSERT INTO `student` (`idStudent`, `idUser`, `passwordUser`, `nameStudent`, `guardianPhone`, `referralId`) VALUES
(101, '0101', '1', 'Lần này o bug', '12321', '123213'),
(44254, '44254', '1', 'Huy', '2434214', '324'),
(44644, '44644', '1', 'Đình Nam', '08798', '553'),
(78989, '78989', '1', 'Trần Đình B', '435355', '23532');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `studentClass`
--

CREATE TABLE `studentClass` (
  `idStudenClass` int(255) NOT NULL,
  `idclass` int(255) NOT NULL,
  `idStudent` int(255) NOT NULL,
  `dateJoin` date NOT NULL,
  `paymentId` varchar(255) NOT NULL,
  `isPaid` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `studentClass`
--

INSERT INTO `studentClass` (`idStudenClass`, `idclass`, `idStudent`, `dateJoin`, `paymentId`, `isPaid`) VALUES
(3, 17, 44254, '2024-09-12', 't4t44', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `teacher`
--

CREATE TABLE `teacher` (
  `idTeacher` int(255) NOT NULL,
  `idUser` varchar(255) NOT NULL,
  `passwordUser` varchar(25) NOT NULL,
  `nameTeacher` varchar(255) NOT NULL,
  `dateJoin` date NOT NULL,
  `sdtTeacher` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `teacher`
--

INSERT INTO `teacher` (`idTeacher`, `idUser`, `passwordUser`, `nameTeacher`, `dateJoin`, `sdtTeacher`) VALUES
(1, '1', '1', '1', '2024-09-11', 124),
(456, '456', '1', 'Khánh Vân', '2024-09-11', 1245),
(999, 'PhamNhatVuong', '1', 'PhamNhatVuong', '2024-09-10', 976454),
(3456, 'NguyenVanA', '1', 'Ngyễn Văn A', '2024-09-11', 98763),
(8777, '66666', '11', 'Nguyễn Văn C', '2024-09-12', 65324),
(44644, '44644', '1', 'Nguyễn Đình Nam', '2024-09-11', 6789),
(55566777, '55566777', '1', 'Hoàng Ngọc Tùng', '2024-09-04', 215421);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `idUser` varchar(255) NOT NULL,
  `passwordUser` varchar(255) NOT NULL,
  `role` enum('admin','user','teacher') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`idUser`, `passwordUser`, `role`) VALUES
('44644', '$2y$10$b0jxqp3Inx4hutNFhp0XI.n9U1EV9x5TjVxn2Dy3WU.Sxm7MNRtBe', 'admin'),
('123', '$2y$10$oIqJrrF8ckbHk.9/I8HTY.jPC00m7vBdsQ3Bv6hGqTxQzWNWjsa4a', 'admin'),
('8777', '$2y$10$FegzMeoqXl.P5LACToz5ruPAMku1mGCF/4zC80EB1tnCY7cPT03VK', 'teacher'),
('78989', '$2y$10$4spGJFgfm9WmXayTUSdwc.rwZgxC/us7BoOQ.p.5Z8QiMXH0J24eu', 'user');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`idclass`);

--
-- Chỉ mục cho bảng `classShift`
--
ALTER TABLE `classShift`
  ADD PRIMARY KEY (`idShift`);

--
-- Chỉ mục cho bảng `rollcall`
--
ALTER TABLE `rollcall`
  ADD PRIMARY KEY (`idRollCall`);

--
-- Chỉ mục cho bảng `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`idStudent`);

--
-- Chỉ mục cho bảng `studentClass`
--
ALTER TABLE `studentClass`
  ADD PRIMARY KEY (`idStudenClass`);

--
-- Chỉ mục cho bảng `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`idTeacher`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `class`
--
ALTER TABLE `class`
  MODIFY `idclass` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=555790;

--
-- AUTO_INCREMENT cho bảng `classShift`
--
ALTER TABLE `classShift`
  MODIFY `idShift` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `rollcall`
--
ALTER TABLE `rollcall`
  MODIFY `idRollCall` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `student`
--
ALTER TABLE `student`
  MODIFY `idStudent` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=987654322;

--
-- AUTO_INCREMENT cho bảng `studentClass`
--
ALTER TABLE `studentClass`
  MODIFY `idStudenClass` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `teacher`
--
ALTER TABLE `teacher`
  MODIFY `idTeacher` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55566778;
--
-- Cơ sở dữ liệu: `demoCNPM`
--
CREATE DATABASE IF NOT EXISTS `demoCNPM` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `demoCNPM`;
--
-- Cơ sở dữ liệu: `hh3a`
--
CREATE DATABASE IF NOT EXISTS `hh3a` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `hh3a`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `idgv` int(11) NOT NULL,
  `namegv` varchar(155) NOT NULL,
  `sdtgv` int(15) NOT NULL,
  `idclass` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`idgv`, `namegv`, `sdtgv`, `idclass`) VALUES
(20, 'NAM', 123456, 1),
(37, 'Huy', 1234, 2),
(38, 'Dũng', 4567, 15),
(70, 'Cô giáo Khánh Vân', 985527695, 16),
(71, 'Đàm Hùng', 234324234, 19),
(72, 'Vanh', 1111, 2),
(73, 'Phong', 23123, 1),
(75, 'Nam', 123456, 21),
(92, 'dd', 4566, 15),
(93, 'dd', 4566, 15),
(94, 'dd', 4566, 15),
(95, 'dd', 4566, 15),
(96, 'dd', 4566, 15),
(97, 'dd', 4566, 15),
(98, 'dd', 4566, 15);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `class`
--

CREATE TABLE `class` (
  `idclass` int(255) NOT NULL,
  `nameclass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `class`
--

INSERT INTO `class` (`idclass`, `nameclass`) VALUES
(1, 'lớp nâng cao 70tr vnd'),
(2, 'Tiếng anh trung cấp 3'),
(15, 'Học tiêu tiền cùng Tuấn'),
(17, 'lớp 2'),
(19, 'Lớp tiếng anh 650+'),
(20, 'Lớp học đàn cùng VANH'),
(21, 'ass'),
(22, 'cnpm');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `diemdanh`
--

CREATE TABLE `diemdanh` (
  `idstudent` int(255) DEFAULT NULL,
  `ngaydiemdanh` date DEFAULT NULL,
  `note` varchar(500) DEFAULT NULL,
  `idclass` varchar(255) NOT NULL,
  `trangthai` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `diemdanh`
--

INSERT INTO `diemdanh` (`idstudent`, `ngaydiemdanh`, `note`, `idclass`, `trangthai`) VALUES
(1, '2024-09-03', 'đi đâyg đủ', '6', 1),
(2, '2024-09-03', 'ok', '7', 1),
(6, '2024-09-03', '0', '3', 0),
(10, '2024-09-03', 'kkkk', '1', 0),
(1, '2024-09-03', '0', '5', 0),
(1, '2024-09-04', 'a', '10', 1),
(2, '2024-09-04', 'v', '10', 1),
(3, '2024-09-04', 'f', '10', 0),
(4, '2024-09-04', 'đá', '10', 0),
(5, '2024-09-04', 'fgasdf', '10', 1),
(6, '2024-09-04', 'sầ', '10', 1),
(7, '2024-09-04', '', '10', 1),
(8, '2024-09-04', 'rw5g', '10', 1),
(9, '2024-09-04', 'sấ', '10', 0),
(10, '2024-09-04', 'h', '10', 1),
(1, '2024-09-04', 'làm bài tốt', '9', 0),
(2, '2024-09-04', 'ok', '9', 0),
(3, '2024-09-04', 'nghỉ giữa chừng', '9', 0),
(4, '2024-09-04', 'còn lười', '9', 0),
(5, '2024-09-04', 'chăm', '9', 0),
(6, '2024-09-04', 'ok', '9', 0),
(7, '2024-09-04', 'ok', '9', 0),
(8, '2024-09-04', 'ok', '9', 0),
(9, '2024-09-04', 'ok', '9', 0),
(10, '2024-09-04', 'ok', '9', 0),
(1, '0224-09-09', 'ok', '2', 0),
(2, '0224-09-09', 'ok', '2', 0),
(3, '0224-09-09', 'ok', '2', 0),
(4, '0224-09-09', 'ok', '2', 0),
(5, '0224-09-09', 'ok', '2', 0),
(6, '0224-09-09', 'ok', '2', 0),
(7, '0224-09-09', 'ok', '2', 0),
(8, '0224-09-09', 'ok', '2', 0),
(9, '0224-09-09', 'ok', '2', 0),
(10, '0224-09-09', 'ok', '2', 0),
(5, '2024-09-04', '', '1', 0),
(6, '2024-09-04', '', '1', 0),
(7, '2024-09-04', '', '1', 1),
(8, '2024-09-04', '', '1', 1),
(9, '2024-09-04', '', '1', 1),
(10, '2024-09-04', '', '1', 1),
(5, '2024-09-05', '1', '1', 0),
(6, '2024-09-05', '2323', '1', 0),
(7, '2024-09-05', '21fdf', '1', 0),
(8, '2024-09-05', 'dff', '1', 0),
(9, '2024-09-05', 'ádfsad', '1', 0),
(10, '2024-09-05', 'ádasd', '1', 0),
(5, '2025-09-05', '', '1', 1),
(6, '2025-09-05', '', '1', 1),
(7, '2025-09-05', '', '1', 1),
(8, '2025-09-05', '', '1', 1),
(9, '2025-09-05', '', '1', 1),
(10, '2025-09-05', '', '1', 1),
(1, '2024-09-09', 'ko đi học', '2', 0),
(2, '2024-09-09', 'đi muộn', '2', 0),
(1, '2024-09-09', 'ko đi học', '2', 0),
(2, '2024-09-09', 'đi muộn', '2', 0),
(1, '2025-08-08', 'a', '2', 0),
(2, '2025-08-08', 'b', '2', 0),
(5, '2025-09-09', 'kvvvvvvvvvvvvvvviiiiiiiddddd', '1', 0),
(6, '2025-09-09', 'kvvvvvvvvvvvvvvviiiiiiiddddd', '1', 0),
(7, '2025-09-09', 'kvvvvvvvvvvvvvvviiiiiiiddddd', '1', 0),
(8, '2025-09-09', 'kvvvvvvvvvvvvvvviiiiiiiddddd', '1', 0),
(9, '2025-09-09', 'kvvvvvvvvvvvvvvviiiiiiiddddd', '1', 0),
(10, '2025-09-09', 'kvvvvvvvvvvvvvvviiiiiiiddddd', '1', 0),
(1, '6666-06-06', '2112121212121212121212', '2', 1),
(2, '6666-06-06', '2112121212121212121212', '2', 0),
(1, '2024-09-20', '', '2', 1),
(2, '2024-09-20', '', '2', 1),
(1, '2024-09-14', '', '2', 1),
(2, '2024-09-14', '', '2', 1),
(5, '2024-04-09', 'a', '1', 1),
(6, '2024-04-09', 'a', '1', 1),
(7, '2024-04-09', 'a', '1', 1),
(8, '2024-04-09', 'a', '1', 1),
(9, '2024-04-09', 'a', '1', 1),
(10, '2024-04-09', 'a', '1', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lichday`
--

CREATE TABLE `lichday` (
  `idlichday` int(255) DEFAULT NULL,
  `idteacher` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `idmonhoc` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `idclasst` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `indate` date DEFAULT NULL,
  `outdate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `lichday`
--

INSERT INTO `lichday` (`idlichday`, `idteacher`, `idmonhoc`, `idclasst`, `indate`, `outdate`) VALUES
(1, 'T01', 'M01', 'C01', '2024-09-10', '2024-09-20'),
(2, 'T02', 'M02', 'C02', '2024-09-11', '2024-09-21'),
(3, 'T03', 'M03', 'C03', '2024-09-12', '2024-09-22'),
(4, 'T04', 'M04', 'C04', '2024-09-13', '2024-09-23'),
(5, 'T05', 'M05', 'C05', '2024-09-14', '2024-09-24'),
(6, 'T06', 'M06', 'C06', '2024-09-15', '2024-09-25'),
(7, 'T07', 'M07', 'C07', '2024-09-16', '2024-09-26'),
(8, 'T08', 'M08', 'C08', '2024-09-17', '2024-09-27'),
(9, 'T09', 'M09', 'C09', '2024-09-18', '2024-09-28'),
(10, 'T10', 'M10', 'C10', '2024-09-19', '2024-09-29');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `monhoc`
--

CREATE TABLE `monhoc` (
  `idmonhoc` int(255) NOT NULL,
  `namemonhoc` varchar(255) DEFAULT NULL,
  `tongsobuoi` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `monhoc`
--

INSERT INTO `monhoc` (`idmonhoc`, `namemonhoc`, `tongsobuoi`) VALUES
(1, 'Toán cao cấp', 45),
(2, 'Lập trình Python', 30),
(3, 'Cơ sở dữ liệu', 35),
(4, 'Xác suất thống kê', 40),
(5, 'Trí tuệ nhân tạo', 32),
(6, 'Phân tích dữ liệu', 28),
(7, 'Quản trị mạng', 25),
(8, 'Lập trình Java', 36),
(9, 'Hệ quản trị CSDL', 33),
(10, 'Kỹ thuật phần mềm', 38);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `student`
--

CREATE TABLE `student` (
  `idstudent` int(255) NOT NULL,
  `namestudent` varchar(100) DEFAULT NULL,
  `emailstudent` varchar(100) DEFAULT NULL,
  `sdtstudent` int(11) DEFAULT NULL,
  `idclass` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `student`
--

INSERT INTO `student` (`idstudent`, `namestudent`, `emailstudent`, `sdtstudent`, `idclass`) VALUES
(1, 'Nguyễn Văn A', 'nguyenvana@example.com', 912345678, 2),
(2, 'Trần Thị B', 'tranthib@example.com', 912345679, 2),
(3, 'Lê Văn C', 'levanc@example.com', 912345680, 3),
(4, 'Phạm Thị D', 'phamthid@example.com', 912345681, 3),
(5, 'Hoàng Văn E', 'hoangvane@example.com', 912345682, 1),
(6, 'Đỗ Thị F', 'dothif@example.com', 912345683, 1),
(7, 'Phan Văn G', 'phanvang@example.com', 912345684, 1),
(8, 'Bùi Thị H', 'buithih@example.com', 912345685, 1),
(9, 'Ngô Văn I', 'ngovani@example.com', 912345686, 1),
(10, 'Vũ Thị K', 'vuthik@example.com', 912345687, 1),
(13, 'Nguyen Van TTT', 'nguyenvana@example.com', 123456789, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1, '1', 'r@gmail.com', '$2y$10$zCTws4FOdz4cUl2tc0oRR.fbX5Ef.5ro7vfJZSJZgxkYM.pGpNgwu'),
(2, 'NguyenNam', 'nguyennama4k54@gmail.com', '$2y$10$GXpg.5apsAWo9U3F58ImxOIOXGQy68MOtPf1f/DvYlt9/5AMc9tB.'),
(3, 'Huy', 'huy@gmail.com', '$2y$10$QrHdHAPHuszVA.i087OvD.lM7vKipHPy417vlD6QDaM/K5Sv5h3pe'),
(4, '12', '12@gmail.com', '$2y$10$lkHz.oRhCCcbN0YIq0BPcuG6tOr7NHiB0zni9gSCDmPFQWhMvQc.K'),
(7, 'KhanhVan', 'nhodihocsangthu4@gmail.com', '$2y$10$N.2MKpp4y7Ql7N/bPR5e7.1vZc1tKdHdd4YdDtvJVHbYDJr1pKOnW'),
(8, '56', '5@gmail.com', '$2y$10$QAjil0VyxlpOO231Re.RfufzDOzhuDQJE8BK9w65kdvnC64Bu0W1i'),
(9, 'Vanh', 'Vanh@gmail.com', '$2y$10$3d/wCDXK2SVo.XMNM2J4A.W23hU2TZ7uzmAX.ibTDZxQYYP/4xpe.'),
(10, 'KhanhVan', 'KhanhVan@gmail.com', '$2y$10$zCODGjtCTnSDvI0qX92JT.4HPogMvfnsDLfrWa8Ra2v1uoFk6CXu6'),
(11, 'gsdsds', 'viethwngcontctwork@gmail.com', '$2y$10$J549kB3Ef10ryijb8BDl.OXJrKJQ/qh8bmf31Rkmj0Iv1UpxBvSp6'),
(12, 'aaaaa', 'aaaa@gmail.com', '$2y$10$.oGekkJ42Ve2l7despDkcuC9eqHGby0oKKRDtmxP7r25kNZtDrtOi');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`idgv`);

--
-- Chỉ mục cho bảng `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`idclass`);

--
-- Chỉ mục cho bảng `diemdanh`
--
ALTER TABLE `diemdanh`
  ADD KEY `idstudent` (`idstudent`),
  ADD KEY `diemdanh_ibfk_2` (`idclass`);

--
-- Chỉ mục cho bảng `monhoc`
--
ALTER TABLE `monhoc`
  ADD PRIMARY KEY (`idmonhoc`);

--
-- Chỉ mục cho bảng `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`idstudent`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `idgv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT cho bảng `class`
--
ALTER TABLE `class`
  MODIFY `idclass` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `diemdanh`
--
ALTER TABLE `diemdanh`
  ADD CONSTRAINT `diemdanh_ibfk_1` FOREIGN KEY (`idstudent`) REFERENCES `student` (`idstudent`),
  ADD CONSTRAINT `diemdanh_ibfk_2` FOREIGN KEY (`idclass`) REFERENCES `classt` (`idclasst`);
--
-- Cơ sở dữ liệu: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(11) NOT NULL,
  `dbase` varchar(255) NOT NULL DEFAULT '',
  `user` varchar(255) NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `query` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) NOT NULL,
  `col_name` varchar(64) NOT NULL,
  `col_type` varchar(64) NOT NULL,
  `col_length` text DEFAULT NULL,
  `col_collation` varchar(64) NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) DEFAULT '',
  `col_default` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `column_name` varchar(64) NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `transformation` varchar(255) NOT NULL DEFAULT '',
  `transformation_options` varchar(255) NOT NULL DEFAULT '',
  `input_transformation` varchar(255) NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) NOT NULL,
  `settings_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

--
-- Đang đổ dữ liệu cho bảng `pma__designer_settings`
--

INSERT INTO `pma__designer_settings` (`username`, `settings_data`) VALUES
('root', '{\"angular_direct\":\"direct\",\"relation_lines\":\"true\",\"snap_to_grid\":\"off\"}');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL,
  `export_type` varchar(10) NOT NULL,
  `template_name` varchar(64) NOT NULL,
  `template_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db` varchar(64) NOT NULL DEFAULT '',
  `table` varchar(64) NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp(),
  `sqlquery` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) NOT NULL,
  `item_name` varchar(64) NOT NULL,
  `item_type` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

--
-- Đang đổ dữ liệu cho bảng `pma__navigationhiding`
--

INSERT INTO `pma__navigationhiding` (`username`, `item_name`, `item_type`, `db_name`, `table_name`) VALUES
('root', 'users', 'table', 'thitheovien', ''),
('root', 'userss', 'table', 'thitheovien', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

--
-- Đang đổ dữ liệu cho bảng `pma__pdf_pages`
--

INSERT INTO `pma__pdf_pages` (`db_name`, `page_nr`, `page_descr`) VALUES
('cnpm', 1, 'dbcnpm'),
('cnpm', 2, 'dbcnpm1'),
('cnpm1', 3, 'cnpm'),
('cnpm1', 4, 'cnpm1'),
('cnpm1', 5, 'cnpm11');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Đang đổ dữ liệu cho bảng `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{\"db\":\"cnpm1\",\"table\":\"rollcall\"},{\"db\":\"cnpm1\",\"table\":\"studentClass\"},{\"db\":\"cnpm1\",\"table\":\"user\"},{\"db\":\"cnpm1\",\"table\":\"payment\"},{\"db\":\"cnpm1\",\"table\":\"teacher\"},{\"db\":\"cnpm1\",\"table\":\"class\"},{\"db\":\"cnpm1\",\"table\":\"classShift\"},{\"db\":\"cnpm1\",\"table\":\"student\"},{\"db\":\"cnpm\",\"table\":\"studentClass\"},{\"db\":\"hh3a\",\"table\":\"users\"}]');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) NOT NULL DEFAULT '',
  `master_table` varchar(64) NOT NULL DEFAULT '',
  `master_field` varchar(64) NOT NULL DEFAULT '',
  `foreign_db` varchar(64) NOT NULL DEFAULT '',
  `foreign_table` varchar(64) NOT NULL DEFAULT '',
  `foreign_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `search_name` varchar(64) NOT NULL DEFAULT '',
  `search_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT 0,
  `x` float UNSIGNED NOT NULL DEFAULT 0,
  `y` float UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

--
-- Đang đổ dữ liệu cho bảng `pma__table_coords`
--

INSERT INTO `pma__table_coords` (`db_name`, `table_name`, `pdf_page_number`, `x`, `y`) VALUES
('cnpm', 'class', 2, 1070, 312),
('cnpm', 'classShift', 2, 1015, 125),
('cnpm', 'payment', 2, 961, 575),
('cnpm', 'referralDetails', 2, 726, 225),
('cnpm', 'role', 2, 58, 409),
('cnpm', 'studentClass', 2, 836, 325),
('cnpm', 'studentDecision', 2, 519, 588),
('cnpm', 'studentDetails', 2, 605, 333),
('cnpm', 'studentReport', 2, 766, 33),
('cnpm', 'teacherDetails', 2, 457, 132),
('cnpm', 'users', 2, 370, 293),
('cnpm1', 'class', 3, 143, 145),
('cnpm1', 'class', 5, 683, 280),
('cnpm1', 'classShift', 3, 165, 520),
('cnpm1', 'classShift', 5, 349, 129),
('cnpm1', 'payment', 5, 833, 503),
('cnpm1', 'rollcall', 3, 88, 334),
('cnpm1', 'rollcall', 5, 762, 91),
('cnpm1', 'student', 3, 353, 414),
('cnpm1', 'student', 5, 229, 280),
('cnpm1', 'studentClass', 3, 672, 162),
('cnpm1', 'studentClass', 5, 462, 280),
('cnpm1', 'teacher', 3, 393, 184),
('cnpm1', 'teacher', 5, 882, 276),
('cnpm1', 'user', 3, 570, 392),
('cnpm1', 'user', 5, 443, 516);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `display_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

--
-- Đang đổ dữ liệu cho bảng `pma__table_info`
--

INSERT INTO `pma__table_info` (`db_name`, `table_name`, `display_field`) VALUES
('hh3a', 'diemdanh', 'note'),
('hh3a', 'student', 'idstudent');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `prefs` text NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

--
-- Đang đổ dữ liệu cho bảng `pma__table_uiprefs`
--

INSERT INTO `pma__table_uiprefs` (`username`, `db_name`, `table_name`, `prefs`, `last_update`) VALUES
('root', 'cnpm', 'class', '{\"sorted_col\":\"`class`.`classname` ASC\"}', '2024-09-06 16:32:54'),
('root', 'cnpm1', 'payment', '{\"sorted_col\":\"`payment`.`isPaid` DESC\"}', '2024-09-09 20:14:44'),
('root', 'cnpm1', 'student', '{\"sorted_col\":\"`idStudent` ASC\"}', '2024-09-09 14:28:51'),
('root', 'cnpm1', 'studentClass', '{\"sorted_col\":\"`studentClass`.`dateJoin` DESC\"}', '2024-09-08 14:09:26'),
('root', 'hh3a', 'category', '{\"sorted_col\":\"`category`.`idclass` ASC\"}', '2024-09-07 04:45:45'),
('root', 'hh3a', 'class', '{\"sorted_col\":\"`class`.`idclass` DESC\"}', '2024-09-06 15:11:45'),
('root', 'hh3a', 'diemdanh', '{\"sorted_col\":\"`idstudent` ASC\"}', '2024-09-08 08:53:18'),
('root', 'hh3a', 'student', '{\"sorted_col\":\"`student`.`idstudent` ASC\"}', '2024-09-06 14:44:37'),
('root', 'test', 'tbl_user', '{\"sorted_col\":\"`tbl_user`.`pass` ASC\"}', '2024-08-22 16:53:30');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text NOT NULL,
  `schema_sql` text DEFAULT NULL,
  `data_sql` longtext DEFAULT NULL,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `config_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Đang đổ dữ liệu cho bảng `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2024-12-30 14:47:35', '{\"lang\":\"vi\",\"Console\\/Mode\":\"show\",\"NavigationWidth\":176,\"Console\\/Height\":10.9938470000000023674147087149322032928466796875}');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) NOT NULL,
  `tab` varchar(64) NOT NULL,
  `allowed` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) NOT NULL,
  `usergroup` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Chỉ mục cho bảng `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Chỉ mục cho bảng `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Chỉ mục cho bảng `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Chỉ mục cho bảng `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Chỉ mục cho bảng `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Chỉ mục cho bảng `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Chỉ mục cho bảng `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Chỉ mục cho bảng `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Chỉ mục cho bảng `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Chỉ mục cho bảng `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Chỉ mục cho bảng `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Chỉ mục cho bảng `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Chỉ mục cho bảng `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Chỉ mục cho bảng `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Chỉ mục cho bảng `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Chỉ mục cho bảng `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Chỉ mục cho bảng `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Cơ sở dữ liệu: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `test`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(10) NOT NULL,
  `user` varchar(20) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `role` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `user`, `pass`, `role`) VALUES
(1, 'admin', '123', 1),
(2, 'hotb', '456', 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Cơ sở dữ liệu: `testcnpm`
--
CREATE DATABASE IF NOT EXISTS `testcnpm` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `testcnpm`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `class`
--

CREATE TABLE `class` (
  `idclass` int(255) NOT NULL,
  `nameclass` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `class`
--

INSERT INTO `class` (`idclass`, `nameclass`) VALUES
(1, 'AA'),
(2, 'aaaa'),
(3, 'công nghệ phần mềm');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `student`
--

CREATE TABLE `student` (
  `idstudent` int(255) NOT NULL,
  `userstudent` varchar(255) NOT NULL,
  `namestudent` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `student`
--

INSERT INTO `student` (`idstudent`, `userstudent`, `namestudent`) VALUES
(1, 'awed', 'ava'),
(2, 'âdw', 'aa'),
(3, 'âdw', 'aa'),
(4, '2asnfdasf', 'nguyễn văn a');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `studentclass`
--

CREATE TABLE `studentclass` (
  `idstudent` int(255) NOT NULL,
  `idclass` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `studentclass`
--

INSERT INTO `studentclass` (`idstudent`, `idclass`) VALUES
(4, 3),
(4, 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `teacher`
--

CREATE TABLE `teacher` (
  `idteacher` int(255) NOT NULL,
  `nameteacher` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `teacher`
--

INSERT INTO `teacher` (`idteacher`, `nameteacher`) VALUES
(1, ''),
(2, ''),
(3, ''),
(4, 'ddd'),
(9, 'xđ'),
(10, 'aaa'),
(11, 'aa'),
(12, 'aa'),
(13, 'aa'),
(14, 'aa');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `teacherclass`
--

CREATE TABLE `teacherclass` (
  `idteacher` int(255) NOT NULL,
  `idclass` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`idclass`);

--
-- Chỉ mục cho bảng `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`idstudent`);

--
-- Chỉ mục cho bảng `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`idteacher`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `class`
--
ALTER TABLE `class`
  MODIFY `idclass` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `student`
--
ALTER TABLE `student`
  MODIFY `idstudent` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `teacher`
--
ALTER TABLE `teacher`
  MODIFY `idteacher` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
