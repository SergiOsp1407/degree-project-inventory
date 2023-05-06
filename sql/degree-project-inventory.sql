-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2023 at 03:00 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `degree-project-inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `cash_balance`
--

CREATE TABLE `cash_balance` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `initial_amount` decimal(10,2) DEFAULT NULL,
  `opening_date` date NOT NULL,
  `closing_date` date DEFAULT NULL,
  `final_amount` decimal(10,2) DEFAULT 0.00,
  `total_sales` int(11) DEFAULT 0,
  `total_sales_amount` decimal(10,2) DEFAULT 0.00,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cash_balance`
--

INSERT INTO `cash_balance` (`id`, `id_user`, `initial_amount`, `opening_date`, `closing_date`, `final_amount`, `total_sales`, `total_sales_amount`, `status`) VALUES
(1, 1, '100000.00', '2023-03-09', '2023-03-09', '150000.00', 5000, '1.00', 0),
(2, 6, '100000.00', '2023-04-24', '2023-04-25', '1100000.00', 4, '1200000.00', 0),
(3, 6, '100000.00', '2023-04-25', '2023-04-25', '300000.00', 1, '400000.00', 0),
(4, 6, '10000.00', '2023-04-25', '2023-04-25', '1630000.00', 3, '1640000.00', 0),
(5, 6, '1.00', '2023-04-25', '2023-04-25', '530000.00', 1, '530001.00', 0),
(6, 6, '1.00', '2023-04-25', '2023-04-25', '440000.00', 2, '440001.00', 0),
(7, 6, '100000.00', '2023-04-25', '2023-04-25', '300000.00', 1, '400000.00', 0),
(8, 6, '100000.00', '2023-04-25', '2023-04-25', '100000.00', 1, '200000.00', 0),
(9, 6, '30000.00', '2023-04-25', '2023-04-25', '770000.00', 1, '800000.00', 0),
(10, 6, '100000.00', '2023-04-25', '2023-04-25', '0.00', 0, '100000.00', 0),
(11, 6, '100000.00', '2023-04-26', '2023-04-26', '0.00', 1, '100000.00', 0),
(12, 6, '100000.00', '2023-04-26', '2023-04-29', '0.00', 0, '100000.00', 0),
(13, 6, '1.00', '2023-05-03', '2023-05-04', '0.00', 0, '1.00', 0),
(14, 6, '1.00', '2023-05-04', '2023-05-04', '0.00', 2, '1.00', 0),
(15, 6, '1.00', '2023-05-04', '2023-05-04', '300000.00', 1, '300001.00', 0),
(16, 6, '100000.00', '2023-05-04', '2023-05-04', '400000.00', 2, '500000.00', 0),
(17, 6, '100000.00', '2023-05-04', '2023-05-04', '0.00', 0, '100000.00', 0),
(18, 6, '100000.00', '2023-05-04', '2023-05-05', '0.00', 2, '100000.00', 0),
(19, 6, '100000.00', '2023-05-05', '2023-05-05', '0.00', 1, '100000.00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cash_register`
--

CREATE TABLE `cash_register` (
  `id` int(11) NOT NULL,
  `cash_register` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cash_register`
--

INSERT INTO `cash_register` (`id`, `cash_register`, `status`) VALUES
(1, 'General', 1),
(3, 'Auxiliar', 1),
(4, 'Primary', 1),
(5, 'Secondary', 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`) VALUES
(1, 'Categoria 1', 1),
(2, 'Categoria 2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `dni_client` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `dni_client`, `name`, `phone`, `address`, `status`) VALUES
(1, '1', 'Sergio', '31924242', 'Calle 78', 1),
(2, '324745464', 'Client test', '32545867576', 'Calle 23 ', 1),
(3, '125642', 'Cliente 2 ', '318513423', 'Calle 13', 1),
(4, '140764562', 'Maria Paula', '3127345676', 'Calle 23 # 78 - 09', 1);

-- --------------------------------------------------------

--
-- Table structure for table `configuration`
--

CREATE TABLE `configuration` (
  `id` int(11) NOT NULL,
  `id_company` varchar(20) NOT NULL,
  `name` varchar(150) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(150) NOT NULL,
  `message` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `configuration`
--

INSERT INTO `configuration` (`id`, `id_company`, `name`, `phone`, `address`, `message`) VALUES
(1, '1.016.094.411-6', 'SpeedBikers', '313402254', 'Carrera 100 # 24D - 06', 'srodriguez97@hotmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `detail_permissions`
--

CREATE TABLE `detail_permissions` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_permission` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_permissions`
--

INSERT INTO `detail_permissions` (`id`, `id_user`, `id_permission`) VALUES
(1, 1, 5),
(2, 1, 8),
(36, 2, 1),
(37, 2, 2),
(38, 2, 3),
(39, 2, 4),
(40, 2, 5),
(41, 2, 6),
(42, 2, 7),
(43, 2, 8),
(44, 2, 9),
(45, 2, 10),
(46, 2, 11),
(47, 2, 12),
(48, 2, 13),
(49, 2, 14),
(50, 4, 1),
(51, 4, 2),
(52, 4, 3),
(53, 4, 4),
(54, 4, 5),
(55, 4, 6),
(56, 4, 7),
(57, 4, 8),
(58, 4, 9),
(59, 4, 10),
(60, 4, 11),
(61, 4, 12),
(62, 4, 13),
(63, 4, 14),
(78, 6, 1),
(79, 6, 2),
(80, 6, 3),
(81, 6, 4),
(82, 6, 5),
(83, 6, 6),
(84, 6, 7),
(85, 6, 8),
(86, 6, 9),
(87, 6, 10),
(88, 6, 11),
(89, 6, 12),
(90, 6, 13),
(91, 6, 14);

-- --------------------------------------------------------

--
-- Table structure for table `measures`
--

CREATE TABLE `measures` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `short_name` varchar(10) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `measures`
--

INSERT INTO `measures` (`id`, `name`, `short_name`, `status`) VALUES
(1, 'Medida_Test', 'medidaTest', 1),
(2, 'Gramo', 'Gr', 1);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `permission` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `permission`) VALUES
(1, 'usuarios'),
(2, 'configuracion'),
(3, 'caja'),
(4, 'balances'),
(5, 'clientes'),
(6, 'medidas'),
(7, 'categorias'),
(8, 'productos'),
(9, 'compras'),
(10, 'historial_compras'),
(11, 'ventas'),
(12, 'historial_ventas'),
(13, 'eliminar_clientes'),
(14, 'registrar_clientes');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `description` varchar(255) NOT NULL,
  `purchase_price` decimal(10,2) NOT NULL,
  `selling_price` decimal(10,2) NOT NULL,
  `amount` int(11) NOT NULL DEFAULT 0,
  `id_measure` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `image` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `code`, `description`, `purchase_price`, `selling_price`, `amount`, `id_measure`, `id_category`, `image`, `status`) VALUES
(2, '123', 'Producto 1', '100000.00', '150000.00', 1, 1, 1, '20230416112654.png', 1),
(3, '1243', 'Product 2', '100000.00', '150000.00', 3, 2, 2, 'product-default.png', 1),
(4, '123341', 'Producto 3', '350000.00', '400000.00', 0, 1, 1, '20230416112722.png', 1),
(5, '123456', 'Producto Test', '100000.00', '150000.00', 6, 1, 1, 'product-default.png', 1),
(6, '7654', 'Producto 6', '30000.00', '35000.00', 0, 1, 1, 'product-default.png', 1),
(7, '1032', 'Producto Test 1', '20500.00', '50000.00', 0, 1, 1, 'product-default.png', 1),
(8, '23', '45345Product', '1234.00', '123.00', 0, 1, 1, 'product-default.png', 1),
(9, '7653', 'Producto prueba', '45000.00', '50000.00', 0, 1, 1, '20230416120128.png', 1),
(10, '0987', 'Producto para prueba tech', '25000.00', '50000.00', 3, 1, 1, '20230421191241.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `purchase_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `total`, `purchase_date`, `status`) VALUES
(4, '700000.00', '2023-04-22 03:16:48', 1),
(5, '200000.00', '2023-04-22 03:17:43', 1),
(6, '200000.00', '2023-04-22 03:21:14', 1),
(7, '125000.00', '2023-04-22 03:22:29', 1),
(8, '125000.00', '2023-04-22 03:22:54', 1),
(9, '100000.00', '2023-04-22 03:23:54', 1),
(10, '300000.00', '2023-04-22 15:04:20', 1),
(11, '200000.00', '2023-04-25 00:30:55', 1),
(12, '423000.00', '2023-04-26 01:53:18', 1),
(13, '2150000.00', '2023-04-26 03:37:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `purchases_details`
--

CREATE TABLE `purchases_details` (
  `id` int(11) NOT NULL,
  `id_purchase` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `sub_total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchases_details`
--

INSERT INTO `purchases_details` (`id`, `id_purchase`, `id_product`, `amount`, `price`, `sub_total`) VALUES
(1, 4, 2, 6, '100000.00', '600000.00'),
(2, 4, 10, 4, '25000.00', '100000.00'),
(3, 5, 2, 2, '100000.00', '200000.00'),
(4, 6, 2, 2, '100000.00', '200000.00'),
(5, 7, 10, 5, '25000.00', '125000.00'),
(6, 8, 10, 5, '25000.00', '125000.00'),
(7, 9, 10, 4, '25000.00', '100000.00'),
(8, 10, 2, 3, '100000.00', '300000.00'),
(9, 11, 2, 2, '100000.00', '200000.00'),
(10, 12, 5, 3, '100000.00', '300000.00'),
(11, 12, 7, 6, '20500.00', '123000.00'),
(12, 13, 5, 10, '100000.00', '1000000.00'),
(13, 13, 2, 10, '100000.00', '1000000.00'),
(14, 13, 10, 6, '25000.00', '150000.00');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `total_sales` decimal(10,2) NOT NULL,
  `sale_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `time_hours` time NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `opening` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `id_user`, `id_client`, `total_sales`, `sale_date`, `time_hours`, `status`, `opening`) VALUES
(1, 6, 1, '200000.00', '2023-04-26 00:37:12', '00:00:00', 1, 0),
(2, 6, 4, '300000.00', '2023-04-26 00:37:12', '00:42:24', 1, 0),
(3, 6, 1, '300000.00', '2023-04-26 00:37:12', '00:43:22', 1, 0),
(4, 6, 3, '300000.00', '2023-04-26 00:37:12', '00:45:47', 1, 0),
(5, 6, 1, '300000.00', '2023-04-26 01:15:22', '20:12:25', 1, 0),
(6, 6, 1, '495000.00', '2023-04-26 01:39:31', '20:28:41', 1, 0),
(7, 6, 4, '495000.00', '2023-04-26 01:39:31', '20:29:50', 1, 0),
(8, 6, 3, '640000.00', '2023-04-26 01:39:31', '20:36:41', 1, 0),
(9, 6, 3, '530000.00', '2023-04-26 02:02:19', '20:54:46', 1, 0),
(10, 6, 1, '300000.00', '2023-04-26 02:57:46', '21:33:29', 1, 0),
(11, 6, 4, '140000.00', '2023-04-26 02:57:46', '21:57:00', 1, 0),
(12, 6, 1, '300000.00', '2023-04-26 03:06:51', '22:05:11', 1, 0),
(13, 6, 1, '100000.00', '2023-04-26 03:14:38', '22:10:02', 1, 0),
(14, 6, 2, '770000.00', '2023-04-26 03:38:37', '22:37:42', 1, 0),
(15, 6, 1, '300000.00', '2023-04-26 06:11:31', '01:10:53', 1, 0),
(16, 6, 1, '450000.00', '2023-05-05 00:57:54', '19:56:41', 1, 0),
(17, 6, 1, '240000.00', '2023-05-05 00:57:54', '19:57:31', 1, 0),
(18, 6, 1, '300000.00', '2023-05-05 01:28:23', '20:28:07', 1, 0),
(19, 6, 1, '300000.00', '2023-05-05 01:32:02', '20:31:35', 1, 0),
(20, 6, 1, '100000.00', '2023-05-05 01:32:02', '20:31:55', 1, 0),
(21, 6, 1, '300000.00', '2023-05-05 05:08:28', '21:10:52', 1, 0),
(22, 6, 1, '610000.00', '2023-05-05 05:08:28', '22:41:07', 1, 0),
(23, 6, 1, '290000.00', '2023-05-05 23:43:03', '18:42:11', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sales_details`
--

CREATE TABLE `sales_details` (
  `id` int(11) NOT NULL,
  `id_sale` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `discount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `price` decimal(10,2) NOT NULL,
  `sub_total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales_details`
--

INSERT INTO `sales_details` (`id`, `id_sale`, `id_product`, `amount`, `discount`, `price`, `sub_total`) VALUES
(1, 7, 2, 2, '0.00', '150000.00', '300000.00'),
(2, 7, 10, 4, '5000.00', '50000.00', '195000.00'),
(3, 8, 2, 4, '10000.00', '150000.00', '590000.00'),
(4, 8, 10, 1, '0.00', '50000.00', '50000.00'),
(5, 9, 7, 2, '10000.00', '50000.00', '90000.00'),
(6, 9, 5, 3, '10000.00', '150000.00', '440000.00'),
(7, 10, 2, 2, '0.00', '150000.00', '300000.00'),
(8, 11, 7, 1, '0.00', '50000.00', '50000.00'),
(9, 11, 10, 2, '10000.00', '50000.00', '90000.00'),
(10, 12, 2, 2, '0.00', '150000.00', '300000.00'),
(11, 13, 10, 2, '0.00', '50000.00', '100000.00'),
(12, 14, 2, 2, '0.00', '150000.00', '300000.00'),
(13, 14, 10, 4, '20000.00', '50000.00', '180000.00'),
(14, 14, 5, 2, '10000.00', '150000.00', '290000.00'),
(15, 15, 2, 2, '0.00', '150000.00', '300000.00'),
(16, 16, 2, 3, '0.00', '150000.00', '450000.00'),
(17, 17, 10, 3, '0.00', '50000.00', '150000.00'),
(18, 17, 7, 2, '10000.00', '50000.00', '90000.00'),
(19, 18, 2, 2, '0.00', '150000.00', '300000.00'),
(20, 19, 5, 2, '0.00', '150000.00', '300000.00'),
(21, 20, 10, 2, '0.00', '50000.00', '100000.00'),
(22, 21, 2, 2, '0.00', '150000.00', '300000.00'),
(23, 22, 2, 3, '10000.00', '150000.00', '440000.00'),
(24, 22, 10, 3, '20000.00', '50000.00', '130000.00'),
(25, 22, 7, 1, '10000.00', '50000.00', '40000.00'),
(26, 23, 2, 2, '10000.00', '150000.00', '290000.00');

-- --------------------------------------------------------

--
-- Table structure for table `tmp_purchases`
--

CREATE TABLE `tmp_purchases` (
  `id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `amount` int(11) NOT NULL,
  `sub_total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tmp_sales`
--

CREATE TABLE `tmp_sales` (
  `id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `amount` int(11) NOT NULL,
  `discount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `sub_total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `id_cash_register` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user`, `name`, `password`, `id_cash_register`, `status`) VALUES
(1, 'Sergio', 'Sergio', 'sergio', 1, 1),
(2, 'Admin', 'Admin', 'admin', 3, 1),
(3, 'DaniGov', 'Daniela', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 3, 1),
(4, 'AdminGeneral', 'Administrador General', 'fe2592b42a727e977f055947385b709cc82b16b9a87f88c6abf3900d65d0cdc3', 1, 1),
(5, 'Prueba1', 'Prueba', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 3, 1),
(6, 'AdminSergio', 'AdminSergio', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 1, 1),
(7, 'Empleado_1', 'Empleado 1', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 3, 1),
(8, 'Empleado_2', 'Empleado 2', '1ea2f89d934cb4a2af0b486736609cf9cb4bdafdc6e946e79aecb02b9d9dceb4', 4, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cash_balance`
--
ALTER TABLE `cash_balance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `cash_register`
--
ALTER TABLE `cash_register`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `configuration`
--
ALTER TABLE `configuration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_permissions`
--
ALTER TABLE `detail_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_permission` (`id_permission`);

--
-- Indexes for table `measures`
--
ALTER TABLE `measures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_measure` (`id_measure`),
  ADD KEY `id_category` (`id_category`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchases_details`
--
ALTER TABLE `purchases_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_product` (`id_product`),
  ADD KEY `id_purchase` (`id_purchase`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_client` (`id_client`);

--
-- Indexes for table `sales_details`
--
ALTER TABLE `sales_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_sale` (`id_sale`),
  ADD KEY `id_product` (`id_product`);

--
-- Indexes for table `tmp_purchases`
--
ALTER TABLE `tmp_purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_product` (`id_product`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tmp_sales`
--
ALTER TABLE `tmp_sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_product` (`id_product`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cash_register` (`id_cash_register`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cash_balance`
--
ALTER TABLE `cash_balance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `cash_register`
--
ALTER TABLE `cash_register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `configuration`
--
ALTER TABLE `configuration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `detail_permissions`
--
ALTER TABLE `detail_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `measures`
--
ALTER TABLE `measures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `purchases_details`
--
ALTER TABLE `purchases_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `sales_details`
--
ALTER TABLE `sales_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tmp_purchases`
--
ALTER TABLE `tmp_purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tmp_sales`
--
ALTER TABLE `tmp_sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cash_balance`
--
ALTER TABLE `cash_balance`
  ADD CONSTRAINT `cash_balance_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `detail_permissions`
--
ALTER TABLE `detail_permissions`
  ADD CONSTRAINT `detail_permissions_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `detail_permissions_ibfk_2` FOREIGN KEY (`id_permission`) REFERENCES `permissions` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`id_measure`) REFERENCES `measures` (`id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id`);

--
-- Constraints for table `purchases_details`
--
ALTER TABLE `purchases_details`
  ADD CONSTRAINT `purchases_details_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`);

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `sales_ibfk_2` FOREIGN KEY (`id_client`) REFERENCES `clients` (`id`);

--
-- Constraints for table `sales_details`
--
ALTER TABLE `sales_details`
  ADD CONSTRAINT `sales_details_ibfk_1` FOREIGN KEY (`id_sale`) REFERENCES `sales` (`id`),
  ADD CONSTRAINT `sales_details_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`);

--
-- Constraints for table `tmp_purchases`
--
ALTER TABLE `tmp_purchases`
  ADD CONSTRAINT `tmp_purchases_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `tmp_purchases_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `tmp_sales`
--
ALTER TABLE `tmp_sales`
  ADD CONSTRAINT `tmp_sales_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `tmp_sales_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_cash_register`) REFERENCES `cash_register` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
