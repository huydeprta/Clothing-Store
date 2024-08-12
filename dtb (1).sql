-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 06, 2023 at 04:04 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dtb`
--

-- --------------------------------------------------------

--
-- Table structure for table `danhmuc`
--

CREATE TABLE `danhmuc` (
  `id_cate` int(11) NOT NULL,
  `name_cate` varchar(255) NOT NULL,
  `mo_ta` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `danhmuc`
--

INSERT INTO `danhmuc` (`id_cate`, `name_cate`, `mo_ta`) VALUES
(1, 'TOP', 'Danh mục sản phẩm top'),
(2, 'BOT', 'Danh mục sản phẩm bot'),
(3, 'ACCESSORIES', 'Danh mục phụ kiện');

-- --------------------------------------------------------

--
-- Table structure for table `hoadon`
--

CREATE TABLE `hoadon` (
  `id_hoadon` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `ngay_mua` date NOT NULL,
  `trang_thai` enum('Đã thanh toán','Chưa thanh toán') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hoadon`
--

INSERT INTO `hoadon` (`id_hoadon`, `id_user`, `ngay_mua`, `trang_thai`) VALUES
(3, 2, '2023-08-06', ''),
(4, 2, '2023-08-06', ''),
(5, 2, '2023-08-06', ''),
(6, 2, '2023-08-06', '');

-- --------------------------------------------------------

--
-- Table structure for table `hoadonchitiet`
--

CREATE TABLE `hoadonchitiet` (
  `id_hoadon` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `so_luong_ban` int(11) NOT NULL,
  `total` float(10,2) NOT NULL,
  `ghi_chu` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hoadonchitiet`
--

INSERT INTO `hoadonchitiet` (`id_hoadon`, `id_product`, `so_luong_ban`, `total`, `ghi_chu`) VALUES
(3, 3, 1, 1000000.00, ''),
(3, 6, 1, 1900000.00, ''),
(4, 3, 1, 1000000.00, ''),
(4, 6, 1, 1900000.00, ''),
(6, 1, 1, 300000.00, '');

-- --------------------------------------------------------

--
-- Table structure for table `khachhang`
--

CREATE TABLE `khachhang` (
  `id_user` int(11) NOT NULL,
  `name_user` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `adress` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `gioi_tinh` enum('Nam','Nữ','Khác') NOT NULL,
  `pass` varchar(255) NOT NULL,
  `roleid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `khachhang`
--

INSERT INTO `khachhang` (`id_user`, `name_user`, `phone`, `adress`, `email`, `gioi_tinh`, `pass`, `roleid`) VALUES
(1, 'thaihuy', '12345678', '113 Lê Duẩn', 'caothaihuy@gmail.com', 'Nam', '113', 1),
(2, 'thaihuy1', '123456789', '115 Lê Duẩn', 'caothaihuy@gmail.com', 'Nam', '123', 2);

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

CREATE TABLE `sanpham` (
  `id_product` int(11) NOT NULL,
  `name_product` varchar(255) NOT NULL,
  `des_product` text DEFAULT NULL,
  `gia` float(10,2) NOT NULL,
  `so_luong` int(11) NOT NULL,
  `hinh_anh` text DEFAULT NULL,
  `id_cate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`id_product`, `name_product`, `des_product`, `gia`, `so_luong`, `hinh_anh`, `id_cate`) VALUES
(1, 'Áo Hoodie Owners', 'Mô tả sản phẩm ', 150000.00, 50, '20230805181834_IMG_7599.1-2048x2048.jpg', 1),
(2, 'Áo Khoác Gió NEWSEVEN Racing Wind Breaker AK.165', 'Mô tả sản phẩm ', 250000.00, 30, '20230805181850_主图-02-2.jpg', 1),
(3, 'Áo Polo NEWSEVEN Cybernetic', 'Mô tả sản phẩm ', 500000.00, 20, '20230805181858_32249a1b156fd79458576c0f147d36ac.jpeg', 1),
(5, 'Áo Thun Dài Tay Studio', 'Mô tả sản phẩm ', 300000.00, 50, '20230805181922_vn-11134207-7qukw-lfp9r696pratfd.jpg', 2),
(6, 'Áo Thun NEWSEVEN Curve T', 'Mô tả sản phẩm ', 450000.00, 30, '20230805181935_screenshot_1688807914.png', 3),
(7, 'Áo Thun NEWSEVEN Line N Tee', 'Mô tả sản phẩm ', 250000.00, 40, '20230805181944_358154516_570235258650024_3102301774846926935_n.jpg', 3),
(8, 'Áo Thun NEWSEVEN Lining', 'Mô tả sản phẩm ', 550000.00, 20, '20230805181954_screenshot_1689217440.png', 3),
(9, 'Áo Thun NEWSEVEN Racing', 'Mô tả sản phẩm ', 150000.00, 50, '20230805182007_主图-02-4-300x300.jpg', 3),
(10, 'Áo Thun Polo N7 Newseven Minimalism V2', 'Mô tả sản phẩm ', 100000.00, 70, '20230805182018_z4289396241271_b95f3e1744393da0a508ada038c1166f.jpg', 3),
(17, 'Quần Short NEWSEVEN Seam QS.151', 'Mô tả', 300000.00, 0, '20230805182821_IMG_7633.1-2048x2048.jpg', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `danhmuc`
--
ALTER TABLE `danhmuc`
  ADD PRIMARY KEY (`id_cate`);

--
-- Indexes for table `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`id_hoadon`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `hoadonchitiet`
--
ALTER TABLE `hoadonchitiet`
  ADD PRIMARY KEY (`id_hoadon`,`id_product`),
  ADD KEY `id_product` (`id_product`);

--
-- Indexes for table `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`id_product`),
  ADD KEY `id_cate` (`id_cate`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `danhmuc`
--
ALTER TABLE `danhmuc`
  MODIFY `id_cate` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `hoadon`
--
ALTER TABLE `hoadon`
  MODIFY `id_hoadon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hoadon`
--
ALTER TABLE `hoadon`
  ADD CONSTRAINT `hoadon_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `khachhang` (`id_user`);

--
-- Constraints for table `hoadonchitiet`
--
ALTER TABLE `hoadonchitiet`
  ADD CONSTRAINT `hoadonchitiet_ibfk_1` FOREIGN KEY (`id_hoadon`) REFERENCES `hoadon` (`id_hoadon`),
  ADD CONSTRAINT `hoadonchitiet_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `sanpham` (`id_product`);

--
-- Constraints for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `sanpham_ibfk_1` FOREIGN KEY (`id_cate`) REFERENCES `danhmuc` (`id_cate`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
