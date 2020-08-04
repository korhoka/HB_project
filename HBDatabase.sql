-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: mysql.metropolia.fi
-- Generation Time: May 09, 2018 at 10:28 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `katjakk`
--

-- --------------------------------------------------------

--
-- Table structure for table `hb_budjet`
--

CREATE TABLE `hb_budjet` (
  `b_id` int(11) NOT NULL,
  `usercode` int(6) DEFAULT NULL,
  `given` int(11) DEFAULT NULL,
  `remaining` int(11) DEFAULT NULL,
  `used` int(11) DEFAULT NULL,
  `datelimit` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hb_budjet`
--

INSERT INTO `hb_budjet` (`b_id`, `usercode`, `given`, `remaining`, `used`, `datelimit`) VALUES
(1, 123456, 3000, 2390, 610, '2019-04-11'),
(2, 123457, 3000, 3000, 0, '2019-04-11');

-- --------------------------------------------------------
--
-- Table structure for table `hb_company`
--

CREATE TABLE `hb_company` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(100) NOT NULL,
  `c_street` varchar(50) NOT NULL,
  `c_zip` int(11) NOT NULL,
  `c_city` varchar(50) DEFAULT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hb_company`
--

INSERT INTO `hb_company` (`c_id`, `c_name`, `c_street`, `c_zip`, `c_city`, `latitude`, `longitude`) VALUES
(0, 'Hoitava Group Oy', 'Nakertajantie 54', 87830, 'Kajaani', 64.2522, 27.6865),
(1, 'Koti- ja hoivapalvelu Merina', 'Mäntytie 5', 88400, 'Ristijärvi', 64.499, 28.2165),
(2, 'Jalkahoito Kotitossu', 'Levälahdentie 44', 88900, 'Kuhmo', 64.1326, 29.5445),
(3, 'Kalevalan kuntoutuskoti-säätiö/ Hyvinvointi Sampo', 'Väinämöinen 2', 88900, 'Kuhmo', 64.1189, 29.5778),
(4, 'Kotipalvelu Ankkuri, SKH Oy', 'Kontiomäentie 8', 88470, 'Kontiomäki', 64.3378, 28.1101),
(5, 'Osuuskunta Kainuun Kanerva', 'Jarrukuja 4', 87100, 'Kajaani', 64.2184, 27.7371),
(6, 'Simolan Kotityöpalvelut', 'Koulukatu 12 as 4', 88900, 'Kuhmo', 64.1269, 29.5248),
(7, 'Kainuun soten vanhuspalvelut', '', 0, '', 0, 0),
(8, 'Matin Kotiapu', 'Huhtikangas 2', 88600, 'Sotkamo', 64.0813, 28.6086),
(9, 'Osuuskunta Sotkamon Monitaiturit', 'Kangaskatu 9', 88600, 'Sotkamo', 64.1315, 28.3861),
(10, 'Tuomon HHH', 'Kainuuntie 88', 88900, 'Kuhmo', 64.1277, 29.518),
(11, 'Leenan puhdistuspalvelu Oy', 'Takojankatu 8', 87400, 'Kajaani', 64.22, 27.769),
(12, 'Makkosenmäen hieronta M.Nevalainen', 'Niemitie 15', 88600, 'Sotkamo', 64.1387, 28.4293),
(13, 'Osuuskunta Eurojopi', 'Puolangantie 8', 88300, 'Paltamo', 64.4058, 27.8381);

-- --------------------------------------------------------

--
-- Table structure for table `hb_mainclass`
--

CREATE TABLE `hb_mainclass` (
  `m_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hb_mainclass`
--

INSERT INTO `hb_mainclass` (`m_id`, `name`) VALUES
(1, 'Asiointi- ja kauppakassipalvelu'),
(2, 'Ateriapalvelu'),
(3, 'Kotitalkkari'),
(4, 'Kylvetyspalvelu'),
(5, 'Muut kotipalvelun tukipalvelut'),
(6, 'Saattaja- ja ulkoilutuspalvelu'),
(7, 'Siivouspalvelu'),
(8, 'Sosiaalista kanssakäymistä tukevat palvelut'),
(9, 'Tilapäinen lastenhoito kotona - palvelusetelituott'),
(10, 'Vaatehuolto');

-- --------------------------------------------------------

--
-- Table structure for table `hb_provide`
--

CREATE TABLE `hb_provide` (
  `p_id` int(11) NOT NULL,
  `priceh` decimal(11,2) DEFAULT NULL,
  `pricekm` decimal(11,2) DEFAULT NULL,
  `rate` int(11) DEFAULT NULL,
  `alkm` int(11) DEFAULT NULL,
  `c_id` int(11) DEFAULT NULL,
  `s_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hb_provide`
--

INSERT INTO `hb_provide` (`p_id`, `priceh`, `pricekm`, `rate`, `alkm`, `c_id`, `s_id`) VALUES
(77, '34.00', '0.00', 8, 3, 0, 7),
(78, '23.30', '0.00', 2, 1, 1, 7),
(79, '32.00', '0.00', 6, 2, 2, 7),
(80, '29.00', '0.00', 4, 1, 3, 7),
(81, '25.00', '0.00', 5, 1, 3, 10),
(82, '30.00', '0.00', 1, 1, 4, 7),
(83, '45.88', '0.55', 6, 2, 5, 7),
(84, '45.88', '0.55', 3, 1, 5, 10),
(85, '34.00', '0.50', 4, 1, 6, 7),
(86, '6.00', '0.00', 5, 1, 7, 10),
(87, '34.00', '0.00', 1, 1, 0, 12),
(88, '34.00', '0.00', 2, 1, 0, 13),
(89, '23.30', '0.00', 3, 1, 1, 12),
(90, '23.30', '0.00', 4, 1, 1, 13),
(91, '30.00', '0.00', 5, 1, 4, 12),
(92, '30.00', '0.00', 1, 1, 4, 13),
(93, '35.00', '0.55', 5, 1, 8, 12),
(94, '35.00', '0.55', 1, 1, 8, 13),
(95, '45.88', '0.55', 2, 1, 5, 12),
(96, '45.88', '0.55', 3, 1, 5, 13),
(97, '30.00', '0.00', 4, 1, 9, 12),
(98, '0.00', '0.00', 5, 1, 9, 13),
(99, '37.70', '0.45', 1, 1, 10, 12),
(100, '37.20', '0.45', 2, 1, 10, 13),
(101, '32.00', '0.00', 3, 1, 2, 12),
(102, '32.00', '0.00', NULL, NULL, 2, 13),
(103, '29.00', '0.43', NULL, NULL, 3, 12),
(104, '29.00', '0.43', NULL, NULL, 3, 13),
(105, '35.90', '0.75', NULL, NULL, 11, 12),
(106, '35.90', '0.75', NULL, NULL, 11, 13),
(107, '20.00', '0.45', NULL, NULL, 12, 12),
(108, '20.00', '0.45', NULL, NULL, 12, 13),
(109, '23.50', '0.00', NULL, NULL, 13, 12),
(110, '23.50', '0.00', NULL, NULL, 13, 13),
(111, '34.00', '0.50', NULL, NULL, 6, 12),
(112, '34.00', '0.50', NULL, NULL, 6, 13),
(113, '13.00', '0.00', NULL, NULL, 7, 12);

-- --------------------------------------------------------

--
-- Table structure for table `hb_service`
--

CREATE TABLE `hb_service` (
  `s_id` int(11) NOT NULL,
  `s_name` varchar(100) DEFAULT NULL,
  `s_description` varchar(500) DEFAULT NULL,
  `m_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hb_service`
--

INSERT INTO `hb_service` (`s_id`, `s_name`, `s_description`, `m_id`) VALUES
(7, 'Kylvetyspalvelu asiakkaan kotona', ' ', 4),
(10, 'Kylvetyspalvelu kodin ulkopuolella', '', 4),
(12, 'Saattajapalvelu', '', 6),
(13, 'Ulkoilutuspalvelu', '', 6);

-- --------------------------------------------------------

--
-- Table structure for table `hb_user`
--

CREATE TABLE `hb_user` (
  `usercode` int(6) NOT NULL,
  `firstname` varchar(20) DEFAULT NULL,
  `lastname` varchar(20) DEFAULT NULL,
  `dateofbirth` date DEFAULT NULL,
  `u_street` varchar(100) DEFAULT NULL,
  `u_zip` int(5) DEFAULT NULL,
  `u_city` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hb_user`
--

INSERT INTO `hb_user` (`usercode`, `firstname`, `lastname`, `dateofbirth`, `u_street`, `u_zip`, `u_city`) VALUES
(123456, 'Maija', 'Meikäläinen', '1970-05-20', 'Hunajamäki 1', 4500, 'Kennola'),
(123457, 'Kettu', 'Repolainen', '1979-02-20', 'Ketunkolo 2', 9900, 'Hikiä'),
(123458, 'Siivo', 'Sipuli', '2001-01-01', 'Kesäkeittokuja 6', 6660, 'Impilä');

-- --------------------------------------------------------

--
-- Table structure for table `hb_uses`
--

CREATE TABLE `hb_uses` (
  `us_id` int(11) NOT NULL,
  `p_id` int(11) DEFAULT NULL,
  `usercode` int(6) DEFAULT NULL,
  `dateofuse` date DEFAULT NULL,
  `freetext` varchar(500) DEFAULT NULL,
  `stars` int(11) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `bdate` date NOT NULL,
  `bought` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hb_uses`
--

INSERT INTO `hb_uses` (`us_id`, `p_id`, `usercode`, `dateofuse`, `freetext`, `stars`, `duration`, `bdate`, `bought`) VALUES
(25, 77, 123456, '2018-04-26', NULL, 5, 2, '2018-04-23', 68),
(43, 79, 123456, '2018-05-05', NULL, 3, 3, '2018-04-27', 96),
(44, 83, 123456, '2018-04-29', NULL, 4, 1, '2018-04-27', 46),
(45, 79, 123456, '2018-05-18', NULL, NULL, 1, '2018-05-03', 32),
(46, 80, 123456, '2018-05-16', NULL, NULL, 1, '2018-05-03', 29),
(47, 83, 123456, '2018-05-10', NULL, NULL, 2, '2018-05-03', 92),
(48, 83, 123456, '2018-05-16', NULL, NULL, 2, '2018-05-03', 92),
(50, 78, 123456, '2018-05-17', NULL, NULL, 1, '2018-05-03', 23),
(51, 82, 123456, '2018-05-11', NULL, NULL, 2, '2018-05-03', 60),
(52, 82, 123456, '2018-05-23', NULL, NULL, 3, '2018-05-03', 90),
(53, 77, 123456, '2018-05-24', NULL, NULL, 2, '2018-05-07', 68),
(54, 78, 123456, '2018-07-19', NULL, NULL, 4, '2018-05-07', 93),
(55, 78, 123456, '2018-05-23', NULL, NULL, 2, '2018-05-07', 47),
(56, 78, 123456, '2018-05-11', NULL, NULL, 2, '2018-05-07', 47),
(57, 77, 123456, '2018-06-07', NULL, NULL, 3, '2018-05-07', 102),
(58, 79, 123456, '2018-08-07', NULL, NULL, 5, '2018-05-07', 160),
(59, 77, 123456, '2018-05-17', NULL, NULL, 2, '2018-05-08', 68),
(60, 79, 123456, '2018-05-25', NULL, NULL, 2, '2018-05-08', 64),
(74, 81, 123456, '2018-05-31', NULL, NULL, 2, '2018-05-08', 50);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hb_budjet`
--
ALTER TABLE `hb_budjet`
  ADD PRIMARY KEY (`b_id`),
  ADD KEY `usercode` (`usercode`);

--

-- Indexes for table `hb_company`
--
ALTER TABLE `hb_company`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `hb_mainclass`
--
ALTER TABLE `hb_mainclass`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `hb_provide`
--
ALTER TABLE `hb_provide`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `c_id` (`c_id`),
  ADD KEY `s_id` (`s_id`);

--
-- Indexes for table `hb_service`
--
ALTER TABLE `hb_service`
  ADD PRIMARY KEY (`s_id`),
  ADD KEY `m_name` (`m_id`) USING BTREE;

--
-- Indexes for table `hb_user`
--
ALTER TABLE `hb_user`
  ADD PRIMARY KEY (`usercode`);

--
-- Indexes for table `hb_uses`
--
ALTER TABLE `hb_uses`
  ADD PRIMARY KEY (`us_id`),
  ADD UNIQUE KEY `unique_index` (`usercode`,`dateofuse`,`p_id`),
  ADD KEY `sid` (`p_id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hb_budjet`
--
ALTER TABLE `hb_budjet`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--

--
-- AUTO_INCREMENT for table `hb_company`
--
ALTER TABLE `hb_company`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `hb_provide`
--
ALTER TABLE `hb_provide`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `hb_service`
--
ALTER TABLE `hb_service`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `hb_uses`
--
ALTER TABLE `hb_uses`
  MODIFY `us_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hb_budjet`
--
ALTER TABLE `hb_budjet`
  ADD CONSTRAINT `hb_budjet_ibfk_1` FOREIGN KEY (`usercode`) REFERENCES `hb_user` (`usercode`);

--

-- Constraints for table `hb_provide`
--
ALTER TABLE `hb_provide`
  ADD CONSTRAINT `hb_provide_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `hb_company` (`c_id`),
  ADD CONSTRAINT `hb_provide_ibfk_2` FOREIGN KEY (`s_id`) REFERENCES `hb_service` (`s_id`);

--
-- Constraints for table `hb_service`
--
ALTER TABLE `hb_service`
  ADD CONSTRAINT `hb_service_ibfk_1` FOREIGN KEY (`m_id`) REFERENCES `hb_mainclass` (`m_id`);

--
-- Constraints for table `hb_uses`
--
ALTER TABLE `hb_uses`
  ADD CONSTRAINT `hb_uses_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `hb_provide` (`p_id`),
  ADD CONSTRAINT `hb_uses_ibfk_2` FOREIGN KEY (`usercode`) REFERENCES `hb_user` (`usercode`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
