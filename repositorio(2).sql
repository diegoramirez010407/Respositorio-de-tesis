-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-12-2022 a las 22:42:17
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `repositorio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `idopcion` int(11) NOT NULL,
  `configuracion` varchar(100) NOT NULL,
  `estado` int(2) NOT NULL,
  `referencia` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`idopcion`, `configuracion`, `estado`, `referencia`) VALUES
(1, 'Cuestionario', 1, 'Habilitado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `id_grupo` int(5) NOT NULL,
  `clv_grupo` varchar(255) NOT NULL,
  `clv_materia` varchar(255) NOT NULL,
  `clv_profesor` varchar(255) NOT NULL,
  `totalumnos` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`id_grupo`, `clv_grupo`, `clv_materia`, `clv_profesor`, `totalumnos`) VALUES
(371, 'Proyecto de investigacion', 'Tesis', 'PEREZ GONZALEZ JOSE ARMANDO', 'Alex Ramires Galindo'),
(373, 'Aplicacion Hippo', 'Proyecto', 'ERIKA CORTEZ NAZAR', 'Raul Nava Lopez'),
(374, 'Aplicacion web para descargar facturas automatizadas', 'Tesina', 'VENTURA MARTINEZ DAMIAN', 'Alex Ramires Galindo'),
(375, 'Examen Profesional', 'Examen Profesional', 'MENDOZA MATEO DIANA', 'Lila Karen Velazquez Modesto'),
(376, 'Sistema web para la administracion de area academica TESSFP', 'Proyecto de Investigacion', 'VELAZQUEZ MARTINEZ CRISTIAN', 'Guillermina Reyez Juarez'),
(377, 'Sistema web para la administracion de area academica TESSFP', 'Proyecto de Investigacion', 'ALANIS GONZALEZ EFRAIN', 'Ernesto Segundo Bartolo'),
(378, 'Aplicacion web para el control y monitorio de almacen', 'Proyecto', 'ALBERTO ANTONIO FAUSTINO', 'Brenda Garcia Miranda'),
(379, 'Aplicacion web ara el control y seguimiento de egresados TESSFP', 'Tesis', 'ARCHUNDIA GARCIA GUSTAVO', 'Raul Nava Lopez'),
(380, 'Creacion de pagina we para empresa D-Conta&Fiscal', 'Tesis', 'MARTINEZ REBOLLO ERICA', 'Lila Karen Velazquez Modesto'),
(381, 'Desarrollo de herramienta de software par control de inventario', 'Tesina', 'CONTRERAS ROJAS IVAN GUSTAVO', 'Guillermina Reyez Juarez'),
(382, 'Aseguramieno de calidad de proyectos de TI', 'Proyecto de Investigacion', 'VELAZQUEZ CRISTOBAL JOSE MANUEL', 'Azucena Hernández Crisostomo'),
(383, 'Aseguramieno de calidad de proyectos de TI Modulo 2', 'Proyecto de Investigacion', 'GONZALEZ BALTAZAR JUAN FRANCISCO', 'José Luis Garcí­a Morales'),
(384, 'Marco de gestion de ciberseguridad', 'Proyecto', 'REYES JUAREZ JOSE ALEX', 'Luis Ángel González Flores'),
(385, 'Sistema y control de gestion para clientes empresa ECRI', 'Tesis', 'LOPEZ GALINDO MARIA DE LOS ANGELES', 'Alondra Elvia Gaspar Bernal'),
(386, 'Desarrollo de un sistema web para control y administracion de deparamento de tutoria', 'Tesina', 'REAL ROJAS MEILIN YOTZIN', 'Raul Nava Lopez'),
(387, 'Biblioteca digital para el museo regional de cultura Modulo 1', 'Proyecto de Investigacion', 'ANGELES SANCHEZ LUIS ANTONIO', 'José Luis Garcí­a Morales'),
(388, 'Biblioteca digital para el museo regional de cultura Modulo 2', 'Proyecto de Investigacion', 'SECUNDINO FLORES YAEL', 'José Luis Garcí­a Morales'),
(389, 'Desarrollo de sistema para el control de horarios del personal docente TESSFP', 'Tesis', 'VARGAS GONZALEZ YANET', 'Guillermina Reyez Juarez'),
(390, 'Desarrollo de sistema para el control de horarios del personal docente TESSFP Modulo 2', 'Tesis', 'NAVARRETE CELESTINO ALFONSO', 'Guillermina Reyez Juarez'),
(391, 'Sistema de control para vehiculos corporativos CFE', 'Tesis', 'MORENO LORENZO GABRIELA', 'Raul Nava Lopez'),
(392, 'Desarrollo de un sistema we para la generacion de calificaciones', 'Tesina', 'NAVARRETE CRUZ MARIA GUADALUPE', 'Azucena Hernández Crisostomo'),
(393, 'Biblioteca digital para el museo regional de cultura Modulo 3', 'Proyecto de Investigacion', 'CAMACHO LUCAS ISAAC', 'José Luis Garcí­a Morales'),
(394, 'Desarrollo de CRM y Sistema de inventario', 'Tesis', 'JIMENEZ LOPEZ CITLALI', 'Luis Ángel González Flores'),
(395, 'Aplicacion web para el registro y control de alumno en actividades complementarias', 'Tesina', 'ANGELES CONTRERAS IVAN', 'Azucena Hernández Crisostomo'),
(396, 'Desarrollo de CRM Modulo 1', 'Proyecto Integrador', 'VALENCIA VALDEZ MARICELA', 'Brenda Garcia Miranda'),
(397, 'Aplicaciones web para cuadre de facturas', 'Tesina', 'SALAZAR GARCIA JOSE URIEL', 'Alondra Elvia Gaspar Bernal'),
(398, 'Sitio web para insercion laboral Moduo 1', 'Tesis', 'ANACLETO ANA LAURA', 'Brenda Garcia Miranda'),
(399, 'Sitio web para insercion laboral Moduo 2', 'Tesis', 'DE JESUS SEGUNDO ANGEL', 'Brenda Garcia Miranda'),
(400, 'Sitio web para insercion laboral Moduo 3', 'Tesis', 'REMIGIO CARMONA JOSMAR', 'Brenda Garcia Miranda'),
(401, 'Plataforma de ecamen de admision Modulo 1', 'Proyecto de Investigacion', 'MAURO RAMIREZ VIOLETA', 'Brenda Garcia Miranda'),
(402, 'Plataforma de examen de admision Modulo 2', 'Proyecto de Investigacion', 'ITURBIDE MENDOZA GUADALUPE', 'Brenda Garcia Miranda'),
(403, 'Desarrollo de CRM y Sistema de inventario Modulo 2', 'Tesis', 'FLORES LOPEZ KEVIN YAHIR', 'Raul Nava Lopez'),
(404, 'Desarrollo de un sistema web para control y administracion de deparamento de tutoria Modulo 2', 'Tesina', 'ONOFRE SEGUNDO DALIA', 'Azucena Hernández Crisostomo'),
(405, 'Aplicacion web ara el control y seguimiento de egresados TESSFP', 'Tesis', 'RUIZ GONZALEZ CITLALI', 'Lila Karen Velazquez Modesto'),
(406, 'Sistema para la gestion de relaciones con proveedores', 'Proyecto de Investigacion', 'TELLEZ RODRIGUEZ PRISCILA', 'Brenda Garcia Miranda');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesores`
--

CREATE TABLE `profesores` (
  `clv_profesor` int(3) NOT NULL,
  `nom_profesor` varchar(255) NOT NULL,
  `clv_depto` int(2) NOT NULL,
  `clv_especialidad` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `profesores`
--

INSERT INTO `profesores` (`clv_profesor`, `nom_profesor`, `clv_depto`, `clv_especialidad`) VALUES
(42, 'Alex Ramírez Galindo', 33, 33),
(43, 'Alondra Elvia Gaspar Bernal', 33, 33),
(44, 'Ana Luisa Ramí­rez Noriega', 33, 33),
(45, 'Andrés Felipe Eguia Rodríguez', 33, 33),
(46, 'Azucena Hernández Crisostomo', 33, 33),
(47, 'Brenda Miranda García', 33, 33),
(48, 'Erika Cortes Nazar', 33, 33),
(49, 'Ernesto Segundo Bartolo', 33, 33),
(50, 'Guillermina Reyes Juarez', 33, 33),
(51, 'José Luis Garcí­a Morales', 33, 33),
(52, 'Lila Karen Velázquez Modesto', 33, 33),
(53, 'Luis Ángel González Flores', 33, 33),
(54, 'Martha Patricia Sánchez Guadarrama', 33, 33),
(55, 'Raúl Nava López', 33, 33),
(56, 'Jose ARmando', 33, 33);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `no_control` bigint(20) NOT NULL,
  `nom_usuario` varchar(255) NOT NULL,
  `clv_especialidad` int(2) NOT NULL,
  `usuario_rol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`no_control`, `nom_usuario`, `clv_especialidad`, `usuario_rol`) VALUES
(2021, 'Renato', 1, 'ADMINISTRADOR'),
(2019330019, 'MENDOZA LOPEZ ALAN MICHEL', 33, 'ALUMNO'),
(2019330075, 'GARCIA ARRIAGA ANAHI', 33, 'ALUMNO'),
(2019330143, 'LEGORRETA DIAZ AXEL', 33, 'ALUMNO'),
(2019330176, 'FLORES GARCIA BRAYAN', 33, 'ALUMNO'),
(2019330187, 'RAMIREZ FLORES BRENDA JANETH', 33, 'ALUMNO'),
(2019330211, 'VELAZQUEZ ITURBIDE CARLOS EDUARDO', 33, 'ALUMNO'),
(2019330222, 'VELAZQUEZ MARTINEZ CRISTIAN', 33, 'ALUMNO'),
(2019330233, 'VENTURA MARTINEZ DAMIAN', 33, 'ALUMNO'),
(2019330244, 'GONZALEZ MARTINEZ DAVID', 33, 'ALUMNO'),
(2019330255, 'GARDUÃ‘O GARCIA DAVID OSVALDO', 33, 'ALUMNO'),
(2019330266, 'MENDOZA MATEO DIANA', 33, 'ALUMNO'),
(2019330299, 'RAMIREZ SANCHEZ DIEGO', 33, 'ALUMNO'),
(2019330312, 'ALANIS GONZALEZ EFRAIN', 33, 'ALUMNO'),
(2019330323, 'MENDOZA ANTONIO ELIZABETH', 33, 'ALUMNO'),
(2019330345, 'CELOTE SEGUNDO EMMANUEL', 33, 'ALUMNO'),
(2019330367, 'MARTINEZ REBOLLO ERICA', 33, 'ALUMNO'),
(2019330378, 'ALBERTO ANTONIO FAUSTINO', 33, 'ALUMNO'),
(2019330413, 'GARCIA MARGARITO GUSTAVO', 33, 'ALUMNO'),
(2019330424, 'ARCHUNDIA GARCIA GUSTAVO', 33, 'ALUMNO'),
(2019330435, 'GARCIA MARGARITO HUGO', 33, 'ALUMNO'),
(2019330446, 'POSADAS MORENO IRIS GUADALUPE', 33, 'ALUMNO'),
(2019330468, 'GARCIA CRUZ IVAN DAVID', 33, 'ALUMNO'),
(2019330479, 'CONTRERAS ROJAS IVAN GUSTAVO', 33, 'ALUMNO'),
(2019330491, 'MATEO VARGAS JACQUELINE', 33, 'ALUMNO'),
(2019330503, 'HERNANDEZ SARABIA JAIRO', 33, 'ALUMNO'),
(2019330514, 'GARCIA GASPAR JESUS', 33, 'ALUMNO'),
(2019330558, 'REYES JUAREZ JOSE ALEX', 33, 'ALUMNO'),
(2019330569, 'PEREZ GONZALEZ JOSE ARMANDO', 33, 'ALUMNO'),
(2019330581, 'VELAZQUEZ CRISTOBAL JOSE MANUEL', 33, 'ALUMNO'),
(2019330592, 'GARDUÃ‘O CRUZ JOSE MIGUEL', 33, 'ALUMNO'),
(2019330615, 'CABALLERO CAMACHO JUAN AXEL', 33, 'ALUMNO'),
(2019330626, 'GONZALEZ BALTAZAR JUAN FRANCISCO', 33, 'ALUMNO'),
(2019330637, 'PAZ SANCHEZ KEVIN SANTIAGO', 33, 'ALUMNO'),
(2019330648, 'VALDES LONGINO LETICIA', 33, 'ALUMNO'),
(2019330671, 'GONZALEZ HERNANDEZ LUIS ANGEL', 33, 'ALUMNO'),
(2019330682, 'DE JESUS LOPEZ LUIS ANTONIO', 33, 'ALUMNO'),
(2019330693, 'ANGELES SANCHEZ LUIS ANTONIO', 33, 'ALUMNO'),
(2019330705, 'LOVERA DOMINGO LUIS ENRIQUE', 33, 'ALUMNO'),
(2019330727, 'GONZALEZ CRUZ MARCO ANTONIO', 33, 'ALUMNO'),
(2019330738, 'LOPEZ GALINDO MARIA DE LOS ANGELES', 33, 'ALUMNO'),
(2019330750, 'SANCHEZ RULFO MARIA GUADALUPE', 33, 'ALUMNO'),
(2019330761, 'LEONARDO CRUZ MARIA GUADALUPE', 33, 'ALUMNO'),
(2019330783, 'REAL ROJAS MEILIN YOTZIN', 33, 'ALUMNO'),
(2019330794, 'EDUARTE GARAY MIREYA', 33, 'ALUMNO'),
(2019330806, 'COLIN ROMERO OCTAVIO', 33, 'ALUMNO'),
(2019330828, 'FLORES MARTINEZ OSCAR', 33, 'ALUMNO'),
(2019330839, 'VILCHIS GARDUÃ‘O PABLO EDWIN', 33, 'ALUMNO'),
(2019330907, 'SEGUNDO MARQUEZ VICTOR MANUEL', 33, 'ALUMNO'),
(2019330918, 'SECUNDINO FLORES YAEL', 33, 'ALUMNO'),
(2019330929, 'VARGAS GONZALEZ YANET', 33, 'ALUMNO'),
(2019330941, 'HERNANDEZ GONZALEZ XOCHITL', 33, 'ALUMNO'),
(2019330974, 'RAMIREZ CONTRERAS JORDY', 33, 'ALUMNO'),
(2019331009, 'SENA ANGELES ALBERTO MAKEINSY', 33, 'ALUMNO'),
(2019331010, 'NAVARRETE CELESTINO ALFONSO', 33, 'ALUMNO'),
(2019331021, 'FELIX ALBA EDUARDO', 33, 'ALUMNO'),
(2019331054, 'CRUZ GONZALEZ BRISSA MARIELI', 33, 'ALUMNO'),
(2019331065, 'PLATA DE LA CRUZ EDWIN ALEXIS', 33, 'ALUMNO'),
(2019331076, 'PECH MUÃ‘OZ OSCAR ADRIAN', 33, 'ALUMNO'),
(2019331087, 'NAVARRETE CRUZ MARIA GUADALUPE', 33, 'ALUMNO'),
(2019331111, 'DE JESUS CASTRO EDGAR', 33, 'ALUMNO'),
(2019331155, 'MORENO LORENZO GABRIELA', 33, 'ALUMNO'),
(2019331166, 'CAMACHO LUCAS ISAAC', 33, 'ALUMNO'),
(2019331201, 'GARCIA GARCIA CARLOS DANIEL', 33, 'ALUMNO'),
(2019331212, 'GARCIA ROMERO JONATHAN', 33, 'ALUMNO'),
(2019331223, 'SALAZAR PIÃ‘ON MARIA CAROLINA', 33, 'ALUMNO'),
(2019331234, 'AMBRIZ MARTINEZ RUBI', 33, 'ALUMNO'),
(2019331245, 'JIMENEZ LOPEZ CITLALI', 33, 'ALUMNO'),
(2020330011, 'CRISOSTOMO RUIZ JOSE ANTONIO', 33, 'ALUMNO'),
(2020330033, 'GARCIA GARCIA FERNANDO', 33, 'ALUMNO'),
(2020330044, 'MARTINEZ PABLO AMALIA', 33, 'ALUMNO'),
(2020330055, 'GARCIA MARTINEZ JUAN CARLOS', 33, 'ALUMNO'),
(2020330066, 'URBINA SANCHEZ PEDRO DAMIAN', 33, 'ALUMNO'),
(2020330077, 'ANGELES CONTRERAS IVAN', 33, 'ALUMNO'),
(2020330088, 'FLORES GUZMAN GABRIEL', 33, 'ALUMNO'),
(2020330101, 'VALENCIA VALDEZ MARICELA', 33, 'ALUMNO'),
(2020330123, 'ALBARRAN ESQUIVEL ANA KAREN', 33, 'ALUMNO'),
(2020330134, 'SALAZAR GARCIA JOSE URIEL', 33, 'ALUMNO'),
(2020330156, 'SANCHEZ DOMINGO KATERINE', 33, 'ALUMNO'),
(2020330167, 'NICOLAS ANACLETO ANA LAURA', 33, 'ALUMNO'),
(2020330189, 'CRUZ GARCIA MIGUEL ANGEL', 33, 'ALUMNO'),
(2020330190, 'DE JESUS SEGUNDO ANGEL', 33, 'ALUMNO'),
(2020330202, 'SANCHEZ LOPEZ JAFET ISAIAS', 33, 'ALUMNO'),
(2020330213, 'REMIGIO CARMONA JOSMAR', 33, 'ALUMNO'),
(2020330224, 'SEGUNDO SANCHEZ DANIELA', 33, 'ALUMNO'),
(2020330235, 'GARDUÃ‘O MATEO DANIEL', 33, 'ALUMNO'),
(2020330246, 'ESQUIVEL REYES JOSE DAMIAN', 33, 'ALUMNO'),
(2020330257, 'MAURO RAMIREZ VIOLETA', 33, 'ALUMNO'),
(2020330268, 'HERNANDEZ CLAUDIO ANAHI', 33, 'ALUMNO'),
(2020330279, 'URBINA PIÃ‘A DANIEL', 33, 'ALUMNO'),
(2020330291, 'ITURBIDE MENDOZA GUADALUPE', 33, 'ALUMNO'),
(2020330325, 'CRUZ ASCENCIO JENNIFER GUADALUPE', 33, 'ALUMNO'),
(2020330336, 'FLORES LOPEZ KEVIN YAHIR', 33, 'ALUMNO'),
(2020330358, 'LOPEZ HERNANDEZ ELOY', 33, 'ALUMNO'),
(2020330381, 'ONOFRE SEGUNDO DALIA', 33, 'ALUMNO'),
(2020330392, 'MARTINEZ EULOGIO DAVID', 33, 'ALUMNO'),
(2020330404, 'SANCHEZ MARTINEZ JIMENA AIDE', 33, 'ALUMNO'),
(2020330415, 'RUIZ GONZALEZ CITLALI', 33, 'ALUMNO'),
(2020330426, 'DE JESUS RAMIREZ JOSE ADRIAN', 33, 'ALUMNO'),
(2020330482, 'TELLEZ RODRIGUEZ PRISCILA', 33, 'ALUMNO');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_administrador`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_administrador` (
`no_control` bigint(20)
,`nom_usuario` varchar(255)
,`clv_especialidad` int(2)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_alumnos`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_alumnos` (
`no_control` bigint(20)
,`nom_usuario` varchar(255)
,`clv_especialidad` int(2)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_configuracion`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_configuracion` (
`configuracion` varchar(100)
,`estado` int(2)
,`referencia` varchar(100)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_grupos`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_grupos` (
`id_grupo` int(5)
,`clv_grupo` varchar(255)
,`clv_materia` varchar(255)
,`clv_profesor` varchar(255)
,`totalumnos` varchar(255)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_profesores`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_profesores` (
`clv_profesor` int(3)
,`nom_profesor` varchar(255)
,`clv_depto` int(2)
,`clv_especialidad` int(2)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_administrador`
--
DROP TABLE IF EXISTS `vista_administrador`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_administrador`  AS SELECT `usuarios`.`no_control` AS `no_control`, `usuarios`.`nom_usuario` AS `nom_usuario`, `usuarios`.`clv_especialidad` AS `clv_especialidad` FROM `usuarios` WHERE `usuarios`.`usuario_rol` = 'ADMINISTRADOR''ADMINISTRADOR'  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_alumnos`
--
DROP TABLE IF EXISTS `vista_alumnos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_alumnos`  AS SELECT `usuarios`.`no_control` AS `no_control`, `usuarios`.`nom_usuario` AS `nom_usuario`, `usuarios`.`clv_especialidad` AS `clv_especialidad` FROM `usuarios` WHERE `usuarios`.`usuario_rol` = 'ALUMNO''ALUMNO'  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_configuracion`
--
DROP TABLE IF EXISTS `vista_configuracion`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_configuracion`  AS SELECT `configuracion`.`configuracion` AS `configuracion`, `configuracion`.`estado` AS `estado`, `configuracion`.`referencia` AS `referencia` FROM `configuracion``configuracion`  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_grupos`
--
DROP TABLE IF EXISTS `vista_grupos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_grupos`  AS SELECT `grupos`.`id_grupo` AS `id_grupo`, `grupos`.`clv_grupo` AS `clv_grupo`, `grupos`.`clv_materia` AS `clv_materia`, `grupos`.`clv_profesor` AS `clv_profesor`, `grupos`.`totalumnos` AS `totalumnos` FROM `grupos``grupos`  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_profesores`
--
DROP TABLE IF EXISTS `vista_profesores`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_profesores`  AS SELECT `profesores`.`clv_profesor` AS `clv_profesor`, `profesores`.`nom_profesor` AS `nom_profesor`, `profesores`.`clv_depto` AS `clv_depto`, `profesores`.`clv_especialidad` AS `clv_especialidad` FROM `profesores``profesores`  ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`idopcion`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`id_grupo`);

--
-- Indices de la tabla `profesores`
--
ALTER TABLE `profesores`
  ADD PRIMARY KEY (`clv_profesor`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`no_control`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `idopcion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `id_grupo` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=409;

--
-- AUTO_INCREMENT de la tabla `profesores`
--
ALTER TABLE `profesores`
  MODIFY `clv_profesor` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
