-- --------------------------------------------------------
-- CREACION DE BASE DE DATOS
-- --------------------------------------------------------

-- Database: `untrmeventos`
CREATE DATABASE untrmeventos;


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- --------------------------------------------------------
-- CREACION DE TABLAS 
-- --------------------------------------------------------

-- Table structure for table `admins`
CREATE TABLE `admins` (
  `id_admin` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `password` varchar(60) NOT NULL,
  `editado` datetime NOT NULL,
  `nivel` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table structure for table `categoria_evento`
CREATE TABLE `categoria_evento` (
  `id_categoria` tinyint(10) NOT NULL,
  `cat_evento` varchar(50) NOT NULL,
  `icono` varchar(15) NOT NULL,
  `editado` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table structure for table `evento`
CREATE TABLE `evento` (
  `id_evento` tinyint(10) NOT NULL,
  `nombre_evento` varchar(60) NOT NULL,
  `fecha_evento` date NOT NULL,
  `hora_evento` time NOT NULL,
  `id_cat_evento` tinyint(10) NOT NULL,
  `id_inv` tinyint(4) NOT NULL,
  `clave` varchar(10) NOT NULL,
  `editado` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table structure for table `invitado`
CREATE TABLE `invitado` (
  `id_invitado` tinyint(4) NOT NULL,
  `nombre_invitado` varchar(30) NOT NULL,
  `apellidopa_invitado` varchar(30) NOT NULL,
  `apellidoma_invitado` varchar(30) NOT NULL,
  `descripcion` text NOT NULL,
  `url_imagen` varchar(50) NOT NULL,
  `editado` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table structure for table `regalo`
CREATE TABLE `regalo` (
  `id_regalo` int(11) NOT NULL,
  `nombre_regalo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table structure for table `registrado`
CREATE TABLE `registrado` (
  `id_registrado` bigint(20) UNSIGNED NOT NULL,
  `nombre_registrado` varchar(50) NOT NULL,
  `apellidopa_registrado` varchar(50) NOT NULL,
  `apellidoma_registrado` varchar(50) NOT NULL,
  `email_registrado` varchar(100) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `pases_articulos` longtext NOT NULL,
  `taller_registrado` longtext NOT NULL,
  `regalo` int(11) NOT NULL,
  `total_pagado` varchar(50) NOT NULL,
  `pagado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
-- CREACION DE INDICES PARA TABLAS VOLCADAS 
-- --------------------------------------------------------

-- Indexes for table `admins`
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `usuario` (`usuario`);

-- Indexes for table `categoria_evento`
ALTER TABLE `categoria_evento`
  ADD PRIMARY KEY (`id_categoria`);

-- Indexes for table `evento`
ALTER TABLE `evento`
  ADD PRIMARY KEY (`id_evento`),
  ADD KEY `id_cat_evento` (`id_cat_evento`),
  ADD KEY `id_inv` (`id_inv`);

-- Indexes for table `invitado`
ALTER TABLE `invitado`
  ADD PRIMARY KEY (`id_invitado`);

-- Indexes for table `regalo`
ALTER TABLE `regalo`
  ADD PRIMARY KEY (`id_regalo`);
  
-- Indexes for table `registrado`
ALTER TABLE `registrado`
  ADD PRIMARY KEY (`id_registrado`),
  ADD KEY `regalo` (`regalo`);
  
-- --------------------------------------------------------
-- CREACION DE AUTO-INCREMENTOS 
-- --------------------------------------------------------  
  
-- AUTO_INCREMENT for table `admins`
ALTER TABLE `admins`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

-- AUTO_INCREMENT for table `categoria_evento`
ALTER TABLE `categoria_evento`
  MODIFY `id_categoria` tinyint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

-- AUTO_INCREMENT for table `evento`
ALTER TABLE `evento`
  MODIFY `id_evento` tinyint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

-- AUTO_INCREMENT for table `invitado`
ALTER TABLE `invitado`
  MODIFY `id_invitado` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

-- AUTO_INCREMENT for table `regalo`
ALTER TABLE `regalo`
  MODIFY `id_regalo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

-- AUTO_INCREMENT for table `registrado`
ALTER TABLE `registrado`
  MODIFY `id_registrado` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

-- --------------------------------------------------------
-- CREACION DE RESTRICCIONES PARA TABLAS VOLCADAS 
-- --------------------------------------------------------

-- Constraints for table `evento`
ALTER TABLE `evento`
  ADD CONSTRAINT `evento_ibfk_1` FOREIGN KEY (`id_cat_evento`) REFERENCES `categoria_evento` (`id_categoria`),
  ADD CONSTRAINT `evento_ibfk_2` FOREIGN KEY (`id_inv`) REFERENCES `invitado` (`id_invitado`);

-- Constraints for table `registrado`
ALTER TABLE `registrado`
  ADD CONSTRAINT `registrado_ibfk_1` FOREIGN KEY (`regalo`) REFERENCES `regalo` (`id_regalo`);

-- --------------------------------------------------------
-- INSERCION DE DATOS A TABLAS CREADAS 
-- --------------------------------------------------------

-- Dumping data for table `admins`
INSERT INTO `admins` (`id_admin`, `usuario`, `nombre`, `password`, `editado`, `nivel`) VALUES
(1, 'admin1', 'Blanca Saavedra Julian', '$2y$12$JVcP.YEiwxa9em/8W1y5huFzJKbDqcsUtYVirRbeKYfNlTO7fx.F2', '0000-00-00 00:00:00', 1),
(2, 'admin2', 'Jesedy Saavedra', '$2y$12$Uyhgtht0lJ5ixxYjCe2arO9wB/KcUkYJn2BrfnAxe.xrhzes9HBCS', '0000-00-00 00:00:00', 0),
(3, 'admin3', 'Edward Vasquez Becerra', '$2y$12$lBxUBy0Ss277oSuFieJUj.X.XvMXrJNvyfq3MX5i0Dv9dh.XsyCNG', '0000-00-00 00:00:00', 1),
(4, 'admin4', 'Harry Rodrigo Cubas Saavedra', '$2y$12$ccBbGRGQXU.Z7qzbx6sRD.Sk552sBdC5vvSVYuRsDZY99i0DjoAde', '0000-00-00 00:00:00', 0),
(5, 'admin5', 'Jhan Risco Velarde', '$2y$12$3dgwtgtYLyh771amziBNfuPen7XkQq08V7bvglphgFYm8L.bMC1E.', '0000-00-00 00:00:00', 0),
(6, 'admin6', 'Jennifer Franco verastegui', '$2y$12$qowBTrXVUra7S0tENKbCDOWLx8/QUOsTa3KIOH1hFPH8WZhAMdg3q', '0000-00-00 00:00:00', 0),
(7, 'admin7', 'Edelguisa Julian Vasquez', '$2y$12$Qh/VGp5U/ULsCzvzv9hnDeutxtfanlnuz/fhWO9bdUCj8mGAO8C4u', '0000-00-00 00:00:00', 0),
(8, 'admin8', 'Jesus Saavedra Tello', '$2y$12$rPY0YxVStZiYzbOvReIBheqBRNF5Ju1p251rnfS0O9NUDtJgmYO8O', '0000-00-00 00:00:00', 0),
(9, 'admin9', 'Jower Cubas Villalovos', '$2y$12$QL.OZ80InAxHPEXMLLsTMea./rKp76udIqypr0AWpoLkH7zkymCAi', '0000-00-00 00:00:00', 0),
(10, 'admin10', 'Ana Saavedra Julian', '$2y$12$n2M7fvrXkhV2gG7w2Bp3RerPQNQ7e5LGfBKy2QNsINYokCn5EI3YO', '0000-00-00 00:00:00', 0);

-- Dumping data for table `categoria_evento`
INSERT INTO `categoria_evento` (`id_categoria`, `cat_evento`, `icono`, `editado`) VALUES
(1, 'Seminario', 'fa-university', '0000-00-00 00:00:00'),
(2, 'Conferencia', 'fa-comment', '0000-00-00 00:00:00'),
(3, 'Taller', 'fa-code', '0000-00-00 00:00:00');

-- Dumping data for table `invitado`
INSERT INTO `invitado` (`id_invitado`, `nombre_invitado`, `apellidopa_invitado`, `apellidoma_invitado`, `descripcion`, `url_imagen`, `editado`) VALUES
(1, 'Roberto Carlos', 'Santa Cruz', 'Acosta', 'Docente nombrado en la FISME - Bagua.', 'invitado1.jpg', '0000-00-00 00:00:00'),
(2, 'Carlos Luis', 'Lobaton', 'Arenas', 'Docente nombrado en la FISME - Bagua.', 'invitado2.jpg', '0000-00-00 00:00:00'),
(3, 'Roberto', 'Pérez', 'Astonitas', 'Docente contratado en la FISME - Bagua.', 'invitado3.jpg', '0000-00-00 00:00:00');

-- Dumping data for table `evento`
INSERT INTO `evento` (`id_evento`, `nombre_evento`, `fecha_evento`, `hora_evento`, `id_cat_evento`, `id_inv`, `clave`, `editado`) VALUES
(1, 'Proceso de investigación', '2020-05-11', '09:00:00', 3, 1, 'taller_01', '0000-00-00 00:00:00'),
(2, 'Acceso a información de bases de datos relevantes.', '2020-05-12', '09:00:00', 3, 2, 'taller_02', '0000-00-00 00:00:00'),
(3, 'Referencias bibliográficas', '2020-05-13', '09:00:00', 3, 1, 'taller_03', '0000-00-00 00:00:00'),
(4, 'Validación', '2020-05-14', '09:00:00', 3, 1, 'taller_04', '0000-00-00 00:00:00'),
(5, 'Análisis de resultados y conclusiones', '2020-05-15', '09:00:00', 3, 1, 'taller_05', '0000-00-00 00:00:00');

-- Dumping data for table `regalo`
INSERT INTO `regalo` (`id_regalo`, `nombre_regalo`) VALUES
(1, 'Pulsera'),
(2, 'Etiquetas'),
(3, 'Plumas');

-- Dumping data for table `registrado`
INSERT INTO `registrado` (`id_registrado`, `nombre_registrado`, `apellidopa_registrado`, `apellidoma_registrado`, `email_registrado`, `fecha_registro`, `pases_articulos`, `taller_registrado`, `regalo`, `total_pagado`, `pagado`) VALUES
(1, 'Blanca', 'Saavedra', 'Julian', 'blank.esj@gmail.com', '2020-01-02 21:02:36', '{"pase_completo":1,"camisas":1,"etiquetas":1}', '{"eventos":["taller_01","taller_02","taller_03","taller_04","taller_05"]}', 1, '61.3', 0),
(2, 'Jennifer', 'Franco', 'Verastegui', 'Jeny.f.v04@gmail.com', '2020-01-02 21:15:51', '{"un_dia":1,"camisas":2,"etiquetas":1}', '{"eventos":["taller_01","taller_02","taller_03","taller_04","taller_05"]}', 3, '50.6', 0),
(3, 'Yerfin', 'Milian', 'Cusma', 'yealmilian97@gmail.com', '2020-01-02 21:29:52', '{"un_dia":1,"camisas":1,"etiquetas":2}', '{"eventos":["taller_01","taller_02","taller_03","taller_04","taller_05"]}', 2, '43.3', 0),
(4, 'Edward', 'Vasquez', 'Becerra', 'edalvb@gmail.com', '2020-01-13 14:35:58', '{"un_dia":1,"camisas":1,"etiquetas":2}', '{"eventos":["taller_01","taller_02","taller_03","taller_04","taller_05"]}', 1, '43.3', 0);

-- --------------------------------------------------------
-- CONSULTAS 
-- --------------------------------------------------------

-- Consulta para login


