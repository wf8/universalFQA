USE universal_fqa;
ALTER TABLE `transect` ADD COLUMN `transect_type` VARCHAR(256) NULL;
ALTER TABLE `transect` ADD COLUMN `plot_size` VARCHAR(256) NULL;
ALTER TABLE `transect` ADD COLUMN `subplot_size` VARCHAR(256) NULL;
ALTER TABLE `transect` ADD COLUMN `transect_length` VARCHAR(256) NULL;
ALTER TABLE `transect` ADD COLUMN `transect_description` TEXT NULL;
ALTER TABLE `transect` ADD COLUMN `cover_method_name` VARCHAR(256) NULL;
ALTER TABLE `transect` ADD COLUMN `community_type_id` VARCHAR(256) NULL;
ALTER TABLE `transect` ADD COLUMN `environment_description` TEXT NULL;

ALTER TABLE `quadrat` ADD COLUMN `quadrat_type` INT NOT NULL DEFAULT 0;
ALTER TABLE `quadrat_taxa` ADD COLUMN `cover_range_midpoint` VARCHAR(256) NULL;

