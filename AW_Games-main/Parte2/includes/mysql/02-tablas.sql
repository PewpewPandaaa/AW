-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2023-05-15 01:06:51
-- 服务器版本： 10.4.27-MariaDB
-- PHP 版本： 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `awsd`
--

-- --------------------------------------------------------

--
-- 表的结构 `amigos`
--

CREATE TABLE `amigos` (
  `id_usuario1` int(50) NOT NULL,
  `id_usuario2` int(50) NOT NULL,
  `fecha_amistad` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 表的结构 `cesta`
--

CREATE TABLE `cesta` (
  `idJuego` int(50) NOT NULL,
  `idUsuario` int(50) NOT NULL,
  `nomJuego` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 表的结构 `chat`
--

CREATE TABLE `chat` (
  `idMensaje` int(11) NOT NULL,
  `id_enviado` int(50) NOT NULL,
  `id_recibido` int(50) NOT NULL,
  `mensaje` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 表的结构 `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL,
  `idUsuario` int(50) NOT NULL,
  `idJuego` int(50) NOT NULL,
  `contentComent` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 表的结构 `comunidadjuego`
--

CREATE TABLE `comunidadjuego` (
  `id_comentario` int(50) NOT NULL,
  `id_Juego` int(50) NOT NULL,
  `id_Usuario` int(50) NOT NULL,
  `comentario` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 表的结构 `juegos`
--

CREATE TABLE `juegos` (
  `idJuego` int(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `imagen` varchar(50) DEFAULT NULL,
  `genero` varchar(20) DEFAULT NULL,
  `infoBasica` text NOT NULL,
  `fechaLanz` date DEFAULT NULL,
  `desarrollador` varchar(50) DEFAULT NULL,
  `video` varchar(50) DEFAULT NULL,
  `valoracion` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 表的结构 `listadeseo`
--

CREATE TABLE `listadeseo` (
  `idUsuario` int(50) NOT NULL,
  `idJuego` int(50) NOT NULL,
  `nomJuego` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 表的结构 `listafavoritos`
--

CREATE TABLE `listafavoritos` (
  `idUsuario` int(50) NOT NULL,
  `idJuego` int(50) NOT NULL,
  `nomJuego` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 表的结构 `oferta`
--

CREATE TABLE `oferta` (
  `idJuego` int(50) NOT NULL,
  `precioReb` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 表的结构 `report`
--

CREATE TABLE `report` (
  `idReport` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `nombreUsuario` varchar(50) NOT NULL,
  `idComReport` int(11) NOT NULL,
  `comentario` text NOT NULL,
  `motivo` text NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 表的结构 `roles`
--

CREATE TABLE `roles` (
  `nombre` varchar(15) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 表的结构 `rolesusuario`
--

CREATE TABLE `rolesusuario` (
  `usuarioid` int(11) NOT NULL,
  `rol` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 表的结构 `solicitudamistad`
--

CREATE TABLE `solicitudamistad` (
  `id_solicitante` int(50) NOT NULL,
  `id_solicitado` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 表的结构 `usmuteado`
--

CREATE TABLE `usmuteado` (
  `id_usuario` int(50) NOT NULL,
  `dias_mute` int(10) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 表的结构 `usuario`
--

CREATE TABLE `usuario` (
  `id` int(50) NOT NULL,
  `contrasenia` varchar(100) NOT NULL,
  `nombreUsuario` varchar(30) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `apodo` varchar(50) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `fecha` date NOT NULL DEFAULT current_timestamp(),
  `saldo` decimal(50,2) DEFAULT NULL,
  `imagen` longblob DEFAULT NULL,
  `genero` varchar(100) DEFAULT NULL,
  `lema` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 表的结构 `usuariojuego`
--

CREATE TABLE `usuariojuego` (
  `idJuego` int(50) NOT NULL,
  `idUsuario` int(50) NOT NULL,
  `nomJuego` varchar(50) NOT NULL,
  `valoracion` int(1) DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转储表的索引
--

--
-- 表的索引 `amigos`
--
ALTER TABLE `amigos`
  ADD PRIMARY KEY (`id_usuario1`,`id_usuario2`),
  ADD KEY `id_usuario2` (`id_usuario2`),
  ADD KEY `id_usuario1` (`id_usuario1`);

--
-- 表的索引 `cesta`
--
ALTER TABLE `cesta`
  ADD PRIMARY KEY (`idJuego`,`idUsuario`),
  ADD KEY `idJuego` (`idJuego`,`idUsuario`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- 表的索引 `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`idMensaje`),
  ADD KEY `id_enviado` (`id_enviado`,`id_recibido`),
  ADD KEY `id_recibido` (`id_recibido`);

--
-- 表的索引 `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUsuario` (`idUsuario`,`idJuego`),
  ADD KEY `idJuego` (`idJuego`);

--
-- 表的索引 `comunidadjuego`
--
ALTER TABLE `comunidadjuego`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `id_Juego` (`id_Juego`,`id_Usuario`),
  ADD KEY `id_Usuario` (`id_Usuario`);

--
-- 表的索引 `juegos`
--
ALTER TABLE `juegos`
  ADD PRIMARY KEY (`idJuego`);

--
-- 表的索引 `listadeseo`
--
ALTER TABLE `listadeseo`
  ADD PRIMARY KEY (`idUsuario`,`idJuego`),
  ADD KEY `idUsuario` (`idUsuario`,`idJuego`),
  ADD KEY `idJuego` (`idJuego`);

--
-- 表的索引 `listafavoritos`
--
ALTER TABLE `listafavoritos`
  ADD PRIMARY KEY (`idUsuario`,`idJuego`),
  ADD KEY `idUsuario` (`idUsuario`,`idJuego`),
  ADD KEY `idJuego` (`idJuego`);

--
-- 表的索引 `oferta`
--
ALTER TABLE `oferta`
  ADD PRIMARY KEY (`idJuego`),
  ADD KEY `idJuego` (`idJuego`);

--
-- 表的索引 `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`idReport`),
  ADD KEY `idUsuario` (`idUsuario`,`idComReport`),
  ADD KEY `idComReport` (`idComReport`);

--
-- 表的索引 `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`nombre`);

--
-- 表的索引 `rolesusuario`
--
ALTER TABLE `rolesusuario`
  ADD PRIMARY KEY (`usuarioid`,`rol`),
  ADD KEY `rol` (`rol`);

--
-- 表的索引 `solicitudamistad`
--
ALTER TABLE `solicitudamistad`
  ADD PRIMARY KEY (`id_solicitante`,`id_solicitado`),
  ADD UNIQUE KEY `id_solicitante` (`id_solicitante`,`id_solicitado`),
  ADD KEY `id_solicitado` (`id_solicitado`);

--
-- 表的索引 `usmuteado`
--
ALTER TABLE `usmuteado`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `id_usuario` (`id_usuario`);

--
-- 表的索引 `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `usuariojuego`
--
ALTER TABLE `usuariojuego`
  ADD PRIMARY KEY (`idJuego`,`idUsuario`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `chat`
--
ALTER TABLE `chat`
  MODIFY `idMensaje` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `comunidadjuego`
--
ALTER TABLE `comunidadjuego`
  MODIFY `id_comentario` int(50) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `juegos`
--
ALTER TABLE `juegos`
  MODIFY `idJuego` int(50) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `report`
--
ALTER TABLE `report`
  MODIFY `idReport` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- 限制导出的表
--

--
-- 限制表 `amigos`
--
ALTER TABLE `amigos`
  ADD CONSTRAINT `amigos_ibfk_1` FOREIGN KEY (`id_usuario1`) REFERENCES `usuario` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `amigos_ibfk_2` FOREIGN KEY (`id_usuario2`) REFERENCES `usuario` (`id`) ON DELETE CASCADE;

--
-- 限制表 `cesta`
--
ALTER TABLE `cesta`
  ADD CONSTRAINT `cesta_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cesta_ibfk_2` FOREIGN KEY (`idJuego`) REFERENCES `juegos` (`idJuego`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_ibfk_1` FOREIGN KEY (`id_enviado`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chat_ibfk_2` FOREIGN KEY (`id_recibido`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`idJuego`) REFERENCES `juegos` (`idJuego`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `comunidadjuego`
--
ALTER TABLE `comunidadjuego`
  ADD CONSTRAINT `comunidadjuego_ibfk_1` FOREIGN KEY (`id_Usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comunidadjuego_ibfk_2` FOREIGN KEY (`id_Juego`) REFERENCES `juegos` (`idJuego`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `listadeseo`
--
ALTER TABLE `listadeseo`
  ADD CONSTRAINT `listadeseo_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `listadeseo_ibfk_2` FOREIGN KEY (`idJuego`) REFERENCES `juegos` (`idJuego`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `listafavoritos`
--
ALTER TABLE `listafavoritos`
  ADD CONSTRAINT `listafavoritos_ibfk_1` FOREIGN KEY (`idJuego`) REFERENCES `juegos` (`idJuego`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `listafavoritos_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `oferta`
--
ALTER TABLE `oferta`
  ADD CONSTRAINT `oferta_ibfk_1` FOREIGN KEY (`idJuego`) REFERENCES `juegos` (`idJuego`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `report_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `report_ibfk_2` FOREIGN KEY (`idComReport`) REFERENCES `comentarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `rolesusuario`
--
ALTER TABLE `rolesusuario`
  ADD CONSTRAINT `rolesusuario_ibfk_2` FOREIGN KEY (`usuarioid`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rolesusuario_ibfk_3` FOREIGN KEY (`rol`) REFERENCES `roles` (`nombre`);

--
-- 限制表 `solicitudamistad`
--
ALTER TABLE `solicitudamistad`
  ADD CONSTRAINT `solicitudamistad_ibfk_1` FOREIGN KEY (`id_solicitante`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `solicitudamistad_ibfk_2` FOREIGN KEY (`id_solicitado`) REFERENCES `usuario` (`id`) ON DELETE CASCADE;

--
-- 限制表 `usmuteado`
--
ALTER TABLE `usmuteado`
  ADD CONSTRAINT `usmuteado_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `usuariojuego`
--
ALTER TABLE `usuariojuego`
  ADD CONSTRAINT `usuariojuego_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuariojuego_ibfk_2` FOREIGN KEY (`idJuego`) REFERENCES `juegos` (`idJuego`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
