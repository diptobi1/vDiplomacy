<?php
// This is file installs the map data for the Empire4 variant
defined('IN_CODE') or die('This script can not be run by itself.');
require_once("variants/install.php");

InstallTerritory::$Territories=array();
$countries=$this->countries;
$territoryRawData=array(
	array('Anchorage', 'Coast', 'Yes', 1, 290, 270, 140, 125),
	array('Yukon', 'Coast', 'No', 1, 384, 380, 192, 185),
	array('Calgary', 'Land', 'Yes', 1, 530, 616, 265, 309),
	array('Northern BC', 'Land', 'No', 1, 422, 510, 211, 272),
	array('Vancouver', 'Coast', 'Yes', 1, 426, 638, 220, 332),
	array('Abitibi', 'Coast', 'No', 8, 982, 675, 491, 336),
	array('Ungava', 'Coast', 'Yes', 8, 985, 540, 495, 270),
	array('Cote-Nord', 'Coast', 'No', 8, 1065, 595, 536, 295),
	array('Quebec', 'Coast', 'Yes', 8, 1040, 675, 518, 339),
	array('Montreal', 'Coast', 'Yes', 8, 1030, 710, 509, 357),
	array('Beauce', 'Coast', 'No', 8, 1073, 708, 538, 355),
	array('Gaspesie', 'Coast', 'No', 8, 1105, 630, 553, 315),
	array('San Francisco', 'Coast', 'Yes', 2, 360, 880, 180, 442),
	array('Los Angeles', 'Coast', 'Yes', 2, 360, 952, 185, 476),
	array('San Diego', 'Coast', 'Yes', 2, 411, 1009, 210, 500),
	array('Dallas', 'Land', 'Yes', 9, 770, 1040, 385, 520),
	array('Houston', 'Coast', 'Yes', 9, 780, 1090, 397, 546),
	array('San Antonio', 'Coast', 'Yes', 9, 745, 1125, 368, 560),
	array('West Texas', 'Land', 'No', 9, 675, 1065, 337, 533),
	array('Minneapolis', 'Coast', 'Yes', 4, 768, 770, 387, 408),
	array('Iowa', 'Land', 'No', 4, 790, 855, 395, 436),
	array('Indiana', 'Coast', 'No', 4, 910, 875, 455, 435),
	array('Chicago', 'Coast', 'Yes', 4, 868, 899, 436, 452),
	array('Milwaukee', 'Coast', 'Yes', 4, 837, 815, 418, 410),
	array('Milwaukee (North Coast)', 'Coast', 'No', 4, 818, 765, 409, 388),
	array('Milwaukee (East Coast)', 'Coast', 'No', 4, 863, 824, 434, 412),
	array('West Pennsylvania', 'Coast', 'No', 6, 1020, 830, 509, 415),
	array('New York State', 'Coast', 'No', 6, 1045, 782, 520, 392),
	array('New York City', 'Coast', 'Yes', 6, 1090, 788, 544, 393),
	array('New Jersey', 'Coast', 'Yes', 6, 1088, 818, 544, 409),
	array('Philadelphia', 'Land', 'Yes', 6, 1048, 810, 522, 414),
	array('Florida Panhandle', 'Coast', 'No', 3, 978, 1049, 493, 524),
	array('Jacksonville', 'Coast', 'Yes', 3, 1048, 1048, 524, 524),
	array('Miami', 'Coast', 'Yes', 3, 1058, 1088, 528, 545),
	array('Tampa', 'Coast', 'Yes', 3, 1023, 1058, 512, 531),
	array('Havana', 'Coast', 'Yes', 10, 1060, 1165, 538, 580),
	array('Holguin', 'Coast', 'Yes', 10, 1184, 1155, 592, 579),
	array('Kingston', 'Coast', 'Yes', 10, 1194, 1204, 597, 602),
	array('Camaguey', 'Coast', 'No', 10, 1135, 1156, 565, 579),
	array('Camaguey (North Coast)', 'Coast', 'No', 10, 1142, 1144, 571, 572),
	array('Camaguey (South Coast)', 'Coast', 'No', 10, 1142, 1164, 569, 584),
	array('Guadalajara', 'Coast', 'Yes', 5, 625, 1260, 310, 631),
	array('Potosi', 'Coast', 'No', 5, 700, 1220, 344, 608),
	array('Veracruz', 'Coast', 'Yes', 5, 780, 1280, 394, 639),
	array('Mexico', 'Land', 'Yes', 5, 722, 1280, 363, 640),
	array('Guerrero', 'Coast', 'No', 5, 680, 1298, 340, 649),
	array('Oaxaca', 'Coast', 'No', 5, 748, 1320, 375, 660),
	array('Antioquia', 'Coast', 'No', 7, 1280, 1350, 642, 672),
	array('Guajira', 'Coast', 'No', 7, 1306, 1294, 653, 647),
	array('Vichada', 'Land', 'No', 7, 1378, 1360, 689, 682),
	array('Bogota', 'Land', 'Yes', 7, 1364, 1410, 684, 703),
	array('Lima', 'Coast', 'Yes', 7, 1352, 1525, 674, 765),
	array('Ecuador', 'Coast', 'No', 7, 1245, 1520, 628, 760),
	array('Cali', 'Coast', 'Yes', 7, 1280, 1420, 640, 710),
	array('Cali (North Coast)', 'Coast', 'No', 7, 1256, 1358, 628, 679),
	array('Cali (South Coast)', 'Coast', 'No', 7, 1270, 1420, 635, 710),
	array('North West Territories', 'Coast', 'No', 0, 470, 390, 235, 195),
	array('Nunavut', 'Coast', 'No', 0, 712, 385, 356, 190),
	array('Manitoba', 'Coast', 'Yes', 0, 724, 615, 362, 295),
	array('Saskatchewan', 'Land', 'No', 0, 624, 665, 312, 315),
	array('Northern Ontario', 'Coast', 'No', 0, 866, 600, 445, 330),
	array('Western Ontario', 'Coast', 'No', 0, 805, 685, 403, 362),
	array('Ontario', 'Coast', 'Yes', 0, 980, 745, 465, 366),
	array('Labrador', 'Coast', 'No', 0, 1125, 478, 559, 255),
	array('Nova Scotia', 'Coast', 'Yes', 0, 1175, 663, 587, 330),
	array('Newfoundland', 'Coast', 'No', 0, 1222, 532, 611, 278),
	array('Washington', 'Coast', 'Yes', 0, 410, 742, 211, 360),
	array('Oregon', 'Coast', 'Yes', 0, 410, 785, 205, 394),
	array('Idaho', 'Land', 'No', 0, 485, 815, 240, 407),
	array('Arizona', 'Land', 'Yes', 0, 508, 1005, 254, 505),
	array('Utah', 'Land', 'No', 0, 518, 920, 259, 460),
	array('Nevada', 'Land', 'No', 0, 438, 900, 219, 450),
	array('New Mexico', 'Land', 'No', 0, 604, 1000, 302, 518),
	array('Colorado', 'Land', 'Yes', 0, 610, 920, 300, 458),
	array('Wyoming', 'Land', 'No', 0, 590, 855, 295, 420),
	array('Montana', 'Land', 'No', 0, 560, 775, 280, 388),
	array('Oklahoma', 'Land', 'No', 0, 750, 1000, 375, 500),
	array('Kansas', 'Land', 'Yes', 0, 750, 925, 380, 462),
	array('Nebraska', 'Land', 'No', 0, 725, 885, 352, 447),
	array('Dakotas', 'Land', 'No', 0, 696, 805, 348, 405),
	array('Missouri', 'Coast', 'Yes', 0, 818, 916, 408, 458),
	array('Arkansas', 'Coast', 'No', 0, 830, 1000, 415, 491),
	array('Louisiana', 'Coast', 'Yes', 0, 836, 1055, 419, 525),
	array('Lake Ontario', 'Sea', 'No', 0, 1014, 776, 509, 388),
	array('Upper Peninsula', 'Coast', 'No', 0, 875, 765, 437, 382),
	array('Michigan', 'Coast', 'Yes', 0, 924, 802, 460, 398),
	array('Lake Michigan', 'Sea', 'No', 0, 885, 810, 443, 406),
	array('Lake Superior', 'Sea', 'No', 0, 868, 740, 437, 370),
	array('Lake Huron', 'Sea', 'No', 0, 938, 768, 469, 384),
	array('Lake Erie', 'Sea', 'No', 0, 968, 822, 492, 405),
	array('Ohio', 'Coast', 'Yes', 0, 962, 855, 482, 436),
	array('Maine', 'Coast', 'No', 0, 1118, 692, 560, 348),
	array('Vermont', 'Coast', 'No', 0, 1080, 730, 540, 366),
	array('Massachusetts', 'Coast', 'Yes', 0, 1100, 768, 555, 384),
	array('Washington DC', 'Coast', 'Yes', 0, 1070, 850, 540, 429),
	array('Virginia', 'Coast', 'No', 0, 1048, 880, 524, 440),
	array('West Virginia', 'Land', 'No', 0, 997, 888, 498, 447),
	array('Kentucky', 'Coast', 'No', 0, 950, 905, 472, 462),
	array('Tennessee', 'Coast', 'Yes', 0, 950, 950, 473, 477),
	array('Deep South', 'Coast', 'No', 0, 912, 1005, 467, 505),
	array('Georgia', 'Coast', 'Yes', 0, 1002, 998, 499, 498),
	array('South Carolina', 'Coast', 'No', 0, 1036, 972, 517, 489),
	array('North Carolina', 'Coast', 'Yes', 0, 1065, 928, 535, 464),
	array('Haiti', 'Coast', 'No', 0, 1270, 1142, 635, 571),
	array('Dominican Republic', 'Coast', 'Yes', 0, 1330, 1126, 665, 563),
	array('Baja California', 'Coast', 'No', 0, 449, 1116, 227, 558),
	array('Chihuahua', 'Coast', 'Yes', 0, 560, 1100, 276, 565),
	array('Coahuila', 'Land', 'No', 0, 668, 1145, 334, 578),
	array('Nuevo Leon', 'Coast', 'Yes', 0, 745, 1185, 374, 591),
	array('Durango', 'Coast', 'Yes', 0, 590, 1175, 300, 585),
	array('Chiapas', 'Coast', 'No', 0, 847, 1320, 419, 661),
	array('Tabasco', 'Coast', 'No', 0, 882, 1290, 439, 643),
	array('Yucatan', 'Coast', 'Yes', 0, 944, 1242, 462, 632),
	array('El Salvador', 'Coast', 'No', 0, 968, 1348, 484, 674),
	array('Panama', 'Coast', 'Yes', 0, 1164, 1386, 582, 693),
	array('Venezuela', 'Coast', 'Yes', 0, 1373, 1278, 687, 640),
	array('Hawaii', 'Coast', 'Yes', 0, 186, 1308, 93, 654),
	array('Greenland', 'Coast', 'Yes', 0, 1000, 100, 531, 75),
	array('Bering Sea', 'Sea', 'No', 0, 78, 160, 39, 100),
	array('Arctic Ocean', 'Sea', 'No', 0, 412, 118, 206, 59),
	array('Beaufort Sea', 'Sea', 'No', 0, 472, 220, 236, 105),
	array('Hudson Bay', 'Sea', 'No', 0, 834, 510, 417, 245),
	array('Baffin Bay', 'Sea', 'No', 0, 905, 194, 440, 95),
	array('Sea of Labrador', 'Sea', 'No', 0, 1108, 374, 554, 175),
	array('North Atlantic Ocean', 'Sea', 'No', 0, 1310, 400, 650, 200),
	array('Gulf of St-Lawrence', 'Sea', 'No', 0, 1165, 610, 595, 291),
	array('Massachusetts Bay', 'Sea', 'No', 0, 1220, 715, 610, 363),
	array('Mid Atlantic Ocean', 'Sea', 'No', 0, 1350, 770, 670, 380),
	array('Chesapeake Bay', 'Sea', 'No', 0, 1180, 905, 590, 453),
	array('Cape May', 'Sea', 'No', 0, 1180, 820, 597, 410),
	array('Sea of Sargasso', 'Sea', 'No', 0, 1350, 945, 680, 475),
	array('Bermuda Triangle', 'Sea', 'No', 0, 1260, 1048, 630, 515),
	array('East Coast', 'Sea', 'No', 0, 1130, 985, 571, 485),
	array('Straits of Florida', 'Sea', 'No', 0, 1105, 1115, 555, 558),
	array('East Caribbean Sea', 'Sea', 'No', 0, 1280, 1190, 635, 597),
	array('Lesser Antilles', 'Sea', 'No', 0, 1364, 1150, 685, 573),
	array('Apalachee Bay', 'Sea', 'No', 0, 950, 1085, 488, 555),
	array('Gulf of Mexico', 'Sea', 'No', 0, 864, 1155, 430, 573),
	array('Gulf of Campeche', 'Sea', 'No', 0, 800, 1235, 400, 618),
	array('Straits of Yucatan', 'Sea', 'No', 0, 1009, 1175, 505, 584),
	array('Gulf of Honduras', 'Sea', 'No', 0, 1008, 1250, 500, 641),
	array('Cayman Trench', 'Sea', 'No', 0, 1220, 1178, 611, 590),
	array('West Caribbean Sea', 'Sea', 'No', 0, 1118, 1245, 563, 640),
	array('South Caribbean Sea', 'Sea', 'No', 0, 1250, 1275, 625, 637),
	array('Gulf of Mosquitos', 'Sea', 'No', 0, 1144, 1330, 572, 665),
	array('North Pacific Ocean', 'Sea', 'No', 0, 130, 940, 65, 460),
	array('Gulf of Alaska', 'Sea', 'No', 0, 130, 490, 78, 241),
	array('Queen Charlotte Sound', 'Sea', 'No', 0, 270, 580, 135, 300),
	array('Straits of Juan de Fuca', 'Sea', 'No', 0, 314, 702, 157, 330),
	array('West Coast', 'Sea', 'No', 0, 280, 855, 140, 435),
	array('Mid Pacific Ocean', 'Sea', 'No', 0, 410, 1280, 200, 625),
	array('Gulf of Santa Catalina', 'Sea', 'No', 0, 354, 1010, 179, 499),
	array('South West Pacific Ocean', 'Sea', 'No', 0, 140, 1440, 50, 710),
	array('Coast of Mexico', 'Sea', 'No', 0, 680, 1370, 340, 680),
	array('Gulf of California', 'Sea', 'No', 0, 540, 1225, 270, 603),
	array('Gulf of Tehuantepec', 'Sea', 'No', 0, 825, 1363, 425, 686),
	array('South Pacific Ocean', 'Sea', 'No', 0, 550, 1490, 280, 740),
	array('Galapagos', 'Sea', 'No', 0, 1020, 1520, 505, 760),
	array('Gulf of Guayaquil', 'Sea', 'No', 0, 1130, 1470, 580, 755),
	array('Gulf of Panama', 'Sea', 'No', 0, 1210, 1405, 607, 697),
	array('Coronado Bay', 'Sea', 'No', 0, 1075, 1433, 536, 717),
	array('Gulf of Fonseca', 'Sea', 'No', 0, 978, 1390, 489, 690),
	array('New Brunswick', 'Coast', 'No', 0, 1130, 650, 565, 324),
	array('New Brunswick (North Coast)', 'Coast', 'No', 0, 1142, 636, 571, 318),
	array('New Brunswick (South Coast)', 'Coast', 'No', 0, 1140, 676, 574, 338),
	array('Honduras', 'Coast', 'No', 0, 1022, 1312, 511, 656),
	array('Honduras (North Coast)', 'Coast', 'No', 0, 1000, 1305, 520, 645),
	array('Honduras (South Coast)', 'Coast', 'No', 0, 995, 1345, 498, 674),
	array('Nicaragua', 'Coast', 'Yes', 0, 1060, 1330, 530, 662),
	array('Nicaragua (East Coast)', 'Coast', 'No', 0, 1078, 1322, 540, 661),
	array('Nicaragua (West Coast)', 'Coast', 'No', 0, 1020, 1360, 510, 681),
	array('Costa Rica', 'Coast', 'No', 0, 1097, 1382, 545, 691),
	array('Costa Rica (North Coast)', 'Coast', 'No', 0, 1100, 1368, 549, 682),
	array('Costa Rica (South Coast)', 'Coast', 'No', 0, 1100, 1395, 531, 697),
	array('Guatemala', 'Coast', 'Yes', 0, 945, 1298, 470, 650),
	array('Guatemala (South Coast)', 'Coast', 'No', 0, 926, 1350, 463, 675),
	array('Guatemala (East Coast)', 'Coast', 'No', 0, 965, 1298, 484, 645)
);

foreach($territoryRawData as $territoryRawRow)
{
	list($name, $type, $supply, $countryID, $x, $y, $sx, $sy)=$territoryRawRow;
	new InstallTerritory($name, $type, $supply, $countryID, $x, $y, $sx, $sy);
}
unset($territoryRawData);

$bordersRawData=array(
	array('Anchorage','Yukon','Yes','Yes'),
	array('Anchorage','Northern BC','No','Yes'),
	array('Anchorage','Vancouver','Yes','Yes'),
	array('Anchorage','Bering Sea','Yes','No'),
	array('Anchorage','Arctic Ocean','Yes','No'),
	array('Anchorage','Beaufort Sea','Yes','No'),
	array('Anchorage','Gulf of Alaska','Yes','No'),
	array('Anchorage','Queen Charlotte Sound','Yes','No'),
	array('Yukon','Northern BC','No','Yes'),
	array('Yukon','North West Territories','Yes','Yes'),
	array('Yukon','Beaufort Sea','Yes','No'),
	array('Calgary','Northern BC','No','Yes'),
	array('Calgary','Vancouver','No','Yes'),
	array('Calgary','North West Territories','No','Yes'),
	array('Calgary','Saskatchewan','No','Yes'),
	array('Calgary','Montana','No','Yes'),
	array('Northern BC','Vancouver','No','Yes'),
	array('Northern BC','North West Territories','No','Yes'),
	array('Vancouver','Washington','Yes','Yes'),
	array('Vancouver','Idaho','No','Yes'),
	array('Vancouver','Montana','No','Yes'),
	array('Vancouver','Queen Charlotte Sound','Yes','No'),
	array('Vancouver','Straits of Juan de Fuca','Yes','No'),
	array('Abitibi','Ungava','Yes','Yes'),
	array('Abitibi','Quebec','No','Yes'),
	array('Abitibi','Montreal','No','Yes'),
	array('Abitibi','Northern Ontario','Yes','Yes'),
	array('Abitibi','Hudson Bay','Yes','No'),
	array('Ungava','Cote-Nord','No','Yes'),
	array('Ungava','Quebec','No','Yes'),
	array('Ungava','Nunavut','Yes','Yes'),
	array('Ungava','Labrador','Yes','Yes'),
	array('Ungava','Hudson Bay','Yes','No'),
	array('Ungava','Sea of Labrador','Yes','No'),
	array('Cote-Nord','Quebec','Yes','Yes'),
	array('Cote-Nord','Labrador','Yes','Yes'),
	array('Cote-Nord','Gulf of St-Lawrence','Yes','No'),
	array('Quebec','Montreal','Yes','Yes'),
	array('Quebec','Beauce','Yes','Yes'),
	array('Quebec','Gaspesie','Yes','Yes'),
	array('Quebec','Gulf of St-Lawrence','Yes','No'),
	array('Montreal','Beauce','Yes','Yes'),
	array('Montreal','Northern Ontario','No','Yes'),
	array('Montreal','Ontario','Yes','Yes'),
	array('Beauce','Gaspesie','Yes','Yes'),
	array('Beauce','New York State','Yes','Yes'),
	array('Beauce','Ontario','Yes','Yes'),
	array('Beauce','Maine','No','Yes'),
	array('Beauce','Vermont','No','Yes'),
	array('Gaspesie','Maine','No','Yes'),
	array('Gaspesie','Gulf of St-Lawrence','Yes','No'),
	array('Gaspesie','New Brunswick','No','Yes'),
	array('Gaspesie','New Brunswick (North Coast)','Yes','No'),
	array('San Francisco','Los Angeles','Yes','Yes'),
	array('San Francisco','Oregon','Yes','Yes'),
	array('San Francisco','Nevada','No','Yes'),
	array('San Francisco','West Coast','Yes','No'),
	array('Los Angeles','San Diego','Yes','Yes'),
	array('Los Angeles','Nevada','No','Yes'),
	array('Los Angeles','West Coast','Yes','No'),
	array('Los Angeles','Gulf of Santa Catalina','Yes','No'),
	array('San Diego','Arizona','No','Yes'),
	array('San Diego','Nevada','No','Yes'),
	array('San Diego','Baja California','Yes','Yes'),
	array('San Diego','Gulf of Santa Catalina','Yes','No'),
	array('Dallas','Houston','No','Yes'),
	array('Dallas','San Antonio','No','Yes'),
	array('Dallas','West Texas','No','Yes'),
	array('Dallas','New Mexico','No','Yes'),
	array('Dallas','Oklahoma','No','Yes'),
	array('Dallas','Arkansas','No','Yes'),
	array('Dallas','Louisiana','No','Yes'),
	array('Houston','San Antonio','Yes','Yes'),
	array('Houston','Louisiana','Yes','Yes'),
	array('Houston','Gulf of Mexico','Yes','No'),
	array('San Antonio','West Texas','No','Yes'),
	array('San Antonio','Coahuila','No','Yes'),
	array('San Antonio','Nuevo Leon','Yes','Yes'),
	array('San Antonio','Gulf of Mexico','Yes','No'),
	array('West Texas','New Mexico','No','Yes'),
	array('West Texas','Chihuahua','No','Yes'),
	array('West Texas','Coahuila','No','Yes'),
	array('Minneapolis','Iowa','No','Yes'),
	array('Minneapolis','Milwaukee','No','Yes'),
	array('Minneapolis','Milwaukee (North Coast)','Yes','No'),
	array('Minneapolis','Manitoba','No','Yes'),
	array('Minneapolis','Western Ontario','Yes','Yes'),
	array('Minneapolis','Dakotas','No','Yes'),
	array('Minneapolis','Lake Superior','Yes','No'),
	array('Iowa','Chicago','No','Yes'),
	array('Iowa','Milwaukee','No','Yes'),
	array('Iowa','Nebraska','No','Yes'),
	array('Iowa','Dakotas','No','Yes'),
	array('Iowa','Missouri','No','Yes'),
	array('Indiana','Chicago','Yes','Yes'),
	array('Indiana','Michigan','Yes','Yes'),
	array('Indiana','Lake Michigan','Yes','No'),
	array('Indiana','Ohio','No','Yes'),
	array('Indiana','Kentucky','No','Yes'),
	array('Chicago','Milwaukee','No','Yes'),
	array('Chicago','Milwaukee (East Coast)','Yes','No'),
	array('Chicago','Missouri','Yes','Yes'),
	array('Chicago','Lake Michigan','Yes','No'),
	array('Chicago','Kentucky','Yes','Yes'),
	array('Milwaukee','Upper Peninsula','No','Yes'),
	array('Milwaukee (North Coast)','Upper Peninsula','Yes','No'),
	array('Milwaukee (North Coast)','Lake Superior','Yes','No'),
	array('Milwaukee (East Coast)','Upper Peninsula','Yes','No'),
	array('Milwaukee (East Coast)','Lake Michigan','Yes','No'),
	array('West Pennsylvania','New York State','Yes','Yes'),
	array('West Pennsylvania','Philadelphia','No','Yes'),
	array('West Pennsylvania','Lake Erie','Yes','No'),
	array('West Pennsylvania','Ohio','Yes','Yes'),
	array('West Pennsylvania','Washington DC','No','Yes'),
	array('West Pennsylvania','West Virginia','No','Yes'),
	array('New York State','New York City','Yes','Yes'),
	array('New York State','Philadelphia','No','Yes'),
	array('New York State','Ontario','Yes','Yes'),
	array('New York State','Lake Ontario','Yes','No'),
	array('New York State','Lake Erie','Yes','No'),
	array('New York State','Vermont','No','Yes'),
	array('New York State','Massachusetts','No','Yes'),
	array('New York City','New Jersey','Yes','Yes'),
	array('New York City','Philadelphia','No','Yes'),
	array('New York City','Massachusetts','Yes','Yes'),
	array('New York City','Cape May','Yes','No'),
	array('New Jersey','Philadelphia','No','Yes'),
	array('New Jersey','Washington DC','Yes','Yes'),
	array('New Jersey','Cape May','Yes','No'),
	array('Philadelphia','Washington DC','No','Yes'),
	array('Florida Panhandle','Jacksonville','No','Yes'),
	array('Florida Panhandle','Tampa','Yes','Yes'),
	array('Florida Panhandle','Deep South','Yes','Yes'),
	array('Florida Panhandle','Georgia','No','Yes'),
	array('Florida Panhandle','Apalachee Bay','Yes','No'),
	array('Jacksonville','Miami','Yes','Yes'),
	array('Jacksonville','Tampa','No','Yes'),
	array('Jacksonville','Georgia','Yes','Yes'),
	array('Jacksonville','East Coast','Yes','No'),
	array('Miami','Tampa','Yes','Yes'),
	array('Miami','East Coast','Yes','No'),
	array('Miami','Straits of Florida','Yes','No'),
	array('Miami','Apalachee Bay','Yes','No'),
	array('Tampa','Apalachee Bay','Yes','No'),
	array('Havana','Camaguey','No','Yes'),
	array('Havana','Camaguey (North Coast)','Yes','No'),
	array('Havana','Camaguey (South Coast)','Yes','No'),
	array('Havana','Straits of Florida','Yes','No'),
	array('Havana','Straits of Yucatan','Yes','No'),
	array('Havana','West Caribbean Sea','Yes','No'),
	array('Holguin','Camaguey','No','Yes'),
	array('Holguin','Camaguey (North Coast)','Yes','No'),
	array('Holguin','Camaguey (South Coast)','Yes','No'),
	array('Holguin','Bermuda Triangle','Yes','No'),
	array('Holguin','Cayman Trench','Yes','No'),
	array('Kingston','East Caribbean Sea','Yes','No'),
	array('Kingston','Cayman Trench','Yes','No'),
	array('Kingston','West Caribbean Sea','Yes','No'),
	array('Camaguey (North Coast)','Bermuda Triangle','Yes','No'),
	array('Camaguey (North Coast)','Straits of Florida','Yes','No'),
	array('Camaguey (South Coast)','Cayman Trench','Yes','No'),
	array('Camaguey (South Coast)','West Caribbean Sea','Yes','No'),
	array('Guadalajara','Potosi','No','Yes'),
	array('Guadalajara','Mexico','No','Yes'),
	array('Guadalajara','Guerrero','Yes','Yes'),
	array('Guadalajara','Durango','Yes','Yes'),
	array('Guadalajara','Coast of Mexico','Yes','No'),
	array('Guadalajara','Gulf of California','Yes','No'),
	array('Potosi','Veracruz','Yes','Yes'),
	array('Potosi','Mexico','No','Yes'),
	array('Potosi','Coahuila','No','Yes'),
	array('Potosi','Nuevo Leon','Yes','Yes'),
	array('Potosi','Durango','No','Yes'),
	array('Potosi','Gulf of Campeche','Yes','No'),
	array('Veracruz','Mexico','No','Yes'),
	array('Veracruz','Oaxaca','No','Yes'),
	array('Veracruz','Chiapas','No','Yes'),
	array('Veracruz','Tabasco','Yes','Yes'),
	array('Veracruz','Gulf of Campeche','Yes','No'),
	array('Mexico','Guerrero','No','Yes'),
	array('Mexico','Oaxaca','No','Yes'),
	array('Guerrero','Oaxaca','Yes','Yes'),
	array('Guerrero','Coast of Mexico','Yes','No'),
	array('Oaxaca','Chiapas','Yes','Yes'),
	array('Oaxaca','Coast of Mexico','Yes','No'),
	array('Oaxaca','Gulf of Tehuantepec','Yes','No'),
	array('Antioquia','Guajira','Yes','Yes'),
	array('Antioquia','Vichada','No','Yes'),
	array('Antioquia','Bogota','No','Yes'),
	array('Antioquia','Cali','No','Yes'),
	array('Antioquia','Cali (North Coast)','Yes','No'),
	array('Antioquia','South Caribbean Sea','Yes','No'),
	array('Guajira','Vichada','No','Yes'),
	array('Guajira','Venezuela','Yes','Yes'),
	array('Guajira','South Caribbean Sea','Yes','No'),
	array('Vichada','Bogota','No','Yes'),
	array('Vichada','Venezuela','No','Yes'),
	array('Bogota','Lima','No','Yes'),
	array('Bogota','Ecuador','No','Yes'),
	array('Bogota','Cali','No','Yes'),
	array('Lima','Ecuador','Yes','Yes'),
	array('Lima','Galapagos','Yes','No'),
	array('Lima','Gulf of Guayaquil','Yes','No'),
	array('Ecuador','Cali','No','Yes'),
	array('Ecuador','Cali (South Coast)','Yes','No'),
	array('Ecuador','Gulf of Guayaquil','Yes','No'),
	array('Cali','Panama','No','Yes'),
	array('Cali (North Coast)','Panama','Yes','No'),
	array('Cali (North Coast)','South Caribbean Sea','Yes','No'),
	array('Cali (South Coast)','Panama','Yes','No'),
	array('Cali (South Coast)','Gulf of Guayaquil','Yes','No'),
	array('Cali (South Coast)','Gulf of Panama','Yes','No'),
	array('North West Territories','Nunavut','Yes','Yes'),
	array('North West Territories','Saskatchewan','No','Yes'),
	array('North West Territories','Arctic Ocean','Yes','No'),
	array('North West Territories','Beaufort Sea','Yes','No'),
	array('Nunavut','Manitoba','Yes','Yes'),
	array('Nunavut','Saskatchewan','No','Yes'),
	array('Nunavut','Arctic Ocean','Yes','No'),
	array('Nunavut','Beaufort Sea','Yes','No'),
	array('Nunavut','Hudson Bay','Yes','No'),
	array('Nunavut','Baffin Bay','Yes','No'),
	array('Nunavut','Sea of Labrador','Yes','No'),
	array('Manitoba','Saskatchewan','No','Yes'),
	array('Manitoba','Northern Ontario','Yes','Yes'),
	array('Manitoba','Western Ontario','No','Yes'),
	array('Manitoba','Dakotas','No','Yes'),
	array('Manitoba','Hudson Bay','Yes','No'),
	array('Saskatchewan','Montana','No','Yes'),
	array('Saskatchewan','Dakotas','No','Yes'),
	array('Northern Ontario','Western Ontario','No','Yes'),
	array('Northern Ontario','Ontario','No','Yes'),
	array('Northern Ontario','Hudson Bay','Yes','No'),
	array('Western Ontario','Ontario','Yes','Yes'),
	array('Western Ontario','Lake Superior','Yes','No'),
	array('Ontario','Lake Ontario','Yes','No'),
	array('Ontario','Upper Peninsula','Yes','Yes'),
	array('Ontario','Michigan','Yes','Yes'),
	array('Ontario','Lake Superior','Yes','No'),
	array('Ontario','Lake Huron','Yes','No'),
	array('Ontario','Lake Erie','Yes','No'),
	array('Labrador','Sea of Labrador','Yes','No'),
	array('Labrador','Gulf of St-Lawrence','Yes','No'),
	array('Nova Scotia','North Atlantic Ocean','Yes','No'),
	array('Nova Scotia','Gulf of St-Lawrence','Yes','No'),
	array('Nova Scotia','Massachusetts Bay','Yes','No'),
	array('Nova Scotia','New Brunswick','No','Yes'),
	array('Nova Scotia','New Brunswick (North Coast)','Yes','No'),
	array('Nova Scotia','New Brunswick (South Coast)','Yes','No'),
	array('Newfoundland','Sea of Labrador','Yes','No'),
	array('Newfoundland','North Atlantic Ocean','Yes','No'),
	array('Newfoundland','Gulf of St-Lawrence','Yes','No'),
	array('Washington','Oregon','Yes','Yes'),
	array('Washington','Idaho','No','Yes'),
	array('Washington','Straits of Juan de Fuca','Yes','No'),
	array('Oregon','Idaho','No','Yes'),
	array('Oregon','Nevada','No','Yes'),
	array('Oregon','Straits of Juan de Fuca','Yes','No'),
	array('Oregon','West Coast','Yes','No'),
	array('Idaho','Utah','No','Yes'),
	array('Idaho','Nevada','No','Yes'),
	array('Idaho','Wyoming','No','Yes'),
	array('Idaho','Montana','No','Yes'),
	array('Arizona','Utah','No','Yes'),
	array('Arizona','Nevada','No','Yes'),
	array('Arizona','New Mexico','No','Yes'),
	array('Arizona','Colorado','No','Yes'),
	array('Arizona','Baja California','No','Yes'),
	array('Arizona','Chihuahua','No','Yes'),
	array('Utah','Nevada','No','Yes'),
	array('Utah','Colorado','No','Yes'),
	array('Utah','Wyoming','No','Yes'),
	array('New Mexico','Colorado','No','Yes'),
	array('New Mexico','Oklahoma','No','Yes'),
	array('New Mexico','Chihuahua','No','Yes'),
	array('Colorado','Wyoming','No','Yes'),
	array('Colorado','Oklahoma','No','Yes'),
	array('Colorado','Kansas','No','Yes'),
	array('Colorado','Nebraska','No','Yes'),
	array('Wyoming','Montana','No','Yes'),
	array('Wyoming','Nebraska','No','Yes'),
	array('Wyoming','Dakotas','No','Yes'),
	array('Montana','Dakotas','No','Yes'),
	array('Oklahoma','Kansas','No','Yes'),
	array('Oklahoma','Missouri','No','Yes'),
	array('Oklahoma','Arkansas','No','Yes'),
	array('Kansas','Nebraska','No','Yes'),
	array('Kansas','Missouri','No','Yes'),
	array('Nebraska','Dakotas','No','Yes'),
	array('Nebraska','Missouri','No','Yes'),
	array('Missouri','Arkansas','Yes','Yes'),
	array('Missouri','Kentucky','Yes','Yes'),
	array('Missouri','Tennessee','Yes','Yes'),
	array('Arkansas','Louisiana','Yes','Yes'),
	array('Arkansas','Tennessee','Yes','Yes'),
	array('Arkansas','Deep South','Yes','Yes'),
	array('Louisiana','Deep South','Yes','Yes'),
	array('Louisiana','Apalachee Bay','Yes','No'),
	array('Louisiana','Gulf of Mexico','Yes','No'),
	array('Upper Peninsula','Michigan','Yes','Yes'),
	array('Upper Peninsula','Lake Michigan','Yes','No'),
	array('Upper Peninsula','Lake Superior','Yes','No'),
	array('Upper Peninsula','Lake Huron','Yes','No'),
	array('Michigan','Lake Michigan','Yes','No'),
	array('Michigan','Lake Huron','Yes','No'),
	array('Michigan','Lake Erie','Yes','No'),
	array('Michigan','Ohio','Yes','Yes'),
	array('Lake Michigan','Lake Huron','Yes','No'),
	array('Lake Superior','Lake Huron','Yes','No'),
	array('Lake Erie','Ohio','Yes','No'),
	array('Ohio','West Virginia','No','Yes'),
	array('Ohio','Kentucky','No','Yes'),
	array('Maine','Vermont','Yes','Yes'),
	array('Maine','Massachusetts Bay','Yes','No'),
	array('Maine','New Brunswick','No','Yes'),
	array('Maine','New Brunswick (South Coast)','Yes','No'),
	array('Vermont','Massachusetts','Yes','Yes'),
	array('Vermont','Massachusetts Bay','Yes','No'),
	array('Massachusetts','Massachusetts Bay','Yes','No'),
	array('Massachusetts','Cape May','Yes','No'),
	array('Washington DC','Virginia','Yes','Yes'),
	array('Washington DC','West Virginia','No','Yes'),
	array('Washington DC','Chesapeake Bay','Yes','No'),
	array('Washington DC','Cape May','Yes','No'),
	array('Virginia','West Virginia','No','Yes'),
	array('Virginia','Kentucky','No','Yes'),
	array('Virginia','Tennessee','No','Yes'),
	array('Virginia','North Carolina','Yes','Yes'),
	array('Virginia','Chesapeake Bay','Yes','No'),
	array('West Virginia','Kentucky','No','Yes'),
	array('Kentucky','Tennessee','Yes','Yes'),
	array('Tennessee','Deep South','Yes','Yes'),
	array('Tennessee','Georgia','No','Yes'),
	array('Tennessee','North Carolina','No','Yes'),
	array('Deep South','Georgia','No','Yes'),
	array('Deep South','Apalachee Bay','Yes','No'),
	array('Georgia','South Carolina','Yes','Yes'),
	array('Georgia','North Carolina','No','Yes'),
	array('Georgia','East Coast','Yes','No'),
	array('South Carolina','North Carolina','Yes','Yes'),
	array('South Carolina','East Coast','Yes','No'),
	array('North Carolina','Chesapeake Bay','Yes','No'),
	array('North Carolina','East Coast','Yes','No'),
	array('Haiti','Dominican Republic','Yes','Yes'),
	array('Haiti','Bermuda Triangle','Yes','No'),
	array('Haiti','East Caribbean Sea','Yes','No'),
	array('Haiti','Cayman Trench','Yes','No'),
	array('Dominican Republic','Sea of Sargasso','Yes','No'),
	array('Dominican Republic','Bermuda Triangle','Yes','No'),
	array('Dominican Republic','East Caribbean Sea','Yes','No'),
	array('Dominican Republic','Lesser Antilles','Yes','No'),
	array('Baja California','Chihuahua','Yes','Yes'),
	array('Baja California','North Pacific Ocean','Yes','No'),
	array('Baja California','Mid Pacific Ocean','Yes','No'),
	array('Baja California','Gulf of Santa Catalina','Yes','No'),
	array('Baja California','Gulf of California','Yes','No'),
	array('Chihuahua','Coahuila','No','Yes'),
	array('Chihuahua','Durango','Yes','Yes'),
	array('Chihuahua','Gulf of California','Yes','No'),
	array('Coahuila','Nuevo Leon','No','Yes'),
	array('Coahuila','Durango','No','Yes'),
	array('Nuevo Leon','Gulf of Mexico','Yes','No'),
	array('Nuevo Leon','Gulf of Campeche','Yes','No'),
	array('Durango','Gulf of California','Yes','No'),
	array('Chiapas','Tabasco','No','Yes'),
	array('Chiapas','Gulf of Tehuantepec','Yes','No'),
	array('Chiapas','Guatemala','No','Yes'),
	array('Chiapas','Guatemala (South Coast)','Yes','No'),
	array('Tabasco','Yucatan','Yes','Yes'),
	array('Tabasco','Gulf of Campeche','Yes','No'),
	array('Tabasco','Guatemala','No','Yes'),
	array('Yucatan','Gulf of Mexico','Yes','No'),
	array('Yucatan','Gulf of Campeche','Yes','No'),
	array('Yucatan','Straits of Yucatan','Yes','No'),
	array('Yucatan','Gulf of Honduras','Yes','No'),
	array('Yucatan','Guatemala','No','Yes'),
	array('Yucatan','Guatemala (East Coast)','Yes','No'),
	array('El Salvador','Coast of Mexico','Yes','No'),
	array('El Salvador','Gulf of Fonseca','Yes','No'),
	array('El Salvador','Honduras','No','Yes'),
	array('El Salvador','Honduras (South Coast)','Yes','No'),
	array('El Salvador','Guatemala','No','Yes'),
	array('El Salvador','Guatemala (South Coast)','Yes','No'),
	array('Panama','South Caribbean Sea','Yes','No'),
	array('Panama','Gulf of Mosquitos','Yes','No'),
	array('Panama','Gulf of Panama','Yes','No'),
	array('Panama','Coronado Bay','Yes','No'),
	array('Panama','Costa Rica','No','Yes'),
	array('Panama','Costa Rica (North Coast)','Yes','No'),
	array('Panama','Costa Rica (South Coast)','Yes','No'),
	array('Venezuela','East Caribbean Sea','Yes','No'),
	array('Venezuela','Lesser Antilles','Yes','No'),
	array('Venezuela','South Caribbean Sea','Yes','No'),
	array('Hawaii','North Pacific Ocean','Yes','No'),
	array('Hawaii','Mid Pacific Ocean','Yes','No'),
	array('Hawaii','South West Pacific Ocean','Yes','No'),
	array('Hawaii','South Pacific Ocean','Yes','No'),
	array('Greenland','Arctic Ocean','Yes','No'),
	array('Greenland','Baffin Bay','Yes','No'),
	array('Greenland','Sea of Labrador','Yes','No'),
	array('Greenland','North Atlantic Ocean','Yes','No'),
	array('Bering Sea','Arctic Ocean','Yes','No'),
	array('Bering Sea','Gulf of Alaska','Yes','No'),
	array('Arctic Ocean','Beaufort Sea','Yes','No'),
	array('Arctic Ocean','Baffin Bay','Yes','No'),
	array('Hudson Bay','Sea of Labrador','Yes','No'),
	array('Baffin Bay','Sea of Labrador','Yes','No'),
	array('Sea of Labrador','North Atlantic Ocean','Yes','No'),
	array('Sea of Labrador','Gulf of St-Lawrence','Yes','No'),
	array('North Atlantic Ocean','Gulf of St-Lawrence','Yes','No'),
	array('North Atlantic Ocean','Massachusetts Bay','Yes','No'),
	array('North Atlantic Ocean','Mid Atlantic Ocean','Yes','No'),
	array('Gulf of St-Lawrence','New Brunswick (North Coast)','Yes','No'),
	array('Massachusetts Bay','Mid Atlantic Ocean','Yes','No'),
	array('Massachusetts Bay','Cape May','Yes','No'),
	array('Massachusetts Bay','New Brunswick (South Coast)','Yes','No'),
	array('Mid Atlantic Ocean','Cape May','Yes','No'),
	array('Mid Atlantic Ocean','Sea of Sargasso','Yes','No'),
	array('Mid Atlantic Ocean','Bermuda Triangle','Yes','No'),
	array('Chesapeake Bay','Cape May','Yes','No'),
	array('Chesapeake Bay','East Coast','Yes','No'),
	array('Cape May','Bermuda Triangle','Yes','No'),
	array('Cape May','East Coast','Yes','No'),
	array('Sea of Sargasso','Bermuda Triangle','Yes','No'),
	array('Sea of Sargasso','Lesser Antilles','Yes','No'),
	array('Bermuda Triangle','East Coast','Yes','No'),
	array('Bermuda Triangle','Straits of Florida','Yes','No'),
	array('Bermuda Triangle','Cayman Trench','Yes','No'),
	array('East Coast','Straits of Florida','Yes','No'),
	array('Straits of Florida','Apalachee Bay','Yes','No'),
	array('Straits of Florida','Gulf of Mexico','Yes','No'),
	array('Straits of Florida','Straits of Yucatan','Yes','No'),
	array('East Caribbean Sea','Lesser Antilles','Yes','No'),
	array('East Caribbean Sea','Cayman Trench','Yes','No'),
	array('East Caribbean Sea','West Caribbean Sea','Yes','No'),
	array('East Caribbean Sea','South Caribbean Sea','Yes','No'),
	array('Apalachee Bay','Gulf of Mexico','Yes','No'),
	array('Gulf of Mexico','Gulf of Campeche','Yes','No'),
	array('Gulf of Mexico','Straits of Yucatan','Yes','No'),
	array('Straits of Yucatan','Gulf of Honduras','Yes','No'),
	array('Straits of Yucatan','West Caribbean Sea','Yes','No'),
	array('Gulf of Honduras','West Caribbean Sea','Yes','No'),
	array('Gulf of Honduras','Honduras (North Coast)','Yes','No'),
	array('Gulf of Honduras','Guatemala (East Coast)','Yes','No'),
	array('Cayman Trench','West Caribbean Sea','Yes','No'),
	array('West Caribbean Sea','South Caribbean Sea','Yes','No'),
	array('West Caribbean Sea','Gulf of Mosquitos','Yes','No'),
	array('West Caribbean Sea','Honduras (North Coast)','Yes','No'),
	array('West Caribbean Sea','Nicaragua (East Coast)','Yes','No'),
	array('South Caribbean Sea','Gulf of Mosquitos','Yes','No'),
	array('Gulf of Mosquitos','Nicaragua (East Coast)','Yes','No'),
	array('Gulf of Mosquitos','Costa Rica (North Coast)','Yes','No'),
	array('North Pacific Ocean','Gulf of Alaska','Yes','No'),
	array('North Pacific Ocean','West Coast','Yes','No'),
	array('North Pacific Ocean','Mid Pacific Ocean','Yes','No'),
	array('North Pacific Ocean','Gulf of Santa Catalina','Yes','No'),
	array('North Pacific Ocean','South West Pacific Ocean','Yes','No'),
	array('Gulf of Alaska','Queen Charlotte Sound','Yes','No'),
	array('Gulf of Alaska','Straits of Juan de Fuca','Yes','No'),
	array('Gulf of Alaska','West Coast','Yes','No'),
	array('Queen Charlotte Sound','Straits of Juan de Fuca','Yes','No'),
	array('Straits of Juan de Fuca','West Coast','Yes','No'),
	array('West Coast','Gulf of Santa Catalina','Yes','No'),
	array('Mid Pacific Ocean','Coast of Mexico','Yes','No'),
	array('Mid Pacific Ocean','Gulf of California','Yes','No'),
	array('Mid Pacific Ocean','South Pacific Ocean','Yes','No'),
	array('South West Pacific Ocean','South Pacific Ocean','Yes','No'),
	array('Coast of Mexico','Gulf of California','Yes','No'),
	array('Coast of Mexico','Gulf of Tehuantepec','Yes','No'),
	array('Coast of Mexico','South Pacific Ocean','Yes','No'),
	array('Coast of Mexico','Galapagos','Yes','No'),
	array('Coast of Mexico','Gulf of Fonseca','Yes','No'),
	array('Coast of Mexico','Guatemala (South Coast)','Yes','No'),
	array('Gulf of Tehuantepec','Guatemala (South Coast)','Yes','No'),
	array('South Pacific Ocean','Galapagos','Yes','No'),
	array('Galapagos','Gulf of Guayaquil','Yes','No'),
	array('Galapagos','Gulf of Fonseca','Yes','No'),
	array('Gulf of Guayaquil','Gulf of Panama','Yes','No'),
	array('Gulf of Guayaquil','Coronado Bay','Yes','No'),
	array('Gulf of Guayaquil','Gulf of Fonseca','Yes','No'),
	array('Gulf of Panama','Coronado Bay','Yes','No'),
	array('Coronado Bay','Gulf of Fonseca','Yes','No'),
	array('Coronado Bay','Nicaragua (West Coast)','Yes','No'),
	array('Coronado Bay','Costa Rica (South Coast)','Yes','No'),
	array('Gulf of Fonseca','Honduras (South Coast)','Yes','No'),
	array('Gulf of Fonseca','Nicaragua (West Coast)','Yes','No'),
	array('Honduras','Nicaragua','No','Yes'),
	array('Honduras','Guatemala','No','Yes'),
	array('Honduras (North Coast)','Nicaragua (East Coast)','Yes','No'),
	array('Honduras (North Coast)','Guatemala (East Coast)','Yes','No'),
	array('Honduras (South Coast)','Nicaragua (West Coast)','Yes','No'),
	array('Nicaragua','Costa Rica','No','Yes'),
	array('Nicaragua (East Coast)','Costa Rica (North Coast)','Yes','No'),
	array('Nicaragua (West Coast)','Costa Rica (South Coast)','Yes','No')
);

foreach($bordersRawData as $borderRawRow)
{
	list($from, $to, $fleets, $armies)=$borderRawRow;
	InstallTerritory::$Territories[$to]  ->addBorder(InstallTerritory::$Territories[$from],$fleets,$armies);
}
unset($bordersRawData);

InstallTerritory::runSQL($this->mapID);
InstallCache::terrJSON($this->territoriesJSONFile(),$this->mapID);
?>
