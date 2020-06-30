-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-06-2020 a las 06:03:03
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.1.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `your_rent`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `properties`
--

CREATE TABLE `properties` (
  `id_property` int(11) NOT NULL,
  `title` varchar(40) NOT NULL,
  `type` varchar(40) NOT NULL,
  `addresses` varchar(50) NOT NULL,
  `rooms` varchar(20) NOT NULL,
  `price` varchar(40) NOT NULL,
  `area` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `properties`
--

INSERT INTO `properties` (`id_property`, `title`, `type`, `addresses`, `rooms`, `price`, `area`) VALUES
(1, 'Casa en la quinta porra', 'house', 'cra 80 # 12-12', '7', '200000', '250'),
(3, 'Apartamento en Reservas del Sur', 'house', 'cra 58 # 77-41', '3', '100000', '123'),
(4, 'Habitación en Medellin', 'room', 'Cra 5 Num 18-48', '1', '250000', '12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `type_id` varchar(20) NOT NULL,
  `identification` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `lastname`, `email`, `type_id`, `identification`, `password`) VALUES
(77, 'Yuly', 'Perez', 'yuly@hotmail.com', 'CC', '123457665', 'alejandro$$'),
(78, 'Pedro', 'Arbelaez', 'pearbe@hotmail.com', 'PAS', '123457665', '%alejandro$'),
(79, 'Pedro', 'Arbelaez', 'pearbe@hotmail.com', 'PAS', '', '%alejandro$'),
(80, 'Paola', 'Zuluaga', 'paola@hotmail.com', 'CC', '1036658665555461', '123456#$'),
(81, 'Sergio', 'Muñoz', 'sergio@gmail.com', 'CC', '108835454647', 'sergio%&'),
(82, 'Juan Camilo', 'Quiroz Aristizabal', 'jucaqui@gmail.com', 'CC', '108836464649', 'juanca&&'),
(83, 'Carlos Alberto', 'Rios Olmos', 'calrio@gmail.com', 'CC', '1054323445678', 'carlos%&');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id_property`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `properties`
--
ALTER TABLE `properties`
  MODIFY `id_property` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
