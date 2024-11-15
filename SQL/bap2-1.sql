-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2024 at 05:05 AM
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
-- Database: `bap`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `account_id` int(11) NOT NULL,
  `id_number` varchar(12) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`account_id`, `id_number`, `email`, `password`, `date_created`) VALUES
(10, 'ADMIN00001', 'nmarcjacob@gmail.com', '$2y$10$d3sV54t6PXwv2vBnPYQ5huxLblJvgWUx8PiETsainAFUQAMYIpzbe', '2024-11-14 22:56:52'),
(11, 'ADMIN00002', 'nmarcjacob@yahoo.com', '$2y$10$qx5PJST2CH/GYQlrKns7V.5/btwPBiFM2r.wzR4r3wLZ69h81HwZu', '2024-11-14 22:57:12');

-- --------------------------------------------------------

--
-- Table structure for table `account_role`
--

CREATE TABLE `account_role` (
  `account_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `log_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `activity_type` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`log_id`, `account_id`, `activity_type`, `timestamp`) VALUES
(1, 11, 'login', '2024-11-14 23:02:29'),
(2, 11, 'login', '2024-11-14 23:02:34');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `surname` varchar(50) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_initial` varchar(5) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `id_number` varchar(12) NOT NULL,
  `region` varchar(5) NOT NULL,
  `chapter` varchar(50) NOT NULL,
  `valid_until` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`surname`, `first_name`, `middle_initial`, `designation`, `id_number`, `region`, `chapter`, `valid_until`) VALUES
('ORIGENES', 'NORMALITO', 'C.', 'MUNICIPAL COMMISSIONER', '10R2023174', '10', 'KOLAMBUGAN, LDN', '2025-12-31'),
('DABA', 'WENNY', 'P.', 'PROVINCIAL COMMISSIONER', '10R20241062', '10', 'MISAMIS ORIENTAL', '2026-05-31'),
('ABEJAY', 'ROMMEL', 'S.', 'CITY COMMISSIONER', '10R20241063', '10', 'EL SALVADOR', '2026-05-31'),
('ANADON', 'RENATO', 'M.', 'REFEREE', '10R20241064', '10', 'EL SALVADOR', '2026-05-31'),
('GALAGNARA', 'JOSE HEINTJE', 'D.', 'REFEREE', '10R20241065', '10', 'EL SALVADOR', '2026-05-31'),
('QUINTO', 'CHRISTIAN ARNIL', 'T.', 'REFEREE', '10R20241066', '10', 'EL SALVADOR', '2026-05-31'),
('PLATERO', 'BRYAN', 'F.', 'REFEREE', '10R20241067', '10', 'CAGAYAN DE ORO', '2026-05-31'),
('CORPUZ', 'JERRY', 'D.', 'CITY DIRECTOR', '10R20241068', '10', 'CAGAYAN DE ORO', '2026-05-31'),
('DAIRO', 'RUEL', 'P.', 'CITY COMMISSIONER', '10R20241069', '10', 'CAGAYAN DE ORO', '2026-05-31'),
('ASENTISTA', 'RALPH ARIEL', 'M.', 'MUNICIPAL COMMISSIONER', '10R20241070', '10', 'BAUNGON', '2026-05-31'),
('PALAHANG', 'WINDYL', 'B.', 'REFEREE', '10R20241100', '10', 'BACOLOD', '2026-06-30'),
('REBECOY JR.', 'FERNANDO', 'C.', 'REFEREE', '10R20241101', '10', 'DON VICTORIANO', '2026-06-30'),
('ABANID', 'RENEBOY', 'L.', 'REFEREE', '10R20241102', '10', 'DON VICTORIANO', '2026-06-30'),
('SENCIO', 'MARLON', 'M.', 'REFEREE', '10R20241103', '10', 'DON VICTORIANO', '2026-06-30'),
('PANUNCIAL', 'JUNJIE', 'P.', 'REFEREE', '10R20241104', '10', 'DON VICTORIANO', '2026-06-30'),
('DUHAYLUNGSOD', 'PEDILO', 'M.', 'REFEREE', '10R20241105', '10', 'DON VICTORIANO', '2026-06-30'),
('BREGONDO', 'RAMEL', 'M.', 'REFEREE', '10R20241106', '10', 'DON VICTORIANO', '2026-06-30'),
('GUMISID', 'ORLEY', 'G.', 'REFEREE', '10R20241107', '10', 'DON VICTORIANO', '2026-06-30'),
('GUMISID', 'JOSHUA', 'G.', 'REFEREE', '10R20241108', '10', 'DON VICTORIANO', '2026-06-30'),
('RECOLITO', 'JOBERTH', 'B.', 'REFEREE', '10R20241109', '10', 'DON VICTORIANO', '2026-06-30'),
('DESCALLAR', 'DARELL', 'A.', 'REFEREE', '10R20241110', '10', 'DON VICTORIANO', '2026-06-30'),
('ALISON', 'KIM JOSHUA', 'S.', 'REFEREE', '10R20241111', '10', 'MALAYBALAY', '2026-06-30'),
('PADILLA', 'HARVEY BRYAN', 'T.', 'REFEREE', '10R20241112', '10', 'MALAYBALAY', '2026-06-30'),
('DAHULORAN', 'ERLMAR', 'D.', 'REFEREE', '10R20241113', '10', 'MALAYBALAY', '2026-06-30'),
('GAWHANON', 'ASRIEL', ' ', 'REFEREE', '10R20241114', '10', 'MALAYBALAY', '2026-06-30'),
('CORDA', 'GENEVIE', 'I.', 'REFEREE', '9R2023124', '9', 'ZAMBOANGA CITY', '2025-09-30'),
('YAHIYA', 'MOHAMMAD AIZEN', 'S.', 'REFEREE', '9R2023125', '9', 'ZAMBOANGA CITY', '2025-09-30'),
('SALIH', 'RAB\'A', 'D.', 'REFEREE', '9R2023126', '9', 'ZAMBOANGA CITY', '2025-09-30'),
('SALIH', 'MAUMAR', 'A.', 'REFEREE', '9R2023127', '9', 'ZAMBOANGA CITY', '2025-09-30'),
('ALIPAN', 'ALEX', 'M.', 'REFEREE', '9R2023128', '9', 'ZAMBOANGA CITY', '2025-09-30'),
('TU-AYON', 'JOHN DANVER', 'C.', 'REFEREE', '9R2023129', '9', 'ZAMBOANGA CITY', '2025-09-30'),
('JAVIER', 'CARMELYN', 'C.', 'REFEREE', '9R2023130', '9', 'ZAMBOANGA CITY', '2025-09-30'),
('SAURADJAN', 'RADJILUL', 'A.', 'REFEREE', '9R2023131', '9', 'ZAMBOANGA CITY', '2025-09-30'),
('MASDAL', 'BEN NEDZFAR', 'S.', 'REFEREE', '9R2023132', '9', 'ZAMBOANGA CITY', '2025-09-30'),
('AKBAR', 'ALIH', 'B.', 'REFEREE', '9R2023133', '9', 'ZAMBOANGA CITY', '2025-09-30'),
('MASARIK', 'FAIZAL', 'A.', 'REFEREE', '9R2023134', '9', 'ZAMBOANGA CITY', '2025-09-30'),
('TIAM WATT', 'DARWIN', 'M.', 'REFEREE', '9R2023135', '9', 'ZAMBOANGA CITY', '2025-09-30'),
('JAMSURI', 'BERHAMIN', 'T.', 'REFEREE', '9R2023136', '9', 'ZAMBOANGA CITY', '2025-09-30'),
('ALI', 'BENFAR', 'A.', 'REFEREE', '9R2023137', '9', 'ZAMBOANGA CITY', '2025-09-30'),
('ALBAR', 'MUAMMAR', 'T.', 'REFEREE', '9R2023138', '9', 'ZAMBOANGA CITY', '2025-09-30'),
('ALICAYA', 'EUGENIO', 'P.', 'REFEREE', '9R2023139', '9', 'ZAMBOANGA CITY', '2025-09-30'),
('FAUSTO', 'JUIPUS', 'L.', 'REFEREE', '9R20241056', '9', 'PAGADIAN', '2026-05-31'),
('MABALOD', 'ROEL', 'T.', 'REFEREE', '9R20241057', '9', 'PAGADIAN', '2026-05-31'),
('MIRANDA', 'RANDEL', 'S.', 'REFEREE', '9R20241058', '9', 'PAGADIAN', '2026-05-31'),
('UBPON', 'ABDULRAHMAN', 'O.', 'REFEREE', '9R20241059', '9', 'DINAS', '2026-05-31'),
('MENDIOLA', 'JOEL', 'A.', 'REFEREE', '9R20241060', '9', 'PAGADIAN', '2026-05-31'),
('TINGCANG', 'EARL', 'T.', 'REFEREE', '9R20241061', '9', 'PAGADIAN', '2026-05-31'),
('BEBIRO', 'JOE JEMAR', 'V.', 'REFEREE', '9R20241071', '9', 'DAPITAN', '2026-05-31'),
('CALASANG', 'REY', 'B.', 'REFEREE', '9R20241072', '9', 'DAPITAN', '2026-05-31'),
('BAGON', 'JEFFREY', 'R.', 'REFEREE', '9R20241073', '9', 'DAPITAN', '2026-05-31'),
('MANISIG', 'ABDIL', 'A.', 'REFEREE', '9R20241074', '9', 'GUTALAC', '2026-05-31'),
('DANIEL', 'ANA', 'B.', 'SECRETARY / TREASURER', '9R20241075', '9', 'GUTALAC', '2026-05-31'),
('VERALIO', 'ARNEL', 'B.', 'REFEREE', '9R20241076', '9', 'GUTALAC', '2026-05-31'),
('BATOCTOY', 'ERWIN', 'M.', 'REFEREE', '9R20241077', '9', 'GUTALAC', '2026-05-31'),
('DANIEL', 'JESSIE', 'P.', 'REFEREE', '9R20241078', '9', 'GUTALAC', '2026-05-31'),
('MANISIG', 'RADJID', 'A.', 'REFEREE', '9R20241079', '9', 'GUTALAC', '2026-05-31'),
('VERALLO', 'ROLLY', 'B.', 'REFEREE', '9R20241080', '9', 'GUTALAC', '2026-05-31'),
('SAMLA', 'SADRODDIN', 'M.', 'MUNICIPAL COMMISSIONER', '9R20241081', '9', 'GUTALAC', '2026-05-31'),
('NAVARRO', 'REYNALDO', 'B.', 'REFEREE', '9R20241082', '9', 'PAGADIAN', '2026-05-31'),
('CANETE', 'ALCHERE', 'C.', 'REFEREE', '9R20241083', '9', 'PAGADIAN', '2026-05-31'),
('SAAVEDRA', 'CYRA TARTINI ANN', 'F.', 'REFEREE', '9R2024119', '9', 'ZAMBOANGA CITY', '2025-09-30'),
('ABRINGE', 'RICHIE', 'S.', 'REFEREE', '9R2024120', '9', 'ZAMBOANGA CITY', '2025-09-30'),
('BOTIN', 'FREDDIE', 'E.', 'REFEREE', '9R2024121', '9', 'ZAMBOANGA CITY', '2025-09-30'),
('ENCABO', 'PHILIP', 'C.', 'REFEREE', '9R2024122', '9', 'ZAMBOANGA CITY', '2025-09-30'),
('ABADIES', 'MARY GRACE', 'P.', 'REFEREE', '9R2024123', '9', 'ZAMBOANGA CITY', '2025-09-30'),
('DEBUG', 'ADMIN', 'TEST', 'ADMINISTRATOR', 'ADMIN00001', '10', 'ILIGAN CITY', '2026-11-30'),
('DEBUG', 'ADMIN', 'TEST', 'ADMINISTRATOR', 'ADMIN00002', '10', 'ILIGAN CITY', '2026-11-30'),
('NIEZ', 'WINEFREDO', 'N.', 'BAP FED NATIONAL PRESIDENT', 'NCR2023001', 'NCR', 'PHILIPPINES', '2028-03-31'),
('CABATIT', 'LLOYD', 'A.', 'MUNICIPAL COMMISSIONER', 'RX102023180', '10', 'MAIGO, LDN', '2025-12-31');

-- --------------------------------------------------------

--
-- Table structure for table `members(old)`
--

CREATE TABLE `members(old)` (
  `name` varchar(600) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `member_id` varchar(12) NOT NULL,
  `region` varchar(15) NOT NULL,
  `chapter` varchar(50) NOT NULL,
  `valid_till` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members(old)`
--

INSERT INTO `members(old)` (`name`, `designation`, `member_id`, `region`, `chapter`, `valid_till`) VALUES
('NORMALITO C. ORIGENES', 'MUNICIPAL COMMISSIONER', '10R2023174', 'REGION X', 'KOLAMBUGAN, LDN', '2025-12-31'),
('WINEFREDO N. NIEZ', 'BAP FED NATIONAL PRESIDENT', 'NCR02023001', 'NCR', 'PHILIPPINES', '2028-03-31'),
('LLOYD A. CABATIT', 'MUNICIPAL COMMISSIONER', 'RX102023180', 'REGION X', 'MAIGO, LDN', '2025-12-31');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(20) NOT NULL,
  `permissions` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`account_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `ID` (`id_number`);

--
-- Indexes for table `account_role`
--
ALTER TABLE `account_role`
  ADD KEY `account` (`account_id`),
  ADD KEY `role` (`role_id`);

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `Activity-Account` (`account_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id_number`);

--
-- Indexes for table `members(old)`
--
ALTER TABLE `members(old)`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `ID` FOREIGN KEY (`id_number`) REFERENCES `members` (`id_number`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `account_role`
--
ALTER TABLE `account_role`
  ADD CONSTRAINT `account` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `Activity-Account` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
