-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2026 at 08:53 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iiser-dosa`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `id` int(11) NOT NULL,
  `content` longtext DEFAULT NULL,
  `last_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`id`, `content`, `last_updated`, `updated_by`) VALUES
(1, '<h2 style=\"font-size: 2.5rem; margin-bottom: 0.5rem; color: var(--text-dark, #333); font-weight: 600; border-left-width: medium; border-left-style: none; border-left-color: currentcolor; padding-left: 0px; margin-top: 0px;\">Introduction</h2><p class=\"ql-align-justify\" style=\"font-size: 1.1rem; line-height: 1.6; color: var(--text-muted, #666); margin-bottom: 1rem; text-align: justify;\">The <strong>Office of Students\' Affairs (OSA)</strong> serves as the primary support system for students at the Indian Institute of Science Education and Research (IISER) Kolkata, fostering an environment where academic excellence is complemented by personal growth and holistic development. The office is committed to ensuring a safe, inclusive, and vibrant campus experience by overseeing student welfare, residential life, healthcare, counselling, campus security, and a wide range of extracurricular activities. Through comprehensive support services and opportunities for leadership, collaboration, and community engagement, the Office of Students\' Affairs strives to make every student\'s journey at IISER Kolkata enriching, rewarding, and memorable.</p><h2 class=\"ql-align-justify\" style=\"font-size: 2.5rem; margin-bottom: 0.5rem; color: var(--text-dark, #333); font-weight: 600; border-left-width: medium; border-left-style: none; border-left-color: currentcolor; padding-left: 0px;\">Our Vision</h2><p class=\"ql-align-justify\" style=\"font-size: 1.1rem; line-height: 1.6; color: var(--text-muted, #666); margin-bottom: 1rem; text-align: justify;\">To foster a vibrant, inclusive, and supportive campus community where every student is empowered to excel academically, grow personally, and lead with integrity. The Office of Students\' Affairs envisions IISER Kolkata as a place where learning extends beyond the classroom, encouraging innovation, collaboration, well-being, and responsible citizenship through a rich and engaging student life.</p><h2 class=\"ql-align-justify\" style=\"font-size: 2.5rem; margin-bottom: 0.5rem; color: var(--text-dark, #333); font-weight: 600; border-left-width: medium; border-left-style: none; border-left-color: currentcolor; padding-left: 0px;\">Our Mission</h2><p style=\"font-size: 1.1rem; line-height: 1.6; color: var(--text-muted, #666); margin-bottom: 1rem; text-align: justify;\" class=\"ql-align-justify\">The Office of Students\' Affairs is committed to enhancing the overall student experience by providing a safe, inclusive, and nurturing environment. We oversee residential life, student welfare, healthcare, counselling, campus security, and essential support services while promoting participation in cultural, technical, literary, and sports activities. Through student clubs, leadership opportunities, and community engagement, we strive to ensure the holistic development of every student and create an enriching campus experience throughout their journey at IISER Kolkata.</p>', '2026-07-21 00:14:38', 'admin@iiser.ac.in');

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` int(11) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `module` varchar(100) NOT NULL,
  `action_type` varchar(50) NOT NULL,
  `details` text DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `admin_email`, `module`, `action_type`, `details`, `ip_address`, `created_at`) VALUES
(453, 'admin@iiser.ac.in', 'Authentication', 'LOGIN', 'Admin login successful: admin@iiser.ac.in', '::1', '2026-07-19 19:31:00'),
(454, 'admin@iiser.ac.in', 'Authentication', 'LOGOUT', 'Admin logout successful: admin@iiser.ac.in', '::1', '2026-07-19 19:34:16'),
(455, 'admin@iiser.ac.in', 'Authentication', 'LOGIN', 'Admin login successful: admin@iiser.ac.in', '::1', '2026-07-19 19:34:27'),
(456, 'admin@iiser.ac.in', 'Authentication', 'LOGIN', 'Admin login successful: admin@iiser.ac.in', '127.0.0.1', '2026-07-20 15:55:42'),
(457, 'admin@iiser.ac.in', 'Page Content', 'UPDATE', 'Updated static HTML page: deans_message', '127.0.0.1', '2026-07-20 16:11:01'),
(458, 'admin@iiser.ac.in', 'Page Content', 'UPDATE', 'Updated static HTML page: about_us', '127.0.0.1', '2026-07-20 16:16:02'),
(459, 'admin@iiser.ac.in', 'Page Content', 'UPDATE', 'Updated static HTML page: about_us', '127.0.0.1', '2026-07-20 16:16:10'),
(460, 'admin@iiser.ac.in', 'Notices', 'CREATE', 'Created new notice ID 10: Notice 1', '127.0.0.1', '2026-07-20 16:49:54'),
(461, 'admin@iiser.ac.in', 'Notices', 'UPDATE', 'Updated notice ID 10: Notice 1 test Notice 1 test Notice 1 test Notice 1 test Notice 1 test Notice 1 test', '127.0.0.1', '2026-07-20 16:53:37'),
(462, 'admin@iiser.ac.in', 'Notices', 'UPDATE', 'Updated notice ID 10: Notice 1 test Notice 1 test Notice 1 test Notice 1 test Notice 1 test Notice 1 test  1 test Notice 1 test  1 test Notice 1 test  1 test Notice 1 test  1 test Notice 1 test  1 test Notice 1 test 1 test Notice 1 test 1 test Notice 1 test', '127.0.0.1', '2026-07-20 16:57:19'),
(463, 'admin@iiser.ac.in', 'Banners', 'UPDATE', 'Toggled banner ID 1 active status to 0', '127.0.0.1', '2026-07-20 17:05:54'),
(464, 'admin@iiser.ac.in', 'Banners', 'UPDATE', 'Toggled banner ID 1 active status to 1', '127.0.0.1', '2026-07-20 17:05:55'),
(465, 'admin@iiser.ac.in', 'Videos', 'CREATE', 'Added new video: test', '127.0.0.1', '2026-07-20 17:33:58'),
(466, 'admin@iiser.ac.in', 'Gallery', 'CREATE', 'Created new gallery ID 1: Test', '127.0.0.1', '2026-07-20 17:41:21'),
(467, 'admin@iiser.ac.in', 'Gallery', 'CREATE', 'Created new gallery ID 2: Test fssdd', '127.0.0.1', '2026-07-20 17:46:29'),
(468, 'admin@iiser.ac.in', 'Authentication', 'LOGIN', 'Admin login successful: admin@iiser.ac.in', '::1', '2026-07-20 21:11:01'),
(469, 'admin@iiser.ac.in', 'Page Content', 'UPDATE', 'Updated page: about_us', '::1', '2026-07-20 21:12:10'),
(470, 'admin@iiser.ac.in', 'Page Content', 'UPDATE', 'Updated page: about_us', '::1', '2026-07-20 21:32:15'),
(471, 'admin@iiser.ac.in', 'Page Content', 'UPDATE', 'Updated page: about_us', '::1', '2026-07-20 21:32:57'),
(472, 'admin@iiser.ac.in', 'Page Content', 'UPDATE', 'Updated page: about_us', '::1', '2026-07-20 21:38:16'),
(473, 'admin@iiser.ac.in', 'Page Content', 'UPDATE', 'Updated page: about_us', '::1', '2026-07-20 21:38:52'),
(474, 'admin@iiser.ac.in', 'Page Content', 'UPDATE', 'Updated page: about_us', '::1', '2026-07-20 21:50:38'),
(475, 'admin@iiser.ac.in', 'Page Content', 'UPDATE', 'Updated page: about_us', '::1', '2026-07-20 22:08:59'),
(476, 'admin@iiser.ac.in', 'Page Content', 'UPDATE', 'Updated page: about_us', '::1', '2026-07-20 22:17:19'),
(477, 'admin@iiser.ac.in', 'Page Content', 'UPDATE', 'Updated page: about_us', '::1', '2026-07-20 22:22:27'),
(478, 'admin@iiser.ac.in', 'Page Content', 'UPDATE', 'Updated page: about_us', '::1', '2026-07-20 22:22:46'),
(479, 'admin@iiser.ac.in', 'Page Content', 'UPDATE', 'Updated page: about_us', '::1', '2026-07-21 00:14:38');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`, `last_login`, `created_at`) VALUES
(2, 'admin@iiser.ac.in', '$2y$10$Orf442CZoB9rIY6UVEODtu1LhxA0tUWdPp1hCg4JD85C9zn003jnK', '2026-07-20 21:11:01', '2026-07-19 14:00:21');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `content` longtext DEFAULT NULL,
  `last_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(100) DEFAULT NULL,
  `office_address` text DEFAULT NULL,
  `email_address` varchar(255) DEFAULT NULL,
  `phone_number` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deans_message`
--

CREATE TABLE `deans_message` (
  `id` int(11) NOT NULL,
  `content` longtext DEFAULT NULL,
  `last_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deans_message`
--

INSERT INTO `deans_message` (`id`, `content`, `last_updated`, `updated_by`) VALUES
(1, '<h2 style=\"border-left: 4px solid rgb(245, 158, 11); padding-left: 12px; color: rgb(26, 26, 26); font-weight: 600; margin-top: 0px;\">Message from the Deans</h2><p>\r\n</p><p>Many congratulations and a warm welcome to IISER Kolkata!</p><p>\r\n</p><p>We are confident that your journey here will be enriching, memorable, and full of lifelong friendships. IISER Kolkata will offer you not only academic training and research exposure, but also opportunities for personal growth, community life, and exploration beyond the classroom.</p><p>\r\n</p><p>The Office of the Dean, Academic Affairs, also known as the Academic Cell, looks after all academic matters of the Institute, from admission to the awarding of degrees. For academic issues, BS-MS students may contact the Institute UGAC Convenor, IPhD students may contact the departmental UGAC Convenor, and PhD students may contact the departmental PGAC Convenor. Students may also approach the General Secretaries, Academic, of the Students’ Affairs Council for help in presenting academic concerns.</p><p>\r\n</p><p>The Office of the Dean of Students’ Affairs, through the Students’ Affairs Section, is committed to student welfare, hostel life, campus activities, and overall well-being. It acts as a liaison between students, faculty members, and the administration, and serves as a central point of contact for student-related support, campus resources, and policy-related queries.</p><p>\r\n</p><p>This booklet is intended to help you become familiar with academic matters, campus living, emergency contacts, student facilities, and the Students’ Affairs Council. We encourage you to use these resources fully and participate actively in campus life.</p><p>\r\n</p><p>The Students’ Affairs Office is located in the AAC Building, Room Nos. 106 and 107.</p><p>\r\n</p><p>Further details are available at:\r\n<a href=\"http://intranet.iiserkol.ac.in/wiki/AcadCoord:Home\">http://intranet.iiserkol.ac.in/wiki/AcadCoord:Home</a>\r\n<a href=\"http://intranet.iiserkol.ac.in/wiki/Student_Affairs:Home\">http://intranet.iiserkol.ac.in/wiki/Student_Affairs:Home</a></p><p>\r\n</p><p>\r\n</p><p><br></p><p>\r\n</p>', '2026-07-20 16:29:22', 'migration_script');

-- --------------------------------------------------------

--
-- Table structure for table `director_message`
--

CREATE TABLE `director_message` (
  `id` int(11) NOT NULL,
  `content` longtext DEFAULT NULL,
  `last_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `director_message`
--

INSERT INTO `director_message` (`id`, `content`, `last_updated`, `updated_by`) VALUES
(1, '<h2>Message from the Director, IISER Kolkata</h2>\n<p>Dear Students,</p>\n<p>Greetings and a warm welcome to IISER Kolkata!</p>\n<p>It is a matter of great joy to welcome you into our academic community. As you begin this new chapter of your educational journey, you are entering an institution that values curiosity and creativity. Each of you brings unique talents and aspirations, and together you will enrich the vibrant culture of learning and discovery that defines IISER Kolkata.</p>\n<p>We encourage you to engage wholeheartedly with your studies, participate actively in campus life, and uphold the values of integrity, respect, and inclusiveness. Your time here will not only shape your academic growth but also prepare you to contribute meaningfully to society and to the advancement of science.</p>\n<p>On behalf of the entire IISER Kolkata fraternity, I extend my heartfelt wishes for your continued learning, exploration, and fulfillment. May your journey here at IISER Kolkata be inspiring and transformative.</p>\n<p>I warmly welcome you all to IISER Kolkata and wish you an enriching journey of learning, exploration and fulfillment. Thank you !</p>\n<p>Sd/- Prof. Sunil Kumar Khare<br>Director, IISER Kolkata</p>\n', '2026-07-20 16:29:22', 'migration_script');

-- --------------------------------------------------------

--
-- Table structure for table `forms_downloads`
--

CREATE TABLE `forms_downloads` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `files` text NOT NULL COMMENT 'JSON array of file paths',
  `visible_from` date NOT NULL,
  `visible_upto` date DEFAULT NULL,
  `display_type` enum('Internal','Public') DEFAULT 'Public',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `forms_downloads`
--

INSERT INTO `forms_downloads` (`id`, `title`, `files`, `visible_from`, `visible_upto`, `display_type`, `created_at`) VALUES
(3, 'test', '[{\"name\":\"antara_resume_finalpdf - Antara Debroy.pdf\",\"path\":\"uploads\\/forms\\/6a5e176209a53_antara_resume_finalpdf_-_Antara_Debroy.pdf\"}]', '2026-07-20', '2026-07-21', 'Public', '2026-07-20 12:41:06'),
(4, 'gbgc', '[{\"name\":\"220520251313admitcard.pdf\",\"path\":\"uploads\\/forms\\/6a5e1775e91ab_220520251313admitcard.pdf\"}]', '2026-07-20', '2026-07-22', 'Internal', '2026-07-20 12:41:25');

-- --------------------------------------------------------

--
-- Table structure for table `gallery_items`
--

CREATE TABLE `gallery_items` (
  `id` int(11) NOT NULL,
  `type` enum('photo','video') NOT NULL DEFAULT 'photo',
  `title` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `media_path` varchar(500) NOT NULL,
  `display_order` int(11) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallery_items`
--

INSERT INTO `gallery_items` (`id`, `type`, `title`, `category`, `media_path`, `display_order`, `created_at`) VALUES
(1, 'photo', 'Academic Block Facade', 'campus', 'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?w=600&q=70', 0, '2026-07-20 17:26:33'),
(2, 'photo', 'Confluence 2024', 'events', 'https://images.unsplash.com/photo-1523580494863-6f3031224c94?w=600&q=70', 0, '2026-07-20 17:26:33'),
(3, 'photo', 'Basketball Court', 'sports', 'https://images.unsplash.com/photo-1461896836934-ffe607ba8211?w=600&q=70', 0, '2026-07-20 17:26:33'),
(4, 'photo', 'Boys Hostel', 'hostels', 'https://images.unsplash.com/photo-1555854877-bab0e564b8d5?w=600&q=70', 0, '2026-07-20 17:26:33');

-- --------------------------------------------------------

--
-- Table structure for table `homepage_banners`
--

CREATE TABLE `homepage_banners` (
  `id` int(11) NOT NULL,
  `image_path` varchar(500) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `button_text` varchar(100) DEFAULT NULL,
  `button_link` varchar(500) DEFAULT NULL,
  `sort_order` int(11) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `homepage_banners`
--

INSERT INTO `homepage_banners` (`id`, `image_path`, `title`, `description`, `button_text`, `button_link`, `sort_order`, `is_active`, `created_at`) VALUES
(1, 'https://images.unsplash.com/photo-1562774053-701939374585?q=80&w=1920&auto=format&fit=crop', 'Main Academic Block — Autumn Semester', 'Experience world-class research facilities and modern lecture halls.', 'Take a Tour', '#gallery', 1, 1, '2026-07-20 11:35:49'),
(2, 'https://images.unsplash.com/photo-1568667256549-094345857637?q=80&w=1920&auto=format&fit=crop', 'Central Library & Reading Halls', 'Access thousands of journals, books, and quiet spaces for deep focus.', '', '', 2, 1, '2026-07-20 11:35:49'),
(3, 'https://images.unsplash.com/photo-1555854877-bab0e564b8d5?q=80&w=1920&auto=format&fit=crop', 'Student Residences at Dusk', 'A home away from home. Safe, vibrant, and highly collaborative.', 'Hostel Life', '#services', 3, 1, '2026-07-20 11:35:49');

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `pdf_path` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `type` varchar(50) NOT NULL,
  `status` varchar(20) DEFAULT 'published',
  `scheduled_time` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `other_type_name` varchar(50) DEFAULT NULL,
  `is_pinned` tinyint(1) DEFAULT 0,
  `pinned_till` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`id`, `title`, `pdf_path`, `link`, `type`, `status`, `scheduled_time`, `created_at`, `other_type_name`, `is_pinned`, `pinned_till`) VALUES
(3, 'Notice 1 test Notice 1 test Notice 1 test Notice 1 test Notice 1 test Notice 1 test', 'dist/notices/notice_1784546394_6a5e045a50e36.pdf', 'https://www.youtube.com', 'Academic', 'published', NULL, '2026-07-20 16:49:54', '', 0, NULL),
(4, 'Notice 1 test Notice 1 test Notice 1 test Notice 1 test Notice 1 test Notice 1 test', 'dist/notices/notice_1784546394_6a5e045a50e36.pdf', 'https://www.youtube.com', 'Academic', 'published', NULL, '2026-07-20 16:49:54', '', 0, NULL),
(10, 'Notice 1 test Notice 1 test Notice 1 test Notice 1 test Notice 1 test Notice 1 test  1 test Notice 1 test  1 test Notice 1 test  1 test Notice 1 test  1 test Notice 1 test  1 test Notice 1 test 1 test Notice 1 test 1 test Notice 1 test', 'dist/notices/notice_1784546394_6a5e045a50e36.pdf', 'https://www.youtube.com', 'Academic', 'published', NULL, '2026-07-20 16:49:54', '', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `photo_galleries`
--

CREATE TABLE `photo_galleries` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `photo_galleries`
--

INSERT INTO `photo_galleries` (`id`, `title`, `description`, `created_by`, `created_at`) VALUES
(1, 'Test', NULL, 'admin@iiser.ac.in', '2026-07-20 17:41:21'),
(2, 'Test fssdd', NULL, 'admin@iiser.ac.in', '2026-07-20 17:46:29');

-- --------------------------------------------------------

--
-- Table structure for table `photo_gallery_images`
--

CREATE TABLE `photo_gallery_images` (
  `id` int(11) NOT NULL,
  `gallery_id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `display_order` int(11) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `photo_gallery_images`
--

INSERT INTO `photo_gallery_images` (`id`, `gallery_id`, `image_path`, `display_order`, `created_at`) VALUES
(1, 1, 'dist/img/galleries/gallery_1784549481_6a5e10693b8e5.png', 1, '2026-07-20 17:41:21'),
(2, 2, 'dist/img/galleries/gallery_1784549790_6a5e119e002ca.jpg', 1, '2026-07-20 17:46:30');

-- --------------------------------------------------------

--
-- Table structure for table `press_releases`
--

CREATE TABLE `press_releases` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `author` varchar(255) DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `video_type` enum('upload','youtube') NOT NULL DEFAULT 'youtube',
  `video_url` varchar(255) NOT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `display_order` int(11) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `video_type`, `video_url`, `caption`, `display_order`, `created_at`) VALUES
(1, 'youtube', 'https://www.youtube.com/embed/dQw4w9WgXcQ', 'IISER Campus Tour & Insights', 0, '2026-07-20 17:20:40'),
(2, 'youtube', 'https://www.youtube.com/embed/3JZ_D3ELwOQ', 'Student Testimonials', 0, '2026-07-20 17:20:40'),
(3, 'youtube', 'https://www.youtube.com/embed/lTRiuFIWV54', 'Annual Convocation Highlight', 0, '2026-07-20 17:20:40'),
(4, 'upload', 'dist/vid/video_1784549038_6a5e0eaed47a8.mp4', 'test', 1, '2026-07-20 17:33:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deans_message`
--
ALTER TABLE `deans_message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `director_message`
--
ALTER TABLE `director_message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forms_downloads`
--
ALTER TABLE `forms_downloads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery_items`
--
ALTER TABLE `gallery_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homepage_banners`
--
ALTER TABLE `homepage_banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photo_galleries`
--
ALTER TABLE `photo_galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photo_gallery_images`
--
ALTER TABLE `photo_gallery_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gallery_id` (`gallery_id`);

--
-- Indexes for table `press_releases`
--
ALTER TABLE `press_releases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=480;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `deans_message`
--
ALTER TABLE `deans_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `director_message`
--
ALTER TABLE `director_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `forms_downloads`
--
ALTER TABLE `forms_downloads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `gallery_items`
--
ALTER TABLE `gallery_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `homepage_banners`
--
ALTER TABLE `homepage_banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `photo_galleries`
--
ALTER TABLE `photo_galleries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `photo_gallery_images`
--
ALTER TABLE `photo_gallery_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `press_releases`
--
ALTER TABLE `press_releases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `photo_gallery_images`
--
ALTER TABLE `photo_gallery_images`
  ADD CONSTRAINT `photo_gallery_images_ibfk_1` FOREIGN KEY (`gallery_id`) REFERENCES `photo_galleries` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
