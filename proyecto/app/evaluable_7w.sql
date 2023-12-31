-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-12-2023 a las 14:50:04
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `evaluable_7w`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `disponibilidad`
--

CREATE TABLE `disponibilidad` (
  `id_disponibilidad` int(11) NOT NULL,
  `disponibilidad` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `disponibilidad`
--

INSERT INTO `disponibilidad` (`id_disponibilidad`, `disponibilidad`) VALUES
(1, 'Mañanas'),
(2, 'Tardes'),
(3, 'Completo'),
(4, 'Fines de semana'),
(32, 'de lunes a viernes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `disp_servicio`
--

CREATE TABLE `disp_servicio` (
  `id_servicio` int(11) NOT NULL,
  `id_disponibilidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `disp_servicio`
--

INSERT INTO `disp_servicio` (`id_servicio`, `id_disponibilidad`) VALUES
(12, 1),
(12, 2),
(12, 3),
(12, 4),
(16, 1),
(16, 2),
(16, 4),
(17, 1),
(17, 2),
(17, 3),
(17, 4),
(18, 3),
(18, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `idioma`
--

CREATE TABLE `idioma` (
  `id_idioma` int(11) NOT NULL,
  `idioma` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `idioma`
--

INSERT INTO `idioma` (`id_idioma`, `idioma`) VALUES
(1, 'Español'),
(2, 'Inglés'),
(6, 'Valenciano');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id_servicios` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `id_user` int(11) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `precio` int(11) NOT NULL,
  `tipo` tinyint(1) NOT NULL,
  `foto_servicio` varchar(100) NOT NULL,
  `fecha_alta` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id_servicios`, `titulo`, `id_user`, `descripcion`, `precio`, `tipo`, `foto_servicio`, `fecha_alta`) VALUES
(1, 'Primer servicio', 54, 'Primera descripción', 0, 0, 'Sin imagen', '2023-12-22'),
(2, 'Pesca de cangrejos', 54, 'Pesca de cangrejo', 0, 0, 'Sin imagen', '2023-12-22'),
(3, 'Reparación de coches', 54, 'Reparación de vehículos clásicos', 100, 0, '../ficheros/fotos\\1703278414WIN_20200915_15_04_54_Pro.jpg', '2023-12-22'),
(4, 'Paseo de perros', 54, 'Paseo de perros profesional', 10, 0, 'Sin imagen', '2023-12-22'),
(12, 'Dorado de marcos', 54, 'Dorado de marcos on pan de oro', 20, 0, 'Sin imagen', '2023-12-23'),
(16, 'Pollos Asados', 54, 'Pollos asados en horno de leña por encargo', 20, 0, 'Sin imagen', '2023-12-23'),
(17, 'Cuidado de gatos', 54, 'Cuido gatos como si fueran marqueses', 5, 0, 'Sin imagen', '2023-12-23'),
(18, 'Pollos', 23, 'crio polloa', 0, 1, 'Sin imagen', '2023-12-23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tokens`
--

CREATE TABLE `tokens` (
  `token` varchar(128) NOT NULL,
  `validez` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user-idioma`
--

CREATE TABLE `user-idioma` (
  `id_user` int(11) NOT NULL,
  `id_idioma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `user-idioma`
--

INSERT INTO `user-idioma` (`id_user`, `id_idioma`) VALUES
(23, 2),
(54, 1),
(72, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_user` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(256) NOT NULL,
  `f_nacimiento` date NOT NULL,
  `foto_perfil` varchar(100) NOT NULL,
  `descripción` varchar(300) NOT NULL,
  `nivel` smallint(6) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_user`, `nombre`, `email`, `pass`, `f_nacimiento`, `foto_perfil`, `descripción`, `nivel`, `activo`) VALUES
(23, 'José Gutiérrez', 'guti@mail.com', '$2y$10$ZkyCkkITVJgUZyjbYXGn9.GruaD0LA4cRzHnYCWgnlRPKBmvI9cFe', '1998-05-12', '../ficheros/fotos\\1703252084WIN_20200915_15_04_53_Pro.jpg', 'asdfasdfsd', 1, 1),
(54, 'Chimo Chornet', 'chimochornet@gmail.com', '$2y$10$f4Tck3ASAl2gltOjZcHNeu00M/KT.2fGvSB5t2E7zY7ogvHKm0fdS', '1971-05-20', '../ficheros/fotos\\1704025127WIN_20200915_15_04_53_Pro.jpg', 'Ninguna OO', 1, 1),
(72, 'Administrador', 'chimochomet@gmail.com', '$2y$10$H/m7ZglO8DBy36eOo8IH5.LyaKUspeTMHq0Ie44V034HZJR7SsXXa', '1971-05-20', '../ficheros/fotos\\1704030408WIN_20200915_15_04_53_Pro.jpg', 'Prueba final', 2, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `disponibilidad`
--
ALTER TABLE `disponibilidad`
  ADD PRIMARY KEY (`id_disponibilidad`);

--
-- Indices de la tabla `disp_servicio`
--
ALTER TABLE `disp_servicio`
  ADD PRIMARY KEY (`id_servicio`,`id_disponibilidad`),
  ADD KEY `fk_iddisponibilidad` (`id_disponibilidad`);

--
-- Indices de la tabla `idioma`
--
ALTER TABLE `idioma`
  ADD UNIQUE KEY `id_idioma` (`id_idioma`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id_servicios`);

--
-- Indices de la tabla `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`token`),
  ADD KEY `id_user` (`id_user`);

--
-- Indices de la tabla `user-idioma`
--
ALTER TABLE `user-idioma`
  ADD PRIMARY KEY (`id_user`,`id_idioma`),
  ADD KEY `fk_ididioma` (`id_idioma`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `uq_email_usuario` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `disponibilidad`
--
ALTER TABLE `disponibilidad`
  MODIFY `id_disponibilidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `idioma`
--
ALTER TABLE `idioma`
  MODIFY `id_idioma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id_servicios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `disp_servicio`
--
ALTER TABLE `disp_servicio`
  ADD CONSTRAINT `fk_iddisponibilidad` FOREIGN KEY (`id_disponibilidad`) REFERENCES `disponibilidad` (`id_disponibilidad`),
  ADD CONSTRAINT `fk_idservicio` FOREIGN KEY (`id_servicio`) REFERENCES `servicios` (`id_servicios`);

--
-- Filtros para la tabla `tokens`
--
ALTER TABLE `tokens`
  ADD CONSTRAINT `tokens_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `usuario` (`id_user`);

--
-- Filtros para la tabla `user-idioma`
--
ALTER TABLE `user-idioma`
  ADD CONSTRAINT `fk_ididioma` FOREIGN KEY (`id_idioma`) REFERENCES `idioma` (`id_idioma`),
  ADD CONSTRAINT `fk_iduser` FOREIGN KEY (`id_user`) REFERENCES `usuario` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
