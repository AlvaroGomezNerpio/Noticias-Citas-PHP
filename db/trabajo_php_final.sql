-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-05-2024 a las 19:01:44
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `trabajo_php_final`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `idCita` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `fecha_cita` date NOT NULL,
  `motivo_cita` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`idCita`, `idUser`, `fecha_cita`, `motivo_cita`) VALUES
(7, 2, '2024-05-23', 'hoola 23'),
(24, 7, '2024-05-31', 'ñlkkjkljlk');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `idNoticia` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `texto` text NOT NULL,
  `fecha` date NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`idNoticia`, `titulo`, `imagen`, `texto`, `fecha`, `idUser`) VALUES
(6, 'Noticia 2', 'uploads/noticias/664397f09eb34_20230511_160131.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer efficitur lacinia eleifend. Donec sed mauris semper, viverra turpis eget, egestas justo. Aenean justo nulla, eleifend in tincidunt a, luctus a elit. Aliquam auctor, nisi ac volutpat hendrerit, lectus ante faucibus tortor, eget dictum nunc dolor id justo. Aliquam erat volutpat. Phasellus a lacinia nibh. Maecenas dictum, lectus id ornare vestibulum, massa eros egestas felis, vel porta arcu dui id elit. Donec at magna non eros mattis consequat non vitae ante. Donec porta lobortis pharetra. Curabitur mattis consectetur nulla id porta.', '2024-05-14', 2),
(7, 'noticia 3', 'uploads/noticias/66439863c77e7_20231221_230121.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer efficitur lacinia eleifend. Donec sed mauris semper, viverra turpis eget, egestas justo. Aenean justo nulla, eleifend in tincidunt a, luctus a elit. Aliquam auctor, nisi ac volutpat hendrerit, lectus ante faucibus tortor, eget dictum nunc dolor id justo. Aliquam erat volutpat. Phasellus a lacinia nibh. Maecenas dictum, lectus id ornare vestibulum, massa eros egestas felis, vel porta arcu dui id elit. Donec at magna non eros mattis consequat non vitae ante. Donec porta lobortis pharetra. Curabitur mattis consectetur nulla id porta.', '2024-05-14', 2),
(8, 'noticia 4', 'uploads/noticias/66439a87dd128_20230505_202719.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer efficitur lacinia eleifend. Donec sed mauris semper, viverra turpis eget, egestas justo. Aenean justo nulla, eleifend in tincidunt a, luctus a elit. Aliquam auctor, nisi ac volutpat hendrerit, lectus ante faucibus tortor, eget dictum nunc dolor id justo. Aliquam erat volutpat. Phasellus a lacinia nibh. Maecenas dictum, lectus id ornare vestibulum, massa eros egestas felis, vel porta arcu dui id elit. Donec at magna non eros mattis consequat non vitae ante. Donec porta lobortis pharetra. Curabitur mattis consectetur nulla id porta.', '2024-05-14', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_data`
--

CREATE TABLE `users_data` (
  `idUser` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `direccion` text DEFAULT NULL,
  `sexo` enum('Masculino','Femenino','Otro') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users_data`
--

INSERT INTO `users_data` (`idUser`, `nombre`, `apellidos`, `email`, `telefono`, `fecha_nacimiento`, `direccion`, `sexo`) VALUES
(2, 'Pepe', 'Gomez', 'Pepe@gmail.com', '123456789', '2219-02-11', 'PepePepePepevvv', 'Masculino'),
(5, 'Julia', 'fernande', 'Julia@gmail.com', '123456789', '2222-03-23', 'Julia', 'Femenino'),
(6, 'Oscar', 'Alfaro', 'oscar@gmail.com', '123456789', '1111-11-11', 'las cosas de oscar', 'Masculino'),
(7, 'juan', 'sanchez', 'juan@g.com', '123456789', '2024-05-23', 'fgghjfhjhj', 'Masculino'),
(8, 'wfewfwfe', 'esffew', 'efwfwef@gmail.vom', '321421343', '2024-05-02', '3243214', 'Masculino');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_login`
--

CREATE TABLE `users_login` (
  `idLogin` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users_login`
--

INSERT INTO `users_login` (`idLogin`, `idUser`, `usuario`, `password`, `rol`) VALUES
(2, 2, 'pepe', '$2y$10$2w6XUv9x6remQxLJ4rHq7uP9ldyeEDdq.zQ1zCwuQjFRCvyo6m0LO', 'admin'),
(4, 5, 'ana', '$2y$10$3L50SX84uNJfCjOBQ4aFrOiK/E0CXI7wlWLX3IpPsiqVIMALnWt5u', 'admin'),
(5, 6, 'asdf', '$2y$10$rQL0IUs3K87l1Bn6p3yiXOylR1hiA2Gy3JET.yYrt0LyOx4ZAlIG6', 'user'),
(6, 7, 'juan12', '$2y$10$jcvPYaQq6MZMaoV4tkztCOc8Gk0Crxmmq0iVZEMi1Ua4gMyrMKLXi', 'user'),
(7, 8, 'gerjo', '$2y$10$PObv5trY0q/zqCLGPZXaxeMin.6dr.KpbEVkXNZU.m8rvsAZqOKKm', 'user');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`idCita`),
  ADD KEY `idUser` (`idUser`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`idNoticia`),
  ADD UNIQUE KEY `titulo` (`titulo`),
  ADD KEY `idUser` (`idUser`);

--
-- Indices de la tabla `users_data`
--
ALTER TABLE `users_data`
  ADD PRIMARY KEY (`idUser`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `users_login`
--
ALTER TABLE `users_login`
  ADD PRIMARY KEY (`idLogin`),
  ADD UNIQUE KEY `idUser` (`idUser`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `idCita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `idNoticia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `users_data`
--
ALTER TABLE `users_data`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `users_login`
--
ALTER TABLE `users_login`
  MODIFY `idLogin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `users_data` (`idUser`);

--
-- Filtros para la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD CONSTRAINT `noticias_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `users_data` (`idUser`);

--
-- Filtros para la tabla `users_login`
--
ALTER TABLE `users_login`
  ADD CONSTRAINT `users_login_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `users_data` (`idUser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
