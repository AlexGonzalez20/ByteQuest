-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-05-2025 a las 22:56:47
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bytequest`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_curso`
--

CREATE TABLE `t_curso` (
  `id_curso` int(50) NOT NULL,
  `id_usuario` int(50) DEFAULT NULL,
  `nombre_curso` varchar(50) DEFAULT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `t_curso`
--

INSERT INTO `t_curso` (`id_curso`, `id_usuario`, `nombre_curso`, `descripcion`) VALUES
(1, 1, 'Programación Básica', 'Curso introductorio de programación.'),
(2, 2, 'Estructuras de Datos', 'Uso de listas, pilas y colas.'),
(3, 3, 'Bases de Datos', 'Curso sobre SQL y diseño relacional.'),
(11, NULL, 'asdf', 'asdf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_historial`
--

CREATE TABLE `t_historial` (
  `id_historial` int(20) NOT NULL,
  `id_usuario` int(20) DEFAULT NULL,
  `cursos_completados` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`cursos_completados`)),
  `cursos_actuales` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`cursos_actuales`)),
  `nivel_actual` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `t_historial`
--

INSERT INTO `t_historial` (`id_historial`, `id_usuario`, `cursos_completados`, `cursos_actuales`, `nivel_actual`) VALUES
(1, 1, '[\"Programación Básica\"]', '[\"Estructuras de Datos\"]', 3),
(2, 2, '[]', '[\"Programación Básica\"]', 1),
(3, 3, '[\"Programación Básica\", \"Estructuras de Datos\"]', '[\"Bases de Datos\"]', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_prueba`
--

CREATE TABLE `t_prueba` (
  `id_prueba` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_historial` int(11) DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL,
  `pregunta` text NOT NULL,
  `opciones` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`opciones`)),
  `nivel` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `t_prueba`
--

INSERT INTO `t_prueba` (`id_prueba`, `id_usuario`, `id_historial`, `id_curso`, `pregunta`, `opciones`, `nivel`) VALUES
(1, 1, 1, 1, '¿Qué es una variable?', '[\"Un contenedor,Un nu00famero,Una operaciu00f3n\"]', 12),
(2, 2, 2, 2, '¿Qué es una pila?', '[\"Estructura LIFO\", \"Una lista\", \"Una base de datos\"]', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_usuario`
--

CREATE TABLE `t_usuario` (
  `id_usuario` int(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `experiencia` int(50) NOT NULL,
  `vidas` int(20) NOT NULL,
  `rol` enum('Estudiante','admin') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `t_usuario`
--

INSERT INTO `t_usuario` (`id_usuario`, `nombre`, `correo`, `password`, `experiencia`, `vidas`, `rol`) VALUES
(1, 'A', 'a@a.a', 'a', 1200, 3, 'Estudiante'),
(2, 'Laura', 'laura@example.com', 'pass456', 1500, 5, 'Estudiante'),
(3, 'Admin', 'admin@example.com', 'admin789', 9999, 10, 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `t_curso`
--
ALTER TABLE `t_curso`
  ADD PRIMARY KEY (`id_curso`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `t_historial`
--
ALTER TABLE `t_historial`
  ADD PRIMARY KEY (`id_historial`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `t_prueba`
--
ALTER TABLE `t_prueba`
  ADD PRIMARY KEY (`id_prueba`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_historial` (`id_historial`),
  ADD KEY `id_curso` (`id_curso`);

--
-- Indices de la tabla `t_usuario`
--
ALTER TABLE `t_usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `t_curso`
--
ALTER TABLE `t_curso`
  MODIFY `id_curso` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `t_historial`
--
ALTER TABLE `t_historial`
  MODIFY `id_historial` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `t_prueba`
--
ALTER TABLE `t_prueba`
  MODIFY `id_prueba` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `t_usuario`
--
ALTER TABLE `t_usuario`
  MODIFY `id_usuario` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `t_curso`
--
ALTER TABLE `t_curso`
  ADD CONSTRAINT `t_curso_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `t_usuario` (`id_usuario`);

--
-- Filtros para la tabla `t_historial`
--
ALTER TABLE `t_historial`
  ADD CONSTRAINT `t_historial_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `t_usuario` (`id_usuario`);

--
-- Filtros para la tabla `t_prueba`
--
ALTER TABLE `t_prueba`
  ADD CONSTRAINT `t_prueba_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `t_usuario` (`id_usuario`),
  ADD CONSTRAINT `t_prueba_ibfk_2` FOREIGN KEY (`id_historial`) REFERENCES `t_historial` (`id_historial`),
  ADD CONSTRAINT `t_prueba_ibfk_3` FOREIGN KEY (`id_curso`) REFERENCES `t_curso` (`id_curso`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
