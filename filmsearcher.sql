-- MySQL Script generated by MySQL Workbench
-- Sun May 28 23:59:49 2023
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema filmsearcher
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema filmsearcher
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `filmsearcher` DEFAULT CHARACTER SET utf8 ;
USE `filmsearcher` ;

-- -----------------------------------------------------
-- Table `filmsearcher`.`FILM`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `filmsearcher`.`FILM` (
  `idFILM` INT NOT NULL,
  PRIMARY KEY (`idFILM`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `filmsearcher`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `filmsearcher`.`user` (
  `iduser` INT NOT NULL,
  `nickname` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `isAdmin` TINYINT NULL,
  PRIMARY KEY (`iduser`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `filmsearcher`.`folders`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `filmsearcher`.`folders` (
  `idfolders` INT NOT NULL,
  `privacy` TINYINT NOT NULL,
  `description` VARCHAR(400) NULL,
  `user_iduser` INT NOT NULL,
  PRIMARY KEY (`idfolders`, `user_iduser`),
  INDEX `fk_folders_user1_idx` (`user_iduser` ASC) VISIBLE,
  CONSTRAINT `fk_folders_user1`
    FOREIGN KEY (`user_iduser`)
    REFERENCES `filmsearcher`.`user` (`iduser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `filmsearcher`.`category`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `filmsearcher`.`category` (
  `idcategory` INT NOT NULL,
  `cname` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idcategory`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `filmsearcher`.`media`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `filmsearcher`.`media` (
  `idmedia` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(45) NOT NULL,
  `image_cover` MEDIUMBLOB NOT NULL,
  `release` DATE NOT NULL,
  `rating` DECIMAL(2,1) NOT NULL,
  `description` VARCHAR(400) NULL,
  `folders_idfolders` INT NOT NULL,
  `folders_user_iduser` INT NOT NULL,
  `category_idcategory` INT NOT NULL,
  PRIMARY KEY (`idmedia`, `folders_idfolders`, `folders_user_iduser`, `category_idcategory`),
  UNIQUE INDEX `title_UNIQUE` (`title` ASC) VISIBLE,
  INDEX `fk_elements_folders1_idx` (`folders_idfolders` ASC, `folders_user_iduser` ASC) VISIBLE,
  INDEX `fk_elements_category1_idx` (`category_idcategory` ASC) VISIBLE,
  CONSTRAINT `fk_elements_folders1`
    FOREIGN KEY (`folders_idfolders` , `folders_user_iduser`)
    REFERENCES `filmsearcher`.`folders` (`idfolders` , `user_iduser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_elements_category1`
    FOREIGN KEY (`category_idcategory`)
    REFERENCES `filmsearcher`.`category` (`idcategory`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `filmsearcher`.`genres`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `filmsearcher`.`genres` (
  `idgenre` INT NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `elements_idelements` INT NOT NULL,
  PRIMARY KEY (`idgenre`, `elements_idelements`),
  INDEX `fk_genres_elements1_idx` (`elements_idelements` ASC) VISIBLE,
  CONSTRAINT `fk_genres_elements1`
    FOREIGN KEY (`elements_idelements`)
    REFERENCES `filmsearcher`.`media` (`idmedia`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `filmsearcher`.`images`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `filmsearcher`.`images` (
  `idimage` INT NOT NULL,
  `path` MEDIUMBLOB NULL,
  `elements_idelements` INT NOT NULL,
  PRIMARY KEY (`idimage`, `elements_idelements`),
  INDEX `fk_images_elements1_idx` (`elements_idelements` ASC) VISIBLE,
  CONSTRAINT `fk_images_elements1`
    FOREIGN KEY (`elements_idelements`)
    REFERENCES `filmsearcher`.`media` (`idmedia`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
