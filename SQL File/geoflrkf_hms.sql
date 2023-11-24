-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 17-11-2023 a las 15:12:34
-- Versión del servidor: 10.5.20-MariaDB-cll-lve-log
-- Versión de PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `geoflrkf_hms`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `updationDate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `updationDate`) VALUES
(1, 'admin', '$%Jul14n2521$%', '28-12-2016 11:42:05 AM');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `doctorSpecialization` varchar(255) DEFAULT NULL,
  `doctorId` int(11) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL,
  `consultancyFees` int(11) DEFAULT NULL,
  `appointmentDate` varchar(255) DEFAULT NULL,
  `appointmentTime` varchar(255) DEFAULT NULL,
  `postingDate` timestamp NULL DEFAULT current_timestamp(),
  `userStatus` int(11) DEFAULT NULL,
  `doctorStatus` int(11) DEFAULT NULL,
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `appointment`
--

INSERT INTO `appointment` (`id`, `doctorSpecialization`, `doctorId`, `userId`, `consultancyFees`, `appointmentDate`, `appointmentTime`, `postingDate`, `userStatus`, `doctorStatus`, `updationDate`) VALUES
(3, 'Demo test', 7, 6, 600, '2019-06-29', '9:15 AM', '2019-06-23 17:31:28', 1, 0, '0000-00-00 00:00:00'),
(4, 'Ayurveda', 5, 5, 8050, '2019-11-08', '1:00 PM', '2019-11-05 10:28:54', 1, 1, '0000-00-00 00:00:00'),
(5, 'Dermatologist', 9, 7, 500, '2019-11-30', '5:30 PM', '2019-11-10 18:41:34', 1, 0, '2019-11-10 18:48:30'),
(6, 'General Physician', 6, 2, 2500, '2022-07-22', '6:30 PM', '2022-07-15 20:24:38', 1, 1, NULL),
(7, 'electricista', 11, 2, 2000, '2023-11-08', '3:00 PM', '2023-11-08 19:58:38', 1, 0, '2023-11-08 20:00:15'),
(8, 'MÃ©dico general', 12, 8, 375, '2023-11-08', '10:15 PM', '2023-11-09 03:07:34', 1, 2, '2023-11-13 19:25:55'),
(9, 'MÃ©dico general', 12, 8, 375, '2023-11-17', '1:30 PM', '2023-11-17 19:23:30', 1, 2, '2023-11-17 19:27:18'),
(10, 'MÃ©dico general', 12, 9, 375, '2023-11-17', '1:30 PM', '2023-11-17 19:23:53', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `specilization` varchar(255) DEFAULT NULL,
  `doctorName` varchar(255) DEFAULT NULL,
  `address` longtext DEFAULT NULL,
  `docFees` varchar(255) DEFAULT NULL,
  `contactno` bigint(11) DEFAULT NULL,
  `docEmail` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `doctors`
--

INSERT INTO `doctors` (`id`, `specilization`, `doctorName`, `address`, `docFees`, `contactno`, `docEmail`, `password`, `creationDate`, `updationDate`) VALUES
(12, 'MÃ©dico general', 'Ivan Velazquez', 'Zona 1 Ciudad de Gautemala', '375', 11111111, 'ivan@ivan.com', '2c42e5cf1cdbafea04ed267018ef1511', '2023-11-09 02:54:02', NULL),
(13, 'Oftalmologo', 'Jorge Urbina', 'Zona 1 Ciudad de Guatemala', '250', 22222222, 'jorge@jorge.com', 'd67326a22642a324aa1b0745f2f17abb', '2023-11-09 02:55:26', NULL),
(14, 'Pediatra', 'Maria serrano', 'Zona 1 Ciudad de Guatemala', '520', 33333333, 'maria@maria.com', '263bce650e68ab4e23f28263760b9fa5', '2023-11-09 02:56:28', NULL),
(15, 'Ginecologo', 'Sophia EspaÃ±a', 'Zona 1 Ciudad de Guatemala', '375', 44444444, 'sophia@sopia.com', '2ee0272b8e1a9705dc3ebe91c10b32f4', '2023-11-09 02:57:38', NULL),
(16, 'Otorrinoralingolo', 'Margarita Garcia', 'Zona 1 Ciudad de Guatemala', '275', 5555555, 'margarita@margarita.com', 'e45bba48e1a1bfa964839e478cbe0034', '2023-11-09 02:58:49', NULL),
(17, 'Nutricionista', 'Pedro Morales', 'Ciudad de Guatemala', '300', 6666666, 'pedro@pedro.com', 'c6cc8094c2dc07b700ffcc36d64e2138', '2023-11-09 02:59:44', NULL),
(18, 'Medico cirujano', 'Samuel Juarez', 'Zona 1 Ciudad de Guatemala', '550', 7777777, 'samuel@samuel.com', 'd8ae5776067290c4712fa454006c8ec6', '2023-11-09 03:00:42', NULL),
(19, 'Urologo', 'David Jerez', 'Zona 1 Ciudad de Guatemala', '350', 88888888, 'david@david.com', '172522ec1028ab781d9dfd17eaca4427', '2023-11-09 03:01:47', NULL),
(20, 'Psicologo', 'Marta Tobar', 'Zona 1 Ciudad de Guatemala', '270', 99999999, 'marta@marta.com', 'a763a66f984948ca463b081bf0f0e6d0', '2023-11-09 03:02:40', NULL),
(21, 'Psiquiatra', 'Javier Xiloj', 'Zona 1 Ciudad de Guatemala', '370', 11112222, 'javier@javier.com', '3c9c03d6008a5adf42c2a55dd4a1a9f2', '2023-11-09 03:04:26', NULL),
(22, 'loboratorio', 'Esteban Mendez', 'Zona 1 Ciudad de Guatemala', '150', 22221111, 'esteban@esteban.com', '69ba109c895658f4c0f163c5fd8c4898', '2023-11-09 03:05:38', NULL),
(23, 'RayosX', 'Carlos Sarat', 'Zona 1 Ciudad de Guatemala', '230', 33331111, 'carlos@carlos.com', 'dc599a9972fde3045dab59dbd1ae170b', '2023-11-09 03:06:42', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctorslog`
--

CREATE TABLE `doctorslog` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `userip` binary(16) DEFAULT NULL,
  `loginTime` timestamp NULL DEFAULT current_timestamp(),
  `logout` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `doctorslog`
--

INSERT INTO `doctorslog` (`id`, `uid`, `username`, `userip`, `loginTime`, `logout`, `status`) VALUES
(20, 7, 'test@demo.com', 0x3a3a3100000000000000000000000000, '2022-07-15 19:59:57', '16-07-2022 02:30:39 AM', 1),
(21, 7, 'test@demo.com', 0x3a3a3100000000000000000000000000, '2022-07-15 20:25:47', '16-07-2022 02:56:57 AM', 1),
(22, 10, 'hola@hola.com', 0x3139302e3134382e35302e3233380000, '2023-11-08 00:25:35', NULL, 1),
(23, 10, 'hola@hola.com', 0x3139302e3134382e35302e3233380000, '2023-11-08 01:44:55', NULL, 1),
(24, NULL, 'pinula@pinula.pw', 0x3138312e3138392e3133392e32310000, '2023-11-08 19:57:44', NULL, 0),
(25, 11, 'pinula@pinula.com', 0x3138312e3138392e3133392e32310000, '2023-11-08 19:57:58', '09-11-2023 01:33:27 AM', 1),
(26, NULL, 'ivan@ivan', 0x3138312e3138392e3133392e32310000, '2023-11-09 03:54:41', NULL, 0),
(27, 12, 'ivan@ivan.com', 0x3138312e3138392e3133392e32310000, '2023-11-09 03:54:52', '09-11-2023 10:08:26 AM', 1),
(28, 12, 'ivan@ivan.com', 0x33382e34312e3233302e343100000000, '2023-11-13 19:25:29', NULL, 1),
(29, NULL, 'gca', 0x33382e34312e3233302e343100000000, '2023-11-17 19:24:32', NULL, 0),
(30, NULL, 'gcali@geoffdeep.pw', 0x33382e34312e3233302e343100000000, '2023-11-17 19:24:48', NULL, 0),
(31, 12, 'ivan@ivan.com', 0x33382e34312e3233302e343100000000, '2023-11-17 19:25:05', '18-11-2023 12:58:01 AM', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctorspecilization`
--

CREATE TABLE `doctorspecilization` (
  `id` int(11) NOT NULL,
  `specilization` varchar(255) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `doctorspecilization`
--

INSERT INTO `doctorspecilization` (`id`, `specilization`, `creationDate`, `updationDate`) VALUES
(15, 'MÃ©dico general', '2023-11-09 02:45:58', NULL),
(16, 'Oftalmologo', '2023-11-09 02:46:09', NULL),
(17, 'Pediatra', '2023-11-09 02:46:19', NULL),
(18, 'Ginecologo', '2023-11-09 02:46:28', NULL),
(19, 'Otorrinoralingolo', '2023-11-09 02:46:46', NULL),
(20, 'Nutricionista', '2023-11-09 02:47:03', NULL),
(21, 'Medico cirujano', '2023-11-09 02:47:25', NULL),
(22, 'Urologo', '2023-11-09 02:47:52', NULL),
(23, 'Psicologo', '2023-11-09 02:49:41', NULL),
(24, 'Psiquiatra', '2023-11-09 02:49:53', NULL),
(25, 'loboratorio', '2023-11-09 02:50:06', NULL),
(26, 'RayosX', '2023-11-09 02:50:12', NULL);


-- --------------------------------------------------------

--

/* Etructora de tabla tecnico de laboratorio*/
DROP TABLE IF EXISTS `tecnico_lab`;

CREATE TABLE `tecnico_lab` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tecnicoName` varchar(255) DEFAULT NULL,
  `address` longtext DEFAULT NULL,
  `labFees` varchar(255) DEFAULT NULL,
  `contactno` bigint(11) DEFAULT NULL,
  `labEmail` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Datos de inicio de sesion tecnicos de laboratorio*/
DROP TABLE IF EXISTS `lablog`;

CREATE TABLE `lablog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `userip` binary(16) DEFAULT NULL,
  `loginTime` timestamp NULL DEFAULT current_timestamp(),
  `logout` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

/*Estructura de Tecnico de rayos X*/
DROP TABLE IF EXISTS `tecnico_rx`;

CREATE TABLE `tecnico_rx` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tecnicoName` varchar(255) DEFAULT NULL,
  `address` longtext DEFAULT NULL,
  `rxFees` varchar(255) DEFAULT NULL,
  `contactno` bigint(11) DEFAULT NULL,
  `rxEmail` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Datos de inicio de sesion tecnicos de rayos X*/
DROP TABLE IF EXISTS `rxlog`;

CREATE TABLE `rxlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `userip` binary(16) DEFAULT NULL,
  `loginTime` timestamp NULL DEFAULT current_timestamp(),
  `logout` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Laboratorios`
--

CREATE TABLE `tiposlab` (
  `id` int(11) NOT NULL,
  `Tipo` varchar(255) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblcontactus`
--

CREATE TABLE `tblcontactus` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contactno` bigint(12) DEFAULT NULL,
  `message` mediumtext DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `AdminRemark` mediumtext DEFAULT NULL,
  `LastupdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `IsRead` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `tblcontactus`
--

INSERT INTO `tblcontactus` (`id`, `fullname`, `email`, `contactno`, `message`, `PostingDate`, `AdminRemark`, `LastupdationDate`, `IsRead`) VALUES
(1, 'test user', 'test@gmail.com', 2523523522523523, ' This is sample text for the test.', '2019-06-29 18:03:08', 'Test Admin Remark', '2019-06-30 11:55:23', 1),
(2, 'Anuj kumar', 'test123@gmail.com', 1111111111111111, ' This is sample text for testing.  This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing.', '2019-06-30 12:06:50', NULL, NULL, NULL),
(3, 'fdsfsdf', 'fsdfsd@ghashhgs.com', 3264826346, 'sample text   sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  ', '2019-11-10 18:53:48', 'vfdsfgfd', '2019-11-10 18:54:04', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblmedicalhistory`
--

CREATE TABLE `tblmedicalhistory` (
  `ID` int(10) NOT NULL,
  `PatientID` int(10) DEFAULT NULL,
  `BloodPressure` varchar(200) DEFAULT NULL,
  `BloodSugar` varchar(200) NOT NULL,
  `Weight` varchar(100) DEFAULT NULL,
  `Temperature` varchar(200) DEFAULT NULL,
  `ExamenFisico` mediumtext DEFAULT NULL,
  `MedicalPres` mediumtext DEFAULT NULL,
  `OrdenesMedicas` mediumtext DEFAULT NULL,
  `Evolucion` mediumtext DEFAULT NULL,
  `Laboratorio` mediumtext DEFAULT NULL,
  `RayosX` mediumtext DEFAULT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `tblmedicalhistory`
--

INSERT INTO `tblmedicalhistory` (`ID`, `PatientID`, `BloodPressure`, `BloodSugar`, `Weight`, `Temperature`, `ExamenFisico`, `MedicalPres`, `OrdenesMedicas`, `Evolucion`, `Laboratorio`, `RayosX`, `CreationDate`) VALUES
(2, 3, '120/185', '80/120', '85 Kg', '101 degree', NULL, '#Fever, #BP high\r\n1.Paracetamol\r\n2.jocib tab\r\n', NULL, NULL, NULL, NULL, '2019-11-06 04:20:07'),
(3, 2, '90/120', '92/190', '86 kg', '99 deg', NULL, '#Sugar High\r\n1.Petz 30', NULL, NULL, NULL, NULL, '2019-11-06 04:31:24'),
(4, 1, '125/200', '86/120', '56 kg', '98 deg', NULL, '# blood pressure is high\r\n1.koil cipla', NULL, NULL, NULL, NULL, '2019-11-06 04:52:42'),
(5, 1, '96/120', '98/120', '57 kg', '102 deg', NULL, '#Viral\r\n1.gjgjh-1Ml\r\n2.kjhuiy-2M', NULL, NULL, NULL, NULL, '2019-11-06 04:56:55'),
(6, 4, '90/120', '120', '56', '98 F', NULL, '#blood sugar high\r\n#Asthma problem', NULL, NULL, NULL, NULL, '2019-11-06 14:38:33'),
(7, 5, '80/120', '120', '85', '98.6', NULL, 'Rx\r\n\r\nAbc tab\r\nxyz Syrup', NULL, NULL, NULL, NULL, '2019-11-10 18:50:23'),
(8, 7, '45', '89', '159lb', '39', 'Bien', 'paracetamol de 800gm 1 a cada 8 horas.', 'Reposo de 2 dias regresar en a evaluacion el 10/11/2023', 'N/A', 'N/A', 'N/A', '2023-11-09 04:23:41'),
(9, 6, '45', '89', '159lb', '39', 'Bien', '1 tableta de 800gm de paracetamol a cada 8 horas por dos dias.', 'Reposo absoluto de dos dias, regresar el 10/11/2023.', 'N/A', 'N/A', 'N/A', '2023-11-09 04:32:19'),
(10, 7, '487', '5465', '4564', '6546', 'lecion extremidad supeior derecha', 'Cirugia', 'Cirigia', 'N/A', 'N/A', 'N/A', '2023-11-17 19:27:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblpatient`
--

CREATE TABLE `tblpatient` (
  `ID` int(10) NOT NULL,
  `PatientAdmision` varchar(200) DEFAULT NULL,
  `Docid` int(10) DEFAULT NULL,
  `labid` int(10) DEFAULT NULL,
  `rxid` int(10) DEFAULT NULL,
  `PatientName` varchar(200) DEFAULT NULL,
  `FechaNac` date DEFAULT NULL,
  `PatientContno` bigint(10) DEFAULT NULL,
  `PatientEmail` varchar(200) DEFAULT NULL,
  `PatientGender` varchar(50) DEFAULT NULL,
  `PatientAdd` mediumtext DEFAULT NULL,
  `PatientAge` int(10) DEFAULT NULL,
  `PatientMedhis` mediumtext DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `tblpatient`
--

INSERT INTO `tblpatient` (`ID`, `PatientAdmision`, `Docid`, `PatientName`, `FechaNac`, `PatientContno`, `PatientEmail`, `PatientGender`, `PatientAdd`, `PatientAge`, `PatientMedhis`, `CreationDate`, `UpdationDate`) VALUES
(1, NULL, 1, 'Manisha Jha', NULL, 4558968789, 'test@gmail.com', 'Female', '\"\"J&K Block J-127, Laxmi Nagar New Delhi', 26, 'She is diabetic patient', '2019-11-04 21:38:06', '2019-11-06 06:48:05'),
(2, NULL, 5, 'Raghu Yadav', NULL, 9797977979, 'raghu@gmail.com', 'Male', 'ABC Apartment Mayur Vihar Ph-1 New Delhi', 39, 'No', '2019-11-05 10:40:13', '2019-11-05 11:53:45'),
(3, NULL, 7, 'Mansi', NULL, 9878978798, 'jk@gmail.com', 'Female', '\"fdghyj', 46, 'No', '2019-11-05 10:49:41', '2019-11-05 11:58:59'),
(4, NULL, 7, 'Manav Sharma', NULL, 9888988989, 'sharma@gmail.com', 'Male', 'L-56,Ashok Nagar New Delhi-110096', 45, 'He is long suffered by asthma', '2019-11-06 14:33:54', '2019-11-06 14:34:31'),
(5, NULL, 9, 'John', NULL, 1234567890, 'john@test.com', 'male', 'Test ', 25, 'THis is sample text for testing.', '2019-11-10 18:49:24', NULL),
(6, '1234', 12, 'Catterin Cifuentes', '1994-10-08', 59624965, 'ccifuentes@umg.edu.gt', 'female', 'Zona 8 Aldea el Campanero, Ciudad San Cristobal', 31, 'Diarrea, Dolor de Cabeza, Fiebre.', '2023-11-09 04:01:53', NULL),
(7, '453', 12, 'Geoffreey Cali', '1993-12-08', 48410140, 'gcali@geoffdeep.pw', 'male', 'Chimaltenango', 29, 'Dolor de cabez', '2023-11-09 04:19:03', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `userlog`
--

CREATE TABLE `userlog` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `userip` binary(16) DEFAULT NULL,
  `loginTime` timestamp NULL DEFAULT current_timestamp(),
  `logout` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `userlog`
--

INSERT INTO `userlog` (`id`, `uid`, `username`, `userip`, `loginTime`, `logout`, `status`) VALUES
(24, NULL, 'test@gmail.com', 0x3a3a3100000000000000000000000000, '2022-07-15 19:57:20', NULL, 0),
(25, 2, 'test@gmail.com', 0x3a3a3100000000000000000000000000, '2022-07-15 19:57:57', '16-07-2022 02:29:28 AM', 1),
(26, 2, 'test@gmail.com', 0x3a3a3100000000000000000000000000, '2022-07-15 20:11:12', '16-07-2022 02:55:17 AM', 1),
(27, NULL, 'gcali@geoffdeep.pw', 0x3138312e3138392e3133392e32310000, '2023-11-08 19:47:24', NULL, 0),
(28, NULL, 'gcali@geoffdeep.pw', 0x3138312e3138392e3133392e32310000, '2023-11-08 19:47:50', NULL, 0),
(29, 2, 'test@gmail.com', 0x3138312e3138392e3133392e32310000, '2023-11-08 19:54:15', '09-11-2023 01:33:21 AM', 1),
(30, 8, 'gcali@geoffdeep.pw', 0x3138312e3138392e3133392e32310000, '2023-11-09 02:27:49', '09-11-2023 07:58:12 AM', 1),
(31, 8, 'gcali@geoffdeep.pw', 0x3138312e3138392e3133392e32310000, '2023-11-09 02:50:38', '09-11-2023 09:58:00 AM', 1),
(32, 9, 'ccifuentes@umg.edu.gt', 0x3138312e3138392e3133392e32310000, '2023-11-09 04:30:32', '09-11-2023 10:07:08 AM', 1),
(33, NULL, 'gcali@geoffdeep.pw', 0x3138312e3138392e3133392e32310000, '2023-11-10 12:37:07', NULL, 0),
(34, NULL, 'gcali@geoffdeep.pw', 0x3138312e3138392e3133392e32310000, '2023-11-10 12:37:10', NULL, 0),
(35, 8, 'gcali@geoffdeep.pw', 0x3138312e3138392e3133392e32310000, '2023-11-10 12:37:35', '10-11-2023 06:09:35 PM', 1),
(36, 8, 'gcali@geoffdeep.pw', 0x33382e34312e3233302e343100000000, '2023-11-13 19:23:36', NULL, 1),
(37, NULL, 'ccifuentes@umg.edu', 0x33382e34312e3233302e343100000000, '2023-11-17 19:22:26', NULL, 0),
(38, 9, 'ccifuentes@umg.edu.gt', 0x33382e34312e3233302e343100000000, '2023-11-17 19:22:40', '18-11-2023 12:58:11 AM', 1),
(39, 8, 'gcali@geoffdeep.pw', 0x33382e34312e3233302e343100000000, '2023-11-17 19:22:46', '18-11-2023 12:58:04 AM', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `PatientAdmision` varchar(200) DEFAULT NULL,
  `fullName` varchar(255) DEFAULT NULL,
  `FechaNac` date DEFAULT NULL,
  `address` longtext DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `regDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `PatientAdmision`, `fullName`, `FechaNac`, `address`, `city`, `gender`, `email`, `password`, `regDate`, `updationDate`) VALUES
(8, '453', 'Geoffreey Cali', '1992-08-02', '6 avenida 5-84 zona 1', 'Chimaltenango', 'male', 'gcali@geoffdeep.pw', '48dee3917024c3b2694e8bdec26f5c3f', '2023-11-09 02:27:30', NULL),
(9, '454', 'Catterin Cifuentes', '1992-08-02', 'Zona 8 Aldea el Campanero', 'Ciudad San Cristobal', 'female', 'ccifuentes@umg.edu.gt', '95a83ae1150dd68f4a52aec9d4d62506', '2023-11-09 04:30:06', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `doctorslog`
--
ALTER TABLE `doctorslog`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `doctorspecilization`
--
ALTER TABLE `doctorspecilization`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tblcontactus`
--
ALTER TABLE `tblcontactus`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tblmedicalhistory`
--
ALTER TABLE `tblmedicalhistory`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `tblpatient`
--
ALTER TABLE `tblpatient`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `doctorslog`
--
ALTER TABLE `doctorslog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `doctorspecilization`
--
ALTER TABLE `doctorspecilization`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `tblcontactus`
--
ALTER TABLE `tblcontactus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tblmedicalhistory`
--
ALTER TABLE `tblmedicalhistory`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tblpatient`
--
ALTER TABLE `tblpatient`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
