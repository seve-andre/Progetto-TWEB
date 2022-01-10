SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

CREATE SCHEMA IF NOT EXISTS `eat_up` DEFAULT CHARACTER SET utf8 ;
USE `eat_up` ;

-- -----------------------------------------------------
-- Table `eat_up`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `eat_up`.`user` (
  `id_user` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `password` VARCHAR(512) NOT NULL,
  `is_admin` TINYINT NULL DEFAULT 0,
  PRIMARY KEY (`id_user`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `eat_up`.`product`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `eat_up`.`product` (
  `id_product` INT NOT NULL AUTO_INCREMENT,
  `product_name` VARCHAR(100) NOT NULL,
  `product_img` VARCHAR(100) NOT NULL,
  `price` DECIMAL(4,2) NOT NULL,
  `description` TINYTEXT NOT NULL,
  `rating` DECIMAL(2,1) NOT NULL,
  `kcal` SMALLINT NOT NULL,
  PRIMARY KEY (`id_product`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `eat_up`.`category`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `eat_up`.`category` (
  `id_category` INT NOT NULL AUTO_INCREMENT,
  `category_name` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id_category`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `eat_up`.`product_has_category`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `eat_up`.`product_has_category` (
  `product` INT NOT NULL,
  `category` INT NOT NULL,
  PRIMARY KEY (`product`, `category`),
  INDEX `fk_product_category_category1_idx` (`category` ASC),
  INDEX `fk_product_category_product1_idx` (`product` ASC),
  CONSTRAINT `fk_product_category_product1`
    FOREIGN KEY (`product`)
    REFERENCES `eat_up`.`product` (`id_product`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_category_category1`
    FOREIGN KEY (`category`)
    REFERENCES `eat_up`.`category` (`id_category`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `eat_up`.`order`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `eat_up`.`order` (
  `id_order` INT NOT NULL AUTO_INCREMENT,
  `id_user` INT NOT NULL,
  `total_price` DECIMAL(10, 2) NOT NULL,
  `order_date` DATETIME NOT NULL,
  `shipping_address` VARCHAR(50) NOT NULL,
  `status` VARCHAR(30) NOT NULL,
  `payment_type` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id_order`),
  CONSTRAINT `fk_user_order_order1`
    FOREIGN KEY (`id_user`)
    REFERENCES `eat_up`.`user` (`id_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `eat_up`.`order_product`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `eat_up`.`order_product` (
  `product` INT NOT NULL,
  `order` INT NOT NULL,
  `quantity` INT NOT NULL,
  PRIMARY KEY (`product`, `order`),
  INDEX `fk_product_order_order1_idx` (`order` ASC),
  INDEX `fk_product_order_product1_idx` (`product` ASC),
  CONSTRAINT `fk_product_order_product1`
    FOREIGN KEY (`product`)
    REFERENCES `eat_up`.`product` (`id_product`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_order_order1`
    FOREIGN KEY (`order`)
    REFERENCES `eat_up`.`order` (`id_order`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `eat_up`.`delivery_man`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `eat_up`.`delivery_man` (
  `id_delivery_man` INT NOT NULL AUTO_INCREMENT,
  `delivery_man_name` VARCHAR(100) NOT NULL,
  `delivery_man_img` VARCHAR(100) NOT NULL DEFAULT 'default_img.png',
  PRIMARY KEY (`id_delivery_man`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `eat_up`.`notifications` (
  `id_notification` INT NOT NULL AUTO_INCREMENT,
  `id_order` INT NOT NULL,
  `id_delivery_man` INT NOT NULL,
  `seen` TINYINT NULL DEFAULT 0,
  PRIMARY KEY (`id_notification`),
  CONSTRAINT `fk_notification_order_order1`
    FOREIGN KEY (`id_order`)
    REFERENCES `eat_up`.`order` (`id_order`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_notification_delivery_man_delivery_man1`
    FOREIGN KEY (`id_delivery_man`)
    REFERENCES `eat_up`.`delivery_man` (`id_delivery_man`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
