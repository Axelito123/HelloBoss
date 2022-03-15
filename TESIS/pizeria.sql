-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-12-2021 a las 19:19:06
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pizeria`
--
CREATE DATABASE IF NOT EXISTS `pizeria` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `pizeria`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bebidas`
--

CREATE TABLE IF NOT EXISTS `bebidas` (
  `id_bebida` int(9) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  `precio` double NOT NULL,
  `imagen` varchar(30) NOT NULL,
  PRIMARY KEY (`id_bebida`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `bebidas`
--

INSERT INTO `bebidas` (`id_bebida`, `nombre`, `precio`, `imagen`) VALUES
(50, 'COCA-COLA', 2.5, 'img/bebidas/cocacola.png'),
(51, 'COCA-COLA LIGHT', 2.5, 'img/bebidas/cocacolaligth.png'),
(52, 'COCA-COLA ZERO', 2.5, 'img/bebidas/cocacolazero.png'),
(53, 'SPRITE', 2.5, 'img/bebidas/sprite.png'),
(54, 'FANTA NARANJA', 2.5, 'img/bebidas/fantaNa.png'),
(55, 'AQUARIUS LIMON', 2.5, 'img/bebidas/aquaLim.png'),
(56, 'AQUARIUS NARANJA', 2.5, 'img/bebidas/aquaNar.png'),
(57, 'AGUA', 1.5, 'img/bebidas/agua.png'),
(58, 'CERVEZA RADDLER', 2.5, 'img/bebidas/raddler.png'),
(59, 'HEINEKKEN', 2.5, 'img/bebidas/heineken.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cocina`
--

CREATE TABLE IF NOT EXISTS `cocina` (
  `id_pedido` int(11) NOT NULL,
  `id_pizza` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `salsa` text NOT NULL,
  `ingrediente_A` text NOT NULL,
  `ingrediente_B` text NOT NULL,
  `ingrediente_C` text NOT NULL,
  KEY `id_pizza` (`id_pizza`),
  KEY `id_pedido` (`id_pedido`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedido`
--

CREATE TABLE IF NOT EXISTS `detalle_pedido` (
  `id_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `id_pedido` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  PRIMARY KEY (`id_detalle`),
  KEY `id_pedido` (`id_pedido`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingredientes`
--

CREATE TABLE IF NOT EXISTS `ingredientes` (
  `id_pizza` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `salsa` text NOT NULL,
  `ingrediente_A` text NOT NULL COMMENT '100 gramos',
  `ingrediente_B` text NOT NULL COMMENT '25 gramos',
  `ingrediente_C` text NOT NULL COMMENT '25 gramos',
  PRIMARY KEY (`id_pizza`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ingredientes`
--

INSERT INTO `ingredientes` (`id_pizza`, `nombre`, `salsa`, `ingrediente_A`, `ingrediente_B`, `ingrediente_C`) VALUES
(1, 'MARGARITA', 'TOMATE.', 'EXTRA QUESO', 'JAMON', 'JAMÓN'),
(2, 'HAWAIANA', 'TOMATE', 'EXTRA QUESO', 'JAMON', 'PIÑA'),
(3, 'PEPPERONI', 'TOMATE', 'PEPPERONI', 'BACON', 'BACON'),
(4, 'VEGETARIANA', 'TOMATE', 'PIMIENTO VERDE', 'CEBOLLA', 'CHAMPIÑONES'),
(5, 'CARNIVORA', 'TOMATE', 'CARNE CERDO', 'CARNE RES', 'BACON'),
(6, 'BARBACOA', 'BBQ', 'POLLO PARRILLA', 'RODAJAS TOMATE', 'CEBOLLA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE IF NOT EXISTS `pedidos` (
  `id_pedido` int(11) NOT NULL AUTO_INCREMENT,
  `clave_trans` varchar(250) NOT NULL,
  `fecha` datetime NOT NULL,
  `nombre` varchar(12) DEFAULT NULL,
  `telefono` varchar(11) DEFAULT NULL,
  `direccion` varchar(250) DEFAULT NULL,
  `metodo_pago` text DEFAULT NULL,
  `envio` text DEFAULT NULL,
  `total` double DEFAULT NULL,
  `clave_paypal` varchar(20) DEFAULT NULL,
  `estatus` text DEFAULT NULL,
  PRIMARY KEY (`id_pedido`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pizzas`
--

CREATE TABLE IF NOT EXISTS `pizzas` (
  `id_pizza` int(9) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(9) NOT NULL,
  `precio` float NOT NULL,
  `imagen` varchar(30) NOT NULL,
  `descripcion` text NOT NULL,
  PRIMARY KEY (`id_pizza`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pizzas`
--

INSERT INTO `pizzas` (`id_pizza`, `nombre`, `precio`, `imagen`, `descripcion`) VALUES
(1, 'MARGARITA', 8.5, 'img/pizzas/margarita.png', 'Deliciosa pizza con salsa de tomate, queso mozarella y jamón fresco.'),
(2, 'HAWAIANA', 8.5, 'img/pizzas/hawaiana.png', 'Deliciosa pizza con salsa de tomate, queso mozarella , jamón fresco y cubitos de piña recién cortada.'),
(3, 'PEPPERONI', 8.5, 'img/pizzas/pepperoni.png', 'Deliciosa pizza con salsa de tomate, queso mozarella, lonjas de bacon y cortes de pepperoni fresco.'),
(4, 'VEGETARIA', 10.5, 'img/pizzas/vegetariana.png', 'Deliciosa pizza con salsa de tomate, queso mozarella , pimientos verdes , cebolla y champiñones.'),
(5, 'CARNIVORA', 10.5, 'img/pizzas/carnivora.png', 'Deliciosa pizza con salsa de tomate, queso mozarella, bacon , carne de res y carne de cerdo.'),
(6, 'BARBACOA', 10.5, 'img/pizzas/barbacoa.png', 'Deliciosa pizza con salsa de barbacoa, queso mozarella, rodajas de tomate, cebolla , pollo a la parrilla.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `repar`
--

CREATE TABLE IF NOT EXISTS `repar` (
  `id_pedido` int(11) NOT NULL,
  `nombre` varchar(12) NOT NULL,
  `direccion` varchar(250) NOT NULL,
  `telefono` varchar(11) NOT NULL,
  `metodo_pago` text DEFAULT NULL,
  `envio` text DEFAULT NULL,
  `total` float DEFAULT NULL,
  PRIMARY KEY (`id_pedido`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
