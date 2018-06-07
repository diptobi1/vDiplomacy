/**
 * Author:  Alex Ronke
 * Created: Aug 12, 2017
 */

ALTER TABLE `webdiplomacy`.`wd_datc` 
CHANGE COLUMN `variantID` `variantID` SMALLINT(6) UNSIGNED NOT NULL ;

ALTER TABLE `webdiplomacy`.`wd_backup_games` 
CHANGE COLUMN `variantID` `variantID` SMALLINT(6) UNSIGNED NOT NULL ;

ALTER TABLE `webdiplomacy`.`wd_borders` 
CHANGE COLUMN `mapID` `mapID` SMALLINT(6) UNSIGNED NOT NULL ;

ALTER TABLE `webdiplomacy`.`wd_coastalborders` 
CHANGE COLUMN `mapID` `mapID` SMALLINT(6) UNSIGNED NOT NULL ;

ALTER TABLE `webdiplomacy`.`wd_games` 
CHANGE COLUMN `variantID` `variantID` SMALLINT(6) UNSIGNED NOT NULL ;

ALTER TABLE `webdiplomacy`.`wd_territories` 
CHANGE COLUMN `mapID` `mapID` SMALLINT(6) UNSIGNED NOT NULL ;

ALTER TABLE `webdiplomacy`.`wd_unitdestroyindex` 
CHANGE COLUMN `mapID` `mapID` SMALLINT(6) UNSIGNED NOT NULL ;

ALTER TABLE `webdiplomacy`.`wd_variantdata` 
CHANGE COLUMN `variantID` `variantID` SMALLINT(6) UNSIGNED NOT NULL ;
