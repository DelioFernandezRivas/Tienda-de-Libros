-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-03-2021 a las 15:51:56
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `viviroutrasvidas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro_alquilado3`
--

CREATE TABLE `libro_alquilado3` (
  `ID` int(255) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  `editorial` varchar(255) NOT NULL,
  `cantidade` int(11) NOT NULL,
  `foto` char(255) NOT NULL,
  `libro` char(255) NOT NULL,
  `usuario` varchar(24) NOT NULL,
  `pagina_web` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `libro_alquilado3`
--

INSERT INTO `libro_alquilado3` (`ID`, `titulo`, `descripcion`, `editorial`, `cantidade`, `foto`, `libro`, `usuario`, `pagina_web`) VALUES
(0, 'El Último Deseo', 'Geralt de Rivia, brujo y mutante sobrehumano, se gana la vida como cazador de monstruos en una tierra de magia y maravilla: con sus dos espadas al hombro —la de acero para hombres, y la de plata para bestias— da cuenta de estriges, mantícoras, grifos, vampiros, quimeras y lobisomes, pero sólo cuando amenazan la paz. Irónico, cínico, descreído y siempre errante, sus pasos le llevan de pueblo en pueblo ofreciendo sus servicios, hallando las más de las veces que los auténticos monstruos se esconden bajo rostros humanos. En su camino sorteará intrigas, elegirá el mal menor, debatirá cuestiones de precio, hollará el confín del mundo y realizará su último deseo: así comienzan las aventuras del brujo Geralt de Rivia.', 'Editorial Bibliopolis', 3, 'ImagenesIAW\\El_ultimo_deseo.jpg', 'Librospdf\\El_Ultimo_Deseo-Andrzej_Sapkowski.pdf', 'Pedro', 1),
(1, 'La Espada Del Destino', 'El esperado regreso de Geralt de Rivia con nuevas aventuras. La vida de un brujo cazador de monstruos no es fácil. Tan pronto puede uno tener que meterse hasta el cuello en un estercolero para eliminar a la bestia carroñera que amenaza la ciudad, intentado no atrapar una infección incurable, como se puede encontrar unido a la cacería de uno de los últimos dragones, en la que la cuestión no es si los cazadores conseguirán matar a la pobre bestia, sino qué pasará cuando tengan que repartirse el botín. Magos, príncipes, estarostas, voievodas, druidas, vexlings, dríadas, juglares y criaturas de todo pelaje pueblan esta tierra, enzarzados en conflictos de supervivencia, codicia y amor, y entre ellos avanza, solitario, el brujo Geralt de Rivia.', 'Editorial Bibliopolis', 2, 'ImagenesIAW\\La_espada_del_destino.jpg', 'Librospdf\\La_Espada_del_Destino-Andrzej_Sapkowski.pdf', 'Pedro', 1),
(2, 'La Sangre de los Elfos', 'En verdad os digo que se acerca el tiempo de la espada y el hacha, la época de la tormenta salvaje. Se acerca el Tiempo del Invierno Blanco y de la Luz Blanca. El Tiempo de la Locura y el Tiempo del Odio, el Tiempo del Fin. El mundo morirá entre la escarcha y resucitará de nuevo junto con el nuevo sol. Resucitará de entre la Antigua Sangre, de Hen Ichaer, de la semilla sembrada. De la semilla que no germina sino que estalla en llamas. ¡Así será! ¡Contemplad las señales! Qué señales sean, yo os diré: primero se derramará sobre la tierra la sangre de los Aen Seidhe, la Sangre de los Elfos…', 'Editorial Bibliopolis', 2, 'ImagenesIAW\\La_Sangre_de_los_Elfos.jpg', 'Librospdf\\La_Sangre_de_los_Elfos-Andrzej_Sapkowski.pdf', 'Pedro', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro_devuelto`
--

CREATE TABLE `libro_devuelto` (
  `ID` int(11) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `cantidade` int(11) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `editorial` varchar(24) DEFAULT NULL,
  `foto` varchar(1000) DEFAULT NULL,
  `libro` char(255) NOT NULL,
  `usuario` varchar(24) NOT NULL,
  `Devolver` int(255) NOT NULL,
  `pagina_web` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `libro_devuelto`
--

INSERT INTO `libro_devuelto` (`ID`, `titulo`, `cantidade`, `descripcion`, `editorial`, `foto`, `libro`, `usuario`, `Devolver`, `pagina_web`) VALUES
(0, 'El Último Deseo', 4, 'Geralt de Rivia, brujo y mutante sobrehumano, se gana la vida como cazador de monstruos en una tierra de magia y maravilla: con sus dos espadas al hombro —la de acero para hombres, y la de plata para bestias— da cuenta de estriges, mantícoras, grifos, vampiros, quimeras y lobisomes, pero sólo cuando amenazan la paz. Irónico, cínico, descreído y siempre errante, sus pasos le llevan de pueblo en pueblo ofreciendo sus servicios, hallando las más de las veces que los auténticos monstruos se esconden bajo rostros humanos. En su camino sorteará intrigas, elegirá el mal menor, debatirá cuestiones de precio, hollará el confín del mundo y realizará su último deseo: así comienzan las aventuras del brujo Geralt de Rivia.', 'Editorial Bibliopolis', 'ImagenesIAW\\El_ultimo_deseo.jpg', 'Librospdf\\El_Ultimo_Deseo-Andrzej_Sapkowski.pdf', 'Pedro', 0, 1),
(1, 'La Espada Del Destino', 1, 'El esperado regreso de Geralt de Rivia con nuevas aventuras. La vida de un brujo cazador de monstruos no es fácil. Tan pronto puede uno tener que meterse hasta el cuello en un estercolero para eliminar a la bestia carroñera que amenaza la ciudad, intentado no atrapar una infección incurable, como se puede encontrar unido a la cacería de uno de los últimos dragones, en la que la cuestión no es si los cazadores conseguirán matar a la pobre bestia, sino qué pasará cuando tengan que repartirse el botín. Magos, príncipes, estarostas, voievodas, druidas, vexlings, dríadas, juglares y criaturas de todo pelaje pueblan esta tierra, enzarzados en conflictos de supervivencia, codicia y amor, y entre ellos avanza, solitario, el brujo Geralt de Rivia.', 'Editorial Bibliopolis', 'ImagenesIAW\\La_espada_del_destino.jpg', 'Librospdf\\La_Espada_del_Destino-Andrzej_Sapkowski.pdf', 'Pedro', 0, 1),
(2, 'La Sangre de los Elfos', 1, 'En verdad os digo que se acerca el tiempo de la espada y el hacha, la época de la tormenta salvaje. Se acerca el Tiempo del Invierno Blanco y de la Luz Blanca. El Tiempo de la Locura y el Tiempo del Odio, el Tiempo del Fin. El mundo morirá entre la escarcha y resucitará de nuevo junto con el nuevo sol. Resucitará de entre la Antigua Sangre, de Hen Ichaer, de la semilla sembrada. De la semilla que no germina sino que estalla en llamas. ¡Así será! ¡Contemplad las señales! Qué señales sean, yo os diré: primero se derramará sobre la tierra la sangre de los Aen Seidhe, la Sangre de los Elfos…', 'Editorial Bibliopolis', 'ImagenesIAW\\La_Sangre_de_los_Elfos.jpg', 'Librospdf\\La_Sangre_de_los_Elfos-Andrzej_Sapkowski.pdf', 'Pedro', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro_para_alquilar`
--

CREATE TABLE `libro_para_alquilar` (
  `ID` int(11) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `cantidade` int(11) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `editorial` varchar(24) DEFAULT NULL,
  `precio` int(11) DEFAULT NULL,
  `foto` char(255) DEFAULT NULL,
  `libro` char(255) NOT NULL,
  `pagina_web` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `libro_para_alquilar`
--

INSERT INTO `libro_para_alquilar` (`ID`, `titulo`, `cantidade`, `descripcion`, `editorial`, `precio`, `foto`, `libro`, `pagina_web`) VALUES
(0, 'El Último Deseo', 496, 'Geralt de Rivia, brujo y mutante sobrehumano, se gana la vida como cazador de monstruos en una tierra de magia y maravilla: con sus dos espadas al hombro —la de acero para hombres, y la de plata para bestias— da cuenta de estriges, mantícoras, grifos, vampiros, quimeras y lobisomes, pero sólo cuando amenazan la paz. Irónico, cínico, descreído y siempre errante, sus pasos le llevan de pueblo en pueblo ofreciendo sus servicios, hallando las más de las veces que los auténticos monstruos se esconden bajo rostros humanos. En su camino sorteará intrigas, elegirá el mal menor, debatirá cuestiones de precio, hollará el confín del mundo y realizará su último deseo: así comienzan las aventuras del brujo Geralt de Rivia.', 'Editorial Bibliopolis', 20, 'ImagenesIAW\\El_ultimo_deseo.jpg', 'Librospdf\\El_Ultimo_Deseo-Andrzej_Sapkowski.pdf', 1),
(1, 'La Espada Del Destino', 497, 'El esperado regreso de Geralt de Rivia con nuevas aventuras. La vida de un brujo cazador de monstruos no es fácil. Tan pronto puede uno tener que meterse hasta el cuello en un estercolero para eliminar a la bestia carroñera que amenaza la ciudad, intentado no atrapar una infección incurable, como se puede encontrar unido a la cacería de uno de los últimos dragones, en la que la cuestión no es si los cazadores conseguirán matar a la pobre bestia, sino qué pasará cuando tengan que repartirse el botín. Magos, príncipes, estarostas, voievodas, druidas, vexlings, dríadas, juglares y criaturas de todo pelaje pueblan esta tierra, enzarzados en conflictos de supervivencia, codicia y amor, y entre ellos avanza, solitario, el brujo Geralt de Rivia.', 'Editorial Bibliopolis', 25, 'ImagenesIAW\\La_espada_del_destino.jpg', 'Librospdf\\La_Espada_del_Destino-Andrzej_Sapkowski.pdf', 1),
(2, 'La Sangre de los Elfos', 497, 'En verdad os digo que se acerca el tiempo de la espada y el hacha, la época de la tormenta salvaje. Se acerca el Tiempo del Invierno Blanco y de la Luz Blanca. El Tiempo de la Locura y el Tiempo del Odio, el Tiempo del Fin. El mundo morirá entre la escarcha y resucitará de nuevo junto con el nuevo sol. Resucitará de entre la Antigua Sangre, de Hen Ichaer, de la semilla sembrada. De la semilla que no germina sino que estalla en llamas. ¡Así será! ¡Contemplad las señales! Qué señales sean, yo os diré: primero se derramará sobre la tierra la sangre de los Aen Seidhe, la Sangre de los Elfos…', 'Editorial Bibliopolis', 30, 'ImagenesIAW\\La_Sangre_de_los_Elfos.jpg', 'Librospdf\\La_Sangre_de_los_Elfos-Andrzej_Sapkowski.pdf', 1),
(3, 'Tiempo de Odio', 500, 'La catástrofe se abate sobre el mundo de Geralt de Rivia. Decir que la conocí sería una exageración. Pienso que, excepto el brujo y la hechicera, nadie la conoció de verdad jamás. Cuando la vi por vez primera no me causó especial impresión, incluso pese a las extraordinarias circunstancias que lo acompañaron. Sé de algunos que han afirmado que al instante, a primera vista, percibieron el hálito de la muerte que seguía a esta muchacha. A mí sin embargo me pareció completamente normal, y ya por entonces sabía yo que no era normal, por eso me esforcé en mirar, descubrir, percibir lo extraordinario en ella. Pero nada vi y nada percibí. Nada que pudiera haber sido señal, presentimiento ni profecía de los trágicos acontecimientos posteriores. Aquéllos de los que fue causa. Y aquéllos que ella misma provocó.', 'Editorial Bibliopolis', 45, 'ImagenesIAW\\Tiempo_de_Odio.jpg', 'Librospdf\\Tiempo_de_Odio-Andrzej_Sapkowski.pdf', 2),
(4, 'Bautismo de Fuego', 500, '«Entonces le dijo la profetisa al brujo: \"Este consejo te doy: ponte botas de yerro, toma en la mano un bastón de yerro. Ve con tus botas de yerro hasta el fin del mundo y por el camino agita el bastón y riega todo con lágrimas. Ve a través de la agua y el fuego, no te detengas ni mires a tu alrededor. Y cuando las almadreñas se te desgasten, cuando el bastón de yerro se deshaga, cuando el viento y el calor te sequen los ojos de tal forma que de ellos ni una lágrima acierte a escapar, entonces, en el fin del mundo, hallarás lo que buscas y lo que amas. Pudiera ser\".»\r\n\r\n\r\n\r\nY el brujo cruzó la agua y el fuego, sin mirar a su alrededor. Pero no se puso botas de yerro ni tomó bastón. Sólo llevó su espada de brujo. No escuchó las palabras de la profetisa. Y bien que hizo, porque era una mala profetisa.', 'Editorial Bibliopolis', 35, 'ImagenesIAW\\Bautismo_de_Fuego.jpg', 'Librospdf\\Bautismo_de_Fuego-Andrzej_Sapkowski.pdf', 2),
(5, 'La Torre de la Golondrina', 500, 'Penúltimo volumen de la saga que ha convulsionado la fantasía. Ciri, convertida en bandolera, se enfrenta al implacable asesino enviado tras ella por el emperador de Nilfgaard. La pequeña bruja es cada vez más mortífera y despiadada… pero tal vez no lo suficiente. Mientras tanto, la compañía de Geralt se interna en el sur, y Yennefer rastrea el océano en busca del escondite del mago traidor Vilgefortz, que puede estar relacionado con la muerte de los padres de Ciri.', 'Editorial Bibliopolis', 40, 'ImagenesIAW\\La_torre_de_la_golondrina.jpg', 'Librospdf\\La_Torre_de_la_Golondrina-Andrzej_Sapkowski.pdf', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro_venta`
--

CREATE TABLE `libro_venta` (
  `ID` smallint(255) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `cantidade` int(11) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `editorial` varchar(24) DEFAULT NULL,
  `precio` int(11) DEFAULT NULL,
  `foto` varchar(1000) DEFAULT NULL,
  `pagina_web` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `libro_venta`
--

INSERT INTO `libro_venta` (`ID`, `titulo`, `cantidade`, `descripcion`, `editorial`, `precio`, `foto`, `pagina_web`) VALUES
(330, 'Libro10', 499, 'jajajaj', 'xq', 50, 'no se', 1),
(331, 'Libro10', 500, 'jajajaj', 'xq', 50, 'no se', 1),
(332, 'Libro10', 500, 'jajajaj', 'xq', 50, 'no se', 1),
(333, 'Libro10', 500, 'jajajaj', 'xq', 50, 'no se', 2),
(340, 'Libro10', 500, 'jajajaj', 'xq', 50, 'no se', 2),
(341, 'Libro10', 500, 'jajajaj', 'xq', 50, 'no se', 2),
(342, 'Libro10', 500, 'jajajaj', 'xq', 50, 'no se', 3),
(343, 'Libro10', 500, 'jajajaj', 'xq', 50, 'no se', 3),
(344, 'Libro10', 500, 'jajajaj', 'xq', 50, 'no se', 3),
(345, 'Libro10', 500, 'jajajaj', 'xq', 50, 'no se', 4),
(346, 'Libro10', 500, 'jajajaj', 'xq', 50, 'no se', 4),
(347, 'Libro10', 500, 'jajajaj', 'xq', 50, 'no se', 4),
(348, 'Libro10', 500, 'jajajaj', 'xq', 50, 'no se', 5),
(349, 'Libro10', 500, 'jajajaj', 'xq', 50, 'no se', 5),
(350, 'Libro10', 500, 'jajajaj', 'xq', 50, 'no se', 5),
(351, 'Libro10', 500, 'jajajaj', 'xq', 50, 'no se', 6),
(352, 'Libro10', 500, 'jajajaj', 'xq', 50, 'no se', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `novo_rexistro`
--

CREATE TABLE `novo_rexistro` (
  `usuario` varchar(24) NOT NULL,
  `contraseña` varchar(8) DEFAULT NULL,
  `nombre` varchar(60) DEFAULT NULL,
  `direccion` varchar(90) DEFAULT NULL,
  `telefono` int(11) DEFAULT NULL,
  `nifdni` varchar(9) DEFAULT NULL,
  `pagina_web` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `novo_rexistro`
--

INSERT INTO `novo_rexistro` (`usuario`, `contraseña`, `nombre`, `direccion`, `telefono`, `nifdni`, `pagina_web`) VALUES
('Daniel', '1234', ' ', ' ', 0, ' ', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usuario` varchar(24) NOT NULL,
  `contraseña` varchar(8) DEFAULT NULL,
  `nombre` varchar(60) DEFAULT NULL,
  `direccion` varchar(90) DEFAULT NULL,
  `telefono` int(11) DEFAULT NULL,
  `nifdni` varchar(9) DEFAULT NULL,
  `tipo_usuario` char(1) DEFAULT NULL,
  `limite_inicios_sesion` char(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuario`, `contraseña`, `nombre`, `direccion`, `telefono`, `nifdni`, `tipo_usuario`, `limite_inicios_sesion`) VALUES
('Delio', 'Pousada', ' ', '1234', 0, ' ', '1', '0'),
('Juaquin', '1234', ' ', ' ', 0, ' ', '0', '0'),
('Pedro', '4321', ' Nombre', 'hola', 0, ' Nif', '0', '0'),
('Richard', '4321', ' ', ' ', 0, ' ', '0', '0'),
('Rodrigo', '1234', ' ', ' ', 0, ' ', '0', '0');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `libro_alquilado3`
--
ALTER TABLE `libro_alquilado3`
  ADD PRIMARY KEY (`ID`,`usuario`) USING BTREE;

--
-- Indices de la tabla `libro_devuelto`
--
ALTER TABLE `libro_devuelto`
  ADD PRIMARY KEY (`ID`) USING BTREE;

--
-- Indices de la tabla `libro_para_alquilar`
--
ALTER TABLE `libro_para_alquilar`
  ADD PRIMARY KEY (`ID`) USING BTREE;

--
-- Indices de la tabla `libro_venta`
--
ALTER TABLE `libro_venta`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `novo_rexistro`
--
ALTER TABLE `novo_rexistro`
  ADD PRIMARY KEY (`usuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
