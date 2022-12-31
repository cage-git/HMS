-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 28, 2021 at 09:33 AM
-- Server version: 5.7.24
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gnbckymy_hms`
--

-- --------------------------------------------------------

--
-- Table structure for table `aboutus_sections`
--

DROP TABLE IF EXISTS `aboutus_sections`;
CREATE TABLE `aboutus_sections` (
  `id` int(11) NOT NULL,
  `about_section_banner` varchar(255) DEFAULT NULL,
  `about_section_tagline` varchar(255) DEFAULT NULL,
  `about_section_heading` varchar(255) DEFAULT NULL,
  `about_section_desc` text,
  `about_section_image` varchar(255) DEFAULT NULL,
  `about_section_button` int(11) DEFAULT '0',
  `about_section_btntxt` varchar(100) DEFAULT NULL,
  `about_section_features` longtext,
  `about_section_publish` int(11) DEFAULT '1',
  `ourteam_section_tagline` varchar(255) DEFAULT NULL,
  `ourteam_section_heading` varchar(255) DEFAULT NULL,
  `ourteam_section_publish` int(11) NOT NULL DEFAULT '1',
  `testimonial_section_publish` int(11) DEFAULT '1',
  `counter_section_publish` int(11) DEFAULT '1',
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aboutus_sections`
--

INSERT INTO `aboutus_sections` (`id`, `about_section_banner`, `about_section_tagline`, `about_section_heading`, `about_section_desc`, `about_section_image`, `about_section_button`, `about_section_btntxt`, `about_section_features`, `about_section_publish`, `ourteam_section_tagline`, `ourteam_section_heading`, `ourteam_section_publish`, `testimonial_section_publish`, `counter_section_publish`, `updated_at`, `created_at`) VALUES
(1, '0f31180b891971f51b3a5dbbb7079f8b_1636953222.jpg', 'We are dynamic team of creative people', 'What we are', 'We provide consulting services in the area of IFRS and management reporting, helping companies to reach their highest level. We optimize business processes, making them easier.', '5209a00e9d647cf7daf5d2c42aea6b49_1636953238.jpg', 0, NULL, '[{\"title\":\"Vission\",\"short_desc\":\"llum similique ducimus accusamus laudantium praesentium, impedit quaerat, itaque maxime sunt deleniti voluptas distinctio .\"},{\"title\":\"Our Approach\",\"short_desc\":\"llum similique ducimus accusamus laudantium praesentium, impedit quaerat, itaque maxime sunt deleniti voluptas distinctio .\"}]', 1, 'Our Team', 'Expert Team member to get best service', 1, 1, 1, '2021-11-17 12:01:10', '2019-09-11 09:14:55');

-- --------------------------------------------------------

--
-- Table structure for table `alert_templates`
--

DROP TABLE IF EXISTS `alert_templates`;
CREATE TABLE `alert_templates` (
  `id` int(11) NOT NULL,
  `template` longtext NOT NULL,
  `type` enum('sms','email') NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1-Checkin,2-Checkout,3-food bill',
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alert_templates`
--

INSERT INTO `alert_templates` (`id`, `template`, `type`, `status`, `updated_at`, `created_at`) VALUES
(1, 'Hi ##NAME##,Welcome to Quickbuzz Paradise Hotel.For any kind of requirement or you wish to order food please contact below.Wish you a happy stay.', 'sms', 2, NULL, '2019-10-28 15:05:34'),
(2, 'Thanks for visiting Quickbuzz Paradise Hotel.We hope you like our services.We wish to serve you again,contact for room booking & restaurant services.', 'sms', 1, NULL, '2019-10-28 15:05:34'),
(3, 'Hi ##NAME##,Thanks for visiting Quickbuzz Paradise Hotel.We wish to serve you again,For room booking & food order or parties,contact-', 'sms', 3, NULL, '2019-10-28 15:05:34');

-- --------------------------------------------------------

--
-- Table structure for table `amenities`
--

DROP TABLE IF EXISTS `amenities`;
CREATE TABLE `amenities` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `status` int(11) NOT NULL DEFAULT '1',
  `is_deleted` int(11) NOT NULL DEFAULT '0',
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `amenities`
--

INSERT INTO `amenities` (`id`, `name`, `description`, `status`, `is_deleted`, `updated_at`, `created_at`) VALUES
(1, '24-Hour Guest Reception', NULL, 1, 0, '2021-11-06 12:12:51', '2021-09-06 04:11:36'),
(2, 'Room Service', NULL, 1, 0, '2021-11-06 12:12:44', '2021-11-06 06:41:19'),
(3, 'Free Wifi', NULL, 1, 0, '2021-11-06 12:12:37', '2021-11-06 06:41:36'),
(4, 'Parking', NULL, 1, 0, '2021-11-06 12:12:14', '2021-11-06 06:42:14'),
(5, 'Healthy Breakfast', NULL, 1, 0, '2021-11-06 12:13:09', '2021-11-06 06:43:09'),
(6, 'Flexible Checkout', NULL, 1, 0, '2021-11-06 12:13:20', '2021-11-06 06:43:20'),
(7, 'Mini-fridge', NULL, 1, 0, '2021-11-06 12:13:29', '2021-11-06 06:43:29'),
(8, 'Free Breakfast', NULL, 1, 0, '2021-11-06 12:13:36', '2021-11-06 06:43:36'),
(9, 'Premium Bedding', NULL, 1, 0, '2021-11-06 12:13:46', '2021-11-06 06:43:46'),
(10, 'Fancy Bathrobes', NULL, 1, 0, '2021-11-06 12:13:58', '2021-11-06 06:43:58');

-- --------------------------------------------------------

--
-- Table structure for table `booked_rooms`
--

DROP TABLE IF EXISTS `booked_rooms`;
CREATE TABLE `booked_rooms` (
  `id` int(11) NOT NULL,
  `reservation_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `room_type_id` int(11) NOT NULL,
  `room_price` float(10,2) NOT NULL,
  `check_in` datetime DEFAULT NULL,
  `check_out` datetime DEFAULT NULL,
  `swapped_from_room` int(11) DEFAULT NULL,
  `is_checkout` int(11) NOT NULL DEFAULT '0',
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

DROP TABLE IF EXISTS `carts`;
CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `date_from` datetime NOT NULL,
  `date_to` datetime NOT NULL,
  `adult` int(11) NOT NULL DEFAULT '0',
  `kids` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contactus_sections`
--

DROP TABLE IF EXISTS `contactus_sections`;
CREATE TABLE `contactus_sections` (
  `id` int(11) NOT NULL,
  `banner_image` varchar(255) DEFAULT NULL,
  `tagline` varchar(255) DEFAULT NULL,
  `heading` varchar(255) DEFAULT NULL,
  `facebook_link` varchar(255) DEFAULT NULL,
  `twitter_link` varchar(255) DEFAULT NULL,
  `linkedin_link` varchar(255) DEFAULT NULL,
  `instagram_link` varchar(255) DEFAULT NULL,
  `youtube_link` varchar(255) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contactus_sections`
--

INSERT INTO `contactus_sections` (`id`, `banner_image`, `tagline`, `heading`, `facebook_link`, `twitter_link`, `linkedin_link`, `instagram_link`, `youtube_link`, `updated_at`, `created_at`) VALUES
(1, '62ec5ae02c8168212c128d09489c1a71_1637298355.jpg', 'Get in touch with us', 'H Innovations is a complete mobile & web solutions provider.', 'fb', 'tw', 'link', 'int', 't', '2021-11-19 10:35:55', '2019-08-20 05:18:31');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `phonecode` varchar(15) DEFAULT NULL,
  `sortname` varchar(20) DEFAULT NULL,
  `sort_order` int(2) NOT NULL DEFAULT '10',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `is_gulf` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `icon`, `phonecode`, `sortname`, `sort_order`, `status`, `is_gulf`, `created_at`, `updated_at`) VALUES
(1, 'Afghanistan', 'https://restcountries.eu/data/afg.svg', '93', 'AF', 10, 0, 1, '2018-05-23 09:04:30', '2018-05-23 09:20:54'),
(2, 'Albania', 'https://restcountries.eu/data/alb.svg', '355', 'AL', 10, 0, 1, '2018-05-23 09:04:30', '2018-05-23 09:20:54'),
(3, 'Algeria', 'https://restcountries.eu/data/dza.svg', '213', 'DZ', 10, 0, 1, '2018-05-23 09:04:30', '2018-05-23 09:20:54'),
(4, 'American Samoa', 'https://restcountries.eu/data/asm.svg', '1684', 'AS', 10, 0, 1, '2018-05-23 09:04:30', '2018-05-23 09:20:54'),
(5, 'Angola', 'https://restcountries.eu/data/ago.svg', '244', 'AO', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:54'),
(6, 'Anguilla', 'https://restcountries.eu/data/aia.svg', '1264', 'AI', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:54'),
(7, 'Antartica', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(8, 'Antigua and Barbuda', 'https://restcountries.eu/data/atg.svg', '1268', 'AG', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:54'),
(9, 'Argentina', 'https://restcountries.eu/data/arg.svg', '54', 'AR', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:54'),
(10, 'Armenia', 'https://restcountries.eu/data/arm.svg', '374', 'AM', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:54'),
(11, 'Aruba', 'https://restcountries.eu/data/abw.svg', '297', 'AW', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:54'),
(12, 'Ashmore and Cartier Island', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(13, 'Australia', 'https://restcountries.eu/data/aus.svg', '61', 'AU', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:54'),
(14, 'Austria', 'https://restcountries.eu/data/aut.svg', '43', 'AT', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:54'),
(15, 'Azerbaijan', 'https://restcountries.eu/data/aze.svg', '994', 'AZ', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:54'),
(16, 'Bahamas', 'https://restcountries.eu/data/bhs.svg', '1242', 'BS', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:55'),
(17, 'Bahrain', 'https://restcountries.eu/data/bhr.svg', '973', 'BH', 5, 1, 1, '2018-05-23 09:04:30', '2018-05-23 09:20:55'),
(18, 'Bangladesh', 'https://restcountries.eu/data/bgd.svg', '880', 'BD', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:55'),
(19, 'Barbados', 'https://restcountries.eu/data/brb.svg', '1246', 'BB', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:55'),
(20, 'Belarus', 'https://restcountries.eu/data/blr.svg', '375', 'BY', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:55'),
(21, 'Belgium', 'https://restcountries.eu/data/bel.svg', '32', 'BE', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:55'),
(22, 'Belize', 'https://restcountries.eu/data/blz.svg', '501', 'BZ', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:55'),
(23, 'Benin', 'https://restcountries.eu/data/ben.svg', '229', 'BJ', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:55'),
(24, 'Bermuda', 'https://restcountries.eu/data/bmu.svg', '1441', 'BM', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:55'),
(25, 'Bhutan', 'https://restcountries.eu/data/btn.svg', '975', 'BT', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:55'),
(26, 'Bolivia', 'BA', '387', 'BAM', 10, 1, 0, '2018-05-23 09:04:30', NULL),
(27, 'Bosnia and Herzegovina', 'https://restcountries.eu/data/bih.svg', '387', 'BA', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:55'),
(28, 'Botswana', 'https://restcountries.eu/data/bwa.svg', '267', 'BW', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:55'),
(29, 'Bouenza\r', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(30, 'Brazil', 'https://restcountries.eu/data/bra.svg', '55', 'BR', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:55'),
(31, 'Brazzaville\r', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(32, 'British Virgin Islands', 'VG', '1', 'USD', 10, 1, 0, '2018-05-23 09:04:30', NULL),
(33, 'Brunei', 'BN', '673', 'BND', 10, 1, 0, '2018-05-23 09:04:30', NULL),
(34, 'Bulgaria', 'https://restcountries.eu/data/bgr.svg', '359', 'BG', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:55'),
(35, 'Burkina Faso', 'https://restcountries.eu/data/bfa.svg', '226', 'BF', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:55'),
(36, 'Burma', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(37, 'Burundi', 'https://restcountries.eu/data/bdi.svg', '257', 'BI', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:55'),
(38, 'Cambodia', 'https://restcountries.eu/data/khm.svg', '855', 'KH', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:55'),
(39, 'Cameroon', 'https://restcountries.eu/data/cmr.svg', '237', 'CM', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:55'),
(40, 'Canada', 'https://restcountries.eu/data/can.svg', '1', 'CA', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:55'),
(41, 'Cape Verde', 'BQ', '599', 'USD', 10, 1, 0, '2018-05-23 09:04:30', NULL),
(42, 'Cayman Islands', 'https://restcountries.eu/data/cym.svg', '1345', 'KY', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:55'),
(43, 'Central African Republic', 'https://restcountries.eu/data/caf.svg', '236', 'CF', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:55'),
(44, 'Chad', 'https://restcountries.eu/data/tcd.svg', '235', 'TD', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:55'),
(45, 'Chile', 'https://restcountries.eu/data/chl.svg', '56', 'CL', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:55'),
(46, 'China', 'https://restcountries.eu/data/chn.svg', '86', 'CN', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:55'),
(47, 'Christmas Island', 'https://restcountries.eu/data/cxr.svg', '61', 'CX', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:55'),
(48, 'Clipperton Island', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(49, 'Cocos (Keeling) Islands', 'https://restcountries.eu/data/cck.svg', '61', 'CC', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:55'),
(50, 'Colombia', 'https://restcountries.eu/data/col.svg', '57', 'CO', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:56'),
(51, 'Comoros', 'https://restcountries.eu/data/com.svg', '269', 'KM', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:56'),
(52, 'Congo', 'https://restcountries.eu/data/cog.svg', '242', 'CG', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:56'),
(53, 'Cook Islands', 'https://restcountries.eu/data/cok.svg', '682', 'CK', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:56'),
(54, 'Costa Rica', 'https://restcountries.eu/data/cri.svg', '506', 'CR', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:56'),
(55, 'Cote dIvoire', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(56, 'Croatia', 'https://restcountries.eu/data/hrv.svg', '385', 'HR', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:56'),
(57, 'Cuba', 'https://restcountries.eu/data/cub.svg', '53', 'CU', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:56'),
(58, 'Cuvette\r', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(59, 'Cyprus', 'https://restcountries.eu/data/cyp.svg', '357', 'CY', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:56'),
(60, 'Czeck Republic', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(61, 'Denmark', 'https://restcountries.eu/data/dnk.svg', '45', 'DK', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:56'),
(62, 'Djibouti', 'https://restcountries.eu/data/dji.svg', '253', 'DJ', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:56'),
(63, 'Dominica', 'https://restcountries.eu/data/dma.svg', '1767', 'DM', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:56'),
(64, 'Dominican Republic', 'https://restcountries.eu/data/dom.svg', '1809', 'DO', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:56'),
(65, 'Ecuador', 'https://restcountries.eu/data/ecu.svg', '593', 'EC', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:56'),
(66, 'Egypt', 'https://restcountries.eu/data/egy.svg', '20', 'EG', 7, 1, 1, '2018-05-23 09:04:30', '2018-05-23 09:20:56'),
(67, 'El Salvador', 'https://restcountries.eu/data/slv.svg', '503', 'SV', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:56'),
(68, 'United Kingdom', 'https://restcountries.eu/data/gbr.svg', '44', 'GBP', 10, 1, 0, '2018-05-23 09:04:30', NULL),
(69, 'Equatorial Guinea', 'https://restcountries.eu/data/gnq.svg', '240', 'GQ', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:56'),
(70, 'Eritrea', 'https://restcountries.eu/data/eri.svg', '291', 'ER', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:56'),
(71, 'Estonia', 'https://restcountries.eu/data/est.svg', '372', 'EE', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:56'),
(72, 'Ethiopia', 'https://restcountries.eu/data/eth.svg', '251', 'ET', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:56'),
(73, 'Europa Island', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(74, 'Falkland Islands (Islas Malvinas)', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(75, 'Faroe Islands', 'https://restcountries.eu/data/fro.svg', '298', 'FO', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:56'),
(76, 'Fiji', 'https://restcountries.eu/data/fji.svg', '679', 'FJ', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:56'),
(77, 'Finland', 'https://restcountries.eu/data/fin.svg', '358', 'FI', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:56'),
(78, 'France', 'https://restcountries.eu/data/fra.svg', '33', 'FR', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:56'),
(79, 'French Guiana', 'https://restcountries.eu/data/guf.svg', '594', 'GF', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:56'),
(80, 'French Polynesia', 'https://restcountries.eu/data/pyf.svg', '689', 'PF', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:56'),
(81, 'French Southern and Antarctic Lands', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(82, 'Gabon', 'https://restcountries.eu/data/gab.svg', '241', 'GA', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:56'),
(83, 'Gambia', 'https://restcountries.eu/data/gmb.svg', '220', 'GM', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:56'),
(84, 'Gaza Strip', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(85, 'Georgia', 'https://restcountries.eu/data/geo.svg', '995', 'GE', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:57'),
(86, 'Germany', 'https://restcountries.eu/data/deu.svg', '49', 'DE', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:57'),
(87, 'Ghana', 'https://restcountries.eu/data/gha.svg', '233', 'GH', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:57'),
(88, 'Gibraltar', 'https://restcountries.eu/data/gib.svg', '350', 'GI', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:57'),
(89, 'Glorioso Islands', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(90, 'Greece', 'https://restcountries.eu/data/grc.svg', '30', 'GR', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:57'),
(91, 'Greenland', 'https://restcountries.eu/data/grl.svg', '299', 'GL', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:57'),
(92, 'Grenada', 'https://restcountries.eu/data/grd.svg', '1473', 'GD', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:57'),
(93, 'Guadeloupe', 'https://restcountries.eu/data/glp.svg', '590', 'GP', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:57'),
(94, 'Guam', 'https://restcountries.eu/data/gum.svg', '1671', 'GU', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:57'),
(95, 'Guatemala', 'https://restcountries.eu/data/gtm.svg', '502', 'GT', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:57'),
(96, 'Guernsey', 'https://restcountries.eu/data/ggy.svg', '44', 'GG', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:57'),
(97, 'Guinea', 'https://restcountries.eu/data/gin.svg', '224', 'GN', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:57'),
(98, 'Guinea-Bissau', 'https://restcountries.eu/data/gnb.svg', '245', 'GW', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:57'),
(99, 'Guyana', 'https://restcountries.eu/data/guy.svg', '592', 'GY', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:57'),
(100, 'Haiti', 'https://restcountries.eu/data/hti.svg', '509', 'HT', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:57'),
(101, 'Heard Island and McDonald Islands', 'https://restcountries.eu/data/hmd.svg', '', 'HM', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:57'),
(102, 'Holy See (Vatican City)', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(103, 'Honduras', 'https://restcountries.eu/data/hnd.svg', '504', 'HN', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:57'),
(104, 'Hong Kong', 'https://restcountries.eu/data/hkg.svg', '852', 'HK', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:57'),
(105, 'Howland Island', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(106, 'Hungary', 'https://restcountries.eu/data/hun.svg', '36', 'HU', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:57'),
(107, 'Iceland', 'https://restcountries.eu/data/isl.svg', '354', 'IS', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:57'),
(108, 'India', 'https://restcountries.eu/data/ind.svg', '91', 'IN', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:57'),
(109, 'Indonesia', 'https://restcountries.eu/data/idn.svg', '62', 'ID', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:57'),
(110, 'Iran', 'IR', '98', 'IRR', 10, 1, 0, '2018-05-23 09:04:30', NULL),
(111, 'Iraq', 'https://restcountries.eu/data/irq.svg', '964', 'IQ', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:57'),
(113, 'Israel', 'https://restcountries.eu/data/isr.svg', '972', 'IL', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:58'),
(114, 'Italy', 'https://restcountries.eu/data/ita.svg', '39', 'IT', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:58'),
(115, 'Jamaica', 'https://restcountries.eu/data/jam.svg', '1876', 'JM', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:58'),
(116, 'Jan Mayen', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(117, 'Japan', 'https://restcountries.eu/data/jpn.svg', '81', 'JP', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:58'),
(118, 'Jarvis Island', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(119, 'Jersey', 'https://restcountries.eu/data/jey.svg', '44', 'JE', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:58'),
(120, 'Johnston Atoll', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(121, 'Jordan', 'https://restcountries.eu/data/jor.svg', '962', 'JO', 10, 1, 1, '2018-05-23 09:04:30', '2018-05-23 09:20:58'),
(122, 'Juan de Nova Island', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(123, 'Kazakhstan', 'https://restcountries.eu/data/kaz.svg', '76', 'KZ', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:58'),
(124, 'Kenya', 'https://restcountries.eu/data/ken.svg', '254', 'KE', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:58'),
(125, 'Kiribati', 'https://restcountries.eu/data/kir.svg', '686', 'KI', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:58'),
(126, 'Korea', '_download (1).png', '82', 'KOR', 10, 1, 0, '2018-05-23 09:04:30', '2019-04-04 20:21:18'),
(127, 'Kouilou\r', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(128, 'Kuwait', 'https://restcountries.eu/data/kwt.svg', '965', 'KW', 4, 1, 1, '2018-05-23 09:04:30', '2018-05-23 09:20:58'),
(129, 'Kyrgyzstan', 'https://restcountries.eu/data/kgz.svg', '996', 'KG', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:58'),
(130, 'Laos', 'LA', '856', 'LAK', 10, 1, 0, '2018-05-23 09:04:30', NULL),
(131, 'Latvia', 'https://restcountries.eu/data/lva.svg', '371', 'LV', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:58'),
(132, 'Lebanon', 'https://restcountries.eu/data/lbn.svg', '961', 'LB', 10, 1, 1, '2018-05-23 09:04:30', '2018-05-23 09:20:58'),
(133, 'Lekoumou\r', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(134, 'Lesotho', 'https://restcountries.eu/data/lso.svg', '266', 'LS', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:58'),
(135, 'Liberia', 'https://restcountries.eu/data/lbr.svg', '231', 'LR', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:58'),
(136, 'Libya', 'https://restcountries.eu/data/lby.svg', '218', 'LY', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:58'),
(137, 'Liechtenstein', 'https://restcountries.eu/data/lie.svg', '423', 'LI', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:58'),
(138, 'Likouala\r', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(139, 'Lithuania', 'https://restcountries.eu/data/ltu.svg', '370', 'LT', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:58'),
(140, 'Luxembourg', 'https://restcountries.eu/data/lux.svg', '352', 'LU', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:58'),
(141, 'Macau', 'MO', '853', 'MOP', 10, 1, 0, '2018-05-23 09:04:30', NULL),
(142, 'Macedonia', 'MK', '389', 'MKD', 10, 1, 0, '2018-05-23 09:04:30', NULL),
(143, 'Madagascar', 'https://restcountries.eu/data/mdg.svg', '261', 'MG', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:58'),
(144, 'Malawi', 'https://restcountries.eu/data/mwi.svg', '265', 'MW', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:59'),
(145, 'Malaysia', 'https://restcountries.eu/data/mys.svg', '60', 'MY', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:59'),
(146, 'Maldives', 'https://restcountries.eu/data/mdv.svg', '960', 'MV', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:59'),
(147, 'Mali', 'https://restcountries.eu/data/mli.svg', '223', 'ML', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:59'),
(148, 'Malta', 'https://restcountries.eu/data/mlt.svg', '356', 'MT', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:59'),
(149, 'Marshall Islands', 'https://restcountries.eu/data/mhl.svg', '692', 'MH', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:59'),
(150, 'Martinique', 'https://restcountries.eu/data/mtq.svg', '596', 'MQ', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:59'),
(151, 'Mauritania', 'https://restcountries.eu/data/mrt.svg', '222', 'MR', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:59'),
(152, 'Mauritius', 'https://restcountries.eu/data/mus.svg', '230', 'MU', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:59'),
(153, 'Mayotte', 'https://restcountries.eu/data/myt.svg', '262', 'YT', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:59'),
(154, 'Mexico', 'https://restcountries.eu/data/mex.svg', '52', 'MX', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:59'),
(155, 'Micronesia', 'FM', '691', 'USD', 10, 1, 0, '2018-05-23 09:04:30', NULL),
(156, 'Midway Islands', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(157, 'Moldova', 'MD', '373', 'MDL', 10, 1, 0, '2018-05-23 09:04:30', NULL),
(158, 'Monaco', 'https://restcountries.eu/data/mco.svg', '377', 'MC', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:59'),
(159, 'Mongolia', 'https://restcountries.eu/data/mng.svg', '976', 'MN', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:59'),
(160, 'Montserrat', 'https://restcountries.eu/data/msr.svg', '1664', 'MS', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:59'),
(161, 'Morocco', 'https://restcountries.eu/data/mar.svg', '212', 'MA', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:59'),
(162, 'Mozambique', 'https://restcountries.eu/data/moz.svg', '258', 'MZ', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:59'),
(163, 'Namibia', 'https://restcountries.eu/data/nam.svg', '264', 'NA', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:59'),
(164, 'Nauru', 'https://restcountries.eu/data/nru.svg', '674', 'NR', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:59'),
(165, 'Nepal', 'https://restcountries.eu/data/npl.svg', '977', 'NP', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:59'),
(166, 'Netherlands', 'https://restcountries.eu/data/nld.svg', '31', 'NL', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:59'),
(167, 'Netherlands Antilles', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(168, 'New Caledonia', 'https://restcountries.eu/data/ncl.svg', '687', 'NC', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:59'),
(169, 'New Zealand', 'https://restcountries.eu/data/nzl.svg', '64', 'NZ', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:59'),
(170, 'Niari\r', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(171, 'Nicaragua', 'https://restcountries.eu/data/nic.svg', '505', 'NI', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:59'),
(172, 'Niger', 'https://restcountries.eu/data/ner.svg', '227', 'NE', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:59'),
(173, 'Nigeria', 'https://restcountries.eu/data/nga.svg', '234', 'NG', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:59'),
(174, 'Niue', 'https://restcountries.eu/data/niu.svg', '683', 'NU', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:20:59'),
(175, 'Norfolk Island', 'https://restcountries.eu/data/nfk.svg', '672', 'NF', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:00'),
(176, 'Northern Mariana Islands', 'https://restcountries.eu/data/mnp.svg', '1670', 'MP', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:00'),
(177, 'Norway', 'https://restcountries.eu/data/nor.svg', '47', 'NO', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:00'),
(178, 'Oman', 'https://restcountries.eu/data/omn.svg', '968', 'OM', 6, 1, 1, '2018-05-23 09:04:30', '2018-05-23 09:21:00'),
(179, 'Pakistan', 'https://restcountries.eu/data/pak.svg', '92', 'PK', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:00'),
(180, 'Palau', 'https://restcountries.eu/data/plw.svg', '680', 'PW', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:00'),
(181, 'Panama', 'https://restcountries.eu/data/pan.svg', '507', 'PA', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:00'),
(182, 'Papua New Guinea', 'https://restcountries.eu/data/png.svg', '675', 'PG', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:00'),
(183, 'Paraguay', 'https://restcountries.eu/data/pry.svg', '595', 'PY', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:00'),
(184, 'Peru', 'https://restcountries.eu/data/per.svg', '51', 'PE', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:00'),
(185, 'Philippines', 'https://restcountries.eu/data/phl.svg', '63', 'PH', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:00'),
(186, 'Pitcaim Islands', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(187, 'Plateaux\r', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(188, 'Poland', 'https://restcountries.eu/data/pol.svg', '48', 'PL', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:00'),
(189, 'Pool\r', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(190, 'Portugal', 'https://restcountries.eu/data/prt.svg', '351', 'PT', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:00'),
(191, 'Puerto Rico', 'https://restcountries.eu/data/pri.svg', '1787', 'PR', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:00'),
(192, 'Qatar', 'https://restcountries.eu/data/qat.svg', '974', 'QA', 3, 1, 1, '2018-05-23 09:04:30', '2018-05-23 09:21:00'),
(193, 'Reunion', 'https://restcountries.eu/data/reu.svg', '262', 'RE', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:00'),
(194, 'Romainia', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(195, 'Russia', 'RU', '7', 'RUB', 10, 1, 0, '2018-05-23 09:04:30', NULL),
(196, 'Rwanda', 'https://restcountries.eu/data/rwa.svg', '250', 'RW', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:00'),
(197, 'Saint Helena', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(198, 'Saint Kitts and Nevis', 'https://restcountries.eu/data/kna.svg', '1869', 'KN', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:00'),
(199, 'Saint Lucia', 'https://restcountries.eu/data/lca.svg', '1758', 'LC', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:00'),
(200, 'Saint Pierre and Miquelon', 'https://restcountries.eu/data/spm.svg', '508', 'PM', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:00'),
(201, 'Saint Vincent and the Grenadines', 'https://restcountries.eu/data/vct.svg', '1784', 'VC', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:00'),
(202, 'Samoa', 'https://restcountries.eu/data/wsm.svg', '685', 'WS', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:00'),
(203, 'San Marino', 'https://restcountries.eu/data/smr.svg', '378', 'SM', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:00'),
(204, 'Sangha\r', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(205, 'Sao Tome and Principe', 'https://restcountries.eu/data/stp.svg', '239', 'ST', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:00'),
(206, 'Saudi Arabia', 'https://restcountries.eu/data/sau.svg', '966', 'SA', 2, 1, 1, '2018-05-23 09:04:30', '2018-05-23 09:21:00'),
(208, 'Senegal', 'https://restcountries.eu/data/sen.svg', '221', 'SN', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:00'),
(209, 'Seychelles', 'https://restcountries.eu/data/syc.svg', '248', 'SC', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:01'),
(210, 'Sierra Leone', 'https://restcountries.eu/data/sle.svg', '232', 'SL', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:01'),
(211, 'Singapore', 'https://restcountries.eu/data/sgp.svg', '65', 'SG', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:01'),
(212, 'Slovakia', 'https://restcountries.eu/data/svk.svg', '421', 'SK', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:01'),
(213, 'Slovenia', 'https://restcountries.eu/data/svn.svg', '386', 'SI', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:01'),
(214, 'Solomon Islands', 'https://restcountries.eu/data/slb.svg', '677', 'SB', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:01'),
(215, 'Somalia', 'https://restcountries.eu/data/som.svg', '252', 'SO', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:01'),
(216, 'South Africa', 'https://restcountries.eu/data/zaf.svg', '27', 'ZA', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:01'),
(217, 'South Georgia and South Sandwich Islands', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(218, 'Spain', 'https://restcountries.eu/data/esp.svg', '34', 'ES', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:01'),
(219, 'Spratly Islands', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(220, 'Sri Lanka', 'https://restcountries.eu/data/lka.svg', '94', 'LK', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:01'),
(221, 'Sudan', 'https://restcountries.eu/data/sdn.svg', '249', 'SD', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:01'),
(222, 'Suriname', 'https://restcountries.eu/data/sur.svg', '597', 'SR', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:01'),
(223, 'Svalbard', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(224, 'Swaziland', 'https://restcountries.eu/data/swz.svg', '268', 'SZ', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:01'),
(225, 'Sweden', 'https://restcountries.eu/data/swe.svg', '46', 'SE', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:01'),
(226, 'Switzerland', 'https://restcountries.eu/data/che.svg', '41', 'CH', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:01'),
(227, 'Syria', 'ST', '239', 'STD', 10, 1, 0, '2018-05-23 09:04:30', NULL),
(228, 'Taiwan', 'https://restcountries.eu/data/twn.svg', '886', 'TW', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:01'),
(229, 'Tajikistan', 'https://restcountries.eu/data/tjk.svg', '992', 'TJ', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:01'),
(230, 'Tanzania', 'TZ', '255', 'TZS', 10, 1, 0, '2018-05-23 09:04:30', NULL),
(231, 'Thailand', 'https://restcountries.eu/data/tha.svg', '66', 'TH', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:01'),
(232, 'Tobago', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(233, 'Toga', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(234, 'Tokelau', 'https://restcountries.eu/data/tkl.svg', '690', 'TK', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:01'),
(235, 'Tonga', 'https://restcountries.eu/data/ton.svg', '676', 'TO', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:01'),
(236, 'Trinidad', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(237, 'Tunisia', 'https://restcountries.eu/data/tun.svg', '216', 'TN', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:01'),
(238, 'Turkey', 'https://restcountries.eu/data/tur.svg', '90', 'TR', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:01'),
(239, 'Turkmenistan', 'https://restcountries.eu/data/tkm.svg', '993', 'TM', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:02'),
(240, 'Tuvalu', 'https://restcountries.eu/data/tuv.svg', '688', 'TV', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:02'),
(241, 'Uganda', 'https://restcountries.eu/data/uga.svg', '256', 'UG', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:02'),
(242, 'Ukraine', 'https://restcountries.eu/data/ukr.svg', '380', 'UA', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:02'),
(243, 'United Arab Emirates', 'https://restcountries.eu/data/are.svg', '971', 'AE', 1, 1, 1, '2018-05-23 09:04:30', '2018-05-23 09:21:02'),
(244, 'United States', 'https://restcountries.eu/data/usa.svg', '1', 'USD', 10, 1, 0, '2018-05-23 09:04:30', NULL),
(245, 'Uruguay', 'https://restcountries.eu/data/ury.svg', '598', 'UY', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:02'),
(246, 'Uzbekistan', 'https://restcountries.eu/data/uzb.svg', '998', 'UZ', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:02'),
(247, 'Vanuatu', 'https://restcountries.eu/data/vut.svg', '678', 'VU', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:02'),
(248, 'Venezuela', 'VE', '58', 'VEF', 10, 1, 0, '2018-05-23 09:04:30', NULL),
(249, 'Vietnam', 'WF', '681', 'XPF', 10, 1, 0, '2018-05-23 09:04:30', NULL),
(250, 'Virgin Islands', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(252, 'Wallis and Futuna', 'https://restcountries.eu/data/wlf.svg', '681', 'WF', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:02'),
(253, 'West Bank', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(254, 'Western Sahara', 'https://restcountries.eu/data/esh.svg', '212', 'EH', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:02'),
(255, 'Yemen', 'https://restcountries.eu/data/yem.svg', '967', 'YE', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:02'),
(256, 'Yugoslavia', '', NULL, NULL, 10, 1, 0, '2018-05-23 09:04:30', NULL),
(257, 'Zambia', 'https://restcountries.eu/data/zmb.svg', '260', 'ZM', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:02'),
(258, 'Zimbabwe', 'https://restcountries.eu/data/zwe.svg', '263', 'ZW', 10, 1, 0, '2018-05-23 09:04:30', '2018-05-23 09:21:02'),
(259, 'Anywhere', NULL, NULL, NULL, 10, 1, 2, '2018-10-15 06:04:57', NULL),
(260, 'Any GCC Country', NULL, NULL, NULL, 10, 1, 2, '2018-10-15 06:04:57', NULL),
(261, 'india', '_artical1.png', '+91', 'ind', 10, 1, 0, '2020-03-19 08:18:58', '2020-03-19 13:50:04');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `surname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `middle_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `father_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `nationality` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zipcode` int(11) DEFAULT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT '0',
  `remember_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dynamic_dropdowns`
--

DROP TABLE IF EXISTS `dynamic_dropdowns`;
CREATE TABLE `dynamic_dropdowns` (
  `id` int(11) NOT NULL,
  `dropdown_name` varchar(255) DEFAULT NULL,
  `dropdown_value` varchar(255) DEFAULT NULL,
  `is_deletable` int(11) NOT NULL DEFAULT '1' COMMENT '1=Yes',
  `is_deleted` int(11) NOT NULL DEFAULT '0',
  `status` int(11) DEFAULT '1',
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dynamic_dropdowns`
--

INSERT INTO `dynamic_dropdowns` (`id`, `dropdown_name`, `dropdown_value`, `is_deletable`, `is_deleted`, `status`, `updated_at`, `created_at`) VALUES
(1, 'gender', 'Male', 0, 0, 0, NULL, '2021-05-24 11:37:27'),
(2, 'gender', 'Female', 0, 0, 0, NULL, '2021-05-24 11:37:27'),
(3, 'gender', 'Other', 0, 0, 0, NULL, '2021-05-24 11:37:27'),
(4, 'type_of_ids', 'Passport', 0, 0, 1, NULL, '2021-05-24 11:37:27'),
(5, 'type_of_ids', 'Driving License', 0, 0, 1, NULL, '2021-05-24 11:37:27'),
(6, 'type_of_ids', 'Aadhar Card', 1, 0, 1, NULL, '2021-05-24 11:37:27'),
(7, 'type_of_ids', 'Voter Id', 1, 0, 1, NULL, '2021-05-24 11:37:27'),
(8, 'measurement', 'Gm', 0, 0, 1, NULL, '2021-05-24 11:37:27'),
(9, 'measurement', 'Kg', 0, 0, 1, NULL, '2021-05-24 11:37:27'),
(10, 'measurement', 'Item', 0, 0, 1, NULL, '2021-05-24 11:37:27'),
(11, 'measurement', 'Piece', 0, 0, 1, NULL, '2021-05-24 11:37:27'),
(12, 'measurement', 'Set', 0, 0, 1, NULL, '2021-05-24 11:37:27'),
(13, 'measurement', 'Bottles', 0, 0, 1, NULL, '2021-05-24 11:37:27'),
(14, 'measurement', 'Cartoons', 0, 0, 1, NULL, '2021-05-24 11:37:27'),
(15, 'room_floor', 'Ground Floor', 0, 0, 1, NULL, '2021-05-24 11:37:27'),
(16, 'room_floor', 'First Floor', 0, 0, 1, NULL, '2021-05-24 11:37:27'),
(17, 'room_floor', 'Second Floor', 0, 0, 1, NULL, '2021-05-24 11:37:27'),
(18, 'room_floor', 'Third Floor', 1, 0, 1, NULL, '2021-05-24 11:37:27'),
(19, 'room_floor', 'Forth Floor', 1, 0, 1, NULL, '2021-05-24 11:37:27'),
(20, 'room_floor', 'Fifth Floor', 1, 0, 1, NULL, '2021-05-24 11:37:27');

-- --------------------------------------------------------

--
-- Table structure for table `enquiries`
--

DROP TABLE IF EXISTS `enquiries`;
CREATE TABLE `enquiries` (
  `id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `email` varchar(80) NOT NULL,
  `read_query` int(11) NOT NULL DEFAULT '0',
  `mobile` varchar(20) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `country` varchar(80) DEFAULT NULL,
  `query` text,
  `ip_addr` varchar(50) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

DROP TABLE IF EXISTS `expenses`;
CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `amount` float(10,2) NOT NULL DEFAULT '0.00',
  `attachment` varchar(255) DEFAULT NULL,
  `remark` text,
  `datetime` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `expense_categories`
--

DROP TABLE IF EXISTS `expense_categories`;
CREATE TABLE `expense_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expense_categories`
--

INSERT INTO `expense_categories` (`id`, `name`, `status`, `updated_at`, `created_at`) VALUES
(1, 'Tours', 1, '2021-09-05 10:11:29', '2021-09-05 10:11:29');

-- --------------------------------------------------------

--
-- Table structure for table `food_categories`
--

DROP TABLE IF EXISTS `food_categories`;
CREATE TABLE `food_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `is_deleted` int(11) NOT NULL DEFAULT '0',
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `food_items`
--

DROP TABLE IF EXISTS `food_items`;
CREATE TABLE `food_items` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` float(10,2) NOT NULL DEFAULT '0.00',
  `description` text,
  `status` int(11) NOT NULL DEFAULT '1',
  `is_deleted` int(11) NOT NULL DEFAULT '0',
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `home_sections`
--

DROP TABLE IF EXISTS `home_sections`;
CREATE TABLE `home_sections` (
  `id` int(11) NOT NULL,
  `banner_section_tagline` varchar(255) DEFAULT NULL,
  `banner_section_heading` varchar(255) DEFAULT NULL,
  `banner_section_button` int(11) DEFAULT '1',
  `banner_section_btntxt` varchar(222) DEFAULT NULL,
  `banner_section_publish` int(11) DEFAULT '1',
  `intro_section_tagline` varchar(255) DEFAULT NULL,
  `intro_section_heading` varchar(255) DEFAULT NULL,
  `intro_section_features` longtext,
  `intro_section_publish` int(11) DEFAULT '1',
  `ourservices_section_tagline` varchar(255) DEFAULT NULL,
  `ourservices_section_heading` varchar(255) DEFAULT NULL,
  `ourservices_section_publish` int(11) NOT NULL DEFAULT '0',
  `testimonial_section_tagline` varchar(255) DEFAULT NULL,
  `testimonial_section_heading` varchar(255) DEFAULT NULL,
  `testimonial_section_publish` int(11) DEFAULT '1',
  `about_section_tagline` varchar(255) DEFAULT NULL,
  `about_section_heading` varchar(255) DEFAULT NULL,
  `about_section_icon` varchar(255) DEFAULT NULL,
  `about_section_title` varchar(255) DEFAULT NULL,
  `about_section_shortdesc` text,
  `about_section_image` varchar(255) DEFAULT NULL,
  `about_section_button` int(11) DEFAULT '1',
  `about_section_btntxt` varchar(20) DEFAULT NULL,
  `about_section_publish` int(11) DEFAULT '1',
  `counter_section_json` longtext,
  `counter_section_publish` int(11) DEFAULT '1',
  `cta_section_json` longtext,
  `cta_section_publish` int(11) DEFAULT '1',
  `footer_cta_section_tagline` varchar(255) DEFAULT NULL,
  `footer_cta_section_heading` varchar(255) DEFAULT NULL,
  `footer_cta_section_button` int(11) DEFAULT '1',
  `footer_cta_section_btntxt` varchar(222) DEFAULT NULL,
  `footer_cta_section_publish` int(11) DEFAULT '1',
  `room_section_tagline` varchar(255) DEFAULT NULL,
  `room_section_heading` varchar(255) DEFAULT NULL,
  `room_section_publish` int(11) DEFAULT '1',
  `room_category_section_tagline` varchar(255) DEFAULT NULL,
  `room_category_section_heading` varchar(255) DEFAULT NULL,
  `room_category_section_publish` int(11) DEFAULT '1',
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `home_sections`
--

INSERT INTO `home_sections` (`id`, `banner_section_tagline`, `banner_section_heading`, `banner_section_button`, `banner_section_btntxt`, `banner_section_publish`, `intro_section_tagline`, `intro_section_heading`, `intro_section_features`, `intro_section_publish`, `ourservices_section_tagline`, `ourservices_section_heading`, `ourservices_section_publish`, `testimonial_section_tagline`, `testimonial_section_heading`, `testimonial_section_publish`, `about_section_tagline`, `about_section_heading`, `about_section_icon`, `about_section_title`, `about_section_shortdesc`, `about_section_image`, `about_section_button`, `about_section_btntxt`, `about_section_publish`, `counter_section_json`, `counter_section_publish`, `cta_section_json`, `cta_section_publish`, `footer_cta_section_tagline`, `footer_cta_section_heading`, `footer_cta_section_button`, `footer_cta_section_btntxt`, `footer_cta_section_publish`, `room_section_tagline`, `room_section_heading`, `room_section_publish`, `room_category_section_tagline`, `room_category_section_heading`, `room_category_section_publish`, `updated_at`, `created_at`) VALUES
(1, 'Enjoy a One of a Kind Stay at Tuhava Hotels!', 'Welcome to Papu New Guinea, Port Moresby', 1, 'GET STARTED', 0, NULL, NULL, '[{\"title\":\"Modern Amenities\",\"icon\":\"ti-desktop\",\"short_desc\":\"Morbi semper fames lobortis ac hac\"},{\"title\":\"Specials & Packages\",\"icon\":\"ti-crown\",\"short_desc\":\"Morbi semper fames lobortis ac hac\"},{\"title\":\"Rooftop Views\",\"icon\":\"ti-home\",\"short_desc\":\"Morbi semper fames lobortis ac hac\"}]', 1, 'Our Services', 'We provide a wide range of creative services', 1, 'Check what\'s our clients say about us', 'Clients testimonial', 1, 'What we are', 'We are dynamic team of creative people', NULL, 'We are Perfect Solution', 'We provide consulting services in the area of IFRS and management reporting, helping companies to reach their highest level. We optimize business processes, making them easier.', '8a3b9a9b8bafb57d02c40c98b9b5405f_1579572910.jpg', 1, 'GET STARTED', 1, '[{\"title\":\"Top Local Guides\",\"number\":\"25\",\"prefix\":\"+\"},{\"title\":\"Green Destinations\",\"number\":\"210\",\"prefix\":\"+\"},{\"title\":\"New Customers\",\"number\":\"170\",\"prefix\":null},{\"title\":\"Happy Customers\",\"number\":\"500\",\"prefix\":\"+\"}]', 1, '[{\"heading\":\"Entrust Your Project to Our Best Team of Professionals\",\"tagline\":\"We create for you\",\"shortdesc\":\"Have any project on mind? For immidiate support :\",\"mobile\":\"+23 876 65 455\",\"icon\":null},{\"heading\":\"Entrust Your Project to Our Best Team of Professionals\",\"tagline\":\"We create for you\",\"shortdesc\":\"Have any project on mind? For immidiate support :\",\"mobile\":\"+23 876 65 455\",\"icon\":\"ti-agenda\"}]', 1, NULL, NULL, 1, 'Contact Us', 0, 'Featured Rooms', 'Featured Rooms', 1, 'Best Staying Places', 'Top Room Categories', 1, '2021-11-24 10:06:13', '2019-09-11 09:14:55');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
CREATE TABLE `languages` (
  `id` int(11) NOT NULL,
  `key` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ar` text CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT 'Arabic',
  `bn` text CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT 'Bengali',
  `zh` text CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT 'Chinese',
  `en` text CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT 'English',
  `fr` text CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT 'French',
  `de` text CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT 'German',
  `hi` text CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT 'Hindi',
  `it` text CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT 'Italian',
  `pt` text CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT 'Portuguese',
  `rm` text CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT 'Romansh',
  `ru` text CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT 'Russian',
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `media_files`
--

DROP TABLE IF EXISTS `media_files`;
CREATE TABLE `media_files` (
  `id` int(11) NOT NULL,
  `tbl_id` int(11) NOT NULL,
  `type` enum('id_cards','expenses','home_banner','room_image','room_type_image','') NOT NULL DEFAULT 'id_cards',
  `file` varchar(255) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `media_files`
--

INSERT INTO `media_files` (`id`, `tbl_id`, `type`, `file`, `updated_at`, `created_at`) VALUES
(2, 1, 'room_type_image', 'ff4e4e4e0f62bc83ef07204d2582bb73_1636180770.jpeg', NULL, '2021-11-06 06:39:30'),
(5, 2, 'room_image', '2937b4987e7bacdb0be6962716726cca_1636183651.jpeg', NULL, '2021-11-06 07:27:31'),
(6, 3, 'room_image', '32f10201c33fa2019d3e8251739eb1f7_1636185434.jpeg', NULL, '2021-11-06 07:57:14'),
(9, 5, 'room_image', '20472c540d05088b2a29ab5f93727d24_1636185530.jpeg', NULL, '2021-11-06 07:58:50'),
(10, 2, 'room_image', '46ef52d27e10b3bb0581c200fecbf972_1636185504.jpeg', NULL, '2021-11-06 07:27:31'),
(11, 2, 'room_image', '46ef52d27e10b3bb0581c200fecbf972_1636185504.jpeg', NULL, '2021-11-06 07:27:31'),
(13, 3, 'room_type_image', 'bdb9fb3a25b377ad3ea8e4c384942d15_1637669641.jpg', NULL, '2021-11-23 12:14:01'),
(14, 3, 'room_type_image', '14f97d97498ecd5a36b256de3e674f57_1637669838.jpg', NULL, '2021-11-23 12:17:18'),
(16, 2, 'room_type_image', '721700bed00356aeb25afd7478adb4fa_1637669914.jpg', NULL, '2021-11-23 12:18:34'),
(17, 2, 'room_type_image', 'cce8ad9409990888ea4af690c5fcbb79_1637669962.jpg', NULL, '2021-11-23 12:19:22'),
(18, 1, 'room_image', '14f97d97498ecd5a36b256de3e674f57_1637670039.jpg', NULL, '2021-11-23 12:20:39'),
(19, 4, 'room_image', '721700bed00356aeb25afd7478adb4fa_1637670085.jpg', NULL, '2021-11-23 12:21:25'),
(21, 1, 'home_banner', '4b88868fc17844cbfda6646b2c22d75e_1637727766.jpg', NULL, '2021-11-24 04:22:46'),
(22, 1, 'home_banner', '205b77cf61fc31d3099c652c1b35e1ce_1637727766.jpg', NULL, '2021-11-24 04:22:46'),
(23, 1, 'home_banner', '6115685e833c57281bf9c21f39903644_1637728573.jpg', NULL, '2021-11-24 04:36:13');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `reservation_id` int(11) DEFAULT NULL,
  `invoice_num` varchar(200) DEFAULT NULL,
  `table_num` varchar(10) DEFAULT NULL,
  `gst_apply` int(11) DEFAULT '0' COMMENT '1=Yes',
  `gst_perc` float(10,2) DEFAULT '0.00',
  `gst_amount` float(10,2) DEFAULT '0.00',
  `cgst_perc` float(10,2) DEFAULT '0.00',
  `cgst_amount` float(10,2) DEFAULT '0.00',
  `discount` float(10,2) DEFAULT '0.00',
  `total_amount` float(10,2) DEFAULT '0.00',
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `address` text,
  `mobile` varchar(15) DEFAULT NULL,
  `invoice_date` date DEFAULT NULL,
  `payment_mode` int(11) DEFAULT NULL,
  `num_of_person` int(11) DEFAULT NULL,
  `waiter_name` varchar(255) DEFAULT NULL,
  `waiter_id` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `original_date` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_histories`
--

DROP TABLE IF EXISTS `order_histories`;
CREATE TABLE `order_histories` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `table_num` varchar(10) NOT NULL,
  `is_book` int(11) NOT NULL DEFAULT '1' COMMENT '1=Booked',
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `order_history_id` int(11) DEFAULT NULL,
  `reservation_id` int(11) DEFAULT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_price` float(10,2) NOT NULL,
  `item_qty` int(11) NOT NULL,
  `json_data` text,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1=Pending,2=Process,3=Delivered,4=Cancelled',
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_history`
--

DROP TABLE IF EXISTS `payment_history`;
CREATE TABLE `payment_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `payment_amount` double DEFAULT NULL,
  `payment_type` varchar(128) DEFAULT NULL,
  `cheque_num` varchar(255) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `payment_date` datetime DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL COMMENT 'user_id',
  `transaction_id` text,
  `purpose` varchar(255) DEFAULT NULL,
  `credit_debit` enum('Credit','Debit','') DEFAULT NULL,
  `remark` text,
  `tbl_id` int(11) DEFAULT NULL,
  `tbl_name` varchar(60) DEFAULT NULL,
  `json_data` text,
  `order_id` varchar(255) DEFAULT NULL,
  `payment_of` enum('cr','dr','') DEFAULT NULL COMMENT 'for admin use only',
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `description` text,
  `slug` varchar(255) NOT NULL,
  `super_admin` int(11) NOT NULL DEFAULT '1',
  `admin` int(11) NOT NULL DEFAULT '1',
  `receptionist` int(11) NOT NULL DEFAULT '1',
  `store_manager` int(11) NOT NULL DEFAULT '0',
  `financial_manager` int(11) NOT NULL DEFAULT '0',
  `customer` int(11) NOT NULL DEFAULT '0',
  `permission_type` enum('menu','route') NOT NULL DEFAULT 'route',
  `status` int(11) NOT NULL DEFAULT '1',
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `parent_id`, `description`, `slug`, `super_admin`, `admin`, `receptionist`, `store_manager`, `financial_manager`, `customer`, `permission_type`, `status`, `updated_at`, `created_at`) VALUES
(1, NULL, 'Dashboard', 'dashboard', 1, 1, 1, 0, 0, 0, 'menu', 1, '2020-11-14 10:40:37', '2019-09-07 11:56:50'),
(2, NULL, 'Check In', 'check-in', 1, 1, 1, 0, 0, 0, 'menu', 1, '2020-11-14 10:40:37', '2019-09-07 11:58:01'),
(3, 2, 'Check In: Add', 'add-check-in', 1, 1, 1, 0, 0, 0, 'menu', 1, '2020-11-14 10:40:37', '2019-09-07 11:59:02'),
(4, 2, 'Check In: List', 'list-check-in', 1, 1, 1, 0, 0, 0, 'menu', 1, '2020-11-14 10:40:37', '2019-09-07 11:59:02'),
(5, NULL, 'Users', 'users', 1, 0, 0, 0, 0, 0, 'menu', 1, '2020-11-14 10:40:37', '2019-09-07 11:59:02'),
(6, 5, 'Users: Add', 'add-users', 1, 0, 0, 0, 0, 0, 'menu', 1, '2020-11-14 10:40:37', '2019-09-07 11:59:02'),
(7, 5, 'Users: List', 'list-users', 1, 0, 0, 0, 0, 0, 'menu', 1, '2020-11-14 10:40:37', '2019-09-07 11:59:02'),
(8, NULL, 'Food Category', 'food-category', 1, 1, 0, 0, 0, 0, 'menu', 1, '2020-11-14 10:40:37', '2019-09-07 11:59:02'),
(9, 8, 'Food Category: Add', 'add-food-category', 1, 1, 0, 0, 0, 0, 'menu', 1, '2020-11-14 10:40:37', '2019-09-07 11:59:02'),
(10, 8, 'Food : Category List', 'list-food-category', 1, 1, 0, 0, 0, 0, 'menu', 1, '2020-11-14 10:40:37', '2019-09-07 11:59:02'),
(11, NULL, 'Food : Item', 'food-item', 1, 1, 0, 0, 0, 0, 'menu', 1, '2020-11-14 10:40:37', '2019-09-07 11:59:02'),
(12, 11, 'Food : Item Add', 'add-food-item', 1, 1, 0, 0, 0, 0, 'menu', 1, '2020-11-14 10:40:37', '2019-09-07 11:59:02'),
(13, 11, 'Food : Item List', 'list-food-item', 1, 1, 0, 0, 0, 0, 'menu', 1, '2020-11-14 10:40:37', '2019-09-07 11:59:02'),
(14, NULL, 'Stocks', 'stocks', 1, 1, 0, 0, 0, 0, 'menu', 1, '2020-11-14 10:40:37', '2019-09-07 11:59:02'),
(15, 14, 'Product: Add', 'add-product', 1, 1, 0, 0, 0, 0, 'menu', 1, '2020-11-14 10:40:37', '2019-09-07 11:59:02'),
(16, 14, 'Product: List', 'list-product', 1, 1, 0, 0, 0, 0, 'menu', 1, '2020-11-14 10:40:37', '2019-09-07 11:59:02'),
(17, 14, 'Stocks: Add', 'add-stock', 1, 1, 0, 0, 0, 0, 'menu', 1, '2020-11-14 10:40:37', '2019-09-07 11:59:02'),
(18, 14, 'Stocks: History', 'history-stock', 1, 1, 0, 0, 0, 0, 'menu', 1, '2020-11-14 10:40:37', '2019-09-07 11:59:02'),
(19, NULL, 'Room Types', 'room-type', 1, 1, 1, 0, 0, 0, 'menu', 1, '2020-11-14 10:40:37', '2019-09-07 11:59:02'),
(20, 19, 'Room Type : Add', 'add-room-type', 1, 1, 0, 0, 0, 0, 'menu', 1, '2020-11-14 10:40:37', '2019-09-07 11:59:02'),
(21, 19, 'Room Type : List', 'list-room-type', 1, 1, 1, 0, 0, 0, 'menu', 1, '2020-11-14 10:40:37', '2019-09-07 11:59:02'),
(22, NULL, 'Rooms', 'rooms', 1, 1, 1, 0, 0, 0, 'menu', 1, '2020-11-14 10:40:37', '2019-09-07 11:59:02'),
(23, 22, 'Rooms : Add', 'add-room', 1, 1, 0, 0, 0, 0, 'menu', 1, '2020-11-14 10:40:37', '2019-09-07 11:59:02'),
(24, 22, 'Rooms : List', 'list-room', 1, 1, 1, 0, 0, 0, 'menu', 1, '2020-11-14 10:40:37', '2019-09-07 11:59:02'),
(25, NULL, 'Amenities: List', 'amenities', 1, 1, 0, 0, 0, 0, 'menu', 1, '2020-11-14 10:40:37', '2019-09-07 11:59:02'),
(26, 25, 'Amenities : Add', 'add-amenities', 1, 1, 0, 0, 0, 0, 'menu', 1, '2020-11-14 10:40:37', '2019-09-07 11:59:02'),
(27, 25, 'Amenities : List', 'list-amenities', 1, 1, 0, 0, 0, 0, 'menu', 1, '2020-11-14 10:40:37', '2019-09-07 11:59:02'),
(28, NULL, 'Dashboard', 'dashboard', 1, 1, 1, 0, 0, 0, 'route', 1, '2020-11-14 10:40:37', '2019-09-07 13:07:07'),
(29, NULL, 'Profile', 'profile', 1, 1, 1, 0, 0, 0, 'route', 1, '2020-11-14 10:40:37', '2019-09-07 13:07:07'),
(30, NULL, 'Profile: Save', 'save-profile', 1, 1, 1, 0, 0, 0, 'route', 1, '2020-11-14 10:40:37', '2019-09-07 13:07:07'),
(31, NULL, 'Users: Add', 'add-user', 1, 0, 0, 0, 0, 0, 'route', 1, '2020-11-14 10:40:37', '2019-09-07 14:24:04'),
(32, NULL, 'Users: Edit', 'edit-user', 1, 0, 0, 0, 0, 0, 'route', 1, '2020-11-14 10:40:37', '2019-09-07 14:24:42'),
(33, NULL, 'Users: Save', 'save-user', 1, 0, 0, 0, 0, 0, 'route', 1, '2020-11-14 10:40:37', '2019-09-07 14:24:42'),
(34, NULL, 'Users: List', 'list-user', 1, 0, 0, 0, 0, 0, 'route', 1, '2020-11-14 10:40:37', '2019-09-07 14:25:56'),
(35, NULL, 'Users: Delete', 'delete-user', 1, 0, 0, 0, 0, 0, 'route', 1, '2020-11-14 10:40:37', '2019-09-07 14:25:56'),
(36, NULL, 'Rooms: Add', 'add-room', 1, 1, 0, 0, 0, 0, 'route', 1, '2020-11-14 10:40:37', '2019-09-07 14:25:56'),
(37, NULL, 'Rooms: Edit', 'edit-room', 1, 1, 0, 0, 0, 0, 'route', 1, '2020-11-14 10:40:37', '2019-09-07 14:25:56'),
(38, NULL, 'Rooms: Save', 'save-room', 1, 1, 0, 0, 0, 0, 'route', 1, '2020-11-14 10:40:37', '2019-09-07 14:26:41'),
(39, NULL, 'Rooms: List', 'list-room', 1, 1, 1, 0, 0, 0, 'route', 1, '2020-11-14 10:40:37', '2019-09-07 14:26:41'),
(40, NULL, 'Delete Room', 'delete-room', 1, 1, 0, 0, 0, 0, 'route', 1, '2020-11-14 10:40:37', '2019-09-07 14:26:41'),
(41, NULL, 'Room Types: Add', 'add-room-types', 1, 1, 0, 0, 0, 0, 'route', 1, '2020-11-14 10:40:37', '2019-09-07 14:26:41'),
(42, NULL, 'Room Types: Edit', 'edit-room-types', 1, 1, 0, 0, 0, 0, 'route', 1, '2020-11-14 10:40:37', '2019-09-07 14:27:50'),
(43, NULL, 'Room Types: Save', 'save-room-types', 1, 1, 0, 0, 0, 0, 'route', 1, '2020-11-14 10:40:37', '2019-09-07 14:27:50'),
(44, NULL, 'Room Types: List', 'list-room-types', 1, 1, 1, 0, 0, 0, 'route', 1, '2020-11-14 10:40:37', '2019-09-07 14:27:50'),
(45, NULL, 'Delete Room Types', 'delete-room-types', 1, 1, 0, 0, 0, 0, 'route', 1, '2020-11-14 10:40:37', '2019-09-07 14:27:50'),
(46, NULL, 'Amenities: Add', 'add-amenities', 1, 1, 0, 0, 0, 0, 'route', 1, '2020-11-14 10:40:37', '2019-09-07 14:29:41'),
(47, NULL, 'Amenities: Edit', 'edit-amenities', 1, 1, 0, 0, 0, 0, 'route', 1, '2020-11-14 10:40:37', '2019-09-07 14:29:41'),
(48, NULL, 'Amenities: Save', 'save-amenities', 1, 1, 0, 0, 0, 0, 'route', 1, '2020-11-14 10:40:37', '2019-09-07 14:29:41'),
(49, NULL, 'Amenities: List', 'list-amenities', 1, 1, 0, 0, 0, 0, 'route', 1, '2020-11-14 10:40:37', '2019-09-07 14:29:41'),
(50, NULL, 'Amenities: Delete', 'delete-amenities', 1, 1, 0, 0, 0, 0, 'route', 1, '2020-11-14 10:40:37', '2019-09-07 14:29:41'),
(51, NULL, 'room-reservation', 'room-reservation', 1, 1, 1, 0, 0, 0, 'route', 1, '2020-11-14 10:40:37', '2019-09-07 14:29:41'),
(52, NULL, 'Check In: Edit', 'edit-reservation', 1, 1, 1, 0, 0, 0, 'route', 0, '2020-11-14 10:40:37', '2019-09-07 14:29:41'),
(53, NULL, 'Check In: Save', 'save-reservation', 1, 1, 1, 0, 0, 0, 'route', 1, '2020-11-14 10:40:37', '2019-09-07 14:29:41'),
(54, NULL, 'Check Out', 'check-out-room', 1, 1, 1, 0, 0, 0, 'route', 1, '2020-11-14 10:40:37', '2019-09-07 14:29:41'),
(55, NULL, 'Check Out: List', 'check-out', 1, 1, 1, 0, 0, 0, 'route', 1, '2020-11-14 10:40:37', '2019-09-07 14:29:41'),
(56, NULL, 'Check In: List', 'list-reservation', 1, 1, 1, 0, 0, 0, 'route', 1, '2020-11-14 10:40:37', '2019-09-07 14:31:49'),
(57, NULL, 'view-reservation', 'view-reservation', 1, 1, 1, 0, 0, 0, 'route', 1, '2020-11-14 10:40:37', '2019-09-07 14:31:49'),
(58, NULL, 'Check In: Delete', 'delete-reservation', 1, 1, 1, 0, 0, 0, 'route', 1, '2020-11-14 10:40:37', '2019-09-07 14:31:49'),
(59, NULL, 'Food Category: Add', 'add-food-category', 1, 1, 0, 0, 0, 0, 'route', 1, '2020-11-14 10:40:37', '2019-09-07 14:31:49'),
(60, NULL, 'Food Category: Save', 'save-food-category', 1, 1, 0, 0, 0, 0, 'route', 1, '2020-11-14 10:40:37', '2019-09-07 14:31:49'),
(61, NULL, 'Food Category: List', 'list-food-category', 1, 1, 0, 0, 0, 0, 'route', 1, '2020-11-14 10:40:37', '2019-09-07 14:31:49'),
(62, NULL, 'Food Category: Delete', 'delete-food-category', 1, 1, 0, 0, 0, 0, 'route', 1, '2020-11-14 10:40:37', '2019-09-07 14:31:49'),
(63, NULL, 'Food Item: Add', 'add-food-item', 1, 1, 0, 0, 0, 0, 'route', 1, '2020-11-14 10:40:37', '2019-09-07 14:31:49'),
(64, NULL, 'Foot Item: Edit', 'edit-food-item', 1, 1, 0, 0, 0, 0, 'route', 1, '2020-11-14 10:40:37', '2019-09-07 14:31:49'),
(65, NULL, 'Food Item: Save', 'save-food-item', 1, 1, 0, 0, 0, 0, 'route', 1, '2020-11-14 10:40:37', '2019-09-07 14:31:49'),
(66, NULL, 'Food Item: List', 'list-food-item', 1, 1, 0, 0, 0, 0, 'route', 1, '2020-11-14 10:40:37', '2019-09-07 14:32:43'),
(67, NULL, 'Food Item: Delete', 'delete-food-item', 1, 1, 0, 0, 0, 0, 'route', 1, '2020-11-14 10:40:37', '2019-09-07 14:32:43'),
(68, NULL, 'Food Orders', 'food-order', 1, 1, 1, 0, 0, 0, 'route', 1, '2020-11-14 10:40:37', '2019-09-07 14:34:54'),
(69, NULL, 'Food Orders: Save', 'save-food-order', 1, 1, 1, 0, 0, 0, 'route', 1, '2020-11-14 10:40:37', '2019-09-07 14:34:54'),
(70, NULL, 'Orders: List', 'orders-list', 1, 1, 1, 0, 0, 0, 'route', 1, '2020-11-14 10:40:37', '2019-09-07 14:34:54'),
(71, NULL, 'Product: Add', 'add-product', 1, 1, 0, 0, 0, 0, 'route', 1, '2020-11-14 10:40:37', '2019-09-07 14:34:54'),
(72, NULL, 'Product: Edit', 'edit-product', 1, 1, 0, 0, 0, 0, 'route', 1, '2020-11-14 10:40:37', '2019-09-07 14:34:54'),
(73, NULL, 'Product: Save', 'save-product', 1, 1, 0, 0, 0, 0, 'route', 1, '2020-11-14 10:40:37', '2019-09-07 14:34:54'),
(74, NULL, 'Product: List', 'list-product', 1, 1, 0, 0, 0, 0, 'route', 1, '2020-11-14 10:40:37', '2019-09-07 14:34:54'),
(75, NULL, 'Product: Delete', 'delete-product', 1, 1, 0, 0, 0, 0, 'route', 1, '2020-11-14 10:40:37', '2019-09-07 14:34:54'),
(76, NULL, 'IO Stock', 'io-stock', 1, 1, 1, 0, 0, 0, 'route', 1, '2020-11-14 10:40:37', '2019-09-07 14:34:54'),
(77, NULL, 'Stocks: Save', 'save-stock', 1, 1, 1, 0, 0, 0, 'route', 1, '2020-11-14 10:40:37', '2019-09-07 14:34:54'),
(78, NULL, 'Stock History', 'stock-history', 1, 0, 0, 0, 0, 0, 'route', 1, '2020-11-14 10:40:37', '2019-09-07 14:34:54'),
(79, NULL, 'Invoice', 'invoice', 1, 1, 1, 0, 0, 0, 'route', 1, '2020-11-14 10:40:37', '2019-09-07 15:20:44'),
(80, NULL, 'Settings', 'settings', 1, 0, 0, 0, 0, 0, 'route', 1, '2020-11-14 10:40:37', '2019-09-07 15:20:44'),
(81, NULL, 'Settings', 'settings', 1, 0, 0, 0, 0, 0, 'menu', 1, '2020-11-14 10:40:37', '2019-09-07 15:20:44'),
(82, NULL, 'Settings: Save', 'save-settings', 1, 0, 0, 0, 0, 0, 'route', 1, '2020-11-14 10:40:37', '2019-09-07 15:20:44'),
(83, NULL, 'Check Out: List', 'list-check-outs', 1, 1, 1, 0, 0, 0, 'route', 1, '2020-11-14 10:40:37', '2019-09-07 15:20:44'),
(84, NULL, 'Check Out: List', 'list-check-outs', 1, 1, 1, 0, 0, 0, 'menu', 1, '2020-11-14 10:40:37', '2019-09-07 15:20:44'),
(85, NULL, 'Invoice Order', 'order-invoice', 1, 1, 1, 0, 0, 0, 'route', 1, '2020-11-14 10:40:37', '2019-09-07 15:20:44'),
(86, NULL, 'Invoice: Final Order', 'order-invoice-final', 1, 1, 1, 0, 0, 0, 'route', 1, '2020-11-14 10:40:38', '2019-09-07 15:20:44'),
(87, NULL, 'food order final', 'food-order-final', 1, 1, 1, 0, 0, 0, 'route', 1, '2020-11-14 10:40:38', '2019-09-07 15:20:44'),
(88, NULL, 'Food Orders Table', 'food-order-table', 1, 1, 1, 0, 0, 0, 'route', 1, '2020-11-14 10:40:38', '2019-09-07 15:20:44'),
(89, NULL, 'Invoice: kitchen', 'kitchen-invoice', 1, 1, 1, 0, 0, 0, 'route', 1, '2020-11-14 10:40:38', '2019-09-07 15:20:44'),
(90, NULL, 'delete order item', 'delete-order-item', 1, 1, 1, 0, 0, 0, 'route', 1, '2020-11-14 10:40:38', '2019-09-07 15:20:44'),
(91, NULL, 'Orders: Search', 'search-orders', 1, 1, 1, 0, 0, 0, 'route', 1, '2020-11-14 10:40:38', '2019-09-07 15:20:44'),
(92, NULL, 'Orders: Export', 'export-orders', 1, 1, 1, 0, 0, 0, 'route', 1, '2020-11-14 10:40:38', '2019-09-07 15:20:44'),
(93, NULL, 'Stocks: Search', 'search-stocks', 1, 1, 1, 0, 0, 0, 'route', 1, '2020-11-14 10:40:38', '2019-09-07 15:20:44'),
(94, NULL, 'Stocks: Export', 'export-stocks', 1, 1, 1, 0, 0, 0, 'route', 1, '2020-11-14 10:40:38', '2019-09-07 15:20:44'),
(95, NULL, 'Check In: Search', 'search-checkins', 1, 1, 1, 0, 0, 0, 'route', 1, '2020-11-14 10:40:38', '2019-09-07 15:20:44'),
(96, NULL, 'Check In: Export', 'export-checkins', 1, 1, 1, 0, 0, 0, 'route', 1, '2020-11-14 10:40:38', '2019-09-07 15:20:44'),
(97, NULL, 'Check Out: Search', 'search-checkouts', 1, 1, 1, 0, 0, 0, 'route', 1, '2020-11-14 10:40:38', '2019-09-07 15:20:44'),
(98, NULL, 'Check Out: Export', 'export-checkouts', 1, 1, 1, 0, 0, 0, 'route', 1, '2020-11-14 10:40:38', '2019-09-07 15:20:44'),
(99, NULL, 'Media Files: Delete', 'delete-mediafile', 1, 1, 1, 0, 0, 0, 'route', 1, '2020-11-14 10:40:38', '2019-09-07 15:20:44'),
(100, NULL, 'Permissions', 'permissions', 1, 0, 0, 0, 0, 0, 'menu', 1, '2020-11-14 10:40:37', '2019-09-07 11:59:02'),
(101, NULL, 'Permission: Update', 'save-permissions', 1, 1, 0, 0, 0, 0, 'route', 1, '2020-11-14 10:40:38', '2019-09-07 15:20:44'),
(102, NULL, 'Permission: List', 'permissions-list', 1, 1, 0, 0, 0, 0, 'route', 1, '2020-11-14 10:40:38', '2019-09-07 15:20:44'),
(103, NULL, 'Customers', 'customers', 1, 1, 1, 0, 0, 0, 'menu', 1, '2020-11-14 10:40:37', '2019-09-07 15:20:44'),
(104, 103, 'Customers : Add', 'add-customers', 1, 1, 1, 0, 0, 0, 'menu', 1, '2020-11-14 10:40:37', '2019-09-07 15:20:44'),
(105, 103, 'Customers : List', 'list-customers', 1, 1, 1, 0, 0, 0, 'menu', 1, '2020-11-14 10:40:37', '2019-09-07 15:20:44'),
(106, NULL, 'Customer: Add', 'add-customer', 1, 1, 1, 0, 0, 0, 'route', 1, '2020-11-14 10:40:38', '2019-09-07 15:20:44'),
(107, NULL, 'Customers: Edit', 'edit-customer', 1, 1, 1, 0, 0, 0, 'route', 1, '2020-11-14 10:40:38', '2019-09-07 15:20:44'),
(108, NULL, 'Customer: Save', 'save-customer', 1, 1, 1, 0, 0, 0, 'route', 1, '2020-11-14 10:40:38', '2019-09-07 15:20:44'),
(109, NULL, 'Customer: List', 'list-customer', 1, 1, 1, 0, 0, 0, 'route', 1, '2020-11-14 10:40:38', '2019-09-07 15:20:44'),
(110, NULL, 'Customers: Delete', 'delete-customer', 1, 1, 1, 0, 0, 0, 'route', 1, '2020-11-14 10:40:38', '2019-09-07 15:20:44'),
(111, NULL, 'Expense', 'expenses', 1, 1, 1, 0, 0, 0, 'menu', 1, '2020-11-14 10:40:37', '2019-09-07 15:20:44'),
(112, 111, 'Expense : Add', 'add-expenses', 1, 1, 1, 0, 0, 0, 'menu', 1, '2020-11-14 10:40:37', '2019-09-07 15:20:44'),
(113, 111, 'Expense : List', 'list-expenses', 1, 1, 1, 0, 0, 0, 'menu', 1, '2020-11-14 10:40:37', '2019-09-07 15:20:44'),
(114, NULL, 'Expense: Add', 'add-expense', 1, 1, 1, 0, 0, 0, 'route', 1, '2020-11-14 10:40:38', '2019-09-07 15:20:44'),
(115, NULL, 'Expense: Edit', 'edit-expense', 1, 1, 1, 0, 0, 0, 'route', 1, '2020-11-14 10:40:38', '2019-09-07 15:20:44'),
(116, NULL, 'Expense: Save', 'save-expense', 1, 1, 1, 0, 0, 0, 'route', 1, '2020-11-14 10:40:38', '2019-09-07 15:20:44'),
(117, NULL, 'Expense: List', 'list-expense', 1, 1, 1, 0, 0, 0, 'route', 1, '2020-11-14 10:40:38', '2019-09-07 15:20:44'),
(118, NULL, 'Expense: Delete', 'delete-expense', 1, 1, 1, 0, 0, 0, 'route', 1, '2020-11-14 10:40:38', '2019-09-07 15:20:44'),
(119, NULL, 'Expense Category', 'expense-categories', 1, 1, 1, 0, 0, 0, 'menu', 1, '2020-11-14 10:40:37', '2019-09-07 15:20:44'),
(120, 119, 'Expense Category : Add', 'add-expense-category', 1, 1, 1, 0, 0, 0, 'menu', 1, '2020-11-14 10:40:37', '2019-09-07 15:20:44'),
(121, 119, 'Expense Category : List', 'list-expense-category', 1, 1, 1, 0, 0, 0, 'menu', 1, '2020-11-14 10:40:37', '2019-09-07 15:20:44'),
(122, NULL, 'Expense: Add Category', 'add-expense-category', 1, 1, 1, 0, 0, 0, 'route', 1, '2020-11-14 10:40:38', '2019-09-07 15:20:44'),
(123, NULL, 'Expense Category: Edit', 'edit-expense-category', 1, 1, 1, 0, 0, 0, 'route', 1, '2020-11-14 10:40:38', '2019-09-07 15:20:44'),
(124, NULL, 'Expense Category: Save', 'save-expense-category', 1, 1, 1, 0, 0, 0, 'route', 1, '2020-11-14 10:40:38', '2019-09-07 15:20:44'),
(125, NULL, 'Expense Category: List', 'list-expense-category', 1, 1, 1, 0, 0, 0, 'route', 1, '2020-11-14 10:40:38', '2019-09-07 15:20:44'),
(126, NULL, 'Expense Category: Delete', 'delete-expense-category', 1, 1, 1, 0, 0, 0, 'route', 1, '2020-11-14 10:40:38', '2019-09-07 15:20:44'),
(127, NULL, 'Expense: Search', 'search-expenses', 1, 1, 1, 0, 0, 0, 'route', 1, '2020-11-14 10:40:38', '2019-09-07 15:20:44'),
(128, NULL, 'Expense: Export', 'export-expenses', 1, 1, 1, 0, 0, 0, 'route', 1, '2020-11-14 10:40:38', '2019-09-07 15:20:44'),
(129, 2, 'Quick Check In', 'quick-check-in', 1, 1, 1, 0, 0, 0, 'menu', 1, '2020-11-14 10:40:37', '2019-09-07 11:59:02'),
(130, NULL, 'Quick Check In', 'quick-check-in', 1, 1, 1, 0, 0, 0, 'route', 1, '2020-11-14 10:40:37', '2019-09-07 14:29:41'),
(131, NULL, 'Check In: Advance Pay', 'advance-pay', 1, 1, 1, 0, 0, 0, 'route', 1, '2021-05-26 19:06:19', '2019-09-07 08:59:41'),
(132, NULL, 'Check In: Swap Room', 'swap-room', 1, 1, 1, 0, 0, 0, 'route', 1, '2021-05-26 19:06:19', '2019-09-07 08:59:41'),
(133, NULL, 'Check In: Swap Room Save', 'save-swap-room', 1, 1, 1, 0, 0, 0, 'route', 1, '2021-05-26 19:06:19', '2019-09-07 08:59:41'),
(134, NULL, 'Dynamic Dropdowns', 'dynamic-dropdowns', 1, 0, 0, 0, 0, 0, 'menu', 1, '2021-05-26 19:06:17', '2019-09-07 06:29:02'),
(135, NULL, 'Dynamic Dropdowns', 'save-dynamic-dropdowns', 1, 1, 0, 0, 0, 0, 'route', 1, '2021-05-26 19:06:19', '2019-09-07 09:50:44'),
(136, NULL, 'Dynamic Dropdowns: List', 'dynamic-dropdown-list', 1, 1, 0, 0, 0, 0, 'route', 1, '2021-05-26 19:06:19', '2019-09-07 09:50:44'),
(137, NULL, 'Check Out: Mark As Paid', 'mark-as-paid', 1, 1, 1, 0, 0, 0, 'route', 1, '2021-05-26 19:06:19', '2019-09-07 08:59:41'),
(138, NULL, 'Customer: Search', 'search-customer', 1, 1, 1, 0, 0, 0, 'route', 1, '2021-05-26 19:06:19', '2019-09-07 09:50:44'),
(139, NULL, 'Customer: Export', 'export-customer', 1, 1, 1, 0, 0, 0, 'route', 0, '2020-11-14 10:40:38', '2019-09-07 09:50:44'),
(140, NULL, 'website_Pages', 'website-pages', 1, 1, 0, 0, 0, 0, 'menu', 1, '2021-05-26 19:06:17', '2019-09-07 06:29:02'),
(141, 140, 'Home Page ', 'home-page', 1, 1, 0, 0, 0, 0, 'route', 1, '2021-05-26 19:06:17', '2019-09-07 06:29:02'),
(142, 140, 'About Page ', 'about-page', 1, 1, 0, 0, 0, 0, 'route', 1, '2021-05-26 19:06:17', '2019-09-07 06:29:02'),
(143, 140, 'Contact Page ', 'contact-page', 1, 1, 0, 0, 0, 0, 'route', 1, '2021-05-26 19:06:17', '2019-09-07 06:29:02'),
(144, 140, 'Home Page Update', 'update-home-page', 1, 1, 0, 0, 0, 0, 'route', 1, '2021-05-26 19:06:17', '2019-09-07 06:29:02'),
(145, 140, 'About Page Update', 'update-about-page', 1, 1, 0, 0, 0, 0, 'route', 1, '2021-05-26 19:06:17', '2019-09-07 06:29:02'),
(146, 140, 'Contact Page Update', 'update-contact-page', 1, 1, 0, 0, 0, 0, 'route', 1, '2021-05-26 19:06:17', '2019-09-07 06:29:02'),
(147, NULL, 'Reports', 'reports', 1, 0, 0, 0, 0, 0, 'menu', 1, '2020-11-14 10:40:37', '2019-09-07 15:20:44'),
(148, NULL, 'Reports', 'reports', 1, 0, 0, 0, 0, 0, 'route', 1, '2020-11-14 10:40:37', '2019-09-07 15:20:44'),
(149, NULL, 'Payment History: Search', 'search-payment-history', 1, 1, 1, 0, 0, 0, 'route', 1, '2021-05-26 19:06:19', '2019-09-07 09:50:44'),
(150, NULL, 'Payment History: Export', 'export-payment-history', 1, 1, 1, 0, 0, 0, 'route', 0, '2020-11-14 10:40:38', '2019-09-07 09:50:44');

-- --------------------------------------------------------

--
-- Table structure for table `person_lists`
--

DROP TABLE IF EXISTS `person_lists`;
CREATE TABLE `person_lists` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `address` text,
  `idcard_type` int(11) DEFAULT NULL,
  `idcard_no` varchar(80) DEFAULT NULL,
  `reservation_id` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `measurement` int(11) DEFAULT NULL,
  `stock_qty` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT '0',
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `invoice_num` varchar(255) DEFAULT NULL,
  `guest_type` enum('new','existing') DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  `check_in` datetime NOT NULL,
  `check_out` datetime DEFAULT NULL,
  `duration_of_stay` int(11) DEFAULT '0',
  `adult` int(11) NOT NULL DEFAULT '0',
  `kids` int(11) DEFAULT '0',
  `booked_by` varchar(255) DEFAULT NULL,
  `referred_by` varchar(80) DEFAULT NULL,
  `referred_by_name` varchar(100) DEFAULT NULL,
  `checked_out_by` varchar(255) DEFAULT NULL,
  `vehicle_number` varchar(80) DEFAULT NULL,
  `idcard_type` int(11) DEFAULT NULL,
  `idcard_no` varchar(255) DEFAULT NULL,
  `idcard_image` varchar(255) DEFAULT NULL,
  `booking_type` enum('Online','Offline') NOT NULL DEFAULT 'Offline',
  `payment_status` int(11) NOT NULL DEFAULT '0' COMMENT '0=Pending 1=Success',
  `payment_mode` int(11) DEFAULT NULL,
  `reason_visit_stay` text,
  `amount_json` text,
  `gst_perc` float(10,2) DEFAULT '0.00',
  `cgst_perc` float(10,2) DEFAULT '0.00',
  `discount` float(10,2) NOT NULL DEFAULT '0.00',
  `gst_amount` float(10,2) NOT NULL DEFAULT '0.00',
  `cgst_amount` float(10,2) NOT NULL DEFAULT '0.00',
  `sub_total` float(10,2) NOT NULL DEFAULT '0.00',
  `grand_total` float(10,2) NOT NULL DEFAULT '0.00',
  `addtional_amount` float(10,2) NOT NULL DEFAULT '0.00',
  `additional_amount_reason` varchar(255) DEFAULT NULL,
  `advance_payment` float(10,2) DEFAULT '0.00',
  `remark_amount` float(10,2) DEFAULT NULL,
  `remark` text,
  `company_gst_num` varchar(255) DEFAULT NULL,
  `room_plan` varchar(10) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT '0',
  `is_checkout` int(11) NOT NULL DEFAULT '0' COMMENT '1=Yes',
  `is_confirmed` int(11) NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at_checkin` datetime DEFAULT NULL,
  `created_at_checkout` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role` varchar(50) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `slug`, `status`, `updated_at`, `created_at`) VALUES
(1, 'Super Admin', 'super_admin', 1, NULL, '2019-08-27 05:12:15'),
(2, 'Admin', 'admin', 1, NULL, '2019-08-27 05:12:15'),
(3, 'Receptionist', 'receptionist', 1, NULL, '2019-08-27 05:12:45'),
(4, 'Store Manager', 'store_manager', 1, NULL, '2019-08-27 05:12:45'),
(5, 'Financial Manager', 'financial_manager', 1, NULL, '2019-08-27 05:12:45'),
(6, 'customer', 'customer', 0, NULL, '2021-11-20 05:45:06');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

DROP TABLE IF EXISTS `rooms`;
CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `room_type_id` int(11) NOT NULL,
  `room_no` varchar(80) NOT NULL,
  `room_name` varchar(255) DEFAULT NULL,
  `floor` int(11) NOT NULL,
  `order_num` int(11) NOT NULL DEFAULT '100000',
  `description` text,
  `status` int(11) NOT NULL DEFAULT '1',
  `is_deleted` int(11) NOT NULL DEFAULT '0',
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `room_type_id`, `room_no`, `room_name`, `floor`, `order_num`, `description`, `status`, `is_deleted`, `updated_at`, `created_at`) VALUES
(1, 3, '101', 'Executive Room', 15, 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 1, 0, '2021-11-23 17:50:39', '2021-09-06 04:12:20'),
(2, 3, '102', 'PRM-Double', 15, 2, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 1, 1, '2021-11-23 17:50:04', '2021-11-06 07:27:31'),
(3, 3, '103', 'PRM-Double', 15, 3, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 1, 1, '2021-11-23 17:50:00', '2021-11-06 07:27:31'),
(4, 2, '102', 'Standard Room', 16, 2, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 1, 0, '2021-11-23 17:51:25', '2021-11-06 07:58:24'),
(5, 1, '301', 'DLX-Single', 17, 5, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 1, 1, '2021-11-23 17:49:54', '2021-11-06 07:58:50');

-- --------------------------------------------------------

--
-- Table structure for table `room_carts`
--

DROP TABLE IF EXISTS `room_carts`;
CREATE TABLE `room_carts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `room_id` int(11) NOT NULL,
  `date_from` datetime DEFAULT NULL,
  `date_to` datetime DEFAULT NULL,
  `duration_of_stay` int(11) NOT NULL DEFAULT '1',
  `adults` int(11) NOT NULL DEFAULT '0',
  `children` int(11) NOT NULL DEFAULT '0',
  `location` varchar(255) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `room_types`
--

DROP TABLE IF EXISTS `room_types`;
CREATE TABLE `room_types` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `short_code` varchar(10) NOT NULL,
  `adult_capacity` int(11) DEFAULT '0',
  `kids_capacity` int(11) NOT NULL DEFAULT '0',
  `base_price` float(10,2) DEFAULT '0.00',
  `amenities` varchar(255) DEFAULT NULL,
  `description` longtext,
  `order_num` int(11) NOT NULL DEFAULT '100000',
  `status` int(11) NOT NULL DEFAULT '1',
  `is_deleted` int(11) NOT NULL DEFAULT '0',
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room_types`
--

INSERT INTO `room_types` (`id`, `title`, `short_code`, `adult_capacity`, `kids_capacity`, `base_price`, `amenities`, `description`, `order_num`, `status`, `is_deleted`, `updated_at`, `created_at`) VALUES
(1, 'Delux Rooms', 'DLX', 2, 2, 777.00, '1,3,5,4', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 3, 1, 1, '2021-11-23 17:47:52', '2021-09-06 04:12:00'),
(2, 'Standard', 'STD', 2, 2, 250.00, '1,10,3,5,7,4', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 2, 1, 0, '2021-11-23 17:48:34', '2021-11-06 06:41:02'),
(3, 'Executive', 'EXE', 2, 2, 350.00, '1,10,6,8,3,5,7,4,9,2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 1, 1, 0, '2021-11-23 17:47:41', '2021-11-06 06:45:51');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` text COLLATE utf8_unicode_ci,
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`, `updated_at`, `created_at`) VALUES
(1, 'site_page_title', 'divllo Hotel & Resort', '2021-12-28 02:30:30', '2020-07-19 06:16:19'),
(2, 'site_language', 'en', '2021-12-28 02:30:30', '2020-07-19 06:16:19'),
(3, 'hotel_name', 'divllo Hotel & Resort', '2021-12-28 02:30:30', '2020-07-19 06:16:19'),
(4, 'hotel_tagline', 'divllo Resort', '2021-12-28 02:30:30', '2020-07-19 06:16:19'),
(5, 'hotel_email', 'divllo@gmail.com', '2021-12-28 02:30:30', '2020-07-19 06:16:19'),
(6, 'hotel_phone', '1234567890', '2021-12-28 02:30:30', '2020-07-19 06:16:19'),
(7, 'hotel_mobile', '9087654321', '2021-12-28 02:30:30', '2020-07-19 06:16:19'),
(8, 'hotel_website', 'https://divllo.com/', '2021-12-28 02:30:30', '2020-07-19 06:16:19'),
(9, 'hotel_address', 'Colony Road, near Bikash Bharati High School.Jangal Khas.', '2021-12-28 02:30:30', '2020-07-19 06:16:19'),
(10, 'gst_num', '19ABQFA0476P1ZO', '2021-12-28 02:30:30', '2020-07-19 06:16:19'),
(11, 'gst', '6', '2021-12-28 02:30:30', '2020-07-19 06:16:19'),
(12, 'cgst', '6', '2021-12-28 02:30:30', '2020-07-19 06:16:19'),
(13, 'food_gst', '2.5', '2021-12-28 02:30:31', '2020-07-19 06:16:19'),
(14, 'food_cgst', '2.5', '2021-12-28 02:30:31', '2020-07-19 06:16:19'),
(15, 'currency', 'INR', '2021-12-28 02:30:31', '2020-11-10 00:41:22'),
(16, 'currency_symbol', '₹', '2021-12-28 02:30:31', '2020-11-10 00:41:22'),
(17, 'sms_api_active', '0', '2021-12-28 02:30:30', '2020-11-15 02:25:55'),
(18, 'default_nationality', '81', '2021-12-28 02:30:31', '2020-11-15 02:25:55'),
(19, 'default_country', 'India', '2021-12-28 02:30:31', '2020-11-15 02:25:55'),
(20, 'invoice_term_condition', '<h1 style=\"font-size: 13px; color: rgb(0, 0, 0); font-family: \" times=\"\" new=\"\" roman\";=\"\" font-weight:=\"\" bold=\"\" !important;\"=\"\">Terms and Conditions</h1><h1 style=\"font-size: 13px; color: rgb(0, 0, 0); font-family: \" times=\"\" new=\"\" roman\";=\"\" font-weight:=\"\" bold=\"\" !important;\"=\"\">General Site Usage</h1><p style=\"font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\">Last Revised: january 16, 2021.</p><p style=\"font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\">Welcome to www.lorem-ipsum.info. This site is provided as a service to our visitors and may be used for informational purposes only. Because the Terms and Conditions contain legal obligations, please read them carefully.</p><h2 style=\"font-size: 13px; color: rgb(0, 0, 0); font-family: \" times=\"\" new=\"\" roman\";=\"\" font-weight:=\"\" bold=\"\" !important;\"=\"\">1. YOUR AGREEMENT</h2><p style=\"font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\">By using this Site, you agree to be bound by, and to comply with, these Terms and Conditions. If you do not agree to these Terms and Conditions, please do not use this site.</p><blockquote style=\"font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\">PLEASE NOTE: We reserve the right, at our sole discretion, to change, modify or otherwise alter these Terms and Conditions at any time. Unless otherwise indicated, amendments will become effective immediately. Please review these Terms and Conditions periodically. Your continued use of the Site following the posting of changes and/or modifications will constitute your acceptance of the revised Terms and Conditions and the reasonableness of these standards for notice of changes. For your information, this page was last updated as of the date at the top of these terms and conditions.</blockquote><h2 style=\"font-size: 13px; color: rgb(0, 0, 0); font-family: \" times=\"\" new=\"\" roman\";=\"\" font-weight:=\"\" bold=\"\" !important;\"=\"\">2. PRIVACY</h2><p style=\"font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\">Please review our Privacy Policy, which also governs your visit to this Site, to understand our practices.</p><h2 style=\"font-size: 13px; color: rgb(0, 0, 0); font-family: \" times=\"\" new=\"\" roman\";=\"\" font-weight:=\"\" bold=\"\" !important;\"=\"\">3. LINKED SITES</h2><p style=\"font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\">This Site may contain links to other independent third-party Web sites (\"Linked Sites”). These Linked Sites are provided solely as a convenience to our visitors. Such Linked Sites are not under our control, and we are not responsible for and does not endorse the content of such Linked Sites, including any information or materials contained on such Linked Sites. You will need to make your own independent judgment regarding your interaction with these Linked Sites.</p><h2 style=\"font-size: 13px; color: rgb(0, 0, 0); font-family: \" times=\"\" new=\"\" roman\";=\"\" font-weight:=\"\" bold=\"\" !important;\"=\"\">4. FORWARD LOOKING STATEMENTS</h2><p style=\"font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\">All materials reproduced on this site speak as of the original date of publication or filing. The fact that a document is available on this site does not mean that the information contained in such document has not been modified or superseded by events or by a subsequent document or filing. We have no duty or policy to update any information or statements contained on this site and, therefore, such information or statements should not be relied upon as being current as of the date you access this site.</p><h2 style=\"font-size: 13px; color: rgb(0, 0, 0); font-family: \" times=\"\" new=\"\" roman\";=\"\" font-weight:=\"\" bold=\"\" !important;\"=\"\">5. DISCLAIMER OF WARRANTIES AND LIMITATION OF LIABILITY</h2><p style=\"font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\">A. THIS SITE MAY CONTAIN INACCURACIES AND TYPOGRAPHICAL ERRORS. WE DOES NOT WARRANT THE ACCURACY OR COMPLETENESS OF THE MATERIALS OR THE RELIABILITY OF ANY ADVICE, OPINION, STATEMENT OR OTHER INFORMATION DISPLAYED OR DISTRIBUTED THROUGH THE SITE. YOU EXPRESSLY UNDERSTAND AND AGREE THAT: (i) YOUR USE OF THE SITE, INCLUDING ANY RELIANCE ON ANY SUCH OPINION, ADVICE, STATEMENT, MEMORANDUM, OR INFORMATION CONTAINED HEREIN, SHALL BE AT YOUR SOLE RISK; (ii) THE SITE IS PROVIDED ON AN \"AS IS\" AND \"AS AVAILABLE\" BASIS; (iii) EXCEPT AS EXPRESSLY PROVIDED HEREIN WE DISCLAIM ALL WARRANTIES OF ANY KIND, WHETHER EXPRESS OR IMPLIED, INCLUDING, BUT NOT LIMITED TO IMPLIED WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, WORKMANLIKE EFFORT, TITLE AND NON-INFRINGEMENT; (iv) WE MAKE NO WARRANTY WITH RESPECT TO THE RESULTS THAT MAY BE OBTAINED FROM THIS SITE, THE PRODUCTS OR SERVICES ADVERTISED OR OFFERED OR MERCHANTS INVOLVED; (v) ANY MATERIAL DOWNLOADED OR OTHERWISE OBTAINED THROUGH THE USE OF THE SITE IS DONE AT YOUR OWN DISCRETION AND RISK; and (vi) YOU WILL BE SOLELY RESPONSIBLE FOR ANY DAMAGE TO YOUR COMPUTER SYSTEM OR FOR ANY LOSS OF DATA THAT RESULTS FROM THE DOWNLOAD OF ANY SUCH MATERIAL.</p><p style=\"font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\">B. YOU UNDERSTAND AND AGREE THAT UNDER NO CIRCUMSTANCES, INCLUDING, BUT NOT LIMITED TO, NEGLIGENCE, SHALL WE BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, PUNITIVE OR CONSEQUENTIAL DAMAGES THAT RESULT FROM THE USE OF, OR THE INABILITY TO USE, ANY OF OUR SITES OR MATERIALS OR FUNCTIONS ON ANY SUCH SITE, EVEN IF WE HAVE BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES. THE FOREGOING LIMITATIONS SHALL APPLY NOTWITHSTANDING ANY FAILURE OF ESSENTIAL PURPOSE OF ANY LIMITED REMEDY.</p><h2 style=\"font-size: 13px; color: rgb(0, 0, 0); font-family: \" times=\"\" new=\"\" roman\";=\"\" font-weight:=\"\" bold=\"\" !important;\"=\"\">6. EXCLUSIONS AND LIMITATIONS</h2><p style=\"font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\">SOME JURISDICTIONS DO NOT ALLOW THE EXCLUSION OF CERTAIN WARRANTIES OR THE LIMITATION OR EXCLUSION OF LIABILITY FOR INCIDENTAL OR CONSEQUENTIAL DAMAGES. ACCORDINGLY, OUR LIABILITY IN SUCH JURISDICTION SHALL BE LIMITED TO THE MAXIMUM EXTENT PERMITTED BY LAW.</p><h2 style=\"font-size: 13px; color: rgb(0, 0, 0); font-family: \" times=\"\" new=\"\" roman\";=\"\" font-weight:=\"\" bold=\"\" !important;\"=\"\">7. OUR PROPRIETARY RIGHTS</h2><p style=\"font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\">This Site and all its Contents are intended solely for personal, non-commercial use. Except as expressly provided, nothing within the Site shall be construed as conferring any license under our or any third party\'s intellectual property rights, whether by estoppel, implication, waiver, or otherwise. Without limiting the generality of the foregoing, you acknowledge and agree that all content available through and used to operate the Site and its services is protected by copyright, trademark, patent, or other proprietary rights. You agree not to: (a) modify, alter, or deface any of the trademarks, service marks, trade dress (collectively \"Trademarks\") or other intellectual property made available by us in connection with the Site; (b) hold yourself out as in any way sponsored by, affiliated with, or endorsed by us, or any of our affiliates or service providers; (c) use any of the Trademarks or other content accessible through the Site for any purpose other than the purpose for which we have made it available to you; (d) defame or disparage us, our Trademarks, or any aspect of the Site; and (e) adapt, translate, modify, decompile, disassemble, or reverse engineer the Site or any software or programs used in connection with it or its products and services.</p><p style=\"font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\">The framing, mirroring, scraping or data mining of the Site or any of its content in any form and by any method is expressly prohibited.</p><h2 style=\"font-size: 13px; color: rgb(0, 0, 0); font-family: \" times=\"\" new=\"\" roman\";=\"\" font-weight:=\"\" bold=\"\" !important;\"=\"\">8. INDEMNITY</h2><p style=\"font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\">By using the Site web sites you agree to indemnify us and affiliated entities (collectively \"Indemnities\") and hold them harmless from any and all claims and expenses, including (without limitation) attorney\'s fees, arising from your use of the Site web sites, your use of the Products and Services, or your submission of ideas and/or related materials to us or from any person\'s use of any ID, membership or password you maintain with any portion of the Site, regardless of whether such use is authorized by you.</p><h2 style=\"font-size: 13px; color: rgb(0, 0, 0); font-family: \" times=\"\" new=\"\" roman\";=\"\" font-weight:=\"\" bold=\"\" !important;\"=\"\">9. COPYRIGHT AND TRADEMARK NOTICE</h2><p style=\"font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\">Except our generated dummy copy, which is free to use for private and commercial use, all other text is copyrighted. generator.lorem-ipsum.info © 2013, all rights reserved</p><h2 style=\"font-size: 13px; color: rgb(0, 0, 0); font-family: \" times=\"\" new=\"\" roman\";=\"\" font-weight:=\"\" bold=\"\" !important;\"=\"\">10. INTELLECTUAL PROPERTY INFRINGEMENT CLAIMS</h2><p style=\"font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\">It is our policy to respond expeditiously to claims of intellectual property infringement. We will promptly process and investigate notices of alleged infringement and will take appropriate actions under the Digital Millennium Copyright Act (\"DMCA\") and other applicable intellectual property laws. Notices of claimed infringement should be directed to:</p><p style=\"font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\">generator.lorem-ipsum.info</p><p style=\"font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\">126 Electricov St.</p><p style=\"font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\">Kiev, Kiev 04176</p><p style=\"font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\">Ukraine</p><p style=\"font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\">contact@lorem-ipsum.info</p><h2 style=\"font-size: 13px; color: rgb(0, 0, 0); font-family: \" times=\"\" new=\"\" roman\";=\"\" font-weight:=\"\" bold=\"\" !important;\"=\"\">11. PLACE OF PERFORMANCE</h2><p style=\"font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\">This Site is controlled, operated and administered by us from our office in Kiev, Ukraine. We make no representation that materials at this site are appropriate or available for use at other locations outside of the Ukraine and access to them from territories where their contents are illegal is prohibited. If you access this Site from a location outside of the Ukraine, you are responsible for compliance with all local laws.</p><h2 style=\"font-size: 13px; color: rgb(0, 0, 0); font-family: \" times=\"\" new=\"\" roman\";=\"\" font-weight:=\"\" bold=\"\" !important;\"=\"\">12. GENERAL</h2><p style=\"font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\">A. If any provision of these Terms and Conditions is held to be invalid or unenforceable, the provision shall be removed (or interpreted, if possible, in a manner as to be enforceable), and the remaining provisions shall be enforced. Headings are for reference purposes only and in no way define, limit, construe or describe the scope or extent of such section. Our failure to act with respect to a breach by you or others does not waive our right to act with respect to subsequent or similar breaches. These Terms and Conditions set forth the entire understanding and agreement between us with respect to the subject matter contained herein and supersede any other agreement, proposals and communications, written or oral, between our representatives and you with respect to the subject matter hereof, including any terms and conditions on any of customer\'s documents or purchase orders.</p><p style=\"font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\">B. No Joint Venture, No Derogation of Rights. You agree that no joint venture, partnership, employment, or agency relationship exists between you and us as a result of these Terms and Conditions or your use of the Site. Our performance of these Terms and Conditions is subject to existing laws and legal process, and nothing contained herein is in derogation of our right to comply with governmental, court and law enforcement requests or requirements relating to your use of the Site or information provided to or gathered by us with respect to such use.</p>', '2021-12-28 02:30:31', '2020-11-15 02:25:55'),
(21, 'files', NULL, '2021-05-26 02:30:24', '2020-11-15 02:25:55'),
(22, 'bank_acc_name', 'Aranyak Resort', '2021-12-28 02:30:31', '2021-03-27 07:20:01'),
(23, 'bank_ifsc_code', 'PUNB0018020', '2021-12-28 02:30:31', '2021-03-27 07:20:01'),
(24, 'bank_acc_num', '0180050163637', '2021-12-28 02:30:31', '2021-03-27 07:20:01'),
(25, 'bank_name', 'Punjab National Bank', '2021-12-28 02:30:31', '2021-03-27 07:20:01'),
(26, 'bank_branch', 'Midnapore', '2021-12-28 02:30:31', '2021-03-27 07:20:01'),
(27, 'default_rec_days', '15', '2021-12-28 02:30:31', '2021-05-26 08:58:29'),
(28, 'site_logo', 'd76e10d2292d1bfa9f000545009607c6_1640682030.png', '2021-12-28 14:30:30', '2021-05-26 10:07:30'),
(29, 'site_logo_height', '100', '2021-12-28 02:30:31', '2021-05-26 10:21:03'),
(30, 'site_logo_width', '100', '2021-12-28 02:30:31', '2021-05-26 10:21:03');

-- --------------------------------------------------------

--
-- Table structure for table `stock_history`
--

DROP TABLE IF EXISTS `stock_history`;
CREATE TABLE `stock_history` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` float(10,2) DEFAULT NULL,
  `stock_is` enum('add','subtract') DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

DROP TABLE IF EXISTS `testimonials`;
CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL,
  `client_image` varchar(255) DEFAULT NULL,
  `client_name` varchar(255) DEFAULT NULL,
  `client_position` varchar(100) DEFAULT NULL,
  `client_comment` text,
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `client_image`, `client_name`, `client_position`, `client_comment`, `updated_at`, `created_at`) VALUES
(2, '54a57f869ca72cdd959e331410a9ba42_1636889202.png', 'Rakesh Sahu', NULL, 'Faucibus tristique felis potenti ultrices ornare rhoncus semper hac facilisi Rutrum tellus lorem sem velit nisi non pharetra in dui.', '2021-11-24 10:06:13', '2019-09-12 07:02:30'),
(3, '54a57f869ca72cdd959e331410a9ba42_1636889202.png', 'Jayson', 'Excutive Director', 'Faucibus tristique felis potenti ultrices ornare rhoncus semper hac facilisi Rutrum tellus lorem sem velit nisi non pharetra in dui.', '2021-11-24 10:06:13', '2019-09-12 07:02:30'),
(4, '54a57f869ca72cdd959e331410a9ba42_1636889216.png', 'Priyanka', NULL, 'Faucibus tristique felis potenti ultrices ornare rhoncus semper hac facilisi Rutrum tellus lorem sem velit nisi non pharetra in dui.', '2021-11-24 10:06:13', '2021-11-14 11:26:42');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

DROP TABLE IF EXISTS `units`;
CREATE TABLE `units` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT '0' COMMENT '1=Deleted',
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `is_deleted`, `updated_at`, `created_at`) VALUES
(1, 'Gm', 0, NULL, '2019-11-26 17:23:48'),
(2, 'Kg', 0, NULL, '2019-11-26 17:23:48'),
(3, 'Item', 0, NULL, '2019-11-26 17:24:03'),
(4, 'Piece', 0, NULL, '2019-11-26 17:24:03'),
(5, 'Set', 0, NULL, '2019-11-26 17:24:23'),
(6, 'Bottles', 0, NULL, '2019-11-26 17:24:23'),
(7, 'Cartoons', 0, NULL, '2019-11-26 17:24:31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `status` int(11) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `gender`, `email`, `email_verified_at`, `password`, `mobile`, `address`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'Super Admin', 'Male', 'divllo@gmail.com', NULL, '$2y$10$jV8scZTAi7OcZyhc2ZPBnuimt2M.WUAUdC/MLNFerhZhfZkQhSRG6', '9038000818', NULL, 1, NULL, NULL, '2021-12-19 12:43:25'),
(2, 2, 'Admin', 'Male', 'admin@gmail.com', NULL, '$2y$10$yb8Bsf15kZfPgyR.NpFAy.Dr.6nBh99lLcCjBINooWEdu9.2boQYC', '9001456808', 'H.No.439 Rani Bazar', 1, NULL, '2019-09-07 03:53:13', '2019-09-07 09:41:18'),
(3, 3, 'Receptionist', 'Male', 'receptionist@gmail.com', NULL, '$2y$10$6F7Oyw9K/ZPT8r.X8ll4xOqZXrKpJL1kz4IABIJ0OGHgrCvMFhG0a', '1234567890', 'HNo 56', 1, NULL, '2019-09-07 09:42:29', '2021-03-11 03:02:17'),
(4, 2, 'Store Manager', 'Male', 'sales@connexionsweb.com', NULL, '$2y$10$vkAjTzGoqzVX0QD4I85qeur5UwoOilLzk64STBaGx40sD9Z0J6Tuq', '9038000818', 'N-186B, Mudialy First lane. PO - Garden Reach', 1, NULL, '2021-03-11 05:01:15', '2021-03-11 05:01:15'),
(5, 6, 'Bheem Swami', NULL, 'bheem@gmail.com', NULL, '$2y$10$TWbnFXsuZ9XKVL5jHEycwO6gJPUAU.knwwD3ZdPrrYCm.MEiDaYmO', '9001456808', 'H.No.439, Near simla cold store, sharma colony, Rani Bazar', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_emails`
--

DROP TABLE IF EXISTS `user_emails`;
CREATE TABLE `user_emails` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip_addr` varchar(255) DEFAULT NULL,
  `verified` int(11) NOT NULL DEFAULT '0',
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_emails`
--

INSERT INTO `user_emails` (`id`, `email`, `ip_addr`, `verified`, `updated_at`, `created_at`) VALUES
(1, 'vinj@mailinator.com', '::1', 0, NULL, '2021-11-19 06:33:37'),
(2, 'cyanitytechnologies@gmail.com', '::1', 0, NULL, '2021-11-19 06:34:32');

-- --------------------------------------------------------

--
-- Table structure for table `user_logs`
--

DROP TABLE IF EXISTS `user_logs`;
CREATE TABLE `user_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uri` varchar(255) DEFAULT NULL,
  `action_as` varchar(255) DEFAULT NULL,
  `controller` varchar(255) DEFAULT NULL,
  `method` varchar(255) DEFAULT NULL,
  `counts` int(11) NOT NULL DEFAULT '1',
  `json_data` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `log_type` varchar(200) DEFAULT NULL,
  `log_date` date DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_logs`
--

INSERT INTO `user_logs` (`id`, `user_id`, `title`, `uri`, `action_as`, `controller`, `method`, `counts`, `json_data`, `log_type`, `log_date`, `updated_at`, `created_at`) VALUES
(1, 1, NULL, 'admin/dashboard', 'dashboard', 'App\\Http\\Controllers\\AdminController@index', 'GET', 3, NULL, NULL, '2021-12-28', '2021-12-28 14:56:35', '2021-12-28 08:59:53'),
(2, 1, NULL, 'admin/settings', 'settings', 'App\\Http\\Controllers\\AdminController@settingsForm', 'GET', 3, NULL, NULL, '2021-12-28', '2021-12-28 14:57:13', '2021-12-28 08:59:59'),
(3, 1, NULL, 'admin/save-settings', 'save-settings', 'App\\Http\\Controllers\\AdminController@saveSettings', 'POST', 1, '{\"_token\":\"a0inkYAZ7ALozyF8HGBzOQ7zNQbUMSJnFp0O6GfD\",\"site_page_title\":\"divllo Hotel & Resort\",\"site_language\":\"en\",\"hotel_name\":\"divllo Hotel & Resort\",\"hotel_tagline\":\"divllo Resort\",\"hotel_email\":\"divllo@gmail.com\",\"hotel_phone\":\"1234567890\",\"hotel_mobile\":\"9087654321\",\"hotel_website\":\"https:\\/\\/divllo.com\\/\",\"hotel_address\":\"Colony Road, near Bikash Bharati High School.Jangal Khas.\",\"gst_num\":\"19ABQFA0476P1ZO\",\"gst\":\"6\",\"cgst\":\"6\",\"food_gst\":\"2.5\",\"food_cgst\":\"2.5\",\"currency\":\"INR\",\"currency_symbol\":\"\\u20b9\",\"default_nationality\":\"81\",\"default_country\":\"India\",\"default_rec_days\":\"15\",\"site_logo_height\":\"100\",\"site_logo_width\":\"100\",\"bank_name\":\"Punjab National Bank\",\"bank_ifsc_code\":\"PUNB0018020\",\"bank_acc_name\":\"Aranyak Resort\",\"bank_acc_num\":\"0180050163637\",\"bank_branch\":\"Midnapore\",\"invoice_term_condition\":\"<h1 style=\\\"font-size: 13px; color: rgb(0, 0, 0); font-family: \\\" times=\\\"\\\" new=\\\"\\\" roman\\\";=\\\"\\\" font-weight:=\\\"\\\" bold=\\\"\\\" !important;\\\"=\\\"\\\">Terms and Conditions<\\/h1><h1 style=\\\"font-size: 13px; color: rgb(0, 0, 0); font-family: \\\" times=\\\"\\\" new=\\\"\\\" roman\\\";=\\\"\\\" font-weight:=\\\"\\\" bold=\\\"\\\" !important;\\\"=\\\"\\\">General Site Usage<\\/h1><p style=\\\"font-family: \\\" times=\\\"\\\" new=\\\"\\\" roman\\\";=\\\"\\\" font-size:=\\\"\\\" medium;\\\"=\\\"\\\">Last Revised: january 16, 2021.<\\/p><p style=\\\"font-family: \\\" times=\\\"\\\" new=\\\"\\\" roman\\\";=\\\"\\\" font-size:=\\\"\\\" medium;\\\"=\\\"\\\">Welcome to www.lorem-ipsum.info. This site is provided as a service to our visitors and may be used for informational purposes only. Because the Terms and Conditions contain legal obligations, please read them carefully.<\\/p><h2 style=\\\"font-size: 13px; color: rgb(0, 0, 0); font-family: \\\" times=\\\"\\\" new=\\\"\\\" roman\\\";=\\\"\\\" font-weight:=\\\"\\\" bold=\\\"\\\" !important;\\\"=\\\"\\\">1. YOUR AGREEMENT<\\/h2><p style=\\\"font-family: \\\" times=\\\"\\\" new=\\\"\\\" roman\\\";=\\\"\\\" font-size:=\\\"\\\" medium;\\\"=\\\"\\\">By using this Site, you agree to be bound by, and to comply with, these Terms and Conditions. If you do not agree to these Terms and Conditions, please do not use this site.<\\/p><blockquote style=\\\"font-family: \\\" times=\\\"\\\" new=\\\"\\\" roman\\\";=\\\"\\\" font-size:=\\\"\\\" medium;\\\"=\\\"\\\">PLEASE NOTE: We reserve the right, at our sole discretion, to change, modify or otherwise alter these Terms and Conditions at any time. Unless otherwise indicated, amendments will become effective immediately. Please review these Terms and Conditions periodically. Your continued use of the Site following the posting of changes and\\/or modifications will constitute your acceptance of the revised Terms and Conditions and the reasonableness of these standards for notice of changes. For your information, this page was last updated as of the date at the top of these terms and conditions.<\\/blockquote><h2 style=\\\"font-size: 13px; color: rgb(0, 0, 0); font-family: \\\" times=\\\"\\\" new=\\\"\\\" roman\\\";=\\\"\\\" font-weight:=\\\"\\\" bold=\\\"\\\" !important;\\\"=\\\"\\\">2. PRIVACY<\\/h2><p style=\\\"font-family: \\\" times=\\\"\\\" new=\\\"\\\" roman\\\";=\\\"\\\" font-size:=\\\"\\\" medium;\\\"=\\\"\\\">Please review our Privacy Policy, which also governs your visit to this Site, to understand our practices.<\\/p><h2 style=\\\"font-size: 13px; color: rgb(0, 0, 0); font-family: \\\" times=\\\"\\\" new=\\\"\\\" roman\\\";=\\\"\\\" font-weight:=\\\"\\\" bold=\\\"\\\" !important;\\\"=\\\"\\\">3. LINKED SITES<\\/h2><p style=\\\"font-family: \\\" times=\\\"\\\" new=\\\"\\\" roman\\\";=\\\"\\\" font-size:=\\\"\\\" medium;\\\"=\\\"\\\">This Site may contain links to other independent third-party Web sites (\\\"Linked Sites\\u201d). These Linked Sites are provided solely as a convenience to our visitors. Such Linked Sites are not under our control, and we are not responsible for and does not endorse the content of such Linked Sites, including any information or materials contained on such Linked Sites. You will need to make your own independent judgment regarding your interaction with these Linked Sites.<\\/p><h2 style=\\\"font-size: 13px; color: rgb(0, 0, 0); font-family: \\\" times=\\\"\\\" new=\\\"\\\" roman\\\";=\\\"\\\" font-weight:=\\\"\\\" bold=\\\"\\\" !important;\\\"=\\\"\\\">4. FORWARD LOOKING STATEMENTS<\\/h2><p style=\\\"font-family: \\\" times=\\\"\\\" new=\\\"\\\" roman\\\";=\\\"\\\" font-size:=\\\"\\\" medium;\\\"=\\\"\\\">All materials reproduced on this site speak as of the original date of publication or filing. The fact that a document is available on this site does not mean that the information contained in such document has not been modified or superseded by events or by a subsequent document or filing. We have no duty or policy to update any information or statements contained on this site and, therefore, such information or statements should not be relied upon as being current as of the date you access this site.<\\/p><h2 style=\\\"font-size: 13px; color: rgb(0, 0, 0); font-family: \\\" times=\\\"\\\" new=\\\"\\\" roman\\\";=\\\"\\\" font-weight:=\\\"\\\" bold=\\\"\\\" !important;\\\"=\\\"\\\">5. DISCLAIMER OF WARRANTIES AND LIMITATION OF LIABILITY<\\/h2><p style=\\\"font-family: \\\" times=\\\"\\\" new=\\\"\\\" roman\\\";=\\\"\\\" font-size:=\\\"\\\" medium;\\\"=\\\"\\\">A. THIS SITE MAY CONTAIN INACCURACIES AND TYPOGRAPHICAL ERRORS. WE DOES NOT WARRANT THE ACCURACY OR COMPLETENESS OF THE MATERIALS OR THE RELIABILITY OF ANY ADVICE, OPINION, STATEMENT OR OTHER INFORMATION DISPLAYED OR DISTRIBUTED THROUGH THE SITE. YOU EXPRESSLY UNDERSTAND AND AGREE THAT: (i) YOUR USE OF THE SITE, INCLUDING ANY RELIANCE ON ANY SUCH OPINION, ADVICE, STATEMENT, MEMORANDUM, OR INFORMATION CONTAINED HEREIN, SHALL BE AT YOUR SOLE RISK; (ii) THE SITE IS PROVIDED ON AN \\\"AS IS\\\" AND \\\"AS AVAILABLE\\\" BASIS; (iii) EXCEPT AS EXPRESSLY PROVIDED HEREIN WE DISCLAIM ALL WARRANTIES OF ANY KIND, WHETHER EXPRESS OR IMPLIED, INCLUDING, BUT NOT LIMITED TO IMPLIED WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, WORKMANLIKE EFFORT, TITLE AND NON-INFRINGEMENT; (iv) WE MAKE NO WARRANTY WITH RESPECT TO THE RESULTS THAT MAY BE OBTAINED FROM THIS SITE, THE PRODUCTS OR SERVICES ADVERTISED OR OFFERED OR MERCHANTS INVOLVED; (v) ANY MATERIAL DOWNLOADED OR OTHERWISE OBTAINED THROUGH THE USE OF THE SITE IS DONE AT YOUR OWN DISCRETION AND RISK; and (vi) YOU WILL BE SOLELY RESPONSIBLE FOR ANY DAMAGE TO YOUR COMPUTER SYSTEM OR FOR ANY LOSS OF DATA THAT RESULTS FROM THE DOWNLOAD OF ANY SUCH MATERIAL.<\\/p><p style=\\\"font-family: \\\" times=\\\"\\\" new=\\\"\\\" roman\\\";=\\\"\\\" font-size:=\\\"\\\" medium;\\\"=\\\"\\\">B. YOU UNDERSTAND AND AGREE THAT UNDER NO CIRCUMSTANCES, INCLUDING, BUT NOT LIMITED TO, NEGLIGENCE, SHALL WE BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, PUNITIVE OR CONSEQUENTIAL DAMAGES THAT RESULT FROM THE USE OF, OR THE INABILITY TO USE, ANY OF OUR SITES OR MATERIALS OR FUNCTIONS ON ANY SUCH SITE, EVEN IF WE HAVE BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES. THE FOREGOING LIMITATIONS SHALL APPLY NOTWITHSTANDING ANY FAILURE OF ESSENTIAL PURPOSE OF ANY LIMITED REMEDY.<\\/p><h2 style=\\\"font-size: 13px; color: rgb(0, 0, 0); font-family: \\\" times=\\\"\\\" new=\\\"\\\" roman\\\";=\\\"\\\" font-weight:=\\\"\\\" bold=\\\"\\\" !important;\\\"=\\\"\\\">6. EXCLUSIONS AND LIMITATIONS<\\/h2><p style=\\\"font-family: \\\" times=\\\"\\\" new=\\\"\\\" roman\\\";=\\\"\\\" font-size:=\\\"\\\" medium;\\\"=\\\"\\\">SOME JURISDICTIONS DO NOT ALLOW THE EXCLUSION OF CERTAIN WARRANTIES OR THE LIMITATION OR EXCLUSION OF LIABILITY FOR INCIDENTAL OR CONSEQUENTIAL DAMAGES. ACCORDINGLY, OUR LIABILITY IN SUCH JURISDICTION SHALL BE LIMITED TO THE MAXIMUM EXTENT PERMITTED BY LAW.<\\/p><h2 style=\\\"font-size: 13px; color: rgb(0, 0, 0); font-family: \\\" times=\\\"\\\" new=\\\"\\\" roman\\\";=\\\"\\\" font-weight:=\\\"\\\" bold=\\\"\\\" !important;\\\"=\\\"\\\">7. OUR PROPRIETARY RIGHTS<\\/h2><p style=\\\"font-family: \\\" times=\\\"\\\" new=\\\"\\\" roman\\\";=\\\"\\\" font-size:=\\\"\\\" medium;\\\"=\\\"\\\">This Site and all its Contents are intended solely for personal, non-commercial use. Except as expressly provided, nothing within the Site shall be construed as conferring any license under our or any third party\'s intellectual property rights, whether by estoppel, implication, waiver, or otherwise. Without limiting the generality of the foregoing, you acknowledge and agree that all content available through and used to operate the Site and its services is protected by copyright, trademark, patent, or other proprietary rights. You agree not to: (a) modify, alter, or deface any of the trademarks, service marks, trade dress (collectively \\\"Trademarks\\\") or other intellectual property made available by us in connection with the Site; (b) hold yourself out as in any way sponsored by, affiliated with, or endorsed by us, or any of our affiliates or service providers; (c) use any of the Trademarks or other content accessible through the Site for any purpose other than the purpose for which we have made it available to you; (d) defame or disparage us, our Trademarks, or any aspect of the Site; and (e) adapt, translate, modify, decompile, disassemble, or reverse engineer the Site or any software or programs used in connection with it or its products and services.<\\/p><p style=\\\"font-family: \\\" times=\\\"\\\" new=\\\"\\\" roman\\\";=\\\"\\\" font-size:=\\\"\\\" medium;\\\"=\\\"\\\">The framing, mirroring, scraping or data mining of the Site or any of its content in any form and by any method is expressly prohibited.<\\/p><h2 style=\\\"font-size: 13px; color: rgb(0, 0, 0); font-family: \\\" times=\\\"\\\" new=\\\"\\\" roman\\\";=\\\"\\\" font-weight:=\\\"\\\" bold=\\\"\\\" !important;\\\"=\\\"\\\">8. INDEMNITY<\\/h2><p style=\\\"font-family: \\\" times=\\\"\\\" new=\\\"\\\" roman\\\";=\\\"\\\" font-size:=\\\"\\\" medium;\\\"=\\\"\\\">By using the Site web sites you agree to indemnify us and affiliated entities (collectively \\\"Indemnities\\\") and hold them harmless from any and all claims and expenses, including (without limitation) attorney\'s fees, arising from your use of the Site web sites, your use of the Products and Services, or your submission of ideas and\\/or related materials to us or from any person\'s use of any ID, membership or password you maintain with any portion of the Site, regardless of whether such use is authorized by you.<\\/p><h2 style=\\\"font-size: 13px; color: rgb(0, 0, 0); font-family: \\\" times=\\\"\\\" new=\\\"\\\" roman\\\";=\\\"\\\" font-weight:=\\\"\\\" bold=\\\"\\\" !important;\\\"=\\\"\\\">9. COPYRIGHT AND TRADEMARK NOTICE<\\/h2><p style=\\\"font-family: \\\" times=\\\"\\\" new=\\\"\\\" roman\\\";=\\\"\\\" font-size:=\\\"\\\" medium;\\\"=\\\"\\\">Except our generated dummy copy, which is free to use for private and commercial use, all other text is copyrighted. generator.lorem-ipsum.info \\u00a9 2013, all rights reserved<\\/p><h2 style=\\\"font-size: 13px; color: rgb(0, 0, 0); font-family: \\\" times=\\\"\\\" new=\\\"\\\" roman\\\";=\\\"\\\" font-weight:=\\\"\\\" bold=\\\"\\\" !important;\\\"=\\\"\\\">10. INTELLECTUAL PROPERTY INFRINGEMENT CLAIMS<\\/h2><p style=\\\"font-family: \\\" times=\\\"\\\" new=\\\"\\\" roman\\\";=\\\"\\\" font-size:=\\\"\\\" medium;\\\"=\\\"\\\">It is our policy to respond expeditiously to claims of intellectual property infringement. We will promptly process and investigate notices of alleged infringement and will take appropriate actions under the Digital Millennium Copyright Act (\\\"DMCA\\\") and other applicable intellectual property laws. Notices of claimed infringement should be directed to:<\\/p><p style=\\\"font-family: \\\" times=\\\"\\\" new=\\\"\\\" roman\\\";=\\\"\\\" font-size:=\\\"\\\" medium;\\\"=\\\"\\\">generator.lorem-ipsum.info<\\/p><p style=\\\"font-family: \\\" times=\\\"\\\" new=\\\"\\\" roman\\\";=\\\"\\\" font-size:=\\\"\\\" medium;\\\"=\\\"\\\">126 Electricov St.<\\/p><p style=\\\"font-family: \\\" times=\\\"\\\" new=\\\"\\\" roman\\\";=\\\"\\\" font-size:=\\\"\\\" medium;\\\"=\\\"\\\">Kiev, Kiev 04176<\\/p><p style=\\\"font-family: \\\" times=\\\"\\\" new=\\\"\\\" roman\\\";=\\\"\\\" font-size:=\\\"\\\" medium;\\\"=\\\"\\\">Ukraine<\\/p><p style=\\\"font-family: \\\" times=\\\"\\\" new=\\\"\\\" roman\\\";=\\\"\\\" font-size:=\\\"\\\" medium;\\\"=\\\"\\\">contact@lorem-ipsum.info<\\/p><h2 style=\\\"font-size: 13px; color: rgb(0, 0, 0); font-family: \\\" times=\\\"\\\" new=\\\"\\\" roman\\\";=\\\"\\\" font-weight:=\\\"\\\" bold=\\\"\\\" !important;\\\"=\\\"\\\">11. PLACE OF PERFORMANCE<\\/h2><p style=\\\"font-family: \\\" times=\\\"\\\" new=\\\"\\\" roman\\\";=\\\"\\\" font-size:=\\\"\\\" medium;\\\"=\\\"\\\">This Site is controlled, operated and administered by us from our office in Kiev, Ukraine. We make no representation that materials at this site are appropriate or available for use at other locations outside of the Ukraine and access to them from territories where their contents are illegal is prohibited. If you access this Site from a location outside of the Ukraine, you are responsible for compliance with all local laws.<\\/p><h2 style=\\\"font-size: 13px; color: rgb(0, 0, 0); font-family: \\\" times=\\\"\\\" new=\\\"\\\" roman\\\";=\\\"\\\" font-weight:=\\\"\\\" bold=\\\"\\\" !important;\\\"=\\\"\\\">12. GENERAL<\\/h2><p style=\\\"font-family: \\\" times=\\\"\\\" new=\\\"\\\" roman\\\";=\\\"\\\" font-size:=\\\"\\\" medium;\\\"=\\\"\\\">A. If any provision of these Terms and Conditions is held to be invalid or unenforceable, the provision shall be removed (or interpreted, if possible, in a manner as to be enforceable), and the remaining provisions shall be enforced. Headings are for reference purposes only and in no way define, limit, construe or describe the scope or extent of such section. Our failure to act with respect to a breach by you or others does not waive our right to act with respect to subsequent or similar breaches. These Terms and Conditions set forth the entire understanding and agreement between us with respect to the subject matter contained herein and supersede any other agreement, proposals and communications, written or oral, between our representatives and you with respect to the subject matter hereof, including any terms and conditions on any of customer\'s documents or purchase orders.<\\/p><p style=\\\"font-family: \\\" times=\\\"\\\" new=\\\"\\\" roman\\\";=\\\"\\\" font-size:=\\\"\\\" medium;\\\"=\\\"\\\">B. No Joint Venture, No Derogation of Rights. You agree that no joint venture, partnership, employment, or agency relationship exists between you and us as a result of these Terms and Conditions or your use of the Site. Our performance of these Terms and Conditions is subject to existing laws and legal process, and nothing contained herein is in derogation of our right to comply with governmental, court and law enforcement requests or requirements relating to your use of the Site or information provided to or gathered by us with respect to such use.<\\/p>\",\"site_logo\":{}}', NULL, '2021-12-28', '2021-12-28 14:30:30', '2021-12-28 09:00:30'),
(4, 1, NULL, 'admin/permissions-list', 'permissions-list', 'App\\Http\\Controllers\\AdminController@listPermission', 'GET', 1, NULL, NULL, '2021-12-28', '2021-12-28 14:56:40', '2021-12-28 09:26:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aboutus_sections`
--
ALTER TABLE `aboutus_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `alert_templates`
--
ALTER TABLE `alert_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `amenities`
--
ALTER TABLE `amenities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booked_rooms`
--
ALTER TABLE `booked_rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contactus_sections`
--
ALTER TABLE `contactus_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `countries` ADD FULLTEXT KEY `IndexName` (`name`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dynamic_dropdowns`
--
ALTER TABLE `dynamic_dropdowns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enquiries`
--
ALTER TABLE `enquiries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_categories`
--
ALTER TABLE `expense_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_categories`
--
ALTER TABLE `food_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_items`
--
ALTER TABLE `food_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_sections`
--
ALTER TABLE `home_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media_files`
--
ALTER TABLE `media_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_histories`
--
ALTER TABLE `order_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_history`
--
ALTER TABLE `payment_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `person_lists`
--
ALTER TABLE `person_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_carts`
--
ALTER TABLE `room_carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_types`
--
ALTER TABLE `room_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_history`
--
ALTER TABLE `stock_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_emails`
--
ALTER TABLE `user_emails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aboutus_sections`
--
ALTER TABLE `aboutus_sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `amenities`
--
ALTER TABLE `amenities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `booked_rooms`
--
ALTER TABLE `booked_rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contactus_sections`
--
ALTER TABLE `contactus_sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=262;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dynamic_dropdowns`
--
ALTER TABLE `dynamic_dropdowns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `enquiries`
--
ALTER TABLE `enquiries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expense_categories`
--
ALTER TABLE `expense_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `food_categories`
--
ALTER TABLE `food_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `food_items`
--
ALTER TABLE `food_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `home_sections`
--
ALTER TABLE `home_sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media_files`
--
ALTER TABLE `media_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_histories`
--
ALTER TABLE `order_histories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_history`
--
ALTER TABLE `payment_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `person_lists`
--
ALTER TABLE `person_lists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `room_carts`
--
ALTER TABLE `room_carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room_types`
--
ALTER TABLE `room_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `stock_history`
--
ALTER TABLE `stock_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_emails`
--
ALTER TABLE `user_emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_logs`
--
ALTER TABLE `user_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
