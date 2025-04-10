-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 07, 2025 lúc 03:34 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `fashionshop`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `brands`
--

INSERT INTO `brands` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Adidas', NULL, NULL),
(2, 'Puma', NULL, NULL),
(3, 'Nike', NULL, NULL),
(4, 'Việt Tiến', NULL, NULL),
(5, 'Yame', NULL, NULL),
(6, 'Canifa', NULL, NULL),
(7, 'DGU', NULL, NULL),
(8, 'ONOFF', NULL, NULL),
(9, 'Thomas Nguyen', NULL, NULL),
(10, 'Routine', NULL, NULL),
(11, 'Noel', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Áo sơ mi', NULL, NULL),
(2, 'Quần jean', NULL, NULL),
(3, 'Áo phông', NULL, NULL),
(4, 'Giày', NULL, NULL),
(5, 'Váy', NULL, NULL),
(6, 'Đồ bộ', NULL, NULL),
(7, 'Áo ấm', NULL, NULL),
(8, 'Quần short', NULL, NULL),
(9, 'Tất', NULL, NULL),
(10, 'Cà vạt', NULL, NULL),
(11, 'Kẹp cà vạt', NULL, NULL),
(12, 'Phụ kiện', NULL, NULL),
(13, 'Đồ lót', '2025-04-07 13:25:10', '2025-04-07 13:25:10');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0000_01_01_000000_create_roles_table', 1),
(2, '0001_01_01_000000_create_users_table', 1),
(3, '0001_01_01_000001_create_cache_table', 1),
(4, '0001_01_01_000002_create_jobs_table', 1),
(5, '2025_03_27_074115_create_categories_table', 1),
(6, '2025_03_27_081445_create_brands_table', 1),
(7, '2025_03_27_081446_create_products_table', 1),
(8, '2025_03_27_082933_create_orders_table', 1),
(9, '2025_03_27_084540_create_order_details_table', 1),
(10, '2025_04_02_132523_create_carts_table', 1),
(11, '2025_04_02_140828_update_orders_table_add_order_date_default', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `total_price` decimal(10,2) NOT NULL,
  `ship_address` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `status` enum('pending','completed','canceled') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_date`, `total_price`, `ship_address`, `notes`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '2025-04-05 11:01:55', 8000.00, 'HCM', 'fdfsf', 'pending', '2025-04-05 11:01:55', '2025-04-05 11:01:55'),
(2, 1, '2025-04-05 11:08:03', 8000.00, 'sgfd', 'dsfsdf', 'pending', '2025-04-05 11:08:03', '2025-04-05 11:08:03'),
(4, 1, '2025-04-05 11:17:54', 7600.00, 'dfsfsd', 'adad', 'completed', '2025-04-05 11:17:54', '2025-04-05 11:19:14'),
(5, 3, '2025-04-05 11:35:50', 7600.00, 'fdsfsdf', 'sdfsdfd', 'pending', '2025-04-05 11:35:50', '2025-04-05 11:35:50'),
(6, 4, '2025-04-06 14:21:22', 312312.00, 'dsfdsfsd', 'fdsfsdf', 'pending', '2025-04-06 14:21:22', '2025-04-06 14:21:22'),
(7, 4, '2025-04-06 14:21:42', 312312.00, 'ddasdasd', 'dsdasd', 'canceled', '2025-04-06 14:21:42', '2025-04-06 14:22:28'),
(8, 4, '2025-04-06 14:28:14', 624624.00, 'dasda', 'dasdasd', 'canceled', '2025-04-06 14:28:14', '2025-04-06 14:28:19');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

CREATE TABLE `order_details` (
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `promotion_price` decimal(10,2) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `seo_title` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `is_hot` tinyint(1) NOT NULL DEFAULT 0,
  `hot_start_date` timestamp NULL DEFAULT NULL,
  `hot_end_date` timestamp NULL DEFAULT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `meta_keyword` varchar(255) DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `promotion_price`, `description`, `image_url`, `category_id`, `status`, `seo_title`, `quantity`, `is_hot`, `hot_start_date`, `hot_end_date`, `brand_id`, `meta_keyword`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(15, '\"White Black\" HP8956', 990000.00, NULL, 'Giày Adidas Breaknet Lifestyle Court Lace', 'https://bizweb.dktcdn.net/100/413/756/products/image-1702894353567.png?v=1730995459190', 4, 1, NULL, 2, 0, NULL, NULL, 1, NULL, 1, '2025-04-07 13:04:45', 1, '2025-04-07 13:29:11'),
(16, 'ÁO SƠ MI DÀI TAY 1P2036BT5/L4V', 580000.00, NULL, 'Áo sơ mi hoa văn tay dài Việt Tiến phom Regular, chất liệu Bamboo - Spun có các tính năng như ít nhăn dễ ủi, bền màu, thấm hút tốt, mềm mịn và thoải mái, phù hợp với môi trường công sở hiện đại. Sản phẩm được phân phối tại các cửa hàng Việt Tiến khu vực phía Bắc.', 'https://www.viettien.com.vn/admin/wp-content/uploads/2020/02/so-mi-6a.jpg', 1, 1, NULL, 2, 0, NULL, NULL, 4, NULL, 1, '2025-04-07 13:06:28', 1, '2025-04-07 13:29:26'),
(17, 'Quần Jean Seventy Seven 28 Ver2 Vol 24 Đen', 327000.00, NULL, '1. Kiểu sản phẩm: Quần Jean lưng gài ống đứng.\r\n2. Ưu điểm:\r\n● Khả năng chịu bền tốt.\r\n● Sợi Spandex giúp sản phẩm có độ co giãn nhẹ, tạo sự thoải mái khi di chuyển.\r\n● Giữ form dáng tốt, không bị nhão hay biến dạng sau nhiều lần giặt.\r\n● Đa dạng màu sắc dễ phối đồ và lựa chọn.\r\n3. Chất liệu: Vải Jean làm từ 85% Cotton, 14% Polyester, 1% Spandex.\r\n4. Kỹ thuật: Sản phẩm được may ống đứng giúp lên form vừa vặn không quá ôm giúp tôn dáng . May phối da thời trang tạo điểm nhấn cho quần .\r\n5. Phù hợp với ai: Những người yêu thích phong cách truyền thống, đơn giản và năng động.\r\n6. Thuộc Bộ Sưu Tập nào: Sản phẩm thuộc Bộ Sưu Tập Seventy Seven thiết kế mang tính trung tính thích hợp diện nhiều dịp khác nhau.\r\n7. Các tên thường gọi hoặc tìm kiếm về sản phẩm này: Quần Jean Seventy Seven màu đen, Quần Jean cotton co giãn, Quần Jean form dáng vừa, Quần Jean ống đứng, Quần bò, Quần bò nam.', 'https://cdn2.yame.vn/pimg/quan-jean-lung-gai-ong-ung-vai-cotton-mac-ben-bieu-tuong-dang-vua-gia-tot-seventy-seven-28-0023383/99dc0cc0-9af7-9e00-f17f-001bf09d25b9.jpg?w=540&h=756', 2, 1, NULL, 2, 0, NULL, NULL, 5, NULL, 1, '2025-04-07 13:10:31', 1, '2025-04-07 13:29:43'),
(18, 'Váy Nike Women by YOON’s Skirt ‘White’ FZ0279-100', 2200000.00, NULL, 'Váy Nike Women by YOON Women’s Skirt với mã sản phẩm FZ0279-100, màu “White,” là một sản phẩm nổi bật trong bộ sưu tập hợp tác giữa Nike và nhà thiết kế YOON. Dưới đây là mô tả chi tiết về chiếc váy này:\r\n\r\nMàu sắc\r\nMàu chính: Trắng (White), một màu sắc tươi sáng, dễ phối đồ và phù hợp cho nhiều dịp khác nhau.\r\nChất liệu\r\nVải: Váy được làm từ chất liệu vải cao cấp, thường là polyester hoặc hỗn hợp vải với đặc tính co giãn tốt và độ bền cao. Vải có khả năng hút ẩm và giữ cho bạn cảm giác thoải mái suốt cả ngày.\r\nThiết kế\r\nCấu trúc: Váy có kiểu dáng ôm nhẹ nhàng, mang đến sự vừa vặn thoải mái mà không quá chật. Thiết kế tinh tế với sự chú trọng đến chi tiết, thường có các yếu tố hiện đại và thời trang từ bộ sưu tập YOON.\r\nChi tiết:\r\n\r\nLưng váy: Thường có thiết kế co giãn hoặc dây thắt lưng để điều chỉnh kích cỡ và tạo sự vừa vặn cho vòng eo.\r\nChiều dài: Váy thường có chiều dài vừa phải, trên gối hoặc đến giữa đùi, phù hợp cho cả hoạt động thể thao lẫn phong cách hàng ngày.\r\nCác chi tiết trang trí: Có thể bao gồm các đường viền, logo Nike, hoặc các chi tiết thiết kế đặc trưng từ bộ sưu tập YOON, làm tăng tính thẩm mỹ của sản phẩm.\r\nTính năng bổ sung\r\nTính năng thể thao: Váy có thể tích hợp công nghệ Dri-FIT hoặc các tính năng tương tự để giúp thoát hơi ẩm và duy trì cảm giác khô ráo khi vận động.\r\nTính năng thời trang: Với thiết kế từ YOON, váy mang đến các yếu tố thiết kế độc đáo và phong cách hiện đại, đồng thời vẫn giữ được sự thoải mái và tính thực dụng.\r\nỨng dụng\r\nPhong cách: Váy phù hợp cho nhiều dịp khác nhau, từ các hoạt động thể thao, dạo phố, đến các sự kiện xã hội không quá trang trọng. Có thể dễ dàng phối hợp với áo thun, áo polo, hoặc các món đồ thể thao khác.\r\nVáy Nike Women by YOON Women’s Skirt ‘White’ FZ0279-100 là sự kết hợp giữa thiết kế thời trang và chức năng thể thao, mang lại sự tiện dụng và phong cách cho người mặc.', 'https://sneakerdaily.vn/wp-content/uploads/2024/08/Vay-Nike-Women-by-YOON-Womens-Skirt-White-FZ0279-100-2.jpg', 5, 1, NULL, 2, 0, NULL, NULL, 3, NULL, 1, '2025-04-07 13:11:59', 1, '2025-04-07 13:30:02'),
(19, 'Bộ mặc nhà nam cotton áo cộc tay quần soóc', 249000.00, NULL, 'Bộ mặc nhà chất liệu 100% cotton, áo cổ tròn tay cộc, quần soóc dệt thoi cạp chun.', 'https://2885706055.e.cdneverest.net/img/1517/2000/resize/8/l/8ls23s004-sb013-xl-1-ghep.webp', 6, 1, NULL, 2, 0, NULL, NULL, 6, NULL, 1, '2025-04-07 13:13:16', 1, '2025-04-07 13:30:19'),
(20, 'Cà vạt lụa cao cấp bản 7.5 cm màu đỏ', 645000.00, NULL, '1. Thiết kế\r\n️ Bản cà vạt: 8cm.\r\n️ Kích thước: 150cm.\r\n️ Ứng dụng: Đi làm, đi dự tiệc đám cưới hoặc dùng làm quà tặng.\r\n️ Đặc điểm: Thiết kế sang trọng, đẳng cấp, giúp xây dựng hình ảnh quý ông chỉn chu, lịch thiệp.\r\n2. Chất liệu\r\n️ Cà vạt được làm từ chất liệu lụa cao cấp. Dễ dàng kết hợp cùng nhiều mẫu vest, sơ mi, gile khác nhau.\r\n️ Chất vải lụa mềm mại, có độ óng ánh của tơ lụa tự nhiên và thân thiện với da khi sử dụng.\r\n\r\n3. Hướng dẫn bảo quản\r\nBảo quản cà vạt:\r\n️ Tháo gỡ nút thắt sau mỗi lần đeo.\r\n️ Treo thẳng cà vạt giúp phục hồi những nếp nhăn.\r\n️ Có thể ủi trên nền nhiệt thấp và ủi cà vạt qua một lớp giấy hoặc vải mỏng.\r\nLàm sạch cà vạt:\r\n️ Dùng một miếng vải mềm ẩm và chặm nhẹ để lấy đi vết bẩn\r\n️ Tuyệt đối không chà xát để tránh vết bẩn lan rộng.\r\n️ Giặt cà vạt nhẹ nhàng bằng tay để tránh phần chỉ thêu tay thủ công trên cà vạt bị bung đứt.', 'https://salt.tikicdn.com/cache/750x750/ts/product/0b/a4/00/9fe5e1d8bffbefb889839f48078d6f91.jpg.webp', 10, 1, NULL, 2, 0, NULL, NULL, 9, NULL, 1, '2025-04-07 13:19:06', 1, '2025-04-07 13:30:45'),
(21, 'Áo thun nam ngắn tay thêu chữ . Form Regular - ROUTINE 10F24TSS019', 339000.00, NULL, 'Áo thun nam ngắn tay thêu chữ . Form Regular - ROUTINE 10F24TSS019 | ROUTINE CÀ MAU\r\n\r\n\r\nĐặc điểm nổi bật\r\nForm :\r\nRegular\r\n\r\nFabric :\r\nCotton Polyester\r\n\r\nGender:\r\nNam\r\n\r\nGiá sản phẩm trên Tiki đã bao gồm thuế theo luật hiện hành. Bên cạnh đó, tuỳ vào loại sản phẩm, hình thức và địa chỉ giao hàng mà có thể phát sinh thêm chi phí khác như phí vận chuyển, phụ phí hàng cồng kềnh, thuế nhập khẩu (đối với đơn hàng giao từ nước ngoài có giá trị trên 1 triệu đồng).....\r\n\r\nSản phẩm này là tài sản cá nhân được bán bởi Nhà Bán Hàng Cá Nhân và không thuộc đối tượng phải chịu thuế GTGT. Do đó hoá đơn VAT không được cung cấp trong trường hợp này.', 'https://salt.tikicdn.com/cache/750x750/ts/product/7a/82/38/71c021650544a3df3ef4c86a45f83c24.png.webp', 3, 1, NULL, 2, 0, NULL, NULL, 10, NULL, 1, '2025-04-07 13:22:11', 1, '2025-04-07 13:30:58'),
(22, 'Giày thể thao Speedcat OG Unisex', 2500000.00, NULL, 'Một biểu tượng kinh điển của PUMA, lấy cảm hứng từ tốc độ trên đường đua: Speedcat OG. Đôi giày nổi bật với dáng siêu mỏng, đường nét sắc sảo, mang tinh thần mạnh mẽ của những...\r\n Kiểu dáng: 398846_01\r\n Màu: PUMA Black-PUMA White', 'https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_1000,h_1000/global/398846/01/sv01/fnd/VNM/fmt/png/Gi%C3%A0y-th%E1%BB%83-thao-Speedcat-OG-Unisex', 4, 1, NULL, 1, 0, NULL, NULL, 2, NULL, 1, '2025-04-07 13:24:14', 1, '2025-04-07 13:31:21'),
(23, 'Áo phông nam', 399000.00, 359100.00, 'Áo phông nam là sản phẩm được thiết kế từ chất liệu cao cấp, giúp thấm hút mồ hôi vượt trội, khả năng thoáng khí tốt, co giãn thoải mái', 'https://onoff.vn/img/1000/1500/resize/1/8/18tp23s025-sk001.webp', 3, 1, NULL, 2, 1, '2025-04-07 13:00:00', '2025-04-08 03:00:00', 8, NULL, 1, '2025-04-07 13:27:49', 1, '2025-04-07 13:32:26'),
(24, 'Vớ Thể Thao NIKE Everyday Cushioned Crew (3 đôi)', 489900.00, NULL, 'Với công nghệ Dri-fit thấm hút mồ hồ cực tốt mẫu vớ Nike Everyday Cushioned Crew sẽ giúp đôi chân của bạn khô thoáng và thoải mái trong suốt ngày dài.', 'https://ash.vn/cdn/shop/files/2b19fd8a09f3df4e2837736b019121ff_700x.jpg?v=1735197095', 9, 1, NULL, 2, 0, NULL, NULL, 3, NULL, 1, '2025-04-07 13:34:16', NULL, '2025-04-07 13:34:16');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2025-04-05 02:36:45', '2025-04-05 02:36:45'),
(2, 'user', '2025-04-05 02:36:45', '2025-04-05 02:36:45');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('O5is2pky4KhIvPR3JKIdqtVODkhDDnW3G0J8vo7N', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVkpuVTllanFxazl6OUd2YjJocUViaVJ5NzJIYTRaVkhPYThSa2c3ZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWN0cyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1744032856);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role_id`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$12$n.1WqeuWUTKpJoD9eSUvjuK.TwWP4QsmVjQq8s.dJYZUeg12aD/DO', NULL, '2025-04-05 02:38:19', '2025-04-06 14:11:18', 1),
(2, 'Test User', 'test@example.com', NULL, '$2y$12$lJU2CC9FEbUhLpoCieC3q.BxwLsi8GpeICtRaszurzCYd4zRQg.DS', NULL, '2025-04-05 02:38:20', '2025-04-05 02:38:20', 2),
(3, 'user', 'user1@gmail.com', NULL, '$2y$12$8aWycBcqs7ffYUg.uW0NBOa7DCgtCMpjzbhbVjITs/09alyTTaAwC', NULL, '2025-04-05 11:35:33', '2025-04-05 11:35:33', 2),
(4, 'user', 'user@gmail.com', NULL, '$2y$12$IABp9bCiaU37evbjvOZPkuaYF6SpgPQ2UOFCO02jx9yAoJlwvC.sC', NULL, '2025-04-06 14:13:13', '2025-04-06 14:13:13', 2);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Chỉ mục cho bảng `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD UNIQUE KEY `order_details_order_id_product_id_unique` (`order_id`,`product_id`),
  ADD KEY `order_details_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`),
  ADD KEY `products_created_by_foreign` (`created_by`),
  ADD KEY `products_updated_by_foreign` (`updated_by`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Chỉ mục cho bảng `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `products_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
