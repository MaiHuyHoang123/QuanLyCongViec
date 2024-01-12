-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th1 04, 2024 lúc 08:35 AM
-- Phiên bản máy phục vụ: 10.3.39-MariaDB-log
-- Phiên bản PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `cafpfypchosting_qlcv`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 1,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `order`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, 'Category 1', 'category-1', '2023-11-27 23:54:12', '2023-11-27 23:54:12'),
(2, NULL, 1, 'Category 2', 'category-2', '2023-11-27 23:54:12', '2023-11-27 23:54:12');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `data_rows`
--

CREATE TABLE `data_rows` (
  `id` int(10) UNSIGNED NOT NULL,
  `data_type_id` int(10) UNSIGNED NOT NULL,
  `field` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `display_name` varchar(255) NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT 0,
  `browse` tinyint(1) NOT NULL DEFAULT 1,
  `read` tinyint(1) NOT NULL DEFAULT 1,
  `edit` tinyint(1) NOT NULL DEFAULT 1,
  `add` tinyint(1) NOT NULL DEFAULT 1,
  `delete` tinyint(1) NOT NULL DEFAULT 1,
  `details` text DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `data_rows`
--

INSERT INTO `data_rows` (`id`, `data_type_id`, `field`, `type`, `display_name`, `required`, `browse`, `read`, `edit`, `add`, `delete`, `details`, `order`) VALUES
(1, 1, 'id', 'number', 'ID', 1, 1, 1, 0, 0, 0, '{}', 1),
(2, 1, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, '{}', 2),
(3, 1, 'email', 'text', 'Email', 1, 1, 1, 1, 1, 1, '{}', 3),
(4, 1, 'password', 'password', 'Password', 1, 0, 0, 1, 1, 0, '{}', 4),
(5, 1, 'remember_token', 'text', 'Remember Token', 0, 0, 0, 0, 0, 0, '{}', 5),
(6, 1, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 0, 0, 0, '{}', 6),
(7, 1, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 7),
(8, 1, 'avatar', 'image', 'Avatar', 0, 1, 1, 1, 1, 1, '{}', 8),
(10, 1, 'user_belongstomany_role_relationship', 'relationship', 'Roles', 0, 1, 1, 1, 1, 0, '{\"model\":\"TCG\\\\Voyager\\\\Models\\\\Role\",\"table\":\"roles\",\"type\":\"belongsToMany\",\"column\":\"id\",\"key\":\"id\",\"label\":\"display_name\",\"pivot_table\":\"user_roles\",\"pivot\":\"1\",\"taggable\":\"0\"}', 11),
(11, 1, 'settings', 'hidden', 'Settings', 0, 0, 0, 0, 0, 0, '{}', 12),
(12, 2, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1),
(13, 2, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2),
(14, 2, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, NULL, 3),
(15, 2, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 4),
(16, 3, 'id', 'number', 'ID', 1, 1, 0, 0, 0, 0, '{}', 1),
(17, 3, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, '{}', 2),
(18, 3, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, '{}', 3),
(19, 3, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 4),
(20, 3, 'display_name', 'text', 'Display Name', 1, 1, 1, 1, 1, 1, '{}', 5),
(21, 1, 'role_id', 'text', 'Role', 0, 1, 1, 1, 1, 1, '{}', 9),
(22, 4, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1),
(23, 4, 'parent_id', 'select_dropdown', 'Parent', 0, 0, 1, 1, 1, 1, '{\"default\":\"\",\"null\":\"\",\"options\":{\"\":\"-- None --\"},\"relationship\":{\"key\":\"id\",\"label\":\"name\"}}', 2),
(24, 4, 'order', 'text', 'Order', 1, 1, 1, 1, 1, 1, '{\"default\":1}', 3),
(25, 4, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 4),
(26, 4, 'slug', 'text', 'Slug', 1, 1, 1, 1, 1, 1, '{\"slugify\":{\"origin\":\"name\"}}', 5),
(27, 4, 'created_at', 'timestamp', 'Created At', 0, 0, 1, 0, 0, 0, NULL, 6),
(28, 4, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 7),
(29, 5, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, '{}', 1),
(30, 5, 'author_id', 'text', 'Author', 1, 0, 1, 1, 0, 1, '{}', 2),
(31, 5, 'category_id', 'text', 'Category', 0, 0, 1, 1, 1, 0, '{}', 3),
(32, 5, 'title', 'text', 'Title', 1, 1, 1, 1, 1, 1, '{}', 4),
(33, 5, 'excerpt', 'text_area', 'Excerpt', 0, 0, 1, 1, 1, 1, '{}', 5),
(34, 5, 'body', 'rich_text_box', 'Body', 1, 0, 1, 1, 1, 1, '{}', 6),
(35, 5, 'image', 'image', 'Post Image', 0, 1, 1, 1, 1, 1, '{\"resize\":{\"width\":\"1000\",\"height\":\"null\"},\"quality\":\"70%\",\"upsize\":true,\"thumbnails\":[{\"name\":\"medium\",\"scale\":\"50%\"},{\"name\":\"small\",\"scale\":\"25%\"},{\"name\":\"cropped\",\"crop\":{\"width\":\"300\",\"height\":\"250\"}}]}', 7),
(36, 5, 'slug', 'text', 'Slug', 1, 0, 1, 1, 1, 1, '{\"slugify\":{\"origin\":\"title\",\"forceUpdate\":true},\"validation\":{\"rule\":\"unique:posts,slug\"}}', 8),
(37, 5, 'meta_description', 'text_area', 'Meta Description', 0, 0, 1, 1, 1, 1, '{}', 9),
(38, 5, 'meta_keywords', 'text_area', 'Meta Keywords', 0, 0, 1, 1, 1, 1, '{}', 10),
(39, 5, 'status', 'select_multiple', 'Status', 1, 1, 1, 1, 1, 1, '{\"default\":\"DRAFT\",\"options\":{\"PUBLISHED\":\"published\",\"DRAFT\":\"draft\",\"PENDING\":\"pending\",\"PRIVATE\":\"private\"}}', 11),
(40, 5, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 0, 0, 0, '{}', 12),
(41, 5, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 13),
(42, 5, 'seo_title', 'text', 'SEO Title', 0, 1, 1, 1, 1, 1, '{}', 14),
(43, 5, 'featured', 'checkbox', 'Featured', 1, 1, 1, 1, 1, 1, '{}', 15),
(44, 6, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1),
(45, 6, 'author_id', 'text', 'Author', 1, 0, 0, 0, 0, 0, NULL, 2),
(46, 6, 'title', 'text', 'Title', 1, 1, 1, 1, 1, 1, NULL, 3),
(47, 6, 'excerpt', 'text_area', 'Excerpt', 1, 0, 1, 1, 1, 1, NULL, 4),
(48, 6, 'body', 'rich_text_box', 'Body', 1, 0, 1, 1, 1, 1, NULL, 5),
(49, 6, 'slug', 'text', 'Slug', 1, 0, 1, 1, 1, 1, '{\"slugify\":{\"origin\":\"title\"},\"validation\":{\"rule\":\"unique:pages,slug\"}}', 6),
(50, 6, 'meta_description', 'text', 'Meta Description', 1, 0, 1, 1, 1, 1, NULL, 7),
(51, 6, 'meta_keywords', 'text', 'Meta Keywords', 1, 0, 1, 1, 1, 1, NULL, 8),
(52, 6, 'status', 'select_dropdown', 'Status', 1, 1, 1, 1, 1, 1, '{\"default\":\"INACTIVE\",\"options\":{\"INACTIVE\":\"INACTIVE\",\"ACTIVE\":\"ACTIVE\"}}', 9),
(53, 6, 'created_at', 'timestamp', 'Created At', 1, 1, 1, 0, 0, 0, NULL, 10),
(54, 6, 'updated_at', 'timestamp', 'Updated At', 1, 0, 0, 0, 0, 0, NULL, 11),
(55, 6, 'image', 'image', 'Page Image', 0, 1, 1, 1, 1, 1, NULL, 12),
(56, 7, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(57, 7, 'name', 'text', 'Tên công việc', 0, 1, 1, 1, 1, 1, '{}', 2),
(58, 7, 'desc', 'text_area', 'Mô tả', 0, 1, 1, 1, 1, 1, '{}', 3),
(59, 7, 'content', 'rich_text_box', 'Nội dung', 0, 1, 1, 1, 1, 1, '{}', 4),
(60, 7, 'start_file', 'file', 'File công việc', 0, 1, 1, 1, 1, 1, '{}', 5),
(61, 7, 'start_time', 'date', 'Thời gian bắt đầu', 0, 1, 1, 1, 1, 1, '{\"display\":{\"width\":\"6\"}}', 6),
(62, 7, 'end_time', 'date', 'Thời gian  kết thúc', 0, 1, 1, 1, 1, 1, '{\"display\":{\"width\":\"6\"}}', 7),
(63, 7, 'complete_file', 'file', 'File hoàn thành', 0, 1, 1, 1, 1, 1, '{}', 8),
(64, 7, 'prioritize', 'checkbox', 'Ưu tiên', 0, 1, 1, 1, 1, 1, '{\"default\":\"1\",\"options\":{\"0\":\"Kh\\u00f4ng\",\"1\":\"C\\u00f3\"}}', 9),
(65, 7, 'status', 'select_dropdown', 'Trạng thái', 0, 1, 1, 1, 1, 1, '{\"default\":\"1\",\"options\":{\"1\":\"\\u0110ang th\\u1ef1c hi\\u1ec7n\",\"2\":\"\\u0110\\u00e3 ho\\u00e0n th\\u00e0nh\",\"3\":\"Kh\\u00f4ng ho\\u00e0n th\\u00e0nh\",\"4\":\"T\\u1ea1m d\\u1eebng\",\"5\":\"H\\u1ee7y b\\u1ecf\"}}', 10),
(67, 8, 'id', 'text', 'Id', 1, 1, 1, 0, 0, 1, '{}', 1),
(68, 8, 'name', 'text', 'Team', 0, 1, 1, 1, 1, 1, '{}', 2),
(69, 7, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 12),
(70, 7, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 13),
(71, 8, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 3),
(72, 8, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 4),
(73, 10, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(74, 10, 'name', 'text', 'Tên', 0, 1, 1, 1, 1, 1, '{}', 2),
(75, 10, 'team_id', 'text', 'Team Id', 0, 1, 1, 1, 1, 1, '{}', 3),
(76, 10, 'role', 'text', 'Phân quyền', 0, 1, 1, 1, 1, 1, '{}', 4),
(77, 10, 'staff_belongsto_team_relationship', 'relationship', 'Team', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Team\",\"table\":\"teams\",\"type\":\"belongsTo\",\"column\":\"team_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"categories\",\"pivot\":\"0\",\"taggable\":\"0\"}', 5),
(78, 10, 'created_at', 'timestamp', 'Tạo ngày', 0, 1, 1, 1, 0, 1, '{}', 5),
(79, 10, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 6),
(80, 11, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(81, 11, 'content', 'rich_text_box', 'Nội dung bình luận', 0, 1, 1, 1, 1, 1, '{}', 2),
(82, 11, 'staff_id', 'text', 'Staff Id', 0, 0, 1, 1, 1, 1, '{}', 3),
(83, 11, 'created_at', 'timestamp', 'Ngày tạo', 0, 1, 1, 1, 0, 1, '{}', 4),
(84, 11, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 5),
(85, 11, 'list_comment_belongsto_staff_relationship', 'relationship', 'Nhân viên', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Staff\",\"table\":\"staff\",\"type\":\"belongsTo\",\"column\":\"staff_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"categories\",\"pivot\":\"0\",\"taggable\":\"0\"}', 6),
(87, 11, 'list_comment_belongsto_job_relationship', 'relationship', 'jobs', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Job\",\"table\":\"jobs\",\"type\":\"belongsTo\",\"column\":\"job_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"categories\",\"pivot\":\"0\",\"taggable\":\"0\"}', 7),
(88, 11, 'job_id', 'text', 'Job Id', 0, 1, 1, 1, 1, 1, '{}', 6),
(89, 7, 'comment', 'text_area', 'Bình luận', 0, 1, 1, 1, 1, 1, '{}', 13),
(98, 13, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(99, 13, 'name', 'text', 'Name', 0, 1, 1, 1, 1, 1, '{}', 2),
(100, 13, 'created_at', 'timestamp', 'Created At', 0, 0, 1, 1, 0, 1, '{}', 6),
(101, 13, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 7),
(102, 13, 'team_id', 'text', 'Team', 0, 1, 1, 1, 1, 1, '{}', 4),
(105, 1, 'email_verified_at', 'timestamp', 'Email Verified At', 0, 1, 1, 1, 1, 1, '{}', 6),
(107, 13, 'role_id', 'select_dropdown', 'Role', 0, 1, 1, 1, 1, 1, '{\"default\":\"2\",\"options\":{\"1\":\"Qu\\u1ea3n l\\u00fd\",\"2\":\"Nh\\u00e2n vi\\u00ean\"}}', 5),
(109, 1, 'team_id', 'text', 'Team', 0, 1, 1, 1, 1, 1, '{}', 12),
(113, 13, 'staff_belongsto_team_relationship_1', 'relationship', 'teams', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Team\",\"table\":\"teams\",\"type\":\"belongsTo\",\"column\":\"team_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"categories\",\"pivot\":\"0\",\"taggable\":\"0\"}', 8),
(114, 1, 'user_belongsto_team_relationship', 'relationship', 'teams', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Team\",\"table\":\"teams\",\"type\":\"belongsTo\",\"column\":\"team_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"categories\",\"pivot\":\"0\",\"taggable\":\"0\"}', 13),
(116, 15, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(117, 15, 'multiple_select', 'select_multiple', 'Multiple Select', 0, 1, 1, 1, 1, 1, '{\"options\":{\"option1\":\"Option 1 Text\",\"option2\":\"Option 2 Text jdsnjhcbdjhbvjhfb\",\"option3\":\"Option 3 Text\",\"option4\":\"Option 4 Text\",\"option5\":\"Option 5 Text\",\"option6\":\"Option 6 Text\",\"option7\":\"Option 7 Text\",\"option8\":\"Option 8 Text\",\"option9\":\"Option 9 Text\",\"option10\":\"Option 10 Text\",\"option11\":\"Option 11 Text\",\"option12\":\"Option 12 Text\",\"option13\":\"Option 13 Text\",\"option14\":\"Option 14 Text\"}}', 2),
(118, 15, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 3),
(119, 15, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 4),
(120, 13, 'password', 'text', 'Password', 0, 1, 1, 1, 1, 1, '{}', 9),
(121, 13, 'phone', 'text', 'Phone', 0, 1, 1, 1, 1, 1, '{}', 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `data_types`
--

CREATE TABLE `data_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `display_name_singular` varchar(255) NOT NULL,
  `display_name_plural` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `model_name` varchar(255) DEFAULT NULL,
  `policy_name` varchar(255) DEFAULT NULL,
  `controller` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `generate_permissions` tinyint(1) NOT NULL DEFAULT 0,
  `server_side` tinyint(4) NOT NULL DEFAULT 0,
  `details` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `data_types`
--

INSERT INTO `data_types` (`id`, `name`, `slug`, `display_name_singular`, `display_name_plural`, `icon`, `model_name`, `policy_name`, `controller`, `description`, `generate_permissions`, `server_side`, `details`, `created_at`, `updated_at`) VALUES
(1, 'users', 'users', 'User', 'Users', 'voyager-person', 'TCG\\Voyager\\Models\\User', 'TCG\\Voyager\\Policies\\UserPolicy', 'TCG\\Voyager\\Http\\Controllers\\VoyagerUserController', NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"desc\",\"default_search_key\":null,\"scope\":null}', '2023-11-27 23:54:11', '2023-12-13 01:14:06'),
(2, 'menus', 'menus', 'Menu', 'Menus', 'voyager-list', 'TCG\\Voyager\\Models\\Menu', NULL, '', '', 1, 0, NULL, '2023-11-27 23:54:11', '2023-11-27 23:54:11'),
(3, 'roles', 'roles', 'Role', 'Roles', 'voyager-lock', 'TCG\\Voyager\\Models\\Role', NULL, 'TCG\\Voyager\\Http\\Controllers\\VoyagerRoleController', NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"desc\",\"default_search_key\":null,\"scope\":null}', '2023-11-27 23:54:11', '2023-12-05 00:57:29'),
(4, 'categories', 'categories', 'Category', 'Categories', 'voyager-categories', 'TCG\\Voyager\\Models\\Category', NULL, '', '', 1, 0, NULL, '2023-11-27 23:54:12', '2023-11-27 23:54:12'),
(5, 'posts', 'posts', 'Post', 'Posts', 'voyager-news', 'TCG\\Voyager\\Models\\Post', 'TCG\\Voyager\\Policies\\PostPolicy', NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"desc\",\"default_search_key\":null,\"scope\":null}', '2023-11-27 23:54:13', '2023-12-19 02:11:02'),
(6, 'pages', 'pages', 'Page', 'Pages', 'voyager-file-text', 'TCG\\Voyager\\Models\\Page', NULL, '', '', 1, 0, NULL, '2023-11-27 23:54:13', '2023-11-27 23:54:13'),
(7, 'jobs', 'jobs', 'Job', 'Jobs', NULL, 'App\\Job', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2023-11-28 01:35:42', '2023-12-13 01:33:44'),
(8, 'teams', 'teams', 'Team', 'Team', NULL, 'App\\Team', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2023-11-28 01:52:01', '2023-12-13 01:17:27'),
(10, 'staff', 'staff', 'Staff', 'Staff', NULL, 'App\\Staff', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2023-11-28 02:15:25', '2023-11-28 23:54:10'),
(11, 'list_comments', 'list-comments', 'List Comment', 'List Comments', NULL, 'App\\ListComment', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2023-11-28 02:48:52', '2023-11-28 03:23:44'),
(13, 'staffs', 'staffs', 'Staff', 'Staffs', NULL, 'App\\Staff', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2023-12-05 00:07:52', '2023-12-26 19:15:05'),
(15, 'tests', 'tests', 'Test', 'Tests', NULL, 'App\\Test', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2023-12-19 02:26:11', '2023-12-19 18:39:00');

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
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `start_file` varchar(255) DEFAULT NULL,
  `start_time` date DEFAULT NULL,
  `end_time` date DEFAULT NULL,
  `complete_file` varchar(200) DEFAULT NULL,
  `prioritize` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `comment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `jobs`
--

INSERT INTO `jobs` (`id`, `name`, `desc`, `content`, `start_file`, `start_time`, `end_time`, `complete_file`, `prioritize`, `status`, `created_at`, `updated_at`, `comment`) VALUES
(1, 'CÔng việc 1', 'âbca', '<p>&acirc;bca</p>', '[{\"download_link\":\"jobs\\\\December2023\\\\OGN04BreAscgj1Hv18n3.xlsx\",\"original_name\":\"DANH S\\u00c1CH DOANH NGHI\\u1ec6P.xlsx\"}]', '2023-12-02', '2023-12-02', '', 1, 2, '2023-11-28 02:57:00', '2023-11-28 03:20:10', NULL),
(2, 'Công việc 2', 'aksn naijdbfijjasnijp abgjiba ịeg', '<p>aksn naijdbfijjasnijp abgjiba ịegaksn naijdbfijjasnijp abgjiba ịegaksn naijdbfijjasnijp abgjiba ịegaksn naijdbfijjasnijp abgjiba ịeg</p>', '[{\"download_link\":\"jobs\\\\December2023\\\\8mOiiiyeM1VpGjoIF1Io.docx\",\"original_name\":\"B\\u00e1o-C\\u00e1o-N11-UDCNPTPM.docx\"}]', '2023-12-04', '2023-12-06', '[{\"download_link\":\"jobs\\\\December2023\\\\LpgzD1i1ZVCiys83kxwX.pdf\",\"original_name\":\"CV N\\u00d4NG Ho\\u00e0ng D\\u01b0\\u01a1ng - hduong-TopCV.vn.pdf\"}]', 0, 4, NULL, NULL, NULL),
(3, 'Công việc mới', 'asfasijjjfaijsb fijwabdijabsdijf', '<p>asfasijjjfaijsb fijwabdijabsdijf</p>', '[{\"download_link\":\"jobs\\\\December2023\\\\It6wnZg00tn5c3ELyz8b.docx\",\"original_name\":\"B\\u00e1o-C\\u00e1o-N11-UDCNPTPM.docx\"}]', '2023-12-14', '2023-12-15', '[{\"download_link\":\"jobs\\\\December2023\\\\8V7yxYtcIgCW3ItAgXrJ.docx\",\"original_name\":\"B\\u00e1o-C\\u00e1o-N11-UDCNPTPM.docx\"}]', 1, 2, NULL, NULL, NULL),
(4, 'Việc ngày 5-12', 'ajsdhfij nsdasdf', '<p>asfsdgasjf &iacute;udhasaaa</p>', '[{\"download_link\":\"jobs\\\\December2023\\\\P06RYwy7ckt6SkdG9ofv.docx\",\"original_name\":\"B\\u00e1o C\\u00e1o Nh\\u00f3m 2 - QLDA.docx\"}]', '2023-12-05', '2023-12-07', '[]', 1, 2, NULL, NULL, 'ahhahhaahahhaihihi'),
(6, 'hihihi', 'áo cotton', '<p>áo cottonáo cottonáo cotton</p>', '[{\"download_link\":\"jobs\\\\December2023\\\\BwqCz8XtHNaWFs63KCjp.docx\",\"original_name\":\"Baocaothuctajp.docx\"}]', '2023-12-14', '2023-12-15', '[]', 0, 1, NULL, NULL, NULL),
(14, 'thu 7', 'lam viec extra', 'cong viec lam them 123', NULL, '2023-12-16', '2023-12-20', NULL, 1, 1, NULL, NULL, NULL),
(15, 'Mai Huy Hoàng', 'lam viec', NULL, NULL, '2023-12-16', '2023-12-16', NULL, 1, 2, NULL, NULL, NULL),
(16, 'headphone', 'lam viec', 'abcdefgh', NULL, '2023-12-18', '2023-12-25', NULL, 1, 1, NULL, NULL, NULL),
(17, 'watch', 'ákjdnkajsnd', 'ádsdghbyrgny', NULL, '2023-12-18', '2023-12-19', NULL, 1, 1, NULL, NULL, NULL),
(18, 'mice logitech', 'lam viec', 'grbthrnthn', NULL, '2023-12-18', '2023-12-20', NULL, 1, 2, NULL, NULL, NULL),
(19, 'Mai Huy Hoàng', 'lam viec', NULL, NULL, '2023-12-19', '2023-12-19', NULL, 1, 1, NULL, NULL, NULL),
(20, 'Mai Huy Hoàng', 'lam viec', NULL, NULL, '2023-12-19', '2023-12-19', NULL, 1, 2, NULL, NULL, NULL),
(21, 'Mai Huy Hoàng', 'lam viec', NULL, NULL, '2023-12-19', '2023-12-19', NULL, 1, 1, NULL, NULL, NULL),
(22, 'Mai Huy Hoàng', 'lam viec', NULL, NULL, '2023-12-19', '2023-12-19', NULL, 1, 1, NULL, NULL, NULL),
(23, 'laptop', 'ákjdnkajsnd', 'ọidfifknv', NULL, '2023-12-19', '2023-12-26', NULL, 1, 1, NULL, NULL, NULL),
(40, 'mice logitech common price', 'lam viec extra', 'kdsnkvfnsb', NULL, '2023-12-21', '2023-12-21', NULL, 1, 1, NULL, NULL, NULL),
(42, 'Xây dựng website Hội an planner', 'Xây dựng website Hội an planner', NULL, NULL, '2023-12-27', '2024-01-05', NULL, 0, 2, NULL, NULL, NULL),
(43, 'hh', 'hh', NULL, NULL, '2024-01-03', '2024-01-03', NULL, 1, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `list_comments`
--

CREATE TABLE `list_comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `content` varchar(255) DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `job_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `list_comments`
--

INSERT INTO `list_comments` (`id`, `content`, `staff_id`, `created_at`, `updated_at`, `job_id`) VALUES
(1, '<p>abc kadjopsdjfoawd</p>', 1, '2023-11-28 03:11:00', '2023-11-28 03:24:10', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `menus`
--

CREATE TABLE `menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `menus`
--

INSERT INTO `menus` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2023-11-27 23:54:11', '2023-11-27 23:54:11');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `menu_items`
--

CREATE TABLE `menu_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `menu_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `target` varchar(255) NOT NULL DEFAULT '_self',
  `icon_class` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `route` varchar(255) DEFAULT NULL,
  `parameters` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `menu_items`
--

INSERT INTO `menu_items` (`id`, `menu_id`, `title`, `url`, `target`, `icon_class`, `color`, `parent_id`, `order`, `created_at`, `updated_at`, `route`, `parameters`) VALUES
(1, 1, 'Dashboard', '', '_self', 'voyager-boat', NULL, NULL, 1, '2023-11-27 23:54:11', '2023-11-27 23:54:11', 'voyager.dashboard', NULL),
(2, 1, 'Media', '', '_self', 'voyager-images', NULL, NULL, 4, '2023-11-27 23:54:11', '2023-12-26 19:29:10', 'voyager.media.index', NULL),
(3, 1, 'Users', '', '_self', 'voyager-person', NULL, 24, 1, '2023-11-27 23:54:11', '2023-12-26 19:27:20', 'voyager.users.index', NULL),
(4, 1, 'Roles', '', '_self', 'voyager-lock', NULL, 24, 2, '2023-11-27 23:54:11', '2023-12-26 19:27:22', 'voyager.roles.index', NULL),
(5, 1, 'Tools', '', '_self', 'voyager-tools', NULL, NULL, 5, '2023-11-27 23:54:11', '2023-12-26 19:29:10', NULL, NULL),
(6, 1, 'Menu Builder', '', '_self', 'voyager-list', NULL, 5, 1, '2023-11-27 23:54:11', '2023-11-28 01:46:42', 'voyager.menus.index', NULL),
(7, 1, 'Database', '', '_self', 'voyager-data', NULL, 5, 2, '2023-11-27 23:54:11', '2023-11-28 01:46:42', 'voyager.database.index', NULL),
(8, 1, 'Compass', '', '_self', 'voyager-compass', NULL, 5, 3, '2023-11-27 23:54:11', '2023-11-28 01:46:42', 'voyager.compass.index', NULL),
(9, 1, 'BREAD', '', '_self', 'voyager-bread', NULL, 5, 4, '2023-11-27 23:54:11', '2023-11-28 01:46:42', 'voyager.bread.index', NULL),
(10, 1, 'Settings', '', '_self', 'voyager-settings', NULL, NULL, 6, '2023-11-27 23:54:11', '2023-12-26 19:29:10', 'voyager.settings.index', NULL),
(14, 1, 'Công việc', '', '_self', 'voyager-window-list', '#000000', 25, 1, '2023-11-28 01:35:42', '2023-12-26 19:29:02', 'voyager.jobs.index', 'null'),
(15, 1, 'Team', '', '_self', 'voyager-people', '#000000', 25, 3, '2023-11-28 01:52:01', '2023-12-26 19:29:10', 'voyager.teams.index', 'null'),
(18, 1, 'Danh sách thảo luận', '', '_self', 'voyager-chat', '#000000', 25, 2, '2023-11-28 02:48:53', '2023-12-26 19:29:10', 'voyager.list-comments.index', 'null'),
(20, 1, 'Nhân viên', '', '_self', 'voyager-person', '#000000', 25, 4, '2023-12-05 00:07:52', '2023-12-26 19:29:10', 'voyager.staffs.index', 'null'),
(24, 1, 'Admin', '', '_self', 'voyager-people', '#000000', NULL, 3, '2023-12-26 19:27:01', '2023-12-26 19:29:10', NULL, ''),
(25, 1, 'Công việc', '', '_self', 'voyager-book', '#000000', NULL, 2, '2023-12-26 19:28:49', '2023-12-26 19:29:00', NULL, '');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2016_01_01_000000_add_voyager_user_fields', 1),
(4, '2016_01_01_000000_create_data_types_table', 1),
(5, '2016_05_19_173453_create_menu_table', 1),
(6, '2016_10_21_190000_create_roles_table', 1),
(7, '2016_10_21_190000_create_settings_table', 1),
(8, '2016_11_30_135954_create_permission_table', 1),
(9, '2016_11_30_141208_create_permission_role_table', 1),
(10, '2016_12_26_201236_data_types__add__server_side', 1),
(11, '2017_01_13_000000_add_route_to_menu_items_table', 1),
(12, '2017_01_14_005015_create_translations_table', 1),
(13, '2017_01_15_000000_make_table_name_nullable_in_permissions_table', 1),
(14, '2017_03_06_000000_add_controller_to_data_types_table', 1),
(15, '2017_04_21_000000_add_order_to_data_rows_table', 1),
(16, '2017_07_05_210000_add_policyname_to_data_types_table', 1),
(17, '2017_08_05_000000_add_group_to_settings_table', 1),
(18, '2017_11_26_013050_add_user_role_relationship', 1),
(19, '2017_11_26_015000_create_user_roles_table', 1),
(20, '2018_03_11_000000_add_user_settings', 1),
(21, '2018_03_14_000000_add_details_to_data_types_table', 1),
(22, '2018_03_16_000000_make_settings_value_nullable', 1),
(23, '2019_08_19_000000_create_failed_jobs_table', 1),
(24, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(25, '2016_01_01_000000_create_pages_table', 2),
(26, '2016_01_01_000000_create_posts_table', 2),
(27, '2016_02_15_204651_create_categories_table', 2),
(28, '2017_04_11_000000_alter_post_nullable_fields_table', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `author_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `excerpt` text DEFAULT NULL,
  `body` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `status` enum('ACTIVE','INACTIVE') NOT NULL DEFAULT 'INACTIVE',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `pages`
--

INSERT INTO `pages` (`id`, `author_id`, `title`, `excerpt`, `body`, `image`, `slug`, `meta_description`, `meta_keywords`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, 'Hello World', 'Hang the jib grog grog blossom grapple dance the hempen jig gangway pressgang bilge rat to go on account lugger. Nelsons folly gabion line draught scallywag fire ship gaff fluke fathom case shot. Sea Legs bilge rat sloop matey gabion long clothes run a shot across the bow Gold Road cog league.', '<p>Hello World. Scallywag grog swab Cat o\'nine tails scuttle rigging hardtack cable nipper Yellow Jack. Handsomely spirits knave lad killick landlubber or just lubber deadlights chantey pinnace crack Jennys tea cup. Provost long clothes black spot Yellow Jack bilged on her anchor league lateen sail case shot lee tackle.</p>\n<p>Ballast spirits fluke topmast me quarterdeck schooner landlubber or just lubber gabion belaying pin. Pinnace stern galleon starboard warp carouser to go on account dance the hempen jig jolly boat measured fer yer chains. Man-of-war fire in the hole nipperkin handsomely doubloon barkadeer Brethren of the Coast gibbet driver squiffy.</p>', 'pages/page1.jpg', 'hello-world', 'Yar Meta Description', 'Keyword1, Keyword2', 'ACTIVE', '2023-11-27 23:54:13', '2023-11-27 23:54:13');

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
-- Cấu trúc bảng cho bảng `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `table_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `permissions`
--

INSERT INTO `permissions` (`id`, `key`, `table_name`, `created_at`, `updated_at`) VALUES
(1, 'browse_admin', NULL, '2023-11-27 23:54:11', '2023-11-27 23:54:11'),
(2, 'browse_bread', NULL, '2023-11-27 23:54:11', '2023-11-27 23:54:11'),
(3, 'browse_database', NULL, '2023-11-27 23:54:11', '2023-11-27 23:54:11'),
(4, 'browse_media', NULL, '2023-11-27 23:54:11', '2023-11-27 23:54:11'),
(5, 'browse_compass', NULL, '2023-11-27 23:54:11', '2023-11-27 23:54:11'),
(6, 'browse_menus', 'menus', '2023-11-27 23:54:11', '2023-11-27 23:54:11'),
(7, 'read_menus', 'menus', '2023-11-27 23:54:11', '2023-11-27 23:54:11'),
(8, 'edit_menus', 'menus', '2023-11-27 23:54:11', '2023-11-27 23:54:11'),
(9, 'add_menus', 'menus', '2023-11-27 23:54:11', '2023-11-27 23:54:11'),
(10, 'delete_menus', 'menus', '2023-11-27 23:54:11', '2023-11-27 23:54:11'),
(11, 'browse_roles', 'roles', '2023-11-27 23:54:11', '2023-11-27 23:54:11'),
(12, 'read_roles', 'roles', '2023-11-27 23:54:11', '2023-11-27 23:54:11'),
(13, 'edit_roles', 'roles', '2023-11-27 23:54:11', '2023-11-27 23:54:11'),
(14, 'add_roles', 'roles', '2023-11-27 23:54:11', '2023-11-27 23:54:11'),
(15, 'delete_roles', 'roles', '2023-11-27 23:54:12', '2023-11-27 23:54:12'),
(16, 'browse_users', 'users', '2023-11-27 23:54:12', '2023-11-27 23:54:12'),
(17, 'read_users', 'users', '2023-11-27 23:54:12', '2023-11-27 23:54:12'),
(18, 'edit_users', 'users', '2023-11-27 23:54:12', '2023-11-27 23:54:12'),
(19, 'add_users', 'users', '2023-11-27 23:54:12', '2023-11-27 23:54:12'),
(20, 'delete_users', 'users', '2023-11-27 23:54:12', '2023-11-27 23:54:12'),
(21, 'browse_settings', 'settings', '2023-11-27 23:54:12', '2023-11-27 23:54:12'),
(22, 'read_settings', 'settings', '2023-11-27 23:54:12', '2023-11-27 23:54:12'),
(23, 'edit_settings', 'settings', '2023-11-27 23:54:12', '2023-11-27 23:54:12'),
(24, 'add_settings', 'settings', '2023-11-27 23:54:12', '2023-11-27 23:54:12'),
(25, 'delete_settings', 'settings', '2023-11-27 23:54:12', '2023-11-27 23:54:12'),
(26, 'browse_categories', 'categories', '2023-11-27 23:54:12', '2023-11-27 23:54:12'),
(27, 'read_categories', 'categories', '2023-11-27 23:54:12', '2023-11-27 23:54:12'),
(28, 'edit_categories', 'categories', '2023-11-27 23:54:12', '2023-11-27 23:54:12'),
(29, 'add_categories', 'categories', '2023-11-27 23:54:12', '2023-11-27 23:54:12'),
(30, 'delete_categories', 'categories', '2023-11-27 23:54:12', '2023-11-27 23:54:12'),
(31, 'browse_posts', 'posts', '2023-11-27 23:54:13', '2023-11-27 23:54:13'),
(32, 'read_posts', 'posts', '2023-11-27 23:54:13', '2023-11-27 23:54:13'),
(33, 'edit_posts', 'posts', '2023-11-27 23:54:13', '2023-11-27 23:54:13'),
(34, 'add_posts', 'posts', '2023-11-27 23:54:13', '2023-11-27 23:54:13'),
(35, 'delete_posts', 'posts', '2023-11-27 23:54:13', '2023-11-27 23:54:13'),
(36, 'browse_pages', 'pages', '2023-11-27 23:54:13', '2023-11-27 23:54:13'),
(37, 'read_pages', 'pages', '2023-11-27 23:54:13', '2023-11-27 23:54:13'),
(38, 'edit_pages', 'pages', '2023-11-27 23:54:13', '2023-11-27 23:54:13'),
(39, 'add_pages', 'pages', '2023-11-27 23:54:13', '2023-11-27 23:54:13'),
(40, 'delete_pages', 'pages', '2023-11-27 23:54:13', '2023-11-27 23:54:13'),
(41, 'browse_jobs', 'jobs', '2023-11-28 01:35:42', '2023-11-28 01:35:42'),
(42, 'read_jobs', 'jobs', '2023-11-28 01:35:42', '2023-11-28 01:35:42'),
(43, 'edit_jobs', 'jobs', '2023-11-28 01:35:42', '2023-11-28 01:35:42'),
(44, 'add_jobs', 'jobs', '2023-11-28 01:35:42', '2023-11-28 01:35:42'),
(45, 'delete_jobs', 'jobs', '2023-11-28 01:35:42', '2023-11-28 01:35:42'),
(46, 'browse_teams', 'teams', '2023-11-28 01:52:01', '2023-11-28 01:52:01'),
(47, 'read_teams', 'teams', '2023-11-28 01:52:01', '2023-11-28 01:52:01'),
(48, 'edit_teams', 'teams', '2023-11-28 01:52:01', '2023-11-28 01:52:01'),
(49, 'add_teams', 'teams', '2023-11-28 01:52:01', '2023-11-28 01:52:01'),
(50, 'delete_teams', 'teams', '2023-11-28 01:52:01', '2023-11-28 01:52:01'),
(56, 'browse_staff', 'staff', '2023-11-28 02:15:25', '2023-11-28 02:15:25'),
(57, 'read_staff', 'staff', '2023-11-28 02:15:25', '2023-11-28 02:15:25'),
(58, 'edit_staff', 'staff', '2023-11-28 02:15:25', '2023-11-28 02:15:25'),
(59, 'add_staff', 'staff', '2023-11-28 02:15:25', '2023-11-28 02:15:25'),
(60, 'delete_staff', 'staff', '2023-11-28 02:15:25', '2023-11-28 02:15:25'),
(61, 'browse_list_comments', 'list_comments', '2023-11-28 02:48:53', '2023-11-28 02:48:53'),
(62, 'read_list_comments', 'list_comments', '2023-11-28 02:48:53', '2023-11-28 02:48:53'),
(63, 'edit_list_comments', 'list_comments', '2023-11-28 02:48:53', '2023-11-28 02:48:53'),
(64, 'add_list_comments', 'list_comments', '2023-11-28 02:48:53', '2023-11-28 02:48:53'),
(65, 'delete_list_comments', 'list_comments', '2023-11-28 02:48:53', '2023-11-28 02:48:53'),
(71, 'browse_staffs', 'staffs', '2023-12-05 00:07:52', '2023-12-05 00:07:52'),
(72, 'read_staffs', 'staffs', '2023-12-05 00:07:52', '2023-12-05 00:07:52'),
(73, 'edit_staffs', 'staffs', '2023-12-05 00:07:52', '2023-12-05 00:07:52'),
(74, 'add_staffs', 'staffs', '2023-12-05 00:07:52', '2023-12-05 00:07:52'),
(75, 'delete_staffs', 'staffs', '2023-12-05 00:07:52', '2023-12-05 00:07:52'),
(81, 'browse_tests', 'tests', '2023-12-19 02:26:11', '2023-12-19 02:26:11'),
(82, 'read_tests', 'tests', '2023-12-19 02:26:11', '2023-12-19 02:26:11'),
(83, 'edit_tests', 'tests', '2023-12-19 02:26:11', '2023-12-19 02:26:11'),
(84, 'add_tests', 'tests', '2023-12-19 02:26:11', '2023-12-19 02:26:11'),
(85, 'delete_tests', 'tests', '2023-12-19 02:26:11', '2023-12-19 02:26:11');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(81, 1),
(82, 1),
(83, 1),
(84, 1),
(85, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `author_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `seo_title` varchar(255) DEFAULT NULL,
  `excerpt` text DEFAULT NULL,
  `body` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `status` enum('PUBLISHED','DRAFT','PENDING') NOT NULL DEFAULT 'DRAFT',
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `posts`
--

INSERT INTO `posts` (`id`, `author_id`, `category_id`, `title`, `seo_title`, `excerpt`, `body`, `image`, `slug`, `meta_description`, `meta_keywords`, `status`, `featured`, `created_at`, `updated_at`) VALUES
(1, 0, NULL, 'Lorem Ipsum Post', NULL, 'This is the excerpt for the Lorem Ipsum Post', '<p>This is the body of the lorem ipsum post</p>', 'posts/post1.jpg', 'lorem-ipsum-post', 'This is the meta description', 'keyword1, keyword2, keyword3', 'PUBLISHED', 0, '2023-11-27 23:54:13', '2023-11-27 23:54:13'),
(2, 0, NULL, 'My Sample Post', NULL, 'This is the excerpt for the sample Post', '<p>This is the body for the sample post, which includes the body.</p>\n                <h2>We can use all kinds of format!</h2>\n                <p>And include a bunch of other stuff.</p>', 'posts/post2.jpg', 'my-sample-post', 'Meta Description for sample post', 'keyword1, keyword2, keyword3', 'PUBLISHED', 0, '2023-11-27 23:54:13', '2023-11-27 23:54:13'),
(3, 0, NULL, 'Latest Post', NULL, 'This is the excerpt for the latest post', '<p>This is the body for the latest post</p>', 'posts/post3.jpg', 'latest-post', 'This is the meta description', 'keyword1, keyword2, keyword3', 'PUBLISHED', 0, '2023-11-27 23:54:13', '2023-11-27 23:54:13'),
(4, 0, NULL, 'Yarr Post', NULL, 'Reef sails nipperkin bring a spring upon her cable coffer jury mast spike marooned Pieces of Eight poop deck pillage. Clipper driver coxswain galleon hempen halter come about pressgang gangplank boatswain swing the lead. Nipperkin yard skysail swab lanyard Blimey bilge water ho quarter Buccaneer.', '<p>Swab deadlights Buccaneer fire ship square-rigged dance the hempen jig weigh anchor cackle fruit grog furl. Crack Jennys tea cup chase guns pressgang hearties spirits hogshead Gold Road six pounders fathom measured fer yer chains. Main sheet provost come about trysail barkadeer crimp scuttle mizzenmast brig plunder.</p>\n<p>Mizzen league keelhaul galleon tender cog chase Barbary Coast doubloon crack Jennys tea cup. Blow the man down lugsail fire ship pinnace cackle fruit line warp Admiral of the Black strike colors doubloon. Tackle Jack Ketch come about crimp rum draft scuppers run a shot across the bow haul wind maroon.</p>\n<p>Interloper heave down list driver pressgang holystone scuppers tackle scallywag bilged on her anchor. Jack Tar interloper draught grapple mizzenmast hulk knave cable transom hogshead. Gaff pillage to go on account grog aft chase guns piracy yardarm knave clap of thunder.</p>', 'posts/post4.jpg', 'yarr-post', 'this be a meta descript', 'keyword1, keyword2, keyword3', 'PUBLISHED', 0, '2023-11-27 23:54:13', '2023-11-27 23:54:13');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `display_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Administrator', '2023-11-27 23:54:11', '2023-11-27 23:54:11'),
(2, 'user', 'Normal User', '2023-11-27 23:54:11', '2023-11-27 23:54:11');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `display_name` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `details` text DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `order` int(11) NOT NULL DEFAULT 1,
  `group` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `settings`
--

INSERT INTO `settings` (`id`, `key`, `display_name`, `value`, `details`, `type`, `order`, `group`) VALUES
(1, 'site.title', 'Site Title', 'Site Title', '', 'text', 1, 'Site'),
(2, 'site.description', 'Site Description', 'Site Description', '', 'text', 2, 'Site'),
(3, 'site.logo', 'Site Logo', 'settings/December2023/U968AZvbiugJJh9MJnI1.png', '', 'image', 3, 'Site'),
(4, 'site.google_analytics_tracking_id', 'Google Analytics Tracking ID', NULL, '', 'text', 4, 'Site'),
(5, 'admin.bg_image', 'Admin Background Image', 'settings/December2023/omUD5v3obrO2HofFSCV2.jpg', '', 'image', 5, 'Admin'),
(6, 'admin.title', 'Admin Title', 'Kennatech', '', 'text', 1, 'Admin'),
(7, 'admin.description', 'Admin Description', 'Welcome to Admin. The Missing Admin for Laravel', '', 'text', 2, 'Admin'),
(8, 'admin.loader', 'Admin Loader', '', '', 'image', 3, 'Admin'),
(9, 'admin.icon_image', 'Admin Icon Image', '', '', 'image', 4, 'Admin'),
(10, 'admin.google_analytics_client_id', 'Google Analytics Client ID (used for admin dashboard)', NULL, '', 'text', 1, 'Admin'),
(11, 'site.banner_login', 'Banner login', 'settings/December2023/vJRY6UvcuuWeD5NE24Vz.jpg', NULL, 'image', 6, 'Site');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `staffs`
--

CREATE TABLE `staffs` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `team_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `password` text DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `staffs`
--

INSERT INTO `staffs` (`id`, `name`, `team_id`, `role_id`, `created_at`, `updated_at`, `password`, `phone`) VALUES
(6, 'Văn Huy', 2, 1, NULL, NULL, '$2y$12$I9n4JgFhZ962Ka51.MfhSeUZpJmna.xoujIWEmqzz334VPvJJo/hC', '0335147577');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `staff_implement_jobs`
--

CREATE TABLE `staff_implement_jobs` (
  `id` int(10) UNSIGNED NOT NULL,
  `job_id` int(10) UNSIGNED NOT NULL,
  `staff_id` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `staff_implement_jobs`
--

INSERT INTO `staff_implement_jobs` (`id`, `job_id`, `staff_id`, `created_at`, `updated_at`) VALUES
(2, 40, '2,4', '2023-12-20 19:10:48', '2023-12-20 19:31:05'),
(4, 6, '4,5', '2023-12-21 18:18:43', '2023-12-21 18:18:43'),
(5, 23, '5,2,3', '2023-12-21 18:19:03', '2023-12-21 18:19:03'),
(6, 17, '5,4', '2023-12-21 18:19:23', '2023-12-21 18:19:23'),
(7, 42, '2,6', '2023-12-26 19:32:33', '2023-12-26 19:32:33'),
(8, 43, '6', '2024-01-02 18:59:31', '2024-01-02 18:59:31');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `teams`
--

CREATE TABLE `teams` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `teams`
--

INSERT INTO `teams` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Thiết kế', '2023-11-28 02:09:00', '2023-11-28 02:24:27'),
(2, 'Lập trình', '2023-11-28 02:09:00', '2023-11-28 02:24:18'),
(3, 'Truyền thông', '2023-11-28 02:20:00', '2023-11-28 02:20:43');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `team_implement_jobs`
--

CREATE TABLE `team_implement_jobs` (
  `id` int(10) UNSIGNED NOT NULL,
  `team_id` int(10) UNSIGNED NOT NULL,
  `job_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `team_implement_jobs`
--

INSERT INTO `team_implement_jobs` (`id`, `team_id`, `job_id`, `created_at`, `updated_at`) VALUES
(1, 2, 21, '2023-12-18 19:32:54', '2023-12-18 19:32:54'),
(2, 2, 22, '2023-12-18 19:33:44', '2023-12-18 19:33:44'),
(3, 3, 23, '2023-12-18 20:28:05', '2023-12-18 20:28:05'),
(4, 3, 14, '2023-12-18 20:41:29', '2023-12-18 20:45:48'),
(18, 2, 40, '2023-12-20 19:10:48', '2023-12-20 19:10:48'),
(20, 2, 6, '2023-12-21 18:18:43', '2023-12-21 18:18:43'),
(21, 2, 17, '2023-12-21 18:19:23', '2023-12-21 18:19:23'),
(22, 2, 42, '2023-12-26 19:32:33', '2023-12-26 19:32:33'),
(23, 2, 43, '2024-01-02 18:59:31', '2024-01-02 18:59:31');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tests`
--

CREATE TABLE `tests` (
  `id` int(10) UNSIGNED NOT NULL,
  `multiple_select` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `translations`
--

CREATE TABLE `translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `table_name` varchar(255) NOT NULL,
  `column_name` varchar(255) NOT NULL,
  `foreign_key` int(10) UNSIGNED NOT NULL,
  `locale` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `translations`
--

INSERT INTO `translations` (`id`, `table_name`, `column_name`, `foreign_key`, `locale`, `value`, `created_at`, `updated_at`) VALUES
(1, 'data_types', 'display_name_singular', 5, 'pt', 'Post', '2023-11-27 23:54:13', '2023-11-27 23:54:13'),
(2, 'data_types', 'display_name_singular', 6, 'pt', 'Página', '2023-11-27 23:54:13', '2023-11-27 23:54:13'),
(3, 'data_types', 'display_name_singular', 1, 'pt', 'Utilizador', '2023-11-27 23:54:13', '2023-11-27 23:54:13'),
(4, 'data_types', 'display_name_singular', 4, 'pt', 'Categoria', '2023-11-27 23:54:13', '2023-11-27 23:54:13'),
(5, 'data_types', 'display_name_singular', 2, 'pt', 'Menu', '2023-11-27 23:54:13', '2023-11-27 23:54:13'),
(6, 'data_types', 'display_name_singular', 3, 'pt', 'Função', '2023-11-27 23:54:13', '2023-11-27 23:54:13'),
(7, 'data_types', 'display_name_plural', 5, 'pt', 'Posts', '2023-11-27 23:54:13', '2023-11-27 23:54:13'),
(8, 'data_types', 'display_name_plural', 6, 'pt', 'Páginas', '2023-11-27 23:54:13', '2023-11-27 23:54:13'),
(9, 'data_types', 'display_name_plural', 1, 'pt', 'Utilizadores', '2023-11-27 23:54:13', '2023-11-27 23:54:13'),
(10, 'data_types', 'display_name_plural', 4, 'pt', 'Categorias', '2023-11-27 23:54:13', '2023-11-27 23:54:13'),
(11, 'data_types', 'display_name_plural', 2, 'pt', 'Menus', '2023-11-27 23:54:13', '2023-11-27 23:54:13'),
(12, 'data_types', 'display_name_plural', 3, 'pt', 'Funções', '2023-11-27 23:54:13', '2023-11-27 23:54:13'),
(13, 'categories', 'slug', 1, 'pt', 'categoria-1', '2023-11-27 23:54:13', '2023-11-27 23:54:13'),
(14, 'categories', 'name', 1, 'pt', 'Categoria 1', '2023-11-27 23:54:13', '2023-11-27 23:54:13'),
(15, 'categories', 'slug', 2, 'pt', 'categoria-2', '2023-11-27 23:54:13', '2023-11-27 23:54:13'),
(16, 'categories', 'name', 2, 'pt', 'Categoria 2', '2023-11-27 23:54:13', '2023-11-27 23:54:13'),
(17, 'pages', 'title', 1, 'pt', 'Olá Mundo', '2023-11-27 23:54:13', '2023-11-27 23:54:13'),
(18, 'pages', 'slug', 1, 'pt', 'ola-mundo', '2023-11-27 23:54:13', '2023-11-27 23:54:13'),
(19, 'pages', 'body', 1, 'pt', '<p>Olá Mundo. Scallywag grog swab Cat o\'nine tails scuttle rigging hardtack cable nipper Yellow Jack. Handsomely spirits knave lad killick landlubber or just lubber deadlights chantey pinnace crack Jennys tea cup. Provost long clothes black spot Yellow Jack bilged on her anchor league lateen sail case shot lee tackle.</p>\r\n<p>Ballast spirits fluke topmast me quarterdeck schooner landlubber or just lubber gabion belaying pin. Pinnace stern galleon starboard warp carouser to go on account dance the hempen jig jolly boat measured fer yer chains. Man-of-war fire in the hole nipperkin handsomely doubloon barkadeer Brethren of the Coast gibbet driver squiffy.</p>', '2023-11-27 23:54:13', '2023-11-27 23:54:13'),
(20, 'menu_items', 'title', 1, 'pt', 'Painel de Controle', '2023-11-27 23:54:13', '2023-11-27 23:54:13'),
(21, 'menu_items', 'title', 2, 'pt', 'Media', '2023-11-27 23:54:13', '2023-11-27 23:54:13'),
(22, 'menu_items', 'title', 12, 'pt', 'Publicações', '2023-11-27 23:54:13', '2023-11-27 23:54:13'),
(23, 'menu_items', 'title', 3, 'pt', 'Utilizadores', '2023-11-27 23:54:13', '2023-11-27 23:54:13'),
(24, 'menu_items', 'title', 11, 'pt', 'Categorias', '2023-11-27 23:54:13', '2023-11-27 23:54:13'),
(25, 'menu_items', 'title', 13, 'pt', 'Páginas', '2023-11-27 23:54:13', '2023-11-27 23:54:13'),
(26, 'menu_items', 'title', 4, 'pt', 'Funções', '2023-11-27 23:54:13', '2023-11-27 23:54:13'),
(27, 'menu_items', 'title', 5, 'pt', 'Ferramentas', '2023-11-27 23:54:13', '2023-11-27 23:54:13'),
(28, 'menu_items', 'title', 6, 'pt', 'Menus', '2023-11-27 23:54:13', '2023-11-27 23:54:13'),
(29, 'menu_items', 'title', 7, 'pt', 'Base de dados', '2023-11-27 23:54:13', '2023-11-27 23:54:13'),
(30, 'menu_items', 'title', 10, 'pt', 'Configurações', '2023-11-27 23:54:13', '2023-11-27 23:54:13');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT 'users/default.png',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `settings` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `team_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `avatar`, `email_verified_at`, `password`, `remember_token`, `settings`, `created_at`, `updated_at`, `team_id`) VALUES
(1, 1, 'Admin', 'admin@admin.com', 'users/December2023/DtSb1RFnr06AULVSG4Yd.png', NULL, '$2y$12$cRLmxzAvD0JKK0HvqryfH.rtHDHE2gsgZ0cc2C6qbPa/AF9.xY/iO', '0edlYzLMnm6h7Jdz5ms69kqkAf6q1rwCjPLKAr8mZfFHEzOIHB4RDBXUgny3', '{\"locale\":\"en\"}', '2023-11-27 23:54:13', '2023-12-26 18:53:57', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_roles`
--

CREATE TABLE `user_roles` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`);

--
-- Chỉ mục cho bảng `data_rows`
--
ALTER TABLE `data_rows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data_rows_data_type_id_foreign` (`data_type_id`);

--
-- Chỉ mục cho bảng `data_types`
--
ALTER TABLE `data_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `data_types_name_unique` (`name`),
  ADD UNIQUE KEY `data_types_slug_unique` (`slug`);

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
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `list_comments`
--
ALTER TABLE `list_comments`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menus_name_unique` (`name`);

--
-- Chỉ mục cho bảng `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_items_menu_id_foreign` (`menu_id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pages_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permissions_key_index` (`key`);

--
-- Chỉ mục cho bảng `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_permission_id_index` (`permission_id`),
  ADD KEY `permission_role_role_id_index` (`role_id`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Chỉ mục cho bảng `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Chỉ mục cho bảng `staffs`
--
ALTER TABLE `staffs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `staff_implement_jobs`
--
ALTER TABLE `staff_implement_jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ForeignKey_JobId` (`job_id`);

--
-- Chỉ mục cho bảng `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `team_implement_jobs`
--
ALTER TABLE `team_implement_jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ForeignKey_TeamId` (`team_id`),
  ADD KEY `ForeignKey_JobId` (`job_id`);

--
-- Chỉ mục cho bảng `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `translations`
--
ALTER TABLE `translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `translations_table_name_column_name_foreign_key_locale_unique` (`table_name`,`column_name`,`foreign_key`,`locale`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Chỉ mục cho bảng `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `user_roles_user_id_index` (`user_id`),
  ADD KEY `user_roles_role_id_index` (`role_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `data_rows`
--
ALTER TABLE `data_rows`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT cho bảng `data_types`
--
ALTER TABLE `data_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT cho bảng `list_comments`
--
ALTER TABLE `list_comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `staffs`
--
ALTER TABLE `staffs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `staff_implement_jobs`
--
ALTER TABLE `staff_implement_jobs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `team_implement_jobs`
--
ALTER TABLE `team_implement_jobs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `tests`
--
ALTER TABLE `tests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `translations`
--
ALTER TABLE `translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `data_rows`
--
ALTER TABLE `data_rows`
  ADD CONSTRAINT `data_rows_data_type_id_foreign` FOREIGN KEY (`data_type_id`) REFERENCES `data_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `menu_items`
--
ALTER TABLE `menu_items`
  ADD CONSTRAINT `menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `staff_implement_jobs`
--
ALTER TABLE `staff_implement_jobs`
  ADD CONSTRAINT `staff_implement_jobs_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`);

--
-- Các ràng buộc cho bảng `team_implement_jobs`
--
ALTER TABLE `team_implement_jobs`
  ADD CONSTRAINT `team_implement_jobs_ibfk_1` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`),
  ADD CONSTRAINT `team_implement_jobs_ibfk_2` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`);

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Các ràng buộc cho bảng `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
