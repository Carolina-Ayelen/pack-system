-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-04-2022 a las 21:02:31
-- Versión del servidor: 10.4.16-MariaDB
-- Versión de PHP: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pack`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bulto`
--

CREATE TABLE `bulto` (
  `id_bulto` int(11) NOT NULL,
  `guia_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cod_pais`
--

CREATE TABLE `cod_pais` (
  `id_pais` int(11) NOT NULL,
  `codigo` varchar(20) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `zona` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cod_pais`
--

INSERT INTO `cod_pais` (`id_pais`, `codigo`, `descripcion`, `zona`) VALUES
(1, 'AD', 'Andorra', NULL),
(2, 'AE', 'Emiratos Árabes Unidos', NULL),
(3, 'AF', 'Afganistán', NULL),
(4, 'AG', 'Antigua y Barbuda', NULL),
(5, 'AI', 'Anguila', NULL),
(6, 'AL', 'Albania', NULL),
(7, 'AM', 'Armenia', NULL),
(8, 'AN', 'Antillas Neerlandesa', NULL),
(9, 'AO', 'Angola', NULL),
(10, 'AQ', 'Antártida', NULL),
(11, 'AR', 'Argentina', NULL),
(12, 'AS', 'Samoa Americana', NULL),
(13, 'AT', 'Austria', NULL),
(14, 'AU', 'Australia', NULL),
(15, 'AW', 'Aruba', NULL),
(16, 'AX', 'Islas Áland', NULL),
(17, 'AZ', 'Azerbaiyán', NULL),
(18, 'BA', 'Bosnia y Herzegovina', NULL),
(19, 'BB', 'Barbados', NULL),
(20, 'BD', 'Bangladesh', NULL),
(21, 'BE', 'Bélgica', NULL),
(22, 'BF', 'Burkina Faso', NULL),
(23, 'BG', 'Bulgaria', NULL),
(24, 'BH', 'Bahréin', NULL),
(25, 'BI', 'Burundi', NULL),
(26, 'BJ', 'Benin', NULL),
(27, 'BL', 'San Bartolomé\r\n', NULL),
(29, 'BN', 'Brunéi', NULL),
(30, 'BO', 'Bolivia', NULL),
(31, 'BR', 'Brasil', NULL),
(32, 'BS', 'Bahamas', NULL),
(33, 'BT', 'Bhután', NULL),
(34, 'BV', 'Isla Bouvet', NULL),
(35, 'BW', 'Botsuana', NULL),
(36, 'BY', 'Belarús', NULL),
(37, 'BZ', 'Belice', NULL),
(38, 'CA', 'Canadá', NULL),
(40, 'CF', 'República Centro-Africana', NULL),
(41, 'CG', 'Congo', NULL),
(42, 'CH', 'Suiza', NULL),
(43, 'CI', 'Costa de Marfil', NULL),
(44, 'CK', 'Islas Cook', NULL),
(45, 'CL', 'Chile', NULL),
(46, 'CM', 'Camerún', NULL),
(47, 'CN', 'China', NULL),
(48, 'CO', 'Colombia', NULL),
(49, 'CR', 'Costa Rica', NULL),
(50, 'CU', 'Cuba', NULL),
(51, 'CV', 'Cabo Verde', NULL),
(52, 'CX', 'Islas Christmas', NULL),
(53, 'CY', 'Chipre', NULL),
(54, 'CZ', 'República Checa', NULL),
(55, 'DE', 'Alemania', NULL),
(56, 'DJ', 'Yibuti', NULL),
(57, 'DK', 'Dinamarca', NULL),
(58, 'DM', 'Domínica', NULL),
(59, 'DO', 'República Dominicana', NULL),
(60, 'DZ', 'Argel', NULL),
(61, 'EC', 'Ecuador', NULL),
(62, 'EE', 'Estonia', NULL),
(63, 'EG', 'Egipto', NULL),
(64, 'EH', 'Sahara Occidental', NULL),
(65, 'ER', 'Eritrea', NULL),
(66, 'ES', 'España', NULL),
(69, 'FJ', 'Fiji', NULL),
(70, 'FK', 'Islas Malvinas', NULL),
(71, 'FM', 'Micronesia', NULL),
(72, 'FO', 'Islas Faroe', NULL),
(73, 'FR', 'Francia', NULL),
(74, 'GA', 'Gabón', NULL),
(76, 'GD', 'Granada', NULL),
(77, 'GE', 'Georgia', NULL),
(78, 'GF', 'Guayana Francesa', NULL),
(79, 'GG', 'Guernsey', NULL),
(80, 'GH', 'Ghana', NULL),
(81, 'GI', 'Gibraltar', NULL),
(82, 'GL', 'Groenlandia', NULL),
(83, 'GM', 'Gambia', NULL),
(84, 'GN', 'Guinea', NULL),
(85, 'GP', 'Guadalupe', NULL),
(86, 'GQ', 'Guinea Ecuatorial', NULL),
(87, 'GR', 'Grecia', NULL),
(88, 'GS', 'Georgia del Sur e Islas Sandwich del Sur', NULL),
(89, 'GT', 'Guatemala', NULL),
(90, 'GU', 'Guam', NULL),
(91, 'GW', 'Guinea-Bissau', NULL),
(92, 'GY', 'Guayana', NULL),
(93, 'HK', 'Hong Kong', NULL),
(94, 'HM', 'Islas Heard y McDona', NULL),
(95, 'HN', 'Honduras', NULL),
(96, 'HR', 'Croacia', NULL),
(97, 'HT', 'Haití', NULL),
(100, 'IE', 'Irlanda', NULL),
(101, 'IL', 'Israel', NULL),
(102, 'IM', 'Isla de Man', NULL),
(103, 'IN', 'India', NULL),
(104, 'IO', 'Territorio Británico', NULL),
(105, 'IQ', 'Irak', NULL),
(106, 'IR', 'Irán', NULL),
(107, 'IS', 'Islandia', NULL),
(108, 'IT', 'Italia', NULL),
(109, 'JE', 'Jersey', NULL),
(110, 'JM', 'Jamaica', NULL),
(111, 'JO', 'Jordania', NULL),
(112, 'JP', 'Japón', NULL),
(114, 'KG', 'Kirguistán', NULL),
(115, 'KH', 'Camboya', NULL),
(116, 'KI', 'Kiribati', NULL),
(117, 'KM', 'Comoros', NULL),
(118, 'KN', 'San Cristóbal y Nieves', NULL),
(119, 'KP', 'Corea del Norte', NULL),
(120, 'KR', 'Corea del Sur', NULL),
(121, 'KW', 'Kuwait', NULL),
(122, 'KY', 'Islas Caimán', NULL),
(123, 'KZ', 'Kazajstán', NULL),
(124, 'LA', 'Laos', NULL),
(125, 'LB', 'Líbano', NULL),
(126, 'LC', 'Santa Lucía', NULL),
(127, 'LI', 'Liechtenstein', NULL),
(128, 'LK', 'Sri Lanka', NULL),
(129, 'LR', 'Liberia', NULL),
(130, 'LS', 'Lesotho', NULL),
(131, 'LT', 'Lituania', NULL),
(132, 'LU', 'Luxemburgo', NULL),
(133, 'LV', 'Letonia', NULL),
(134, 'LY', 'Libia', NULL),
(135, 'MA', 'Marruecos', NULL),
(136, 'MC', 'Mónaco', NULL),
(137, 'MD', 'Moldova', NULL),
(138, 'ME', 'Montenegro', NULL),
(139, 'MG', 'Madagascar', NULL),
(140, 'MH', 'Islas Marshall', NULL),
(141, 'MK', 'Macedonia', NULL),
(142, 'ML', 'Mali', NULL),
(143, 'MM', 'Myanmar', NULL),
(144, 'MN', 'Mongolia', NULL),
(145, 'MO', 'Macao', NULL),
(146, 'MQ', 'Martinica', NULL),
(147, 'MR', 'Mauritania', NULL),
(148, 'MS', 'Montserrat', NULL),
(149, 'MT', 'Malta', NULL),
(150, 'MU', 'Mauricio', NULL),
(151, 'MV', 'Maldivas', NULL),
(152, 'MW', 'Malawi', NULL),
(153, 'MX', 'México', NULL),
(154, 'MY', 'Malasia', NULL),
(155, 'MZ', 'Mozambique', NULL),
(156, 'NA', 'Namibia', NULL),
(157, 'NC', 'Nueva Caledonia', NULL),
(158, 'NE', 'Níger', NULL),
(159, 'NF', 'Islas Norkfolk', NULL),
(160, 'NG', 'Nigeria', NULL),
(161, 'NI', 'Nicaragua', NULL),
(162, 'NL', 'Países Bajos', NULL),
(163, 'NO', 'Noruega', NULL),
(164, 'NP', 'Nepal', NULL),
(165, 'NR', 'Nauru', NULL),
(166, 'NU', 'Niue', NULL),
(167, 'NZ', 'Nueva Zelanda', NULL),
(168, 'OM', 'Omán', NULL),
(169, 'PA', 'Panamá', NULL),
(171, 'PF', 'Polinesia Francesa', NULL),
(172, 'PG', 'Papúa Nueva Guinea', NULL),
(173, 'PH', 'Filipinas', NULL),
(174, 'PK', 'Pakistán', NULL),
(175, 'PL', 'Polonia', NULL),
(176, 'PM', 'San Pedro y Miquelón', NULL),
(178, 'PR', 'Puerto Rico', NULL),
(179, 'PS', 'Palestina', NULL),
(180, 'PT', 'Portugal', NULL),
(181, 'PW', 'Islas Palaos', NULL),
(182, 'PY', 'Paraguay', NULL),
(183, 'QA', 'Qatar', NULL),
(184, 'RE', 'Rumanía', NULL),
(187, 'RU', 'Rusia', NULL),
(188, 'RW', 'Ruanda', NULL),
(189, 'SA', 'Arabia Saudita', NULL),
(190, 'SB', 'Islas Solomón', NULL),
(192, 'SD', 'Sudán', NULL),
(193, 'SE', 'Suecia', NULL),
(194, 'SG', 'Singapur', NULL),
(195, 'SH', 'Santa Elena', NULL),
(196, 'SI', 'Eslovenia', NULL),
(197, 'SJ', 'Islas Svalbard y Jan Mayen', NULL),
(198, 'SK', 'Eslovaquia', NULL),
(199, 'SL', 'Sierra Leona', NULL),
(200, 'SM', 'San Marino', NULL),
(201, 'SN', 'Senegal', NULL),
(202, 'SO', 'Somalia', NULL),
(203, 'SR', 'Surinam', NULL),
(204, 'ST', 'Santo Tomé y Príncipe', NULL),
(205, 'SV', 'El Salvador', NULL),
(206, 'SY', 'Siria', NULL),
(207, 'SZ', 'Suazilandia', NULL),
(208, 'TC', 'Islas Turcas y Caico', NULL),
(209, 'TD', 'Chad', NULL),
(210, 'TF', 'Territorios Australe', NULL),
(211, 'TG', 'Togo', NULL),
(212, 'TH', 'Tailandia', NULL),
(213, 'TH', 'Tanzania', NULL),
(214, 'TJ', 'Tayikistán', NULL),
(215, 'TK', 'Tokelau', NULL),
(216, 'TL', 'Timor-Leste', NULL),
(217, 'TM', 'Turkmenistán', NULL),
(218, 'TN', 'Túnez', NULL),
(219, 'TO', 'Tonga', NULL),
(220, 'TR', 'Turquía', NULL),
(221, 'TT', 'Trinidad y Tobago', NULL),
(222, 'TV', 'Tuvalu', NULL),
(223, 'TW', 'Taiwán', NULL),
(224, 'UA', 'Ucrania', NULL),
(225, 'UG', 'Uganda', NULL),
(226, 'US', 'Estados Unidos de América', NULL),
(227, 'UY', 'Uruguay', NULL),
(228, 'UZ', 'Uzbekistán', NULL),
(229, 'VA', 'Ciudad del Vaticano', NULL),
(230, 'VC', 'San Vicente y las Granadinas', NULL),
(231, 'VE', 'Venezuela', NULL),
(232, 'VG', 'Islas Vírgenes Británicas', NULL),
(233, 'VI', 'Islas Vírgenes de los Estados Unidos de América', NULL),
(234, 'VN', 'Vietnam', NULL),
(235, 'VU', 'Vanuatu', NULL),
(236, 'WF', 'Wallis y Futuna', NULL),
(237, 'WS', 'Samoa', NULL),
(238, 'YE', 'Yemen', NULL),
(239, 'YT', 'Mayotte', NULL),
(240, 'ZA', 'Sudáfrica', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_bulto`
--

CREATE TABLE `detalles_bulto` (
  `id_detalle` int(11) NOT NULL,
  `descripcion` varchar(20) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` float NOT NULL,
  `bulto_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `id_factura` int(11) NOT NULL,
  `fecha` date NOT NULL DEFAULT current_timestamp(),
  `precio_tipo` decimal(25,2) NOT NULL DEFAULT 0.07,
  `importe_tipo` decimal(25,2) NOT NULL,
  `importe_empaquetado` decimal(25,2) NOT NULL DEFAULT 0.00,
  `importe_tarifario` decimal(25,2) NOT NULL,
  `precio_excedenteKg` decimal(25,2) NOT NULL,
  `dif_x_peso` decimal(25,2) NOT NULL,
  `guia_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `guia_embarque`
--

CREATE TABLE `guia_embarque` (
  `id_guia` int(11) NOT NULL,
  `numero` varchar(25) NOT NULL DEFAULT '''0''',
  `cod_origen` int(11) NOT NULL,
  `cod_destino` int(11) NOT NULL,
  `fecha_emb` date NOT NULL,
  `valor_mercancia` decimal(10,0) NOT NULL,
  `peso_real` float NOT NULL,
  `tipo_bulto` varchar(20) NOT NULL,
  `cantidad_bulto` int(11) NOT NULL,
  `descripcion` varchar(20) NOT NULL,
  `empaquetado` char(2) NOT NULL,
  `peso_volumetrico` float NOT NULL,
  `incotem` varchar(25) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `electronico` char(2) NOT NULL DEFAULT 'no',
  `personasEnv_id` int(11) NOT NULL,
  `personasDest_id` int(11) NOT NULL,
  `estado_id` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `manifiesto`
--

CREATE TABLE `manifiesto` (
  `id_manifiesto` int(11) NOT NULL,
  `numero` varchar(10) NOT NULL DEFAULT '0',
  `fecha` date NOT NULL,
  `vuelo` varchar(11) NOT NULL,
  `cod_origen` int(11) NOT NULL,
  `cod_destino` int(11) NOT NULL,
  `expedidor` varchar(1000) NOT NULL,
  `consignatario` varchar(1000) NOT NULL,
  `electronico` char(2) NOT NULL DEFAULT 'no',
  `estado_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `manifiesto`
--

INSERT INTO `manifiesto` (`id_manifiesto`, `numero`, `fecha`, `vuelo`, `cod_origen`, `cod_destino`, `expedidor`, `consignatario`, `electronico`, `estado_id`) VALUES
(29, '0', '2022-02-14', '5653368', 1, 2, 'FERIBAN S.A. Aeropuerto Int´l. de Carrasco TCU of 116 Montevideo - Uruguay', 'xxxxx', 'no', 1),
(30, 'null', '2022-02-14', '123456', 1, 2, 'FERIBAN S.A. Aeropuerto Int´l. de Carrasco TCU of 116 Montevideo - Uruguay', '123', 'no', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `manif_embarq`
--

CREATE TABLE `manif_embarq` (
  `manifiesto_id` int(11) NOT NULL,
  `guia_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `manif_embarq`
--

INSERT INTO `manif_embarq` (`manifiesto_id`, `guia_id`) VALUES
(29, 138),
(30, 143);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id_persona` int(11) NOT NULL,
  `dni` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellidos` varchar(20) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `tel` varchar(50) NOT NULL,
  `pais` int(11) NOT NULL,
  `departamento` varchar(50) NOT NULL,
  `cod_postal` int(11) NOT NULL,
  `correo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarifario`
--

CREATE TABLE `tarifario` (
  `kg` decimal(10,2) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `zona` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tarifario`
--

INSERT INTO `tarifario` (`kg`, `precio`, `zona`) VALUES
('0.00', '23.00', 'F'),
('0.50', '52.00', 'F'),
('1.00', '54.00', 'F'),
('1.50', '69.00', 'F'),
('2.00', '75.00', 'F'),
('2.50', '85.00', 'F'),
('3.00', '101.00', 'F'),
('3.50', '112.00', 'F'),
('4.00', '122.00', 'F'),
('4.50', '133.00', 'F'),
('5.00', '144.00', 'F'),
('5.50', '151.00', 'F'),
('6.00', '164.00', 'F'),
('6.50', '171.00', 'F'),
('7.00', '179.00', 'F'),
('7.50', '186.00', 'F'),
('8.00', '194.00', 'F'),
('8.50', '202.00', 'F'),
('9.00', '214.00', 'F'),
('9.50', '223.00', 'F'),
('10.00', '228.00', 'F'),
('10.50', '256.80', 'F'),
('11.00', '264.29', 'F'),
('11.50', '276.06', 'F'),
('12.00', '280.27', 'F'),
('12.50', '294.97', 'F'),
('13.00', '297.50', 'F'),
('13.50', '313.84', 'F'),
('14.00', '319.48', 'F'),
('14.50', '324.67', 'F'),
('15.00', '338.25', 'F'),
('15.50', '348.16', 'F'),
('16.00', '355.94', 'F'),
('16.50', '372.27', 'F'),
('17.00', '377.91', 'F'),
('17.50', '383.55', 'F'),
('18.00', '399.89', 'F'),
('18.50', '409.81', 'F'),
('19.00', '418.66', 'F'),
('19.50', '437.14', 'F'),
('20.00', '442.78', 'F'),
('20.50', '484.40', 'F'),
('21.00', '454.04', 'F'),
('21.50', '459.68', 'F'),
('22.00', '465.32', 'F'),
('22.50', '479.52', 'F'),
('23.00', '498.00', 'F'),
('23.50', '503.64', 'F'),
('24.00', '509.28', 'F'),
('24.50', '514.92', 'F'),
('25.00', '520.56', 'F'),
('26.00', '536.95', 'F'),
('27.00', '558.15', 'F'),
('28.00', '575.30', 'F'),
('29.00', '588.29', 'F'),
('30.00', '612.04', 'F');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(20) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `roll` varchar(20) DEFAULT NULL,
  `personas_id` int(11) NOT NULL,
  `imagen` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bulto`
--
ALTER TABLE `bulto`
  ADD PRIMARY KEY (`id_bulto`),
  ADD KEY `guia_id` (`guia_id`);

--
-- Indices de la tabla `cod_pais`
--
ALTER TABLE `cod_pais`
  ADD PRIMARY KEY (`id_pais`);

--
-- Indices de la tabla `detalles_bulto`
--
ALTER TABLE `detalles_bulto`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `bulto_id` (`bulto_id`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id_factura`),
  ADD KEY `factura_usuario` (`usuario_id`),
  ADD KEY `guia_id` (`guia_id`);

--
-- Indices de la tabla `guia_embarque`
--
ALTER TABLE `guia_embarque`
  ADD PRIMARY KEY (`id_guia`),
  ADD KEY `cod_origen` (`cod_origen`),
  ADD KEY `personas_id` (`personasEnv_id`),
  ADD KEY `personasDest_id` (`personasDest_id`),
  ADD KEY `cod_destino` (`cod_destino`);

--
-- Indices de la tabla `manifiesto`
--
ALTER TABLE `manifiesto`
  ADD PRIMARY KEY (`id_manifiesto`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id_persona`),
  ADD KEY `pais` (`pais`);

--
-- Indices de la tabla `tarifario`
--
ALTER TABLE `tarifario`
  ADD PRIMARY KEY (`kg`,`zona`),
  ADD KEY `pais_id` (`zona`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `personas_usuario` (`personas_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bulto`
--
ALTER TABLE `bulto`
  MODIFY `id_bulto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id_factura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `guia_embarque`
--
ALTER TABLE `guia_embarque`
  MODIFY `id_guia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT de la tabla `manifiesto`
--
ALTER TABLE `manifiesto`
  MODIFY `id_manifiesto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bulto`
--
ALTER TABLE `bulto`
  ADD CONSTRAINT `bulto_guia` FOREIGN KEY (`guia_id`) REFERENCES `guia_embarque` (`id_guia`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalles_bulto`
--
ALTER TABLE `detalles_bulto`
  ADD CONSTRAINT `detalle_bulto` FOREIGN KEY (`bulto_id`) REFERENCES `bulto` (`id_bulto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`guia_id`) REFERENCES `guia_embarque` (`id_guia`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `factura_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `guia_embarque`
--
ALTER TABLE `guia_embarque`
  ADD CONSTRAINT `destinatario` FOREIGN KEY (`personasDest_id`) REFERENCES `personas` (`id_persona`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `remitente` FOREIGN KEY (`personasEnv_id`) REFERENCES `personas` (`id_persona`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `personas`
--
ALTER TABLE `personas`
  ADD CONSTRAINT `personas_pais` FOREIGN KEY (`pais`) REFERENCES `cod_pais` (`id_pais`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `personas_usuario` FOREIGN KEY (`personas_id`) REFERENCES `personas` (`id_persona`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `personas_usuarios` FOREIGN KEY (`personas_id`) REFERENCES `personas` (`id_persona`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
