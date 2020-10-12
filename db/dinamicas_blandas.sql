-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-10-2020 a las 18:42:17
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dinamicas_blandas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `db_actores`
--

CREATE TABLE `db_actores` (
  `id_actor` int(11) NOT NULL,
  `desc_actor` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `posicion_x` int(11) NOT NULL,
  `posicion_y` int(11) NOT NULL,
  `estilo` varchar(200) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `id_tipo` int(11) NOT NULL,
  `id_status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `db_actores`
--

INSERT INTO `db_actores` (`id_actor`, `desc_actor`, `posicion_x`, `posicion_y`, `estilo`, `id_tipo`, `id_status`, `created_at`) VALUES
(1, 'Punto A', 0, 0, '', 1, 2, '2020-10-02 01:02:45'),
(2, 'Punto B', 700, 700, '', 1, 1, '2020-10-02 01:02:45'),
(3, 'Rectángulo A', 300, 400, '', 2, 1, '2020-10-02 01:12:52'),
(4, 'Rectángulo B', 800, 700, '', 2, 1, '2020-10-02 01:12:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `db_canvas`
--

CREATE TABLE `db_canvas` (
  `id_canvas` int(11) NOT NULL,
  `desc_canvas` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `tamano_x` int(11) NOT NULL,
  `tamano_y` int(11) NOT NULL,
  `color` varchar(20) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `estilo` varchar(200) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `id_status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `db_canvas`
--

INSERT INTO `db_canvas` (`id_canvas`, `desc_canvas`, `tamano_x`, `tamano_y`, `color`, `estilo`, `id_status`, `created_at`) VALUES
(1, 'Lienzo pequeño A (1000x800)', 1000, 800, 'white', '', 1, '2020-10-02 01:50:02'),
(2, 'Lienzo muy pequeño A (700x600)', 700, 600, 'black', '', 1, '2020-10-02 01:50:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `db_escenas`
--

CREATE TABLE `db_escenas` (
  `id_escena` int(11) NOT NULL,
  `desc_escena` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `tiempo` int(11) NOT NULL,
  `id_canvas` int(11) NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `id_status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `db_escenas`
--

INSERT INTO `db_escenas` (`id_escena`, `desc_escena`, `tiempo`, `id_canvas`, `id_tipo`, `id_status`, `created_at`) VALUES
(1, 'Escena A', 12, 1, 1, 1, '2020-10-02 02:20:03'),
(2, 'Escena B', 1, 2, 1, 1, '2020-10-02 02:20:03'),
(3, 'nombre de escena patito', 22, 1, 2, 1, '2020-10-08 19:51:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `db_escenas_obra`
--

CREATE TABLE `db_escenas_obra` (
  `id_obra` int(11) NOT NULL,
  `id_escena` int(11) NOT NULL,
  `orden` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `db_escenas_obra`
--

INSERT INTO `db_escenas_obra` (`id_obra`, `id_escena`, `orden`) VALUES
(1, 1, 1),
(1, 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `db_escena_actores`
--

CREATE TABLE `db_escena_actores` (
  `id_escena` int(11) NOT NULL,
  `id_actor` int(11) NOT NULL,
  `posicion_x` int(11) NOT NULL,
  `posicion_y` int(11) NOT NULL,
  `permanente` int(11) NOT NULL,
  `tiempo_ini` int(11) DEFAULT NULL,
  `tiempo_fin` int(11) DEFAULT NULL,
  `estilo` varchar(200) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `orden` int(11) NOT NULL,
  `id_status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `db_escena_actores`
--

INSERT INTO `db_escena_actores` (`id_escena`, `id_actor`, `posicion_x`, `posicion_y`, `permanente`, `tiempo_ini`, `tiempo_fin`, `estilo`, `orden`, `id_status`, `created_at`) VALUES
(1, 1, 200, 100, 1, 0, 0, '', 0, 1, '2020-10-02 02:39:46'),
(1, 2, 401, 202, 0, 3, 6, 'sin estilo :)', 3, 1, '2020-10-02 02:39:46'),
(1, 3, 300, 300, 1, 0, 0, '', 4, 1, '2020-10-02 02:39:46'),
(1, 2, 600, 402, 0, 7, 10, '', 5, 1, '2020-10-09 00:30:53'),
(3, 2, 200, 200, 0, 2, 3, '', 2, 1, '2020-10-09 06:31:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `db_fechas_temporada`
--

CREATE TABLE `db_fechas_temporada` (
  `id_temporada` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `id_status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `db_lienzos`
--

CREATE TABLE `db_lienzos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(80) COLLATE utf8mb4_spanish_ci NOT NULL,
  `ancho` int(11) NOT NULL,
  `alto` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `db_lienzos`
--

INSERT INTO `db_lienzos` (`id`, `nombre`, `ancho`, `alto`, `status_id`, `created_at`) VALUES
(1, 'Lienzo default (600px x 500px)', 600, 500, 1, '2020-09-28 18:52:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `db_lienzo_status`
--

CREATE TABLE `db_lienzo_status` (
  `id` int(11) NOT NULL,
  `statusDesc` varchar(30) COLLATE utf8mb4_spanish_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `db_lienzo_status`
--

INSERT INTO `db_lienzo_status` (`id`, `statusDesc`, `created_at`) VALUES
(1, 'Default', '2020-09-28 18:25:38'),
(2, 'Activo', '2020-09-28 18:26:48'),
(3, 'Inactivo', '2020-09-28 18:26:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `db_news`
--

CREATE TABLE `db_news` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `date_posted` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fecha` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `db_news`
--

INSERT INTO `db_news` (`id`, `title`, `content`, `date_posted`, `fecha`) VALUES
(1, 'This is just a test', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2020-05-07 13:19:11', NULL),
(2, 'This is just a test', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2020-05-07 13:19:11', NULL),
(3, 'This is just a test', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2020-05-07 13:19:29', NULL),
(4, 'This is just a test', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2020-05-07 13:19:29', NULL),
(5, 'This is just a test', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2020-05-07 13:19:39', NULL),
(6, 'This is just a test', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2020-05-07 13:19:39', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `db_obras`
--

CREATE TABLE `db_obras` (
  `id_obra` int(11) NOT NULL,
  `desc_obra` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `id_status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `db_obras`
--

INSERT INTO `db_obras` (`id_obra`, `desc_obra`, `id_status`, `created_at`) VALUES
(1, 'Obra Dinámicas Blandas', 1, '2020-10-02 02:46:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `db_puntos`
--

CREATE TABLE `db_puntos` (
  `id_actor` int(11) NOT NULL,
  `diametro` int(11) NOT NULL,
  `color` varchar(20) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `contenido` varchar(200) COLLATE utf8mb4_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `db_puntos`
--

INSERT INTO `db_puntos` (`id_actor`, `diametro`, `color`, `contenido`) VALUES
(1, 20, 'red', ''),
(2, 30, 'blue', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `db_rectangulos`
--

CREATE TABLE `db_rectangulos` (
  `id_actor` int(11) NOT NULL,
  `tamano_x` int(11) NOT NULL,
  `tamano_y` int(11) NOT NULL,
  `color` varchar(20) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `contenido` varchar(200) COLLATE utf8mb4_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `db_rectangulos`
--

INSERT INTO `db_rectangulos` (`id_actor`, `tamano_x`, `tamano_y`, `color`, `contenido`) VALUES
(3, 100, 50, 'gray', ''),
(4, 80, 120, 'green', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `db_status`
--

CREATE TABLE `db_status` (
  `id` int(11) NOT NULL,
  `statusDesc` varchar(30) COLLATE utf8mb4_spanish_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `db_status`
--

INSERT INTO `db_status` (`id`, `statusDesc`, `created_at`) VALUES
(1, 'Activo', '2020-09-28 23:26:48'),
(2, 'Inactivo', '2020-09-28 23:26:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `db_status_gral`
--

CREATE TABLE `db_status_gral` (
  `id_status` int(11) NOT NULL,
  `desc_status` varchar(30) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `db_status_gral`
--

INSERT INTO `db_status_gral` (`id_status`, `desc_status`) VALUES
(1, 'Activo'),
(2, 'Inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `db_temporadas`
--

CREATE TABLE `db_temporadas` (
  `id_temporada` int(11) NOT NULL,
  `desc_temporada` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `permanente` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `db_temporadas`
--

INSERT INTO `db_temporadas` (`id_temporada`, `desc_temporada`, `id_tipo`, `permanente`, `created_at`) VALUES
(1, 'Obra Dinámicas Blandas', 1, 1, '2020-10-02 03:03:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `db_textos`
--

CREATE TABLE `db_textos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `texto` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `ntop` int(11) NOT NULL,
  `nleft` int(11) NOT NULL,
  `nheight` int(11) NOT NULL,
  `nwidth` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `db_textos`
--

INSERT INTO `db_textos` (`id`, `nombre`, `texto`, `ntop`, `nleft`, `nheight`, `nwidth`, `status_id`, `created_at`) VALUES
(2, 'Poema a las dinámicas blándas', 'bla ble bli blo blu', 100, 100, 200, 200, 1, '2020-10-01 06:24:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `db_tipo_actores`
--

CREATE TABLE `db_tipo_actores` (
  `id_tipo` int(11) NOT NULL,
  `desc_tipo` varchar(30) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `db_tipo_actores`
--

INSERT INTO `db_tipo_actores` (`id_tipo`, `desc_tipo`) VALUES
(1, 'Punto'),
(2, 'Rectángulo'),
(3, 'texto'),
(4, 'Imagen'),
(5, 'Audio'),
(6, 'Video');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `db_tipo_escena`
--

CREATE TABLE `db_tipo_escena` (
  `id_tipo` int(11) NOT NULL,
  `desc_tipo` varchar(20) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `db_tipo_escena`
--

INSERT INTO `db_tipo_escena` (`id_tipo`, `desc_tipo`) VALUES
(1, 'Escena'),
(2, 'Break');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `db_tipo_temporada`
--

CREATE TABLE `db_tipo_temporada` (
  `id_tipo` int(11) NOT NULL,
  `desc_tipo` varchar(20) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `db_tipo_temporada`
--

INSERT INTO `db_tipo_temporada` (`id_tipo`, `desc_tipo`) VALUES
(1, 'Abierta'),
(2, 'Cerrada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `db_users`
--

CREATE TABLE `db_users` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL,
  `email` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL,
  `password` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL,
  `status_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `db_users`
--

INSERT INTO `db_users` (`id`, `name`, `email`, `password`, `status_id`, `type_id`, `created_at`) VALUES
(0, 'Rober', 'rober.glez.08@gmail.com', '$2y$10$ZGGvSO5PZCBWy/8DJA8wTuKlBzMOrPSOKuKd1Iktu1gqLBiWoNje.', 1, 4, '2020-09-27 03:50:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `db_user_states`
--

CREATE TABLE `db_user_states` (
  `id` int(11) NOT NULL,
  `stateDesc` varchar(30) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `db_user_states`
--

INSERT INTO `db_user_states` (`id`, `stateDesc`) VALUES
(1, 'Iniciado'),
(2, 'Activo'),
(3, 'Eliminado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `db_user_types`
--

CREATE TABLE `db_user_types` (
  `id` int(11) NOT NULL,
  `typeDesc` varchar(30) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `db_user_types`
--

INSERT INTO `db_user_types` (`id`, `typeDesc`) VALUES
(1, 'Administrador'),
(2, 'Curador'),
(3, 'Colaborador'),
(4, 'Espectador');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `db_actores`
--
ALTER TABLE `db_actores`
  ADD PRIMARY KEY (`id_actor`),
  ADD KEY `id_tipo` (`id_tipo`),
  ADD KEY `id_status` (`id_status`);

--
-- Indices de la tabla `db_canvas`
--
ALTER TABLE `db_canvas`
  ADD PRIMARY KEY (`id_canvas`),
  ADD KEY `id_status` (`id_status`);

--
-- Indices de la tabla `db_escenas`
--
ALTER TABLE `db_escenas`
  ADD PRIMARY KEY (`id_escena`),
  ADD KEY `id_canvas` (`id_canvas`),
  ADD KEY `id_tipo` (`id_tipo`),
  ADD KEY `id_status` (`id_status`);

--
-- Indices de la tabla `db_escenas_obra`
--
ALTER TABLE `db_escenas_obra`
  ADD KEY `id_obra` (`id_obra`),
  ADD KEY `id_escena` (`id_escena`);

--
-- Indices de la tabla `db_escena_actores`
--
ALTER TABLE `db_escena_actores`
  ADD KEY `id_escena` (`id_escena`),
  ADD KEY `id_actor` (`id_actor`),
  ADD KEY `id_status` (`id_status`);

--
-- Indices de la tabla `db_fechas_temporada`
--
ALTER TABLE `db_fechas_temporada`
  ADD KEY `id_temporada` (`id_temporada`),
  ADD KEY `id_status` (`id_status`);

--
-- Indices de la tabla `db_lienzos`
--
ALTER TABLE `db_lienzos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indices de la tabla `db_lienzo_status`
--
ALTER TABLE `db_lienzo_status`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `db_news`
--
ALTER TABLE `db_news`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `db_obras`
--
ALTER TABLE `db_obras`
  ADD PRIMARY KEY (`id_obra`),
  ADD KEY `id_status` (`id_status`);

--
-- Indices de la tabla `db_puntos`
--
ALTER TABLE `db_puntos`
  ADD PRIMARY KEY (`id_actor`);

--
-- Indices de la tabla `db_rectangulos`
--
ALTER TABLE `db_rectangulos`
  ADD PRIMARY KEY (`id_actor`);

--
-- Indices de la tabla `db_status`
--
ALTER TABLE `db_status`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `db_status_gral`
--
ALTER TABLE `db_status_gral`
  ADD PRIMARY KEY (`id_status`);

--
-- Indices de la tabla `db_temporadas`
--
ALTER TABLE `db_temporadas`
  ADD PRIMARY KEY (`id_temporada`),
  ADD KEY `id_tipo` (`id_tipo`);

--
-- Indices de la tabla `db_textos`
--
ALTER TABLE `db_textos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indices de la tabla `db_tipo_actores`
--
ALTER TABLE `db_tipo_actores`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indices de la tabla `db_tipo_escena`
--
ALTER TABLE `db_tipo_escena`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indices de la tabla `db_tipo_temporada`
--
ALTER TABLE `db_tipo_temporada`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indices de la tabla `db_users`
--
ALTER TABLE `db_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `type_id` (`type_id`),
  ADD KEY `type_id_2` (`type_id`),
  ADD KEY `status_id_2` (`status_id`),
  ADD KEY `type_id_3` (`type_id`);

--
-- Indices de la tabla `db_user_states`
--
ALTER TABLE `db_user_states`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `db_user_types`
--
ALTER TABLE `db_user_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `db_actores`
--
ALTER TABLE `db_actores`
  MODIFY `id_actor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `db_canvas`
--
ALTER TABLE `db_canvas`
  MODIFY `id_canvas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `db_escenas`
--
ALTER TABLE `db_escenas`
  MODIFY `id_escena` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `db_lienzos`
--
ALTER TABLE `db_lienzos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `db_lienzo_status`
--
ALTER TABLE `db_lienzo_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `db_news`
--
ALTER TABLE `db_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `db_obras`
--
ALTER TABLE `db_obras`
  MODIFY `id_obra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `db_status`
--
ALTER TABLE `db_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `db_temporadas`
--
ALTER TABLE `db_temporadas`
  MODIFY `id_temporada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `db_textos`
--
ALTER TABLE `db_textos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `db_actores`
--
ALTER TABLE `db_actores`
  ADD CONSTRAINT `rel_status_gral_actores` FOREIGN KEY (`id_status`) REFERENCES `db_status_gral` (`id_status`),
  ADD CONSTRAINT `rel_tipo_actores` FOREIGN KEY (`id_tipo`) REFERENCES `db_tipo_actores` (`id_tipo`);

--
-- Filtros para la tabla `db_canvas`
--
ALTER TABLE `db_canvas`
  ADD CONSTRAINT `rel_status_gral_canvas` FOREIGN KEY (`id_status`) REFERENCES `db_status_gral` (`id_status`);

--
-- Filtros para la tabla `db_escenas`
--
ALTER TABLE `db_escenas`
  ADD CONSTRAINT `rel_canvas_escenas` FOREIGN KEY (`id_canvas`) REFERENCES `db_canvas` (`id_canvas`),
  ADD CONSTRAINT `rel_status_gral_escenas` FOREIGN KEY (`id_status`) REFERENCES `db_status_gral` (`id_status`),
  ADD CONSTRAINT `rel_tipo_escenas` FOREIGN KEY (`id_tipo`) REFERENCES `db_tipo_escena` (`id_tipo`);

--
-- Filtros para la tabla `db_escenas_obra`
--
ALTER TABLE `db_escenas_obra`
  ADD CONSTRAINT `rel_escenas_obra_escenas` FOREIGN KEY (`id_escena`) REFERENCES `db_escenas` (`id_escena`),
  ADD CONSTRAINT `rel_escenas_obra_obras` FOREIGN KEY (`id_obra`) REFERENCES `db_obras` (`id_obra`);

--
-- Filtros para la tabla `db_escena_actores`
--
ALTER TABLE `db_escena_actores`
  ADD CONSTRAINT `rel_escena_actores_actores` FOREIGN KEY (`id_actor`) REFERENCES `db_actores` (`id_actor`),
  ADD CONSTRAINT `rel_escena_actores_escenas` FOREIGN KEY (`id_escena`) REFERENCES `db_escenas` (`id_escena`),
  ADD CONSTRAINT `rel_status_gral_escena_actores` FOREIGN KEY (`id_status`) REFERENCES `db_status_gral` (`id_status`);

--
-- Filtros para la tabla `db_fechas_temporada`
--
ALTER TABLE `db_fechas_temporada`
  ADD CONSTRAINT `rel_temporadas_fechas_temporada` FOREIGN KEY (`id_temporada`) REFERENCES `db_temporadas` (`id_temporada`),
  ADD CONSTRAINT `rel_temporadas_status_gral` FOREIGN KEY (`id_status`) REFERENCES `db_status_gral` (`id_status`);

--
-- Filtros para la tabla `db_lienzos`
--
ALTER TABLE `db_lienzos`
  ADD CONSTRAINT `rel_status_lienzo_id` FOREIGN KEY (`status_id`) REFERENCES `db_lienzo_status` (`id`);

--
-- Filtros para la tabla `db_obras`
--
ALTER TABLE `db_obras`
  ADD CONSTRAINT `rel_status_gral_obras` FOREIGN KEY (`id_status`) REFERENCES `db_status_gral` (`id_status`);

--
-- Filtros para la tabla `db_puntos`
--
ALTER TABLE `db_puntos`
  ADD CONSTRAINT `rel_puntos_actores` FOREIGN KEY (`id_actor`) REFERENCES `db_actores` (`id_actor`);

--
-- Filtros para la tabla `db_rectangulos`
--
ALTER TABLE `db_rectangulos`
  ADD CONSTRAINT `rel_rectangulos_actores` FOREIGN KEY (`id_actor`) REFERENCES `db_actores` (`id_actor`);

--
-- Filtros para la tabla `db_temporadas`
--
ALTER TABLE `db_temporadas`
  ADD CONSTRAINT `rel_tipo_temporada_temporadas` FOREIGN KEY (`id_tipo`) REFERENCES `db_tipo_temporada` (`id_tipo`);

--
-- Filtros para la tabla `db_textos`
--
ALTER TABLE `db_textos`
  ADD CONSTRAINT `rel_status_texto_id` FOREIGN KEY (`status_id`) REFERENCES `db_status` (`id`);

--
-- Filtros para la tabla `db_users`
--
ALTER TABLE `db_users`
  ADD CONSTRAINT `rel_status_id` FOREIGN KEY (`status_id`) REFERENCES `db_user_states` (`id`),
  ADD CONSTRAINT `rel_type_id` FOREIGN KEY (`type_id`) REFERENCES `db_user_types` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
