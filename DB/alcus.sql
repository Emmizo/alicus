-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 05, 2023 at 03:40 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alcus`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `client_name` varchar(255) DEFAULT NULL,
  `BOD` varchar(255) DEFAULT NULL,
  `SSN` varchar(255) DEFAULT NULL,
  `insurance_ID` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `race` varchar(255) DEFAULT NULL,
  `ethnicity` varchar(255) DEFAULT NULL,
  `gender_birth` varchar(255) DEFAULT NULL,
  `martial_status` varchar(255) DEFAULT NULL,
  `house_hold` varchar(255) DEFAULT NULL,
  `preferred_language` varchar(255) DEFAULT NULL,
  `employment_status` varchar(255) DEFAULT NULL,
  `emergency_name` varchar(255) DEFAULT NULL,
  `emergency_phone` varchar(255) DEFAULT NULL,
  `emergency_email` varchar(255) DEFAULT NULL,
  `relationship` varchar(255) DEFAULT NULL,
  `emergency_address` varchar(255) DEFAULT NULL,
  `primary_care_provider` varchar(255) DEFAULT NULL,
  `client_PIN` varchar(255) DEFAULT NULL,
  `insurance_code` varchar(255) DEFAULT NULL,
  `company_id` int(11) UNSIGNED NOT NULL,
  `created_by` int(11) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `discharged` int(11) NOT NULL DEFAULT 0,
  `discharged_at` varchar(255) DEFAULT NULL,
  `paid` int(11) DEFAULT 0,
  `is_deleted` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `client_name`, `BOD`, `SSN`, `insurance_ID`, `country`, `address`, `telephone`, `email`, `race`, `ethnicity`, `gender_birth`, `martial_status`, `house_hold`, `preferred_language`, `employment_status`, `emergency_name`, `emergency_phone`, `emergency_email`, `relationship`, `emergency_address`, `primary_care_provider`, `client_PIN`, `insurance_code`, `company_id`, `created_by`, `status`, `discharged`, `discharged_at`, `paid`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Nyakuri Revitte', '2002-02-24', 'ssn', '1', 'Rwanda', 'Kigali', '(078) 112-7373', 'emmizokwizera@gmail.com', 'N/A', 'R', 'M', 'Married', 'none', 'English', 'Engineer', 'Kalisa Claude', '(078) 273-7333', 'kalisa@gmail.com', 'Uncle', 'Kibagabaga', 'N/A', '334', NULL, 1, 3, 1, 0, '2022-12-19 14:50:06', 0, 1, '2022-12-27 18:28:27', '2022-12-27 18:28:27'),
(2, 'Muganga Maurice', '2002-02-28', 'new data', '1', 'Rwanda', 'Rwamagana', '(078) 112-7373', 'emmizokwizera@gmail.com', 'American Indan or Alaska Native', 'Hispanic or Latino', 'Male', 'Married', 'Household', 'English', 'Employed', 'Kalisa Claude', '(078) 273-7333', 'k@gmail.com', 'Uncle', 'Kibagabaga', 'N/A', '334', '7777', 1, 3, 0, 0, NULL, 0, 1, '2022-12-19 09:13:29', '2022-12-19 07:13:29'),
(3, 'Ndanyuzwe Duncan', '2002-01-03', 'ssn', '1', 'Rwanda', 'Kigali', '(333) 333-3333', 'againtest2020@gmail.com', 'American Indan or Alaska Native', 'Hispanic or Latino', 'Male', 'Single', 'Household', 'English', 'Employed', 'Kalisa Claude', '(078) 273-7333', NULL, 'Uncle', 'Kibagabaga', 'N/A', '12345', NULL, 1, 3, 1, 0, NULL, 1, 1, '2022-12-18 18:14:21', '2022-12-18 16:14:21'),
(4, 'Bernard Hakizimana', '2022-12-04', '34', '1', 'Rwanda', 'Kigali', '(333) 333-3333', 'dadohhakizimana@gmail.com', 'American Indan or Alaska Native', 'Hispanic or Latino', 'Male', 'Married', 'Household', 'English', 'Employed', 'Kalisa Claude', '(078) 273-7333', NULL, 'Uncle', 'Kibagabaga', 'N/A', '1222', NULL, 1, 3, 1, 0, NULL, 0, 1, '2022-12-18 17:56:45', '2022-12-18 15:56:45'),
(5, 'Florbert Habimana', '1996-07-14', 'ssn', '1', 'Rwanda', 'Kigali', '(333) 333-3333', 'gastonniyizi@gmail.com', 'N/A', 'ethnicity', 'Male', 'Single', 'none', 'English', 'Engineer', 'Kalisa Claude', '(078) 273-7333', NULL, 'Uncle', 'Kibagabaga', 'N/A', '1234', NULL, 1, 3, 1, 0, '2022-12-19 15:58:31', 0, 1, '2022-12-27 18:29:04', '2022-12-27 18:29:04'),
(6, 'Gastion', '1997-07-19', 'ssn', '1', 'Rwanda', 'Nyarugenge/Kigali', '(333) 333-3333', 'gastonniyizi@gmail.com', 'American Indan or Alaska Native', 'Ashkenazi Jewish', 'Male', 'Single', 'Household', 'English', 'Employed', NULL, NULL, NULL, NULL, NULL, NULL, '1234', '11111', 1, 3, 1, 0, NULL, 0, 1, '2022-12-27 20:06:45', '2022-12-27 18:06:45');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `company_logo` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `first_name`, `last_name`, `phone`, `email`, `company_name`, `company_logo`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Kwizera', 'Emmanuel', '(078) 116-7275', 'thefuture@gmail.com', 'TheFuture Ltd4', 'companies_logo/1668523552-2.png', 1, 0, '2022-12-26 09:05:35', '2022-12-26 07:05:35'),
(2, 'Emmizo', 'Emmizo', '(078) 116-7275', 'emmizotech@gmail.com', 'TheFuture Ltd2', 'companies_logo/1668576069-3.png', 1, 0, '2022-11-16 03:21:09', '2022-11-16 03:21:09'),
(4, 'Karangwa', 'Janvier', '(078) 273-7377', 'info@iremeapp.com', 'Tech Mob', 'companies_logo/1670342508-ireme.png', 1, 0, '2022-12-06 14:01:49', '2022-12-06 14:01:49'),
(5, 'Karangwa', 'Janvier', '(078) 273-7377', 'info@iremeappa.com', 'Tech Mobile', 'companies_logo/1670346234-ireme.png', 1, 0, '2022-12-26 11:30:07', '2022-12-26 09:30:07'),
(6, 'Karangwa', 'Janvier', '(078) 273-7377', 'info@iremeapp11.com', 'Tech Mob23', NULL, 1, 0, '2022-12-27 20:09:04', '2022-12-27 18:09:04');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `doc_name` varchar(255) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `discharged` int(11) NOT NULL DEFAULT 0,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `title`, `doc_name`, `created_by`, `client_id`, `status`, `discharged`, `is_deleted`, `created_at`, `updated_at`) VALUES
(2, 'Good', 'TheFuture-Ltd4/Good-0001.pdf', 3, 1, 1, 1, 0, '2022-12-18 14:50:06', '2022-12-18 12:50:06'),
(3, 'bk', 'TheFuture-Ltd4/bk-001.pdf', 3, 1, 1, 1, 0, '2022-12-18 14:50:06', '2022-12-18 12:50:06'),
(4, 'Group note', 'TheFuture-Ltd4/Group note-001.pdf', 3, 1, 1, 1, 0, '2022-12-18 14:50:06', '2022-12-18 12:50:06'),
(5, 'New', 'TheFuture-Ltd4/New-001.pdf', 3, 1, 1, 1, 0, '2022-12-18 14:50:06', '2022-12-18 12:50:06'),
(6, 'hhhh', 'TheFuture-Ltd4/hhhh-001.pdf', 3, 1, 1, 1, 0, '2022-12-18 14:50:06', '2022-12-18 12:50:06');

-- --------------------------------------------------------

--
-- Table structure for table `echat`
--

CREATE TABLE `echat` (
  `id` int(11) UNSIGNED NOT NULL,
  `medical_applied_id` int(11) UNSIGNED NOT NULL,
  `action` varchar(255) DEFAULT NULL,
  `qty` varchar(255) DEFAULT NULL,
  `recorded_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `comment` text DEFAULT NULL,
  `client_pin` text DEFAULT NULL,
  `staff_id` int(11) UNSIGNED NOT NULL,
  `staff_signature` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `discharged` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `echat`
--

INSERT INTO `echat` (`id`, `medical_applied_id`, `action`, `qty`, `recorded_at`, `comment`, `client_pin`, `staff_id`, `staff_signature`, `status`, `discharged`, `created_at`, `updated_at`) VALUES
(114, 5, 'refused', '0', '2022-12-19 20:40:57', NULL, '334', 3, '3', 1, 0, '2022-12-19 18:40:57', '2022-12-19 18:40:57'),
(115, 6, 'Taken', '1', '2022-12-19 20:40:57', NULL, '334', 3, '3', 1, 0, '2022-12-19 18:40:57', '2022-12-19 18:40:57'),
(116, 5, 'refused', '0', '2022-12-19 20:45:40', '2', '334', 3, '3', 1, 0, '2022-12-19 18:45:40', '2022-12-19 18:45:40');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `group_notes`
--

CREATE TABLE `group_notes` (
  `id` int(11) UNSIGNED NOT NULL,
  `client_id` int(11) UNSIGNED NOT NULL,
  `topic` varchar(255) DEFAULT NULL,
  `group_note` text DEFAULT NULL,
  `mood` text DEFAULT NULL,
  `effect` text DEFAULT NULL,
  `level_participation` varchar(255) DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `discharged` int(11) NOT NULL DEFAULT 0,
  `staff_id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `group_notes`
--

INSERT INTO `group_notes` (`id`, `client_id`, `topic`, `group_note`, `mood`, `effect`, `level_participation`, `comments`, `status`, `discharged`, `staff_id`, `created_at`, `updated_at`) VALUES
(7, 2, 'This is about your illness', 'Hi there', '[\"Conflicted\",\"Inappropriate\",\"Depressed\",\"Envious\",\"Hopeful\",\"Excited\"]', '[\"Angry\",\"Inappropriate\"]', '[\"Low\"]', 'Hi there', 1, 0, 3, '2022-11-27 08:51:32', '2022-11-27 08:51:32'),
(8, 1, 'This is about your illness', 'Hi there', '[\"Appropriate\",\"Conflicted\",\"Annoyed\",\"Anxious\",\"Restless\",\"Energetic\"]', '\"Restricted\"', 'null', 'Hi there, take care of yourself', 1, 1, 3, '2022-12-18 14:50:06', '2022-12-18 12:50:06'),
(12, 2, 'This is about how his recovering', 'Hi this form is for group notes', '[\"Appropriate\",\"Conflicted\",\"Annoyed\",\"Anxious\",\"Restless\",\"Energetic\"]', '[\"Motivated\",\"Restricted\"]', '[\"High\"]', 'Hi there', 1, 0, 3, '2022-12-01 11:38:28', '2022-12-01 11:38:28'),
(13, 2, 'Muganga Maurice\'s Group notes', 'New data for u', '[\"Appropriate\",\"Conflicted\",\"Annoyed\",\"Anxious\",\"Restless\",\"Energetic\"]', '[\"Motivated\",\"Restricted\"]', '[\"High\"]', 'Hi man', 1, 0, 3, '2022-12-01 11:40:30', '2022-12-01 11:40:30'),
(14, 1, 'This is about your illness', 'h', '[\"Appropriate\",\"Annoyed\",\"Anxious\",\"Energetic\",\"Fearful\",\"Hopeful\"]', '[\"Angry\",\"Inappropriate\"]', '[\"Medium\"]', 'Hi there', 1, 1, 3, '2022-12-18 14:50:06', '2022-12-18 12:50:06'),
(15, 5, 'This is about your illness', '<p>Hi <strong>man</strong></p>', '[\"Appropriate\",\"Conflicted\",\"Annoyed\",\"Anxious\",\"Restless\",\"Energetic\"]', '[\"Motivated\",\"Restricted\"]', '[\"High\"]', '<p>Nothing to changes</p>', 1, 0, 3, '2023-01-05 07:34:53', '2023-01-05 07:34:53'),
(16, 3, 'This is about your illness', '<p>Hi There</p>', '[\"Appropriate\",\"Conflicted\",\"Annoyed\",\"Anxious\",\"Restless\",\"Energetic\"]', '[\"Motivated\",\"Restricted\"]', '[\"High\"]', '<p>Hi <strong>you</strong></p>', 1, 0, 3, '2023-01-05 11:40:35', '2023-01-05 11:40:35');

-- --------------------------------------------------------

--
-- Table structure for table `individual_notes`
--

CREATE TABLE `individual_notes` (
  `id` int(11) NOT NULL,
  `topic` varchar(255) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `individual_therapy` varchar(255) DEFAULT NULL,
  `mood` varchar(255) DEFAULT NULL,
  `effect` varchar(255) DEFAULT NULL,
  `level_participation` varchar(255) DEFAULT NULL,
  `comments` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `discharged` int(11) NOT NULL DEFAULT 0,
  `staff_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `individual_notes`
--

INSERT INTO `individual_notes` (`id`, `topic`, `client_id`, `individual_therapy`, `mood`, `effect`, `level_participation`, `comments`, `status`, `discharged`, `staff_id`, `created_at`, `updated_at`) VALUES
(1, 'This is about your illness', 1, 'Hi there', '[\"Appropriate\",\"Conflicted\",\"Annoyed\",\"Anxious\",\"Restless\",\"Energetic\"]', '[\"Motivated\",\"Restricted\"]', '[\"High\"]', 'Hi man', 1, 1, 3, '2022-12-18 14:50:06', '2022-12-18 12:50:06'),
(2, 'Fofo', 5, 'Yes we can', '[\"Appropriate\",\"Fearful\",\"Guilty\",\"Uninterested\",\"Regretful\",\"Relaxed\"]', '[\"Motivated\",\"Inappropriate\"]', '[\"Neutral\"]', 'Hi man', 1, 0, 3, '2022-12-30 16:44:48', '2022-12-30 16:44:48'),
(3, 'This is about your illness', 2, 'Hi there individual', '[\"Appropriate\",\"Energetic\",\"Fearful\",\"Guilty\",\"Bored\",\"Relaxed\"]', '[\"Motivated\",\"Happy\"]', '[\"Medium\"]', NULL, 1, 0, 3, '2023-01-01 05:29:11', '2023-01-01 05:29:11'),
(4, 'This is about your illness', 1, '<p>Hi <strong>man</strong></p>', '[\"Appropriate\",\"Conflicted\",\"Annoyed\",\"Anxious\",\"Restless\",\"Energetic\"]', '[\"Motivated\",\"Restricted\"]', '[\"High\"]', '<p>Hi again</p>', 1, 0, 3, '2023-01-05 08:12:12', '2023-01-05 08:12:12'),
(5, 'This is about your illness', 5, '<p>This is <strong>about your illness</strong></p>', '[\"Inappropriate\",\"Fearful\",\"Depressed\",\"Envious\",\"Hopeful\",\"Excited\"]', '[\"Angry\",\"Inappropriate\"]', '[\"Medium\"]', '<p><strong>This is about</strong> your illness</p>', 1, 0, 3, '2023-01-05 09:50:29', '2023-01-05 09:50:29');

-- --------------------------------------------------------

--
-- Table structure for table `insurances`
--

CREATE TABLE `insurances` (
  `id` int(11) NOT NULL,
  `insurance_company` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `percentage` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `insurance_name` varchar(255) NOT NULL,
  `company_id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `insurances`
--

INSERT INTO `insurances` (`id`, `insurance_company`, `phone`, `percentage`, `address`, `insurance_name`, `company_id`, `created_at`, `updated_at`) VALUES
(1, 'RSSB', '(078) 288-8889', '90', 'Nyarugenge/Kigali', 'Mutuelle', 1, '2022-12-17 12:53:56', '2022-12-17 10:53:56'),
(5, 'Bank of Kigali', '(078) 288-8889', '90', 'Nyarugenge/Kigali', 'BK insurance', 1, '2022-12-17 12:47:59', '2022-12-17 10:47:59'),
(6, 'I&M Bank', '(078) 288-8881', '100', 'Nyarugenge/Kigali', 'I&M Insurance', 1, '2022-12-17 12:48:39', '2022-12-17 10:48:39'),
(7, 'Equity Bank', '(078) 288-8889', '90', 'Nyarugenge/Kigali', 'Equity', 1, '2022-12-17 13:13:02', '2022-12-17 11:13:02'),
(8, 'Radiant', '(078) 288-8889', '90', 'Nyarugenge/Kigali', 'Radiant', 1, '2022-12-19 18:53:42', '2022-12-19 18:53:42'),
(9, 'Bank of Kigali', '(078) 288-8881', '90', 'Nyarugenge/Kigali', 'BK insurance', 6, '2022-12-22 07:19:31', '2022-12-22 07:19:31');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) UNSIGNED NOT NULL,
  `client_id` int(11) UNSIGNED NOT NULL,
  `staff_id` int(11) UNSIGNED DEFAULT NULL,
  `start_date` varchar(255) DEFAULT NULL,
  `billing_date` varchar(255) DEFAULT NULL,
  `no_of_day` varchar(255) DEFAULT NULL,
  `price_per_day` varchar(255) DEFAULT NULL,
  `tot` varchar(255) DEFAULT NULL,
  `payment` varchar(255) DEFAULT NULL,
  `due_payment` varchar(255) DEFAULT NULL,
  `discharged` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `client_id`, `staff_id`, `start_date`, `billing_date`, `no_of_day`, `price_per_day`, `tot`, `payment`, `due_payment`, `discharged`, `created_at`, `updated_at`) VALUES
(5, 1, 3, '2022-12-01', '2022-12-10', '9', '1000', '9000', '3000', '6000', 1, '2022-12-18 14:50:06', '2022-12-18 12:50:06'),
(6, 1, 3, '2022-12-10', '2022-12-10', '9', '1000', '9000', '6000', '0', 1, '2022-12-18 14:50:06', '2022-12-18 12:50:06'),
(7, 2, 3, '2022-12-13', '2022-12-14', '1', '10000', '10000', '2000', '8000', 0, '2022-12-13 12:08:42', '2022-12-13 12:08:42'),
(8, 5, 3, '2022-12-14', '2022-12-15', '1', '1000', '1000', '200', '800', 1, '2022-12-18 15:58:31', '2022-12-18 13:58:31');

-- --------------------------------------------------------

--
-- Table structure for table `medical_clients`
--

CREATE TABLE `medical_clients` (
  `id` int(11) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_by` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `discharged` int(11) NOT NULL DEFAULT 0,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `medical_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medical_clients`
--

INSERT INTO `medical_clients` (`id`, `client_id`, `status`, `created_by`, `created_at`, `discharged`, `updated_at`, `medical_id`) VALUES
(25, 1, 1, 3, '2022-11-24 07:56:47', 0, '2022-11-24 07:56:47', 2),
(26, 1, 1, 3, '2022-11-24 07:56:47', 0, '2022-11-24 07:56:47', 3),
(27, 1, 1, 3, '2022-11-24 07:56:47', 0, '2022-11-24 07:56:47', 4),
(28, 2, 1, 3, '2022-11-25 15:19:15', 0, '2022-11-25 15:19:15', 1),
(29, 2, 1, 3, '2022-11-25 15:19:16', 0, '2022-11-25 15:19:16', 2),
(30, 2, 1, 3, '2022-11-25 15:19:39', 0, '2022-11-25 15:19:39', 3),
(31, 2, 1, 3, '2022-11-26 07:40:43', 0, '2022-11-26 07:40:43', 1);

-- --------------------------------------------------------

--
-- Table structure for table `medications`
--

CREATE TABLE `medications` (
  `id` int(11) NOT NULL,
  `medication_name` varchar(255) DEFAULT NULL,
  `dose_units` varchar(255) DEFAULT NULL,
  `dose_quantity` varchar(255) DEFAULT NULL,
  `frequency` varchar(255) DEFAULT NULL,
  `prescriber` varchar(255) DEFAULT NULL,
  `date_start` varchar(255) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `client_id` int(11) UNSIGNED NOT NULL,
  `discharged` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medications`
--

INSERT INTO `medications` (`id`, `medication_name`, `dose_units`, `dose_quantity`, `frequency`, `prescriber`, `date_start`, `created_by`, `client_id`, `discharged`, `created_at`, `updated_at`) VALUES
(1, 'Hydroxyzine', '150mg', '1', 'at bedtime', 'Dr Peter Teboh', '2022-11-27', 3, 1, 1, '2022-11-20 07:49:59', '2022-12-18 12:50:06'),
(2, 'Levetiracetam', '500mg', '1', 'twice per day', 'Dr Peter Teboh', '2022-11-21', 3, 1, 1, '2022-11-21 18:06:42', '2022-12-18 12:50:06'),
(3, 'Ibuprofen', '800mg', '1', 'Every eight hours as needed', 'Dr Peter Teboh', '2022-11-21', 3, 1, 1, '2022-11-21 18:06:57', '2022-12-18 12:50:06'),
(4, 'Amlodipine', '50mg', '1', 'once everyday', 'Dr Peter Teboh', '2022-11-21', 3, 1, 1, '2022-11-21 18:07:09', '2022-12-18 12:50:06'),
(5, 'Hydroxyzine', '150mg', '1', 'at bedtime', 'Dr Peter Teboh', '2022-11-27', 3, 2, 0, '2022-11-27 05:36:08', '2022-11-27 05:36:08'),
(6, 'Hydroxyzine', '150mg', '1', 'at bedtime', 'Dr Peter Teboh', '2022-11-27', 3, 2, 0, '2022-11-27 06:06:59', '2022-11-27 06:06:59'),
(7, 'Hydroxyzine', '150mg', '1', 'at bedtime', 'Dr Peter Teboh', '2022-12-03', 3, 3, 0, '2022-12-03 12:59:27', '2022-12-03 12:59:27'),
(8, 'Levetiracetam', '500mg', '1', 'at bedtime', 'Dr Peter Teboh', '2022-12-03', 3, 3, 0, '2022-12-03 13:00:48', '2022-12-03 13:00:48'),
(9, 'Ibuprofen', '150mg', '1', 'twice per day', 'Dr Peter Teboh', '2022-12-03', 3, 3, 0, '2022-12-03 13:03:16', '2022-12-03 13:03:16');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_11_12_175111_create_permission_tables', 2);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 2),
(1, 'App\\Models\\User', 4),
(1, 'App\\Models\\User', 6),
(2, 'App\\Models\\User', 3),
(4, 'App\\Models\\User', 5),
(4, 'App\\Models\\User', 7);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('againtest2020@gmail.com', '$2y$10$RLv598EUCiPySD9oCJHIZupKRKKpxWZccddF7OQpHg.VnGREHn6B.', '2022-11-16 08:03:25'),
('emmizokwizera@yahoo.com', '$2y$10$h7M76TNF6OVXdBToH1tnkO35Dph76hwowast/ddCzYUudVyWIaxAW', '2022-12-22 06:14:42'),
('mugangamaurice@gmail.com', '$2y$10$Kez2aL.AWK7OflWin.SGHesPQwkwbRKBCW94V.wxwd5hF/BZsVYh.', '2022-12-22 06:19:23'),
('emmizokwizera2@gmail.com', '$2y$10$K7yy2e27c34JTs6e8LF3Wuq/cM4uxgruM9mk77DXpLY4LhRoCXKNC', '2022-12-26 09:03:01'),
('emmizokwizera@gmail.com', '$2y$10$cFOB1E2V8ZhgUuqatOU7peFBEwWt/s.IuAHAPS5avZRaO6e.JI6gO', '2022-12-30 17:34:27');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `for_client` int(11) NOT NULL DEFAULT 11,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `for_client`, `created_at`, `updated_at`) VALUES
(1, 'manage-company', 'web', 11, '2022-11-15 07:37:50', '2022-11-15 07:37:50'),
(2, 'manage-client', 'web', 11, '2022-11-15 07:37:50', '2022-11-15 07:37:50'),
(4, 'manage-payor', 'web', 11, '2022-12-25 06:50:15', '2022-12-25 06:50:15'),
(5, 'manage-users-client', 'web', 11, '2022-12-25 06:50:50', '2022-12-25 06:50:50'),
(6, 'manage-invoice', 'web', 11, '2022-12-25 06:51:13', '2022-12-25 06:51:13'),
(7, 'manage-roles-client', 'web', 11, '2022-12-25 06:51:44', '2022-12-25 06:51:44'),
(8, 'manage-archive', 'web', 11, '2022-12-25 07:06:59', '2022-12-25 07:06:59'),
(9, 'manage-report', 'web', 11, '2022-12-25 07:07:57', '2022-12-25 07:07:57');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `progress_notes`
--

CREATE TABLE `progress_notes` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `progress_note` varchar(255) DEFAULT NULL,
  `level_participation` varchar(255) DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `discharged` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `progress_notes`
--

INSERT INTO `progress_notes` (`id`, `client_id`, `progress_note`, `level_participation`, `staff_id`, `status`, `discharged`, `created_at`, `updated_at`) VALUES
(1, 1, 'Hi progress', '[\"High\"]', 3, 1, 1, '2022-12-18 14:50:06', '2022-12-18 12:50:06'),
(2, 5, 'Hi there', '[\"High\"]', 3, 1, 0, '2022-12-29 17:01:24', '2022-12-29 17:01:24'),
(3, 2, 'Progress note text area', '[\"Medium\"]', 3, 1, 0, '2023-01-01 05:27:49', '2023-01-01 05:27:49'),
(4, 5, '<p><strong>Progress</strong> note</p>', '[\"Neutral\"]', 3, 1, 0, '2023-01-05 07:52:29', '2023-01-05 07:52:29'),
(5, 1, '<p>Hi <strong>there</strong></p>', '[\"Neutral\"]', 3, 1, 0, '2023-01-05 12:30:15', '2023-01-05 10:26:46'),
(6, 5, '<p>Hi <strong>Progress</strong> test</p>', 'null', 3, 1, 0, '2023-01-05 11:20:43', '2023-01-05 11:20:43');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by_admin` int(11) NOT NULL DEFAULT 0,
  `created_by_client` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `company_id`, `guard_name`, `created_by_admin`, `created_by_client`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Admin', NULL, 'web', 1, 0, 1, '2022-11-15 05:45:01', '2022-12-26 09:44:38'),
(2, 'Client', 1, 'web', 1, 1, 1, '2022-12-24 08:59:45', '2022-12-26 09:44:32'),
(4, 'Employee', 1, 'web', 0, 1, 1, '2022-12-25 09:38:20', '2022-12-25 09:38:20'),
(5, 'Employee-TheFuture Ltd4', 1, 'web', 0, 1, 0, '2022-12-26 10:24:25', '2022-12-26 10:24:25'),
(6, 'Employee-Alicus', NULL, 'web', 1, 0, 0, '2022-12-26 10:25:48', '2022-12-26 10:25:48');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 6),
(2, 2),
(2, 4),
(2, 5),
(4, 2),
(4, 4),
(5, 2),
(5, 5),
(6, 2),
(6, 4),
(7, 2),
(8, 2),
(8, 4),
(9, 2),
(9, 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `account_verified` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(11) NOT NULL,
  `profile_picture` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `employee_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `is_allowed` int(11) DEFAULT 0,
  `date_of_birth` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delete_feature` int(11) DEFAULT 0,
  `is_delete` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `phone_number`, `email_verified_at`, `account_verified`, `password`, `role`, `profile_picture`, `company_id`, `employee_id`, `created_by`, `is_allowed`, `date_of_birth`, `delete_feature`, `is_delete`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Kwizera', 'Emmanuel', 'emmizokwizera@gmail.com', NULL, NULL, NULL, '$2a$08$wtZ5ccqlPrI.eIZeWFRLLuuC.lCDsFAzx4iXlkTgBJAOZ8BxPO5Pu', 1, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 1, NULL, '2022-11-14 20:28:00', '2022-11-14 20:28:00'),
(3, 'Karim', 'Enzo', 'againtest2020@gmail.com', '', NULL, NULL, '$2y$10$lR5DvHJ.hfAA9KJbC7owGOzFaWAa6167dMZOngdyTtmtBSYLNdco.', 2, '', 1, '1', 1, 0, NULL, 1, 0, 1, NULL, '2022-11-16 10:03:24', '2022-12-26 10:28:59'),
(5, 'Ell', 'Pacino', 'emmizokwizera@yahoo.com', '', NULL, NULL, '$2y$10$lR5DvHJ.hfAA9KJbC7owGOzFaWAa6167dMZOngdyTtmtBSYLNdco.', 4, '', 1, 'DQMS-001', 1, 0, NULL, 0, 0, 1, NULL, '2022-12-22 08:14:42', '2022-12-26 09:05:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `echat`
--
ALTER TABLE `echat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `group_notes`
--
ALTER TABLE `group_notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Indexes for table `individual_notes`
--
ALTER TABLE `individual_notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `insurances`
--
ALTER TABLE `insurances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Indexes for table `medical_clients`
--
ALTER TABLE `medical_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `medical_id` (`medical_id`);

--
-- Indexes for table `medications`
--
ALTER TABLE `medications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`client_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `progress_notes`
--
ALTER TABLE `progress_notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `echat`
--
ALTER TABLE `echat`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `group_notes`
--
ALTER TABLE `group_notes`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `individual_notes`
--
ALTER TABLE `individual_notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `insurances`
--
ALTER TABLE `insurances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `medical_clients`
--
ALTER TABLE `medical_clients`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `medications`
--
ALTER TABLE `medications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `progress_notes`
--
ALTER TABLE `progress_notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
