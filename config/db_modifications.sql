USE universal_fqa;
ALTER TABLE `transect` ADD COLUMN `transect_type` VARCHAR(256) NULL;
ALTER TABLE `transect` ADD COLUMN `plot_size` VARCHAR(256) NULL;
ALTER TABLE `transect` ADD COLUMN `subplot_size` VARCHAR(256) NULL;
ALTER TABLE `transect` ADD COLUMN `transect_length` VARCHAR(256) NULL;
ALTER TABLE `transect` ADD COLUMN `transect_description` TEXT NULL;
ALTER TABLE `transect` ADD COLUMN `cover_method_name` VARCHAR(256) NULL;

