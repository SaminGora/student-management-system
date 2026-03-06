-- Database Schema for Student Management System (Repaired & Normalized)
-- This file reduces data redundancy and adds Foreign Key constraints for automatic updates/deletions.

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `studentmgt`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `image` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `admin` (`id`, `name`, `contact`, `username`, `password`, `email`, `image`) VALUES
(1, 'Rajesh hamal', '9812345678', 'admin', 'admin', 'rajesh@gmail.com', 'uploads/Principal.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `class_id` int(11) NOT NULL,
  `roll` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `parent_name` varchar(255) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `parent_email` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `admission_date` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `students` (`student_id`, `name`, `class_id`, `roll`, `address`, `gender`, `dob`, `email`, `username`, `password`, `parent_name`, `contact`, `parent_email`, `image`, `created_at`, `admission_date`) VALUES
(1, 'Ram Gora', 8, 1, 'bhaktapur', 'Male', '2003-01-13', 'gorasamin6@gmail.com', 'abcd', '$2y$10$HGI5/kyU6sOvBf.xMG1NkusGSf8lGYnuD2PW7dEAkeM6LqdidJ.wa', 'samin gora', '9800000001', 'gorasamin6@gmail.com', 'uploads/images.jpg', '2025-12-25 06:11:09', '2025-12-25'),
(2, 'yogesh', 8, 2, 'thimi', 'Male', '2004-01-12', 'yogeshtimsina64@gmail.com', 'yogesh', '$2y$10$OXk/xFqJD2pDH5bY1mWnHOa/3eHorZSGDy59uedYBrRTTSWw78kly', 'abc', '9812345678', 'yogesh@gmail.com', 'uploads/images.jpg', '2026-01-01 04:42:53', '2026-01-01'),
(3, 'Sagar Gora', 9, 1, 'thimi', 'Male', '2000-01-22', 'abc@gmail.com', 'sagar', '$2y$10$K37WzuhTnL/rcoZCbIx9RObllq4NCWjv.8cwauQiBwFI5ctGdgO7q', 'abc', '9800000001', 'gora@gmail.com', '', '2026-01-07 06:48:57', '2026-01-07'),
(4, 'Abin hero', 10, 1, 'bhaktapur', 'Male', '2003-01-05', 'abc@gmail.com', 'abin', '$2y$10$GZIXFXUAGlSIVzh/dcFAtOExgblFl9C.3XlwI2ZwINxDIbRhPAkPC', 'abn', '9800000111', 'gora@gmail.com', 'uploads/IMG_20240326_200115_808.jpg', '2026-01-07 06:52:44', '2026-01-07'),
(5, 'hello 123', 10, 2, 'ktm', 'Female', '2003-02-25', 'abc@gmail.com', 'hello123', '$2y$10$ABL45dSHNAjXBAGdOWWgOOH0EI1t9h.SW6WAeNMitDtqBNOvu9pgG', 'hiii', '9800000111', 'gora@gmail.com', 'uploads/download.jpg', '2026-01-07 06:54:39', '2026-01-07'),
(6, 'lisha suwal', 10, 3, 'bhaktapur', 'Female', '2002-02-05', 'abc@gmail.com', 'lisha', '$2y$10$WdEco42NE2FvWDVE4A3Q2ujVPeaRadnVZjDUYz2t9zltQg3nV/ahi', 'lishaa', '9800000111', 'gora@gmail.com', 'uploads/download.jpg', '2026-01-07 06:56:14', '2026-01-07');

-- --------------------------------------------------------

--
-- Table structure for table `attendence`
--

CREATE TABLE `attendence` (
  `attendence_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `attendence` varchar(20) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`attendence_id`),
  KEY `fk_attendence_student` (`student_id`),
  CONSTRAINT `fk_attendence_student` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `attendence` (`attendence_id`, `student_id`, `attendence`, `date`) VALUES
(1, 1, 'present', '2025-12-27');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `class_id` int(11) NOT NULL AUTO_INCREMENT,
  `class_name` varchar(255) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  PRIMARY KEY (`class_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `classes` (`class_id`, `class_name`, `teacher_id`) VALUES
(8, 'class 8', 1),
(9, 'class9', 3),
(10, 'class10', 4);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `cotact_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `contact` bigint(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `comment` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`cotact_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `contact` (`cotact_id`, `name`, `address`, `contact`, `email`, `comment`) VALUES
(1, 'Samin Gora', 'bkt', 9111111111, 'gora@gmail.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `exam_id` int(11) NOT NULL AUTO_INCREMENT,
  `exam_name` varchar(255) NOT NULL,
  `year` varchar(50) NOT NULL,
  PRIMARY KEY (`exam_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `exam` (`exam_id`, `exam_name`, `year`) VALUES
(1, 'First Terminal', '2083'),
(2, 'Second Terminal', '2083'),
(3, 'Third Terminal', '2083');

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

CREATE TABLE `fees` (
  `fee_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `month` varchar(50) NOT NULL,
  `total_fee` decimal(10,2) NOT NULL,
  `paid_amount` decimal(10,2) NOT NULL,
  `due_date` date NOT NULL,
  `payment_date` date DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`fee_id`),
  KEY `fk_fees_student` (`student_id`),
  CONSTRAINT `fk_fees_student` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `homework`
--

CREATE TABLE `homework` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `hw_for` int(11) NOT NULL,
  `description` text NOT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `sub_date` date NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `homework` (`id`, `title`, `hw_for`, `description`, `file_path`, `sub_date`, `post_date`) VALUES
(2, 'practice question', 8, 'solve all ticked question', 'uploads/Screenshot 2025-09-10 153444.png', '2026-01-08', '2026-01-01 07:51:23'),
(3, 'abc', 8, 'copy all', 'uploads/Screenshot 2025-09-10 153444.png', '2026-01-01', '2026-01-02 10:24:36');

-- --------------------------------------------------------

--
-- Table structure for table `note`
--

CREATE TABLE `note` (
  `note_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(100) DEFAULT NULL,
  `class` varchar(100) DEFAULT NULL,
  `description` varchar(200) NOT NULL,
  `file` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`note_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `note` (`note_id`, `subject`, `class`, `description`, `file`) VALUES
(1, 'computer', '8', 'computer notes', 'uploads/sudip .pdf');

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `noticetitle` varchar(255) NOT NULL,
  `classid` int(11) NOT NULL,
  `noticemsg` text NOT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `notice` (`id`, `noticetitle`, `classid`, `noticemsg`, `file_path`, `created_at`) VALUES
(1, '1st term exam', 8, 'examination routine', 'uploads/Screenshot 2025-09-10 153444.png', '2025-12-27 12:51:49');

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `result_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `obtained_marks` int(11) NOT NULL,
  PRIMARY KEY (`result_id`),
  KEY `fk_result_student` (`student_id`),
  CONSTRAINT `fk_result_student` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `sub_id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_name` varchar(255) NOT NULL,
  `full_mark` int(11) NOT NULL,
  `pass_mark` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  PRIMARY KEY (`sub_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `subjects` (`sub_id`, `sub_name`, `full_mark`, `pass_mark`, `class_id`) VALUES
(1, 'Math', 100, 40, 6),
(2, 'Science', 100, 40, 6),
(3, 'Social', 100, 40, 6),
(4, 'English', 100, 40, 6),
(5, 'Nepali', 100, 40, 6),
(6, 'Grammar', 50, 20, 6),
(7, 'Health', 50, 20, 6),
(8, 'Moral', 50, 20, 6),
(9, 'Math', 100, 40, 7),
(10, 'Science', 100, 40, 7),
(11, 'Social', 100, 40, 7),
(12, 'English', 100, 40, 7),
(13, 'Nepali', 100, 40, 7),
(14, 'GK', 100, 20, 7),
(15, 'Computer', 50, 20, 7),
(16, 'Health', 50, 20, 7),
(17, 'Math', 100, 40, 8),
(18, 'Science', 100, 40, 8),
(19, 'Social', 100, 40, 8),
(20, 'English', 100, 40, 8),
(21, 'Nepali', 100, 40, 8),
(22, 'EPH', 100, 20, 8),
(23, 'Computer', 50, 20, 8),
(24, 'Health', 50, 20, 8),
(25, 'Math', 100, 40, 9),
(26, 'Science', 100, 40, 9),
(27, 'Social', 100, 40, 9),
(28, 'English', 100, 40, 9),
(29, 'Nepali', 100, 40, 9),
(30, 'EPH', 100, 20, 9),
(31, 'Account', 100, 40, 9),
(32, 'Optional Math', 50, 20, 9),
(33, 'Math', 100, 40, 10),
(34, 'Science', 100, 40, 10),
(35, 'Social', 100, 40, 10),
(36, 'English', 100, 40, 10),
(37, 'Nepali', 100, 40, 10),
(38, 'Account', 100, 40, 10),
(39, 'Optional Math', 50, 20, 10),
(40, 'Population', 50, 20, 10);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `T_id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  `Contact` varchar(20) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `Role` varchar(50) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`T_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `teachers` (`T_id`, `Name`, `Contact`, `Email`, `subject`, `Role`, `username`, `password`, `image`) VALUES
(1, 'ram kilambu', '9861887715', 'gorasamin6@gmail.com', 'computer', 'class teacher', 'samin', '$2y$10$bryRhL3nwvlM51Cjeux1RO16DRrxiQB4d/.zSnOXrgfPvoITVQu3G', 'uploads/download.jpg'),
(2, 'Abin hamal', '9812345678', 'abinsuwal650@gmail.com', 'react js', 'subject teacher', 'abin', '$2y$10$lJ3.RU0TPfCQTMDG825cRe3V9V8k4ii9vNxPDuahs0crQSemBR/uW', 'uploads/MF8jno.jpg'),
(3, 'Hari khadka', '9801562612', 'gorasamin6@gmail.com', 'science', 'class teacher', 'hari', '$2y$10$dcUniMuZwXPC2hLenbr2weEHmfVVSfcrt0NSChMRc97YBsZ/yrWL.', 'uploads/IMG_20250128_205532.jpg'),
(4, 'shyam kilambu', '9800000000', 'gora@gmail.com', 'math', 'class teacher', 'shyam', '$2y$10$b/y4l1VbGTW4d/6ASJeazuz.VcwYuFO.uIBg0uwg.Sw1l1SVsYgWC', '');

-- --------------------------------------------------------

--
-- Table structure for table `uploadhomework`
--

CREATE TABLE `uploadhomework` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sts_id` int(11) DEFAULT NULL,
  `hwid` int(11) DEFAULT NULL,
  `file_path` varchar(100) DEFAULT NULL,
  `teacher_remark` varchar(100) NOT NULL,
  `post_date` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_uploadhomework_student` (`sts_id`),
  CONSTRAINT `fk_uploadhomework_student` FOREIGN KEY (`sts_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
