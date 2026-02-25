-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2026 at 08:08 AM
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
-- Database: `digital_consultant`
--

-- --------------------------------------------------------

--
-- Table structure for table `man_power`
--

CREATE TABLE `man_power` (
  `id` int(11) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `no_of_employees` int(11) NOT NULL,
  `salary_per_employee` decimal(15,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `man_power`
--

INSERT INTO `man_power` (`id`, `designation`, `no_of_employees`, `salary_per_employee`, `created_at`) VALUES
(11, 'Director', 3, 100000.00, '2026-02-25 06:53:37'),
(12, 'General Manager', 1, 60000.00, '2026-02-25 06:53:54'),
(13, 'Manager Marketing', 1, 50000.00, '2026-02-25 06:54:13'),
(14, 'Manager Production', 1, 10000.00, '2026-02-25 06:54:34'),
(15, 'Manager QC', 1, 15000.00, '2026-02-25 06:54:57'),
(16, 'Quality Control & Microbial Testing', 2, 10000.00, '2026-02-25 06:55:14'),
(17, 'Account', 2, 10000.00, '2026-02-25 06:55:37'),
(18, 'Driver', 1, 10000.00, '2026-02-25 06:56:30'),
(19, 'Runner', 2, 8000.00, '2026-02-25 06:56:52'),
(20, 'Machine Operator', 10, 10000.00, '2026-02-25 06:57:21');

-- --------------------------------------------------------

--
-- Table structure for table `pre_operative_expenditure`
--

CREATE TABLE `pre_operative_expenditure` (
  `sr_no` bigint(20) UNSIGNED NOT NULL,
  `registration_and_licenses` text NOT NULL,
  `issuing_authority` text NOT NULL,
  `approximate_cost_in_rupees` decimal(15,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pre_operative_expenditure`
--

INSERT INTO `pre_operative_expenditure` (`sr_no`, `registration_and_licenses`, `issuing_authority`, `approximate_cost_in_rupees`, `created_at`) VALUES
(1, 'Land Conversion Charges From Agriculture To Industrials', 'District Collector', 5000.00, '2026-02-17 12:13:05'),
(2, 'Land Transfer Fees', 'Government of the state', 5000.00, '2026-02-17 12:13:05'),
(3, 'Registration of Private Limited Company*', 'Registrar of Companies GOI', 5000.00, '2026-02-17 12:13:05'),
(4, 'Company Secretary Fees', '', 5000.00, '2026-02-17 12:13:05'),
(5, 'Factory License', 'Chief Inspector of Factories district', 5000.00, '2026-02-17 12:13:05'),
(6, 'Fire Department License', 'Divisional Magistrate', 5000.00, '2026-02-17 12:13:05'),
(7, 'Pollution Control Board NOC', 'Pollution Control Board District', 5000.00, '2026-02-17 12:13:05'),
(8, 'Archeological Department NOC', 'Archeological Department District', 5000.00, '2026-02-17 12:13:05'),
(9, 'Meteorological Department NOC', 'Meteorological Department District', 5000.00, '2026-02-17 12:13:05'),
(10, 'Industrial Water', 'Department of Water supply', 5000.00, '2026-02-17 12:13:05'),
(11, 'Trade License', 'Gram Panchayat', 5000.00, '2026-02-17 12:13:05'),
(12, 'Health License', 'Municipal Corporation', 5000.00, '2026-02-17 12:13:05'),
(13, 'GST Registration', 'Commissioner of Tax office', 5000.00, '2026-02-17 12:13:05'),
(14, 'Excise Registration', 'Commissioner of Central Excise District', 5000.00, '2026-02-17 12:13:05'),
(15, 'Employees Insurance and PPF', 'Commissioner of Labor District', 5000.00, '2026-02-17 12:13:05'),
(16, 'Professional Tax', 'Professional Tax Commissioner District', 5000.00, '2026-02-17 12:13:05'),
(17, 'Food Processing License', 'Commissioner of Food Processing', 5000.00, '2026-02-17 12:13:05'),
(18, 'Forest License', 'Divisional Forest Officer1198', 5000.00, '2026-02-17 12:13:05'),
(19, 'Clearance under Town and Country Planning', 'Zilla Parishad', 5000.00, '2026-02-17 12:13:05'),
(20, 'Installation of DG Set clearance/ permission and registration', 'Chief Inspector of Power Department District Level', 5000.00, '2026-02-17 12:13:05'),
(21, 'Discom License and Permission', 'Chief Inspector Electricity Board', 5000.00, '2026-02-17 12:13:05'),
(22, 'Import Export License', 'Online registration', 7000.00, '2026-02-17 12:13:05'),
(23, 'ISO 22000', 'ISO issuing authority', 50000.00, '2026-02-17 12:13:05'),
(24, 'HACCP', 'HACCP issuing authority', 60000.00, '2026-02-17 12:13:05'),
(25, 'Storage of essential commodities license, permit and NOC', 'District Controller food supply, Sub divisional Officer, Divisional Magistrate', 10000.00, '2026-02-17 12:13:05'),
(26, 'Agency fees (Outside from 7-22)', '', 100000.00, '2026-02-17 12:13:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `man_power`
--
ALTER TABLE `man_power`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pre_operative_expenditure`
--
ALTER TABLE `pre_operative_expenditure`
  ADD PRIMARY KEY (`sr_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `man_power`
--
ALTER TABLE `man_power`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `pre_operative_expenditure`
--
ALTER TABLE `pre_operative_expenditure`
  MODIFY `sr_no` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
