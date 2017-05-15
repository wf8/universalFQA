USE universal_fqa;
ALTER TABLE `transect` ADD COLUMN `transect_type` VARCHAR(256) NULL;
ALTER TABLE `transect` ADD COLUMN `plot_size` VARCHAR(256) NULL;
ALTER TABLE `transect` ADD COLUMN `subplot_size` VARCHAR(256) NULL;
ALTER TABLE `transect` ADD COLUMN `transect_length` VARCHAR(256) NULL;
ALTER TABLE `transect` ADD COLUMN `transect_description` TEXT NULL;
ALTER TABLE `transect` ADD COLUMN `cover_method_name` VARCHAR(256) NULL;

ALTER TABLE `quadrat_taxa` ADD COLUMN `cover_range_midpoint` VARCHAR(256) NULL;

