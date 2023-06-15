-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-06-2023 a las 19:59:53
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dw3_cagnoni_castrogamero_ferrari`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `categoria_id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`categoria_id`, `nombre`) VALUES
(1, 'Celulares'),
(2, 'Relojes'),
(3, 'Tablets'),
(4, 'Cámaras'),
(5, 'Computadoras');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `producto_id` int(10) UNSIGNED NOT NULL,
  `vendedor_fk` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` float NOT NULL,
  `stock` int(11) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `imagen_desc` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`producto_id`, `vendedor_fk`, `nombre`, `descripcion`, `precio`, `stock`, `imagen`, `imagen_desc`) VALUES
(6, 1, 'Iphone 12', 'El iPhone 12 tiene una espectacular pantalla Super Retina XDR de 6.1 pulgadas. Un frente de Ceramic Shield, cuatro veces más resistente a las caídas. Modo Noche en todas las cámaras, para que puedas tomar fotos increíbles con poca luz. Grabación, edición y reproducción de video en Dolby Vision con calidad cinematográfica. Y el potente chip A14 Bionic. Además, es compatible con los nuevos accesorios MagSafe, que se acoplan fácilmente a tu iPhone y permiten una carga inalámbrica más rápida.', 167610, 80, 'iphone-12.png', 'Imagen descriptiva de Iphone 12'),
(7, 2, 'Galaxy Watch 5', 'Destinado para fines generales de bienestar y estado físico solamente. No está diseñado para su uso en la detección, diagnóstico o tratamiento de cualquier condición médica o trastorno del sueño. Las medidas son solo para su referencia personal.', 116800, 35, 'img/products/reloj-samsung.png', 'Imagen descriptiva de Galaxy Watch 5'),
(8, 3, 'Iphone 14 Pro Max', 'El iPhone 14 Pro Max te permite captar detalles increíbles gracias a su cámara gran angular de 48 MP. Además, trae la Dynamic Island y una pantalla siempre activa, para que puedas interactuar con tu iPhone de una forma completamente nueva. Y viene con Detección de Choques, una funcionalidad de seguridad que pide ayuda cuando no estás en condiciones de hacerlo.', 210800, 120, 'img/products/iphone-14.png', 'Imagen descriptiva de Iphone 14 Pro Max'),
(9, 4, 'Ipad Pro 12.9', 'Este producto combina la potencia y la capacidad de una computadora con la versatilidad y facilidad de uso que solo un iPad puede brindar. Realizar varias tareas a la vez, como editar documentos mientras buscas información en internet o sacarte una selfie, es sumamente sencillo.', 120580, 100, 'img/products/ipad-pro.png', 'Imagen descriptiva de Ipad Pro'),
(10, 5, 'Iphone X', 'El Apple iPhone X es una demostración de fuerza de Apple, mostrando lo que es capaz de hacer y para celebrar los 10 años del iPhone. El iPhone X cuenta con una pantalla de 5.8 pulgadas que abarca todo el frente del teléfono, dejando un espacio arriba para acomodar todos los sensores que contribuyen a Face ID, el nuevo método de desbloqueo por rostro, ya que el botón Touch ID desaparece.', 144300, 90, 'img/products/iphone-x.png', 'Imagen descriptiva de Iphone X'),
(11, 1, 'Camara Sony Mirrorless', 'La a7 II es la primera cámara de fotograma completo en el mundo. Se encuentra entre las cámaras digitales con lentes intercambiables que cuentan con un sensor de imágenes de fotograma completo de 35 mm. A partir de noviembre de 2014, según la investigación realizada por Sony.', 54300, 20, 'img/products/camara-sony.png', 'Imagen descriptiva de Camara Sony Mirrorless'),
(12, 2, 'Apple Watch SE', 'El nuevo Apple Watch SE tiene la misma pantalla Retina grande que los Relojes Series 6, para que puedas ver aún más de un vistazo. Sensores avanzados para registrar todos tus objetivos de entrenamiento. E increíbles funciones para mantenerte sano y seguro.', 74500, 35, 'img/products/reloj-apple.png', 'Imagen descriptiva de Apple Watch SE'),
(13, 3, 'Macbook Pro', 'La nueva MacBook Pro ofrece a los usuarios más profesionales un rendimiento revolucionario. Elige entre el chip M1 Pro o el aún más potente M1 Max para resolver las tareas profesionales más exigentes con una excepcional duración de la batería (1). Además, la MacBook Pro trae una espectacular pantalla Liquid Retina XDR de 16 pulgadas y puertos avanzados para sacarle más provecho que nunca.', 220300, 70, 'img/products/macbook-pro.png', 'Imagen descriptiva de Macbook Pro'),
(14, 4, 'Imac Pro', 'La iMac Pro es una computadora de escritorio todo-en-uno diseñada por Apple para usuarios profesionales que requieren un alto rendimiento en tareas de edición de video, animación, diseño gráfico y otras aplicaciones exigentes. Cuenta con una pantalla Retina 5K de 27 pulgadas, procesador Intel Xeon de hasta 18 núcleos, memoria RAM de hasta 256 GB y almacenamiento SSD de hasta 4 TB. Además, incorpora una tarjeta gráfica Radeon Pro Vega con hasta 16 GB de memoria HBM2.', 290560, 40, 'img/products/imac-pro.png', 'Imagen descriptiva de Imac Pro'),
(15, 5, 'Canon EOS 500D', 'La Canon EOS 500D es una cámara réflex digital de nivel medio que ofrece una excelente calidad de imagen y una gran variedad de características avanzadas. Esta cámara cuenta con un sensor CMOS de 15.1 megapíxeles y un sistema de enfoque automático de 9 puntos que permite un enfoque rápido y preciso en una amplia variedad de situaciones.', 390760, 15, 'img/products/camara-canon.png', 'Imagen descriptiva de Camara Canon'),
(16, 1, 'Samsung Galaxy S7', 'Esta tablet Samsung es la compañera ideal, con capacidad de sobra para cada una de tus actividades. El diseño delgado, compacto y portátil, con facilidad para sostener en una mano, lo convierte en una combinación perfecta de rendimiento y versatilidad.', 230460, 30, 'img/products/tablet-samsung.png', 'Imagen descriptiva de Tablet Samsung Galaxy S7'),
(17, 2, 'Galaxy S23 Ultra', 'Samsung Galaxy S23 Ultra con un procesador Octa-Core (3.36GHz, 2.8GHz, 2GHz) para que estés al día con todas las aplicaciones y juegos de última generación. Descubre todas las posibilidades para tus fotos, tanto de día como de noche, con la cámara de 200+10+10 MP. Memoria interna de 512 GB.', 360780, 100, 'img/products/galaxy-ultra.png', 'Imagen descriptiva de Galaxy S23 Ultra');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_tienen_categorias`
--

CREATE TABLE `productos_tienen_categorias` (
  `producto_fk` int(10) UNSIGNED NOT NULL,
  `categoria_fk` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `productos_tienen_categorias`
--

INSERT INTO `productos_tienen_categorias` (`producto_fk`, `categoria_fk`) VALUES
(6, 1),
(7, 2),
(8, 1),
(9, 3),
(10, 1),
(11, 4),
(12, 2),
(13, 5),
(14, 5),
(15, 4),
(16, 3),
(17, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vendedores`
--

CREATE TABLE `vendedores` (
  `vendedor_id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(60) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `vendedores`
--

INSERT INTO `vendedores` (`vendedor_id`, `nombre`, `email`, `password`) VALUES
(1, 'TechZone', 'techzone@gmail.com', 'techzone123'),
(2, 'DigitalWave', 'digitalwave@gmail.com', 'digitalwave123'),
(3, 'iPoint', 'ipoint@gmail.com', 'ipoint123'),
(4, 'CyberGeek', 'cybergeek@gmail.com', 'cybergeek123'),
(5, 'CodeNinja', 'codeninja@gmail.com', 'codeninja123');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`categoria_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`producto_id`),
  ADD KEY `fk_productos_vendedores_idx` (`vendedor_fk`);

--
-- Indices de la tabla `productos_tienen_categorias`
--
ALTER TABLE `productos_tienen_categorias`
  ADD PRIMARY KEY (`producto_fk`,`categoria_fk`),
  ADD KEY `fk_productos_has_categorias_categorias1_idx` (`categoria_fk`),
  ADD KEY `fk_productos_has_categorias_productos1_idx` (`producto_fk`);

--
-- Indices de la tabla `vendedores`
--
ALTER TABLE `vendedores`
  ADD PRIMARY KEY (`vendedor_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `categoria_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `producto_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `vendedores`
--
ALTER TABLE `vendedores`
  MODIFY `vendedor_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_productos_vendedores` FOREIGN KEY (`vendedor_fk`) REFERENCES `vendedores` (`vendedor_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `productos_tienen_categorias`
--
ALTER TABLE `productos_tienen_categorias`
  ADD CONSTRAINT `fk_productos_has_categorias_categorias1` FOREIGN KEY (`categoria_fk`) REFERENCES `categorias` (`categoria_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_productos_has_categorias_productos1` FOREIGN KEY (`producto_fk`) REFERENCES `productos` (`producto_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
