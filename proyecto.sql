-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 20-10-2022 a las 04:03:08
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `product` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `estado` varchar(50) NOT NULL DEFAULT 'Sin Fecha de Entrega'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `orders`
--

INSERT INTO `orders` (`id`, `name`, `email`, `product`, `description`, `model`, `phone`, `estado`) VALUES
(1, 'andros', 'androsmedina@gmail.com', 'Taza Calor', 'Puede tener la taza la foto por fas', '10a41412a28f914d3878babdf7ce3580.jpeg', 7531394898, '2022-10-25'),
(6, 'andros', 'androsmedina@gmail.com', 'Taza', 'Taza normal con la foto por fas', '48aebc10554dfbb7f4ac31b00c6ddebd.jpeg', 7531394898, '2022-10-08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `photo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `photo`) VALUES
(1, 'Taza Conica', 'taza tipo conica blanca editable', '600fd54777a50babf96bd9a1df51ebdd.jpg'),
(2, 'Taza', 'taza normal editable al gusto', '835def03a1bfd010e927799496d8376d.jpg'),
(3, 'Taza conica calor', 'taza cónica que cambia al calentarse', '9930d6da4a446a894d1c6cfa53a9c205.jpg'),
(4, 'Taza Calor', 'taza que cambia al calentarse', '93dc612a9f770940eccb772fbe40d898.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `phone` bigint(15) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `role`) VALUES
(1, 'brandon medina', 'braandonmedina@gmail.com', '123456789', 7531394899, 'admin'),
(3, 'andros', 'androsmedina@gmail.com', '123456789', 7531394898, 'user'),
(4, 'perla lozano', 'perlalozano@gmail.com', '123456789', 7894561425, 'user'),
(5, 'jesus maldonado', 'jesusmaldonado@gmail.com', '123456789', 7531265896, 'user');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
