/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19-11.7.2-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: Artus
-- ------------------------------------------------------
-- Server version	11.7.2-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `categorias` (
  `idCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombreCategoria` varchar(100) NOT NULL,
  PRIMARY KEY (`idCategoria`),
  UNIQUE KEY `nombreCategoria` (`nombreCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES
(1,'Aseo'),
(3,'Electrodomesticos');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cierreMes`
--

DROP TABLE IF EXISTS `cierreMes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cierreMes` (
  `idCierre` int(11) NOT NULL AUTO_INCREMENT,
  `mes` int(11) NOT NULL CHECK (`mes` between 1 and 12),
  `año` int(11) NOT NULL CHECK (`año` >= 2000),
  `totalVentas` decimal(10,2) NOT NULL,
  `totalGastos` decimal(10,2) NOT NULL,
  `gananciaNota` decimal(10,2) NOT NULL,
  `fechaCierre` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idCierre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cierreMes`
--

LOCK TABLES `cierreMes` WRITE;
/*!40000 ALTER TABLE `cierreMes` DISABLE KEYS */;
/*!40000 ALTER TABLE `cierreMes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `clientes` (
  `idCliente` int(11) NOT NULL AUTO_INCREMENT,
  `numeroDocumento` varchar(20) NOT NULL,
  PRIMARY KEY (`idCliente`),
  UNIQUE KEY `numeroDocumento` (`numeroDocumento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configuracionTicketera`
--

DROP TABLE IF EXISTS `configuracionTicketera`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `configuracionTicketera` (
  `id_config` int(11) NOT NULL AUTO_INCREMENT,
  `nombreImpresora` varchar(100) NOT NULL,
  `puerto` varchar(50) NOT NULL,
  `configuracion_json` text NOT NULL,
  PRIMARY KEY (`id_config`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuracionTicketera`
--

LOCK TABLES `configuracionTicketera` WRITE;
/*!40000 ALTER TABLE `configuracionTicketera` DISABLE KEYS */;
/*!40000 ALTER TABLE `configuracionTicketera` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalleVenta`
--

DROP TABLE IF EXISTS `detalleVenta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `detalleVenta` (
  `idDetalleVenta` int(11) NOT NULL AUTO_INCREMENT,
  `venta_idVenta` int(11) DEFAULT NULL,
  `codigoBarras` varchar(20) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precioUnitario` decimal(10,2) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`idDetalleVenta`),
  KEY `venta_idVenta` (`venta_idVenta`),
  KEY `fk_codigoBarras_detalle` (`codigoBarras`),
  CONSTRAINT `detalleVenta_ibfk_1` FOREIGN KEY (`venta_idVenta`) REFERENCES `ventas` (`idVenta`) ON DELETE CASCADE,
  CONSTRAINT `fk_codigoBarras_detalle` FOREIGN KEY (`codigoBarras`) REFERENCES `productos` (`codigoBarras`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalleVenta`
--

LOCK TABLES `detalleVenta` WRITE;
/*!40000 ALTER TABLE `detalleVenta` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalleVenta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gastosMensuales`
--

DROP TABLE IF EXISTS `gastosMensuales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `gastosMensuales` (
  `idGastos` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` text NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `mes` int(11) NOT NULL CHECK (`mes` between 1 and 12),
  `año` int(11) NOT NULL CHECK (`año` >= 2000),
  `fecha` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idGastos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gastosMensuales`
--

LOCK TABLES `gastosMensuales` WRITE;
/*!40000 ALTER TABLE `gastosMensuales` DISABLE KEYS */;
/*!40000 ALTER TABLE `gastosMensuales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historialVentas`
--

DROP TABLE IF EXISTS `historialVentas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `historialVentas` (
  `idHistorial` int(11) NOT NULL AUTO_INCREMENT,
  `venta_idVenta` int(11) NOT NULL,
  `accion` enum('Venta realizada','anulacion de venta') NOT NULL,
  `fecha` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idHistorial`),
  KEY `venta_idVenta` (`venta_idVenta`),
  CONSTRAINT `historialVentas_ibfk_1` FOREIGN KEY (`venta_idVenta`) REFERENCES `ventas` (`idVenta`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historialVentas`
--

LOCK TABLES `historialVentas` WRITE;
/*!40000 ALTER TABLE `historialVentas` DISABLE KEYS */;
/*!40000 ALTER TABLE `historialVentas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inversionesProductos`
--

DROP TABLE IF EXISTS `inversionesProductos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `inversionesProductos` (
  `idInversion` int(11) NOT NULL AUTO_INCREMENT,
  `codigoBarras` varchar(20) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `costoTotal` decimal(10,2) NOT NULL,
  `fecha` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idInversion`),
  KEY `fk_codigoBarras_inversion` (`codigoBarras`),
  CONSTRAINT `fk_codigoBarras_inversion` FOREIGN KEY (`codigoBarras`) REFERENCES `productos` (`codigoBarras`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inversionesProductos`
--

LOCK TABLES `inversionesProductos` WRITE;
/*!40000 ALTER TABLE `inversionesProductos` DISABLE KEYS */;
/*!40000 ALTER TABLE `inversionesProductos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `productos` (
  `codigoBarras` varchar(20) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precioCompra` decimal(10,2) NOT NULL,
  `precioVenta` decimal(10,2) NOT NULL,
  `categoria_idCategoria` int(11) NOT NULL,
  `proveedor_idProveedor` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fechaCreacion` date NOT NULL,
  PRIMARY KEY (`codigoBarras`),
  KEY `categoria_idCategoria` (`categoria_idCategoria`),
  KEY `proveedor_idProveedor` (`proveedor_idProveedor`),
  CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`categoria_idCategoria`) REFERENCES `categorias` (`idCategoria`) ON DELETE CASCADE,
  CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`proveedor_idProveedor`) REFERENCES `proveedores` (`idProveedor`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES
('123123','Case',NULL,30000.00,50000.00,3,2,50,'2025-04-03'),
('123123123','Trapero',NULL,5000.00,8000.00,1,1,2,'2025-04-03');
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proveedores`
--

DROP TABLE IF EXISTS `proveedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `proveedores` (
  `idProveedor` int(11) NOT NULL AUTO_INCREMENT,
  `nombreProveedor` varchar(150) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `direccion` text DEFAULT NULL,
  PRIMARY KEY (`idProveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proveedores`
--

LOCK TABLES `proveedores` WRITE;
/*!40000 ALTER TABLE `proveedores` DISABLE KEYS */;
INSERT INTO `proveedores` VALUES
(1,'Juanito','31413123','juanito@gmail.com','calle 86'),
(2,'Johan','3135135','johan@gmail.com','calle 90');
/*!40000 ALTER TABLE `proveedores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reportes`
--

DROP TABLE IF EXISTS `reportes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `reportes` (
  `idReporte` int(11) NOT NULL AUTO_INCREMENT,
  `tipoReporte` enum('Cierre Diario','Reporte Productos','Reporte Proveedores','Reporte Inversion','Reporte Ganancias','Cierre Mensual') NOT NULL,
  `fechaGeneracion` timestamp NULL DEFAULT current_timestamp(),
  `archivoPDF` varchar(255) NOT NULL,
  PRIMARY KEY (`idReporte`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reportes`
--

LOCK TABLES `reportes` WRITE;
/*!40000 ALTER TABLE `reportes` DISABLE KEYS */;
/*!40000 ALTER TABLE `reportes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rol`
--

DROP TABLE IF EXISTS `rol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `rol` (
  `idRol` int(11) NOT NULL AUTO_INCREMENT,
  `nombreRol` enum('admin','cajero') NOT NULL,
  PRIMARY KEY (`idRol`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rol`
--

LOCK TABLES `rol` WRITE;
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO `rol` VALUES
(1,'admin'),
(2,'cajero');
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stockProductos`
--

DROP TABLE IF EXISTS `stockProductos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `stockProductos` (
  `idStock` int(11) NOT NULL AUTO_INCREMENT,
  `codigoBarras` varchar(20) NOT NULL,
  `cantidadDisponible` int(11) NOT NULL DEFAULT 0,
  `cantidadMinima` int(11) NOT NULL DEFAULT 1,
  `ubicacionAlmacen` varchar(255) DEFAULT NULL,
  `fechaActualizacion` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`idStock`),
  KEY `fk_codigoBarras_stock` (`codigoBarras`),
  CONSTRAINT `fk_codigoBarras_stock` FOREIGN KEY (`codigoBarras`) REFERENCES `productos` (`codigoBarras`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stockProductos`
--

LOCK TABLES `stockProductos` WRITE;
/*!40000 ALTER TABLE `stockProductos` DISABLE KEYS */;
/*!40000 ALTER TABLE `stockProductos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `num_doc` int(20) NOT NULL,
  `nombreCompleto` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `rol` int(11) NOT NULL,
  PRIMARY KEY (`num_doc`),
  UNIQUE KEY `email` (`email`),
  KEY `rol` (`rol`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `rol` (`idRol`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES
(111,'admin','admin@gmail.com','$2y$12$0w7MIjpniYZE1daLJcdRAuTeam9eJ.wwIiacrJbLma3obGcquzKvu',1),
(123,'Alexander Osuna','alex@gmail.com','$2y$12$vj//zBNHJg.RxVccq5aa1eIy72YT0KsX6XaOVYkSHwC6XCNFr96QG',2);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ventas`
--

DROP TABLE IF EXISTS `ventas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `ventas` (
  `idVenta` int(11) NOT NULL AUTO_INCREMENT,
  `cliente_idCliente` int(11) DEFAULT NULL,
  `usuario_idUsuario` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `fecha` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idVenta`),
  KEY `cliente_idCliente` (`cliente_idCliente`),
  CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`cliente_idCliente`) REFERENCES `clientes` (`idCliente`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ventas`
--

LOCK TABLES `ventas` WRITE;
/*!40000 ALTER TABLE `ventas` DISABLE KEYS */;
/*!40000 ALTER TABLE `ventas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2025-04-03 19:08:47
