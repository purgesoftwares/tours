-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2016 at 10:11 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tour_shout`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
`id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `tourism_type` int(11) NOT NULL,
  `lft` int(11) NOT NULL,
  `rght` int(11) NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `description_en` text NOT NULL,
  `name_pt` varchar(255) NOT NULL,
  `name_sp` varchar(255) NOT NULL,
  `description_pt` text NOT NULL,
  `description_sp` text NOT NULL,
  `credit_pt` varchar(255) NOT NULL,
  `credit_sp` varchar(255) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `credit_en` text NOT NULL,
  `slug` varchar(255) NOT NULL,
  `is_show` int(11) NOT NULL DEFAULT '0',
  `created` int(11) NOT NULL,
  `modified` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
`id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `created` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `modified` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `client_id`, `first_name`, `last_name`, `email`, `phone`, `created`, `modified`) VALUES
(1, 0, 'new contact', 'new contact', 'new@contact.com', '3265987845', '1426309953', '1426309953'),
(2, 6, 'new contact', 'new contact', 'new@contact.com', '3265987845', '1426310029', '1449859815'),
(3, 6, 'new contact 23', 'asd', 'asd@asd.asd', '213123123', '1426353043', '1449859815'),
(4, 6, 'new contact 1', 'sd', 'sd@terst.com', '32659878', '1426353072', '1449859815'),
(5, 6, 'wsdsad', 'sadsad', 'sad@sadf.df', '', '1426354824', '1449859815'),
(6, 6, 'new ', 'contact', 'newc@mailinator.com', '3265986532', '1434425623', '1449859816'),
(7, 0, 'new contact', '1', 'newcontact11@mailinator.com', '', '1436682422', '1436682422'),
(8, 0, 'new contact', '1', 'newcontact111@mailinator.com', '', '1436682477', '1436682477'),
(9, 0, 'new contact', '2', 'newcontact2@mailinator.com', '', '1436682607', '1436682607'),
(10, 0, 'new contact', '3', 'newcontact3@mailinator.com', '', '1436682906', '1436682906'),
(11, 5, 'new contact', '4', 'newcontact4@mailinator.com', '3265988745', '1436682957', '1436682957'),
(12, 0, 'new contact1', '41', 'newcontact41@mailinator.com', '32659887451', '1436695534', '1436695534');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
`id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `iso3166_1` char(2) COLLATE utf8_unicode_ci NOT NULL,
  `phone_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `initials` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `origin` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '3',
  `created` int(11) NOT NULL,
  `updated` varchar(11) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=245 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='countries';

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `iso3166_1`, `phone_code`, `initials`, `origin`, `created`, `updated`) VALUES
(1, 'Afganistan', 'AF', '+93', 'Afeganistão', '3', 1389088162, '1389088162'),
(2, 'Aland', 'AX', '+1', 'Ilhas Aland', '3', 1389088162, '1389088162'),
(3, 'Albania', 'AL', '+355', 'Albânia', '3', 1389088162, '1389088162'),
(4, 'Algeria', 'DZ', '+213', 'Argélia', '3', 1389088162, '1389088162'),
(5, 'American Samoa', 'AS', '+1', 'Samoa Americana', '3', 1389088162, '1389088162'),
(6, 'Andorra', 'AD', '+376', 'Andorra', '3', 1389088162, '1389088162'),
(7, 'Angola', 'AO', '+244', 'Angola', '3', 1389088162, '1389088162'),
(8, 'Anguilla', 'AI', '+264', 'Anguilla', '3', 1389088162, '1389088162'),
(9, 'Antarctica', 'AQ', '+1', 'Antártida', '3', 1389088162, '1389088162'),
(10, 'Antigua and Barbuda', 'AG', '+1', 'Antígua e Barbuda', '3', 1389088162, '1389088162'),
(11, 'Argentina', 'AR', '+54', 'Argentina', '3', 1389088162, '1389088162'),
(12, 'Armenia', 'AM', '+374', 'Armênia', '3', 1389088162, '1389088162'),
(13, 'Aruba', 'AW', '+297', 'Aruba', '3', 1389088162, '1389088162'),
(14, 'Australia', 'AU', '+61', 'Austrália', '3', 1389088162, '1389088162'),
(15, 'Austria', 'AT', '+43', 'Áustria', '3', 1389088162, '1389088162'),
(16, 'Azerbaijan', 'AZ', '+994', 'Azerbaijão', '3', 1389088162, '1389088162'),
(17, 'Bahamas', 'BS', '+242', 'Bahamas', '3', 1389088162, '1389088162'),
(18, 'Bahrain', 'BH', '+973', 'Bahrein', '3', 1389088162, '1389088162'),
(19, 'Bangladesh', 'BD', '+880', 'Bangladesh', '3', 1389088162, '1389088162'),
(20, 'Barbados', 'BB', '+246', 'Barbados', '3', 1389088162, '1389088162'),
(21, 'Belarus', 'BY', '+375', 'Belarus', '3', 1389088162, '1389088162'),
(22, 'Belgium', 'BE', '+32', 'Bélgica', '3', 1389088162, '1389088162'),
(23, 'Belize', 'BZ', '+501', 'Belize', '3', 1389088162, '1389088162'),
(24, 'Benin', 'BJ', '+229', 'Benin', '3', 1389088162, '1389088162'),
(25, 'Bermuda', 'BM', '+441', 'Bermudas', '3', 1389088162, '1389088162'),
(26, 'Bhutan', 'BT', '+975', 'Butão', '3', 1389088162, '1389088162'),
(27, 'Bolivia', 'BO', '+591', 'Bolívia', '3', 1389088162, '1389088162'),
(28, 'Bosnia and Herzegovina', 'BA', '+387', 'Bósnia-Herzegóvina', '3', 1389088162, '1389088162'),
(29, 'Botswana', 'BW', '+267', 'Botsuana', '3', 1389088162, '1389088162'),
(30, 'Bouvet Island', 'BV', '+1', 'Ilha Bouvet (Território da Noruega)', '3', 1389088162, '1389088162'),
(31, 'Brazil', 'BR', '+55', 'Brasil', '3', 1389088162, '1389088162'),
(32, 'British Indian Ocean Territory', 'IO', '+1', 'Território Britânico do Oceano índico', '3', 1389088162, '1389088162'),
(33, 'Brunei Darussalam', 'BN', '+673', 'Brunei', '3', 1389088162, '1389088162'),
(34, 'Bulgaria', 'BG', '+359', 'Bulgária', '3', 1389088162, '1389088162'),
(35, 'Burkina Faso', 'BF', '+226', 'Burkina Fasso', '3', 1389088162, '1389088162'),
(36, 'Burundi', 'BI', '+257', 'Burundi', '3', 1389088162, '1389088162'),
(37, 'Cambodia', 'KH', '+855', 'Camboja', '3', 1389088162, '1389088162'),
(38, 'Cameroon', 'CM', '+237', 'Camarões', '3', 1389088162, '1389088162'),
(39, 'Canada', 'CA', '+1', 'Canadá', '3', 1389088162, '1389088162'),
(40, 'Cape Verde', 'CV', '+238', 'Cabo Verde', '3', 1389088162, '1389088162'),
(41, 'Cayman Islands', 'KY', '+345', 'Ilhas Cayman', '3', 1389088162, '1389088162'),
(42, 'Central African Republic', 'CF', '+236', 'República Centro-Africana', '3', 1389088162, '1389088162'),
(43, 'Chad', 'TD', '+235', 'Chade', '3', 1389088162, '1389088162'),
(44, 'Chile', 'CL', '+56', 'Chile', '3', 1389088162, '1389088162'),
(45, 'China', 'CN', '+86', 'China', '3', 1389088162, '1389088162'),
(46, 'Christmas Island', 'CX', '+1', 'Ilha Natal', '3', 1389088162, '1389088162'),
(47, 'Cocos (Keeling) Islands', 'CC', '+1', 'Ilhas Cocos', '3', 1389088162, '1389088162'),
(48, 'Colombia', 'CO', '+57', 'Colômbia', '3', 1389088162, '1389088162'),
(49, 'Comoros', 'KM', '+269', 'Ilhas Comores', '3', 1389088162, '1389088162'),
(50, 'Congo (Brazzaville)', 'CG', '+1', 'Congo', '3', 1389088162, '1389088162'),
(51, 'Congo (Kinshasa)', 'CD', '+1', 'República Democrática do Congo (ex-Zaire)', '3', 1389088162, '1389088162'),
(52, 'Cook Islands', 'CK', '+682', 'Ilhas Cook', '3', 1389088162, '1389088162'),
(53, 'Costa Rica', 'CR', '+506', 'Costa Rica', '3', 1389088162, '1389088162'),
(54, 'Cote d Ivoire', 'CI', '+1', 'Costa do Marfim', '3', 1389088162, '1389088162'),
(55, 'Croatia', 'HR', '+385', 'Croácia (Hrvatska)', '3', 1389088162, '1389088162'),
(56, 'Cuba', 'CU', '+53', 'Cuba', '3', 1389088162, '1389088162'),
(57, 'Cyprus', 'CY', '+357', 'Chipre', '3', 1389088162, '1389088162'),
(58, 'Czech Republic', 'CZ', '+420', 'República Tcheca', '3', 1389088162, '1389088162'),
(59, 'Denmark', 'DK', '+45', 'Dinamarca', '3', 1389088162, '1389088162'),
(60, 'Djibouti', 'DJ', '+253', 'Djibuti', '3', 1389088162, '1389088162'),
(61, 'Dominica', 'DM', '+767', 'Dominica', '3', 1389088162, '1389088162'),
(62, 'Dominican Republic', 'DO', '+1', 'República Dominicana', '3', 1389088162, '1389088162'),
(63, 'East Timor', 'TP', '+670', '', '3', 1389088162, '1389088162'),
(64, 'Ecuador', 'EC', '+593', 'Equador', '3', 1389088162, '1389088162'),
(65, 'Egypt', 'EG', '+20', 'Egito', '3', 1389088162, '1389088162'),
(66, 'El Salvador', 'SV', '+503', 'El Salvador', '3', 1389088162, '1389088162'),
(67, 'Equatorial Guinea', 'GQ', '+240', 'Guiné Equatorial', '3', 1389088162, '1389088162'),
(68, 'Eritrea', 'ER', '+291', 'Eritréia', '3', 1389088162, '1389088162'),
(69, 'Estonia', 'EE', '+372', 'Estônia', '3', 1389088162, '1389088162'),
(70, 'Ethiopia', 'ET', '+251', 'Etiópia', '3', 1389088162, '1389088162'),
(71, 'Falkland Islands', 'FK', '+500', 'Ilhas Falkland (Malvinas)', '3', 1389088162, '1389088162'),
(72, 'Faroe Islands', 'FO', '+298', 'Ilhas Faroes', '3', 1389088162, '1389088162'),
(73, 'Fiji', 'FJ', '+679', 'Fiji', '3', 1389088162, '1389088162'),
(74, 'Finland', 'FI', '+358', 'Finlândia', '3', 1389088162, '1389088162'),
(75, 'France', 'FR', '+33', 'França', '3', 1389088162, '1389088162'),
(76, 'French Guiana', 'GF', '+594', 'Guiana Francesa', '3', 1389088162, '1389088162'),
(77, 'French Polynesia', 'PF', '+689', 'Polinésia Francesa', '3', 1389088162, '1389088162'),
(78, 'French Southern Lands', 'TF', '+1', 'Territórios do Sul da França', '3', 1389088162, '1389088162'),
(79, 'Gabon', 'GA', '+241', 'Gabão', '3', 1389088162, '1389088162'),
(80, 'Gambia', 'GM', '+220', 'Gâmbia', '3', 1389088162, '1389088162'),
(81, 'Georgia', 'GE', '+995', 'Geórgia', '3', 1389088162, '1389088162'),
(82, 'Germany', 'DE', '+49', 'Alemanha', '3', 1389088162, '1389088162'),
(83, 'Ghana', 'GH', '+233', 'Gana', '3', 1389088162, '1389088162'),
(84, 'Gibraltar', 'GI', '+350', 'Gibraltar', '3', 1389088162, '1389088162'),
(85, 'Greece', 'GR', '+30', 'Grécia', '3', 1389088162, '1389088162'),
(86, 'Greenland', 'GL', '+299', 'Groelândia', '3', 1389088162, '1389088162'),
(87, 'Grenada', 'GD', '+473', 'Granada', '3', 1389088162, '1389088162'),
(88, 'Guadeloupe', 'GP', '+590', 'Guadalupe', '3', 1389088162, '1389088162'),
(89, 'Guam', 'GU', '+1', 'Guam (Território dos Estados Unidos)', '3', 1389088162, '1389088162'),
(90, 'Guatemala', 'GT', '+502', 'Guatemala', '3', 1389088162, '1389088162'),
(91, 'Guinea', 'GN', '+224', 'Guiné', '3', 1389088162, '1389088162'),
(92, 'Guinea-Bissau', 'GW', '+245', 'Guiné-Bissau', '3', 1389088162, '1389088162'),
(93, 'Guyana', 'GY', '+592', 'Guiana', '3', 1389088162, '1389088162'),
(94, 'Haiti', 'HT', '+509', 'Haiti', '3', 1389088162, '1389088162'),
(95, 'Heard and McDonald Islands', 'HM', '+1', 'Ilhas Heard e McDonald (Território da Austrália)', '3', 1389088162, '1389088162'),
(96, 'Honduras', 'HN', '+504', 'Honduras', '3', 1389088162, '1389088162'),
(97, 'Hong Kong', 'HK', '+852', 'Hong Kong', '3', 1389088162, '1389088162'),
(98, 'Hungary', 'HU', '+36', 'Hungria', '3', 1389088162, '1389088162'),
(99, 'Iceland', 'IS', '+354', 'Islândia', '3', 1389088162, '1389088162'),
(100, 'India', 'IN', '+91', 'Índia', '3', 1389088162, '1389088162'),
(101, 'Indonesia', 'ID', '+62', 'Indonésia', '3', 1389088162, '1389088162'),
(102, 'Iran', 'IR', '+98', 'Irã', '3', 1389088162, '1389088162'),
(103, 'Iraq', 'IQ', '+964', 'Iraque', '3', 1389088162, '1389088162'),
(104, 'Ireland', 'IE', '+353', 'Irlanda', '3', 1389088162, '1389088162'),
(105, 'Israel', 'IL', '+972', 'Israel', '3', 1389088162, '1389088162'),
(106, 'Italy', 'IT', '+39', 'Itália', '3', 1389088162, '1389088162'),
(107, 'Jamaica', 'JM', '+876', 'Jamaica', '3', 1389088162, '1389088162'),
(108, 'Japan', 'JP', '+81', 'Japão', '3', 1389088162, '1389088162'),
(109, 'Jordan', 'JO', '+962', 'Jordânia', '3', 1389088162, '1389088162'),
(110, 'Kazakhstan', 'KZ', '+997', 'Cazaquistão', '3', 1389088162, '1389088162'),
(111, 'Kenya', 'KE', '+254', 'Kênia', '3', 1389088162, '1389088162'),
(112, 'Kiribati', 'KI', '+686', 'Kiribati', '3', 1389088162, '1389088162'),
(113, 'Korea, North', 'KP', '+1', 'Coréia do Norte', '3', 1389088162, '1389088162'),
(114, 'Korea, South', 'KR', '+1', 'Coréia do Sul', '3', 1389088162, '1389088162'),
(115, 'Kuwait', 'KW', '+965', 'Kuait', '3', 1389088162, '1389088162'),
(116, 'Kyrgyzstan', 'KG', '+996', 'Kyrgyzstan', '3', 1389088162, '1389088162'),
(117, 'Laos', 'LA', '+856', 'Laos', '3', 1389088162, '1389088162'),
(118, 'Latvia', 'LV', '+371', 'Látvia', '3', 1389088162, '1389088162'),
(119, 'Lebanon', 'LB', '+961', 'Líbano', '3', 1389088162, '1389088162'),
(120, 'Lesotho', 'LS', '+266', 'Lesoto', '3', 1389088162, '1389088162'),
(121, 'Liberia', 'LR', '+231', 'Libéria', '3', 1389088162, '1389088162'),
(122, 'Libya', 'LY', '+218', 'Líbia', '3', 1389088162, '1389088162'),
(123, 'Liechtenstein', 'LI', '+423', 'Liechtenstein', '3', 1389088162, '1389088162'),
(124, 'Lithuania', 'LT', '+370', 'Lituânia', '3', 1389088162, '1389088162'),
(125, 'Luxembourg', 'LU', '+352', 'Luxemburgo', '3', 1389088162, '1389088162'),
(126, 'Macau', 'MO', '+853', 'Macau', '3', 1389088162, '1389088162'),
(127, 'Macedonia', 'MK', '+389', 'Macedônia (República Yugoslava)', '3', 1389088162, '1389088162'),
(128, 'Madagascar', 'MG', '+261', 'Madagascar', '3', 1389088162, '1389088162'),
(129, 'Malawi', 'MW', '+265', 'Malaui', '3', 1389088162, '1389088162'),
(130, 'Malaysia', 'MY', '+60', 'Malásia', '3', 1389088162, '1389088162'),
(131, 'Maldives', 'MV', '+960', 'Maldivas', '3', 1389088162, '1389088162'),
(132, 'Mali', 'ML', '+223', 'Mali', '3', 1389088162, '1389088162'),
(133, 'Malta', 'MT', '+356', 'Malta', '3', 1389088162, '1389088162'),
(134, 'Marshall Islands', 'MH', '+692', 'Ilhas Marshall', '3', 1389088162, '1389088162'),
(135, 'Martinique', 'MQ', '+596', 'Martinica', '3', 1389088162, '1389088162'),
(136, 'Mauritania', 'MR', '+222', 'Mauritânia', '3', 1389088162, '1389088162'),
(137, 'Mauritius', 'MU', '+230', 'Maurício', '3', 1389088162, '1389088162'),
(138, 'Mayotte', 'YT', '+269', 'Mayotte', '3', 1389088162, '1389088162'),
(139, 'Mexico', 'MX', '+52', 'Mexico', '3', 1389088162, '1389088162'),
(140, 'Micronesia', 'FM', '+691', 'Micronésia', '3', 1389088162, '1389088162'),
(141, 'Moldova', 'MD', '+373', 'Moldova', '3', 1389088162, '1389088162'),
(142, 'Monaco', 'MC', '+377', 'Mônaco', '3', 1389088162, '1389088162'),
(143, 'Mongolia', 'MN', '+976', 'Mongólia', '3', 1389088162, '1389088162'),
(144, 'Montserrat', 'MS', '+1', 'Montserrat', '3', 1389088162, '1389088162'),
(145, 'Morocco', 'MA', '+212', 'Marrocos', '3', 1389088162, '1389088162'),
(146, 'Mozambique', 'MZ', '+258', 'Moçambique', '3', 1389088162, '1389088162'),
(147, 'Myanmar', 'MM', '+95', 'Myanma (Ex-Burma)', '3', 1389088162, '1389088162'),
(148, 'Namibia', 'NA', '+264', 'Namíbia', '3', 1389088162, '1389088162'),
(149, 'Nauru', 'NR', '+674', 'Nauru', '3', 1389088162, '1389088162'),
(150, 'Nepal', 'NP', '+977', 'Nepal', '3', 1389088162, '1389088162'),
(151, 'Netherlands', 'NL', '+31', 'Holanda', '3', 1389088162, '1389088162'),
(152, 'Netherlands Antilles', 'AN', '+599', 'Antilhas Holandesas', '3', 1389088162, '1389088162'),
(153, 'New Caledonia', 'NC', '+687', 'Nova Caledônia', '3', 1389088162, '1389088162'),
(154, 'New Zealand', 'NZ', '+64', 'Nova Zelândia', '3', 1389088162, '1389088162'),
(155, 'Nicaragua', 'NI', '+505', 'Nicarágua', '3', 1389088162, '1389088162'),
(156, 'Niger', 'NE', '+227', 'Níger', '3', 1389088162, '1389088162'),
(157, 'Nigeria', 'NG', '+234', 'Nigéria', '3', 1389088162, '1389088162'),
(158, 'Niue', 'NU', '+683', 'Niue', '3', 1389088162, '1389088162'),
(159, 'Norfolk Island', 'NF', '+6723', '', '3', 1389088162, '1389088162'),
(160, 'Northern Mariana Islands', 'MP', '+670', '', '3', 1389088162, '1389088162'),
(161, 'Norway', 'NO', '+47', 'Noruega', '3', 1389088162, '1389088162'),
(162, 'Oman', 'OM', '+968', 'Omã', '3', 1389088162, '1389088162'),
(163, 'Pakistan', 'PK', '+92', 'Paquistão', '3', 1389088162, '1389088162'),
(164, 'Palau', 'PW', '+680', 'Palau', '3', 1389088162, '1389088162'),
(165, 'Palestine', 'PS', '+970', '', '3', 1389088162, '1389088162'),
(166, 'Panama', 'PA', '+507', 'Panamá', '3', 1389088162, '1389088162'),
(167, 'Papua New Guinea', 'PG', '+675', 'Papua-Nova Guiné', '3', 1389088162, '1389088162'),
(168, 'Paraguay', 'PY', '+595', 'Paraguai', '3', 1389088162, '1389088162'),
(169, 'Peru', 'PE', '+51', 'Peru', '3', 1389088162, '1389088162'),
(170, 'Philippines', 'PH', '+63', 'Filipinas', '3', 1389088162, '1389088162'),
(171, 'Pitcairn', 'PN', '+1', 'Ilha Pitcairn', '3', 1389088162, '1389088162'),
(172, 'Poland', 'PL', '+48', 'Polônia', '3', 1389088162, '1389088162'),
(173, 'Portugal', 'PT', '+351', 'Portugal', '1', 1389088162, '1389088162'),
(174, 'Puerto Rico', 'PR', '+1', 'Porto Rico', '3', 1389088162, '1389088162'),
(175, 'Qatar', 'QA', '+974', 'Qatar', '3', 1389088162, '1389088162'),
(176, 'Reunion', 'RE', '+262', 'Ilha Reunião', '3', 1389088162, '1389088162'),
(177, 'Romania', 'RO', '+40', 'Romênia', '3', 1389088162, '1389088162'),
(178, 'Russian Federation', 'RU', '+7', '', '3', 1389088162, '1389088162'),
(179, 'Rwanda', 'RW', '+250', 'Ruanda', '3', 1389088162, '1389088162'),
(180, 'Saint Helena', 'SH', '+290', 'Santa Helena', '3', 1389088162, '1389088162'),
(181, 'Saint Kitts and Nevis', 'KN', '+1', 'São Cristóvão e Névis', '3', 1389088162, '1389088162'),
(182, 'Saint Lucia', 'LC', '+1', 'Santa Lúcia', '3', 1389088162, '1389088162'),
(183, 'Saint Pierre and Miquelon', 'PM', '+508', 'St. Pierre and Miquelon', '3', 1389088162, '1389088162'),
(184, 'Saint Vincent and the Grenadines', 'VC', '+1', 'Saint Vincente e Granadinas', '3', 1389088162, '1389088162'),
(185, 'Samoa', 'WS', '+685', 'Samoa Ocidental', '3', 1389088162, '1389088162'),
(186, 'San Marino', 'SM', '+378', 'San Marino', '3', 1389088162, '1389088162'),
(187, 'Sao Tome and Principe', 'ST', '+239', 'São Tomé e Príncipe', '3', 1389088162, '1389088162'),
(188, 'Saudi Arabia', 'SA', '+966', 'Arábia Saudita', '3', 1389088162, '1389088162'),
(189, 'Senegal', 'SN', '+221', 'Senegal', '3', 1389088162, '1389088162'),
(190, 'Serbia and Montenegro', 'CS', '+1', '', '3', 1389088162, '1389088162'),
(191, 'Seychelles', 'SC', '+248', 'Ilhas Seychelles', '3', 1389088162, '1389088162'),
(192, 'Sierra Leone', 'SL', '+232', 'Serra Leoa', '3', 1389088162, '1389088162'),
(193, 'Singapore', 'SG', '+65', 'Cingapura', '3', 1389088162, '1389088162'),
(194, 'Slovakia', 'SK', '+421', 'Eslováquia', '3', 1389088162, '1389088162'),
(195, 'Slovenia', 'SI', '+386', 'Eslovênia', '3', 1389088162, '1389088162'),
(196, 'Solomon Islands', 'SB', '+677', 'Ilhas Solomão', '3', 1389088162, '1389088162'),
(197, 'Somalia', 'SO', '+252', 'Somália', '3', 1389088162, '1389088162'),
(198, 'South Africa', 'ZA', '+27', 'África do Sul', '3', 1389088162, '1389088162'),
(199, 'South Georgia and South Sandwich Islands', 'GS', '+1', 'Ilhas Geórgia do Sul e Sandwich do Sul', '3', 1389088162, '1389088162'),
(200, 'Spain', 'ES', '+34', 'Espanha', '3', 1389088162, '1389088162'),
(201, 'Sri Lanka', 'LK', '+94', 'Sri Lanka', '3', 1389088162, '1389088162'),
(202, 'Sudan', 'SD', '+249', 'Sudão', '3', 1389088162, '1389088162'),
(203, 'Suriname', 'SR', '+597', 'Suriname', '3', 1389088162, '1389088162'),
(204, 'Svalbard and Jan Mayen Islands', 'SJ', '+1', 'Ilhas Svalbard e Jan Mayen', '3', 1389088162, '1389088162'),
(205, 'Swaziland', 'SZ', '+268', 'Suazilândia', '3', 1389088162, '1389088162'),
(206, 'Sweden', 'SE', '+46', 'Suécia', '3', 1389088162, '1389088162'),
(207, 'Switzerland', 'CH', '+41', 'Suíça', '3', 1389088162, '1389088162'),
(208, 'Syria', 'SY', '+963', 'Síria', '3', 1389088162, '1389088162'),
(209, 'Taiwan', 'TW', '+886', 'Taiwan', '3', 1389088162, '1389088162'),
(210, 'Tajikistan', 'TJ', '+992', 'Tadjiquistão', '3', 1389088162, '1389088162'),
(211, 'Tanzania', 'TZ', '+255', '', '3', 1389088162, '1389088162'),
(212, 'Thailand', 'TH', '+66', 'Tailândia', '3', 1389088162, '1389088162'),
(213, 'Timor-Leste', 'TL', '+670', 'Timor Leste (Ex-East Timor)', '3', 1389088162, '1389088162'),
(214, 'Togo', 'TG', '+228', 'Togo', '3', 1389088162, '1389088162'),
(215, 'Tokelau', 'TK', '+690', 'Ilhas Tokelau', '3', 1389088162, '1389088162'),
(216, 'Tonga', 'TO', '+676', 'Tonga', '3', 1389088162, '1389088162'),
(217, 'Trinidad and Tobago', 'TT', '+1', 'Trinidad and Tobago', '3', 1389088162, '1389088162'),
(218, 'Tunisia', 'TN', '+216', 'Tunísia', '3', 1389088162, '1389088162'),
(219, 'Turkey', 'TR', '+90', 'Turquia', '3', 1389088162, '1389088162'),
(220, 'Turkmenistan', 'TM', '+993', 'Turcomenistão', '3', 1389088162, '1389088162'),
(221, 'Turks and Caicos Islands', 'TC', '+1', 'Ilhas Turks e Caicos', '3', 1389088162, '1389088162'),
(222, 'Tuvalu', 'TV', '+688', 'Tuvalu', '3', 1389088162, '1389088162'),
(223, 'Uganda', 'UG', '+256', 'Uganda', '3', 1389088162, '1389088162'),
(224, 'Ukraine', 'UA', '+380', 'Ucrânia', '3', 1389088162, '1389088162'),
(225, 'United Arab Emirates', 'AE', '+971', 'Emirados Árabes Unidos', '3', 1389088162, '1389088162'),
(226, 'United Kingdom', 'GB', '+44', 'Grã-Bretanha (Reino Unido, UK)', '3', 1389088162, '1389088162'),
(227, 'United States Minor Outlying Islands', 'UM', '+1', 'Ilhas Menores dos Estados Unidos', '3', 1389088162, '1389088162'),
(228, 'United States of America', 'US', '+1', 'Estados Unidos', '3', 1389088162, '1389088162'),
(229, 'Uruguay', 'UY', '+598', 'Uruguai', '3', 1389088162, '1389088162'),
(230, 'Uzbekistan', 'UZ', '+998', 'Uzbequistão', '3', 1389088162, '1389088162'),
(231, 'Vanuatu', 'VU', '+678', 'Vanuatu', '3', 1389088162, '1389088162'),
(232, 'Vatican City', 'VA', '+1', 'Vaticano', '3', 1389088162, '1389088162'),
(233, 'Venezuela', 'VE', '+58', 'Venezuela', '3', 1389088162, '1389088162'),
(234, 'Vietnam', 'VN', '+84', 'Vietnam', '3', 1389088162, '1389088162'),
(235, 'Virgin Islands, British', 'VG', '+1', 'Ilhas Virgens (Inglaterra)', '3', 1389088162, '1389088162'),
(236, 'Virgin Islands, U.S.', 'VI', '+1', 'Ilhas Virgens (Estados Unidos)', '3', 1389088162, '1389088162'),
(237, 'Wallis and Futuna Islands', 'WF', '+681', 'Ilhas Wallis e Futuna', '3', 1389088162, '1389088162'),
(238, 'Western Sahara', 'EH', '+1', 'Saara Ocidental (Ex-Spanish Sahara)', '3', 1389088162, '1389088162'),
(239, 'Yemen', 'YE', '+967', 'Iêmen', '3', 1389088162, '1389088162'),
(240, 'Zambia', 'ZM', '+260', 'Zâmbia', '3', 1389088162, '1389088162'),
(241, 'Zimbabwe', 'ZW', '+263', 'Zimbábue', '3', 1389088162, '1389088162'),
(244, 'AAAA', '', '', '', '3', 1389088162, '1389088162');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE IF NOT EXISTS `districts` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dropdown_managers`
--

CREATE TABLE IF NOT EXISTS `dropdown_managers` (
`id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `dropdown_type` varchar(55) NOT NULL,
  `name` varchar(105) NOT NULL,
  `description` longtext NOT NULL,
  `slug` varchar(105) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dropdown_managers`
--

INSERT INTO `dropdown_managers` (`id`, `parent_id`, `dropdown_type`, `name`, `description`, `slug`, `created`, `modified`) VALUES
(1, 0, 'client_types', 'Realtor', 'Realtor', 'realtor', '2015-02-28 16:49:46', '2015-02-28 16:53:40'),
(2, 0, 'client_types', 'Commercial', 'Commercial', 'commercial', '2015-02-28 16:52:47', '2015-02-28 16:52:47');

-- --------------------------------------------------------

--
-- Table structure for table `email_actions`
--

CREATE TABLE IF NOT EXISTS `email_actions` (
`id` int(11) NOT NULL,
  `action` varchar(55) NOT NULL,
  `options` varchar(200) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email_actions`
--

INSERT INTO `email_actions` (`id`, `action`, `options`) VALUES
(1, 'Registration', 'USER_NAME,EMAIL_ADDRESS,VERIFY_LINK,WEBSITE_URL,PASSWORD'),
(2, 'VerificationMail', 'USER_NAME,EMAIL_ADDRESS,LOGIN_LINK,FULL_NAME,PASSWORD,WEBSITE_URL'),
(3, 'ForgotPassword', 'USER_NAME,EMAIL_ADDRESS,RESET_LINK,WEBSITE_URL'),
(4, 'UserPasswordChangedSuccessfully', 'USER_NAME,EMAIL_ADDRESS,WEBSITE_URL'),
(28, 'PersonalInboxNotification', 'USER_NAME,EMAIL_ADDRESS,WEBSITE_URL'),
(29, 'contact_added', 'FIRST_NAME,LAST_NAME,EMAIL,PHONE_NUMBER,PASSWORD,WEBSITE_URL'),
(30, 'booking_confirmation', 'SHOOT_TITLE,SHOOT_DATE,SHOOT_SIZE,SHOOT_PRICE,PRODUCT,PHOTOGRAPHER,FIRST_NAME,LAST_NAME'),
(31, 'editing_status_done', 'SHOOT_TITLE,SHOOT_TIME'),
(32, 'invoice_reminder', 'SHOOT_TITLE,SHOOT_TIME,FIRST_NAME,LAST_NAME,RELEASE_DATE,PAYMENT'),
(33, 'release_email', 'SHOOT_TITLE,SHOOT_TIME,FIRST_NAME,LAST_NAME,RELEASE_DATE'),
(34, 'partner_upgrade_confirmation', 'PARTNER_NAME,PRICE,UPGRADE_TYPE'),
(35, 'partner_upgradeaddresource_confirmation', 'PARTNER_NAME,PRICE,UPGRADE_TYPE'),
(36, 'partner_upgradeaddnews_confirmation', 'PARTNER_NAME,PRICE,UPGRADE_TYPE'),
(37, 'campaign_highlight_confirmation', 'PARTNER_NAME,PRICE'),
(38, 'resource_reserve_confirmation_user', 'USER_NAME,PRODUCT_NAME,PRODUCT_PRICE,PRODUCT_QUANTITY,TOTAL_PRICE'),
(39, 'InvoiceSent', 'USER_NAME,EMAIL_ADDRESS,WEBSITE_URL'),
(40, 'invoice_past_due_email', 'SHOOT_TITLE,SHOOT_TIME,FIRST_NAME,LAST_NAME,RELEASE_DATE,PAYMENT'),
(41, 'invoice_paid_email', 'SHOOT_TITLE,SHOOT_TIME,FIRST_NAME,LAST_NAME,RELEASE_DATE,PAYMENT'),
(42, 'shoot_feedback', 'SHOOT_TITLE,FIRST_NAME,LAST_NAME,COMMENT');

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE IF NOT EXISTS `email_templates` (
`id` bigint(20) NOT NULL,
  `name` varchar(105) NOT NULL,
  `subject` text NOT NULL,
  `action` varchar(55) NOT NULL,
  `body` longtext NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `name`, `subject`, `action`, `body`, `created`, `modified`) VALUES
(1, 'Registration Successful', 'Registration Successful', 'Registration', '<p>Dear {USER_NAME}</p>\r\n\r\n<p>Your account has been registered successfully. Please click the below link to verify your account.&nbsp;&nbsp;{VERIFY_LINK}</p>\r\n\r\n<p>Password:-&nbsp; {PASSWORD}</p>\r\n\r\n<p><br />\r\n<em>Best Regards<br />\r\nTeam Tour Shout</em></p>\r\n', '2013-01-24 01:25:31', '2015-06-15 04:33:22'),
(4, 'Recover Forgot Password', 'Recover Forgot Password', 'UserPasswordChangedSuccessfully', '<p>Hi {USER_NAME},</p>\r\n\r\n<p>You have successfully reset your password. Please click below link to login.</p>\r\n\r\n<p>{WEBSITE_URL}</p>\r\n\r\n<p>Best Regards<br />\r\nTeam TourShout</p>\r\n', '2013-09-02 05:05:37', '2015-06-25 19:53:32'),
(2, 'Verify Registration', 'Verify Registration', 'VerificationMail', '<p>&nbsp; Dear {USER_NAME},</p>\r\n\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Your account is verified successfully.&nbsp; You can now sign in to aniima.com.</p>\r\n\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Email:-{EMAIL_ADDRESS}</p>\r\n\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; For login :- {LOGIN_LINK}</p>\r\n\r\n<p>&nbsp; Best Regards</p>\r\n\r\n<p>&nbsp; Team TourShout</p>\r\n', '2013-01-24 01:29:18', '2015-06-25 19:54:06'),
(3, 'Forgot Password', 'Forgot Password', 'Forgot Password', '<p>Dear {USER_NAME},</p>\r\n\r\n<p>Please click on the below link to reset your password. {RESET_LINK}</p>\r\n\r\n<p>Best Regards<br />\r\nTeam Tour Shout</p>\r\n', '2013-01-24 01:33:01', '2015-06-15 04:33:59'),
(5, 'Contact Added', 'Contact Added', 'contact_added', '<p>&nbsp;</p>\r\n\r\n<p>Hi {FIRST_NAME} {LAST_NAME},</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>You have been added in {WEBSITE_URL}&nbsp;with phone number {PHONE_NUMBER}&nbsp;and email address {EMAIL}.</p>\r\n\r\n<p>Your password is :&nbsp;{PASSWORD}</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Thanks</p>\r\n\r\n<p><em><strong>TourShout Team</strong></em></p>\r\n', '2015-05-12 20:30:35', '2015-07-11 19:59:30'),
(6, 'Booking Information', 'Booking Information', 'booking_confirmation', '<p><span style="line-height: 1.6em;">Hi </span>{FIRST_NAME}<span style="line-height: 1.6em;">&nbsp;</span>{LAST_NAME}<span style="line-height: 1.6em;">,</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;A shoot named <strong>&quot;</strong>{SHOOT_TITLE}<strong>&quot;</strong> is scheduled on {SHOOT_DATE}&nbsp;for you in price {SHOOT_PRICE}<strong>USD</strong>.</p>\r\n\r\n<p>&nbsp;Product :&nbsp;{PRODUCT}</p>\r\n\r\n<p>Shoot size :&nbsp;{SHOOT_SIZE} sq. ft.</p>\r\n\r\n<p><span style="line-height: 20.7999992370605px;">PHOTOGRAPHER:&nbsp;</span>{PHOTOGRAPHER}</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Thanks</p>\r\n\r\n<p><strong><em>TourShout Team</em></strong></p>\r\n', '2015-05-12 20:31:47', '2015-06-16 06:01:50'),
(7, 'Editing Status Done', 'Editing Status Done', 'editing_status_done', '<p>Hi,</p>\r\n\r\n<p>A new Editing Status changed to Done.</p>\r\n\r\n<p>for shout&nbsp;{SHOOT_TITLE} on&nbsp;{SHOOT_TIME}</p>\r\n\r\n<p>Thanks</p>\r\n\r\n<p><em><strong>TourShout Team</strong></em></p>\r\n', '2015-05-12 20:32:36', '2015-06-17 03:07:27'),
(8, 'Invoice Reminder', 'Invoice Reminder', 'invoice_reminder', '<p>Hi {FIRST_NAME}&nbsp;{LAST_NAME},</p>\r\n\r\n<p>This is the reminder for your invoice to pay.</p>\r\n\r\n<p>For Shout :&nbsp;{SHOOT_TITLE}</p>\r\n\r\n<p>Shout Time :&nbsp;{SHOOT_TIME}</p>\r\n\r\n<p>Shout Release Date :&nbsp;{RELEASE_DATE}</p>\r\n\r\n<p>Invoice Payment :&nbsp;{PAYMENT}</p>\r\n\r\n<p>Thanks</p>\r\n\r\n<p><em><strong>TourShout Team</strong></em></p>\r\n', '2015-05-12 20:33:22', '2015-06-17 03:32:57'),
(9, 'Release Email', 'Release Email', 'release_email', '<p>Hi,</p>\r\n\r\n<p>Your gallery is released on TourShoot and now ready for download.</p>\r\n\r\n<p>Thanks</p>\r\n\r\n<p><em><strong>TourShout Team</strong></em></p>\r\n', '2015-05-12 20:34:37', '2015-05-12 20:42:40'),
(10, 'Invoice Past Due email', 'Invoice Past Due email', 'invoice_past_due_email', '<p>Hi {FIRST_NAME}&nbsp;{LAST_NAME},&nbsp;</p><p>&nbsp;</p><p>Please pay your Past Due payment of&nbsp;{PAYMENT} for shout &quot;{SHOOT_TITLE}&quot;.</p><p>Thanks</p><p>The TourShout Team</p>', '2015-06-23 18:53:19', '2015-06-23 19:07:21'),
(11, 'Invoice Paid email', 'Invoice Paid email', 'invoice_paid_email', '<p><span style="line-height: 1.6em;">Hi </span>{FIRST_NAME}&nbsp;{LAST_NAME}<span style="line-height: 1.6em;">,</span></p><p>Your payment of&nbsp;{PAYMENT} for shoot&nbsp;{SHOOT_TITLE} successful completed.</p><p><span style="line-height: 1.6em;">Thanks for payment. </span></p><p><span style="line-height: 1.6em;">Regards</span></p><p><span style="line-height: 1.6em;">The TourShout Team</span></p>', '2015-06-23 18:54:19', '2015-06-23 19:05:41'),
(12, 'Shoot Feedback', 'Shoot Feedback', 'shoot_feedback', '<p>Hi&nbsp;{FIRST_NAME}&nbsp;{LAST_NAME},</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Following feed back is provided by the client of shoot &quot;{SHOOT_TITLE}&quot;</p>\r\n\r\n<p>Comment:&nbsp;{COMMENT}</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Regards</p>\r\n\r\n<p>The TourShout Team</p>\r\n', '2015-06-30 19:49:17', '2015-06-30 19:57:07');

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE IF NOT EXISTS `galleries` (
`id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `gallery_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `hour` int(11) NOT NULL,
  `min` int(11) NOT NULL,
  `meridian` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `require_payment_for_access` int(11) NOT NULL DEFAULT '0',
  `recipient` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1-active, 2-dilivered, 3-released',
  `include_project_title` int(11) DEFAULT '0',
  `alt_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `include_agent_title` int(11) DEFAULT '0',
  `alt_agent_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `include_agent_contact` int(11) DEFAULT '0',
  `alt_agent_phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alt_agent_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `include_mls_number` int(11) DEFAULT '0',
  `mls_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `modified` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `client_id`, `gallery_title`, `date`, `hour`, `min`, `meridian`, `require_payment_for_access`, `recipient`, `status`, `include_project_title`, `alt_title`, `include_agent_title`, `alt_agent_title`, `include_agent_contact`, `alt_agent_phone`, `alt_agent_email`, `include_mls_number`, `mls_number`, `created`, `modified`) VALUES
(1, 6, '12 3 Maint st   dallas AL', '3-03-2015', 9, 3, 'pm', 0, 2, 3, 1, 'dsfsdf', 1, 'sdfsdf', 1, 'dsfsdf', 'sdfsdf', 1, 'sdfsdf', '1426364386', '1427222593'),
(2, 6, 'New test gallery', '31-03-2015', 8, 29, 'pm', 1, 2, 2, 0, '', 0, '', 0, '', '', 0, '', '1427226072', '1427226507'),
(3, 6, 'sadasd sad', '4-03-2015', 10, 0, 'am', 1, 2, 1, 0, NULL, 0, NULL, 0, NULL, NULL, 0, NULL, '1427306621', '1427306621'),
(4, 6, 'sadasd sad', '4-03-2015', 10, 0, 'am', 1, 2, 2, 0, NULL, 0, NULL, 0, NULL, NULL, 0, NULL, '1427306652', '1449635051'),
(5, 5, 'sadasd sad', '4-12-2015', 10, 0, 'am', 1, 5, 1, 0, NULL, 0, NULL, 0, NULL, NULL, 0, NULL, '1427315545', '1427315545'),
(6, 5, 'sadasd sad', '4-12-2015', 10, 0, 'am', 1, 5, 1, 0, NULL, 0, NULL, 0, NULL, NULL, 0, NULL, '1427315568', '1427315568'),
(7, 5, '123 Main st. ', '04-25-2015', 10, 0, 'am', 1, 5, 2, 1, '', 1, '', 1, '', '', 1, '324346554654', '1429973323', '1430001343'),
(8, 5, '123 Main st. ', '04-9-2015', 10, 0, 'am', 1, 5, 2, 1, '', 1, '', 1, '', '', 1, '', '1429974230', '1436576582'),
(9, 5, '123 Main st. ', '04-27-2015', 10, 0, 'am', 1, 5, 3, 0, NULL, 0, NULL, 0, NULL, NULL, 0, NULL, '1430001579', '1435598753'),
(10, 7, '123 Main st. ', '06-4-2015', 10, 0, 'am', 1, 7, 1, 0, NULL, 0, NULL, 0, NULL, NULL, 0, NULL, '1434334323', '1434334323'),
(11, 13, '401 nort avevnue 9a road sikar road jaipur ', '07-12-2015', 10, 0, 'am', 1, 13, 1, 0, NULL, 0, NULL, 0, NULL, NULL, 0, NULL, '1434427033', '1434427033'),
(12, 13, '123 Main st.dfgfd ', '06-20-2015', 10, 0, 'am', 1, 13, 1, 0, NULL, 0, NULL, 0, NULL, NULL, 0, NULL, '1434427344', '1434427344'),
(13, 13, '401dsfsd sdf ', '06-19-2015', 10, 0, 'am', 1, 13, 1, 0, NULL, 0, NULL, 0, NULL, NULL, 0, NULL, '1434506173', '1434506173'),
(14, 13, '12sadsa3 Main st. ', '06-23-2015', 3, 0, 'pm', 1, 13, 1, 0, NULL, 0, NULL, 0, NULL, NULL, 0, NULL, '1435080184', '1435080184'),
(15, 13, '123 as Main st. ', '06-25-2015', 10, 0, 'am', 1, 13, 1, 0, NULL, 0, NULL, 0, NULL, NULL, 0, NULL, '1435253708', '1435253708'),
(16, 5, '123 Main st. dfdf', '07-13-2015', 10, 0, 'am', 1, 5, 1, 0, NULL, 0, NULL, 0, NULL, NULL, 0, NULL, '1436550407', '1436550407'),
(17, 5, '123 Main st. dfdf', '07-11-2015', 10, 0, 'am', 1, 5, 1, 0, NULL, 0, NULL, 0, NULL, NULL, 0, NULL, '1436550489', '1436550489'),
(18, 5, '123 Main st.dsdr dfdf', '07-11-2015', 10, 0, 'am', 1, 5, 1, 0, NULL, 0, NULL, 0, NULL, NULL, 0, NULL, '1436585577', '1436585577'),
(19, 5, '123 Main st. dfdf', '06-31-2015', 10, 0, 'am', 1, 5, 1, 0, NULL, 0, NULL, 0, NULL, NULL, 0, NULL, '1436648304', '1436648304'),
(20, 5, '123 Main st. dfdf', '06-31-2015', 10, 0, 'am', 1, 5, 1, 0, NULL, 0, NULL, 0, NULL, NULL, 0, NULL, '1436649190', '1436649190'),
(21, 5, '401dsfsd sdf as', '07-8-2015', 10, 0, 'am', 1, 11, 1, 0, NULL, 0, NULL, 0, NULL, NULL, 0, NULL, '1436687170', '1436687170'),
(22, 5, '401dsfsd sdf as', '07-8-2015', 10, 0, 'am', 1, 11, 1, 0, NULL, 0, NULL, 0, NULL, NULL, 0, NULL, '1436687311', '1436687311'),
(23, 5, '401dsfsd sdf as', '07-8-2015', 10, 0, 'am', 1, 11, 1, 0, NULL, 0, NULL, 0, NULL, NULL, 0, NULL, '1436687353', '1436687353'),
(24, 5, '401dsfsd sdf as', '07-13-2015', 10, 0, 'am', 1, 11, 1, 0, NULL, 0, NULL, 0, NULL, NULL, 0, NULL, '1436687376', '1436687376'),
(25, 6, '123 Main st. dfdf', '12-10-2015', 10, 0, 'am', 1, 2, 1, 0, NULL, 0, NULL, 0, NULL, NULL, 0, NULL, '1449860602', '1449860602'),
(26, 6, '123 Main st. dfdf', '12-11-2015', 10, 0, 'am', 1, 2, 1, 0, NULL, 0, NULL, 0, NULL, NULL, 0, NULL, '1449860660', '1449860660'),
(27, 6, '123 Main st. dfdf', '12-9-2015', 10, 0, 'am', 1, 2, 1, 0, NULL, 0, NULL, 0, NULL, NULL, 0, NULL, '1449860950', '1449860950'),
(28, 6, '123 Main st. dfdf', '12-8-2015', 10, 0, 'am', 1, 2, 1, 0, NULL, 0, NULL, 0, NULL, NULL, 0, NULL, '1449861384', '1449861384'),
(29, 6, '123 Main st. dfdf', '12-8-2015', 10, 0, 'am', 1, 2, 1, 0, NULL, 0, NULL, 0, NULL, NULL, 0, NULL, '1449862144', '1449862144'),
(30, 6, '123 Main st. dfdf', '12-8-2015', 10, 0, 'am', 1, 2, 3, 0, NULL, 0, NULL, 0, NULL, NULL, 0, NULL, '1449862173', '1449865570'),
(31, 6, '123 Main st. dfdf', '12-15-2015', 10, 0, 'am', 1, 2, 1, 0, NULL, 0, NULL, 0, NULL, NULL, 0, NULL, '1449987799', '1449987799'),
(32, 6, '123 Main st. dfdf', '12-14-2015', 10, 0, 'am', 1, 2, 1, 0, NULL, 0, NULL, 0, NULL, NULL, 0, NULL, '1449987933', '1449987933');

-- --------------------------------------------------------

--
-- Table structure for table `gallery_images`
--

CREATE TABLE IF NOT EXISTS `gallery_images` (
`id` int(11) NOT NULL,
  `gallery_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_folder` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sort` int(11) NOT NULL DEFAULT '0',
  `created` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `modified` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `gallery_images`
--

INSERT INTO `gallery_images` (`id`, `gallery_id`, `image`, `image_folder`, `sort`, `created`, `modified`) VALUES
(3, 1, '90dea5345884c4f94ef075f787e043f2csign.gif.gif', 'gallery_1', 2, '1427164403', '1428262157'),
(4, 1, '90dea5345884c4f94ef075f787e043f2dsign.gif.gif', 'gallery_1', 2, '1427164403', '1428262251'),
(5, 1, '90dea5345884c4f94ef075f787e043f2hqsign.gif.gif', 'gallery_1', 3, '1427164403', '1427164403'),
(6, 1, '90dea5345884c4f94ef075f787e043f2ressign.gif.gif', 'gallery_1', 5, '1427164403', '1427164403'),
(7, 1, '01bb4199da018c28c43a3ab56a0a1770background.jpg.jpg', 'gallery_1', 4, '1427164913', '1427164913'),
(8, 2, '15-01-DOOL - Webiste Layout 01.jpg.jpg', 'gallery_2', 0, '1427226481', '1428353931'),
(9, 7, 'life-code-typography-hd-wallpaper.jpg.jpg', 'gallery_7', 2, '1429979272', '1429979272'),
(10, 7, 'minimalistic-programming_00252003.jpg.jpg', 'gallery_7', 6, '1429979272', '1429979272'),
(11, 7, 'Programming_Wordle.jpg.jpg', 'gallery_7', 9, '1429979272', '1429979272'),
(12, 7, 'programming-code_00275233.jpg.jpg', 'gallery_7', 12, '1429979272', '1429979272'),
(13, 7, 'life-code-typography-hd-wallpaper.jpg.jpg', 'gallery_7', 3, '1430000871', '1430000871'),
(14, 7, 'minimalistic-programming_00252003.jpg.jpg', 'gallery_7', 7, '1430000871', '1430000871'),
(15, 7, 'Programming_Wordle.jpg.jpg', 'gallery_7', 10, '1430000871', '1430000871'),
(16, 7, 'programming-code_00275233.jpg.jpg', 'gallery_7', 13, '1430000871', '1430000871'),
(17, 7, 'life-code-typography-hd-wallpaper.jpg.jpg', 'gallery_7', 4, '1430000962', '1430000962'),
(18, 7, 'minimalistic-programming_00252003.jpg.jpg', 'gallery_7', 8, '1430000962', '1430000962'),
(19, 7, 'Programming_Wordle.jpg.jpg', 'gallery_7', 11, '1430000962', '1430000962'),
(20, 7, 'programming-code_00275233.jpg.jpg', 'gallery_7', 14, '1430000962', '1430000962'),
(21, 7, 'life-code-typography-hd-wallpaper.jpg', 'gallery_7', 1, '1430001343', '1430001343'),
(22, 7, 'minimalistic-programming_00252003.jpg', 'gallery_7', 5, '1430001343', '1430001343'),
(24, 8, '204 Circleview Dr-0002.jpg.jpg', 'gallery_8', 1, '1430790553', '1430790553'),
(25, 8, '204 Circleview Dr-0003.jpg.jpg', 'gallery_8', 2, '1430790553', '1430790553'),
(26, 8, '204 Circleview Dr-0004.jpg.jpg', 'gallery_8', 3, '1430790553', '1430790553'),
(27, 8, '204 Circleview Dr-0005.jpg.jpg', 'gallery_8', 4, '1430790553', '1430790553'),
(28, 8, '204 Circleview Dr-0006.jpg.jpg', 'gallery_8', 5, '1430790553', '1430790553'),
(29, 8, '204 Circleview Dr-0007.jpg.jpg', 'gallery_8', 6, '1430790554', '1430790554'),
(30, 8, '204 Circleview Dr-0008.jpg.jpg', 'gallery_8', 7, '1430790554', '1430790554'),
(31, 8, '204 Circleview Dr-0009.jpg.jpg', 'gallery_8', 8, '1430790554', '1430790554'),
(32, 8, '204 Circleview Dr-0010.jpg.jpg', 'gallery_8', 9, '1430790554', '1430790554'),
(33, 8, '204 Circleview Dr-0011.jpg.jpg', 'gallery_8', 10, '1430790554', '1430790554'),
(34, 8, '204 Circleview Dr-0012.jpg.jpg', 'gallery_8', 11, '1430790554', '1430790554'),
(35, 8, '204 Circleview Dr-0013.jpg.jpg', 'gallery_8', 12, '1430790554', '1430790554'),
(36, 8, '204 Circleview Dr-0014.jpg.jpg', 'gallery_8', 13, '1430790555', '1430790555'),
(37, 8, '204 Circleview Dr-0015.jpg.jpg', 'gallery_8', 14, '1430790555', '1430790555'),
(38, 8, '204 Circleview Dr-0016.jpg.jpg', 'gallery_8', 15, '1430790555', '1430790555'),
(39, 8, '204 Circleview Dr-0017.jpg.jpg', 'gallery_8', 16, '1430790555', '1430790555'),
(40, 8, '204 Circleview Dr-0018.jpg.jpg', 'gallery_8', 17, '1430790555', '1430790555'),
(41, 8, '204 Circleview Dr-0019.jpg.jpg', 'gallery_8', 18, '1430790555', '1430790555'),
(43, 8, '204 Circleview Dr-0019.jpg.jpg', 'gallery_8', 19, '1430791925', '1430791925'),
(45, 9, 'life-code-typography-hd-wallpaper.jpg (2).jpg', 'gallery_9', 2, '1435028841', '1435028841'),
(47, 9, 'debug_is_programming-wallpaper-1600x900.jpg', 'gallery_9', 1, '1435077895', '1435077895'),
(48, 4, '37-buddha-incredible-india.preview.jpg', 'gallery_4', 2, '1449635050', '1449635050'),
(49, 4, '69th-Independence-day-wallpapers.jpg', 'gallery_4', 3, '1449635050', '1449635050'),
(50, 4, '10700268_295628300625708_3725866805908908581_o.jpg', 'gallery_4', 1, '1449635050', '1449635050'),
(51, 30, 'JC_logo.jpg', 'gallery_30', 1, '1449865391', '1449865391'),
(52, 30, 'JC_logo.jpg', 'gallery_30', 2, '1449865565', '1449865565');

-- --------------------------------------------------------

--
-- Table structure for table `image_albums`
--

CREATE TABLE IF NOT EXISTS `image_albums` (
`id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL DEFAULT '1',
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `name` varchar(255) NOT NULL,
  `default_image_id` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `modified` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `image_galleries`
--

CREATE TABLE IF NOT EXISTS `image_galleries` (
`id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `album_id` int(11) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `credit_en` varchar(255) NOT NULL,
  `image_alt_en` text NOT NULL,
  `link_text_en` varchar(255) NOT NULL,
  `image_url_en` varchar(255) NOT NULL,
  `description_en` text NOT NULL,
  `title_pt` varchar(255) NOT NULL,
  `credit_pt` varchar(255) NOT NULL,
  `image_alt_pt` varchar(255) NOT NULL,
  `link_text_pt` varchar(255) NOT NULL,
  `image_url_pt` varchar(255) NOT NULL,
  `description_pt` text NOT NULL,
  `title_sp` varchar(255) NOT NULL,
  `credit_sp` varchar(255) NOT NULL,
  `image_alt_sp` varchar(255) NOT NULL,
  `link_text_sp` varchar(255) NOT NULL,
  `image_url_sp` varchar(255) NOT NULL,
  `description_sp` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `folder` varchar(255) NOT NULL,
  `created` int(11) NOT NULL,
  `modified` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE IF NOT EXISTS `invoices` (
`id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `shoot_id` int(11) NOT NULL,
  `gallery_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `recipient_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `photographer_id` int(11) NOT NULL,
  `payment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `send_confirmation` int(11) NOT NULL,
  `due_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `send_reminder` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `discount_amount` double NOT NULL DEFAULT '0',
  `discount_description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paid` double NOT NULL DEFAULT '0',
  `created` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `modified` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tax` double NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `title`, `shoot_id`, `gallery_id`, `client_id`, `recipient_id`, `product_id`, `photographer_id`, `payment`, `send_confirmation`, `due_date`, `send_reminder`, `status`, `discount_amount`, `discount_description`, `paid`, `created`, `modified`, `tax`, `total`) VALUES
(1, 'sadasd sad sad AL 2134', 3, 4, 6, 2, 1, 9, '25.55', 1, '03-03-2015', 1, 0, 0, NULL, 0, '1427306652', '1436684957', 0, 25.55),
(2, 'sadasd sad sad AL 2134', 4, 5, 5, 5, 1, 9, '25.55', 1, '03-12-2015', 1, 1, 0, NULL, 25.55, '1427315545', '1431281148', 0, 25.55),
(3, 'sadasd sad sad AL 2134', 5, 6, 5, 5, 1, 9, '25.55', 1, '03-12-2015', 1, 1, 5.55, '5 dollar', 20, '1427315568', '1429996526', 0, 25.55),
(4, '123 Main st.  Dallas AL 3265', 6, 7, 5, 5, 1, 9, '25.55', 1, '04-24-2015', 1, 1, 0, NULL, 0, '1429973323', '1429973323', 0, 25.55),
(5, '123 Main st.  Dallas AL 3265', 7, 8, 5, 5, 1, 9, '25.55', 1, '04-08-2015', 1, 1, 0, NULL, 25.55, '1429974230', '1429974230', 0, 25.55),
(6, '123 Main st.  Dallas AL 3265', 8, 9, 5, 5, 1, 9, '25.55', 1, '04-26-2015', 1, 1, 0, NULL, 25.55, '1430001579', '1431285891', 0, 25.55),
(7, '123 Main st.  Dallas AL 3265', 9, 10, 7, 7, 1, 9, '25.55', 1, '06-03-2015', 1, 0, 0, NULL, 0, '1434334324', '1434334324', 0, 25.55),
(8, '401 nort avevnue 9a road sikar road jaipur  jaipur AL 302013', 10, 11, 13, 13, 1, 9, '25.55', 1, '06-08-2015', 1, 1, 0, NULL, 25.55, '1434427033', '1434427033', 0, 25.55),
(9, '123 Main st.dfgfd  Dallas AL 3265', 11, 12, 13, 13, 1, 9, '25.55', 1, '06-09-2015', 1, 0, 0, NULL, 0, '1434427345', '1434427345', 0, 25.55),
(10, '401dsfsd sdf  jaipur AL 302013', 12, 13, 13, 13, 1, 9, '25.55', 1, '06-18-2015', 1, 0, 0, NULL, 0, '1434506173', '1434506173', 0, 25.55),
(11, '12sadsa3 Main st.  Dallas AL 3265', 13, 14, 13, 13, 1, 9, '25.55', 1, '06-22-2015', 1, 1, 0, NULL, 25.55, '1435080184', '1435083641', 0, 25.55),
(12, '123 as Main st.  Dallas AL 3265', 14, 15, 13, 13, 1, 9, '25.55', 1, '06-25-2015', 1, 0, 0, NULL, 0, '1435253708', '1435253708', 0, 25.55),
(13, '123 Main st. dfdf Dallas AL 3265', 15, 16, 5, 5, 2, 9, '123', 1, '07-13-2015', 1, 0, 0, NULL, 0, '1436550407', '1436550407', 2.46, 125.46),
(14, '123 Main st. dfdf Dallas AL 3265', 16, 17, 5, 5, 2, 9, '123', 1, '07-13-2015', 1, 0, 0, NULL, 0, '1436550489', '1436550489', 2.46, 125.46),
(15, '123 Main st.dsdr dfdf Dallas AL 3265', 17, 18, 5, 5, 1, 9, '25.55', 1, '07-10-2015', 1, 0, 0, NULL, 0, '1436585577', '1436585577', 0, 25.55),
(16, '123 Main st. dfdf Dallas AL 3265', 19, 20, 5, 5, 1, 9, '174.1', 1, '06-30-2015', 1, 0, 0, NULL, 0, '1436649190', '1436649190', 2.46, 176.56),
(17, '401dsfsd sdf as jaipur AL 302013', 22, 23, 5, 11, 1, 9, '25.55', 1, '07-07-2015', 1, 0, 0, NULL, 0, '1436687353', '1436687353', 0, 25.55),
(18, '401dsfsd sdf as jaipur AL 302013', 23, 24, 5, 11, 1, 9, '25.55', 1, '07-07-2015', 1, 0, 0, NULL, 0, '1436687377', '1436687377', 0, 25.55),
(19, '123 Main st. dfdf Dallas AL 3265', 24, 25, 6, 2, 2, 9, '123', 1, '12-08-2015', 1, 0, 0, NULL, 0, '1449860602', '1449860602', 2.46, 125.46),
(20, '123 Main st. dfdf Dallas AL 3265', 25, 26, 6, 2, 2, 9, '123', 1, '12-01-2015', 1, 0, 0, NULL, 0, '1449860660', '1449860660', 2.46, 125.46),
(21, '123 Main st. dfdf Dallas AL 3265', 26, 27, 6, 2, 2, 9, '148.55', 1, '12-08-2015', 1, 0, 0, NULL, 0, '1449860950', '1449860950', 2.46, 151.01),
(22, '123 Main st. dfdf Dallas AL 3265', 27, 28, 6, 2, 1, 9, '199.65', 1, '12-07-2015', 1, 0, 0, NULL, 0, '1449861384', '1449861384', 2.46, 202.11),
(23, '123 Main st. dfdf Dallas AL 3265', 28, 29, 6, 2, 1, 9, '199.65', 1, '12-07-2015', 1, 0, 0, NULL, 0, '1449862144', '1449862144', 2.46, 202.11),
(24, '123 Main st. dfdf Dallas AL 3265', 29, 30, 6, 2, 1, 9, '199.65', 1, '12-07-2015', 1, 0, 0, NULL, 0, '1449862173', '1449862173', 2.46, 202.11),
(25, '123 Main st. dfdf Dallas AL 3265', 30, 31, 6, 2, 2, 9, '123', 1, '12-14-2015', 1, 0, 0, NULL, 0, '1449987799', '1449987799', 2.46, 125.46),
(26, '123 Main st. dfdf Dallas AL 3265', 31, 32, 6, 2, 2, 9, '123', 1, '12-13-2015', 1, 0, 0, NULL, 0, '1449987933', '1449987933', 2.46, 125.46);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
`id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL DEFAULT '1',
  `page_type` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(105) COLLATE utf8_unicode_ci NOT NULL,
  `body` longtext COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` text COLLATE utf8_unicode_ci NOT NULL,
  `name_pt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body_pt` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_description_pt` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords_pt` text COLLATE utf8_unicode_ci NOT NULL,
  `name_sp` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body_sp` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_description_sp` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords_sp` text COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(105) COLLATE utf8_unicode_ci NOT NULL,
  `file_path` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1',
  `is_editable` tinyint(2) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `language_id`, `page_type`, `name`, `body`, `meta_description`, `meta_keywords`, `name_pt`, `body_pt`, `meta_description_pt`, `meta_keywords_pt`, `name_sp`, `body_sp`, `meta_description_sp`, `meta_keywords_sp`, `slug`, `file_path`, `status`, `is_editable`, `created`, `modified`) VALUES
(1, 1, 'cms', 'Home Page12', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<div class="rc">\r\n<h2 class="why">&nbsp;</h2>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n</div>\r\n', 'Meta description', 'Meta Keyword', 'Home Page ', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<div class="rc">\r\n<h2 class="why">&nbsp;</h2>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n</div>\r\n', 'Meta description', 'Meta description', 'Home Page', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<div class="rc">\r\n<h2 class="why">&nbsp;</h2>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n</div>\r\n', 'Meta description', 'Meta description', 'home_page', '', 1, 1, '2013-08-15 12:56:55', 1389942713),
(2, 1, 'cms', 'Terms & Conditions', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>\n\n<hr class="clearfix" />\n<h5>Lorem Ipsum</h5>\n\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>\n\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>\n\n<h5>Lorem Ipsum</h5>\n\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>\n\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>\n', 'Terms & Conditions', 'Terms & Conditions', 'Terms & Conditions', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>\n\n<hr class="clearfix" />\n<h5>Lorem Ipsum</h5>\n\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>\n\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>\n\n<h5>Lorem Ipsum</h5>\n\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>\n\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>\n', 'Terms & Conditions', 'Terms & Conditions', 'Terms & Conditions', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>\n\n<hr class="clearfix" />\n<h5>Lorem Ipsum</h5>\n\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>\n\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>\n\n<h5>Lorem Ipsum</h5>\n\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>\n\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>\n', 'Terms & Conditions', 'Terms & Conditions', 'terms_conditions', '', 1, 1, '0000-00-00 00:00:00', 1389362852),
(19, 1, 'cms', 'Who We Are', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<div class="rc">\r\n<h2 class="why">&nbsp;</h2>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n</div>\r\n', 'Who We Are', 'Who We Are', 'Who We Are', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<div class="rc">\r\n<h2 class="why">&nbsp;</h2>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n</div>\r\n', 'Who We Are', 'Who We Are', 'fdsa', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<div class="rc">\r\n<h2 class="why">&nbsp;</h2>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n</div>\r\n', 'Who We Are', 'Who We Are', 'who_we_are', '', 1, 1, '2014-01-17 01:03:01', 1389942097),
(20, 1, 'cms', 'Mission', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<div class="rc">\r\n<h2 class="why">&nbsp;</h2>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n</div>\r\n', 'Mission', 'Mission', 'Mission', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<div class="rc">\r\n<h2 class="why">&nbsp;</h2>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n</div>\r\n', 'Mission', 'Mission', '', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<div class="rc">\r\n<h2 class="why">&nbsp;</h2>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n</div>\r\n', 'Mission', 'Mission', 'mission', '', 1, 1, '2014-01-17 03:17:22', 1389942152);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
`id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL DEFAULT '1',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `taxable` int(11) NOT NULL DEFAULT '0',
  `created` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `modified` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `admin_id`, `name`, `price`, `description`, `taxable`, `created`, `modified`) VALUES
(1, 1, 'Best Product', 25.55, '232xfsdf sadas', 0, '1425227874', '1425227913'),
(2, 1, 'Best Product123', 123, '123', 1, '1426352185', '1426352189'),
(4, 25, 'New admin product', 26, 'dssdf', 1, '1436811231', '1436811231');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE IF NOT EXISTS `ratings` (
`id` int(11) NOT NULL,
  `gallery_id` int(11) DEFAULT NULL,
  `photographer_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `rating` double DEFAULT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `created` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `gallery_id`, `photographer_id`, `client_id`, `rating`, `comment`, `created`) VALUES
(1, 8, 9, 5, 5, 'sadasdsadsad', '1435687458');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
`id` int(20) NOT NULL,
  `key` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(105) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `input_type` varchar(55) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'text',
  `editable` tinyint(1) NOT NULL DEFAULT '1',
  `weight` int(11) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=193 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `title`, `description`, `input_type`, `editable`, `weight`) VALUES
(1, 'Site.email', 'admin@admin.com', 'Email', '', 'text', 1, NULL),
(3, 'Site.title', 'Tour Shout ', 'Site Title', '', 'text', 1, NULL),
(7, 'Site.Copyright_text', '&copy; Copyright all rights reserved, Tour Shout 2014', 'Copyright Text', '', 'text', 1, NULL),
(183, 'Payment.paypal_email', 'shankar.palsaniya@gmail.com', 'Paypal Email Address', '', 'text', 1, NULL),
(182, 'Site.sales_tax_rate', '2', 'Sales Tax Rate', '', 'text', 1, NULL),
(29, 'Contact.address', 'lorem ipsum\r\nprinting and typesetting\r\n12-123 1/2 lorem ipsum\r\nSpecime M1B2P4\r\nParis ', 'Address', '', 'textarea', 1, NULL),
(30, 'Contact.phone', '+1 1234.43.989 ', 'Phone', '', 'text', 1, NULL),
(31, 'Contact.fax', '123.456.4657 ', 'Fax', '', 'text', 1, NULL),
(32, 'Contact.email', 'shankar@mailinator.com', 'Email', '', 'text', 1, NULL),
(184, 'Payment.paypal_sandbox', '1', 'Use Paypal Sandbox', '', 'checkbox', 1, NULL),
(185, 'Payment.auth_nickname', 'test', 'Authorize.net Merchant Nichname', '', 'text', 1, NULL),
(186, 'Payment.api_login_id', '79C3feQFsS', 'API Login ID', '', 'text', 1, NULL),
(187, 'Payment.api_transaction_key', '2F982bgF7HWA6tqV', 'Transaction Key', '', 'text', 1, NULL),
(188, 'Payment.test_mode', '1', 'Use Test Mode', '', 'checkbox', 1, NULL),
(189, 'Payment.PaypalUsername', 'Tour Shout', 'Paypal Username', '', 'text', 1, NULL),
(190, 'Site.time_invoice_past_due_email', '2', 'Time for Invoice Past Due email(Days)', '', 'text', 1, NULL),
(191, 'Site.feedback_email', 'shankar@mailinator.com', 'Feedback Notifications receiving EmailId', '', 'text', 1, NULL),
(192, 'Site.editing_list_email', 'shankar@mailinator.com', 'Email for Editing List Notifications', '', 'text', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shoots`
--

CREATE TABLE IF NOT EXISTS `shoots` (
`id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `size` double DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `show_on_calender` int(11) NOT NULL DEFAULT '1',
  `price` double NOT NULL,
  `client_id` int(11) NOT NULL,
  `photographer_id` int(11) NOT NULL,
  `payment` double NOT NULL,
  `client_present` int(11) DEFAULT NULL,
  `combo_code` int(11) DEFAULT NULL,
  `comment` text COLLATE utf8_unicode_ci,
  `global_comment` text COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hour` int(11) NOT NULL,
  `min` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `meridian` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'am',
  `address_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address_2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `zip` int(11) NOT NULL,
  `gallery_id` int(11) NOT NULL,
  `editing_time` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1=acive(waiting), 2=Processing,3=Done, 4=Dilivered',
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `modified` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `shoots`
--

INSERT INTO `shoots` (`id`, `title`, `size`, `product_id`, `show_on_calender`, `price`, `client_id`, `photographer_id`, `payment`, `client_present`, `combo_code`, `comment`, `global_comment`, `date`, `hour`, `min`, `meridian`, `address_1`, `address_2`, `city`, `state`, `zip`, `gallery_id`, `editing_time`, `status`, `slug`, `created`, `modified`) VALUES
(1, '12 3 Maint st   dallas AL 3265', 5, 1, 1, 25.55, 6, 9, 877.39, 1, 234324, 'sdfsdfdsf', '[14/03/2015 18:39PM] ', '02-03-2015', 9, '03', 'pm', '12 3 Maint st ', '', 'dallas', 'AL', 0, 0, 15, 3, '12_3_maint_st_dallas_al_3265', '1426364386', '1434504256'),
(2, 'sadasd sad sad AL 2134', 2, 1, 1, 25.55, 6, 9, 12.78, 1, 223, 'asdsd', '[14/03/2015 18:39PM] sadsa', '07-06-2015', 10, '00', 'am', 'sadasd', 'sad', 'sad', 'AL', 0, 0, 20, 4, 'sadasd_sad_sad_al_2134', '1427306621', '1428353460'),
(3, 'sadasd sad sad AL 2134', 2, 1, 1, 25.55, 6, 9, 12.78, 1, 223, 'asdsd', '[14/03/2015 18:39PM] sadsa', '07-03-2015', 10, '00', 'am', 'sadasd', 'sad', 'sad', 'AL', 0, 0, 10, 4, 'sadasd_sad_sad_al_2134_1', '1427306652', '1428351504'),
(4, 'sadasd sad sad AL 2134', 2, 1, 1, 25.55, 5, 9, 12.78, 1, 223, 'sdafsad', '[28/02/2015 19:35PM] asdsdsad', '03-12-2015', 10, '00', 'am', 'sadasd', 'sad', 'sad', 'AL', 0, 0, 10, 1, '', '1427315545', '1431779744'),
(5, 'sadasd sad sad AL 2134', 2, 1, 1, 25.55, 5, 9, 12.78, 1, 223, 'sdafsad', '[28/02/2015 19:35PM] asdsdsad', '03-12-2015', 10, '00', 'am', 'sadasd', 'sad', 'sad', 'AL', 0, 0, 10, 1, '', '1427315568', '1431779729'),
(6, '123 Main st.  Dallas AL 3265', 2, 1, 1, 25.55, 5, 9, 12.78, 1, 223, 'ewds', '[23/04/2015 20:15PM] dfdghfdhfgh', '04-07-2015', 10, '00', 'am', '123 Main st.', '', 'Dallas', 'AL', 0, 7, 0, 1, '123_main_st_dallas_al_3265', '1429973323', '1429973323'),
(7, '123 Main st.  Dallas AL 3265', 2, 1, 1, 25.55, 5, 9, 12.78, 1, 0, 'ghg ', '[23/04/2015 20:15PM] gdhgdhgfh', '04-08-2015', 10, '00', 'am', '123 Main st.', '', 'Dallas', 'AL', 0, 8, 0, 1, '123_main_st_dallas_al_3265_1', '1429974230', '1429974230'),
(8, '123 Main st.  Dallas AL 3265', 2, 1, 1, 25.55, 5, 9, 12.78, 1, 213213, 'sadsad', '[23/04/2015 20:15PM] ', '04-26-2015', 10, '00', 'am', '123 Main st.', '', 'Dallas', 'AL', 0, 9, 0, 4, '123_main_st_dallas_al_3265_2', '1430001578', '1430001820'),
(9, '123 Main st.  Dallas AL 3265', 2, 1, 1, 25.55, 7, 9, 12.78, 1, 223, '', '[28/02/2015 18:58PM] nice one', '06-03-2015', 10, '00', 'am', '123 Main st.', '', 'Dallas', 'AL', 0, 10, 0, 3, '123_main_st_dallas_al_3265_3', '1434334323', '1449689578'),
(10, '401 nort avevnue 9a road sikar road jaipur  jaipur AL 302013', 2, 1, 1, 25.55, 13, 9, 12.78, 1, 223, 'xdtre', 'rtytryrty', '06-08-2015', 10, '00', 'am', '401 nort avevnue 9a road sikar road jaipur', '', 'jaipur', 'AL', 0, 11, 0, 1, '401_nort_avevnue_9a_road_sikar_road_jaipur_jaipur_al_302013', '1434427033', '1434427033'),
(11, '123 Main st.dfgfd  Dallas AL 3265', 2, 1, 1, 25.55, 13, 9, 12.78, 1, 223, 'fdgfg', 'hfg', '06-19-2015', 10, '00', 'am', '123 Main st.dfgfd', '', 'Dallas', 'AL', 0, 12, 0, 1, '123_main_st_dfgfd_dallas_al_3265', '1434427344', '1434427345'),
(12, '401dsfsd sdf  jaipur AL 302013', 2, 1, 1, 25.55, 13, 9, 12.78, 1, 223, 'asd', 'sdadsad', '06-18-2015', 10, '00', 'am', '401dsfsd sdf', '', 'jaipur', 'AL', 0, 13, 0, 1, '401dsfsd_sdf_jaipur_al_302013', '1434506172', '1434506173'),
(13, '12sadsa3 Main st.  Dallas AL 3265', 2, 1, 1, 25.55, 13, 9, 12.78, 1, 223, 'sadsa', 'dsadsa', '06-22-2015', 10, '00', 'am', '12sadsa3 Main st.', '', 'Dallas', 'AL', 0, 14, 0, 1, '12sadsa3_main_st_dallas_al_3265', '1435080184', '1435080184'),
(14, '123 as Main st.  Dallas AL 3265', 2, 1, 1, 25.55, 13, 9, 12.78, 1, NULL, 'sad', 'sadsad', '06-23-2015', 10, '00', 'am', '123 as Main st.', '', 'Dallas', 'AL', 0, 15, 0, 1, '123_as_main_st_dallas_al_3265', '1435253708', '1435253708'),
(15, '123 Main st. dfdf Dallas AL 3265', 2, 2, 1, 123, 5, 9, 61.5, 1, 223, 'fgdfgdfg', '[23/04/2015 20:15PM] fdgfdgfgfd', '07-12-2015', 10, '00', 'am', '123 Main st.', 'dfdf', 'Dallas', 'AL', 0, 0, 0, 1, '', '1436550407', '1436550407'),
(16, '123 Main st. dfdf Dallas AL 3265', 2, 2, 1, 123, 5, 9, 61.5, 1, 223, 'fgdfgdfg', '[23/04/2015 20:15PM] fdgfdgfgfd', '07-12-2015', 10, '00', 'am', '123 Main st.', 'dfdf', 'Dallas', 'AL', 0, 0, 0, 1, '', '1436550489', '1436550489'),
(17, '123 Main st.dsdr dfdf Dallas AL 3265', 2, 1, 1, 25.55, 5, 9, 12.78, 1, 223, 'sadsadsa', '[23/04/2015 20:15PM] ', '07-10-2015', 10, '00', 'am', '123 Main st.dsdr', 'dfdf', 'Dallas', 'AL', 0, 18, 0, 1, '', '1436585577', '1436585577'),
(18, '123 Main st. dfdf Dallas AL 3265', 2, 1, 1, 174.1, 5, 9, 87.05, 1, 223, 'sdsadsad', '[23/04/2015 20:15PM] sadsadsadd', '06-30-2015', 10, '00', 'am', '123 Main st.', 'dfdf', 'Dallas', 'AL', 0, 19, 0, 1, '123_main_st_dfdf_dallas_al_3265', '1436648304', '1436648304'),
(19, '123 Main st. dfdf Dallas AL 3265', 2, 1, 1, 174.1, 5, 9, 87.05, 1, 223, 'sdsadsad', '[23/04/2015 20:15PM] sadsadsadd', '06-30-2015', 10, '00', 'am', '123 Main st.', 'dfdf', 'Dallas', 'AL', 0, 20, 0, 1, '123_main_st_dfdf_dallas_al_3265_1', '1436649190', '1436649190'),
(20, '401dsfsd sdf as jaipur AL 302013', 2, 1, 1, 25.55, 5, 9, 12.78, 1, 223, 'fdfgdgdfg', '[23/04/2015 20:15PM] ', '07-07-2015', 10, '00', 'am', '401dsfsd sdf', 'as', 'jaipur', 'AL', 0, 21, 0, 1, '401dsfsd_sdf_as_jaipur_al_302013', '1436687170', '1436687170'),
(21, '401dsfsd sdf as jaipur AL 302013', 2, 1, 1, 25.55, 5, 9, 12.78, 1, 223, 'fdfgdgdfg', '[23/04/2015 20:15PM] ', '07-07-2015', 10, '00', 'am', '401dsfsd sdf', 'as', 'jaipur', 'AL', 0, 22, 0, 1, '401dsfsd_sdf_as_jaipur_al_302013_1', '1436687311', '1436687311'),
(22, '401dsfsd sdf as jaipur AL 302013', 2, 1, 1, 25.55, 5, 9, 12.78, 1, 223, 'fdfgdgdfg', '[23/04/2015 20:15PM] ', '07-07-2015', 10, '00', 'am', '401dsfsd sdf', 'as', 'jaipur', 'AL', 0, 23, 0, 1, '401dsfsd_sdf_as_jaipur_al_302013_2', '1436687353', '1436687353'),
(23, '401dsfsd sdf as jaipur AL 302013', 2, 1, 1, 25.55, 5, 9, 12.78, 1, 223, 'fdfgdgdfg', '[23/04/2015 20:15PM] ', '07-13-2015', 10, '00', 'am', '401dsfsd sdf', 'as', 'jaipur', 'AL', 0, 24, 0, 1, '401dsfsd_sdf_as_jaipur_al_302013_3', '1436687376', '1436687376'),
(24, '123 Main st. dfdf Dallas AL 3265', 2, 2, 1, 123, 6, 9, 61.5, 1, 213, '2323', '[11/12/2015 19:50PM] sdsdsdsd', '12-09-2015', 10, '00', 'am', '123 Main st.', 'dfdf', 'Dallas', 'AL', 0, 25, 0, 1, '123_main_st_dfdf_dallas_al_3265_2', '1449860601', '1449860602'),
(25, '123 Main st. dfdf Dallas AL 3265', 2, 2, 1, 123, 6, 9, 61.5, 1, 213, 'edfdsf', '[11/12/2015 19:50PM] sdsdsdsd\r\n\r\nsad\r\nsadsad\r\nsadased', '12-10-2015', 10, '00', 'am', '123 Main st.', 'dfdf', 'Dallas', 'AL', 0, 26, 0, 1, '123_main_st_dfdf_dallas_al_3265_3', '1449860660', '1449860660'),
(26, '123 Main st. dfdf Dallas AL 3265', 2, 2, 1, 148.55, 6, 9, 61.5, 1, 213, 'rtret', '[11/12/2015 19:50PM] sdsdsdsd\r\n\r\nsad\r\nsadsad\r\nsadased\r\n\r\n\r\ndsfsdfsdfsdfsdf', '12-08-2015', 10, '00', 'am', '123 Main st.', 'dfdf', 'Dallas', 'AL', 0, 27, 0, 1, '123_main_st_dfdf_dallas_al_3265_4', '1449860950', '1449860950'),
(27, '123 Main st. dfdf Dallas AL 3265', 2, 1, 1, 199.65, 6, 9, 0, 1, 213, 'dsfdsf', '[11/12/2015 19:50PM] sdsdsdsd\r\n\r\nsad\r\nsadsad\r\nsadased\r\n\r\n\r\ndsfsdfsdfsdfsdf', '12-07-2015', 10, '00', 'am', '123 Main st.', 'dfdf', 'Dallas', 'AL', 0, 28, 0, 1, '123_main_st_dfdf_dallas_al_3265_5', '1449861384', '1449861384'),
(28, '123 Main st. dfdf Dallas AL 3265', 2, 1, 1, 199.65, 6, 9, 0, 1, 213, 'dsfdsf', '[11/12/2015 19:50PM] sdsdsdsd\r\n\r\nsad\r\nsadsad\r\nsadased\r\n\r\n\r\ndsfsdfsdfsdfsdf', '12-07-2015', 10, '00', 'am', '123 Main st.', 'dfdf', 'Dallas', 'AL', 0, 29, 0, 1, '123_main_st_dfdf_dallas_al_3265_6', '1449862144', '1449862144'),
(29, '123 Main st. dfdf Dallas AL 3265', 2, 1, 1, 199.65, 6, 9, 0, 1, 213, 'dsfdsf', '[11/12/2015 19:50PM] sdsdsdsd\r\n\r\nsad\r\nsadsad\r\nsadased\r\n\r\n\r\ndsfsdfsdfsdfsdf', '12-07-2015', 10, '00', 'am', '123 Main st.', 'dfdf', 'Dallas', 'AL', 0, 30, 0, 1, '123_main_st_dfdf_dallas_al_3265_7', '1449862173', '1449862173'),
(30, '123 Main st. dfdf Dallas AL 3265', 2, 2, 1, 123, 6, 9, 61.5, 1, 213, 'erewrer', '[11/12/2015 19:50PM] sdsdsdsd\r\n\r\nsad\r\nsadsad\r\nsadased\r\n\r\n\r\ndsfsdfsdfsdfsdf', '12-14-2015', 10, '00', 'am', '123 Main st.', 'dfdf', 'Dallas', 'AL', 0, 31, 0, 1, '123_main_st_dfdf_dallas_al_3265_8', '1449987799', '1449987799'),
(31, '123 Main st. dfdf Dallas AL 3265', 2, 2, 1, 123, 6, 9, 61.5, 1, 213, '46rt5765', '[11/12/2015 19:50PM] sdsdsdsd\r\n\r\nsad\r\nsadsad\r\nsadased\r\n\r\n\r\ndsfsdfsdfsdfsdf', '12-13-2015', 10, '00', 'am', '123 Main st.', 'dfdf', 'Dallas', 'AL', 0, 32, 0, 1, '123_main_st_dfdf_dallas_al_3265_9', '1449987933', '1449987933');

-- --------------------------------------------------------

--
-- Table structure for table `shoot_products`
--

CREATE TABLE IF NOT EXISTS `shoot_products` (
`id` int(11) NOT NULL,
  `shoot_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `shoot_products`
--

INSERT INTO `shoot_products` (`id`, `shoot_id`, `product_id`, `created`) VALUES
(1, 18, 1, '1436648304'),
(2, 18, 1, '1436648304'),
(3, 18, 2, '1436648304'),
(4, 19, 1, '1436649190'),
(5, 19, 1, '1436649190'),
(6, 19, 2, '1436649190'),
(7, 20, 1, '1436687170'),
(8, 21, 1, '1436687311'),
(9, 22, 1, '1436687353'),
(10, 23, 1, '1436687376'),
(11, 24, 2, '1449860602'),
(12, 25, 2, '1449860660'),
(13, 26, 2, '1449860950'),
(14, 26, 1, '1449860950'),
(15, 27, 1, '1449861384'),
(16, 27, 1, '1449861384'),
(17, 27, 2, '1449861384'),
(18, 27, 1, '1449861384'),
(19, 28, 1, '1449862144'),
(20, 28, 1, '1449862144'),
(21, 28, 2, '1449862144'),
(22, 28, 1, '1449862144'),
(23, 29, 1, '1449862173'),
(24, 29, 1, '1449862173'),
(25, 29, 2, '1449862173'),
(26, 29, 1, '1449862173'),
(27, 30, 2, '1449987799'),
(28, 31, 2, '1449987933');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE IF NOT EXISTS `states` (
`id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `short_code` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created` int(11) NOT NULL,
  `updated` varchar(11) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=62 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='countries';

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `name`, `short_code`, `created`, `updated`) VALUES
(1, 'Alabama', 'AL', 1425145463, '1425145463'),
(2, 'Alaska', 'AK', 1425145463, '1425145463'),
(3, 'American Samoa', 'AS', 1425145463, '1425145463'),
(4, 'Arizona', 'AZ', 1425145463, '1425145463'),
(5, 'Arkansas', 'AR', 1425145463, '1425145463'),
(6, 'Armed Forces Europe', 'AE', 1425145463, '1425145463'),
(7, 'Armed Forces Pacific', 'AP', 1425145463, '1425145463'),
(8, 'Armed Forces the Americas', 'AA', 1425145463, '1425145463'),
(9, 'California', 'CA', 1425145463, '1425145463'),
(10, 'Colorado', 'CO', 1425145463, '1425145463'),
(11, 'Connecticut', 'CT', 1425145463, '1425145463'),
(12, 'Delaware', 'DE', 1425145463, '1425145463'),
(13, 'District of Columbia', 'DC', 1425145463, '1425145463'),
(14, 'Federated States of Micronesia', 'FM', 1425145463, '1425145463'),
(15, 'Florida', 'FL', 1425145463, '1425145463'),
(16, 'Georgia', 'GA', 1425145463, '1425145463'),
(17, 'Guam', 'GU', 1425145463, '1425145463'),
(18, 'Hawaii', 'HI', 1425145463, '1425145463'),
(19, 'Idaho', 'ID', 1425145463, '1425145463'),
(20, 'Illinois', 'IL', 1425145463, '1425145463'),
(21, 'Indiana', 'IN', 1425145463, '1425145463'),
(22, 'Iowa', 'IA', 1425145463, '1425145463'),
(23, 'Kansas', 'KS', 1425145463, '1425145463'),
(24, 'Kentucky', 'KY', 1425145463, '1425145463'),
(25, 'Louisiana', 'LA', 1425145463, '1425145463'),
(26, 'Maine', 'ME', 1425145463, '1425145463'),
(27, 'Marshall Islands', 'MH', 1425145463, '1425145463'),
(28, 'Maryland', 'MD', 1425145463, '1425145463'),
(29, 'Massachusetts', 'MA', 1425145463, '1425145463'),
(30, 'Michigan', 'MI', 1425145463, '1425145463'),
(31, 'Minnesota', 'MN', 1425145463, '1425145463'),
(32, 'Mississippi', 'MS', 1425145463, '1425145463'),
(33, 'Missouri', 'MO', 1425145463, '1425145463'),
(34, 'Montana', 'MT', 1425145463, '1425145463'),
(35, 'Nebraska', 'NE', 1425145463, '1425145463'),
(36, 'Nevada', 'NV', 1425145463, '1425145463'),
(37, 'New Hampshire', 'NH', 1425145463, '1425145463'),
(38, 'New Jersey', 'NJ', 1425145463, '1425145463'),
(39, 'New Mexico', 'NM', 1425145463, '1425145463'),
(40, 'New York', 'NY', 1425145463, '1425145463'),
(41, 'North Carolina', 'NC', 1425145463, '1425145463'),
(42, 'North Dakota', 'ND', 1425145463, '1425145463'),
(43, 'Northern Mariana Islands', 'MP', 1425145463, '1425145463'),
(44, 'Ohio', 'OH', 1425145463, '1425145463'),
(45, 'Oklahoma', 'OK', 1425145463, '1425145463'),
(46, 'Oregon', 'OR', 1425145463, '1425145463'),
(47, 'Pennsylvania', 'PA', 1425145463, '1425145463'),
(48, 'Puerto Rico', 'PR', 1425145463, '1425145463'),
(49, 'Rhode Island', 'RI', 1425145463, '1425145463'),
(50, 'South Carolina', 'SC', 1425145463, '1425145463'),
(51, 'South Dakota', 'SD', 1425145463, '1425145463'),
(52, 'Tennessee', 'TN', 1425145463, '1425145463'),
(53, 'Texas', 'TX', 1425145463, '1425145463'),
(54, 'Utah', 'UT', 1425145463, '1425145463'),
(55, 'Vermont', 'VT', 1425145463, '1425145463'),
(56, 'Virgin Islands, U.S.', 'VI', 1425145463, '1425145463'),
(57, 'Virginia', 'VA', 1425145463, '1425145463'),
(58, 'Washington', 'WA', 1425145463, '1425145463'),
(59, 'West Virginia', 'WV', 1425145463, '1425145463'),
(60, 'Wisconsin', 'WI', 1425145463, '1425145463'),
(61, 'Wyoming', 'WY', 1425145463, '1425145463');

-- --------------------------------------------------------

--
-- Table structure for table `temps`
--

CREATE TABLE IF NOT EXISTS `temps` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `value` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `references` text NOT NULL,
  `created` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
`id` int(11) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `auth_code` varchar(255) DEFAULT NULL,
  `invoice_no` varchar(255) DEFAULT NULL,
  `paid` double NOT NULL DEFAULT '0',
  `payment_date` varchar(255) NOT NULL,
  `method` varchar(255) NOT NULL,
  `description` text,
  `details` text,
  `completed` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `transaction_id`, `invoice_id`, `auth_code`, `invoice_no`, `paid`, `payment_date`, `method`, `description`, `details`, `completed`, `status`, `created`) VALUES
(1, '354168465156', 3, NULL, NULL, 10, '04-25-2015', 'Check', NULL, NULL, 0, 1, '2015-04-25 23:35:30'),
(3, '35416846515612', 3, NULL, NULL, 10, '04-25-2015', 'Check', NULL, NULL, 0, 1, '2015-04-25 23:38:11'),
(4, '32434545', 5, NULL, NULL, 25.55, '04-23-2015', 'Check', NULL, NULL, 0, 1, '2015-05-05 04:15:03'),
(9, '7AG45639NK440172J', 6, 'AqSUl9S54KrFB7bWrqaS-nIu9xo5u18k9DQaJ4M9wTgBw6AYFEUvTnFd30gu9cStoJivQ-pqcqgm7Yo456jGXvA', NULL, 25.55, '05-10-2015', 'paypal', '123 Main st.  Dallas AL 3265', '{"mc_gross":"25.55","protection_eligibility":"Ineligible","address_status":"confirmed","item_number1":"","payer_id":"VFN5TSFMPQCLQ","tax":"0.00","address_street":"1 Main St","payment_date":"12:22:11 May 10, 2015 PDT","payment_status":"Pending","charset":"windows-1252","address_zip":"95131","mc_shipping":"0.00","mc_handling":"0.00","first_name":"champ","address_country_code":"US","address_name":"xtreem","notify_version":"3.8","custom":"6","payer_status":"verified","business":"shankar.palsaniya@gmail.com","address_country":"United States","num_cart_items":"1","mc_handling1":"0.00","address_city":"San Jose","payer_email":"bharat.xtreem@yahoo.com","verify_sign":"AhKRzE9omJIMe3jsH3JDHQljQpXxAFMcAPae-vs35xoSblRjRroIbU75","mc_shipping1":"0.00","tax1":"0.00","txn_id":"7AG45639NK440172J","payment_type":"instant","payer_business_name":"xtreem","last_name":"xtreem","item_name1":"123 Main st.  Dallas AL 3265","address_state":"CA","receiver_email":"shankar.palsaniya@gmail.com","quantity1":"1","pending_reason":"unilateral","txn_type":"cart","mc_gross_1":"25.55","mc_currency":"USD","residence_country":"US","test_ipn":"1","transaction_subject":"6","payment_gross":"25.55","auth":"AqSUl9S54KrFB7bWrqaS-nIu9xo5u18k9DQaJ4M9wTgBw6AYFEUvTnFd30gu9cStoJivQ-pqcqgm7Yo456jGXvA"}', 0, 1, '2015-05-10 21:22:27'),
(8, '2233363784', 2, 'YVED48', '9B882B3A9DCEDAA07F67D8BC016D299E', 25.55, '05-10-2015', 'CC', 'Payment for shoot sadasd sad sad AL 2134', '{"Billing":{"first_name":"shankar","last_name":"dayal","address":"123 Main st.","city":"Dallas","state":"AL","zip":"3265"},"CreditCard":{"number":"4444333322221111","expiration":"022028"},"Transaction":{"amount":25.55,"description":"Payment for shoot sadasd sad sad AL 2134","invoice_number":"2"}}', 0, 1, '2015-05-10 20:05:48'),
(11, '9VH11916GF510915Y', 6, 'Aa.yolhQZ2votJQQfeNrCQpMo6LrNhNPXiRWiYjx3b7.ULQNX9z5pC7S2swKrcG42xDbcv3PCXCUzFGBzj-4Mbg', NULL, 25.55, '07-02-2015', 'paypal', '123 Main st.  Dallas AL 3265', '{"mc_gross":"25.55","protection_eligibility":"Ineligible","address_status":"confirmed","item_number1":"","payer_id":"VFN5TSFMPQCLQ","tax":"0.00","address_street":"1 Main St","payment_date":"12:24:37 May 10, 2015 PDT","payment_status":"Pending","charset":"windows-1252","address_zip":"95131","mc_shipping":"0.00","mc_handling":"0.00","first_name":"champ","address_country_code":"US","address_name":"xtreem","notify_version":"3.8","custom":"6","payer_status":"verified","business":"shankar.palsaniya@gmail.com","address_country":"United States","num_cart_items":"1","mc_handling1":"0.00","address_city":"San Jose","payer_email":"bharat.xtreem@yahoo.com","verify_sign":"AFcWxV21C7fd0v3bYYYRCpSSRl31A7eWmyoj5eiPcy80bNE0l9m7cwuQ","mc_shipping1":"0.00","tax1":"0.00","txn_id":"9VH11916GF510915Y","payment_type":"instant","payer_business_name":"xtreem","last_name":"xtreem","item_name1":"123 Main st.  Dallas AL 3265","address_state":"CA","receiver_email":"shankar.palsaniya@gmail.com","quantity1":"1","pending_reason":"unilateral","txn_type":"cart","mc_gross_1":"25.55","mc_currency":"USD","residence_country":"US","test_ipn":"1","transaction_subject":"6","payment_gross":"25.55","auth":"Aa.yolhQZ2votJQQfeNrCQpMo6LrNhNPXiRWiYjx3b7.ULQNX9z5pC7S2swKrcG42xDbcv3PCXCUzFGBzj-4Mbg"}', 0, 1, '2015-05-10 21:24:51'),
(15, '354168465156', 8, NULL, NULL, 25.55, '04-25-2015', 'Check', NULL, NULL, 0, 1, '2015-06-23 20:17:30'),
(14, '354168465156h', 8, NULL, NULL, 25.55, '04-25-2015', 'Check', NULL, NULL, 0, 1, '2015-06-23 20:16:06'),
(16, '354168465156', 8, NULL, NULL, 25.55, '04-25-2015', 'Check', NULL, NULL, 0, 1, '2015-06-23 20:18:45'),
(17, '9S103321XF2598640', 11, 'Ah-NOLAxqaJ7frCay3A2NF951dlKSA7T1N1-mkxJeIOEILz0bO2LrK9ncV.1BrLYrDC3rCn0zNo1pv9QYPBz7rA', NULL, 25.55, '07-03-2015', 'paypal', '12sadsa3 Main st.  Dallas AL 3265', '{"mc_gross":"25.55","protection_eligibility":"Ineligible","address_status":"confirmed","item_number1":"","payer_id":"VFN5TSFMPQCLQ","tax":"0.00","address_street":"1 Main St","payment_date":"11:20:32 Jun 23, 2015 PDT","payment_status":"Pending","charset":"windows-1252","address_zip":"95131","mc_shipping":"0.00","mc_handling":"0.00","first_name":"champ","address_country_code":"US","address_name":"xtreem","notify_version":"3.8","custom":"11","payer_status":"verified","business":"shankar.palsaniya@gmail.com","address_country":"United States","num_cart_items":"1","mc_handling1":"0.00","address_city":"San Jose","payer_email":"bharat.xtreem@yahoo.com","verify_sign":"ApjVYZLxI2P6DwtDJDkZ1FrfDJ2cA7U1qyG8ENrt.rZLg9MgDIkwGZq9","mc_shipping1":"0.00","tax1":"0.00","txn_id":"9S103321XF2598640","payment_type":"instant","payer_business_name":"xtreem","last_name":"xtreem","item_name1":"12sadsa3 Main st.  Dallas AL 3265","address_state":"CA","receiver_email":"shankar.palsaniya@gmail.com","quantity1":"1","pending_reason":"unilateral","txn_type":"cart","mc_gross_1":"25.55","mc_currency":"USD","residence_country":"US","test_ipn":"1","transaction_subject":"11","payment_gross":"25.55","merchant_return_link":"click here","auth":"Ah-NOLAxqaJ7frCay3A2NF951dlKSA7T1N1-mkxJeIOEILz0bO2LrK9ncV.1BrLYrDC3rCn0zNo1pv9QYPBz7rA"}', 0, 1, '2015-06-23 20:20:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` bigint(20) NOT NULL,
  `parent_id` bigint(20) NOT NULL,
  `email` varchar(155) NOT NULL,
  `username` varchar(100) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `password` varchar(155) NOT NULL,
  `user_role_id` int(4) NOT NULL COMMENT '1=admin, 2=Promoter , 3=partner,  4=other partner,  5=customer',
  `mobile` varchar(255) NOT NULL,
  `telephone` varchar(200) DEFAULT NULL,
  `address` text NOT NULL,
  `is_verified` tinyint(2) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `forgot_password_validate_string` varchar(255) NOT NULL,
  `validate_string` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `last_activity` varchar(255) DEFAULT NULL,
  `is_closed` int(11) NOT NULL DEFAULT '0',
  `deny` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1 COMMENT='This table has all user records';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `parent_id`, `email`, `username`, `first_name`, `last_name`, `type`, `password`, `user_role_id`, `mobile`, `telephone`, `address`, `is_verified`, `active`, `forgot_password_validate_string`, `validate_string`, `created`, `modified`, `last_activity`, `is_closed`, `deny`, `slug`) VALUES
(1, 1, 'admin@admin.com', 'admin', 'shankar', 'palsaniya', NULL, 'f2a9e6db54e62223fdfecdc1eb658078d893ea03', 1, '', '3598653265', '', 1, 1, '', '', '2014-09-23 22:47:47', '2015-12-13 07:47:55', '1436809534', 0, '', NULL),
(2, 1, 'john.doe@mailinator.com', 'supervisor', 'supervisor', '', NULL, '9eb3e7cc27fcd74031a54e428c131883c3b25d4d', 4, '', NULL, '', 1, 1, '', '', '2014-10-27 22:51:27', '2014-10-27 22:51:30', NULL, 0, '0', 'supervisor'),
(5, 25, 'client@mailinator.com', '', 'Client', 'Smith', 'Realtor', 'f2a9e6db54e62223fdfecdc1eb658078d893ea03', 3, '321654987', '321654987', 'Client Company', 0, 1, '', '', '2015-02-28 18:24:47', '2015-12-09 20:40:23', '1429813002', 0, '', NULL),
(6, 1, 'clientnew@mailinator.com', '', 'client ', '234', 'Realtor', '2161174fd9a5e1a478fb0bee15d10e75cf0e67c8', 3, '321654987', '321654987', 'asdasd', 0, 1, '', '', '2015-02-28 18:54:07', '2015-02-28 18:54:07', '1449859814', 0, '', NULL),
(7, 1, 'asdclient@mailinator.com', '', 'Client', 'nes', 'Realtor', 'e4e32246345d8698bdb9ccaa075146d988d30e39', 3, '321654987', NULL, 'sd', 0, 1, '', '', '2015-02-28 18:59:05', '2015-06-15 04:31:14', '1425146345', 0, '', NULL),
(9, 1, 'bestphtgrphr1@mailinator.com', '', 'best ', 'photographer', NULL, '', 2, '321654987', '321654987', '12', 0, 1, '', '', '2015-03-01 17:09:17', '2015-03-01 17:09:17', '1427300680', 0, '', NULL),
(10, 1, 'sad@admin.com', '', 'shajkaks', 'dskfhgdsuif', 'Realtor', '123456', 3, '565656565656', '5656565656', '', 0, 1, '', '', '2015-04-26 01:13:09', '2015-04-26 01:13:09', '1430003589', 0, '', NULL),
(11, 1, 'sad1@admin.com', '', 'shajkaks', 'dskfhgdsuif', 'Realtor', 'e4e32246345d8698bdb9ccaa075146d988d30e39', 3, '565656565656', '5656565656', '', 0, 1, '', '', '2015-04-26 01:13:55', '2015-04-26 01:13:55', '1430003635', 0, '', NULL),
(12, 1, 'shankar123@mailinator.com', '', 'shankar', 'dayal', 'Realtor', 'e4e32246345d8698bdb9ccaa075146d988d30e39', 3, '3265983265', '3265986598', 'sdp', 0, 1, '', '', '2015-05-17 14:15:26', '2015-05-17 14:15:26', '1431864926', 0, '', NULL),
(13, 0, 'sdf@mailinator.com', '', 'shankar1', 'dayal1', NULL, '', 3, '', '3265989865', '', 0, 0, '', '', '2015-06-16 05:12:59', '2015-06-16 05:12:59', NULL, 0, '', NULL),
(15, 1, 'sdfg@mailinator.com', '', 'sonu', 'monu', NULL, '673e90e766d5a86991387d7789bb2382db2cfdff', 3, '', '326598', '', 0, 0, '', '', '2015-07-11 19:46:49', '2015-07-11 19:46:49', '1436636809', 0, '', NULL),
(16, 1, 'sdfas@mailinator.com', '', 'sonu', 'nigam', NULL, '2d5c6dbc116ac1ee8faf0382dadf6e395e4989b0', 3, '', '09928875002', '', 0, 0, '', '', '2015-07-11 20:02:48', '2015-07-11 20:02:48', '1436637768', 0, '', NULL),
(17, 0, 'newcontact@mailinator.com', '', 'new ', 'contact 1', NULL, 'fad3a6e9bd3db07deb20a80d10e1066355430ad1', 4, '', '3265986532', '', 0, 0, '', '', '2015-07-12 08:18:17', '2015-07-12 08:18:17', '1436681897', 0, '', NULL),
(18, 0, 'newcontact1@mailinator.com', '', 'new contact', '1', NULL, '34f2d57100d1a081cd5be71c231178f9c762127f', 4, '', '659896598', '', 0, 0, '', '', '2015-07-12 08:26:29', '2015-07-12 08:26:29', '1436682389', 0, '', NULL),
(19, 0, 'newcontact11@mailinator.com', '', 'new contact', '1', NULL, '34f2d57100d1a081cd5be71c231178f9c762127f', 4, '', '659896598', '', 0, 0, '', '', '2015-07-12 08:27:02', '2015-07-12 08:27:02', '1436682422', 0, '', NULL),
(20, 0, 'newcontact111@mailinator.com', '', 'new contact', '1', NULL, '34f2d57100d1a081cd5be71c231178f9c762127f', 4, '', '659896598', '', 0, 0, '', '', '2015-07-12 08:27:57', '2015-07-12 08:27:57', '1436682477', 0, '', NULL),
(21, 5, 'newcontact2@mailinator.com', '', 'new contact', '2', NULL, '216176648699e408359ebb6e20142c6e2de25fc1', 4, '', '3265988745', '', 0, 0, '', '', '2015-07-12 08:30:07', '2015-07-12 08:30:07', '1436682607', 0, '', NULL),
(22, 5, 'newcontact3@mailinator.com', '', 'new contact', '3', NULL, '216176648699e408359ebb6e20142c6e2de25fc1', 4, '', '3265988745', '', 0, 0, '', '', '2015-07-12 08:35:05', '2015-07-12 08:35:05', '1436682905', 0, '', NULL),
(23, 5, 'newcontact4@mailinator.com', '', 'new contact', '4', 'Realtor', '216176648699e408359ebb6e20142c6e2de25fc1', 4, '', '3265988745', '', 0, 1, '', '', '2015-07-12 08:35:57', '2015-07-12 08:35:57', '1436695553', 0, '', NULL),
(25, 1, 'newadmin1@mailinator.com', '', 'New ', 'Admin', NULL, 'f2a9e6db54e62223fdfecdc1eb658078d893ea03', 1, '3565989533', '6598326598', '123 Main st.\r\ndfdf', 0, 1, '', '', '2015-07-13 19:52:21', '2015-07-13 19:52:21', '1436809941', 0, '', NULL),
(26, 25, 'nadpht@mailinator.com', '', 'New admin', 'photogrfr', NULL, '', 2, '', '3265986532', '123 Main st.\r\ndfdf', 0, 1, '', '', '2015-07-13 20:15:27', '2015-07-13 20:15:27', '1436811327', 0, '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE IF NOT EXISTS `user_details` (
`id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `field_name` varchar(155) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `field_value` text CHARACTER SET utf8 COLLATE utf8_unicode_ci
) ENGINE=InnoDB AUTO_INCREMENT=206 DEFAULT CHARSET=latin1 COMMENT='This table hold various information for user.';

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `field_name`, `field_value`) VALUES
(18, 5, 'User.first_name', 'Client'),
(19, 5, 'User.last_name', 'Smith'),
(20, 5, 'User.user_image', 'e546d5db74209a8122c5b5bbd5b7c446.'),
(21, 5, 'User.telephone', '321654987'),
(22, 5, 'User.mobile', '321654987'),
(23, 5, 'User.user_image_folder', 'Sep-2014'),
(63, 5, 'User.city', 'dallas'),
(64, 5, 'User.state', 'CA'),
(65, 5, 'User.company', 'Client Company'),
(66, 5, 'User.comment', '[23/04/2015 20:15PM] '),
(67, 5, 'User.address', 'Client Company'),
(68, 5, 'User.zipcode', '326545'),
(69, 6, 'User.first_name', 'client '),
(70, 6, 'User.city', 'jaipur'),
(71, 6, 'User.state', 'AL'),
(72, 6, 'User.company', 'asd'),
(73, 6, 'User.comment', '[11/12/2015 19:50PM] sdsdsdsd\r\n\r\nsad\r\nsadsad\r\nsadased\r\n\r\n\r\ndsfsdfsdfsdfsdf'),
(74, 6, 'User.address', 'asdasd'),
(75, 6, 'User.zipcode', '321654'),
(76, 6, 'User.telephone', '321654987'),
(77, 6, 'User.mobile', '321654987'),
(78, 7, 'User.first_name', 'Client'),
(79, 7, 'User.last_name', 'nes'),
(80, 7, 'User.city', 'jaipur'),
(81, 7, 'User.state', 'AL'),
(82, 7, 'User.company', 'Client Company'),
(83, 7, 'User.comment', '[28/02/2015 18:58PM] nice one'),
(84, 7, 'User.address', 'sd'),
(85, 7, 'User.zipcode', '123456'),
(86, 7, 'User.telephone', '321654987'),
(87, 7, 'User.mobile', '321654987'),
(88, 6, 'User.last_name', '234'),
(89, 9, 'User.first_name', 'best '),
(90, 9, 'User.last_name', 'photographer'),
(91, 9, 'User.city', 'dallas'),
(92, 9, 'User.state', 'TX'),
(93, 9, 'User.price', '50'),
(94, 9, 'User.comment', '[25/03/2015 17:24PM] '),
(95, 9, 'User.address', '12'),
(96, 9, 'User.zipcode', '3265'),
(97, 9, 'User.telephone', '321654987'),
(98, 9, 'User.mobile', '321654987'),
(99, 12, 'User.first_name', 'shankar'),
(100, 12, 'User.last_name', 'dayal'),
(101, 12, 'User.city', 'jaipur'),
(102, 12, 'User.state', 'AL'),
(103, 12, 'User.company', 'sdp'),
(104, 12, 'User.comment', '[17/05/2015 12:50PM] '),
(105, 12, 'User.address', 'sdp'),
(106, 12, 'User.zipcode', '3265'),
(107, 12, 'User.telephone', '3265986598'),
(108, 12, 'User.mobile', '3265983265'),
(109, 13, 'User.first_name', 'shankar1'),
(110, 13, 'User.last_name', 'dayal1'),
(111, 13, 'User.city', NULL),
(112, 13, 'User.state', NULL),
(113, 13, 'User.company', NULL),
(114, 13, 'User.comment', NULL),
(115, 13, 'User.address', NULL),
(116, 13, 'User.zipcode', NULL),
(117, 13, 'User.telephone', '3265989865'),
(118, 13, 'User.mobile', NULL),
(122, 10, 'User.first_name', 'shajkaks'),
(123, 10, 'User.last_name', 'dskfhgdsuif'),
(124, 10, 'User.city', ''),
(125, 10, 'User.state', 'AL'),
(126, 10, 'User.company', ''),
(127, 10, 'User.comment', '[26/04/2015 01:12AM] '),
(128, 10, 'User.address', ''),
(129, 10, 'User.zipcode', ''),
(130, 10, 'User.telephone', '5656565656'),
(131, 10, 'User.mobile', '565656565656'),
(132, 11, 'User.first_name', 'shajkaks'),
(133, 11, 'User.last_name', 'dskfhgdsuif'),
(134, 11, 'User.city', ''),
(135, 11, 'User.state', 'AL'),
(136, 11, 'User.company', ''),
(137, 11, 'User.comment', '[26/04/2015 01:13AM] '),
(138, 11, 'User.address', ''),
(139, 11, 'User.zipcode', ''),
(140, 11, 'User.telephone', '5656565656'),
(141, 11, 'User.mobile', '565656565656'),
(142, 15, 'User.first_name', 'sonu'),
(143, 15, 'User.last_name', 'monu'),
(144, 15, 'User.telephone', '326598'),
(145, 16, 'User.first_name', 'sonu'),
(146, 16, 'User.last_name', 'nigam'),
(147, 16, 'User.telephone', '09928875002'),
(148, 17, 'User.first_name', 'new '),
(149, 17, 'User.last_name', 'contact 1'),
(150, 17, 'User.telephone', '3265986532'),
(151, 19, 'User.first_name', 'new contact'),
(152, 19, 'User.last_name', '1'),
(153, 19, 'User.telephone', '659896598'),
(154, 20, 'User.first_name', 'new contact'),
(155, 20, 'User.last_name', '1'),
(156, 20, 'User.telephone', '659896598'),
(157, 21, 'User.first_name', 'new contact'),
(158, 21, 'User.last_name', '2'),
(159, 21, 'User.telephone', '3265988745'),
(160, 22, 'User.first_name', 'new contact'),
(161, 22, 'User.last_name', '3'),
(162, 22, 'User.telephone', '3265988745'),
(163, 23, 'User.first_name', 'new contact'),
(164, 23, 'User.last_name', '4'),
(165, 23, 'User.telephone', '3265988745'),
(166, 23, 'User.city', ''),
(167, 23, 'User.state', 'AL'),
(168, 23, 'User.company', ''),
(169, 23, 'User.address', ''),
(170, 23, 'User.zipcode', ''),
(171, 23, 'User.mobile', ''),
(172, 1, 'User.first_name', 'shankar'),
(173, 1, 'User.last_name', 'palsaniya'),
(174, 1, 'User.city', ''),
(175, 1, 'User.state', 'AL'),
(176, 1, 'User.address', ''),
(177, 1, 'User.zipcode', ''),
(178, 1, 'User.telephone', '3598653265'),
(179, 1, 'User.mobile', ''),
(188, 25, 'User.first_name', 'New '),
(189, 25, 'User.last_name', 'Admin'),
(190, 25, 'User.city', 'Dallas'),
(191, 25, 'User.state', 'AL'),
(192, 25, 'User.address', '123 Main st.\r\ndfdf'),
(193, 25, 'User.zipcode', '3265'),
(194, 25, 'User.telephone', '6598326598'),
(195, 25, 'User.mobile', '3565989533'),
(196, 26, 'User.first_name', 'New admin'),
(197, 26, 'User.last_name', 'photogrfr'),
(198, 26, 'User.city', 'Dallas'),
(199, 26, 'User.state', 'AL'),
(200, 26, 'User.price', '50'),
(201, 26, 'User.comment', '[13/07/2015 20:14PM] sadsdasd'),
(202, 26, 'User.address', '123 Main st.\r\ndfdf'),
(203, 26, 'User.zipcode', '3265'),
(204, 26, 'User.telephone', '3265986532'),
(205, 26, 'User.mobile', '');

-- --------------------------------------------------------

--
-- Table structure for table `video_albums`
--

CREATE TABLE IF NOT EXISTS `video_albums` (
`id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL DEFAULT '1',
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `name` varchar(255) NOT NULL,
  `default_video_id` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `modified` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `video_galleries`
--

CREATE TABLE IF NOT EXISTS `video_galleries` (
`id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '1',
  `album_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `video` text NOT NULL,
  `description` text NOT NULL,
  `type` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created` int(11) NOT NULL,
  `modified` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `uniq_type` (`iso3166_1`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dropdown_managers`
--
ALTER TABLE `dropdown_managers`
 ADD PRIMARY KEY (`id`), ADD KEY `dropdown_type` (`dropdown_type`);

--
-- Indexes for table `email_actions`
--
ALTER TABLE `email_actions`
 ADD PRIMARY KEY (`id`), ADD KEY `action` (`action`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery_images`
--
ALTER TABLE `gallery_images`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image_albums`
--
ALTER TABLE `image_albums`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image_galleries`
--
ALTER TABLE `image_galleries`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
 ADD PRIMARY KEY (`id`), ADD KEY `is_editable` (`is_editable`), ADD KEY `slug` (`slug`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `key` (`key`);

--
-- Indexes for table `shoots`
--
ALTER TABLE `shoots`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shoot_products`
--
ALTER TABLE `shoot_products`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temps`
--
ALTER TABLE `temps`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD KEY `email` (`email`), ADD KEY `role_id` (`user_role_id`), ADD KEY `username` (`username`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
 ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `video_albums`
--
ALTER TABLE `video_albums`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `video_galleries`
--
ALTER TABLE `video_galleries`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=245;
--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dropdown_managers`
--
ALTER TABLE `dropdown_managers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `email_actions`
--
ALTER TABLE `email_actions`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `gallery_images`
--
ALTER TABLE `gallery_images`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `image_albums`
--
ALTER TABLE `image_albums`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `image_galleries`
--
ALTER TABLE `image_galleries`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
MODIFY `id` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=193;
--
-- AUTO_INCREMENT for table `shoots`
--
ALTER TABLE `shoots`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `shoot_products`
--
ALTER TABLE `shoot_products`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT for table `temps`
--
ALTER TABLE `temps`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=206;
--
-- AUTO_INCREMENT for table `video_albums`
--
ALTER TABLE `video_albums`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `video_galleries`
--
ALTER TABLE `video_galleries`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
