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
INSERT INTO `cover_method_values` (`cover_method_id`, `display_name`, `midpoint_value`) VALUES (4, "2: 0.1-1% (0.55)", 0.55);
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

CREATE TABLE `fqa_states` (
 `id` INT NOT NULL AUTO_INCREMENT,
 `fqa_id` INT NOT NULL,
 `is_custom_fqa` TINYINT(1) NOT NULL DEFAULT 0,
 `state_id` INT NOT NULL,
 INDEX (`fqa_id`),
 INDEX (`state_id`),
 PRIMARY KEY (`id`)
);

CREATE TABLE `states_provinces` (
 `id` INT NOT NULL AUTO_INCREMENT,
 `country` VARCHAR(6) NOT NULL,
 `abbr` VARCHAR(6) NOT NULL,
 `name` VARCHAR(64) NOT NULL,
 INDEX (`abbr`),
 INDEX (`country`),
 PRIMARY KEY (`id`)
);

INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("US", "AK", "Alaska");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("US", "AL", "Alabama");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("US", "AP", "Armed Forces Pacific");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("US", "AR", "Arkansas");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("US", "AS", "American Samoa");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("US", "AZ", "Arizona");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("US", "CA", "California");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("US", "CO", "Colorado");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("US", "CT", "Connecticut");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("US", "DC", "District of Columbia");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("US", "DE", "Delaware");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("US", "FL", "Florida");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("US", "FM", "Federated States of Micronesia");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("US", "GA", "Georgia");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("US", "GU", "Guam");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("US", "HI", "Hawaii");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("US", "IA", "Iowa");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("US", "ID", "Idaho");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("US", "IL", "Illinois");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("US", "IN", "Indiana");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("US", "KS", "Kansas");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("US", "KY", "Kentucky");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("US", "LA", "Louisiana");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("US", "MA", "Massachusetts");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("US", "MD", "Maryland");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("US", "ME", "Maine");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("US", "MH", "Marshall Islands");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("US", "MI", "Michigan");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("US", "MN", "Minnesota");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("US", "MO", "Missouri");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("US", "MP", "Northern Mariana Islands");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("US", "MS", "Mississippi");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("US", "MT", "Montana");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("US", "NC", "North Carolina");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("US", "ND", "North Dakota");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("US", "NE", "Nebraska");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("US", "NH", "New Hampshire");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("US", "NJ", "New Jersey");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("US", "NM", "New Mexico");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("US", "NV", "Nevada");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("US", "NY", "New York");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("US", "OH", "Ohio");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("US", "OK", "Oklahoma");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("US", "OR", "Oregon");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("US", "PA", "Pennsylvania");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("US", "PR", "Puerto Rico");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("US", "PW", "Palau");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("US", "RI", "Rhode Island");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("US", "SC", "South Carolina");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("US", "SD", "South Dakota");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("US", "TN", "Tennessee");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("US", "TX", "Texas");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("US", "UT", "Utah");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("US", "VA", "Virginia");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("US", "VI", "Virgin Islands");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("US", "VT", "Vermont");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("US", "WA", "Washington");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("US", "WV", "West Virginia");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("US", "WI", "Wisconsin");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("US", "WY", "Wyoming");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("CA", "AB", "Alberta");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("CA", "BC", "British Columbia");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("CA", "MB", "Manitoba");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("CA", "NB", "New Brunswick");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("CA", "NL", "Newfoundland");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("CA", "NS", "Nova Scotia");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("CA", "NU", "Nunavut");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("CA", "ON", "Ontario");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("CA", "PE", "Prince Edward Island");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("CA", "QC", "Quebec");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("CA", "SK", "Saskatchewan");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("CA", "NT", "Northwest Territories");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("CA", "YT", "Yukon Territory");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("MX", "AG", "Aguascalientes");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("MX", "BC", "Baja California");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("MX", "BS", "Baja California Sur");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("MX", "CH", "Chihuahua");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("MX", "CL", "Colima");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("MX", "CM", "Campeche");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("MX", "CO", "Coahuila");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("MX", "CS", "Chiapas");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("MX", "DF", "Federal District");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("MX", "DG", "Durango");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("MX", "GR", "Guerrero");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("MX", "GT", "Guanajuato");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("MX", "HG", "Hidalgo");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("MX", "JA", "Jalisco");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("MX", "ME", "México State");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("MX", "MI", "Michoacán");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("MX", "MO", "Morelos");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("MX", "NA", "Nayarit");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("MX", "NL", "Nuevo León");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("MX", "OA", "Oaxaca");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("MX", "PB", "Puebla");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("MX", "QE", "Querétaro");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("MX", "QR", "Quintana Roo");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("MX", "SI", "Sinaloa");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("MX", "SL", "San Luis Potosí");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("MX", "SO", "Sonora");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("MX", "TB", "Tabasco");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("MX", "TL", "Tlaxcala");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("MX", "TM", "Tamaulipas");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("MX", "VE", "Veracruz");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("MX", "YU", "Yucatán");
INSERT INTO `states_provinces` (`country`, `abbr`, `name`) VALUES ("MX", "ZA", "Zacatecas");

CREATE TABLE `fqa_ecoregions` (
 `id` INT NOT NULL AUTO_INCREMENT,
 `fqa_id` INT NOT NULL,
 `is_custom_fqa` TINYINT(1) NOT NULL DEFAULT 0,
 `ecoregion_id` INT NOT NULL,
 INDEX (`fqa_id`),
 INDEX (`ecoregion_id`),
 PRIMARY KEY (`id`)
);

CREATE TABLE `site_ecoregions` (
 `id` INT NOT NULL AUTO_INCREMENT,
 `site_id` INT NOT NULL,
 `ecoregion_id` INT NOT NULL,
 INDEX (`site_id`),
 INDEX (`ecoregion_id`),
 PRIMARY KEY (`id`)
);

CREATE TABLE `omernik_ecoregions` (
 `id` INT NOT NULL AUTO_INCREMENT,
 `omernik_level` INT NOT NULL,
 `ecoregion_code` VARCHAR(32) NOT NULL,
 `ecoregion_number` VARCHAR(32) NOT NULL,
 `ecoregion_name` VARCHAR(256) NOT NULL,
 `display_name` VARCHAR(256) NOT NULL,
 PRIMARY KEY (`id`)
);

INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "7.1.8", "1", "Coast Range", "1 - Coast Range (7.1.8)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "7.1.7", "2", "Strait of Georgia/Puget Lowland", "2 - Strait of Georgia/Puget Lowland (7.1.7)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "7.1.9", "3", "Willamette Valley","3 - Willamette Valley (7.1.9)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "6.2.7", "4", "Cascades","4 - Cascades (6.2.7)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "6.2.12", "5", "Sierra Nevada","5 - Sierra Nevada (6.2.12)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "11.1.1", "6", "California Coastal Sage, Chaparral, and Oak Woodlands","6 - California Coastal Sage, Chaparral, and Oak Woodlands (11.1.1)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "11.1.2", "7", "Central California Valley","7 - Central California Valley (11.1.2)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "11.1.3", "8", "Southern and Baja California Pine-Oak Mountains","8 - Southern and Baja California Pine-Oak Mountains (11.1.3)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "6.2.8", "9", "Eastern Cascades Slopes and Foothills","9 - Eastern Cascades Slopes and Foothills (6.2.8)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "10.1.2", "10", "Columbia Plateau","10 - Columbia Plateau (10.1.2)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "6.2.9", "11", "Blue Mountains","11 - Blue Mountains (6.2.9)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "10.1.8", "12", "Snake River Plain","12 - Snake River Plain (10.1.8)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "10.1.5", "13", "Central Basin and Range","13 - Central Basin and Range (10.1.5)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "10.2.1", "14", "Mojave Basin and Range","14 - Mojave Basin and Range (10.2.1)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "6.2.3", "15", "Columbia Mountains/Northern Rockies","15 - Columbia Mountains/Northern Rockies (6.2.3)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "6.2.15", "16", "Idaho Batholith","16 - Idaho Batholith (6.2.15)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "6.2.10", "17", "Middle Rockies","17 - Middle Rockies (6.2.10)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "10.1.4", "18", "Wyoming Basin","18 - Wyoming Basin (10.1.4)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "6.2.13", "19", "Wasatch and Uinta Mountains","19 - Wasatch and Uinta Mountains (6.2.13)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "10.1.6", "20", "Colorado Plateaus","20 - Colorado Plateaus (10.1.6)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "6.2.14", "21", "Southern Rockies","21 - Southern Rockies (6.2.14)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "10.1.7", "22", "Arizona/New Mexico Plateau","22 - Arizona/New Mexico Plateau (10.1.7)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "13.1.1", "23", "Arizona/New Mexico Mountains","23 - Arizona/New Mexico Mountains (13.1.1)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "10.2.4", "24", "Chihuahuan Desert","24 - Chihuahuan Desert (10.2.4)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "9.4.1", "25", "High Plains","25 - High Plains (9.4.1)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "9.4.3", "26", "Southwestern Tablelands","26 - Southwestern Tablelands (9.4.3)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "9.4.2", "27", "Central Great Plains","27 - Central Great Plains (9.4.2)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "9.4.4", "28", "Flint Hills","28 - Flint Hills (9.4.4)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "9.4.5", "29", "Cross Timbers","29 - Cross Timbers (9.4.5)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "9.4.6", "30", "Edwards Plateau","30 - Edwards Plateau (9.4.6)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "9.6.1", "31", "Southern Texas Plains/Interior Plains and Hills with Xerophytic Shrub and Oak Forest","31 - Southern Texas Plains/Interior Plains and Hills with Xerophytic Shrub and Oak Forest (9.6.1)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "9.4.7", "32", "Texas Blackland Prairies","32 - Texas Blackland Prairies (9.4.7)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "8.3.8", "33", "East Central Texas Plains","33 - East Central Texas Plains (8.3.8)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "9.5.1", "34", "Western Gulf Coastal Plain","34 - Western Gulf Coastal Plain (9.5.1)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "8.3.7", "35", "South Central Plains","35 - South Central Plains (8.3.7)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "8.4.8", "36", "Ouachita Mountains","36 - Ouachita Mountains (8.4.8)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "8.4.7", "37", "Arkansas Valley","37 - Arkansas Valley (8.4.7)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "8.4.6", "38", "Boston Mountains","38 - Boston Mountains (8.4.6)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "8.4.5", "39", "Ozark Highlands","39 - Ozark Highlands (8.4.5)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "9.2.4", "40", "Central Irregular Plains","40 - Central Irregular Plains (9.2.4)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "6.2.4", "41", "Canadian Rockies","41 - Canadian Rockies (6.2.4)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "9.3.1", "42", "Northwestern Glaciated Plains","42 - Northwestern Glaciated Plains (9.3.1)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "9.3.3", "43", "Northwestern Great Plains","43 - Northwestern Great Plains (9.3.3)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "9.3.4", "44", "Nebraska Sand Hills","44 - Nebraska Sand Hills (9.3.4)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "8.3.4", "45", "Piedmont","45 - Piedmont (8.3.4)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "9.2.1", "46", "Aspen Parkland/Northern Glaciated Plains","46 - Aspen Parkland/Northern Glaciated Plains (9.2.1)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "9.2.3", "47", "Western Corn Belt Plains","47 - Western Corn Belt Plains (9.2.3)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "9.2.2", "48", "Lake Manitoba and Lake Agassiz Plain","48 - Lake Manitoba and Lake Agassiz Plain (9.2.2)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "5.2.2", "49", "Northern Minnesota Wetlands","49 - Northern Minnesota Wetlands (5.2.2)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "5.2.1", "50", "Northern Lakes and Forests","50 - Northern Lakes and Forests (5.2.1)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "8.1.4", "51", "North Central Hardwood Forests","51 - North Central Hardwood Forests (8.1.4)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "8.1.5", "52", "Driftless Area","52 - Driftless Area (8.1.5)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "8.2.1", "53", "Southeastern Wisconsin Till Plains","53 - Southeastern Wisconsin Till Plains (8.2.1)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "8.2.3", "54", "Central Corn Belt Plains","54 - Central Corn Belt Plains (8.2.3)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "8.2.4", "55", "Eastern Corn Belt Plains","55 - Eastern Corn Belt Plains (8.2.4)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "8.1.6", "56", "S. Michigan/N. Indiana Drift Plains","56 - S. Michigan/N. Indiana Drift Plains (8.1.6)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "8.2.2", "57", "Huron/Erie Lake Plains","57 - Huron/Erie Lake Plains (8.2.2)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "5.3.1", "58", "Northern Appalachian and Atlantic Maritime Highlands","58 - Northern Appalachian and Atlantic Maritime Highlands (5.3.1)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "8.1.7", "59", "Northeastern Coastal Zone","59 - Northeastern Coastal Zone (8.1.7)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "8.1.3", "60", "Northern Appalachian Plateau and Uplands","60 - Northern Appalachian Plateau and Uplands (8.1.3)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "8.1.10", "61", "Erie Drift Plain","61 - Erie Drift Plain (8.1.10)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "5.3.3", "62", "North Central Appalachians","62 - North Central Appalachians (5.3.3)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "8.5.1", "63", "Middle Atlantic Coastal Plain","63 - Middle Atlantic Coastal Plain (8.5.1)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "8.3.1", "64", "Northern Piedmont","64 - Northern Piedmont (8.3.1)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "8.3.5", "65", "Southeastern Plains","65 - Southeastern Plains (8.3.5)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "8.4.4", "66", "Blue Ridge","66 - Blue Ridge (8.4.4)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "8.4.1", "67", "Ridge and Valley","67 - Ridge and Valley (8.4.1)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "8.4.9", "68", "Southwestern Appalachians","68 - Southwestern Appalachians (8.4.9)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "8.4.2", "69", "Central Appalachians","69 - Central Appalachians (8.4.2)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "8.4.3", "70", "Western Allegheny Plateau","70 - Western Allegheny Plateau (8.4.3)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "8.3.3", "71", "Interior Plateau","71 - Interior Plateau (8.3.3)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "8.3.2", "72", "Interior River Valleys and Hills","72 - Interior River Valleys and Hills (8.3.2)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "8.5.2", "73", "Mississippi Alluvial Plain","73 - Mississippi Alluvial Plain (8.5.2)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "8.3.6", "74", "Mississippi Valley Loess Plains","74 - Mississippi Valley Loess Plains (8.3.6)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "8.5.3", "75", "Southern Coastal Plain","75 - Southern Coastal Plain (8.5.3)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "15.4.1", "76", "Southern Florida Coastal Plain","76 - Southern Florida Coastal Plain (15.4.1)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "6.2.5", "77", "North Cascades","77 - North Cascades (6.2.5)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "6.2.11", "78", "Klamath Mountains","78 - Klamath Mountains (6.2.11)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "12.1.1", "79", "Madrean Archipelago","79 - Madrean Archipelago (12.1.1)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "10.1.3", "80", "Northern Basin and Range","80 - Northern Basin and Range (10.1.3)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "10.2.2", "81", "Sonoran Desert","81 - Sonoran Desert (10.2.2)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "8.1.8", "82", "Maine/New Brunswick Plains and Hills","82 - Maine/New Brunswick Plains and Hills (8.1.8)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "8.1.1", "83", "Eastern Great Lakes and Hudson Lowlands","83 - Eastern Great Lakes and Hudson Lowlands (8.1.1)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "8.5.4", "84", "Atlantic Coastal Pine Barrens","84 - Atlantic Coastal Pine Barrens (8.5.4)");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "0.0.0", "", "Water","0.0.0 - Water");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "1.1.1", "", "Ellesmere and Devon Islands Ice Caps","1.1.1 - Ellesmere and Devon Islands Ice Caps");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "1.1.2", "", "Baffin and Torngat Mountains","1.1.2 - Baffin and Torngat Mountains");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "2.1.1", "", "Sverdrup Islands Lowland","2.1.1 - Sverdrup Islands Lowland");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "2.1.2", "", "Ellesmere Mountains and Eureka Hills","2.1.2 - Ellesmere Mountains and Eureka Hills");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "2.1.3", "", "Parry Islands Plateau","2.1.3 - Parry Islands Plateau");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "2.1.4", "", "Lancaster and Borden Peninsula Plateaus","2.1.4 - Lancaster and Borden Peninsula Plateaus");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "2.1.5", "", "Foxe Uplands","2.1.5 - Foxe Uplands");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "2.1.6", "", "Baffin Uplands","2.1.6 - Baffin Uplands");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "2.1.7", "", "Gulf of Boothia and Foxe Basin Plains","2.1.7 - Gulf of Boothia and Foxe Basin Plains");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "2.1.8", "", "Victoria Island Lowlands","2.1.8 - Victoria Island Lowlands");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "2.1.9", "", "Banks Island and Amundsen Gulf Lowlands","2.1.9 - Banks Island and Amundsen Gulf Lowlands");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "2.2.1", "", "Arctic Coastal Plain","2.2.1 - Arctic Coastal Plain");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "2.2.2", "", "Arctic Foothills","2.2.2 - Arctic Foothills");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "2.2.3", "", "Subarctic Coastal Plains","2.2.3 - Subarctic Coastal Plains");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "2.2.4", "", "Seward Peninsula","2.2.4 - Seward Peninsula");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "2.2.5", "", "Bristol Bay-Nushagak Lowlands","2.2.5 - Bristol Bay-Nushagak Lowlands");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "2.2.6", "", "Aleutian Islands","2.2.6 - Aleutian Islands");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "2.3.1", "", "Brooks Range/Richardson Mountains","2.3.1 - Brooks Range/Richardson Mountains");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "2.4.1", "", "Amundsen Plains","2.4.1 - Amundsen Plains");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "2.4.2", "", "Aberdeen Plains","2.4.2 - Aberdeen Plains");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "2.4.3", "", "Central Ungava Peninsula and Ottawa and Belcher Islands","2.4.3 - Central Ungava Peninsula and Ottawa and Belcher Islands");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "2.4.4", "", "Queen Maud Gulf and Chantrey Inlet Lowlands","2.4.4 - Queen Maud Gulf and Chantrey Inlet Lowlands");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "3.1.1", "", "Interior Forested Lowlands and Uplands","3.1.1 - Interior Forested Lowlands and Uplands");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "3.1.2", "", "Interior Bottomlands","3.1.2 - Interior Bottomlands");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "3.1.3", "", "Yukon Flats","3.1.3 - Yukon Flats");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "3.2.1", "", "Ogilvie Mountains","3.2.1 - Ogilvie Mountains");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "3.2.2", "", "Mackenzie and Selwyn Mountains","3.2.2 - Mackenzie and Selwyn Mountains");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "3.2.3", "", "Peel River and Nahanni Plateaus","3.2.3 - Peel River and Nahanni Plateaus");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "3.3.1", "", "Great Bear Plains","3.3.1 - Great Bear Plains");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "3.3.2", "", "Hay and Slave River Lowlands","3.3.2 - Hay and Slave River Lowlands");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "3.4.1", "", "Kazan River and Selwyn Lake Uplands","3.4.1 - Kazan River and Selwyn Lake Uplands");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "3.4.2", "", "La Grande Hills and New Quebec Central Plateau","3.4.2 - La Grande Hills and New Quebec Central Plateau");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "3.4.3", "", "Smallwood Uplands","3.4.3 - Smallwood Uplands");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "3.4.4", "", "Ungava Bay Basin and George Plateau","3.4.4 - Ungava Bay Basin and George Plateau");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "3.4.5", "", "Coppermine River and Tazin Lake Uplands","3.4.5 - Coppermine River and Tazin Lake Uplands");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "4.1.1", "", "Coastal Hudson Bay Lowland","4.1.1 - Coastal Hudson Bay Lowland");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "4.1.2", "", "Hudson Bay and James Bay Lowlands","4.1.2 - Hudson Bay and James Bay Lowlands");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "5.1.1", "", "Athabasca Plain and Churchill River Upland","5.1.1 - Athabasca Plain and Churchill River Upland");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "5.1.2", "", "Lake Nipigon and Lac Seul Upland","5.1.2 - Lake Nipigon and Lac Seul Upland");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "5.1.3", "", "Central Laurentians and Mecatina Plateau","5.1.3 - Central Laurentians and Mecatina Plateau");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "5.1.4", "", "Newfoundland Island","5.1.4 - Newfoundland Island");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "5.1.5", "","Hayes River Upland and Big Trout Lake","5.1.5 - Hayes River Upland and Big Trout Lake");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "5.1.6", "","Abitibi Plains and Riviere Rupert Plateau","5.1.6 - Abitibi Plains and Riviere Rupert Plateau");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "5.2.3", "","Algonquin/Southern Laurentians","5.2.3 - Algonquin/Southern Laurentians");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "5.4.1", "","Mid-Boreal Uplands and Peace-Wabaska Lowlands","5.4.1 - Mid-Boreal Uplands and Peace-Wabaska Lowlands");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "5.4.2", "","Clear Hills and Western Alberta Upland","5.4.2 - Clear Hills and Western Alberta Upland");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "5.4.3", "","Mid-Boreal Lowland and Interlake Plain","5.4.3 - Mid-Boreal Lowland and Interlake Plain");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "6.1.1", "","Interior Highlands and Klondike Plateau","6.1.1 - Interior Highlands and Klondike Plateau");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "6.1.2", "","Alaska Range","6.1.2 - Alaska Range");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "6.1.3", "","Copper Plateau","6.1.3 - Copper Plateau");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "6.1.4", "","Wrangell and St. Elias Mountains","6.1.4 - Wrangell and St. Elias Mountains");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "6.1.5", "","Watson Highlands","6.1.5 - Watson Highlands");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "6.1.6", "","Yukon-Stikine Highlands/Boreal Mountains and Plateaus","6.1.6 - Yukon-Stikine Highlands/Boreal Mountains and Plateaus");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "6.2.1", "","Skeena-Omineca-Central Canadian Rocky Mountains","6.2.1 - Skeena-Omineca-Central Canadian Rocky Mountains");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "6.2.2", "","Chilcotin Ranges and Fraser Plateau","6.2.2 - Chilcotin Ranges and Fraser Plateau");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "6.2.6", "","Cypress Upland","6.2.6 - Cypress Upland");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "7.1.1", "","Ahklun and Kilbuck Mountains","7.1.1 - Ahklun and Kilbuck Mountains");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "7.1.2", "","Alaska Peninsula Mountains","7.1.2 - Alaska Peninsula Mountains");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "7.1.3", "","Cook Inlet","7.1.3 - Cook Inlet");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "7.1.4", "","Pacific Coastal Mountains","7.1.4 - Pacific Coastal Mountains");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "7.1.5", "","Coastal Western Hemlock-Sitka Spruce Forests","7.1.5 - Coastal Western Hemlock-Sitka Spruce Forests");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "7.1.6", "","Pacific and Nass Ranges","7.1.6 - Pacific and Nass Ranges");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "8.1.2", "","Lake Erie Lowland","8.1.2 - Lake Erie Lowland");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "8.1.9", "","Maritime Lowlands","8.1.9 - Maritime Lowlands");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "10.1.1","","Thompson-Okanogan Plateau","10.1.1 - Thompson-Okanogan Plateau");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "10.2.3","","Baja Californian Desert","10.2.3 - Baja Californian Desert");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "12.1.2","","Piedmonts and Plains with Grasslands, Xeric Shrub, and Oak and Conifer Forests","12.1.2 - Piedmonts and Plains with Grasslands, Xeric Shrub, and Oak and Conifer Forests");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "12.2.1","","Hills and Interior Plains with Xeric Shrub and Mesquite Low Forest","12.2.1 - Hills and Interior Plains with Xeric Shrub and Mesquite Low Forest");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "13.2.1","","Sierra Madre Occidental with Conifer, Oak, and Mixed Forests","13.2.1 - Sierra Madre Occidental with Conifer, Oak, and Mixed Forests");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "13.3.1","","Sierra Madre Oriental with Conifer, Oak, and Mixed Forests","13.3.1 - Sierra Madre Oriental with Conifer, Oak, and Mixed Forests");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "13.4.1","","Interior Plains and Piedmonts with Grasslands and Xeric Shrub","13.4.1 - Interior Plains and Piedmonts with Grasslands and Xeric Shrub");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "13.4.2","","Hills and Sierras with Conifer, Oak, and Mixed Forests","13.4.2 - Hills and Sierras with Conifer, Oak, and Mixed Forests");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "13.5.1","","Sierras of Jalisco and Michoacan with Conifer, Oak, and Mixed Forests","13.5.1 - Sierras of Jalisco and Michoacan with Conifer, Oak, and Mixed Forests");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "13.5.2","","Sierras of Guerrero and Oaxaca with Conifer, Oak, and Mixed Forests","13.5.2 - Sierras of Guerrero and Oaxaca with Conifer, Oak, and Mixed Forests");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "13.6.1","","Central American Sierra Madre with Conifer, Oak, and Mixed Forests","13.6.1 - Central American Sierra Madre with Conifer, Oak, and Mixed Forests");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "13.6.2","","Chiapas Highlands with Conifer, Oak, and Mixed Forest","13.6.2 - Chiapas Highlands with Conifer, Oak, and Mixed Forest");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "14.1.1","","Coastal Plain with Low Tropical Deciduous Forest","14.1.1 - Coastal Plain with Low Tropical Deciduous Forest");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "14.1.2","","Hills and Sierra with Low Tropical Deciduous Forest and Oak Forest","14.1.2 - Hills and Sierra with Low Tropical Deciduous Forest and Oak Forest");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "14.2.1","","Northwestern Yucatan Plain with Low Tropical Deciduous Forest","14.2.1 - Northwestern Yucatan Plain with Low Tropical Deciduous Forest");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "14.3.1","","Sinaloa Coastal Plain with Low Thorn Tropical Forest and Wetlands","14.3.1 - Sinaloa Coastal Plain with Low Thorn Tropical Forest and Wetlands");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "14.3.2","","Sinaloa and Sonora Hills and Canyons with Xeric Shrub and Low Tropical Deciduous Forest","14.3.2 - Sinaloa and Sonora Hills and Canyons with Xeric Shrub and Low Tropical Deciduous Forest");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "14.4.1","","Balsas Depression with Low Tropical Deciduous Forest and Xerophytic Shrub","14.4.1 - Balsas Depression with Low Tropical Deciduous Forest and Xerophytic Shrub");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "14.4.2","","Chiapas Depression with Low Deciduous and Medium Semi-Deciduous Tropical Forest","14.4.2 - Chiapas Depression with Low Deciduous and Medium Semi-Deciduous Tropical Forest");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "14.4.3","","Valleys and Depressions with Xeric Shrub and Low Tropical Deciduous Forest","14.4.3 - Valleys and Depressions with Xeric Shrub and Low Tropical Deciduous Forest");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "14.5.1","","Tehuantepec Canyon and Plain with Low Tropical Deciduous Forest and Low Thorn Tropical Forest","14.5.1 - Tehuantepec Canyon and Plain with Low Tropical Deciduous Forest and Low Thorn Tropical Forest");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "14.5.2","","South Pacific Hills and Piedmonts with Low Tropical Deciduous Forest","14.5.2 - South Pacific Hills and Piedmonts with Low Tropical Deciduous Forest");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "14.6.1","","Los Cabos Plains and Hills with Low Tropical Deciduous Forest and Xeric Shrub","14.6.1 - Los Cabos Plains and Hills with Low Tropical Deciduous Forest and Xeric Shrub");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "14.6.2","","La Laguna Mountains with Oak and Conifer Forest","14.6.2 - La Laguna Mountains with Oak and Conifer Forest");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "15.1.1","","Gulf of Mexico Coastal Plain with Wetlands and High Tropical Rain Forest","15.1.1 - Gulf of Mexico Coastal Plain with Wetlands and High Tropical Rain Forest");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "15.1.2","","Hills with Medium and High Evergreen Tropical Forest","15.1.2 - Hills with Medium and High Evergreen Tropical Forest");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "15.2.1","","Plain with Low and Medium Deciduous Tropical Forest","15.2.1 - Plain with Low and Medium Deciduous Tropical Forest");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "15.2.2","","Plain with Medium and High Semi-Evergreen Tropical Forest","15.2.2 - Plain with Medium and High Semi-Evergreen Tropical Forest");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "15.2.3","","Hills with High and Medium Semi-Evergreen Tropical Forest","15.2.3 - Hills with High and Medium Semi-Evergreen Tropical Forest");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "15.3.1","","Los Tuxtlas Sierra with High Evergreen Tropical Forest","15.3.1 - Los Tuxtlas Sierra with High Evergreen Tropical Forest");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "15.5.1","","Nayarit and Sinaloa Plain with Low Thorn Tropical Forest","15.5.1 - Nayarit and Sinaloa Plain with Low Thorn Tropical Forest");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "15.5.2","","Jalisco and Nayarit Hills and Plains with Medium Semi-Evergreen Tropical Forest","15.5.2 - Jalisco and Nayarit Hills and Plains with Medium Semi-Evergreen Tropical Forest");
INSERT INTO `omernik_ecoregions` (`omernik_level`, `ecoregion_code`, `ecoregion_number`, `ecoregion_name`, `display_name`) VALUES (3, "15.6.1","","Coastal Plain and Hills with High and Medium-High Evergreen Tropical Forest and Wetlands","15.6.1 - Coastal Plain and Hills with High and Medium-High Evergreen Tropical Forest and Wetlands");
