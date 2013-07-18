CREATE DATABASE `universal_fqa`;
GRANT ALL PRIVILEGES ON universal_fqa.* TO root@localhost IDENTIFIED BY 'root';
USE universal_fqa;

CREATE TABLE `fqa` (
 `id` INT NOT NULL AUTO_INCREMENT,
 `region_name` VARCHAR(128) NOT NULL,
 `description` TEXT NOT NULL,
 `publication_year` VARCHAR(4) NOT NULL,
 `created` DATE NOT NULL,
 `user_id` INT NOT NULL,
PRIMARY KEY (  `id` )
);

CREATE TABLE `taxa` (
 `id` INT NOT NULL AUTO_INCREMENT,
 `fqa_id` INT NOT NULL,
 `scientific_name` VARCHAR(256) NOT NULL,
 `family` VARCHAR(256) NULL,
 `common_name` VARCHAR(256) NULL,
 `acronym` VARCHAR(8) NULL,
 `c_o_c` INT NOT NULL,
 `c_o_w` INT NULL DEFAULT NULL,
 `native` BOOLEAN NOT NULL,
 `physiognomy` VARCHAR(10) NULL,
 `duration` VARCHAR(10) NULL,
PRIMARY KEY (  `id` ),
INDEX (`fqa_id`)
);

CREATE TABLE `customized_fqa` (
 `id` INT NOT NULL AUTO_INCREMENT,
 `fqa_id` INT NOT NULL,
 `region_name` VARCHAR(128) NOT NULL,
 `publication_year` VARCHAR(4) NOT NULL,
 `customized_name` TEXT NULL,
 `customized_description` TEXT NULL,
 `created` DATE NOT NULL,
 `user_id` INT NOT NULL,
PRIMARY KEY ( `id` ),
INDEX (`user_id`)
);

CREATE TABLE `customized_taxa` (
 `id` INT NOT NULL AUTO_INCREMENT,
 `customized_fqa_id` INT NOT NULL,
 `fqa_id` INT NOT NULL,
 `scientific_name` VARCHAR(256) NOT NULL,
 `family` VARCHAR(256) NULL,
 `common_name` VARCHAR(256) NULL,
 `acronym` VARCHAR(8) NULL,
 `c_o_c` INT NOT NULL,
 `c_o_w` INT NULL DEFAULT NULL,
 `native` BOOLEAN NOT NULL,
 `physiognomy` VARCHAR(10) NULL,
 `duration` VARCHAR(10) NULL,
PRIMARY KEY (  `id` ),
INDEX ( `customized_fqa_id`, `fqa_id` )
);

CREATE TABLE `site` (
 `id` INT NOT NULL AUTO_INCREMENT,
 `user_id` INT NOT NULL,
 `name` VARCHAR(256) NOT NULL,
 `location` TEXT NULL,
 `city` VARCHAR(256) NULL,
 `county` VARCHAR(256) NULL,
 `state` VARCHAR(256) NULL,
 `country` VARCHAR(256) NULL,
 `notes` TEXT NULL,
PRIMARY KEY (  `id` )
);

CREATE TABLE `inventory` (
 `id` INT NOT NULL AUTO_INCREMENT,
 `user_id` INT NOT NULL,
 `fqa_id` INT NOT NULL,
 `site_id` INT NOT NULL,
 `date` DATE NOT NULL,
 `private` BOOLEAN NOT NULL DEFAULT 0,
 `practitioner` TEXT NOT NULL,
 `latitude` VARCHAR(256) NULL,
 `longitude` VARCHAR(256) NULL,
 `weather_notes` TEXT NULL,
 `duration_notes` TEXT NULL,
 `community_type_notes` TEXT NULL,
 `other_notes` TEXT NULL,
INDEX ( `user_id`, `site_id`, `fqa_id`, `date` ),
PRIMARY KEY (  `id` )
);

CREATE TABLE `inventory_taxa` (
 `id` INT NOT NULL AUTO_INCREMENT,
 `inventory_id` INT NOT NULL,
 `site_id` INT NOT NULL,
 `fqa_id` INT NOT NULL,
 `taxa_id` INT NOT NULL,
INDEX (`inventory_id`, `taxa_id`),
PRIMARY KEY (  `id` )
);

CREATE TABLE `transect` (
 `id` INT NOT NULL AUTO_INCREMENT,
 `user_id` INT NOT NULL,
 `fqa_id` INT NOT NULL,
 `site_id` INT NOT NULL,
 `date` DATE NOT NULL,
 `private` BOOLEAN NOT NULL DEFAULT 0,
 `practitioner` TEXT NOT NULL,
 `latitude` VARCHAR(256) NULL,
 `longitude` VARCHAR(256) NULL,
 `weather_notes` TEXT NULL,
 `duration_notes` TEXT NULL,
 `community_type_notes` TEXT NULL,
 `other_notes` TEXT NULL,
INDEX ( `user_id`, `site_id`, `fqa_id`, `date` ),
PRIMARY KEY (  `id` )
);

CREATE TABLE `quadrat` (
 `id` INT NOT NULL AUTO_INCREMENT,
 `transect_id` INT NOT NULL,
 `site_id` INT NOT NULL,
 `fqa_id` INT NOT NULL,
 `name` VARCHAR(256) NOT NULL,
 `active` BOOLEAN NOT NULL DEFAULT 1,
 `latitude` VARCHAR(256) NULL,
 `longitude` VARCHAR(256) NULL,
INDEX (`transect_id` ),
PRIMARY KEY (  `id` )
);

CREATE TABLE `quadrat_taxa` (
 `id` INT NOT NULL AUTO_INCREMENT,
 `quadrat_id` INT NOT NULL,
 `transect_id` INT NOT NULL,
 `site_id` INT NOT NULL,
 `fqa_id` INT NOT NULL,
 `taxa_id` INT NOT NULL,
 `percent_coverage` INT NULL,
INDEX ( `quadrat_id`, `transect_id`, `taxa_id`),
PRIMARY KEY (  `id` )
);

CREATE TABLE `user` (
 `id` INT NOT NULL AUTO_INCREMENT,
 `email` VARCHAR(50) NOT NULL UNIQUE,
 `first_name` TEXT NULL ,
 `last_name` TEXT NULL ,
 `password` VARCHAR(64) NOT NULL,
 `salt` VARCHAR(3) NOT NULL,
 `editor` BOOLEAN NOT NULL DEFAULT 0,
 `admin` BOOLEAN NOT NULL DEFAULT 0,
PRIMARY KEY (  `id` )
);
