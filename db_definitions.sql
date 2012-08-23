CREATE TABLE `fqa` (
 `id` INT NOT NULL AUTO_INCREMENT,
 `region` VARCHAR(128) NOT NULL,
 `publication_year` VARCHAR(4) NOT NULL,
 `citation` TEXT NOT NULL,
 `user_id` INT NOT NULL,
PRIMARY KEY (  `id` )
) ENGINE = INNODB;

CREATE TABLE `taxa` (
 `id` INT NOT NULL AUTO_INCREMENT,
 `fqa_id` INT NOT NULL,
 `scientific_name` VARCHAR(256) NOT NULL,
 `common_name` VARCHAR(256) NULL,
 `acronym` VARCHAR(8) NULL,
 `c_o_c` INT NOT NULL,
 `c_o_w` INT NULL,
 `nativity` BOOLEAN NOT NULL,
 `physiognomy` VARCHAR(10) NULL,
 `duration` VARCHAR(10) NULL,
PRIMARY KEY (  `id` ),
INDEX (`fqa_id`)
)  ENGINE = INNODB;

CREATE TABLE `inventory` (
 `id` INT NOT NULL AUTO_INCREMENT,
 `user_id` INT NOT NULL,
 `name` VARCHAR(256) NOT NULL,
 `notes` TEXT NULL,
PRIMARY KEY (  `id` )
)  ENGINE = INNODB;

CREATE TABLE `inventory_taxa` (
 `id` INT NOT NULL AUTO_INCREMENT,
 `inventory_id` INT NOT NULL,
 `taxa_id` INT NOT NULL,
 `percent_coverage` INT NULL,
INDEX (`inventory_id`, `taxa_id`),
PRIMARY KEY (  `id` )
)  ENGINE = INNODB;

CREATE TABLE `transect` (
 `id` INT NOT NULL AUTO_INCREMENT,
 `user_id` INT NOT NULL,
 `name` VARCHAR(256) NOT NULL,
 `notes` TEXT NULL,
PRIMARY KEY (  `id` )
)  ENGINE = INNODB;

CREATE TABLE `transect_inventory` (
 `id` INT NOT NULL AUTO_INCREMENT,
 `transect_id` INT NOT NULL,
 `inventory_id` INT NOT NULL,
INDEX (`transect_id`, `inventory_id`),
PRIMARY KEY (  `id` )
)  ENGINE = INNODB;

CREATE TABLE `user` (
 `id` INT NOT NULL AUTO_INCREMENT,
 `email` VARCHAR(50) NOT NULL UNIQUE,
 `first_name` TEXT NULL ,
 `last_name` TEXT NULL ,
 `password` VARCHAR(64) NOT NULL,
 `salt` VARCHAR(3) NOT NULL,
PRIMARY KEY (  `id` )
)  ENGINE = INNODB;
