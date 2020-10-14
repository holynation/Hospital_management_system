-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2018 at 06:43 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.0.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `previous_ehm_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin`
--

CREATE TABLE `adminlogin` (
  `id` int(11) NOT NULL,
  `username` varchar(250) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `role` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `mobile` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`id`, `username`, `password`, `role`, `email`, `mobile`) VALUES
(1, 'admin', '$2y$12$T31xd7x7b67FO/ucBMGue.VXWDHAgmqOWicF3UpJRP5VIKH3hm5p.', NULL, 'admin@gmail.com', '07064625478');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `department` varchar(50) NOT NULL,
  `doctor_name` varchar(50) NOT NULL,
  `appointment_date` datetime NOT NULL,
  `complaint` varchar(255) NOT NULL,
  `type` varchar(20) NOT NULL,
  `status` varchar(6) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `patient_id`, `department`, `doctor_name`, `appointment_date`, `complaint`, `type`, `status`, `date_created`, `date_modified`) VALUES
(3, 2, '4', '1', '2018-03-05 09:00:00', 'Stomach ache and Head ache...', 'Schedule appointment', 'false', '2018-02-27 16:15:28', '2018-02-28 00:42:43'),
(4, 3, '5', '2', '2018-02-28 00:27:05', 'Purging and a slight headache...', 'Walk in appointment', 'true', '2018-02-28 00:27:05', '0000-00-00 00:00:00'),
(5, 9, '6', '6', '2018-03-09 09:00:00', 'Stomach and head ache...', 'Schedule appointment', 'false', '2018-03-07 01:30:24', '2018-03-07 01:57:03');

-- --------------------------------------------------------

--
-- Table structure for table `casenote`
--

CREATE TABLE `casenote` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `health_status` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `casenote`
--

INSERT INTO `casenote` (`id`, `patient_id`, `health_status`, `description`, `created_by`, `date_created`, `updated_by`, `date_updated`) VALUES
(6, 2, 'good', 'can go home', 1, '2018-03-05 09:43:16', NULL, NULL),
(7, 2, 'good', 'can go home', 1, '2018-03-05 09:50:11', NULL, NULL),
(8, 2, 'dd', 'ddd', 1, '2018-03-05 09:51:57', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `department_name` varchar(40) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `department_name`, `description`, `date_created`, `date_modified`) VALUES
(1, 'Microbiology', 'Microbiology', '2018-02-26 09:08:01', '2018-04-06 15:17:50'),
(3, 'Neurology', 'Neurology', '2018-02-26 09:15:53', '2018-04-06 15:17:35'),
(4, 'General Surgery', 'General Surgery', '2018-02-26 09:16:09', '2018-04-06 15:12:57'),
(5, 'Radiotherapy', 'Radiotherapy', '2018-02-26 09:16:31', '2018-04-06 15:12:57'),
(6, 'Pharmacy', 'Pharmacy', '2018-02-26 09:16:46', '2018-04-06 15:12:57'),
(7, 'Oncology', 'Oncology', '2018-02-26 09:17:05', '2018-04-06 15:12:57'),
(8, 'Gynaecology', 'Gynaecology', '2018-02-26 09:17:26', '2018-04-06 15:12:57'),
(9, 'Rheumatology', 'Rheumatology', '2018-02-26 09:17:52', '2018-04-06 15:12:57'),
(10, 'Orthopaedics', 'Orthopaedics', '2018-02-26 09:18:30', '2018-04-06 15:12:57');

-- --------------------------------------------------------

--
-- Table structure for table `insurance`
--

CREATE TABLE `insurance` (
  `id` int(11) NOT NULL,
  `package_name` varchar(100) NOT NULL,
  `percentage` int(5) NOT NULL,
  `description` varchar(200) NOT NULL,
  `type` varchar(100) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `insurance`
--

INSERT INTO `insurance` (`id`, `package_name`, `percentage`, `description`, `type`, `date_created`, `date_modified`) VALUES
(1, 'oluwaseunsssss', 4088, 'oluwaseunssssss', 'special', '2018-03-28 14:14:49', '2018-03-28 15:00:23'),
(2, 'akintobass', 8044, 'hello worldcsdcscsc', 'special', '2018-03-28 14:15:28', '2018-03-28 14:59:56'),
(4, 'NHIS package', 20, 'sfswfs sjcjs sbcbd bbdshdsb akbd b sbd bs vdskbsbdbv', 'nhis', '2018-04-03 09:54:44', '2018-04-03 17:24:07');

-- --------------------------------------------------------

--
-- Table structure for table `local_government`
--

CREATE TABLE `local_government` (
  `id` bigint(255) NOT NULL,
  `state_id` bigint(255) NOT NULL,
  `local_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `local_government`
--

INSERT INTO `local_government` (`id`, `state_id`, `local_name`) VALUES
(1, 1, 'Aba South'),
(2, 1, 'Arochukwu'),
(3, 1, 'Bende'),
(4, 1, 'Ikwuano'),
(5, 1, 'Isiala Ngwa North'),
(6, 1, 'Isiala Ngwa South'),
(7, 1, 'Isuikwuato'),
(8, 1, 'Obi Ngwa'),
(9, 1, 'Ohafia'),
(10, 1, 'Osisioma'),
(11, 1, 'Ugwunagbo'),
(12, 1, 'Ukwa East'),
(13, 1, 'Ukwa West'),
(14, 1, 'Umuahia North'),
(15, 1, 'Umuahia South'),
(16, 1, 'Umu Nneochi'),
(17, 2, 'Fufure'),
(18, 2, 'Ganye'),
(19, 2, 'Gayuk'),
(20, 2, 'Gombi'),
(21, 2, 'Grie'),
(22, 2, 'Hong'),
(23, 2, 'Jada'),
(24, 2, 'Lamurde'),
(25, 2, 'Madagali'),
(26, 2, 'Maiha'),
(27, 2, 'Mayo Belwa'),
(28, 2, 'Michika'),
(29, 2, 'Mubi North'),
(30, 2, 'Mubi South'),
(31, 2, 'Numan'),
(32, 2, 'Shelleng'),
(33, 2, 'Song'),
(34, 2, 'Toungo'),
(35, 2, 'Yola North'),
(36, 2, 'Yola South'),
(37, 3, 'Eastern Obolo'),
(38, 3, 'Eket'),
(39, 3, 'Esit Eket'),
(40, 3, 'Essien Udim'),
(41, 3, 'Etim Ekpo'),
(42, 3, 'Etinan'),
(43, 3, 'Ibeno'),
(44, 3, 'Ibesikpo Asutan'),
(45, 3, 'Ibiono-Ibom'),
(46, 3, 'Ika'),
(47, 3, 'Ikono'),
(48, 3, 'Ikot Abasi'),
(49, 3, 'Ikot Ekpene'),
(50, 3, 'Ini'),
(51, 3, 'Itu'),
(52, 3, 'Mbo'),
(53, 3, 'Mkpat-Enin'),
(54, 3, 'Nsit-Atai'),
(55, 3, 'Nsit-Ibom'),
(56, 3, 'Nsit-Ubium'),
(57, 3, 'Obot Akara'),
(58, 3, 'Okobo'),
(59, 3, 'Onna'),
(60, 3, 'Oron'),
(61, 3, 'Oruk Anam'),
(62, 3, 'Udung-Uko'),
(63, 3, 'Ukanafun'),
(64, 3, 'Uruan'),
(65, 3, 'Urue-Offong/Oruko'),
(66, 3, 'Uyo'),
(67, 4, 'Anambra East'),
(68, 4, 'Anambra West'),
(69, 4, 'Anaocha'),
(70, 4, 'Awka North'),
(71, 4, 'Awka South'),
(72, 4, 'Ayamelum'),
(73, 4, 'Dunukofia'),
(74, 4, 'Ekwusigo'),
(75, 4, 'Idemili North'),
(76, 4, 'Idemili South'),
(77, 4, 'Ihiala'),
(78, 4, 'Njikoka'),
(79, 4, 'Nnewi North'),
(80, 4, 'Nnewi South'),
(81, 4, 'Ogbaru'),
(82, 4, 'Onitsha North'),
(83, 4, 'Onitsha South'),
(84, 4, 'Orumba North'),
(85, 4, 'Orumba South'),
(86, 4, 'Oyi'),
(87, 5, 'Bauchi'),
(88, 5, 'Bogoro'),
(89, 5, 'Damban'),
(90, 5, 'Darazo'),
(91, 5, 'Dass'),
(92, 5, 'Gamawa'),
(93, 5, 'Ganjuwa'),
(94, 5, 'Giade'),
(95, 5, 'Itas/Gadau'),
(96, 5, 'Jama\'are'),
(97, 5, 'Katagum'),
(98, 5, 'Kirfi'),
(99, 5, 'Misau'),
(100, 5, 'Ningi'),
(101, 5, 'Shira'),
(102, 5, 'Tafawa Balewa'),
(103, 5, 'Toro'),
(104, 5, 'Warji'),
(105, 5, 'Zaki'),
(106, 6, 'Ekeremor'),
(107, 6, 'Kolokuma/Opokuma'),
(108, 6, 'Nembe'),
(109, 6, 'Ogbia'),
(110, 6, 'Sagbama'),
(111, 6, 'Southern Ijaw'),
(112, 6, 'Yenagoa'),
(113, 7, 'Apa'),
(114, 7, 'Ado'),
(115, 7, 'Buruku'),
(116, 7, 'Gboko'),
(117, 7, 'Guma'),
(118, 7, 'Gwer East'),
(119, 7, 'Gwer West'),
(120, 7, 'Katsina-Ala'),
(121, 7, 'Konshisha'),
(122, 7, 'Kwande'),
(123, 7, 'Logo'),
(124, 7, 'Makurdi'),
(125, 7, 'Obi'),
(126, 7, 'Ogbadibo'),
(127, 7, 'Ohimini'),
(128, 7, 'Oju'),
(129, 7, 'Okpokwu'),
(130, 7, 'Oturkpo'),
(131, 7, 'Tarka'),
(132, 7, 'Ukum'),
(133, 7, 'Ushongo'),
(134, 7, 'Vandeikya'),
(135, 8, 'Askira/Uba'),
(136, 8, 'Bama'),
(137, 8, 'Bayo'),
(138, 8, 'Biu'),
(139, 8, 'Chibok'),
(140, 8, 'Damboa'),
(141, 8, 'Dikwa'),
(142, 8, 'Gubio'),
(143, 8, 'Guzamala'),
(144, 8, 'Gwoza'),
(145, 8, 'Hawul'),
(146, 8, 'Jere'),
(147, 8, 'Kaga'),
(148, 8, 'Kala/Balge'),
(149, 8, 'Konduga'),
(150, 8, 'Kukawa'),
(151, 8, 'Kwaya Kusar'),
(152, 8, 'Mafa'),
(153, 8, 'Magumeri'),
(154, 8, 'Maiduguri'),
(155, 8, 'Marte'),
(156, 8, 'Mobbar'),
(157, 8, 'Monguno'),
(158, 8, 'Ngala'),
(159, 8, 'Nganzai'),
(160, 8, 'Shani'),
(161, 9, 'Akamkpa'),
(162, 9, 'Akpabuyo'),
(163, 9, 'Bakassi'),
(164, 9, 'Bekwarra'),
(165, 9, 'Biase'),
(166, 9, 'Boki'),
(167, 9, 'Calabar Municipal'),
(168, 9, 'Calabar South'),
(169, 9, 'Etung'),
(170, 9, 'Ikom'),
(171, 9, 'Obanliku'),
(172, 9, 'Obubra'),
(173, 9, 'Obudu'),
(174, 9, 'Odukpani'),
(175, 9, 'Ogoja'),
(176, 9, 'Yakuur'),
(177, 9, 'Yala'),
(178, 10, 'Aniocha South'),
(179, 10, 'Bomadi'),
(180, 10, 'Burutu'),
(181, 10, 'Ethiope East'),
(182, 10, 'Ethiope West'),
(183, 10, 'Ika North East'),
(184, 10, 'Ika South'),
(185, 10, 'Isoko North'),
(186, 10, 'Isoko South'),
(187, 10, 'Ndokwa East'),
(188, 10, 'Ndokwa West'),
(189, 10, 'Okpe'),
(190, 10, 'Oshimili North'),
(191, 10, 'Oshimili South'),
(192, 10, 'Patani'),
(193, 10, 'Sapele'),
(194, 10, 'Udu'),
(195, 10, 'Ughelli North'),
(196, 10, 'Ughelli South'),
(197, 10, 'Ukwuani'),
(198, 10, 'Uvwie'),
(199, 10, 'Warri North'),
(200, 10, 'Warri South'),
(201, 10, 'Warri South West'),
(202, 11, 'Afikpo North'),
(203, 11, 'Afikpo South'),
(204, 11, 'Ebonyi'),
(205, 11, 'Ezza North'),
(206, 11, 'Ezza South'),
(207, 11, 'Ikwo'),
(208, 11, 'Ishielu'),
(209, 11, 'Ivo'),
(210, 11, 'Izzi'),
(211, 11, 'Ohaozara'),
(212, 11, 'Ohaukwu'),
(213, 11, 'Onicha'),
(214, 12, 'Egor'),
(215, 12, 'Esan Central'),
(216, 12, 'Esan North-East'),
(217, 12, 'Esan South-East'),
(218, 12, 'Esan West'),
(219, 12, 'Etsako Central'),
(220, 12, 'Etsako East'),
(221, 12, 'Etsako West'),
(222, 12, 'Igueben'),
(223, 12, 'Ikpoba Okha'),
(224, 12, 'Orhionmwon'),
(225, 12, 'Oredo'),
(226, 12, 'Ovia North-East'),
(227, 12, 'Ovia South-West'),
(228, 12, 'Owan East'),
(229, 12, 'Owan West'),
(230, 12, 'Uhunmwonde'),
(231, 13, 'Efon'),
(232, 13, 'Ekiti East'),
(233, 13, 'Ekiti South-West'),
(234, 13, 'Ekiti West'),
(235, 13, 'Emure'),
(236, 13, 'Gbonyin'),
(237, 13, 'Ido Osi'),
(238, 13, 'Ijero'),
(239, 13, 'Ikere'),
(240, 13, 'Ikole'),
(241, 13, 'Ilejemeje'),
(242, 13, 'Irepodun/Ifelodun'),
(243, 13, 'Ise/Orun'),
(244, 13, 'Moba'),
(245, 13, 'Oye'),
(246, 14, 'Awgu'),
(247, 14, 'Enugu East'),
(248, 14, 'Enugu North'),
(249, 14, 'Enugu South'),
(250, 14, 'Ezeagu'),
(251, 14, 'Igbo Etiti'),
(252, 14, 'Igbo Eze North'),
(253, 14, 'Igbo Eze South'),
(254, 14, 'Isi Uzo'),
(255, 14, 'Nkanu East'),
(256, 14, 'Nkanu West'),
(257, 14, 'Nsukka'),
(258, 14, 'Oji River'),
(259, 14, 'Udenu'),
(260, 14, 'Udi'),
(261, 14, 'Uzo Uwani'),
(262, 15, 'Bwari'),
(263, 15, 'Gwagwalada'),
(264, 15, 'Kuje'),
(265, 15, 'Kwali'),
(266, 15, 'Municipal Area Council'),
(267, 16, 'Balanga'),
(268, 16, 'Billiri'),
(269, 16, 'Dukku'),
(270, 16, 'Funakaye'),
(271, 16, 'Gombe'),
(272, 16, 'Kaltungo'),
(273, 16, 'Kwami'),
(274, 16, 'Nafada'),
(275, 16, 'Shongom'),
(276, 16, 'Yamaltu/Deba'),
(277, 17, 'Ahiazu Mbaise'),
(278, 17, 'Ehime Mbano'),
(279, 17, 'Ezinihitte'),
(280, 17, 'Ideato North'),
(281, 17, 'Ideato South'),
(282, 17, 'Ihitte/Uboma'),
(283, 17, 'Ikeduru'),
(284, 17, 'Isiala Mbano'),
(285, 17, 'Isu'),
(286, 17, 'Mbaitoli'),
(287, 17, 'Ngor Okpala'),
(288, 17, 'Njaba'),
(289, 17, 'Nkwerre'),
(290, 17, 'Nwangele'),
(291, 17, 'Obowo'),
(292, 17, 'Oguta'),
(293, 17, 'Ohaji/Egbema'),
(294, 17, 'Okigwe'),
(295, 17, 'Orlu'),
(296, 17, 'Orsu'),
(297, 17, 'Oru East'),
(298, 17, 'Oru West'),
(299, 17, 'Owerri Municipal'),
(300, 17, 'Owerri North'),
(301, 17, 'Owerri West'),
(302, 17, 'Unuimo'),
(303, 18, 'Babura'),
(304, 18, 'Biriniwa'),
(305, 18, 'Birnin Kudu'),
(306, 18, 'Buji'),
(307, 18, 'Dutse'),
(308, 18, 'Gagarawa'),
(309, 18, 'Garki'),
(310, 18, 'Gumel'),
(311, 18, 'Guri'),
(312, 18, 'Gwaram'),
(313, 18, 'Gwiwa'),
(314, 18, 'Hadejia'),
(315, 18, 'Jahun'),
(316, 18, 'Kafin Hausa'),
(317, 18, 'Kazaure'),
(318, 18, 'Kiri Kasama'),
(319, 18, 'Kiyawa'),
(320, 18, 'Kaugama'),
(321, 18, 'Maigatari'),
(322, 18, 'Malam Madori'),
(323, 18, 'Miga'),
(324, 18, 'Ringim'),
(325, 18, 'Roni'),
(326, 18, 'Sule Tankarkar'),
(327, 18, 'Taura'),
(328, 18, 'Yankwashi'),
(329, 19, 'Chikun'),
(330, 19, 'Giwa'),
(331, 19, 'Igabi'),
(332, 19, 'Ikara'),
(333, 19, 'Jaba'),
(334, 19, 'Jema\'a'),
(335, 19, 'Kachia'),
(336, 19, 'Kaduna North'),
(337, 19, 'Kaduna South'),
(338, 19, 'Kagarko'),
(339, 19, 'Kajuru'),
(340, 19, 'Kaura'),
(341, 19, 'Kauru'),
(342, 19, 'Kubau'),
(343, 19, 'Kudan'),
(344, 19, 'Lere'),
(345, 19, 'Makarfi'),
(346, 19, 'Sabon Gari'),
(347, 19, 'Sanga'),
(348, 19, 'Soba'),
(349, 19, 'Zangon Kataf'),
(350, 19, 'Zaria'),
(351, 20, 'Albasu'),
(352, 20, 'Bagwai'),
(353, 20, 'Bebeji'),
(354, 20, 'Bichi'),
(355, 20, 'Bunkure'),
(356, 20, 'Dala'),
(357, 20, 'Dambatta'),
(358, 20, 'Dawakin Kudu'),
(359, 20, 'Dawakin Tofa'),
(360, 20, 'Doguwa'),
(361, 20, 'Fagge'),
(362, 20, 'Gabasawa'),
(363, 20, 'Garko'),
(364, 20, 'Garun Mallam'),
(365, 20, 'Gaya'),
(366, 20, 'Gezawa'),
(367, 20, 'Gwale'),
(368, 20, 'Gwarzo'),
(369, 20, 'Kabo'),
(370, 20, 'Kano Municipal'),
(371, 20, 'Karaye'),
(372, 20, 'Kibiya'),
(373, 20, 'Kiru'),
(374, 20, 'Kumbotso'),
(375, 20, 'Kunchi'),
(376, 20, 'Kura'),
(377, 20, 'Madobi'),
(378, 20, 'Makoda'),
(379, 20, 'Minjibir'),
(380, 20, 'Nasarawa'),
(381, 20, 'Rano'),
(382, 20, 'Rimin Gado'),
(383, 20, 'Rogo'),
(384, 20, 'Shanono'),
(385, 20, 'Sumaila'),
(386, 20, 'Takai'),
(387, 20, 'Tarauni'),
(388, 20, 'Tofa'),
(389, 20, 'Tsanyawa'),
(390, 20, 'Tudun Wada'),
(391, 20, 'Ungogo'),
(392, 20, 'Warawa'),
(393, 20, 'Wudil'),
(394, 21, 'Batagarawa'),
(395, 21, 'Batsari'),
(396, 21, 'Baure'),
(397, 21, 'Bindawa'),
(398, 21, 'Charanchi'),
(399, 21, 'Dandume'),
(400, 21, 'Danja'),
(401, 21, 'Dan Musa'),
(402, 21, 'Daura'),
(403, 21, 'Dutsi'),
(404, 21, 'Dutsin Ma'),
(405, 21, 'Faskari'),
(406, 21, 'Funtua'),
(407, 21, 'Ingawa'),
(408, 21, 'Jibia'),
(409, 21, 'Kafur'),
(410, 21, 'Kaita'),
(411, 21, 'Kankara'),
(412, 21, 'Kankia'),
(413, 21, 'Katsina'),
(414, 21, 'Kurfi'),
(415, 21, 'Kusada'),
(416, 21, 'Mai\'Adua'),
(417, 21, 'Malumfashi'),
(418, 21, 'Mani'),
(419, 21, 'Mashi'),
(420, 21, 'Matazu'),
(421, 21, 'Musawa'),
(422, 21, 'Rimi'),
(423, 21, 'Sabuwa'),
(424, 21, 'Safana'),
(425, 21, 'Sandamu'),
(426, 21, 'Zango'),
(427, 22, 'Arewa Dandi'),
(428, 22, 'Argungu'),
(429, 22, 'Augie'),
(430, 22, 'Bagudo'),
(431, 22, 'Birnin Kebbi'),
(432, 22, 'Bunza'),
(433, 22, 'Dandi'),
(434, 22, 'Fakai'),
(435, 22, 'Gwandu'),
(436, 22, 'Jega'),
(437, 22, 'Kalgo'),
(438, 22, 'Koko/Besse'),
(439, 22, 'Maiyama'),
(440, 22, 'Ngaski'),
(441, 22, 'Sakaba'),
(442, 22, 'Shanga'),
(443, 22, 'Suru'),
(444, 22, 'Wasagu/Danko'),
(445, 22, 'Yauri'),
(446, 22, 'Zuru'),
(447, 23, 'Ajaokuta'),
(448, 23, 'Ankpa'),
(449, 23, 'Bassa'),
(450, 23, 'Dekina'),
(451, 23, 'Ibaji'),
(452, 23, 'Idah'),
(453, 23, 'Igalamela Odolu'),
(454, 23, 'Ijumu'),
(455, 23, 'Kabba/Bunu'),
(456, 23, 'Kogi'),
(457, 23, 'Lokoja'),
(458, 23, 'Mopa Muro'),
(459, 23, 'Ofu'),
(460, 23, 'Ogori/Magongo'),
(461, 23, 'Okehi'),
(462, 23, 'Okene'),
(463, 23, 'Olamaboro'),
(464, 23, 'Omala'),
(465, 23, 'Yagba East'),
(466, 23, 'Yagba West'),
(467, 24, 'Baruten'),
(468, 24, 'Edu'),
(469, 24, 'Ekiti'),
(470, 24, 'Ifelodun'),
(471, 24, 'Ilorin East'),
(472, 24, 'Ilorin South'),
(473, 24, 'Ilorin West'),
(474, 24, 'Irepodun'),
(475, 24, 'Isin'),
(476, 24, 'Kaiama'),
(477, 24, 'Moro'),
(478, 24, 'Offa'),
(479, 24, 'Oke Ero'),
(480, 24, 'Oyun'),
(481, 24, 'Pategi'),
(482, 25, 'Ajeromi-Ifelodun'),
(483, 25, 'Alimosho'),
(484, 25, 'Amuwo-Odofin'),
(485, 25, 'Apapa'),
(486, 25, 'Badagry'),
(487, 25, 'Epe'),
(488, 25, 'Eti Osa'),
(489, 25, 'Ibeju-Lekki'),
(490, 25, 'Ifako-Ijaiye'),
(491, 25, 'Ikeja'),
(492, 25, 'Ikorodu'),
(493, 25, 'Kosofe'),
(494, 25, 'Lagos Island'),
(495, 25, 'Lagos Mainland'),
(496, 25, 'Mushin'),
(497, 25, 'Ojo'),
(498, 25, 'Oshodi-Isolo'),
(499, 25, 'Shomolu'),
(500, 25, 'Surulere'),
(501, 26, 'Awe'),
(502, 26, 'Doma'),
(503, 26, 'Karu'),
(504, 26, 'Keana'),
(505, 26, 'Keffi'),
(506, 26, 'Kokona'),
(507, 26, 'Lafia'),
(508, 26, 'Nasarawa'),
(509, 26, 'Nasarawa Egon'),
(510, 26, 'Obi'),
(511, 26, 'Toto'),
(512, 26, 'Wamba'),
(513, 27, 'Agwara'),
(514, 27, 'Bida'),
(515, 27, 'Borgu'),
(516, 27, 'Bosso'),
(517, 27, 'Chanchaga'),
(518, 27, 'Edati'),
(519, 27, 'Gbako'),
(520, 27, 'Gurara'),
(521, 27, 'Katcha'),
(522, 27, 'Kontagora'),
(523, 27, 'Lapai'),
(524, 27, 'Lavun'),
(525, 27, 'Magama'),
(526, 27, 'Mariga'),
(527, 27, 'Mashegu'),
(528, 27, 'Mokwa'),
(529, 27, 'Moya'),
(530, 27, 'Paikoro'),
(531, 27, 'Rafi'),
(532, 27, 'Rijau'),
(533, 27, 'Shiroro'),
(534, 27, 'Suleja'),
(535, 27, 'Tafa'),
(536, 27, 'Wushishi'),
(537, 28, 'Abeokuta South'),
(538, 28, 'Ado-Odo/Ota'),
(539, 28, 'Egbado North'),
(540, 28, 'Egbado South'),
(541, 28, 'Ewekoro'),
(542, 28, 'Ifo'),
(543, 28, 'Ijebu East'),
(544, 28, 'Ijebu North'),
(545, 28, 'Ijebu North East'),
(546, 28, 'Ijebu Ode'),
(547, 28, 'Ikenne'),
(548, 28, 'Imeko Afon'),
(549, 28, 'Ipokia'),
(550, 28, 'Obafemi Owode'),
(551, 28, 'Odeda'),
(552, 28, 'Odogbolu'),
(553, 28, 'Ogun Waterside'),
(554, 28, 'Remo North'),
(555, 28, 'Shagamu'),
(556, 29, 'Akoko North-West'),
(557, 29, 'Akoko South-West'),
(558, 29, 'Akoko South-East'),
(559, 29, 'Akure North'),
(560, 29, 'Akure South'),
(561, 29, 'Ese Odo'),
(562, 29, 'Idanre'),
(563, 29, 'Ifedore'),
(564, 29, 'Ilaje'),
(565, 29, 'Ile Oluji/Okeigbo'),
(566, 29, 'Irele'),
(567, 29, 'Odigbo'),
(568, 29, 'Okitipupa'),
(569, 29, 'Ondo East'),
(570, 29, 'Ondo West'),
(571, 29, 'Ose'),
(572, 29, 'Owo'),
(573, 30, 'Atakunmosa West'),
(574, 30, 'Aiyedaade'),
(575, 30, 'Aiyedire'),
(576, 30, 'Boluwaduro'),
(577, 30, 'Boripe'),
(578, 30, 'Ede North'),
(579, 30, 'Ede South'),
(580, 30, 'Ife Central'),
(581, 30, 'Ife East'),
(582, 30, 'Ife North'),
(583, 30, 'Ife South'),
(584, 30, 'Egbedore'),
(585, 30, 'Ejigbo'),
(586, 30, 'Ifedayo'),
(587, 30, 'Ifelodun'),
(588, 30, 'Ila'),
(589, 30, 'Ilesa East'),
(590, 30, 'Ilesa West'),
(591, 30, 'Irepodun'),
(592, 30, 'Irewole'),
(593, 30, 'Isokan'),
(594, 30, 'Iwo'),
(595, 30, 'Obokun'),
(596, 30, 'Odo Otin'),
(597, 30, 'Ola Oluwa'),
(598, 30, 'Olorunda'),
(599, 30, 'Oriade'),
(600, 30, 'Orolu'),
(601, 30, 'Osogbo'),
(602, 31, 'Akinyele'),
(603, 31, 'Atiba'),
(604, 31, 'Atisbo'),
(605, 31, 'Egbeda'),
(606, 31, 'Ibadan North'),
(607, 31, 'Ibadan North-East'),
(608, 31, 'Ibadan North-West'),
(609, 31, 'Ibadan South-East'),
(610, 31, 'Ibadan South-West'),
(611, 31, 'Ibarapa Central'),
(612, 31, 'Ibarapa East'),
(613, 31, 'Ibarapa North'),
(614, 31, 'Ido'),
(615, 31, 'Irepo'),
(616, 31, 'Iseyin'),
(617, 31, 'Itesiwaju'),
(618, 31, 'Iwajowa'),
(619, 31, 'Kajola'),
(620, 31, 'Lagelu'),
(621, 31, 'Ogbomosho North'),
(622, 31, 'Ogbomosho South'),
(623, 31, 'Ogo Oluwa'),
(624, 31, 'Olorunsogo'),
(625, 31, 'Oluyole'),
(626, 31, 'Ona Ara'),
(627, 31, 'Orelope'),
(628, 31, 'Ori Ire'),
(629, 31, 'Oyo'),
(630, 31, 'Oyo East'),
(631, 31, 'Saki East'),
(632, 31, 'Saki West'),
(633, 31, 'Surulere'),
(634, 32, 'Barkin Ladi'),
(635, 32, 'Bassa'),
(636, 32, 'Jos East'),
(637, 32, 'Jos North'),
(638, 32, 'Jos South'),
(639, 32, 'Kanam'),
(640, 32, 'Kanke'),
(641, 32, 'Langtang South'),
(642, 32, 'Langtang North'),
(643, 32, 'Mangu'),
(644, 32, 'Mikang'),
(645, 32, 'Pankshin'),
(646, 32, 'Qua\'an Pan'),
(647, 32, 'Riyom'),
(648, 32, 'Shendam'),
(649, 32, 'Wase'),
(650, 33, 'Ahoada East'),
(651, 33, 'Ahoada West'),
(652, 33, 'Akuku-Toru'),
(653, 33, 'Andoni'),
(654, 33, 'Asari-Toru'),
(655, 33, 'Bonny'),
(656, 33, 'Degema'),
(657, 33, 'Eleme'),
(658, 33, 'Emuoha'),
(659, 33, 'Etche'),
(660, 33, 'Gokana'),
(661, 33, 'Ikwerre'),
(662, 33, 'Khana'),
(663, 33, 'Obio/Akpor'),
(664, 33, 'Ogba/Egbema/Ndoni'),
(665, 33, 'Ogu/Bolo'),
(666, 33, 'Okrika'),
(667, 33, 'Omuma'),
(668, 33, 'Opobo/Nkoro'),
(669, 33, 'Oyigbo'),
(670, 33, 'Port Harcourt'),
(671, 33, 'Tai'),
(672, 34, 'Bodinga'),
(673, 34, 'Dange Shuni'),
(674, 34, 'Gada'),
(675, 34, 'Goronyo'),
(676, 34, 'Gudu'),
(677, 34, 'Gwadabawa'),
(678, 34, 'Illela'),
(679, 34, 'Isa'),
(680, 34, 'Kebbe'),
(681, 34, 'Kware'),
(682, 34, 'Rabah'),
(683, 34, 'Sabon Birni'),
(684, 34, 'Shagari'),
(685, 34, 'Silame'),
(686, 34, 'Sokoto North'),
(687, 34, 'Sokoto South'),
(688, 34, 'Tambuwal'),
(689, 34, 'Tangaza'),
(690, 34, 'Tureta'),
(691, 34, 'Wamako'),
(692, 34, 'Wurno'),
(693, 34, 'Yabo'),
(694, 35, 'Bali'),
(695, 35, 'Donga'),
(696, 35, 'Gashaka'),
(697, 35, 'Gassol'),
(698, 35, 'Ibi'),
(699, 35, 'Jalingo'),
(700, 35, 'Karim Lamido'),
(701, 35, 'Kumi'),
(702, 35, 'Lau'),
(703, 35, 'Sardauna'),
(704, 35, 'Takum'),
(705, 35, 'Ussa'),
(706, 35, 'Wukari'),
(707, 35, 'Yorro'),
(708, 35, 'Zing'),
(709, 36, 'Bursari'),
(710, 36, 'Damaturu'),
(711, 36, 'Fika'),
(712, 36, 'Fune'),
(713, 36, 'Geidam'),
(714, 36, 'Gujba'),
(715, 36, 'Gulani'),
(716, 36, 'Jakusko'),
(717, 36, 'Karasuwa'),
(718, 36, 'Machina'),
(719, 36, 'Nangere'),
(720, 36, 'Nguru'),
(721, 36, 'Potiskum'),
(722, 36, 'Tarmuwa'),
(723, 36, 'Yunusari'),
(724, 36, 'Yusufari'),
(725, 37, 'Bakura'),
(726, 37, 'Birnin Magaji/Kiyaw'),
(727, 37, 'Bukkuyum'),
(728, 37, 'Bungudu'),
(729, 37, 'Gummi'),
(730, 37, 'Gusau'),
(731, 37, 'Kaura Namoda'),
(732, 37, 'Maradun'),
(733, 37, 'Maru'),
(734, 37, 'Shinkafi'),
(735, 37, 'Talata Mafara'),
(736, 37, 'Chafe'),
(737, 37, 'Zurmi'),
(740, 15, 'Abaji'),
(741, 1, 'Aba North'),
(742, 1, 'Ngwa');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempt`
--

CREATE TABLE `login_attempt` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `user_agent` varchar(70) NOT NULL,
  `status` int(2) NOT NULL,
  `date_attempt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `category` int(11) NOT NULL,
  `form` varchar(50) NOT NULL,
  `packing` varchar(20) NOT NULL,
  `manufacture_date` datetime NOT NULL,
  `effect` varchar(250) NOT NULL,
  `generic_name` varchar(250) NOT NULL,
  `quantity` int(11) NOT NULL,
  `expire_date` datetime NOT NULL,
  `selling_price` int(11) NOT NULL,
  `company` varchar(100) NOT NULL,
  `purchase_price` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `modifier` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`id`, `name`, `category`, `form`, `packing`, `manufacture_date`, `effect`, `generic_name`, `quantity`, `expire_date`, `selling_price`, `company`, `purchase_price`, `date_created`, `date_modified`, `modifier`) VALUES
(1, 'Aspirin', 1, 'caps', '30ml', '2016-03-24 00:00:00', '', 'ggt', 26, '2018-03-30 00:00:00', 1000, 'pharmadeco', 800, '2018-03-19 18:16:18', '0000-00-00 00:00:00', ''),
(2, 'Dolometa-b', 5, 'caps', '500mg', '2018-03-14 00:00:00', 'No side effect', 'Pain killer', 41, '2020-03-25 00:00:00', 200, 'pharmadeco', 100, '2018-03-20 13:56:16', '2018-03-26 17:33:33', 'Admin Alatise Abraham'),
(3, 'Vitamin c', 1, 'caps', '800ml', '2018-03-02 00:00:00', '', 'Vitamin c', 11, '2018-03-10 00:00:00', 500, 'pharmadeco', 200, '2018-03-27 09:16:51', '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `medicine_category`
--

CREATE TABLE `medicine_category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `description` varchar(250) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `modifier` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medicine_category`
--

INSERT INTO `medicine_category` (`id`, `category_name`, `description`, `date_created`, `date_modified`, `modifier`) VALUES
(5, 'Homoeopathy', 'Homoeopathy', '2018-03-20 16:44:12', '2018-03-28 15:05:08', 'Admin Alatise Abraham'),
(6, 'Insulin', 'Insulin', '2018-03-28 15:04:35', '2018-03-28 15:05:18', 'Admin Alatise Abraham');

-- --------------------------------------------------------

--
-- Table structure for table `medicine_sold`
--

CREATE TABLE `medicine_sold` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `medicine_id` varchar(255) NOT NULL,
  `quantity` varchar(30) NOT NULL,
  `discount` int(20) NOT NULL,
  `total` int(30) NOT NULL,
  `date_created` datetime NOT NULL,
  `submitted_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medicine_sold`
--

INSERT INTO `medicine_sold` (`id`, `patient_id`, `medicine_id`, `quantity`, `discount`, `total`, `date_created`, `submitted_by`) VALUES
(1, 1, '1,2', '10,20', 400, 13600, '2018-03-26 17:25:03', 'Admin Alatise Abraham'),
(2, 9, '1,2,3', '10,5,5', 200, 13300, '2018-03-28 11:38:45', 'Admin Alatise Abraham'),
(3, 6, '2,3', '2,2', 0, 1400, '2018-04-03 10:15:11', 'Admin Alatise Abraham'),
(4, 6, '1,2', '2,2', 0, 2400, '2018-04-03 10:20:43', 'Admin Alatise Abraham'),
(5, 7, '1', '2', 0, 2000, '2018-04-03 14:20:51', 'Admin Alatise Abraham');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` int(11) NOT NULL,
  `patient_id` varchar(50) NOT NULL,
  `title` varchar(20) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `phone_no` varchar(15) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `address` varchar(150) NOT NULL,
  `city_address` varchar(20) NOT NULL,
  `state` varchar(30) NOT NULL,
  `lga` varchar(50) NOT NULL,
  `occupation` varchar(50) NOT NULL,
  `marital_status` varchar(20) NOT NULL,
  `firstname_kin` varchar(50) NOT NULL,
  `middle_name_kin` varchar(30) DEFAULT NULL,
  `last_name_kin` varchar(30) NOT NULL,
  `relationship_kin` varchar(30) NOT NULL,
  `phone_kin` varchar(15) NOT NULL,
  `address_kin` varchar(150) NOT NULL,
  `genotype` varchar(20) NOT NULL,
  `blood_group` varchar(20) NOT NULL,
  `picture_path` varchar(150) NOT NULL,
  `allergy` varchar(255) NOT NULL,
  `blood_pressure` varchar(20) NOT NULL,
  `employer_name` varchar(60) DEFAULT NULL,
  `weight` varchar(11) DEFAULT NULL,
  `height` varchar(11) DEFAULT NULL,
  `pulse` varchar(11) DEFAULT NULL,
  `body_temprature` varchar(11) DEFAULT NULL,
  `date_created` datetime NOT NULL,
  `modifier` varchar(100) NOT NULL,
  `date_modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `patient_id`, `title`, `first_name`, `middle_name`, `last_name`, `gender`, `dob`, `phone_no`, `email`, `address`, `city_address`, `state`, `lga`, `occupation`, `marital_status`, `firstname_kin`, `middle_name_kin`, `last_name_kin`, `relationship_kin`, `phone_kin`, `address_kin`, `genotype`, `blood_group`, `picture_path`, `allergy`, `blood_pressure`, `employer_name`, `weight`, `height`, `pulse`, `body_temprature`, `date_created`, `modifier`, `date_modified`) VALUES
(1, 'UCH-P20187186', 'Mr', 'Badmus', 'Bashir', 'Akintoba', 'Male', '2018-02-22', '+2348109994485', 'b.akintoba@gmail.com', 'No 3, Akobo', 'Ibadan', '31', 'Ogbomosho North', 'Programmer', 'Single', 'Badmus', 'Alabi', 'Damilare', 'Kwali', '+2348109994485', 'No 3, Akobo', 'AA', 'A+', './assets/img/patient/default.jpg', 'Egg yoke', '', NULL, NULL, NULL, NULL, NULL, '2018-02-17 17:09:23', 'admin', '2018-03-03 16:48:06'),
(2, 'UCH-P20181271', 'Mr', 'Badmus', 'Oluwaseun', 'Akintoba', 'Male', '2018-02-27', '+2348109994485', 'holynationdevelopment@gmail.com', 'Akobo', 'Ibadan', '27', 'Gbako', 'Programmer', 'Single', 'Badmus', 'Alabi', 'Damilare', 'Ibarapa East', '+2348109994485', 'Akobo', 'AS', 'B+', './assets/img/patient/default.jpg', 'Egg yoke', '', NULL, NULL, NULL, NULL, NULL, '2018-02-17 17:29:41', 'admin Alatise Abraham', '2018-03-03 16:43:27'),
(3, 'UCH-P20187887', 'Mrs', 'Ajibade', 'Abigail', 'Tolulope', 'Female', '2018-02-24', '+2348109994485', 'Abigail@gmail.com', 'No 5, Olodo', 'Ibadan', '18', 'Hadejia', 'worker', 'Married', 'Ajibade', 'Tunde', 'Samson', 'Siblings', '+2348109994485', 'No 5, Olodo', 'AS', 'B+', './assets/img/patient/default.jpg', 'Egg yoke', '', NULL, NULL, NULL, NULL, NULL, '2018-02-20 15:34:52', '', '2018-02-20 15:34:52'),
(5, 'UCH-P20185827', 'Mr', 'Alade', 'Oluwaseun', 'Temitope', 'Male', '1995-12-21', '+2347064625478', 'temitope@gmail.com', 'No 10, Oki Olodo, Ibadan.', 'Ibadan', '28', 'Ijebu Ode', 'Engineer', 'Single', 'Alade', 'Alabi', 'Tunde', 'Ijebu Ode', '+2348109994485', 'No 10, Oki Olodo, Ibadan.', 'AA', 'A+', './assets/img/patient/ehm_77966_ 5a8e838200155.jpg', 'Carbohydrate food', '', NULL, NULL, NULL, NULL, NULL, '2018-02-22 09:46:58', '', '2018-02-22 10:00:28'),
(6, 'UCH-P20188082', 'Miss', 'Babatunde', 'Adenike', 'Shade', 'Female', '2006-04-12', '+2347055448855', 'Adenike@gmail.com', 'No 24, Ewekoro', 'Ikono', '3', 'Ikono', 'Trader', 'Single', 'Babatunde', 'Oyindamola', 'Olamide', 'Siblings', '+2347055448855', 'No 24, Ewekoro', 'SS', 'B-', 'assets/img/patient/default.jpg', 'Food allergy', '', NULL, NULL, NULL, NULL, NULL, '2018-03-03 17:37:48', '', '2018-03-03 17:37:48'),
(7, 'UCH-P20184987', 'Mr', 'Omolewa', 'Adenike', 'Dasola', 'Female', '2016-03-01', '+2347055448855', 'Dasola@gmail.com', 'Ajibode,UI Ibadan', 'Ibadan', '31', 'Egbeda', 'Trader', 'Single', 'Omolewa', 'Kunle', 'Olamide', 'Siblings', '+2347055448855', 'Ajibode,UI Ibadan', 'AC', 'O+', 'assets/img/upload/patient/default.jpg', 'Carbohydrate food', '', NULL, NULL, NULL, NULL, NULL, '2018-03-07 00:35:35', '', '2018-03-07 00:35:35'),
(8, 'UCH-P20184128', 'Mr', 'Akintola', '', 'Tayo', 'Male', '1995-03-27', '+2347055448855', 'tayo@gmail.com', 'Ajibode,UI Ibadan', 'Osun', '30', 'Ife East', 'Trader', 'Single', 'Akintola', '', 'Bukky', 'Ife East', '+2347055448855', 'Ajibode,UI Ibadan', 'SS', 'A-', 'assets/img/upload/patient/ehm_4528_ 5a9f2722873db.jpg', 'Protein food', '', NULL, NULL, NULL, NULL, NULL, '2018-03-07 00:41:22', 'admin', '2018-03-07 00:54:25'),
(9, 'UCH-P20184996', 'Mrs', 'Babatunde', '', 'Steven', 'Male', '2005-03-02', '+2347055448855', 'Steven@gmail.com', 'Ikorodu, Lagos', 'Lagos', '10', 'Isoko South', 'Trader', 'Single', 'Babatunde', '', 'Olamide', 'Isoko South', '+2347055448855', 'Ikorodu, Lagos', 'AA', 'B-', 'assets/img/upload/patient/ehm_1266_ 5a9f2cd989891.jpg', 'Flour food', '', NULL, NULL, NULL, NULL, NULL, '2018-03-07 01:05:45', 'admin', '2018-04-06 17:42:41');

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `role_id` int(10) DEFAULT NULL,
  `permissions` enum('r','w') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`id`, `staff_id`, `role_id`, `permissions`) VALUES
(1, 8, 4, 'r'),
(2, 1, 1, 'w');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role_name` varchar(30) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role_name`, `description`, `date_created`) VALUES
(1, 'Admin', 'This is the admin role', '2018-03-03 16:23:47'),
(2, 'Nurse', 'This is the nurse role', '2018-03-03 16:24:22'),
(3, 'Accountant', 'This is the nurse role', '2018-03-03 16:24:36'),
(4, 'Receptionist', 'This is the receptionist role', '2018-03-03 16:25:04'),
(5, 'Pharmacist', 'This is the pharmacist role', '2018-03-03 16:25:39'),
(6, 'Lab Scientist', 'This is the Lab Scientist role', '2018-03-03 16:27:00'),
(7, 'Doctor', 'This is the doctor role', '2018-04-07 05:23:44');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `available_days` varchar(15) NOT NULL,
  `available_time_start` varchar(11) NOT NULL,
  `available_time_end` varchar(11) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id`, `doctor_id`, `available_days`, `available_time_start`, `available_time_end`, `date_created`) VALUES
(1, 1, 'Monday', '7:00 AM', '12:00 PM', '2018-02-26 05:21:38'),
(2, 2, 'Tuesday', '5:25 AM', '5:23 PM', '2018-02-26 05:25:45'),
(3, 6, 'Monday', '8:00 AM', '10:00 PM', '2018-03-07 01:25:11');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `favicon` varchar(240) NOT NULL,
  `smtp_username` varchar(250) NOT NULL,
  `smtp_host` varchar(250) NOT NULL,
  `smtp_password` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `lock_screen` varchar(5) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `title`, `logo`, `favicon`, `smtp_username`, `smtp_host`, `smtp_password`, `email`, `lock_screen`, `date_created`) VALUES
(1, 'EH-Manager', 'assets/img/upload/ehm-logo_30871_ 5a9df4eb92272.png', '', 'oalatise@technodesolutuions.com', 'technodesolutions.com', 'sincefeb2015', 'holynationDevelopment@gmail.com', '', '2018-03-06 02:54:51');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `staff_id` varchar(20) NOT NULL,
  `staff_username` varchar(15) NOT NULL,
  `password` varchar(100) NOT NULL,
  `title` varchar(11) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `middle_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(20) NOT NULL,
  `birth` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `marital_status` varchar(11) NOT NULL,
  `phone_no` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `state` varchar(20) NOT NULL,
  `lga` varchar(30) NOT NULL,
  `address` varchar(100) NOT NULL,
  `firstname_kin` varchar(50) NOT NULL,
  `middle_name_kin` varchar(50) DEFAULT NULL,
  `last_name_kin` varchar(50) NOT NULL,
  `relationship_kin` varchar(50) NOT NULL,
  `phone_kin` varchar(14) NOT NULL,
  `address_kin` varchar(250) NOT NULL,
  `department_id` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL,
  `img_path` varchar(60) NOT NULL,
  `status` varchar(10) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `staff_id`, `staff_username`, `password`, `title`, `first_name`, `middle_name`, `last_name`, `birth`, `gender`, `marital_status`, `phone_no`, `email`, `state`, `lga`, `address`, `firstname_kin`, `middle_name_kin`, `last_name_kin`, `relationship_kin`, `phone_kin`, `address_kin`, `department_id`, `role`, `img_path`, `status`, `date_created`, `date_modified`) VALUES
(1, 'ehm-123', 'admin', '$2y$12$FoHXfPaDfyJUpqTSn/IvF.rWs8rGFBKUxWZimTrqBmPhYP0AYo.Lq', '', 'Alatise', 'Oluwaseun', 'Abraham', '', 'Male', 'single', '+2347064625478', 'holynationdevelopment@gmail.com', '', '', '', '', NULL, '', '', '', '', '4', '1', 'assets/img/upload/staff/default.jpg', 'Active', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'UCH-20181545', 'holynation', '$2y$12$0QxIStZVg5762AaSSPxsd..OJXIR1Wvm.g8O3DVUF6CYN.fd5kX.y', 'Mr', 'Badmus', 'Segun', 'Akintoba', '2018-02-26', 'Male', 'Single', '+2348109994485', 'b.akintoba@gmail.com', '31', 'Ibadan North-East', 'No 2, Akobo', 'Badmus', 'Alabi', 'Damilare', 'Siblings', '+2348109994485', 'No 2, Akobo', '5', '7', 'assets/img/upload/staff/default.jpg', 'Active', '2018-02-17 11:14:36', '2018-02-24 08:08:33'),
(3, 'UCH-20181967', 'Nahir', '$2y$12$aIG85hghFB73f8d2vu8ElON3VUWNYNYIN8XzWQhK9fIEHr9XE9LD.', 'Mr', 'Badmus', 'Segun', 'Akintola', '2018-02-28', 'Male', 'Married', '+2348109994485', 'holynationdevelopment667@gmail.com', '15', 'Kwali', 'No 4, Akobo', 'Badmus', 'Asake', 'Dammy', 'Siblings', '+2348109994485', 'No 4, Akobo', '1', '7', 'assets/img/upload/staff/default.jpg', 'Active', '2018-02-17 13:05:32', '0000-00-00 00:00:00'),
(4, 'UCH-20186881', 'abike', '$2y$12$FaEu/1elNI0lxNiV22XByebVeaZsuIucV8EomCuUU1gsfdQ/OCGYi', 'Mrs', 'Abike', 'Ayo', 'Shade', '1990-05-17', 'Female', 'Married', '+2347055448855', 'Shade@gmail.com', '10', 'Oshimili North', 'Ojurin Akobo', 'Abike', 'Oyindamola', 'Olamide', 'Siblings', '+2347055448855', 'Ojurin Akobo', '6', '4', 'assets/img/upload/staff/default.jpg', 'Active', '2018-03-03 12:56:28', '0000-00-00 00:00:00'),
(5, 'UCH-20185137', 'dazzy', '$2y$12$DpBzhCAE8QECL6/W1KUmjO6YPr13BB8XMlX2aJ7CPba33qBbkCZVW', 'Mrs', 'Babatunde', 'Kenny', 'Dasola', '2018-03-20', 'Female', 'Single', '+2347055448855', 'Dasola@gmail.com', '7', 'Logo', 'No 10, Ojo-road, Ibadan.', 'Babatunde', 'Ayobami', 'Oluwaseun', 'Siblings', '+2347055448855', 'No 10, Ojo-road, Ibadan.', '4', '2', 'assets/img/upload/staff/default.jpg', 'Active', '2018-03-03 13:00:09', '0000-00-00 00:00:00'),
(6, 'UCH-20183674', 'lewa', '$2y$12$MUGX7xbEU5jTBDA/CJkNJ.uc4asVKLxJ9TcXFjKIY8jdXTeZrL8IC', 'Mr', 'Omolewa', 'Ayobami', 'Steven', '1995-11-14', 'Male', 'Single', '+2347055448855', 'Steven@gmail.com', '30', 'Ilesa East', 'Ikorodu Lagos', 'Omolewa', 'Kunle', 'Olamide', 'Siblings', '+2347055448855', 'Ikorodu Lagos', '6', '7', 'assets/img/upload/staff/avatar.jpg', 'Active', '2018-03-06 03:28:27', '0000-00-00 00:00:00'),
(7, 'UCH-20181564', 'slim', '$2y$12$aop5SH3E7elmRoFkKinJPO4INY4kkcliBxo/PGUlyGybCW8LvPfLG', 'Mr', 'Alatise change', '', 'Steven', '2018-03-01', 'Female', 'Single', '+2347055448855', 'Adenike@gmail.com', '10', 'Ndokwa West', 'Lagos', 'Omolewa', '', 'Oluwaseun', 'Mother', '+2347055448855', 'Lagos', '7', '3', 'assets/img/upload/staff/default.jpg', 'Inactive', '2018-03-06 03:58:46', '0000-00-00 00:00:00'),
(8, 'UCH-20185482', 'Sockokid', '$2y$12$EYbr0iVNmf../R7gtT/xXeAW7xIikjBAK/mnX4trWJoF2XtNJUAg6', 'Mr', 'Akintola', 'Ayo', 'Sodiq', '2016-03-16', 'Male', 'Single', '+2347055448855', 'Sodiq@gmail.com', '31', 'Ibadan North-East', 'Aperin Ibadan', 'Akintola', '', 'Rasaq', 'Siblings', '+2347055448855', 'Aperin Ibadan', '9', '4', 'assets/img/upload/staff/ehm_46194_ 5a9e996de2b49.jpg', 'Active', '2018-03-06 14:36:45', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` bigint(255) NOT NULL,
  `state_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `state_name`) VALUES
(1, 'Abia State'),
(2, 'Adamawa State'),
(3, 'Akwa Ibom State'),
(4, 'Anambra State'),
(5, 'Bauchi State'),
(6, 'Bayelsa State'),
(7, 'Benue State'),
(8, 'Borno State'),
(9, 'Cross River State'),
(10, 'Delta State'),
(11, 'Ebonyi State'),
(12, 'Edo State'),
(13, 'Ekiti State'),
(14, 'Enugu State'),
(15, 'FCT'),
(16, 'Gombe State'),
(17, 'Imo State'),
(18, 'Jigawa State'),
(19, 'Kaduna State'),
(20, 'Kano State'),
(21, 'Katsina State'),
(22, 'Kebbi State'),
(23, 'Kogi State'),
(24, 'Kwara State'),
(25, 'Lagos State'),
(26, 'Nasarawa State'),
(27, 'Niger State'),
(28, 'Ogun State'),
(29, 'Ondo State'),
(30, 'Osun State'),
(31, 'Oyo State'),
(32, 'Plateau State'),
(33, 'Rivers State'),
(34, 'Sokoto State'),
(35, 'Taraba State'),
(36, 'Yobe State'),
(37, 'Zamfara State');

-- --------------------------------------------------------

--
-- Table structure for table `users_session`
--

CREATE TABLE `users_session` (
  `id` int(11) NOT NULL,
  `staff_id` varchar(11) NOT NULL,
  `ip_address` varchar(100) NOT NULL,
  `hash` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ward`
--

CREATE TABLE `ward` (
  `id` int(11) NOT NULL,
  `ward_name` varchar(50) NOT NULL,
  `no_of_bed` int(11) NOT NULL,
  `category` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  `charge` int(11) NOT NULL,
  `status` varchar(8) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `user_modified` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ward`
--

INSERT INTO `ward` (`id`, `ward_name`, `no_of_bed`, `category`, `description`, `charge`, `status`, `date_created`, `date_modified`, `user_modified`) VALUES
(1, 'Peace', 10, 'Private', 'This is a private ward for the general...', 10000, 'Active', '2018-03-02 13:51:25', '2018-03-02 14:10:50', ''),
(2, 'Joy', 5, 'Public', 'This is for the general...', 1500, 'Active', '2018-03-02 14:00:48', '2018-03-02 14:41:40', 'Doctor Alatise Abraham'),
(3, 'Grace', 4, 'Public', 'This is for the general...', 1500, 'Active', '2018-03-02 14:01:28', '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `ward_assign`
--

CREATE TABLE `ward_assign` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `ward_id` int(11) NOT NULL,
  `assign_date` datetime NOT NULL,
  `discharge_date` datetime NOT NULL,
  `description` varchar(250) NOT NULL,
  `no_of_day` int(11) NOT NULL,
  `total_amount` bigint(200) NOT NULL,
  `assign_by` varchar(150) NOT NULL,
  `status` varchar(11) NOT NULL,
  `discharge_status` varchar(10) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `modifier` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ward_assign`
--

INSERT INTO `ward_assign` (`id`, `patient_id`, `ward_id`, `assign_date`, `discharge_date`, `description`, `no_of_day`, `total_amount`, `assign_by`, `status`, `discharge_status`, `date_created`, `date_modified`, `modifier`) VALUES
(3, 9, 1, '2018-03-13 00:00:00', '0000-00-00 00:00:00', 'ddaddwqdd', 0, 0, '', 'Active', 'Inactive', '2018-03-10 12:22:49', '0000-00-00 00:00:00', ''),
(4, 9, 1, '2018-03-13 00:00:00', '0000-00-00 00:00:00', 'ddaddwqdd', 0, 0, '', 'Active', 'Inactive', '2018-03-10 12:24:58', '0000-00-00 00:00:00', ''),
(5, 9, 1, '2018-03-13 00:00:00', '0000-00-00 00:00:00', 'ddaddwqdd', 0, 0, '', 'Active', 'Inactive', '2018-03-10 12:26:53', '0000-00-00 00:00:00', ''),
(6, 9, 1, '2018-03-13 00:00:00', '0000-00-00 00:00:00', 'ddaddwqdd', 0, 0, '', 'Active', 'Inactive', '2018-03-10 12:29:02', '0000-00-00 00:00:00', ''),
(7, 9, 1, '2018-03-13 00:00:00', '0000-00-00 00:00:00', 'ddaddwqdd', 0, 0, '', 'Active', 'Inactive', '2018-03-10 12:30:17', '0000-00-00 00:00:00', ''),
(8, 9, 1, '2018-03-13 00:00:00', '0000-00-00 00:00:00', 'ddaddwqdd', 0, 0, '', 'Active', 'Inactive', '2018-03-10 12:33:17', '0000-00-00 00:00:00', ''),
(9, 9, 1, '2018-03-13 00:00:00', '0000-00-00 00:00:00', 'ddaddwqdd', 0, 0, '', 'Active', 'Inactive', '2018-03-10 12:34:40', '0000-00-00 00:00:00', ''),
(10, 9, 3, '2018-03-30 00:00:00', '0000-00-00 00:00:00', 'efefefe', 0, 0, '', 'Active', 'Inactive', '2018-03-10 17:35:30', '2018-03-15 17:48:43', 'Admin Alatise Abraham'),
(11, 9, 3, '2018-03-24 00:00:00', '0000-00-00 00:00:00', 'this is working', 0, 0, '', 'Active', 'Inactive', '2018-03-10 18:52:47', '2018-03-15 17:42:26', 'Admin Alatise Abraham'),
(12, 9, 3, '2018-03-22 00:00:00', '2018-03-30 00:00:00', 'this is working', 8, 12000, '', 'Active', 'Active', '2018-03-10 18:53:02', '2018-03-15 17:51:06', 'Admin Alatise Abraham'),
(13, 7, 2, '2018-03-17 00:00:00', '2018-03-21 00:00:00', 'This patient have a deep hole in his abdomen', 4, 6000, '1', 'Active', 'Active', '2018-03-15 10:22:07', '2018-03-15 18:14:17', 'Admin Alatise Abraham');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminlogin`
--
ALTER TABLE `adminlogin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `casenote`
--
ALTER TABLE `casenote`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `insurance`
--
ALTER TABLE `insurance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `local_government`
--
ALTER TABLE `local_government`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempt`
--
ALTER TABLE `login_attempt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicine_category`
--
ALTER TABLE `medicine_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicine_sold`
--
ALTER TABLE `medicine_sold`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_session`
--
ALTER TABLE `users_session`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ward`
--
ALTER TABLE `ward`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ward_assign`
--
ALTER TABLE `ward_assign`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminlogin`
--
ALTER TABLE `adminlogin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `casenote`
--
ALTER TABLE `casenote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `insurance`
--
ALTER TABLE `insurance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `local_government`
--
ALTER TABLE `local_government`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=743;

--
-- AUTO_INCREMENT for table `login_attempt`
--
ALTER TABLE `login_attempt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `medicine_category`
--
ALTER TABLE `medicine_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `medicine_sold`
--
ALTER TABLE `medicine_sold`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `users_session`
--
ALTER TABLE `users_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ward`
--
ALTER TABLE `ward`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ward_assign`
--
ALTER TABLE `ward_assign`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
