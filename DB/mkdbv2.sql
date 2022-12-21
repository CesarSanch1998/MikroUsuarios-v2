-- MySQL Script generated by MySQL Workbench
-- Thu Dec 15 12:22:46 2022
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mkdbv2
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `mkdbv2` ;

-- -----------------------------------------------------
-- Schema mkdbv2
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mkdbv2` DEFAULT CHARACTER SET utf8 ;
USE `mkdbv2` ;

-- -----------------------------------------------------
-- Table `mkdbv2`.`Usuarios_Creados`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mkdbv2`.`Usuarios_Creados` ;

CREATE TABLE IF NOT EXISTS `mkdbv2`.`Usuarios_Creados` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `Usuario` VARCHAR(6) NULL,
  `Contraseña` VARCHAR(6) NULL,
  `Fecha_Creacion` DATE NOT NULL,
  `Tipo` VARCHAR(10) NOT NULL,
  `User_Profile` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mkdbv2`.`Usuarios_Activos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mkdbv2`.`Usuarios_Activos` ;

CREATE TABLE IF NOT EXISTS `mkdbv2`.`Usuarios_Activos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `Nombre_Cliente` VARCHAR(30) NOT NULL,
  `Mesa` INT NULL,
  `Fecha_Venta` DATE NULL,
  `Fecha_Vencimiento` DATE NULL,
  `Estatus_Mikrotik` TINYINT NULL,
  `Usuarios_Creados_id` INT NOT NULL,
  PRIMARY KEY (`id`, `Usuarios_Creados_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mkdbv2`.`Usuarios_Vencidos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mkdbv2`.`Usuarios_Vencidos` ;

CREATE TABLE IF NOT EXISTS `mkdbv2`.`Usuarios_Vencidos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `Nombre_Cliente` VARCHAR(30) NOT NULL,
  `Mesa` INT NULL,
  `Fecha_Venta` DATE NULL,
  `Fecha_Vencimiento` DATE NULL,
  `Estatus_Mikrotik` TINYINT NULL,
  `Usuarios_Creados_id` INT NOT NULL,
  PRIMARY KEY (`id`, `Usuarios_Creados_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mkdbv2`.`Pago_Registro`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mkdbv2`.`Pago_Registro` ;

CREATE TABLE IF NOT EXISTS `mkdbv2`.`Pago_Registro` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `Nombre_Cliente` VARCHAR(30) NOT NULL,
  `Mesa` INT NOT NULL,
  `Pagado` FLOAT NULL,
  `Pendiente` FLOAT NULL,
  `Fecha_Venta` DATE NULL,
  `Fecha_Abono` DATE NULL,
  `Usuarios_Deudores_id` INT NOT NULL,
  `Usuarios_Deudores_Usuarios_Creados_id` INT NOT NULL,
  PRIMARY KEY (`id`, `Usuarios_Deudores_id`, `Usuarios_Deudores_Usuarios_Creados_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mkdbv2`.`Usuarios_Deudores`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mkdbv2`.`Usuarios_Deudores` ;

CREATE TABLE IF NOT EXISTS `mkdbv2`.`Usuarios_Deudores` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `Nombre_Cliente` VARCHAR(30) NOT NULL,
  `Mesa` INT NULL,
  `Pagado` FLOAT NULL,
  `Pendiente` FLOAT NULL,
  `Fecha_Venta` DATE NULL,
  `Fecha_Abono` DATE NULL,
  `Usuarios_Creados_id` INT NOT NULL,
  PRIMARY KEY (`id`, `Usuarios_Creados_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mkdbv2`.`Usuarios_Pausados`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mkdbv2`.`Usuarios_Pausados` ;

CREATE TABLE IF NOT EXISTS `mkdbv2`.`Usuarios_Pausados` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `Nombre_Cliente` VARCHAR(30) NOT NULL,
  `Mesa` INT NULL,
  `Fecha_Venta` DATE NULL,
  `Fecha_Vencimiento` DATE NULL,
  `Fecha_Pausado` DATE NULL,
  `Dias_Restantes` INT NULL,
  `Usuarios_Creados_id` INT NOT NULL,
  PRIMARY KEY (`id`, `Usuarios_Creados_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mkdbv2`.`Acciones_Registro`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mkdbv2`.`Acciones_Registro` ;

CREATE TABLE IF NOT EXISTS `mkdbv2`.`Acciones_Registro` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `Accion` VARCHAR(20) NOT NULL,
  `Nombre_Cliente` VARCHAR(30) NOT NULL COMMENT 'hola codfgfdghfghljktpaotreh5u7fj65kfu6j',
  `Usuario` VARCHAR(10) NOT NULL,
  `Fecha_Accion` DATE NULL,
  `Log` VARCHAR(70) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
