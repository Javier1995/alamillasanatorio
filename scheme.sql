CREATE DATABASE alamilla;
USE alamilla;

CREATE TABLE `categorias_medicamentos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias_medicamentos`
--

INSERT INTO `categorias_medicamentos` (`id`, `nombre`) VALUES
(1, 'BAÃƒâ€˜OS'),
(2, 'COLUTORIOS'),
(3, 'COMPRIMIDOS'),
(4, 'ELIXIRES'),
(5, 'GOTAS'),
(6, 'GOTAS NASALES'),
(7, 'INHALADORES'),
(8, 'JARABE'),
(9, 'LOCIONES'),
(11, 'NEBULIZACIONES'),
(12, 'PARCHES TRANDERMICOS'),
(13, 'POLVOS'),
(14, 'POMADAS RECTALES'),
(15, 'SELLOS'),
(16, 'SUPOSITORIOS'),
(17, 'SUSPENSION'),
(18, 'TABLETAS'),
(19, 'CAPSULAS'),
(20, 'SOLUCION INYECTABLE'),
(21, 'SOLUCION ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_niveles`
--

CREATE TABLE `cat_niveles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cat_niveles`
--

INSERT INTO `cat_niveles` (`id`, `nombre`) VALUES
(1, 'ADMINISTRADOR'),
(2, 'VENTA'),
(3, 'ALTA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `corte_cajas`
--

CREATE TABLE `corte_cajas` (
  `id` int(11) NOT NULL,
  `fecha_corte` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lotes`
--

CREATE TABLE `lotes` (
  `cve_lote` varchar(255) NOT NULL,
  `fecha_alta` datetime DEFAULT CURRENT_TIMESTAMP,
  `fecha_caducidad` date NOT NULL,
  `cve_medicamento` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `lotes`
--

INSERT INTO `lotes` (`cve_lote`, `fecha_alta`, `fecha_caducidad`, `cve_medicamento`) VALUES
('135BV060', '2018-11-29 18:32:10', '2020-01-30', '7501385490279'),
('15081812', '2018-11-29 18:26:24', '2018-08-01', '7502001162310'),
('1704', '2018-11-29 17:53:23', '2019-03-01', '7501258205863'),
('17MO61', '2018-11-29 17:57:19', '2018-12-01', '7502216793071'),
('18G170', '2018-11-29 18:23:52', '2020-07-01', '7502216801196'),
('2402201', '2018-11-29 18:41:34', '2019-10-01', '7501122900801'),
('450028', '2018-11-29 18:38:20', '2020-01-01', '7501075718546'),
('5106180563', '2018-11-29 18:43:41', '2020-05-01', '7502213142902'),
('61059', '2018-11-29 18:19:08', '2018-09-01', '7502006922520'),
('62923', '2018-11-29 18:47:12', '2020-01-01', '7841141004198'),
('62924', '2018-11-29 19:22:28', '2035-12-28', '7841141004198'),
('660235', '2018-11-29 18:28:04', '2018-08-01', '7501075714135'),
('C8118', '2018-11-29 18:39:51', '2020-02-01', '7503001007052'),
('I16F249', '2018-11-29 18:34:01', '2019-02-01', '7501125195891'),
('SG18012', '2018-11-29 18:21:20', '2020-07-01', '7502209851160'),
('SH1741', '2018-11-29 18:36:35', '2020-08-01', '7501573903307');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicamentos`
--

CREATE TABLE `medicamentos` (
  `cve_medicamento` varchar(255) NOT NULL,
  `nombre_generico` varchar(255) NOT NULL,
  `nombre_comercial` varchar(255) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `presentacion` varchar(255) DEFAULT NULL,
  `precio_adquisitivo` decimal(15,2) NOT NULL,
  `precio_venta` decimal(15,2) NOT NULL,
  `unidades_caja` int(11) NOT NULL,
  `stock_minimo` int(11) NOT NULL,
  `fecha_alta` datetime DEFAULT CURRENT_TIMESTAMP,
  `id_proveedor` int(11) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `medicamentos`
--

INSERT INTO `medicamentos` (`cve_medicamento`, `nombre_generico`, `nombre_comercial`, `descripcion`, `imagen`, `presentacion`, `precio_adquisitivo`, `precio_venta`, `unidades_caja`, `stock_minimo`, `fecha_alta`, `id_proveedor`, `id_categoria`) VALUES
('7501075714135', 'METAMIZOL SODICO', 'PIRINOVAG', 'NINGUNA', NULL, '500MG', '200.00', '400.00', 10, 3, '2018-11-29 18:28:04', NULL, 18),
('7501075718546', 'BEZAFIBRATO', 'NIBEZVAG', 'NINGUNA', NULL, '200 MG', '200.00', '300.00', 30, 3, '2018-11-29 18:38:20', NULL, 18),
('7501122900801', 'IVERMICTINA', 'IVEXTERM', 'NINGIUNA', NULL, '6 MG', '200.00', '30.00', 4, 2, '2018-11-29 18:41:34', NULL, 18),
('7501125195891', 'AMPICILINA', 'AMPICILINA', 'NINGUNA', NULL, '500 MG', '300.00', '400.00', 12, 3, '2018-11-29 18:34:01', NULL, 20),
('7501258205863', 'CETIRIZINA', 'VISERTRAL', '', NULL, '10MG', '100.00', '156.00', 10, 5, '2018-11-29 17:53:23', NULL, 18),
('7501385490279', 'TRIMETROPRIMA', 'ORMOPRIM', 'NINGUNA', NULL, '80MG/400MG', '45.00', '50.00', 20, 3, '2018-11-29 18:32:10', NULL, 18),
('7501573903307', 'BUTILHIOSCINA', 'BIOMESINA', 'NINGUNA', NULL, '10 MG', '120.20', '200.00', 10, 3, '2018-11-29 18:36:35', NULL, 18),
('7502001162310', 'GENTAMICINA', 'GENTAMICINA', 'NINGUNA', NULL, '160 MG/2ML', '160.00', '700.00', 5, 4, '2018-11-29 18:26:24', NULL, 20),
('7502006922520', 'CLORFENAMINA, FENILEFRINA, PARACETEAMOL', 'BREGAMIN', '', NULL, '15 ML', '54.00', '200.00', 1, 3, '2018-11-29 18:19:08', NULL, 21),
('7502209851160', 'LORATADINA', 'LORATADINA', 'NINGUNA', NULL, '10 MG', '160.00', '170.00', 20, 2, '2018-11-29 18:21:20', NULL, 18),
('7502213142902', 'ATORVASTATINA', 'ATORVASTATINA', 'NINGUNA', NULL, '20 MG', '300.00', '400.00', 20, 2, '2018-11-29 18:43:41', NULL, 18),
('7502216793071', 'ENAPRIL', 'ENAPRIL', 'NINGUN', NULL, '10 MG', '200.00', '300.00', 10, 2, '2018-11-29 17:57:19', NULL, 18),
('7502216801196', 'KETOROLACO', 'KETOROLACO', 'NINGUNO', NULL, '10 MG', '70.00', '80.00', 10, 3, '2018-11-29 18:23:52', NULL, 18),
('7503001007052', 'AMOXICILINA', 'VANDIX', 'NINGUNA', NULL, '500 MG', '200.00', '300.00', 12, 2, '2018-11-29 18:39:51', NULL, 19),
('7841141004198', 'NORFLOXACINO FENAZOPIRIDINA', 'MICTASOL', 'NINGUNA', NULL, '400 MG - 100MG', '200.00', '30.00', 16, 2, '2018-11-29 18:47:12', NULL, 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `operaciones`
--

CREATE TABLE `operaciones` (
  `id` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `descuento` decimal(15,2) DEFAULT NULL,
  `precio` decimal(15,2) DEFAULT NULL,
  `id_tipo_operacion` int(11) DEFAULT NULL,
  `id_medicamento` varchar(255) DEFAULT NULL,
  `id_pedido` int(11) DEFAULT NULL,
  `cve_lote` varchar(255) DEFAULT NULL,
  `fecha_operacion` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `operaciones`
--

INSERT INTO `operaciones` (`id`, `cantidad`, `descuento`, `precio`, `id_tipo_operacion`, `id_medicamento`, `id_pedido`, `cve_lote`, `fecha_operacion`) VALUES
(30, 10, NULL, NULL, 1, '7501258205863', NULL, '1704', '2018-11-29 17:53:23'),
(31, 20, NULL, NULL, 1, '7502216793071', NULL, '17MO61', '2018-11-29 17:57:19'),
(32, 30, NULL, NULL, 1, '7502006922520', NULL, '61059', '2018-11-29 18:19:08'),
(33, 20, NULL, NULL, 1, '7502209851160', NULL, 'SG18012', '2018-11-29 18:21:20'),
(34, 20, NULL, NULL, 1, '7502216801196', NULL, '18G170', '2018-11-29 18:23:52'),
(35, 30, NULL, NULL, 1, '7502001162310', NULL, '15081812', '2018-11-29 18:26:24'),
(36, 30, NULL, NULL, 1, '7501075714135', NULL, '660235', '2018-11-29 18:28:04'),
(37, 40, NULL, NULL, 1, '7501385490279', NULL, '135BV060', '2018-11-29 18:32:10'),
(38, 40, NULL, NULL, 1, '7501125195891', NULL, 'I16F249', '2018-11-29 18:34:01'),
(39, 20, NULL, NULL, 1, '7501573903307', NULL, 'SH1741', '2018-11-29 18:36:35'),
(40, 20, NULL, NULL, 1, '7501075718546', NULL, '450028', '2018-11-29 18:38:20'),
(41, 20, NULL, NULL, 1, '7503001007052', NULL, 'C8118', '2018-11-29 18:39:51'),
(42, 15, NULL, NULL, 1, '7501122900801', NULL, '2402201', '2018-11-29 18:41:34'),
(43, 30, NULL, NULL, 1, '7502213142902', NULL, '5106180563', '2018-11-29 18:43:41'),
(44, 20, NULL, NULL, 1, '7841141004198', NULL, '62923', '2018-11-29 18:47:12'),
(45, 30, NULL, NULL, 1, '7841141004198', NULL, '62924', '2018-11-29 19:22:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `dinero` decimal(15,2) DEFAULT NULL,
  `total` decimal(15,2) DEFAULT NULL,
  `descuento` decimal(15,2) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `id_tipo_operacion` int(11) DEFAULT NULL,
  `id_proveedor` int(11) DEFAULT NULL,
  `id_corte_caja` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `compania` varchar(100) NOT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `telefono1` varchar(100) DEFAULT NULL,
  `telefono2` varchar(100) DEFAULT NULL,
  `fecha_alta` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_operaciones`
--

CREATE TABLE `tipo_operaciones` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_operaciones`
--

INSERT INTO `tipo_operaciones` (`id`, `nombre`) VALUES
(1, 'ENTRADA'),
(2, 'VENTA'),
(3, 'CADUCADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nick` varchar(100) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `bloqueo` tinyint(2) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `id_nivel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nick`, `pass`, `nombre`, `apellidos`, `bloqueo`, `foto`, `id_nivel`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'ALBERTO', 'ALAMILLA MURILLO', 1, 'foto_perfil/ADMINISTRADOR.png', 1),
(4, 'QUIROGA', 'a66c9f6fecfb26f755df609061d8ba38eebf163c', 'JAVIER', 'QUIROGA', 1, 'foto_perfil/VENTA.png', 2);

--
-- Ã�ndices para tablas volcadas
--

--
-- Indices de la tabla `categorias_medicamentos`
--
ALTER TABLE `categorias_medicamentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cat_niveles`
--
ALTER TABLE `cat_niveles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `corte_cajas`
--
ALTER TABLE `corte_cajas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lotes`
--
ALTER TABLE `lotes`
  ADD PRIMARY KEY (`cve_lote`),
  ADD KEY `cve_medicamento` (`cve_medicamento`);

--
-- Indices de la tabla `medicamentos`
--
ALTER TABLE `medicamentos`
  ADD PRIMARY KEY (`cve_medicamento`),
  ADD KEY `id_proveedor` (`id_proveedor`),
  ADD KEY `medicamentos_ibfk_2` (`id_categoria`);

--
-- Indices de la tabla `operaciones`
--
ALTER TABLE `operaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tipo_operacion` (`id_tipo_operacion`),
  ADD KEY `id_medicamento` (`id_medicamento`),
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `cve_lote` (`cve_lote`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tipo_operacion` (`id_tipo_operacion`),
  ADD KEY `id_proveedor` (`id_proveedor`),
  ADD KEY `id_corte_caja` (`id_corte_caja`),
  ADD KEY `pedidos_ibfk_4` (`id_usuario`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_operaciones`
--
ALTER TABLE `tipo_operaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_nivel` (`id_nivel`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias_medicamentos`
--
ALTER TABLE `categorias_medicamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de la tabla `cat_niveles`
--
ALTER TABLE `cat_niveles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `corte_cajas`
--
ALTER TABLE `corte_cajas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `operaciones`
--
ALTER TABLE `operaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tipo_operaciones`
--
ALTER TABLE `tipo_operaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `lotes`
--
ALTER TABLE `lotes`
  ADD CONSTRAINT `lotes_ibfk_1` FOREIGN KEY (`cve_medicamento`) REFERENCES `medicamentos` (`cve_medicamento`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `medicamentos`
--
ALTER TABLE `medicamentos`
  ADD CONSTRAINT `medicamentos_ibfk_1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id`),
  ADD CONSTRAINT `medicamentos_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `categorias_medicamentos` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `operaciones`
--
ALTER TABLE `operaciones`
  ADD CONSTRAINT `operaciones_ibfk_1` FOREIGN KEY (`id_tipo_operacion`) REFERENCES `tipo_operaciones` (`id`),
  ADD CONSTRAINT `operaciones_ibfk_2` FOREIGN KEY (`id_medicamento`) REFERENCES `medicamentos` (`cve_medicamento`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `operaciones_ibfk_3` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id`),
  ADD CONSTRAINT `operaciones_ibfk_4` FOREIGN KEY (`cve_lote`) REFERENCES `lotes` (`cve_lote`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_tipo_operacion`) REFERENCES `tipo_operaciones` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `pedidos_ibfk_3` FOREIGN KEY (`id_corte_caja`) REFERENCES `corte_cajas` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `pedidos_ibfk_4` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_nivel`) REFERENCES `cat_niveles` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
