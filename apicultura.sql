-- Author: Nelson Blanco Charro
-- version 1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de datos: abejas
--
CREATE DATABASE IF NOT EXISTS abejas DEFAULT CHARACTER SET latin1 COLLATE latin1_spanish_ci;
USE abejas;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla apicultura
--

DROP TABLE IF EXISTS apicultura;
CREATE TABLE IF NOT EXISTS apicultura (
  id_articulo INT(6) unsigned NOT NULL AUTO_INCREMENT,
  Nombre VARCHAR(200) NOT NULL,
  Cantidad INT(6) DEFAULT NULL,
  Precio DECIMAL(10,2) DEFAULT NULL,
  Pesog DECIMAL(10,2) DEFAULT NULL,
  Descripcion VARCHAR(200) DEFAULT NULL,
  Tipo VARCHAR(200) DEFAULT NULL,
  Imagen VARCHAR(200) DEFAULT NULL,
  PRIMARY KEY (id_articulo)
) engine=innodb AUTO_INCREMENT=6;

--
-- Volcado de datos para la tabla `apicultura`
--

INSERT INTO `apicultura` (`id_articulo`, `Nombre`, `Cantidad`, `Precio`, `Pesog`, `Descripcion`, `Tipo`, `Imagen`) VALUES
(1, 'Miel de castaña', 50, 29.99, 1000, 'Envase con miel de castaña de 1Kg', 'miel', 'mielCastano.jpg'),
(2, 'Miel de romero', 5, 19.99, 500, 'Envase con miel de romero de 500g', 'miel', 'mielRomero.jpg'),
(3, 'Miel de azahar', 33, 25.95, 1000, 'Envase con miel de azahar de 1Kg', 'miel', 'mielAzahar.jpg'),
(4, 'Miel de aguacate', 14, 33.5, 1000, 'Envase con miel de aguacate de 1Kg', 'miel', 'mielAguacate.png'),
(5, 'Miel de brezo', 60, 12, 500, 'Envase con miel de brezo de 500g', 'miel', 'mielBrezo.jpg'),
(6, 'Miel de lavanda', 22, 18.5, 500, 'Envase con miel de lavanda de 500g', 'miel', 'mielLavanda.jpg'),
(7, 'Miel de eucalipto', 19, 32.50, 1000, 'Envase con miel de eucalipto de 1Kg', 'miel', 'mielEucalipto.jpg'),
(8, 'Miel de tomillo', 23, 19.99, 500, 'Envase con miel de tomillo de 500g', 'miel', 'mielTomillo.jpg'),
(9, 'Miel de milflores', 48, 25.95, 1000, 'Envase con miel de tomillo de 1Kg', 'miel', 'mielMilflores.jpg'),

(10, 'Jalea real fresca', 8, 7.70, 20, 'Jalea Real fresca y pura de abeja en formato de 20 gramos', 'jalea real', 'jaleaReal20.png'),
(11, 'Jalea real fresca', 4, 75, 1000, 'Jalea Real fresca y pura de abeja en formato de 1 Kg', 'jalea real', 'jaleaReal1000.png'),

(12, 'Propoleo en spray', 7, 10.9, 20, 'Propoleo ecologico en formato de spray bucal 20 mL', 'propoleo', 'propoleoSpray.png'),
(13, 'Propoleo masticable', 12, 12.75, 50, 'Propoleo puro ecologico masticable', 'propoleo', 'propoleoMasticable.png'),
(14, 'Gominolas de propoleo', 15, 5.3, 50, 'Gominolas de propoleo y naranja. Sin azúcares añadidos. Caja con 45 gominolas.', 'propoleo', 'propoleoGominolas.png'),
(15, 'Jarabe de garganta con propoleo', 6, 12.9, 145, 'Jarabe de propoleo ecologico en formato de 145 mL', 'propoleo', 'propoleoJarabe.png'),

(16, 'Polen de abeja', 17, 5.95, 20, 'Polen de abeja 100% natural en formato de 200 g', 'polen', 'polen225.png'),
(17, 'Caja de polen de abeja', 3, 480, 25000, 'Polen de abeja 100% natural en formato de caja de 25 Kg', 'polen', 'polen25000.png');

