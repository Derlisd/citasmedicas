-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-05-2019 a las 08:11:12
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbdentalkiru`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita`
--

CREATE TABLE `cita` (
  `idcita` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `idpaciente` int(11) NOT NULL,
  `iddetalle_horario` int(11) NOT NULL,
  `idcosto` int(11) NOT NULL,
  `observaciones` varchar(45) NOT NULL,
  `agregado` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cita`
--

INSERT INTO `cita` (`idcita`, `idusuario`, `idpaciente`, `iddetalle_horario`, `idcosto`, `observaciones`, `agregado`, `estado`) VALUES
(73, 2, 3, 179, 1, 'tof0d', '2019-05-14 16:36:38', 'anulado'),
(74, 1, 1, 183, 1, 'yyyyy', '2019-05-14 16:38:12', 'pagado'),
(75, 1, 1, 193, 1, 'aaaaaaa', '2019-05-14 16:49:46', 'pagado'),
(76, 1, 2, 191, 1, 'mal mal', '2019-05-14 16:50:10', 'pagado'),
(77, 1, 3, 182, 1, 'aaaaaaa', '2019-05-15 16:24:36', 'pagado'),
(78, 1, 3, 180, 1, 'dolor de cabeza', '2019-05-15 19:32:51', 'anulado'),
(79, 1, 1, 181, 1, 'iiii', '2019-05-16 00:11:35', 'anulado'),
(80, 1, 1, 180, 1, 'dolor de cabeza', '2019-05-16 00:11:51', 'anulado'),
(81, 1, 2, 190, 1, 'dolor de cabeza', '2019-05-16 00:21:02', 'pendiente'),
(82, 1, 2, 189, 1, 'mal mal', '2019-05-16 00:21:23', 'pagado');

--
-- Disparadores `cita`
--
DELIMITER $$
CREATE TRIGGER `tr_activarhorario` AFTER UPDATE ON `cita` FOR EACH ROW BEGIN
  UPDATE cita c
    JOIN detalle_horario dh
      ON dh.iddetalle_horario = c.iddetalle_horario
     AND c.estado ='anulado'
     AND c.idcita =NEW.idcita
     set dh.estado ='1';
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tr_desactivarhorarios` AFTER INSERT ON `cita` FOR EACH ROW BEGIN
 UPDATE detalle_horario SET estado =0 
 WHERE detalle_horario.iddetalle_horario = NEW.iddetalle_horario;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consultorio`
--

CREATE TABLE `consultorio` (
  `idconsultorio` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `estado` tinyint(4) NOT NULL,
  `agregado` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `consultorio`
--

INSERT INTO `consultorio` (`idconsultorio`, `nombre`, `estado`, `agregado`) VALUES
(1, 'camiseta Sporting Cristal Celeste', 1, '2019-05-10 11:59:24'),
(2, 'casaca', 1, '2019-05-10 11:59:27'),
(3, 'blusa', 1, '2019-05-10 11:59:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `costo`
--

CREATE TABLE `costo` (
  `idcosto` int(11) NOT NULL,
  `idespecialidad` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `costo`
--

INSERT INTO `costo` (`idcosto`, `idespecialidad`, `precio`, `estado`) VALUES
(1, 2, '90.00', 1),
(2, 4, '100.00', 1),
(3, 3, '10.00', 1),
(4, 1, '60.00', 1),
(5, 5, '50.00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_horario`
--

CREATE TABLE `detalle_horario` (
  `iddetalle_horario` int(11) NOT NULL,
  `idhorario` int(11) NOT NULL,
  `idhora` int(11) NOT NULL,
  `estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_horario`
--

INSERT INTO `detalle_horario` (`iddetalle_horario`, `idhorario`, `idhora`, `estado`) VALUES
(179, 12, 2, 0),
(180, 12, 3, 1),
(181, 12, 4, 1),
(182, 12, 7, 0),
(183, 12, 8, 0),
(184, 13, 2, 1),
(185, 13, 3, 1),
(186, 13, 4, 1),
(187, 13, 7, 1),
(188, 13, 8, 1),
(189, 14, 2, 0),
(190, 14, 3, 0),
(191, 14, 4, 0),
(192, 14, 7, 1),
(193, 14, 8, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidad`
--

CREATE TABLE `especialidad` (
  `idespecialidad` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `agregado` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `especialidad`
--

INSERT INTO `especialidad` (`idespecialidad`, `nombre`, `agregado`, `estado`) VALUES
(1, 'DOCTOR', '2019-05-10 11:59:57', 1),
(2, 'PROFE', '2019-05-10 12:00:02', 1),
(3, 'ABOGADO', '2019-05-10 12:00:06', 1),
(4, 'ING', '2019-05-10 12:00:12', 1),
(5, 'DIVELOPER', '2019-05-10 12:00:18', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hora`
--

CREATE TABLE `hora` (
  `idhora` int(11) NOT NULL,
  `nombre` time NOT NULL,
  `agregado` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `hora`
--

INSERT INTO `hora` (`idhora`, `nombre`, `agregado`, `estado`) VALUES
(1, '08:00:00', '2019-05-10 12:05:23', 0),
(2, '09:00:00', '2019-05-10 12:05:55', 1),
(3, '10:00:00', '2019-05-10 12:06:04', 1),
(4, '11:00:00', '2019-05-10 12:06:11', 1),
(6, '12:00:00', '2019-05-10 12:07:32', 0),
(7, '13:00:00', '2019-05-10 12:07:40', 1),
(8, '14:00:00', '2019-05-10 12:07:48', 1),
(9, '15:00:00', '2019-05-10 12:08:01', 0),
(10, '16:00:00', '2019-05-10 12:08:24', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

CREATE TABLE `horario` (
  `idhorario` int(11) NOT NULL,
  `idmedico` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `horario`
--

INSERT INTO `horario` (`idhorario`, `idmedico`, `fecha`, `estado`) VALUES
(12, 2, '2019-05-14', 1),
(13, 2, '2019-05-15', 1),
(14, 9, '2019-05-14', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medico`
--

CREATE TABLE `medico` (
  `idmedico` int(11) NOT NULL,
  `nombres` varchar(45) NOT NULL,
  `apellidos` varchar(45) NOT NULL,
  `fechanac` date NOT NULL,
  `tipo_documento` varchar(45) NOT NULL,
  `num_documento` varchar(11) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `direccion` varchar(45) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `genero` varchar(45) NOT NULL,
  `idespecialidad` int(11) NOT NULL,
  `idconsultorio` int(11) NOT NULL,
  `estado` tinyint(4) NOT NULL,
  `agregado` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `medico`
--

INSERT INTO `medico` (`idmedico`, `nombres`, `apellidos`, `fechanac`, `tipo_documento`, `num_documento`, `telefono`, `direccion`, `email`, `genero`, `idespecialidad`, `idconsultorio`, `estado`, `agregado`) VALUES
(1, 'LUIS', 'HUAVES', '1991-04-03', 'CARNET EXT', '98596783', '999999999', 'HHHHHH', 'YYYYYY@gmail.com', 'Masculino', 4, 1, 1, '2019-05-10 12:01:58'),
(2, 'KIPLTA', 'KONEL', '1999-05-17', 'PASAPORTE', '677888', '4500000', 'lima, lima', 'aalbinagortav@gmail.com', 'Femenino', 2, 3, 1, '2019-05-10 12:04:25'),
(3, 'aaaa', 'aaaaa', '2010-10-09', 'DNI', '9899855', '987678909', 'lima', 'aaaaa', 'aaa', 4, 3, 1, '2019-05-12 10:56:27'),
(4, 'wwww', 'wwwwww', '2010-10-09', 'DNI', '9899855', '987678909', 'lima', 'aaaaa', 'aaa', 4, 3, 1, '2019-05-12 10:57:06'),
(5, 'eee', 'eee', '2010-10-09', 'DNI', '9899855', '987678909', 'lima', 'aaaaa', 'aaa', 4, 3, 1, '2019-05-12 10:57:06'),
(6, 'rrrr', 'rrrr', '2010-10-09', 'DNI', '9899855', '987678909', 'lima', 'aaaaa', 'aaa', 4, 3, 1, '2019-05-12 10:57:06'),
(7, 'tttt', 'tttt', '2010-10-09', 'DNI', '9899855', '987678909', 'lima', 'aaaaa', 'aaa', 4, 3, 1, '2019-05-12 10:57:06'),
(8, 'yyyyy', 'yyyyyyy', '2010-10-09', 'DNI', '9899855', '987678909', 'lima', 'aaaaa', 'aaa', 4, 3, 1, '2019-05-12 10:57:06'),
(9, 'juansssss', 'edilverto', '2019-04-15', '222', '9899855', '987678909', 'lima, lima', 'aalbinagortav@gmail.com', 'sss', 2, 3, 1, '2019-05-12 11:33:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `idpaciente` int(11) NOT NULL,
  `nombres` varchar(45) NOT NULL,
  `apellidos` varchar(45) NOT NULL,
  `fechanac` date NOT NULL,
  `tipo_documento` varchar(45) NOT NULL,
  `num_documento` varchar(10) NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `direccion` varchar(45) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `genero` varchar(45) NOT NULL,
  `agregado` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`idpaciente`, `nombres`, `apellidos`, `fechanac`, `tipo_documento`, `num_documento`, `telefono`, `direccion`, `email`, `genero`, `agregado`) VALUES
(1, 'ANGEL', 'edilverto', '1999-05-17', 'DNI', '677888', '987987657', 'lima, lima', 'aalbinagortav@gmail.com', 'Masculino', '2019-05-10 11:54:37'),
(2, 'juan', 'albinagorta', '2010-10-09', 'DNI', '9899855', '987678909', 'lima, lima', 'aalbinagortav@gmail.com', 'MASCULINO', '2019-05-12 10:32:25'),
(3, 'aaaaaa', 'albinagorta', '2010-10-09', 'DNI', '9899855', '987678909', 'lima, lima', 'aalbinagortav@gmail.com', 'MASCULINO', '2019-05-12 10:32:58'),
(4, 'ssss', 'albinagorta', '2010-10-09', 'DNI', '9899855', '987678909', 'lima, lima', 'aalbinagortav@gmail.com', 'MASCULINO', '2019-05-12 10:32:58'),
(5, 'ttttt', 'albinagorta', '2010-10-09', 'DNI', '9899855', '987678909', 'lima, lima', 'aalbinagortav@gmail.com', 'MASCULINO', '2019-05-12 10:32:58'),
(6, 'ooooo', 'albinagorta', '2010-10-09', 'DNI', '9899855', '987678909', 'lima, lima', 'aalbinagortav@gmail.com', 'MASCULINO', '2019-05-12 10:32:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `idpermiso` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`idpermiso`, `nombre`) VALUES
(1, 'consultorio'),
(2, 'especialidad'),
(3, 'hora'),
(4, 'horario'),
(5, 'medico'),
(6, 'paciente'),
(7, 'costo'),
(8, 'permiso'),
(9, 'usuario'),
(10, 'cita'),
(11, 'escritorio'),
(12, 'consultaG'),
(13, 'acceso');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `nombres` varchar(45) NOT NULL,
  `apellidos` varchar(45) NOT NULL,
  `direccion` varchar(70) DEFAULT NULL,
  `tipo_documento` varchar(20) DEFAULT NULL,
  `num_documento` varchar(20) DEFAULT NULL,
  `telefono` varchar(20) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `cargo` varchar(20) NOT NULL,
  `login` varchar(20) NOT NULL,
  `clave` varchar(64) NOT NULL,
  `imagen` varchar(200) NOT NULL,
  `estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nombres`, `apellidos`, `direccion`, `tipo_documento`, `num_documento`, `telefono`, `email`, `cargo`, `login`, `clave`, `imagen`, `estado`) VALUES
(1, 'angel', 'gomez', 'limalima', 'RUC', '98596783', '987987657', 'aalbinagortav@gmail.com', 'Administrador', 'angel', '519ba91a5a5b4afb9dc66f8805ce8c442b6576316c19c6896af2fa9bda6aff71', '1557526657.jpg', 1),
(2, 'alcides', 'camana', 'lima, lima', 'CEDULA', '677888', '987987657', 'angel@gmail.com', 'secretaria', 'alcides', '9f3a189e129d458f02efd648f6e80f4e00d2e4e05f907f1dd658016c3af3eccf', '1557526628.jpg', 1),
(3, 'luis', 'albinagorta vargas', 'lima, lima', 'RUC', '677888', '987987657', 'angel@gmail.com', 'secretaria', 'luis', 'c5ff177a86e82441f93e3772da700d5f6838157fa1bfdc0bb689d7f7e55e7aba', '1557526773.jpg', 1),
(4, 'alverto', 'sanches', 'lima, lima', 'CEDULA', '98596783', '987987657', 'aalbinagortav@gmail.com', 'secretaria', '123', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', '1557627154.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_permiso`
--

CREATE TABLE `usuario_permiso` (
  `idusuario_permiso` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `idpermiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario_permiso`
--

INSERT INTO `usuario_permiso` (`idusuario_permiso`, `idusuario`, `idpermiso`) VALUES
(129, 3, 1),
(130, 3, 2),
(131, 3, 3),
(132, 3, 4),
(133, 3, 5),
(134, 3, 6),
(135, 3, 7),
(136, 3, 8),
(137, 3, 9),
(138, 3, 10),
(139, 3, 11),
(140, 3, 12),
(141, 3, 13),
(170, 4, 1),
(171, 4, 2),
(172, 4, 3),
(173, 4, 4),
(174, 4, 5),
(175, 4, 6),
(176, 4, 7),
(177, 4, 8),
(178, 4, 9),
(179, 4, 10),
(180, 4, 11),
(181, 4, 12),
(182, 4, 13),
(183, 1, 1),
(184, 1, 2),
(185, 1, 3),
(186, 1, 4),
(187, 1, 5),
(188, 1, 6),
(189, 1, 7),
(190, 1, 8),
(191, 1, 9),
(192, 1, 10),
(193, 1, 11),
(194, 1, 12),
(195, 1, 13),
(198, 2, 1),
(199, 2, 2),
(200, 2, 3),
(201, 2, 4),
(202, 2, 5),
(203, 2, 6),
(204, 2, 7),
(205, 2, 8),
(206, 2, 9),
(207, 2, 10),
(208, 2, 11),
(209, 2, 12),
(210, 2, 13);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cita`
--
ALTER TABLE `cita`
  ADD PRIMARY KEY (`idcita`),
  ADD KEY `fkidusuario_usuario_idusuario_cita` (`idusuario`),
  ADD KEY `fkidpaciente_paciente_idpaciente_cita` (`idpaciente`),
  ADD KEY `fkiddetalle_horario_detalle_horario_iddetalle_horario_cita` (`iddetalle_horario`),
  ADD KEY `fkidcosto_costo_idcosto_cita` (`idcosto`);

--
-- Indices de la tabla `consultorio`
--
ALTER TABLE `consultorio`
  ADD PRIMARY KEY (`idconsultorio`);

--
-- Indices de la tabla `costo`
--
ALTER TABLE `costo`
  ADD PRIMARY KEY (`idcosto`),
  ADD KEY `fkidespecialidad_especialidad_idespecialidad_costo` (`idespecialidad`);

--
-- Indices de la tabla `detalle_horario`
--
ALTER TABLE `detalle_horario`
  ADD PRIMARY KEY (`iddetalle_horario`),
  ADD KEY `fkidhorario_horario_idhorario_detalle_horario` (`idhorario`),
  ADD KEY `fkidhora_hora_idhora_detalle_horario` (`idhora`);

--
-- Indices de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  ADD PRIMARY KEY (`idespecialidad`);

--
-- Indices de la tabla `hora`
--
ALTER TABLE `hora`
  ADD PRIMARY KEY (`idhora`);

--
-- Indices de la tabla `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`idhorario`),
  ADD KEY `fkidmedico_medico_idmedico_horario` (`idmedico`);

--
-- Indices de la tabla `medico`
--
ALTER TABLE `medico`
  ADD PRIMARY KEY (`idmedico`),
  ADD KEY `fkidespecialidad_especialidad_idespecialidad_medico` (`idespecialidad`),
  ADD KEY `fkidconsultorio_consultorio_idconsultorio_medico` (`idconsultorio`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`idpaciente`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`idpermiso`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`);

--
-- Indices de la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  ADD PRIMARY KEY (`idusuario_permiso`),
  ADD KEY `fkidusuario_usuario_idusuario_usuario_permiso` (`idusuario`),
  ADD KEY `fkidpermiso_permiso_idpermiso_usuario_permiso` (`idpermiso`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cita`
--
ALTER TABLE `cita`
  MODIFY `idcita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT de la tabla `consultorio`
--
ALTER TABLE `consultorio`
  MODIFY `idconsultorio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `costo`
--
ALTER TABLE `costo`
  MODIFY `idcosto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `detalle_horario`
--
ALTER TABLE `detalle_horario`
  MODIFY `iddetalle_horario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=194;

--
-- AUTO_INCREMENT de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  MODIFY `idespecialidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `hora`
--
ALTER TABLE `hora`
  MODIFY `idhora` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `horario`
--
ALTER TABLE `horario`
  MODIFY `idhorario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `medico`
--
ALTER TABLE `medico`
  MODIFY `idmedico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `paciente`
--
ALTER TABLE `paciente`
  MODIFY `idpaciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `idpermiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  MODIFY `idusuario_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cita`
--
ALTER TABLE `cita`
  ADD CONSTRAINT `fkidcosto_costo_idcosto_cita` FOREIGN KEY (`idcosto`) REFERENCES `costo` (`idcosto`),
  ADD CONSTRAINT `fkiddetalle_horario_detalle_horario_iddetalle_horario_cita` FOREIGN KEY (`iddetalle_horario`) REFERENCES `detalle_horario` (`iddetalle_horario`),
  ADD CONSTRAINT `fkidpaciente_paciente_idpaciente_cita` FOREIGN KEY (`idpaciente`) REFERENCES `paciente` (`idpaciente`),
  ADD CONSTRAINT `fkidusuario_usuario_idusuario_cita` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`);

--
-- Filtros para la tabla `costo`
--
ALTER TABLE `costo`
  ADD CONSTRAINT `fkidespecialidad_especialidad_idespecialidad_costo` FOREIGN KEY (`idespecialidad`) REFERENCES `especialidad` (`idespecialidad`);

--
-- Filtros para la tabla `detalle_horario`
--
ALTER TABLE `detalle_horario`
  ADD CONSTRAINT `fkidhora_hora_idhora_detalle_horario` FOREIGN KEY (`idhora`) REFERENCES `hora` (`idhora`),
  ADD CONSTRAINT `fkidhorario_horario_idhorario_detalle_horario` FOREIGN KEY (`idhorario`) REFERENCES `horario` (`idhorario`);

--
-- Filtros para la tabla `horario`
--
ALTER TABLE `horario`
  ADD CONSTRAINT `fkidmedico_medico_idmedico_horario` FOREIGN KEY (`idmedico`) REFERENCES `medico` (`idmedico`);

--
-- Filtros para la tabla `medico`
--
ALTER TABLE `medico`
  ADD CONSTRAINT `fkidconsultorio_consultorio_idconsultorio_medico` FOREIGN KEY (`idconsultorio`) REFERENCES `consultorio` (`idconsultorio`),
  ADD CONSTRAINT `fkidespecialidad_especialidad_idespecialidad_medico` FOREIGN KEY (`idespecialidad`) REFERENCES `especialidad` (`idespecialidad`);

--
-- Filtros para la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  ADD CONSTRAINT `fkidpermiso_permiso_idpermiso_usuario_permiso` FOREIGN KEY (`idpermiso`) REFERENCES `permiso` (`idpermiso`),
  ADD CONSTRAINT `fkidusuario_usuario_idusuario_usuario_permiso` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
