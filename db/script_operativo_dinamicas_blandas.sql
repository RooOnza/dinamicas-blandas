-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-10-2020 a las 04:42:30
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Base de datos: `dinamicas_blandas`


--
-- Tabla: db_status_gral
CREATE TABLE `db_status_gral` (
  `id_status` int(11) NOT NULL,
  `desc_status` varchar(30) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO `db_status_gral` (`id_status`, `desc_status`) VALUES
(1, 'Activo'),
(2, 'Inactivo');

ALTER TABLE `db_status_gral`
  ADD PRIMARY KEY (`id_status`);

--
-- Tabla: db_tipo_actores
CREATE TABLE `db_tipo_actores` (
  `id_tipo` int(11) NOT NULL,
  `desc_tipo` varchar(30) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO `db_tipo_actores` (`id_tipo`, `desc_tipo`) VALUES
(1, 'Punto'),
(2, 'Rectángulo'),
(3, 'texto'),
(4, 'Imagen'),
(5, 'Audio'),
(6, 'Video');

ALTER TABLE `db_tipo_actores`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Tabla: db_actores
CREATE TABLE `db_actores` (
  `id_actor` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `posicion_x` int(11) NOT NULL,
  `posicion_y` int(11) NOT NULL,
  `estilo` varchar(200) COLLATE utf8mb4_spanish_ci NULL,
  `id_tipo` int(11) NOT NULL,
  `id_status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

ALTER TABLE `db_actores`
  ADD PRIMARY KEY (`id_actor`),
  ADD KEY `id_tipo` (`id_tipo`),
  ADD KEY `id_status` (`id_status`);

-- Relación con tabla de tipo
ALTER TABLE `db_actores`
  ADD CONSTRAINT `rel_tipo_actores` FOREIGN KEY (`id_tipo`) REFERENCES `db_tipo_actores` (`id_tipo`);

-- Relación con tabla de status
ALTER TABLE `db_actores`
  ADD CONSTRAINT `rel_status_gral_actores` FOREIGN KEY (`id_status`) REFERENCES `db_status_gral` (`id_status`);

-- AUTO_INCREMENT 
ALTER TABLE `db_actores`
  MODIFY `id_actor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

INSERT INTO `db_actores` (`nombre`, `posicion_x`, `posicion_y`, `estilo`, `id_tipo`, `id_status`) VALUES 
('Punto A', 400, 400, '', 1, 1),
('Punto B', 700, 700, '', 1, 1),
('Rectángulo A', 300, 400, '', 1, 1),
('Rectángulo B', 800, 700, '', 1, 1);

--
-- Tabla: db_puntos
CREATE TABLE `db_puntos` (
  `id_actor` int(11) NOT NULL,
  `diametro` int(11) NOT NULL,
  `color` varchar(20) COLLATE utf8mb4_spanish_ci NULL,
  `contenido` varchar(200) COLLATE utf8mb4_spanish_ci NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

ALTER TABLE `db_puntos`
  ADD PRIMARY KEY (`id_actor`);

INSERT INTO `db_puntos` (`id_actor`, `diametro`, `color`, `contenido`) VALUES 
(1, 20, 'red', ''),
(2, 30, 'blue', '');

-- Relación con tabla db_actores
ALTER TABLE `db_puntos`
  ADD CONSTRAINT `rel_puntos_actores` FOREIGN KEY (`id_actor`) REFERENCES `db_actores` (`id_actor`);

--
-- Tabla: db_rectangulos
CREATE TABLE `db_rectangulos` (
  `id_actor` int(11) NOT NULL,
  `tamaño_x` int(11) NOT NULL,
  `tamaño_y` int(11) NOT NULL,
  `color` varchar(20) COLLATE utf8mb4_spanish_ci NULL,
  `contenido` varchar(200) COLLATE utf8mb4_spanish_ci NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
 
ALTER TABLE `db_rectangulos`
  ADD PRIMARY KEY (`id_actor`);

INSERT INTO `db_rectangulos` (`id_actor`, `tamaño_x`, `tamaño_y`, `color`, `contenido`) VALUES 
(3, 100, 50, 'gray', ''),
(4, 80, 120, 'green', '');

-- Relación con tabla db_actores
ALTER TABLE `db_rectangulos`
  ADD CONSTRAINT `rel_rectangulos_actores` FOREIGN KEY (`id_actor`) REFERENCES `db_actores` (`id_actor`);

--
--
-- Tabla: db_canvas
CREATE TABLE `db_canvas` (
  `id_canvas` int(11) NOT NULL,
  `desc_canvas` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `tamaño_x` int(11) NOT NULL,
  `tamaño_y` int(11) NOT NULL,
  `color` varchar(20) COLLATE utf8mb4_spanish_ci NULL,
  `estilo` varchar(200) COLLATE utf8mb4_spanish_ci NULL,
  `id_status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

ALTER TABLE `db_canvas`
  ADD PRIMARY KEY (`id_canvas`),
  ADD KEY `id_status` (`id_status`);

-- Relación con tabla de status
ALTER TABLE `db_canvas`
  ADD CONSTRAINT `rel_status_gral_canvas` FOREIGN KEY (`id_status`) REFERENCES `db_status_gral` (`id_status`);

-- AUTO_INCREMENT 
ALTER TABLE `db_canvas`
  MODIFY `id_canvas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

INSERT INTO `db_canvas` (`desc_canvas`, `tamaño_x`, `tamaño_y`, `color`, `estilo`, `id_status`) VALUES 
('Lienzo pequeño A (1000x800)', 1000, 800, 'white', '', 1),
('Lienzo muy pequeño A (700x600)', 700, 600, 'black', '', 1);


--
-- Tabla: db_tipo_escena
CREATE TABLE `db_tipo_escena` (
  `id_tipo` int(11) NOT NULL,
  `desc_tipo` varchar(20) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO `db_tipo_escena` (`id_tipo`, `desc_tipo`) VALUES
(1, 'Escena'),
(2, 'Break');

ALTER TABLE `db_tipo_escena`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Tabla: db_tipo_temporada
CREATE TABLE `db_tipo_temporada` (
  `id_tipo` int(11) NOT NULL,
  `desc_tipo` varchar(20) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO `db_tipo_temporada` (`id_tipo`, `desc_tipo`) VALUES
(1, 'Abierta'),
(2, 'Cerrada');

ALTER TABLE `db_tipo_temporada`
  ADD PRIMARY KEY (`id_tipo`);


-- Tabla: db_escenas
CREATE TABLE `db_escenas` (
  `id_escena` int(11) NOT NULL,
  `desc_escena` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `tiempo` int(11) NOT NULL,
  `id_canvas` int(11) NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `id_status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

ALTER TABLE `db_escenas`
  ADD PRIMARY KEY (`id_escena`),
  ADD KEY `id_canvas` (`id_canvas`),
  ADD KEY `id_tipo` (`id_tipo`),
  ADD KEY `id_status` (`id_status`);

ALTER TABLE `db_escenas`
  ADD CONSTRAINT `rel_canvas_escenas` FOREIGN KEY (`id_canvas`) REFERENCES `db_canvas` (`id_canvas`);

ALTER TABLE `db_escenas`
  ADD CONSTRAINT `rel_tipo_escenas` FOREIGN KEY (`id_tipo`) REFERENCES `db_tipo_escena` (`id_tipo`);

ALTER TABLE `db_escenas`
  ADD CONSTRAINT `rel_status_gral_escenas` FOREIGN KEY (`id_status`) REFERENCES `db_status_gral` (`id_status`);

ALTER TABLE `db_escenas`
  MODIFY `id_escena` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

INSERT INTO `db_escenas` (`desc_escena`, `tiempo`, `id_canvas`, `id_tipo`, `id_status`) VALUES 
('Escena A', 2, 1, 1, 1),
('Escena B', 1, 2, 1, 1);


-- Tabla: db_escena_actores
CREATE TABLE `db_escena_actores` (
  `id_escena` int(11) NOT NULL,
  `id_actor` int(11) NOT NULL,
  `posicion_x` int(11) NOT NULL,
  `posicion_y` int(11) NOT NULL,
  `permanente` int(11) NOT NULL,
  `tiempo_ini` int(11) NULL,
  `tiempo_fin` int(11) NULL,
  `estilo` varchar(200) COLLATE utf8mb4_spanish_ci NULL,
  `id_status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

ALTER TABLE `db_escena_actores`
  ADD KEY `id_escena` (`id_escena`),
  ADD KEY `id_actor` (`id_actor`),
  ADD KEY `id_status` (`id_status`);

ALTER TABLE `db_escena_actores`
  ADD CONSTRAINT `rel_escena_actores_escenas` FOREIGN KEY (`id_escena`) REFERENCES `db_escenas` (`id_escena`);

ALTER TABLE `db_escena_actores`
  ADD CONSTRAINT `rel_escena_actores_actores` FOREIGN KEY (`id_actor`) REFERENCES `db_actores` (`id_actor`);

ALTER TABLE `db_escena_actores`
  ADD CONSTRAINT `rel_status_gral_escena_actores` FOREIGN KEY (`id_status`) REFERENCES `db_status_gral` (`id_status`);

INSERT INTO `db_escena_actores` (`id_escena`, `id_actor`, `posicion_x`, `posicion_y`, `permanente`, `tiempo_ini`, `tiempo_fin`, `estilo`, `id_status`) VALUES 
(1, 1, 200, 100, 1, 0, 0, '', 1),
(1, 2, 400, 100, 1, 0, 0, '', 1),
(1, 3, 300, 300, 1, 0, 0, '', 1);


-- Tabla: db_obras
CREATE TABLE `db_obras` (
  `id_obra` int(11) NOT NULL,
  `desc_obra` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `id_status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

ALTER TABLE `db_obras`
  ADD PRIMARY KEY (`id_obra`),
  ADD KEY `id_status` (`id_status`);

ALTER TABLE `db_obras`
  ADD CONSTRAINT `rel_status_gral_obras` FOREIGN KEY (`id_status`) REFERENCES `db_status_gral` (`id_status`);

ALTER TABLE `db_obras`
  MODIFY `id_obra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

INSERT INTO `db_obras` (`desc_obra`, `id_status`) VALUES 
('Obra Dinámicas Blandas', 1);


-- Tabla: db_escenas_obra
CREATE TABLE `db_escenas_obra` (
  `id_obra` int(11) NOT NULL,
  `id_escena` int(11) NOT NULL,
  `orden` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

ALTER TABLE `db_escenas_obra`
  ADD KEY `id_obra` (`id_obra`),
  ADD KEY `id_escena` (`id_escena`);

ALTER TABLE `db_escenas_obra`
  ADD CONSTRAINT `rel_escenas_obra_obras` FOREIGN KEY (`id_obra`) REFERENCES `db_obras` (`id_obra`);

ALTER TABLE `db_escenas_obra`
  ADD CONSTRAINT `rel_escenas_obra_escenas` FOREIGN KEY (`id_escena`) REFERENCES `db_escenas` (`id_escena`);

INSERT INTO `db_escenas_obra` (`id_obra`, `id_escena`, `orden`) VALUES 
(1, 1, 1),
(1, 2, 2);


-- Tabla: db_temporadas
CREATE TABLE `db_temporadas` (
  `id_temporada` int(11) NOT NULL,
  `desc_temporada` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `permanente` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

ALTER TABLE `db_temporadas`
  ADD PRIMARY KEY (`id_temporada`),
  ADD KEY `id_tipo` (`id_tipo`);

ALTER TABLE `db_temporadas`
  ADD CONSTRAINT `rel_tipo_temporada_temporadas` FOREIGN KEY (`id_tipo`) REFERENCES `db_tipo_temporada` (`id_tipo`);

ALTER TABLE `db_temporadas`
  MODIFY `id_temporada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

INSERT INTO `db_temporadas` (`desc_temporada`, `id_tipo`, `permanente`) VALUES 
('Obra Dinámicas Blandas', 1, 1);


-- Tabla: db_fechas_temporada
CREATE TABLE `db_fechas_temporada` (
  `id_temporada` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `id_status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

ALTER TABLE `db_fechas_temporada`
  ADD KEY `id_temporada` (`id_temporada`),
  ADD KEY `id_status` (`id_status`);

ALTER TABLE `db_fechas_temporada`
  ADD CONSTRAINT `rel_temporadas_fechas_temporada` FOREIGN KEY (`id_temporada`) REFERENCES `db_temporadas` (`id_temporada`);

ALTER TABLE `db_fechas_temporada`
  ADD CONSTRAINT `rel_temporadas_status_gral` FOREIGN KEY (`id_status`) REFERENCES `db_status_gral` (`id_status`);


COMMIT;
