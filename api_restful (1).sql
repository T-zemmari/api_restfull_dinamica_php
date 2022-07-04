-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-07-2022 a las 12:30:43
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
-- Estructura de tabla para la tabla `educations`
--

CREATE TABLE `educations` (
  `id_education` int(11) NOT NULL,
  `in_school_education` varchar(255) DEFAULT NULL,
  `certificate_education` varchar(255) DEFAULT NULL,
  `date_start_education` date DEFAULT current_timestamp(),
  `date_end_education` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `date_create_experience` datetime DEFAULT NULL,
  `date_update_experience` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `experiences`
--

INSERT INTO `experiences` (`id_experience`, `company_experience`, `date_start_experience`, `date_end_experience`, `position_company_experience`, `date_create_experience`, `date_update_experience`) VALUES
(0, 'Google', '2022-06-15 16:40:22', '2022-06-15 16:40:22', 'Full stack', '2022-06-15 16:40:53', '2022-06-15 16:40:53'),
(1, 'Tedy', '2022-06-15 15:33:33', '2022-06-15 15:33:33', 'Full stack', '2022-06-15 15:34:02', '2022-06-15 15:34:02'),
(5, 'Tedy business', '2022-01-01 00:00:00', '0000-00-00 00:00:00', 'Front-end developper', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id_product` int(11) NOT NULL,
  `quantity_product` int(11) DEFAULT NULL,
  `model_product` varchar(255) DEFAULT NULL,
  `marca_product` varchar(255) DEFAULT NULL,
  `image_one_product` varchar(255) DEFAULT NULL,
  `image_two_product` varchar(255) DEFAULT NULL,
  `image_tree_product` varchar(255) DEFAULT NULL,
  `price_product` decimal(10,2) DEFAULT NULL,
  `add_date_product` datetime DEFAULT current_timestamp(),
  `modified_date_product` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id_product`, `quantity_product`, `model_product`, `marca_product`, `image_one_product`, `image_two_product`, `image_tree_product`, `price_product`, `add_date_product`, `modified_date_product`) VALUES
(1, 110, 'Paco raban', 'Paco raban marca', '/asdasdasdasdasda', NULL, NULL, '15.99', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

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
  `id_education_user` int(11) DEFAULT NULL,
  `date_create_user` datetime DEFAULT current_timestamp(),
  `date_update_user` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_user`, `name_user`, `lastname_user`, `email_user`, `password_user`, `metodo_registro_user`, `phone_user`, `adress_user`, `cp_user`, `city_user`, `country_user`, `nif_user`, `token_user`, `token_exp_user`, `id_experience_user`, `id_education_user`, `date_create_user`, `date_update_user`) VALUES
(2, 'Tarek 2', 'Moreno lopez', '', '123456789', NULL, '', '', '', '', '', '', NULL, NULL, 1, NULL, '2022-06-15 11:11:46', '2022-06-15 11:11:46'),
(3, 'Maria', 'La vega', 'maia@gmail.com', '123456789', NULL, '666666666', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-06-15 16:38:30', '2022-06-15 16:38:30'),
(4, 'Fran', 'Mario dario', 'mario@gmail.com', '123456789', NULL, '666666666', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-06-15 16:39:32', '2022-06-15 16:39:32'),
(6, 'Paco', 'Lopez Flores', 'lopez@gmail.com', '123456789', NULL, '666666666', 'calle la paz mundial 21', '46001', 'Valencia', 'España', '23669988L', NULL, NULL, NULL, NULL, '2022-06-22 13:44:10', '2022-06-22 13:44:10'),
(7, 'Paco', 'Lopez Flores', 'lopez@gmail.com', '123456789', NULL, '666666666', 'calle la paz mundial 21', '46001', 'Valencia', 'España', '23669988L', NULL, NULL, NULL, NULL, '2022-06-22 13:50:29', '2022-06-22 13:50:29'),
(8, 'Paco', 'Lopez Flores', 'lopez@gmail.com', '123456789', NULL, '666666666', 'calle la paz mundial 21', '46001', 'Valencia', 'España', '23669988L', NULL, NULL, NULL, NULL, '2022-06-30 15:18:54', '2022-06-30 15:18:54'),
(9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-06-30 16:43:22', '2022-06-30 16:43:22'),
(10, 'Paco', 'Lopez Flores', 'lopez@gmail.com', '123456789', NULL, '666666666', 'calle la paz mundial 21', '46001', 'Valencia', 'España', '23669988L', NULL, NULL, NULL, NULL, '2022-07-04 08:26:59', '2022-07-04 08:26:59'),
(23, NULL, NULL, 'correo3@users.com', '$2a$07$aHasheaHachea052022$$u3MOxMbQ7xFIYWrouo18wPB80mWGne.S', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2NTY5MjkxNjgsImV4cCI6MTY1NzAxNTU2OCwiZGF0YSI6eyJpZCI6IjIzIiwiZW1haWwiOiJjb3JyZW8zQHVzZXJzLmNvbSJ9fQ.vSXWRtEqF5dbFlu1hJ_swJ7MXEm0WYKU9vLqY8azq1Y', '1657015568', NULL, NULL, '2022-07-04 09:58:09', '2022-07-04 09:58:09'),
(26, NULL, NULL, 'correo1@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2NTY5MjkwMTQsImV4cCI6MTY1NzAxNTQxNCwiZGF0YSI6eyJpZCI6IjI2IiwiZW1haWwiOiJjb3JyZW8xQGdtYWlsLmNvbSJ9fQ.f7DmLfHO5b2_ybXR5Fh6xvAjuX9qFiHWmnfPpT0qvA0', '1657015414', NULL, NULL, '2022-07-04 11:50:01', '2022-07-04 11:50:01');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `educations`
--
ALTER TABLE `educations`
  ADD PRIMARY KEY (`id_education`);

--
-- Indices de la tabla `experiences`
--
ALTER TABLE `experiences`
  ADD PRIMARY KEY (`id_experience`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_product`);

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
-- AUTO_INCREMENT de la tabla `educations`
--
ALTER TABLE `educations`
  MODIFY `id_education` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `experiences`
--
ALTER TABLE `experiences`
  MODIFY `id_experience` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
