-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th10 18, 2024 lúc 04:46 PM
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
-- Cơ sở dữ liệu: `cnpm1`
--

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
