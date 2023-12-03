-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-12-2023 a las 19:42:49
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
-- Base de datos: `4019_final_p`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `student`
--

CREATE TABLE `student` (
  `student_id` char(9) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(40) NOT NULL,
  `year_of_study` tinyint(1) NOT NULL DEFAULT 1,
  `name` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `student`
--

INSERT INTO `student` (`student_id`, `password`, `email`, `year_of_study`, `name`, `lastName`) VALUES
('840181999', 'lkj', 'abimelec.roman3@upr.edu', 6, 'Abimelec', 'Roman'),
('840206745', '$2y$10$8ydjUZqxTNvP9AYqZScbSeSfvk32OjeVj0VoUl/QLn4AzmZ/wkbC6', 'Daisy3@upr.edu', 1, 'Daisy', 'Escalante'),
('840199857', '$2y$10$8ydjUZqxTNvP9AYqZScbSeSfvk32OjeVj0VoUl/QLn4AzmZ/wkbC6', 'Emanuel8@upr.edu', 4, 'Emanuel', 'Martinez');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `student_id` (`student_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
