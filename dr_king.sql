-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-06-2025 a las 21:43:42
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dr_king`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `id` int(11) NOT NULL,
  `paciente` int(11) NOT NULL,
  `codigo` varchar(20) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clinica`
--

CREATE TABLE `clinica` (
  `id_clinica` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `direccion` varchar(30) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `horario` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consultas`
--

CREATE TABLE `consultas` (
  `id` int(11) NOT NULL,
  `peso` varchar(10) NOT NULL,
  `altura` varchar(10) NOT NULL,
  `tension_arterial` varchar(10) NOT NULL,
  `pulso` varchar(10) NOT NULL,
  `temperatura` varchar(10) NOT NULL,
  `PO2` varchar(10) NOT NULL,
  `observaciones` text DEFAULT NULL,
  `paciente_id` int(11) NOT NULL,
  `paciente_cod` varchar(100) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `precio` int(11) NOT NULL,
  `motivo` text NOT NULL,
  `hea` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_consultas`
--

CREATE TABLE `detalles_consultas` (
  `id` int(11) NOT NULL,
  `antecedentes_patologicos` varchar(255) DEFAULT NULL,
  `grupo_sanguineo` varchar(20) DEFAULT NULL,
  `alergia_medi` varchar(255) DEFAULT NULL,
  `visita_medica` varchar(2) DEFAULT NULL,
  `diagnostico` varchar(255) DEFAULT NULL,
  `tratamiento` varchar(255) DEFAULT NULL,
  `consulta_id` int(11) NOT NULL,
  `codigo_pac` varchar(20) NOT NULL,
  `fecha` date NOT NULL,
  `antecedente` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `dip` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellidos` varchar(30) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `sexo` varchar(2) NOT NULL,
  `direccion` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `tutor` varchar(30) NOT NULL,
  `fecha` date NOT NULL,
  `id` int(11) NOT NULL,
  `codigo` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `id_prueba` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `id_tipo_prueba` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE `personal` (
  `dip_personal` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellidos` varchar(20) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `sexo` varchar(2) NOT NULL,
  `codigo` varchar(10) NOT NULL,
  `direccion` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `nacionalidad` varchar(25) NOT NULL,
  `fecha_registro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`dip_personal`, `nombre`, `apellidos`, `fecha_nacimiento`, `sexo`, `codigo`, `direccion`, `email`, `telefono`, `nacionalidad`, `fecha_registro`) VALUES
(117, 'juana ', 'nsue', '2022-09-22', 'F', '', 'serra', 'juana@gmail.com', '2225141', 'maliense', '2025-05-21'),
(178, 'maximiliano', 'compe', '2023-08-03', 'M', '', 'begoña', 'maxi@gamail.com', '555551233 ', 'ecuatoguieno', '2025-05-20'),
(174708, 'salvador2', 'METE BIJERI2', '2012-06-06', 'F', '', 'Sampaka', 'perdu@info.com', '222725886', 'camerunes2', '2024-01-17'),
(906543, 'mariana', 'mangue', '2002-01-08', 'F', '', 'banapa', 'profesordemo@gmail.com', '555904321', 'guineana', '2024-01-23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prueba`
--

CREATE TABLE `prueba` (
  `id_prueba` int(11) NOT NULL,
  `resultado` varchar(250) DEFAULT NULL,
  `estado` int(1) NOT NULL,
  `id_tipo_prueba` int(11) NOT NULL,
  `id_consulta` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `dip_personal` int(11) NOT NULL,
  `paciente` int(11) NOT NULL,
  `pagado` int(1) NOT NULL,
  `codigo_pac` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `receta`
--

CREATE TABLE `receta` (
  `id_receta` int(11) NOT NULL,
  `descripcion_receta` text NOT NULL,
  `id_consulta` int(11) NOT NULL,
  `paciente` int(11) NOT NULL,
  `instrucciones_receta` text NOT NULL,
  `fecha` date NOT NULL,
  `codigo_pac` varchar(20) NOT NULL,
  `id_diagnostico` varchar(255) NOT NULL,
  `comentario` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `nombre` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `nombre`) VALUES
(1, 'ENFERMERA'),
(2, 'DOCTOR'),
(3, 'LABORATORIO'),
(4, 'ADMINISTRADOR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_prueba`
--

CREATE TABLE `tipo_prueba` (
  `id` int(11) NOT NULL,
  `nombre_prueba` varchar(100) NOT NULL,
  `precio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `tipo_prueba`
--

INSERT INTO `tipo_prueba` (`id`, `nombre_prueba`, `precio`) VALUES
(1, 'paludismo', 2000),
(2, 'tifoidea', 3000),
(3, 'VIH', 10000),
(4, 'HEMOGRAMA', 10000),
(5, 'HEPATITIS B', 12000),
(6, 'TES WIDAL ', 5000),
(7, 'Helycobacter pilory', 14000),
(8, 'Glicemia', 8000),
(9, 'HEPATITIS A', 10000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(15) NOT NULL,
  `password_usuario` varchar(60) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `dip_personal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `password_usuario`, `id_rol`, `dip_personal`) VALUES
(1, 'Mh', '$2y$10$HGxE6mFG0/Ek48SPHtlxEuF9M8ok5TKi2tbQUCwtlYqYQR7/wpvl6', 2, 174708),
(2, 'lab', '$2y$10$FGxmD0X/DdqH55yLfmqBkuPXjVbnrdysZ0qfxxN06Kij3l6b8fuoC', 3, 906543),
(3, 'admin', '$2y$10$RdZBS/j92I1rb/LLgRaH0.p..1YfKmmn7WdQNUbvlQcYrmQlVFMma', 4, 906543),
(4, 'max', '$2y$10$qsgQbHGa8JKyf8Hw6qNsE.V0I/k6tPiAF0caqyFoThvoeIZ5lqbBm', 2, 178),
(5, 'triage', '$2y$10$MdNRitG49WN1HQUVFYOEGeOpzF96qLK.ENI6i5/9.Zn6d.KnXoTI2', 1, 117);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paciente` (`paciente`);

--
-- Indices de la tabla `clinica`
--
ALTER TABLE `clinica`
  ADD PRIMARY KEY (`id_clinica`);

--
-- Indices de la tabla `consultas`
--
ALTER TABLE `consultas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paciente_id` (`paciente_id`);

--
-- Indices de la tabla `detalles_consultas`
--
ALTER TABLE `detalles_consultas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `consulta_id` (`consulta_id`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_prueba` (`id_prueba`);

--
-- Indices de la tabla `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`dip_personal`);

--
-- Indices de la tabla `prueba`
--
ALTER TABLE `prueba`
  ADD PRIMARY KEY (`id_prueba`),
  ADD KEY `id_tipo_prueba` (`id_tipo_prueba`),
  ADD KEY `id_consulta` (`id_consulta`),
  ADD KEY `dip_personal` (`dip_personal`),
  ADD KEY `paciente` (`paciente`);

--
-- Indices de la tabla `receta`
--
ALTER TABLE `receta`
  ADD PRIMARY KEY (`id_receta`),
  ADD KEY `dip` (`paciente`),
  ADD KEY `id_consulta` (`id_consulta`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `tipo_prueba`
--
ALTER TABLE `tipo_prueba`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_rol` (`id_rol`),
  ADD KEY `dip_personal` (`dip_personal`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clinica`
--
ALTER TABLE `clinica`
  MODIFY `id_clinica` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `consultas`
--
ALTER TABLE `consultas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `detalles_consultas`
--
ALTER TABLE `detalles_consultas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `prueba`
--
ALTER TABLE `prueba`
  MODIFY `id_prueba` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `receta`
--
ALTER TABLE `receta`
  MODIFY `id_receta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tipo_prueba`
--
ALTER TABLE `tipo_prueba`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`paciente`) REFERENCES `pacientes` (`id`);

--
-- Filtros para la tabla `consultas`
--
ALTER TABLE `consultas`
  ADD CONSTRAINT `consultas_ibfk_1` FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalles_consultas`
--
ALTER TABLE `detalles_consultas`
  ADD CONSTRAINT `detalles_consultas_ibfk_1` FOREIGN KEY (`consulta_id`) REFERENCES `consultas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `pagos_ibfk_1` FOREIGN KEY (`id_prueba`) REFERENCES `prueba` (`id_prueba`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `prueba`
--
ALTER TABLE `prueba`
  ADD CONSTRAINT `prueba_ibfk_1` FOREIGN KEY (`id_tipo_prueba`) REFERENCES `tipo_prueba` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `prueba_ibfk_2` FOREIGN KEY (`dip_personal`) REFERENCES `personal` (`dip_personal`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `prueba_ibfk_3` FOREIGN KEY (`id_consulta`) REFERENCES `consultas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prueba_ibfk_4` FOREIGN KEY (`paciente`) REFERENCES `pacientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `receta`
--
ALTER TABLE `receta`
  ADD CONSTRAINT `receta_ibfk_1` FOREIGN KEY (`id_consulta`) REFERENCES `consultas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `receta_ibfk_2` FOREIGN KEY (`paciente`) REFERENCES `pacientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`dip_personal`) REFERENCES `personal` (`dip_personal`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
