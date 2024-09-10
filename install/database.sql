-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2023 at 09:26 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `viserlab_viserhotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `role_id`, `name`, `email`, `username`, `email_verified_at`, `image`, `password`, `remember_token`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, 'Super Admin', 'admin@site.com', 'admin', NULL, '63d4cecdc7d5f1674890957.jpeg', '$2y$10$wlY66NfdpeZeGeVdDr8A4uQ8P5rYbmp5qPD4KevbCHYB324d53bTS', 'SMlw5KCSM1YtYXhesZFmTRlWGTb15FuBhje2tzjnUSDWOXfFr5hgbSpZ41so', 1, NULL, '2023-01-28 07:29:18');

-- --------------------------------------------------------

--
-- Table structure for table `admin_notifications`
--

CREATE TABLE `admin_notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `click_url` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_password_resets`
--

CREATE TABLE `admin_password_resets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `amenities`
--

CREATE TABLE `amenities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bed_types`
--

CREATE TABLE `bed_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `booked_rooms`
--

CREATE TABLE `booked_rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `room_type_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `room_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `booked_for` date DEFAULT NULL,
  `fare` decimal(28,8) DEFAULT NULL,
  `tax_charge` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `cancellation_fee` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '1= success/active; 3 = cancelled; 9 = checked Out',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `booking_number` varchar(40) DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `check_in` date DEFAULT NULL,
  `check_out` date DEFAULT NULL,
  `guest_details` text DEFAULT NULL,
  `tax_charge` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `booking_fare` decimal(28,8) NOT NULL DEFAULT 0.00000000 COMMENT 'Total of room * nights fare ',
  `service_cost` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `extra_charge` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `extra_charge_subtracted` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `paid_amount` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `cancellation_fee` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `refunded_amount` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `key_status` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '1= success/active; 3 = cancelled; 9 = checked Out',
  `checked_in_at` datetime DEFAULT NULL,
  `checked_out_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `booking_action_histories`
--

CREATE TABLE `booking_action_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `remark` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `booking_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `admin_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `booking_requests`
--

CREATE TABLE `booking_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `number_of_rooms` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `room_type_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `unit_fare` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `check_in` date DEFAULT NULL,
  `check_out` date DEFAULT NULL,
  `tax_charge` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `total_amount` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 = pending,\r\n1 = approved,\r\n3 = cancelled; ',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `complements`
--

CREATE TABLE `complements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

CREATE TABLE `deposits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `booking_id` int(10) DEFAULT 0,
  `admin_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `method_code` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `amount` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `method_currency` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `charge` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `rate` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `final_amo` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `detail` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `btc_amo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `btc_wallet` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trx` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_try` int(10) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1=>success, 2=>pending, 3=>cancel',
  `from_api` tinyint(1) NOT NULL DEFAULT 0,
  `admin_feedback` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `extensions`
--

CREATE TABLE `extensions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `act` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `script` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shortcode` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'object',
  `support` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'help section',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=>enable, 2=>disable',
  `deleted_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `extensions`
--

INSERT INTO `extensions` (`id`, `act`, `name`, `description`, `image`, `script`, `shortcode`, `support`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'tawk-chat', 'Tawk.to', 'Key location is shown bellow', 'tawky_big.png', '<script>\r\n                        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();\r\n                        (function(){\r\n                        var s1=document.createElement(\"script\"),s0=document.getElementsByTagName(\"script\")[0];\r\n                        s1.async=true;\r\n                        s1.src=\"https://embed.tawk.to/{{app_key}}\";\r\n                        s1.charset=\"UTF-8\";\r\n                        s1.setAttribute(\"crossorigin\",\"*\");\r\n                        s0.parentNode.insertBefore(s1,s0);\r\n                        })();\r\n                    </script>', '{\"app_key\":{\"title\":\"App Key\",\"value\":\"------\"}}', 'twak.png', 0, NULL, '2019-10-18 17:16:05', '2022-03-21 23:22:24'),
(2, 'google-recaptcha2', 'Google Recaptcha 2', 'Key location is shown bellow', 'recaptcha3.png', '\n<script src=\"https://www.google.com/recaptcha/api.js\"></script>\n<div class=\"g-recaptcha\" data-sitekey=\"{{site_key}}\" data-callback=\"verifyCaptcha\"></div>\n<div id=\"g-recaptcha-error\"></div>', '{\"site_key\":{\"title\":\"Site Key\",\"value\":\"6LdPC88fAAAAADQlUf_DV6Hrvgm-pZuLJFSLDOWV\"},\"secret_key\":{\"title\":\"Secret Key\",\"value\":\"6LdPC88fAAAAAG5SVaRYDnV2NpCrptLg2XLYKRKB\"}}', 'recaptcha.png', 0, NULL, '2019-10-18 17:16:05', '2023-06-01 07:23:34'),
(3, 'custom-captcha', 'Custom Captcha', 'Just put any random string', 'customcaptcha.png', NULL, '{\"random_key\":{\"title\":\"Random String\",\"value\":\"SecureString\"}}', 'na', 0, NULL, '2019-10-18 17:16:05', '2022-10-12 23:02:43'),
(4, 'google-analytics', 'Google Analytics', 'Key location is shown bellow', 'google_analytics.png', '<script async src=\"https://www.googletagmanager.com/gtag/js?id={{app_key}}\"></script>\r\n                <script>\r\n                  window.dataLayer = window.dataLayer || [];\r\n                  function gtag(){dataLayer.push(arguments);}\r\n                  gtag(\"js\", new Date());\r\n                \r\n                  gtag(\"config\", \"{{app_key}}\");\r\n                </script>', '{\"app_key\":{\"title\":\"App Key\",\"value\":\"------\"}}', 'ganalytics.png', 0, NULL, NULL, '2021-05-04 04:19:12'),
(5, 'fb-comment', 'Facebook Comment ', 'Key location is shown bellow', 'Facebook.png', '<div id=\"fb-root\"></div><script async defer crossorigin=\"anonymous\" src=\"https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v4.0&appId={{app_key}}&autoLogAppEvents=1\"></script>', '{\"app_key\":{\"title\":\"App Key\",\"value\":\"----\"}}', 'fb_com.PNG', 0, NULL, NULL, '2022-03-21 23:18:36');

-- --------------------------------------------------------

--
-- Table structure for table `extra_services`
--

CREATE TABLE `extra_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cost` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE `forms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `act` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `form_data` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `frontends`
--

CREATE TABLE `frontends` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `data_keys` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data_values` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `frontends`
--

INSERT INTO `frontends` (`id`, `data_keys`, `data_values`, `created_at`, `updated_at`) VALUES
(1, 'seo.data', '{\"seo_image\":\"1\",\"keywords\":[\"hotel\",\"booking\",\"room booking\",\"reservation\",\"room reservation\",\"hotel booking\",\"night\",\"day\",\"premium\",\"royal\"],\"description\":\"ViserHotel - Ultimate hotel booking solution.\",\"social_title\":\"Viserlab Limited\",\"social_description\":\"ViserHotel - Ultimate hotel booking solution.\",\"image\":\"62c440e26b46d1657028834.png\"}', '2020-07-04 23:42:52', '2023-02-07 05:47:47'),
(24, 'about.content', '{\"has_image\":\"1\",\"heading\":\"Welcome and Relax at Our Hotel\",\"subheading\":\"Maecenas nec odio et ante tincidunt tempus. Donec vitae apitlibero venenatis faucibus. Nullam quis ante. Etiam sit amet orci\",\"description\":\"posuere ut, mauris. Praesent adipiscing. Phasellus ullamcorper ipsum rutrum nuncnc nonummy metus. Vestibulum volutpat pretium libero. Cras id dui. Aenean ueros nisl sagittis vestibulum. Nullam nulla eros, ultricies sit amet nonummy id, imperdiet ugiat pede. Sed lectus. Donec mollis hendrerit risus. Phasellus nec sem in justo plentesque facilisis. Etiam imperdiet imperdiet orci.\\u00a0<div><br \\/><\\/div><div>Nunc nec neque.\\r\\nposuere ut, mauris. Praesent adipiscing. Phasellus ullamcorper ipsum rutrum nuncnc nonummy metus. Vestibulum volutpat pretium libero. Cras id dui. Aenean ueros nisl sagittis ve\\r\\n\\r\\nposuere ut, mauris. Praesent adipiscing. Phasellus ullamcorper ipsum rutrum nuncnc nonummy metus. Vestibulum volutpat pretium libero. Cras id dui. Aenean ueros nisl sagittis vestibulum. Nullam nulla eros, ultricies sit amet nonummy id, imperdiet ugiat pede. Sed lectus. Donec mollis hendrerit risus. Phasellus nec sem in justo plentesque facilisis. Etiam imperdiet imperdiet orci. Nunc nec neque.<\\/div>\",\"image_1\":\"6296091c727e21653999900.jpg\",\"image_2\":\"6296091d240461653999901.jpg\",\"image_3\":\"6296091d9fd3c1653999901.jpg\",\"image_4\":\"6296091e478d11653999902.jpg\"}', '2020-10-28 00:51:20', '2022-06-07 11:55:54'),
(25, 'blog.content', '{\"heading\":\"Latest Blog Post\",\"subheading\":\"Maecenas nec odio et ante tincidunt tempus. Donec vitae apitlibero venenatis faucibus. Nullam quis ante. Etiam sit amet orci\"}', '2020-10-28 00:51:34', '2022-04-05 14:00:44'),
(26, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Retailers are hopping to see a rise in demand\",\"description\":\"<h3 style=\\\"margin-top:1.5rem;margin-bottom:1rem;font-weight:600;line-height:1.15;color:rgb(0,42,71);\\\">Curabitur a felis in nunc fringilla tristique abot escrow.<\\/h3><div class=\\\"mt-4 contact-section__content-text\\\" style=\\\"color:rgb(0,42,71);font-family:Roboto, sans-serif;\\\"><p class=\\\"mt-4 contact-section__content-text\\\" style=\\\"margin-bottom:1.5rem;color:rgb(0,42,71);font-size:16px;\\\">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In dui maosuere eget, vestibulum et, tempor auctor, justo. In ac felis quis tortor malesuada pretium. Pellentesque auctor neque nec urna. Proin sapien ipsum, porta a, auctor quis, euismod ut, mi. Aenean viverra rhoncus pede. fringilla tstique. Morbi mattis ullamcorper velit. Phasellus gravida semper nisi. Nullam vel sem.<\\/p><p class=\\\"contact-section__content-text\\\" style=\\\"margin-bottom:1.5rem;color:rgb(0,42,71);font-size:16px;\\\">Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,<\\/p><h4 style=\\\"margin-top:1.5rem;margin-bottom:1rem;font-weight:600;line-height:1.15;color:rgb(0,42,71);\\\">Maecenas Dempuget condimentum rhoncus<\\/h4><p class=\\\"contact-section__content-text\\\" style=\\\"margin-bottom:1.5rem;color:rgb(0,42,71);font-size:16px;\\\">Dorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,<\\/p><p class=\\\"contact-section__content-text\\\" style=\\\"margin-bottom:1.5rem;color:rgb(0,42,71);font-size:16px;\\\">Dorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc.<\\/p><\\/div>\",\"image\":\"624ad622adcf51649071650.jpg\"}', '2020-10-28 00:57:19', '2022-06-21 12:09:51'),
(27, 'contact_us.content', '{\"has_image\":\"1\",\"title\":\"Get In Touch With Us\",\"short_details\":\"Maecenas nec odio et ante tincidunt tempus. Donec vitae apitlibero venenatis.\",\"email_address\":\"viserhotel@gmail.com\",\"contact_number\":\"123 - 4567890\",\"latitude\":\"5555h\",\"longitude\":\"5555s\",\"address\":\"15205 North Kierland Blvd.\",\"image\":\"62887f5e94d901653112670.jpg\"}', '2020-10-28 00:59:19', '2022-07-04 08:57:13'),
(28, 'counter.content', '{\"heading\":\"Latest News\",\"sub_heading\":\"Register New Account\"}', '2020-10-28 01:04:02', '2020-10-28 01:04:02'),
(31, 'social_icon.element', '{\"title\":\"Facebook\",\"social_icon\":\"<i class=\\\"fab fa-facebook-f\\\"><\\/i>\",\"url\":\"https:\\/\\/www.google.com\\/\"}', '2020-11-12 04:07:30', '2022-04-04 06:44:59'),
(33, 'feature.content', '{\"heading\":\"asdf\",\"sub_heading\":\"asdf\"}', '2021-01-03 23:40:54', '2021-01-03 23:40:55'),
(34, 'feature.element', '{\"title\":\"asdf\",\"description\":\"asdf\",\"feature_icon\":\"asdf\"}', '2021-01-03 23:41:02', '2021-01-03 23:41:02'),
(36, 'service.content', '{\"heading\":\"Our Hotel services\",\"subheading\":\"Maecenas nec odio et ante tincidunt tempus. Donec vitae apitlibero venenatis faucibus. Nullam quis ante. Etiam sit amet orci\",\"video_url\":\"https:\\/\\/www.youtube.com\\/embed\\/WOb4cj7izpE\",\"has_image\":\"1\",\"video_thumb\":\"624c4b87d5ee01649167239.jpg\"}', '2021-03-06 01:27:34', '2022-05-21 06:12:24'),
(39, 'banner.content', '{\"heading\":\"SPEND YOUR BEAUTIFUL MOMENT\",\"has_image\":\"1\",\"banner_image\":\"6295feb8520991653997240.jpg\",\"breadcrumb_image\":\"624acd26d7a4c1649069350.jpg\"}', '2021-05-02 06:09:30', '2022-05-31 11:40:41'),
(41, 'cookie.data', '{\"short_desc\":\"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic\",\"description\":\"<div class=\\\"mb-5\\\" style=\\\"color: rgb(111, 111, 111); font-family: Nunito, sans-serif; margin-bottom: 3rem !important;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight: 600; line-height: 1.3; font-size: 24px; font-family: Exo, sans-serif; color: rgb(54, 54, 54);\\\">What information do we collect?<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right: 0px; margin-left: 0px; font-size: 18px !important;\\\">We gather data from you when you register on our site, submit a request, buy any services, react to an overview, or round out a structure. At the point when requesting any assistance or enrolling on our site, as suitable, you might be approached to enter your: name, email address, or telephone number. You may, nonetheless, visit our site anonymously.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color: rgb(111, 111, 111); font-family: Nunito, sans-serif; margin-bottom: 3rem !important;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight: 600; line-height: 1.3; font-size: 24px; font-family: Exo, sans-serif; color: rgb(54, 54, 54);\\\">How do we protect your information?<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right: 0px; margin-left: 0px; font-size: 18px !important;\\\">All provided delicate\\/credit data is sent through Stripe.<br>After an exchange, your private data (credit cards, social security numbers, financials, and so on) won\'t be put away on our workers.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color: rgb(111, 111, 111); font-family: Nunito, sans-serif; margin-bottom: 3rem !important;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight: 600; line-height: 1.3; font-size: 24px; font-family: Exo, sans-serif; color: rgb(54, 54, 54);\\\">Do we disclose any information to outside parties?<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right: 0px; margin-left: 0px; font-size: 18px !important;\\\">We don\'t sell, exchange, or in any case move to outside gatherings by and by recognizable data. This does exclude confided in outsiders who help us in working our site, leading our business, or adjusting you, since those gatherings consent to keep this data private. We may likewise deliver your data when we accept discharge is suitable to follow the law, implement our site strategies, or ensure our own or others\' rights, property, or wellbeing.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color: rgb(111, 111, 111); font-family: Nunito, sans-serif; margin-bottom: 3rem !important;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight: 600; line-height: 1.3; font-size: 24px; font-family: Exo, sans-serif; color: rgb(54, 54, 54);\\\">Children\'s Online Privacy Protection Act Compliance<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right: 0px; margin-left: 0px; font-size: 18px !important;\\\">We are consistent with the prerequisites of COPPA (Children\'s Online Privacy Protection Act), we don\'t gather any data from anybody under 13 years old. Our site, items, and administrations are completely coordinated to individuals who are in any event 13 years of age or more established.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color: rgb(111, 111, 111); font-family: Nunito, sans-serif; margin-bottom: 3rem !important;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight: 600; line-height: 1.3; font-size: 24px; font-family: Exo, sans-serif; color: rgb(54, 54, 54);\\\">Changes to our Privacy Policy<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right: 0px; margin-left: 0px; font-size: 18px !important;\\\">If we decide to change our privacy policy, we will post those changes on this page.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color: rgb(111, 111, 111); font-family: Nunito, sans-serif; margin-bottom: 3rem !important;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight: 600; line-height: 1.3; font-size: 24px; font-family: Exo, sans-serif; color: rgb(54, 54, 54);\\\">How long we retain your information?<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right: 0px; margin-left: 0px; font-size: 18px !important;\\\">At the point when you register for our site, we cycle and keep your information we have about you however long you don\'t erase the record or withdraw yourself (subject to laws and guidelines).<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color: rgb(111, 111, 111); font-family: Nunito, sans-serif; margin-bottom: 3rem !important;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight: 600; line-height: 1.3; font-size: 24px; font-family: Exo, sans-serif; color: rgb(54, 54, 54);\\\">What we don\\u2019t do with your data<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right: 0px; margin-left: 0px; font-size: 18px !important;\\\">We don\'t and will never share, unveil, sell, or in any case give your information to different organizations for the promoting of their items or administrations.<\\/p><\\/div>\",\"status\":1}', '2020-07-04 23:42:52', '2022-02-24 07:06:22'),
(42, 'policy_pages.element', '{\"title\":\"Privacy Policy\",\"details\":\"<div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">What information do we collect?<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">We gather data from you when you register on our site, submit a request, buy any services, react to an overview, or round out a structure. At the point when requesting any assistance or enrolling on our site, as suitable, you might be approached to enter your: name, email address, or telephone number. You may, nonetheless, visit our site anonymously.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">How do we protect your information?<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">All provided delicate\\/credit data is sent through Stripe.<br \\/>After an exchange, your private data (credit cards, social security numbers, financials, and so on) won\'t be put away on our workers.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">Do we disclose any information to outside parties?<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">We don\'t sell, exchange, or in any case move to outside gatherings by and by recognizable data. This does exclude confided in outsiders who help us in working our site, leading our business, or adjusting you, since those gatherings consent to keep this data private. We may likewise deliver your data when we accept discharge is suitable to follow the law, implement our site strategies, or ensure our own or others\' rights, property, or wellbeing.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">Children\'s Online Privacy Protection Act Compliance<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">We are consistent with the prerequisites of COPPA (Children\'s Online Privacy Protection Act), we don\'t gather any data from anybody under 13 years old. Our site, items, and administrations are completely coordinated to individuals who are in any event 13 years of age or more established.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">Changes to our Privacy Policy<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">If we decide to change our privacy policy, we will post those changes on this page.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">How long we retain your information?<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">At the point when you register for our site, we cycle and keep your information we have about you however long you don\'t erase the record or withdraw yourself (subject to laws and guidelines).<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">What we don\\u2019t do with your data<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">We don\'t and will never share, unveil, sell, or in any case give your information to different organizations for the promoting of their items or administrations.<\\/p><\\/div>\"}', '2021-06-09 08:50:42', '2021-06-09 08:50:42'),
(43, 'policy_pages.element', '{\"title\":\"Terms of Service\",\"details\":\"<div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">We claim all authority to dismiss, end, or handicap any help with or without cause per administrator discretion. This is a Complete independent facilitating, on the off chance that you misuse our ticket or Livechat or emotionally supportive network by submitting solicitations or protests we will impair your record. The solitary time you should reach us about the seaward facilitating is if there is an issue with the worker. We have not many substance limitations and everything is as per laws and guidelines. Try not to join on the off chance that you intend to do anything contrary to the guidelines, we do check these things and we will know, don\'t burn through our own and your time by joining on the off chance that you figure you will have the option to sneak by us and break the terms.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><ul class=\\\"font-18\\\" style=\\\"padding-left:15px;list-style-type:disc;font-size:18px;\\\"><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Configuration requests - If you have a fully managed dedicated server with us then we offer custom PHP\\/MySQL configurations, firewalls for dedicated IPs, DNS, and httpd configurations.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Software requests - Cpanel Extension Installation will be granted as long as it does not interfere with the security, stability, and performance of other users on the server.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Emergency Support - We do not provide emergency support \\/ Phone Support \\/ LiveChat Support. Support may take some hours sometimes.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Webmaster help - We do not offer any support for webmaster related issues and difficulty including coding, &amp; installs, Error solving. if there is an issue where a library or configuration of the server then we can help you if it\'s possible from our end.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Backups - We keep backups but we are not responsible for data loss, you are fully responsible for all backups.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">We Don\'t support any child porn or such material.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">No spam-related sites or material, such as email lists, mass mail programs, and scripts, etc.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">No harassing material that may cause people to retaliate against you.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">No phishing pages.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">You may not run any exploitation script from the server. reason can be terminated immediately.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">If Anyone attempting to hack or exploit the server by using your script or hosting, we will terminate your account to keep safe other users.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Malicious Botnets are strictly forbidden.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Spam, mass mailing, or email marketing in any way are strictly forbidden here.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Malicious hacking materials, trojans, viruses, &amp; malicious bots running or for download are forbidden.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Resource and cronjob abuse is forbidden and will result in suspension or termination.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Php\\/CGI proxies are strictly forbidden.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">CGI-IRC is strictly forbidden.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">No fake or disposal mailers, mass mailing, mail bombers, SMS bombers, etc.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">NO CREDIT OR REFUND will be granted for interruptions of service, due to User Agreement violations.<\\/li><\\/ul><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">Terms &amp; Conditions for Users<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">Before getting to this site, you are consenting to be limited by these site Terms and Conditions of Use, every single appropriate law, and guidelines, and concur that you are answerable for consistency with any material neighborhood laws. If you disagree with any of these terms, you are restricted from utilizing or getting to this site.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">Support<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">Whenever you have downloaded our item, you may get in touch with us for help through email and we will give a valiant effort to determine your issue. We will attempt to answer using the Email for more modest bug fixes, after which we will refresh the center bundle. Content help is offered to confirmed clients by Tickets as it were. Backing demands made by email and Livechat.<\\/p><p class=\\\"my-3 font-18 font-weight-bold\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">On the off chance that your help requires extra adjustment of the System, at that point, you have two alternatives:<\\/p><ul class=\\\"font-18\\\" style=\\\"padding-left:15px;list-style-type:disc;font-size:18px;\\\"><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Hang tight for additional update discharge.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Or on the other hand, enlist a specialist (We offer customization for extra charges).<\\/li><\\/ul><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">Ownership<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">You may not guarantee scholarly or selective possession of any of our items, altered or unmodified. All items are property, we created them. Our items are given \\\"with no guarantees\\\" without guarantee of any sort, either communicated or suggested. On no occasion will our juridical individual be subject to any harms including, however not restricted to, immediate, roundabout, extraordinary, accidental, or significant harms or different misfortunes emerging out of the utilization of or powerlessness to utilize our items.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">Warranty<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">We don\'t offer any guarantee or assurance of these Services in any way. When our Services have been modified we can\'t ensure they will work with all outsider plugins, modules, or internet browsers. Program similarity ought to be tried against the show formats on the demo worker. If you don\'t mind guarantee that the programs you use will work with the component, as we can not ensure that our systems will work with all program mixes.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">Unauthorized\\/Illegal Usage<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">You may not utilize our things for any illicit or unapproved reason or may you, in the utilization of the stage, disregard any laws in your locale (counting yet not restricted to copyright laws) just as the laws of your nation and International law. Specifically, it is disallowed to utilize the things on our foundation for pages that advance: brutality, illegal intimidation, hard sexual entertainment, bigotry, obscenity content or warez programming joins.<br \\/><br \\/>You can\'t imitate, copy, duplicate, sell, exchange or adventure any of our segment, utilization of the offered on our things, or admittance to the administration without the express composed consent by us or item proprietor.<br \\/><br \\/>Our Members are liable for all substance posted on the discussion and demo and movement that happens under your record.<br \\/><br \\/>We hold the chance of hindering your participation account quickly if we will think about a particularly not allowed conduct.<br \\/><br \\/>If you make a record on our site, you are liable for keeping up the security of your record, and you are completely answerable for all exercises that happen under the record and some other activities taken regarding the record. You should quickly inform us, of any unapproved employments of your record or some other penetrates of security.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">Fiverr, Seoclerks Sellers Or Affiliates<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">We do NOT ensure full SEO campaign conveyance within 24 hours. We make no assurance for conveyance time by any means. We give our best assessment to orders during the putting in of requests, anyway, these are gauges. We won\'t be considered liable for loss of assets, negative surveys or you being prohibited for late conveyance. If you are selling on a site that requires time touchy outcomes, utilize Our SEO Services at your own risk.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">Payment\\/Refund Policy<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">No refund or cash back will be made. After a deposit has been finished, it is extremely unlikely to invert it. You should utilize your equilibrium on requests our administrations, Hosting, SEO campaign. You concur that once you complete a deposit, you won\'t document a debate or a chargeback against us in any way, shape, or form.<br \\/><br \\/>If you document a debate or chargeback against us after a deposit, we claim all authority to end every single future request, prohibit you from our site. False action, for example, utilizing unapproved or taken charge cards will prompt the end of your record. There are no special cases.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">Free Balance \\/ Coupon Policy<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">We offer numerous approaches to get FREE Balance, Coupons and Deposit offers yet we generally reserve the privilege to audit it and deduct it from your record offset with any explanation we may it is a sort of misuse. If we choose to deduct a few or all of free Balance from your record balance, and your record balance becomes negative, at that point the record will naturally be suspended. If your record is suspended because of a negative Balance you can request to make a custom payment to settle your equilibrium to actuate your record.<\\/p><\\/div>\"}', '2021-06-09 08:51:18', '2021-06-09 08:51:18'),
(44, 'topnav.content', '{\"email\":\"viserhotel@gmail.com\",\"telephone\":\"123 - 4567890\"}', '2022-04-04 05:46:37', '2022-04-04 05:57:05'),
(45, 'social_icon.element', '{\"title\":\"Twitter\",\"social_icon\":\"<i class=\\\"fab fa-twitter\\\"><\\/i>\",\"url\":\"https:\\/\\/twitter.com\\/\"}', '2022-04-04 05:47:23', '2022-04-04 05:47:46'),
(46, 'social_icon.element', '{\"title\":\"Instagram\",\"social_icon\":\"<i class=\\\"fab fa-instagram\\\"><\\/i>\",\"url\":\"https:\\/\\/www.instagram.com\\/\"}', '2022-04-04 05:48:22', '2022-04-04 05:48:22'),
(47, 'social_icon.element', '{\"title\":\"LinkedIn\",\"social_icon\":\"<i class=\\\"fab fa-linkedin-in\\\"><\\/i>\",\"url\":\"https:\\/\\/www.linkedin.com\\/\"}', '2022-04-04 05:49:00', '2022-04-04 05:49:00'),
(48, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Country is rapidly recovering from the impacts\",\"description\":\"<h3 style=\\\"margin-top:1.5rem;margin-bottom:1rem;font-weight:600;line-height:1.15;font-size:1.5rem;font-family:\'Josefin Sans\', sans-serif;color:rgb(0,42,71);\\\">Curabitur a felis in nunc fringilla tristique abot escrow.<\\/h3><h2 style=\\\"margin-bottom:10px;padding:0px;font-family:DauphinPlain;font-size:24px;line-height:24px;color:rgb(0,0,0);\\\"><\\/h2><div class=\\\"mt-4 contact-section__content-text\\\" style=\\\"font-size:16px;color:rgb(0,42,71);font-family:Roboto, sans-serif;\\\"><p class=\\\"mt-4 contact-section__content-text\\\" style=\\\"margin-bottom:1.5rem;margin-right:0px;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In dui maosuere eget, vestibulum et, tempor auctor, justo. In ac felis quis tortor malesuada pretium. Pellentesque auctor neque nec urna. Proin sapien ipsum, porta a, auctor quis, euismod ut, mi. Aenean viverra rhoncus pede. fringilla tstique. Morbi mattis ullamcorper velit. Phasellus gravida semper nisi. Nullam vel sem.<\\/p><p class=\\\"contact-section__content-text\\\" style=\\\"margin-right:0px;margin-bottom:1.5rem;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,<\\/p><\\/div><h4 style=\\\"margin-top:1.5rem;margin-bottom:1rem;font-weight:600;line-height:1.15;font-size:1.375rem;font-family:\'Josefin Sans\', sans-serif;color:rgb(0,42,71);\\\">Maecenas Dempuget condimentum rhoncus<\\/h4><h2 style=\\\"margin-bottom:10px;padding:0px;font-family:DauphinPlain;font-size:24px;line-height:24px;color:rgb(0,0,0);\\\"><\\/h2><div class=\\\"mt-4 contact-section__content-text\\\" style=\\\"font-size:16px;color:rgb(0,42,71);font-family:Roboto, sans-serif;\\\"><p class=\\\"contact-section__content-text\\\" style=\\\"margin-right:0px;margin-bottom:1.5rem;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Dorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,<\\/p><p class=\\\"contact-section__content-text\\\" style=\\\"margin-right:0px;margin-bottom:1.5rem;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Dorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc.<\\/p><\\/div>\",\"image\":\"624ad875af7f81649072245.jpg\"}', '2022-04-04 10:07:25', '2022-06-21 12:10:02'),
(49, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Il passaggio standard del Lorem Ipsum, utilizzato sin dal sedicesimo secolo\",\"description\":\"<h3 style=\\\"margin-top:1.5rem;margin-bottom:1rem;font-weight:600;line-height:1.15;font-size:1.5rem;font-family:\'Josefin Sans\', sans-serif;color:rgb(0,42,71);\\\">Curabitur a felis in nunc fringilla tristique abot escrow.<\\/h3><h3 style=\\\"margin-top:15px;margin-bottom:15px;padding:0px;font-weight:700;font-size:14px;color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;\\\"><\\/h3><div class=\\\"mt-4 contact-section__content-text\\\" style=\\\"font-size:16px;font-weight:400;color:rgb(0,42,71);font-family:Roboto, sans-serif;\\\"><p class=\\\"mt-4 contact-section__content-text\\\" style=\\\"margin-bottom:1.5rem;margin-right:0px;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In dui maosuere eget, vestibulum et, tempor auctor, justo. In ac felis quis tortor malesuada pretium. Pellentesque auctor neque nec urna. Proin sapien ipsum, porta a, auctor quis, euismod ut, mi. Aenean viverra rhoncus pede. fringilla tstique. Morbi mattis ullamcorper velit. Phasellus gravida semper nisi. Nullam vel sem.<\\/p><p class=\\\"contact-section__content-text\\\" style=\\\"margin-right:0px;margin-bottom:1.5rem;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,<\\/p><\\/div><h4 style=\\\"margin-top:1.5rem;margin-bottom:1rem;font-weight:600;line-height:1.15;font-size:1.375rem;font-family:\'Josefin Sans\', sans-serif;color:rgb(0,42,71);\\\">Maecenas Dempuget condimentum rhoncus<\\/h4><h3 style=\\\"margin-top:15px;margin-bottom:15px;padding:0px;font-weight:700;font-size:14px;color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;\\\"><\\/h3><div class=\\\"mt-4 contact-section__content-text\\\" style=\\\"font-size:16px;font-weight:400;color:rgb(0,42,71);font-family:Roboto, sans-serif;\\\"><p class=\\\"contact-section__content-text\\\" style=\\\"margin-right:0px;margin-bottom:1.5rem;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Dorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,<\\/p><p class=\\\"contact-section__content-text\\\" style=\\\"margin-right:0px;margin-bottom:1.5rem;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Dorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc.<\\/p><\\/div>\",\"image\":\"624c082766c651649149991.jpg\"}', '2022-04-05 07:43:11', '2022-06-19 12:10:26'),
(50, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Traduzione del 1914 di H. Rackham\",\"description\":\"<h3 style=\\\"margin-top:1.5rem;margin-bottom:1rem;font-weight:600;line-height:1.15;font-size:1.5rem;font-family:\'Josefin Sans\', sans-serif;color:rgb(0,42,71);\\\">Curabitur a felis in nunc fringilla tristique abot escrow.<\\/h3><div class=\\\"mt-4 contact-section__content-text\\\" style=\\\"color:rgb(0,42,71);font-family:Roboto, sans-serif;\\\"><p class=\\\"mt-4 contact-section__content-text\\\" style=\\\"margin-bottom:1.5rem;margin-right:0px;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In dui maosuere eget, vestibulum et, tempor auctor, justo. In ac felis quis tortor malesuada pretium. Pellentesque auctor neque nec urna. Proin sapien ipsum, porta a, auctor quis, euismod ut, mi. Aenean viverra rhoncus pede. fringilla tstique. Morbi mattis ullamcorper velit. Phasellus gravida semper nisi. Nullam vel sem.<\\/p><p class=\\\"contact-section__content-text\\\" style=\\\"margin-right:0px;margin-bottom:1.5rem;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,<\\/p><h4 style=\\\"margin-top:1.5rem;margin-bottom:1rem;font-weight:600;line-height:1.15;font-size:1.375rem;font-family:\'Josefin Sans\', sans-serif;color:rgb(0,42,71);\\\">Maecenas Dempuget condimentum rhoncus<\\/h4><p class=\\\"contact-section__content-text\\\" style=\\\"margin-right:0px;margin-bottom:1.5rem;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Dorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,<\\/p><p class=\\\"contact-section__content-text\\\" style=\\\"margin-right:0px;margin-bottom:1.5rem;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Dorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc.<\\/p><\\/div>\",\"image\":\"624c0841e870e1649150017.jpg\"}', '2022-04-05 07:43:37', '2022-06-19 12:10:35'),
(51, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"La sezione 1.10.33 del \\\"de Finibus Bonorum et Malorum\\\", scritto da Cicerone nel 45 AC\",\"description\":\"<h3 style=\\\"margin-top:1.5rem;margin-bottom:1rem;font-weight:600;line-height:1.15;font-size:1.5rem;font-family:\'Josefin Sans\', sans-serif;color:rgb(0,42,71);\\\">Curabitur a felis in nunc fringilla tristique abot escrow.<\\/h3><div class=\\\"mt-4 contact-section__content-text\\\" style=\\\"color:rgb(0,42,71);font-family:Roboto, sans-serif;\\\"><p class=\\\"mt-4 contact-section__content-text\\\" style=\\\"margin-bottom:1.5rem;margin-right:0px;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In dui maosuere eget, vestibulum et, tempor auctor, justo. In ac felis quis tortor malesuada pretium. Pellentesque auctor neque nec urna. Proin sapien ipsum, porta a, auctor quis, euismod ut, mi. Aenean viverra rhoncus pede. fringilla tstique. Morbi mattis ullamcorper velit. Phasellus gravida semper nisi. Nullam vel sem.<\\/p><p class=\\\"contact-section__content-text\\\" style=\\\"margin-right:0px;margin-bottom:1.5rem;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,<\\/p><h4 style=\\\"margin-top:1.5rem;margin-bottom:1rem;font-weight:600;line-height:1.15;font-size:1.375rem;font-family:\'Josefin Sans\', sans-serif;color:rgb(0,42,71);\\\">Maecenas Dempuget condimentum rhoncus<\\/h4><p class=\\\"contact-section__content-text\\\" style=\\\"margin-right:0px;margin-bottom:1.5rem;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Dorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,<\\/p><p class=\\\"contact-section__content-text\\\" style=\\\"margin-right:0px;margin-bottom:1.5rem;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Dorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc.<\\/p><\\/div>\",\"image\":\"624c08595ff9f1649150041.jpg\"}', '2022-04-05 07:44:01', '2022-06-19 12:10:44'),
(52, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Al contrario di quanto si pensi,  LoClintock\",\"description\":\"<h3 style=\\\"margin-top:1.5rem;margin-bottom:1rem;font-weight:600;line-height:1.15;font-size:1.5rem;font-family:\'Josefin Sans\', sans-serif;color:rgb(0,42,71);\\\">Curabitur a felis in nunc fringilla tristique abot escrow.<\\/h3><div class=\\\"mt-4 contact-section__content-text\\\" style=\\\"color:rgb(0,42,71);font-family:Roboto, sans-serif;\\\"><p class=\\\"mt-4 contact-section__content-text\\\" style=\\\"margin-bottom:1.5rem;margin-right:0px;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In dui maosuere eget, vestibulum et, tempor auctor, justo. In ac felis quis tortor malesuada pretium. Pellentesque auctor neque nec urna. Proin sapien ipsum, porta a, auctor quis, euismod ut, mi. Aenean viverra rhoncus pede. fringilla tstique. Morbi mattis ullamcorper velit. Phasellus gravida semper nisi. Nullam vel sem.<\\/p><p class=\\\"contact-section__content-text\\\" style=\\\"margin-right:0px;margin-bottom:1.5rem;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,<\\/p><h4 style=\\\"margin-top:1.5rem;margin-bottom:1rem;font-weight:600;line-height:1.15;font-size:1.375rem;font-family:\'Josefin Sans\', sans-serif;color:rgb(0,42,71);\\\">Maecenas Dempuget condimentum rhoncus<\\/h4><p class=\\\"contact-section__content-text\\\" style=\\\"margin-right:0px;margin-bottom:1.5rem;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Dorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,<\\/p><p class=\\\"contact-section__content-text\\\" style=\\\"margin-right:0px;margin-bottom:1.5rem;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Dorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc.<\\/p><\\/div>\",\"image\":\"624c08adaa94c1649150125.jpg\"}', '2022-04-05 07:45:25', '2022-06-19 12:11:57');
INSERT INTO `frontends` (`id`, `data_keys`, `data_values`, `created_at`, `updated_at`) VALUES
(53, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"\\u00c8 universalmente riconosciuto che un lettore che osserva il layout di una pagina viene distratto dal contenuto testuale\",\"description\":\"<h3 style=\\\"margin-top:1.5rem;margin-bottom:1rem;font-weight:600;line-height:1.15;font-size:1.5rem;font-family:\'Josefin Sans\', sans-serif;color:rgb(0,42,71);\\\">Curabitur a felis in nunc fringilla tristique abot escrow.<\\/h3><h2 style=\\\"margin-bottom:10px;padding:0px;font-family:DauphinPlain;font-size:24px;line-height:24px;color:rgb(0,0,0);\\\"><\\/h2><div class=\\\"mt-4 contact-section__content-text\\\" style=\\\"font-size:16px;color:rgb(0,42,71);font-family:Roboto, sans-serif;\\\"><p class=\\\"mt-4 contact-section__content-text\\\" style=\\\"margin-bottom:1.5rem;margin-right:0px;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In dui maosuere eget, vestibulum et, tempor auctor, justo. In ac felis quis tortor malesuada pretium. Pellentesque auctor neque nec urna. Proin sapien ipsum, porta a, auctor quis, euismod ut, mi. Aenean viverra rhoncus pede. fringilla tstique. Morbi mattis ullamcorper velit. Phasellus gravida semper nisi. Nullam vel sem.<\\/p><p class=\\\"contact-section__content-text\\\" style=\\\"margin-right:0px;margin-bottom:1.5rem;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,<\\/p><\\/div><h4 style=\\\"margin-top:1.5rem;margin-bottom:1rem;font-weight:600;line-height:1.15;font-size:1.375rem;font-family:\'Josefin Sans\', sans-serif;color:rgb(0,42,71);\\\">Maecenas Dempuget condimentum rhoncus<\\/h4><h2 style=\\\"margin-bottom:10px;padding:0px;font-family:DauphinPlain;font-size:24px;line-height:24px;color:rgb(0,0,0);\\\"><\\/h2><div class=\\\"mt-4 contact-section__content-text\\\" style=\\\"font-size:16px;color:rgb(0,42,71);font-family:Roboto, sans-serif;\\\"><p class=\\\"contact-section__content-text\\\" style=\\\"margin-right:0px;margin-bottom:1.5rem;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Dorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,<\\/p><p class=\\\"contact-section__content-text\\\" style=\\\"margin-right:0px;margin-bottom:1.5rem;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Dorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc.<\\/p><\\/div>\",\"image\":\"624c09f9527101649150457.jpg\"}', '2022-04-05 07:50:57', '2022-06-19 12:11:47'),
(54, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"The standard Lorem Ipsum passage\",\"description\":\"<h3 style=\\\"margin-top:1.5rem;margin-bottom:1rem;font-weight:600;line-height:1.15;font-size:1.5rem;font-family:\'Josefin Sans\', sans-serif;color:rgb(0,42,71);\\\">Curabitur a felis in nunc fringilla tristique abot escrow.<\\/h3><div class=\\\"mt-4 contact-section__content-text\\\" style=\\\"color:rgb(0,42,71);font-family:Roboto, sans-serif;\\\"><p class=\\\"mt-4 contact-section__content-text\\\" style=\\\"margin-bottom:1.5rem;margin-right:0px;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In dui maosuere eget, vestibulum et, tempor auctor, justo. In ac felis quis tortor malesuada pretium. Pellentesque auctor neque nec urna. Proin sapien ipsum, porta a, auctor quis, euismod ut, mi. Aenean viverra rhoncus pede. fringilla tstique. Morbi mattis ullamcorper velit. Phasellus gravida semper nisi. Nullam vel sem.<\\/p><p class=\\\"contact-section__content-text\\\" style=\\\"margin-right:0px;margin-bottom:1.5rem;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,<\\/p><h4 style=\\\"margin-top:1.5rem;margin-bottom:1rem;font-weight:600;line-height:1.15;font-size:1.375rem;font-family:\'Josefin Sans\', sans-serif;color:rgb(0,42,71);\\\">Maecenas Dempuget condimentum rhoncus<\\/h4><p class=\\\"contact-section__content-text\\\" style=\\\"margin-right:0px;margin-bottom:1.5rem;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Dorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,<\\/p><p class=\\\"contact-section__content-text\\\" style=\\\"margin-right:0px;margin-bottom:1.5rem;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Dorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc.<\\/p><\\/div>\",\"image\":\"624c0a42107321649150530.jpg\"}', '2022-04-05 07:52:10', '2022-06-21 12:10:29'),
(55, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"The consumers who did not spend\",\"description\":\"<h3 style=\\\"margin-top:1.5rem;margin-bottom:1rem;font-weight:600;line-height:1.15;font-size:1.5rem;font-family:\'Josefin Sans\', sans-serif;color:rgb(0,42,71);\\\">Curabitur a felis in nunc fringilla tristique abot escrow.<\\/h3><div class=\\\"mt-4 contact-section__content-text\\\" style=\\\"color:rgb(0,42,71);font-family:Roboto, sans-serif;\\\"><p class=\\\"mt-4 contact-section__content-text\\\" style=\\\"margin-bottom:1.5rem;margin-right:0px;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In dui maosuere eget, vestibulum et, tempor auctor, justo. In ac felis quis tortor malesuada pretium. Pellentesque auctor neque nec urna. Proin sapien ipsum, porta a, auctor quis, euismod ut, mi. Aenean viverra rhoncus pede. fringilla tstique. Morbi mattis ullamcorper velit. Phasellus gravida semper nisi. Nullam vel sem.<\\/p><p class=\\\"contact-section__content-text\\\" style=\\\"margin-right:0px;margin-bottom:1.5rem;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,<\\/p><h4 style=\\\"margin-top:1.5rem;margin-bottom:1rem;font-weight:600;line-height:1.15;font-size:1.375rem;font-family:\'Josefin Sans\', sans-serif;color:rgb(0,42,71);\\\">Maecenas Dempuget condimentum rhoncus<\\/h4><p class=\\\"contact-section__content-text\\\" style=\\\"margin-right:0px;margin-bottom:1.5rem;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Dorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,<\\/p><p class=\\\"contact-section__content-text\\\" style=\\\"margin-right:0px;margin-bottom:1.5rem;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Dorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc.<\\/p><\\/div>\",\"image\":\"624c0a7923c511649150585.jpg\"}', '2022-04-05 07:53:05', '2022-06-21 12:10:46'),
(56, 'subscribe.content', '{\"has_image\":\"1\",\"heading\":\"Subscribe Newsletter\",\"button_title\":\"Subscribe\",\"image\":\"624c17a47e1771649153956.jpg\"}', '2022-04-05 08:49:16', '2022-06-19 07:33:40'),
(61, 'testimonial.content', '{\"has_image\":\"1\",\"heading\":\"Happy Client\'s Review\",\"subheading\":\"Maecenas nec odio et ante tincidunt tempus. Donec vitae apitlibero venenatis faucibus. Nullam quis ante. Etiam sit amet orci\",\"background_image\":\"624c521e4fca71649168926.jpg\"}', '2022-04-05 12:55:06', '2022-06-02 04:41:21'),
(67, 'faq.content', '{\"heading\":\"FAQ\",\"subheading\":\"Please check the question and answer. If any further issues occured, please contact with us, we will solve the issue in correct time.\",\"button_text\":\"See More\",\"button_url\":\"\\/faq\"}', '2022-04-05 13:34:46', '2022-06-19 07:15:02'),
(68, 'faq.element', '{\"question\":\"How to booking room?\",\"answer\":\"Condimentum nec, nisi. Praesent nec nisl a purus blandit viverra.raesent ac massa at ligula laoreet iaculis. Nulla neque dolor sagittis eget iaculis quis molestie non velit. Mauris turpis nunc.\"}', '2022-04-05 13:35:20', '2022-04-05 13:35:20'),
(69, 'faq.element', '{\"question\":\"Hotel location?\",\"answer\":\"Condimentum nec, nisi. Praesent nec nisl a purus blandit viverra.raesent ac massa at ligula laoreet iaculis. Nulla neque dolor sagittis eget iaculis quis molestie non velit. Mauris turpis nunc.\"}', '2022-04-05 13:35:37', '2022-04-05 13:35:37'),
(70, 'faq.element', '{\"question\":\"What we serve?\",\"answer\":\"Condimentum nec, nisi. Praesent nec nisl a purus blandit viverra.raesent ac massa at ligula laoreet iaculis. Nulla neque dolor sagittis eget iaculis quis molestie non velit. Mauris turpis nunc.\"}', '2022-04-05 13:36:31', '2022-04-05 13:36:31'),
(71, 'login.content', '{\"has_image\":\"1\",\"title\":\"Hello! Welcome to Single Hotel Room Booking\",\"short_details\":\"Maecenas nec odio et ante tincidunt tempus. Donec vitae apitlibero venenatis\",\"form_heading\":\"Sign In Account\",\"form_subheading\":\"Maecenas nec odio et ante tincidunt tempus. Donec vitae apitlibero venenatis\",\"image\":\"629710f22d70d1654067442.png\"}', '2022-04-06 01:40:04', '2022-06-01 09:28:58'),
(72, 'register.content', '{\"has_image\":\"1\",\"title\":\"Hello! Welcome to Single Hotel Room Booking\",\"heading\":\"Register Your Account\",\"subheading\":\"When you create an account, it helps you book your perfect room.\",\"image\":\"6297316e19a5c1654075758.png\"}', '2022-04-06 01:40:45', '2023-01-28 13:33:03'),
(74, 'code_verify.content', '{\"description\":\"A 6 digit verification code sent to your email address :\"}', '2022-04-06 04:09:22', '2022-06-26 04:03:14'),
(75, 'service.element', '{\"name\":\"Health Care\",\"icon\":\"<i class=\\\"fas fa-ambulance\\\"><\\/i>\"}', '2022-05-21 06:23:17', '2022-05-21 06:23:17'),
(76, 'service.element', '{\"name\":\"Swimming Pool\",\"icon\":\"<i class=\\\"fas fa-swimming-pool\\\"><\\/i>\"}', '2022-05-21 06:23:45', '2022-05-21 06:23:45'),
(77, 'service.element', '{\"name\":\"Travelling\",\"icon\":\"<i class=\\\"fas fa-plane-departure\\\"><\\/i>\"}', '2022-05-21 06:24:13', '2022-05-21 06:24:13'),
(78, 'service.element', '{\"name\":\"BBQ Resturant\",\"icon\":\"<i class=\\\"fas fa-hotel\\\"><\\/i>\"}', '2022-05-21 06:25:33', '2022-05-21 06:26:16'),
(79, 'testimonial.element', '{\"name\":\"Elvis Gentry\",\"designation\":\"Expedita tenetur vol\",\"feedback\":\"The hospitality and services provided by each staff of the hotel were excellent, they attended us well at all times and we were impressed by their courtesy. We enjoyed our stay and convey thanks to all associated with the hotel. Special thanks to Khun Gap, who took very good care of our group since the inspection day until the end of the trip. We really appreciate ka. We hope to come again soon.\\r\\n\\r\\nThanks for the memories!\",\"has_image\":[\"1\"],\"image\":\"6288874160bf51653114689.png\"}', '2022-05-21 06:31:29', '2022-05-21 06:33:11'),
(80, 'testimonial.element', '{\"name\":\"Mohammad Bright\",\"designation\":\"Nostrud repellendus\",\"feedback\":\"Thank you so much to the Royal Cliff team. I left something behind at the hotel and also wanted them to issue another receipt for tax purposes. They immediately worked on it and the receipt was sent in the hour by email. The item was returned within the day. Totally beyond my expectation. You can totally trust this hotel! Whilst staying there everything was so clean and the service was very attentive. Will always be a customer here.\",\"has_image\":[\"1\"],\"image\":\"62888750e9efe1653114704.png\"}', '2022-05-21 06:31:44', '2022-05-21 06:33:58'),
(81, 'testimonial.element', '{\"name\":\"Nasim Knapp\",\"designation\":\"In adipisci iste in\",\"feedback\":\"Thank you for a truly amazing stay! Your hospitality is quite outstanding. The sports centre is also very good with excellent quality tennis courts. Hope to be back soon.\",\"has_image\":[\"1\"],\"image\":\"628887596ea0a1653114713.png\"}', '2022-05-21 06:31:53', '2022-05-21 06:34:23'),
(82, 'testimonial.element', '{\"name\":\"Amy Vazquez\",\"designation\":\"Voluptatum sint volu\",\"feedback\":\"Beyond 5 stars! Stayed last week at this wonderful hotel. Everything exceeds ones wildest dream of a hotel. On top they have the most wonderful staff, extremely kind and helpful with every wish. This is indeed a place you do not want to leave, and when you do it is with one hope \\u2013 to come back.\",\"has_image\":[\"1\"],\"image\":\"62888760b4f021653114720.png\"}', '2022-05-21 06:32:00', '2022-05-21 06:34:43'),
(83, 'testimonial.element', '{\"name\":\"Connor Cooke\",\"designation\":\"Amet error iure et\",\"feedback\":\"The service here has just been fantastic; whatever we needed was brought to us right away. Our event coordinator was amazing, she has been most helpful. The food was so delicious; the entire experience was really great.\",\"has_image\":[\"1\"],\"image\":\"62888769986841653114729.png\"}', '2022-05-21 06:32:09', '2022-05-21 06:35:08'),
(84, 'testimonial.element', '{\"name\":\"Hope Mills\",\"designation\":\"Qui cillum illo aut\",\"feedback\":\"Good day! We would like to thank you for your sincere efforts and support in success of our recent Parts Conference held in your Hotel. Outstanding support was received from you, your team which is highly appreciated. Please find attached official Appreciation Letter for your kind reference. Thanks &amp; Best Regards.\",\"has_image\":[\"1\"],\"image\":\"62888770d77e31653114736.png\"}', '2022-05-21 06:32:16', '2022-05-21 06:35:55'),
(85, 'faq.element', '{\"question\":\"How to cancel booking?\",\"answer\":\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam aliquam at lectus sed dignissim. In posuere ex dui, ac lacinia risus elementum non\"}', '2022-05-21 06:40:42', '2022-05-21 06:40:42'),
(86, 'faq.element', '{\"question\":\"What is our refund policy?\",\"answer\":\"Curabitur gravida diam sed facilisis aliquet. Nam vel turpis metus. Fusce luctus convallis purus vel malesuada. Sed ultrices magna quis eros posuere.\"}', '2022-05-21 06:41:17', '2022-05-21 06:41:17'),
(87, 'footer.content', '{\"has_image\":\"1\",\"description\":\"Maecenas nec odio et ante tincid empus. Donec vitae sapien ut libero venaucibus. Nullam quis ante. Etiam sit amet.\",\"image\":\"62888fc1e667b1653116865.jpg\"}', '2022-05-21 07:07:45', '2022-05-24 10:39:18'),
(88, 'maintenance.data', '{\"description\":\"<div style=\\\"font-family: Nunito, sans-serif;\\\">\\r\\n        <h2 style=\\\"font-family: Poppins, sans-serif; text-align: center;\\\">\\r\\n            We\'re Just Tuning Up a Few Things\\r\\n        <\\/h2>\\r\\n       \\r\\n        <p style=\\\"text-align: start; font-size:1rem;\\\">\\r\\n            We apologize for the inconvenience but Front is currently undergoing planned maintenance. Thanks for your patience\\r\\n        <\\/p>\\r\\n        \\r\\n    <\\/div>\",\"image\":\"63da462b6557d1675249195.png\",\"heading\":\"THE SITE USNDER MAINTENANCE\",\"button_text\":null}', NULL, '2023-02-02 05:56:42'),
(89, 'faq.element', '{\"question\":\"Enim consequatur La ?\",\"answer\":\"It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\"}', '2022-06-02 06:23:27', '2022-06-02 06:23:27'),
(90, 'faq.element', '{\"question\":\"Duis velit qui reru ?\",\"answer\":\"There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour.\"}', '2022-06-02 06:23:47', '2022-06-02 06:23:47'),
(91, 'faq.element', '{\"question\":\"Magni quas voluptate ?\",\"answer\":\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis.\"}', '2022-06-02 06:24:08', '2022-06-02 06:24:08'),
(92, 'faq.element', '{\"question\":\"Illum sint voluptat ?\",\"answer\":\"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects.\"}', '2022-06-02 06:24:37', '2022-06-02 06:24:37'),
(93, 'faq.element', '{\"question\":\"Iste asperiores illo ?\",\"answer\":\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis.\"}', '2022-06-02 06:24:48', '2022-06-19 07:13:41'),
(95, 'featured_room.content', '{\"heading\":\"Featured Rooms\",\"subheading\":\"Every room type has many rooms. Anyone can send booking requrest from this site.\"}', '2022-06-19 07:05:06', '2022-06-23 06:37:14'),
(97, 'maintenance_mode.content', '{\"has_image\":\"1\",\"heading\":\"THE SITE IS UNDER MAINTENANCE\",\"image\":\"62b8578719e9e1656248199.png\"}', '2022-06-26 06:48:45', '2022-06-26 06:56:39'),
(98, 'banned_page.content', '{\"has_image\":\"1\",\"heading\":\"You are banned\",\"image\":\"63d77188b0ad61675063688.png\"}', '2022-06-26 07:22:50', '2023-01-30 07:28:08'),
(99, 'maintenance_page.content', '{\"has_image\":\"1\",\"heading\":\"THE SITE IS UNDER MAINTENANCE\",\"image\":\"62b92e3bdf08d1656303163.png\"}', '2022-06-26 22:12:43', '2022-06-26 22:12:44'),
(100, 'policy_pages.element', '{\"title\":\"Refund and Cancellation Policy\",\"details\":\"<h2 class=\\\"title mb-3\\\" style=\\\"font-weight:700;line-height:1.1;font-size:1.875rem;color:rgb(33,33,33);\\\">Cancellation And Refund Policies<\\/h2><h1 class=\\\"title\\\" style=\\\"margin-right:30px;margin-bottom:0.5em;padding:0px;font-family:MontBold;font-weight:800;line-height:45px;color:rgb(16,16,155);font-size:30px;text-transform:capitalize;\\\"><\\/h1><p style=\\\"margin-right:0px;margin-left:0px;color:rgb(85,85,85);font-family:Lato, sans-serif;font-size:16px;text-transform:none;\\\">To reduce last-minute cancellations and the risk of \\\"<a href=\\\"https:\\/\\/en.wikipedia.org\\/wiki\\/Chargeback\\\" style=\\\"color:rgb(16,16,155);margin:0px;padding:0px;\\\">chargebacks<\\/a>\\\" from customers, it is always a good idea to have your customers agree to your cancellation and refund policy. This should be attached to the customers\' orders for future reference. The occasion makes this easy for you and your customers.<\\/p><p style=\\\"margin-right:0px;margin-left:0px;color:rgb(85,85,85);font-family:Lato, sans-serif;font-size:16px;text-transform:none;\\\">In this article, we will help you define your cancellation and refund policy. Let\'s start by answering the following questions:<\\/p><ol style=\\\"color:rgb(85,85,85);font-family:Lato, sans-serif;font-size:16px;font-weight:400;text-transform:none;\\\"><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\"><\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">When do they have to inform you by before the actual event date starts to cancel?<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Do you want to keep their payment and give them store credit instead?<\\/li><\\/ol><p style=\\\"margin-right:0px;margin-left:0px;color:rgb(85,85,85);font-family:Lato, sans-serif;font-size:16px;text-transform:none;\\\">By answering the questions above, you can come up with some very simple and basic policies, like this one:\\u00a0<i style=\\\"margin:0px;padding:0px;\\\">To receive a refund, customers must notify at least 4 days before the start of the event. In all other instances, only store credit is issued.<\\/i><\\/p><p style=\\\"margin-right:0px;margin-left:0px;color:rgb(85,85,85);font-family:Lato, sans-serif;font-size:16px;text-transform:none;\\\">Below are\\u00a0<span style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\"><u style=\\\"margin:0px;padding:0px;\\\">six<\\/u><\\/span>\\u00a0great examples of cancellation and refund policies:<\\/p><ol style=\\\"color:rgb(85,85,85);font-family:Lato, sans-serif;font-size:16px;font-weight:400;text-transform:none;\\\"><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Due\\u00a0to limited seating, we request that you cancel at least 48 hours before a scheduled class. This gives us the opportunity to fill the class. You may cancel by phone or online here. If you have to cancel your class, we offer you a credit to your account if you cancel before 48 hours, but do not offer refunds. You may use these credits for any future class. However, if you do not cancel prior to the 48 hours, you will lose the payment for the class. The owner has the only right to be flexible here.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Cancellations made 7 days or more in advance of the event date will receive a 100% refund. Cancellations made within 3 - 6 days will incur a 20% fee. Cancellations made within 48 hours of the event will incur a 30% fee.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">I understand that I am holding a spot so reservations for this event are nonrefundable. If I am unable to attend I understand that I can transfer to a friend.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">If your cancellation is at least 24 hours in advance of the class, you will receive a full refund. If your cancellation is less than 24 hours in advance, you will receive a gift certificate to attend a future class. We will do our best to accommodate your needs.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">You may cancel your class up to 24 hours before the class begins and request receives a full refund. If cancellation is made the day of you will receive a credit to reschedule at a later date. Credit must be used within 90 days.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">You may request to cancel your ticket for a full refund, up to 72 hours before the date and time of the event. Cancellations between 25-72 hours before the event may be transferred to a different date\\/time of the same class. Cancellation requests made within 24 hours of the class date\\/time may not receive a refund or a transfer. When you register for a class, you agree to these terms.<\\/li><\\/ol>\"}', '2022-07-04 08:52:24', '2022-07-04 09:23:53'),
(101, 'account_recovery.content', '{\"description\":\"Lorem ipsum dolor sit amet. Et consequatur corporis eum laudantium galisum ut nostrum perferendis. Ut tenetur neque eos vitae nulla id itaque possimus aut cupiditate maxime.\"}', '2023-01-30 07:22:26', '2023-01-30 07:22:26');

-- --------------------------------------------------------

--
-- Table structure for table `gateways`
--

CREATE TABLE `gateways` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `form_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `code` int(10) DEFAULT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alias` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NULL',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=>enable, 2=>disable',
  `gateway_parameters` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supported_currencies` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `crypto` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: fiat currency, 1: crypto currency',
  `extra` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gateways`
--

INSERT INTO `gateways` (`id`, `form_id`, `code`, `name`, `alias`, `status`, `gateway_parameters`, `supported_currencies`, `crypto`, `extra`, `description`, `created_at`, `updated_at`) VALUES
(1, 0, 101, 'Paypal', 'Paypal', 1, '{\"paypal_email\":{\"title\":\"PayPal Email\",\"global\":true,\"value\":\"sb-owud61543012@business.example.com\"}}', '{\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"TWD\":\"TWD\",\"NZD\":\"NZD\",\"NOK\":\"NOK\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"GBP\":\"GBP\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"USD\":\"$\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 00:04:38'),
(2, 0, 102, 'Perfect Money', 'PerfectMoney', 1, '{\"passphrase\":{\"title\":\"ALTERNATE PASSPHRASE\",\"global\":true,\"value\":\"hR26aw02Q1eEeUPSIfuwNypXX\"},\"wallet_id\":{\"title\":\"PM Wallet\",\"global\":false,\"value\":\"\"}}', '{\"USD\":\"$\",\"EUR\":\"\\u20ac\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 01:35:33'),
(3, 0, 103, 'Stripe Hosted', 'Stripe', 1, '{\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"sk_test_51I6GGiCGv1sRiQlEi5v1or9eR0HVbuzdMd2rW4n3DxC8UKfz66R4X6n4yYkzvI2LeAIuRU9H99ZpY7XCNFC9xMs500vBjZGkKG\"},\"publishable_key\":{\"title\":\"PUBLISHABLE KEY\",\"global\":true,\"value\":\"pk_test_51I6GGiCGv1sRiQlEOisPKrjBqQqqcFsw8mXNaZ2H2baN6R01NulFS7dKFji1NRRxuchoUTEDdB7ujKcyKYSVc0z500eth7otOM\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"SGD\":\"SGD\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 00:48:36'),
(4, 0, 104, 'Skrill', 'Skrill', 1, '{\"pay_to_email\":{\"title\":\"Skrill Email\",\"global\":true,\"value\":\"merchant@skrill.com\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"---\"}}', '{\"AED\":\"AED\",\"AUD\":\"AUD\",\"BGN\":\"BGN\",\"BHD\":\"BHD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"HRK\":\"HRK\",\"HUF\":\"HUF\",\"ILS\":\"ILS\",\"INR\":\"INR\",\"ISK\":\"ISK\",\"JOD\":\"JOD\",\"JPY\":\"JPY\",\"KRW\":\"KRW\",\"KWD\":\"KWD\",\"MAD\":\"MAD\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"OMR\":\"OMR\",\"PLN\":\"PLN\",\"QAR\":\"QAR\",\"RON\":\"RON\",\"RSD\":\"RSD\",\"SAR\":\"SAR\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TND\":\"TND\",\"TRY\":\"TRY\",\"TWD\":\"TWD\",\"USD\":\"USD\",\"ZAR\":\"ZAR\",\"COP\":\"COP\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 01:30:16'),
(5, 0, 105, 'PayTM', 'Paytm', 1, '{\"MID\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"DIY12386817555501617\"},\"merchant_key\":{\"title\":\"Merchant Key\",\"global\":true,\"value\":\"bKMfNxPPf_QdZppa\"},\"WEBSITE\":{\"title\":\"Paytm Website\",\"global\":true,\"value\":\"DIYtestingweb\"},\"INDUSTRY_TYPE_ID\":{\"title\":\"Industry Type\",\"global\":true,\"value\":\"Retail\"},\"CHANNEL_ID\":{\"title\":\"CHANNEL ID\",\"global\":true,\"value\":\"WEB\"},\"transaction_url\":{\"title\":\"Transaction URL\",\"global\":true,\"value\":\"https:\\/\\/pguat.paytm.com\\/oltp-web\\/processTransaction\"},\"transaction_status_url\":{\"title\":\"Transaction STATUS URL\",\"global\":true,\"value\":\"https:\\/\\/pguat.paytm.com\\/paytmchecksum\\/paytmCallback.jsp\"}}', '{\"AUD\":\"AUD\",\"ARS\":\"ARS\",\"BDT\":\"BDT\",\"BRL\":\"BRL\",\"BGN\":\"BGN\",\"CAD\":\"CAD\",\"CLP\":\"CLP\",\"CNY\":\"CNY\",\"COP\":\"COP\",\"HRK\":\"HRK\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EGP\":\"EGP\",\"EUR\":\"EUR\",\"GEL\":\"GEL\",\"GHS\":\"GHS\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"IDR\":\"IDR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"KES\":\"KES\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"MAD\":\"MAD\",\"NPR\":\"NPR\",\"NZD\":\"NZD\",\"NGN\":\"NGN\",\"NOK\":\"NOK\",\"PKR\":\"PKR\",\"PEN\":\"PEN\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"RON\":\"RON\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"ZAR\":\"ZAR\",\"KRW\":\"KRW\",\"LKR\":\"LKR\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"TRY\":\"TRY\",\"UGX\":\"UGX\",\"UAH\":\"UAH\",\"AED\":\"AED\",\"GBP\":\"GBP\",\"USD\":\"USD\",\"VND\":\"VND\",\"XOF\":\"XOF\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 03:00:44'),
(6, 0, 106, 'Payeer', 'Payeer', 1, '{\"merchant_id\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"866989763\"},\"secret_key\":{\"title\":\"Secret key\",\"global\":true,\"value\":\"7575\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\",\"RUB\":\"RUB\"}', 0, '{\"status\":{\"title\": \"Status URL\",\"value\":\"ipn.Payeer\"}}', NULL, '2019-09-14 13:14:22', '2022-08-28 10:11:14'),
(7, 0, 107, 'PayStack', 'Paystack', 1, '{\"public_key\":{\"title\":\"Public key\",\"global\":true,\"value\":\"pk_test_cd330608eb47970889bca397ced55c1dd5ad3783\"},\"secret_key\":{\"title\":\"Secret key\",\"global\":true,\"value\":\"sk_test_8a0b1f199362d7acc9c390bff72c4e81f74e2ac3\"}}', '{\"USD\":\"USD\",\"NGN\":\"NGN\"}', 0, '{\"callback\":{\"title\": \"Callback URL\",\"value\":\"ipn.Paystack\"},\"webhook\":{\"title\": \"Webhook URL\",\"value\":\"ipn.Paystack\"}}\r\n', NULL, '2019-09-14 13:14:22', '2021-05-21 01:49:51'),
(8, 0, 108, 'VoguePay', 'Voguepay', 1, '{\"merchant_id\":{\"title\":\"MERCHANT ID\",\"global\":true,\"value\":\"demo\"}}', '{\"USD\":\"USD\",\"GBP\":\"GBP\",\"EUR\":\"EUR\",\"GHS\":\"GHS\",\"NGN\":\"NGN\",\"ZAR\":\"ZAR\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 01:22:38'),
(9, 0, 109, 'Flutterwave', 'Flutterwave', 1, '{\"public_key\":{\"title\":\"Public Key\",\"global\":true,\"value\":\"----------------\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"-----------------------\"},\"encryption_key\":{\"title\":\"Encryption Key\",\"global\":true,\"value\":\"------------------\"}}', '{\"BIF\":\"BIF\",\"CAD\":\"CAD\",\"CDF\":\"CDF\",\"CVE\":\"CVE\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"GHS\":\"GHS\",\"GMD\":\"GMD\",\"GNF\":\"GNF\",\"KES\":\"KES\",\"LRD\":\"LRD\",\"MWK\":\"MWK\",\"MZN\":\"MZN\",\"NGN\":\"NGN\",\"RWF\":\"RWF\",\"SLL\":\"SLL\",\"STD\":\"STD\",\"TZS\":\"TZS\",\"UGX\":\"UGX\",\"USD\":\"USD\",\"XAF\":\"XAF\",\"XOF\":\"XOF\",\"ZMK\":\"ZMK\",\"ZMW\":\"ZMW\",\"ZWD\":\"ZWD\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2021-06-05 11:37:45'),
(10, 0, 110, 'RazorPay', 'Razorpay', 1, '{\"key_id\":{\"title\":\"Key Id\",\"global\":true,\"value\":\"rzp_test_kiOtejPbRZU90E\"},\"key_secret\":{\"title\":\"Key Secret \",\"global\":true,\"value\":\"osRDebzEqbsE1kbyQJ4y0re7\"}}', '{\"INR\":\"INR\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 02:51:32'),
(11, 0, 111, 'Stripe Storefront', 'StripeJs', 1, '{\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"sk_test_51I6GGiCGv1sRiQlEi5v1or9eR0HVbuzdMd2rW4n3DxC8UKfz66R4X6n4yYkzvI2LeAIuRU9H99ZpY7XCNFC9xMs500vBjZGkKG\"},\"publishable_key\":{\"title\":\"PUBLISHABLE KEY\",\"global\":true,\"value\":\"pk_test_51I6GGiCGv1sRiQlEOisPKrjBqQqqcFsw8mXNaZ2H2baN6R01NulFS7dKFji1NRRxuchoUTEDdB7ujKcyKYSVc0z500eth7otOM\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"SGD\":\"SGD\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 00:53:10'),
(12, 0, 112, 'Instamojo', 'Instamojo', 1, '{\"api_key\":{\"title\":\"API KEY\",\"global\":true,\"value\":\"test_2241633c3bc44a3de84a3b33969\"},\"auth_token\":{\"title\":\"Auth Token\",\"global\":true,\"value\":\"test_279f083f7bebefd35217feef22d\"},\"salt\":{\"title\":\"Salt\",\"global\":true,\"value\":\"19d38908eeff4f58b2ddda2c6d86ca25\"}}', '{\"INR\":\"INR\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 02:56:20'),
(13, 0, 501, 'Blockchain', 'Blockchain', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"55529946-05ca-48ff-8710-f279d86b1cc5\"},\"xpub_code\":{\"title\":\"XPUB CODE\",\"global\":true,\"value\":\"xpub6CKQ3xxWyBoFAF83izZCSFUorptEU9AF8TezhtWeMU5oefjX3sFSBw62Lr9iHXPkXmDQJJiHZeTRtD9Vzt8grAYRhvbz4nEvBu3QKELVzFK\"}}', '{\"BTC\":\"BTC\"}', 1, NULL, NULL, '2019-09-14 13:14:22', '2022-03-21 07:41:56'),
(15, 0, 503, 'CoinPayments', 'Coinpayments', 1, '{\"public_key\":{\"title\":\"Public Key\",\"global\":true,\"value\":\"---------------\"},\"private_key\":{\"title\":\"Private Key\",\"global\":true,\"value\":\"------------\"},\"merchant_id\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"93a1e014c4ad60a7980b4a7239673cb4\"}}', '{\"BTC\":\"Bitcoin\",\"BTC.LN\":\"Bitcoin (Lightning Network)\",\"LTC\":\"Litecoin\",\"CPS\":\"CPS Coin\",\"VLX\":\"Velas\",\"APL\":\"Apollo\",\"AYA\":\"Aryacoin\",\"BAD\":\"Badcoin\",\"BCD\":\"Bitcoin Diamond\",\"BCH\":\"Bitcoin Cash\",\"BCN\":\"Bytecoin\",\"BEAM\":\"BEAM\",\"BITB\":\"Bean Cash\",\"BLK\":\"BlackCoin\",\"BSV\":\"Bitcoin SV\",\"BTAD\":\"Bitcoin Adult\",\"BTG\":\"Bitcoin Gold\",\"BTT\":\"BitTorrent\",\"CLOAK\":\"CloakCoin\",\"CLUB\":\"ClubCoin\",\"CRW\":\"Crown\",\"CRYP\":\"CrypticCoin\",\"CRYT\":\"CryTrExCoin\",\"CURE\":\"CureCoin\",\"DASH\":\"DASH\",\"DCR\":\"Decred\",\"DEV\":\"DeviantCoin\",\"DGB\":\"DigiByte\",\"DOGE\":\"Dogecoin\",\"EBST\":\"eBoost\",\"EOS\":\"EOS\",\"ETC\":\"Ether Classic\",\"ETH\":\"Ethereum\",\"ETN\":\"Electroneum\",\"EUNO\":\"EUNO\",\"EXP\":\"EXP\",\"Expanse\":\"Expanse\",\"FLASH\":\"FLASH\",\"GAME\":\"GameCredits\",\"GLC\":\"Goldcoin\",\"GRS\":\"Groestlcoin\",\"KMD\":\"Komodo\",\"LOKI\":\"LOKI\",\"LSK\":\"LSK\",\"MAID\":\"MaidSafeCoin\",\"MUE\":\"MonetaryUnit\",\"NAV\":\"NAV Coin\",\"NEO\":\"NEO\",\"NMC\":\"Namecoin\",\"NVST\":\"NVO Token\",\"NXT\":\"NXT\",\"OMNI\":\"OMNI\",\"PINK\":\"PinkCoin\",\"PIVX\":\"PIVX\",\"POT\":\"PotCoin\",\"PPC\":\"Peercoin\",\"PROC\":\"ProCurrency\",\"PURA\":\"PURA\",\"QTUM\":\"QTUM\",\"RES\":\"Resistance\",\"RVN\":\"Ravencoin\",\"RVR\":\"RevolutionVR\",\"SBD\":\"Steem Dollars\",\"SMART\":\"SmartCash\",\"SOXAX\":\"SOXAX\",\"STEEM\":\"STEEM\",\"STRAT\":\"STRAT\",\"SYS\":\"Syscoin\",\"TPAY\":\"TokenPay\",\"TRIGGERS\":\"Triggers\",\"TRX\":\" TRON\",\"UBQ\":\"Ubiq\",\"UNIT\":\"UniversalCurrency\",\"USDT\":\"Tether USD (Omni Layer)\",\"USDT.BEP20\":\"Tether USD (BSC Chain)\",\"USDT.ERC20\":\"Tether USD (ERC20)\",\"USDT.TRC20\":\"Tether USD (Tron/TRC20)\",\"VTC\":\"Vertcoin\",\"WAVES\":\"Waves\",\"XCP\":\"Counterparty\",\"XEM\":\"NEM\",\"XMR\":\"Monero\",\"XSN\":\"Stakenet\",\"XSR\":\"SucreCoin\",\"XVG\":\"VERGE\",\"XZC\":\"ZCoin\",\"ZEC\":\"ZCash\",\"ZEN\":\"Horizen\"}', 1, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 02:07:14'),
(16, 0, 504, 'CoinPayments Fiat', 'CoinpaymentsFiat', 1, '{\"merchant_id\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"6515561\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CLP\":\"CLP\",\"CNY\":\"CNY\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"ISK\":\"ISK\",\"JPY\":\"JPY\",\"KRW\":\"KRW\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"RUB\":\"RUB\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TWD\":\"TWD\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 02:07:44'),
(17, 0, 505, 'Coingate', 'Coingate', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"6354mwVCEw5kHzRJ6thbGo-N\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2022-03-30 09:24:57'),
(18, 0, 506, 'Coinbase Commerce', 'CoinbaseCommerce', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"c47cd7df-d8e8-424b-a20a\"},\"secret\":{\"title\":\"Webhook Shared Secret\",\"global\":true,\"value\":\"55871878-2c32-4f64-ab66\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\",\"JPY\":\"JPY\",\"GBP\":\"GBP\",\"AUD\":\"AUD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CNY\":\"CNY\",\"SEK\":\"SEK\",\"NZD\":\"NZD\",\"MXN\":\"MXN\",\"SGD\":\"SGD\",\"HKD\":\"HKD\",\"NOK\":\"NOK\",\"KRW\":\"KRW\",\"TRY\":\"TRY\",\"RUB\":\"RUB\",\"INR\":\"INR\",\"BRL\":\"BRL\",\"ZAR\":\"ZAR\",\"AED\":\"AED\",\"AFN\":\"AFN\",\"ALL\":\"ALL\",\"AMD\":\"AMD\",\"ANG\":\"ANG\",\"AOA\":\"AOA\",\"ARS\":\"ARS\",\"AWG\":\"AWG\",\"AZN\":\"AZN\",\"BAM\":\"BAM\",\"BBD\":\"BBD\",\"BDT\":\"BDT\",\"BGN\":\"BGN\",\"BHD\":\"BHD\",\"BIF\":\"BIF\",\"BMD\":\"BMD\",\"BND\":\"BND\",\"BOB\":\"BOB\",\"BSD\":\"BSD\",\"BTN\":\"BTN\",\"BWP\":\"BWP\",\"BYN\":\"BYN\",\"BZD\":\"BZD\",\"CDF\":\"CDF\",\"CLF\":\"CLF\",\"CLP\":\"CLP\",\"COP\":\"COP\",\"CRC\":\"CRC\",\"CUC\":\"CUC\",\"CUP\":\"CUP\",\"CVE\":\"CVE\",\"CZK\":\"CZK\",\"DJF\":\"DJF\",\"DKK\":\"DKK\",\"DOP\":\"DOP\",\"DZD\":\"DZD\",\"EGP\":\"EGP\",\"ERN\":\"ERN\",\"ETB\":\"ETB\",\"FJD\":\"FJD\",\"FKP\":\"FKP\",\"GEL\":\"GEL\",\"GGP\":\"GGP\",\"GHS\":\"GHS\",\"GIP\":\"GIP\",\"GMD\":\"GMD\",\"GNF\":\"GNF\",\"GTQ\":\"GTQ\",\"GYD\":\"GYD\",\"HNL\":\"HNL\",\"HRK\":\"HRK\",\"HTG\":\"HTG\",\"HUF\":\"HUF\",\"IDR\":\"IDR\",\"ILS\":\"ILS\",\"IMP\":\"IMP\",\"IQD\":\"IQD\",\"IRR\":\"IRR\",\"ISK\":\"ISK\",\"JEP\":\"JEP\",\"JMD\":\"JMD\",\"JOD\":\"JOD\",\"KES\":\"KES\",\"KGS\":\"KGS\",\"KHR\":\"KHR\",\"KMF\":\"KMF\",\"KPW\":\"KPW\",\"KWD\":\"KWD\",\"KYD\":\"KYD\",\"KZT\":\"KZT\",\"LAK\":\"LAK\",\"LBP\":\"LBP\",\"LKR\":\"LKR\",\"LRD\":\"LRD\",\"LSL\":\"LSL\",\"LYD\":\"LYD\",\"MAD\":\"MAD\",\"MDL\":\"MDL\",\"MGA\":\"MGA\",\"MKD\":\"MKD\",\"MMK\":\"MMK\",\"MNT\":\"MNT\",\"MOP\":\"MOP\",\"MRO\":\"MRO\",\"MUR\":\"MUR\",\"MVR\":\"MVR\",\"MWK\":\"MWK\",\"MYR\":\"MYR\",\"MZN\":\"MZN\",\"NAD\":\"NAD\",\"NGN\":\"NGN\",\"NIO\":\"NIO\",\"NPR\":\"NPR\",\"OMR\":\"OMR\",\"PAB\":\"PAB\",\"PEN\":\"PEN\",\"PGK\":\"PGK\",\"PHP\":\"PHP\",\"PKR\":\"PKR\",\"PLN\":\"PLN\",\"PYG\":\"PYG\",\"QAR\":\"QAR\",\"RON\":\"RON\",\"RSD\":\"RSD\",\"RWF\":\"RWF\",\"SAR\":\"SAR\",\"SBD\":\"SBD\",\"SCR\":\"SCR\",\"SDG\":\"SDG\",\"SHP\":\"SHP\",\"SLL\":\"SLL\",\"SOS\":\"SOS\",\"SRD\":\"SRD\",\"SSP\":\"SSP\",\"STD\":\"STD\",\"SVC\":\"SVC\",\"SYP\":\"SYP\",\"SZL\":\"SZL\",\"THB\":\"THB\",\"TJS\":\"TJS\",\"TMT\":\"TMT\",\"TND\":\"TND\",\"TOP\":\"TOP\",\"TTD\":\"TTD\",\"TWD\":\"TWD\",\"TZS\":\"TZS\",\"UAH\":\"UAH\",\"UGX\":\"UGX\",\"UYU\":\"UYU\",\"UZS\":\"UZS\",\"VEF\":\"VEF\",\"VND\":\"VND\",\"VUV\":\"VUV\",\"WST\":\"WST\",\"XAF\":\"XAF\",\"XAG\":\"XAG\",\"XAU\":\"XAU\",\"XCD\":\"XCD\",\"XDR\":\"XDR\",\"XOF\":\"XOF\",\"XPD\":\"XPD\",\"XPF\":\"XPF\",\"XPT\":\"XPT\",\"YER\":\"YER\",\"ZMW\":\"ZMW\",\"ZWL\":\"ZWL\"}\r\n\r\n', 0, '{\"endpoint\":{\"title\": \"Webhook Endpoint\",\"value\":\"ipn.CoinbaseCommerce\"}}', NULL, '2019-09-14 13:14:22', '2021-05-21 02:02:47'),
(24, 0, 113, 'Paypal Express', 'PaypalSdk', 1, '{\"clientId\":{\"title\":\"Paypal Client ID\",\"global\":true,\"value\":\"Ae0-tixtSV7DvLwIh3Bmu7JvHrjh5EfGdXr_cEklKAVjjezRZ747BxKILiBdzlKKyp-W8W_T7CKH1Ken\"},\"clientSecret\":{\"title\":\"Client Secret\",\"global\":true,\"value\":\"EOhbvHZgFNO21soQJT1L9Q00M3rK6PIEsdiTgXRBt2gtGtxwRer5JvKnVUGNU5oE63fFnjnYY7hq3HBA\"}}', '{\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"TWD\":\"TWD\",\"NZD\":\"NZD\",\"NOK\":\"NOK\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"GBP\":\"GBP\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"USD\":\"$\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2021-05-20 23:01:08'),
(25, 0, 114, 'Stripe Checkout', 'StripeV3', 1, '{\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"sk_test_51I6GGiCGv1sRiQlEi5v1or9eR0HVbuzdMd2rW4n3DxC8UKfz66R4X6n4yYkzvI2LeAIuRU9H99ZpY7XCNFC9xMs500vBjZGkKG\"},\"publishable_key\":{\"title\":\"PUBLISHABLE KEY\",\"global\":true,\"value\":\"pk_test_51I6GGiCGv1sRiQlEOisPKrjBqQqqcFsw8mXNaZ2H2baN6R01NulFS7dKFji1NRRxuchoUTEDdB7ujKcyKYSVc0z500eth7otOM\"},\"end_point\":{\"title\":\"End Point Secret\",\"global\":true,\"value\":\"whsec_lUmit1gtxwKTveLnSe88xCSDdnPOt8g5\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"SGD\":\"SGD\"}', 0, '{\"webhook\":{\"title\": \"Webhook Endpoint\",\"value\":\"ipn.StripeV3\"}}', NULL, '2019-09-14 13:14:22', '2021-05-21 00:58:38'),
(27, 0, 115, 'Mollie', 'Mollie', 1, '{\"mollie_email\":{\"title\":\"Mollie Email \",\"global\":true,\"value\":\"vi@gmail.com\"},\"api_key\":{\"title\":\"API KEY\",\"global\":true,\"value\":\"test_cucfwKTWfft9s337qsVfn5CC4vNkrn\"}}', '{\"AED\":\"AED\",\"AUD\":\"AUD\",\"BGN\":\"BGN\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"HRK\":\"HRK\",\"HUF\":\"HUF\",\"ILS\":\"ILS\",\"ISK\":\"ISK\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"RON\":\"RON\",\"RUB\":\"RUB\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TWD\":\"TWD\",\"USD\":\"USD\",\"ZAR\":\"ZAR\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 02:44:45'),
(30, 0, 116, 'Cashmaal', 'Cashmaal', 1, '{\"web_id\":{\"title\":\"Web Id\",\"global\":true,\"value\":\"3748\"},\"ipn_key\":{\"title\":\"IPN Key\",\"global\":true,\"value\":\"546254628759524554647987\"}}', '{\"PKR\":\"PKR\",\"USD\":\"USD\"}', 0, '{\"webhook\":{\"title\": \"IPN URL\",\"value\":\"ipn.Cashmaal\"}}', NULL, NULL, '2021-06-22 08:05:04'),
(36, 0, 119, 'Mercado Pago', 'MercadoPago', 1, '{\"access_token\":{\"title\":\"Access Token\",\"global\":true,\"value\":\"APP_USR-7924565816849832-082312-21941521997fab717db925cf1ea2c190-1071840315\"}}', '{\"USD\":\"USD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"NOK\":\"NOK\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"AUD\":\"AUD\",\"NZD\":\"NZD\"}', 0, NULL, NULL, NULL, '2022-09-14 07:41:14'),
(37, 0, 120, 'Authorize.net', 'Authorize', 1, '{\"login_id\":{\"title\":\"Login ID\",\"global\":true,\"value\":\"59e4P9DBcZv\"},\"transaction_key\":{\"title\":\"Transaction Key\",\"global\":true,\"value\":\"47x47TJyLw2E7DbR\"}}', '{\"USD\":\"USD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"NOK\":\"NOK\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"AUD\":\"AUD\",\"NZD\":\"NZD\"}', 0, NULL, NULL, NULL, '2022-08-28 09:33:06'),
(46, 0, 121, 'NMI', 'NMI', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"2F822Rw39fx762MaV7Yy86jXGTC7sCDy\"}}', '{\"AED\":\"AED\",\"ARS\":\"ARS\",\"AUD\":\"AUD\",\"BOB\":\"BOB\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CLP\":\"CLP\",\"CNY\":\"CNY\",\"COP\":\"COP\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"IDR\":\"IDR\",\"ILS\":\"ILS\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"KRW\":\"KRW\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PEN\":\"PEN\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"PYG\":\"PYG\",\"RUB\":\"RUB\",\"SEC\":\"SEC\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TRY\":\"TRY\",\"TWD\":\"TWD\",\"USD\":\"USD\",\"ZAR\":\"ZAR\"}', 0, NULL, NULL, NULL, '2022-08-28 10:32:31'),
(51, 0, 122, 'BTCPay', 'BTCPay', 1, '{\"store_id\":{\"title\":\"Store Id\",\"global\":true,\"value\":\"-------\"},\"api_key\":{\"title\":\"Api Key\",\"global\":true,\"value\":\"------\"},\"server_name\":{\"title\":\"Server Name\",\"global\":true,\"value\":\"https:\\/\\/yourbtcpaserver.lndyn.com\"},\"secret_code\":{\"title\":\"Secret Code\",\"global\":true,\"value\":\"----------\"}}', '{\"BTC\":\"Bitcoin\",\"LTC\":\"Litecoin\"}', 1, '{\"webhook\":{\"title\": \"IPN URL\",\"value\":\"ipn.BTCPay\"}}', NULL, NULL, NULL),
(52, 0, 123, 'Now payments hosted', 'NowPaymentsHosted', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"-------------------\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"--------------\"}}', '{\"BTG\":\"BTG\",\"ETH\":\"ETH\",\"XMR\":\"XMR\",\"ZEC\":\"ZEC\",\"XVG\":\"XVG\",\"ADA\":\"ADA\",\"LTC\":\"LTC\",\"BCH\":\"BCH\",\"QTUM\":\"QTUM\",\"DASH\":\"DASH\",\"XLM\":\"XLM\",\"XRP\":\"XRP\",\"XEM\":\"XEM\",\"DGB\":\"DGB\",\"LSK\":\"LSK\",\"DOGE\":\"DOGE\",\"TRX\":\"TRX\",\"KMD\":\"KMD\",\"REP\":\"REP\",\"BAT\":\"BAT\",\"ARK\":\"ARK\",\"WAVES\":\"WAVES\",\"BNB\":\"BNB\",\"XZC\":\"XZC\",\"NANO\":\"NANO\",\"TUSD\":\"TUSD\",\"VET\":\"VET\",\"ZEN\":\"ZEN\",\"GRS\":\"GRS\",\"FUN\":\"FUN\",\"NEO\":\"NEO\",\"GAS\":\"GAS\",\"PAX\":\"PAX\",\"USDC\":\"USDC\",\"ONT\":\"ONT\",\"XTZ\":\"XTZ\",\"LINK\":\"LINK\",\"RVN\":\"RVN\",\"BNBMAINNET\":\"BNBMAINNET\",\"ZIL\":\"ZIL\",\"BCD\":\"BCD\",\"USDT\":\"USDT\",\"USDTERC20\":\"USDTERC20\",\"CRO\":\"CRO\",\"DAI\":\"DAI\",\"HT\":\"HT\",\"WABI\":\"WABI\",\"BUSD\":\"BUSD\",\"ALGO\":\"ALGO\",\"USDTTRC20\":\"USDTTRC20\",\"GT\":\"GT\",\"STPT\":\"STPT\",\"AVA\":\"AVA\",\"SXP\":\"SXP\",\"UNI\":\"UNI\",\"OKB\":\"OKB\",\"BTC\":\"BTC\"}', 1, '', NULL, NULL, '2023-02-14 04:42:09'),
(53, 0, 509, 'Now payments checkout', 'NowPaymentsCheckout', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"-------------------\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"--------------\"}}', '{\"BTG\":\"BTG\",\"ETH\":\"ETH\",\"XMR\":\"XMR\",\"ZEC\":\"ZEC\",\"XVG\":\"XVG\",\"ADA\":\"ADA\",\"LTC\":\"LTC\",\"BCH\":\"BCH\",\"QTUM\":\"QTUM\",\"DASH\":\"DASH\",\"XLM\":\"XLM\",\"XRP\":\"XRP\",\"XEM\":\"XEM\",\"DGB\":\"DGB\",\"LSK\":\"LSK\",\"DOGE\":\"DOGE\",\"TRX\":\"TRX\",\"KMD\":\"KMD\",\"REP\":\"REP\",\"BAT\":\"BAT\",\"ARK\":\"ARK\",\"WAVES\":\"WAVES\",\"BNB\":\"BNB\",\"XZC\":\"XZC\",\"NANO\":\"NANO\",\"TUSD\":\"TUSD\",\"VET\":\"VET\",\"ZEN\":\"ZEN\",\"GRS\":\"GRS\",\"FUN\":\"FUN\",\"NEO\":\"NEO\",\"GAS\":\"GAS\",\"PAX\":\"PAX\",\"USDC\":\"USDC\",\"ONT\":\"ONT\",\"XTZ\":\"XTZ\",\"LINK\":\"LINK\",\"RVN\":\"RVN\",\"BNBMAINNET\":\"BNBMAINNET\",\"ZIL\":\"ZIL\",\"BCD\":\"BCD\",\"USDT\":\"USDT\",\"USDTERC20\":\"USDTERC20\",\"CRO\":\"CRO\",\"DAI\":\"DAI\",\"HT\":\"HT\",\"WABI\":\"WABI\",\"BUSD\":\"BUSD\",\"ALGO\":\"ALGO\",\"USDTTRC20\":\"USDTTRC20\",\"GT\":\"GT\",\"STPT\":\"STPT\",\"AVA\":\"AVA\",\"SXP\":\"SXP\",\"UNI\":\"UNI\",\"OKB\":\"OKB\",\"BTC\":\"BTC\"}', 1, '', NULL, NULL, '2023-02-14 04:42:09'),
(54, 0, 122, '2Checkout', 'TwoCheckout', 1, '{\"merchant_code\": {\"title\": \"Merchant Code\",\"global\": true,\"value\": \"---------\"},\"secret_key\": {\"title\": \"Secret Key\",\"global\": true,\"value\": \"--------\"}}', '{\"AFN\": \"AFN\",\"ALL\": \"ALL\",\"DZD\": \"DZD\",\"ARS\": \"ARS\",\"AUD\": \"AUD\",\"AZN\": \"AZN\",\"BSD\": \"BSD\",\"BDT\": \"BDT\",\"BBD\": \"BBD\",\"BZD\": \"BZD\",\"BMD\": \"BMD\",\"BOB\": \"BOB\",\"BWP\": \"BWP\",\"BRL\": \"BRL\",\"GBP\": \"GBP\",\"BND\": \"BND\",\"BGN\": \"BGN\",\"CAD\": \"CAD\",\"CLP\": \"CLP\",\"CNY\": \"CNY\",\"COP\": \"COP\",\"CRC\": \"CRC\",\"HRK\": \"HRK\",\"CZK\": \"CZK\",\"DKK\": \"DKK\",\"DOP\": \"DOP\",\"XCD\": \"XCD\",\"EGP\": \"EGP\",\"EUR\": \"EUR\",\"FJD\": \"FJD\",\"GTQ\": \"GTQ\",\"HKD\": \"HKD\",\"HNL\": \"HNL\",\"HUF\": \"HUF\",\"INR\": \"INR\",\"IDR\": \"IDR\",\"ILS\": \"ILS\",\"JMD\": \"JMD\",\"JPY\": \"JPY\",\"KZT\": \"KZT\",\"KES\": \"KES\",\"LAK\": \"LAK\",\"MMK\": \"MMK\",\"LBP\": \"LBP\",\"LRD\": \"LRD\",\"MOP\": \"MOP\",\"MYR\": \"MYR\",\"MVR\": \"MVR\",\"MRO\": \"MRO\",\"MUR\": \"MUR\",\"MXN\": \"MXN\",\"MAD\": \"MAD\",\"NPR\": \"NPR\",\"TWD\": \"TWD\",\"NZD\": \"NZD\",\"NIO\": \"NIO\",\"NOK\": \"NOK\",\"PKR\": \"PKR\",\"PGK\": \"PGK\",\"PEN\": \"PEN\",\"PHP\": \"PHP\",\"PLN\": \"PLN\",\"QAR\": \"QAR\",\"RON\": \"RON\",\"RUB\": \"RUB\",\"WST\": \"WST\",\"SAR\": \"SAR\",\"SCR\": \"SCR\",\"SGD\": \"SGD\",\"SBD\": \"SBD\",\"ZAR\": \"ZAR\",\"KRW\": \"KRW\",\"LKR\": \"LKR\",\"SEK\": \"SEK\",\"CHF\": \"CHF\",\"SYP\": \"SYP\",\"THB\": \"THB\",\"TOP\": \"TOP\",\"TTD\": \"TTD\",\"TRY\": \"TRY\",\"UAH\": \"UAH\",\"AED\": \"AED\",\"USD\": \"USD\",\"VUV\": \"VUV\",\"VND\": \"VND\",\"XOF\": \"XOF\",\"YER\": \"YER\"}', 1, '{\"approved_url\":{\"title\": \"Approved URL\",\"value\":\"ipn.TwoCheckout\"}}', NULL, NULL, '2023-02-14 04:42:09'),
(55, 0, 123, 'Checkout', 'Checkout', 1, '{\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"sk_f7f9a069-dcc5-45d8-aa72-e60f605c9514\"},\"public_key\":{\"title\":\"PUBLIC KEY\",\"global\":true,\"value\":\"pk_66e19b3f-a431-44ff-823f-d773d960f6b9\"},\"processing_channel_id\":{\"title\":\"PROCESSING CHANNEL\",\"global\":true,\"value\":\"---\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"AUD\":\"AUD\",\"CAN\":\"CAN\",\"CHF\":\"CHF\",\"SGD\":\"SGD\",\"JPY\":\"JPY\",\"NZD\":\"NZD\"}', 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gateway_currencies`
--

CREATE TABLE `gateway_currencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `symbol` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `method_code` int(10) DEFAULT NULL,
  `gateway_alias` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_amount` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `max_amount` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `percent_charge` decimal(5,2) NOT NULL DEFAULT 0.00,
  `fixed_charge` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `rate` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gateway_parameter` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `site_name` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cur_text` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'currency text',
  `cur_sym` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'currency symbol',
  `email_from` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_template` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_body` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_from` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `base_color` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_config` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'email configuration',
  `sms_config` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `global_shortcodes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kv` tinyint(1) NOT NULL DEFAULT 0,
  `ev` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'email verification, 0 - dont check, 1 - check',
  `en` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'email notification, 0 - dont send, 1 - send',
  `sv` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'mobile verication, 0 - dont check, 1 - check',
  `sn` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'sms notification, 0 - dont send, 1 - send',
  `tax` decimal(5,2) NOT NULL DEFAULT 0.00,
  `tax_name` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `multi_language` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1⇾Enable, 0⇾Disable',
  `maintenance_mode` tinyint(4) NOT NULL DEFAULT 1,
  `force_ssl` tinyint(1) NOT NULL DEFAULT 0,
  `secure_password` tinyint(1) NOT NULL DEFAULT 0,
  `agree` tinyint(1) NOT NULL DEFAULT 0,
  `registration` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: Off	, 1: On',
  `active_template` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `system_info` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checkin_time` time DEFAULT NULL,
  `checkout_time` time DEFAULT NULL,
  `upcoming_checkin_days` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `upcoming_checkout_days` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `site_name`, `cur_text`, `cur_sym`, `email_from`, `email_template`, `sms_body`, `sms_from`, `base_color`, `mail_config`, `sms_config`, `global_shortcodes`, `kv`, `ev`, `en`, `sv`, `sn`, `tax`, `tax_name`, `multi_language`, `maintenance_mode`, `force_ssl`, `secure_password`, `agree`, `registration`, `active_template`, `system_info`, `checkin_time`, `checkout_time`, `upcoming_checkin_days`, `upcoming_checkout_days`, `created_at`, `updated_at`) VALUES
(1, 'Viser Hotel', 'USD', '$', 'info@viserlab.com', '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n  <!--[if !mso]><!-->\r\n  <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\r\n  <!--<![endif]-->\r\n  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n  <title></title>\r\n  <style type=\"text/css\">\r\n.ReadMsgBody { width: 100%; background-color: #ffffff; }\r\n.ExternalClass { width: 100%; background-color: #ffffff; }\r\n.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div { line-height: 100%; }\r\nhtml { width: 100%; }\r\nbody { -webkit-text-size-adjust: none; -ms-text-size-adjust: none; margin: 0; padding: 0; }\r\ntable { border-spacing: 0; table-layout: fixed; margin: 0 auto;border-collapse: collapse; }\r\ntable table table { table-layout: auto; }\r\n.yshortcuts a { border-bottom: none !important; }\r\nimg:hover { opacity: 0.9 !important; }\r\na { color: #0087ff; text-decoration: none; }\r\n.textbutton a { font-family: \'open sans\', arial, sans-serif !important;}\r\n.btn-link a { color:#FFFFFF !important;}\r\n\r\n@media only screen and (max-width: 480px) {\r\nbody { width: auto !important; }\r\n*[class=\"table-inner\"] { width: 90% !important; text-align: center !important; }\r\n*[class=\"table-full\"] { width: 100% !important; text-align: center !important; }\r\n/* image */\r\nimg[class=\"img1\"] { width: 100% !important; height: auto !important; }\r\n}\r\n</style>\r\n\r\n\r\n\r\n  <table bgcolor=\"#414a51\" width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n    <tbody><tr>\r\n      <td height=\"50\"></td>\r\n    </tr>\r\n    <tr>\r\n      <td align=\"center\" style=\"text-align:center;vertical-align:top;font-size:0;\">\r\n        <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n          <tbody><tr>\r\n            <td align=\"center\" width=\"600\">\r\n              <!--header-->\r\n              <table class=\"table-inner\" width=\"95%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n                <tbody><tr>\r\n                  <td bgcolor=\"#0087ff\" style=\"border-top-left-radius:6px; border-top-right-radius:6px;text-align:center;vertical-align:top;font-size:0;\" align=\"center\">\r\n                    <table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n                      <tbody><tr>\r\n                        <td height=\"20\"></td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td align=\"center\" style=\"font-family: \'Open sans\', Arial, sans-serif; color:#FFFFFF; font-size:16px; font-weight: bold;\">This is a System Generated Email</td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td height=\"20\"></td>\r\n                      </tr>\r\n                    </tbody></table>\r\n                  </td>\r\n                </tr>\r\n              </tbody></table>\r\n              <!--end header-->\r\n              <table class=\"table-inner\" width=\"95%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                <tbody><tr>\r\n                  <td bgcolor=\"#FFFFFF\" align=\"center\" style=\"text-align:center;vertical-align:top;font-size:0;\">\r\n                    <table align=\"center\" width=\"90%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                      <tbody><tr>\r\n                        <td height=\"35\"></td>\r\n                      </tr>\r\n                      <!--logo-->\r\n                      <tr>\r\n                        <td align=\"center\" style=\"vertical-align:top;font-size:0;\">\r\n                          <a href=\"#\">\r\n                            <img style=\"display:block; line-height:0px; font-size:0px; border:0px;\" src=\"https://i.imgur.com/Z1qtvtV.png\" alt=\"img\">\r\n                          </a>\r\n                        </td>\r\n                      </tr>\r\n                      <!--end logo-->\r\n                      <tr>\r\n                        <td height=\"40\"></td>\r\n                      </tr>\r\n                      <!--headline-->\r\n                      <tr>\r\n                        <td align=\"center\" style=\"font-family: \'Open Sans\', Arial, sans-serif; font-size: 22px;color:#414a51;font-weight: bold;\">Hello {{fullname}} ({{username}})</td>\r\n                      </tr>\r\n                      <!--end headline-->\r\n                      <tr>\r\n                        <td align=\"center\" style=\"text-align:center;vertical-align:top;font-size:0;\">\r\n                          <table width=\"40\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n                            <tbody><tr>\r\n                              <td height=\"20\" style=\" border-bottom:3px solid #0087ff;\"></td>\r\n                            </tr>\r\n                          </tbody></table>\r\n                        </td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td height=\"20\"></td>\r\n                      </tr>\r\n                      <!--content-->\r\n                      <tr>\r\n                        <td align=\"left\" style=\"font-family: \'Open sans\', Arial, sans-serif; color:#7f8c8d; font-size:16px; line-height: 28px;\">{{message}}</td>\r\n                      </tr>\r\n                      <!--end content-->\r\n                      <tr>\r\n                        <td height=\"40\"></td>\r\n                      </tr>\r\n              \r\n                    </tbody></table>\r\n                  </td>\r\n                </tr>\r\n                <tr>\r\n                  <td height=\"45\" align=\"center\" bgcolor=\"#f4f4f4\" style=\"border-bottom-left-radius:6px;border-bottom-right-radius:6px;\">\r\n                    <table align=\"center\" width=\"90%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                      <tbody><tr>\r\n                        <td height=\"10\"></td>\r\n                      </tr>\r\n                      <!--preference-->\r\n                      <tr>\r\n                        <td class=\"preference-link\" align=\"center\" style=\"font-family: \'Open sans\', Arial, sans-serif; color:#95a5a6; font-size:14px;\">\r\n                          © 2021 <a href=\"#\">Website Name</a> . All Rights Reserved. \r\n                        </td>\r\n                      </tr>\r\n                      <!--end preference-->\r\n                      <tr>\r\n                        <td height=\"10\"></td>\r\n                      </tr>\r\n                    </tbody></table>\r\n                  </td>\r\n                </tr>\r\n              </tbody></table>\r\n            </td>\r\n          </tr>\r\n        </tbody></table>\r\n      </td>\r\n    </tr>\r\n    <tr>\r\n      <td height=\"60\"></td>\r\n    </tr>\r\n  </tbody></table>', 'hi {{fullname}} ({{username}}), {{message}}', 'SMS From Viserlab Admin', 'ab8a62', '{\"name\":\"php\"}', '{\"name\":\"clickatell\",\"clickatell\":{\"api_key\":\"----------------\"},\"infobip\":{\"username\":\"------------\",\"password\":\"-----------------\"},\"message_bird\":{\"api_key\":\"-------------------\"},\"nexmo\":{\"api_key\":\"----------------------\",\"api_secret\":\"----------------------\"},\"sms_broadcast\":{\"username\":\"----------------------\",\"password\":\"-----------------------------\"},\"twilio\":{\"account_sid\":\"-----------------------\",\"auth_token\":\"---------------------------\",\"from\":\"----------------------\"},\"text_magic\":{\"username\":\"-----------------------\",\"apiv2_key\":\"-------------------------------\"},\"custom\":{\"method\":\"get\",\"url\":\"https:\\/\\/hostname\\/demo-api-v1\",\"headers\":{\"name\":[\"api_key\"],\"value\":[\"test_api 555\"]},\"body\":{\"name\":[\"from_number\"],\"value\":[\"5657545757\"]}}}', '{\n    \"site_name\":\"Name of your site\",\n    \"site_currency\":\"Currency of your site\",\n    \"currency_symbol\":\"Symbol of currency\"\n}', 0, 1, 1, 0, 1, 10.00, 'Tax', 0, 0, 0, 0, 1, 1, 'basic', '[]', '12:00:00', '12:00:00', 3, 5, NULL, '2023-06-01 07:23:16');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: not default language, 1: default language',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification_logs`
--

CREATE TABLE `notification_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `sender` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sent_from` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sent_to` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notification_type` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification_templates`
--

CREATE TABLE `notification_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `act` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subj` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_body` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_body` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shortcodes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_status` tinyint(1) NOT NULL DEFAULT 1,
  `sms_status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification_templates`
--

INSERT INTO `notification_templates` (`id`, `act`, `name`, `subj`, `email_body`, `sms_body`, `shortcodes`, `email_status`, `sms_status`, `created_at`, `updated_at`) VALUES
(3, 'DIRECT_PAYMENT_SUCCESSFUL', 'Payment- Automated - Successful', 'Payment Completed Successfully', '<div>Your payment for&nbsp;<span style=\"font-weight: 700; font-size: 1rem; text-align: var(--bs-body-text-align);\">{{booking_number}}</span><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">&nbsp;of&nbsp;</span><span style=\"font-size: 1rem; text-align: var(--bs-body-text-align); font-weight: bolder;\">{{amount}} {{site_currency}}</span><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">&nbsp;via&nbsp;&nbsp;</span><span style=\"font-size: 1rem; text-align: var(--bs-body-text-align); font-weight: bolder;\">{{method_name}}&nbsp;</span><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">has&nbsp; been completed Successfully.</span></div><div><span style=\"font-weight: bolder;\"><br></span></div><div><span style=\"font-weight: bolder;\">Details of your payment:<br></span></div><div><br></div><div>Amount : {{amount}} {{site_currency}}</div><div>Charge:&nbsp;<font color=\"#000000\">{{charge}} {{site_currency}}</font></div><div><br></div><div>Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div>Payable : {{method_amount}} {{method_currency}}<br></div><div>Paid via :&nbsp; {{method_name}}</div><div><br style=\"font-family: Montserrat, sans-serif;\"></div>', '{{amount}} {{site_currency}} payment successfully by {{method_name}}', '{\r\n                \"booking_number\":\"Booking Number\",\r\n                \"amount\":\"Amount inserted by the user\",\r\n                \"charge\":\"Gateway charge set by the admin\",\r\n                \"rate\":\"Conversion rate between base currency and method currency\",\r\n                \"method_name\":\"Name of the deposit method\",\r\n                \"method_currency\":\"Currency of the deposit method\",\r\n                \"method_amount\":\"Amount after conversion between base currency and method currency\"\r\n            }', 1, 1, '2021-11-03 12:00:00', '2022-06-29 22:41:04'),
(4, 'PAYMENT_MANUAL_APPROVED', 'Payment - Manual - Approved', 'Your Payment is Approved', '<div style=\"font-family: Montserrat, sans-serif;\">Your payment request&nbsp;<span style=\"color: rgb(33, 37, 41); font-family: Poppins, sans-serif; font-size: 1rem; text-align: var(--bs-body-text-align);\">for&nbsp;</span><span style=\"font-family: Poppins, sans-serif; font-size: 1rem; text-align: var(--bs-body-text-align); font-weight: 700;\">{{booking_number}}</span><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">&nbsp;of&nbsp;</span><span style=\"font-size: 1rem; text-align: var(--bs-body-text-align); font-weight: bolder;\">{{amount}}{{site_currency}}</span><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">&nbsp;via&nbsp;&nbsp;</span><span style=\"font-size: 1rem; text-align: var(--bs-body-text-align); font-weight: bolder;\">{{method_name}}&nbsp;</span><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">is Approved .</span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\">Details of your payment:<br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Amount : {{amount}} {{site_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">Charge:&nbsp;<font color=\"#FF0000\">{{charge}} {{site_currency}}</font></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">Payable : {{method_amount}} {{method_currency}}<br></div><div style=\"font-family: Montserrat, sans-serif;\">Paid via :&nbsp; {{method_name}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div>', 'Management Approve Your {{amount}} {{method_currency}} payment request by {{method_name}} Booking Number: {{booking_number}}', '{\"booking_number\":\"Booking Number\",\"amount\":\"Amount inserted by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the deposit method\",\"method_currency\":\"Currency of the deposit method\",\"method_amount\":\"Amount after conversion between base currency and method currency\",\"post_balance\":\"Balance of the user after this transaction\"}', 1, 1, '2021-11-03 12:00:00', '2022-06-29 22:42:35'),
(6, 'PAYMENT_MANUAL_REQUEST', 'Payment - Manual - Requested', 'Payment Request Submitted Successfully', '<div>Your payment request&nbsp;<span style=\"color: rgb(33, 37, 41); font-size: 1rem; text-align: var(--bs-body-text-align);\">for&nbsp;</span><span style=\"font-size: 1rem; text-align: var(--bs-body-text-align); font-weight: 700;\">{{booking_number}}</span><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">&nbsp;of&nbsp;</span><span style=\"font-size: 1rem; text-align: var(--bs-body-text-align); font-weight: bolder;\">{{amount}} {{site_currency}}</span><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">&nbsp;via&nbsp;&nbsp;</span><span style=\"font-size: 1rem; text-align: var(--bs-body-text-align); font-weight: bolder;\">{{method_name}}&nbsp;</span><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">submitted successfully</span><span style=\"font-size: 1rem; text-align: var(--bs-body-text-align); font-weight: bolder;\">&nbsp;.</span></div><div><span style=\"font-weight: bolder;\"><br></span></div><div><span style=\"font-weight: bolder;\">Details of your payment:<br></span></div><div><br></div><div>Amount : {{amount}} {{site_currency}}</div><div>Charge:&nbsp;<font color=\"#FF0000\">{{charge}} {{site_currency}}</font></div><div><br></div><div>Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div>Payable : {{method_amount}} {{method_currency}}<br></div><div>Pay via :&nbsp; {{method_name}}</div><div><br></div><div><br style=\"font-family: Montserrat, sans-serif;\"></div>', '{{amount}} Payment requested by {{method_name}}. Charge: {{charge}} . Booking Number: {{booking_number}}', '{\"booking_number\":\"Transaction number for the deposit\",\"amount\":\"Amount inserted by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the deposit method\",\"method_currency\":\"Currency of the deposit method\",\"method_amount\":\"Amount after conversion between base currency and method currency\"}', 1, 1, '2021-11-03 12:00:00', '2022-06-29 22:42:04'),
(7, 'PASS_RESET_CODE', 'Password - Reset - Code', 'Password Reset', '<div style=\"font-family: Montserrat, sans-serif;\">We have received a request to reset the password for your account on&nbsp;<span style=\"font-weight: bolder;\">{{time}} .<br></span></div><div style=\"font-family: Montserrat, sans-serif;\">Requested From IP:&nbsp;<span style=\"font-weight: bolder;\">{{ip}}</span>&nbsp;using&nbsp;<span style=\"font-weight: bolder;\">{{browser}}</span>&nbsp;on&nbsp;<span style=\"font-weight: bolder;\">{{operating_system}}&nbsp;</span>.</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><br style=\"font-family: Montserrat, sans-serif;\"><div style=\"font-family: Montserrat, sans-serif;\"><div>Your account recovery code is:&nbsp;&nbsp;&nbsp;<font size=\"6\"><span style=\"font-weight: bolder;\">{{code}}</span></font></div><div><br></div></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"4\" color=\"#CC0000\">If you do not wish to reset your password, please disregard this message.&nbsp;</font><br></div><div><font size=\"4\" color=\"#CC0000\"><br></font></div>', 'Your account recovery code is: {{code}}', '{\"code\":\"Verification code for password reset\",\"ip\":\"IP address of the user\",\"browser\":\"Browser of the user\",\"operating_system\":\"Operating system of the user\",\"time\":\"Time of the request\"}', 1, 0, '2021-11-03 12:00:00', '2022-03-20 20:47:05'),
(8, 'PASS_RESET_DONE', 'Password - Reset - Confirmation', 'You have Reset your password', '<p style=\"font-family: Montserrat, sans-serif;\">You have successfully reset your password.</p><p style=\"font-family: Montserrat, sans-serif;\">You changed from&nbsp; IP:&nbsp;<span style=\"font-weight: bolder;\">{{ip}}</span>&nbsp;using&nbsp;<span style=\"font-weight: bolder;\">{{browser}}</span>&nbsp;on&nbsp;<span style=\"font-weight: bolder;\">{{operating_system}}&nbsp;</span>&nbsp;on&nbsp;<span style=\"font-weight: bolder;\">{{time}}</span></p><p style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></p><p style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><font color=\"#ff0000\">If you did not changed that, Please contact with us as soon as possible.</font></span></p>', 'Your password has been changed successfully', '{\"ip\":\"IP address of the user\",\"browser\":\"Browser of the user\",\"operating_system\":\"Operating system of the user\",\"time\":\"Time of the request\"}', 1, 1, '2021-11-03 12:00:00', '2022-03-20 20:47:25'),
(9, 'ADMIN_SUPPORT_REPLY', 'Support - Reply', 'Reply Support Ticket', '<div><p><span data-mce-style=\"font-size: 11pt;\" style=\"font-size: 11pt;\"><span style=\"font-weight: bolder;\">A member from our support team has replied to the following ticket:</span></span></p><p><span style=\"font-weight: bolder;\"><span data-mce-style=\"font-size: 11pt;\" style=\"font-size: 11pt;\"><span style=\"font-weight: bolder;\"><br></span></span></span></p><p><span style=\"font-weight: bolder;\">[Ticket#{{ticket_id}}] {{ticket_subject}}<br><br>Click here to reply:&nbsp; {{link}}</span></p><p>----------------------------------------------</p><p>Here is the reply :<br></p><p>{{reply}}<br></p></div><div><br style=\"font-family: Montserrat, sans-serif;\"></div>', 'Your Ticket#{{ticket_id}} :  {{ticket_subject}} has been replied.', '{\"ticket_id\":\"ID of the support ticket\",\"ticket_subject\":\"Subject  of the support ticket\",\"reply\":\"Reply made by the admin\",\"link\":\"URL to view the support ticket\"}', 1, 1, '2021-11-03 12:00:00', '2022-03-20 20:47:51'),
(10, 'EVER_CODE', 'Verification - Email', 'Please verify your email address', '<br><div><div style=\"font-family: Montserrat, sans-serif;\">Thanks For join with us.<br></div><div style=\"font-family: Montserrat, sans-serif;\">Please use below code to verify your email address.<br></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Your email verification code is:<font size=\"6\"><span style=\"font-weight: bolder;\">&nbsp;{{code}}</span></font></div></div>', '---', '{\"code\":\"Email verification code\"}', 1, 0, '2021-11-03 12:00:00', '2022-03-20 20:49:35'),
(11, 'SVER_CODE', 'Verification - SMS', 'Verify Your Mobile Number', '---', 'Your phone verification code is: {{code}}', '{\"code\":\"SMS Verification Code\"}', 0, 1, '2021-11-03 12:00:00', '2022-03-20 19:24:37'),
(15, 'DEFAULT', 'Default Template', '{{subject}}', '{{message}}', '{{message}}', '{\"subject\":\"Subject\",\"message\":\"Message\"}', 1, 1, '2019-09-14 13:14:22', '2021-11-04 09:38:55'),
(18, 'ACCOUNT_CREATE', 'Account Create', 'Your account has been created', '<br><div><div style=\"font-family: Montserrat, sans-serif;\">Thanks For join with us.<br></div><div style=\"font-family: Montserrat, sans-serif;\">Now you can log in by this credentials:<br></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">username: {{username}}&nbsp;</div><div style=\"font-family: Montserrat, sans-serif;\">email: {{email}}</div><div style=\"font-family: Montserrat, sans-serif;\">password:{{password}}</div>\r\n</div>', '---', '{\"username\":\"username\", \r\n\"email\":\"email\", \"password\":\"password\"}', 1, 0, '2021-11-03 12:00:00', '2022-04-10 08:30:01'),
(19, 'ROOM_BOOKED', 'Room_booked', 'Your room has been booked.', '<div style=\"font-family: Montserrat, sans-serif;\">Thanks for booking rooms here.</div><div style=\"font-family: Montserrat, sans-serif;\">Booking Number: {{booking_number}},</div><div style=\"font-family: Montserrat, sans-serif;\">Total Amount:{{amount}}&nbsp;<span style=\"white-space: nowrap; font-family: Poppins, sans-serif; text-align: var(--bs-body-text-align);\"><font size=\"3\">{{site_currency}}</font></span><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">,</span></div><div style=\"\"><span style=\"font-family: Montserrat, sans-serif; color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">Paid Amount :&nbsp;</span><span style=\"text-align: var(--bs-body-text-align);\"><font color=\"#212529\" face=\"Montserrat, sans-serif\">{{paid_amount}}&nbsp;</font></span><span style=\"text-align: var(--bs-body-text-align);\"><font color=\"#212529\" face=\"Montserrat, sans-serif\">{{site_currency}}</font></span></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Check In Date : {{check_in}}</div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"color: rgb(33, 37, 41);\">Check Out Date : {{check_out}}</span><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"color: rgb(33, 37, 41);\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"3\"><u><b>Booked Rooms:</b></u></font></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"color: rgb(33, 37, 41);\">&nbsp;{{rooms}}</span><br></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"3\"><b style=\"\"><br></b></font></div>\r\n<div><div style=\"font-family: Montserrat, sans-serif;\">Thanks for being with us.</div></div>', 'Thanks for booking room here. Booking Number : {{booking_number}}, Paid Amount:{{paid_amount}} {{site_currency}} instead of \r\n Your booked rooms: {{rooms}} .', '{\"booking_number\":\"Booking number for the action\",\"amount\":\"Booking total amount\",\r\n\"paid_amount\":\"Paid amount for booking\", \"rooms\":\"booked rooms list\",\"check_in\":\"Check In date\", \"check_out\": \"Check Out Date\"}', 1, 0, '2021-11-03 12:00:00', '2023-05-15 08:43:02'),
(20, 'APPROVE_BOOKING_REQUEST', 'Booking Request Approve', 'Your Booking Request has been approved.', '<div><div style=\"font-family: Montserrat, sans-serif;\">Thanks for booking room here.</div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">Payable Amount:&nbsp;</span><span style=\"font-weight: bolder; font-family: Poppins, sans-serif; white-space: nowrap;\"><font size=\"3\">{{amount}}</font></span><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">&nbsp;</span><span style=\"font-size: 1rem; text-align: var(--bs-body-text-align); white-space: nowrap; font-family: Poppins, sans-serif;\"><b><font size=\"3\">{{site_currency}}</font></b></span><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">,</span></div></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Check-In date : {{check_in}}</div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"color: rgb(33, 37, 41);\">Check-Out date : {{check_out}}</span><br></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Room Type : {{room_type}}</div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"color: rgb(33, 37, 41);\">&nbsp;Rooms: {{rooms}}</span><br></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"3\"><b style=\"\"><br></b></font></div>', 'Thanks for booking room here. Your requesting rooms: {{rooms}}\r\npayable amount: {{amount}} {{site_currency}}', '{\"amount\":\"Total Payable Amount\",\r\n\"room_type\":\"Booked Room Type\", \"rooms\":\"booked room list\",\"check_in\":\"Check in date\", \"check_out\": \"Check Out Date\"}', 1, 0, '2021-11-03 12:00:00', '2022-05-16 06:11:06'),
(21, 'BOOKING_REQUEST_CANCELLED', 'Booking Request Cancelled', 'Booking Request Cancelled', '<div><div style=\"font-family: Montserrat, sans-serif;\">Your booking request for&nbsp;<span style=\"color: rgb(33, 37, 41); font-size: 1rem; text-align: var(--bs-body-text-align);\">{{check_in}}&nbsp; to {{check_out}} for <b>{{room_type}}</b></span><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">&nbsp;</span><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">has been cancelled</span><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">.</span></div></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"3\"><b style=\"\"><br></b></font></div>', 'Your booking request for {{check_in}}  to {{check_out}} for {{room_type}} has been cancelled.', '{\"room_type\":\"Room Type\",\"number_of_rooms\":\"Number of Rooms\",\"check_in\":\"Check in date\", \"check_out\": \"Check Out Date\"}', 1, 0, '2021-11-03 12:00:00', '2022-06-29 22:41:33'),
(22, 'BOOKING_CANCELLED', 'Booking Cancelled', 'Booking Cancelled', '<div><div style=\"font-family: Montserrat, sans-serif;\">Your booking&nbsp; for&nbsp;<span style=\"color: rgb(33, 37, 41); font-size: 1rem; text-align: var(--bs-body-text-align);\">{{check_in}}&nbsp; to {{check_out}}&nbsp;</span><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">has been canceled</span><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">.</span></div></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">Booking Number:</span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"color: rgb(33, 37, 41); font-family: Poppins, sans-serif; font-size: 12px; font-weight: 600; white-space: nowrap;\">{{booking_number}}</span><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">Booked rooms:</span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"color: rgb(33, 37, 41); font-family: Poppins, sans-serif; font-size: 12px; font-weight: 600; white-space: nowrap;\">{{rooms}}</span><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"3\"><b style=\"\"><br></b></font></div>', 'Your booking request for {{check_in}}  to {{check_out}} has been canceled.\r\nBooking Number: {{booking_number}}', '{\"booking_number\":\"Booking Number\",\"rooms\":\"rooms\",\"check_in\":\"Check in date\", \"check_out\": \"Check Out Date\"}', 1, 0, '2021-11-03 12:00:00', '2022-06-29 07:57:04'),
(23, 'PAYMENT_MANUAL_REJECT', 'Payment - Manual - Reject', 'Your Payment is Rejected', '<div style=\"font-family: Montserrat, sans-serif;\">Your payment request&nbsp;<span style=\"color: rgb(33, 37, 41); font-family: Poppins, sans-serif; font-size: 1rem; text-align: var(--bs-body-text-align);\">for&nbsp;</span><span style=\"font-family: Poppins, sans-serif; font-size: 1rem; text-align: var(--bs-body-text-align); font-weight: 700;\">{{booking_number}}</span><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">&nbsp;of&nbsp;</span><span style=\"font-size: 1rem; text-align: var(--bs-body-text-align); font-weight: bolder;\">{{amount}}{{site_currency}}</span><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">&nbsp;via&nbsp;&nbsp;</span><span style=\"font-size: 1rem; text-align: var(--bs-body-text-align); font-weight: bolder;\">{{method_name}}&nbsp;</span><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">is rejected.</span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\">Details of your payment:<br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Amount : {{amount}} {{site_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">Charge:&nbsp;<font color=\"#FF0000\">{{charge}} {{site_currency}}</font></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">Payable : {{method_amount}} {{method_currency}}<br></div><div style=\"font-family: Montserrat, sans-serif;\">Paid via :&nbsp; {{method_name}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div>', 'Management reject your {{amount}} {{method_currency}} payment request by {{method_name}} Booking Number: {{booking_number}}', '{\"booking_number\":\"Booking Number\",\"amount\":\"Amount inserted by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the deposit method\",\"method_currency\":\"Currency of the deposit method\",\"method_amount\":\"Amount after conversion between base currency and method currency\",\"post_balance\":\"Balance of the user after this transaction\"}', 1, 1, '2021-11-03 12:00:00', '2022-06-29 23:01:10'),
(24, 'BOOKING_CANCELLED_BY_DATE', 'Booking Cancelled by Date', 'Booking Cancelled', '<div><div style=\"font-family: Montserrat, sans-serif;\">Your booking for&nbsp;<span style=\"color: rgb(33, 37, 41); font-size: 1rem; text-align: var(--bs-body-text-align);\">{{date}}&nbsp;</span><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">has been canceled</span><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">.</span></div></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">Booking Number:</span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"color: rgb(33, 37, 41); font-family: Poppins, sans-serif; font-size: 12px; font-weight: 600; white-space: nowrap;\">{{booking_number}}</span><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">Booked rooms:</span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"color: rgb(33, 37, 41); font-family: Poppins, sans-serif; font-size: 12px; font-weight: 600; white-space: nowrap;\">{{rooms}}</span><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"3\"><b style=\"\"><br></b></font></div>', 'Your booking request for {{date}} has been canceled.\r\nBooking Number: {{booking_number}}', '{\"booking_number\":\"Booking Number\",\"rooms\":\"rooms\",\"date\":\"The Date of Booked For\"}', 1, 0, '2021-11-03 12:00:00', '2022-07-03 09:46:50'),
(25, 'REFUND_AMOUNT', 'Refund Amount', 'Amount Refunded Successfully', '<div><div style=\"\"><font color=\"#d1d5db\" face=\"Söhne, ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Ubuntu, Cantarell, Noto Sans, sans-serif, Helvetica Neue, Arial, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji\"><span style=\"white-space: pre-wrap;\">We regret to inform you that your booking with reference number {{booking_number}} has been canceled. The amount paid for this booking was {{paid_amount}} {{site_currency}}, and as per our refund policy, you are entitled to receive {{refund_amount}} {{site_currency}} for canceling the booking. Please allow up to 5 business days for the refund to be processed and reflected in your account. If you have any further queries, please do not hesitate to contact our customer support team.</span></font><br></div></div>', 'We regret to inform you that your booking with reference number {{booking_number}} has been canceled. The amount paid for this booking was {{paid_amount}} {{site_currency}}, and as per our refund policy, you are entitled to receive {{refund_amount}} {{site_currency}} for canceling the booking. Please allow up to 5 business days for the refund to be processed and reflected in your account. If you have any further queries, please do not hesitate to contact our customer support team.', '{\"booking_number\":\"Booking Number\", \"paid_amount\": \"Paid Amount\", \"refund_amount\" : \"Refund Amount\"}', 1, 0, '2021-11-03 12:00:00', '2023-04-30 10:04:53'),
(26, 'REFUND_FOR_ROOM_CANCELLATION', 'Refund for Room Cancellation', 'Refund for room cancellation', '<div><div style=\"font-family: Montserrat, sans-serif;\">Booking Number :&nbsp;<b>{{booking_number}}</b></div></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"\"><font size=\"3\" style=\"\"><font color=\"#212529\" face=\"Montserrat, sans-serif\">{{refund_amount}}&nbsp;</font></font><span style=\"text-align: var(--bs-body-text-align);\"><font color=\"#212529\" face=\"Montserrat, sans-serif\" size=\"3\">{{site_currency}} has been minimized from your total payable amount.&nbsp;</font></span><font size=\"3\" style=\"\"><br></font></div><div style=\"\"><span style=\"text-align: var(--bs-body-text-align);\"><font color=\"#212529\" face=\"Montserrat, sans-serif\" size=\"3\">Refund Charge :&nbsp;&nbsp;</font></span><span style=\"text-align: var(--bs-body-text-align);\"><font color=\"#212529\" face=\"Montserrat, sans-serif\" size=\"3\">{{refund_charge}}&nbsp;</font></span><span style=\"text-align: var(--bs-body-text-align);\"><font color=\"#212529\" face=\"Montserrat, sans-serif\" size=\"3\">{{site_currency}}</font></span></div>', 'Booking Number : {{booking_number}}\r\n\r\n{{refund_amount}} {{site_currency}} has been minimized from your total payable amount. \r\nRefund Charge :  {{refund_charge}} {{site_currency}}', '{\"booking_number\":\"Booking Number\", \"refund_charge\": \"Refund Charge\", \"refund_amount\" : \"Refund Amount\"}', 1, 0, '2021-11-03 12:00:00', '2023-04-29 10:27:13'),
(27, 'CANCEL_BOOKED_ROOM', 'Cancel Booked Room', 'Cancel Booked Room', '<div><div style=\"font-family: Montserrat, sans-serif;\">Room&nbsp;{{room_number}} for&nbsp;{{date}} has been canceled successfully.&nbsp;</div></div><div style=\"font-family: Montserrat, sans-serif;\">Booking Number :&nbsp;{{booking_number}}</div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"3\"><b style=\"\"><br></b></font></div>', 'Room {{room_number}} for {{date}} has been canceled successfully. \r\nBooking Number : {{booking_number}}', '{\"booking_number\":\"Booking Number\",\"room_number\":\"Cancelled Room\", \"date\":\"Booking Date\"}', 1, 0, '2021-11-03 12:00:00', '2023-04-30 06:55:09');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempname` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'template name',
  `secs` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `slug`, `tempname`, `secs`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 'HOME', '/', 'templates.basic.', '[\"about\",\"featured_room\",\"service\",\"faq\",\"testimonial\",\"blog\",\"subscribe\"]', 1, '2020-07-11 06:23:58', '2022-06-25 23:17:02'),
(4, 'Blog', 'blog', 'templates.basic.', NULL, 1, '2020-10-22 01:14:43', '2020-10-22 01:14:43'),
(5, 'Contact', 'contact', 'templates.basic.', NULL, 1, '2020-10-22 01:14:53', '2022-06-28 01:09:20'),
(17, 'Book Online', 'book-online', 'templates.basic.', NULL, 1, '2022-06-02 10:10:32', '2022-06-02 10:10:32'),
(18, 'FAQs', 'faq', 'templates.basic.', '[\"faq\"]', 0, '2022-06-19 08:18:43', '2022-06-19 08:18:52');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_logs`
--

CREATE TABLE `payment_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `amount` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `type` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_id` int(10) UNSIGNED DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `group`, `code`) VALUES
(1, 'Dashboard', 'AdminController', 'admin.dashboard'),
(2, 'Notifications', 'AdminController', 'admin.notifications'),
(3, 'Read Notifications', 'AdminController', 'admin.notification.read'),
(4, 'Read All Notifications', 'AdminController', 'admin.notifications.readAll'),
(5, 'Request & Report', 'AdminController', 'admin.request.report'),
(6, 'Submit Request Report', 'AdminController', 'admin.request.report.submit'),
(7, 'Download Attachment', 'AdminController', 'admin.download.attachment'),
(8, 'All Staff', 'StaffController', 'admin.staff.index'),
(9, 'Add Staff', 'StaffController', 'admin.staff.save'),
(10, 'Change Status', 'StaffController', 'admin.staff.status'),
(11, 'Staff Login', 'StaffController', 'admin.staff.login'),
(12, 'Roles', 'RolesController', 'admin.roles.index'),
(13, 'Add Role Page', 'RolesController', 'admin.roles.add'),
(14, 'Update Role Page', 'RolesController', 'admin.roles.edit'),
(15, 'Submit Role Form', 'RolesController', 'admin.roles.save'),
(16, 'All Users', 'ManageUsersController', 'admin.users.all'),
(17, 'Active Users', 'ManageUsersController', 'admin.users.active'),
(18, 'Banned Users', 'ManageUsersController', 'admin.users.banned'),
(19, 'Email Verified Users', 'ManageUsersController', 'admin.users.email.verified'),
(20, 'Email Unverified Users', 'ManageUsersController', 'admin.users.email.unverified'),
(21, 'Mobile Unverified Users', 'ManageUsersController', 'admin.users.mobile.unverified'),
(22, 'Mobile Verified Users', 'ManageUsersController', 'admin.users.mobile.verified'),
(23, 'User Details', 'ManageUsersController', 'admin.users.detail'),
(24, 'Update User', 'ManageUsersController', 'admin.users.update'),
(26, 'Notification To A User - Page', 'ManageUsersController', 'admin.users.notification.single'),
(27, 'Send Notification To A User', 'ManageUsersController', 'admin.users.notification.single'),
(28, 'Login As User', 'ManageUsersController', 'admin.users.login'),
(29, 'Update User Status', 'ManageUsersController', 'admin.users.status'),
(30, 'Notification To All Users - Page', 'ManageUsersController', 'admin.users.notification.all'),
(31, 'Send Notification To All Users', 'ManageUsersController', 'admin.users.notification.all.send'),
(32, 'View Notifications Sent To Users', 'ManageUsersController', 'admin.users.notification.log'),
(33, 'All Amenities', 'AmenitiesController', 'admin.hotel.amenity.all'),
(34, 'Add Amenities', 'AmenitiesController', 'admin.hotel.amenity.save'),
(35, 'Update Amenity Status', 'AmenitiesController', 'admin.hotel.amenity.status'),
(36, 'Bed Types', 'BedTypeController', 'admin.hotel.bed.all'),
(37, 'Add Bed Types', 'BedTypeController', 'admin.hotel.bed.save'),
(38, 'Delete Bed Type', 'BedTypeController', 'admin.hotel.bed.delete'),
(39, 'All Complements', 'ComplementController', 'admin.hotel.complement.all'),
(40, 'Add Complements', 'ComplementController', 'admin.hotel.complement.save'),
(41, 'All Room Types', 'RoomTypeController', 'admin.hotel.room.type.all'),
(42, 'Add New Room Type - Page', 'RoomTypeController', 'admin.hotel.room.type.create'),
(43, 'Update Room Type - Page', 'RoomTypeController', 'admin.hotel.room.type.edit'),
(44, 'Add Or Update Room Type', 'RoomTypeController', 'admin.hotel.room.type.save'),
(45, 'Update Room Type Status', 'RoomTypeController', 'admin.hotel.room.type.status'),
(46, 'All Rooms', 'RoomController', 'admin.hotel.room.all'),
(47, 'Update Room Status', 'RoomController', 'admin.hotel.room.status'),
(48, 'All Extra Services', 'ExtraServiceController', 'admin.hotel.extra_services.all'),
(49, 'Add Extra Servies', 'ExtraServiceController', 'admin.hotel.extra_services.save'),
(51, 'Update Extra Service Status', 'ExtraServiceController', 'admin.hotel.extra_services.status'),
(52, 'Book Room - Page', 'BookRoomController', 'admin.book.room'),
(53, 'Book Room Submit', 'BookRoomController', 'admin.room.book'),
(54, 'Room Search', 'BookRoomController', 'admin.room.search'),
(55, 'Booking Merge', 'ManageBookingController', 'admin.booking.merge'),
(56, 'Booking Payment - Page', 'ManageBookingController', 'admin.booking.payment'),
(57, 'Submit Booking Payment Form', 'ManageBookingController', 'admin.booking.payment'),
(58, 'Booking Checkout - Page', 'ManageBookingController', 'admin.booking.checkout'),
(59, 'Submit Checkout Form', 'ManageBookingController', 'admin.booking.checkout'),
(60, 'All Booked Rooms', 'BookingController', 'admin.booking.booked.rooms'),
(61, 'Booking Service Details', 'ManageBookingController', 'admin.booking.service.details'),
(63, 'Booking Details', 'BookingController', 'admin.booking.details'),
(64, 'View Invoice', 'ManageBookingController', 'admin.booking.invoice'),
(65, 'Handover Key', 'ManageBookingController', 'admin.booking.key.handover'),
(66, 'All Bookings', 'BookingController', 'admin.booking.all'),
(67, 'Active Bookings', 'BookingController', 'admin.booking.active'),
(68, 'Canceled Bookings', 'BookingController', 'admin.booking.canceled.list'),
(69, 'Checked Out Bookings', 'BookingController', 'admin.booking.checked.out.list'),
(70, 'Todays Booked', 'BookingController', 'admin.booking.todays.booked'),
(71, 'Todays Checkin', 'BookingController', 'admin.booking.todays.checkin'),
(72, 'Todays Checkout', 'BookingController', 'admin.booking.todays.checkout'),
(73, 'Refundable Bookings', 'BookingController', 'admin.booking.refundable'),
(74, 'Delayed Checkout Bookings', 'BookingController', 'admin.booking.checkout.delayed'),
(75, 'Cancel Booking - Page', 'CancelBookingController', 'admin.booking.cancel'),
(76, 'Cancel Full Booking', 'CancelBookingController', 'admin.booking.cancel.full'),
(77, 'Cancel Single Room', 'CancelBookingController', 'admin.booking.booked.room.cancel'),
(78, 'Cancel Booking For A Date', 'CancelBookingController', 'admin.booking.booked.day.cancel'),
(79, 'Upcoming Check-In Bookings', 'BookingController', 'admin.upcoming.booking.checkin'),
(80, 'Upcoming Checkout Bookings', 'BookingController', 'admin.upcoming.booking.checkout'),
(81, 'Extra Service List For A Booking', 'BookingExtraServiceController', 'admin.extra.service.list'),
(82, 'Add Extra Form - Page', 'BookingExtraServiceController', 'admin.extra.service.add'),
(83, 'Submit Extra Service', 'BookingExtraServiceController', 'admin.extra.service.save'),
(84, 'Delete Extra Service', 'BookingExtraServiceController', 'admin.extra.service.delete'),
(85, 'All Booking Requests', 'ManageBookingRequestController', 'admin.request.booking.all'),
(86, 'Canceled Booking Requests', 'ManageBookingRequestController', 'admin.request.booking.canceled'),
(87, 'Approve Booking Request - Page', 'ManageBookingRequestController', 'admin.request.booking.approve'),
(88, 'Cancel Booking Request', 'ManageBookingRequestController', 'admin.request.booking.cancel'),
(89, 'Assign Room On A Booking Request', 'ManageBookingRequestController', 'admin.request.booking.assign.room'),
(90, 'Subscribers', 'SubscriberController', 'admin.subscriber.index'),
(91, 'Send Email To Subscribers - Page', 'SubscriberController', 'admin.subscriber.send.email'),
(92, 'Remove Subscriber', 'SubscriberController', 'admin.subscriber.remove'),
(93, 'Send Email To Subscribers', 'SubscriberController', 'admin.subscriber.send.email'),
(94, 'Automatic Gateways', 'AutomaticGatewayController', 'admin.gateway.automatic.index'),
(95, 'Update - Page', 'AutomaticGatewayController', 'admin.gateway.automatic.edit'),
(96, 'Update Gateway', 'AutomaticGatewayController', 'admin.gateway.automatic.update'),
(97, 'Remove A Currency  From A Gateway', 'AutomaticGatewayController', 'admin.gateway.automatic.remove'),
(98, 'Change Status', 'AutomaticGatewayController', 'admin.gateway.automatic.status'),
(99, 'Manual Gateways', 'ManualGatewayController', 'admin.gateway.manual.index'),
(100, 'Add New Gateway - Page', 'ManualGatewayController', 'admin.gateway.manual.create'),
(101, 'Submit New Gateway', 'ManualGatewayController', 'admin.gateway.manual.store'),
(102, 'Update Page', 'ManualGatewayController', 'admin.gateway.manual.edit'),
(103, 'Update Gateway', 'ManualGatewayController', 'admin.gateway.manual.update'),
(104, 'Change Status', 'ManualGatewayController', 'admin.gateway.manual.status'),
(105, 'All Payments', 'DepositController', 'admin.deposit.list'),
(106, 'Pending Payments', 'DepositController', 'admin.deposit.pending'),
(107, 'Rejected Payments', 'DepositController', 'admin.deposit.rejected'),
(108, 'Approved Payments', 'DepositController', 'admin.deposit.approved'),
(109, 'Successful Payments', 'DepositController', 'admin.deposit.successful'),
(110, 'Failed Payments', 'DepositController', 'admin.deposit.failed'),
(111, 'View Details', 'DepositController', 'admin.deposit.details'),
(112, 'Reject Pament', 'DepositController', 'admin.deposit.reject'),
(113, 'Approve Payment', 'DepositController', 'admin.deposit.approve'),
(114, 'Login History', 'ReportController', 'admin.report.login.history'),
(115, 'View Login History By IP', 'ReportController', 'admin.report.login.ipHistory'),
(116, 'Notification History', 'ReportController', 'admin.report.notification.history'),
(117, 'View Email Details', 'ReportController', 'admin.report.email.details'),
(118, 'Booking Actions', 'ReportController', 'admin.report.booking.history'),
(119, 'Received Payments', 'ReportController', 'admin.report.payments.received'),
(120, 'Returned Payments', 'ReportController', 'admin.report.payments.returned'),
(121, 'All Ticket', 'SupportTicketController', 'admin.ticket.index'),
(122, 'Pending Ticket', 'SupportTicketController', 'admin.ticket.pending'),
(123, 'Closed Ticket', 'SupportTicketController', 'admin.ticket.closed'),
(124, 'Answered Ticket', 'SupportTicketController', 'admin.ticket.answered'),
(125, 'View Ticket', 'SupportTicketController', 'admin.ticket.view'),
(126, 'Reply Ticket', 'SupportTicketController', 'admin.ticket.reply'),
(127, 'Close Ticket', 'SupportTicketController', 'admin.ticket.close'),
(128, 'Download Ticket', 'SupportTicketController', 'admin.ticket.download'),
(129, 'Delete Ticket', 'SupportTicketController', 'admin.ticket.delete'),
(130, 'View Language List', 'LanguageController', 'admin.language.manage'),
(131, 'Add New Language', 'LanguageController', 'admin.language.manage.store'),
(132, 'Delete Language', 'LanguageController', 'admin.language.manage.delete'),
(133, 'Update Language', 'LanguageController', 'admin.language.manage.update'),
(134, 'Translate Language', 'LanguageController', 'admin.language.key'),
(135, 'Import Language Button', 'LanguageController', 'admin.language.import.lang'),
(136, 'Add New Key To A Language', 'LanguageController', 'admin.language.store.key'),
(137, 'Delete Key', 'LanguageController', 'admin.language.delete.key'),
(138, 'Update Key', 'LanguageController', 'admin.language.update.key'),
(139, 'Language Keywords Button', 'LanguageController', 'admin.language.get.key'),
(140, 'General Setting', 'GeneralSettingController', 'admin.setting.index'),
(141, 'Update General Setting', 'GeneralSettingController', 'admin.setting.update'),
(142, 'System Configuration', 'GeneralSettingController', 'admin.setting.system.configuration'),
(143, 'Update System Configuration', 'GeneralSettingController', 'admin.setting.system.configuration.submit'),
(144, 'Logo & Favicon', 'GeneralSettingController', 'admin.setting.logo.icon'),
(145, 'Update Logo & Favicon', 'GeneralSettingController', 'admin.setting.logo.icon'),
(146, 'Custom CSS', 'GeneralSettingController', 'admin.setting.custom.css'),
(147, 'Update Custom CSS', 'GeneralSettingController', 'admin.setting.custom.css.submit'),
(148, 'GDPR Cookie', 'GeneralSettingController', 'admin.setting.cookie'),
(149, 'Update GDPR Cookie', 'GeneralSettingController', 'admin.setting.cookie.submit'),
(150, 'Maintenance Mode', 'GeneralSettingController', 'admin.maintenance.mode'),
(151, 'Submit Maintenance Mode Form', 'GeneralSettingController', 'admin.maintenance.mode.submit'),
(152, 'Global Template', 'NotificationController', 'admin.setting.notification.global'),
(153, 'Update Global Template', 'NotificationController', 'admin.setting.notification.global.update'),
(154, 'Notification Templates', 'NotificationController', 'admin.setting.notification.templates'),
(155, 'Update Notification Template - Page', 'NotificationController', 'admin.setting.notification.template.edit'),
(156, 'Update Notification Template', 'NotificationController', 'admin.setting.notification.template.update'),
(157, 'Email Setting', 'NotificationController', 'admin.setting.notification.email'),
(158, 'Update Email Setting', 'NotificationController', 'admin.setting.notification.email.update'),
(159, 'Send Test Email', 'NotificationController', 'admin.setting.notification.email.test'),
(160, 'SMS Setting', 'NotificationController', 'admin.setting.notification.sms'),
(161, 'Update SMS Setting', 'NotificationController', 'admin.setting.notification.sms.update'),
(162, 'Send Test SMS', 'NotificationController', 'admin.setting.notification.sms.test'),
(163, 'Extensions', 'ExtensionController', 'admin.extensions.index'),
(164, 'Update Extension', 'ExtensionController', 'admin.extensions.update'),
(165, 'Update Status', 'ExtensionController', 'admin.extensions.status'),
(166, 'Support', 'SystemController', 'admin.system.support'),
(167, 'Application', 'SystemController', 'admin.system.info'),
(168, 'Server', 'SystemController', 'admin.system.server.info'),
(169, 'Cache', 'SystemController', 'admin.system.optimize'),
(170, 'Clear Cache', 'SystemController', 'admin.system.optimize.clear'),
(171, 'SEO Manager', 'FrontendController', 'admin.seo'),
(172, 'Manage Templates', 'FrontendController', 'admin.frontend.templates'),
(173, 'Active Templates', 'FrontendController', 'admin.frontend.templates.active'),
(174, 'Frontend Sections', 'FrontendController', 'admin.frontend.sections'),
(175, 'Frontend Sections Content', 'FrontendController', 'admin.frontend.sections.content'),
(176, 'Frontend Sections Element', 'FrontendController', 'admin.frontend.sections.element'),
(177, 'Remove Frontend Sections Element', 'FrontendController', 'admin.frontend.remove'),
(178, 'Manage Pages', 'PageBuilderController', 'admin.frontend.manage.pages'),
(179, 'Add New Page', 'PageBuilderController', 'admin.frontend.manage.pages.save'),
(180, 'Update Page', 'PageBuilderController', 'admin.frontend.manage.pages.update'),
(181, 'Delete Page', 'PageBuilderController', 'admin.frontend.manage.pages.delete'),
(182, 'Manage Sections', 'PageBuilderController', 'admin.frontend.manage.section'),
(183, 'Update Sections', 'PageBuilderController', 'admin.frontend.manage.section.update'),
(184, 'Booking Extra Charge Add', 'ManageBookingController', 'admin.booking.extra.charge.add'),
(185, 'Booking Extra Charge Subtract', 'ManageBookingController', 'admin.booking.extra.charge.subtract'),
(186, 'Pending Check-Ins', 'BookingController', 'admin.pending.booking.checkin'),
(187, 'Delayed Checkouts', 'BookingController', 'admin.delayed.booking.checkout');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `room_type_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `room_number` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_types`
--

CREATE TABLE `room_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_adult` int(11) NOT NULL DEFAULT 0,
  `total_child` int(11) NOT NULL DEFAULT 0,
  `fare` decimal(28,16) DEFAULT NULL,
  `keywords` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `beds` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cancellation_fee` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `cancellation_policy` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `feature_status` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_type_amenities`
--

CREATE TABLE `room_type_amenities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `room_type_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `amenities_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_type_complements`
--

CREATE TABLE `room_type_complements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `room_type_id` int(10) UNSIGNED NOT NULL,
  `complement_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_type_images`
--

CREATE TABLE `room_type_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `room_type_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_attachments`
--

CREATE TABLE `support_attachments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `support_message_id` int(10) UNSIGNED DEFAULT NULL,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_messages`
--

CREATE TABLE `support_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `support_ticket_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `admin_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `message` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_tickets`
--

CREATE TABLE `support_tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) DEFAULT 0,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ticket` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: Open, 1: Answered, 2: Replied, 3: Closed',
  `priority` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1 = Low, 2 = medium, 3 = heigh',
  `last_reply` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `used_extra_services`
--

CREATE TABLE `used_extra_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `extra_service_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `room_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `booked_room_id` int(10) UNSIGNED DEFAULT NULL,
  `qty` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `unit_price` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `total_amount` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `service_date` date DEFAULT NULL,
  `admin_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_code` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'contains full address',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0: banned, 1: active',
  `ev` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: email unverified, 1: email verified',
  `sv` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: mobile unverified, 1: mobile verified',
  `profile_complete` tinyint(1) NOT NULL DEFAULT 0,
  `ver_code` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'stores verification code',
  `ver_code_send_at` datetime DEFAULT NULL COMMENT 'verification send time',
  `tsc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ban_reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_logins`
--

CREATE TABLE `user_logins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `user_ip` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`,`username`);

--
-- Indexes for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_password_resets`
--
ALTER TABLE `admin_password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `amenities`
--
ALTER TABLE `amenities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bed_types`
--
ALTER TABLE `bed_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booked_rooms`
--
ALTER TABLE `booked_rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_action_histories`
--
ALTER TABLE `booking_action_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_requests`
--
ALTER TABLE `booking_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complements`
--
ALTER TABLE `complements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposits`
--
ALTER TABLE `deposits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `extensions`
--
ALTER TABLE `extensions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `extra_services`
--
ALTER TABLE `extra_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forms`
--
ALTER TABLE `forms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `frontends`
--
ALTER TABLE `frontends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gateways`
--
ALTER TABLE `gateways`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gateway_currencies`
--
ALTER TABLE `gateway_currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_logs`
--
ALTER TABLE `notification_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_templates`
--
ALTER TABLE `notification_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_logs`
--
ALTER TABLE `payment_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `room_number` (`room_number`);

--
-- Indexes for table `room_types`
--
ALTER TABLE `room_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_type_amenities`
--
ALTER TABLE `room_type_amenities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_type_complements`
--
ALTER TABLE `room_type_complements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_type_images`
--
ALTER TABLE `room_type_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_attachments`
--
ALTER TABLE `support_attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_messages`
--
ALTER TABLE `support_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_tickets`
--
ALTER TABLE `support_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `used_extra_services`
--
ALTER TABLE `used_extra_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`,`email`);

--
-- Indexes for table `user_logins`
--
ALTER TABLE `user_logins`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_password_resets`
--
ALTER TABLE `admin_password_resets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `amenities`
--
ALTER TABLE `amenities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bed_types`
--
ALTER TABLE `bed_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `booked_rooms`
--
ALTER TABLE `booked_rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `booking_action_histories`
--
ALTER TABLE `booking_action_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `booking_requests`
--
ALTER TABLE `booking_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `complements`
--
ALTER TABLE `complements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deposits`
--
ALTER TABLE `deposits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `extensions`
--
ALTER TABLE `extensions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `extra_services`
--
ALTER TABLE `extra_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forms`
--
ALTER TABLE `forms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `frontends`
--
ALTER TABLE `frontends`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `gateways`
--
ALTER TABLE `gateways`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `gateway_currencies`
--
ALTER TABLE `gateway_currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification_logs`
--
ALTER TABLE `notification_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification_templates`
--
ALTER TABLE `notification_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `payment_logs`
--
ALTER TABLE `payment_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;

--
-- AUTO_INCREMENT for table `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room_types`
--
ALTER TABLE `room_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room_type_amenities`
--
ALTER TABLE `room_type_amenities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room_type_complements`
--
ALTER TABLE `room_type_complements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room_type_images`
--
ALTER TABLE `room_type_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_attachments`
--
ALTER TABLE `support_attachments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_messages`
--
ALTER TABLE `support_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_tickets`
--
ALTER TABLE `support_tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `used_extra_services`
--
ALTER TABLE `used_extra_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_logins`
--
ALTER TABLE `user_logins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
