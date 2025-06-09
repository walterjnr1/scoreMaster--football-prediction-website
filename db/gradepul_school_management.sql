-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 28, 2025 at 06:40 PM
-- Server version: 11.4.7-MariaDB
-- PHP Version: 8.3.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gradepul_school_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_session`
--

CREATE TABLE `academic_session` (
  `id` int(11) NOT NULL,
  `school_id` int(11) DEFAULT NULL,
  `session` varchar(100) DEFAULT NULL,
  `term` varchar(50) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` int(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `academic_session`
--

INSERT INTO `academic_session` (`id`, `school_id`, `session`, `term`, `start_date`, `end_date`, `status`) VALUES
(13, 11, '2024/2025', '1st', '2025-05-08', '2025-06-06', 0),
(14, 14, '2024/2025', '1st', '2024-01-02', '2025-12-28', 1),
(15, 11, '2024/2025', '2nd', '2025-05-16', '2025-06-06', 1),
(17, 16, '2024/2025', '1st', '2025-05-04', '2025-05-16', 0),
(18, 16, '2024/2025', '2nd', '2025-05-15', '2025-06-08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` int(11) NOT NULL,
  `school_id` int(11) DEFAULT NULL,
  `user_id` varchar(125) NOT NULL,
  `role` varchar(15) NOT NULL,
  `operation` text DEFAULT NULL,
  `ip_address` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `school_id`, `user_id`, `role`, `operation`, `ip_address`, `created_at`) VALUES
(477, 14, '17', 'Teacher', 'Created user: Osei Seth on 2025-05-27 19:48:23', '41.215.165.251', '2025-05-27 19:48:24'),
(478, 14, '17', 'Admin', 'updated paystack details on 2025-05-27 19:53:30', '41.215.165.251', '2025-05-27 19:53:31'),
(479, 14, '17', 'Admin', 'Created a session: 2025/2026 and 2nd on 2025-05-27 23:16:43', '41.215.171.54', '2025-05-27 23:16:44'),
(480, 14, '17', 'Admin', 'Allocated subject to a teacher on 2025-05-27 23:34:41', '41.215.171.54', '2025-05-27 23:34:42'),
(481, 14, '17', 'Admin', 'Allocated subject to a teacher on 2025-05-27 23:34:48', '41.215.171.54', '2025-05-27 23:34:49'),
(482, 14, '17', 'Admin', 'Allocated subject to a teacher on 2025-05-27 23:34:56', '41.215.171.54', '2025-05-27 23:34:56'),
(483, 14, '17', 'Admin', 'Allocated subject to a teacher on 2025-05-27 23:35:03', '41.215.171.54', '2025-05-27 23:35:03'),
(484, 14, '17', 'Admin', 'Created permission on 2025-05-27 23:39:12', '41.215.171.54', '2025-05-27 23:39:14'),
(485, 16, '24', 'Admin', 'Created permission on 2025-05-28 11:08:53', '197.210.226.205', '2025-05-28 11:08:56'),
(486, 16, '24', 'Admin', 'Created permission on 2025-05-28 11:11:15', '197.210.226.205', '2025-05-28 11:11:16'),
(487, 16, '24', 'Admin', 'registered student on 2025-05-28 11:43:18', '197.210.226.205', '2025-05-28 11:43:18'),
(488, 16, '24', 'Admin', 'registered student on 2025-05-28 11:43:18', '197.210.226.205', '2025-05-28 11:43:18'),
(489, 16, '24', 'Admin', 'Edited school contact details: 2025-05-28 11:44:01', '197.210.226.205', '2025-05-28 11:44:01'),
(490, 16, '24', 'Admin', 'updated headmaster/headmistress data on 2025-05-28 11:44:21', '197.210.226.205', '2025-05-28 11:44:21'),
(491, 16, '24', 'Admin', 'updated scratch card amount on 2025-05-28 11:44:28', '197.210.226.205', '2025-05-28 11:44:29'),
(492, 16, '24', 'Admin', 'updated paystack details on 2025-05-28 11:45:18', '197.210.226.205', '2025-05-28 11:45:18'),
(493, 16, '24', 'Admin', 'Created a session: 2024/2025 and 1st on 2025-05-28 11:46:35', '197.210.226.205', '2025-05-28 11:46:35'),
(494, 16, '24', 'Teacher', 'Created user: Daniel Edem on 2025-05-28 11:48:28', '197.210.226.205', '2025-05-28 11:48:29'),
(495, 16, '24', 'Admin', 'Created Class: jss1A on 2025-05-28 11:48:46', '197.210.226.205', '2025-05-28 11:48:46'),
(496, 16, '24', 'Admin', 'Assigned student to a Class on 2025-05-28 11:49:20', '197.210.226.205', '2025-05-28 11:49:20'),
(497, 16, '24', 'Admin', 'Assigned student to a Class on 2025-05-28 11:49:25', '197.210.226.205', '2025-05-28 11:49:26'),
(498, 16, '24', 'Admin', 'registered student on 2025-05-28 11:51:44', '197.210.226.205', '2025-05-28 11:51:44'),
(499, 16, '24', 'Admin', 'registered student on 2025-05-28 11:51:44', '197.210.226.205', '2025-05-28 11:51:45'),
(500, 16, '24', 'Admin', 'registered student on 2025-05-28 11:55:20', '197.210.226.205', '2025-05-28 11:55:20'),
(501, 16, '24', 'Admin', 'registered student on 2025-05-28 11:55:20', '197.210.226.205', '2025-05-28 11:55:21'),
(502, 16, '24', 'Admin', 'Assigned student to a Class on 2025-05-28 11:55:32', '197.210.226.205', '2025-05-28 11:55:33'),
(503, 16, '24', 'Admin', 'Assigned student to a Class on 2025-05-28 11:55:39', '197.210.226.205', '2025-05-28 11:55:39'),
(504, 16, '24', 'Admin', 'Created subject: Computer Studies on 2025-05-28 11:55:53', '197.210.226.205', '2025-05-28 11:55:54'),
(505, 16, '24', 'Admin', 'Created subject: Mathematics on 2025-05-28 11:56:00', '197.210.226.205', '2025-05-28 11:56:00'),
(506, 16, '24', 'Admin', 'Assigned Subject to Class on 2025-05-28 11:56:15', '197.210.226.205', '2025-05-28 11:56:15'),
(507, 16, '24', 'Admin', 'Assigned Subject to Class on 2025-05-28 11:56:15', '197.210.226.205', '2025-05-28 11:56:15'),
(508, 16, '25', 'Admin', NULL, '197.210.226.205', '2025-05-28 11:56:39'),
(509, 16, '24', 'Admin', 'Created grading system on 2025-05-28 11:57:23', '197.210.226.205', '2025-05-28 11:57:23'),
(510, 16, '24', 'Admin', 'Created grading system on 2025-05-28 11:57:43', '197.210.226.205', '2025-05-28 11:57:44'),
(511, 16, '24', 'Admin', 'Edited grade: A on 2025-05-28 11:58:58', '197.210.226.205', '2025-05-28 11:58:59'),
(512, 16, '24', 'Admin', 'Edited grade: B on 2025-05-28 11:59:15', '197.210.226.205', '2025-05-28 11:59:16'),
(513, 16, '24', 'Admin', 'Created grading system on 2025-05-28 11:59:33', '197.210.226.205', '2025-05-28 11:59:34'),
(514, 16, '24', 'Admin', 'Created grading system on 2025-05-28 12:00:05', '197.210.226.205', '2025-05-28 12:00:06'),
(515, 16, '24', 'Admin', 'Created grading system on 2025-05-28 12:00:54', '197.210.226.205', '2025-05-28 12:00:55'),
(516, 16, '24', 'Admin', 'Created grading system on 2025-05-28 12:01:11', '197.210.226.205', '2025-05-28 12:01:11'),
(517, 16, '24', 'Admin', 'Created Exam: Final on 2025-05-28 12:02:06', '197.210.226.205', '2025-05-28 12:02:07'),
(518, 16, '24', 'Admin', 'Edited Exams: Midterm on 2025-05-28 12:03:41', '197.210.226.205', '2025-05-28 12:03:42'),
(519, 16, '24', 'Admin', 'Edited Exams: Final on 2025-05-28 12:03:51', '197.210.226.205', '2025-05-28 12:03:51'),
(520, 16, '24', 'Admin', 'logged out on 2025-05-28 12:03:56', '197.210.226.205', '2025-05-28 12:03:56'),
(521, 16, '25', 'Teacher', 'logged out on 2025-05-28 12:04:45', '197.210.226.205', '2025-05-28 12:04:45'),
(522, 16, '25', 'Teacher', 'logged out on 2025-05-28 12:10:44', '197.210.226.205', '2025-05-28 12:10:44'),
(523, 16, '24', 'Admin', 'Created permission on 2025-05-28 12:11:50', '197.210.226.205', '2025-05-28 12:11:51'),
(524, 16, '24', 'Admin', 'logged out on 2025-05-28 12:11:55', '197.210.226.205', '2025-05-28 12:11:55'),
(525, 16, '25', 'Teacher', 'logged out on 2025-05-28 12:12:38', '197.210.226.205', '2025-05-28 12:12:38'),
(526, 16, '24', 'Admin', 'Allocated subject to a teacher on 2025-05-28 12:12:55', '197.210.226.205', '2025-05-28 12:12:55'),
(527, 16, '24', 'Admin', 'Allocated subject to a teacher on 2025-05-28 12:12:59', '197.210.226.205', '2025-05-28 12:12:59'),
(528, 16, '24', 'Admin', 'logged out on 2025-05-28 12:13:43', '197.210.226.205', '2025-05-28 12:13:43'),
(529, 16, '25', 'Teacher', 'Entered student scores for jss1 A - Computer Studies', '197.210.226.205', '2025-05-28 12:14:14'),
(530, 16, '25', 'Teacher', 'Entered student scores for jss1 A - Mathematics', '197.210.226.205', '2025-05-28 12:14:33'),
(531, 16, '25', 'Teacher', 'logged out on 2025-05-28 12:14:49', '197.210.226.205', '2025-05-28 12:14:49'),
(532, 16, '24', 'Admin', 'Created a session: 2024/2025 and 2nd on 2025-05-28 12:15:48', '197.210.226.205', '2025-05-28 12:15:49'),
(533, 16, '24', 'Admin', 'logged out on 2025-05-28 12:15:54', '197.210.226.205', '2025-05-28 12:15:54'),
(534, 16, '25', 'Teacher', 'Entered student scores for jss1 A - Computer Studies', '197.210.226.205', '2025-05-28 12:16:37'),
(535, 16, '25', 'Teacher', 'Entered student scores for jss1 A - Mathematics', '197.210.226.205', '2025-05-28 12:16:54'),
(536, 16, '25', 'Teacher', 'logged out on 2025-05-28 17:32:09', '102.88.111.74', '2025-05-28 17:32:09'),
(537, 16, '24', 'Admin', 'deleted result on 2025-05-28 17:33:35', '102.88.111.74', '2025-05-28 17:33:36'),
(538, 16, '24', 'Admin', 'deleted result on 2025-05-28 17:39:04', '102.88.111.74', '2025-05-28 17:39:05'),
(539, 16, '24', 'Admin', 'deleted overall result and associated scores on 2025-05-28 17:39:04', '102.88.111.74', '2025-05-28 17:39:05'),
(540, 16, '24', 'Admin', 'deleted result on 2025-05-28 17:39:32', '102.88.111.74', '2025-05-28 17:39:33'),
(541, 16, '24', 'Admin', 'deleted overall result and associated scores on 2025-05-28 17:39:32', '102.88.111.74', '2025-05-28 17:39:33'),
(542, 16, '24', 'Admin', 'logged out on 2025-05-28 18:01:55', '102.88.111.74', '2025-05-28 18:01:55'),
(543, 16, '25', 'Teacher', 'Entered student scores for jss1 A - Computer Studies', '102.88.111.74', '2025-05-28 18:02:29'),
(544, 16, '25', 'Teacher', 'Entered student scores for jss1 A - Mathematics', '102.88.111.74', '2025-05-28 18:02:48'),
(545, 16, '25', 'Teacher', 'logged out on 2025-05-28 18:02:52', '102.88.111.74', '2025-05-28 18:02:52'),
(546, 16, '24', 'Admin', 'deleted all scores for student 65 in exam 13, class 22, session 17, school 16 on 2025-05-28 18:03:16', '102.88.111.74', '2025-05-28 18:03:16');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `school_id` int(11) DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
  `section` varchar(50) DEFAULT NULL,
  `next_class` varchar(150) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `school_id`, `name`, `section`, `next_class`, `created_at`) VALUES
(22, 16, 'jss1', 'A', 'jss2A', '2025-05-28 11:48:46');

-- --------------------------------------------------------

--
-- Table structure for table `class_students`
--

CREATE TABLE `class_students` (
  `id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `assigned_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class_students`
--

INSERT INTO `class_students` (`id`, `school_id`, `class_id`, `student_id`, `assigned_at`) VALUES
(10, 14, 19, 38, '2025-05-27 14:55:49'),
(11, 14, 19, 39, '2025-05-27 14:55:58'),
(12, 14, 19, 40, '2025-05-27 14:56:06'),
(13, 14, 19, 41, '2025-05-27 14:56:15'),
(14, 14, 19, 42, '2025-05-27 14:56:58'),
(15, 14, 19, 43, '2025-05-27 14:57:06'),
(16, 14, 19, 44, '2025-05-27 14:57:14'),
(17, 14, 19, 45, '2025-05-27 14:57:34'),
(18, 14, 19, 46, '2025-05-27 14:57:57'),
(19, 14, 19, 47, '2025-05-27 14:58:11'),
(20, 14, 19, 48, '2025-05-27 14:58:26'),
(21, 14, 19, 49, '2025-05-27 14:58:40'),
(22, 14, 19, 50, '2025-05-27 14:58:49'),
(23, 14, 19, 51, '2025-05-27 14:59:00'),
(24, 14, 19, 52, '2025-05-27 14:59:37'),
(25, 14, 19, 53, '2025-05-27 14:59:52'),
(26, 14, 19, 54, '2025-05-27 15:00:07'),
(27, 14, 19, 55, '2025-05-27 15:00:18'),
(28, 14, 19, 56, '2025-05-27 15:00:33'),
(29, 14, 19, 57, '2025-05-27 15:00:47'),
(30, 14, 19, 58, '2025-05-27 15:01:07'),
(31, 14, 19, 59, '2025-05-27 15:01:23'),
(32, 14, 19, 60, '2025-05-27 15:01:37'),
(33, 11, 21, 11, '2025-05-27 18:19:08'),
(34, 11, 21, 12, '2025-05-27 18:19:14'),
(35, 16, 22, 61, '2025-05-28 11:49:20'),
(36, 16, 22, 62, '2025-05-28 11:49:26'),
(37, 16, 22, 65, '2025-05-28 11:55:33'),
(38, 16, 22, 66, '2025-05-28 11:55:39');

-- --------------------------------------------------------

--
-- Table structure for table `class_subjects`
--

CREATE TABLE `class_subjects` (
  `id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class_subjects`
--

INSERT INTO `class_subjects` (`id`, `school_id`, `class_id`, `subject_id`, `created_at`, `updated_at`) VALUES
(11, 14, 19, 11, '2025-05-27 14:21:52', '2025-05-27 14:21:52'),
(12, 14, 19, 12, '2025-05-27 14:21:52', '2025-05-27 14:21:52'),
(13, 14, 19, 13, '2025-05-27 14:21:52', '2025-05-27 14:21:52'),
(14, 14, 19, 14, '2025-05-27 14:21:52', '2025-05-27 14:21:52'),
(15, 14, 19, 15, '2025-05-27 14:21:52', '2025-05-27 14:21:52'),
(16, 14, 19, 16, '2025-05-27 14:21:52', '2025-05-27 14:21:52'),
(17, 14, 19, 17, '2025-05-27 14:21:52', '2025-05-27 14:21:52'),
(18, 14, 19, 18, '2025-05-27 14:21:52', '2025-05-27 14:21:52'),
(19, 14, 19, 19, '2025-05-27 17:11:59', '2025-05-27 17:11:59'),
(20, 14, 19, 20, '2025-05-27 17:11:59', '2025-05-27 17:11:59'),
(21, 11, 21, 21, '2025-05-27 17:58:23', '2025-05-27 17:58:23'),
(22, 11, 21, 22, '2025-05-27 17:58:23', '2025-05-27 17:58:23'),
(23, 11, 21, 23, '2025-05-27 17:58:23', '2025-05-27 17:58:23'),
(24, 16, 22, 24, '2025-05-28 11:56:15', '2025-05-28 11:56:15'),
(25, 16, 22, 25, '2025-05-28 11:56:15', '2025-05-28 11:56:15');

-- --------------------------------------------------------

--
-- Table structure for table `class_teachers`
--

CREATE TABLE `class_teachers` (
  `id` int(11) NOT NULL,
  `school_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class_teachers`
--

INSERT INTO `class_teachers` (`id`, `school_id`, `user_id`, `class_id`, `created_at`) VALUES
(8, 14, 18, 19, '2025-05-27 17:10:11'),
(9, 11, 19, 21, '2025-05-27 17:57:45'),
(10, 16, 25, 22, '2025-05-28 11:56:39');

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` int(4) NOT NULL,
  `school_id` int(5) NOT NULL,
  `exam_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `school_id`, `exam_name`) VALUES
(9, 14, 'Midterm'),
(10, 14, 'Final'),
(11, 14, 'Mock'),
(12, 11, 'Final'),
(13, 16, 'Final');

-- --------------------------------------------------------

--
-- Table structure for table `exam_results`
--

CREATE TABLE `exam_results` (
  `id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `test_score` decimal(5,2) DEFAULT 0.00,
  `exam_score` decimal(5,2) DEFAULT 0.00,
  `total_mark` decimal(5,2) GENERATED ALWAYS AS (`test_score` + `exam_score`) STORED,
  `grade_id` int(11) DEFAULT NULL,
  `class_id` int(11) NOT NULL,
  `position_in_subject` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exam_results`
--

INSERT INTO `exam_results` (`id`, `school_id`, `session_id`, `student_id`, `subject_id`, `exam_id`, `test_score`, `exam_score`, `grade_id`, `class_id`, `position_in_subject`, `created_at`) VALUES
(83, 11, 13, 11, 23, 12, 11.00, 55.00, NULL, 21, 1, '2025-05-27 18:25:07'),
(84, 11, 13, 12, 23, 12, 30.00, 56.00, NULL, 21, 2, '2025-05-27 18:25:07'),
(85, 11, 13, 11, 22, 12, 12.00, 66.00, NULL, 21, 1, '2025-05-27 18:25:41'),
(86, 11, 13, 12, 22, 12, 30.00, 44.00, NULL, 21, 2, '2025-05-27 18:25:41'),
(87, 11, 15, 11, 23, 12, 12.00, 56.00, NULL, 21, 1, '2025-05-27 18:27:26'),
(88, 11, 15, 12, 23, 12, 14.00, 66.00, NULL, 21, 2, '2025-05-27 18:27:26'),
(89, 11, 15, 11, 22, 12, 23.00, 70.00, NULL, 21, 1, '2025-05-27 18:27:44'),
(90, 11, 15, 12, 22, 12, 22.00, 66.00, NULL, 21, 2, '2025-05-27 18:27:44'),
(95, 16, 18, 65, 24, 13, 12.00, 46.00, 32, 22, 1, '2025-05-28 12:16:37'),
(96, 16, 18, 66, 24, 13, 14.00, 65.00, 30, 22, 2, '2025-05-28 12:16:37'),
(97, 16, 18, 65, 25, 13, 30.00, 70.00, 30, 22, 1, '2025-05-28 12:16:54'),
(98, 16, 18, 66, 25, 13, 30.00, 68.00, 30, 22, 2, '2025-05-28 12:16:54'),
(100, 16, 17, 66, 24, 13, 23.00, 33.00, 32, 22, 2, '2025-05-28 18:02:29'),
(102, 16, 17, 66, 25, 13, 30.00, 33.00, 31, 22, 2, '2025-05-28 18:02:48');

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int(11) NOT NULL,
  `school_id` int(11) DEFAULT NULL,
  `grade` varchar(10) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `min_score` decimal(5,2) DEFAULT NULL,
  `max_score` decimal(5,2) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `school_id`, `grade`, `remarks`, `min_score`, `max_score`, `created_at`) VALUES
(21, 14, '1', 'Excellent', 80.00, 100.00, '2025-05-27 14:16:26'),
(22, 14, '2', 'Very Good', 70.00, 79.00, '2025-05-27 14:16:53'),
(23, 14, '3', 'Good', 60.00, 69.00, '2025-05-27 14:17:26'),
(24, 14, '4', 'Credit', 55.00, 59.00, '2025-05-27 14:17:48'),
(25, 14, '5', 'Credit', 50.00, 54.00, '2025-05-27 14:18:18'),
(26, 14, '6', 'Pass', 45.00, 49.00, '2025-05-27 14:18:54'),
(27, 14, '7', 'Pass', 35.00, 44.00, '2025-05-27 14:19:25'),
(28, 14, '8', 'Weak Pass', 30.00, 34.00, '2025-05-27 14:20:03'),
(29, 14, '9', 'Fail', 0.00, 29.00, '2025-05-27 14:20:23'),
(30, 16, 'A', 'Excellent', 75.00, 100.00, '2025-05-28 11:57:23'),
(31, 16, 'B', 'Very Good', 60.00, 74.00, '2025-05-28 11:57:44'),
(32, 16, 'C', 'Good', 50.00, 59.00, '2025-05-28 11:59:34'),
(33, 16, 'D', 'Fair', 45.00, 49.00, '2025-05-28 12:00:06'),
(34, 16, 'E', 'Pass', 40.00, 44.00, '2025-05-28 12:00:55'),
(35, 16, 'F', 'Fail', 0.00, 39.00, '2025-05-28 12:01:11');

-- --------------------------------------------------------

--
-- Table structure for table `otps`
--

CREATE TABLE `otps` (
  `id` int(4) NOT NULL,
  `code` int(5) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `owners`
--

CREATE TABLE `owners` (
  `id` int(4) NOT NULL,
  `name` text NOT NULL,
  `password` text NOT NULL,
  `email` varchar(111) NOT NULL,
  `phone` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `owners`
--

INSERT INTO `owners` (`id`, `name`, `password`, `email`, `phone`) VALUES
(6, 'Ndueso Walter', '$2y$10$oSgfxMH3afG3GrFUvWqCte4k44SQGX9W/yj5aWN9YIZOfoi.x/6iq', 'newleastpaysolution@gmail.com', '08067361023');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(4) NOT NULL,
  `school_id` int(4) NOT NULL,
  `reference_id` varchar(50) NOT NULL,
  `student_id` int(5) NOT NULL,
  `amount` varchar(9) NOT NULL,
  `channel` varchar(22) NOT NULL,
  `description` varchar(120) NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `school_id`, `reference_id`, `student_id`, `amount`, `channel`, `description`, `payment_date`) VALUES
(8, 16, '488987435764', 65, '110', 'Paystack', 'scratch card purchase', '2025-05-28 18:24:06');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `school_id` int(11) DEFAULT NULL,
  `role` varchar(50) NOT NULL,
  `module` varchar(100) NOT NULL,
  `permission_type` varchar(50) NOT NULL,
  `can_access` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `school_id`, `role`, `module`, `permission_type`, `can_access`) VALUES
(7610, 4, 'Admin', 'dashboard', 'create', 1),
(7611, 4, 'Admin', 'dashboard', 'read', 1),
(7612, 4, 'Admin', 'dashboard', 'update', 1),
(7613, 4, 'Admin', 'dashboard', 'delete', 1),
(7614, 4, 'Admin', 'account management', 'create', 1),
(7615, 4, 'Admin', 'account management', 'read', 1),
(7616, 4, 'Admin', 'account management', 'update', 1),
(7617, 4, 'Admin', 'account management', 'delete', 1),
(7618, 4, 'Admin', 'add user', 'create', 1),
(7619, 4, 'Admin', 'add user', 'read', 1),
(7620, 4, 'Admin', 'add user', 'update', 1),
(7621, 4, 'Admin', 'add user', 'delete', 1),
(7622, 4, 'Admin', 'user record', 'create', 1),
(7623, 4, 'Admin', 'user record', 'read', 1),
(7624, 4, 'Admin', 'user record', 'update', 1),
(7625, 4, 'Admin', 'user record', 'delete', 1),
(7626, 4, 'Admin', 'change password', 'create', 1),
(7627, 4, 'Admin', 'change password', 'read', 1),
(7628, 4, 'Admin', 'change password', 'update', 1),
(7629, 4, 'Admin', 'change password', 'delete', 1),
(7630, 4, 'Admin', 'profile', 'create', 1),
(7631, 4, 'Admin', 'profile', 'read', 1),
(7632, 4, 'Admin', 'profile', 'update', 1),
(7633, 4, 'Admin', 'profile', 'delete', 1),
(7634, 4, 'Admin', 'class management', 'create', 1),
(7635, 4, 'Admin', 'class management', 'read', 1),
(7636, 4, 'Admin', 'class management', 'update', 1),
(7637, 4, 'Admin', 'class management', 'delete', 1),
(7638, 4, 'Admin', 'add class', 'create', 1),
(7639, 4, 'Admin', 'add class', 'read', 1),
(7640, 4, 'Admin', 'add class', 'update', 1),
(7641, 4, 'Admin', 'add class', 'delete', 1),
(7642, 4, 'Admin', 'class record', 'create', 1),
(7643, 4, 'Admin', 'class record', 'read', 1),
(7644, 4, 'Admin', 'class record', 'update', 1),
(7645, 4, 'Admin', 'class record', 'delete', 1),
(7646, 4, 'Admin', 'assign subject class', 'create', 1),
(7647, 4, 'Admin', 'assign subject class', 'read', 1),
(7648, 4, 'Admin', 'assign subject class', 'update', 1),
(7649, 4, 'Admin', 'assign subject class', 'delete', 1),
(7650, 4, 'Admin', 'teacher management', 'create', 1),
(7651, 4, 'Admin', 'teacher management', 'read', 1),
(7652, 4, 'Admin', 'teacher management', 'update', 1),
(7653, 4, 'Admin', 'teacher management', 'delete', 1),
(7654, 4, 'Admin', 'teacher record', 'create', 1),
(7655, 4, 'Admin', 'teacher record', 'read', 1),
(7656, 4, 'Admin', 'teacher record', 'update', 1),
(7657, 4, 'Admin', 'teacher record', 'delete', 1),
(7658, 4, 'Admin', 'assign teacher to class', 'create', 1),
(7659, 4, 'Admin', 'assign teacher to class', 'read', 1),
(7660, 4, 'Admin', 'assign teacher to class', 'update', 1),
(7661, 4, 'Admin', 'assign teacher to class', 'delete', 1),
(7662, 4, 'Admin', 'grade setup', 'create', 1),
(7663, 4, 'Admin', 'grade setup', 'read', 1),
(7664, 4, 'Admin', 'grade setup', 'update', 1),
(7665, 4, 'Admin', 'grade setup', 'delete', 1),
(7666, 4, 'Admin', 'add grade', 'create', 1),
(7667, 4, 'Admin', 'add grade', 'read', 1),
(7668, 4, 'Admin', 'add grade', 'update', 1),
(7669, 4, 'Admin', 'add grade', 'delete', 1),
(7670, 4, 'Admin', 'grade record', 'create', 1),
(7671, 4, 'Admin', 'grade record', 'read', 1),
(7672, 4, 'Admin', 'grade record', 'update', 1),
(7673, 4, 'Admin', 'grade record', 'delete', 1),
(7674, 4, 'Admin', 'session Management', 'create', 1),
(7675, 4, 'Admin', 'session Management', 'read', 1),
(7676, 4, 'Admin', 'session Management', 'update', 1),
(7677, 4, 'Admin', 'session Management', 'delete', 1),
(7678, 4, 'Admin', 'create session', 'create', 1),
(7679, 4, 'Admin', 'create session', 'read', 1),
(7680, 4, 'Admin', 'create session', 'update', 1),
(7681, 4, 'Admin', 'create session', 'delete', 1),
(7682, 4, 'Admin', 'session record', 'create', 1),
(7683, 4, 'Admin', 'session record', 'read', 1),
(7684, 4, 'Admin', 'session record', 'update', 1),
(7685, 4, 'Admin', 'session record', 'delete', 1),
(7686, 4, 'Admin', 'subject management', 'create', 1),
(7687, 4, 'Admin', 'subject management', 'read', 1),
(7688, 4, 'Admin', 'subject management', 'update', 1),
(7689, 4, 'Admin', 'subject management', 'delete', 1),
(7690, 4, 'Admin', 'add subject', 'create', 1),
(7691, 4, 'Admin', 'add subject', 'read', 1),
(7692, 4, 'Admin', 'add subject', 'update', 1),
(7693, 4, 'Admin', 'add subject', 'delete', 1),
(7694, 4, 'Admin', 'subject record', 'create', 1),
(7695, 4, 'Admin', 'subject record', 'read', 1),
(7696, 4, 'Admin', 'subject record', 'update', 1),
(7697, 4, 'Admin', 'subject record', 'delete', 1),
(7698, 4, 'Admin', 'subject allocation', 'create', 1),
(7699, 4, 'Admin', 'subject allocation', 'read', 1),
(7700, 4, 'Admin', 'subject allocation', 'update', 1),
(7701, 4, 'Admin', 'subject allocation', 'delete', 1),
(7702, 4, 'Admin', 'subject allocation record', 'create', 1),
(7703, 4, 'Admin', 'subject allocation record', 'read', 1),
(7704, 4, 'Admin', 'subject allocation record', 'update', 1),
(7705, 4, 'Admin', 'subject allocation record', 'delete', 1),
(7706, 4, 'Admin', 'subject assignment record', 'create', 1),
(7707, 4, 'Admin', 'subject assignment record', 'read', 1),
(7708, 4, 'Admin', 'subject assignment record', 'update', 1),
(7709, 4, 'Admin', 'subject assignment record', 'delete', 1),
(7710, 4, 'Admin', 'result management', 'create', 1),
(7711, 4, 'Admin', 'result management', 'read', 1),
(7712, 4, 'Admin', 'result management', 'update', 1),
(7713, 4, 'Admin', 'result management', 'delete', 1),
(7714, 4, 'Admin', 'result record', 'create', 1),
(7715, 4, 'Admin', 'result record', 'read', 1),
(7716, 4, 'Admin', 'result record', 'update', 1),
(7717, 4, 'Admin', 'result record', 'delete', 1),
(7718, 4, 'Admin', 'score record', 'create', 1),
(7719, 4, 'Admin', 'score record', 'read', 1),
(7720, 4, 'Admin', 'score record', 'update', 1),
(7721, 4, 'Admin', 'score record', 'delete', 1),
(7722, 4, 'Admin', 'student management', 'create', 1),
(7723, 4, 'Admin', 'student management', 'read', 1),
(7724, 4, 'Admin', 'student management', 'update', 1),
(7725, 4, 'Admin', 'student management', 'delete', 1),
(7726, 4, 'Admin', 'student record', 'create', 1),
(7727, 4, 'Admin', 'student record', 'read', 1),
(7728, 4, 'Admin', 'student record', 'update', 1),
(7729, 4, 'Admin', 'student record', 'delete', 1),
(7730, 4, 'Admin', 'assign student to class', 'create', 1),
(7731, 4, 'Admin', 'assign student to class', 'read', 1),
(7732, 4, 'Admin', 'assign student to class', 'update', 1),
(7733, 4, 'Admin', 'assign student to class', 'delete', 1),
(7734, 4, 'Admin', 'scratch card management', 'create', 1),
(7735, 4, 'Admin', 'scratch card management', 'read', 1),
(7736, 4, 'Admin', 'scratch card management', 'update', 1),
(7737, 4, 'Admin', 'scratch card management', 'delete', 1),
(7738, 4, 'Admin', 'generate scratch card', 'create', 1),
(7739, 4, 'Admin', 'generate scratch card', 'read', 1),
(7740, 4, 'Admin', 'generate scratch card', 'update', 1),
(7741, 4, 'Admin', 'generate scratch card', 'delete', 1),
(7742, 4, 'Admin', 'scratch card record', 'create', 1),
(7743, 4, 'Admin', 'scratch card record', 'read', 1),
(7744, 4, 'Admin', 'scratch card record', 'update', 1),
(7745, 4, 'Admin', 'scratch card record', 'delete', 1),
(7746, 4, 'Admin', 'permission management', 'create', 1),
(7747, 4, 'Admin', 'permission management', 'read', 1),
(7748, 4, 'Admin', 'permission management', 'update', 1),
(7749, 4, 'Admin', 'permission management', 'delete', 1),
(7750, 4, 'Admin', 'add permission', 'create', 1),
(7751, 4, 'Admin', 'add permission', 'read', 1),
(7752, 4, 'Admin', 'add permission', 'update', 1),
(7753, 4, 'Admin', 'add permission', 'delete', 1),
(7754, 4, 'Admin', 'permission record', 'create', 1),
(7755, 4, 'Admin', 'permission record', 'read', 1),
(7756, 4, 'Admin', 'permission record', 'update', 1),
(7757, 4, 'Admin', 'permission record', 'delete', 1),
(7758, 4, 'Admin', 'promotion management', 'create', 1),
(7759, 4, 'Admin', 'promotion management', 'read', 1),
(7760, 4, 'Admin', 'promotion management', 'update', 1),
(7761, 4, 'Admin', 'promotion management', 'delete', 1),
(7762, 4, 'Admin', 'promotion', 'create', 1),
(7763, 4, 'Admin', 'promotion', 'read', 1),
(7764, 4, 'Admin', 'promotion', 'update', 1),
(7765, 4, 'Admin', 'promotion', 'delete', 1),
(7766, 4, 'Admin', 'exam record', 'create', 1),
(7767, 4, 'Admin', 'exam record', 'read', 1),
(7768, 4, 'Admin', 'exam record', 'update', 1),
(7769, 4, 'Admin', 'exam record', 'delete', 1),
(7770, 4, 'Admin', 'exam management', 'create', 1),
(7771, 4, 'Admin', 'exam management', 'read', 1),
(7772, 4, 'Admin', 'exam management', 'update', 1),
(7773, 4, 'Admin', 'exam management', 'delete', 1),
(7774, 4, 'Admin', 'add exam', 'create', 1),
(7775, 4, 'Admin', 'add exam', 'read', 1),
(7776, 4, 'Admin', 'add exam', 'update', 1),
(7777, 4, 'Admin', 'add exam', 'delete', 1),
(7778, 4, 'Admin', 'school setting', 'create', 1),
(7779, 4, 'Admin', 'school setting', 'read', 1),
(7780, 4, 'Admin', 'school setting', 'update', 1),
(7781, 4, 'Admin', 'school setting', 'delete', 1),
(7782, 4, 'Admin', 'activity log', 'create', 1),
(7783, 4, 'Admin', 'activity log', 'read', 1),
(7784, 4, 'Admin', 'activity log', 'update', 1),
(7785, 4, 'Admin', 'activity log', 'delete', 1),
(7786, 4, 'Admin', 'database backup', 'create', 1),
(7787, 4, 'Admin', 'database backup', 'read', 1),
(7788, 4, 'Admin', 'database backup', 'update', 1),
(7789, 4, 'Admin', 'database backup', 'delete', 1),
(8158, 1, 'Teacher', 'dashboard', 'create', 1),
(8159, 1, 'Teacher', 'dashboard', 'read', 1),
(8160, 1, 'Teacher', 'dashboard', 'update', 1),
(8161, 1, 'Teacher', 'dashboard', 'delete', 1),
(8162, 1, 'Teacher', 'account management', 'create', 1),
(8163, 1, 'Teacher', 'account management', 'read', 1),
(8164, 1, 'Teacher', 'account management', 'update', 1),
(8165, 1, 'Teacher', 'account management', 'delete', 1),
(8166, 1, 'Teacher', 'add user', 'create', 1),
(8167, 1, 'Teacher', 'add user', 'read', 1),
(8168, 1, 'Teacher', 'add user', 'update', 1),
(8169, 1, 'Teacher', 'add user', 'delete', 1),
(8170, 1, 'Teacher', 'user record', 'create', 1),
(8171, 1, 'Teacher', 'user record', 'read', 1),
(8172, 1, 'Teacher', 'user record', 'update', 1),
(8173, 1, 'Teacher', 'user record', 'delete', 1),
(8174, 1, 'Teacher', 'change password', 'create', 1),
(8175, 1, 'Teacher', 'change password', 'read', 1),
(8176, 1, 'Teacher', 'change password', 'update', 1),
(8177, 1, 'Teacher', 'change password', 'delete', 1),
(8178, 1, 'Teacher', 'profile', 'create', 1),
(8179, 1, 'Teacher', 'profile', 'read', 1),
(8180, 1, 'Teacher', 'profile', 'update', 1),
(8181, 1, 'Teacher', 'profile', 'delete', 1),
(8182, 1, 'Teacher', 'class management', 'create', 1),
(8183, 1, 'Teacher', 'class management', 'read', 1),
(8184, 1, 'Teacher', 'class management', 'update', 1),
(8185, 1, 'Teacher', 'class management', 'delete', 1),
(8186, 1, 'Teacher', 'add class', 'create', 1),
(8187, 1, 'Teacher', 'add class', 'read', 1),
(8188, 1, 'Teacher', 'add class', 'update', 1),
(8189, 1, 'Teacher', 'add class', 'delete', 1),
(8190, 1, 'Teacher', 'class record', 'create', 1),
(8191, 1, 'Teacher', 'class record', 'read', 1),
(8192, 1, 'Teacher', 'class record', 'update', 1),
(8193, 1, 'Teacher', 'class record', 'delete', 1),
(8194, 1, 'Teacher', 'assign subject class', 'create', 1),
(8195, 1, 'Teacher', 'assign subject class', 'read', 1),
(8196, 1, 'Teacher', 'assign subject class', 'update', 1),
(8197, 1, 'Teacher', 'assign subject class', 'delete', 1),
(8198, 1, 'Teacher', 'teacher management', 'create', 1),
(8199, 1, 'Teacher', 'teacher management', 'read', 1),
(8200, 1, 'Teacher', 'teacher management', 'update', 1),
(8201, 1, 'Teacher', 'teacher management', 'delete', 1),
(8202, 1, 'Teacher', 'teacher record', 'create', 1),
(8203, 1, 'Teacher', 'teacher record', 'read', 1),
(8204, 1, 'Teacher', 'teacher record', 'update', 1),
(8205, 1, 'Teacher', 'teacher record', 'delete', 1),
(8206, 1, 'Teacher', 'assign teacher to class', 'create', 1),
(8207, 1, 'Teacher', 'assign teacher to class', 'read', 1),
(8208, 1, 'Teacher', 'assign teacher to class', 'update', 1),
(8209, 1, 'Teacher', 'assign teacher to class', 'delete', 1),
(8210, 1, 'Teacher', 'grade setup', 'create', 1),
(8211, 1, 'Teacher', 'grade setup', 'read', 1),
(8212, 1, 'Teacher', 'grade setup', 'update', 1),
(8213, 1, 'Teacher', 'grade setup', 'delete', 1),
(8214, 1, 'Teacher', 'add grade', 'create', 1),
(8215, 1, 'Teacher', 'add grade', 'read', 1),
(8216, 1, 'Teacher', 'add grade', 'update', 1),
(8217, 1, 'Teacher', 'add grade', 'delete', 1),
(8218, 1, 'Teacher', 'grade record', 'create', 1),
(8219, 1, 'Teacher', 'grade record', 'read', 1),
(8220, 1, 'Teacher', 'grade record', 'update', 1),
(8221, 1, 'Teacher', 'grade record', 'delete', 1),
(8222, 1, 'Teacher', 'session Management', 'create', 1),
(8223, 1, 'Teacher', 'session Management', 'read', 1),
(8224, 1, 'Teacher', 'session Management', 'update', 1),
(8225, 1, 'Teacher', 'session Management', 'delete', 1),
(8226, 1, 'Teacher', 'create session', 'create', 1),
(8227, 1, 'Teacher', 'create session', 'read', 1),
(8228, 1, 'Teacher', 'create session', 'update', 1),
(8229, 1, 'Teacher', 'create session', 'delete', 1),
(8230, 1, 'Teacher', 'session record', 'create', 1),
(8231, 1, 'Teacher', 'session record', 'read', 1),
(8232, 1, 'Teacher', 'session record', 'update', 1),
(8233, 1, 'Teacher', 'session record', 'delete', 1),
(8234, 1, 'Teacher', 'subject management', 'create', 1),
(8235, 1, 'Teacher', 'subject management', 'read', 1),
(8236, 1, 'Teacher', 'subject management', 'update', 1),
(8237, 1, 'Teacher', 'subject management', 'delete', 1),
(8238, 1, 'Teacher', 'add subject', 'create', 1),
(8239, 1, 'Teacher', 'add subject', 'read', 1),
(8240, 1, 'Teacher', 'add subject', 'update', 1),
(8241, 1, 'Teacher', 'add subject', 'delete', 1),
(8242, 1, 'Teacher', 'subject record', 'create', 1),
(8243, 1, 'Teacher', 'subject record', 'read', 1),
(8244, 1, 'Teacher', 'subject record', 'update', 1),
(8245, 1, 'Teacher', 'subject record', 'delete', 1),
(8246, 1, 'Teacher', 'subject allocation', 'create', 1),
(8247, 1, 'Teacher', 'subject allocation', 'read', 1),
(8248, 1, 'Teacher', 'subject allocation', 'update', 1),
(8249, 1, 'Teacher', 'subject allocation', 'delete', 1),
(8250, 1, 'Teacher', 'subject allocation record', 'create', 1),
(8251, 1, 'Teacher', 'subject allocation record', 'read', 1),
(8252, 1, 'Teacher', 'subject allocation record', 'update', 1),
(8253, 1, 'Teacher', 'subject allocation record', 'delete', 1),
(8254, 1, 'Teacher', 'subject assignment record', 'create', 1),
(8255, 1, 'Teacher', 'subject assignment record', 'read', 1),
(8256, 1, 'Teacher', 'subject assignment record', 'update', 1),
(8257, 1, 'Teacher', 'subject assignment record', 'delete', 1),
(8258, 1, 'Teacher', 'result management', 'create', 1),
(8259, 1, 'Teacher', 'result management', 'read', 1),
(8260, 1, 'Teacher', 'result management', 'update', 1),
(8261, 1, 'Teacher', 'result management', 'delete', 1),
(8262, 1, 'Teacher', 'result record', 'create', 1),
(8263, 1, 'Teacher', 'result record', 'read', 1),
(8264, 1, 'Teacher', 'result record', 'update', 1),
(8265, 1, 'Teacher', 'result record', 'delete', 1),
(8266, 1, 'Teacher', 'upload scores', 'create', 1),
(8267, 1, 'Teacher', 'upload scores', 'read', 1),
(8268, 1, 'Teacher', 'upload scores', 'update', 1),
(8269, 1, 'Teacher', 'upload scores', 'delete', 1),
(8270, 1, 'Teacher', 'score record', 'create', 1),
(8271, 1, 'Teacher', 'score record', 'read', 1),
(8272, 1, 'Teacher', 'score record', 'update', 1),
(8273, 1, 'Teacher', 'score record', 'delete', 1),
(8274, 1, 'Teacher', 'student management', 'create', 1),
(8275, 1, 'Teacher', 'student management', 'read', 1),
(8276, 1, 'Teacher', 'student management', 'update', 1),
(8277, 1, 'Teacher', 'student management', 'delete', 1),
(8278, 1, 'Teacher', 'student record', 'create', 1),
(8279, 1, 'Teacher', 'student record', 'read', 1),
(8280, 1, 'Teacher', 'student record', 'update', 1),
(8281, 1, 'Teacher', 'student record', 'delete', 1),
(8282, 1, 'Teacher', 'assign student to class', 'create', 1),
(8283, 1, 'Teacher', 'assign student to class', 'read', 1),
(8284, 1, 'Teacher', 'assign student to class', 'update', 1),
(8285, 1, 'Teacher', 'assign student to class', 'delete', 1),
(8286, 1, 'Teacher', 'scratch card management', 'create', 1),
(8287, 1, 'Teacher', 'scratch card management', 'read', 1),
(8288, 1, 'Teacher', 'scratch card management', 'update', 1),
(8289, 1, 'Teacher', 'scratch card management', 'delete', 1),
(8290, 1, 'Teacher', 'generate scratch card', 'create', 1),
(8291, 1, 'Teacher', 'generate scratch card', 'read', 1),
(8292, 1, 'Teacher', 'generate scratch card', 'update', 1),
(8293, 1, 'Teacher', 'generate scratch card', 'delete', 1),
(8294, 1, 'Teacher', 'scratch card record', 'create', 1),
(8295, 1, 'Teacher', 'scratch card record', 'read', 1),
(8296, 1, 'Teacher', 'scratch card record', 'update', 1),
(8297, 1, 'Teacher', 'scratch card record', 'delete', 1),
(8298, 1, 'Teacher', 'permission management', 'create', 1),
(8299, 1, 'Teacher', 'permission management', 'read', 1),
(8300, 1, 'Teacher', 'permission management', 'update', 1),
(8301, 1, 'Teacher', 'permission management', 'delete', 1),
(8302, 1, 'Teacher', 'add permission', 'create', 1),
(8303, 1, 'Teacher', 'add permission', 'read', 1),
(8304, 1, 'Teacher', 'add permission', 'update', 1),
(8305, 1, 'Teacher', 'add permission', 'delete', 1),
(8306, 1, 'Teacher', 'permission record', 'create', 1),
(8307, 1, 'Teacher', 'permission record', 'read', 1),
(8308, 1, 'Teacher', 'permission record', 'update', 1),
(8309, 1, 'Teacher', 'permission record', 'delete', 1),
(8310, 1, 'Teacher', 'promotion management', 'create', 1),
(8311, 1, 'Teacher', 'promotion management', 'read', 1),
(8312, 1, 'Teacher', 'promotion management', 'update', 1),
(8313, 1, 'Teacher', 'promotion management', 'delete', 1),
(8314, 1, 'Teacher', 'promotion', 'create', 1),
(8315, 1, 'Teacher', 'promotion', 'read', 1),
(8316, 1, 'Teacher', 'promotion', 'update', 1),
(8317, 1, 'Teacher', 'promotion', 'delete', 1),
(8318, 1, 'Teacher', 'exam record', 'create', 1),
(8319, 1, 'Teacher', 'exam record', 'read', 1),
(8320, 1, 'Teacher', 'exam record', 'update', 1),
(8321, 1, 'Teacher', 'exam record', 'delete', 1),
(8322, 1, 'Teacher', 'exam management', 'create', 1),
(8323, 1, 'Teacher', 'exam management', 'read', 1),
(8324, 1, 'Teacher', 'exam management', 'update', 1),
(8325, 1, 'Teacher', 'exam management', 'delete', 1),
(8326, 1, 'Teacher', 'add exam', 'create', 1),
(8327, 1, 'Teacher', 'add exam', 'read', 1),
(8328, 1, 'Teacher', 'add exam', 'update', 1),
(8329, 1, 'Teacher', 'add exam', 'delete', 1),
(8330, 1, 'Teacher', 'school setting', 'create', 1),
(8331, 1, 'Teacher', 'school setting', 'read', 1),
(8332, 1, 'Teacher', 'school setting', 'update', 1),
(8333, 1, 'Teacher', 'school setting', 'delete', 1),
(8334, 1, 'Teacher', 'activity log', 'create', 1),
(8335, 1, 'Teacher', 'activity log', 'read', 1),
(8336, 1, 'Teacher', 'activity log', 'update', 1),
(8337, 1, 'Teacher', 'activity log', 'delete', 1),
(8338, 1, 'Teacher', 'database backup', 'create', 1),
(8339, 1, 'Teacher', 'database backup', 'read', 1),
(8340, 1, 'Teacher', 'database backup', 'update', 1),
(8341, 1, 'Teacher', 'database backup', 'delete', 1),
(8342, 4, 'Teacher', 'dashboard', 'create', 1),
(8343, 4, 'Teacher', 'dashboard', 'read', 1),
(8344, 4, 'Teacher', 'dashboard', 'update', 1),
(8345, 4, 'Teacher', 'dashboard', 'delete', 1),
(8346, 4, 'Teacher', 'account management', 'create', 1),
(8347, 4, 'Teacher', 'account management', 'read', 1),
(8348, 4, 'Teacher', 'account management', 'update', 1),
(8349, 4, 'Teacher', 'account management', 'delete', 1),
(8350, 4, 'Teacher', 'add user', 'create', 1),
(8351, 4, 'Teacher', 'add user', 'read', 1),
(8352, 4, 'Teacher', 'add user', 'update', 1),
(8353, 4, 'Teacher', 'add user', 'delete', 1),
(8354, 4, 'Teacher', 'user record', 'create', 1),
(8355, 4, 'Teacher', 'user record', 'read', 1),
(8356, 4, 'Teacher', 'user record', 'update', 1),
(8357, 4, 'Teacher', 'user record', 'delete', 1),
(8358, 4, 'Teacher', 'change password', 'create', 1),
(8359, 4, 'Teacher', 'change password', 'read', 1),
(8360, 4, 'Teacher', 'change password', 'update', 1),
(8361, 4, 'Teacher', 'change password', 'delete', 1),
(8362, 4, 'Teacher', 'profile', 'create', 1),
(8363, 4, 'Teacher', 'profile', 'read', 1),
(8364, 4, 'Teacher', 'profile', 'update', 1),
(8365, 4, 'Teacher', 'profile', 'delete', 1),
(8366, 4, 'Teacher', 'class management', 'create', 1),
(8367, 4, 'Teacher', 'class management', 'read', 1),
(8368, 4, 'Teacher', 'class management', 'update', 1),
(8369, 4, 'Teacher', 'class management', 'delete', 1),
(8370, 4, 'Teacher', 'add class', 'create', 1),
(8371, 4, 'Teacher', 'add class', 'read', 1),
(8372, 4, 'Teacher', 'add class', 'update', 1),
(8373, 4, 'Teacher', 'add class', 'delete', 1),
(8374, 4, 'Teacher', 'class record', 'create', 1),
(8375, 4, 'Teacher', 'class record', 'read', 1),
(8376, 4, 'Teacher', 'class record', 'update', 1),
(8377, 4, 'Teacher', 'class record', 'delete', 1),
(8378, 4, 'Teacher', 'assign subject class', 'create', 1),
(8379, 4, 'Teacher', 'assign subject class', 'read', 1),
(8380, 4, 'Teacher', 'assign subject class', 'update', 1),
(8381, 4, 'Teacher', 'assign subject class', 'delete', 1),
(8382, 4, 'Teacher', 'teacher management', 'create', 1),
(8383, 4, 'Teacher', 'teacher management', 'read', 1),
(8384, 4, 'Teacher', 'teacher management', 'update', 1),
(8385, 4, 'Teacher', 'teacher management', 'delete', 1),
(8386, 4, 'Teacher', 'teacher record', 'create', 1),
(8387, 4, 'Teacher', 'teacher record', 'read', 1),
(8388, 4, 'Teacher', 'teacher record', 'update', 1),
(8389, 4, 'Teacher', 'teacher record', 'delete', 1),
(8390, 4, 'Teacher', 'assign teacher to class', 'create', 1),
(8391, 4, 'Teacher', 'assign teacher to class', 'read', 1),
(8392, 4, 'Teacher', 'assign teacher to class', 'update', 1),
(8393, 4, 'Teacher', 'assign teacher to class', 'delete', 1),
(8394, 4, 'Teacher', 'grade setup', 'create', 1),
(8395, 4, 'Teacher', 'grade setup', 'read', 1),
(8396, 4, 'Teacher', 'grade setup', 'update', 1),
(8397, 4, 'Teacher', 'grade setup', 'delete', 1),
(8398, 4, 'Teacher', 'add grade', 'create', 1),
(8399, 4, 'Teacher', 'add grade', 'read', 1),
(8400, 4, 'Teacher', 'add grade', 'update', 1),
(8401, 4, 'Teacher', 'add grade', 'delete', 1),
(8402, 4, 'Teacher', 'grade record', 'create', 1),
(8403, 4, 'Teacher', 'grade record', 'read', 1),
(8404, 4, 'Teacher', 'grade record', 'update', 1),
(8405, 4, 'Teacher', 'grade record', 'delete', 1),
(8406, 4, 'Teacher', 'session Management', 'create', 1),
(8407, 4, 'Teacher', 'session Management', 'read', 1),
(8408, 4, 'Teacher', 'session Management', 'update', 1),
(8409, 4, 'Teacher', 'session Management', 'delete', 1),
(8410, 4, 'Teacher', 'create session', 'create', 1),
(8411, 4, 'Teacher', 'create session', 'read', 1),
(8412, 4, 'Teacher', 'create session', 'update', 1),
(8413, 4, 'Teacher', 'create session', 'delete', 1),
(8414, 4, 'Teacher', 'session record', 'create', 1),
(8415, 4, 'Teacher', 'session record', 'read', 1),
(8416, 4, 'Teacher', 'session record', 'update', 1),
(8417, 4, 'Teacher', 'session record', 'delete', 1),
(8418, 4, 'Teacher', 'subject management', 'create', 1),
(8419, 4, 'Teacher', 'subject management', 'read', 1),
(8420, 4, 'Teacher', 'subject management', 'update', 1),
(8421, 4, 'Teacher', 'subject management', 'delete', 1),
(8422, 4, 'Teacher', 'add subject', 'create', 1),
(8423, 4, 'Teacher', 'add subject', 'read', 1),
(8424, 4, 'Teacher', 'add subject', 'update', 1),
(8425, 4, 'Teacher', 'add subject', 'delete', 1),
(8426, 4, 'Teacher', 'subject record', 'create', 1),
(8427, 4, 'Teacher', 'subject record', 'read', 1),
(8428, 4, 'Teacher', 'subject record', 'update', 1),
(8429, 4, 'Teacher', 'subject record', 'delete', 1),
(8430, 4, 'Teacher', 'subject allocation', 'create', 1),
(8431, 4, 'Teacher', 'subject allocation', 'read', 1),
(8432, 4, 'Teacher', 'subject allocation', 'update', 1),
(8433, 4, 'Teacher', 'subject allocation', 'delete', 1),
(8434, 4, 'Teacher', 'subject allocation record', 'create', 1),
(8435, 4, 'Teacher', 'subject allocation record', 'read', 1),
(8436, 4, 'Teacher', 'subject allocation record', 'update', 1),
(8437, 4, 'Teacher', 'subject allocation record', 'delete', 1),
(8438, 4, 'Teacher', 'subject assignment record', 'create', 1),
(8439, 4, 'Teacher', 'subject assignment record', 'read', 1),
(8440, 4, 'Teacher', 'subject assignment record', 'update', 1),
(8441, 4, 'Teacher', 'subject assignment record', 'delete', 1),
(8442, 4, 'Teacher', 'result management', 'create', 1),
(8443, 4, 'Teacher', 'result management', 'read', 1),
(8444, 4, 'Teacher', 'result management', 'update', 1),
(8445, 4, 'Teacher', 'result management', 'delete', 1),
(8446, 4, 'Teacher', 'result record', 'create', 1),
(8447, 4, 'Teacher', 'result record', 'read', 1),
(8448, 4, 'Teacher', 'result record', 'update', 1),
(8449, 4, 'Teacher', 'result record', 'delete', 1),
(8450, 4, 'Teacher', 'upload scores', 'create', 1),
(8451, 4, 'Teacher', 'upload scores', 'read', 1),
(8452, 4, 'Teacher', 'upload scores', 'update', 1),
(8453, 4, 'Teacher', 'upload scores', 'delete', 1),
(8454, 4, 'Teacher', 'score record', 'create', 1),
(8455, 4, 'Teacher', 'score record', 'read', 1),
(8456, 4, 'Teacher', 'score record', 'update', 1),
(8457, 4, 'Teacher', 'score record', 'delete', 1),
(8458, 4, 'Teacher', 'student management', 'create', 1),
(8459, 4, 'Teacher', 'student management', 'read', 1),
(8460, 4, 'Teacher', 'student management', 'update', 1),
(8461, 4, 'Teacher', 'student management', 'delete', 1),
(8462, 4, 'Teacher', 'student record', 'create', 1),
(8463, 4, 'Teacher', 'student record', 'read', 1),
(8464, 4, 'Teacher', 'student record', 'update', 1),
(8465, 4, 'Teacher', 'student record', 'delete', 1),
(8466, 4, 'Teacher', 'assign student to class', 'create', 1),
(8467, 4, 'Teacher', 'assign student to class', 'read', 1),
(8468, 4, 'Teacher', 'assign student to class', 'update', 1),
(8469, 4, 'Teacher', 'assign student to class', 'delete', 1),
(8470, 4, 'Teacher', 'scratch card management', 'create', 1),
(8471, 4, 'Teacher', 'scratch card management', 'read', 1),
(8472, 4, 'Teacher', 'scratch card management', 'update', 1),
(8473, 4, 'Teacher', 'scratch card management', 'delete', 1),
(8474, 4, 'Teacher', 'generate scratch card', 'create', 1),
(8475, 4, 'Teacher', 'generate scratch card', 'read', 1),
(8476, 4, 'Teacher', 'generate scratch card', 'update', 1),
(8477, 4, 'Teacher', 'generate scratch card', 'delete', 1),
(8478, 4, 'Teacher', 'scratch card record', 'create', 1),
(8479, 4, 'Teacher', 'scratch card record', 'read', 1),
(8480, 4, 'Teacher', 'scratch card record', 'update', 1),
(8481, 4, 'Teacher', 'scratch card record', 'delete', 1),
(8482, 4, 'Teacher', 'permission management', 'create', 1),
(8483, 4, 'Teacher', 'permission management', 'read', 1),
(8484, 4, 'Teacher', 'permission management', 'update', 1),
(8485, 4, 'Teacher', 'permission management', 'delete', 1),
(8486, 4, 'Teacher', 'add permission', 'create', 1),
(8487, 4, 'Teacher', 'add permission', 'read', 1),
(8488, 4, 'Teacher', 'add permission', 'update', 1),
(8489, 4, 'Teacher', 'add permission', 'delete', 1),
(8490, 4, 'Teacher', 'permission record', 'create', 1),
(8491, 4, 'Teacher', 'permission record', 'read', 1),
(8492, 4, 'Teacher', 'permission record', 'update', 1),
(8493, 4, 'Teacher', 'permission record', 'delete', 1),
(8494, 4, 'Teacher', 'promotion management', 'create', 1),
(8495, 4, 'Teacher', 'promotion management', 'read', 1),
(8496, 4, 'Teacher', 'promotion management', 'update', 1),
(8497, 4, 'Teacher', 'promotion management', 'delete', 1),
(8498, 4, 'Teacher', 'promotion', 'create', 1),
(8499, 4, 'Teacher', 'promotion', 'read', 1),
(8500, 4, 'Teacher', 'promotion', 'update', 1),
(8501, 4, 'Teacher', 'promotion', 'delete', 1),
(8502, 4, 'Teacher', 'exam record', 'create', 1),
(8503, 4, 'Teacher', 'exam record', 'read', 1),
(8504, 4, 'Teacher', 'exam record', 'update', 1),
(8505, 4, 'Teacher', 'exam record', 'delete', 1),
(8506, 4, 'Teacher', 'exam management', 'create', 1),
(8507, 4, 'Teacher', 'exam management', 'read', 1),
(8508, 4, 'Teacher', 'exam management', 'update', 1),
(8509, 4, 'Teacher', 'exam management', 'delete', 1),
(8510, 4, 'Teacher', 'add exam', 'create', 1),
(8511, 4, 'Teacher', 'add exam', 'read', 1),
(8512, 4, 'Teacher', 'add exam', 'update', 1),
(8513, 4, 'Teacher', 'add exam', 'delete', 1),
(8514, 4, 'Teacher', 'school setting', 'create', 1),
(8515, 4, 'Teacher', 'school setting', 'read', 1),
(8516, 4, 'Teacher', 'school setting', 'update', 1),
(8517, 4, 'Teacher', 'school setting', 'delete', 1),
(8518, 4, 'Teacher', 'activity log', 'create', 1),
(8519, 4, 'Teacher', 'activity log', 'read', 1),
(8520, 4, 'Teacher', 'activity log', 'update', 1),
(8521, 4, 'Teacher', 'activity log', 'delete', 1),
(8522, 4, 'Teacher', 'database backup', 'create', 1),
(8523, 4, 'Teacher', 'database backup', 'read', 1),
(8524, 4, 'Teacher', 'database backup', 'update', 1),
(8525, 4, 'Teacher', 'database backup', 'delete', 1),
(8526, 9, 'Admin', 'dashboard', 'create', 1),
(8527, 9, 'Admin', 'dashboard', 'read', 1),
(8528, 9, 'Admin', 'dashboard', 'update', 1),
(8529, 9, 'Admin', 'dashboard', 'delete', 1),
(8530, 9, 'Admin', 'account management', 'create', 1),
(8531, 9, 'Admin', 'account management', 'read', 1),
(8532, 9, 'Admin', 'account management', 'update', 1),
(8533, 9, 'Admin', 'account management', 'delete', 1),
(8534, 9, 'Admin', 'add user', 'create', 1),
(8535, 9, 'Admin', 'add user', 'read', 1),
(8536, 9, 'Admin', 'add user', 'update', 1),
(8537, 9, 'Admin', 'add user', 'delete', 1),
(8538, 9, 'Admin', 'user record', 'create', 1),
(8539, 9, 'Admin', 'user record', 'read', 1),
(8540, 9, 'Admin', 'user record', 'update', 1),
(8541, 9, 'Admin', 'user record', 'delete', 1),
(8542, 9, 'Admin', 'change password', 'create', 1),
(8543, 9, 'Admin', 'change password', 'read', 1),
(8544, 9, 'Admin', 'change password', 'update', 1),
(8545, 9, 'Admin', 'change password', 'delete', 1),
(8546, 9, 'Admin', 'profile', 'create', 1),
(8547, 9, 'Admin', 'profile', 'read', 1),
(8548, 9, 'Admin', 'profile', 'update', 1),
(8549, 9, 'Admin', 'profile', 'delete', 1),
(8550, 9, 'Admin', 'class management', 'create', 1),
(8551, 9, 'Admin', 'class management', 'read', 1),
(8552, 9, 'Admin', 'class management', 'update', 1),
(8553, 9, 'Admin', 'class management', 'delete', 1),
(8554, 9, 'Admin', 'add class', 'create', 1),
(8555, 9, 'Admin', 'add class', 'read', 1),
(8556, 9, 'Admin', 'add class', 'update', 1),
(8557, 9, 'Admin', 'add class', 'delete', 1),
(8558, 9, 'Admin', 'class record', 'create', 1),
(8559, 9, 'Admin', 'class record', 'read', 1),
(8560, 9, 'Admin', 'class record', 'update', 1),
(8561, 9, 'Admin', 'class record', 'delete', 1),
(8562, 9, 'Admin', 'assign subject class', 'create', 1),
(8563, 9, 'Admin', 'assign subject class', 'read', 1),
(8564, 9, 'Admin', 'assign subject class', 'update', 1),
(8565, 9, 'Admin', 'assign subject class', 'delete', 1),
(8566, 9, 'Admin', 'teacher management', 'create', 1),
(8567, 9, 'Admin', 'teacher management', 'read', 1),
(8568, 9, 'Admin', 'teacher management', 'update', 1),
(8569, 9, 'Admin', 'teacher management', 'delete', 1),
(8570, 9, 'Admin', 'teacher record', 'create', 1),
(8571, 9, 'Admin', 'teacher record', 'read', 1),
(8572, 9, 'Admin', 'teacher record', 'update', 1),
(8573, 9, 'Admin', 'teacher record', 'delete', 1),
(8574, 9, 'Admin', 'assign teacher to class', 'create', 1),
(8575, 9, 'Admin', 'assign teacher to class', 'read', 1),
(8576, 9, 'Admin', 'assign teacher to class', 'update', 1),
(8577, 9, 'Admin', 'assign teacher to class', 'delete', 1),
(8578, 9, 'Admin', 'grade setup', 'create', 1),
(8579, 9, 'Admin', 'grade setup', 'read', 1),
(8580, 9, 'Admin', 'grade setup', 'update', 1),
(8581, 9, 'Admin', 'grade setup', 'delete', 1),
(8582, 9, 'Admin', 'add grade', 'create', 1),
(8583, 9, 'Admin', 'add grade', 'read', 1),
(8584, 9, 'Admin', 'add grade', 'update', 1),
(8585, 9, 'Admin', 'add grade', 'delete', 1),
(8586, 9, 'Admin', 'grade record', 'create', 1),
(8587, 9, 'Admin', 'grade record', 'read', 1),
(8588, 9, 'Admin', 'grade record', 'update', 1),
(8589, 9, 'Admin', 'grade record', 'delete', 1),
(8590, 9, 'Admin', 'session Management', 'create', 1),
(8591, 9, 'Admin', 'session Management', 'read', 1),
(8592, 9, 'Admin', 'session Management', 'update', 1),
(8593, 9, 'Admin', 'session Management', 'delete', 1),
(8594, 9, 'Admin', 'create session', 'create', 1),
(8595, 9, 'Admin', 'create session', 'read', 1),
(8596, 9, 'Admin', 'create session', 'update', 1),
(8597, 9, 'Admin', 'create session', 'delete', 1),
(8598, 9, 'Admin', 'session record', 'create', 1),
(8599, 9, 'Admin', 'session record', 'read', 1),
(8600, 9, 'Admin', 'session record', 'update', 1),
(8601, 9, 'Admin', 'session record', 'delete', 1),
(8602, 9, 'Admin', 'subject management', 'create', 1),
(8603, 9, 'Admin', 'subject management', 'read', 1),
(8604, 9, 'Admin', 'subject management', 'update', 1),
(8605, 9, 'Admin', 'subject management', 'delete', 1),
(8606, 9, 'Admin', 'add subject', 'create', 1),
(8607, 9, 'Admin', 'add subject', 'read', 1),
(8608, 9, 'Admin', 'add subject', 'update', 1),
(8609, 9, 'Admin', 'add subject', 'delete', 1),
(8610, 9, 'Admin', 'subject record', 'create', 1),
(8611, 9, 'Admin', 'subject record', 'read', 1),
(8612, 9, 'Admin', 'subject record', 'update', 1),
(8613, 9, 'Admin', 'subject record', 'delete', 1),
(8614, 9, 'Admin', 'subject allocation', 'create', 1),
(8615, 9, 'Admin', 'subject allocation', 'read', 1),
(8616, 9, 'Admin', 'subject allocation', 'update', 1),
(8617, 9, 'Admin', 'subject allocation', 'delete', 1),
(8618, 9, 'Admin', 'subject allocation record', 'create', 1),
(8619, 9, 'Admin', 'subject allocation record', 'read', 1),
(8620, 9, 'Admin', 'subject allocation record', 'update', 1),
(8621, 9, 'Admin', 'subject allocation record', 'delete', 1),
(8622, 9, 'Admin', 'subject assignment record', 'create', 1),
(8623, 9, 'Admin', 'subject assignment record', 'read', 1),
(8624, 9, 'Admin', 'subject assignment record', 'update', 1),
(8625, 9, 'Admin', 'subject assignment record', 'delete', 1),
(8626, 9, 'Admin', 'result management', 'create', 1),
(8627, 9, 'Admin', 'result management', 'read', 1),
(8628, 9, 'Admin', 'result management', 'update', 1),
(8629, 9, 'Admin', 'result management', 'delete', 1),
(8630, 9, 'Admin', 'result record', 'create', 1),
(8631, 9, 'Admin', 'result record', 'read', 1),
(8632, 9, 'Admin', 'result record', 'update', 1),
(8633, 9, 'Admin', 'result record', 'delete', 1),
(8634, 9, 'Admin', 'score record', 'create', 1),
(8635, 9, 'Admin', 'score record', 'read', 1),
(8636, 9, 'Admin', 'score record', 'update', 1),
(8637, 9, 'Admin', 'score record', 'delete', 1),
(8638, 9, 'Admin', 'student management', 'create', 1),
(8639, 9, 'Admin', 'student management', 'read', 1),
(8640, 9, 'Admin', 'student management', 'update', 1),
(8641, 9, 'Admin', 'student management', 'delete', 1),
(8642, 9, 'Admin', 'student record', 'create', 1),
(8643, 9, 'Admin', 'student record', 'read', 1),
(8644, 9, 'Admin', 'student record', 'update', 1),
(8645, 9, 'Admin', 'student record', 'delete', 1),
(8646, 9, 'Admin', 'assign student to class', 'create', 1),
(8647, 9, 'Admin', 'assign student to class', 'read', 1),
(8648, 9, 'Admin', 'assign student to class', 'update', 1),
(8649, 9, 'Admin', 'assign student to class', 'delete', 1),
(8650, 9, 'Admin', 'scratch card management', 'create', 1),
(8651, 9, 'Admin', 'scratch card management', 'read', 1),
(8652, 9, 'Admin', 'scratch card management', 'update', 1),
(8653, 9, 'Admin', 'scratch card management', 'delete', 1),
(8654, 9, 'Admin', 'generate scratch card', 'create', 1),
(8655, 9, 'Admin', 'generate scratch card', 'read', 1),
(8656, 9, 'Admin', 'generate scratch card', 'update', 1),
(8657, 9, 'Admin', 'generate scratch card', 'delete', 1),
(8658, 9, 'Admin', 'scratch card record', 'create', 1),
(8659, 9, 'Admin', 'scratch card record', 'read', 1),
(8660, 9, 'Admin', 'scratch card record', 'update', 1),
(8661, 9, 'Admin', 'scratch card record', 'delete', 1),
(8662, 9, 'Admin', 'permission management', 'create', 1),
(8663, 9, 'Admin', 'permission management', 'read', 1),
(8664, 9, 'Admin', 'permission management', 'update', 1),
(8665, 9, 'Admin', 'permission management', 'delete', 1),
(8666, 9, 'Admin', 'add permission', 'create', 1),
(8667, 9, 'Admin', 'add permission', 'read', 1),
(8668, 9, 'Admin', 'add permission', 'update', 1),
(8669, 9, 'Admin', 'add permission', 'delete', 1),
(8670, 9, 'Admin', 'permission record', 'create', 1),
(8671, 9, 'Admin', 'permission record', 'read', 1),
(8672, 9, 'Admin', 'permission record', 'update', 1),
(8673, 9, 'Admin', 'permission record', 'delete', 1),
(8674, 9, 'Admin', 'promotion management', 'create', 1),
(8675, 9, 'Admin', 'promotion management', 'read', 1),
(8676, 9, 'Admin', 'promotion management', 'update', 1),
(8677, 9, 'Admin', 'promotion management', 'delete', 1),
(8678, 9, 'Admin', 'promotion', 'create', 1),
(8679, 9, 'Admin', 'promotion', 'read', 1),
(8680, 9, 'Admin', 'promotion', 'update', 1),
(8681, 9, 'Admin', 'promotion', 'delete', 1),
(8682, 9, 'Admin', 'exam record', 'create', 1),
(8683, 9, 'Admin', 'exam record', 'read', 1),
(8684, 9, 'Admin', 'exam record', 'update', 1),
(8685, 9, 'Admin', 'exam record', 'delete', 1),
(8686, 9, 'Admin', 'exam management', 'create', 1),
(8687, 9, 'Admin', 'exam management', 'read', 1),
(8688, 9, 'Admin', 'exam management', 'update', 1),
(8689, 9, 'Admin', 'exam management', 'delete', 1),
(8690, 9, 'Admin', 'add exam', 'create', 1),
(8691, 9, 'Admin', 'add exam', 'read', 1),
(8692, 9, 'Admin', 'add exam', 'update', 1),
(8693, 9, 'Admin', 'add exam', 'delete', 1),
(8694, 9, 'Admin', 'school setting', 'create', 1),
(8695, 9, 'Admin', 'school setting', 'read', 1),
(8696, 9, 'Admin', 'school setting', 'update', 1),
(8697, 9, 'Admin', 'school setting', 'delete', 1),
(8698, 9, 'Admin', 'activity log', 'create', 1),
(8699, 9, 'Admin', 'activity log', 'read', 1),
(8700, 9, 'Admin', 'activity log', 'update', 1),
(8701, 9, 'Admin', 'activity log', 'delete', 1),
(8702, 9, 'Admin', 'database backup', 'create', 1),
(8703, 9, 'Admin', 'database backup', 'read', 1),
(8704, 9, 'Admin', 'database backup', 'update', 1),
(8705, 9, 'Admin', 'database backup', 'delete', 1),
(8706, 9, 'Teacher', 'dashboard', 'create', 1),
(8707, 9, 'Teacher', 'dashboard', 'read', 1),
(8708, 9, 'Teacher', 'dashboard', 'update', 1),
(8709, 9, 'Teacher', 'dashboard', 'delete', 1),
(8710, 9, 'Teacher', 'account management', 'create', 1),
(8711, 9, 'Teacher', 'account management', 'read', 1),
(8712, 9, 'Teacher', 'account management', 'update', 1),
(8713, 9, 'Teacher', 'account management', 'delete', 1),
(8714, 9, 'Teacher', 'add user', 'create', 1),
(8715, 9, 'Teacher', 'add user', 'read', 1),
(8716, 9, 'Teacher', 'add user', 'update', 1),
(8717, 9, 'Teacher', 'add user', 'delete', 1),
(8718, 9, 'Teacher', 'user record', 'create', 1),
(8719, 9, 'Teacher', 'user record', 'read', 1),
(8720, 9, 'Teacher', 'user record', 'update', 1),
(8721, 9, 'Teacher', 'user record', 'delete', 1),
(8722, 9, 'Teacher', 'change password', 'create', 1),
(8723, 9, 'Teacher', 'change password', 'read', 1),
(8724, 9, 'Teacher', 'change password', 'update', 1),
(8725, 9, 'Teacher', 'change password', 'delete', 1),
(8726, 9, 'Teacher', 'profile', 'create', 1),
(8727, 9, 'Teacher', 'profile', 'read', 1),
(8728, 9, 'Teacher', 'profile', 'update', 1),
(8729, 9, 'Teacher', 'profile', 'delete', 1),
(8730, 9, 'Teacher', 'class management', 'create', 1),
(8731, 9, 'Teacher', 'class management', 'read', 1),
(8732, 9, 'Teacher', 'class management', 'update', 1),
(8733, 9, 'Teacher', 'class management', 'delete', 1),
(8734, 9, 'Teacher', 'add class', 'create', 1),
(8735, 9, 'Teacher', 'add class', 'read', 1),
(8736, 9, 'Teacher', 'add class', 'update', 1),
(8737, 9, 'Teacher', 'add class', 'delete', 1),
(8738, 9, 'Teacher', 'class record', 'create', 1),
(8739, 9, 'Teacher', 'class record', 'read', 1),
(8740, 9, 'Teacher', 'class record', 'update', 1),
(8741, 9, 'Teacher', 'class record', 'delete', 1),
(8742, 9, 'Teacher', 'assign subject class', 'create', 1),
(8743, 9, 'Teacher', 'assign subject class', 'read', 1),
(8744, 9, 'Teacher', 'assign subject class', 'update', 1),
(8745, 9, 'Teacher', 'assign subject class', 'delete', 1),
(8746, 9, 'Teacher', 'teacher management', 'create', 1),
(8747, 9, 'Teacher', 'teacher management', 'read', 1),
(8748, 9, 'Teacher', 'teacher management', 'update', 1),
(8749, 9, 'Teacher', 'teacher management', 'delete', 1),
(8750, 9, 'Teacher', 'teacher record', 'create', 1),
(8751, 9, 'Teacher', 'teacher record', 'read', 1),
(8752, 9, 'Teacher', 'teacher record', 'update', 1),
(8753, 9, 'Teacher', 'teacher record', 'delete', 1),
(8754, 9, 'Teacher', 'assign teacher to class', 'create', 1),
(8755, 9, 'Teacher', 'assign teacher to class', 'read', 1),
(8756, 9, 'Teacher', 'assign teacher to class', 'update', 1),
(8757, 9, 'Teacher', 'assign teacher to class', 'delete', 1),
(8758, 9, 'Teacher', 'grade setup', 'create', 1),
(8759, 9, 'Teacher', 'grade setup', 'read', 1),
(8760, 9, 'Teacher', 'grade setup', 'update', 1),
(8761, 9, 'Teacher', 'grade setup', 'delete', 1),
(8762, 9, 'Teacher', 'add grade', 'create', 1),
(8763, 9, 'Teacher', 'add grade', 'read', 1),
(8764, 9, 'Teacher', 'add grade', 'update', 1),
(8765, 9, 'Teacher', 'add grade', 'delete', 1),
(8766, 9, 'Teacher', 'grade record', 'create', 1),
(8767, 9, 'Teacher', 'grade record', 'read', 1),
(8768, 9, 'Teacher', 'grade record', 'update', 1),
(8769, 9, 'Teacher', 'grade record', 'delete', 1),
(8770, 9, 'Teacher', 'session Management', 'create', 1),
(8771, 9, 'Teacher', 'session Management', 'read', 1),
(8772, 9, 'Teacher', 'session Management', 'update', 1),
(8773, 9, 'Teacher', 'session Management', 'delete', 1),
(8774, 9, 'Teacher', 'create session', 'create', 1),
(8775, 9, 'Teacher', 'create session', 'read', 1),
(8776, 9, 'Teacher', 'create session', 'update', 1),
(8777, 9, 'Teacher', 'create session', 'delete', 1),
(8778, 9, 'Teacher', 'session record', 'create', 1),
(8779, 9, 'Teacher', 'session record', 'read', 1),
(8780, 9, 'Teacher', 'session record', 'update', 1),
(8781, 9, 'Teacher', 'session record', 'delete', 1),
(8782, 9, 'Teacher', 'subject management', 'create', 1),
(8783, 9, 'Teacher', 'subject management', 'read', 1),
(8784, 9, 'Teacher', 'subject management', 'update', 1),
(8785, 9, 'Teacher', 'subject management', 'delete', 1),
(8786, 9, 'Teacher', 'add subject', 'create', 1),
(8787, 9, 'Teacher', 'add subject', 'read', 1),
(8788, 9, 'Teacher', 'add subject', 'update', 1),
(8789, 9, 'Teacher', 'add subject', 'delete', 1),
(8790, 9, 'Teacher', 'subject record', 'create', 1),
(8791, 9, 'Teacher', 'subject record', 'read', 1),
(8792, 9, 'Teacher', 'subject record', 'update', 1),
(8793, 9, 'Teacher', 'subject record', 'delete', 1),
(8794, 9, 'Teacher', 'subject allocation', 'create', 1),
(8795, 9, 'Teacher', 'subject allocation', 'read', 1),
(8796, 9, 'Teacher', 'subject allocation', 'update', 1),
(8797, 9, 'Teacher', 'subject allocation', 'delete', 1),
(8798, 9, 'Teacher', 'subject allocation record', 'create', 1),
(8799, 9, 'Teacher', 'subject allocation record', 'read', 1),
(8800, 9, 'Teacher', 'subject allocation record', 'update', 1),
(8801, 9, 'Teacher', 'subject allocation record', 'delete', 1),
(8802, 9, 'Teacher', 'subject assignment record', 'create', 1),
(8803, 9, 'Teacher', 'subject assignment record', 'read', 1),
(8804, 9, 'Teacher', 'subject assignment record', 'update', 1),
(8805, 9, 'Teacher', 'subject assignment record', 'delete', 1),
(8806, 9, 'Teacher', 'result management', 'create', 1),
(8807, 9, 'Teacher', 'result management', 'read', 1),
(8808, 9, 'Teacher', 'result management', 'update', 1),
(8809, 9, 'Teacher', 'result management', 'delete', 1),
(8810, 9, 'Teacher', 'result record', 'create', 1),
(8811, 9, 'Teacher', 'result record', 'read', 1),
(8812, 9, 'Teacher', 'result record', 'update', 1),
(8813, 9, 'Teacher', 'result record', 'delete', 1),
(8814, 9, 'Teacher', 'upload scores', 'create', 1),
(8815, 9, 'Teacher', 'upload scores', 'read', 1),
(8816, 9, 'Teacher', 'upload scores', 'update', 1),
(8817, 9, 'Teacher', 'upload scores', 'delete', 1),
(8818, 9, 'Teacher', 'score record', 'create', 1),
(8819, 9, 'Teacher', 'score record', 'read', 1),
(8820, 9, 'Teacher', 'score record', 'update', 1),
(8821, 9, 'Teacher', 'score record', 'delete', 1),
(8822, 9, 'Teacher', 'student management', 'create', 1),
(8823, 9, 'Teacher', 'student management', 'read', 1),
(8824, 9, 'Teacher', 'student management', 'update', 1),
(8825, 9, 'Teacher', 'student management', 'delete', 1),
(8826, 9, 'Teacher', 'student record', 'create', 1),
(8827, 9, 'Teacher', 'student record', 'read', 1),
(8828, 9, 'Teacher', 'student record', 'update', 1),
(8829, 9, 'Teacher', 'student record', 'delete', 1),
(8830, 9, 'Teacher', 'assign student to class', 'create', 1),
(8831, 9, 'Teacher', 'assign student to class', 'read', 1),
(8832, 9, 'Teacher', 'assign student to class', 'update', 1),
(8833, 9, 'Teacher', 'assign student to class', 'delete', 1),
(8834, 9, 'Teacher', 'scratch card management', 'create', 1),
(8835, 9, 'Teacher', 'scratch card management', 'read', 1),
(8836, 9, 'Teacher', 'scratch card management', 'update', 1),
(8837, 9, 'Teacher', 'scratch card management', 'delete', 1),
(8838, 9, 'Teacher', 'generate scratch card', 'create', 1),
(8839, 9, 'Teacher', 'generate scratch card', 'read', 1),
(8840, 9, 'Teacher', 'generate scratch card', 'update', 1),
(8841, 9, 'Teacher', 'generate scratch card', 'delete', 1),
(8842, 9, 'Teacher', 'scratch card record', 'create', 1),
(8843, 9, 'Teacher', 'scratch card record', 'read', 1),
(8844, 9, 'Teacher', 'scratch card record', 'update', 1),
(8845, 9, 'Teacher', 'scratch card record', 'delete', 1),
(8846, 9, 'Teacher', 'permission management', 'create', 1),
(8847, 9, 'Teacher', 'permission management', 'read', 1),
(8848, 9, 'Teacher', 'permission management', 'update', 1),
(8849, 9, 'Teacher', 'permission management', 'delete', 1),
(8850, 9, 'Teacher', 'add permission', 'create', 1),
(8851, 9, 'Teacher', 'add permission', 'read', 1),
(8852, 9, 'Teacher', 'add permission', 'update', 1),
(8853, 9, 'Teacher', 'add permission', 'delete', 1),
(8854, 9, 'Teacher', 'permission record', 'create', 1),
(8855, 9, 'Teacher', 'permission record', 'read', 1),
(8856, 9, 'Teacher', 'permission record', 'update', 1),
(8857, 9, 'Teacher', 'permission record', 'delete', 1),
(8858, 9, 'Teacher', 'promotion management', 'create', 1),
(8859, 9, 'Teacher', 'promotion management', 'read', 1),
(8860, 9, 'Teacher', 'promotion management', 'update', 1),
(8861, 9, 'Teacher', 'promotion management', 'delete', 1),
(8862, 9, 'Teacher', 'promotion', 'create', 1),
(8863, 9, 'Teacher', 'promotion', 'read', 1),
(8864, 9, 'Teacher', 'promotion', 'update', 1),
(8865, 9, 'Teacher', 'promotion', 'delete', 1),
(8866, 9, 'Teacher', 'exam record', 'create', 1),
(8867, 9, 'Teacher', 'exam record', 'read', 1),
(8868, 9, 'Teacher', 'exam record', 'update', 1),
(8869, 9, 'Teacher', 'exam record', 'delete', 1),
(8870, 9, 'Teacher', 'exam management', 'create', 1),
(8871, 9, 'Teacher', 'exam management', 'read', 1),
(8872, 9, 'Teacher', 'exam management', 'update', 1),
(8873, 9, 'Teacher', 'exam management', 'delete', 1),
(8874, 9, 'Teacher', 'add exam', 'create', 1),
(8875, 9, 'Teacher', 'add exam', 'read', 1),
(8876, 9, 'Teacher', 'add exam', 'update', 1),
(8877, 9, 'Teacher', 'add exam', 'delete', 1),
(8878, 9, 'Teacher', 'school setting', 'create', 1),
(8879, 9, 'Teacher', 'school setting', 'read', 1),
(8880, 9, 'Teacher', 'school setting', 'update', 1),
(8881, 9, 'Teacher', 'school setting', 'delete', 1),
(8882, 9, 'Teacher', 'activity log', 'create', 1),
(8883, 9, 'Teacher', 'activity log', 'read', 1),
(8884, 9, 'Teacher', 'activity log', 'update', 1),
(8885, 9, 'Teacher', 'activity log', 'delete', 1),
(8886, 9, 'Teacher', 'database backup', 'create', 1),
(8887, 9, 'Teacher', 'database backup', 'read', 1),
(8888, 9, 'Teacher', 'database backup', 'update', 1),
(8889, 9, 'Teacher', 'database backup', 'delete', 1),
(8890, 11, 'Admin', 'dashboard', 'create', 1),
(8891, 11, 'Admin', 'dashboard', 'read', 1),
(8892, 11, 'Admin', 'dashboard', 'update', 1),
(8893, 11, 'Admin', 'dashboard', 'delete', 1),
(8894, 11, 'Admin', 'account management', 'create', 1),
(8895, 11, 'Admin', 'account management', 'read', 1),
(8896, 11, 'Admin', 'account management', 'update', 1),
(8897, 11, 'Admin', 'account management', 'delete', 1),
(8898, 11, 'Admin', 'add user', 'create', 1),
(8899, 11, 'Admin', 'add user', 'read', 1),
(8900, 11, 'Admin', 'add user', 'update', 1),
(8901, 11, 'Admin', 'add user', 'delete', 1),
(8902, 11, 'Admin', 'user record', 'create', 1),
(8903, 11, 'Admin', 'user record', 'read', 1),
(8904, 11, 'Admin', 'user record', 'update', 1),
(8905, 11, 'Admin', 'user record', 'delete', 1),
(8906, 11, 'Admin', 'change password', 'create', 1),
(8907, 11, 'Admin', 'change password', 'read', 1),
(8908, 11, 'Admin', 'change password', 'update', 1),
(8909, 11, 'Admin', 'change password', 'delete', 1),
(8910, 11, 'Admin', 'profile', 'create', 1),
(8911, 11, 'Admin', 'profile', 'read', 1),
(8912, 11, 'Admin', 'profile', 'update', 1),
(8913, 11, 'Admin', 'profile', 'delete', 1),
(8914, 11, 'Admin', 'class management', 'create', 1),
(8915, 11, 'Admin', 'class management', 'read', 1),
(8916, 11, 'Admin', 'class management', 'update', 1),
(8917, 11, 'Admin', 'class management', 'delete', 1),
(8918, 11, 'Admin', 'add class', 'create', 1),
(8919, 11, 'Admin', 'add class', 'read', 1),
(8920, 11, 'Admin', 'add class', 'update', 1),
(8921, 11, 'Admin', 'add class', 'delete', 1),
(8922, 11, 'Admin', 'class record', 'create', 1),
(8923, 11, 'Admin', 'class record', 'read', 1),
(8924, 11, 'Admin', 'class record', 'update', 1),
(8925, 11, 'Admin', 'class record', 'delete', 1),
(8926, 11, 'Admin', 'assign subject class', 'create', 1),
(8927, 11, 'Admin', 'assign subject class', 'read', 1),
(8928, 11, 'Admin', 'assign subject class', 'update', 1),
(8929, 11, 'Admin', 'assign subject class', 'delete', 1),
(8930, 11, 'Admin', 'teacher management', 'create', 1),
(8931, 11, 'Admin', 'teacher management', 'read', 1),
(8932, 11, 'Admin', 'teacher management', 'update', 1),
(8933, 11, 'Admin', 'teacher management', 'delete', 1),
(8934, 11, 'Admin', 'teacher record', 'create', 1),
(8935, 11, 'Admin', 'teacher record', 'read', 1),
(8936, 11, 'Admin', 'teacher record', 'update', 1),
(8937, 11, 'Admin', 'teacher record', 'delete', 1),
(8938, 11, 'Admin', 'assign teacher to class', 'create', 1),
(8939, 11, 'Admin', 'assign teacher to class', 'read', 1),
(8940, 11, 'Admin', 'assign teacher to class', 'update', 1),
(8941, 11, 'Admin', 'assign teacher to class', 'delete', 1),
(8942, 11, 'Admin', 'grade setup', 'create', 1),
(8943, 11, 'Admin', 'grade setup', 'read', 1),
(8944, 11, 'Admin', 'grade setup', 'update', 1),
(8945, 11, 'Admin', 'grade setup', 'delete', 1),
(8946, 11, 'Admin', 'add grade', 'create', 1),
(8947, 11, 'Admin', 'add grade', 'read', 1),
(8948, 11, 'Admin', 'add grade', 'update', 1),
(8949, 11, 'Admin', 'add grade', 'delete', 1),
(8950, 11, 'Admin', 'grade record', 'create', 1),
(8951, 11, 'Admin', 'grade record', 'read', 1),
(8952, 11, 'Admin', 'grade record', 'update', 1),
(8953, 11, 'Admin', 'grade record', 'delete', 1),
(8954, 11, 'Admin', 'session Management', 'create', 1),
(8955, 11, 'Admin', 'session Management', 'read', 1),
(8956, 11, 'Admin', 'session Management', 'update', 1),
(8957, 11, 'Admin', 'session Management', 'delete', 1),
(8958, 11, 'Admin', 'create session', 'create', 1),
(8959, 11, 'Admin', 'create session', 'read', 1);
INSERT INTO `permissions` (`id`, `school_id`, `role`, `module`, `permission_type`, `can_access`) VALUES
(8960, 11, 'Admin', 'create session', 'update', 1),
(8961, 11, 'Admin', 'create session', 'delete', 1),
(8962, 11, 'Admin', 'session record', 'create', 1),
(8963, 11, 'Admin', 'session record', 'read', 1),
(8964, 11, 'Admin', 'session record', 'update', 1),
(8965, 11, 'Admin', 'session record', 'delete', 1),
(8966, 11, 'Admin', 'subject management', 'create', 1),
(8967, 11, 'Admin', 'subject management', 'read', 1),
(8968, 11, 'Admin', 'subject management', 'update', 1),
(8969, 11, 'Admin', 'subject management', 'delete', 1),
(8970, 11, 'Admin', 'add subject', 'create', 1),
(8971, 11, 'Admin', 'add subject', 'read', 1),
(8972, 11, 'Admin', 'add subject', 'update', 1),
(8973, 11, 'Admin', 'add subject', 'delete', 1),
(8974, 11, 'Admin', 'subject record', 'create', 1),
(8975, 11, 'Admin', 'subject record', 'read', 1),
(8976, 11, 'Admin', 'subject record', 'update', 1),
(8977, 11, 'Admin', 'subject record', 'delete', 1),
(8978, 11, 'Admin', 'subject allocation', 'create', 1),
(8979, 11, 'Admin', 'subject allocation', 'read', 1),
(8980, 11, 'Admin', 'subject allocation', 'update', 1),
(8981, 11, 'Admin', 'subject allocation', 'delete', 1),
(8982, 11, 'Admin', 'subject allocation record', 'create', 1),
(8983, 11, 'Admin', 'subject allocation record', 'read', 1),
(8984, 11, 'Admin', 'subject allocation record', 'update', 1),
(8985, 11, 'Admin', 'subject allocation record', 'delete', 1),
(8986, 11, 'Admin', 'subject assignment record', 'create', 1),
(8987, 11, 'Admin', 'subject assignment record', 'read', 1),
(8988, 11, 'Admin', 'subject assignment record', 'update', 1),
(8989, 11, 'Admin', 'subject assignment record', 'delete', 1),
(8990, 11, 'Admin', 'result management', 'create', 1),
(8991, 11, 'Admin', 'result management', 'read', 1),
(8992, 11, 'Admin', 'result management', 'update', 1),
(8993, 11, 'Admin', 'result management', 'delete', 1),
(8994, 11, 'Admin', 'result record', 'create', 1),
(8995, 11, 'Admin', 'result record', 'read', 1),
(8996, 11, 'Admin', 'result record', 'update', 1),
(8997, 11, 'Admin', 'result record', 'delete', 1),
(8998, 11, 'Admin', 'score record', 'create', 1),
(8999, 11, 'Admin', 'score record', 'read', 1),
(9000, 11, 'Admin', 'score record', 'update', 1),
(9001, 11, 'Admin', 'score record', 'delete', 1),
(9002, 11, 'Admin', 'student management', 'create', 1),
(9003, 11, 'Admin', 'student management', 'read', 1),
(9004, 11, 'Admin', 'student management', 'update', 1),
(9005, 11, 'Admin', 'student management', 'delete', 1),
(9006, 11, 'Admin', 'student record', 'create', 1),
(9007, 11, 'Admin', 'student record', 'read', 1),
(9008, 11, 'Admin', 'student record', 'update', 1),
(9009, 11, 'Admin', 'student record', 'delete', 1),
(9010, 11, 'Admin', 'assign student to class', 'create', 1),
(9011, 11, 'Admin', 'assign student to class', 'read', 1),
(9012, 11, 'Admin', 'assign student to class', 'update', 1),
(9013, 11, 'Admin', 'assign student to class', 'delete', 1),
(9014, 11, 'Admin', 'scratch card management', 'create', 1),
(9015, 11, 'Admin', 'scratch card management', 'read', 1),
(9016, 11, 'Admin', 'scratch card management', 'update', 1),
(9017, 11, 'Admin', 'scratch card management', 'delete', 1),
(9018, 11, 'Admin', 'generate scratch card', 'create', 1),
(9019, 11, 'Admin', 'generate scratch card', 'read', 1),
(9020, 11, 'Admin', 'generate scratch card', 'update', 1),
(9021, 11, 'Admin', 'generate scratch card', 'delete', 1),
(9022, 11, 'Admin', 'scratch card record', 'create', 1),
(9023, 11, 'Admin', 'scratch card record', 'read', 1),
(9024, 11, 'Admin', 'scratch card record', 'update', 1),
(9025, 11, 'Admin', 'scratch card record', 'delete', 1),
(9026, 11, 'Admin', 'permission management', 'create', 1),
(9027, 11, 'Admin', 'permission management', 'read', 1),
(9028, 11, 'Admin', 'permission management', 'update', 1),
(9029, 11, 'Admin', 'permission management', 'delete', 1),
(9030, 11, 'Admin', 'add permission', 'create', 1),
(9031, 11, 'Admin', 'add permission', 'read', 1),
(9032, 11, 'Admin', 'add permission', 'update', 1),
(9033, 11, 'Admin', 'add permission', 'delete', 1),
(9034, 11, 'Admin', 'permission record', 'create', 1),
(9035, 11, 'Admin', 'permission record', 'read', 1),
(9036, 11, 'Admin', 'permission record', 'update', 1),
(9037, 11, 'Admin', 'permission record', 'delete', 1),
(9038, 11, 'Admin', 'promotion management', 'create', 1),
(9039, 11, 'Admin', 'promotion management', 'read', 1),
(9040, 11, 'Admin', 'promotion management', 'update', 1),
(9041, 11, 'Admin', 'promotion management', 'delete', 1),
(9042, 11, 'Admin', 'promotion', 'create', 1),
(9043, 11, 'Admin', 'promotion', 'read', 1),
(9044, 11, 'Admin', 'promotion', 'update', 1),
(9045, 11, 'Admin', 'promotion', 'delete', 1),
(9046, 11, 'Admin', 'exam record', 'create', 1),
(9047, 11, 'Admin', 'exam record', 'read', 1),
(9048, 11, 'Admin', 'exam record', 'update', 1),
(9049, 11, 'Admin', 'exam record', 'delete', 1),
(9050, 11, 'Admin', 'exam management', 'create', 1),
(9051, 11, 'Admin', 'exam management', 'read', 1),
(9052, 11, 'Admin', 'exam management', 'update', 1),
(9053, 11, 'Admin', 'exam management', 'delete', 1),
(9054, 11, 'Admin', 'add exam', 'create', 1),
(9055, 11, 'Admin', 'add exam', 'read', 1),
(9056, 11, 'Admin', 'add exam', 'update', 1),
(9057, 11, 'Admin', 'add exam', 'delete', 1),
(9058, 11, 'Admin', 'school setting', 'create', 1),
(9059, 11, 'Admin', 'school setting', 'read', 1),
(9060, 11, 'Admin', 'school setting', 'update', 1),
(9061, 11, 'Admin', 'school setting', 'delete', 1),
(9062, 11, 'Admin', 'activity log', 'create', 1),
(9063, 11, 'Admin', 'activity log', 'read', 1),
(9064, 11, 'Admin', 'activity log', 'update', 1),
(9065, 11, 'Admin', 'activity log', 'delete', 1),
(9066, 11, 'Admin', 'database backup', 'create', 1),
(9067, 11, 'Admin', 'database backup', 'read', 1),
(9068, 11, 'Admin', 'database backup', 'update', 1),
(9069, 11, 'Admin', 'database backup', 'delete', 1),
(9070, 11, 'Teacher', 'dashboard', 'create', 1),
(9071, 11, 'Teacher', 'dashboard', 'read', 1),
(9072, 11, 'Teacher', 'dashboard', 'update', 1),
(9073, 11, 'Teacher', 'account management', 'create', 1),
(9074, 11, 'Teacher', 'account management', 'read', 1),
(9075, 11, 'Teacher', 'account management', 'update', 1),
(9076, 11, 'Teacher', 'user record', 'read', 1),
(9077, 11, 'Teacher', 'change password', 'create', 1),
(9078, 11, 'Teacher', 'change password', 'read', 1),
(9079, 11, 'Teacher', 'profile', 'create', 1),
(9080, 11, 'Teacher', 'profile', 'read', 1),
(9081, 11, 'Teacher', 'profile', 'update', 1),
(9082, 11, 'Teacher', 'class management', 'create', 1),
(9083, 11, 'Teacher', 'class management', 'read', 1),
(9084, 11, 'Teacher', 'class management', 'update', 1),
(9085, 11, 'Teacher', 'class record', 'read', 1),
(9086, 11, 'Teacher', 'teacher management', 'create', 1),
(9087, 11, 'Teacher', 'teacher management', 'read', 1),
(9088, 11, 'Teacher', 'teacher record', 'create', 1),
(9089, 11, 'Teacher', 'teacher record', 'read', 1),
(9090, 11, 'Teacher', 'grade setup', 'read', 1),
(9091, 11, 'Teacher', 'grade record', 'create', 1),
(9092, 11, 'Teacher', 'grade record', 'read', 1),
(9093, 11, 'Teacher', 'session Management', 'create', 1),
(9094, 11, 'Teacher', 'session Management', 'read', 1),
(9095, 11, 'Teacher', 'session record', 'create', 1),
(9096, 11, 'Teacher', 'session record', 'read', 1),
(9097, 11, 'Teacher', 'subject management', 'create', 1),
(9098, 11, 'Teacher', 'subject management', 'read', 1),
(9099, 11, 'Teacher', 'subject record', 'create', 1),
(9100, 11, 'Teacher', 'subject record', 'read', 1),
(9101, 11, 'Teacher', 'subject allocation record', 'create', 1),
(9102, 11, 'Teacher', 'subject allocation record', 'read', 1),
(9103, 11, 'Teacher', 'subject assignment record', 'create', 1),
(9104, 11, 'Teacher', 'subject assignment record', 'read', 1),
(9105, 11, 'Teacher', 'result management', 'create', 1),
(9106, 11, 'Teacher', 'result management', 'read', 1),
(9107, 11, 'Teacher', 'result management', 'update', 1),
(9108, 11, 'Teacher', 'result management', 'delete', 1),
(9109, 11, 'Teacher', 'result record', 'create', 1),
(9110, 11, 'Teacher', 'result record', 'read', 1),
(9111, 11, 'Teacher', 'upload scores', 'create', 1),
(9112, 11, 'Teacher', 'upload scores', 'read', 1),
(9113, 11, 'Teacher', 'upload scores', 'update', 1),
(9114, 11, 'Teacher', 'upload scores', 'delete', 1),
(9115, 11, 'Teacher', 'score record', 'create', 1),
(9116, 11, 'Teacher', 'score record', 'read', 1),
(9117, 11, 'Teacher', 'score record', 'update', 1),
(9118, 11, 'Teacher', 'score record', 'delete', 1),
(9119, 11, 'Teacher', 'student management', 'create', 1),
(9120, 11, 'Teacher', 'student management', 'read', 1),
(9121, 11, 'Teacher', 'student record', 'create', 1),
(9122, 11, 'Teacher', 'student record', 'read', 1),
(9123, 11, 'Teacher', 'permission management', 'create', 1),
(9124, 11, 'Teacher', 'permission management', 'read', 1),
(9125, 11, 'Teacher', 'permission record', 'create', 1),
(9126, 11, 'Teacher', 'permission record', 'read', 1),
(9127, 11, 'Teacher', 'promotion management', 'create', 1),
(9128, 11, 'Teacher', 'promotion management', 'read', 1),
(9129, 11, 'Teacher', 'promotion management', 'update', 1),
(9130, 11, 'Teacher', 'promotion management', 'delete', 1),
(9131, 11, 'Teacher', 'exam record', 'create', 1),
(9132, 11, 'Teacher', 'exam record', 'read', 1),
(9133, 11, 'Teacher', 'exam management', 'create', 1),
(9134, 11, 'Teacher', 'exam management', 'read', 1),
(9135, 11, 'Teacher', 'activity log', 'create', 1),
(9136, 11, 'Teacher', 'activity log', 'read', 1),
(9137, 1, 'Admin', 'dashboard', 'create', 1),
(9138, 1, 'Admin', 'dashboard', 'read', 1),
(9139, 1, 'Admin', 'dashboard', 'update', 1),
(9140, 1, 'Admin', 'dashboard', 'delete', 1),
(9141, 1, 'Admin', 'account management', 'create', 1),
(9142, 1, 'Admin', 'account management', 'read', 1),
(9143, 1, 'Admin', 'account management', 'update', 1),
(9144, 1, 'Admin', 'account management', 'delete', 1),
(9145, 1, 'Admin', 'add user', 'create', 1),
(9146, 1, 'Admin', 'add user', 'read', 1),
(9147, 1, 'Admin', 'add user', 'update', 1),
(9148, 1, 'Admin', 'add user', 'delete', 1),
(9149, 1, 'Admin', 'user record', 'create', 1),
(9150, 1, 'Admin', 'user record', 'read', 1),
(9151, 1, 'Admin', 'user record', 'update', 1),
(9152, 1, 'Admin', 'user record', 'delete', 1),
(9153, 1, 'Admin', 'change password', 'create', 1),
(9154, 1, 'Admin', 'change password', 'read', 1),
(9155, 1, 'Admin', 'change password', 'update', 1),
(9156, 1, 'Admin', 'change password', 'delete', 1),
(9157, 1, 'Admin', 'profile', 'create', 1),
(9158, 1, 'Admin', 'profile', 'read', 1),
(9159, 1, 'Admin', 'profile', 'update', 1),
(9160, 1, 'Admin', 'profile', 'delete', 1),
(9161, 1, 'Admin', 'class management', 'create', 1),
(9162, 1, 'Admin', 'class management', 'read', 1),
(9163, 1, 'Admin', 'class management', 'update', 1),
(9164, 1, 'Admin', 'class management', 'delete', 1),
(9165, 1, 'Admin', 'add class', 'create', 1),
(9166, 1, 'Admin', 'add class', 'read', 1),
(9167, 1, 'Admin', 'add class', 'update', 1),
(9168, 1, 'Admin', 'add class', 'delete', 1),
(9169, 1, 'Admin', 'class record', 'create', 1),
(9170, 1, 'Admin', 'class record', 'read', 1),
(9171, 1, 'Admin', 'class record', 'update', 1),
(9172, 1, 'Admin', 'class record', 'delete', 1),
(9173, 1, 'Admin', 'assign subject class', 'create', 1),
(9174, 1, 'Admin', 'assign subject class', 'read', 1),
(9175, 1, 'Admin', 'assign subject class', 'update', 1),
(9176, 1, 'Admin', 'assign subject class', 'delete', 1),
(9177, 1, 'Admin', 'teacher management', 'create', 1),
(9178, 1, 'Admin', 'teacher management', 'read', 1),
(9179, 1, 'Admin', 'teacher management', 'update', 1),
(9180, 1, 'Admin', 'teacher management', 'delete', 1),
(9181, 1, 'Admin', 'teacher record', 'create', 1),
(9182, 1, 'Admin', 'teacher record', 'read', 1),
(9183, 1, 'Admin', 'teacher record', 'update', 1),
(9184, 1, 'Admin', 'teacher record', 'delete', 1),
(9185, 1, 'Admin', 'assign teacher to class', 'create', 1),
(9186, 1, 'Admin', 'assign teacher to class', 'read', 1),
(9187, 1, 'Admin', 'assign teacher to class', 'update', 1),
(9188, 1, 'Admin', 'assign teacher to class', 'delete', 1),
(9189, 1, 'Admin', 'grade setup', 'create', 1),
(9190, 1, 'Admin', 'grade setup', 'read', 1),
(9191, 1, 'Admin', 'grade setup', 'update', 1),
(9192, 1, 'Admin', 'grade setup', 'delete', 1),
(9193, 1, 'Admin', 'add grade', 'create', 1),
(9194, 1, 'Admin', 'add grade', 'read', 1),
(9195, 1, 'Admin', 'add grade', 'update', 1),
(9196, 1, 'Admin', 'add grade', 'delete', 1),
(9197, 1, 'Admin', 'grade record', 'create', 1),
(9198, 1, 'Admin', 'grade record', 'read', 1),
(9199, 1, 'Admin', 'grade record', 'update', 1),
(9200, 1, 'Admin', 'grade record', 'delete', 1),
(9201, 1, 'Admin', 'session Management', 'create', 1),
(9202, 1, 'Admin', 'session Management', 'read', 1),
(9203, 1, 'Admin', 'session Management', 'update', 1),
(9204, 1, 'Admin', 'session Management', 'delete', 1),
(9205, 1, 'Admin', 'create session', 'create', 1),
(9206, 1, 'Admin', 'create session', 'read', 1),
(9207, 1, 'Admin', 'create session', 'update', 1),
(9208, 1, 'Admin', 'create session', 'delete', 1),
(9209, 1, 'Admin', 'session record', 'create', 1),
(9210, 1, 'Admin', 'session record', 'read', 1),
(9211, 1, 'Admin', 'session record', 'update', 1),
(9212, 1, 'Admin', 'session record', 'delete', 1),
(9213, 1, 'Admin', 'subject management', 'create', 1),
(9214, 1, 'Admin', 'subject management', 'read', 1),
(9215, 1, 'Admin', 'subject management', 'update', 1),
(9216, 1, 'Admin', 'subject management', 'delete', 1),
(9217, 1, 'Admin', 'add subject', 'create', 1),
(9218, 1, 'Admin', 'add subject', 'read', 1),
(9219, 1, 'Admin', 'add subject', 'update', 1),
(9220, 1, 'Admin', 'add subject', 'delete', 1),
(9221, 1, 'Admin', 'subject record', 'create', 1),
(9222, 1, 'Admin', 'subject record', 'read', 1),
(9223, 1, 'Admin', 'subject record', 'update', 1),
(9224, 1, 'Admin', 'subject record', 'delete', 1),
(9225, 1, 'Admin', 'subject allocation', 'create', 1),
(9226, 1, 'Admin', 'subject allocation', 'read', 1),
(9227, 1, 'Admin', 'subject allocation', 'update', 1),
(9228, 1, 'Admin', 'subject allocation', 'delete', 1),
(9229, 1, 'Admin', 'subject allocation record', 'create', 1),
(9230, 1, 'Admin', 'subject allocation record', 'read', 1),
(9231, 1, 'Admin', 'subject allocation record', 'update', 1),
(9232, 1, 'Admin', 'subject allocation record', 'delete', 1),
(9233, 1, 'Admin', 'subject assignment record', 'create', 1),
(9234, 1, 'Admin', 'subject assignment record', 'read', 1),
(9235, 1, 'Admin', 'subject assignment record', 'update', 1),
(9236, 1, 'Admin', 'subject assignment record', 'delete', 1),
(9237, 1, 'Admin', 'result management', 'create', 1),
(9238, 1, 'Admin', 'result management', 'read', 1),
(9239, 1, 'Admin', 'result management', 'update', 1),
(9240, 1, 'Admin', 'result management', 'delete', 1),
(9241, 1, 'Admin', 'result record', 'create', 1),
(9242, 1, 'Admin', 'result record', 'read', 1),
(9243, 1, 'Admin', 'result record', 'update', 1),
(9244, 1, 'Admin', 'result record', 'delete', 1),
(9245, 1, 'Admin', 'score record', 'create', 1),
(9246, 1, 'Admin', 'score record', 'read', 1),
(9247, 1, 'Admin', 'score record', 'update', 1),
(9248, 1, 'Admin', 'score record', 'delete', 1),
(9249, 1, 'Admin', 'student management', 'create', 1),
(9250, 1, 'Admin', 'student management', 'read', 1),
(9251, 1, 'Admin', 'student management', 'update', 1),
(9252, 1, 'Admin', 'student management', 'delete', 1),
(9253, 1, 'Admin', 'register student', 'create', 1),
(9254, 1, 'Admin', 'register student', 'read', 1),
(9255, 1, 'Admin', 'register student', 'update', 1),
(9256, 1, 'Admin', 'register student', 'delete', 1),
(9257, 1, 'Admin', 'student record', 'create', 1),
(9258, 1, 'Admin', 'student record', 'read', 1),
(9259, 1, 'Admin', 'student record', 'update', 1),
(9260, 1, 'Admin', 'student record', 'delete', 1),
(9261, 1, 'Admin', 'assign student to class', 'create', 1),
(9262, 1, 'Admin', 'assign student to class', 'read', 1),
(9263, 1, 'Admin', 'assign student to class', 'update', 1),
(9264, 1, 'Admin', 'assign student to class', 'delete', 1),
(9265, 1, 'Admin', 'scratch card management', 'create', 1),
(9266, 1, 'Admin', 'scratch card management', 'read', 1),
(9267, 1, 'Admin', 'scratch card management', 'update', 1),
(9268, 1, 'Admin', 'scratch card management', 'delete', 1),
(9269, 1, 'Admin', 'generate scratch card', 'create', 1),
(9270, 1, 'Admin', 'generate scratch card', 'read', 1),
(9271, 1, 'Admin', 'generate scratch card', 'update', 1),
(9272, 1, 'Admin', 'generate scratch card', 'delete', 1),
(9273, 1, 'Admin', 'scratch card record', 'create', 1),
(9274, 1, 'Admin', 'scratch card record', 'read', 1),
(9275, 1, 'Admin', 'scratch card record', 'update', 1),
(9276, 1, 'Admin', 'scratch card record', 'delete', 1),
(9277, 1, 'Admin', 'permission management', 'create', 1),
(9278, 1, 'Admin', 'permission management', 'read', 1),
(9279, 1, 'Admin', 'permission management', 'update', 1),
(9280, 1, 'Admin', 'permission management', 'delete', 1),
(9281, 1, 'Admin', 'add permission', 'create', 1),
(9282, 1, 'Admin', 'add permission', 'read', 1),
(9283, 1, 'Admin', 'add permission', 'update', 1),
(9284, 1, 'Admin', 'add permission', 'delete', 1),
(9285, 1, 'Admin', 'permission record', 'create', 1),
(9286, 1, 'Admin', 'permission record', 'read', 1),
(9287, 1, 'Admin', 'permission record', 'update', 1),
(9288, 1, 'Admin', 'permission record', 'delete', 1),
(9289, 1, 'Admin', 'promotion management', 'create', 1),
(9290, 1, 'Admin', 'promotion management', 'read', 1),
(9291, 1, 'Admin', 'promotion management', 'update', 1),
(9292, 1, 'Admin', 'promotion management', 'delete', 1),
(9293, 1, 'Admin', 'promotion', 'create', 1),
(9294, 1, 'Admin', 'promotion', 'read', 1),
(9295, 1, 'Admin', 'promotion', 'update', 1),
(9296, 1, 'Admin', 'promotion', 'delete', 1),
(9297, 1, 'Admin', 'exam record', 'create', 1),
(9298, 1, 'Admin', 'exam record', 'read', 1),
(9299, 1, 'Admin', 'exam record', 'update', 1),
(9300, 1, 'Admin', 'exam record', 'delete', 1),
(9301, 1, 'Admin', 'exam management', 'create', 1),
(9302, 1, 'Admin', 'exam management', 'read', 1),
(9303, 1, 'Admin', 'exam management', 'update', 1),
(9304, 1, 'Admin', 'exam management', 'delete', 1),
(9305, 1, 'Admin', 'add exam', 'create', 1),
(9306, 1, 'Admin', 'add exam', 'read', 1),
(9307, 1, 'Admin', 'add exam', 'update', 1),
(9308, 1, 'Admin', 'add exam', 'delete', 1),
(9309, 1, 'Admin', 'school setting', 'create', 1),
(9310, 1, 'Admin', 'school setting', 'read', 1),
(9311, 1, 'Admin', 'school setting', 'update', 1),
(9312, 1, 'Admin', 'school setting', 'delete', 1),
(9313, 1, 'Admin', 'activity log', 'create', 1),
(9314, 1, 'Admin', 'activity log', 'read', 1),
(9315, 1, 'Admin', 'activity log', 'update', 1),
(9316, 1, 'Admin', 'activity log', 'delete', 1),
(9317, 1, 'Admin', 'database backup', 'create', 1),
(9318, 1, 'Admin', 'database backup', 'read', 1),
(9319, 1, 'Admin', 'database backup', 'update', 1),
(9320, 1, 'Admin', 'database backup', 'delete', 1),
(9575, 14, 'Teacher', 'dashboard', 'create', 1),
(9576, 14, 'Teacher', 'dashboard', 'read', 1),
(9577, 14, 'Teacher', 'dashboard', 'update', 1),
(9578, 14, 'Teacher', 'account management', 'create', 1),
(9579, 14, 'Teacher', 'account management', 'read', 1),
(9580, 14, 'Teacher', 'account management', 'update', 1),
(9581, 14, 'Teacher', 'user record', 'read', 1),
(9582, 14, 'Teacher', 'change password', 'create', 1),
(9583, 14, 'Teacher', 'change password', 'read', 1),
(9584, 14, 'Teacher', 'change password', 'update', 1),
(9585, 14, 'Teacher', 'profile', 'create', 1),
(9586, 14, 'Teacher', 'profile', 'read', 1),
(9587, 14, 'Teacher', 'profile', 'update', 1),
(9588, 14, 'Teacher', 'class management', 'create', 1),
(9589, 14, 'Teacher', 'class management', 'read', 1),
(9590, 14, 'Teacher', 'class management', 'update', 1),
(9591, 14, 'Teacher', 'class record', 'create', 1),
(9592, 14, 'Teacher', 'class record', 'read', 1),
(9593, 14, 'Teacher', 'teacher management', 'create', 1),
(9594, 14, 'Teacher', 'teacher management', 'read', 1),
(9595, 14, 'Teacher', 'teacher record', 'create', 1),
(9596, 14, 'Teacher', 'teacher record', 'read', 1),
(9597, 14, 'Teacher', 'grade setup', 'read', 1),
(9598, 14, 'Teacher', 'grade record', 'create', 1),
(9599, 14, 'Teacher', 'grade record', 'read', 1),
(9600, 14, 'Teacher', 'session Management', 'create', 1),
(9601, 14, 'Teacher', 'session Management', 'read', 1),
(9602, 14, 'Teacher', 'session record', 'create', 1),
(9603, 14, 'Teacher', 'session record', 'read', 1),
(9604, 14, 'Teacher', 'subject management', 'create', 1),
(9605, 14, 'Teacher', 'subject management', 'read', 1),
(9606, 14, 'Teacher', 'subject record', 'create', 1),
(9607, 14, 'Teacher', 'subject record', 'read', 1),
(9608, 14, 'Teacher', 'subject allocation record', 'create', 1),
(9609, 14, 'Teacher', 'subject allocation record', 'read', 1),
(9610, 14, 'Teacher', 'subject assignment record', 'create', 1),
(9611, 14, 'Teacher', 'subject assignment record', 'read', 1),
(9612, 14, 'Teacher', 'result management', 'create', 1),
(9613, 14, 'Teacher', 'result management', 'read', 1),
(9614, 14, 'Teacher', 'result management', 'update', 1),
(9615, 14, 'Teacher', 'result management', 'delete', 1),
(9616, 14, 'Teacher', 'result record', 'create', 1),
(9617, 14, 'Teacher', 'result record', 'read', 1),
(9618, 14, 'Teacher', 'upload scores', 'create', 1),
(9619, 14, 'Teacher', 'upload scores', 'read', 1),
(9620, 14, 'Teacher', 'upload scores', 'update', 1),
(9621, 14, 'Teacher', 'upload scores', 'delete', 1),
(9622, 14, 'Teacher', 'score record', 'create', 1),
(9623, 14, 'Teacher', 'score record', 'read', 1),
(9624, 14, 'Teacher', 'score record', 'update', 1),
(9625, 14, 'Teacher', 'score record', 'delete', 1),
(9626, 14, 'Teacher', 'student management', 'create', 1),
(9627, 14, 'Teacher', 'student management', 'read', 1),
(9628, 14, 'Teacher', 'student record', 'create', 1),
(9629, 14, 'Teacher', 'student record', 'read', 1),
(9630, 14, 'Teacher', 'permission management', 'create', 1),
(9631, 14, 'Teacher', 'permission management', 'read', 1),
(9632, 14, 'Teacher', 'permission record', 'create', 1),
(9633, 14, 'Teacher', 'permission record', 'read', 1),
(9634, 14, 'Teacher', 'promotion management', 'create', 1),
(9635, 14, 'Teacher', 'promotion management', 'read', 1),
(9636, 14, 'Teacher', 'promotion management', 'update', 1),
(9637, 14, 'Teacher', 'promotion management', 'delete', 1),
(9638, 14, 'Teacher', 'exam record', 'create', 1),
(9639, 14, 'Teacher', 'exam record', 'read', 1),
(9640, 14, 'Teacher', 'exam management', 'create', 1),
(9641, 14, 'Teacher', 'exam management', 'read', 1),
(9642, 14, 'Teacher', 'activity log', 'create', 1),
(9643, 14, 'Teacher', 'activity log', 'read', 1),
(9644, 14, 'Admin', 'dashboard', 'create', 1),
(9645, 14, 'Admin', 'dashboard', 'read', 1),
(9646, 14, 'Admin', 'dashboard', 'update', 1),
(9647, 14, 'Admin', 'dashboard', 'delete', 1),
(9648, 14, 'Admin', 'account management', 'create', 1),
(9649, 14, 'Admin', 'account management', 'read', 1),
(9650, 14, 'Admin', 'account management', 'update', 1),
(9651, 14, 'Admin', 'account management', 'delete', 1),
(9652, 14, 'Admin', 'add user', 'create', 1),
(9653, 14, 'Admin', 'add user', 'read', 1),
(9654, 14, 'Admin', 'add user', 'update', 1),
(9655, 14, 'Admin', 'add user', 'delete', 1),
(9656, 14, 'Admin', 'user record', 'create', 1),
(9657, 14, 'Admin', 'user record', 'read', 1),
(9658, 14, 'Admin', 'user record', 'update', 1),
(9659, 14, 'Admin', 'user record', 'delete', 1),
(9660, 14, 'Admin', 'change password', 'create', 1),
(9661, 14, 'Admin', 'change password', 'read', 1),
(9662, 14, 'Admin', 'change password', 'update', 1),
(9663, 14, 'Admin', 'change password', 'delete', 1),
(9664, 14, 'Admin', 'profile', 'create', 1),
(9665, 14, 'Admin', 'profile', 'read', 1),
(9666, 14, 'Admin', 'profile', 'update', 1),
(9667, 14, 'Admin', 'profile', 'delete', 1),
(9668, 14, 'Admin', 'class management', 'create', 1),
(9669, 14, 'Admin', 'class management', 'read', 1),
(9670, 14, 'Admin', 'class management', 'update', 1),
(9671, 14, 'Admin', 'class management', 'delete', 1),
(9672, 14, 'Admin', 'add class', 'create', 1),
(9673, 14, 'Admin', 'add class', 'read', 1),
(9674, 14, 'Admin', 'add class', 'update', 1),
(9675, 14, 'Admin', 'add class', 'delete', 1),
(9676, 14, 'Admin', 'class record', 'create', 1),
(9677, 14, 'Admin', 'class record', 'read', 1),
(9678, 14, 'Admin', 'class record', 'update', 1),
(9679, 14, 'Admin', 'class record', 'delete', 1),
(9680, 14, 'Admin', 'assign subject class', 'create', 1),
(9681, 14, 'Admin', 'assign subject class', 'read', 1),
(9682, 14, 'Admin', 'assign subject class', 'update', 1),
(9683, 14, 'Admin', 'assign subject class', 'delete', 1),
(9684, 14, 'Admin', 'teacher management', 'create', 1),
(9685, 14, 'Admin', 'teacher management', 'read', 1),
(9686, 14, 'Admin', 'teacher management', 'update', 1),
(9687, 14, 'Admin', 'teacher management', 'delete', 1),
(9688, 14, 'Admin', 'teacher record', 'create', 1),
(9689, 14, 'Admin', 'teacher record', 'read', 1),
(9690, 14, 'Admin', 'teacher record', 'update', 1),
(9691, 14, 'Admin', 'teacher record', 'delete', 1),
(9692, 14, 'Admin', 'assign teacher to class', 'create', 1),
(9693, 14, 'Admin', 'assign teacher to class', 'read', 1),
(9694, 14, 'Admin', 'assign teacher to class', 'update', 1),
(9695, 14, 'Admin', 'assign teacher to class', 'delete', 1),
(9696, 14, 'Admin', 'grade setup', 'create', 1),
(9697, 14, 'Admin', 'grade setup', 'read', 1),
(9698, 14, 'Admin', 'grade setup', 'update', 1),
(9699, 14, 'Admin', 'grade setup', 'delete', 1),
(9700, 14, 'Admin', 'add grade', 'create', 1),
(9701, 14, 'Admin', 'add grade', 'read', 1),
(9702, 14, 'Admin', 'add grade', 'update', 1),
(9703, 14, 'Admin', 'add grade', 'delete', 1),
(9704, 14, 'Admin', 'grade record', 'create', 1),
(9705, 14, 'Admin', 'grade record', 'read', 1),
(9706, 14, 'Admin', 'grade record', 'update', 1),
(9707, 14, 'Admin', 'grade record', 'delete', 1),
(9708, 14, 'Admin', 'session Management', 'create', 1),
(9709, 14, 'Admin', 'session Management', 'read', 1),
(9710, 14, 'Admin', 'session Management', 'update', 1),
(9711, 14, 'Admin', 'session Management', 'delete', 1),
(9712, 14, 'Admin', 'create session', 'create', 1),
(9713, 14, 'Admin', 'create session', 'read', 1),
(9714, 14, 'Admin', 'create session', 'update', 1),
(9715, 14, 'Admin', 'create session', 'delete', 1),
(9716, 14, 'Admin', 'session record', 'create', 1),
(9717, 14, 'Admin', 'session record', 'read', 1),
(9718, 14, 'Admin', 'session record', 'update', 1),
(9719, 14, 'Admin', 'session record', 'delete', 1),
(9720, 14, 'Admin', 'subject management', 'create', 1),
(9721, 14, 'Admin', 'subject management', 'read', 1),
(9722, 14, 'Admin', 'subject management', 'update', 1),
(9723, 14, 'Admin', 'subject management', 'delete', 1),
(9724, 14, 'Admin', 'add subject', 'create', 1),
(9725, 14, 'Admin', 'add subject', 'read', 1),
(9726, 14, 'Admin', 'add subject', 'update', 1),
(9727, 14, 'Admin', 'add subject', 'delete', 1),
(9728, 14, 'Admin', 'subject record', 'create', 1),
(9729, 14, 'Admin', 'subject record', 'read', 1),
(9730, 14, 'Admin', 'subject record', 'update', 1),
(9731, 14, 'Admin', 'subject record', 'delete', 1),
(9732, 14, 'Admin', 'subject allocation', 'create', 1),
(9733, 14, 'Admin', 'subject allocation', 'read', 1),
(9734, 14, 'Admin', 'subject allocation', 'update', 1),
(9735, 14, 'Admin', 'subject allocation', 'delete', 1),
(9736, 14, 'Admin', 'subject allocation record', 'create', 1),
(9737, 14, 'Admin', 'subject allocation record', 'read', 1),
(9738, 14, 'Admin', 'subject allocation record', 'update', 1),
(9739, 14, 'Admin', 'subject allocation record', 'delete', 1),
(9740, 14, 'Admin', 'subject assignment record', 'create', 1),
(9741, 14, 'Admin', 'subject assignment record', 'read', 1),
(9742, 14, 'Admin', 'subject assignment record', 'update', 1),
(9743, 14, 'Admin', 'subject assignment record', 'delete', 1),
(9744, 14, 'Admin', 'result management', 'create', 1),
(9745, 14, 'Admin', 'result management', 'read', 1),
(9746, 14, 'Admin', 'result management', 'update', 1),
(9747, 14, 'Admin', 'result management', 'delete', 1),
(9748, 14, 'Admin', 'result record', 'create', 1),
(9749, 14, 'Admin', 'result record', 'read', 1),
(9750, 14, 'Admin', 'result record', 'update', 1),
(9751, 14, 'Admin', 'result record', 'delete', 1),
(9752, 14, 'Admin', 'upload scores', 'create', 1),
(9753, 14, 'Admin', 'upload scores', 'read', 1),
(9754, 14, 'Admin', 'upload scores', 'update', 1),
(9755, 14, 'Admin', 'upload scores', 'delete', 1),
(9756, 14, 'Admin', 'score record', 'create', 1),
(9757, 14, 'Admin', 'score record', 'read', 1),
(9758, 14, 'Admin', 'score record', 'update', 1),
(9759, 14, 'Admin', 'score record', 'delete', 1),
(9760, 14, 'Admin', 'student management', 'create', 1),
(9761, 14, 'Admin', 'student management', 'read', 1),
(9762, 14, 'Admin', 'student management', 'update', 1),
(9763, 14, 'Admin', 'student management', 'delete', 1),
(9764, 14, 'Admin', 'register student', 'create', 1),
(9765, 14, 'Admin', 'register student', 'read', 1),
(9766, 14, 'Admin', 'register student', 'update', 1),
(9767, 14, 'Admin', 'register student', 'delete', 1),
(9768, 14, 'Admin', 'student record', 'create', 1),
(9769, 14, 'Admin', 'student record', 'read', 1),
(9770, 14, 'Admin', 'student record', 'update', 1),
(9771, 14, 'Admin', 'student record', 'delete', 1),
(9772, 14, 'Admin', 'assign student to class', 'create', 1),
(9773, 14, 'Admin', 'assign student to class', 'read', 1),
(9774, 14, 'Admin', 'assign student to class', 'update', 1),
(9775, 14, 'Admin', 'assign student to class', 'delete', 1),
(9776, 14, 'Admin', 'scratch card management', 'create', 1),
(9777, 14, 'Admin', 'scratch card management', 'read', 1),
(9778, 14, 'Admin', 'scratch card management', 'update', 1),
(9779, 14, 'Admin', 'scratch card management', 'delete', 1),
(9780, 14, 'Admin', 'generate scratch card', 'create', 1),
(9781, 14, 'Admin', 'generate scratch card', 'read', 1),
(9782, 14, 'Admin', 'generate scratch card', 'update', 1),
(9783, 14, 'Admin', 'generate scratch card', 'delete', 1),
(9784, 14, 'Admin', 'scratch card record', 'create', 1),
(9785, 14, 'Admin', 'scratch card record', 'read', 1),
(9786, 14, 'Admin', 'scratch card record', 'update', 1),
(9787, 14, 'Admin', 'scratch card record', 'delete', 1),
(9788, 14, 'Admin', 'permission management', 'create', 1),
(9789, 14, 'Admin', 'permission management', 'read', 1),
(9790, 14, 'Admin', 'permission management', 'update', 1),
(9791, 14, 'Admin', 'permission management', 'delete', 1),
(9792, 14, 'Admin', 'add permission', 'create', 1),
(9793, 14, 'Admin', 'add permission', 'read', 1),
(9794, 14, 'Admin', 'add permission', 'update', 1),
(9795, 14, 'Admin', 'add permission', 'delete', 1),
(9796, 14, 'Admin', 'permission record', 'create', 1),
(9797, 14, 'Admin', 'permission record', 'read', 1),
(9798, 14, 'Admin', 'permission record', 'update', 1),
(9799, 14, 'Admin', 'permission record', 'delete', 1),
(9800, 14, 'Admin', 'promotion management', 'create', 1),
(9801, 14, 'Admin', 'promotion management', 'read', 1),
(9802, 14, 'Admin', 'promotion management', 'update', 1),
(9803, 14, 'Admin', 'promotion management', 'delete', 1),
(9804, 14, 'Admin', 'promotion', 'create', 1),
(9805, 14, 'Admin', 'promotion', 'read', 1),
(9806, 14, 'Admin', 'promotion', 'update', 1),
(9807, 14, 'Admin', 'promotion', 'delete', 1),
(9808, 14, 'Admin', 'exam record', 'create', 1),
(9809, 14, 'Admin', 'exam record', 'read', 1),
(9810, 14, 'Admin', 'exam record', 'update', 1),
(9811, 14, 'Admin', 'exam record', 'delete', 1),
(9812, 14, 'Admin', 'exam management', 'create', 1),
(9813, 14, 'Admin', 'exam management', 'read', 1),
(9814, 14, 'Admin', 'exam management', 'update', 1),
(9815, 14, 'Admin', 'exam management', 'delete', 1),
(9816, 14, 'Admin', 'add exam', 'create', 1),
(9817, 14, 'Admin', 'add exam', 'read', 1),
(9818, 14, 'Admin', 'add exam', 'update', 1),
(9819, 14, 'Admin', 'add exam', 'delete', 1),
(9820, 14, 'Admin', 'school setting', 'create', 1),
(9821, 14, 'Admin', 'school setting', 'read', 1),
(9822, 14, 'Admin', 'school setting', 'update', 1),
(9823, 14, 'Admin', 'school setting', 'delete', 1),
(9824, 14, 'Admin', 'activity log', 'create', 1),
(9825, 14, 'Admin', 'activity log', 'read', 1),
(9826, 14, 'Admin', 'activity log', 'update', 1),
(9827, 14, 'Admin', 'activity log', 'delete', 1),
(9828, 14, 'Admin', 'database backup', 'create', 1),
(9829, 14, 'Admin', 'database backup', 'read', 1),
(9830, 14, 'Admin', 'database backup', 'update', 1),
(9831, 14, 'Admin', 'database backup', 'delete', 1),
(9832, 16, 'Admin', 'dashboard', 'create', 1),
(9833, 16, 'Admin', 'dashboard', 'read', 1),
(9834, 16, 'Admin', 'dashboard', 'update', 1),
(9835, 16, 'Admin', 'dashboard', 'delete', 1),
(9836, 16, 'Admin', 'account management', 'create', 1),
(9837, 16, 'Admin', 'account management', 'read', 1),
(9838, 16, 'Admin', 'account management', 'update', 1),
(9839, 16, 'Admin', 'account management', 'delete', 1),
(9840, 16, 'Admin', 'add user', 'create', 1),
(9841, 16, 'Admin', 'add user', 'read', 1),
(9842, 16, 'Admin', 'add user', 'update', 1),
(9843, 16, 'Admin', 'add user', 'delete', 1),
(9844, 16, 'Admin', 'user record', 'create', 1),
(9845, 16, 'Admin', 'user record', 'read', 1),
(9846, 16, 'Admin', 'user record', 'update', 1),
(9847, 16, 'Admin', 'user record', 'delete', 1),
(9848, 16, 'Admin', 'change password', 'create', 1),
(9849, 16, 'Admin', 'change password', 'read', 1),
(9850, 16, 'Admin', 'change password', 'update', 1),
(9851, 16, 'Admin', 'change password', 'delete', 1),
(9852, 16, 'Admin', 'profile', 'create', 1),
(9853, 16, 'Admin', 'profile', 'read', 1),
(9854, 16, 'Admin', 'profile', 'update', 1),
(9855, 16, 'Admin', 'profile', 'delete', 1),
(9856, 16, 'Admin', 'class management', 'create', 1),
(9857, 16, 'Admin', 'class management', 'read', 1),
(9858, 16, 'Admin', 'class management', 'update', 1),
(9859, 16, 'Admin', 'class management', 'delete', 1),
(9860, 16, 'Admin', 'add class', 'create', 1),
(9861, 16, 'Admin', 'add class', 'read', 1),
(9862, 16, 'Admin', 'add class', 'update', 1),
(9863, 16, 'Admin', 'add class', 'delete', 1),
(9864, 16, 'Admin', 'class record', 'create', 1),
(9865, 16, 'Admin', 'class record', 'read', 1),
(9866, 16, 'Admin', 'class record', 'update', 1),
(9867, 16, 'Admin', 'class record', 'delete', 1),
(9868, 16, 'Admin', 'assign subject class', 'create', 1),
(9869, 16, 'Admin', 'assign subject class', 'read', 1),
(9870, 16, 'Admin', 'assign subject class', 'update', 1),
(9871, 16, 'Admin', 'assign subject class', 'delete', 1),
(9872, 16, 'Admin', 'teacher management', 'create', 1),
(9873, 16, 'Admin', 'teacher management', 'read', 1),
(9874, 16, 'Admin', 'teacher management', 'update', 1),
(9875, 16, 'Admin', 'teacher management', 'delete', 1),
(9876, 16, 'Admin', 'teacher record', 'create', 1),
(9877, 16, 'Admin', 'teacher record', 'read', 1),
(9878, 16, 'Admin', 'teacher record', 'update', 1),
(9879, 16, 'Admin', 'teacher record', 'delete', 1),
(9880, 16, 'Admin', 'assign teacher to class', 'create', 1),
(9881, 16, 'Admin', 'assign teacher to class', 'read', 1),
(9882, 16, 'Admin', 'assign teacher to class', 'update', 1),
(9883, 16, 'Admin', 'assign teacher to class', 'delete', 1),
(9884, 16, 'Admin', 'grade setup', 'create', 1),
(9885, 16, 'Admin', 'grade setup', 'read', 1),
(9886, 16, 'Admin', 'grade setup', 'update', 1),
(9887, 16, 'Admin', 'grade setup', 'delete', 1),
(9888, 16, 'Admin', 'add grade', 'create', 1),
(9889, 16, 'Admin', 'add grade', 'read', 1),
(9890, 16, 'Admin', 'add grade', 'update', 1),
(9891, 16, 'Admin', 'add grade', 'delete', 1),
(9892, 16, 'Admin', 'grade record', 'create', 1),
(9893, 16, 'Admin', 'grade record', 'read', 1),
(9894, 16, 'Admin', 'grade record', 'update', 1),
(9895, 16, 'Admin', 'grade record', 'delete', 1),
(9896, 16, 'Admin', 'session Management', 'create', 1),
(9897, 16, 'Admin', 'session Management', 'read', 1),
(9898, 16, 'Admin', 'session Management', 'update', 1),
(9899, 16, 'Admin', 'session Management', 'delete', 1),
(9900, 16, 'Admin', 'create session', 'create', 1),
(9901, 16, 'Admin', 'create session', 'read', 1),
(9902, 16, 'Admin', 'create session', 'update', 1),
(9903, 16, 'Admin', 'create session', 'delete', 1),
(9904, 16, 'Admin', 'session record', 'create', 1),
(9905, 16, 'Admin', 'session record', 'read', 1),
(9906, 16, 'Admin', 'session record', 'update', 1),
(9907, 16, 'Admin', 'session record', 'delete', 1),
(9908, 16, 'Admin', 'subject management', 'create', 1),
(9909, 16, 'Admin', 'subject management', 'read', 1),
(9910, 16, 'Admin', 'subject management', 'update', 1),
(9911, 16, 'Admin', 'subject management', 'delete', 1),
(9912, 16, 'Admin', 'add subject', 'create', 1),
(9913, 16, 'Admin', 'add subject', 'read', 1),
(9914, 16, 'Admin', 'add subject', 'update', 1),
(9915, 16, 'Admin', 'add subject', 'delete', 1),
(9916, 16, 'Admin', 'subject record', 'create', 1),
(9917, 16, 'Admin', 'subject record', 'read', 1),
(9918, 16, 'Admin', 'subject record', 'update', 1),
(9919, 16, 'Admin', 'subject record', 'delete', 1),
(9920, 16, 'Admin', 'subject allocation', 'create', 1),
(9921, 16, 'Admin', 'subject allocation', 'read', 1),
(9922, 16, 'Admin', 'subject allocation', 'update', 1),
(9923, 16, 'Admin', 'subject allocation', 'delete', 1),
(9924, 16, 'Admin', 'subject allocation record', 'create', 1),
(9925, 16, 'Admin', 'subject allocation record', 'read', 1),
(9926, 16, 'Admin', 'subject allocation record', 'update', 1),
(9927, 16, 'Admin', 'subject allocation record', 'delete', 1),
(9928, 16, 'Admin', 'subject assignment record', 'create', 1),
(9929, 16, 'Admin', 'subject assignment record', 'read', 1),
(9930, 16, 'Admin', 'subject assignment record', 'update', 1),
(9931, 16, 'Admin', 'subject assignment record', 'delete', 1),
(9932, 16, 'Admin', 'result management', 'create', 1),
(9933, 16, 'Admin', 'result management', 'read', 1),
(9934, 16, 'Admin', 'result management', 'update', 1),
(9935, 16, 'Admin', 'result management', 'delete', 1),
(9936, 16, 'Admin', 'result record', 'create', 1),
(9937, 16, 'Admin', 'result record', 'read', 1),
(9938, 16, 'Admin', 'result record', 'update', 1),
(9939, 16, 'Admin', 'result record', 'delete', 1),
(9940, 16, 'Admin', 'score record', 'create', 1),
(9941, 16, 'Admin', 'score record', 'read', 1),
(9942, 16, 'Admin', 'score record', 'update', 1),
(9943, 16, 'Admin', 'score record', 'delete', 1),
(9944, 16, 'Admin', 'student management', 'create', 1),
(9945, 16, 'Admin', 'student management', 'read', 1),
(9946, 16, 'Admin', 'student management', 'update', 1),
(9947, 16, 'Admin', 'student management', 'delete', 1),
(9948, 16, 'Admin', 'register student', 'create', 1),
(9949, 16, 'Admin', 'register student', 'read', 1),
(9950, 16, 'Admin', 'register student', 'update', 1),
(9951, 16, 'Admin', 'register student', 'delete', 1),
(9952, 16, 'Admin', 'student record', 'create', 1),
(9953, 16, 'Admin', 'student record', 'read', 1),
(9954, 16, 'Admin', 'student record', 'update', 1),
(9955, 16, 'Admin', 'student record', 'delete', 1),
(9956, 16, 'Admin', 'assign student to class', 'create', 1),
(9957, 16, 'Admin', 'assign student to class', 'read', 1),
(9958, 16, 'Admin', 'assign student to class', 'update', 1),
(9959, 16, 'Admin', 'assign student to class', 'delete', 1),
(9960, 16, 'Admin', 'scratch card management', 'create', 1),
(9961, 16, 'Admin', 'scratch card management', 'read', 1),
(9962, 16, 'Admin', 'scratch card management', 'update', 1),
(9963, 16, 'Admin', 'scratch card management', 'delete', 1),
(9964, 16, 'Admin', 'generate scratch card', 'create', 1),
(9965, 16, 'Admin', 'generate scratch card', 'read', 1),
(9966, 16, 'Admin', 'generate scratch card', 'update', 1),
(9967, 16, 'Admin', 'generate scratch card', 'delete', 1),
(9968, 16, 'Admin', 'scratch card record', 'create', 1),
(9969, 16, 'Admin', 'scratch card record', 'read', 1),
(9970, 16, 'Admin', 'scratch card record', 'update', 1),
(9971, 16, 'Admin', 'scratch card record', 'delete', 1),
(9972, 16, 'Admin', 'permission management', 'create', 1),
(9973, 16, 'Admin', 'permission management', 'read', 1),
(9974, 16, 'Admin', 'permission management', 'update', 1),
(9975, 16, 'Admin', 'permission management', 'delete', 1),
(9976, 16, 'Admin', 'add permission', 'create', 1),
(9977, 16, 'Admin', 'add permission', 'read', 1),
(9978, 16, 'Admin', 'add permission', 'update', 1),
(9979, 16, 'Admin', 'add permission', 'delete', 1),
(9980, 16, 'Admin', 'permission record', 'create', 1),
(9981, 16, 'Admin', 'permission record', 'read', 1),
(9982, 16, 'Admin', 'permission record', 'update', 1),
(9983, 16, 'Admin', 'permission record', 'delete', 1),
(9984, 16, 'Admin', 'promotion management', 'create', 1),
(9985, 16, 'Admin', 'promotion management', 'read', 1),
(9986, 16, 'Admin', 'promotion management', 'update', 1),
(9987, 16, 'Admin', 'promotion management', 'delete', 1),
(9988, 16, 'Admin', 'promotion', 'create', 1),
(9989, 16, 'Admin', 'promotion', 'read', 1),
(9990, 16, 'Admin', 'promotion', 'update', 1),
(9991, 16, 'Admin', 'promotion', 'delete', 1),
(9992, 16, 'Admin', 'exam record', 'create', 1),
(9993, 16, 'Admin', 'exam record', 'read', 1),
(9994, 16, 'Admin', 'exam record', 'update', 1),
(9995, 16, 'Admin', 'exam record', 'delete', 1),
(9996, 16, 'Admin', 'exam management', 'create', 1),
(9997, 16, 'Admin', 'exam management', 'read', 1),
(9998, 16, 'Admin', 'exam management', 'update', 1),
(9999, 16, 'Admin', 'exam management', 'delete', 1),
(10000, 16, 'Admin', 'add exam', 'create', 1),
(10001, 16, 'Admin', 'add exam', 'read', 1),
(10002, 16, 'Admin', 'add exam', 'update', 1),
(10003, 16, 'Admin', 'add exam', 'delete', 1),
(10004, 16, 'Admin', 'school setting', 'create', 1),
(10005, 16, 'Admin', 'school setting', 'read', 1),
(10006, 16, 'Admin', 'school setting', 'update', 1),
(10007, 16, 'Admin', 'school setting', 'delete', 1),
(10008, 16, 'Admin', 'activity log', 'create', 1),
(10009, 16, 'Admin', 'activity log', 'read', 1),
(10010, 16, 'Admin', 'activity log', 'update', 1),
(10011, 16, 'Admin', 'activity log', 'delete', 1),
(10012, 16, 'Admin', 'database backup', 'create', 1),
(10013, 16, 'Admin', 'database backup', 'read', 1),
(10014, 16, 'Admin', 'database backup', 'update', 1),
(10015, 16, 'Admin', 'database backup', 'delete', 1),
(10052, 16, 'Teacher', 'dashboard', 'create', 1),
(10053, 16, 'Teacher', 'dashboard', 'read', 1),
(10054, 16, 'Teacher', 'dashboard', 'update', 1),
(10055, 16, 'Teacher', 'dashboard', 'delete', 1),
(10056, 16, 'Teacher', 'result management', 'create', 1),
(10057, 16, 'Teacher', 'result management', 'read', 1),
(10058, 16, 'Teacher', 'result record', 'create', 1),
(10059, 16, 'Teacher', 'result record', 'read', 1),
(10060, 16, 'Teacher', 'result record', 'update', 1),
(10061, 16, 'Teacher', 'upload scores', 'create', 1),
(10062, 16, 'Teacher', 'upload scores', 'read', 1),
(10063, 16, 'Teacher', 'upload scores', 'update', 1),
(10064, 16, 'Teacher', 'upload scores', 'delete', 1),
(10065, 16, 'Teacher', 'score record', 'read', 1),
(10066, 16, 'Teacher', 'student management', 'read', 1),
(10067, 16, 'Teacher', 'student record', 'read', 1);

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

CREATE TABLE `promotions` (
  `id` int(11) NOT NULL,
  `school_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `from_class_id` int(11) DEFAULT NULL,
  `to_class_id` int(11) DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `promoted_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE `schools` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `code` varchar(100) DEFAULT NULL,
  `phone1` varchar(20) DEFAULT NULL,
  `phone2` varchar(20) DEFAULT NULL,
  `box` varchar(100) DEFAULT NULL,
  `region` varchar(100) DEFAULT NULL,
  `district` varchar(100) DEFAULT NULL,
  `headmaster_name` varchar(255) DEFAULT NULL,
  `headmaster_signature` text DEFAULT NULL,
  `logo` text DEFAULT NULL,
  `gpsaddress` varchar(255) DEFAULT NULL,
  `amount_scratch_card` varchar(11) DEFAULT NULL,
  `paystack_public_key` text DEFAULT NULL,
  `paystack_secret_key` text DEFAULT NULL,
  `status` enum('1','0') DEFAULT '1',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`id`, `name`, `address`, `email`, `code`, `phone1`, `phone2`, `box`, `region`, `district`, `headmaster_name`, `headmaster_signature`, `logo`, `gpsaddress`, `amount_scratch_card`, `paystack_public_key`, `paystack_secret_key`, `status`, `created_at`) VALUES
(16, 'Ghana International School', '20 Barrack rd,  uyo', 'newleastpaysolution@gmail.com', '836064', '09043355666', '123-456-7891', '565', 'Ahafo', 'Goaso', 'Nse  Walter', 'uploadImage/Signature/signature.png', NULL, '1312342', '120', 'pk_test_9ec59b185041d43b15100d668a88bbb4340e3e96', 'sk_test_5ce8266da43dc03d429aef2dfcc4fc986f642eec', '1', '2025-05-28 10:59:08');

-- --------------------------------------------------------

--
-- Table structure for table `scratch_cards`
--

CREATE TABLE `scratch_cards` (
  `id` int(11) NOT NULL,
  `school_id` int(11) DEFAULT NULL,
  `pin` varchar(50) DEFAULT NULL,
  `serial_number` varchar(50) DEFAULT NULL,
  `is_used` tinyint(1) DEFAULT 0,
  `used_by_student_id` int(11) DEFAULT NULL,
  `used_by_exam_id` int(4) DEFAULT NULL,
  `used_on` timestamp NULL DEFAULT NULL,
  `usage_count` int(11) DEFAULT 0,
  `max_usage` int(11) DEFAULT 3,
  `created_at` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `scratch_cards`
--

INSERT INTO `scratch_cards` (`id`, `school_id`, `pin`, `serial_number`, `is_used`, `used_by_student_id`, `used_by_exam_id`, `used_on`, `usage_count`, `max_usage`, `created_at`) VALUES
(147, 16, '271CF14CBB68411E6FA3', 'D7A4240A311AA0F99D2E', 1, 65, 13, '2025-05-28 18:37:53', 1, 3, '2025-05-28 18:24:05');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `admission_no` varchar(50) NOT NULL,
  `school_id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `sex` enum('Male','Female') NOT NULL,
  `dob` varchar(15) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `region` varchar(100) DEFAULT NULL,
  `district` varchar(100) DEFAULT NULL,
  `parent_email` varchar(100) DEFAULT NULL,
  `parent_phone` varchar(20) DEFAULT NULL,
  `day_boarding` enum('Day','Boarding') DEFAULT NULL,
  `previous_school` varchar(100) DEFAULT NULL,
  `house` varchar(50) DEFAULT NULL,
  `status` enum('1','0') DEFAULT '0',
  `result_status` enum('1','0') DEFAULT '1',
  `photo` varchar(255) DEFAULT 'uploadImage/Profile/default.png',
  `current_session_id` int(11) DEFAULT NULL,
  `promoted` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `admission_no`, `school_id`, `fullname`, `password`, `sex`, `dob`, `class_id`, `address`, `region`, `district`, `parent_email`, `parent_phone`, `day_boarding`, `previous_school`, `house`, `status`, `result_status`, `photo`, `current_session_id`, `promoted`, `created_at`) VALUES
(65, '12345', 16, 'Bassey Akpan', '$2y$10$e4eg6eUqFAPUFuuEF8F90uI0qCahn.Ew1u79CHdgQD.4IDnU7d3nS', 'Male', '6/12/2009', 22, 'ikot utu', 'Ahafo', 'Goaso', 'newleastpaysolution@yahoo.com', '8056723322', 'Day', 'Gorretti female school', 'Red', '1', '1', 'uploadImage/Profile/photo_683751343a6402.71951569.jpg', 18, 0, '2025-05-28 11:55:20'),
(66, '23979', 16, 'Uduak Uduka', '$2y$10$4hAmzVg6z5GQ8WKJHY.2kulhSKsT4.V7hgBqkDjkHXfeYUtPDu3Wy\n', 'Female', '9/2/1990', 22, '4 ikot akpan omon', 'uyo', 'aks', 'newleastpaysolution@gmail.com', '9090656656', 'Boarding', 'Liberty school', NULL, '1', '1', 'uploadImage/Profile/default.png', 18, 0, '2025-05-28 11:55:20');

-- --------------------------------------------------------

--
-- Table structure for table `student_login_logs`
--

CREATE TABLE `student_login_logs` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `login_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_login_logs`
--

INSERT INTO `student_login_logs` (`id`, `student_id`, `ip_address`, `login_at`) VALUES
(26, 5, '::1', '2025-05-12 14:48:15'),
(27, 5, '::1', '2025-05-12 15:36:37'),
(28, 5, '::1', '2025-05-13 21:11:22'),
(29, 5, '::1', '2025-05-15 11:56:37'),
(30, 4, '::1', '2025-05-16 11:15:15'),
(31, 5, '::1', '2025-05-16 11:24:00'),
(32, 8, '::1', '2025-05-17 22:34:29'),
(33, 10, '::1', '2025-05-18 11:24:43'),
(34, 11, '::1', '2025-05-18 23:19:32'),
(35, 11, '::1', '2025-05-18 23:23:35'),
(36, 11, '::1', '2025-05-18 23:33:41'),
(37, 4, '::1', '2025-05-24 21:22:17'),
(38, 5, '::1', '2025-05-26 00:55:09'),
(39, 5, '::1', '2025-05-26 00:57:18'),
(40, 5, '::1', '2025-05-26 01:13:19'),
(41, 5, '::1', '2025-05-26 10:36:04'),
(42, 5, '::1', '2025-05-26 15:31:01'),
(43, 38, '41.215.165.251', '2025-05-27 18:02:04'),
(44, 5, '102.90.45.62', '2025-05-27 18:52:56'),
(45, 65, '102.88.111.74', '2025-05-28 18:08:28');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `school_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `school_id`, `name`, `code`, `created_at`) VALUES
(11, 14, 'ENGLISH LANGUAGE', '8764', '2025-05-27 14:07:18'),
(12, 14, 'CORE MATHEMATICS', '9579', '2025-05-27 14:07:36'),
(13, 14, 'INTEGRATED SCIENCE', '8243', '2025-05-27 14:07:52'),
(14, 14, 'SOCIAL STUDIES', '4052', '2025-05-27 14:08:09'),
(15, 14, 'I.C.T', '5017', '2025-05-27 14:08:31'),
(16, 14, 'FOOD AND NUTRITION', '8249', '2025-05-27 14:08:48'),
(17, 14, 'GKA', '7262', '2025-05-27 14:09:17'),
(18, 14, 'MANAGEMENT IN LIVING', '2301', '2025-05-27 14:09:31'),
(19, 14, 'PHYSICAL EDUCATION', '4413', '2025-05-27 14:41:35'),
(20, 14, 'BIOLOGY', '8883', '2025-05-27 14:45:12'),
(21, 11, 'Mathematics', '5402', '2025-05-27 17:56:38'),
(22, 11, 'English', '8136', '2025-05-27 17:56:43'),
(23, 11, 'Computer Studies', '1912', '2025-05-27 17:56:50'),
(24, 16, 'Computer Studies', '6810', '2025-05-28 11:55:54'),
(25, 16, 'Mathematics', '4956', '2025-05-28 11:56:00');

-- --------------------------------------------------------

--
-- Table structure for table `subject_teacher`
--

CREATE TABLE `subject_teacher` (
  `id` int(11) NOT NULL,
  `school_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject_teacher`
--

INSERT INTO `subject_teacher` (`id`, `school_id`, `subject_id`, `user_id`, `class_id`, `created_at`) VALUES
(21, 14, 11, 18, 19, '2025-05-27 17:12:59'),
(22, 14, 12, 18, 19, '2025-05-27 17:13:05'),
(23, 14, 13, 18, 19, '2025-05-27 17:13:14'),
(24, 11, 21, 19, 21, '2025-05-27 17:58:00'),
(25, 11, 22, 19, 21, '2025-05-27 17:58:06'),
(26, 11, 23, 19, 21, '2025-05-27 17:58:10'),
(27, 14, 11, 20, 19, '2025-05-27 23:34:42'),
(28, 14, 12, 20, 19, '2025-05-27 23:34:48'),
(29, 14, 13, 20, 19, '2025-05-27 23:34:56'),
(30, 14, 15, 20, 19, '2025-05-27 23:35:03'),
(31, 16, 24, 25, 22, '2025-05-28 12:12:55'),
(32, 16, 25, 25, 22, '2025-05-28 12:12:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `school_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` text NOT NULL,
  `role` enum('Admin','Teacher') DEFAULT NULL,
  `status` enum('1','0') DEFAULT '1',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `school_id`, `name`, `phone`, `email`, `password`, `role`, `status`, `created_at`) VALUES
(17, 14, 'Mansen', '0266059070', 'snraddae@gmail.com', '$2y$10$6z5S1ITFbNlwTpjEMNt6Ju1CuLHVXyTaZ/0/Gi/QHGy2HS2SHe.Ym', 'Admin', '1', '2025-05-27 11:51:25'),
(19, 11, 'Eyo Ansa', '08067361023', 'newleastpaysolution@yahoo.com', '$2y$10$rFbRmlPayJw8J9GHfhAuieuIqSWAL5eFRoLxPkYXgGmlsSCNiYKoq', 'Teacher', '1', '2025-05-27 17:57:33'),
(20, 14, 'Osei Seth', '0546425546', 'teacheronegh@gmail.com', '$2y$10$DSgCt8jnzRf45XU.Da4uyOi9Evblwx6lIdmUW6uU27DGlP103JyDC', 'Teacher', '1', '2025-05-27 19:48:24'),
(24, 16, 'Mathew Umoh', '08067361023', 'newleastpaysolution@gmail.com', '$2y$10$F6STOZSyKC/td8CvYTTac.NN6f3LPlCBgdcXBj7HOyoCg0CBNYVEm', 'Admin', '1', '2025-05-28 11:07:46'),
(25, 16, 'Daniel Edem', '08067361023', 'newleastpaysolution@yahoo.com', '$2y$10$e4eg6eUqFAPUFuuEF8F90uI0qCahn.Ew1u79CHdgQD.4IDnU7d3nS', 'Teacher', '1', '2025-05-28 11:48:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_session`
--
ALTER TABLE `academic_session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `class_students`
--
ALTER TABLE `class_students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_id` (`school_id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `class_subjects`
--
ALTER TABLE `class_subjects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_class_subject` (`class_id`,`subject_id`),
  ADD KEY `fk_cs_school` (`school_id`),
  ADD KEY `fk_cs_subject` (`subject_id`);

--
-- Indexes for table `class_teachers`
--
ALTER TABLE `class_teachers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_id` (`school_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_results`
--
ALTER TABLE `exam_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `exam_id` (`exam_id`),
  ADD KEY `session_id` (`session_id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `grade_id` (`grade_id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `otps`
--
ALTER TABLE `otps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `owners`
--
ALTER TABLE `owners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `from_class_id` (`from_class_id`),
  ADD KEY `to_class_id` (`to_class_id`),
  ADD KEY `school_id` (`school_id`),
  ADD KEY `session_id` (`session_id`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scratch_cards`
--
ALTER TABLE `scratch_cards`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pin` (`pin`),
  ADD UNIQUE KEY `serial_number` (`serial_number`),
  ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_login_logs`
--
ALTER TABLE `student_login_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `subject_teacher`
--
ALTER TABLE `subject_teacher`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_id` (`school_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_id` (`school_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_session`
--
ALTER TABLE `academic_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=547;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `class_students`
--
ALTER TABLE `class_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `class_subjects`
--
ALTER TABLE `class_subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `class_teachers`
--
ALTER TABLE `class_teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `exam_results`
--
ALTER TABLE `exam_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `otps`
--
ALTER TABLE `otps`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `owners`
--
ALTER TABLE `owners`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10068;

--
-- AUTO_INCREMENT for table `promotions`
--
ALTER TABLE `promotions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `scratch_cards`
--
ALTER TABLE `scratch_cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `student_login_logs`
--
ALTER TABLE `student_login_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `subject_teacher`
--
ALTER TABLE `subject_teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
