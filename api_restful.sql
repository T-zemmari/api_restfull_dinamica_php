-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-07-2022 a las 11:54:19
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `api_restful`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `experiences`
--

CREATE TABLE `experiences` (
  `id_experience` int(11) NOT NULL,
  `company_experience` varchar(255) DEFAULT NULL,
  `date_start_experience` datetime DEFAULT NULL,
  `date_end_experience` datetime DEFAULT NULL,
  `position_company_experience` varchar(255) DEFAULT NULL,
  `date_create_experience` datetime DEFAULT current_timestamp(),
  `date_update_experience` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `experiences`
--

INSERT INTO `experiences` (`id_experience`, `company_experience`, `date_start_experience`, `date_end_experience`, `position_company_experience`, `date_create_experience`, `date_update_experience`) VALUES
(0, 'Google', '2022-06-15 16:40:22', '2022-06-15 16:40:22', 'Full stack', '2022-06-15 16:40:53', '2022-06-15 16:40:53'),
(1, 'Tedy', '2022-06-15 15:33:33', '2022-06-15 15:33:33', 'Full stack', '2022-06-15 15:34:02', '2022-06-15 15:34:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `name_user` varchar(255) DEFAULT NULL,
  `lastname_user` varchar(255) DEFAULT NULL,
  `email_user` varchar(255) DEFAULT NULL,
  `password_user` varchar(255) DEFAULT NULL,
  `metodo_registro_user` varchar(255) DEFAULT NULL,
  `phone_user` varchar(255) DEFAULT NULL,
  `adress_user` varchar(255) DEFAULT NULL,
  `cp_user` varchar(255) DEFAULT NULL,
  `city_user` varchar(255) DEFAULT NULL,
  `country_user` varchar(255) DEFAULT NULL,
  `nif_user` varchar(255) DEFAULT NULL,
  `token_user` text DEFAULT NULL,
  `token_exp_user` text DEFAULT NULL,
  `id_experience_user` int(11) DEFAULT NULL,
  `date_create_user` datetime DEFAULT current_timestamp(),
  `date_update_user` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_user`, `name_user`, `lastname_user`, `email_user`, `password_user`, `metodo_registro_user`, `phone_user`, `adress_user`, `cp_user`, `city_user`, `country_user`, `nif_user`, `token_user`, `token_exp_user`, `id_experience_user`, `date_create_user`, `date_update_user`) VALUES
(2, 'Tarek 2', 'Moreno lopez', '', '123456789', NULL, '', '', '', '', '', '', NULL, NULL, 1, '2022-06-15 11:11:46', '2022-06-15 11:11:46'),
(3, 'Maria', 'La vega', 'maia@gmail.com', '123456789', NULL, '666666666', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2022-06-15 16:38:30', '2022-06-15 16:38:30'),
(4, 'Fran', 'Mario dario', 'mario@gmail.com', '123456789', NULL, '666666666', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-06-15 16:39:32', '2022-06-15 16:39:32'),
(6, 'Paco', 'Lopez Flores', 'lopez@gmail.com', '123456789', NULL, '666666666', 'calle la paz mundial 21', '46001', 'Valencia', 'España', '23669988L', NULL, NULL, NULL, '2022-06-22 13:44:10', '2022-06-22 13:44:10'),
(7, 'Paco', 'Lopez Flores', 'lopez@gmail.com', '123456789', NULL, '666666666', 'calle la paz mundial 21', '46001', 'Valencia', 'España', '23669988L', NULL, NULL, NULL, '2022-06-22 13:50:29', '2022-06-22 13:50:29'),
(8, 'Paco', 'Lopez Flores', 'lopez@gmail.com', '123456789', NULL, '666666666', 'calle la paz mundial 21', '46001', 'Valencia', 'España', '23669988L', NULL, NULL, NULL, '2022-06-30 15:18:54', '2022-06-30 15:18:54'),
(9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-06-30 16:43:22', '2022-06-30 16:43:22'),
(10, 'Paco', 'Lopez Flores', 'lopez@gmail.com', '123456789', NULL, '666666666', 'calle la paz mundial 21', '46001', 'Valencia', 'España', '23669988L', NULL, NULL, NULL, '2022-07-04 08:26:59', '2022-07-04 08:26:59'),
(23, NULL, NULL, 'correo3@users.com', '$2a$07$aHasheaHachea052022$$u3MOxMbQ7xFIYWrouo18wPB80mWGne.S', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2NTY5MjgxNzUsImV4cCI6MTY1NzAxNDU3NSwiZGF0YSI6eyJpZCI6IjIzIiwiZW1haWwiOiJjb3JyZW8zQHVzZXJzLmNvbSJ9fQ.JmhfxZzMvTdkvCBJJrlD21tSU-M9Y5n8Vnk7C0IlhjY', '1657014575', NULL, '2022-07-04 09:58:09', '2022-07-04 09:58:09'),
(26, NULL, NULL, 'correo1@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2NTY5MjgyMDEsImV4cCI6MTY1NzAxNDYwMSwiZGF0YSI6eyJpZCI6IjI2IiwiZW1haWwiOiJjb3JyZW8xQGdtYWlsLmNvbSJ9fQ.uTAygAmm-D2b5qmFIC2_rL-7VC915KZaEFZ4Nh1TSmg', '1657014601', NULL, '2022-07-04 11:50:01', '2022-07-04 11:50:01');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `experiences`
--
ALTER TABLE `experiences`
  ADD PRIMARY KEY (`id_experience`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_experience_user` (`id_experience_user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `experiences`
--
ALTER TABLE `experiences`
  MODIFY `id_experience` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
