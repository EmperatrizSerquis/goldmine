-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-05-2020 a las 19:12:00
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `goldmine2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `associated_store_items_and_item_sizes`
--

CREATE TABLE `associated_store_items_and_item_sizes` (
  `id` int(11) NOT NULL,
  `store_items_id` int(11) DEFAULT NULL,
  `item_sizes_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `associated_store_items_and_item_sizes`
--

INSERT INTO `associated_store_items_and_item_sizes` (`id`, `store_items_id`, `item_sizes_id`) VALUES
(1, 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `associated_store_items_and_store_item_colors`
--

CREATE TABLE `associated_store_items_and_store_item_colors` (
  `id` int(11) NOT NULL,
  `store_items_id` int(11) DEFAULT NULL,
  `store_item_colors_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `associated_store_items_and_store_item_colors`
--

INSERT INTO `associated_store_items_and_store_item_colors` (`id`, `store_items_id`, `store_item_colors_id`) VALUES
(1, 2, 3),
(2, 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `comment` text,
  `date_created` int(11) DEFAULT '0',
  `user_id` int(11) DEFAULT NULL,
  `target_table` varchar(125) DEFAULT NULL,
  `update_id` int(11) DEFAULT NULL,
  `code` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `item_sizes`
--

CREATE TABLE `item_sizes` (
  `id` int(11) NOT NULL,
  `type_size` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `item_sizes`
--

INSERT INTO `item_sizes` (`id`, `type_size`) VALUES
(1, 'Small'),
(2, 'Large');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `store_accounts`
--

CREATE TABLE `store_accounts` (
  `id` int(11) NOT NULL,
  `first_name` varchar(120) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `company` varchar(150) DEFAULT NULL,
  `street_address` varchar(255) DEFAULT NULL,
  `address_line_2` varchar(255) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `state` varchar(48) DEFAULT NULL,
  `zip_code` varchar(10) DEFAULT NULL,
  `telephone_number` varchar(70) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `date_created` int(11) NOT NULL,
  `pword` varchar(255) NOT NULL,
  `trongate_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `store_accounts`
--

INSERT INTO `store_accounts` (`id`, `first_name`, `last_name`, `company`, `street_address`, `address_line_2`, `city`, `state`, `zip_code`, `telephone_number`, `email`, `date_created`, `pword`, `trongate_user_id`) VALUES
(1, 'David', 'Connelly', 'Claudia', 'Amenabar 1655', '', 'Belgrano', 'CABA', '1426', '1155746171', 'david.webguy@gmail.com', 1588635501, '', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `store_basket`
--

CREATE TABLE `store_basket` (
  `id` int(11) NOT NULL,
  `code` varchar(32) NOT NULL,
  `session_id` varchar(65) NOT NULL,
  `ip_address` varchar(55) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_qty` int(11) NOT NULL,
  `item_color_id` int(11) NOT NULL,
  `item_size_id` int(11) NOT NULL,
  `date_added` int(11) NOT NULL,
  `shopper_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `store_items`
--

CREATE TABLE `store_items` (
  `id` int(11) NOT NULL,
  `url_string` varchar(255) DEFAULT NULL,
  `item_title` varchar(255) DEFAULT NULL,
  `in_stock` tinyint(1) DEFAULT NULL,
  `item_code` varchar(255) DEFAULT NULL,
  `item_price` decimal(7,2) DEFAULT NULL,
  `description` text,
  `picture` varchar(255) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `store_items`
--

INSERT INTO `store_items` (`id`, `url_string`, `item_title`, `in_stock`, `item_code`, `item_price`, `description`, `picture`) VALUES
(1, 'first-item', 'First Item', 1, '123456', '88.00', 'Primer producto', 'watch1.jpg'),
(2, 'citizen-ecodrive-at901303h', 'Citizen Eco-Drive AT9013-03H', 1, 'YKD3MF', '888.00', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus veritatis autem laborum et praesentium porro consequuntur, sequi corporis nisi dolorem, ipsum placeat voluptatem debitis provident eligendi. Doloribus aliquid ab temporibus!\r\n                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora voluptate consectetur numquam illo esse distinctio nam iusto laudantium repudiandae fuga dolores rerum cumque aspernatur quidem minima dolor labore, atque quasi.\r\n               Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatum, ex consequuntur dolorem doloribus odio ratione voluptas cum, iure magnam deserunt ipsam fuga soluta commodi a facilis vel modi adipisci temporibus.', 'watch3.jpg'),
(3, 'no-pic-item', 'No Pic Item', 1, '3REJND', '120.00', 'Sin imagen q', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `store_item_colors`
--

CREATE TABLE `store_item_colors` (
  `id` int(11) NOT NULL,
  `item_color` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `store_item_colors`
--

INSERT INTO `store_item_colors` (`id`, `item_color`) VALUES
(1, 'Gold'),
(2, 'Silver'),
(3, 'Black');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trongate_administrators`
--

CREATE TABLE `trongate_administrators` (
  `id` int(11) NOT NULL,
  `username` varchar(65) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `trongate_user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `trongate_administrators`
--

INSERT INTO `trongate_administrators` (`id`, `username`, `password`, `trongate_user_id`) VALUES
(1, 'admin', '$2y$11$SoHZDvbfLSRHAi3WiKIBiu.tAoi/GCBBO4HRxVX1I3qQkq3wCWfXi', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trongate_tokens`
--

CREATE TABLE `trongate_tokens` (
  `id` int(11) NOT NULL,
  `token` varchar(125) DEFAULT NULL,
  `user_id` int(11) DEFAULT '0',
  `expiry_date` int(11) DEFAULT NULL,
  `code` varchar(3) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `trongate_tokens`
--

INSERT INTO `trongate_tokens` (`id`, `token`, `user_id`, `expiry_date`, `code`) VALUES
(1, 'ARPqyemcJA19Bwlt2FDVoT5ZhwmxFkkz', 1, 1588703159, '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trongate_users`
--

CREATE TABLE `trongate_users` (
  `id` int(11) NOT NULL,
  `code` varchar(32) DEFAULT NULL,
  `user_level_id` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `trongate_users`
--

INSERT INTO `trongate_users` (`id`, `code`, `user_level_id`) VALUES
(1, 'rHewIzOEGgtAjmve3vJZ8WysYGC0Dkny', 1),
(2, 'gR6vxLQKM32tJ9pA7HuzCEFaurscDE9X', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trongate_user_levels`
--

CREATE TABLE `trongate_user_levels` (
  `id` int(11) NOT NULL,
  `level_title` varchar(125) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `trongate_user_levels`
--

INSERT INTO `trongate_user_levels` (`id`, `level_title`) VALUES
(1, 'admin'),
(2, 'customer');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `associated_store_items_and_item_sizes`
--
ALTER TABLE `associated_store_items_and_item_sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `associated_store_items_and_store_item_colors`
--
ALTER TABLE `associated_store_items_and_store_item_colors`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `item_sizes`
--
ALTER TABLE `item_sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `store_accounts`
--
ALTER TABLE `store_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `store_basket`
--
ALTER TABLE `store_basket`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `store_items`
--
ALTER TABLE `store_items`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `store_item_colors`
--
ALTER TABLE `store_item_colors`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `trongate_administrators`
--
ALTER TABLE `trongate_administrators`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `trongate_tokens`
--
ALTER TABLE `trongate_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `trongate_users`
--
ALTER TABLE `trongate_users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `trongate_user_levels`
--
ALTER TABLE `trongate_user_levels`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `associated_store_items_and_item_sizes`
--
ALTER TABLE `associated_store_items_and_item_sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `associated_store_items_and_store_item_colors`
--
ALTER TABLE `associated_store_items_and_store_item_colors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `item_sizes`
--
ALTER TABLE `item_sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `store_accounts`
--
ALTER TABLE `store_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `store_basket`
--
ALTER TABLE `store_basket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `store_items`
--
ALTER TABLE `store_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `store_item_colors`
--
ALTER TABLE `store_item_colors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `trongate_administrators`
--
ALTER TABLE `trongate_administrators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `trongate_tokens`
--
ALTER TABLE `trongate_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `trongate_users`
--
ALTER TABLE `trongate_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `trongate_user_levels`
--
ALTER TABLE `trongate_user_levels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
