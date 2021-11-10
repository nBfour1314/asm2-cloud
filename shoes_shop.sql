-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 17, 2021 lúc 06:39 PM
-- Phiên bản máy phục vụ: 10.4.18-MariaDB
-- Phiên bản PHP: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `shoes_shop`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `Cate_ID` int(10) NOT NULL,
  `Cate_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`Cate_ID`, `Cate_name`) VALUES
(1, 'MALE ADIDAS'),
(2, 'FEMALE ADIDAS'),
(3, 'MALE NIKE'),
(4, 'FEMALE NIKE');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_pro`
--

CREATE TABLE `order_pro` (
  `O_ID` int(10) NOT NULL,
  `Username` varchar(30) NOT NULL,
  `O_Date` date NOT NULL,
  `Pro_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `Pro_ID` int(10) NOT NULL,
  `Pro_name` varchar(50) NOT NULL,
  `Price` int(10) NOT NULL,
  `Qty` int(10) NOT NULL,
  `Pro_img` varchar(200) NOT NULL,
  `Cate_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`Pro_ID`, `Pro_name`, `Price`, `Qty`, `Pro_img`, `Cate_ID`) VALUES
(1, 'Breaknet', 1400000, 10, 'breaknet.jpg', 1),
(2, 'Runfalcon 2.0', 1400000, 10, 'runfalcon.jpg', 1),
(3, 'Breaknet', 1400000, 10, 'breaknet.jpg', 2),
(4, 'Hypersleek', 3100000, 10, 'hypersleek.jpg', 2),
(5, 'NIKE AIR MAX 270 \'NAVY\' BLUE', 1000000, 10, 'nikeairmax270navyblue.jpg', 4),
(6, 'NIKE AIR MAX 270 WHITE', 1000000, 10, 'nikeairmax270.jpg', 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `Username` varchar(30) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `Telephone` varchar(15) NOT NULL,
  `State` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`Username`, `Password`, `Email`, `Address`, `Telephone`, `State`) VALUES
('admin', 'fcea920f7412b5da7be0cf42b8c93759', 'haonngcc19117@fpt.edu.vn', 'Ca Mau City', '0399989631', 1),
('user', 'fcea920f7412b5da7be0cf42b8c93759', 'user@gmail.com', 'Ca Mau City', '0123456789', 0),
('user1', 'fcea920f7412b5da7be0cf42b8c93759', 'user1@gmail.com', 'Can Tho', '0987654321', 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`Cate_ID`);

--
-- Chỉ mục cho bảng `order_pro`
--
ALTER TABLE `order_pro`
  ADD PRIMARY KEY (`O_ID`),
  ADD KEY `Username` (`Username`),
  ADD KEY `Pro_ID` (`Pro_ID`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`Pro_ID`),
  ADD KEY `Cate_ID` (`Cate_ID`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Username`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `order_pro`
--
ALTER TABLE `order_pro`
  MODIFY `O_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `Pro_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `order_pro`
--
ALTER TABLE `order_pro`
  ADD CONSTRAINT `order_pro_ibfk_1` FOREIGN KEY (`Username`) REFERENCES `user` (`Username`),
  ADD CONSTRAINT `order_pro_ibfk_2` FOREIGN KEY (`Pro_ID`) REFERENCES `product` (`Pro_ID`);

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`Cate_ID`) REFERENCES `category` (`Cate_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
