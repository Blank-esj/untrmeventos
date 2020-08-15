-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='';

-- -----------------------------------------------------
-- Schema untrmeventos
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema untrmeventos
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `untrmeventos` DEFAULT CHARACTER SET utf8mb4 ;
USE `untrmeventos` ;

-- -----------------------------------------------------
-- Table `untrmeventos`.`persona`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `untrmeventos`.`persona` (
  `idpersona` INT NOT NULL,
  `nombres` VARCHAR(50) NOT NULL,
  `apellidopa` VARCHAR(50) NOT NULL,
  `apellidoma` VARCHAR(50) NOT NULL,
  `email` VARCHAR(50) NULL,
  `telefono` CHAR(12) NULL,
  `doc_identidad` VARCHAR(20) NULL,
  PRIMARY KEY (`idpersona`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `untrmeventos`.`admins`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `untrmeventos`.`admins` (
  `idpersona` INT NOT NULL,
  `usuario` VARCHAR(50) NOT NULL,
  `password` VARCHAR(60) NOT NULL,
  `nivel` INT NOT NULL,
  `fecha_actualizacion` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idpersona`),
  UNIQUE INDEX `usuario_UNIQUE` (`usuario` ASC) VISIBLE,
  CONSTRAINT `fk_admins_persona1`
    FOREIGN KEY (`idpersona`)
    REFERENCES `untrmeventos`.`persona` (`idpersona`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `untrmeventos`.`categoria_evento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `untrmeventos`.`categoria_evento` (
  `id_categoria` TINYINT NOT NULL AUTO_INCREMENT,
  `cat_evento` VARCHAR(50) NOT NULL,
  `icono` VARCHAR(30) NOT NULL,
  `fecha_actualizacion` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_categoria`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `untrmeventos`.`grado_instruccion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `untrmeventos`.`grado_instruccion` (
  `idgrado_instruccion` INT NOT NULL AUTO_INCREMENT,
  `grado` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`idgrado_instruccion`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `untrmeventos`.`invitado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `untrmeventos`.`invitado` (
  `idpersona` INT NOT NULL,
  `descripcion` TEXT NOT NULL,
  `url_imagen` VARCHAR(255) NOT NULL,
  `institucion_procedencia` VARCHAR(100) NULL,
  `idgrado_instruccion` INT NULL,
  `nacimiento` DATE NULL,
  `sexo` CHAR(1) NULL,
  `fecha_actualizacion` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX `fk_invitado_grado_instruccion1_idx` (`idgrado_instruccion` ASC) VISIBLE,
  PRIMARY KEY (`idpersona`),
  CONSTRAINT `fk_invitado_grado_instruccion1`
    FOREIGN KEY (`idgrado_instruccion`)
    REFERENCES `untrmeventos`.`grado_instruccion` (`idgrado_instruccion`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_invitado_persona1`
    FOREIGN KEY (`idpersona`)
    REFERENCES `untrmeventos`.`persona` (`idpersona`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `untrmeventos`.`evento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `untrmeventos`.`evento` (
  `id_evento` TINYINT NOT NULL AUTO_INCREMENT,
  `nombre_evento` VARCHAR(60) NOT NULL,
  `fecha_evento` DATE NOT NULL,
  `hora_evento` TIME NOT NULL,
  `id_cat_evento` TINYINT NOT NULL,
  `id_inv` INT NOT NULL,
  `clave` VARCHAR(10) NOT NULL,
  `fecha_actualizacion` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_evento`),
  INDEX `id_cat_evento` (`id_cat_evento` ASC) VISIBLE,
  INDEX `invitado_eventofk_idx` (`id_inv` ASC) VISIBLE,
  CONSTRAINT `evento_ibfk_1`
    FOREIGN KEY (`id_cat_evento`)
    REFERENCES `untrmeventos`.`categoria_evento` (`id_categoria`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `invitado_eventofk`
    FOREIGN KEY (`id_inv`)
    REFERENCES `untrmeventos`.`invitado` (`idpersona`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `untrmeventos`.`regalo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `untrmeventos`.`regalo` (
  `idregalo` INT NOT NULL AUTO_INCREMENT,
  `nombre_regalo` VARCHAR(50) NOT NULL,
  `stock` DECIMAL(14,2) NOT NULL DEFAULT 0,
  PRIMARY KEY (`idregalo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `untrmeventos`.`plan`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `untrmeventos`.`plan` (
  `idplan` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `precio` DECIMAL(14,2) NOT NULL,
  `descripcion` VARCHAR(200) NULL,
  PRIMARY KEY (`idplan`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `untrmeventos`.`venta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `untrmeventos`.`venta` (
  `idventa` INT NOT NULL AUTO_INCREMENT,
  `clave_transaccion` VARCHAR(255) NOT NULL,
  `paypal_datos` JSON NOT NULL,
  `correo` VARCHAR(500) NOT NULL,
  `total_pre` DECIMAL(14,2) NOT NULL,
  `estado` VARCHAR(200) NOT NULL,
  `fecha_creacion` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_actualizacion` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idventa`),
  UNIQUE INDEX `idventa_UNIQUE` (`idventa` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `untrmeventos`.`boleto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `untrmeventos`.`boleto` (
  `idboleto` INT NOT NULL AUTO_INCREMENT,
  `idpersona` INT NOT NULL,
  `idventa` INT NULL,
  `idplan` INT NOT NULL,
  `idregalo` INT NULL,
  `fecha_creacion` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_actualizacion` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idboleto`, `idpersona`),
  INDEX `fk_registro_boleto1_idx` (`idplan` ASC) VISIBLE,
  INDEX `fk_boleto_regalo1_idx` (`idregalo` ASC) VISIBLE,
  INDEX `fk_boleto_persona_idx` (`idpersona` ASC) VISIBLE,
  INDEX `fk_boleto_venta1_idx` (`idventa` ASC) VISIBLE,
  CONSTRAINT `fk_registro_boleto1`
    FOREIGN KEY (`idplan`)
    REFERENCES `untrmeventos`.`plan` (`idplan`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_boleto_regalo1`
    FOREIGN KEY (`idregalo`)
    REFERENCES `untrmeventos`.`regalo` (`idregalo`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_boleto_persona`
    FOREIGN KEY (`idpersona`)
    REFERENCES `untrmeventos`.`persona` (`idpersona`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_boleto_venta1`
    FOREIGN KEY (`idventa`)
    REFERENCES `untrmeventos`.`venta` (`idventa`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `untrmeventos`.`articulo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `untrmeventos`.`articulo` (
  `idarticulo` INT NOT NULL AUTO_INCREMENT,
  `nombre_articulo` VARCHAR(50) NOT NULL,
  `precio` DECIMAL(14,2) UNSIGNED NOT NULL DEFAULT 0,
  `stock` DECIMAL(14,2) NOT NULL DEFAULT 0,
  `descripcion` VARCHAR(500) NULL,
  `url_imagen` VARCHAR(255) NULL,
  PRIMARY KEY (`idarticulo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `untrmeventos`.`beneficio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `untrmeventos`.`beneficio` (
  `idbeneficio` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`idbeneficio`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `untrmeventos`.`plan_beneficio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `untrmeventos`.`plan_beneficio` (
  `idplan_beneficio` INT NOT NULL AUTO_INCREMENT,
  `idplan` INT NOT NULL,
  `idbeneficio` INT NOT NULL,
  INDEX `fk_table1_boleto1_idx` (`idplan` ASC) VISIBLE,
  INDEX `fk_table1_beneficio1_idx` (`idbeneficio` ASC) VISIBLE,
  PRIMARY KEY (`idplan_beneficio`),
  CONSTRAINT `fk_table1_boleto1`
    FOREIGN KEY (`idplan`)
    REFERENCES `untrmeventos`.`plan` (`idplan`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_table1_beneficio1`
    FOREIGN KEY (`idbeneficio`)
    REFERENCES `untrmeventos`.`beneficio` (`idbeneficio`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `untrmeventos`.`venta_articulo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `untrmeventos`.`venta_articulo` (
  `idventa_articulo` INT NOT NULL AUTO_INCREMENT,
  `idventa` INT NOT NULL,
  `idarticulo` INT NOT NULL,
  `cantidad` DECIMAL(14,2) NOT NULL,
  INDEX `fk_articulo_compra_articulo1_idx` (`idarticulo` ASC) VISIBLE,
  PRIMARY KEY (`idventa_articulo`),
  INDEX `fk_articulo_boleto_venta1_idx` (`idventa` ASC) VISIBLE,
  CONSTRAINT `fk_articulo_compra_articulo1`
    FOREIGN KEY (`idarticulo`)
    REFERENCES `untrmeventos`.`articulo` (`idarticulo`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_articulo_boleto_venta1`
    FOREIGN KEY (`idventa`)
    REFERENCES `untrmeventos`.`venta` (`idventa`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

USE `untrmeventos` ;

-- -----------------------------------------------------
-- Placeholder table for view `untrmeventos`.`v_invitado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `untrmeventos`.`v_invitado` (`idpersona` INT, `nombre_completo` INT, `email` INT, `telefono` INT, `doc_identidad` INT, `institucion_procedencia` INT, `grado` INT, `nacimiento` INT, `sexo` INT, `descripcion` INT, `url_imagen` INT, `fecha_actualizacion` INT);

-- -----------------------------------------------------
-- Placeholder table for view `untrmeventos`.`v_admins`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `untrmeventos`.`v_admins` (`idpersona` INT, `nombre_completo` INT, `email` INT, `telefono` INT, `doc_identidad` INT, `usuario` INT, `password` INT, `nivel` INT, `fecha_actualizacion` INT);

-- -----------------------------------------------------
-- Placeholder table for view `untrmeventos`.`v_detalle_evento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `untrmeventos`.`v_detalle_evento` (`id_evento` INT, `nombre_evento` INT, `fecha_evento` INT, `hora_evento` INT, `clave` INT, `nombre_invitado` INT, `cat_evento` INT, `icono` INT, `fecha_actualizacion` INT);

-- -----------------------------------------------------
-- Placeholder table for view `untrmeventos`.`v_boleto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `untrmeventos`.`v_boleto` (`idboleto` INT, `boleto` INT, `estado_venta` INT, `comprador` INT, `asistente` INT, `plan` INT, `regalo` INT, `email` INT, `telefono` INT, `doc_identidad` INT, `fecha_creacion` INT, `fecha_actualizacion` INT);

-- -----------------------------------------------------
-- Placeholder table for view `untrmeventos`.`v_categoria_cantidad_evento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `untrmeventos`.`v_categoria_cantidad_evento` (`id_categoria` INT, `categoria_evento` INT, `cantidad_evento` INT);

-- -----------------------------------------------------
-- Placeholder table for view `untrmeventos`.`v_venta_articulo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `untrmeventos`.`v_venta_articulo` (`idventa_articulo` INT, `idventa` INT, `idarticulo` INT, `comprador` INT, `articulo` INT, `precio` INT, `cantidad` INT, `subtotal` INT, `url_imagen` INT, `estado` INT);

-- -----------------------------------------------------
-- Placeholder table for view `untrmeventos`.`v_venta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `untrmeventos`.`v_venta` (`id` INT);

-- -----------------------------------------------------
-- Placeholder table for view `untrmeventos`.`v_evento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `untrmeventos`.`v_evento` (`id_evento` INT, `evento` INT, `fecha` INT, `hora` INT, `categoria` INT, `invitado` INT, `clave` INT);

-- -----------------------------------------------------
-- procedure sp_beneficios_plan
-- -----------------------------------------------------

DELIMITER $$
USE `untrmeventos`$$
-- Modificado: 01/08/2020 11:42
CREATE PROCEDURE `sp_beneficios_plan` (IN idplan INT)
BEGIN
	SELECT b.idbeneficio, b.nombre FROM plan_beneficio pb
	INNER JOIN plan p
		ON p.idplan = pb.idplan
	INNER JOIN beneficio b
		ON b.idbeneficio = pb.idbeneficio
	WHERE pb.idplan = idplan
    ORDER BY b.nombre;
END$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure sp_plan_por_venta
-- -----------------------------------------------------

DELIMITER $$
USE `untrmeventos`$$
-- Modificado: 03-08-2020 3:41
CREATE PROCEDURE `sp_plan_por_venta` (IN id_venta INT)
BEGIN
	SELECT 
		b.idboleto, 
		p.idplan,
		p.nombre,
		p.precio,
        COUNT(*) cantidad
	FROM plan p, boleto b
	WHERE p.idplan = b.idplan
    AND b.idventa = id_venta
    GROUP BY p.idplan;
END$$

DELIMITER ;

-- -----------------------------------------------------
-- View `untrmeventos`.`v_invitado`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `untrmeventos`.`v_invitado`;
USE `untrmeventos`;
-- Modificado: 29/07/2020 11:44 PM
CREATE  OR REPLACE VIEW `v_invitado` AS
SELECT i.idpersona,
    CONCAT(p.nombres, ' ', p.apellidopa, ' ', p.apellidoma) nombre_completo,
    p.email,
    p.telefono,
    p.doc_identidad,
    i.institucion_procedencia,
    gi.grado,
    i.nacimiento,
    i.sexo,
    i.descripcion,
    i.url_imagen,
    i.fecha_actualizacion
FROM persona p
	JOIN invitado i ON p.idpersona = i.idpersona
	LEFT JOIN grado_instruccion gi ON i.idgrado_instruccion = gi.idgrado_instruccion
ORDER BY p.nombres;

-- -----------------------------------------------------
-- View `untrmeventos`.`v_admins`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `untrmeventos`.`v_admins`;
USE `untrmeventos`;
-- Modificado: 16/07/2020 3:05
CREATE  OR REPLACE VIEW `v_admins` AS
SELECT a.idpersona,
    CONCAT(p.nombres, ' ', p.apellidopa, ' ', p.apellidoma) nombre_completo,
    p.email,
    p.telefono,
    p.doc_identidad,
    a.usuario,
    a.password,
    a.nivel,
    a.fecha_actualizacion
FROM persona p,
    admins a
WHERE p.idpersona = a.idpersona;

-- -----------------------------------------------------
-- View `untrmeventos`.`v_detalle_evento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `untrmeventos`.`v_detalle_evento`;
USE `untrmeventos`;
-- Modificado: 22/07/2020 07:45 PM
CREATE  OR REPLACE VIEW `v_detalle_evento` AS
SELECT e.id_evento, 
	e.nombre_evento,
	e.fecha_evento,
	e.hora_evento,
    e.clave,
	CONCAT(p.nombres, ' ', p.apellidopa, ' ', p.apellidoma) nombre_invitado,
	ce.cat_evento,
    ce.icono,
	e.fecha_actualizacion
FROM evento e
	JOIN invitado i ON i.idpersona = e.id_inv
	JOIN categoria_evento ce ON ce.id_categoria = e.id_cat_evento
	JOIN persona p ON i.idpersona = p.idpersona
ORDER BY e.id_evento;

-- -----------------------------------------------------
-- View `untrmeventos`.`v_venta`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `untrmeventos`.`v_venta`;
USE `untrmeventos`;
-- Modificado: 03/08/2020 07:04
CREATE  OR REPLACE VIEW `v_venta` AS
SELECT v.idventa,
	v.clave_transaccion,
    v.estado,
	v.paypal_datos->>"$.payer.payer_info.first_name" nombres,
    v.paypal_datos->>"$.payer.payer_info.last_name" apellidos,
    v.paypal_datos->>"$.payer.payer_info.email" correo_comprador,
    v.correo correo_proporcionado,
    v.paypal_datos->>"$.transactions[0].payee.email" correo_beneficiario,
    v.paypal_datos->>"$.payer.payer_info.phone" telefono,
    v.paypal_datos->>"$.payer.payer_info.shipping_address.line1" direccion,
    v.paypal_datos->>"$.payer.payer_info.shipping_address.city" ciudad,
    v.paypal_datos->>"$.payer.payer_info.shipping_address.state" provincia,
    v.paypal_datos->>"$.payer.payer_info.shipping_address.postal_code" cod_postal,
    v.paypal_datos->>"$.payer.payer_info.country_code" pais,
    v.paypal_datos->>"$.transactions[0].related_resources[0].sale.transaction_fee.currency" moneda,
	CAST(v.paypal_datos->>"$.transactions[0].related_resources[0].sale.transaction_fee.value" AS DECIMAL(14, 2)) tarifa_transaccion,
    IFNULL(
            (
                SELECT SUM(va.cantidad * a.precio)
                FROM venta_articulo va,
                    articulo a
                WHERE va.idarticulo = a.idarticulo
                    AND va.idventa = v.idventa
            ),
            0
    ) st_articulos,
    SUM(IFNULL(pl.precio, 0)) st_plan,
    (
		IFNULL(
            (
                SELECT SUM(va.cantidad * a.precio)
                FROM venta_articulo va,
                    articulo a
                WHERE va.idarticulo = a.idarticulo
                    AND va.idventa = v.idventa
            ),
            0
    ) + SUM(IFNULL(pl.precio, 0)) ) total,
    v.total_pre total_paypal,
    v.fecha_creacion,
    v.fecha_actualizacion
FROM venta v
LEFT JOIN boleto b
	ON b.idventa = v.idventa
LEFT JOIN plan pl
	ON b.idplan = pl.idplan
GROUP BY v.idventa
ORDER BY v.idventa;

-- -----------------------------------------------------
-- View `untrmeventos`.`v_boleto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `untrmeventos`.`v_boleto`;
USE `untrmeventos`;
-- Modificado: 09/08/2020 00:29
CREATE  OR REPLACE VIEW `v_boleto` AS
SELECT b.idboleto,
	CONCAT("FISME", SUBSTRING(YEAR(b.fecha_creacion), 3, 2), "-", b.idboleto) boleto,
    v.estado estado_venta,
    CONCAT(v.nombres, ' ', v.apellidos) comprador,
    CONCAT(p.nombres, ' ', p.apellidopa, ' ', p.apellidoma) asistente,
    pl.nombre plan,
    r.nombre_regalo regalo,
    p.email,
    p.telefono,
    p.doc_identidad,
    b.fecha_creacion,
    b.fecha_actualizacion
FROM persona p
INNER JOIN boleto b
	ON b.idpersona = p.idpersona
INNER JOIN plan pl
	ON b.idplan = pl.idplan
LEFT JOIN regalo r
	ON b.idregalo = r.idregalo
LEFT JOIN v_venta v
	ON b.idventa = v.idventa
ORDER BY idboleto;

-- -----------------------------------------------------
-- View `untrmeventos`.`v_categoria_cantidad_evento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `untrmeventos`.`v_categoria_cantidad_evento`;
USE `untrmeventos`;
-- Modificado: 16/07/2020 4:22
CREATE  OR REPLACE VIEW `v_categoria_cantidad_evento` AS
SELECT id_categoria,
	cat_evento categoria_evento,
	(
        SELECT count(*)
        FROM untrmeventos.evento
        WHERE id_cat_evento = id_categoria
    ) cantidad_evento
FROM categoria_evento
ORDER BY id_categoria;

-- -----------------------------------------------------
-- View `untrmeventos`.`v_venta_articulo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `untrmeventos`.`v_venta_articulo`;
USE `untrmeventos`;
-- Modificado: 02/08/2020 12:15
CREATE  OR REPLACE VIEW `v_venta_articulo` AS
SELECT 
	ab.idventa_articulo, 
    ab.idventa,
    ab.idarticulo,
    CONCAT(vb.nombres, " ", vb.apellidos) comprador,
    a.nombre_articulo articulo,
    a.precio,
    ab.cantidad,
    (a.precio * ab.cantidad) subtotal,
    a.url_imagen,
    vb.estado
FROM venta_articulo ab, v_venta vb, articulo a
WHERE ab.idventa = vb.idventa AND ab.idarticulo = a.idarticulo
ORDER BY vb.fecha_creacion DESC;

-- -----------------------------------------------------
-- View `untrmeventos`.`v_evento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `untrmeventos`.`v_evento`;
USE `untrmeventos`;
-- Modificado: 3:53 01-08-2020
CREATE  OR REPLACE VIEW `v_evento` AS
SELECT 
    id_evento, 
    nombre_evento evento, 
    fecha_evento fecha, 
    hora_evento hora, 
    cat_evento categoria, 
    CONCAT(nombres, ' ', apellidopa, ' ', apellidoma) AS invitado,
    clave
FROM evento
INNER JOIN categoria_evento
    ON evento.id_cat_evento = categoria_evento.id_categoria
INNER JOIN persona
    ON evento.id_inv = persona.idpersona
ORDER BY id_evento;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
