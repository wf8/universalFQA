USE universal_fqa;
ALTER TABLE `transect` ADD COLUMN `transect_type` VARCHAR(256) NULL;
ALTER TABLE `transect` ADD COLUMN `plot_size` VARCHAR(256) NULL;
ALTER TABLE `transect` ADD COLUMN `subplot_size` VARCHAR(256) NULL;
ALTER TABLE `transect` ADD COLUMN `transect_length` VARCHAR(256) NULL;
ALTER TABLE `transect` ADD COLUMN `transect_description` TEXT NULL;
ALTER TABLE `transect` ADD COLUMN `cover_method_id` INT NULL DEFAULT 0;
ALTER TABLE `transect` ADD COLUMN `community_code` VARCHAR(256) NULL;
ALTER TABLE `transect` ADD COLUMN `community_name` VARCHAR(256) NULL;
ALTER TABLE `transect` ADD COLUMN `environment_description` TEXT NULL;

ALTER TABLE `quadrat` ADD COLUMN `quadrat_type` INT NOT NULL DEFAULT 0;
ALTER TABLE `quadrat_taxa` ADD COLUMN `cover_method_value_id` INT NULL;

CREATE TABLE `cover_methods` (
 `id` INT NOT NULL,
 `name` VARCHAR(256) NOT NULL,
PRIMARY KEY (`id`)
);

CREATE TABLE `cover_method_values` (
 `id` INT NOT NULL AUTO_INCREMENT,
 `cover_method_id` INT NOT NULL,
 `display_name` VARCHAR(256) NOT NULL,
 `midpoint_value` DOUBLE(5,2) NOT NULL DEFAULT 0.0,
INDEX (`cover_method_id` ),
PRIMARY KEY (`id`)
);

INSERT INTO `cover_methods` (`id`, `name`) VALUES (0, "% Cover (0 - 100)");
INSERT INTO `cover_methods` (`id`, `name`) VALUES (1, "Braun-Blanquet");
INSERT INTO `cover_methods` (`id`, `name`) VALUES (2, "PLOTS2 Braun-Blanquet");
INSERT INTO `cover_methods` (`id`, `name`) VALUES (3, "Modified Braun-Blanquet 7-pt scale");
INSERT INTO `cover_methods` (`id`, `name`) VALUES (4, "Carolina Vegetation Survey");
INSERT INTO `cover_methods` (`id`, `name`) VALUES (5, "Daubenmire 1959");
INSERT INTO `cover_methods` (`id`, `name`) VALUES (6, "U.S. Forest Service ECODATA");

INSERT INTO `cover_method_values` (`cover_method_id`, `display_name`, `midpoint_value`) VALUES (1, "r: single (0.05)", 0.05);
INSERT INTO `cover_method_values` (`cover_method_id`, `display_name`, `midpoint_value`) VALUES (1, "+: few (0.5)", 0.5);
INSERT INTO `cover_method_values` (`cover_method_id`, `display_name`, `midpoint_value`) VALUES (1, "1: <5% (2.5)", 2.5);
INSERT INTO `cover_method_values` (`cover_method_id`, `display_name`, `midpoint_value`) VALUES (1, "2: 5-25% (15)", 15);
INSERT INTO `cover_method_values` (`cover_method_id`, `display_name`, `midpoint_value`) VALUES (1, "3: 25-50% (37.5)", 37.5);
INSERT INTO `cover_method_values` (`cover_method_id`, `display_name`, `midpoint_value`) VALUES (1, "4: 50-75% (62.5)", 62.5);
INSERT INTO `cover_method_values` (`cover_method_id`, `display_name`, `midpoint_value`) VALUES (1, "5: 75-100% (87.5)", 87.5);

INSERT INTO `cover_method_values` (`cover_method_id`, `display_name`, `midpoint_value`) VALUES (2, "1: <1% (0.5)", 0.5);
INSERT INTO `cover_method_values` (`cover_method_id`, `display_name`, `midpoint_value`) VALUES (2, "2: 1-5% (3)", 3);
INSERT INTO `cover_method_values` (`cover_method_id`, `display_name`, `midpoint_value`) VALUES (2, "3: 5-25% (15)", 15);
INSERT INTO `cover_method_values` (`cover_method_id`, `display_name`, `midpoint_value`) VALUES (2, "4: 25-50% (37.5)", 37.5);
INSERT INTO `cover_method_values` (`cover_method_id`, `display_name`, `midpoint_value`) VALUES (2, "5: 50-75% (62.5)", 62.5);
INSERT INTO `cover_method_values` (`cover_method_id`, `display_name`, `midpoint_value`) VALUES (2, "6: 75-100% (87.5)", 87.5);

INSERT INTO `cover_method_values` (`cover_method_id`, `display_name`, `midpoint_value`) VALUES (3, "1: <1% (0.5)", 0.5);
INSERT INTO `cover_method_values` (`cover_method_id`, `display_name`, `midpoint_value`) VALUES (3, "2: 1-5% (3)", 3);
INSERT INTO `cover_method_values` (`cover_method_id`, `display_name`, `midpoint_value`) VALUES (3, "3a: 5-10% (7.5)", 7.5);
INSERT INTO `cover_method_values` (`cover_method_id`, `display_name`, `midpoint_value`) VALUES (3, "3b: 10-25% (17.5)", 17.5);
INSERT INTO `cover_method_values` (`cover_method_id`, `display_name`, `midpoint_value`) VALUES (3, "4: 25-50% (37.5)", 37.5);
INSERT INTO `cover_method_values` (`cover_method_id`, `display_name`, `midpoint_value`) VALUES (3, "5: 50-75% (62.5)", 62.5);
INSERT INTO `cover_method_values` (`cover_method_id`, `display_name`, `midpoint_value`) VALUES (3, "6: 75-100% (87.5)", 87.5);

INSERT INTO `cover_method_values` (`cover_method_id`, `display_name`, `midpoint_value`) VALUES (4, "1: trace (0.05)", 0.05);
INSERT INTO `cover_method_values` (`cover_method_id`, `display_name`, `midpoint_value`) VALUES (4, "2: 0.1-1% (0.51)", 0.51);
INSERT INTO `cover_method_values` (`cover_method_id`, `display_name`, `midpoint_value`) VALUES (4, "3: 1-2% (1.5)", 1.5);
INSERT INTO `cover_method_values` (`cover_method_id`, `display_name`, `midpoint_value`) VALUES (4, "4: 2-5% (3.5)", 3.5);
INSERT INTO `cover_method_values` (`cover_method_id`, `display_name`, `midpoint_value`) VALUES (4, "5: 5-10% (7.5)", 7.5);
INSERT INTO `cover_method_values` (`cover_method_id`, `display_name`, `midpoint_value`) VALUES (4, "6: 10-25% (17.5)", 17.5);
INSERT INTO `cover_method_values` (`cover_method_id`, `display_name`, `midpoint_value`) VALUES (4, "7: 25-50% (37.5)", 37.5);
INSERT INTO `cover_method_values` (`cover_method_id`, `display_name`, `midpoint_value`) VALUES (4, "8: 50-75% (62.5)", 62.5);
INSERT INTO `cover_method_values` (`cover_method_id`, `display_name`, `midpoint_value`) VALUES (4, "9: 75-95% (85)", 85);
INSERT INTO `cover_method_values` (`cover_method_id`, `display_name`, `midpoint_value`) VALUES (4, "10: 95-100% (97.5)", 97.5);

INSERT INTO `cover_method_values` (`cover_method_id`, `display_name`, `midpoint_value`) VALUES (5, "1: 0-5% (2.5)", 97.5);
INSERT INTO `cover_method_values` (`cover_method_id`, `display_name`, `midpoint_value`) VALUES (5, "2: 5-25% (15)", 97.5);
INSERT INTO `cover_method_values` (`cover_method_id`, `display_name`, `midpoint_value`) VALUES (5, "3: 25-50% (37.5)", 97.5);
INSERT INTO `cover_method_values` (`cover_method_id`, `display_name`, `midpoint_value`) VALUES (5, "4: 50-75% (62.5)", 97.5);
INSERT INTO `cover_method_values` (`cover_method_id`, `display_name`, `midpoint_value`) VALUES (5, "5: 75-95% (85)", 97.5);
INSERT INTO `cover_method_values` (`cover_method_id`, `display_name`, `midpoint_value`) VALUES (5, "6: 95-100% (97.5)", 97.5);

INSERT INTO `cover_method_values` (`cover_method_id`, `display_name`, `midpoint_value`) VALUES (6, "T: <1% (0.5)", 0.5);
INSERT INTO `cover_method_values` (`cover_method_id`, `display_name`, `midpoint_value`) VALUES (6, "P: 1-4% (3)", 3);
INSERT INTO `cover_method_values` (`cover_method_id`, `display_name`, `midpoint_value`) VALUES (6, "1: 5-14% (10)", 10);
INSERT INTO `cover_method_values` (`cover_method_id`, `display_name`, `midpoint_value`) VALUES (6, "2: 15-24% (20)", 20);
INSERT INTO `cover_method_values` (`cover_method_id`, `display_name`, `midpoint_value`) VALUES (6, "3: 25-34% (30)", 30);
INSERT INTO `cover_method_values` (`cover_method_id`, `display_name`, `midpoint_value`) VALUES (6, "4: 35-44% (40)", 40);
INSERT INTO `cover_method_values` (`cover_method_id`, `display_name`, `midpoint_value`) VALUES (6, "5: 45-54% (50)", 50);
INSERT INTO `cover_method_values` (`cover_method_id`, `display_name`, `midpoint_value`) VALUES (6, "6: 55-64% (60)", 60);
INSERT INTO `cover_method_values` (`cover_method_id`, `display_name`, `midpoint_value`) VALUES (6, "7: 65-74% (70)", 70);
INSERT INTO `cover_method_values` (`cover_method_id`, `display_name`, `midpoint_value`) VALUES (6, "8: 75-84% (80)", 80);
INSERT INTO `cover_method_values` (`cover_method_id`, `display_name`, `midpoint_value`) VALUES (6, "9: 85-94% (90)", 90);
INSERT INTO `cover_method_values` (`cover_method_id`, `display_name`, `midpoint_value`) VALUES (6, "10: 95-100% (98)", 98);

CREATE TABLE `quadrat_types` (
 `id` INT NOT NULL,
 `name` VARCHAR(256) NOT NULL,
 `display_name` VARCHAR(256) NOT NULL,
PRIMARY KEY (`id`)
);

INSERT INTO `quadrat_types` (`id`, `name`, `display_name`) VALUES (0, "QuadratSubplot", "Quadrat/Subplot");
INSERT INTO `quadrat_types` (`id`, `name`, `display_name`) VALUES (1, "FullTrPlot", "Full Transect/Plot");
INSERT INTO `quadrat_types` (`id`, `name`, `display_name`) VALUES (2, "OutsideTrPlot", "Outside Transect/Plot");
INSERT INTO `quadrat_types` (`id`, `name`, `display_name`) VALUES (3, "RestOfTrPlot", "Rest of Transect/Plot");
