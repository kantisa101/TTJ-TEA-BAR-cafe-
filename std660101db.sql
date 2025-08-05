-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 31, 2025 at 11:11 AM
-- Server version: 8.0.42-0ubuntu0.22.04.1
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `std660101db`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `BestSellingProducts`
-- (See below for the actual view)
--
CREATE TABLE `BestSellingProducts` (
`Product_id` varchar(8)
,`Product_name` varchar(100)
,`Product_price` decimal(10,2)
,`Product_picture` varchar(100)
,`Category_name` varchar(100)
,`total_sold` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Table structure for table `DetailTTJ_T_BAR`
--

CREATE TABLE `DetailTTJ_T_BAR` (
  `Detail_id` varchar(3) NOT NULL,
  `Detail_topic` varchar(100) DEFAULT NULL,
  `Detail_info` varchar(500) DEFAULT NULL,
  `Detail_address` varchar(255) DEFAULT NULL,
  `Detail_tel` varchar(11) DEFAULT NULL,
  `Detail_banner1` varchar(100) DEFAULT NULL,
  `Detail_banner2` varchar(100) DEFAULT NULL,
  `Detail_banner3` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `DetailTTJ_T_BAR`
--

INSERT INTO `DetailTTJ_T_BAR` (`Detail_id`, `Detail_topic`, `Detail_info`, `Detail_address`, `Detail_tel`, `Detail_banner1`, `Detail_banner2`, `Detail_banner3`) VALUES
('01', 'TTJ TEA BAR Cafe', 'เป็นคาเฟ่เล็กๆๆ', 'ตำบล ปงยางคก อำเภอห้างฉัตร ลำปาง 52190', '0856329415', 'img/Detail/banner1.png', 'img/Detail/banner2.png', 'img/Detail/banner3.png');

-- --------------------------------------------------------

--
-- Table structure for table `Employee`
--

CREATE TABLE `Employee` (
  `Emp_id` varchar(8) NOT NULL,
  `Emp_fname` varchar(50) DEFAULT NULL,
  `Emp_lname` varchar(50) DEFAULT NULL,
  `Emp_tel` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Emp_address` varchar(255) DEFAULT NULL,
  `Emp_status` varchar(1) DEFAULT '2',
  `Emp_image` varchar(100) DEFAULT NULL,
  `Emp_username` varchar(20) DEFAULT NULL,
  `Emp_password` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Employee`
--

INSERT INTO `Employee` (`Emp_id`, `Emp_fname`, `Emp_lname`, `Emp_tel`, `Emp_address`, `Emp_status`, `Emp_image`, `Emp_username`, `Emp_password`) VALUES
('EMP001', 'นางสาวเสาวลักษณ์', ' ปัญญาเวศ', '086 361 2553', '144/3 ม.6 ต.ปงยางคก อ.ห้างฉัตร, จ.ลำปาง', '1', 'img/Emp/EMP001.jpg', 'EMP001', '123456'),
('EMP002', 'วรันธร', 'ศรีสุข', '089 582 6325', '255 ม.6 ต.ปงยางคก อ.ห้างฉัตร, จ.ลำปาง', '2', 'img/Emp/EMP002.jpg', 'EMP002', '123456'),
('EMP003', 'ขวัญทิพย์', 'สรพินิจ ', '083 254 4758', '441 ม.6 ต.ปงยางคก อ.ห้างฉัตร, จ.ลำปาง', '2', 'img/Emp/EMP003.jpg', 'EMP003', '123456'),
('EMP004', 'ภูวดล', 'ประเสริญวงศ์', '084 552 2987', '257 ม.6 ต.ปงยางคก อ.ห้างฉัตร, จ.ลำปาง', '2', 'img/Emp/EMP004.jpg', 'EMP004', '123456'),
('EMP005', 'สุชาติ', 'วรวุฒิอนันตกุล', '087 753 2145', '106 ม.6 ต.ปงยางคก อ.ห้างฉัตร จ.ลำปาง', '2', 'img/Emp/EMP005.jpg', 'EMP005', '123456'),
('EMP006', 'เจน', 'ใจเย็น ', '0877532145', '20/1 ม.6 ต.ปงยางคก อ.ห้างฉัตร จ.ลำปาง', '2', 'img/Emp/EMP006.jpg', 'EMP006', '123456'),
('EMP007', 'test', 'test ', '1234567890', '44 ม.2 ต.ชมพู อ.เมือง จ.ลำปาง', '2', 'img/Emp/EMP007.jpg', 'test@test.com', '123456'),
('EMP008', 'อาจารย์', 'ไพจิตร ', '0302546789', '77 ม.3', '2', 'img/Emp/EMP008.jpg', 'EMP008', '123456');

-- --------------------------------------------------------

--
-- Stand-in structure for view `LOGIN_DATA`
-- (See below for the actual view)
--
CREATE TABLE `LOGIN_DATA` (
`Emp_id` varchar(8)
,`Emp_fname` varchar(50)
,`Emp_lname` varchar(50)
,`Emp_status` varchar(1)
,`Emp_username` varchar(20)
,`Emp_password` varchar(10)
);

-- --------------------------------------------------------

--
-- Table structure for table `Member`
--

CREATE TABLE `Member` (
  `Mem_id` varchar(8) NOT NULL,
  `Mem_fname` varchar(50) DEFAULT NULL,
  `Mem_lname` varchar(50) DEFAULT NULL,
  `Mem_tel` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Mem_address` varchar(255) DEFAULT NULL,
  `Mem_day` date DEFAULT NULL,
  `Mem_stamp` int DEFAULT NULL,
  `Mem_username` varchar(20) DEFAULT NULL,
  `Mem_password` varchar(10) DEFAULT NULL,
  `Mem_image` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Member`
--

INSERT INTO `Member` (`Mem_id`, `Mem_fname`, `Mem_lname`, `Mem_tel`, `Mem_address`, `Mem_day`, `Mem_stamp`, `Mem_username`, `Mem_password`, `Mem_image`) VALUES
('MB001', 'นางสาวกันติศา', 'กิ่งก้ำ', '0901317027', '481 ม.6 ต.ปงยางคก อ.ห้างฉัตร จ.ลำปาง', '2025-02-06', 21, 'MB001', '12345', 'img/Mem/MB001.jpg'),
('MB002', 'มาริสา', 'ใจเที่ยง', '0817092769', '310 ม.6 ต.ปงยางคก อ.ห้างฉัตร จ.ลำปาง', '2025-02-05', 15, 'MB002', '12345', 'img/Mem/MB002.jpg'),
('MB003', 'อริสา ', 'ใจเที่ยง', '0873039446', '310/1 ม.6 ต.ปงยางคก อ.ห้างฉัตร จ.ลำปาง', '2025-02-01', 10, 'MB003', '12345', 'img/Mem/MB003.jpg'),
('MB004', 'รณพร', 'นรินทร์ชนก', '0853653245', '105 ม.6 ต.ปงยางคก อ.ห้างฉัตร จ.ลำปาง', '2025-01-30', 12, 'MB004', '12345', 'img/Mem/MB004.jpg'),
('MB005', 'ธนิณี', 'ภัชรภิรมย์', '0849637418', '255 ม.6 ต.ปงยางคก อ.ห้างฉัตร จ.ลำปาง', '2025-01-24', 9, 'MB005', '12345', 'img/Mem/MB005.jpg'),
('MB006', 'สมใจ', 'มีมาก ', '0658794125', '11 ม.2 ต.ชมพู อ.เมือง จ.ลำปาง ', '2025-02-13', 6, 'MB006', '12345', 'img/Mem/MB006.jpg'),
('MB007', 'สุชาติ', 'วรวุฒิอนันตกุล', '0856987152', '155 ม.2 ต.ชมพู อ.เมือง จ.ลำปาง', '2025-06-02', 0, 'MB007', '12345', 'img/Mem/MB007.jpg'),
('MB008', 'อาจารย์', 'นพนันท์', '0615238547', '477 ม.3 ต.ชมพู อ.เมือง จ.ลำปาง', '2025-05-14', 12, 'MB008', '12345', 'img/Mem/MB008.jpg');

-- --------------------------------------------------------

--
-- Stand-in structure for view `MemberStampsReport`
-- (See below for the actual view)
--
CREATE TABLE `MemberStampsReport` (
`Mem_id` varchar(8)
,`Mem_fname` varchar(50)
,`Mem_lname` varchar(50)
,`Mem_tel` varchar(20)
,`Mem_address` varchar(255)
,`Mem_day` date
,`Total_Stamps` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Table structure for table `Product`
--

CREATE TABLE `Product` (
  `Product_id` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Product_name` varchar(100) DEFAULT NULL,
  `Category_id` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Product_price` decimal(10,2) DEFAULT NULL,
  `Product_status` varchar(1) DEFAULT '1',
  `Product_picture` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Product`
--

INSERT INTO `Product` (`Product_id`, `Product_name`, `Category_id`, `Product_price`, `Product_status`, `Product_picture`) VALUES
('B0049', 'ปังปิ้งเนยนม', 'ProC0006', '20.00', '1', 'img/Product/P0049.jpg'),
('B0050', 'ปังปิ้งเนยน้ำตาล', 'ProC0006', '20.00', '1', 'img/Product/P0050.jpg'),
('B0051', 'ปังปิ้งเนย นม น้ำตาล', 'ProC0006', '25.00', '1', 'img/Product/P0051.jpg'),
('B0052', 'ปังปิ้งเนย นม สังขยา', 'ProC0006', '25.00', '1', 'img/Product/P0052.jpg'),
('B0053', 'ปังปิ้งแยมบลูเบอร์รี่', 'ProC0006', '25.00', '1', 'img/Product/P0053.jpg'),
('B0054', 'ปังปิ้งเนย นม โอวัลติน', 'ProC0006', '25.00', '1', 'img/Product/P0054.jpg'),
('B0055', 'ปังปิ้งพริกเผาหมูหยอง', 'ProC0006', '25.00', '1', 'img/Product/P0055.jpg'),
('B0056', 'ปังปิ้งแยมสตอเบอร์รี่', 'ProC0006', '25.00', '1', 'img/Product/P0056.jpg'),
('B0057', 'ปังปิ้งเนย นม ช็อคโกแลต', 'ProC0006', '25.00', '1', 'img/Product/P0057.jpg'),
('P0001', 'อเมริกาโน่', 'ProC0001', '40.00', '1', 'img/Product/P0001.jpg'),
('P0002', 'เอสเพรสโซ่', 'ProC0001', '40.00', '1', 'img/Product/P0002.jpg'),
('P0003', 'คาปูชิโน่', 'ProC0001', '40.00', '1', 'img/Product/P0003.jpg'),
('P0004', 'มอคค่า', 'ProC0001', '40.00', '1', 'img/Product/P0004.jpg'),
('P0005', 'ลาเต้', 'ProC0001', '40.00', '1', 'img/Product/P0005.jpg'),
('P0006', 'เนสกาแฟ', 'ProC0001', '40.00', '1', 'img/Product/P0006.jpg'),
('P0007', 'ชานมไต้หวัน', 'ProC0002', '30.00', '1', 'img/Product/P0007.jpg'),
('P0008', 'ชานมบราวน์ชูการ์', 'ProC0002', '30.00', '1', 'img/Product/P0008.jpg'),
('P0009', 'ชาไทย', 'ProC0002', '30.00', '1', 'img/Product/P0009.jpg'),
('P0010', 'ชาเขียว', 'ProC0002', '30.00', '1', 'img/Product/P0010.jpg'),
('P0011', 'ชามะลิ', 'ProC0002', '30.00', '1', 'img/Product/P0011.jpg'),
('P0012', 'ชามะลิน้ำผึ้งมะนาว', 'ProC0002', '35.00', '1', 'img/Product/P0012.jpg'),
('P0013', 'ชาเขียวน้ำผึ้งมะนาว', 'ProC0002', '35.00', '1', 'img/Product/P0013.jpg'),
('P0014', 'ชาไทยน้ำผึ้งมะนาว', 'ProC0002', '35.00', '1', 'img/Product/P0014.jpg'),
('P0015', 'ชามะนาว', 'ProC0002', '30.00', '1', 'img/Product/P0015.jpg'),
('P0016', 'ชาพีช/ชาแอปเปิ้ล', 'ProC0002', '30.00', '1', 'img/Product/P0016.jpg'),
('P0017', 'ชาอัญชันน้ำผึ้งมะนาว', 'ProC0002', '35.00', '1', 'img/Product/P0017.jpg'),
('P0018', 'โกโก้ลาวานมสด', 'ProC0003', '35.00', '1', 'img/Product/P0018.jpg'),
('P0019', 'เฉาก๊วยนมสด', 'ProC0003', '35.00', '1', 'img/Product/P0019.jpg'),
('P0020', 'โอเลี้ยง', 'ProC0003', '30.00', '1', 'img/Product/P0020.jpg'),
('P0021', 'โอเลี้ยงยกล้อ(ใส่นม)', 'ProC0003', '30.00', '1', 'img/Product/P0021.jpg'),
('P0022', 'กาแฟโบราณ', 'ProC0003', '35.00', '1', 'img/Product/P0022.jpg'),
('P0023', 'โอริโอ้ปั่นนมสด', 'ProC0003', '35.00', '1', 'img/Product/P0023.jpg'),
('P0024', 'น้ำมะพร้าวปั่น', 'ProC0003', '35.00', '1', 'img/Product/P0024.jpg'),
('P0025', 'น้ำมะพร้าวนมสดปั่น', 'ProC0003', '40.00', '1', 'img/Product/P0025.jpg'),
('P0026', 'อเมริกาโน่ มะพร้าว', 'ProC0003', '40.00', '1', 'img/Product/P0026.jpg'),
('P0027', 'ลาเต้ มะพร้าว', 'ProC0003', '45.00', '1', 'img/Product/P0027.jpg'),
('P0028', 'มะพร้าวปั่นนมสด+ช็อตกาแฟ', 'ProC0003', '50.00', '1', 'img/Product/P0028.jpg'),
('P0029', 'นมสด', 'ProC0004', '30.00', '1', 'img/Product/P0029.jpg'),
('P0030', 'นมชมพู', 'ProC0004', '30.00', '1', 'img/Product/P0030.jpg'),
('P0031', 'นมสดคาราเมล', 'ProC0004', '30.00', '1', 'img/Product/P0031.jpg'),
('P0032', 'นมสดช็อคโกแลต', 'ProC0004', '30.00', '1', 'img/Product/P0032.jpg'),
('P0033', 'นมสดบราวน์ชูการ์', 'ProC0004', '30.00', '1', 'img/Product/P0033.jpg'),
('P0034', 'นมสดน้ำผึ้ง', 'ProC0004', '30.00', '1', 'img/Product/P0034.jpg'),
('P0035', 'ชาไทย/ชาเขียว นมสด', 'ProC0004', '35.00', '1', 'img/Product/P0035.jpg'),
('P0036', 'ชาอัญชันนมสด', 'ProC0004', '35.00', '1', 'img/Product/P0036.jpg'),
('P0037', 'ชาเขียวมัทฉะลาเต้', 'ProC0004', '45.00', '1', 'img/Product/P0037.jpg'),
('P0038', 'มันม่วงญี่ปุ่นนมสด', 'ProC0004', '35.00', '1', 'img/Product/P0038.jpg'),
('P0039', 'ไมโลนมสด', 'ProC0004', '35.00', '1', 'img/Product/P0039.jpg'),
('P0040', 'โอวัลตินนมสด', 'ProC0004', '35.00', '1', 'img/Product/P0040.jpg'),
('P0041', 'ไวท์มอลต์นมสด', 'ProC0004', '35.00', '1', 'img/Product/P0041.jpg'),
('P0042', 'นมสดสตอเบอร์รี่', 'ProC0004', '30.00', '1', 'img/Product/P0042.jpg'),
('P0043', 'สตอเบอร์รี่ โซดา', 'ProC0005', '25.00', '1', 'img/Product/P0043.jpg'),
('P0044', 'บลูฮาวาย โซดา', 'ProC0005', '25.00', '1', 'img/Product/P0044.jpg'),
('P0045', 'บลูเบอร์รี่ โซดา', 'ProC0005', '25.00', '1', 'img/Product/P0045.jpg'),
('P0046', 'แอปเปิ้ลเขียว โซดา', 'ProC0005', '25.00', '1', 'img/Product/P0046.jpg'),
('P0047', 'กีวี่  โซดา', 'ProC0005', '25.00', '1', 'img/Product/P0047.jpg'),
('P0048', 'ลิ้นจี่ โซดา', 'ProC0005', '25.00', '1', 'img/Product/P0048.jpg'),
('P0060', 'แก้วทำความเย็น', 'ProC0007', '50.00', '1', 'img/Product/P0060.jpg'),
('P0061', 'พวงกุญแจ', 'ProC0007', '50.00', '1', 'img/Product/P0061.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `ProductCategory`
--

CREATE TABLE `ProductCategory` (
  `Category_id` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Category_name` varchar(100) DEFAULT NULL,
  `Category_Description` varchar(255) DEFAULT NULL,
  `Category_picture` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ProductCategory`
--

INSERT INTO `ProductCategory` (`Category_id`, `Category_name`, `Category_Description`, `Category_picture`) VALUES
('ProC0001', 'coffee', 'เครื่องดื่มประเภทกาแฟ', 'img/ProCat/ProC0001.jpg'),
('ProC0002', 'tea', 'เครื่องดื่มประเภทชา', 'img/ProCat/ProC0002.jpg'),
('ProC0003', 'Special menu', 'เครื่องดื่มประเภทเมนูพิเศษ', 'img/ProCat/ProC0003.jpg'),
('ProC0004', 'Fresh milk', 'เครื่องดื่มประเภทนมสด', 'img/ProCat/ProC0004.jpg'),
('ProC0005', 'Italian Soda Menu', 'เครื่องดื่มประเภทอิตาเลี่ยนโซดา', 'img/ProCat/ProC0005.jpg'),
('ProC0006', 'Toast', 'ขนมปังปิ้ง', 'img/ProCat/ProC0006.jpg'),
('ProC0007', 'ของสมนาคุณ', 'ของคำนันให้สมาชิก', 'img/ProCat/ProC0007.jpg');

-- --------------------------------------------------------

--
-- Stand-in structure for view `Product_DATA`
-- (See below for the actual view)
--
CREATE TABLE `Product_DATA` (
`Product_id` varchar(8)
,`Product_name` varchar(100)
,`Category_id` varchar(8)
,`Product_price` decimal(10,2)
,`Product_status` varchar(1)
,`Product_picture` varchar(100)
,`Category_name` varchar(100)
,`Category_Description` varchar(255)
,`New_name` varchar(10)
);

-- --------------------------------------------------------

--
-- Table structure for table `Promotion`
--

CREATE TABLE `Promotion` (
  `Pmo_id` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Pmo_name` varchar(100) DEFAULT NULL,
  `Pmo_Description` varchar(255) DEFAULT NULL,
  `Pmo_startdate` date DEFAULT NULL,
  `Pmo_Enddate` date DEFAULT NULL,
  `Pmo_condition` varchar(255) DEFAULT NULL,
  `Pmo_discount` int NOT NULL DEFAULT '5'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Promotion`
--

INSERT INTO `Promotion` (`Pmo_id`, `Pmo_name`, `Pmo_Description`, `Pmo_startdate`, `Pmo_Enddate`, `Pmo_condition`, `Pmo_discount`) VALUES
('Pmo001', 'Summer Sale', 'ลดราคาสินค้าทั้งหมด 50%', '2025-07-01', '2025-07-20', 'ยอดซื้อต้องไม่น้อยกว่า 50 บาท', 50),
('Pmo002', 'VIP Member Discount', 'ส่วนลด 20% สำหรับสมาชิก VIP', '2025-07-01', '2025-07-31', 'เฉพาะสมาชิก VIP เท่านั้น', 20),
('Pmo003', 'Holiday Special', 'ลด 30% สำหรับสินค้าที่ร่วมรายการในช่วงวันหยุด', '2025-07-01', '2025-07-31', 'ใช้ได้เฉพาะช่วงวันหยุด', 30),
('Pmo004', 'New Customer Welcome', 'ส่วนลด 10% สำหรับลูกค้าใหม่ครั้งแรก', '2025-05-01', '2025-05-30', 'เฉพาะลูกค้าใหม่ครั้งแรกเท่านั้น', 10);

-- --------------------------------------------------------

--
-- Stand-in structure for view `Promotionlist`
-- (See below for the actual view)
--
CREATE TABLE `Promotionlist` (
`Pmo_id` varchar(8)
,`Pmo_name` varchar(100)
,`Pmo_Description` varchar(255)
,`Pmo_startdate` date
,`Pmo_Enddate` date
,`Pmo_condition` varchar(255)
,`Pmo_discount` int
,`DATEDIFF(``Pmo_Enddate``, CURDATE())` int
);

-- --------------------------------------------------------

--
-- Table structure for table `Sales`
--

CREATE TABLE `Sales` (
  `Sales_id` varchar(50) NOT NULL,
  `Sales_datetime` datetime NOT NULL,
  `Mem_id` varchar(50) NOT NULL,
  `Sales_discount` decimal(10,2) DEFAULT '0.00',
  `Sales_total` decimal(10,2) NOT NULL,
  `Sales_Payment_channels` varchar(50) NOT NULL,
  `Emp_id` varchar(50) NOT NULL,
  `Pmo_id` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Sales`
--

INSERT INTO `Sales` (`Sales_id`, `Sales_datetime`, `Mem_id`, `Sales_discount`, `Sales_total`, `Sales_Payment_channels`, `Emp_id`, `Pmo_id`) VALUES
('S16072025MB0021', '2025-07-16 11:55:04', 'MB002', '60.00', '60.00', 'เงินสด', 'EMP001', 'Pmo001'),
('S16072025MB0022', '2025-07-16 13:42:12', 'MB002', '24.00', '96.00', 'เงินสด', 'EMP001', 'Pmo002'),
('S16072025MB0041', '2025-07-16 11:55:44', 'MB004', '22.00', '88.00', 'QR Code', 'EMP001', 'Pmo002'),
('S16072025MB0081', '2025-07-16 13:47:59', 'MB008', '0.00', '120.00', 'QR Code', 'EMP001', '0000'),
('S16072025MB0082', '2025-07-16 13:48:52', 'MB008', '0.00', '120.00', 'QR Code', 'EMP001', '0000'),
('S21062025+MB005+1', '2025-06-21 20:36:23', 'MB005', '60.00', '60.00', 'เงินสด', 'EMP001', 'Pmo001'),
('S21062025000001', '2025-06-21 20:49:45', '00000', '0.00', '80.00', 'เงินสด', 'EMP001', '0000'),
('S21062025MB0061', '2025-06-21 20:41:18', 'MB006', '0.00', '105.00', 'เงินสด', 'EMP001', '0000'),
('S28062025000001', '2025-06-28 11:33:38', '00000', '0.00', '160.00', 'เงินสด', 'EMP001', '0000'),
('S28062025000002', '2025-06-28 11:54:20', '00000', '0.00', '125.00', 'QR Code', 'EMP001', '0000'),
('S28062025MB0011', '2025-06-28 10:34:45', 'MB001', '40.00', '40.00', 'QR Code', 'EMP001', 'Pmo001'),
('S28062025MB0031', '2025-06-28 11:10:11', 'MB003', '85.00', '85.00', 'QR Code', 'EMP001', 'Pmo001'),
('S67e7b91256e7e', '2025-03-29 16:10:41', 'MB002', '4.00', '76.00', 'QR Code', 'EMP001', 'Pmo002'),
('S67e7bf069461d', '2025-03-29 16:36:06', 'MB002', '21.00', '189.00', 'เงินสด', 'EMP001', 'Pmo005'),
('S67e7c065a83da', '2025-03-29 16:41:57', 'MB001', '57.50', '57.50', 'เงินสด', 'EMP001', 'Pmo001'),
('S67e7c09d37216', '2025-03-29 16:42:52', 'MB006', '22.00', '88.00', 'เงินสด', 'EMP001', 'Pmo003'),
('S67e7c0ea1214e', '2025-03-29 16:44:09', 'MB003', '5.00', '95.00', 'เงินสด', 'EMP001', 'Pmo002'),
('S67e7c1ba9f74c', '2025-03-29 16:47:38', 'MB002', '33.00', '77.00', 'เงินสด', 'EMP001', 'Pmo004'),
('S67f1f72db0713', '2025-04-06 10:38:21', 'MB002', '6.00', '114.00', 'เงินสด', 'EMP001', 'Pmo002'),
('S67f3350c6b120', '2025-04-07 09:14:36', '00000', '3.75', '71.25', 'เงินสด', 'EMP001', 'Pmo002'),
('S681ebeb57080f', '2025-05-10 09:49:25', 'MB001', '0.00', '40.00', 'QR Code', 'EMP001', '0000'),
('S6823231d88bb7', '2025-05-13 17:46:52', 'MB001', '60.00', '60.00', 'เงินสด', 'EMP001', 'Pmo001'),
('S68232332ab67e', '2025-05-13 17:47:14', 'MB004', '36.00', '84.00', 'เงินสด', 'EMP001', 'Pmo003'),
('S6827f4fabb37b', '2025-05-17 09:31:23', 'MB005', '0.00', '120.00', 'QR Code', 'EMP001', '0000'),
('S6827f526d1fc4', '2025-05-17 09:32:07', 'MB005', '0.00', '55.00', 'QR Code', 'EMP001', '0000'),
('S682806023cbe8', '2025-05-17 10:44:02', 'MB001', '67.50', '67.50', 'เงินสด', 'EMP001', 'Pmo001'),
('S682806ce599f2', '2025-05-17 10:47:27', 'MB002', '0.00', '70.00', 'QR Code', 'EMP001', '0000'),
('S6828072db98d6', '2025-05-17 10:49:02', 'MB006', '0.00', '75.00', 'QR Code', 'EMP001', '0000'),
('S682808bd35360', '2025-05-17 10:55:41', 'MB005', '0.00', '80.00', 'QR Code', 'EMP001', '0000'),
('S68280949751ef', '2025-05-17 10:58:02', 'MB006', '12.00', '48.00', 'QR Code', 'EMP001', 'Pmo002'),
('S68280bf3c4a28', '2025-05-17 11:09:24', 'MB005', '35.00', '35.00', 'QR Code', 'EMP001', 'Pmo001'),
('S68280c9b13d7a', '2025-05-17 11:12:11', 'MB004', '30.00', '70.00', 'QR Code', 'EMP001', 'Pmo003'),
('S68280d04a4339', '2025-05-17 11:13:57', 'MB004', '0.00', '60.00', 'QR Code', 'EMP001', '0000'),
('S68280e80404cd', '2025-05-17 11:20:16', 'MB006', '16.00', '64.00', 'QR Code', 'EMP001', 'Pmo002'),
('S68281d8318c52', '2025-05-17 12:24:19', 'MB002', '0.00', '80.00', 'QR Code', 'EMP001', '0000'),
('S68281d9e86591', '2025-05-17 12:24:47', 'MB005', '0.00', '50.00', 'QR Code', 'EMP001', '0000'),
('S68281db067d51', '2025-05-17 12:25:05', 'MB001', '0.00', '125.00', 'QR Code', 'EMP001', '0000'),
('S683ab301e090d', '2025-05-31 14:42:58', 'MB001', '0.00', '150.00', 'QR Code', 'EMP001', '0000'),
('S683ab36cc9e00', '2025-05-31 14:44:45', 'MB003', '0.00', '80.00', 'QR Code', 'EMP001', '0000'),
('S683d0e84a8780', '2025-06-02 09:37:56', 'MB006', '47.50', '47.50', 'เงินสด', 'EMP001', 'Pmo001'),
('S685270b0387c5', '2025-06-18 14:54:23', 'MB008', '40.00', '40.00', 'QR Code', 'EMP001', 'Pmo001'),
('S6852772677ddb', '2025-06-18 15:21:58', 'MB008', '0.00', '100.00', 'QR Code', 'EMP008', '0000'),
('S68562908f0ccc', '2025-06-21 10:37:45', '00000', '0.00', '80.00', 'เงินสด', 'EMP001', '0000'),
('S68562b5c2f8be', '2025-06-21 10:47:40', 'MB001', '40.00', '40.00', 'QR Code', 'EMP001', 'Pmo001'),
('S68562c80da662', '2025-06-21 10:52:33', '00000', '0.00', '70.00', 'QR Code', 'EMP001', '0000'),
('S68562cb67e114', '2025-06-21 10:53:27', 'MB001', '30.00', '30.00', 'QR Code', 'EMP001', 'Pmo001');

-- --------------------------------------------------------

--
-- Table structure for table `SalesList`
--

CREATE TABLE `SalesList` (
  `SalesList_id` int NOT NULL,
  `Sales_id` varchar(50) NOT NULL,
  `Product_id` varchar(50) NOT NULL,
  `Quantity` int NOT NULL DEFAULT '1',
  `Price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `SalesList`
--

INSERT INTO `SalesList` (`SalesList_id`, `Sales_id`, `Product_id`, `Quantity`, `Price`) VALUES
(52, 'S67dd2abeb0f7d', 'P0002', 1, '40.00'),
(53, 'S67dd2abeb0f7d', 'P0003', 1, '40.00'),
(54, 'S67dd2abeb0f7d', 'P0010', 1, '30.00'),
(55, 'S67dd2e394b7b1', 'P0005', 1, '40.00'),
(56, 'S67dd2e394b7b1', 'P0016', 1, '30.00'),
(57, 'S67dd2e394b7b1', 'P0015', 1, '30.00'),
(58, 'S67dd2e394b7b1', 'P0014', 1, '35.00'),
(59, 'S67dd312bdbf7e', 'P0001', 1, '40.00'),
(60, 'S67dd312bdbf7e', 'P0002', 1, '40.00'),
(61, 'S67dd312bdbf7e', 'P0003', 1, '40.00'),
(62, 'S67dd312bdbf7e', 'P0010', 1, '30.00'),
(63, 'S67dd3289a856a', 'P0052', 1, '25.00'),
(64, 'S67dd3289a856a', 'P0051', 1, '25.00'),
(65, 'S67dd3289a856a', 'P0050', 1, '20.00'),
(66, 'S67dd3289a856a', 'P0049', 1, '20.00'),
(67, 'S67dd3427bf466', 'P0013', 1, '35.00'),
(68, 'S67dd3427bf466', 'P0014', 1, '35.00'),
(69, 'S67dd3427bf466', 'P0049', 1, '20.00'),
(70, 'S67dd3427bf466', 'P0050', 1, '20.00'),
(71, 'S67dd3590674dc', 'P0001', 1, '40.00'),
(72, 'S67dd3590674dc', 'P0038', 1, '35.00'),
(73, 'S67dd3590674dc', 'P0052', 1, '25.00'),
(74, 'S67dd3590674dc', 'P0053', 1, '25.00'),
(75, 'S67dd35b0e97c1', 'P0006', 1, '40.00'),
(76, 'S67dd35b0e97c1', 'P0018', 1, '35.00'),
(77, 'S67dd35b0e97c1', 'P0024', 1, '35.00'),
(78, 'S67dd35b0e97c1', 'P0030', 1, '30.00'),
(79, 'S67dd371461096', 'P0024', 1, '35.00'),
(80, 'S67dd371461096', 'P0023', 1, '35.00'),
(81, 'S67dd371461096', 'P0022', 1, '35.00'),
(82, 'S67dd630e301cd', 'P0001', 1, '40.00'),
(83, 'S67dd630e301cd', 'P0002', 1, '40.00'),
(84, 'S67dd630e301cd', 'P0003', 1, '40.00'),
(85, 'S67dd630e301cd', 'P0004', 1, '40.00'),
(86, 'S67dd67d3e42a0', 'P0006', 1, '40.00'),
(87, 'S67dd67d3e42a0', 'P0012', 1, '35.00'),
(88, 'S67dd67d3e42a0', 'P0018', 1, '35.00'),
(89, 'S67dd6811da572', 'P0009', 1, '30.00'),
(90, 'S67dd6811da572', 'P0021', 1, '30.00'),
(91, 'S67dd6811da572', 'P0020', 1, '30.00'),
(92, 'S67dd682ad9f32', 'P0028', 1, '50.00'),
(93, 'S67dd682ad9f32', 'P0029', 1, '30.00'),
(94, 'S67dd682ad9f32', 'P0030', 1, '30.00'),
(95, 'S67dd682ad9f32', 'P0035', 1, '35.00'),
(96, 'S67dd68f145625', 'P0034', 1, '30.00'),
(97, 'S67dd68f145625', 'P0033', 1, '30.00'),
(98, 'S67dd68f145625', 'P0052', 1, '25.00'),
(99, 'S67dd68f145625', 'P0051', 1, '25.00'),
(100, 'S67de5b04a698e', 'P0005', 1, '40.00'),
(101, 'S67de5b04a698e', 'P0004', 1, '40.00'),
(102, 'S67de5bb827890', 'P0001', 1, '40.00'),
(103, 'S67de5bb827890', 'P0003', 1, '40.00'),
(104, 'S67de5cb5846b1', 'P0006', 1, '40.00'),
(105, 'S67de5cb5846b1', 'P0005', 1, '40.00'),
(106, 'S67de603547432', 'P0006', 1, '40.00'),
(107, 'S67de603547432', 'P0017', 1, '35.00'),
(108, 'S67de605d1041f', 'P0006', 1, '40.00'),
(109, 'S67de605d1041f', 'P0005', 1, '40.00'),
(110, 'S67de606e40d68', 'P0006', 1, '40.00'),
(111, 'S67de606e40d68', 'P0005', 1, '40.00'),
(112, 'S67de618a18b00', 'P0004', 1, '40.00'),
(113, 'S67de618a18b00', 'P0003', 1, '40.00'),
(114, 'S67de6500a2a2b', 'P0001', 1, '40.00'),
(115, 'S67de6500a2a2b', 'P0002', 1, '40.00'),
(116, 'S67de6500a2a2b', 'P0015', 1, '30.00'),
(117, 'S67de652906486', 'P0016', 1, '30.00'),
(118, 'S67de652906486', 'P0015', 1, '30.00'),
(119, 'S67de6905a2bf5', 'P0015', 1, '30.00'),
(120, 'S67de6905a2bf5', 'P0014', 1, '35.00'),
(121, 'S67de6bf9129cb', 'P0018', 1, '35.00'),
(122, 'S67de6bf9129cb', 'P0024', 1, '35.00'),
(123, 'S67de7136cc433', 'P0001', 1, '40.00'),
(124, 'S67de7136cc433', 'P0002', 1, '40.00'),
(125, 'S67de7928a6cf4', 'P0005', 1, '40.00'),
(126, 'S67de7928a6cf4', 'P0007', 1, '30.00'),
(127, 'S67de7928a6cf4', 'P0009', 1, '30.00'),
(128, 'S67de797c4a61b', 'P0004', 1, '40.00'),
(129, 'S67de797c4a61b', 'P0005', 1, '40.00'),
(130, 'S67de797c4a61b', 'P0006', 1, '40.00'),
(131, 'S67de7991358fe', 'P0004', 1, '40.00'),
(132, 'S67de7991358fe', 'P0005', 1, '40.00'),
(133, 'S67de7991358fe', 'P0006', 1, '40.00'),
(134, 'S67de7991358fe', 'P0057', 1, '25.00'),
(135, 'S67de7991358fe', 'P0056', 1, '25.00'),
(136, 'S67de7991358fe', 'P0055', 1, '25.00'),
(137, 'S67de7b46218d0', 'P0057', 1, '25.00'),
(138, 'S67de7b46218d0', 'P0056', 1, '25.00'),
(139, 'S67de7b46218d0', 'P0055', 1, '25.00'),
(140, 'S67de7b46218d0', 'P0054', 1, '25.00'),
(141, 'S67dfe4de310e4', 'P0001', 1, '40.00'),
(142, 'S67dfe4de310e4', 'P0002', 1, '40.00'),
(143, 'S67dfe4de310e4', 'P0003', 1, '40.00'),
(144, 'S67dfe4de310e4', 'P0010', 1, '30.00'),
(145, 'S67dfe4de310e4', 'P0022', 1, '35.00'),
(146, 'S67e359c237b07', 'P0016', 1, '30.00'),
(147, 'S67e359c237b07', 'P0015', 1, '30.00'),
(148, 'S67e359c237b07', 'P0014', 1, '35.00'),
(149, 'S67e35b451651c', 'P0006', 1, '40.00'),
(150, 'S67e35b451651c', 'P0005', 1, '40.00'),
(151, 'S67e35b451651c', 'P0004', 1, '40.00'),
(152, 'S67e3759a1ce78', 'P0004', 1, '40.00'),
(153, 'S67e3759a1ce78', 'P0003', 1, '40.00'),
(154, 'S67e3759a1ce78', 'P0009', 1, '30.00'),
(155, 'S67e3759a1ce78', 'P0010', 1, '30.00'),
(156, 'S67e79ea384d61', 'P0001', 1, '40.00'),
(157, 'S67e79ea384d61', 'P0008', 1, '30.00'),
(158, 'S67e79ea384d61', 'P0009', 1, '30.00'),
(159, 'S67e79f12d61d9', 'P0001', 1, '40.00'),
(160, 'S67e79f12d61d9', 'P0008', 1, '30.00'),
(161, 'S67e79f12d61d9', 'P0009', 1, '30.00'),
(162, 'S67e79f28ed1a8', 'P0004', 1, '40.00'),
(163, 'S67e79f28ed1a8', 'P0003', 1, '40.00'),
(164, 'S67e7b91256e7e', 'P0002', 1, '40.00'),
(165, 'S67e7b91256e7e', 'P0003', 1, '40.00'),
(166, 'S67e7bf069461d', 'P0001', 1, '40.00'),
(167, 'S67e7bf069461d', 'P0002', 1, '40.00'),
(168, 'S67e7bf069461d', 'P0003', 1, '40.00'),
(169, 'S67e7bf069461d', 'P0004', 1, '40.00'),
(170, 'S67e7bf069461d', 'P0057', 1, '25.00'),
(171, 'S67e7bf069461d', 'P0056', 1, '25.00'),
(172, 'S67e7c065a83da', 'P0002', 1, '40.00'),
(173, 'S67e7c065a83da', 'P0003', 1, '40.00'),
(174, 'S67e7c065a83da', 'P0039', 1, '35.00'),
(175, 'S67e7c09d37216', 'P0026', 1, '40.00'),
(176, 'S67e7c09d37216', 'P0027', 1, '45.00'),
(177, 'S67e7c09d37216', 'P0051', 1, '25.00'),
(178, 'S67e7c0ea1214e', 'P0006', 1, '40.00'),
(179, 'S67e7c0ea1214e', 'P0034', 1, '30.00'),
(180, 'S67e7c0ea1214e', 'P0033', 1, '30.00'),
(181, 'S67e7c1ba9f74c', 'P0052', 1, '25.00'),
(182, 'S67e7c1ba9f74c', 'P0027', 1, '45.00'),
(183, 'S67e7c1ba9f74c', 'P0026', 1, '40.00'),
(184, 'S67f1f72db0713', 'P0003', 1, '40.00'),
(185, 'S67f1f72db0713', 'P0002', 1, '40.00'),
(186, 'S67f1f72db0713', 'P0004', 1, '40.00'),
(187, 'S67f3350c6b120', 'P0016', 1, '30.00'),
(188, 'S67f3350c6b120', 'P0027', 1, '45.00'),
(189, 'S681ebeb57080f', 'P0005', 1, '40.00'),
(190, 'S6823231d88bb7', 'P0005', 1, '40.00'),
(191, 'S6823231d88bb7', 'P0004', 1, '40.00'),
(192, 'S6823231d88bb7', 'P0003', 1, '40.00'),
(193, 'S68232332ab67e', 'P0004', 1, '40.00'),
(194, 'S68232332ab67e', 'P0005', 1, '40.00'),
(195, 'S68232332ab67e', 'P0006', 1, '40.00'),
(196, 'S6827f4fabb37b', 'P0004', 1, '40.00'),
(197, 'S6827f4fabb37b', 'P0003', 1, '40.00'),
(198, 'S6827f4fabb37b', 'P0006', 1, '40.00'),
(199, 'S6827f526d1fc4', 'P0016', 1, '30.00'),
(200, 'S6827f526d1fc4', 'P0052', 1, '25.00'),
(201, 'S682806023cbe8', 'P0004', 1, '40.00'),
(202, 'S682806023cbe8', 'P0003', 1, '40.00'),
(203, 'S682806023cbe8', 'P0011', 1, '30.00'),
(204, 'S682806023cbe8', 'P0057', 1, '25.00'),
(205, 'S682806ce599f2', 'P0005', 1, '40.00'),
(206, 'S682806ce599f2', 'P0011', 1, '30.00'),
(207, 'S6828072db98d6', 'P0006', 1, '40.00'),
(208, 'S6828072db98d6', 'P0018', 1, '35.00'),
(209, 'S682808bd35360', 'P0004', 1, '40.00'),
(210, 'S682808bd35360', 'P0005', 1, '40.00'),
(211, 'S68280949751ef', 'P0009', 1, '30.00'),
(212, 'S68280949751ef', 'P0008', 1, '30.00'),
(213, 'S68280bf3c4a28', 'P0003', 1, '40.00'),
(214, 'S68280bf3c4a28', 'P0009', 1, '30.00'),
(215, 'S68280c9b13d7a', 'P0015', 1, '30.00'),
(216, 'S68280c9b13d7a', 'P0014', 1, '35.00'),
(217, 'S68280c9b13d7a', 'P0022', 1, '35.00'),
(218, 'S68280d04a4339', 'P0011', 1, '30.00'),
(219, 'S68280d04a4339', 'P0010', 1, '30.00'),
(220, 'S68280e80404cd', 'P0006', 1, '40.00'),
(221, 'S68280e80404cd', 'P0005', 1, '40.00'),
(222, 'S68281d8318c52', 'P0006', 1, '40.00'),
(223, 'S68281d8318c52', 'P0005', 1, '40.00'),
(224, 'S68281d9e86591', 'B0052', 1, '25.00'),
(225, 'S68281d9e86591', 'B0053', 1, '25.00'),
(226, 'S68281db067d51', 'P0005', 1, '40.00'),
(227, 'S68281db067d51', 'P0017', 1, '35.00'),
(228, 'S68281db067d51', 'B0057', 1, '25.00'),
(229, 'S68281db067d51', 'B0056', 1, '25.00'),
(230, 'S683ab301e090d', 'P0006', 1, '40.00'),
(231, 'S683ab301e090d', 'P0005', 1, '40.00'),
(232, 'S683ab301e090d', 'P0012', 1, '35.00'),
(233, 'S683ab301e090d', 'P0035', 1, '35.00'),
(234, 'S683ab36cc9e00', 'P0006', 1, '40.00'),
(235, 'S683ab36cc9e00', 'P0005', 1, '40.00'),
(236, 'S683d0e84a8780', 'P0016', 1, '30.00'),
(237, 'S683d0e84a8780', 'P0015', 1, '30.00'),
(238, 'S683d0e84a8780', 'P0014', 1, '35.00'),
(239, 'S685270b0387c5', 'P0002', 1, '40.00'),
(240, 'S685270b0387c5', 'P0002', 1, '40.00'),
(241, 'S6852772677ddb', 'P0061', 1, '50.00'),
(242, 'S6852772677ddb', 'P0061', 1, '50.00'),
(243, 'S68562908f0ccc', 'P0006', 1, '40.00'),
(244, 'S68562908f0ccc', 'P0005', 1, '40.00'),
(245, 'S68562b5c2f8be', 'P0004', 1, '40.00'),
(246, 'S68562b5c2f8be', 'P0003', 1, '40.00'),
(247, 'S68562c80da662', 'P0006', 1, '40.00'),
(248, 'S68562c80da662', 'P0011', 1, '30.00'),
(249, 'S68562cb67e114', 'P0009', 1, '30.00'),
(250, 'S68562cb67e114', 'P0010', 1, '30.00'),
(251, 'S21062025+MB005+1', 'P0004', 1, '40.00'),
(252, 'S21062025+MB005+1', 'P0003', 1, '40.00'),
(253, 'S21062025+MB005+1', 'P0006', 1, '40.00'),
(254, 'S21062025MB0061', 'P0005', 1, '40.00'),
(255, 'S21062025MB0061', 'P0010', 1, '30.00'),
(256, 'S21062025MB0061', 'P0023', 1, '35.00'),
(257, 'S21062025000001', 'P0004', 1, '40.00'),
(258, 'S21062025000001', 'P0003', 1, '40.00'),
(259, 'S28062025MB0011', 'P0001', 1, '40.00'),
(260, 'S28062025MB0011', 'P0002', 1, '40.00'),
(261, 'S28062025MB0031', 'P0010', 3, '30.00'),
(262, 'S28062025MB0031', 'P0002', 2, '40.00'),
(263, 'S28062025000001', 'P0005', 2, '40.00'),
(264, 'S28062025000001', 'P0004', 1, '40.00'),
(265, 'S28062025000001', 'P0003', 1, '40.00'),
(266, 'S28062025000002', 'P0010', 2, '30.00'),
(267, 'S28062025000002', 'P0015', 1, '30.00'),
(268, 'S28062025000002', 'P0014', 1, '35.00'),
(269, 'S16072025MB0021', 'P0005', 1, '40.00'),
(270, 'S16072025MB0021', 'P0004', 1, '40.00'),
(271, 'S16072025MB0021', 'P0003', 1, '40.00'),
(272, 'S16072025MB0041', 'P0006', 1, '40.00'),
(273, 'S16072025MB0041', 'P0005', 1, '40.00'),
(274, 'S16072025MB0041', 'P0011', 1, '30.00'),
(275, 'S16072025MB0022', 'P0005', 1, '40.00'),
(276, 'S16072025MB0022', 'P0004', 1, '40.00'),
(277, 'S16072025MB0022', 'P0003', 1, '40.00'),
(278, 'S16072025MB0081', 'P0005', 2, '40.00'),
(279, 'S16072025MB0081', 'P0002', 1, '40.00'),
(280, 'S16072025MB0082', 'P0002', 1, '40.00'),
(281, 'S16072025MB0082', 'P0005', 2, '40.00');

-- --------------------------------------------------------

--
-- Structure for view `BestSellingProducts`
--
DROP TABLE IF EXISTS `BestSellingProducts`;

CREATE ALGORITHM=UNDEFINED DEFINER=`std660101`@`localhost` SQL SECURITY DEFINER VIEW `BestSellingProducts`  AS SELECT `p`.`Product_id` AS `Product_id`, `p`.`Product_name` AS `Product_name`, `p`.`Product_price` AS `Product_price`, `p`.`Product_picture` AS `Product_picture`, `pc`.`Category_name` AS `Category_name`, sum(`sl`.`Quantity`) AS `total_sold` FROM ((`SalesList` `sl` join `Product` `p` on((`sl`.`Product_id` = `p`.`Product_id`))) join `ProductCategory` `pc` on((`p`.`Category_id` = `pc`.`Category_id`))) GROUP BY `p`.`Product_id`, `p`.`Product_name`, `p`.`Product_price`, `p`.`Product_picture`, `pc`.`Category_name` HAVING (`total_sold` > 0) ORDER BY `total_sold` DESC LIMIT 0, 10 ;

-- --------------------------------------------------------

--
-- Structure for view `LOGIN_DATA`
--
DROP TABLE IF EXISTS `LOGIN_DATA`;

CREATE ALGORITHM=UNDEFINED DEFINER=`std660101`@`localhost` SQL SECURITY DEFINER VIEW `LOGIN_DATA`  AS SELECT `Employee`.`Emp_id` AS `Emp_id`, `Employee`.`Emp_fname` AS `Emp_fname`, `Employee`.`Emp_lname` AS `Emp_lname`, `Employee`.`Emp_status` AS `Emp_status`, `Employee`.`Emp_username` AS `Emp_username`, `Employee`.`Emp_password` AS `Emp_password` FROM `Employee` ;

-- --------------------------------------------------------

--
-- Structure for view `MemberStampsReport`
--
DROP TABLE IF EXISTS `MemberStampsReport`;

CREATE ALGORITHM=UNDEFINED DEFINER=`std660101`@`localhost` SQL SECURITY DEFINER VIEW `MemberStampsReport`  AS SELECT `m`.`Mem_id` AS `Mem_id`, `m`.`Mem_fname` AS `Mem_fname`, `m`.`Mem_lname` AS `Mem_lname`, `m`.`Mem_tel` AS `Mem_tel`, `m`.`Mem_address` AS `Mem_address`, `m`.`Mem_day` AS `Mem_day`, coalesce(sum(`sl`.`Quantity`),0) AS `Total_Stamps` FROM ((`Member` `m` left join `Sales` `s` on((`m`.`Mem_id` = `s`.`Mem_id`))) left join `SalesList` `sl` on((`s`.`Sales_id` = `sl`.`Sales_id`))) GROUP BY `m`.`Mem_id`, `m`.`Mem_fname`, `m`.`Mem_lname`, `m`.`Mem_tel`, `m`.`Mem_address`, `m`.`Mem_day` ;

-- --------------------------------------------------------

--
-- Structure for view `Product_DATA`
--
DROP TABLE IF EXISTS `Product_DATA`;

CREATE ALGORITHM=UNDEFINED DEFINER=`std660101`@`localhost` SQL SECURITY DEFINER VIEW `Product_DATA`  AS SELECT `Product`.`Product_id` AS `Product_id`, `Product`.`Product_name` AS `Product_name`, `Product`.`Category_id` AS `Category_id`, `Product`.`Product_price` AS `Product_price`, `Product`.`Product_status` AS `Product_status`, `Product`.`Product_picture` AS `Product_picture`, `ProductCategory`.`Category_name` AS `Category_name`, `ProductCategory`.`Category_Description` AS `Category_Description`, left(`Product`.`Product_name`,10) AS `New_name` FROM (`Product` join `ProductCategory` on((`Product`.`Category_id` = `ProductCategory`.`Category_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `Promotionlist`
--
DROP TABLE IF EXISTS `Promotionlist`;

CREATE ALGORITHM=UNDEFINED DEFINER=`std660101`@`localhost` SQL SECURITY DEFINER VIEW `Promotionlist`  AS SELECT `Promotion`.`Pmo_id` AS `Pmo_id`, `Promotion`.`Pmo_name` AS `Pmo_name`, `Promotion`.`Pmo_Description` AS `Pmo_Description`, `Promotion`.`Pmo_startdate` AS `Pmo_startdate`, `Promotion`.`Pmo_Enddate` AS `Pmo_Enddate`, `Promotion`.`Pmo_condition` AS `Pmo_condition`, `Promotion`.`Pmo_discount` AS `Pmo_discount`, (to_days(`Promotion`.`Pmo_Enddate`) - to_days(curdate())) AS `DATEDIFF(``Pmo_Enddate``, CURDATE())` FROM `Promotion` WHERE ((to_days(`Promotion`.`Pmo_Enddate`) - to_days(curdate())) >= 0) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `DetailTTJ_T_BAR`
--
ALTER TABLE `DetailTTJ_T_BAR`
  ADD PRIMARY KEY (`Detail_id`);

--
-- Indexes for table `Employee`
--
ALTER TABLE `Employee`
  ADD PRIMARY KEY (`Emp_id`);

--
-- Indexes for table `Member`
--
ALTER TABLE `Member`
  ADD PRIMARY KEY (`Mem_id`);

--
-- Indexes for table `Product`
--
ALTER TABLE `Product`
  ADD PRIMARY KEY (`Product_id`),
  ADD KEY `Category_id` (`Category_id`);

--
-- Indexes for table `ProductCategory`
--
ALTER TABLE `ProductCategory`
  ADD PRIMARY KEY (`Category_id`);

--
-- Indexes for table `Promotion`
--
ALTER TABLE `Promotion`
  ADD PRIMARY KEY (`Pmo_id`);

--
-- Indexes for table `Sales`
--
ALTER TABLE `Sales`
  ADD PRIMARY KEY (`Sales_id`),
  ADD KEY `index_emp_id` (`Emp_id`);

--
-- Indexes for table `SalesList`
--
ALTER TABLE `SalesList`
  ADD PRIMARY KEY (`SalesList_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `SalesList`
--
ALTER TABLE `SalesList`
  MODIFY `SalesList_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=282;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Product`
--
ALTER TABLE `Product`
  ADD CONSTRAINT `Product_ibfk_1` FOREIGN KEY (`Category_id`) REFERENCES `ProductCategory` (`Category_id`);

--
-- Constraints for table `Sales`
--
ALTER TABLE `Sales`
  ADD CONSTRAINT `index_emp_id` FOREIGN KEY (`Emp_id`) REFERENCES `Employee` (`Emp_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
