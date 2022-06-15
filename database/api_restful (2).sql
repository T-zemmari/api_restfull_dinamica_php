-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-06-2022 a las 13:53:36
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
  `id_experience_user` int(11) DEFAULT NULL,
  `date_create_experience` datetime DEFAULT current_timestamp(),
  `date_update_experience` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id_user` int(11) DEFAULT NULL,
  `name_user` varchar(255) DEFAULT NULL,
  `lastname_user` varchar(255) DEFAULT NULL,
  `email_user` varchar(255) DEFAULT NULL,
  `password_user` varchar(255) DEFAULT NULL,
  `phone_user` varchar(255) DEFAULT NULL,
  `adress_user` varchar(255) DEFAULT NULL,
  `cp_user` varchar(255) DEFAULT NULL,
  `city_user` varchar(255) DEFAULT NULL,
  `country_user` varchar(255) DEFAULT NULL,
  `nif_user` varchar(255) DEFAULT NULL,
  `token_user` text DEFAULT NULL,
  `token_exp_user` text DEFAULT NULL,
  `date_create_user` datetime DEFAULT current_timestamp(),
  `date_update_user` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_user`, `name_user`, `lastname_user`, `email_user`, `password_user`, `phone_user`, `adress_user`, `cp_user`, `city_user`, `country_user`, `nif_user`, `token_user`, `token_exp_user`, `date_create_user`, `date_update_user`) VALUES
(1, 'Tarik', 'Zemmari Kissani', 'guirep@gmail.com', '123456789', '669217903', 'Calla la paz mundial 3', '46001', 'valencia', 'España', '23940276J', NULL, NULL, '2022-06-14 13:18:20', '2022-06-14 13:18:20'),
(2, 'Lorena', 'Vaso ', 'vaso.lorna@gmail.com', '123456789', '669121212', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-06-15 11:11:46', '2022-06-15 11:11:46');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `experiences`
--
ALTER TABLE `experiences`
  ADD PRIMARY KEY (`id_experience`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `experiences`
--
ALTER TABLE `experiences`
  MODIFY `id_experience` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
