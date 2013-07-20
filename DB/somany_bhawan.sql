-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 20, 2013 at 04:05 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `somany_bhawan`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_addt_contents`
--

DROP TABLE IF EXISTS `tbl_addt_contents`;
CREATE TABLE IF NOT EXISTS `tbl_addt_contents` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `page_id` int(10) NOT NULL,
  `content` text,
  PRIMARY KEY (`id`),
  KEY `page_id` (`page_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_addt_contents`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin_menu`
--

DROP TABLE IF EXISTS `tbl_admin_menu`;
CREATE TABLE IF NOT EXISTS `tbl_admin_menu` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(100) NOT NULL,
  `menu_id` int(10) NOT NULL,
  `sequence` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `tbl_admin_menu`
--

INSERT INTO `tbl_admin_menu` (`id`, `menu_name`, `menu_id`, `sequence`) VALUES
(1, 'MANAGE PAGES', 0, 1),
(2, 'PAGES', 1, 1),
(7, 'RESERVATION', 0, 3),
(8, 'CONTACTS', 7, 3),
(13, 'SITE CONFIGURE', 0, 4),
(14, 'GLOBAL CONFIG', 13, 1),
(15, 'MANAGE ACCOUNT', 13, 2),
(16, 'ROOMS', 0, 2),
(17, 'CATEGORY', 16, 1),
(18, 'BOOKING', 7, 1),
(19, 'CANCELLATION', 7, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin_rights`
--

DROP TABLE IF EXISTS `tbl_admin_rights`;
CREATE TABLE IF NOT EXISTS `tbl_admin_rights` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `permt_menu_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `permt_menu_id` (`permt_menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_admin_rights`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_careers`
--

DROP TABLE IF EXISTS `tbl_careers`;
CREATE TABLE IF NOT EXISTS `tbl_careers` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `post` varchar(50) NOT NULL,
  `dept_id` int(10) NOT NULL,
  `city_id` int(10) NOT NULL,
  `qualification` varchar(50) NOT NULL,
  `experience` varchar(255) NOT NULL,
  `job_desc` text NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`),
  KEY `dept_id` (`dept_id`),
  KEY `city_id` (`city_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbl_careers`
--

INSERT INTO `tbl_careers` (`id`, `post`, `dept_id`, `city_id`, `qualification`, `experience`, `job_desc`, `status`) VALUES
(8, 'Test Post', 2, 60, 'Bsc', 'Test Exp', 'Test Desc', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_catg_subcatg`
--

DROP TABLE IF EXISTS `tbl_catg_subcatg`;
CREATE TABLE IF NOT EXISTS `tbl_catg_subcatg` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `desc` text NOT NULL,
  `status` enum('ACTV','INACTV') NOT NULL DEFAULT 'ACTV',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_catg_subcatg`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_cities`
--

DROP TABLE IF EXISTS `tbl_cities`;
CREATE TABLE IF NOT EXISTS `tbl_cities` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `state_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `state_id` (`state_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=607 ;

--
-- Dumping data for table `tbl_cities`
--

INSERT INTO `tbl_cities` (`id`, `name`, `state_id`) VALUES
(1, 'North and Middle Andaman', 1),
(2, 'South Andaman', 1),
(3, 'Nicobar', 1),
(4, 'Nalgonda', 2),
(5, 'Kurnool', 2),
(6, 'Karimnagar', 2),
(7, 'Guntur', 2),
(8, 'Vizianagaram', 2),
(9, 'Anantapur', 2),
(10, 'Rangareddi', 2),
(11, 'Nellore', 2),
(12, 'Mahbubnagar', 2),
(13, 'Khammam', 2),
(14, 'Hyderabad', 2),
(15, 'Warangal', 2),
(16, 'Chittoor', 2),
(17, 'Srikakulam', 2),
(18, 'Nizamabad', 2),
(19, 'Medak', 2),
(20, 'Krishna', 2),
(21, 'Kadapa', 2),
(22, 'West Godavari', 2),
(23, 'East Godavari', 2),
(24, 'Vishakhapatnam', 2),
(25, 'Adilabad', 2),
(26, 'Prakasam', 2),
(27, 'Tirap', 3),
(28, 'Lohit', 3),
(29, 'Anjaw', 3),
(30, 'Dibang Valley', 3),
(31, 'Lower Subansiri', 3),
(32, 'Changlang', 3),
(33, 'Upper Subansiri', 3),
(34, 'Papum Pare', 3),
(35, 'East Kameng', 3),
(36, 'West Kameng', 3),
(37, 'Karimganj', 4),
(38, 'Hailakandi', 4),
(39, 'Dibrugarh', 4),
(40, 'Sibsagar', 4),
(41, 'Darrang', 4),
(42, 'Nagaon', 4),
(43, 'Barpeta', 4),
(44, 'Kokrajhar', 4),
(45, 'Jorhat', 4),
(46, 'Goalpara', 4),
(47, 'Sonitpur', 4),
(48, 'Dhemaji', 4),
(49, 'Nalbari', 4),
(50, 'Bongaigaon', 4),
(51, 'Lakhimpur', 4),
(52, 'Karbi Anglong', 4),
(53, 'Golaghat', 4),
(54, 'Tinsukia', 4),
(55, 'Dhubri', 4),
(56, 'North Cachar Hills', 4),
(57, 'Cachar', 4),
(58, 'Marigaon', 4),
(59, 'Buxar', 5),
(60, 'Nalanda', 5),
(61, 'Begusarai', 5),
(62, 'Munger', 5),
(63, 'Vaishali', 5),
(64, 'Araria', 5),
(65, 'Katihar', 5),
(66, 'Sitamarhi', 5),
(67, 'Khagaria', 5),
(68, 'Sheohar', 5),
(69, 'Gopalganj', 5),
(70, 'Rohtas', 5),
(71, 'Darbhanga', 5),
(72, 'Nawada', 5),
(73, 'Bhagalpur', 5),
(74, 'Madhepura', 5),
(75, 'Pashchim Champaran', 5),
(76, 'Aurangabad', 5),
(77, 'Lakhisarai', 5),
(78, 'Supaul', 5),
(79, 'Kishanganj', 5),
(80, 'Sheikhpura', 5),
(81, 'Jamui', 5),
(82, 'Saharsa', 5),
(83, 'Purba Champaran', 5),
(84, 'Patna', 5),
(85, 'Bhojpur', 5),
(86, 'Muzaffarpur', 5),
(87, 'Banka', 5),
(88, 'Madhubani', 5),
(89, 'Siwan', 5),
(90, 'Kaimur', 5),
(91, 'Saran', 5),
(92, 'Jehanabad', 5),
(93, 'Samastipur', 5),
(94, 'Gaya', 5),
(95, 'Purnia', 5),
(96, '', 6),
(97, 'Bastar', 7),
(98, 'Rajnandgaon', 7),
(99, 'Kawardha', 7),
(100, 'Korba', 7),
(101, 'Durg', 7),
(102, 'Bilaspur', 7),
(103, 'Raipur', 7),
(104, 'Mahasamund', 7),
(105, 'Koriya', 7),
(106, 'Jashpur', 7),
(107, 'Dantewada', 7),
(108, 'Surguja', 7),
(109, 'Raigarh', 7),
(110, 'Kanker', 7),
(111, 'Janjgir-Champa', 7),
(112, 'Dhamtari', 7),
(113, 'Dadra', 8),
(114, 'Diu', 9),
(115, 'Daman', 9),
(116, 'South West Delhi', 10),
(117, 'North East Delhi', 10),
(118, 'East Delhi', 10),
(119, 'West Delhi', 10),
(120, 'North West Delhi', 10),
(121, 'New Delhi', 10),
(122, 'South Delhi', 10),
(123, 'North Delhi', 10),
(124, 'Central Delhi', 10),
(125, 'South Goa', 11),
(126, 'North Goa', 11),
(127, 'Anand', 12),
(128, 'Porbandar', 12),
(129, 'Navsari', 12),
(130, 'Kheda', 12),
(131, 'Jamnagar', 12),
(132, 'Dahod', 12),
(133, 'Surat', 12),
(134, 'Banaskantha', 12),
(135, 'Rajkot', 12),
(136, 'Ahmedabad', 12),
(137, 'Patan', 12),
(138, 'Mehsana', 12),
(139, 'Junagadh', 12),
(140, 'The Dangs', 12),
(141, 'Vadodara', 12),
(142, 'Bharuch', 12),
(143, 'Sabarkantha', 12),
(144, 'Amreli District', 12),
(145, 'Panchmahal', 12),
(146, 'Narmada', 12),
(147, 'Kutch', 12),
(148, 'Gandhinagar', 12),
(149, 'Valsad', 12),
(150, 'Bhavnagar', 12),
(151, 'Surendranagar', 12),
(152, 'Kaithal', 13),
(153, 'Jhajjar', 13),
(154, 'Fatehabad', 13),
(155, 'Yamuna Nagar', 13),
(156, 'Ambala', 13),
(157, 'Rohtak', 13),
(158, 'Panchkula', 13),
(159, 'Kurukshetra', 13),
(160, 'Jind', 13),
(161, 'Gurgaon', 13),
(162, 'Palwal', 13),
(163, 'Bhiwani', 13),
(164, 'Sirsa', 13),
(165, 'Panipat', 13),
(166, 'Mahendragarh', 13),
(167, 'Karnal', 13),
(168, 'Hissar', 13),
(169, 'Faridabad', 13),
(170, 'Sonepat', 13),
(171, 'Rewari', 13),
(172, 'Mewat', 13),
(173, 'Kinnaur', 14),
(174, 'Chamba', 14),
(175, 'Una', 14),
(176, 'Shimla', 14),
(177, 'Kulu', 14),
(178, 'Hamirpur', 14),
(179, 'Sirmaur', 14),
(180, 'Lahaul and Spiti', 14),
(181, 'Kangra', 14),
(182, 'Bilaspur', 14),
(183, 'Solan', 14),
(184, 'Mandi', 14),
(185, 'Kupwara', 15),
(186, 'Jammu', 15),
(187, 'Bandipore', 15),
(188, 'Udhampur', 15),
(189, 'Rajauri', 15),
(190, 'Leh', 15),
(191, 'Kargil', 15),
(192, 'Baramula', 15),
(193, 'Anantnag', 15),
(194, 'Srinagar', 15),
(195, 'Poonch', 15),
(196, 'Kathua', 15),
(197, 'Doda', 15),
(198, 'Badgam', 15),
(199, 'Samba', 15),
(200, 'Pulwama', 15),
(201, 'Godda', 16),
(202, 'Purba Singhbhum', 16),
(203, 'Deoghar', 16),
(204, 'Pashchim Singhbhum', 16),
(205, 'Ranchi', 16),
(206, 'Lohardaga', 16),
(207, 'Gumla', 16),
(208, 'Garhwa', 16),
(209, 'Dhanbad', 16),
(210, 'Ramgarh', 16),
(211, 'Bokaro', 16),
(212, 'Sahibganj', 16),
(213, 'Pakur', 16),
(214, 'Hazaribagh', 16),
(215, 'Giridih', 16),
(216, 'Dumka', 16),
(217, 'Chatra', 16),
(218, 'Seraikela and Kharsawan', 16),
(219, 'Palamu', 16),
(220, 'Koderma', 16),
(221, 'Bellary', 17),
(222, 'Mandya', 17),
(223, 'Belgaum', 17),
(224, 'Kodagu', 17),
(225, 'Gulbarga', 17),
(226, 'Dharwad', 17),
(227, 'Ramanagara', 17),
(228, 'Chikmagalur', 17),
(229, 'Tumkur', 17),
(230, 'Bangalore Rural District', 17),
(231, 'Mysore', 17),
(232, 'Bijapur', 17),
(233, 'Kolar', 17),
(234, 'Hassan', 17),
(235, 'Dakshina Kannada', 17),
(236, 'Chikballapur', 17),
(237, 'Chitradurga', 17),
(238, 'Udupi', 17),
(239, 'Bangalore Urban District', 17),
(240, 'Raichur', 17),
(241, 'Bagalkot', 17),
(242, 'Koppal', 17),
(243, 'Bidar', 17),
(244, 'Haveri District', 17),
(245, 'Gadag', 17),
(246, 'Yadagiri', 17),
(247, 'Davanagere', 17),
(248, 'Uttara Kannada', 17),
(249, 'Chamarajnagar', 17),
(250, 'Shimoga', 17),
(251, 'Kottayam', 18),
(252, 'Kollam', 18),
(253, 'Alappuzha', 18),
(254, 'Wayanad', 18),
(255, 'Pathanamthitta', 18),
(256, 'Kozhikode', 18),
(257, 'Kannur', 18),
(258, 'Ernakulam', 18),
(259, 'Thrissur', 18),
(260, 'Malappuram', 18),
(261, 'Kasaragod', 18),
(262, 'Idukki', 18),
(263, 'Thiruvananthapuram', 18),
(264, 'Palakkad', 18),
(265, '', 19),
(266, 'Bhopal', 20),
(267, 'Katni', 20),
(268, 'Seoni', 20),
(269, 'Barwani', 20),
(270, 'Indore', 20),
(271, 'Sagar', 20),
(272, 'Anuppur', 20),
(273, 'Gwalior', 20),
(274, 'Rajgarh', 20),
(275, 'Vidisha', 20),
(276, 'Dhar', 20),
(277, 'Neemuch', 20),
(278, 'Tikamgarh', 20),
(279, 'Damoh', 20),
(280, 'Mandsaur', 20),
(281, 'Shivpuri', 20),
(282, 'Burhanpur', 20),
(283, 'Khandwa', 20),
(284, 'Shahdol', 20),
(285, 'Betul', 20),
(286, 'Jabalpur', 20),
(287, 'Satna', 20),
(288, 'Ashok Nagar', 20),
(289, 'Harda', 20),
(290, 'Ratlam', 20),
(291, 'Dindori', 20),
(292, 'Panna', 20),
(293, 'Ujjain', 20),
(294, 'Datia', 20),
(295, 'Morena', 20),
(296, 'Sidhi', 20),
(297, 'Chhatarpur', 20),
(298, 'Khargone', 20),
(299, 'Shajapur', 20),
(300, 'Bhind', 20),
(301, 'Jhabua', 20),
(302, 'Sehore', 20),
(303, 'Balaghat', 20),
(304, 'Hoshangabad', 20),
(305, 'Raisen', 20),
(306, 'Alirajpur', 20),
(307, 'Guna', 20),
(308, 'Rewa', 20),
(309, 'Umaria', 20),
(310, 'Dewas', 20),
(311, 'Narsinghpur', 20),
(312, 'Singrauli', 20),
(313, 'Chhindwara', 20),
(314, 'Mandla', 20),
(315, 'Sheopur', 20),
(316, 'Beed', 21),
(317, 'Nashik', 21),
(318, 'Amrawati', 21),
(319, 'Nandurbar', 21),
(320, 'Yavatmal', 21),
(321, 'Latur', 21),
(322, 'Thane', 21),
(323, 'Jalgaon', 21),
(324, 'Sangli', 21),
(325, 'Gadchiroli', 21),
(326, 'Raigad', 21),
(327, 'Buldhana', 21),
(328, 'Osmanabad', 21),
(329, 'Aurangabad', 21),
(330, 'Nanded', 21),
(331, 'Ahmednagar', 21),
(332, 'Mumbai', 21),
(333, 'Wardha', 21),
(334, 'Jalna', 21),
(335, 'Solapur', 21),
(336, 'Gondiya', 21),
(337, 'Ratnagiri', 21),
(338, 'Chandrapur', 21),
(339, 'Parbhani', 21),
(340, 'Bhandara', 21),
(341, 'Nagpur', 21),
(342, 'Akola', 21),
(343, 'Mumbai suburban', 21),
(344, 'Washim', 21),
(345, 'Kolhapur', 21),
(346, 'Satara', 21),
(347, 'Hingoli', 21),
(348, 'Sindhudurg', 21),
(349, 'Dhule', 21),
(350, 'Pune', 21),
(351, 'Chandel', 22),
(352, 'Thoubal', 22),
(353, 'Imphal East', 22),
(354, 'Bishnupur', 22),
(355, 'Ukhrul', 22),
(356, 'Senapati', 22),
(357, 'Churachandpur', 22),
(358, 'Imphal West', 22),
(359, 'Tamenglong', 22),
(360, 'West Khasi Hills', 23),
(361, 'Ri-Bhoi', 23),
(362, 'East Garo Hills', 23),
(363, 'South Garo Hills', 23),
(364, 'East Khasi Hills', 23),
(365, 'West Garo Hills', 23),
(366, 'Jaintia Hills', 23),
(367, 'Kolasib', 24),
(368, 'Saiha', 24),
(369, 'Lawngtlai', 24),
(370, 'Aizawl', 24),
(371, 'Serchhip', 24),
(372, 'Lunglei', 24),
(373, 'Champhai', 24),
(374, 'Mamit', 24),
(375, 'Zunheboto', 25),
(376, 'Phek', 25),
(377, 'Kohima', 25),
(378, 'Tuensang', 25),
(379, 'Mokokchung', 25),
(380, 'Wokha', 25),
(381, 'Mon', 25),
(382, 'Dimapur', 25),
(383, 'Bhadrak', 26),
(384, 'Koraput', 26),
(385, 'Kendujhar', 26),
(386, 'Jajapur', 26),
(387, 'Subarnapur', 26),
(388, 'Ganjam', 26),
(389, 'Puri', 26),
(390, 'Cuttack', 26),
(391, 'Nabarangpur', 26),
(392, 'Bolangir', 26),
(393, 'Kendrapara', 26),
(394, 'Angul', 26),
(395, 'Kalahandi', 26),
(396, 'Jagatsinghpur', 26),
(397, 'Sundargarh', 26),
(398, 'Gajapati', 26),
(399, 'Rayagada', 26),
(400, 'Debagarh', 26),
(401, 'Nuapada', 26),
(402, 'Bargarh', 26),
(403, 'Malkangiri', 26),
(404, 'Boudh', 26),
(405, 'Kandhamal', 26),
(406, 'Khordha', 26),
(407, 'Jharsuguda', 26),
(408, 'Sambalpur', 26),
(409, 'Dhenkanal', 26),
(410, 'Nayagarh', 26),
(411, 'Baleswar', 26),
(412, 'Mayurbhanj', 26),
(413, 'Mahe', 27),
(414, 'Puducherry', 27),
(415, 'Yanam', 27),
(416, 'Karaikal', 27),
(417, 'Amritsar', 28),
(418, 'Sangrur', 28),
(419, 'Nawan Shehar', 28),
(420, 'Mansa', 28),
(421, 'Jalandhar', 28),
(422, 'Fatehgarh Sahib', 28),
(423, 'Bathinda', 28),
(424, 'Patiala', 28),
(425, 'Moga', 28),
(426, 'Kapurthala', 28),
(427, 'Gurdaspur', 28),
(428, 'Firozpur', 28),
(429, 'Rupnagar', 28),
(430, 'Mukatsar', 28),
(431, 'Ludhiana', 28),
(432, 'Hoshiarpur', 28),
(433, 'Faridkot', 28),
(434, 'Hanumangarh', 29),
(435, 'Tonk', 29),
(436, 'Dholpur', 29),
(437, 'Sikar', 29),
(438, 'Churu', 29),
(439, 'Pali', 29),
(440, 'Baran', 29),
(441, 'Karauli', 29),
(442, 'Barmer', 29),
(443, 'Jaipur', 29),
(444, 'Ajmer', 29),
(445, 'Juhnjhunun', 29),
(446, 'Udaipur', 29),
(447, 'Dungapur', 29),
(448, 'Sawai Madhopur', 29),
(449, 'Chittorgarh', 29),
(450, 'Pratapgarh', 29),
(451, 'Bundi', 29),
(452, 'Kota', 29),
(453, 'Banswara', 29),
(454, 'Jaisalmer', 29),
(455, 'Alwar', 29),
(456, 'Jalore', 29),
(457, 'Ganganagar', 29),
(458, 'Sirohi', 29),
(459, 'Dausa', 29),
(460, 'Rajsamand', 29),
(461, 'Bhilwara', 29),
(462, 'Nagaur', 29),
(463, 'Bharatpur', 29),
(464, 'Jhalawar', 29),
(465, 'Bikaner', 29),
(466, 'Jodhpur', 29),
(467, 'South Sikkim', 30),
(468, 'West Sikkim', 30),
(469, 'East Sikkim', 30),
(470, 'North Sikkim', 30),
(471, 'Madurai', 31),
(472, 'Thiruvarur', 31),
(473, 'Kanchipuram', 31),
(474, 'Thanjavur', 31),
(475, 'Dharmapuri', 31),
(476, 'Tiruchirappalli', 31),
(477, 'Chennai', 31),
(478, 'Salem', 31),
(479, 'Perambalur', 31),
(480, 'Nagapattinam', 31),
(481, 'Tiruvannamalai', 31),
(482, 'Kanyakumari', 31),
(483, 'Thoothukudi', 31),
(484, 'Dindigul', 31),
(485, 'Theni', 31),
(486, 'Coimbatore', 31),
(487, 'Sivagangai', 31),
(488, 'Pudukkottai', 31),
(489, 'The Nilgiris', 31),
(490, 'Vellore', 31),
(491, 'Karur', 31),
(492, 'Thiruvallur', 31),
(493, 'Erode', 31),
(494, 'Tirunelveli', 31),
(495, 'Cuddalore', 31),
(496, 'Tiruppur', 31),
(497, 'Ariyalur', 31),
(498, 'Ramanathapuram', 31),
(499, 'Namakkal', 31),
(500, 'Villupuram', 31),
(501, 'West Tripura', 32),
(502, 'Dhalai', 32),
(503, 'North Tripura', 32),
(504, 'South Tripura', 32),
(505, 'Pithoragharh', 33),
(506, 'Haridwar', 33),
(507, 'Chamoli', 33),
(508, 'Uttarkashi', 33),
(509, 'Rudraprayag', 33),
(510, 'Nainital', 33),
(511, 'Champawat', 33),
(512, 'Almora', 33),
(513, 'Tehri Garhwal', 33),
(514, 'Pauri Garhwal', 33),
(515, 'Dehradun', 33),
(516, 'Bageshwar', 33),
(517, 'Udham Singh Nagar', 33),
(518, 'Ballia', 34),
(519, 'Gautam Buddha Nagar', 34),
(520, 'Kushinagar', 34),
(521, 'Rae Bareli', 34),
(522, 'Bagpat', 34),
(523, 'Farrukhabad', 34),
(524, 'Kannauj', 34),
(525, 'Pilibhit', 34),
(526, 'Azamgarh', 34),
(527, 'Kanshiram Nagar', 34),
(528, 'Jyotiba Phule Nagar', 34),
(529, 'Mainpuri', 34),
(530, 'Unnao', 34),
(531, 'Aligarh', 34),
(532, 'Chitrakoot', 34),
(533, 'Mahamaya Nagar', 34),
(534, 'Mahoba', 34),
(535, 'Sant Ravidas Nagar', 34),
(536, 'Basti', 34),
(537, 'Ghaziabad', 34),
(538, 'Mau', 34),
(539, 'Sant Kabir Nagar', 34),
(540, 'Banda', 34),
(541, 'Gonda', 34),
(542, 'Lalitpur', 34),
(543, 'Saharanpur', 34),
(544, 'Bahraich', 34),
(545, 'Fatehpur', 34),
(546, 'Kanpur Nagar', 34),
(547, 'Pratapgarh', 34),
(548, 'Barabanki', 34),
(549, 'Etawah', 34),
(550, 'Jaunpur District', 34),
(551, 'Mathura', 34),
(552, 'Varanasi', 34),
(553, 'Ambedkar Nagar', 34),
(554, 'Deoria', 34),
(555, 'Jhansi', 34),
(556, 'Mirzapur', 34),
(557, 'Sultanpur', 34),
(558, 'Agra', 34),
(559, 'Bulandshahr', 34),
(560, 'Hamirpur', 34),
(561, 'Meerut', 34),
(562, 'Siddharthnagar', 34),
(563, 'Balrampur', 34),
(564, 'Ghazipur', 34),
(565, 'Lakhimpur Kheri', 34),
(566, 'Sitapur', 34),
(567, 'Bijnor', 34),
(568, 'Faizabad', 34),
(569, 'Kaushambi', 34),
(570, 'Rampur', 34),
(571, 'Badaun', 34),
(572, 'Firozabad', 34),
(573, 'Kanpur Dehat', 34),
(574, 'Muzaffarnagar', 34),
(575, 'Auraiya', 34),
(576, 'Etah', 34),
(577, 'Jalaun', 34),
(578, 'Moradabad', 34),
(579, 'Shravasti', 34),
(580, 'Allahabad', 34),
(581, 'Chandauli', 34),
(582, 'Hardoi', 34),
(583, 'Maharajganj', 34),
(584, 'Sonbhadra', 34),
(585, 'Bareilly', 34),
(586, 'Gorkakhpur', 34),
(587, 'Lucknow', 34),
(588, 'Shahjahanpur', 34),
(589, 'Dakshin Dinajpur', 35),
(590, 'Bankura', 35),
(591, 'Uttar Dinajpur', 35),
(592, 'North 24 Parganas', 35),
(593, 'Midnapore', 35),
(594, 'Cooch Behar', 35),
(595, 'Hooghly', 35),
(596, 'Bardhaman', 35),
(597, 'South 24 Parganas', 35),
(598, 'Murshidabad', 35),
(599, 'Kolkata', 35),
(600, 'Howrah', 35),
(601, 'Darjeeling', 35),
(602, 'Birbhum', 35),
(603, 'Purulia', 35),
(604, 'Nadia', 35),
(605, 'Malda', 35),
(606, 'Jalpaiguri', 35);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ci_sessions`
--

DROP TABLE IF EXISTS `tbl_ci_sessions`;
CREATE TABLE IF NOT EXISTS `tbl_ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_ci_sessions`
--

INSERT INTO `tbl_ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('8585dfdabd91c19bcf186c252231c484', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:12.0) Gecko/20100101 Firefox/12.0', 1374316497, 'a:8:{s:9:"user_data";s:0:"";s:8:"usr_name";s:10:"Aditya Das";s:6:"usr_id";s:1:"3";s:8:"usr_type";s:2:"su";s:15:"usr_prev_ip_add";s:3:"::1";s:17:"usr_last_log_time";s:22:"20-July-13 02:50:05 PM";s:16:"usr_cur_log_time";s:11:"04:04:57 PM";s:9:"logged_in";b:1;}');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_color`
--

DROP TABLE IF EXISTS `tbl_color`;
CREATE TABLE IF NOT EXISTS `tbl_color` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `catg_id` int(10) NOT NULL,
  `value` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `catg_id` (`catg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_color`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_contact`
--

DROP TABLE IF EXISTS `tbl_contact`;
CREATE TABLE IF NOT EXISTS `tbl_contact` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `city_id` int(10) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(50) NOT NULL,
  `fax` varchar(50) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`),
  KEY `city_id` (`city_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_contact`
--

INSERT INTO `tbl_contact` (`id`, `city_id`, `address`, `phone`, `fax`, `mobile`, `email`, `name`, `status`) VALUES
(1, 599, 'Hindusthan National Glass & Industries Limited,\r\n2, Red Cross Place\r\nKolkata - 700001', '+91-33-26000200 / 26000338', '+91-33-26000333', '+91-9903041664', 'sunilsomany@hngil.com', 'Mr. Sunil Somany', 'active'),
(2, 121, 'Hindusthan National Glass & Industries Limited,\r\nBahadhurgarh, Haryana', '+91-1276-221400 / 221438', '+91-1276-221666', '', 'jmnair@hngil.com', 'Mr. M. Jayakrishnan', 'active'),
(4, 332, 'Hindusthan National Glass & Industries Limited,\r\n202, Ackruti Centre Point,\r\n2nd Floor, MIDC, Central Road\r\nAndheri East, Mumbai - 400093', '+91-22-42118800 / 31', '', '+91-9867665080', 'omnanair@hngil.com', 'Mrs. Omana Bhaskaran Nair', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_departments`
--

DROP TABLE IF EXISTS `tbl_departments`;
CREATE TABLE IF NOT EXISTS `tbl_departments` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_departments`
--

INSERT INTO `tbl_departments` (`id`, `name`) VALUES
(1, 'test_dept1'),
(2, 'test_dept2');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_distributors`
--

DROP TABLE IF EXISTS `tbl_distributors`;
CREATE TABLE IF NOT EXISTS `tbl_distributors` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `city_id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`),
  KEY `city_id` (`city_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_distributors`
--

INSERT INTO `tbl_distributors` (`id`, `city_id`, `name`, `contact`, `address`, `status`) VALUES
(2, 2, 'Distributor 1', '', 'Test Address', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feedback`
--

DROP TABLE IF EXISTS `tbl_feedback`;
CREATE TABLE IF NOT EXISTS `tbl_feedback` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `feedback_time` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `feedback` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `tbl_feedback`
--

INSERT INTO `tbl_feedback` (`id`, `feedback_time`, `name`, `email`, `subject`, `feedback`) VALUES
(12, '05-February-13 12:33:41 PM', 'Aditya Das', 'a@gmail.com', 'Test', 'test'),
(13, '05-February-13 12:38:18 PM', 'Aditya Das', 'a@gmail.com', 'Test', 'test'),
(14, '05-February-13 12:38:37 PM', 'Aditya Das', 'a@gmail.com', 'Test', 'test'),
(15, '07-February-13 02:42:04 PM', 'Aditya Das', 'a@gmail.com', 'kk', 'nn'),
(16, '07-February-13 02:42:43 PM', 'Aditya Das', 'a@gmail.com', 'a', 'aa'),
(17, '07-February-13 02:42:56 PM', 'Aditya Das', 'a@gmail.com', 'a', 'aa'),
(18, '07-February-13 02:44:17 PM', 'Aditya Das', 'a@gmail.com', 'a', 'aa'),
(19, '07-February-13 02:46:05 PM', 'Aditya Das', 'a@gmail.com', 'asa', 'as');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_front_menu`
--

DROP TABLE IF EXISTS `tbl_front_menu`;
CREATE TABLE IF NOT EXISTS `tbl_front_menu` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(50) NOT NULL,
  `menu_id` int(10) NOT NULL,
  `page_id` int(10) NOT NULL,
  `sequence` int(10) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `default` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `main_menu_id` (`menu_id`),
  KEY `page_id` (`page_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `tbl_front_menu`
--

INSERT INTO `tbl_front_menu` (`id`, `menu_name`, `menu_id`, `page_id`, `sequence`, `status`, `default`) VALUES
(1, 'HOME', 0, 1, 1, 'active', 1),
(2, 'ROOMS', 0, 2, 2, 'active', 1),
(3, 'FACILITIES', 0, 3, 3, 'active', 1),
(4, 'RESERVATION', 0, 4, 4, 'active', 1),
(5, 'EXCURSIONS', 0, 5, 5, 'active', 1),
(6, 'LOCATION', 0, 6, 6, 'active', 1),
(9, 'CONTACT US', 0, 9, 8, 'active', 1),
(12, 'RATE', 2, 12, 1, 'active', 0),
(13, 'AVAILABILITY', 2, 13, 2, 'active', 0),
(19, 'LOCAL ATTRACTIONS', 5, 19, 1, 'active', 0),
(20, 'TOURIST POINT', 5, 20, 2, 'active', 0),
(21, 'HARIDWAR', 20, 21, 1, 'active', 0),
(22, 'CHILA', 20, 22, 2, 'active', 0),
(23, 'DEHRADUN', 20, 23, 3, 'active', 0),
(24, 'MUSSOORIE', 20, 24, 4, 'active', 0),
(25, 'DHANAULTI', 20, 25, 5, 'active', 0),
(26, 'KUNJA PURI', 20, 26, 6, 'active', 0),
(27, 'NEELKANTH', 20, 27, 7, 'active', 0),
(28, 'SHIVPURI', 20, 28, 8, 'active', 0),
(29, 'BADRINATH', 20, 29, 9, 'active', 0),
(30, 'KEDARNATH', 20, 30, 10, 'active', 0),
(31, 'GANGOTRI', 20, 31, 11, 'active', 0),
(32, 'YAMUNOTRI', 20, 32, 12, 'active', 0),
(33, 'DEVPRAYAG', 20, 33, 13, 'active', 0),
(34, 'PAURI', 20, 34, 14, 'active', 0),
(35, 'AULI', 20, 35, 15, 'active', 0),
(36, 'CHOPTA', 20, 36, 16, 'active', 0),
(37, 'RAM JHOOLA', 19, 37, 1, 'active', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_images`
--

DROP TABLE IF EXISTS `tbl_images`;
CREATE TABLE IF NOT EXISTS `tbl_images` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` enum('PG','IN_PAGE','RM') NOT NULL,
  `ref_id` int(10) NOT NULL,
  `image_name` varchar(50) NOT NULL,
  `title_tag` varchar(50) DEFAULT NULL,
  `alt_tag` varchar(50) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=83 ;

--
-- Dumping data for table `tbl_images`
--

INSERT INTO `tbl_images` (`id`, `type`, `ref_id`, `image_name`, `title_tag`, `alt_tag`, `status`) VALUES
(2, 'PG', 1, '8a35b2fa36464eb3f9cacf17befd51eb.jpg', '', '', 'active'),
(3, 'PG', 1, '7ec67b44437e70e711e1635a5e3f14f2.jpg', '', '', 'active'),
(4, 'PG', 1, 'bdd80c3076727a61f0e7ebf972a4df50.jpg', '', '', 'active'),
(5, 'PG', 14, '40554dbd7e0172ed315249d412ad459b.jpg', '', '', 'active'),
(6, 'PG', 14, 'c44978e2bc36a8cfc4bf229bf6ede432.jpg', NULL, NULL, 'active'),
(7, 'PG', 14, '584110bfc36a187fcddb39c601ba8370.jpg', NULL, NULL, 'active'),
(8, 'PG', 15, '3af570ba1358c0066a7887617f0ad96e.jpg', NULL, NULL, 'active'),
(9, 'PG', 15, '8ffe8c4ede06ec64464eb90dc960b49a.jpg', NULL, NULL, 'active'),
(10, 'PG', 15, '46a3446c05a560d21f47a61a7810cea9.jpg', NULL, NULL, 'active'),
(11, 'PG', 16, '86949b46015a6b3301aa9fad98256e63.jpg', NULL, NULL, 'active'),
(12, 'PG', 16, 'c06a171de683413ddb2b087a712e6347.jpg', NULL, NULL, 'active'),
(13, 'PG', 16, '84fdc4cc324612e39ec181de7d323420.jpg', NULL, NULL, 'active'),
(14, 'PG', 17, 'a58a623c2d48e3e715ce44c79ff36d63.jpg', NULL, NULL, 'active'),
(15, 'PG', 17, '4eae014426730baba6295d784d5b9269.jpg', NULL, NULL, 'active'),
(16, 'PG', 17, '01ca72928112b40d48dc91f6d0827d02.jpg', NULL, NULL, 'active'),
(17, 'PG', 18, '2abd43c5a42d82e301de3477fad63a42.jpg', NULL, NULL, 'active'),
(18, 'PG', 18, 'c5f9cdfb25a3d7f5f3e65fe208af74d6.jpg', NULL, NULL, 'active'),
(19, 'PG', 18, '15282ca230294e2ec45e1af912a0766b.jpg', NULL, NULL, 'active'),
(20, 'PG', 21, '4cbc65f0a4f65a368692289c8088cfb6.jpg', 'Test Title', '', 'active'),
(21, 'PG', 21, 'bd9fb7c7019008bfec5c0c3353ca5413.jpg', NULL, NULL, 'active'),
(22, 'PG', 21, '21ec9cacbf0f388aaee713ac3ba58df7.jpg', NULL, NULL, 'active'),
(23, 'PG', 22, 'f212b474b6d10cb06cd3b2f8c206a25b.jpg', NULL, NULL, 'active'),
(24, 'PG', 22, '189431b4004398daed8089d037d85255.jpg', NULL, NULL, 'active'),
(25, 'PG', 22, '666804cd4fb661461f1f3730e1709de3.jpg', NULL, NULL, 'active'),
(26, 'PG', 23, 'eb2c5107349013ef2eeba6bfa70eb8c6.jpg', NULL, NULL, 'active'),
(27, 'PG', 23, '95e73710a0f83bbd6195a66a4b1586e3.jpg', NULL, NULL, 'active'),
(28, 'PG', 23, '01345bdaedb572641d65c05f953ec6f5.jpg', NULL, NULL, 'active'),
(29, 'PG', 24, '4f53a564e35b425718d0816d5be5ea72.jpg', NULL, NULL, 'active'),
(30, 'PG', 24, 'ffd71ee4a330d6421f76af16bac7511f.jpg', NULL, NULL, 'active'),
(31, 'PG', 24, '3fb8a3a2bc39f34ce271b0806aac5c33.jpg', NULL, NULL, 'active'),
(32, 'PG', 25, '01cdc1e8bd7237578de81e4cd2febf08.jpg', NULL, NULL, 'active'),
(33, 'PG', 25, '111d4d71c6b97803f5a3a2454b2428a7.jpg', NULL, NULL, 'active'),
(34, 'PG', 25, '6b710c03802b43a1fa14123be2692b2e.jpg', NULL, NULL, 'active'),
(35, 'PG', 26, '19221819294a58ef916d649e54a0a142.jpg', NULL, NULL, 'active'),
(36, 'PG', 26, '3e4c14dc3fee39c82a51c270eefe5418.jpg', NULL, NULL, 'active'),
(37, 'PG', 26, 'd7307721b8b73d9fdf76506a30ba0bcb.jpg', NULL, NULL, 'active'),
(38, 'PG', 27, '8c9ae51fa6ecfdd8d3df4855ac195781.jpg', NULL, NULL, 'active'),
(39, 'PG', 27, '3d9342eccd41ba5d3fc821cbeb9eb740.jpg', NULL, NULL, 'active'),
(40, 'PG', 27, '22756caaa0789612ae38d347ca79dbd5.jpg', NULL, NULL, 'active'),
(41, 'PG', 28, 'cdf1526071b46518746a132371cc8683.jpg', '', '', 'active'),
(42, 'PG', 28, '54a1cb46164221be18280830c8fe75f2.jpg', NULL, NULL, 'active'),
(43, 'PG', 28, '40e5f5f253cfe73e4a5862a9ace0745c.jpg', NULL, NULL, 'active'),
(44, 'PG', 29, 'e5c04822ad22e08bbab60bf46dfc06a5.jpg', NULL, NULL, 'active'),
(45, 'PG', 29, 'da95f0052469baf8baa628ab4733c384.jpg', NULL, NULL, 'active'),
(46, 'PG', 29, 'bdaf6606c5a881e88f3bef1024d8eebd.jpg', NULL, NULL, 'active'),
(47, 'PG', 30, 'b826a1326586489547f7650aedeb45c6.jpg', NULL, NULL, 'active'),
(48, 'PG', 30, 'fbcd7182b874d831bbd214bdbeae35a8.jpg', NULL, NULL, 'active'),
(49, 'PG', 30, '2856e83e67f4b1ab01e58f84cb93b70e.jpg', NULL, NULL, 'active'),
(50, 'PG', 32, '13aadb1937399bff3b7d8ae5502fd08b.jpg', NULL, NULL, 'active'),
(51, 'PG', 32, '71d0369c28fd45649ea5b24d4f008cd7.jpg', NULL, NULL, 'active'),
(52, 'PG', 32, '618d17c001c4c2b5cb62a86c040a1ac7.jpg', NULL, NULL, 'active'),
(53, 'PG', 33, '191ec44d1012465165f26aa21a52d5e4.jpg', NULL, NULL, 'active'),
(54, 'PG', 33, '6c4c941fff087e718fea5523db436051.jpg', NULL, NULL, 'active'),
(55, 'PG', 33, '07364c5a8ed5d4bf7e4c51d241cf86a2.jpg', NULL, NULL, 'active'),
(56, 'PG', 34, 'cc5209aaec820092f601b6e4b6f70ec9.jpg', NULL, NULL, 'active'),
(57, 'PG', 34, '231cb3e67acb8ca18f07b82605db9920.jpg', NULL, NULL, 'active'),
(58, 'PG', 34, '4dd4a34f2389a1b78b6a46a61aa4049e.jpg', NULL, NULL, 'active'),
(59, 'PG', 35, '8193251ff554950d40944d8396c1c1cc.jpg', NULL, NULL, 'active'),
(60, 'PG', 35, '6d2b82540d1ceb4dab4d771ddbe3c726.jpg', NULL, NULL, 'active'),
(61, 'PG', 35, 'a77ad071bb57776aa1d556b3c1c76893.jpg', NULL, NULL, 'active'),
(62, 'PG', 36, '9eb1819333baf223717187e9f37444db.jpg', NULL, NULL, 'active'),
(63, 'PG', 36, '9e956114d734fd6a95c8045270d63600.jpg', NULL, NULL, 'active'),
(64, 'PG', 36, '33e0adeabe906a6aa481551847ae9055.jpg', NULL, NULL, 'active'),
(65, 'PG', 31, '44f095f0cc6d7c324210b6d8d41c1f28.jpg', NULL, NULL, 'active'),
(66, 'PG', 31, '1709ff7ab6bcca77e701baf70c9e6205.jpg', NULL, NULL, 'active'),
(67, 'PG', 31, '72c87441c2f0dd5b16ce01e869aa4a82.jpg', NULL, NULL, 'active'),
(79, 'RM', 3, '17fe043f64cc9adbc32946a800c59912.jpg', '', '', 'active'),
(81, 'RM', 3, '36611db39d043e61a89dd2c768b064a1.jpg', NULL, NULL, 'active'),
(82, 'RM', 3, '1085a1ec21b9a51bc55ec3731c5d1ae9.jpg', NULL, NULL, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pages`
--

DROP TABLE IF EXISTS `tbl_pages`;
CREATE TABLE IF NOT EXISTS `tbl_pages` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `head` varchar(50) DEFAULT NULL,
  `content` text,
  `meta_keyword` varchar(255) DEFAULT NULL,
  `latitude` varchar(25) DEFAULT NULL,
  `longitude` varchar(25) DEFAULT NULL,
  `zoom` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `tbl_pages`
--

INSERT INTO `tbl_pages` (`id`, `head`, `content`, `meta_keyword`, `latitude`, `longitude`, `zoom`) VALUES
(1, 'Welcome to Somany Bhawan Guest House', '<div class="row-fluid">\r\n<p>Situated on the Bank of the Maa Ganga, Janki Devi Somany Bhawan Guest House offers all the comforts of home - including home-cooked food. On the outskirts of Rishikesh, rediscover tranquility in the mystical embrace of Himalaya mountains. Enjoy the beautiful gardens, breathtaking view of Rajaji National Park and a dip in cool waters of the holy river Ganga.</p>\r\n</div>\r\n\r\n<div class="row-fluid home" style="margin-top: 15px">\r\n<ul class="thumbnails">\r\n	<li class="span4">\r\n	<div class="thumbnail"><img alt="300x200" class="img-polaroid" data-="" src="http://localhost/somanybhawan/resources/pics/fck_images/thumb_home1.jpg" style="width: 300px; height: 200px;" />\r\n	<div class="caption">\r\n	<h3>Rooms &amp; Rates</h3>\r\n\r\n	<p>Come visit us and check out our lovely Guest House and quaint comfy rooms. Each room is personally decorated.</p>\r\n\r\n	<p><a href="index/rooms">More Info</a></p>\r\n	</div>\r\n	</div>\r\n	</li>\r\n	<li class="span4">\r\n	<div class="thumbnail"><img alt="300x200" class="img-polaroid" data-="" src="http://localhost/somanybhawan/resources/pics/fck_images/thumb_home2.jpg" style="width: 300px; height: 200px;" />\r\n	<div class="caption">\r\n	<h3>Location</h3>\r\n\r\n	<p>Nestled in the heart of the country-side, Somany Bhawan is perfectly located for the weekend break or a leisurely holiday.</p>\r\n\r\n	<p><a href="index/location">More Info</a></p>\r\n	</div>\r\n	</div>\r\n	</li>\r\n	<li class="span4">\r\n	<div class="thumbnail"><img alt="300x200" class="img-polaroid" data-="" src="http://localhost/somanybhawan/resources/pics/fck_images/thumb_home3.jpg" style="width: 300px; height: 200px;" />\r\n	<div class="caption">\r\n	<h3>Excursions</h3>\r\n\r\n	<p>Find a list of personalized local sightseeing tour package and some reachable religiuos &amp; adventurous destinations.</p>\r\n\r\n	<p><a href="index/excursions">More Info</a></p>\r\n	</div>\r\n	</div>\r\n	</li>\r\n</ul>\r\n</div>', '', '', '', 0),
(2, 'Rooms', '<div class="row-fluid">\r\n<ul class="rooms">\r\n	<li>Air Conditioned Room with cable TV.</li>\r\n	<li>Check-in time Is 12:00 P.M and check-out time is 11:00 A.M.</li>\r\n	<li>Seasonal discount is available from 15<sup>th</sup> November to February end.</li>\r\n</ul>\r\n</div>', '', '', '', 0),
(3, 'Facilities & Services', '<div class="row-fluid facl_cont">\r\n<div class="span7 rightborder">\r\n<div class="row-fluid">\r\n<div class="span12">\r\n<h3>Facilities</h3>\r\n</div>\r\n</div>\r\n\r\n<div class="row-fluid paddrow">\r\n<div class="span4"><img alt="200 X 150" class="img-polaroid" data-="" src="http://localhost/somanybhawan/resources/pics/fck_images/thumb_home1.jpg" style="width: 200px; height: 150px;" /></div>\r\n\r\n<div class="span8">\r\n<ul class="facilities">\r\n	<li>Air Conditioned Rooms</li>\r\n	<li>Telephone in all Rooms</li>\r\n	<li>Cable T.V. in all Rooms</li>\r\n	<li>Attached Bathroom with Hot &amp; Cold Running Water</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n</div>\r\n</div>\r\n\r\n<div class="row-fluid paddrow">\r\n<div class="span4"><img alt="200 X 150" class="img-polaroid" data-="" src="http://localhost/somanybhawan/resources/pics/fck_images/thumb_facl2.jpg" style="width: 200px; height: 150px;" /></div>\r\n\r\n<div class="span8">\r\n<ul class="facilities">\r\n	<li>Home Cooked Food in Dining Hall(served on prior notice within schedule time only).</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n</div>\r\n</div>\r\n\r\n<div class="row-fluid paddrow">\r\n<div class="span4"><img alt="200 X 150" class="img-polaroid" data-="" src="http://localhost/somanybhawan/resources/pics/fck_images/thumb_facl1.jpg" style="width: 200px; height: 150px;" /></div>\r\n\r\n<div class="span8">\r\n<ul class="facilities">\r\n	<li>Panoramic View of Rajaji National Park from Attached Bathing Ghat on the Ganga.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n</div>\r\n</div>\r\n\r\n<div class="row-fluid paddrow">\r\n<div class="span4"><img alt="200 X 150" class="img-polaroid" data-="" src="http://localhost/somanybhawan/resources/pics/fck_images/thumb_facl3.jpg" style="width: 200px; height: 150px;" /></div>\r\n\r\n<div class="span8">\r\n<ul class="facilities">\r\n	<li>Travel Arrangements Bookings can be made for Car Rentals, Trekking, White Water Rafting, Sightseeing, Tours.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class="span5">\r\n<div class="row-fluid">\r\n<div class="span12">\r\n<h3>Services</h3>\r\n</div>\r\n</div>\r\n\r\n<div class="row-fluid paddrow">\r\n<div class="span12">\r\n<ul class="facilities">\r\n	<li>Arrival/departure point transfers (Extra charge)</li>\r\n	<li>Daily Housekeeping</li>\r\n	<li>Doctor/Nurse on call</li>\r\n	<li>Dry Cleaning</li>\r\n	<li>Foreign Currency Exchange</li>\r\n	<li>Laundry/Ironing</li>\r\n	<li>Room Service</li>\r\n	<li>Vehicle Hire/Car Rental Onsite</li>\r\n	<li>Local sightseeing can be arranged</li>\r\n</ul>\r\n</div>\r\n</div>\r\n</div>\r\n</div>', '', '', '', 0),
(4, 'Reservation', '<div class="row-fluid">\r\n<p>After confirmation of availability of rooms you may deposit full amount in any AXIS Bank mentioning Rishikesh-A/c No-156010100025638, in the name of &quot;JANKI DEVI SOMANY CHARITY TRUST&quot; and Fax to us.</p>\r\n</div>', '', '', '', 0),
(5, 'Excursions', '<p>There are few wonderful excursions that you can enjoy during your holidays in Rishikesh. Popular tourist destinations excursions places situated near Rishikesh are as follows.</p>', '', '', '', 0),
(6, 'Location', '<p>234, Ganga Vihar, Koyal Ghati, Rishikesh - 249201</p>', '', '', '', 0),
(7, 'CAREERS', NULL, NULL, '', '', 0),
(8, 'SALES NETWORK', NULL, NULL, '', '', 0),
(9, 'Contact Us', '<p><span style="color:#666666;"><span style="font-size: 14px;"><span style="font-family: verdana,geneva,sans-serif;"><strong>Janki Devi Somany Bhawan Guest House<br />\r\n<u>234, Ganga Vihar, Koyal Ghati, Rishikesh - 249201</u></strong></span></span></span></p>\r\n\r\n<p><span style="font-size:12px;"><span style="font-family: verdana,geneva,sans-serif;"><strong>Tel:</strong> </span></span><span style="font-family: verdana,geneva,sans-serif;">+91-135-2433976 / 2120200</span>&nbsp;</p>\r\n\r\n<p><strong>Mob:</strong> +91-9359191644 (Mr. Dinesh Mantry)</p>\r\n\r\n<p><span style="font-size:12px;"><span style="font-family: verdana,geneva,sans-serif;"><strong>Mob:</strong> +91-9897930425</span></span> (<span style="font-size:12px;"><span style="font-family: verdana,geneva,sans-serif;">Mr. Vijay)</span></span></p>', 'Test Meta', '', '', 0),
(12, 'Rates', '<p>Select any room category to check rooms in that category and their rates.</p>', '', '', '', 0),
(13, 'Availability', '', '', '', '', 0),
(19, 'Local Attractions', '', '', '', '', 0),
(20, 'Tourist Point', '', '', '', '', 0),
(21, 'Haridwar', '<p>Haridwar is situated at the base of the Shivalik hills, where the Ganga, comes down from the mighty Himalayas meets the plains. Haridwar, literally is &#39;The gateway to the Gods&#39;. &quot;This place is very beautiful&quot;, at one sight one will say so and fall in love with the scenic beauty of the blend of height and plains. A Gateway to the four pilgrimage of Uttarakhand, Haridwar is also known as Gangadwar, Tapovan and Mayapuri. In its long history back to pre-historic time, the Haridwar got it name from the rishis. According to the mythology it is known as Kapilsthan. legend goes that the suryavnshi Prince Bhagirath performed penance here to salvage the souls of his ancestors who had perished due to the curse of the sage Kapila. The penance was answered and the river Ganga trickled forth from Lord Shiva&#39;s locks and its bountiful waters revived the sixty thousand sons of King Sagara. Mythologically, drops of nectar churned out from the primordial ocean fell at the four sites of the Kumbh mela including Haridwar. The kumbha mela, happening once every 12 years and the Ardha Kumbha Mela (Coming once every six years) are big draws. One of the oldest living cities, Hairdwar has been in people&#39;s mind from the period of Buddha to the British advent and now even is the 21st century. Besides being a religious place, it has served as the center for learning arts, science and culture.</p>', '', '29.945691', '78.164248', 15),
(22, 'Chila', '<p>Chila wildlife sanctuary, a haven for animal watchers is just 8 kms. from Haridwar and 21 kms. from Rishikesh. Located on the banks of the Ganga river in the heart of Shivalik hills, Chila is a part of the famous Rajaji National Park. The fauna species include elephants, spotted deer, stag deer, blue bull, wild boar, fox, porcupine, jungle fowls and peacocks. Beside these, migratory birds are also seen on the river Ganga. Wild animal/bird watching and photography on elephant back is a special interest. Pleasure walks in the jungle. Picnic at Chila beach (1.5 kms.).</p>', '', '29.967703', '78.224491', 14),
(23, 'Dehradun', '<p>This old centre of the Raj is situated in the broad Doon Valley between the Siwaliks and the front range of the Himalya. Dehra Dun is at the centre of a forest area and the Forest Research Institute is here. The town is a major academic and research centre and a base for the Indian Military Academy and the Survey of India. There are also several prestigious boarding schools including the Doon School, India&#39;s most exclusive private school. Dehradun takes its name from the Hindi words, dera, which means camp, and dun, valley. Famous for its educational institutions, the town has one of the largest railway terminuses in North India. According to a legend, Lord Shiva, the Hindu Destroyer of the Universe, stomped his foot in anger in the Dun valley. Another lore has it that Lord Rama and his brother, Laxmana, did penance here after killing Ravana, the King of Lanka . During their exile, the five Pandavas lived in the Dun valley for a short while. A rock inscription near Kalsi has led historians to believe that Emperor Ashoka ruled over the area in the 4th century b.c.</p>', '', '30.316495', '78.032192', 16),
(24, 'Mussoorie', '<p>Mussoorie, located some 250 miles north of Delhi, capital of India, is among the most popular hill stations of India, and is called the Queen among the hill stations. It overlooks the sprawling Doon valley and the city of Dehradun, the gateway to Mussoorie and infact to the entire Garhwal.Mussoorie, a hill resort at a height of around 7000 ft above the sea level, straddles a ridge in the Garhwal Himalayas &ndash; a region which is developing into a major tourism destination. The holy and mighty river Ganga is visible from one end of the ridge and another famous river Jamuna from the other, a stretch of around twelve miles in all, from Cloud&rsquo;s end in the west to Jabarkhet in the east.Although Mussoorie, as a hill station was established only as back as in 1823, it has quite an intriguing past. Mussoorie was never an official summer capital unlike Simla &ndash; a hill station in the state of Himachal pradesh which was the summer capital of the British Indian government and even unlike Nainital &ndash; the summer capital of the united provinces government in British India. Mussoorie always remained unofficial &ndash; for the affairs of heart. It has always been a gossipy place &ndash; with an air of informality and a tradition of romance &ndash; The Honeymoon capital of India.</p>', '', '30.455339', '78.074046', 16),
(25, 'Dhanaulti', '<p>Amidst the oak, deodar and rhododendrons, in the Tehri Garhwal district of Uttarakhand, is the town of Dhanaulti. It is situated at a height of 2286 metres above sea level and is close to the hill stations of Mussourie (24 km) and Chamba (29 km). This hill station is visited by most tourists during the summer season. With abundant deodar trees, the newly created Eco Park is a popular tourist spot. The region is full of sightseeing places and excursions which include visits to potato farms, Chamba, Surkanda Devi Temple and to Mussourie. The hilly terrain provides a unique opportunity for trekking, mountain climbing and camping. Dhanaulti is linked to the major towns in north India such as Delhi and Dehradun, where airports are located. Dehradun is the closest town where a large number of accommodation options are available. The destination can also be reached by road through the Mussourie Chamba road. In summers, the hilly areas of Dhanaulti are cool while the cold winters experience snowfall. There is a continuous drizzle during the rainy season from July to September and the mist and fog cover the hill tops. During the Dussehra festival, tourists can indulge in the Surkhananda Devi fair, which is the time of worship of goddess Durga.</p>', '', '30.424227', '78.245835', 15),
(26, 'Kunjapuri', '<p>Kunjapuri is the name given to a peak having an altitude of about 1,676 m. It lies in Lat. 30`11` N. and Long. 78`20` E., about 93 km. from Devaprayag and 7 km. from Narendra Nagar. It commands a beautiful view of the snow-ranges of the Himalayas and of the valley of the Bhagirathi. It contains an old temple dedicated to the goddess Kunjapuri Devi which is visited by a number of people every year. Nearby, in Agarakhal, there is a dak bungalow situated in picturesque surroundings and maitnained by the public works department. Kunjapuri is said to be one of the sidddhapeeths established in the region by Jagadguru Shankaracharya and legend has it that the upper-half of the body of Sati, wife of Siva, fell here when Siva was carrying it to Kailash after Sati had flung herself in the yajna fires when some derogatory remarks were made about her husband by her father Daksha</p>', '', '30.17409', '78.313317', 17),
(27, 'Neelkanth', '<p>The journey from Haridwar to Neelkanth Mahadev leads the tourists to a breathtaking scenic location. Being located 40 km away from Haridwar, Neelkanth Mahadev has an elevation of 1675 m above sea level. The two perennial rivers of Pankaja and Madhumati intersect the immensely rich religious site of Neelkanth Mahadev. Surrounded by Manikoot, Brahmakoot and Vishnukoot valleys, Neelkanth Mahadev is visited by thousands of pilgrims every year. The temple of Neelkanth Mahadev is the prime appeal of the place which is associated with a significant mythological event. In the Hindu mythology Sagar Manthan holds a special place. This is due to the fact that during the churning of the seas Lord Shiva, who is also known as Mahadeva, drank the entire venom. Immediately after this event Lord Shiva&#39;s neck turned blue. The Neelkanth Mahadev Temple is believed to be the very place where this incident took place in the ancient era. The term Neelkanth denotes the blue neck and to pay respect to Mahadeva the place was named after him. People from all corners of the world come to Neelkanth Mahadev Temple to offer their prayers. Apart from being an important choice of religious tours from Haridwar, Neelkanth Mahadev also offers exciting trekking opportunities. From Rishikesh, Neelkanth Mahadev can be reached by covering a distance of about 32 km. The trekking route from Rishikesh to Neelkanth Mahadev surely enchants the adventurous tourists. It is a common belief of the pilgrims that visiting the Neelkanth Mahadev shrine near Haridwar would definitely fulfill all their wishes.</p>', '', '30.080744', '78.340963', 16),
(28, 'Shivpuri', '<p>Shivpuri, in north Madhya Pradesh, was once the summer capital of the Scindias of Gwalior. The impassable forests of this historic town were the hunting grounds of the Mughal emperors. Shivpuri, though bears a modern look, the glimpses of its royal heritage hangs all around the city. Remnants of ancient mansions, magnificient palaces, hunting lodges and the royal streets give a majestic look to the surroundings. The rolling hills and the pleasant climate of Shivpuri makes it as a fast emerging tourist destination. Magnificient royal mansions with Victorian style architecture, majestic hills, palaces, lustrous greenery, Shivpuri is a picniker&rsquo;s delight. Exquisite royal palaces of Shivpuri with its glittering whiteness present an eye-catching spectacle to the viewer. Shivpuri is surrounded by deep woody forest that is the treasure houses of rich flora and fauna. An adventurous trip through the wilderness of the jungle paths is indeed very challenging. The renowned wildlife sanctuaries that preserve the endangered animal and bird species add special charm to Shivpuri&rsquo;s natural beauty. Adventure lovers can opt for short trips through the challenging paths, amidst of lush vegetation that provides fabulous views of a ruined fort, three Hindu temples, and a monastery. With its lustrous forest, undulating hills, Shivpuri has now attained the glory of a effervescent, buoyant tourist destination. Shivpuri is a recommended place for those tourists who love to spend their leisure time in the silence of nature. Today, Shivpuri is a favourite destination for history buffs and nature lovers.</p>', '', '30.137807', '78.394479', 16),
(29, 'Badrinath', '<p>Situated 297 kms from the holy town of Rishikesh and about 600 kms from Delhi, Badrinath lies at an elevation of 3,133 m. Considered to be amongst the most pious of the eternal Hindu shrines of Kedarnath, Badrinath, Gangotri and Yamunotri. Badrinath is located in the lap of Nar-Narayan Parvat, with the Neelkanth peak(6,597m) overlooking in the background. It is to the credit of Adi Guru Shankaracharya, who in order to revive the lost prestige of Hinduism and to unite the country in one bond, built four dhamas or pilgrimage centers in four corners of the country. Badrinath temple, dedicated to Lord Vishnu, is located on the right bank of river Alaknanda, perched at an altitude of over 3000m in the middle of a valley full with scenic beauty. whether someone agrees or not, it has been said that &quot;there were many sacred spots of pilgrimage in heaven, earth and the other world, but neither is any equal to Badrinath nor shall there be one&quot;. Even minus this religious claim, Badrinath has some scintillating scenic beauty and rare recreational spots in the vicinity. Indeed, an universal attraction. The present temple was built about two centuries ago by the kings of Garhwal. The principal idol in the temple is of black stone and represents Vishnu seated in a meditative pose, and flanked by Nara-Narayan. Badrinath is also known as Vishal Badri and is one of the Panch Badris. The temple remains closed from October to April due to severe winter conditions. During this period the idols of Utsavo Murti are taken to Pandukeshwar. It is said that &quot;There are many sacred spots of pilgrimage in the heavens, earth and the nether world, but there has been none equal to Badri, nor shall there be&quot;.</p>', '', '30.744710', '79.490601', 16),
(30, 'Kedarnath', '<p>Kedarnath is the most important Hindu shrine in Himalayas, and among the major Shiva temples, of the country. Located at the source of the river Mandakini, Kedarnath is one of the twelve Jyothirlingas, of Lord Shiva, and one of the Panch Kedars. Mythology identifies the deity at Kedarnath temple, with the rump of a bull, a form assumed by Lord Shiva, when eluding the Pandavas, who had come for repentance for killing their kith and kin, in the great battle of Kurukshetra. It is believed that the temple of Kedarnath, was constructed by the Pandavas. At the entrance of the temple, is the statue of Nandi, the divine bull of Shiva. The wall inside the temple, is exquisitely carved with images, and the temple houses a shiva lingam, which is worshipped by hordes of pilgrims. At the approach of winters in the month of November, the holy statue of Lord Shiva, is carried down from Garhwal (Kedarkhand) to Ukhimath, and is reinstated at Kedarnath, in the first week of May. It is at this time, that the doors of the temple are thrown open to pilgrims, who flock from all parts of India, for a holy pilgrimage. Legends notwithstanding, the shrine of Kedarnath is very scenically placed, and is surrounded by lofty, snow - covered mountains, and grassy meadows covering the valleys. Immediately behind the temple, is the high Keadardome peak, which can be sighted from great distances. The sight of the temple and the peak with its perpetual snows is, simply, an enthralling sight.</p>', '', '30.797501', '79.067497', 11),
(31, 'Gangotri', '<p>One of the main religious places among the four Char Dham pilgrimage areas, Gangotri, situated in Uttarkashi, is closely related to Goddess Ganga, the river that we know as Ganges. The history of Gangotri dates back to centuries when Goddess Ganga transformed herself into a river to dissolve the sins of King Bhagirath&rsquo;s forefathers, following his penance. In order to reduce the impact of her fall, Lord Shiva gathered Ganga into his matted locks and has ever since been associated with Goddess Ganga. The Gangotri Temple was built by a Gorkha Commander in the early years of the 18th century. This temple stands at an altitude of 3042m and emits a highly pious aura. Religious rituals are in full swing in the Gangotri temple with the Arti ceremony performed by the pujaris of the Semwal family. The river Ganga originates from the Gangotri glacier and is known as Bhagirathi. The name Ganga picks up later on after the river passes Devaprayag and merges into the river Alaknanda. Just the perfect destination to breath in a serene and pious atmosphere, Gangotri has the charm to attract people from all over. The striking presence of the snow-clad mountains in the vicinity and the pure crystal clear water of the Ganges flowing around add to the sanctity of the place. One feels close to God in the high altitude of Gangotri. Vegan food dominates the culture and is available in the local food joints or dhabas. Non-vegetarian food and alcoholic drinks are a strict no-no.</p>', '', '31.000156', '78.915083', 11),
(32, 'Yamunotri', '<p>Situated amidst the Garhwal Himalayas, Yamunotri in the state of Uttar Pradesh is naturally bestowed with abundant beauty and charm. At a hovering altitude of 3293 meters, Yamunotri lies adjacent to the Indo-Chinese border and is encircled by the lofty peaks on all sides. One of the holiest centers in the Hindu pantheon, this sacred abode of the Asti muni boast of so many unparallel vistas of nature. Highly revered as the origin of the majestic River Yamuna, Yamunotri is famed for its glaciers, and thermal springs that makes it one of the most important stopovers in the schedule of a Hindu pilgrim. According to Hindu tradition, Yamuna is the sister of Yama, the god of death and a holy dip in this river secures a painless death to the devotee. A thrilling and exhilarating location in the footsteps of Garhwal mountain ranges, Yamunotri proffers picturesque surroundings with the awesome shrubs, lush meadows and gushing cascades. A legendary place, which demands lots of courage and stamina to reach, Yamunotri would be a perfect place for those who love escapades. The trek to Yamunotri is magnificent, subjugated by mind stilling views of craggy peaks and intense forests. From the snow-clad summits to the turquoise lakes, Yamunothri has unbelievably romantic allures on store for those who are young at heart. Its imposing walking trails beside the gushing streams presents some of the spectacular moments that one could never forget. Apart from all, this snowy abode of Yamuna is a wildlife enthusiast dream destination.</p>', '', '30.996866', '78.461653', 11),
(33, 'Devprayag', '<p>The town of Devprayag is located in the Indian state of Uttarakhand. This region is a hotspot for pilgrims, as the entire place is considered very sacred and holy by Hindus. The town is located in a region which serves as a junction for the rivers Bhagirathi and Alaknanda. The beautiful town is also a hit among tourists, who find solace it its very picturesque and green surroundings and visit the many temples there to get a taste of the local culture. There are many places of interest that you can visit during your trip to Devprayag. The Dasharathachal Peak is one of these, and this peak is by far the most popular tourist spot in the region. A stream runs down this peak too, and this is an ideal place to enjoy some quiet times with your close ones. You can also visit the Chandrabadani temple during your trip to the town of Devprayag. This temple is an important location for pilgrims, and it is located at a distance of around twenty two kilometres from the town. Many ancient idols can be seen in this temple, and it will be jam packed during the festival seasons. The Raghunathji temple in Devprayag is also an important temple that you can visit. There are also temples dedicated to Garuda, Annapurna Devi and Hanuman.</p>', '', '30.145947', '78.599293', 15),
(34, 'Pauri', '<p>A panoramic location on the northern slopes of Kandoliya hills, Pauri in the Indian state of Uttaranchal is a virtual paradise on earth. The splendid view of the looming mountains of Himalayas and the woody forests with multitudes of lofty trees bestows a miraculous appeal to this land. Pauri is a land of undeclared time off. Its eternal monologue of mountains proffers wonderful probabilities for nice treks and assorted activities. Situated in a sylvan surroundings, Pauri is largely considered as a murky place by the recluse. In fact, it is a perfect retreat for those who fancy to flee off from the annoying crowd of the popular hilly resorts of the Gharwal region. The terra firma of Pauri is sanctified with impressive view of snowy peaks of Himalayas, charming valleys, tortuous rivers, intense forests and cordial people with rich traditions. Pauri proffers a diverse topography that varies from the foothills of the &lsquo;Bhabar&rsquo; to the mind stilling paddocks of Dhudatoli. The majestic beauty of Himalayas in its muddle of wilds, the deep woods of odorous pines and deodars, blossoming rhododendrons along with rich flora and fauna, Pauri is spectacular in every way. Though its magnificent walkways never find its space in any of the tourism maps, the uphill and downhill stroll through the winding trails is simply superb, the joy of which could be exhilarating. Fairs and festivals in Pauri have a religious and mythological fervor. Among the prominent fiestas, Bhandara, Uttarayni and Sharadotsav are the unique festivals of this holy town which are celebrated with lots of cultural and recreational activities. If you want to enjoy the scenic look of the snow-covered hills and the chill weather, Pauri would be the preferable destination. Discover the splendor of Himalayas while retreating in a soothing environ of lush greenery.</p>', '', '29.868768', '78.838264', 15),
(35, 'Auli', '<p>Auli in the Indian state of Uttarakhand is renowned for the fascinating ski resorts and stunning natural vistas. Bounded by the snowy peaks of the mighty Himalayas, this hilly terrain offers the enchanting sceneries of oak fringed slopes and coniferous forests. At an average height of 2800 meters, this might be the single spot where the visitors would get the unusual opportunity of a nice promenade. Walking through the misty slope provides one with the imposing spectacles of some of the lofty mountain ranges like Nanda Devi, Mana Paravat and Kamat Kamet. Besides these snowy miracles, the boulevards through the slopes offers marvelous views of gorgeous apple orchards and fine deodar trees, which make ones morning, stride a precious experience. Auli proffers a credible past that dates back to the 8th century. It is believed that this pretty locale is blessed with the sacred visit of Sankaracharya. As a toddler in the tourism arena, Auli proffers an unspoiled ambiance. The harsh frosty storms, the sylvan peaks and the long stretch of snowy valleys would make idyllic surroundings for a skier. Aptly called as the haven for skiing activities, this hilly resort is turned to be the only tourist destination where skiing is the most sought after past time. The erstwhile training ground of the Indo-Tibetan Police Force, Auli has gained the status of a popular hill resort within a short span of time. The sheer inclines of Auli are a hot spot of courageous men who dare to explore the demanding environs. The snowcapped mountain ranges, the screech of the winds and the entertaining skiing, Auli is bestowed with all that is enough to thrill the onlookers. The nature at its full bloom gives a feeling of an awe inspiring time, which cannot be wiped out from our wildest dreams.</p>', '', '30.528889', '79.570278', 12),
(36, 'Chopta', '<p>Chopta is a small settlement and valley that is located in the Indian state of Uttarakhand. This region is very popular among tourists, mainly because of the number of options it provides for exploring. The entire region is a haven of beauty, and the ones among you who are looking for a good place to relax, without the hustle and bustle of a typical tourist hotspot can visit Chopta valley and gaze in awe at the many peaks located a short distance away from the valley. The valley is a great place for adventure buffs and trekking enthusiasts, because trekking is a popular activity in the valley. During your trip to Chopta valley, you can take a trek to the nearby region of Deori Tal. Deori Tal is a very famous lake that is surrounded entirely by forests on all sides. This lake lies under the Chukhumba peak, and a trek to this lake can be taken provided you receive proper services from a guide in the region. You can stay near the lake for as long as you want to as many tourists camp out here. You can also take a trek to the temple in Tungnath. This trek can be easily completed without any guidance, as the roads to this temple are well paved and set. The temple at Tungnath is located at an altitude of 3660 metres.</p>', '', '30.352550', '79.046143', 15),
(37, 'Ram Jhoola', '', '', '30.123218', '78.314501', 15);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_range`
--

DROP TABLE IF EXISTS `tbl_range`;
CREATE TABLE IF NOT EXISTS `tbl_range` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `catg_id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `desc` text NOT NULL,
  `status` enum('ACTV','INACTV') NOT NULL DEFAULT 'ACTV',
  PRIMARY KEY (`id`),
  KEY `catg_id` (`catg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_range`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_rooms`
--

DROP TABLE IF EXISTS `tbl_rooms`;
CREATE TABLE IF NOT EXISTS `tbl_rooms` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `room_catg_id` int(10) NOT NULL,
  `room_no` varchar(50) NOT NULL,
  `floor_no` int(10) NOT NULL DEFAULT '0',
  `description` text,
  `ses_donation` int(10) NOT NULL DEFAULT '0',
  `off_ses_donation` int(10) NOT NULL DEFAULT '0',
  `maintenance` int(10) NOT NULL DEFAULT '0',
  `single_bed` int(10) NOT NULL DEFAULT '0',
  `double_bed` int(10) NOT NULL DEFAULT '0',
  `sofa_cum_bed` int(10) NOT NULL DEFAULT '0',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`),
  KEY `room_catg_id` (`room_catg_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_rooms`
--

INSERT INTO `tbl_rooms` (`id`, `room_catg_id`, `room_no`, `floor_no`, `description`, `ses_donation`, `off_ses_donation`, `maintenance`, `single_bed`, `double_bed`, `sofa_cum_bed`, `status`) VALUES
(4, 3, '125', 2, '<p>test</p>', 650, 450, 100, 1, 1, 0, 'active'),
(5, 5, '3', 0, '', 500, 350, 75, 0, 1, 0, 'active'),
(6, 5, '5', 0, '', 800, 600, 175, 0, 1, 0, 'active'),
(7, 5, '102', 1, '', 1200, 1000, 275, 0, 1, 0, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rooms_cancellation`
--

DROP TABLE IF EXISTS `tbl_rooms_cancellation`;
CREATE TABLE IF NOT EXISTS `tbl_rooms_cancellation` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `cancl_req_date` varchar(50) NOT NULL,
  `cancl_requester_id` int(10) NOT NULL,
  `booking_id` varchar(25) NOT NULL,
  `rooms` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_rooms_cancellation`
--

INSERT INTO `tbl_rooms_cancellation` (`id`, `cancl_req_date`, `cancl_requester_id`, `booking_id`, `rooms`) VALUES
(1, '15 February 2013', 3, '15022013112814', '5|102');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rooms_catg`
--

DROP TABLE IF EXISTS `tbl_rooms_catg`;
CREATE TABLE IF NOT EXISTS `tbl_rooms_catg` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbl_rooms_catg`
--

INSERT INTO `tbl_rooms_catg` (`id`, `name`, `description`, `status`) VALUES
(3, 'Ganga Darshan Suite (for 3 persons)', '', 'active'),
(4, 'Deluxe Suite (for 3 persons)', '', 'active'),
(5, 'Family Rooms (for 2 persons)', '', 'active'),
(6, 'Family Rooms (for 3 persons)', '', 'active'),
(7, 'Family Rooms (for 4 persons)', '', 'active'),
(8, 'Family Rooms (for 5 persons)', '', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rooms_reservation`
--

DROP TABLE IF EXISTS `tbl_rooms_reservation`;
CREATE TABLE IF NOT EXISTS `tbl_rooms_reservation` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `booking_code` varchar(25) NOT NULL,
  `bookby_userid` int(10) NOT NULL,
  `booking_date` varchar(50) NOT NULL,
  `book_start_date` varchar(50) NOT NULL,
  `book_end_date` varchar(50) NOT NULL,
  `room_no` varchar(15) NOT NULL,
  `charge_type` enum('sess','offsess') NOT NULL DEFAULT 'sess',
  `room_charge` int(10) NOT NULL DEFAULT '0',
  `guest_name` varchar(100) DEFAULT NULL,
  `guest_add1` text,
  `guest_add2` text,
  `guest_country_id` int(10) DEFAULT NULL,
  `guest_phone` varchar(20) DEFAULT NULL,
  `guest_mobile` varchar(20) DEFAULT NULL,
  `guest_email` varchar(100) DEFAULT NULL,
  `receipt_no` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `tbl_rooms_reservation`
--

INSERT INTO `tbl_rooms_reservation` (`id`, `booking_code`, `bookby_userid`, `booking_date`, `book_start_date`, `book_end_date`, `room_no`, `charge_type`, `room_charge`, `guest_name`, `guest_add1`, `guest_add2`, `guest_country_id`, `guest_phone`, `guest_mobile`, `guest_email`, `receipt_no`) VALUES
(40, '15022013112814', 3, '15 February 2013', '15 February 2013', '15 February 2013', '5', 'sess', 975, 'sdsd', 'vbvb', '', NULL, '877878', '66556', 'a@gmail.com', 'dsd22'),
(41, '15022013112814', 3, '15 February 2013', '15 February 2013', '15 February 2013', '102', 'sess', 1475, 'sdsd', 'vbvb', '', NULL, '877878', '66556', 'a@gmail.com', 'dsd22');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_site_config`
--

DROP TABLE IF EXISTS `tbl_site_config`;
CREATE TABLE IF NOT EXISTS `tbl_site_config` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `site_title` varchar(100) NOT NULL,
  `meta_keyword` varchar(255) NOT NULL,
  `meta_desc` varchar(255) NOT NULL,
  `google_analytic` text NOT NULL,
  `contact_mail` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_site_config`
--

INSERT INTO `tbl_site_config` (`id`, `site_title`, `meta_keyword`, `meta_desc`, `google_analytic`, `contact_mail`) VALUES
(2, 'Janki Devi Somany Bhawan', 'Global Meta', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_states`
--

DROP TABLE IF EXISTS `tbl_states`;
CREATE TABLE IF NOT EXISTS `tbl_states` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `tbl_states`
--

INSERT INTO `tbl_states` (`id`, `name`) VALUES
(1, 'Andaman and Nicobar'),
(2, 'Andhra Pradesh'),
(3, 'Arunachal Pradesh'),
(4, 'Assam'),
(5, 'Bihar'),
(6, 'Chandigarh'),
(7, 'Chhattisgarh'),
(8, 'Dadra and Nagar Haveli'),
(9, 'Daman and Diu'),
(10, 'Delhi'),
(11, 'Goa'),
(12, 'Gujarat'),
(13, 'Haryana'),
(14, 'Himachal Pradesh'),
(15, 'Jammu and Kashmir'),
(16, 'Jharkhand'),
(17, 'Karnataka'),
(18, 'Kerala'),
(19, 'Lakshadweep'),
(20, 'Madhya Pradesh'),
(21, 'Maharashtra'),
(22, 'Manipur'),
(23, 'Meghalaya'),
(24, 'Mizoram'),
(25, 'Nagaland'),
(26, 'Orissa'),
(27, 'Puducherry'),
(28, 'Punjab'),
(29, 'Rajasthan'),
(30, 'Sikkim'),
(31, 'Tamil Nadu'),
(32, 'Tripura'),
(33, 'Uttarakhand'),
(34, 'Uttar Pradesh'),
(35, 'West Bengal');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `pswd` varchar(70) NOT NULL,
  `email` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `last_log_time` varchar(100) DEFAULT NULL,
  `prev_ip_add` varchar(15) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `type` enum('su','admin') NOT NULL DEFAULT 'admin',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `pswd`, `email`, `name`, `last_log_time`, `prev_ip_add`, `status`, `type`) VALUES
(2, 'e10adc3949ba59abbe56e057f20f883e', 'test@gmail.com', 'Test Admin', '31-January-13 08:52:39 AM', '127.0.0.1', 'active', 'admin'),
(3, '613d3b9c91e9445abaeca02f2342e5a6', 'su@test.com', 'Aditya Das', '20-July-13 04:04:57 PM', '::1', 'active', 'su');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_variant`
--

DROP TABLE IF EXISTS `tbl_variant`;
CREATE TABLE IF NOT EXISTS `tbl_variant` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `catg_id` int(10) NOT NULL,
  `desc` text NOT NULL,
  `status` enum('ACTV','INACTV') NOT NULL DEFAULT 'ACTV',
  PRIMARY KEY (`id`),
  KEY `catg_id` (`catg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_variant`
--


--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_addt_contents`
--
ALTER TABLE `tbl_addt_contents`
  ADD CONSTRAINT `tbl_addt_contents_ibfk_1` FOREIGN KEY (`page_id`) REFERENCES `tbl_pages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_admin_rights`
--
ALTER TABLE `tbl_admin_rights`
  ADD CONSTRAINT `tbl_admin_rights_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_admin_rights_ibfk_3` FOREIGN KEY (`permt_menu_id`) REFERENCES `tbl_admin_menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_careers`
--
ALTER TABLE `tbl_careers`
  ADD CONSTRAINT `tbl_careers_ibfk_3` FOREIGN KEY (`city_id`) REFERENCES `tbl_cities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_careers_ibfk_4` FOREIGN KEY (`dept_id`) REFERENCES `tbl_departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_cities`
--
ALTER TABLE `tbl_cities`
  ADD CONSTRAINT `tbl_cities_ibfk_1` FOREIGN KEY (`state_id`) REFERENCES `tbl_states` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_color`
--
ALTER TABLE `tbl_color`
  ADD CONSTRAINT `tbl_color_ibfk_1` FOREIGN KEY (`catg_id`) REFERENCES `tbl_catg_subcatg` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_contact`
--
ALTER TABLE `tbl_contact`
  ADD CONSTRAINT `tbl_contact_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `tbl_cities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_distributors`
--
ALTER TABLE `tbl_distributors`
  ADD CONSTRAINT `tbl_distributors_ibfk_2` FOREIGN KEY (`city_id`) REFERENCES `tbl_cities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_front_menu`
--
ALTER TABLE `tbl_front_menu`
  ADD CONSTRAINT `tbl_front_menu_ibfk_2` FOREIGN KEY (`page_id`) REFERENCES `tbl_pages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_range`
--
ALTER TABLE `tbl_range`
  ADD CONSTRAINT `tbl_range_ibfk_1` FOREIGN KEY (`catg_id`) REFERENCES `tbl_catg_subcatg` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_rooms`
--
ALTER TABLE `tbl_rooms`
  ADD CONSTRAINT `tbl_rooms_ibfk_1` FOREIGN KEY (`room_catg_id`) REFERENCES `tbl_rooms_catg` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_variant`
--
ALTER TABLE `tbl_variant`
  ADD CONSTRAINT `tbl_variant_ibfk_1` FOREIGN KEY (`catg_id`) REFERENCES `tbl_catg_subcatg` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
