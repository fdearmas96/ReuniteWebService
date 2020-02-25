-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-02-2020 a las 20:05:23
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `reunitebd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicacion`
--

CREATE TABLE `publicacion` (
  `Pub_ID` int(20) NOT NULL COMMENT 'id_publicacion',
  `Pub_Titulo` varchar(50) NOT NULL COMMENT 'Titulo',
  `Pub_Desc` varchar(500) NOT NULL COMMENT 'Descripción',
  `Pub_img` varchar(500) NOT NULL COMMENT 'Dirección imagen',
  `Pub_Contacto` varchar(300) NOT NULL COMMENT 'Contacto',
  `Usuario_ID` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `userpub`
--

CREATE TABLE `userpub` (
  `Usuario_ID` varchar(15) NOT NULL,
  `Pub_ID` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `Usuario_ID` varchar(15) NOT NULL,
  `Usuario_Pass` varchar(15) NOT NULL,
  `usuario_Nombre` varchar(30) NOT NULL COMMENT 'Nombre',
  `usuario_Apellido` varchar(30) NOT NULL COMMENT 'Apellido',
  `usuario_Correo` varchar(60) NOT NULL COMMENT 'Correo electronico'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`Usuario_ID`, `Usuario_Pass`, `usuario_Nombre`, `usuario_Apellido`, `usuario_Correo`) VALUES
('emulador1', 'root', 'Emulador', 'Apellido', 'correo.com.uy'),
('Fernando', 'root1', 'Nombre', 'Apellido', 'fernando@correo.com'),
('Usuario1', 'root', 'Nombre', 'Apellido', 'otro');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `publicacion`
--
ALTER TABLE `publicacion`
  ADD PRIMARY KEY (`Pub_ID`),
  ADD KEY `Usuario_ID` (`Usuario_ID`),
  ADD KEY `Usuario_ID_2` (`Usuario_ID`);

--
-- Indices de la tabla `userpub`
--
ALTER TABLE `userpub`
  ADD PRIMARY KEY (`Usuario_ID`,`Pub_ID`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`Usuario_ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
