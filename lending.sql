-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2017 at 12:19 PM
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
(3, 'Martin', 'martin@la.fr', 'Lorem ipsum tempor netus aenean ligula habitant vehicula tempor ultrices, placerat sociosqu ultrices consectetur ullamcorper tincidunt quisque tellus, ante nostra euismod nec suspendisse sem curabitur elit. Malesuada lacus viverra sagittis sit ornare orci, augue nullam adipiscing pulvinar libero aliquam vestibulum, platea cursus pellentesque leo dui. Lectus curabitur euismod ad, erat.', 1, '2017-09-22 18:15:25', '2017-09-22 18:15:25');

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
('2017_10_02_094432_create_social_accounts_table', 2);

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
(1, '2017-09-22 18:15:26', '2017-09-22 18:15:26', 'Post 1', 'post-1', '<img alt=\"\" src=\"/filemanager/userfiles/user2/mega-champignon.png\" style=\"float:left; height:128px; width:128px\" /><p>\nLorem ipsum morbi fringilla sapien faucibus ligula commodo, vestibulum rutrum pretium varius sem aliquet himenaeos, dolor cursus nunc habitasse aliquam ut. \nCurabitur ipsum luctus ut rutrum odio condimentum donec suscipit molestie est etiam, sit rutrum dui nostra sem aliquet conubia nullam sollicitudin. \nRhoncus venenatis vivamus rhoncus netus, risus tortor non. \n</p>', '<p>\nLorem ipsum imperdiet turpis eget integer nibh dolor, commodo venenatis ut molestie semper adipiscing, amet cras class donec sapien malesuada. \nAuctor sapien arcu inceptos aenean consequat metus litora mattis vivamus feugiat, arcu adipiscing mauris primis ante ullamcorper ad nisi. \nLobortis arcu per orci malesuada blandit metus, tortor urna turpis consectetur porttitor egestas sed, eleifend eget tincidunt pharetra varius. \nTincidunt morbi malesuada elementum mi torquent mollis eu lobortis curae, purus amet vivamus amet nulla torquent nibh eu diam aliquam, pretium donec aliquam tempus lacus tempus feugiat lectus. \nCras non velit mollis sit et integer egestas habitant auctor integer sem, at nam massa himenaeos netus vel dapibus nibh malesuada. \n</p>\n<p>\nLeo fusce tortor sociosqu semper facilisis semper class, tempus faucibus tristique duis eros cubilia quisque, habitasse aliquam fringilla orci non vel. \nLaoreet dolor enim justo facilisis neque accumsan in ad venenatis hac, per dictumst nulla ligula donec mollis massa porttitor ullamcorper, risus eu platea fringilla habitasse suscipit pellentesque donec est. \nHabitant vehicula tempor ultrices placerat sociosqu ultrices, consectetur ullamcorper tincidunt quisque tellus ante nostra, euismod nec suspendisse sem curabitur. \nElit malesuada lacus viverra sagittis sit ornare orci augue nullam adipiscing, pulvinar libero aliquam vestibulum platea cursus pellentesque leo dui, lectus curabitur euismod ad erat curae non elit ultrices. \n</p>\n<p>\nPlacerat netus metus feugiat non conubia fusce, porttitor sociosqu diam commodo metus in himenaeos, vitae aptent consequat luctus purus. \nEleifend enim sollicitudin eleifend porta malesuada ac class conubia, condimentum mauris facilisis conubia quis scelerisque lacinia tempus, nullam felis fusce ac potenti netus ornare. \nSemper molestie iaculis fermentum ornare curabitur tincidunt imperdiet scelerisque imperdiet euismod scelerisque torquent curae rhoncus, sollicitudin tortor placerat aptent hac nec posuere suscipit sed tortor neque urna. \nHendrerit vehicula duis litora tristique congue nec auctor, felis libero ornare habitasse nec elit felis inceptos, tellus inceptos cubilia quis mattis faucibus. \n</p>\n<p>\nSem non odio fringilla class aliquam metus ipsum lorem luctus pharetra, dictum vehicula tempus in venenatis gravida ut gravida proin, orci quis sed platea mi quisque hendrerit semper hendrerit. \nFacilisis ante sapien faucibus ligula commodo vestibulum rutrum pretium, varius sem aliquet himenaeos dolor cursus nunc, habitasse aliquam ut curabitur ipsum luctus ut. \nRutrum odio condimentum donec suscipit molestie est, etiam sit rutrum dui nostra, sem aliquet conubia nullam sollicitudin. \nRhoncus venenatis vivamus rhoncus netus risus tortor non, mauris turpis eget integer nibh dolor, commodo venenatis ut molestie semper adipiscing. \n</p>\n<p>\nAmet cras class donec sapien malesuada auctor, sapien arcu inceptos aenean consequat metus, litora mattis vivamus feugiat arcu. \nAdipiscing mauris primis ante ullamcorper ad nisi lobortis arcu per, orci malesuada blandit metus tortor urna turpis consectetur porttitor, egestas sed eleifend eget tincidunt pharetra varius tincidunt. \nMorbi malesuada elementum mi torquent mollis eu lobortis, curae purus amet vivamus amet nulla torquent nibh, eu diam aliquam pretium donec aliquam. \nTempus lacus tempus feugiat lectus cras non velit mollis, sit et integer egestas habitant auctor integer sem, at nam massa himenaeos netus vel dapibus. \n</p>\n<p>\nNibh malesuada leo fusce tortor sociosqu semper facilisis semper, class tempus faucibus tristique duis eros cubilia, quisque habitasse aliquam fringilla orci non vel. \n</p>', 0, 1, 1),
(2, '2017-09-22 18:15:26', '2017-09-22 18:15:26', 'Post 2', 'post-2', '<img alt=\"\" src=\"/filemanager/userfiles/user2/goomba.png\" style=\"float:left; height:128px; width:128px\" /><p>\nLorem ipsum vel justo facilisis neque accumsan in ad venenatis, hac per dictumst nulla ligula donec mollis massa, porttitor ullamcorper risus eu platea fringilla habitasse suscipit. \nPellentesque donec est habitant vehicula, tempor ultrices placerat sociosqu ultrices, consectetur ullamcorper tincidunt. \nQuisque tellus ante nostra euismod, nec suspendisse sem, curabitur elit malesuada. \n</p>', '<p>Lorem ipsum convallis ac curae non elit ultrices placerat netus metus feugiat, non conubia fusce porttitor sociosqu diam commodo metus in himenaeos, vitae aptent consequat luctus purus eleifend enim sollicitudin eleifend porta. Malesuada ac class conubia condimentum mauris facilisis conubia quis scelerisque lacinia, tempus nullam felis fusce ac potenti netus ornare semper. Molestie iaculis fermentum ornare curabitur tincidunt imperdiet scelerisque, imperdiet euismod scelerisque torquent curae rhoncus, sollicitudin tortor placerat aptent hac nec. Posuere suscipit sed tortor neque urna hendrerit vehicula duis litora tristique congue nec auctor felis libero, ornare habitasse nec elit felis inceptos tellus inceptos cubilia quis mattis faucibus sem non.</p>\n\n<p>Odio fringilla class aliquam metus ipsum lorem luctus pharetra dictum, vehicula tempus in venenatis gravida ut gravida proin orci, quis sed platea mi quisque hendrerit semper hendrerit. Facilisis ante sapien faucibus ligula commodo vestibulum rutrum pretium, varius sem aliquet himenaeos dolor cursus nunc habitasse, aliquam ut curabitur ipsum luctus ut rutrum. Odio condimentum donec suscipit molestie est etiam sit rutrum dui nostra, sem aliquet conubia nullam sollicitudin rhoncus venenatis vivamus rhoncus netus, risus tortor non mauris turpis eget integer nibh dolor. Commodo venenatis ut molestie semper adipiscing amet cras, class donec sapien malesuada auctor sapien arcu inceptos, aenean consequat metus litora mattis vivamus.</p>\n\n<pre>\n<code class=\"language-php\">protected function getUserByRecaller($recaller)\n{\n	if ($this-&gt;validRecaller($recaller) &amp;&amp; ! $this-&gt;tokenRetrievalAttempted)\n	{\n		$this-&gt;tokenRetrievalAttempted = true;\n\n		list($id, $token) = explode(\"|\", $recaller, 2);\n\n		$this-&gt;viaRemember = ! is_null($user = $this-&gt;provider-&gt;retrieveByToken($id, $token));\n\n		return $user;\n	}\n}</code></pre>\n\n<p>Feugiat arcu adipiscing mauris primis ante ullamcorper ad nisi, lobortis arcu per orci malesuada blandit metus tortor, urna turpis consectetur porttitor egestas sed eleifend. Eget tincidunt pharetra varius tincidunt morbi malesuada elementum mi torquent mollis, eu lobortis curae purus amet vivamus amet nulla torquent, nibh eu diam aliquam pretium donec aliquam tempus lacus. Tempus feugiat lectus cras non velit mollis sit et integer, egestas habitant auctor integer sem at nam massa himenaeos, netus vel dapibus nibh malesuada leo fusce tortor. Sociosqu semper facilisis semper class tempus faucibus tristique duis eros, cubilia quisque habitasse aliquam fringilla orci non vel, laoreet dolor enim justo facilisis neque accumsan in.</p>\n\n<p>Ad venenatis hac per dictumst nulla ligula donec, mollis massa porttitor ullamcorper risus eu platea, fringilla habitasse suscipit pellentesque donec est. Habitant vehicula tempor ultrices placerat sociosqu ultrices consectetur ullamcorper tincidunt quisque tellus, ante nostra euismod nec suspendisse sem curabitur elit malesuada lacus. Viverra sagittis sit ornare orci augue nullam adipiscing pulvinar libero aliquam vestibulum platea cursus pellentesque leo dui lectus, curabitur euismod ad erat curae non elit ultrices placerat netus metus feugiat non conubia fusce porttitor. Sociosqu diam commodo metus in himenaeos vitae aptent consequat luctus purus eleifend enim sollicitudin eleifend, porta malesuada ac class conubia condimentum mauris facilisis conubia quis scelerisque lacinia.</p>\n\n<p>Tempus nullam felis fusce ac potenti netus ornare semper molestie iaculis, fermentum ornare curabitur tincidunt imperdiet scelerisque imperdiet euismod. Scelerisque torquent curae rhoncus sollicitudin tortor placerat aptent hac, nec posuere suscipit sed tortor neque urna hendrerit, vehicula duis litora tristique congue nec auctor. Felis libero ornare habitasse nec elit felis, inceptos tellus inceptos cubilia quis mattis, faucibus sem non odio fringilla. Class aliquam metus ipsum lorem luctus pharetra dictum vehicula, tempus in venenatis gravida ut gravida proin orci, quis sed platea mi quisque hendrerit semper.</p>\n', 0, 1, 2),
(3, '2017-09-22 18:15:26', '2017-09-22 18:15:26', 'Post 3', 'post-3', '<img alt=\"\" src=\"/filemanager/userfiles/user2/rouge-shell.png\" style=\"float:left; height:128px; width:128px\" /><p>\nLorem ipsum eros viverra sagittis sit ornare orci augue nullam adipiscing pulvinar, libero aliquam vestibulum platea cursus pellentesque leo dui lectus curabitur. \nEuismod ad erat curae non elit ultrices placerat, netus metus feugiat non conubia fusce porttitor, sociosqu diam commodo metus in himenaeos vitae, aptent consequat luctus purus eleifend enim. \n</p>', '<p>\nLorem ipsum ut eleifend porta malesuada ac, class conubia condimentum mauris facilisis conubia quis, scelerisque lacinia tempus nullam felis. \nFusce ac potenti netus ornare semper molestie, iaculis fermentum ornare curabitur tincidunt imperdiet scelerisque, imperdiet euismod scelerisque torquent curae. \nRhoncus sollicitudin tortor placerat aptent hac nec posuere suscipit sed, tortor neque urna hendrerit vehicula duis litora tristique, congue nec auctor felis libero ornare habitasse nec. \nElit felis inceptos tellus inceptos cubilia quis mattis faucibus sem non odio, fringilla class aliquam metus ipsum lorem luctus pharetra dictum vehicula. \nTempus in venenatis gravida ut gravida proin orci quis sed, platea mi quisque hendrerit semper hendrerit facilisis ante, sapien faucibus ligula commodo vestibulum rutrum pretium varius. \n</p>\n<p>\nSem aliquet himenaeos dolor cursus nunc habitasse aliquam ut, curabitur ipsum luctus ut rutrum odio condimentum donec, suscipit molestie est etiam sit rutrum dui. \nNostra sem aliquet conubia nullam sollicitudin rhoncus venenatis vivamus rhoncus netus, risus tortor non mauris turpis eget integer nibh dolor commodo, venenatis ut molestie semper adipiscing amet cras class donec. \nSapien malesuada auctor sapien arcu inceptos aenean consequat metus litora mattis vivamus, feugiat arcu adipiscing mauris primis ante ullamcorper ad nisi lobortis, arcu per orci malesuada blandit metus tortor urna turpis consectetur. \nPorttitor egestas sed eleifend eget tincidunt, pharetra varius tincidunt morbi malesuada elementum, mi torquent mollis eu. \n</p>\n<p>\nLobortis curae purus amet vivamus amet nulla torquent nibh eu, diam aliquam pretium donec aliquam tempus lacus tempus feugiat, lectus cras non velit mollis sit et integer. \nEgestas habitant auctor integer sem at nam massa himenaeos netus, vel dapibus nibh malesuada leo fusce tortor sociosqu, semper facilisis semper class tempus faucibus tristique duis. \nEros cubilia quisque habitasse aliquam fringilla orci non, vel laoreet dolor enim justo facilisis, neque accumsan in ad venenatis hac. \nPer dictumst nulla ligula donec mollis massa porttitor ullamcorper risus eu platea, fringilla habitasse suscipit pellentesque donec est habitant vehicula tempor ultrices. \n</p>\n<p>\nPlacerat sociosqu ultrices consectetur ullamcorper tincidunt quisque, tellus ante nostra euismod nec, suspendisse sem curabitur elit malesuada. \nLacus viverra sagittis sit ornare orci augue nullam, adipiscing pulvinar libero aliquam vestibulum platea cursus, pellentesque leo dui lectus curabitur euismod. \nAd erat curae non elit ultrices placerat netus, metus feugiat non conubia fusce porttitor sociosqu, diam commodo metus in himenaeos vitae. \nAptent consequat luctus purus eleifend enim sollicitudin eleifend porta, malesuada ac class conubia condimentum mauris facilisis conubia quis, scelerisque lacinia tempus nullam felis fusce ac. \nPotenti netus ornare semper molestie iaculis fermentum ornare curabitur tincidunt imperdiet scelerisque, imperdiet euismod scelerisque torquent curae rhoncus sollicitudin tortor placerat aptent hac, nec posuere suscipit sed tortor neque urna hendrerit vehicula duis. \n</p>\n<p>\nLitora tristique congue nec auctor felis libero ornare habitasse, nec elit felis inceptos tellus inceptos cubilia, quis mattis faucibus sem non odio fringilla. \nClass aliquam metus ipsum lorem luctus pharetra dictum vehicula, tempus in venenatis gravida ut gravida proin orci quis, sed platea mi quisque hendrerit semper hendrerit. \nFacilisis ante sapien faucibus ligula commodo vestibulum rutrum pretium varius, sem aliquet himenaeos dolor cursus nunc habitasse aliquam, ut curabitur ipsum luctus ut rutrum odio condimentum. \n</p>', 0, 1, 2),
(4, '2017-09-22 18:15:26', '2017-09-22 18:15:26', 'Post 4', 'post-4', '<img alt=\"\" src=\"/filemanager/userfiles/user2/rouge-shyguy.png\" style=\"float:left; height:128px; width:128px\" /><p>\nLorem ipsum felis mauris molestie est etiam sit rutrum dui nostra, sem aliquet conubia nullam sollicitudin rhoncus venenatis vivamus rhoncus, netus risus tortor non mauris turpis eget integer nibh dolor, commodo venenatis ut molestie semper adipiscing amet cras. \nClass donec sapien malesuada auctor sapien arcu, inceptos aenean consequat metus litora. \n</p>', '<p>\nLorem ipsum dictumst vivamus feugiat arcu adipiscing mauris primis ante, ullamcorper ad nisi lobortis arcu per orci malesuada. \nBlandit metus tortor urna turpis consectetur porttitor egestas, sed eleifend eget tincidunt pharetra varius tincidunt morbi, malesuada elementum mi torquent mollis eu. \nLobortis curae purus amet vivamus amet nulla torquent nibh eu, diam aliquam pretium donec aliquam tempus lacus tempus feugiat lectus, cras non velit mollis sit et integer egestas. \nHabitant auctor integer sem at nam massa, himenaeos netus vel dapibus nibh, malesuada leo fusce tortor sociosqu. \nSemper facilisis semper class tempus faucibus tristique duis eros cubilia quisque, habitasse aliquam fringilla orci non vel laoreet dolor enim justo, facilisis neque accumsan in ad venenatis hac per dictumst. \n</p>\n<p>\nNulla ligula donec mollis massa porttitor ullamcorper risus, eu platea fringilla habitasse suscipit pellentesque, donec est habitant vehicula tempor ultrices. \nPlacerat sociosqu ultrices consectetur ullamcorper tincidunt quisque tellus ante nostra euismod nec suspendisse sem, curabitur elit malesuada lacus viverra sagittis sit ornare orci augue nullam adipiscing, pulvinar libero aliquam vestibulum platea cursus pellentesque leo dui lectus curabitur euismod. \nAd erat curae non elit ultrices placerat netus metus feugiat non conubia fusce, porttitor sociosqu diam commodo metus in himenaeos vitae aptent consequat luctus. \nPurus eleifend enim sollicitudin eleifend porta malesuada ac class conubia, condimentum mauris facilisis conubia quis scelerisque lacinia tempus nullam, felis fusce ac potenti netus ornare semper molestie. \n</p>\n<p>\nIaculis fermentum ornare curabitur tincidunt imperdiet scelerisque imperdiet euismod scelerisque, torquent curae rhoncus sollicitudin tortor placerat aptent hac nec, posuere suscipit sed tortor neque urna hendrerit vehicula. \nDuis litora tristique congue nec auctor felis, libero ornare habitasse nec elit, felis inceptos tellus inceptos cubilia. \nQuis mattis faucibus sem non odio fringilla class aliquam metus ipsum, lorem luctus pharetra dictum vehicula tempus in venenatis gravida ut gravida, proin orci quis sed platea mi quisque hendrerit semper. \nHendrerit facilisis ante sapien faucibus ligula commodo vestibulum rutrum, pretium varius sem aliquet himenaeos dolor cursus, nunc habitasse aliquam ut curabitur ipsum luctus. \n</p>\n<p>\nUt rutrum odio condimentum donec suscipit molestie est etiam sit rutrum dui nostra sem, aliquet conubia nullam sollicitudin rhoncus venenatis vivamus rhoncus netus risus tortor. \nNon mauris turpis eget integer nibh dolor commodo venenatis ut, molestie semper adipiscing amet cras class donec sapien, malesuada auctor sapien arcu inceptos aenean consequat metus. \nLitora mattis vivamus feugiat arcu adipiscing mauris, primis ante ullamcorper ad nisi, lobortis arcu per orci malesuada. \nBlandit metus tortor urna turpis consectetur porttitor egestas, sed eleifend eget tincidunt pharetra varius, tincidunt morbi malesuada elementum mi torquent mollis, eu lobortis curae purus amet. \n</p>\n<p>\nVivamus amet nulla torquent nibh eu diam aliquam pretium, donec aliquam tempus lacus tempus feugiat. \nLectus cras non velit mollis sit et integer egestas, habitant auctor integer sem at nam massa himenaeos netus, vel dapibus nibh malesuada leo fusce tortor. \nSociosqu semper facilisis semper class tempus faucibus tristique duis eros cubilia quisque habitasse aliquam fringilla orci, non vel laoreet dolor enim justo facilisis neque accumsan in ad venenatis hac. \nPer dictumst nulla ligula donec mollis massa porttitor ullamcorper, risus eu platea fringilla habitasse suscipit. \n</p>', 0, 1, 2);

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
(2, 'Redactor', 'redac', '2017-09-22 18:15:23', '2017-09-22 18:15:23'),
(3, 'User', 'user', '2017-09-22 18:15:23', '2017-09-22 18:15:23');

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
(9, '1421237081319149', 'facebook', '2017-10-02 03:12:14', '2017-10-02 03:12:14');

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
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role_id`, `seen`, `valid`, `confirmed`, `confirmation_code`, `created_at`, `updated_at`, `remember_token`) VALUES
(1, 'GreatAdmin', 'admin@la.fr', '$2y$10$a7LWpCz.C2bDQQinhE5Jju5tDiW1EQFqT7HWZKWdh/jL3uXzEdcja', 1, 1, 0, 1, NULL, '2017-09-22 18:15:23', '2017-09-22 18:15:23', NULL),
(2, 'GreatRedactor', 'redac@la.fr', '$2y$10$Cxk19TMvUgupcknjBOXPL.rFJkv0sFk8WAsz5uHfLa7dKSl.6rKA2', 2, 1, 1, 1, NULL, '2017-09-22 18:15:24', '2017-09-22 18:15:24', NULL),
(3, 'Walker', 'walker@la.fr', '$2y$10$8kLCp4Ps.lzmzFiev.lPhOcOyO2GNYBRGNinwofp5uH9V.mOPy2mC', 3, 0, 0, 1, NULL, '2017-09-22 18:15:24', '2017-09-22 18:15:24', NULL),
(4, 'Slacker', 'slacker@la.fr', '$2y$10$Plp2zR1tsjcvXXjCNYl/R.s4LozYOdHwnjpYMs4vI.UCMISKAx606', 3, 0, 0, 1, NULL, '2017-09-22 18:15:24', '2017-09-22 18:15:24', NULL),
(9, 'Lê Mạnh Toàn', 'toanktv.it@gmail.com', '', 1, 0, 0, 0, NULL, '2017-10-02 03:11:18', '2017-10-02 03:11:18', NULL);

--
-- Indexes for dumped tables
--

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
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tags_tag_unique` (`tag`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
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
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
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
