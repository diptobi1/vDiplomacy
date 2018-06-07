/**
 * Author:  Alex Ronke
 * Created: May 27, 2017
 */
ALTER TABLE `webdiplomacy`.`wd_territories` 
CHANGE COLUMN `type` `type` ENUM('Sea', 'Land', 'Coast', 'Strait') NOT NULL ;

