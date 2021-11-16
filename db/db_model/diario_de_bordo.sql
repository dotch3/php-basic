-- MySQL Script generated by MySQL Workbench
-- Sat Nov  6 01:03:03 2021
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema diario_bordo
-- -----------------------------------------------------
-- 				

-- -----------------------------------------------------
-- Schema diario_bordo
--
-- 				
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `diario_bordo` DEFAULT CHARACTER SET utf8 ;
USE `diario_bordo` ;

-- -----------------------------------------------------
-- Table `diario_bordo`.`categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `diario_bordo`.`categoria` (
  `categoria_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `create_date` DATETIME GENERATED ALWAYS AS (),
  `modify_date` DATETIME GENERATED ALWAYS AS (),
  `delete_date` DATETIME GENERATED ALWAYS AS (),
  PRIMARY KEY (`categoria_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `diario_bordo`.`picture`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `diario_bordo`.`picture` (
  `picture_id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(250) NOT NULL,
  `location` VARCHAR(250) NOT NULL,
  `post_id` INT UNSIGNED NULL,
  PRIMARY KEY (`picture_id`),
  CONSTRAINT `post_id`
    FOREIGN KEY (`post_id`)
    REFERENCES `diario_bordo`.`post` (`post_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `post_id_idx` ON `diario_bordo`.`picture` (`post_id` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `diario_bordo`.`post`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `diario_bordo`.`post` (
  `post_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(250) NOT NULL,
  `description` LONGTEXT NULL,
  `create_date` DATETIME GENERATED ALWAYS AS (),
  `modify_date` DATETIME GENERATED ALWAYS AS (),
  `delete_date` DATETIME GENERATED ALWAYS AS (),
  `categoria_id` INT UNSIGNED NULL,
  PRIMARY KEY (`post_id`),
  CONSTRAINT `categoria_id`
    FOREIGN KEY (`categoria_id`)
    REFERENCES `diario_bordo`.`categoria` (`categoria_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `categoria_id_idx` ON `diario_bordo`.`post` (`categoria_id` ASC) VISIBLE;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;