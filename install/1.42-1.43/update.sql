ALTER TABLE wD_UserOptions ADD `pointNClick` enum('No','Yes') NOT NULL DEFAULT 'Yes',
	ADD `terrGrey` enum('Highlight own units and order options','Highlight only order options','No grey-out') NOT NULL DEFAULT 'Highlight only order options',
	ADD `greyOut` enum('10 %', '30 %', '50 %', '70 %', '90 %') NOT NULL DEFAULT '50 %',
	ADD `scrollbars` enum('No','Yes') NOT NULL DEFAULT 'Yes'

UPDATE `wD_Misc` SET `value` = '143' WHERE `name` = 'Version';