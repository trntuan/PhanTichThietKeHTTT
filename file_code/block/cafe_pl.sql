-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 14, 2022 lúc 05:47 PM
-- Phiên bản máy phục vụ: 10.4.24-MariaDB
-- Phiên bản PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `cafe_pl`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chucvu`
--

CREATE TABLE `chucvu` (
  `MaCV` int(3) NOT NULL,
  `TenCV` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chucvu`
--

INSERT INTO `chucvu` (`MaCV`, `TenCV`) VALUES
(1, 'quản lý'),
(2, 'giao hàng'),
(3, 'pha chế');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ctgiohang`
--

CREATE TABLE `ctgiohang` (
  `IdGio` int(5) NOT NULL,
  `IdSanPham` int(5) NOT NULL,
  `SoLuong` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `ctgiohang`
--

INSERT INTO `ctgiohang` (`IdGio`, `IdSanPham`, `SoLuong`) VALUES
(1, 5, 8),
(1, 11, 5),
(1, 12, 15),
(1, 15, 8),
(1, 16, 5),
(1, 18, 7),
(1, 24, 4),
(2, 8, 5),
(2, 10, 5),
(2, 11, 11),
(2, 19, 2),
(2, 21, 3),
(3, 2, 1),
(3, 3, 2),
(3, 7, 1),
(3, 18, 2),
(3, 24, 10),
(4, 1, 2),
(4, 17, 4),
(4, 25, 8),
(4, 26, 5),
(5, 5, 9),
(5, 11, 6),
(5, 13, 2),
(5, 20, 8),
(5, 22, 5),
(5, 26, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cthoadon`
--

CREATE TABLE `cthoadon` (
  `IdHoaDon` int(5) NOT NULL,
  `MaSP` int(5) NOT NULL,
  `SoLuong` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cthoadon`
--

INSERT INTO `cthoadon` (`IdHoaDon`, `MaSP`, `SoLuong`) VALUES
(1, 8, 1),
(1, 10, 1),
(1, 21, 2),
(2, 11, 4),
(3, 5, 1),
(3, 11, 2),
(3, 20, 1),
(4, 5, 1),
(5, 2, 1),
(5, 7, 1),
(6, 18, 1),
(6, 24, 2),
(7, 12, 2),
(8, 11, 5),
(9, 1, 2),
(9, 17, 1),
(9, 26, 4),
(10, 25, 6),
(11, 5, 2),
(11, 7, 2),
(12, 3, 1),
(12, 19, 6),
(13, 2, 3),
(14, 3, 3),
(15, 26, 2),
(16, 5, 4),
(17, 6, 1),
(17, 12, 6),
(18, 13, 3),
(18, 21, 5),
(19, 11, 5),
(19, 17, 3),
(20, 24, 4),
(21, 9, 1),
(22, 14, 3),
(23, 25, 1),
(24, 20, 6),
(25, 1, 3),
(26, 23, 3),
(27, 26, 1),
(28, 5, 2),
(29, 15, 1),
(30, 26, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `diachi`
--

CREATE TABLE `diachi` (
  `IDKhachHang` int(5) NOT NULL,
  `DiaChi` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `diachi`
--

INSERT INTO `diachi` (`IDKhachHang`, `DiaChi`) VALUES
(1, '7 Phan Phù Tiên, Vĩnh Hải, Nha Trang, Khánh Hòa'),
(2, '03 Lê Thánh Tôn, Lộc Thọ, Nha Trang, Khánh Hòa'),
(3, '40 Lê Quý Đôn, Tân Lập, Nha Trang, Khánh Hòa'),
(4, '29 Nguyễn Thị Minh Khai, Phước Hòa, Nha Trang, Khánh Hòa'),
(5, '20 Ngô Gia Tự, Tân Lập, Nha Trang, Khánh Hòa');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giohang`
--

CREATE TABLE `giohang` (
  `IdGio` int(5) NOT NULL,
  `IdKH` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `giohang`
--

INSERT INTO `giohang` (`IdGio`, `IdKH`) VALUES
(1, 2),
(2, 1),
(3, 3),
(4, 4),
(5, 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoadon`
--

CREATE TABLE `hoadon` (
  `IdHoaDon` int(5) NOT NULL,
  `IdKhachHang` int(5) NOT NULL,
  `IdNV` int(5) NOT NULL,
  `TrangThai` int(5) NOT NULL,
  `NgayDat` date NOT NULL,
  `GioDat` time NOT NULL,
  `TongTien` int(17) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hoadon`
--

INSERT INTO `hoadon` (`IdHoaDon`, `IdKhachHang`, `IdNV`, `TrangThai`, `NgayDat`, `GioDat`, `TongTien`) VALUES
(1, 1, 3, 1, '2020-02-23', '11:09:48', 799000),
(2, 1, 2, 5, '2021-02-25', '11:09:48', 299000),
(3, 5, 4, 2, '2021-06-30', '07:09:20', 398000),
(4, 5, 4, 4, '2021-06-30', '10:09:20', 298000),
(5, 3, 5, 1, '2021-10-02', '14:35:48', 208000),
(6, 3, 2, 5, '2021-10-10', '14:35:48', 220000),
(7, 2, 3, 2, '2022-02-12', '08:09:03', 241000),
(8, 2, 4, 6, '2022-03-10', '07:30:50', 201000),
(9, 4, 3, 3, '2022-05-10', '15:03:04', 215000),
(10, 4, 2, 4, '2022-05-15', '13:03:04', 218000),
(11, 1, 2, 5, '2022-02-16', '10:10:30', 118000),
(12, 2, 4, 4, '2022-02-20', '11:09:20', 117000),
(13, 5, 5, 1, '2022-02-26', '12:09:20', 122000),
(14, 4, 3, 2, '2022-03-10', '13:09:20', 120000),
(15, 5, 2, 5, '2022-03-20', '06:34:08', 420000),
(16, 1, 2, 5, '2022-03-30', '11:09:20', 410000),
(17, 4, 3, 2, '2022-04-10', '10:09:20', 400000),
(18, 1, 4, 5, '2022-04-21', '08:30:20', 409000),
(19, 3, 5, 3, '2022-04-30', '12:09:20', 209000),
(20, 3, 2, 5, '2022-05-30', '14:35:48', 109000),
(21, 1, 2, 6, '2022-06-16', '13:35:48', 129000),
(22, 5, 2, 5, '2022-06-29', '10:30:42', 127000),
(23, 4, 4, 5, '2022-07-10', '08:10:03', 107000),
(24, 5, 2, 4, '2022-07-30', '15:03:04', 227000),
(25, 1, 5, 1, '2022-08-12', '20:03:04', 827000),
(26, 3, 4, 5, '2022-08-30', '21:03:04', 590000),
(27, 2, 2, 5, '2022-09-04', '16:03:04', 420000),
(28, 4, 4, 5, '2022-10-20', '08:30:20', 240000),
(29, 2, 3, 1, '2022-10-20', '07:09:20', 540000),
(30, 1, 4, 5, '2022-10-20', '13:09:20', 102000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

CREATE TABLE `khachhang` (
  `idKH` int(5) NOT NULL,
  `TenKH` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `HoKH` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Sdt` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `GioiTinh` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DiaChi` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `anh` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`idKH`, `TenKH`, `HoKH`, `Sdt`, `GioiTinh`, `DiaChi`, `anh`) VALUES
(1, 'Quang Chí', 'Lê', '0928118234', 'nam', '7 Phan Phù Tiên, Vĩnh Hải, Nha Trang, Khánh Hòa', 'chi.jpg'),
(2, 'Trung Kiên', 'Ngô', '0928918421', 'nam', '03 Lê Thánh Tôn, Lộc Thọ, Nha Trang, Khánh Hòa', 'kien.jpg'),
(3, 'Vũ Duy Hưng', 'Nguyễn', '0321918234', 'nam', '40 Lê Quý Đôn, Tân Lập, Nha Trang, Khánh Hòa', 'hung.jpg'),
(4, 'Minh Đức', 'Phạm', '0923213234', 'nam', '29 Nguyễn Thị Minh Khai, Phước Hòa, Nha Trang, Khánh Hoà', 'duc.jpg'),
(5, 'Hoàng Kha', 'Hồ', '0928918234', 'nam', '20 Ngô Gia Tự, Tân Lập, Nha Trang, Khánh Hòa', 'kha.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaisp`
--

CREATE TABLE `loaisp` (
  `MaLoai` int(5) NOT NULL,
  `TenLoai` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `loaisp`
--

INSERT INTO `loaisp` (`MaLoai`, `TenLoai`) VALUES
(1, 'trà'),
(2, 'cà phê'),
(3, 'nước ép'),
(4, 'sữa chua');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhanvien`
--

CREATE TABLE `nhanvien` (
  `IdNV` int(5) NOT NULL,
  `TenNV` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `HoNV` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Sdt` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `GioTinh` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NgaySinh` date NOT NULL,
  `IdChuVu` int(3) NOT NULL,
  `anh` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhanvien`
--

INSERT INTO `nhanvien` (`IdNV`, `TenNV`, `HoNV`, `Sdt`, `GioTinh`, `NgaySinh`, `IdChuVu`, `anh`) VALUES
(1, 'Ngọc Tuấn', 'Trương', '0344705573', 'nam', '2002-05-26', 1, 'tuan.jpg'),
(2, 'Sanh Quốc Huy', 'Nguyễn', '0849281739', 'nam', '2002-03-12', 2, 'huy.jpg'),
(3, 'Tuấn Kiệt', 'Nguyễn', '0938198273', 'nam', '2002-05-22', 3, 'kiet.jpg'),
(4, 'Văn Hải', 'Đặng', '0938271908', 'nam', '2002-05-24', 2, 'hai.jpg'),
(5, 'Minh Tiến', 'Phan', '0927389123', 'nam', '2002-01-22', 3, 'tien.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `IDSP` int(5) NOT NULL,
  `Ten` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Gia` int(11) NOT NULL,
  `LoaiSP` int(5) NOT NULL,
  `MoTa` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hinh` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`IDSP`, `Ten`, `Gia`, `LoaiSP`, `MoTa`, `size`, `hinh`) VALUES
(1, 'Cà Phê Vanilla', 78000, 2, 'Cà phê Vanilla là sự kết hợp giữa cà phê robusta và hương vani pháp, hương vani được kết hợp vào làm bật thêm hương và vị của cà phê, cà phê vani mang lại cho người dùng sự dịu nhẹ ấm áp tâm hồn.', 'Vừa', 'capheVanilla.png'),
(2, 'Cà Phê Rich', 110000, 2, 'Cà phê Rich có hương vị đậm đà, sâu lắng, thỏa mãn nhu cầu tinh tế của người thưởng thức.', 'Lớn', 'capheRich.png'),
(3, 'Cà Phê Smooth', 100000, 2, ' Cà phê Smooth là sự kết hợp giữa hai dòng Moka và Culi cùng hương Hazelnut mang lại dư vị mới mẻ đánh thức mọi giác quan.', 'vừa', 'capheSmooth.png'),
(4, 'Cà Phê Caramel', 75000, 2, 'Cà phê Caramel là sự kết hợp giữa Robusta cùng hương Caramel, có vị thơm ngọt béo đặc trưng của Caramel mang lạ dư vị dễ chịu và khoan khoái khi thưởng thức.', 'Lớn', 'capheCaramel.png'),
(5, 'Cà Phê Capuccino', 75000, 2, ' Cà phê Cappuccino là sự kết hợp giữa 2 dòng Moka và Robusta cùng hương Cappuccino tạo nên sản phẩm có hương thơm và vị béo đặc trưng.', 'Vừa', 'capheCapuchino.png'),
(6, 'Cà Phê Robusta - Culi', 135000, 2, 'Cà phê Robusta kết hợp cùng Culi cho vị ngon đậm đà thượng hạng mà vẫn thanh thoát đầy lôi cuốn.', 'Lớn', 'capheRobusta.png'),
(7, 'Cà Phê Royal Có Bơ', 75000, 2, 'Cà phê Royal được sản xuất từ những hạt cà phê được tuyển chọn kĩ càng và sản xuất theo dây chuyền công nghệ hiện đại và bí quyết riêng không thể sao chép cho hương thơm nhẹ nhàng quyến rũ. Bột cà phê không xay nhuyễn để khi pha giữ được vị ngon đậm đà thượng hạng mà vẫn thanh thoát đầy lôi cuốn.', 'Vừa', 'capheRoyalcobo.jpg'),
(8, 'Cà Phê Hazelnut', 75000, 2, 'Cà phê Hazelnut là sự kết hợp giữa cà phê Robusta và hương hạt hazelnut tạo nên sự thoải mái, êm dịu và hài hòa khi thưởng thức, là một lựa chọn tuyệt hảo để khởi đầu một ngày mới.', 'Vừa', 'capheHazelnut.png'),
(9, 'Trà Sữa Bery Bery', 60000, 1, 'Trà Sữa Berry Berry - Vị trà sữa Ô Long beo béo, đậm vị trà, hương dâu nồng nàn kết hợp với topping đác dâu dẻo mềm lần đầu ra mắt, mang đến cho bạn một mùa đông ngọt ngào.', 'Vừa', 'trasuaberryberry.png'),
(10, 'Trà Lài Đác Thơm', 50000, 1, 'Trà Lài Đác Thơm với vị chua thanh của thơm, ngọt nhẹ của trà lài và hạt đác dai giòn sần sật.', 'Vừa', 'tralaidacthom.png'),
(11, 'Trà Nhãn - Sen', 50000, 1, 'Trà thơm hương sen, cùi nhãn giòn ngọt, không chỉ là thức uống ngon trong ngày oi nóng mà còn hợp với tiết trời hanh hao.', 'Lớn', 'tranhan_sen.png'),
(12, 'Trà Ô Long Mãng Cầu', 54000, 1, 'Trà Ô Long thanh mát, đậm đà lan toả trên đầu lưỡi, Mứt Mãng Cầu sên chua ngọt dẻo sánh cùng Thạch Nha Đam tươi giòn vui miệng.', 'Lớn', 'traolongmangcau.png'),
(13, 'Hồng Trà Đác Cam', 70000, 1, 'Hồng trà Đác cam với vị cam tươi nguyên hòa quyện cùng hồng trà, kết hợp với topping đác dẻo giòn, vỏ cam the mát.', 'Lớn', 'hongtradaccam.png'),
(14, 'Trà Đào', 50000, 1, 'Trà đào là thức uống của ngày hè và khá được yêu thích bởi giới trẻ nước ta hiện nay. Những ly trà đào thường mang mùi vị vô cùng thanh mát, dịu nhẹ, mang đậm đặc điểm của đào rất phù hợp để giải khát vào ngày hè.', 'Vừa', 'tradao.png'),
(15, 'Trà Đào Đá Xay', 65000, 1, 'Trà đào đá xay vừa mang hương vị chua chua tươi mát của đào, vừa có mùi hương quyến rũ của trà đen, lại còn kết hợp với lớp kem khó cưỡng ở phía trên nữa. Đảm bảo thức uống này sẽ là người bạn tuyệt vời của bạn trong những ngày nắng nóng như hiện nay đấy.', 'Vừa', 'tradaodaxay.png'),
(16, 'Trà Hoa Hồng', 50000, 1, 'Trà hoa hồng là loại trà được làm từ cánh và nụ của hoa hồng. Có 2 loại chính là trà hoa hồng tươi và trà hoa hồng sấy khô.', 'vừa', 'trahoahong.png'),
(17, 'Trà Ô Long Dâu', 55000, 1, 'Sự kết hợp độc đáo giữa hương vị đậm đà của nước cốt trà Ôlong, vị dâu tây chín chua chua ngòn ngọt thanh mát đã cho ra một ly nước uống thanh mát giải nhiệt tốt cho sức khỏe.', 'Lớn', 'traolongdau.png'),
(18, 'Hồng Trà Chanh', 45000, 1, 'Hồng trà chanh là một thức uống rất được ưa thích, nhất là trong những ngày nóng bức. Vị trà đậm đà nồng nàn, hòa quyện với vị chanh chua chua tươi mát, thêm một chút vị ngọt thanh nhẹ, mang đến một đồ uống giải nhiệt tức thì.', 'Lớn', 'hongtrachanh.png'),
(19, 'Cam Ép', 45000, 3, 'Nước cam ép là một loại thức uống phổ biến được làm từ cam bằng cách chiết xuất nước từ trái cam tươi bằng việc vắt hay ép thành một loại nước cam tươi.', 'Vừa', 'camep.png'),
(20, 'Dâu Ép', 55000, 3, 'Dâu tây là một loại quả mọng nước có chứa nhiều vitamin C, axit folic, chất xơ và kali. Uống nước ép dâu tây thường xuyên không chỉ giúp bạn làm đẹp da mà còn giúp làm giảm nguy cơ mắc bệnh tim, tiểu đường và ung thư', 'vừa', 'dauep.png'),
(21, 'Dứa Ép', 45000, 3, 'Nước dứa ép bổ sung cho cơ thể vì loại nước ép này ngoài tác dụng giải nhiệt, nó còn có lượng vi chất dồi dào, cần thiết cho cơ thể.', 'Vừa', 'duaep.png'),
(22, 'Táo Ép', 45000, 3, 'Nước ép táo là một trong những loại thức uống được rất nhiều người ưa chuộng. Không chỉ sở hữu hương vị hấp dẫn, loại đồ uống này còn rất bổ dưỡng khi chứa nhiều vitamin tốt cho sức khỏe.', 'Vừa', 'taoep.png'),
(23, 'Táo Và Dâu Ép', 50000, 3, 'Táo và dâu kết hợp tạo nên hương vị tuyệt vời vừa xua tan những ngày hè nóng bức vừa bổ sung dinh dưỡng cho cơ thể.', 'Vừa', 'taovadauep.jpg'),
(24, 'Thơm Và Dâu Ép', 50000, 3, 'Thơm và dâu kết hợp tạo nên hương vị tuyệt vời vừa tạo cho bạn một cảm giác mới lạ, vừa bổ sung dinh dưỡng cho cơ thể.', 'Vừa', 'thomvadauep.png'),
(25, 'Sữa Chua Phúc Bồn Tử Đác Cam', 70000, 4, 'Sữa Chua Phúc Bồn Tử Đác Cam: vị chua nhẹ nhàng của trái Phúc Bồn Tử hòa quyện cùng sữa chua Phúc Long mềm mịn với topping Đác Cam giòn dai thú vị.', 'Vừa', 'suachuaphucbontudaccam.png'),
(26, 'Sữa Chua Xoài Đác Thơm', 70000, 4, 'Sữa Chua Xoài Đác Thơm: vị chua thanh ngọt của Xoài Cát hòa quyện cùng sữa chua Phúc Long mềm mịn được tô điểm bằng topping Đác Thơm đậm đà.', 'vừa', 'suachuaxoaidacthom.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoankh`
--

CREATE TABLE `taikhoankh` (
  `IdKH` int(5) NOT NULL,
  `Email` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `taikhoankh`
--

INSERT INTO `taikhoankh` (`IdKH`, `Email`, `password`) VALUES
(1, 'chi@gmail.com', '12345'),
(2, 'kien@gmail.com', '12345'),
(3, 'hung@gmail.com', '12345'),
(4, 'duc@gmail.com', '12345'),
(5, 'kha@gmail.com', '12345');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoannv`
--

CREATE TABLE `taikhoannv` (
  `IdNV` int(5) NOT NULL,
  `Email` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `taikhoannv`
--

INSERT INTO `taikhoannv` (`IdNV`, `Email`, `password`) VALUES
(1, 'tuan@gmail.com', '12345'),
(2, 'huy@gmail.com', '12345'),
(3, 'kiet@gmail.com', '12345'),
(4, 'hai@gmail.com', '12345'),
(5, 'tien@gmail.com', '12345');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `trangthai`
--

CREATE TABLE `trangthai` (
  `MaTT` int(5) NOT NULL,
  `TenTT` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `trangthai`
--

INSERT INTO `trangthai` (`MaTT`, `TenTT`) VALUES
(1, 'đang đặt hàng'),
(2, 'đã nhận pha chế'),
(3, 'đã pha chế'),
(4, 'đang vận chuyển'),
(5, 'giao hàng thành công'),
(6, 'giao hàng thất bại');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chucvu`
--
ALTER TABLE `chucvu`
  ADD PRIMARY KEY (`MaCV`);

--
-- Chỉ mục cho bảng `ctgiohang`
--
ALTER TABLE `ctgiohang`
  ADD PRIMARY KEY (`IdGio`,`IdSanPham`),
  ADD KEY `IdSanPham` (`IdSanPham`);

--
-- Chỉ mục cho bảng `cthoadon`
--
ALTER TABLE `cthoadon`
  ADD PRIMARY KEY (`IdHoaDon`,`MaSP`),
  ADD KEY `MaSP` (`MaSP`);

--
-- Chỉ mục cho bảng `diachi`
--
ALTER TABLE `diachi`
  ADD PRIMARY KEY (`IDKhachHang`);

--
-- Chỉ mục cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD PRIMARY KEY (`IdGio`,`IdKH`),
  ADD KEY `IdKH` (`IdKH`);

--
-- Chỉ mục cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`IdHoaDon`),
  ADD KEY `IdKhachHang` (`IdKhachHang`),
  ADD KEY `IdNV` (`IdNV`),
  ADD KEY `TrangThai` (`TrangThai`);

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`idKH`);

--
-- Chỉ mục cho bảng `loaisp`
--
ALTER TABLE `loaisp`
  ADD PRIMARY KEY (`MaLoai`);

--
-- Chỉ mục cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`IdNV`),
  ADD KEY `IdChuVu` (`IdChuVu`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`IDSP`),
  ADD KEY `LoaiSP` (`LoaiSP`);

--
-- Chỉ mục cho bảng `taikhoankh`
--
ALTER TABLE `taikhoankh`
  ADD PRIMARY KEY (`IdKH`,`Email`);

--
-- Chỉ mục cho bảng `taikhoannv`
--
ALTER TABLE `taikhoannv`
  ADD PRIMARY KEY (`IdNV`,`Email`);

--
-- Chỉ mục cho bảng `trangthai`
--
ALTER TABLE `trangthai`
  ADD PRIMARY KEY (`MaTT`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `chucvu`
--
ALTER TABLE `chucvu`
  MODIFY `MaCV` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `giohang`
--
ALTER TABLE `giohang`
  MODIFY `IdGio` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  MODIFY `IdHoaDon` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `idKH` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `loaisp`
--
ALTER TABLE `loaisp`
  MODIFY `MaLoai` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `IdNV` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `IDSP` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT cho bảng `trangthai`
--
ALTER TABLE `trangthai`
  MODIFY `MaTT` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `ctgiohang`
--
ALTER TABLE `ctgiohang`
  ADD CONSTRAINT `ctgiohang_ibfk_1` FOREIGN KEY (`IdGio`) REFERENCES `giohang` (`IdGio`),
  ADD CONSTRAINT `ctgiohang_ibfk_2` FOREIGN KEY (`IdSanPham`) REFERENCES `sanpham` (`IDSP`);

--
-- Các ràng buộc cho bảng `cthoadon`
--
ALTER TABLE `cthoadon`
  ADD CONSTRAINT `cthoadon_ibfk_1` FOREIGN KEY (`IdHoaDon`) REFERENCES `hoadon` (`IdHoaDon`),
  ADD CONSTRAINT `cthoadon_ibfk_2` FOREIGN KEY (`MaSP`) REFERENCES `sanpham` (`IDSP`);

--
-- Các ràng buộc cho bảng `diachi`
--
ALTER TABLE `diachi`
  ADD CONSTRAINT `diachi_ibfk_1` FOREIGN KEY (`IDKhachHang`) REFERENCES `khachhang` (`idKH`);

--
-- Các ràng buộc cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD CONSTRAINT `giohang_ibfk_1` FOREIGN KEY (`IdKH`) REFERENCES `khachhang` (`idKH`);

--
-- Các ràng buộc cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD CONSTRAINT `hoadon_ibfk_1` FOREIGN KEY (`IdKhachHang`) REFERENCES `khachhang` (`idKH`),
  ADD CONSTRAINT `hoadon_ibfk_2` FOREIGN KEY (`IdNV`) REFERENCES `nhanvien` (`IdNV`),
  ADD CONSTRAINT `hoadon_ibfk_3` FOREIGN KEY (`TrangThai`) REFERENCES `trangthai` (`MaTT`);

--
-- Các ràng buộc cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD CONSTRAINT `nhanvien_ibfk_1` FOREIGN KEY (`IdChuVu`) REFERENCES `chucvu` (`MaCV`);

--
-- Các ràng buộc cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `sanpham_ibfk_1` FOREIGN KEY (`LoaiSP`) REFERENCES `loaisp` (`MaLoai`);

--
-- Các ràng buộc cho bảng `taikhoankh`
--
ALTER TABLE `taikhoankh`
  ADD CONSTRAINT `taikhoankh_ibfk_1` FOREIGN KEY (`IdKH`) REFERENCES `khachhang` (`idKH`);

--
-- Các ràng buộc cho bảng `taikhoannv`
--
ALTER TABLE `taikhoannv`
  ADD CONSTRAINT `taikhoannv_ibfk_1` FOREIGN KEY (`IdNV`) REFERENCES `nhanvien` (`IdNV`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
