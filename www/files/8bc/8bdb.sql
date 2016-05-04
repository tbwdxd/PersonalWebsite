-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2014 at 03:42 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `8bdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer_account`
--

CREATE TABLE IF NOT EXISTS `customer_account` (
  `Customer_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Subscription_ID` int(11) NOT NULL,
  `Email` varchar(250) CHARACTER SET utf8 NOT NULL,
  `Password` varchar(250) CHARACTER SET utf8 NOT NULL,
  `First_Name` varchar(250) CHARACTER SET utf8 NOT NULL,
  `Last_Name` varchar(250) CHARACTER SET utf8 NOT NULL,
  `Street` varchar(250) CHARACTER SET utf8 NOT NULL,
  `City` varchar(250) CHARACTER SET utf8 NOT NULL,
  `State` varchar(250) CHARACTER SET utf8 NOT NULL,
  `Zip` int(11) NOT NULL,
  `Total_Balance` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`Customer_ID`),
  UNIQUE KEY `Email` (`Email`),
  KEY `Customer_ID` (`Customer_ID`),
  KEY `Subscription_ID` (`Subscription_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Table for Customer Account Management' AUTO_INCREMENT=32 ;

--
-- Dumping data for table `customer_account`
--

INSERT INTO `customer_account` (`Customer_ID`, `Subscription_ID`, `Email`, `Password`, `First_Name`, `Last_Name`, `Street`, `City`, `State`, `Zip`, `Total_Balance`) VALUES
(9, 2, 'tiffaniechen@hotmail.com', '655f7d5448a7e7b148b28ff01c569a6cc357ec36979b08cb5eab1041ed49f724c6b7295fd47e599e72b2a520d91619bd3bc29454b2d2be9adf7435430cac90ab', 'Bowen', 'Tian', '3321 quartz lane', 'fullerton', 'CA', 92831, 199.9),
(14, 3, 'test@PHP.com', 'e13efc991a9bf44bbb4da87cdbb725240184585ccaf270523170e008cf2a3b85f45f86c3da647f69780fb9e971caf5437b3d06d418355a68c9760c70a31d05c7', 'testPHP', 'PHP', '1234 PHP', '', '', 0, 0),
(19, 2, 'xiaoliang@qq.com', '1d29223a3dcb95a2adf905680838abbbd4a61f6e664d870fe56412ce2eedd8a1777484ebea209aec010bf40af717c7825cf0e594828677b5fbbea73520c41b83', 'Xiao', 'Liang', '3345 rt street', 'fullerton', 'CA', 92831, 0),
(20, 1, 'bb@qq.com', '1d29223a3dcb95a2adf905680838abbbd4a61f6e664d870fe56412ce2eedd8a1777484ebea209aec010bf40af717c7825cf0e594828677b5fbbea73520c41b83', 'Taylor', 'Tian', '', '', '', 0, 0),
(21, 2, 'YN@u.com', '1d29223a3dcb95a2adf905680838abbbd4a61f6e664d870fe56412ce2eedd8a1777484ebea209aec010bf40af717c7825cf0e594828677b5fbbea73520c41b83', 'Yes', 'No', '', '', '', 0, 0),
(23, 1, 'jsmith@gmail.com', 'fa585d89c851dd338a70dcf535aa2a92fee7836dd6aff1226583e88e0996293f16bc009c652826e0fc5c706695a03cddce372f139eff4d13959da6f1f5d3eabe', 'John', 'Smith', '800 N. State College Blvd.', 'Fullerton', 'California', 92831, 0),
(25, 1, 'taylortianbowen@hotmail.com', '1d29223a3dcb95a2adf905680838abbbd4a61f6e664d870fe56412ce2eedd8a1777484ebea209aec010bf40af717c7825cf0e594828677b5fbbea73520c41b83', 'Bowen', 'Tian', '3321 quartz lane', 'fullerton', 'CA', 92831, 120.99),
(27, 1, 'xiaoliang@hotmail.com', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 'xx', 'll', '123123', '', '', 0, 0),
(28, 1, 'test@8bc.com', 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86', 'testtwo', 'test', '', '', '', 0, 0),
(30, 3, 'BB@BA.com', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 'BB', 'BA', '1155 Davis Way', 'Placentia', 'California', 92870, 0),
(31, 1, 'mahdi@mahdi.com', 'fa585d89c851dd338a70dcf535aa2a92fee7836dd6aff1226583e88e0996293f16bc009c652826e0fc5c706695a03cddce372f139eff4d13959da6f1f5d3eabe', 'Mahdi', 'H', '', '', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `Employee_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Employee_Fname` varchar(250) NOT NULL,
  `Employee_Lname` varchar(250) NOT NULL,
  `Emp_Street` varchar(250) NOT NULL,
  `Emp_City` varchar(250) NOT NULL,
  `Emp_State` varchar(250) NOT NULL,
  `Emp_Zip` int(12) NOT NULL,
  `Emp_Email` varchar(250) NOT NULL,
  `Emp_Password` varchar(250) NOT NULL,
  `Emp_Status` varchar(250) NOT NULL,
  `Hire_Date` date NOT NULL,
  `Leave_Date` date NOT NULL,
  `Pay_Rate` float NOT NULL,
  PRIMARY KEY (`Employee_ID`),
  UNIQUE KEY `Emp_Email` (`Emp_Email`),
  KEY `Employee_ID` (`Employee_ID`),
  KEY `Emp_Email_2` (`Emp_Email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Table for Employee' AUTO_INCREMENT=8 ;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`Employee_ID`, `Employee_Fname`, `Employee_Lname`, `Emp_Street`, `Emp_City`, `Emp_State`, `Emp_Zip`, `Emp_Email`, `Emp_Password`, `Emp_Status`, `Hire_Date`, `Leave_Date`, `Pay_Rate`) VALUES
(3, 'Admin', 'Admin', '8 Bit St.', 'Xbox', 'Game', 8000000, 'admin@8bc.com', 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86', 'Active', '2014-06-07', '0000-00-00', 900),
(7, 'John', 'Game', '', '', '', 92831, 'admin2@8bc.com', '1d29223a3dcb95a2adf905680838abbbd4a61f6e664d870fe56412ce2eedd8a1777484ebea209aec010bf40af717c7825cf0e594828677b5fbbea73520c41b83', 'Active', '2014-04-27', '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `P_ID` int(11) NOT NULL AUTO_INCREMENT,
  `P_D_ID` int(11) NOT NULL,
  `Unit_Cost` double NOT NULL,
  `Product_Status` int(11) NOT NULL,
  `Trade_ID` int(11) NOT NULL,
  `Rented_Times` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`P_ID`),
  KEY `P_ID` (`P_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`P_ID`, `P_D_ID`, `Unit_Cost`, `Product_Status`, `Trade_ID`, `Rented_Times`) VALUES
(0, 2, 39.99, 0, 0, 3),
(2, 1, 10, 0, 0, 1),
(3, 1, 29.99, 0, 0, 1),
(4, 3, 39.99, 1, 0, 4),
(5, 2, 13, 0, 0, 1),
(6, 2, 2, 0, 0, 0),
(7, 4, 6, 0, 0, 2),
(8, 1, 0, 0, 0, 2),
(9, 5, 59.99, 0, 0, 8),
(10, 6, 5, 0, 5, 0),
(11, 9, 46.99, 0, 0, 0),
(12, 15, 29.99, 0, 0, 0),
(13, 12, 29.99, 0, 0, 0),
(14, 11, 19.99, 0, 0, 0),
(15, 8, 15.65, 0, 0, 0),
(16, 16, 39.99, 0, 0, 0),
(17, 10, 49.99, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_details`
--

CREATE TABLE IF NOT EXISTS `product_details` (
  `P_D_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Product_Title` varchar(250) NOT NULL,
  `Product_Developer` varchar(250) NOT NULL,
  `Product_Publisher` varchar(250) NOT NULL,
  `Release_Date` date NOT NULL,
  `ESRB_Rating` varchar(250) NOT NULL,
  `Cover_dir` varchar(250) NOT NULL,
  `Platform` varchar(20) NOT NULL,
  `Rented_Times` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`P_D_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `product_details`
--

INSERT INTO `product_details` (`P_D_ID`, `Product_Title`, `Product_Developer`, `Product_Publisher`, `Release_Date`, `ESRB_Rating`, `Cover_dir`, `Platform`, `Rented_Times`) VALUES
(1, 'Call of Duty Black Ops 2 ', 'Treyarch', 'Activision', '2012-11-13', 'MATURE', 'boxart_callofduty.jpg', 'PC', 4),
(2, 'Assassins Creed IV: Black Flag', 'Ubisoft Montreal', 'Ubisoft', '2013-10-29', 'MATURE', 'boxart_assassinscreed.jpg', 'PC', 2),
(3, 'Battlefield 4', 'EA Digital Illusions CE', 'Electronic Arts', '2013-10-29', 'MATURE', 'boxart_battlefield.jpg', 'PC', 2),
(4, 'BioShock Infinite', 'Irrational Games 2K Australia', '2K Games', '2013-03-26', 'MATURE', 'boxart_bioshock.jpg', 'PC', 2),
(5, 'Diablo III', 'Blizzard Entertainment', 'Blizzard Entertainment JP Square Enix', '2012-05-15', 'MATURE', 'boxart_diablo.jpg', 'PC', 3),
(6, 'Grand Theft Auto V', 'Rockstar North', 'Rockstar Games', '2013-09-17', 'MATURE', 'boxart_gta5.jpg', 'PS', 0),
(7, 'Assassins Creed IV: Black Flag', 'Ubisoft Montreal', 'Ubisoft', '2013-10-29', 'MATURE', 'boxart_assassinscreed.jpg', 'WII', 0),
(8, 'Need for Speed Rivals', 'Ghost Games', 'Electronic Arts', '2013-11-29', 'EVERYONE', 'boxart_needforspeed.jpg', 'XBOX', 0),
(9, 'Titanfall', 'Respawn Entertainment', 'Electronic Arts', '2014-03-11', 'MATURE', 'boxart_titanfall.jpg', 'XBOX', 0),
(10, 'The Amazing Spider-Man 2', 'Beenox', 'Activision', '2014-04-29', 'TEEN', 'boxart_theamazingspiderman2.jpg', 'PS', 0),
(11, 'Monster Hunter 3 Ultimate', 'Capcom Production Studio', 'Capcom', '2013-03-19', 'TEEN', 'boxart_monsterhunter3ultimate.jpg', 'WII', 0),
(12, 'LEGO The Hobbit', 'Travellers Tales', 'Warner Bros Interactive Entertainment', '2014-04-08', 'EVERYONE 10+', 'boxart_legothehobbit.jpg', 'WII', 0),
(13, 'Titanfall', 'Respawn Entertainment', 'Electronic Arts', '2014-03-11', 'MATURE', 'boxart_titanfall.jpg', 'PC', 0),
(14, 'Halo 4', '343 Industries', 'Microsoft Studios', '2012-11-06', 'MATURE', 'boxart_halo.jpg', 'XBOX', 0),
(15, 'NBA 2K14', 'Visual Concepts', '2K Sports', '2013-10-01', 'EVERYONE', 'boxart_nba2k14.jpg', 'PS', 0),
(16, 'World of Warcraft: Mists of Pandaria', 'Blizzard Entertainment', 'Blizzard Entertainment', '2012-11-25', 'TEEN', 'boxart_wow.jpg', 'PC', 0);

-- --------------------------------------------------------

--
-- Table structure for table `rental_history`
--

CREATE TABLE IF NOT EXISTS `rental_history` (
  `RH_ID` int(11) NOT NULL AUTO_INCREMENT,
  `P_ID` int(11) NOT NULL,
  `Date_Rented` date NOT NULL,
  `Date_Returned` date NOT NULL,
  `Customer_ID` int(11) NOT NULL,
  PRIMARY KEY (`RH_ID`),
  KEY `Customer_ID` (`Customer_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `rental_history`
--

INSERT INTO `rental_history` (`RH_ID`, `P_ID`, `Date_Rented`, `Date_Returned`, `Customer_ID`) VALUES
(16, 0, '2014-04-29', '2014-05-01', 25),
(17, 2, '2014-04-29', '2014-05-05', 25),
(18, 4, '2014-05-01', '2014-05-01', 25),
(19, 7, '2014-05-01', '2014-05-01', 25),
(20, 7, '2014-05-01', '2014-05-07', 25),
(21, 4, '2014-05-01', '2014-05-01', 25),
(22, 3, '2014-05-01', '2014-05-01', 25),
(23, 8, '2014-05-01', '2014-05-01', 25),
(24, 9, '2014-05-04', '2014-05-04', 25),
(25, 9, '2014-05-04', '2014-05-04', 25),
(26, 9, '2014-05-04', '2014-05-04', 25),
(27, 0, '2014-05-04', '2014-05-04', 25),
(28, 5, '2014-05-04', '2014-05-04', 25),
(29, 8, '2014-05-05', '2014-05-07', 25),
(34, 9, '2014-05-07', '2014-05-07', 25),
(35, 4, '2014-05-07', '0000-00-00', 25),
(36, 13, '0000-00-00', '0000-00-00', 25),
(37, 12, '0000-00-00', '0000-00-00', 25),
(39, 11, '0000-00-00', '0000-00-00', 25),
(41, 10, '0000-00-00', '0000-00-00', 25),
(42, 8, '0000-00-00', '0000-00-00', 25),
(43, 7, '0000-00-00', '0000-00-00', 25),
(44, 9, '0000-00-00', '0000-00-00', 25),
(45, 17, '0000-00-00', '0000-00-00', 25),
(46, 14, '0000-00-00', '0000-00-00', 25);

-- --------------------------------------------------------

--
-- Table structure for table `subscription_plan`
--

CREATE TABLE IF NOT EXISTS `subscription_plan` (
  `Subscription_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Description` varchar(250) CHARACTER SET utf8 NOT NULL,
  `Rate` float NOT NULL,
  `Visibility` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`Subscription_ID`),
  KEY `Subscription_ID` (`Subscription_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `subscription_plan`
--

INSERT INTO `subscription_plan` (`Subscription_ID`, `Description`, `Rate`, `Visibility`) VALUES
(1, '2-Disc', 15.99, 1),
(2, 'First-Time Bundle', 19.99, 1),
(3, '365-Free Play', 150, 1),
(4, 'Coming Soon Bundle', 1.1, 0),
(5, 'Coming Soon Bundle - 2', 1.1, 0),
(6, 'Coming Soon Bundle - 3', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `trade`
--

CREATE TABLE IF NOT EXISTS `trade` (
  `Trade_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Customer_ID` int(11) NOT NULL,
  `Trade_Date` date NOT NULL,
  `Trade_Price` float NOT NULL,
  `P_D_ID` int(11) NOT NULL,
  `Employee_ID` int(11) NOT NULL,
  `Trade_Status` int(11) NOT NULL DEFAULT '0',
  `Is_Purchase` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Trade_ID`),
  KEY `Customer_ID` (`Customer_ID`,`P_D_ID`,`Employee_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `trade`
--

INSERT INTO `trade` (`Trade_ID`, `Customer_ID`, `Trade_Date`, `Trade_Price`, `P_D_ID`, `Employee_ID`, `Trade_Status`, `Is_Purchase`) VALUES
(5, 25, '2014-05-05', 5, 6, 3, 1, 0),
(6, 25, '2014-05-08', 0, 8, 3, 2, 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_account`
--
ALTER TABLE `customer_account`
  ADD CONSTRAINT `Customer_Account_ibfk_1` FOREIGN KEY (`Subscription_ID`) REFERENCES `subscription_plan` (`Subscription_ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
