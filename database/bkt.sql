SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';


-- -----------------------------------------------------
-- Table `bkt`.`categories`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bkt`.`categories` ;

CREATE  TABLE IF NOT EXISTS `bkt`.`categories` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `parent_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_categories_categories1_idx` (`parent_id` ASC) ,
  CONSTRAINT `fk_categories_categories1`
    FOREIGN KEY (`parent_id` )
    REFERENCES `bkt`.`categories` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bkt`.`pages`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bkt`.`pages` ;

CREATE  TABLE IF NOT EXISTS `bkt`.`pages` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `seo` VARCHAR(100) NULL ,
  `old_id` INT UNSIGNED NULL ,
  `categories_id` INT UNSIGNED NOT NULL ,
  `show` INT UNSIGNED NOT NULL DEFAULT 1 ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_pages_categories1_idx` (`categories_id` ASC) ,
  CONSTRAINT `fk_pages_categories1`
    FOREIGN KEY (`categories_id` )
    REFERENCES `bkt`.`categories` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bkt`.`pages_lang`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bkt`.`pages_lang` ;

CREATE  TABLE IF NOT EXISTS `bkt`.`pages_lang` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `id_lang` TINYINT UNSIGNED NULL ,
  `meta_desc` VARCHAR(225) NULL ,
  `meta_keywords` VARCHAR(255) NULL ,
  `title` VARCHAR(255) NULL ,
  `pages_id` INT UNSIGNED NOT NULL ,
  `name` VARCHAR(100) NULL ,
  `text` TEXT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_pages_lang_pages1_idx` (`pages_id` ASC) ,
  CONSTRAINT `fk_pages_lang_pages1`
    FOREIGN KEY (`pages_id` )
    REFERENCES `bkt`.`pages` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bkt`.`modules`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bkt`.`modules` ;

CREATE  TABLE IF NOT EXISTS `bkt`.`modules` (
  `id` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NULL ,
  `icon` VARCHAR(45) NULL DEFAULT 'icon_news' ,
  `class` VARCHAR(45) NULL ,
  `parent_id` TINYINT UNSIGNED NULL DEFAULT 1 ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bkt`.`roles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bkt`.`roles` ;

CREATE  TABLE IF NOT EXISTS `bkt`.`roles` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bkt`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bkt`.`users` ;

CREATE  TABLE IF NOT EXISTS `bkt`.`users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `username` VARCHAR(45) NULL ,
  `password` VARCHAR(100) NULL ,
  `has_logo` TINYINT NULL DEFAULT 0 ,
  `register_date` DATETIME NULL ,
  `last_login` DATETIME NULL ,
  `name` VARCHAR(150) NULL ,
  `active` TINYINT UNSIGNED NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bkt`.`roles_users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bkt`.`roles_users` ;

CREATE  TABLE IF NOT EXISTS `bkt`.`roles_users` (
  `role_id` INT UNSIGNED NOT NULL ,
  `user_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`role_id`, `user_id`) ,
  INDEX `fk_roles_users_users1_idx` (`user_id` ASC) ,
  CONSTRAINT `fk_roles_users_roles1`
    FOREIGN KEY (`role_id` )
    REFERENCES `bkt`.`roles` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_roles_users_users1`
    FOREIGN KEY (`user_id` )
    REFERENCES `bkt`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bkt`.`courses`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bkt`.`courses` ;

CREATE  TABLE IF NOT EXISTS `bkt`.`courses` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `courses_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_courses_courses1_idx` (`courses_id` ASC) ,
  CONSTRAINT `fk_courses_courses1`
    FOREIGN KEY (`courses_id` )
    REFERENCES `bkt`.`courses` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bkt`.`courses_lang`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bkt`.`courses_lang` ;

CREATE  TABLE IF NOT EXISTS `bkt`.`courses_lang` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `id_lang` INT UNSIGNED NOT NULL ,
  `name` VARCHAR(150) NULL ,
  `courses_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_courses_lang_courses1_idx` (`courses_id` ASC) ,
  CONSTRAINT `fk_courses_lang_courses1`
    FOREIGN KEY (`courses_id` )
    REFERENCES `bkt`.`courses` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bkt`.`schedule`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bkt`.`schedule` ;

CREATE  TABLE IF NOT EXISTS `bkt`.`schedule` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `group` INT UNSIGNED NOT NULL ,
  `price` INT UNSIGNED NOT NULL ,
  `lessons_count` INT UNSIGNED NOT NULL ,
  `time_from` TIME NOT NULL ,
  `time_to` TIME NOT NULL ,
  `people_count` INT UNSIGNED NOT NULL ,
  `days` VARCHAR(255) NULL ,
  `courses_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_schedule_courses1_idx` (`courses_id` ASC) ,
  CONSTRAINT `fk_schedule_courses1`
    FOREIGN KEY (`courses_id` )
    REFERENCES `bkt`.`courses` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bkt`.`individual_prices`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bkt`.`individual_prices` ;

CREATE  TABLE IF NOT EXISTS `bkt`.`individual_prices` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `base_lessons_count` INT UNSIGNED NULL ,
  `extended_lessons_count` INT UNSIGNED NULL ,
  `base_price` INT UNSIGNED NULL ,
  `extended_price` INT UNSIGNED NULL ,
  `courses_id` INT UNSIGNED NOT NULL ,
  `show` TINYINT NULL DEFAULT 1 ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_individual_prices_courses1_idx` (`courses_id` ASC) ,
  CONSTRAINT `fk_individual_prices_courses1`
    FOREIGN KEY (`courses_id` )
    REFERENCES `bkt`.`courses` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bkt`.`group_prices`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bkt`.`group_prices` ;

CREATE  TABLE IF NOT EXISTS `bkt`.`group_prices` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `people_count` INT UNSIGNED NULL ,
  `lessons_count` INT UNSIGNED NULL ,
  `courses_id` INT UNSIGNED NOT NULL ,
  `show` TINYINT NULL DEFAULT 1 ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_group_prices_courses1_idx` (`courses_id` ASC) ,
  CONSTRAINT `fk_group_prices_courses1`
    FOREIGN KEY (`courses_id` )
    REFERENCES `bkt`.`courses` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bkt`.`feedbacks`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bkt`.`feedbacks` ;

CREATE  TABLE IF NOT EXISTS `bkt`.`feedbacks` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `date` DATETIME NULL ,
  `text` TEXT NULL ,
  `users_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_feedbacks_users1_idx` (`users_id` ASC) ,
  CONSTRAINT `fk_feedbacks_users1`
    FOREIGN KEY (`users_id` )
    REFERENCES `bkt`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bkt`.`payments`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bkt`.`payments` ;

CREATE  TABLE IF NOT EXISTS `bkt`.`payments` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `date` DATE NULL ,
  `amount` INT UNSIGNED NOT NULL ,
  `students_id` INT UNSIGNED NOT NULL ,
  `teachers_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_payments_users1_idx` (`students_id` ASC) ,
  INDEX `fk_payments_users2_idx` (`teachers_id` ASC) ,
  CONSTRAINT `fk_payments_users1`
    FOREIGN KEY (`students_id` )
    REFERENCES `bkt`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_payments_users2`
    FOREIGN KEY (`teachers_id` )
    REFERENCES `bkt`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bkt`.`prices_group`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bkt`.`prices_group` ;

CREATE  TABLE IF NOT EXISTS `bkt`.`prices_group` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `people_count` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bkt`.`timetable`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bkt`.`timetable` ;

CREATE  TABLE IF NOT EXISTS `bkt`.`timetable` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `room` ENUM('first','second') NULL ,
  `time_from` TIME NULL ,
  `time_to` TIME NULL ,
  `date` DATE NULL ,
  `users_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_timetable_users1_idx` (`users_id` ASC) ,
  CONSTRAINT `fk_timetable_users1`
    FOREIGN KEY (`users_id` )
    REFERENCES `bkt`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bkt`.`libraries`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bkt`.`libraries` ;

CREATE  TABLE IF NOT EXISTS `bkt`.`libraries` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NULL ,
  `file` VARCHAR(255) NULL ,
  `courses_id` INT UNSIGNED NOT NULL ,
  `has_logo` TINYINT NULL DEFAULT 0 ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_libraries_courses1_idx` (`courses_id` ASC) ,
  CONSTRAINT `fk_libraries_courses1`
    FOREIGN KEY (`courses_id` )
    REFERENCES `bkt`.`courses` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
