CREATE SCHEMA `palestra` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE `palestra`.`posts` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `title` VARCHAR(45) NOT NULL COMMENT '',
  `body` TEXT NOT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '');

INSERT INTO `palestra`.`posts` (`title`, `body`) VALUES ('Palestra TDC', 'Trabalhando de forma profissional com Silex');