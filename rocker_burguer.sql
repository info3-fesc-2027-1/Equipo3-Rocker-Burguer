-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-11-2026 a las 09:00:33
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `rocker_burguer`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bases`
--

CREATE TABLE `bases` (
  `id_base` int(2) NOT NULL,
  `base` varchar(25) CHARACTER SET utf8mb4 NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `bases`
--

INSERT INTO `bases` (`id_base`, `base`, `estado`) VALUES
(1, 'Nutella', 1),
(2, 'Philadenphia', 1),
(3, 'Mermelada', 1),
(4, 'Cajeta', 1),
(5, 'Lechera', 1),
(6, 'Hershey\'s', 1),
(7, 'Crema Cacahuate', 1),
(8, 'Maple', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bebidas`
--

CREATE TABLE `bebidas` (
  `id_bebida` int(4) NOT NULL,
  `bebida` varchar(45) CHARACTER SET utf8mb4 NOT NULL,
  `tipo` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
  `preMedioL` int(5) DEFAULT NULL,
  `preL` int(5) DEFAULT NULL,
  `preLDos` int(5) DEFAULT NULL,
  `precio` int(5) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `bebidas`
--

INSERT INTO `bebidas` (`id_bebida`, `bebida`, `tipo`, `preMedioL`, `preL`, `preLDos`, `precio`, `estado`) VALUES
(1, 'Mojito Clasico', 'Ron', 55, 90, NULL, NULL, 1),
(2, 'Mojito de Mango', 'Ron', 65, 105, NULL, NULL, 1),
(3, 'Mojito de Fresa', 'Ron', 65, 105, NULL, NULL, 1),
(4, 'Mojito de Maracuya', 'Ron', 65, 105, NULL, NULL, 1),
(5, 'Mojito de Frutos Rojos', 'Ron', 65, 105, NULL, NULL, 1),
(6, 'Barbie', 'Ron', 75, 115, NULL, NULL, 1),
(7, 'Bacardi de Mango', 'Ron', 40, 115, NULL, NULL, 1),
(8, 'Bacardi de Limon', 'Ron', 70, 115, NULL, NULL, 1),
(9, 'Bacardi Rasberry', 'Ron', 70, 115, NULL, NULL, 1),
(10, 'Cuba Libre Bacacho', 'Ron', 70, 115, NULL, NULL, 1),
(11, 'Pi?a Colada', 'Ron', 75, 120, NULL, NULL, 1),
(12, 'Molotov', 'Ron', 75, 120, NULL, NULL, 1),
(13, 'Vodka (Jugo a elecci?n)', 'Vodka', 65, 105, NULL, NULL, 1),
(14, 'Vodka Absolut', 'Vodka', 75, 120, NULL, NULL, 1),
(15, 'Vodka Tamarindo', 'Vodka', 75, 120, NULL, NULL, 1),
(16, 'Azulito Energizante', 'Vodka', 65, 105, NULL, NULL, 1),
(17, 'Azulito Electrico', 'Vodka', 65, 105, NULL, NULL, 1),
(18, 'Ultra Violeta', 'Vodka', 65, 105, NULL, NULL, 1),
(19, 'Tequila Son Rise', 'Tequila', 70, 105, NULL, NULL, 1),
(20, 'Vampiro', 'Tequila', 70, 105, NULL, NULL, 1),
(21, 'Paloma', 'Tequila', 70, 105, NULL, NULL, 1),
(22, 'Charro Negro', 'Tequila', 70, 105, NULL, NULL, 1),
(23, 'Cantarito', 'Tequila', 70, 105, NULL, NULL, 1),
(24, 'Magarita', 'Tequila', 70, 105, NULL, NULL, 1),
(25, 'Con Centenario', 'Tequila', 85, 125, NULL, NULL, 1),
(26, 'Cerveza Sola', 'Cerveza', 45, 80, 90, NULL, 1),
(27, 'Michelada', 'Cerveza', 50, 90, 95, NULL, 1),
(28, 'Cubana', 'Cerveza', 55, 100, 105, NULL, 1),
(29, 'Cerillo Laton 473 ml', 'Cerveza', NULL, NULL, NULL, 43, 1),
(30, 'Cerveza 0% Alcohol 355 ml', 'Cerveza', NULL, NULL, NULL, 43, 1),
(31, 'Cerveza 355 ml Vidrio', 'Cerveza', NULL, NULL, NULL, 43, 1),
(32, 'Mega Envase', 'Cerveza', NULL, NULL, 85, NULL, 1),
(33, 'Margarita 266 ml', 'Copas', NULL, NULL, NULL, 70, 1),
(34, 'Carajillo', 'Copas', NULL, NULL, NULL, 100, 1),
(35, 'Alfonso XIII', 'Copas', NULL, NULL, NULL, 85, 1),
(36, 'Caballito 2 oz Tequila Azul', 'Copas', NULL, NULL, NULL, 50, 1),
(37, 'Caballito 2 oz Tequila Centenario', 'Copas', NULL, NULL, NULL, 70, 1),
(38, 'Caballito 2 oz Mezcal Cantona', 'Copas', NULL, NULL, NULL, 60, 1),
(39, 'Caballito 2 oz Mezcal 400 Conejos', 'Copas', NULL, NULL, NULL, 95, 1),
(40, 'Pi?ada', 'Sin Alcohol', 50, 90, NULL, NULL, 1),
(41, 'Soda Italiana', 'Sin Alcohol', 35, 60, NULL, NULL, 1),
(42, 'Refresco preparado Squirt', 'Sin Alcohol', NULL, 65, NULL, NULL, 1),
(43, 'Refresco preparado Agua Mineral', 'Sin Alcohol', NULL, 65, NULL, NULL, 1),
(44, 'Refresco preparado Sangria', 'Sin Alcohol', NULL, 65, NULL, NULL, 1),
(45, 'Limonada', 'Sin Alcohol', NULL, 65, NULL, NULL, 1),
(46, 'Mezcalmix con Cantona', 'Mezcal', 75, 120, NULL, NULL, 1),
(47, 'Mezcalmix con Mezcal 400 Conejos', 'Mezcal', 105, 175, NULL, NULL, 1),
(48, 'Flamingo con Cantona', 'Mezcal', 75, 120, NULL, NULL, 1),
(49, 'Flamingo con Mezcal 400 Conejos', 'Mezcal', 105, 175, NULL, NULL, 1),
(50, 'Maria Mezcal con Cantona', 'Mezcal', 75, 120, NULL, NULL, 1),
(51, 'Maria Mezcal con Mezcal 400 Conejos', 'Mezcal', 105, 175, NULL, NULL, 1),
(52, 'Perla Negra', 'Mezcal', 80, 130, NULL, NULL, 1),
(53, 'Whisky Red Label', 'Mezcal', 80, 150, NULL, NULL, 1),
(54, 'Caipirinha', 'Mezcal', 80, 130, NULL, NULL, 1),
(55, 'Torres 10', 'Mezcal', 80, 130, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bebidascal`
--

CREATE TABLE `bebidascal` (
  `id_bebidaCal` int(1) NOT NULL,
  `bebida` varchar(20) COLLATE utf8mb4_spanish_ci NOT NULL,
  `costo` int(4) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `tiempo` int(2) NOT NULL,
  `imagen` varchar(25) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `bebidascal`
--

INSERT INTO `bebidascal` (`id_bebidaCal`, `bebida`, `costo`, `estado`, `tiempo`, `imagen`) VALUES
(1, 'Café Americano', 25, 1, 3, 'americano.jpg'),
(2, 'Capuchino', 25, 1, 4, 'capuchino.jpg'),
(3, 'Latte', 25, 1, 5, 'latte.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(10) NOT NULL,
  `nom` tinytext CHARACTER SET utf8mb4 NOT NULL,
  `ap` tinytext CHARACTER SET utf8mb4 NOT NULL,
  `am` tinytext CHARACTER SET utf8mb4 NOT NULL,
  `tel` bigint(10) NOT NULL,
  `id_correo` varchar(45) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nom`, `ap`, `am`, `tel`, `id_correo`) VALUES
(1, 'Gabriela', 'Millan', 'Salazar', 5623987452, 'gaby@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crepasal`
--

CREATE TABLE `crepasal` (
  `id_crepaSal` int(9) NOT NULL,
  `tipo` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
  `ingre1` int(2) NOT NULL,
  `ingre2` int(2) NOT NULL,
  `ingre3` int(3) NOT NULL,
  `costo` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crepasdulces`
--

CREATE TABLE `crepasdulces` (
  `id_crepaDul` int(9) NOT NULL,
  `tipo` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
  `fruta` int(2) DEFAULT NULL,
  `toppingPrem` int(2) DEFAULT NULL,
  `topping` int(3) DEFAULT NULL,
  `base1` int(2) NOT NULL,
  `base2` int(2) DEFAULT NULL,
  `base3` int(2) DEFAULT NULL,
  `folioPedido` int(8) NOT NULL,
  `costo` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuenta`
--

CREATE TABLE `cuenta` (
  `no_cuenta` bigint(20) NOT NULL,
  `id_cliente` int(10) NOT NULL,
  `col` tinytext CHARACTER SET utf8mb4 NOT NULL,
  `mun` tinytext CHARACTER SET utf8mb4 NOT NULL,
  `calle` tinytext CHARACTER SET utf8mb4 NOT NULL,
  `no_int` int(5) NOT NULL,
  `banco` tinytext CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `cuenta`
--

INSERT INTO `cuenta` (`no_cuenta`, `id_cliente`, `col`, `mun`, `calle`, `no_int`, `banco`) VALUES
(586923635241124956, 1, 'Galaxia', 'Cuautitlán Izcalli', 'Laureles', 272, 'Santander');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id_empleado` int(10) NOT NULL,
  `nom` tinytext CHARACTER SET utf8mb4 NOT NULL,
  `ap` tinytext CHARACTER SET utf8mb4 NOT NULL,
  `am` tinytext CHARACTER SET utf8mb4 NOT NULL,
  `tel` bigint(10) NOT NULL,
  `id_correo` varchar(45) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id_empleado`, `nom`, `ap`, `am`, `tel`, `id_correo`) VALUES
(1, 'Valeria', 'Hernandez', 'Lopez', 5623984512, 'empleado@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id_estado` int(11) NOT NULL,
  `estado` varchar(25) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id_estado`, `estado`) VALUES
(1, 'En preparaci?n'),
(2, 'En camino'),
(3, 'Entregado'),
(4, 'Cancelado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `frutas`
--

CREATE TABLE `frutas` (
  `id_fruta` int(2) NOT NULL,
  `fruta` varchar(30) CHARACTER SET utf8mb4 NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `frutas`
--

INSERT INTO `frutas` (`id_fruta`, `fruta`, `estado`) VALUES
(1, 'Fresa Natural/Crema', 1),
(2, 'Durazno Natural/Crema', 1),
(3, 'Uvas con Crema', 1),
(4, 'Platano Natural', 1),
(5, 'Pi?a Natural', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingredientes`
--

CREATE TABLE `ingredientes` (
  `id_ingrediente` int(2) NOT NULL,
  `ingrediente` varchar(15) CHARACTER SET utf8mb4 NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `ingredientes`
--

INSERT INTO `ingredientes` (`id_ingrediente`, `ingrediente`, `estado`) VALUES
(1, 'Jam?n', 1),
(2, 'Queso', 1),
(3, 'Pepperoni', 1),
(4, 'At?n', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jefes`
--

CREATE TABLE `jefes` (
  `id_jefe` int(11) NOT NULL,
  `nom` tinytext CHARACTER SET utf8mb4 NOT NULL,
  `ap` tinytext CHARACTER SET utf8mb4 NOT NULL,
  `am` tinytext CHARACTER SET utf8mb4 NOT NULL,
  `tel` bigint(10) NOT NULL,
  `id_correo` varchar(45) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `jefes`
--

INSERT INTO `jefes` (`id_jefe`, `nom`, `ap`, `am`, `tel`, `id_correo`) VALUES
(2, 'Carlos', 'Mendoza', 'R?os', 5689745255, 'jefe@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `folio` int(8) NOT NULL,
  `modo` varchar(35) CHARACTER SET utf8mb4 NOT NULL,
  `mesa` int(3) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `total` int(8) NOT NULL,
  `id_cliente` int(10) NOT NULL,
  `id_estado` int(1) NOT NULL,
  `aclaraciones` varchar(250) CHARACTER SET utf8mb4 DEFAULT NULL,
  `tiempoAprox` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`folio`, `modo`, `mesa`, `fecha`, `hora`, `total`, `id_cliente`, `id_estado`, `aclaraciones`, `tiempoAprox`) VALUES
(30133378, 'En el restaurante', 1, '2026-11-22', '23:23:08', 250, 1, 4, 'Sin Lechuga ni jitomate por favor.', 15),
(72342807, 'En el restaurante', 10, '2026-11-22', '00:44:12', 203, 1, 3, 'Sin mucha crema los duraznos.', 15),
(91483242, 'En el restaurante', 5, '2026-11-21', '21:56:42', 353, 1, 4, NULL, 15),
(92693992, 'En el restaurante', 5, '2026-11-21', '21:56:42', 353, 1, 4, NULL, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_bebidas`
--

CREATE TABLE `pedido_bebidas` (
  `id_pebe` int(11) NOT NULL,
  `id_pedido` int(8) NOT NULL,
  `id_bebida` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_bebidascal`
--

CREATE TABLE `pedido_bebidascal` (
  `id_pebecal` int(11) NOT NULL,
  `id_pedido` int(8) NOT NULL,
  `id_bebidaCal` int(1) NOT NULL,
  `cantidad` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `pedido_bebidascal`
--

INSERT INTO `pedido_bebidascal` (`id_pebecal`, `id_pedido`, `id_bebidaCal`, `cantidad`) VALUES
(1, 91483242, 1, 1),
(2, 92693992, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_crepadul`
--

CREATE TABLE `pedido_crepadul` (
  `id_pecrep` int(11) NOT NULL,
  `id_pedido` int(8) NOT NULL,
  `id_crepaDul` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_crepasal`
--

CREATE TABLE `pedido_crepasal` (
  `id_pecrep` int(11) NOT NULL,
  `id_pedido` int(8) NOT NULL,
  `id_crepaSal` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_platillo`
--

CREATE TABLE `pedido_platillo` (
  `id_peplat` int(11) NOT NULL,
  `id_pedido` int(8) NOT NULL,
  `id_platillo` int(5) NOT NULL,
  `cantidad` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `pedido_platillo`
--

INSERT INTO `pedido_platillo` (`id_peplat`, `id_pedido`, `id_platillo`, `cantidad`) VALUES
(1, 91483242, 1, 1),
(2, 91483242, 5, 1),
(3, 91483242, 8, 1),
(4, 92693992, 1, 1),
(5, 92693992, 5, 1),
(6, 92693992, 8, 1),
(7, 72342807, 25, 1),
(8, 72342807, 19, 1),
(9, 72342807, 13, 1),
(10, 30133378, 1, 1),
(11, 30133378, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_postre`
--

CREATE TABLE `pedido_postre` (
  `id_pepos` int(11) NOT NULL,
  `id_pedido` int(8) NOT NULL,
  `id_postre` int(3) NOT NULL,
  `cantidad` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `pedido_postre`
--

INSERT INTO `pedido_postre` (`id_pepos`, `id_pedido`, `id_postre`, `cantidad`) VALUES
(1, 72342807, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `platillos`
--

CREATE TABLE `platillos` (
  `id_platillo` int(5) NOT NULL,
  `comida` varchar(30) CHARACTER SET utf8mb4 NOT NULL,
  `tipo` varchar(30) CHARACTER SET utf8mb4 NOT NULL,
  `descripcion` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `costo` int(5) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `tiempo` int(3) NOT NULL,
  `imagen` varchar(25) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `platillos`
--

INSERT INTO `platillos` (`id_platillo`, `comida`, `tipo`, `descripcion`, `costo`, `estado`, `tiempo`, `imagen`) VALUES
(1, 'Chispa Adecuada', 'Hamburguesas', 'Pan brioche, 125 gr carne, 110 gr camarón y Q. manchego', 125, 1, 15, 'chispa.jpg'),
(2, 'Huesuda', 'Hamburguesas', 'Pan brioche, 110 gr camarón, longaniza y Q. manchego', 125, 0, 12, 'huesuda.jpg'),
(3, 'Long Burger', 'Hamburguesas', 'Pan brioche, 125 gr carne, longaniza y Q. manchego', 105, 1, 15, 'longburger.jpg'),
(4, 'Matador', 'Hamburguesas', 'Pan, boble carne de 125 gr c/u, Q. amarillo y manchego', 105, 1, 18, 'matador.jpg'),
(5, 'Dosis Perfecta', 'Hamburguesas', 'Pan, 110 gr camarón y Q. manchego', 98, 1, 12, 'dosis.jpg'),
(6, 'Ingrata', 'Hamburguesas', 'Pan, 125 gr carne, piña, tocino, jamón y Q. manchego', 88, 1, 15, 'ingrata.jpg'),
(7, 'Mentirosa', 'Hamburguesas', 'Pan, pollo y Q. amarillo', 60, 1, 12, 'mentirosa.jpg'),
(8, 'La Flaca', 'Hamburguesas', 'Pan, 125 gr carne y Q. amarillo', 65, 1, 12, 'flaca.jpg'),
(9, 'Tradicionales', 'Hot Rock\'s', 'Pan, salchicha de pavo, tocino y Q. manchego', 65, 1, 8, 'tradicionales.jpg'),
(10, 'Freddy Mercury', 'Hot Rock\'s', 'Pan, salchicha de pavo, longaniza y Q. manchego', 95, 1, 10, 'freddy.jpg'),
(11, 'Especialisimos', 'Hot Rock\'s', 'Pan, salchicha de pavo, 110 gr de camarones y Q. manchego', 115, 1, 12, 'especialismos.jpg'),
(12, 'Papas Fugaz', 'Papas', 'Papas a la francesa', 48, 1, 8, 'papasfugaz.jpg'),
(13, 'Papas mil horas', 'Papas', 'Papas gajo', 58, 1, 10, 'papasmilhoras.jpg'),
(14, 'Salchipulpos', 'Papas', '6 pzas. salchipulpos con papas', 60, 1, 10, 'salchipulpos.jpg'),
(15, 'Alitas Sencillas', 'Para Compartir', '', 85, 1, 15, 'alitas.jpg'),
(16, 'Alitas con Papas', 'Para Compartir', '', 95, 1, 18, 'alitaspapas.jpg'),
(17, 'Costillas Sencillas', 'Para Compartir', '', 95, 1, 20, 'costillas.jpg'),
(18, 'Costillas con Papas', 'Para Compartir', '', 105, 1, 22, 'costillaspapas.jpg'),
(19, 'Boneless', 'Para Compartir', '5 pzas. con papas', 85, 1, 15, 'boneless.jpg'),
(20, 'Palomitas de Pollo', 'Para Compartir', '20 pzas. con papas', 73, 1, 12, 'palomitaspollo.jpg'),
(21, 'Nugguets', 'Para Compartir', '6 pzas. con papas', 55, 1, 10, 'nugguets.jpg'),
(22, 'Nachos', 'Para Compartir', '', 55, 1, 8, 'nachos.jpg'),
(23, 'Malteadas', 'Nuestras Bebidas', '', 70, 1, 5, 'malteadas.jpg'),
(24, 'Frappes', 'Nuestras Bebidas', '', 68, 1, 6, 'frappes.jpg'),
(25, 'Refrescos', 'Nuestras Bebidas', '', 25, 1, 2, 'refrescos.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `postres`
--

CREATE TABLE `postres` (
  `id_postre` int(3) NOT NULL,
  `postre` varchar(30) CHARACTER SET utf8mb4 NOT NULL,
  `costo` int(4) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `tiempo` int(2) NOT NULL,
  `imagen` varchar(25) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `postres`
--

INSERT INTO `postres` (`id_postre`, `postre`, `costo`, `estado`, `tiempo`, `imagen`) VALUES
(1, 'Fresas con crema', 35, 0, 5, 'fresas.jpg'),
(2, 'Duraznos con crema', 35, 1, 5, 'duraznos.jpg'),
(3, 'Uvas con crema', 35, 1, 5, 'uvas.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salsas`
--

CREATE TABLE `salsas` (
  `id_salsa` int(2) NOT NULL,
  `salsa` varchar(30) CHARACTER SET utf8mb4 NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `salsas`
--

INSERT INTO `salsas` (`id_salsa`, `salsa`, `estado`) VALUES
(1, 'BBQ', 1),
(2, 'Bufalo', 1),
(3, 'Jamaica Tajin', 1),
(4, 'Leamon Papper', 1),
(5, 'Blue Berry Morita', 1),
(6, 'Pi?a Moztaza', 1),
(7, 'Frutos Rojos', 1),
(8, 'Tamarindo Morita', 1),
(9, 'Mango Habanero', 1),
(10, 'Zarzamora Chipotle', 1),
(11, 'Fuego', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `toppingprem`
--

CREATE TABLE `toppingprem` (
  `id_topPrem` int(2) NOT NULL,
  `topping` varchar(35) CHARACTER SET utf8mb4 NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `toppingprem`
--

INSERT INTO `toppingprem` (`id_topPrem`, `topping`, `estado`) VALUES
(1, 'Helado de Fresa', 1),
(2, 'Helado de Chocolate', 1),
(3, 'Helado de Vainilla', 1),
(4, 'Galleta Oreo', 1),
(5, 'Kinder Delice', 1),
(6, 'Kinder Bueno', 1),
(7, 'Ferrero Rocher', 1),
(8, 'Conejito Turin', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `toppings`
--

CREATE TABLE `toppings` (
  `id_topping` int(3) NOT NULL,
  `topping` varchar(30) CHARACTER SET utf8mb4 NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `toppings`
--

INSERT INTO `toppings` (`id_topping`, `topping`, `estado`) VALUES
(1, 'Chispas de Chocolate', 1),
(2, 'Nuez', 1),
(3, 'M&M\'s', 1),
(4, 'Pasas', 1),
(5, 'Lunetas de Yogurt', 1),
(6, 'Granillo de Chocolate', 1),
(7, 'Granillo Colores', 1),
(8, 'Cereza', 1),
(9, 'Amaranto', 1),
(10, 'Coco Rallado', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `correo` varchar(45) CHARACTER SET utf8mb4 NOT NULL,
  `pass` varchar(12) CHARACTER SET utf8mb4 NOT NULL,
  `tipo_usuario` varchar(10) CHARACTER SET utf8mb4 NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`correo`, `pass`, `tipo_usuario`, `estado`) VALUES
('empleado@gmail.com', 'Emple2007/', 'empleado', 0),
('gaby@gmail.com', 'Gaby2007/', 'usuario', 0),
('jefe@gmail.com', 'Jefe2007/', 'jefe', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bases`
--
ALTER TABLE `bases`
  ADD PRIMARY KEY (`id_base`);

--
-- Indices de la tabla `bebidas`
--
ALTER TABLE `bebidas`
  ADD PRIMARY KEY (`id_bebida`);

--
-- Indices de la tabla `bebidascal`
--
ALTER TABLE `bebidascal`
  ADD PRIMARY KEY (`id_bebidaCal`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `id_correo` (`id_correo`);

--
-- Indices de la tabla `crepasal`
--
ALTER TABLE `crepasal`
  ADD PRIMARY KEY (`id_crepaSal`),
  ADD KEY `ingre1` (`ingre1`),
  ADD KEY `ingre2` (`ingre2`),
  ADD KEY `ingre3` (`ingre3`);

--
-- Indices de la tabla `crepasdulces`
--
ALTER TABLE `crepasdulces`
  ADD PRIMARY KEY (`id_crepaDul`),
  ADD KEY `fruta` (`fruta`),
  ADD KEY `toppingPrem` (`toppingPrem`),
  ADD KEY `topping` (`topping`),
  ADD KEY `base1` (`base1`),
  ADD KEY `base2` (`base2`),
  ADD KEY `base3` (`base3`),
  ADD KEY `folioPedido` (`folioPedido`);

--
-- Indices de la tabla `cuenta`
--
ALTER TABLE `cuenta`
  ADD PRIMARY KEY (`no_cuenta`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id_empleado`),
  ADD KEY `id_correo` (`id_correo`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `frutas`
--
ALTER TABLE `frutas`
  ADD PRIMARY KEY (`id_fruta`);

--
-- Indices de la tabla `ingredientes`
--
ALTER TABLE `ingredientes`
  ADD PRIMARY KEY (`id_ingrediente`);

--
-- Indices de la tabla `jefes`
--
ALTER TABLE `jefes`
  ADD PRIMARY KEY (`id_jefe`),
  ADD KEY `id_correo` (`id_correo`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`folio`),
  ADD KEY `id_estado` (`id_estado`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `pedido_bebidas`
--
ALTER TABLE `pedido_bebidas`
  ADD PRIMARY KEY (`id_pebe`),
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `id_bebida` (`id_bebida`);

--
-- Indices de la tabla `pedido_bebidascal`
--
ALTER TABLE `pedido_bebidascal`
  ADD PRIMARY KEY (`id_pebecal`),
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `id_bebidaCal` (`id_bebidaCal`);

--
-- Indices de la tabla `pedido_crepadul`
--
ALTER TABLE `pedido_crepadul`
  ADD PRIMARY KEY (`id_pecrep`),
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `id_crepaDul` (`id_crepaDul`);

--
-- Indices de la tabla `pedido_crepasal`
--
ALTER TABLE `pedido_crepasal`
  ADD PRIMARY KEY (`id_pecrep`),
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `id_crepaSal` (`id_crepaSal`);

--
-- Indices de la tabla `pedido_platillo`
--
ALTER TABLE `pedido_platillo`
  ADD PRIMARY KEY (`id_peplat`),
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `id_platillo` (`id_platillo`);

--
-- Indices de la tabla `pedido_postre`
--
ALTER TABLE `pedido_postre`
  ADD PRIMARY KEY (`id_pepos`),
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `id_postre` (`id_postre`);

--
-- Indices de la tabla `platillos`
--
ALTER TABLE `platillos`
  ADD PRIMARY KEY (`id_platillo`);

--
-- Indices de la tabla `postres`
--
ALTER TABLE `postres`
  ADD PRIMARY KEY (`id_postre`);

--
-- Indices de la tabla `salsas`
--
ALTER TABLE `salsas`
  ADD PRIMARY KEY (`id_salsa`);

--
-- Indices de la tabla `toppingprem`
--
ALTER TABLE `toppingprem`
  ADD PRIMARY KEY (`id_topPrem`);

--
-- Indices de la tabla `toppings`
--
ALTER TABLE `toppings`
  ADD PRIMARY KEY (`id_topping`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bases`
--
ALTER TABLE `bases`
  MODIFY `id_base` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `bebidas`
--
ALTER TABLE `bebidas`
  MODIFY `id_bebida` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de la tabla `bebidascal`
--
ALTER TABLE `bebidascal`
  MODIFY `id_bebidaCal` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `crepasal`
--
ALTER TABLE `crepasal`
  MODIFY `id_crepaSal` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `crepasdulces`
--
ALTER TABLE `crepasdulces`
  MODIFY `id_crepaDul` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id_empleado` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `frutas`
--
ALTER TABLE `frutas`
  MODIFY `id_fruta` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `ingredientes`
--
ALTER TABLE `ingredientes`
  MODIFY `id_ingrediente` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `jefes`
--
ALTER TABLE `jefes`
  MODIFY `id_jefe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `pedido_bebidas`
--
ALTER TABLE `pedido_bebidas`
  MODIFY `id_pebe` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedido_bebidascal`
--
ALTER TABLE `pedido_bebidascal`
  MODIFY `id_pebecal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `pedido_crepadul`
--
ALTER TABLE `pedido_crepadul`
  MODIFY `id_pecrep` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedido_crepasal`
--
ALTER TABLE `pedido_crepasal`
  MODIFY `id_pecrep` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedido_platillo`
--
ALTER TABLE `pedido_platillo`
  MODIFY `id_peplat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `pedido_postre`
--
ALTER TABLE `pedido_postre`
  MODIFY `id_pepos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `platillos`
--
ALTER TABLE `platillos`
  MODIFY `id_platillo` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `postres`
--
ALTER TABLE `postres`
  MODIFY `id_postre` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `salsas`
--
ALTER TABLE `salsas`
  MODIFY `id_salsa` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `toppingprem`
--
ALTER TABLE `toppingprem`
  MODIFY `id_topPrem` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `toppings`
--
ALTER TABLE `toppings`
  MODIFY `id_topping` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_ibfk_1` FOREIGN KEY (`id_correo`) REFERENCES `usuarios` (`correo`);

--
-- Filtros para la tabla `crepasal`
--
ALTER TABLE `crepasal`
  ADD CONSTRAINT `crepasal_ibfk_1` FOREIGN KEY (`ingre1`) REFERENCES `ingredientes` (`id_ingrediente`),
  ADD CONSTRAINT `crepasal_ibfk_2` FOREIGN KEY (`ingre2`) REFERENCES `ingredientes` (`id_ingrediente`),
  ADD CONSTRAINT `crepasal_ibfk_3` FOREIGN KEY (`ingre3`) REFERENCES `ingredientes` (`id_ingrediente`);

--
-- Filtros para la tabla `crepasdulces`
--
ALTER TABLE `crepasdulces`
  ADD CONSTRAINT `crepasdulces_ibfk_1` FOREIGN KEY (`fruta`) REFERENCES `frutas` (`id_fruta`),
  ADD CONSTRAINT `crepasdulces_ibfk_2` FOREIGN KEY (`toppingPrem`) REFERENCES `toppingprem` (`id_topPrem`),
  ADD CONSTRAINT `crepasdulces_ibfk_3` FOREIGN KEY (`topping`) REFERENCES `toppings` (`id_topping`),
  ADD CONSTRAINT `crepasdulces_ibfk_4` FOREIGN KEY (`base1`) REFERENCES `bases` (`id_base`),
  ADD CONSTRAINT `crepasdulces_ibfk_5` FOREIGN KEY (`base2`) REFERENCES `bases` (`id_base`),
  ADD CONSTRAINT `crepasdulces_ibfk_6` FOREIGN KEY (`base3`) REFERENCES `bases` (`id_base`),
  ADD CONSTRAINT `crepasdulces_ibfk_7` FOREIGN KEY (`folioPedido`) REFERENCES `pedidos` (`folio`);

--
-- Filtros para la tabla `cuenta`
--
ALTER TABLE `cuenta`
  ADD CONSTRAINT `cuenta_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`);

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `empleados_ibfk_1` FOREIGN KEY (`id_correo`) REFERENCES `usuarios` (`correo`);

--
-- Filtros para la tabla `jefes`
--
ALTER TABLE `jefes`
  ADD CONSTRAINT `jefes_ibfk_1` FOREIGN KEY (`id_correo`) REFERENCES `usuarios` (`correo`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_estado`) REFERENCES `estados` (`id_estado`),
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`);

--
-- Filtros para la tabla `pedido_bebidas`
--
ALTER TABLE `pedido_bebidas`
  ADD CONSTRAINT `pedido_bebidas_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`folio`),
  ADD CONSTRAINT `pedido_bebidas_ibfk_2` FOREIGN KEY (`id_bebida`) REFERENCES `bebidas` (`id_bebida`);

--
-- Filtros para la tabla `pedido_bebidascal`
--
ALTER TABLE `pedido_bebidascal`
  ADD CONSTRAINT `pedido_bebidascal_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`folio`),
  ADD CONSTRAINT `pedido_bebidascal_ibfk_2` FOREIGN KEY (`id_bebidaCal`) REFERENCES `bebidascal` (`id_bebidaCal`);

--
-- Filtros para la tabla `pedido_crepadul`
--
ALTER TABLE `pedido_crepadul`
  ADD CONSTRAINT `pedido_crepadul_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`folio`),
  ADD CONSTRAINT `pedido_crepadul_ibfk_2` FOREIGN KEY (`id_crepaDul`) REFERENCES `crepasdulces` (`id_crepaDul`);

--
-- Filtros para la tabla `pedido_crepasal`
--
ALTER TABLE `pedido_crepasal`
  ADD CONSTRAINT `pedido_crepasal_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`folio`),
  ADD CONSTRAINT `pedido_crepasal_ibfk_2` FOREIGN KEY (`id_crepaSal`) REFERENCES `crepasal` (`id_crepaSal`);

--
-- Filtros para la tabla `pedido_platillo`
--
ALTER TABLE `pedido_platillo`
  ADD CONSTRAINT `pedido_platillo_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`folio`),
  ADD CONSTRAINT `pedido_platillo_ibfk_2` FOREIGN KEY (`id_platillo`) REFERENCES `platillos` (`id_platillo`);

--
-- Filtros para la tabla `pedido_postre`
--
ALTER TABLE `pedido_postre`
  ADD CONSTRAINT `pedido_postre_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`folio`),
  ADD CONSTRAINT `pedido_postre_ibfk_2` FOREIGN KEY (`id_postre`) REFERENCES `postres` (`id_postre`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
