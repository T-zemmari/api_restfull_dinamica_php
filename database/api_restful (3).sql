-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-07-2022 a las 16:18:30
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
  `publi_check_user` tinyint(1) DEFAULT NULL,
  `remember_me_user` tinyint(1) DEFAULT NULL,
  `id_education_user` int(11) DEFAULT NULL,
  `date_create_user` datetime DEFAULT current_timestamp(),
  `date_update_user` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_user`, `name_user`, `lastname_user`, `email_user`, `password_user`, `metodo_registro_user`, `phone_user`, `adress_user`, `cp_user`, `city_user`, `country_user`, `nif_user`, `token_user`, `token_exp_user`, `id_experience_user`, `publi_check_user`, `remember_me_user`, `id_education_user`, `date_create_user`, `date_update_user`) VALUES
(85, 'Tarek', 'Zemmari Kissani', 'guirep@prueba.com', '$2a$07$aHasheaHachea052022$$u3MOxMbQ7xFIYWrouo18wPB80mWGne.S', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2022-07-08 16:00:25', '2022-07-08 16:00:25');

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
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
