-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2018 at 11:47 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lending`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_ip`
--

CREATE TABLE `admin_ip` (
  `id` int(11) NOT NULL,
  `ip` varchar(200) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_ip`
--

INSERT INTO `admin_ip` (`id`, `ip`, `status`, `created_at`, `updated_at`) VALUES
(1, '::1', 1, '2017-10-19 02:01:41', '2017-10-19 02:21:42'),
(3, '127.0.0.1', 1, '2017-10-19 02:21:52', '2017-10-19 02:21:52');

-- --------------------------------------------------------

--
-- Table structure for table `borrow`
--

CREATE TABLE `borrow` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `soluongthechap` decimal(20,2) NOT NULL,
  `kieuthechap` varchar(20) NOT NULL,
  `thoigianthechap` int(11) NOT NULL,
  `phantramlai` decimal(20,2) NOT NULL,
  `sotientoida` decimal(20,2) NOT NULL,
  `dutinhlai` decimal(20,2) NOT NULL,
  `sotiencanvay` decimal(20,2) NOT NULL,
  `ngaygiaingan` timestamp NULL DEFAULT NULL,
  `ngaydaohan` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL COMMENT '0:Khởi tạo; 1:Đã thế chấp tài sản, chờ nhà đầu tư; 2: Đang hoạt động; 3: Giao dịch tạm khóa; 4: Giao dịch hoàn thành; 10: Chờ admin duyệt; 20: reminder lan 1; 30: reminder lan 2: 40: da mat the chap',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `borrow`
--

INSERT INTO `borrow` (`id`, `uid`, `soluongthechap`, `kieuthechap`, `thoigianthechap`, `phantramlai`, `sotientoida`, `dutinhlai`, `sotiencanvay`, `ngaygiaingan`, `ngaydaohan`, `status`, `created_at`, `updated_at`) VALUES
(17, 31, '120.00', 'BTC', 1, '3.00', '939783.60', '33.00', '1100.00', '2018-04-01 19:38:42', '2018-04-01 19:38:42', 4, '2018-03-01 19:38:42', '2018-03-13 19:48:48'),
(21, 31, '120.00', 'BTC', 1, '3.00', '939783.60', '18.00', '999.80', '2018-04-01 19:38:42', '2018-04-01 19:38:42', 2, '2018-03-13 19:48:48', '2018-03-13 19:48:48'),
(23, 31, '50.00', 'ETH', 1, '3.00', '24535.95', '16.98', '566.00', '2018-04-13 20:54:49', '2018-04-13 20:54:49', 1, '2018-03-13 20:54:49', '2018-03-13 20:54:49'),
(24, 31, '120.00', 'BTC', 1, '3.00', '939783.60', '33.00', '1100.00', '2018-04-01 19:38:42', '2018-04-01 19:38:42', 4, '2018-03-01 19:38:42', '2018-03-13 19:48:48'),
(25, 31, '120.00', 'BTC', 1, '3.00', '939783.60', '33.00', '1100.00', '2018-04-01 19:38:42', '2018-04-01 19:38:42', 4, '2018-03-01 19:38:42', '2018-03-13 19:48:48'),
(26, 31, '150.00', 'ETH', 1, '3.00', '939783.60', '53.00', '1300.00', '2018-04-01 19:38:42', '2018-04-01 19:38:42', 4, '2018-03-01 19:38:42', '2018-03-13 19:48:48'),
(27, 31, '12.00', 'ETH', 8, '3.00', '4918.89', '43.20', '180.00', '2018-11-14 21:11:02', '2018-11-14 21:11:02', 2, '2018-03-14 21:11:02', '2018-03-14 21:11:02'),
(28, 31, '149.56', 'ETH', 8, '3.00', '4918.89', '43.20', '180.00', '2018-11-14 21:11:02', '2018-11-14 21:11:02', 4, '2018-03-14 21:11:02', '2018-03-14 21:11:02'),
(29, 31, '12.00', 'BTC', 3, '3.00', '66663.49', '12.42', '138.00', '2018-06-14 21:32:16', '2018-06-14 21:32:16', 2, '2018-03-14 21:32:16', '2018-03-14 21:32:16'),
(30, 31, '239.98', 'BTC', 3, '3.00', '66663.49', '12.42', '1333131.84', '2018-06-14 21:32:16', '2018-06-14 21:32:16', 4, '2018-03-14 21:32:16', '2018-03-14 21:32:16'),
(32, 38, '0.03', 'BTC', 6, '3.00', '5592.82', '26.10', '145.00', '2018-09-14 21:56:18', '2018-09-14 21:56:18', 0, '2018-03-14 21:56:18', '2018-03-14 21:56:18'),
(33, 38, '0.03', 'BTC', 6, '3.00', '5592.82', '26.10', '145.00', '2018-09-14 22:04:09', '2018-09-14 22:04:09', 0, '2018-03-14 22:04:09', '2018-03-14 22:04:09'),
(38, 31, '138.67', 'ETH', 8, '3.00', '4918.89', '43.20', '59640.75', '2018-11-14 21:11:02', '2018-11-14 21:11:02', 4, '2018-03-15 02:31:42', '2018-03-15 02:31:42'),
(39, 31, '224.43', 'BTC', 3, '3.00', '66663.49', '12.42', '1302169.34', '2018-06-14 21:32:16', '2018-06-14 21:32:16', 4, '2018-03-15 02:36:23', '2018-03-15 02:36:23'),
(40, 31, '448.86', 'BTC', 3, '3.00', '66663.49', '12.42', '2601158.96', '2018-06-14 21:32:16', '2018-06-14 21:32:16', 4, '2018-03-15 03:05:17', '2018-03-15 03:05:17'),
(41, 31, '433.31', 'BTC', 3, '3.00', '66663.49', '12.42', '2511046.18', '2018-06-14 21:32:16', '2018-06-14 21:32:16', 4, '2018-03-15 03:05:36', '2018-03-15 03:05:36');

-- --------------------------------------------------------

--
-- Table structure for table `checkout`
--

CREATE TABLE `checkout` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `uid` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `dataId` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `checkout`
--

INSERT INTO `checkout` (`id`, `type`, `uid`, `status`, `dataId`, `created_at`, `updated_at`, `value`) VALUES
(6, '1', 31, 1, 17, '2018-03-14 02:48:48', '2018-03-13 19:48:48', '120.00'),
(7, '0', 31, 0, 26, '2018-03-14 21:11:02', '2018-03-14 21:11:02', ''),
(8, '0', 31, 0, 24, '2018-03-14 21:32:16', '2018-03-14 21:32:16', ''),
(9, '0', 31, 0, 25, '2018-03-14 21:32:16', '2018-03-14 21:32:16', ''),
(13, '0', 31, 0, 28, '2018-03-15 02:31:42', '2018-03-15 02:31:42', ''),
(15, '0', 31, 0, 30, '2018-03-15 03:05:17', '2018-03-15 03:05:17', ''),
(16, '0', 31, 0, 39, '2018-03-15 03:05:17', '2018-03-15 03:05:17', ''),
(17, '0', 31, 0, 40, '2018-03-15 03:05:36', '2018-03-15 03:05:36', '');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `created_at`, `updated_at`, `content`, `seen`, `user_id`, `post_id`) VALUES
(1, '2017-09-22 18:15:28', '2017-09-22 18:15:28', '<p>\nLorem ipsum rutrum est habitant vehicula tempor ultrices placerat sociosqu ultrices consectetur ullamcorper, tincidunt quisque tellus ante nostra euismod nec suspendisse sem curabitur elit. \nMalesuada lacus viverra sagittis sit ornare orci, augue nullam adipiscing pulvinar libero aliquam vestibulum, platea cursus pellentesque leo dui. \nLectus curabitur euismod ad erat curae non elit ultrices placerat netus, metus feugiat non conubia fusce porttitor sociosqu diam commodo metus in, himenaeos vitae aptent consequat luctus purus eleifend enim sollicitudin. \nEleifend porta malesuada ac class conubia condimentum mauris facilisis, conubia quis scelerisque lacinia tempus nullam felis fusce, ac potenti netus ornare semper molestie iaculis. \n</p>\n<p>\nFermentum ornare curabitur tincidunt imperdiet scelerisque imperdiet euismod scelerisque torquent, curae rhoncus sollicitudin tortor placerat aptent hac nec posuere suscipit, sed tortor neque urna hendrerit vehicula duis litora. \nTristique congue nec auctor felis libero ornare habitasse, nec elit felis inceptos tellus inceptos cubilia quis, mattis faucibus sem non odio fringilla. \nClass aliquam metus ipsum lorem luctus pharetra dictum vehicula, tempus in venenatis gravida ut gravida proin orci, quis sed platea mi quisque hendrerit semper. \nHendrerit facilisis ante sapien faucibus ligula commodo vestibulum rutrum, pretium varius sem aliquet himenaeos dolor cursus, nunc habitasse aliquam ut curabitur ipsum luctus. \n</p>\n<p>\nUt rutrum odio condimentum, donec. \n</p>', 0, 2, 1),
(2, '2017-09-22 18:15:28', '2017-09-22 18:15:28', '<p>\nLorem ipsum phasellus molestie est etiam sit rutrum dui, nostra sem aliquet conubia nullam sollicitudin rhoncus. \nVenenatis vivamus rhoncus netus risus tortor non, mauris turpis eget integer nibh dolor, commodo venenatis ut molestie semper. \nAdipiscing amet cras class donec sapien malesuada auctor sapien arcu, inceptos aenean consequat metus litora mattis vivamus. \nFeugiat arcu adipiscing mauris primis ante ullamcorper ad nisi lobortis, arcu per orci malesuada blandit metus tortor urna turpis, consectetur porttitor egestas sed eleifend eget tincidunt pharetra. \nVarius tincidunt morbi malesuada elementum mi torquent mollis, eu lobortis curae purus amet vivamus amet, nulla torquent nibh eu diam aliquam. \n</p>\n<p>\nPretium donec aliquam tempus lacus tempus feugiat lectus cras non velit, mollis sit et integer egestas habitant auctor integer. \nSem at nam massa himenaeos netus vel dapibus nibh malesuada, leo fusce tortor sociosqu semper facilisis semper class tempus faucibus, tristique duis eros cubilia quisque habitasse aliquam fringilla. \nOrci non vel laoreet dolor enim justo facilisis, neque accumsan in ad venenatis hac per dictumst, nulla ligula donec mollis massa porttitor. \nUllamcorper risus eu platea fringilla habitasse suscipit pellentesque donec, est habitant vehicula tempor ultrices placerat sociosqu, ultrices consectetur ullamcorper tincidunt quisque tellus ante. \n</p>\n<p>\nNostra euismod nec suspendisse sem curabitur, elit malesuada lacus. \n</p>', 0, 2, 2),
(3, '2017-09-22 18:15:28', '2017-09-22 18:15:28', '<p>\nLorem ipsum donec sagittis sit ornare orci augue nullam, adipiscing pulvinar libero aliquam vestibulum platea cursus pellentesque leo, dui lectus curabitur euismod ad erat curae. \nNon elit ultrices placerat netus metus feugiat non conubia, fusce porttitor sociosqu diam commodo metus in, himenaeos vitae aptent consequat luctus purus eleifend. \nEnim sollicitudin eleifend porta malesuada ac class conubia condimentum, mauris facilisis conubia quis scelerisque lacinia tempus nullam, felis fusce ac potenti netus ornare semper. \nMolestie iaculis fermentum ornare curabitur tincidunt imperdiet scelerisque imperdiet euismod scelerisque torquent curae rhoncus, sollicitudin tortor placerat aptent hac nec posuere suscipit sed tortor neque urna. \n</p>\n<p>\nHendrerit vehicula duis litora tristique congue nec auctor, felis libero ornare habitasse nec elit. \nFelis inceptos tellus inceptos cubilia quis mattis faucibus sem non odio fringilla, class aliquam metus ipsum lorem luctus pharetra dictum vehicula tempus in, venenatis gravida ut gravida proin orci quis sed platea mi. \nQuisque hendrerit semper hendrerit facilisis ante sapien faucibus ligula, commodo vestibulum rutrum pretium varius sem aliquet himenaeos, dolor cursus nunc habitasse aliquam ut curabitur. \nIpsum luctus ut rutrum odio condimentum donec, suscipit molestie est etiam sit rutrum dui, nostra sem aliquet conubia nullam. \n</p>\n<p>\nSollicitudin rhoncus venenatis vivamus rhoncus netus risus, tortor non mauris turpis eget. \n</p>', 0, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `text`, `seen`, `created_at`, `updated_at`) VALUES
(1, 'Dupont', 'dupont@la.fr', 'Lorem ipsum inceptos malesuada leo fusce tortor sociosqu semper, facilisis semper class tempus faucibus tristique duis eros, cubilia quisque habitasse aliquam fringilla orci non. Vel laoreet dolor enim justo facilisis neque accumsan, in ad venenatis hac per dictumst nulla ligula, donec mollis massa porttitor ullamcorper risus. Eu platea fringilla, habitasse.', 0, '2017-09-22 18:15:24', '2017-09-22 18:15:24'),
(2, 'Durand', 'durand@la.fr', ' Lorem ipsum erat non elit ultrices placerat, netus metus feugiat non conubia fusce porttitor, sociosqu diam commodo metus in. Himenaeos vitae aptent consequat luctus purus eleifend enim, sollicitudin eleifend porta malesuada ac class conubia, condimentum mauris facilisis conubia quis scelerisque. Lacinia tempus nullam felis fusce ac potenti netus ornare semper molestie, iaculis fermentum ornare curabitur tincidunt imperdiet scelerisque imperdiet euismod.', 0, '2017-09-22 18:15:25', '2017-09-22 18:15:25'),
(3, 'Martin', 'martin@la.fr', 'Lorem ipsum tempor netus aenean ligula habitant vehicula tempor ultrices, placerat sociosqu ultrices consectetur ullamcorper tincidunt quisque tellus, ante nostra euismod nec suspendisse sem curabitur elit. Malesuada lacus viverra sagittis sit ornare orci, augue nullam adipiscing pulvinar libero aliquam vestibulum, platea cursus pellentesque leo dui. Lectus curabitur euismod ad, erat.', 1, '2017-09-22 18:15:25', '2017-09-22 18:15:25'),
(4, 'lemanhtoan', 'toan@ktv.it', 'ok toanlm contact', 0, '2017-11-05 08:53:01', '2017-11-05 08:53:01');

-- --------------------------------------------------------

--
-- Table structure for table `hash_confirm`
--

CREATE TABLE `hash_confirm` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `hask` varchar(255) NOT NULL,
  `uid` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `dataId` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tygia` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hash_confirm`
--

INSERT INTO `hash_confirm` (`id`, `type`, `hask`, `uid`, `status`, `dataId`, `created_at`, `updated_at`, `tygia`) VALUES
(3, 'borrow', 'b6f6991d03df0e2e04dafffcd6bc418aac66049e2cd74b80f14ac86db1e3f0davvv', 31, 1, 17, '2018-03-13 07:47:33', '2018-03-01 23:59:16', NULL),
(4, 'borrow', '0xff7d7f8e897161b374b938cfbb1ef1cf3911b9c18bebef11be98f5014df66e40222', 33, 1, 17, '2018-03-13 07:44:17', '2018-03-02 01:04:41', NULL),
(6, 'borrow', 'b6f6991d03df0e2e04dafffcd6bc418aac66049e2cd74b80f14ac86db1e3f0da__', 31, 1, 17, '2018-03-13 07:57:06', '2018-03-13 00:54:50', '1'),
(7, 'borrow', 'b6f6991d03df0e2e04dafffcd6bc418aac66049e2cd74b80f14ac86db1e3f0da__', 31, 1, 17, '2018-03-14 02:47:35', '2018-03-13 00:57:29', '1'),
(8, 'borrow', 'b6f6991d03df0e2e04dafffcd6bc418aac66049e2cd74b80f14ac86db1e3f0da__', 31, 1, 17, '2018-03-14 02:48:43', '2018-03-13 19:47:41', '1'),
(9, 'borrow', 'b6f6991d03df0e2e04dafffcd6bc418aac66049e2cd74b80f14ac86db1e3f0da', 31, 1, 17, '2018-03-13 19:48:48', '2018-03-13 19:48:48', '1');

-- --------------------------------------------------------

--
-- Table structure for table `invest`
--

CREATE TABLE `invest` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `borrowId` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `rate` decimal(10,2) DEFAULT NULL,
  `rateUser` decimal(10,2) DEFAULT NULL,
  `rateAdmin` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invest`
--

INSERT INTO `invest` (`id`, `uid`, `borrowId`, `status`, `created_at`, `updated_at`, `rate`, `rateUser`, `rateAdmin`) VALUES
(30, 33, 17, 1, '2017-10-17 16:49:26', '2017-10-17 16:49:26', NULL, NULL, NULL),
(32, 33, 23, 0, '2018-03-13 21:24:55', '2018-03-13 21:24:55', '0.00', '16.98', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `uid`, `status`, `message`, `created_at`, `updated_at`) VALUES
(1, 31, 1, 'Your request payment was done', '2018-03-15 10:44:38', 2018),
(2, 31, 0, 'Your request payment was done', '2018-03-15 03:05:35', 2018);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2014_10_21_105844_create_roles_table', 1),
('2014_10_21_110325_create_foreign_keys', 1),
('2014_10_24_205441_create_contact_table', 1),
('2014_10_26_172107_create_posts_table', 1),
('2014_10_26_172631_create_tags_table', 1),
('2014_10_26_172904_create_post_tag_table', 1),
('2014_10_26_222018_create_comments_table', 1),
('2017_10_02_094432_create_social_accounts_table', 2),
('2017_10_03_080909_create_user_activations_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `summary` text COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `created_at`, `updated_at`, `title`, `slug`, `summary`, `content`, `seen`, `active`, `user_id`) VALUES
(1, '2017-09-22 18:15:26', '2018-03-07 01:09:48', 'Post 1', 'post-1', '<p>Ipsum morbi fringilla sapien faucibus ligula commodo, vestibulum rutrum pretium varius sem aliquet himenaeos, dolor cursus nunc habitasse aliquam ut. Curabitur ipsum luctus ut rutrum odio condimentum donec suscipit molestie est etiam, sit rutrum dui nostra sem aliquet conubia nullam sollicitudin. Rhoncus venenatis vivamus rhoncus netus, risus tortor non...</p>\r\n', '<p>Ipsum imperdiet turpis eget integer nibh dolor, commodo venenatis ut molestie semper adipiscing, amet cras class donec sapien malesuada. Auctor sapien arcu inceptos aenean consequat metus litora mattis vivamus feugiat, arcu adipiscing mauris primis ante ullamcorper ad nisi. Lobortis arcu per orci malesuada blandit metus, tortor urna turpis consectetur porttitor egestas sed, eleifend eget tincidunt pharetra varius. Tincidunt morbi malesuada elementum mi torquent mollis eu lobortis curae, purus amet vivamus amet nulla torquent nibh eu diam aliquam, pretium donec aliquam tempus lacus tempus feugiat lectus. Cras non velit mollis sit et integer egestas habitant auctor integer sem, at nam massa himenaeos netus vel dapibus nibh malesuada.</p>\r\n\r\n<p>Leo fusce tortor sociosqu semper facilisis semper class, tempus faucibus tristique duis eros cubilia quisque, habitasse aliquam fringilla orci non vel. Laoreet dolor enim justo facilisis neque accumsan in ad venenatis hac, per dictumst nulla ligula donec mollis massa porttitor ullamcorper, risus eu platea fringilla habitasse suscipit pellentesque donec est. Habitant vehicula tempor ultrices placerat sociosqu ultrices, consectetur ullamcorper tincidunt quisque tellus ante nostra, euismod nec suspendisse sem curabitur. Elit malesuada lacus viverra sagittis sit ornare orci augue nullam adipiscing, pulvinar libero aliquam vestibulum platea cursus pellentesque leo dui, lectus curabitur euismod ad erat curae non elit ultrices.</p>\r\n\r\n<p>Placerat netus metus feugiat non conubia fusce, porttitor sociosqu diam commodo metus in himenaeos, vitae aptent consequat luctus purus. Eleifend enim sollicitudin eleifend porta malesuada ac class conubia, condimentum mauris facilisis conubia quis scelerisque lacinia tempus, nullam felis fusce ac potenti netus ornare. Semper molestie iaculis fermentum ornare curabitur tincidunt imperdiet scelerisque imperdiet euismod scelerisque torquent curae rhoncus, sollicitudin tortor placerat aptent hac nec posuere suscipit sed tortor neque urna. Hendrerit vehicula duis litora tristique congue nec auctor, felis libero ornare habitasse nec elit felis inceptos, tellus inceptos cubilia quis mattis faucibus.</p>\r\n\r\n<p>Sem non odio fringilla class aliquam metus ipsum lorem luctus pharetra, dictum vehicula tempus in venenatis gravida ut gravida proin, orci quis sed platea mi quisque hendrerit semper hendrerit. Facilisis ante sapien faucibus ligula commodo vestibulum rutrum pretium, varius sem aliquet himenaeos dolor cursus nunc, habitasse aliquam ut curabitur ipsum luctus ut. Rutrum odio condimentum donec suscipit molestie est, etiam sit rutrum dui nostra, sem aliquet conubia nullam sollicitudin. Rhoncus venenatis vivamus rhoncus netus risus tortor non, mauris turpis eget integer nibh dolor, commodo venenatis ut molestie semper adipiscing.</p>\r\n\r\n<p>Amet cras class donec sapien malesuada auctor, sapien arcu inceptos aenean consequat metus, litora mattis vivamus feugiat arcu. Adipiscing mauris primis ante ullamcorper ad nisi lobortis arcu per, orci malesuada blandit metus tortor urna turpis consectetur porttitor, egestas sed eleifend eget tincidunt pharetra varius tincidunt. Morbi malesuada elementum mi torquent mollis eu lobortis, curae purus amet vivamus amet nulla torquent nibh, eu diam aliquam pretium donec aliquam. Tempus lacus tempus feugiat lectus cras non velit mollis, sit et integer egestas habitant auctor integer sem, at nam massa himenaeos netus vel dapibus.</p>\r\n\r\n<p>Nibh malesuada leo fusce tortor sociosqu semper facilisis semper, class tempus faucibus tristique duis eros cubilia, quisque habitasse aliquam fringilla orci non vel.</p>\r\n', 0, 1, 1),
(2, '2017-09-22 18:15:26', '2017-10-21 20:07:27', 'Post 2', 'post-2', '<p>Lorem ipsum vel justo facilisis neque accumsan in ad venenatis, hac per dictumst nulla ligula donec mollis massa, porttitor ullamcorper risus eu platea fringilla habitasse suscipit. Pellentesque donec est habitant vehicula, tempor ultrices placerat sociosqu ultrices, consectetur ullamcorper tincidunt. Quisque tellus ante nostra euismod, nec suspendisse sem, curabitur elit malesuada.</p>\r\n', '<p>Lorem ipsum convallis ac curae non elit ultrices placerat netus metus feugiat, non conubia fusce porttitor sociosqu diam commodo metus in himenaeos, vitae aptent consequat luctus purus eleifend enim sollicitudin eleifend porta. Malesuada ac class conubia condimentum mauris facilisis conubia quis scelerisque lacinia, tempus nullam felis fusce ac potenti netus ornare semper. Molestie iaculis fermentum ornare curabitur tincidunt imperdiet scelerisque, imperdiet euismod scelerisque torquent curae rhoncus, sollicitudin tortor placerat aptent hac nec. Posuere suscipit sed tortor neque urna hendrerit vehicula duis litora tristique congue nec auctor felis libero, ornare habitasse nec elit felis inceptos tellus inceptos cubilia quis mattis faucibus sem non.</p>\r\n\r\n<p>Odio fringilla class aliquam metus ipsum lorem luctus pharetra dictum, vehicula tempus in venenatis gravida ut gravida proin orci, quis sed platea mi quisque hendrerit semper hendrerit. Facilisis ante sapien faucibus ligula commodo vestibulum rutrum pretium, varius sem aliquet himenaeos dolor cursus nunc habitasse, aliquam ut curabitur ipsum luctus ut rutrum. Odio condimentum donec suscipit molestie est etiam sit rutrum dui nostra, sem aliquet conubia nullam sollicitudin rhoncus venenatis vivamus rhoncus netus, risus tortor non mauris turpis eget integer nibh dolor. Commodo venenatis ut molestie semper adipiscing amet cras, class donec sapien malesuada auctor sapien arcu inceptos, aenean consequat metus litora mattis vivamus.</p>\r\n\r\n<pre>\r\nFeugiat arcu adipiscing mauris primis ante ullamcorper ad nisi, lobortis arcu per orci malesuada blandit metus tortor, urna turpis consectetur porttitor egestas sed eleifend. Eget tincidunt pharetra varius tincidunt morbi malesuada elementum mi torquent mollis, eu lobortis curae purus amet vivamus amet nulla torquent, nibh eu diam aliquam pretium donec aliquam tempus lacus. Tempus feugiat lectus cras non velit mollis sit et integer, egestas habitant auctor integer sem at nam massa himenaeos, netus vel dapibus nibh malesuada leo fusce tortor. Sociosqu semper facilisis semper class tempus faucibus tristique duis eros, cubilia quisque habitasse aliquam fringilla orci non vel, laoreet dolor enim justo facilisis neque accumsan in.</pre>\r\n\r\n<p>Ad venenatis hac per dictumst nulla ligula donec, mollis massa porttitor ullamcorper risus eu platea, fringilla habitasse suscipit pellentesque donec est. Habitant vehicula tempor ultrices placerat sociosqu ultrices consectetur ullamcorper tincidunt quisque tellus, ante nostra euismod nec suspendisse sem curabitur elit malesuada lacus. Viverra sagittis sit ornare orci augue nullam adipiscing pulvinar libero aliquam vestibulum platea cursus pellentesque leo dui lectus, curabitur euismod ad erat curae non elit ultrices placerat netus metus feugiat non conubia fusce porttitor. Sociosqu diam commodo metus in himenaeos vitae aptent consequat luctus purus eleifend enim sollicitudin eleifend, porta malesuada ac class conubia condimentum mauris facilisis conubia quis scelerisque lacinia.</p>\r\n\r\n<p>Tempus nullam felis fusce ac potenti netus ornare semper molestie iaculis, fermentum ornare curabitur tincidunt imperdiet scelerisque imperdiet euismod. Scelerisque torquent curae rhoncus sollicitudin tortor placerat aptent hac, nec posuere suscipit sed tortor neque urna hendrerit, vehicula duis litora tristique congue nec auctor. Felis libero ornare habitasse nec elit felis, inceptos tellus inceptos cubilia quis mattis, faucibus sem non odio fringilla. Class aliquam metus ipsum lorem luctus pharetra dictum vehicula, tempus in venenatis gravida ut gravida proin orci, quis sed platea mi quisque hendrerit semper.</p>\r\n', 0, 1, 2),
(3, '2017-09-22 18:15:26', '2017-10-21 20:07:38', 'Post 3', 'post-3', '<p>Lorem ipsum eros viverra sagittis sit ornare orci augue nullam adipiscing pulvinar, libero aliquam vestibulum platea cursus pellentesque leo dui lectus curabitur. Euismod ad erat curae non elit ultrices placerat, netus metus feugiat non conubia fusce porttitor, sociosqu diam commodo metus in himenaeos vitae, aptent consequat luctus purus eleifend enim.</p>\r\n', '<p>Lorem ipsum ut eleifend porta malesuada ac, class conubia condimentum mauris facilisis conubia quis, scelerisque lacinia tempus nullam felis. Fusce ac potenti netus ornare semper molestie, iaculis fermentum ornare curabitur tincidunt imperdiet scelerisque, imperdiet euismod scelerisque torquent curae. Rhoncus sollicitudin tortor placerat aptent hac nec posuere suscipit sed, tortor neque urna hendrerit vehicula duis litora tristique, congue nec auctor felis libero ornare habitasse nec. Elit felis inceptos tellus inceptos cubilia quis mattis faucibus sem non odio, fringilla class aliquam metus ipsum lorem luctus pharetra dictum vehicula. Tempus in venenatis gravida ut gravida proin orci quis sed, platea mi quisque hendrerit semper hendrerit facilisis ante, sapien faucibus ligula commodo vestibulum rutrum pretium varius.</p>\r\n\r\n<p>Sem aliquet himenaeos dolor cursus nunc habitasse aliquam ut, curabitur ipsum luctus ut rutrum odio condimentum donec, suscipit molestie est etiam sit rutrum dui. Nostra sem aliquet conubia nullam sollicitudin rhoncus venenatis vivamus rhoncus netus, risus tortor non mauris turpis eget integer nibh dolor commodo, venenatis ut molestie semper adipiscing amet cras class donec. Sapien malesuada auctor sapien arcu inceptos aenean consequat metus litora mattis vivamus, feugiat arcu adipiscing mauris primis ante ullamcorper ad nisi lobortis, arcu per orci malesuada blandit metus tortor urna turpis consectetur. Porttitor egestas sed eleifend eget tincidunt, pharetra varius tincidunt morbi malesuada elementum, mi torquent mollis eu.</p>\r\n\r\n<p>Lobortis curae purus amet vivamus amet nulla torquent nibh eu, diam aliquam pretium donec aliquam tempus lacus tempus feugiat, lectus cras non velit mollis sit et integer. Egestas habitant auctor integer sem at nam massa himenaeos netus, vel dapibus nibh malesuada leo fusce tortor sociosqu, semper facilisis semper class tempus faucibus tristique duis. Eros cubilia quisque habitasse aliquam fringilla orci non, vel laoreet dolor enim justo facilisis, neque accumsan in ad venenatis hac. Per dictumst nulla ligula donec mollis massa porttitor ullamcorper risus eu platea, fringilla habitasse suscipit pellentesque donec est habitant vehicula tempor ultrices.</p>\r\n\r\n<p>Placerat sociosqu ultrices consectetur ullamcorper tincidunt quisque, tellus ante nostra euismod nec, suspendisse sem curabitur elit malesuada. Lacus viverra sagittis sit ornare orci augue nullam, adipiscing pulvinar libero aliquam vestibulum platea cursus, pellentesque leo dui lectus curabitur euismod. Ad erat curae non elit ultrices placerat netus, metus feugiat non conubia fusce porttitor sociosqu, diam commodo metus in himenaeos vitae. Aptent consequat luctus purus eleifend enim sollicitudin eleifend porta, malesuada ac class conubia condimentum mauris facilisis conubia quis, scelerisque lacinia tempus nullam felis fusce ac. Potenti netus ornare semper molestie iaculis fermentum ornare curabitur tincidunt imperdiet scelerisque, imperdiet euismod scelerisque torquent curae rhoncus sollicitudin tortor placerat aptent hac, nec posuere suscipit sed tortor neque urna hendrerit vehicula duis.</p>\r\n\r\n<p>Litora tristique congue nec auctor felis libero ornare habitasse, nec elit felis inceptos tellus inceptos cubilia, quis mattis faucibus sem non odio fringilla. Class aliquam metus ipsum lorem luctus pharetra dictum vehicula, tempus in venenatis gravida ut gravida proin orci quis, sed platea mi quisque hendrerit semper hendrerit. Facilisis ante sapien faucibus ligula commodo vestibulum rutrum pretium varius, sem aliquet himenaeos dolor cursus nunc habitasse aliquam, ut curabitur ipsum luctus ut rutrum odio condimentum.</p>\r\n', 0, 1, 2),
(4, '2017-09-22 18:15:26', '2017-10-21 20:07:49', 'Post 4', 'post-4', '<p>Lorem ipsum felis mauris molestie est etiam sit rutrum dui nostra, sem aliquet conubia nullam sollicitudin rhoncus venenatis vivamus rhoncus, netus risus tortor non mauris turpis eget integer nibh dolor, commodo venenatis ut molestie semper adipiscing amet cras. Class donec sapien malesuada auctor sapien arcu, inceptos aenean consequat metus litora.</p>\r\n', '<p>Lorem ipsum dictumst vivamus feugiat arcu adipiscing mauris primis ante, ullamcorper ad nisi lobortis arcu per orci malesuada. Blandit metus tortor urna turpis consectetur porttitor egestas, sed eleifend eget tincidunt pharetra varius tincidunt morbi, malesuada elementum mi torquent mollis eu. Lobortis curae purus amet vivamus amet nulla torquent nibh eu, diam aliquam pretium donec aliquam tempus lacus tempus feugiat lectus, cras non velit mollis sit et integer egestas. Habitant auctor integer sem at nam massa, himenaeos netus vel dapibus nibh, malesuada leo fusce tortor sociosqu. Semper facilisis semper class tempus faucibus tristique duis eros cubilia quisque, habitasse aliquam fringilla orci non vel laoreet dolor enim justo, facilisis neque accumsan in ad venenatis hac per dictumst.</p>\r\n\r\n<p>Nulla ligula donec mollis massa porttitor ullamcorper risus, eu platea fringilla habitasse suscipit pellentesque, donec est habitant vehicula tempor ultrices. Placerat sociosqu ultrices consectetur ullamcorper tincidunt quisque tellus ante nostra euismod nec suspendisse sem, curabitur elit malesuada lacus viverra sagittis sit ornare orci augue nullam adipiscing, pulvinar libero aliquam vestibulum platea cursus pellentesque leo dui lectus curabitur euismod. Ad erat curae non elit ultrices placerat netus metus feugiat non conubia fusce, porttitor sociosqu diam commodo metus in himenaeos vitae aptent consequat luctus. Purus eleifend enim sollicitudin eleifend porta malesuada ac class conubia, condimentum mauris facilisis conubia quis scelerisque lacinia tempus nullam, felis fusce ac potenti netus ornare semper molestie.</p>\r\n\r\n<p>Iaculis fermentum ornare curabitur tincidunt imperdiet scelerisque imperdiet euismod scelerisque, torquent curae rhoncus sollicitudin tortor placerat aptent hac nec, posuere suscipit sed tortor neque urna hendrerit vehicula. Duis litora tristique congue nec auctor felis, libero ornare habitasse nec elit, felis inceptos tellus inceptos cubilia. Quis mattis faucibus sem non odio fringilla class aliquam metus ipsum, lorem luctus pharetra dictum vehicula tempus in venenatis gravida ut gravida, proin orci quis sed platea mi quisque hendrerit semper. Hendrerit facilisis ante sapien faucibus ligula commodo vestibulum rutrum, pretium varius sem aliquet himenaeos dolor cursus, nunc habitasse aliquam ut curabitur ipsum luctus.</p>\r\n\r\n<p>Ut rutrum odio condimentum donec suscipit molestie est etiam sit rutrum dui nostra sem, aliquet conubia nullam sollicitudin rhoncus venenatis vivamus rhoncus netus risus tortor. Non mauris turpis eget integer nibh dolor commodo venenatis ut, molestie semper adipiscing amet cras class donec sapien, malesuada auctor sapien arcu inceptos aenean consequat metus. Litora mattis vivamus feugiat arcu adipiscing mauris, primis ante ullamcorper ad nisi, lobortis arcu per orci malesuada. Blandit metus tortor urna turpis consectetur porttitor egestas, sed eleifend eget tincidunt pharetra varius, tincidunt morbi malesuada elementum mi torquent mollis, eu lobortis curae purus amet.</p>\r\n\r\n<p>Vivamus amet nulla torquent nibh eu diam aliquam pretium, donec aliquam tempus lacus tempus feugiat. Lectus cras non velit mollis sit et integer egestas, habitant auctor integer sem at nam massa himenaeos netus, vel dapibus nibh malesuada leo fusce tortor. Sociosqu semper facilisis semper class tempus faucibus tristique duis eros cubilia quisque habitasse aliquam fringilla orci, non vel laoreet dolor enim justo facilisis neque accumsan in ad venenatis hac. Per dictumst nulla ligula donec mollis massa porttitor ullamcorper, risus eu platea fringilla habitasse suscipit.</p>\r\n', 0, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `post_tag`
--

CREATE TABLE `post_tag` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `tag_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `post_tag`
--

INSERT INTO `post_tag` (`id`, `post_id`, `tag_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 1),
(4, 2, 2),
(5, 2, 3),
(6, 3, 1),
(7, 3, 2),
(8, 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `request_checkout`
--

CREATE TABLE `request_checkout` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `value` decimal(15,8) NOT NULL,
  `status` int(11) NOT NULL,
  `type` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `request_checkout`
--

INSERT INTO `request_checkout` (`id`, `uid`, `value`, `status`, `type`, `created_at`, `updated_at`) VALUES
(1, 31, '10.89000000', 1, 'ETH', '2018-03-15 09:31:41', '2018-03-15 02:31:41'),
(2, 31, '15.55000000', 1, 'BTC', '2018-03-15 10:05:35', '2018-03-15 03:05:35');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin', '2017-09-22 18:15:23', '2017-09-22 18:15:23'),
(2, 'Admin', 'redac', '2017-09-22 18:15:23', '2017-10-21 01:21:04'),
(3, 'User', 'user', '2017-09-22 18:15:23', '2017-09-22 18:15:23');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `content`, `created_at`, `updated_at`) VALUES
(1, 'dataLogo', '1508030853_image.png', '2017-06-06 10:11:33', '2017-10-06 02:36:06'),
(10, 'dataHotline', '024.3237.3333', '2017-06-09 09:42:11', '2017-10-06 02:35:17'),
(13, 'emailsupport', 'quocdungxd@gmail.com', '2017-10-06 02:46:40', '2017-10-26 02:08:21'),
(14, 'mainbg', '#ff0000', '2017-10-06 02:54:24', '2017-10-06 03:03:07'),
(15, 'maincolor', '#0000ff', '2017-10-06 02:54:27', '2017-10-06 03:03:14'),
(16, 'laisuat', '3', '2017-10-06 02:54:33', '2017-10-06 03:06:06'),
(17, 'maxverified', '2000', '2017-10-06 02:54:43', '2017-10-06 03:06:36'),
(18, 'footer', '<p>Footer content dynamic</p>\r\n', '2017-10-06 02:57:04', '2017-10-06 03:06:47'),
(19, 'maxqty', '3', '2017-10-06 02:57:28', '2017-10-06 02:57:28'),
(20, 'dayredm', '7', '2017-10-06 02:57:33', '2017-10-06 03:06:23'),
(21, 'tygiaUV', '1', '2017-10-06 02:57:37', '2017-10-06 03:06:12'),
(22, 'daylost', '15', '2017-10-06 02:58:34', '2017-10-06 03:06:18'),
(23, 'emailadmin', 'toanktv.it@gmail.com', '2017-10-25 17:00:00', '2017-10-25 17:00:00'),
(24, 'ccl', '0.5', NULL, '2018-02-27 02:10:59'),
(26, 'minday', '20', '2018-03-09 17:00:00', '2018-03-09 19:57:42'),
(27, 'adminrate', '0', '2018-03-09 17:00:00', '2018-03-09 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `slideshow`
--

CREATE TABLE `slideshow` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `position` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `slideshow`
--

INSERT INTO `slideshow` (`id`, `title`, `status`, `created_at`, `updated_at`, `link`, `image`, `position`) VALUES
(1, 'Slider 1', 1, '2017-11-07 01:16:02', '2017-11-07 01:58:49', '#', '1510045129_banner1.jpg', 1),
(3, 'Slider 2', 1, '2017-11-07 01:23:56', '2017-11-07 01:59:06', '#', '1510045146_banner2.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `social_accounts`
--

CREATE TABLE `social_accounts` (
  `user_id` int(11) NOT NULL,
  `provider_user_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `social_accounts`
--

INSERT INTO `social_accounts` (`user_id`, `provider_user_id`, `provider`, `created_at`, `updated_at`) VALUES
(13, '100571142524785537016', 'google', '2017-10-03 00:51:11', '2017-10-03 00:51:11'),
(14, '108809095619282634374', 'google', '2017-10-03 00:51:37', '2017-10-03 00:51:37'),
(36, '1421237081319149', 'facebook', '2018-03-07 21:30:14', '2018-03-07 21:30:14');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tag` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `created_at`, `updated_at`, `tag`) VALUES
(1, '2017-09-22 18:15:25', '2017-09-22 18:15:25', 'Tag1'),
(2, '2017-09-22 18:15:25', '2017-09-22 18:15:25', 'Tag2'),
(3, '2017-09-22 18:15:25', '2017-09-22 18:15:25', 'Tag3'),
(4, '2017-09-22 18:15:25', '2017-09-22 18:15:25', 'Tag4');

-- --------------------------------------------------------

--
-- Table structure for table `temp_summary`
--

CREATE TABLE `temp_summary` (
  `id` int(11) NOT NULL,
  `summary_id` int(11) NOT NULL COMMENT 'User summary id',
  `type` int(11) NOT NULL COMMENT '2: NDT, 3: Nguoivay',
  `data_id` int(11) NOT NULL,
  `value` decimal(20,2) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT '0',
  `valid` tinyint(1) NOT NULL DEFAULT '0',
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `confirmation_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activated` tinyint(1) DEFAULT '0',
  `usertype` int(1) NOT NULL COMMENT 'User type',
  `userReceived` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cclAddress` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role_id`, `seen`, `valid`, `confirmed`, `confirmation_code`, `created_at`, `updated_at`, `remember_token`, `activated`, `usertype`, `userReceived`, `cclAddress`) VALUES
(1, 'Great Admin', 'admin@gmail.com', '$2y$10$a7LWpCz.C2bDQQinhE5Jju5tDiW1EQFqT7HWZKWdh/jL3uXzEdcja', 1, 1, 0, 1, NULL, '2017-09-22 18:15:23', '2018-03-15 03:06:41', 'WXDr0OdrUVjE8qtIEOScdyNGrqtIiiVcBUWRFHa06ISe5LHcYskiIEAh79z5', 1, 0, NULL, NULL),
(2, 'Great Redactor', 'redac@gmail.com', '$2y$10$Cxk19TMvUgupcknjBOXPL.rFJkv0sFk8WAsz5uHfLa7dKSl.6rKA2', 2, 1, 1, 1, NULL, '2017-09-22 18:15:24', '2017-10-24 21:07:53', NULL, 1, 2, NULL, NULL),
(3, 'Walker', 'walker@gmail.com', '$2y$10$8kLCp4Ps.lzmzFiev.lPhOcOyO2GNYBRGNinwofp5uH9V.mOPy2mC', 3, 0, 0, 1, NULL, '2017-09-22 18:15:24', '2017-09-22 18:15:24', NULL, 1, 3, NULL, NULL),
(4, 'Slacker', 'slacker@gmail.com', '$2y$10$Plp2zR1tsjcvXXjCNYl/R.s4LozYOdHwnjpYMs4vI.UCMISKAx606', 3, 0, 0, 1, NULL, '2017-09-22 18:15:24', '2017-09-22 18:15:24', NULL, 0, 3, NULL, NULL),
(27, 'toan', 'adcskt1@gmail.com', '$2y$10$rh0YCEB22nyuldIdYWPG5eGv1mRBN8rYEHhaxoFlWsmHTvLvuZ2P6', 3, 0, 0, 1, NULL, '2017-10-03 02:11:59', '2017-10-03 02:15:20', 'i9yyyO9CnjswP77WBDddq98HdxqhYkz49hxK97WQopWBe66hSSH5Uvm0glOO', 1, 0, NULL, NULL),
(28, 'toanlm', 'toanlm@gmail.com', '$2y$10$FlV3Qje1oyyH/J70mS/Yc.SJX8Vw2uagkQh5ftjLpdV6kenhzOPlW', 3, 0, 0, 1, NULL, '2017-10-12 02:50:09', '2017-10-24 21:07:53', NULL, 1, 1, NULL, '1111111111'),
(29, 'ndtdb', 'ndtdb@gmail.com', '$2y$10$J5UE2GkjXJXA0rS8WTpdG.lx7FHLa5349J56XgSsr4Z4whB3LDwN.', 3, 0, 0, 1, NULL, '2017-10-12 03:02:36', '2017-10-24 21:07:53', 'b411N1hWoaPNmGSYb2DnYPDo8MA6hItYfRA5IGJe84OBcGDfuPZccLwty9VZ', 1, 2, NULL, NULL),
(30, 'vay', 'adcskt@gmail.com', '$2y$10$vV43IuxrJmj8pN50Ng0AROyiR3ReqDwJFwnC74LEYF9nX.BVcUvWC', 3, 0, 0, 1, NULL, '2017-10-12 03:03:13', '2017-10-26 00:31:10', '8KUFJXutaJyqTIUZnqmZSlUJwDOSHICcYiMCLI47ifvM4LN9SDhFzm93bNVv', 1, 3, 'USDT', '0xb95c5558fc0b37503c9488fbbc83867ffef2b6ac'),
(31, 'vay2', 'vay2@gmail.com', '$2y$10$cyq.EPq2gF6Kq25Trp9Y2OK071MX4Pc3per0UABcITC8DZhgKTr1O', 3, 0, 0, 1, NULL, '2017-10-12 03:04:46', '2018-03-15 03:04:28', 'HHbCzGRYVySot5JqF8nWL8xZezHg7xGdW1Sl5uWWEy0mGKjPvCQ8L6kUxmb5', 1, 3, 'USDT', '0xb95c5558fc0b37503c9488fbbc83867ffef2b6ac'),
(32, 'test', 'test@gmail.com', '$2y$10$aoKWL585E0zyPpMSu8HQ/.mhPbeDZjdxliedAHex6zSKgC0RYDfmO', 3, 0, 0, 1, NULL, '2017-10-21 01:44:11', '2017-11-08 02:33:51', NULL, 1, 2, 'USDT', NULL),
(33, 'ndt1', 'ndt1@gmail.com', '$2y$10$hgks7FbQWR/puRFQNRFVH.JQw26JBM8VW7bquVYrpMh5AMeBslsl2', 3, 0, 0, 1, NULL, '2017-10-21 23:54:20', '2018-03-06 21:17:28', 'BQIyQDM3KBRhuFy5lzvEf29gqWYvweJPfFZ7NPgQLrD59tyUkL6JjeLBwJl7', 1, 2, 'USDT', '0x9a64d9493de1d1c1377e415460ccf09fcd7ff532'),
(36, 'Lê Mạnh Toàn', 'design@bseatedglobal.com', '', 3, 0, 0, 1, NULL, '2018-03-07 21:30:14', '2018-03-08 03:08:01', 'mz3HO3C9rOI1ucQByaH8FOo3k22wOJM4p3zpftHN64i3rmtqNO4KHvBBNZDW', 0, 2, NULL, NULL),
(37, 'toanlm2', 'testtoan@gmail.com', '$2y$10$83CNFTEgL55rNQT6/hTD9.Ii3537l8m.qtGvTllzI6XWeTWnGuXD2', 3, 0, 0, 1, NULL, '2018-03-08 02:27:05', '2018-03-08 02:27:05', NULL, 0, 2, NULL, NULL),
(38, 'vaynew', 'vaynew@gmail.com', '$2y$10$SS44rCuAmNUJXpVuwz4Ug./nJ3cny4Fe6cV8XA0.dHkZIOoJCgeTW', 3, 0, 0, 1, NULL, '2018-03-14 21:40:59', '2018-03-15 01:40:34', 'gQo5zNJIm3AbA6avCEnM5fl0LbBZrmrPxDND3dUEpPDCyEFOz2MHJguRrv0w', 1, 3, NULL, '0x9a64d9493de1d1c1377e415460ccf09fcd7ff532');

-- --------------------------------------------------------

--
-- Table structure for table `user_activations`
--

CREATE TABLE `user_activations` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_activations`
--

INSERT INTO `user_activations` (`user_id`, `token`, `created_at`) VALUES
(28, 'bbd4fc4e976541dc5cfb4cb5993b0597e70736c51441559e645adc7096431cfe', '2017-10-12 02:50:09'),
(29, '6d80fda1862c55b9aba54038e7176937d9175c335519dfa92dcc0da2a0c9ef9e', '2017-10-12 03:02:36'),
(30, '3588532a5e37b493480683756fb0ba9df0acbe8f0564b0ec4d5f544f49baaf5b', '2017-10-12 03:03:14'),
(31, '5ad5cf7386b0a858866ce059e690d8f0d285adaeb679d9ad424b71de82bdf328', '2017-10-12 03:04:46'),
(33, '3b9df710971a7835688cd3ed8381c8e0e95bb98daacae129f9538aca472a6694', '2017-10-21 23:54:20'),
(37, '16cdbd3468cb6cffc61b72c771ed079dcfc836f2df0d0163d25de52120c806f6', '2018-03-08 02:27:05'),
(36, 'e6d7c9af8284a613bb2967484a9265d4de7e7174659a13e9ab1f464387693e62', '2018-03-08 02:46:56'),
(38, 'c5921e9c0903d728ae650ef11e00042968963869fd9923ed02ec94ae504818e9', '2018-03-14 21:40:59');

-- --------------------------------------------------------

--
-- Table structure for table `user_bank`
--

CREATE TABLE `user_bank` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `bank_name` varchar(200) NOT NULL,
  `bank_number` varchar(200) NOT NULL,
  `bank_username` varchar(200) NOT NULL,
  `exp_month` int(11) NOT NULL,
  `exp_year` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_id`
--

CREATE TABLE `user_id` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `type` int(11) NOT NULL COMMENT '0: cmnd; 1: passport',
  `front` varchar(255) NOT NULL,
  `back` varchar(255) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0: wait, 1: accept; 2: reject',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_id`
--

INSERT INTO `user_id` (`id`, `uid`, `type`, `front`, `back`, `status`, `created_at`, `updated_at`) VALUES
(2, 30, 1, '59f0513f28a51_Screenshot_1.png', '59f0513f29114_db.jpg', 1, '2017-10-25 01:54:23', '2017-10-25 02:54:41'),
(3, 30, 0, '59f052edd5318_Inkednew_LI.jpg', '59f052edd5a57_lending.jpg', 0, '2017-10-25 02:01:33', '2017-10-25 02:54:41'),
(4, 1, 0, '59ff35460b609_Volvo_X664279WL_1.JPG', '59ff35460ba88_Volvo_WP282_V1.JPG', 1, '2017-11-05 08:59:02', '2017-11-05 08:59:44');

-- --------------------------------------------------------

--
-- Table structure for table `user_summary`
--

CREATE TABLE `user_summary` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `address` varchar(255) NOT NULL COMMENT 'address of user credit',
  `value` decimal(20,2) NOT NULL COMMENT 'value of money',
  `transferType` int(11) NOT NULL COMMENT '0: Nha dau tu dac biet chuyen, 1: NDT chuyen, 2: Nguoivay chuen, 3: NDT rut, 4: Nguoivay rut',
  `moneyType` varchar(20) NOT NULL COMMENT 'ETC, ETH, ...',
  `isType` int(11) NOT NULL COMMENT '1: add, 0: minus',
  `status` int(11) NOT NULL COMMENT '1: dang su dung, 0: het han',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_total`
--

CREATE TABLE `user_total` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `total` decimal(20,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_ip`
--
ALTER TABLE `admin_ip`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `borrow`
--
ALTER TABLE `borrow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `checkout`
--
ALTER TABLE `checkout`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_user_id_foreign` (`user_id`),
  ADD KEY `comments_post_id_foreign` (`post_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hash_confirm`
--
ALTER TABLE `hash_confirm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invest`
--
ALTER TABLE `invest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_slug_unique` (`slug`),
  ADD KEY `posts_user_id_foreign` (`user_id`);

--
-- Indexes for table `post_tag`
--
ALTER TABLE `post_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_tag_post_id_foreign` (`post_id`),
  ADD KEY `post_tag_tag_id_foreign` (`tag_id`);

--
-- Indexes for table `request_checkout`
--
ALTER TABLE `request_checkout`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slideshow`
--
ALTER TABLE `slideshow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tags_tag_unique` (`tag`);

--
-- Indexes for table `temp_summary`
--
ALTER TABLE `temp_summary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Indexes for table `user_activations`
--
ALTER TABLE `user_activations`
  ADD KEY `user_activations_token_index` (`token`);

--
-- Indexes for table `user_bank`
--
ALTER TABLE `user_bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_id`
--
ALTER TABLE `user_id`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_summary`
--
ALTER TABLE `user_summary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_total`
--
ALTER TABLE `user_total`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_ip`
--
ALTER TABLE `admin_ip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `borrow`
--
ALTER TABLE `borrow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `checkout`
--
ALTER TABLE `checkout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `hash_confirm`
--
ALTER TABLE `hash_confirm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `invest`
--
ALTER TABLE `invest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `post_tag`
--
ALTER TABLE `post_tag`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `request_checkout`
--
ALTER TABLE `request_checkout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `slideshow`
--
ALTER TABLE `slideshow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `temp_summary`
--
ALTER TABLE `temp_summary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `user_bank`
--
ALTER TABLE `user_bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_id`
--
ALTER TABLE `user_id`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user_summary`
--
ALTER TABLE `user_summary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_total`
--
ALTER TABLE `user_total`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `post_tag`
--
ALTER TABLE `post_tag`
  ADD CONSTRAINT `post_tag_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `post_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
