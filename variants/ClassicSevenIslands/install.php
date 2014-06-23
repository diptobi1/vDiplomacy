<?php
/*
	Copyright (C) 2010 Oliver Auth

	This file is part of the 7 Islands variant for webDiplomacy

	The 7 Islands variant for webDiplomacy is free software: you can redistribute
	it and/or modify it under the terms of the GNU Affero General Public License 
	as published by the Free Software Foundation, either version 3 of the License,
	or (at your option) any later version.

	The 7 Islands variant for webDiplomacy is distributed in the hope that it will be
	useful, but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. 
	See the GNU General Public License for more details.

	You should have received a copy of the GNU Affero General Public License
	along with webDiplomacy. If not, see <http://www.gnu.org/licenses/>.

*/

defined('IN_CODE') or die('This script can not be run by itself.');

require_once("variants/install.php");

InstallTerritory::$Territories=array();
$countries=$this->countries;
$territoryRawData=array(
	array('Clyde'                       ,'Coast','No' , 309,337,157,120,'England'),
	array('Edinburgh'                   ,'Coast','Yes', 340,350,175,109,'England'),
	array('Liverpool'                   ,'Coast','Yes', 315,405,166,140,'England'),
	array('Yorkshire'                   ,'Coast','No' , 355,440,184,150,'England'),
	array('Wales'                       ,'Coast','No' , 305,480,154,179,'England'),
	array('London'                      ,'Coast','Yes', 358,485,176,185,'England'),
	array('Portugal'                    ,'Coast','Yes', 100,718, 65,292,'Neutral'),
	array('Spain'                       ,'Coast','Yes', 205,760,110,307,'Neutral'),
	array('North Africa'                ,'Coast','No' , 210,923,130,380,'Neutral'),
	array('Tunis'                       ,'Coast','Yes', 420,970,204,384,'Neutral'),
	array('Naples'                      ,'Coast','Yes', 570,870,298,357,'Italy'  ),
	array('Rome'                        ,'Coast','Yes', 522,800,272,330,'Italy'  ),
	array('Tuscany'                     ,'Coast','No' , 485,755,256,312,'Italy'  ),
	array('Piedmont'                    ,'Coast','No' , 441,694,228,276,'Italy'  ),
	array('Venice'                      ,'Coast','Yes', 490,710,258,292,'Italy'  ),
	array('Apulia'                      ,'Coast','No' , 575,813,295,335,'Italy'  ),
	array('Greece'                      ,'Coast','Yes', 676,851,355,361,'Neutral'),
	array('Albania'                     ,'Coast','No' , 640,820,343,341,'Neutral'),
	array('Serbia'                      ,'Land' ,'Yes', 668,766,357,324,'Neutral'),
	array('Bulgaria'                    ,'Coast','Yes', 730,776,394,318,'Neutral'),
	array('Rumania'                     ,'Coast','Yes', 765,717,412,272,'Neutral'),
	array('Constantinople'              ,'Coast','Yes', 821,840,433,345,'Turkey' ),
	array('Smyrna'                      ,'Coast','Yes', 899,890,480,363,'Turkey' ),
	array('Ankara'                      ,'Coast','Yes', 970,820,485,320,'Turkey' ),
	array('Armenia'                     ,'Coast','No' ,1130,835,572,323,'Turkey' ),
	array('Syria'                       ,'Coast','No' ,1073,940,559,370,'Turkey' ),
	array('Sevastopol'                  ,'Coast','Yes', 920,595,485,248,'Russia' ),
	array('Ukraine'                     ,'Land' ,'No' , 779,579,418,220,'Russia' ),
	array('Warsaw'                      ,'Land' ,'Yes', 680,540,358,209,'Russia' ),
	array('Livonia'                     ,'Coast','No' , 719,441,374,168,'Russia' ),
	array('Moscow'                      ,'Land' ,'Yes', 880,440,490,160,'Russia' ),
	array('St. Petersburg'              ,'Coast','Yes', 837,309,445, 97,'Russia' ),
	array('Finland'                     ,'Coast','No' , 710,263,369,109,'Russia' ),
	array('Sweden'                      ,'Coast','Yes', 587,285,307,103,'Neutral'),
	array('Norway'                      ,'Coast','Yes', 518,270,265,113,'Neutral'),
	array('Denmark'                     ,'Coast','Yes', 501,435,264,150,'Neutral'),
	array('Kiel'                        ,'Coast','Yes', 477,504,253,193,'Germany'),
	array('Berlin'                      ,'Coast','Yes', 559,493,287,189,'Germany'),
	array('Prussia'                     ,'Coast','No' , 618,482,319,202,'Germany'),
	array('Silesia'                     ,'Land' ,'No' , 589,535,315,222,'Germany'),
	array('Munich'                      ,'Land' ,'Yes', 489,596,252,229,'Germany'),
	array('Ruhr'                        ,'Land' ,'No' , 450,550,227,221,'Germany'),
	array('Holland'                     ,'Coast','Yes', 433,510,234,185,'Neutral'),
	array('Belgium'                     ,'Coast','Yes', 410,550,215,205,'Neutral'),
	array('Picardy'                     ,'Coast','No' , 363,559,182,213,'France' ),
	array('Brest'                       ,'Coast','Yes', 298,595,153,240,'France' ),
	array('Paris'                       ,'Land' ,'Yes', 336,620,176,233,'France' ),
	array('Burgundy'                    ,'Land' ,'No' , 393,629,204,243,'France' ),
	array('Marseilles'                  ,'Coast','Yes', 390,689,199,275,'France' ),
	array('Gascony'                     ,'Coast','No' , 301,676,154,265,'France' ),
	array('Barents Sea'                 ,'Sea'  ,'No' , 826, 37,427, 15,'Neutral'),
	array('Norwegian Sea'               ,'Sea'  ,'No' , 437,149,240, 31,'Neutral'),
	array('North Sea'                   ,'Sea'  ,'No' , 414,378,216,125,'Neutral'),
	array('Skagerrack'                  ,'Sea'  ,'No' , 518,363,284,146,'Neutral'),
	array('Heligoland Bight'            ,'Sea'  ,'No' , 455,439,241,159,'Neutral'),
	array('Baltic Sea'                  ,'Sea'  ,'No' , 621,431,338,177,'Neutral'),
	array('Gulf of Bothnia'             ,'Sea'  ,'No' , 653,330,345,141,'Neutral'),
	array('North Atlantic Ocean'        ,'Sea'  ,'No' , 145,250, 78, 92,'Neutral'),
	array('Irish Sea'                   ,'Sea'  ,'No' , 208,478,118,171,'Neutral'),
	array('English Channel'             ,'Sea'  ,'No' , 275,526,145,205,'Neutral'),
	array('Mid-Atlantic Ocean'          ,'Sea'  ,'No' , 106,587, 60,251,'Neutral'),
	array('Western Mediterranean'       ,'Sea'  ,'No' , 327,852,186,350,'Neutral'),
	array('Gulf of Lyons'               ,'Sea'  ,'No' , 366,774,208,322,'Neutral'),
	array('Tyrrhenian Sea'              ,'Sea'  ,'No' , 490,847,248,343,'Neutral'),
	array('Ionian Sea'                  ,'Sea'  ,'No' , 610,952,325,379,'Neutral'),
	array('Adriatic Sea'                ,'Sea'  ,'No' , 554,761,316,329,'Neutral'),
	array('Aegean Sea'                  ,'Sea'  ,'No' , 755,930,395,363,'Neutral'),
	array('Eastern Mediterranean'       ,'Sea'  ,'No' , 860,967,465,383,'Neutral'),
	array('Black Sea'                   ,'Sea'  ,'No' , 915,735,457,300,'Neutral'),
	array('Tyrolia'                     ,'Land' ,'No' , 542,632,282,252,'Austria'),
	array('Bohemia'                     ,'Land' ,'No' , 567,586,298,227,'Austria'),
	array('Vienna'                      ,'Land' ,'Yes', 602,637,314,246,'Austria'),
	array('Trieste'                     ,'Coast','Yes', 579,710,308,288,'Austria'),
	array('Budapest'                    ,'Land' ,'Yes', 661,678,350,260,'Austria'),
	array('Galicia'                     ,'Land' ,'No' , 710,610,378,240,'Austria'),
	array('Iceland'                     ,'Coast','Yes', 262, 81,145, 27,'Neutral'),
	array('Ireland'                     ,'Coast','Yes', 244,415,127,142,'Neutral'),
	array('Corsica'                     ,'Coast','Yes', 433,777,222,312,'Neutral'),
	array('Sardinia'                    ,'Coast','Yes', 420,822,212,340,'Neutral'),
	array('Sicily'                      ,'Coast','Yes', 519,907,263,377,'Neutral'),
	array('Crete'                       ,'Coast','Yes', 740,968,390,389,'Neutral'),
	array('Cyprus'                      ,'Coast','Yes', 933,953,483,388,'Neutral'),
	array('Spain (North Coast)'         ,'Coast','No' , 193,685, 90,273,'Neutral'),
	array('Spain (South Coast)'         ,'Coast','No' , 191,832,106,345,'Neutral'),
	array('St. Petersburg (North Coast)','Coast','No' , 828, 90,448, 59,'Russia' ),
	array('St. Petersburg (South Coast)','Coast','No' , 760,335,397,130,'Russia' ),
	array('Bulgaria (North Coast)'      ,'Coast','No' , 785,762,424,304,'Neutral'),
	array('Bulgaria (South Coast)'      ,'Coast','No' , 749,815,397,332,'Neutral')
);

foreach($territoryRawData as $territoryRawRow)
{
	list($name, $type, $supply, $x, $y, $sx, $sy, $country)=$territoryRawRow;
	if( $country=='Neutral' )
		$countryID=0;
	else
		$countryID=$this->countryID($country);
		
	new InstallTerritory($name, $type, $supply, $countryID, $x, $y, $sx, $sy);
}
unset($territoryRawData);

$bordersRawData=array(
	array('Edinburgh'                   ,'Clyde'                ,'Yes','Yes'),
	array('Liverpool'                   ,'Clyde'                ,'Yes','Yes'),
	array('Yorkshire'                   ,'Edinburgh'            ,'Yes','Yes'),
	array('Wales'                       ,'Liverpool'            ,'Yes','Yes'),
	array('London'                      ,'Yorkshire'            ,'Yes','Yes'),
	array('London'                      ,'Wales'                ,'Yes','Yes'),
	array('Tunis'                       ,'North Africa'         ,'Yes','Yes'),
	array('Rome'                        ,'Naples'               ,'Yes','Yes'),
	array('Tuscany'                     ,'Rome'                 ,'Yes','Yes'),
	array('Piedmont'                    ,'Tuscany'              ,'Yes','Yes'),
	array('Apulia'                      ,'Naples'               ,'Yes','Yes'),
	array('Apulia'                      ,'Venice'               ,'Yes','Yes'),
	array('Albania'                     ,'Greece'               ,'Yes','Yes'),
	array('Smyrna'                      ,'Constantinople'       ,'Yes','Yes'),
	array('Ankara'                      ,'Constantinople'       ,'Yes','Yes'),
	array('Armenia'                     ,'Ankara'               ,'Yes','Yes'),
	array('Syria'                       ,'Smyrna'               ,'Yes','Yes'),
	array('Sevastopol'                  ,'Rumania'              ,'Yes','Yes'),
	array('Sevastopol'                  ,'Armenia'              ,'Yes','Yes'),
	array('Sweden'                      ,'Finland'              ,'Yes','Yes'),
	array('Norway'                      ,'Sweden'               ,'Yes','Yes'),
	array('Denmark'                     ,'Sweden'               ,'Yes','Yes'),
	array('Kiel'                        ,'Denmark'              ,'Yes','Yes'),
	array('Berlin'                      ,'Kiel'                 ,'Yes','Yes'),
	array('Prussia'                     ,'Livonia'              ,'Yes','Yes'),
	array('Prussia'                     ,'Berlin'               ,'Yes','Yes'),
	array('Holland'                     ,'Kiel'                 ,'Yes','Yes'),
	array('Belgium'                     ,'Holland'              ,'Yes','Yes'),
	array('Picardy'                     ,'Belgium'              ,'Yes','Yes'),
	array('Brest'                       ,'Picardy'              ,'Yes','Yes'),
	array('Marseilles'                  ,'Piedmont'             ,'Yes','Yes'),
	array('Gascony'                     ,'Brest'                ,'Yes','Yes'),
	array('Trieste'                     ,'Venice'               ,'Yes','Yes'),
	array('Trieste'                     ,'Albania'              ,'Yes','Yes'),
	array('Corsica'                     ,'Sardinia'             ,'Yes','Yes'),
	array('Sicily'                      ,'Naples'               ,'Yes','Yes'),
	array('Cyprus'                      ,'Syria'                ,'Yes','Yes'),
	array('Liverpool'                   ,'Edinburgh'            ,'No' ,'Yes'),
	array('Yorkshire'                   ,'Liverpool'            ,'No' ,'Yes'),
	array('Wales'                       ,'Yorkshire'            ,'No' ,'Yes'),
	array('Spain'                       ,'Portugal'             ,'No' ,'Yes'),
	array('Venice'                      ,'Rome'                 ,'No' ,'Yes'),
	array('Venice'                      ,'Tuscany'              ,'No' ,'Yes'),
	array('Venice'                      ,'Piedmont'             ,'No' ,'Yes'),
	array('Apulia'                      ,'Rome'                 ,'No' ,'Yes'),
	array('Serbia'                      ,'Greece'               ,'No' ,'Yes'),
	array('Serbia'                      ,'Albania'              ,'No' ,'Yes'),
	array('Bulgaria'                    ,'Greece'               ,'No' ,'Yes'),
	array('Bulgaria'                    ,'Serbia'               ,'No' ,'Yes'),
	array('Rumania'                     ,'Serbia'               ,'No' ,'Yes'),
	array('Rumania'                     ,'Bulgaria'             ,'No' ,'Yes'),
	array('Constantinople'              ,'Bulgaria'             ,'No' ,'Yes'),
	array('Ankara'                      ,'Smyrna'               ,'No' ,'Yes'),
	array('Armenia'                     ,'Smyrna'               ,'No' ,'Yes'),
	array('Syria'                       ,'Armenia'              ,'No' ,'Yes'),
	array('Ukraine'                     ,'Rumania'              ,'No' ,'Yes'),
	array('Ukraine'                     ,'Sevastopol'           ,'No' ,'Yes'),
	array('Warsaw'                      ,'Ukraine'              ,'No' ,'Yes'),
	array('Livonia'                     ,'Warsaw'               ,'No' ,'Yes'),
	array('Moscow'                      ,'Sevastopol'           ,'No' ,'Yes'),
	array('Moscow'                      ,'Ukraine'              ,'No' ,'Yes'),
	array('Moscow'                      ,'Warsaw'               ,'No' ,'Yes'),
	array('Moscow'                      ,'Livonia'              ,'No' ,'Yes'),
	array('St. Petersburg'              ,'Livonia'              ,'No' ,'Yes'),
	array('St. Petersburg'              ,'Moscow'               ,'No' ,'Yes'),
	array('Finland'                     ,'St. Petersburg'       ,'No' ,'Yes'),
	array('Norway'                      ,'St. Petersburg'       ,'No' ,'Yes'),
	array('Norway'                      ,'Finland'              ,'No' ,'Yes'),
	array('Prussia'                     ,'Warsaw'               ,'No' ,'Yes'),
	array('Silesia'                     ,'Warsaw'               ,'No' ,'Yes'),
	array('Silesia'                     ,'Berlin'               ,'No' ,'Yes'),
	array('Silesia'                     ,'Prussia'              ,'No' ,'Yes'),
	array('Munich'                      ,'Kiel'                 ,'No' ,'Yes'),
	array('Munich'                      ,'Berlin'               ,'No' ,'Yes'),
	array('Munich'                      ,'Silesia'              ,'No' ,'Yes'),
	array('Ruhr'                        ,'Kiel'                 ,'No' ,'Yes'),
	array('Ruhr'                        ,'Munich'               ,'No' ,'Yes'),
	array('Holland'                     ,'Ruhr'                 ,'No' ,'Yes'),
	array('Belgium'                     ,'Ruhr'                 ,'No' ,'Yes'),
	array('Paris'                       ,'Picardy'              ,'No' ,'Yes'),
	array('Paris'                       ,'Brest'                ,'No' ,'Yes'),
	array('Burgundy'                    ,'Munich'               ,'No' ,'Yes'),
	array('Burgundy'                    ,'Ruhr'                 ,'No' ,'Yes'),
	array('Burgundy'                    ,'Belgium'              ,'No' ,'Yes'),
	array('Burgundy'                    ,'Picardy'              ,'No' ,'Yes'),
	array('Burgundy'                    ,'Paris'                ,'No' ,'Yes'),
	array('Marseilles'                  ,'Spain'                ,'No' ,'Yes'),
	array('Marseilles'                  ,'Burgundy'             ,'No' ,'Yes'),
	array('Gascony'                     ,'Spain'                ,'No' ,'Yes'),
	array('Gascony'                     ,'Paris'                ,'No' ,'Yes'),
	array('Gascony'                     ,'Burgundy'             ,'No' ,'Yes'),
	array('Gascony'                     ,'Marseilles'           ,'No' ,'Yes'),
	array('Tyrolia'                     ,'Piedmont'             ,'No' ,'Yes'),
	array('Tyrolia'                     ,'Venice'               ,'No' ,'Yes'),
	array('Tyrolia'                     ,'Munich'               ,'No' ,'Yes'),
	array('Bohemia'                     ,'Silesia'              ,'No' ,'Yes'),
	array('Bohemia'                     ,'Munich'               ,'No' ,'Yes'),
	array('Bohemia'                     ,'Tyrolia'              ,'No' ,'Yes'),
	array('Vienna'                      ,'Tyrolia'              ,'No' ,'Yes'),
	array('Vienna'                      ,'Bohemia'              ,'No' ,'Yes'),
	array('Trieste'                     ,'Serbia'               ,'No' ,'Yes'),
	array('Trieste'                     ,'Tyrolia'              ,'No' ,'Yes'),
	array('Trieste'                     ,'Vienna'               ,'No' ,'Yes'),
	array('Budapest'                    ,'Serbia'               ,'No' ,'Yes'),
	array('Budapest'                    ,'Rumania'              ,'No' ,'Yes'),
	array('Budapest'                    ,'Vienna'               ,'No' ,'Yes'),
	array('Budapest'                    ,'Trieste'              ,'No' ,'Yes'),
	array('Galicia'                     ,'Rumania'              ,'No' ,'Yes'),
	array('Galicia'                     ,'Ukraine'              ,'No' ,'Yes'),
	array('Galicia'                     ,'Warsaw'               ,'No' ,'Yes'),
	array('Galicia'                     ,'Silesia'              ,'No' ,'Yes'),
	array('Galicia'                     ,'Bohemia'              ,'No' ,'Yes'),
	array('Galicia'                     ,'Vienna'               ,'No' ,'Yes'),
	array('Galicia'                     ,'Budapest'             ,'No' ,'Yes'),
	array('Barents Sea'                 ,'Norway'               ,'Yes','No' ),
	array('Norwegian Sea'               ,'Clyde'                ,'Yes','No' ),
	array('Norwegian Sea'               ,'Edinburgh'            ,'Yes','No' ),
	array('Norwegian Sea'               ,'Norway'               ,'Yes','No' ),
	array('Norwegian Sea'               ,'Barents Sea'          ,'Yes','No' ),
	array('North Sea'                   ,'Edinburgh'            ,'Yes','No' ),
	array('North Sea'                   ,'Yorkshire'            ,'Yes','No' ),
	array('North Sea'                   ,'London'               ,'Yes','No' ),
	array('North Sea'                   ,'Norway'               ,'Yes','No' ),
	array('North Sea'                   ,'Denmark'              ,'Yes','No' ),
	array('North Sea'                   ,'Holland'              ,'Yes','No' ),
	array('North Sea'                   ,'Belgium'              ,'Yes','No' ),
	array('North Sea'                   ,'Norwegian Sea'        ,'Yes','No' ),
	array('Skagerrack'                  ,'Sweden'               ,'Yes','No' ),
	array('Skagerrack'                  ,'Norway'               ,'Yes','No' ),
	array('Skagerrack'                  ,'Denmark'              ,'Yes','No' ),
	array('Skagerrack'                  ,'North Sea'            ,'Yes','No' ),
	array('Heligoland Bight'            ,'Denmark'              ,'Yes','No' ),
	array('Heligoland Bight'            ,'Kiel'                 ,'Yes','No' ),
	array('Heligoland Bight'            ,'Holland'              ,'Yes','No' ),
	array('Heligoland Bight'            ,'North Sea'            ,'Yes','No' ),
	array('Baltic Sea'                  ,'Livonia'              ,'Yes','No' ),
	array('Baltic Sea'                  ,'Sweden'               ,'Yes','No' ),
	array('Baltic Sea'                  ,'Denmark'              ,'Yes','No' ),
	array('Baltic Sea'                  ,'Kiel'                 ,'Yes','No' ),
	array('Baltic Sea'                  ,'Berlin'               ,'Yes','No' ),
	array('Baltic Sea'                  ,'Prussia'              ,'Yes','No' ),
	array('Gulf of Bothnia'             ,'Livonia'              ,'Yes','No' ),
	array('Gulf of Bothnia'             ,'Finland'              ,'Yes','No' ),
	array('Gulf of Bothnia'             ,'Sweden'               ,'Yes','No' ),
	array('Gulf of Bothnia'             ,'Baltic Sea'           ,'Yes','No' ),
	array('North Atlantic Ocean'        ,'Clyde'                ,'Yes','No' ),
	array('North Atlantic Ocean'        ,'Liverpool'            ,'Yes','No' ),
	array('North Atlantic Ocean'        ,'Norwegian Sea'        ,'Yes','No' ),
	array('Irish Sea'                   ,'Liverpool'            ,'Yes','No' ),
	array('Irish Sea'                   ,'Wales'                ,'Yes','No' ),
	array('Irish Sea'                   ,'North Atlantic Ocean' ,'Yes','No' ),
	array('English Channel'             ,'Wales'                ,'Yes','No' ),
	array('English Channel'             ,'London'               ,'Yes','No' ),
	array('English Channel'             ,'Belgium'              ,'Yes','No' ),
	array('English Channel'             ,'Picardy'              ,'Yes','No' ),
	array('English Channel'             ,'Brest'                ,'Yes','No' ),
	array('English Channel'             ,'North Sea'            ,'Yes','No' ),
	array('English Channel'             ,'Irish Sea'            ,'Yes','No' ),
	array('Mid-Atlantic Ocean'          ,'Portugal'             ,'Yes','No' ),
	array('Mid-Atlantic Ocean'          ,'North Africa'         ,'Yes','No' ),
	array('Mid-Atlantic Ocean'          ,'Brest'                ,'Yes','No' ),
	array('Mid-Atlantic Ocean'          ,'Gascony'              ,'Yes','No' ),
	array('Mid-Atlantic Ocean'          ,'North Atlantic Ocean' ,'Yes','No' ),
	array('Mid-Atlantic Ocean'          ,'Irish Sea'            ,'Yes','No' ),
	array('Mid-Atlantic Ocean'          ,'English Channel'      ,'Yes','No' ),
	array('Western Mediterranean'       ,'North Africa'         ,'Yes','No' ),
	array('Western Mediterranean'       ,'Tunis'                ,'Yes','No' ),
	array('Western Mediterranean'       ,'Mid-Atlantic Ocean'   ,'Yes','No' ),
	array('Gulf of Lyons'               ,'Tuscany'              ,'Yes','No' ),
	array('Gulf of Lyons'               ,'Piedmont'             ,'Yes','No' ),
	array('Gulf of Lyons'               ,'Marseilles'           ,'Yes','No' ),
	array('Gulf of Lyons'               ,'Western Mediterranean','Yes','No' ),
	array('Tyrrhenian Sea'              ,'Tunis'                ,'Yes','No' ),
	array('Tyrrhenian Sea'              ,'Naples'               ,'Yes','No' ),
	array('Tyrrhenian Sea'              ,'Rome'                 ,'Yes','No' ),
	array('Tyrrhenian Sea'              ,'Tuscany'              ,'Yes','No' ),
	array('Tyrrhenian Sea'              ,'Western Mediterranean','Yes','No' ),
	array('Tyrrhenian Sea'              ,'Gulf of Lyons'        ,'Yes','No' ),
	array('Ionian Sea'                  ,'Tunis'                ,'Yes','No' ),
	array('Ionian Sea'                  ,'Naples'               ,'Yes','No' ),
	array('Ionian Sea'                  ,'Apulia'               ,'Yes','No' ),
	array('Ionian Sea'                  ,'Greece'               ,'Yes','No' ),
	array('Ionian Sea'                  ,'Albania'              ,'Yes','No' ),
	array('Ionian Sea'                  ,'Tyrrhenian Sea'       ,'Yes','No' ),
	array('Adriatic Sea'                ,'Venice'               ,'Yes','No' ),
	array('Adriatic Sea'                ,'Apulia'               ,'Yes','No' ),
	array('Adriatic Sea'                ,'Albania'              ,'Yes','No' ),
	array('Adriatic Sea'                ,'Ionian Sea'           ,'Yes','No' ),
	array('Aegean Sea'                  ,'Greece'               ,'Yes','No' ),
	array('Aegean Sea'                  ,'Constantinople'       ,'Yes','No' ),
	array('Aegean Sea'                  ,'Smyrna'               ,'Yes','No' ),
	array('Aegean Sea'                  ,'Ionian Sea'           ,'Yes','No' ),
	array('Eastern Mediterranean'       ,'Smyrna'               ,'Yes','No' ),
	array('Eastern Mediterranean'       ,'Syria'                ,'Yes','No' ),
	array('Eastern Mediterranean'       ,'Ionian Sea'           ,'Yes','No' ),
	array('Eastern Mediterranean'       ,'Aegean Sea'           ,'Yes','No' ),
	array('Black Sea'                   ,'Rumania'              ,'Yes','No' ),
	array('Black Sea'                   ,'Constantinople'       ,'Yes','No' ),
	array('Black Sea'                   ,'Ankara'               ,'Yes','No' ),
	array('Black Sea'                   ,'Armenia'              ,'Yes','No' ),
	array('Black Sea'                   ,'Sevastopol'           ,'Yes','No' ),
	array('Trieste'                     ,'Adriatic Sea'         ,'Yes','No' ),
	array('Iceland'                     ,'North Atlantic Ocean' ,'Yes','No' ),
	array('Iceland'                     ,'Norwegian Sea'        ,'Yes','No' ),
	array('Ireland'                     ,'North Atlantic Ocean' ,'Yes','No' ),
	array('Ireland'                     ,'Irish Sea'            ,'Yes','No' ),
	array('Corsica'                     ,'Gulf of Lyons'        ,'Yes','No' ),
	array('Corsica'                     ,'Tyrrhenian Sea'       ,'Yes','No' ),
	array('Sardinia'                    ,'Gulf of Lyons'        ,'Yes','No' ),
	array('Sardinia'                    ,'Tyrrhenian Sea'       ,'Yes','No' ),
	array('Sardinia'                    ,'Western Mediterranean','Yes','No' ),
	array('Sicily'                      ,'Tyrrhenian Sea'       ,'Yes','No' ),
	array('Sicily'                      ,'Ionian Sea'           ,'Yes','No' ),
	array('Crete'                       ,'Ionian Sea'           ,'Yes','No' ),
	array('Crete'                       ,'Aegean Sea'           ,'Yes','No' ),
	array('Crete'                       ,'Eastern Mediterranean','Yes','No' ),
	array('Cyprus'                      ,'Eastern Mediterranean','Yes','No' ),
	array('Spain (North Coast)'         ,'Portugal'             ,'Yes','No' ),
	array('Spain (North Coast)'         ,'Gascony'              ,'Yes','No' ),
	array('Spain (North Coast)'         ,'Mid-Atlantic Ocean'   ,'Yes','No' ),
	array('Spain (South Coast)'         ,'Portugal'             ,'Yes','No' ),
	array('Spain (South Coast)'         ,'Marseilles'           ,'Yes','No' ),
	array('Spain (South Coast)'         ,'Mid-Atlantic Ocean'   ,'Yes','No' ),
	array('Spain (South Coast)'         ,'Western Mediterranean','Yes','No' ),
	array('Spain (South Coast)'         ,'Gulf of Lyons'        ,'Yes','No' ),
	array('St. Petersburg (North Coast)','Norway'               ,'Yes','No' ),
	array('St. Petersburg (North Coast)','Barents Sea'          ,'Yes','No' ),
	array('St. Petersburg (South Coast)','Livonia'              ,'Yes','No' ),
	array('St. Petersburg (South Coast)','Finland'              ,'Yes','No' ),
	array('St. Petersburg (South Coast)','Gulf of Bothnia'      ,'Yes','No' ),
	array('Bulgaria (North Coast)'      ,'Rumania'              ,'Yes','No' ),
	array('Bulgaria (North Coast)'      ,'Constantinople'       ,'Yes','No' ),
	array('Bulgaria (North Coast)'      ,'Black Sea'            ,'Yes','No' ),
	array('Bulgaria (South Coast)'      ,'Greece'               ,'Yes','No' ),
	array('Bulgaria (South Coast)'      ,'Constantinople'       ,'Yes','No' ),
	array('Bulgaria (South Coast)'      ,'Aegean Sea'           ,'Yes','No' )
);

foreach($bordersRawData as $borderRawRow)
{
	list($from, $to, $fleets, $armies)=$borderRawRow;
	InstallTerritory::$Territories[$from]->addBorder(InstallTerritory::$Territories[$to]  ,$fleets,$armies);
	InstallTerritory::$Territories[$to]  ->addBorder(InstallTerritory::$Territories[$from],$fleets,$armies);
}
unset($bordersRawData);

InstallTerritory::runSQL($this->mapID);
InstallCache::terrJSON($this->territoriesJSONFile(),$this->mapID);

?>