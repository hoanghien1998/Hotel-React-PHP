-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 03, 2021 lúc 04:39 AM
-- Phiên bản máy phục vụ: 10.4.11-MariaDB
-- Phiên bản PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `qlkhachsan`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1),
(2, 'tieptan', 'd30bccbcb15f0a1643c0ce3c65f5f718', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bookroom`
--

CREATE TABLE `bookroom` (
  `id` int(11) NOT NULL,
  `cus_code` int(11) NOT NULL,
  `total` float NOT NULL,
  `state` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `bookroom`
--

INSERT INTO `bookroom` (`id`, `cus_code`, `total`, `state`) VALUES
(1, 1, 366500, '0');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bookservice`
--

CREATE TABLE `bookservice` (
  `id` int(11) NOT NULL,
  `cus_code` int(11) NOT NULL,
  `total` float NOT NULL,
  `state` varchar(20) COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `id_roomtype` int(11) NOT NULL,
  `number_room` int(11) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `number_adults` int(11) NOT NULL,
  `number_childrens` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`id_roomtype`, `number_room`, `check_in`, `check_out`, `number_adults`, `number_childrens`) VALUES
(1, 1, '2021-01-08', '2021-01-08', 1, 1),
(2, 1, '2021-01-08', '2021-01-08', 1, 1),
(3, 1, '2021-01-08', '2021-01-08', 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer`
--

CREATE TABLE `customer` (
  `cus_code` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cmnd` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `customer`
--

INSERT INTO `customer` (`cus_code`, `name`, `phone`, `address`, `cmnd`, `email`, `password`, `state`) VALUES
(1, 'Nguyễn Hùng Vĩ', '0977503349', '2/16A đường 385 Tăng Nhơn Phú A Quận 9 Tp.HCM', '251090192', 'thaongoc0123456@gmail.com', '', '0');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `detailbook`
--

CREATE TABLE `detailbook` (
  `id` int(11) NOT NULL,
  `booking_code` int(11) NOT NULL,
  `room_type_id` int(11) NOT NULL,
  `price` float NOT NULL,
  `number_room` int(11) NOT NULL,
  `number_adults` int(11) NOT NULL,
  `number_childrens` int(11) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `date_set` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `detailbook`
--

INSERT INTO `detailbook` (`id`, `booking_code`, `room_type_id`, `price`, `number_room`, `number_adults`, `number_childrens`, `check_in`, `check_out`, `date_set`) VALUES
(1, 1, 1, 2500, 1, 2, 2, '2021-01-08', '2021-01-08', '2021-01-08'),
(2, 1, 2, 4000, 1, 2, 2, '2021-01-08', '2021-01-08', '2021-01-08');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `detailbook_room`
--

CREATE TABLE `detailbook_room` (
  `id` int(11) NOT NULL,
  `detail_book_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `detailbook_room`
--

INSERT INTO `detailbook_room` (`id`, `detail_book_id`, `room_id`) VALUES
(1, 1, 4),
(2, 2, 8);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `detail_bookservice`
--

CREATE TABLE `detail_bookservice` (
  `id` int(11) NOT NULL,
  `bookCodeService` int(11) NOT NULL,
  `serviceTypeCode` int(11) NOT NULL,
  `price` float NOT NULL,
  `numberService` int(11) NOT NULL,
  `checkint` datetime NOT NULL,
  `checkout` datetime NOT NULL,
  `date_set` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `detail_service`
--

CREATE TABLE `detail_service` (
  `id` int(11) NOT NULL,
  `id_detailbookservice` int(11) NOT NULL,
  `id_service` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `detail_surcharge`
--

CREATE TABLE `detail_surcharge` (
  `id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `booking_code` int(11) NOT NULL,
  `number` int(100) NOT NULL,
  `price` float NOT NULL,
  `sum_money` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `detail_surcharge`
--

INSERT INTO `detail_surcharge` (`id`, `id_product`, `booking_code`, `number`, `price`, `sum_money`) VALUES
(1, 1, 1, 3, 120000, 360000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name_product` varchar(255) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `price` float NOT NULL,
  `number` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `name_product`, `price`, `number`) VALUES
(1, 'Giờ ở thêm', 120000, 999),
(3, 'Bim bim', 6000, 100);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `room`
--

CREATE TABLE `room` (
  `id` int(11) NOT NULL,
  `roomNumber` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `typeCode` int(11) NOT NULL,
  `state` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `room`
--

INSERT INTO `room` (`id`, `roomNumber`, `typeCode`, `state`) VALUES
(1, 'p001', 1, '0'),
(2, 'p002', 1, '0'),
(3, 'p003', 1, '0'),
(4, 'p004', 1, '0'),
(5, 'p005', 1, '0'),
(6, 'L001', 2, '0'),
(7, 'L002', 2, '0'),
(8, 'L003', 2, '0'),
(9, 'L004', 2, '0'),
(10, 'L005', 2, '0'),
(11, 'M001', 3, '0'),
(12, 'M002', 3, '0'),
(13, 'M003', 3, '0'),
(14, 'M004', 3, '0'),
(15, 'M005', 3, '0'),
(16, 'K001', 4, '0'),
(17, 'K002', 4, '0'),
(18, 'K003', 4, '0'),
(19, 'K004', 4, '0'),
(20, 'K005', 4, '0'),
(21, 'S001', 5, '0'),
(22, 'S002', 5, '0'),
(23, 'S003', 5, '0'),
(24, 'S004', 5, '0'),
(25, 'S005', 5, '0'),
(26, 'Q001', 6, '0'),
(27, 'Q002', 6, '0'),
(28, 'Q003', 6, '0'),
(29, 'Q004', 6, '0'),
(30, 'Q005', 6, '0');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roomdetail_img`
--

CREATE TABLE `roomdetail_img` (
  `id` int(11) NOT NULL,
  `room_type_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roomtype`
--

CREATE TABLE `roomtype` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` float NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `roomtype`
--

INSERT INTO `roomtype` (`id`, `name`, `price`, `image`) VALUES
(1, 'Suite Gia đình với Sân hiên', 2500, 'room-1.jpg'),
(2, 'Suite Gia Đình Thương Gia', 4000, 'room-2.jpg'),
(3, 'Suite Executive gia đình', 3500, 'room-3.jpg'),
(4, 'Phòng đơn view hướng biển', 800, 'room-4.jpg'),
(5, 'Phòng đơn thường', 500, 'room-5.jpg'),
(6, 'Phòng đôi view biển', 1200, 'room-6.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `room_type_detail`
--

CREATE TABLE `room_type_detail` (
  `id` int(11) NOT NULL,
  `room_type_id` int(11) NOT NULL,
  `dientich` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `huongphong` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `giuong` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `room_type_detail`
--

INSERT INTO `room_type_detail` (`id`, `room_type_id`, `dientich`, `huongphong`, `giuong`) VALUES
(1, 1, '110 m²', 'Ban công hướng ra biển', '2'),
(2, 2, '130 m²', 'Ban công hướng ra bãi trước của biển', '3 giường đôi, 2 giường đơn'),
(3, 3, '90 m²', 'Ban công hướng hồ bơi, của phòng hướng ra ngọn hải đăng đảo', '2 giường đôi, 2 giường đơn'),
(4, 4, '45 m²', 'Ban công hướng ra biển', ' 2 giường đơn'),
(5, 5, '35 m²', 'Ban công hướng ra hồ bơi resort', '1 giường đơn'),
(6, 6, '55 m²', 'Ban công hướng ra bãi trước của biển', '2 giường đôi');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `numberService` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `typeServiceCode` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `state` varchar(20) COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `service`
--

INSERT INTO `service` (`id`, `numberService`, `typeServiceCode`, `description`, `state`) VALUES
(1, 'm001', 1, '', '0'),
(2, 'm002', 1, '', '0'),
(3, 'm003', 1, '', '0'),
(4, 'm004', 1, '', '0'),
(5, 'm005', 1, '', '0'),
(6, 'm006', 2, '', '0'),
(7, 'm007', 2, '', '0'),
(8, 'm008', 2, '', '0'),
(9, 'm009', 2, '', '0'),
(10, 'm010', 2, '', '0'),
(11, 'front garden', 3, '', '0'),
(12, 'backyard', 4, '', '0');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `servicetype`
--

CREATE TABLE `servicetype` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `price` float NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `servicetype`
--

INSERT INTO `servicetype` (`id`, `name`, `price`, `image`) VALUES
(1, 'Meeting Room small', 250000, ''),
(2, 'Meeting Room big', 500000, ''),
(3, 'Event beach front yard', 2000000, ''),
(4, 'Event yards backyard', 2000000, '');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `bookroom`
--
ALTER TABLE `bookroom`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cat` (`cus_code`);

--
-- Chỉ mục cho bảng `bookservice`
--
ALTER TABLE `bookservice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cus_code` (`cus_code`);

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id_roomtype`);

--
-- Chỉ mục cho bảng `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cus_code`);

--
-- Chỉ mục cho bảng `detailbook`
--
ALTER TABLE `detailbook`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_code` (`booking_code`),
  ADD KEY `room_type_id` (`room_type_id`);

--
-- Chỉ mục cho bảng `detailbook_room`
--
ALTER TABLE `detailbook_room`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_book_id` (`detail_book_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Chỉ mục cho bảng `detail_bookservice`
--
ALTER TABLE `detail_bookservice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookCodeService` (`bookCodeService`),
  ADD KEY `serviceTypeCode` (`serviceTypeCode`);

--
-- Chỉ mục cho bảng `detail_service`
--
ALTER TABLE `detail_service`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_detailbookservice` (`id_detailbookservice`),
  ADD KEY `id_service` (`id_service`);

--
-- Chỉ mục cho bảng `detail_surcharge`
--
ALTER TABLE `detail_surcharge`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_product` (`id_product`),
  ADD KEY `booking_code` (`booking_code`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_room` (`typeCode`);

--
-- Chỉ mục cho bảng `roomdetail_img`
--
ALTER TABLE `roomdetail_img`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_code` (`room_type_id`);

--
-- Chỉ mục cho bảng `roomtype`
--
ALTER TABLE `roomtype`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `room_type_detail`
--
ALTER TABLE `room_type_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_type_id` (`room_type_id`);

--
-- Chỉ mục cho bảng `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`),
  ADD KEY `typeServiceCode` (`typeServiceCode`);

--
-- Chỉ mục cho bảng `servicetype`
--
ALTER TABLE `servicetype`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `bookroom`
--
ALTER TABLE `bookroom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `bookservice`
--
ALTER TABLE `bookservice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `customer`
--
ALTER TABLE `customer`
  MODIFY `cus_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `detailbook`
--
ALTER TABLE `detailbook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `detailbook_room`
--
ALTER TABLE `detailbook_room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `detail_bookservice`
--
ALTER TABLE `detail_bookservice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `detail_service`
--
ALTER TABLE `detail_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `detail_surcharge`
--
ALTER TABLE `detail_surcharge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `room`
--
ALTER TABLE `room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT cho bảng `roomdetail_img`
--
ALTER TABLE `roomdetail_img`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `roomtype`
--
ALTER TABLE `roomtype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `room_type_detail`
--
ALTER TABLE `room_type_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `servicetype`
--
ALTER TABLE `servicetype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `bookroom`
--
ALTER TABLE `bookroom`
  ADD CONSTRAINT `fk_cat` FOREIGN KEY (`cus_code`) REFERENCES `customer` (`cus_code`);

--
-- Các ràng buộc cho bảng `bookservice`
--
ALTER TABLE `bookservice`
  ADD CONSTRAINT `bookservice_ibfk_1` FOREIGN KEY (`cus_code`) REFERENCES `customer` (`cus_code`);

--
-- Các ràng buộc cho bảng `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`id_roomtype`) REFERENCES `roomtype` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `detailbook`
--
ALTER TABLE `detailbook`
  ADD CONSTRAINT `detailbook_ibfk_1` FOREIGN KEY (`booking_code`) REFERENCES `bookroom` (`id`),
  ADD CONSTRAINT `detailbook_ibfk_2` FOREIGN KEY (`room_type_id`) REFERENCES `roomtype` (`id`);

--
-- Các ràng buộc cho bảng `detailbook_room`
--
ALTER TABLE `detailbook_room`
  ADD CONSTRAINT `detailbook_room_ibfk_2` FOREIGN KEY (`detail_book_id`) REFERENCES `detailbook` (`id`),
  ADD CONSTRAINT `detailbook_room_ibfk_3` FOREIGN KEY (`room_id`) REFERENCES `room` (`id`);

--
-- Các ràng buộc cho bảng `detail_bookservice`
--
ALTER TABLE `detail_bookservice`
  ADD CONSTRAINT `detail_bookservice_ibfk_1` FOREIGN KEY (`bookCodeService`) REFERENCES `bookservice` (`id`),
  ADD CONSTRAINT `detail_bookservice_ibfk_2` FOREIGN KEY (`serviceTypeCode`) REFERENCES `servicetype` (`id`);

--
-- Các ràng buộc cho bảng `detail_service`
--
ALTER TABLE `detail_service`
  ADD CONSTRAINT `detail_service_ibfk_1` FOREIGN KEY (`id_detailbookservice`) REFERENCES `detail_bookservice` (`id`),
  ADD CONSTRAINT `detail_service_ibfk_2` FOREIGN KEY (`id_service`) REFERENCES `service` (`id`);

--
-- Các ràng buộc cho bảng `detail_surcharge`
--
ALTER TABLE `detail_surcharge`
  ADD CONSTRAINT `detail_surcharge_ibfk_1` FOREIGN KEY (`booking_code`) REFERENCES `bookroom` (`id`),
  ADD CONSTRAINT `detail_surcharge_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`);

--
-- Các ràng buộc cho bảng `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `room_ibfk_1` FOREIGN KEY (`typeCode`) REFERENCES `roomtype` (`id`);

--
-- Các ràng buộc cho bảng `roomdetail_img`
--
ALTER TABLE `roomdetail_img`
  ADD CONSTRAINT `roomdetail_img_ibfk_1` FOREIGN KEY (`room_type_id`) REFERENCES `roomtype` (`id`);

--
-- Các ràng buộc cho bảng `room_type_detail`
--
ALTER TABLE `room_type_detail`
  ADD CONSTRAINT `room_type_detail_ibfk_1` FOREIGN KEY (`room_type_id`) REFERENCES `roomtype` (`id`);

--
-- Các ràng buộc cho bảng `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `service_ibfk_1` FOREIGN KEY (`typeServiceCode`) REFERENCES `servicetype` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
