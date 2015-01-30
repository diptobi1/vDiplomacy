<?php
// This is file installs the map data for the Karibik variant
defined('IN_CODE') or die('This script can not be run by itself.');
require_once("variants/install.php");

InstallTerritory::$Territories=array();
$countries=$this->countries;
$territoryRawData=array(
	array('Belo Horizonte', 'Land', 'Yes', 1, 1234, 722, 617, 361),
	array('Bogota', 'Land', 'Yes', 2, 860, 567, 427, 286),
	array('Havanna', 'Coast', 'Yes', 3, 663, 239, 343, 119),
	array('Mexico City', 'Coast', 'Yes', 4, 356, 314, 178, 157),
	array('Randonia', 'Land', 'Yes', 5, 1041, 818, 523, 409),
	array('Cuzco', 'Land', 'Yes', 6, 838, 844, 424, 422),
	array('Phoenix', 'Land', 'Yes', 7, 170, 80, 118, 37),
	array('Ciudad Bolivar', 'Land', 'Yes', 8, 1075, 560, 530, 275),
	array('Nevada', 'Land', 'No', 7, 162, 24, 81, 12),
	array('California', 'Coast', 'Yes', 0, 54, 65, 27, 14),
	array('Houston', 'Coast', 'Yes', 7, 372, 154, 186, 77),
	array('Miami', 'Coast', 'Yes', 7, 654, 160, 322, 85),
	array('Low California', 'Coast', 'No', 4, 90, 172, 45, 86),
	array('Mazatlan', 'Coast', 'Yes', 4, 180, 184, 90, 92),
	array('Sierra Madre', 'Coast', 'No', 4, 341, 221, 168, 113),
	array('Sierra Madre del Sur', 'Coast', 'No', 4, 344, 352, 172, 176),
	array('Merida', 'Coast', 'Yes', 4, 504, 287, 237, 151),
	array('Guatemala', 'Coast', 'No', 0, 456, 370, 228, 185),
	array('Panama', 'Coast', 'Yes', 0, 581, 491, 288, 244),
	array('Nassau', 'Coast', 'Yes', 0, 773, 187, 384, 86),
	array('Cientuegos', 'Coast', 'No', 3, 730, 288, 365, 144),
	array('Camaguey', 'Coast', 'No', 3, 756, 270, 378, 135),
	array('Santiago', 'Coast', 'Yes', 3, 832, 323, 423, 162),
	array('Haiti', 'Coast', 'No', 3, 926, 311, 463, 158),
	array('Puerto Rico', 'Coast', 'Yes', 0, 1066, 317, 537, 154),
	array('Santo Domingo', 'Coast', 'Yes', 3, 967, 321, 491, 149),
	array('Jamaica', 'Coast', 'Yes', 0, 712, 356, 356, 177),
	array('Cartagena', 'Coast', 'Yes', 2, 734, 517, 367, 258),
	array('Maracaibo', 'Coast', 'No', 8, 870, 488, 435, 244),
	array('Caracas', 'Coast', 'Yes', 8, 959, 479, 462, 242),
	array('Cumana', 'Coast', 'Yes', 8, 1053, 486, 534, 248),
	array('Cecar', 'Coast', 'No', 2, 800, 524, 400, 262),
	array('Guyana', 'Coast', 'Yes', 0, 1121, 525, 563, 265),
	array('Surinam', 'Coast', 'Yes', 0, 1196, 560, 598, 280),
	array('French Guyana', 'Coast', 'Yes', 0, 1280, 565, 645, 285),
	array('Belem', 'Coast', 'Yes', 1, 1346, 660, 673, 330),
	array('Medellin', 'Coast', 'Yes', 2, 718, 567, 362, 283),
	array('Caqueta', 'Coast', 'No', 2, 712, 620, 356, 310),
	array('Ecuador', 'Coast', 'Yes', 0, 650, 676, 325, 338),
	array('Sullana', 'Coast', 'No', 6, 654, 746, 327, 373),
	array('Lima', 'Coast', 'Yes', 6, 718, 820, 359, 410),
	array('Arequipa', 'Coast', 'No', 6, 882, 924, 441, 462),
	array('Arica', 'Coast', 'Yes', 0, 924, 1008, 462, 504),
	array('Vaupes', 'Land', 'No', 2, 854, 642, 427, 321),
	array('Amazon', 'Land', 'No', 1, 942, 714, 471, 357),
	array('Guarcio', 'Land', 'No', 8, 972, 556, 486, 278),
	array('Northern Amazonas', 'Land', 'No', 8, 980, 615, 495, 293),
	array('Roraima', 'Land', 'No', 1, 1080, 612, 540, 306),
	array('Manaus', 'Land', 'Yes', 1, 1150, 706, 575, 353),
	array('Iquitos', 'Land', 'Yes', 6, 772, 698, 386, 349),
	array('San Martin', 'Land', 'No', 6, 777, 770, 396, 405),
	array('Southern Amazonas', 'Land', 'No', 1, 1130, 765, 565, 397),
	array('Mojos', 'Land', 'No', 0, 972, 846, 486, 423),
	array('Cuiaba', 'Land', 'Yes', 5, 1184, 853, 592, 429),
	array('La Paz', 'Land', 'Yes', 0, 972, 924, 486, 462),
	array('Santa Cruz', 'Land', 'Yes', 0, 1070, 962, 516, 486),
	array('Argentina', 'Land', 'No', 0, 1036, 1044, 518, 522),
	array('Asuncion', 'Land', 'Yes', 5, 1140, 1002, 570, 501),
	array('Mato Grosso', 'Land', 'No', 5, 1320, 950, 660, 475),
	array('North Pacific Ocean', 'Sea', 'No', 0, 36, 178, 18, 89),
	array('Revilla Islands', 'Sea', 'No', 0, 54, 378, 27, 189),
	array('Gulf of California', 'Sea', 'No', 0, 158, 240, 79, 120),
	array('Mexikograben', 'Sea', 'No', 0, 222, 388, 111, 194),
	array('Bay of Mexico', 'Sea', 'No', 0, 412, 232, 206, 116),
	array('Gulf of Mexico', 'Sea', 'No', 0, 544, 186, 272, 93),
	array('West Atlantic Ocean', 'Sea', 'No', 0, 822, 68, 411, 34),
	array('Straits of Florida', 'Sea', 'No', 0, 708, 181, 354, 83),
	array('Sargassosea', 'Sea', 'No', 0, 1014, 98, 507, 49),
	array('Atlantic Ocean', 'Sea', 'No', 0, 1234, 170, 617, 85),
	array('Bank of Bahama', 'Sea', 'No', 0, 844, 260, 422, 135),
	array('Bahamas', 'Sea', 'No', 0, 1042, 256, 521, 128),
	array('little Antilles', 'Sea', 'No', 0, 1197, 440, 596, 210),
	array('Caymangraben', 'Sea', 'No', 0, 671, 337, 333, 171),
	array('Windwardpassage', 'Sea', 'No', 0, 846, 358, 423, 179),
	array('Carribean Sea', 'Sea', 'No', 0, 1006, 372, 503, 186),
	array('Bay of Yucatan', 'Sea', 'No', 0, 600, 355, 281, 160),
	array('Southern Carribean', 'Sea', 'No', 0, 710, 445, 381, 205),
	array('Eastern Carribean', 'Sea', 'No', 0, 892, 432, 446, 216),
	array('Amazonasschelf', 'Sea', 'No', 0, 1312, 422, 656, 211),
	array('Galapagos Islands', 'Sea', 'No', 0, 451, 623, 223, 324),
	array('Gulf of Panama', 'Sea', 'No', 0, 650, 561, 325, 283),
	array('Perugraben', 'Sea', 'No', 0, 672, 878, 336, 444),
	array('Bay of Chile', 'Sea', 'No', 0, 796, 1052, 398, 526),
	array('Pacific Ocean', 'Sea', 'No', 0, 216, 814, 94, 400),
	array('Eastern USA', 'Coast', 'No', 7, 636, 72, 318, 36),
	array('Eastern USA (East Coast)', 'Coast', 'No', 0, 752, 54, 376, 27),
	array('Eastern USA (South Coast)', 'Coast', 'No', 0, 498, 132, 249, 66),
	array('Honduras', 'Coast', 'Yes', 0, 498, 406, 249, 203),
	array('Honduras (South Coast)', 'Coast', 'No', 0, 482, 411, 241, 208),
	array('Honduras (North Coast)', 'Coast', 'No', 0, 545, 360, 252, 176),
	array('Nicaragua', 'Coast', 'Yes', 0, 556, 413, 278, 209),
	array('Nicaragua (East Coast)', 'Coast', 'No', 0, 578, 400, 289, 205),
	array('Nicaragua (West Coast)', 'Coast', 'No', 0, 514, 440, 269, 232)
);

foreach($territoryRawData as $territoryRawRow)
{
	list($name, $type, $supply, $countryID, $x, $y, $sx, $sy)=$territoryRawRow;
	new InstallTerritory($name, $type, $supply, $countryID, $x, $y, $sx, $sy);
}
unset($territoryRawData);

$bordersRawData=array(
	array('Belo Horizonte','Belem','No','Yes'),
	array('Belo Horizonte','Roraima','No','Yes'),
	array('Belo Horizonte','Manaus','No','Yes'),
	array('Belo Horizonte','Southern Amazonas','No','Yes'),
	array('Belo Horizonte','Mato Grosso','No','Yes'),
	array('Bogota','Maracaibo','No','Yes'),
	array('Bogota','Cecar','No','Yes'),
	array('Bogota','Medellin','No','Yes'),
	array('Bogota','Caqueta','No','Yes'),
	array('Bogota','Vaupes','No','Yes'),
	array('Havanna','Cientuegos','Yes','Yes'),
	array('Havanna','Camaguey','Yes','Yes'),
	array('Havanna','Gulf of Mexico','Yes','No'),
	array('Havanna','Straits of Florida','Yes','No'),
	array('Havanna','Bank of Bahama','Yes','No'),
	array('Havanna','Caymangraben','Yes','No'),
	array('Mexico City','Sierra Madre','Yes','Yes'),
	array('Mexico City','Sierra Madre del Sur','No','Yes'),
	array('Mexico City','Merida','Yes','Yes'),
	array('Mexico City','Bay of Mexico','Yes','No'),
	array('Randonia','Amazon','No','Yes'),
	array('Randonia','Southern Amazonas','No','Yes'),
	array('Randonia','Mojos','No','Yes'),
	array('Randonia','Cuiaba','No','Yes'),
	array('Cuzco','Arequipa','No','Yes'),
	array('Cuzco','Amazon','No','Yes'),
	array('Cuzco','San Martin','No','Yes'),
	array('Cuzco','Mojos','No','Yes'),
	array('Cuzco','La Paz','No','Yes'),
	array('Phoenix','Nevada','No','Yes'),
	array('Phoenix','California','No','Yes'),
	array('Phoenix','Houston','No','Yes'),
	array('Phoenix','Low California','No','Yes'),
	array('Phoenix','Mazatlan','No','Yes'),
	array('Phoenix','Sierra Madre','No','Yes'),
	array('Ciudad Bolivar','Cumana','No','Yes'),
	array('Ciudad Bolivar','Guyana','No','Yes'),
	array('Ciudad Bolivar','Guarcio','No','Yes'),
	array('Ciudad Bolivar','Northern Amazonas','No','Yes'),
	array('Ciudad Bolivar','Roraima','No','Yes'),
	array('Nevada','California','No','Yes'),
	array('Nevada','Houston','No','Yes'),
	array('Nevada','Eastern USA','No','Yes'),
	array('California','Low California','Yes','Yes'),
	array('California','North Pacific Ocean','Yes','No'),
	array('Houston','Sierra Madre','Yes','Yes'),
	array('Houston','Bay of Mexico','Yes','No'),
	array('Houston','Gulf of Mexico','Yes','No'),
	array('Houston','Eastern USA','No','Yes'),
	array('Houston','Eastern USA (South Coast)','Yes','No'),
	array('Miami','Gulf of Mexico','Yes','No'),
	array('Miami','West Atlantic Ocean','Yes','No'),
	array('Miami','Straits of Florida','Yes','No'),
	array('Miami','Eastern USA','No','Yes'),
	array('Miami','Eastern USA (East Coast)','Yes','No'),
	array('Miami','Eastern USA (South Coast)','Yes','No'),
	array('Low California','Mazatlan','Yes','Yes'),
	array('Low California','North Pacific Ocean','Yes','No'),
	array('Low California','Revilla Islands','Yes','No'),
	array('Low California','Gulf of California','Yes','No'),
	array('Mazatlan','Sierra Madre','No','Yes'),
	array('Mazatlan','Sierra Madre del Sur','Yes','Yes'),
	array('Mazatlan','Gulf of California','Yes','No'),
	array('Sierra Madre','Sierra Madre del Sur','No','Yes'),
	array('Sierra Madre','Bay of Mexico','Yes','No'),
	array('Sierra Madre del Sur','Merida','No','Yes'),
	array('Sierra Madre del Sur','Guatemala','Yes','Yes'),
	array('Sierra Madre del Sur','Gulf of California','Yes','No'),
	array('Sierra Madre del Sur','Mexikograben','Yes','No'),
	array('Merida','Guatemala','No','Yes'),
	array('Merida','Bay of Mexico','Yes','No'),
	array('Merida','Gulf of Mexico','Yes','No'),
	array('Merida','Bay of Yucatan','Yes','No'),
	array('Merida','Honduras','No','Yes'),
	array('Merida','Honduras (North Coast)','Yes','No'),
	array('Guatemala','Mexikograben','Yes','No'),
	array('Guatemala','Honduras','No','Yes'),
	array('Guatemala','Honduras (South Coast)','Yes','No'),
	array('Panama','Cartagena','Yes','Yes'),
	array('Panama','Medellin','Yes','Yes'),
	array('Panama','Bay of Yucatan','Yes','No'),
	array('Panama','Southern Carribean','Yes','No'),
	array('Panama','Galapagos Islands','Yes','No'),
	array('Panama','Gulf of Panama','Yes','No'),
	array('Panama','Nicaragua','No','Yes'),
	array('Panama','Nicaragua (East Coast)','Yes','No'),
	array('Panama','Nicaragua (West Coast)','Yes','No'),
	array('Nassau','West Atlantic Ocean','Yes','No'),
	array('Nassau','Straits of Florida','Yes','No'),
	array('Nassau','Sargassosea','Yes','No'),
	array('Nassau','Bank of Bahama','Yes','No'),
	array('Nassau','Bahamas','Yes','No'),
	array('Cientuegos','Camaguey','No','Yes'),
	array('Cientuegos','Santiago','Yes','Yes'),
	array('Cientuegos','Caymangraben','Yes','No'),
	array('Camaguey','Santiago','Yes','Yes'),
	array('Camaguey','Bank of Bahama','Yes','No'),
	array('Santiago','Bank of Bahama','Yes','No'),
	array('Santiago','Caymangraben','Yes','No'),
	array('Santiago','Windwardpassage','Yes','No'),
	array('Haiti','Santo Domingo','Yes','Yes'),
	array('Haiti','Bank of Bahama','Yes','No'),
	array('Haiti','Bahamas','Yes','No'),
	array('Haiti','Windwardpassage','Yes','No'),
	array('Haiti','Carribean Sea','Yes','No'),
	array('Puerto Rico','Bahamas','Yes','No'),
	array('Puerto Rico','little Antilles','Yes','No'),
	array('Puerto Rico','Carribean Sea','Yes','No'),
	array('Santo Domingo','Bahamas','Yes','No'),
	array('Santo Domingo','Carribean Sea','Yes','No'),
	array('Jamaica','Caymangraben','Yes','No'),
	array('Jamaica','Windwardpassage','Yes','No'),
	array('Jamaica','Southern Carribean','Yes','No'),
	array('Cartagena','Cecar','Yes','Yes'),
	array('Cartagena','Medellin','No','Yes'),
	array('Cartagena','Southern Carribean','Yes','No'),
	array('Maracaibo','Caracas','Yes','Yes'),
	array('Maracaibo','Cecar','Yes','Yes'),
	array('Maracaibo','Vaupes','No','Yes'),
	array('Maracaibo','Guarcio','No','Yes'),
	array('Maracaibo','Eastern Carribean','Yes','No'),
	array('Caracas','Cumana','Yes','Yes'),
	array('Caracas','Guarcio','No','Yes'),
	array('Caracas','Eastern Carribean','Yes','No'),
	array('Cumana','Guyana','Yes','Yes'),
	array('Cumana','Guarcio','No','Yes'),
	array('Cumana','little Antilles','Yes','No'),
	array('Cumana','Eastern Carribean','Yes','No'),
	array('Cecar','Medellin','No','Yes'),
	array('Cecar','Southern Carribean','Yes','No'),
	array('Cecar','Eastern Carribean','Yes','No'),
	array('Guyana','Surinam','Yes','Yes'),
	array('Guyana','Roraima','No','Yes'),
	array('Guyana','little Antilles','Yes','No'),
	array('Surinam','French Guyana','Yes','Yes'),
	array('Surinam','Belem','No','Yes'),
	array('Surinam','Roraima','No','Yes'),
	array('Surinam','little Antilles','Yes','No'),
	array('Surinam','Amazonasschelf','Yes','No'),
	array('French Guyana','Belem','Yes','Yes'),
	array('French Guyana','Amazonasschelf','Yes','No'),
	array('Belem','Roraima','No','Yes'),
	array('Belem','Amazonasschelf','Yes','No'),
	array('Medellin','Caqueta','Yes','Yes'),
	array('Medellin','Gulf of Panama','Yes','No'),
	array('Caqueta','Ecuador','Yes','Yes'),
	array('Caqueta','Vaupes','No','Yes'),
	array('Caqueta','Iquitos','No','Yes'),
	array('Caqueta','Gulf of Panama','Yes','No'),
	array('Ecuador','Sullana','Yes','Yes'),
	array('Ecuador','Iquitos','No','Yes'),
	array('Ecuador','Gulf of Panama','Yes','No'),
	array('Sullana','Lima','Yes','Yes'),
	array('Sullana','Iquitos','No','Yes'),
	array('Sullana','San Martin','No','Yes'),
	array('Sullana','Gulf of Panama','Yes','No'),
	array('Sullana','Perugraben','Yes','No'),
	array('Lima','Arequipa','Yes','Yes'),
	array('Lima','San Martin','No','Yes'),
	array('Lima','Perugraben','Yes','No'),
	array('Arequipa','Arica','Yes','Yes'),
	array('Arequipa','San Martin','No','Yes'),
	array('Arequipa','La Paz','No','Yes'),
	array('Arequipa','Perugraben','Yes','No'),
	array('Arica','La Paz','No','Yes'),
	array('Arica','Santa Cruz','No','Yes'),
	array('Arica','Argentina','No','Yes'),
	array('Arica','Perugraben','Yes','No'),
	array('Arica','Bay of Chile','Yes','No'),
	array('Vaupes','Amazon','No','Yes'),
	array('Vaupes','Guarcio','No','Yes'),
	array('Vaupes','Northern Amazonas','No','Yes'),
	array('Vaupes','Iquitos','No','Yes'),
	array('Amazon','Northern Amazonas','No','Yes'),
	array('Amazon','Roraima','No','Yes'),
	array('Amazon','Manaus','No','Yes'),
	array('Amazon','Iquitos','No','Yes'),
	array('Amazon','San Martin','No','Yes'),
	array('Amazon','Southern Amazonas','No','Yes'),
	array('Amazon','Mojos','No','Yes'),
	array('Guarcio','Northern Amazonas','No','Yes'),
	array('Northern Amazonas','Roraima','No','Yes'),
	array('Roraima','Manaus','No','Yes'),
	array('Manaus','Southern Amazonas','No','Yes'),
	array('Iquitos','San Martin','No','Yes'),
	array('Southern Amazonas','Cuiaba','No','Yes'),
	array('Southern Amazonas','Mato Grosso','No','Yes'),
	array('Mojos','Cuiaba','No','Yes'),
	array('Mojos','La Paz','No','Yes'),
	array('Mojos','Santa Cruz','No','Yes'),
	array('Mojos','Mato Grosso','No','Yes'),
	array('Cuiaba','Mato Grosso','No','Yes'),
	array('La Paz','Santa Cruz','No','Yes'),
	array('Santa Cruz','Argentina','No','Yes'),
	array('Santa Cruz','Asuncion','No','Yes'),
	array('Santa Cruz','Mato Grosso','No','Yes'),
	array('Argentina','Asuncion','No','Yes'),
	array('Asuncion','Mato Grosso','No','Yes'),
	array('North Pacific Ocean','Revilla Islands','Yes','No'),
	array('Revilla Islands','Gulf of California','Yes','No'),
	array('Revilla Islands','Mexikograben','Yes','No'),
	array('Revilla Islands','Galapagos Islands','Yes','No'),
	array('Revilla Islands','Pacific Ocean','Yes','No'),
	array('Gulf of California','Mexikograben','Yes','No'),
	array('Mexikograben','Galapagos Islands','Yes','No'),
	array('Mexikograben','Honduras (South Coast)','Yes','No'),
	array('Mexikograben','Nicaragua (West Coast)','Yes','No'),
	array('Bay of Mexico','Gulf of Mexico','Yes','No'),
	array('Gulf of Mexico','Straits of Florida','Yes','No'),
	array('Gulf of Mexico','Caymangraben','Yes','No'),
	array('Gulf of Mexico','Bay of Yucatan','Yes','No'),
	array('Gulf of Mexico','Eastern USA (South Coast)','Yes','No'),
	array('West Atlantic Ocean','Straits of Florida','Yes','No'),
	array('West Atlantic Ocean','Sargassosea','Yes','No'),
	array('West Atlantic Ocean','Eastern USA (East Coast)','Yes','No'),
	array('Straits of Florida','Bank of Bahama','Yes','No'),
	array('Sargassosea','Atlantic Ocean','Yes','No'),
	array('Sargassosea','Bahamas','Yes','No'),
	array('Sargassosea','little Antilles','Yes','No'),
	array('Atlantic Ocean','little Antilles','Yes','No'),
	array('Atlantic Ocean','Amazonasschelf','Yes','No'),
	array('Bank of Bahama','Bahamas','Yes','No'),
	array('Bank of Bahama','Windwardpassage','Yes','No'),
	array('Bahamas','little Antilles','Yes','No'),
	array('Bahamas','Carribean Sea','Yes','No'),
	array('little Antilles','Carribean Sea','Yes','No'),
	array('little Antilles','Eastern Carribean','Yes','No'),
	array('little Antilles','Amazonasschelf','Yes','No'),
	array('Caymangraben','Windwardpassage','Yes','No'),
	array('Caymangraben','Bay of Yucatan','Yes','No'),
	array('Caymangraben','Southern Carribean','Yes','No'),
	array('Windwardpassage','Carribean Sea','Yes','No'),
	array('Windwardpassage','Southern Carribean','Yes','No'),
	array('Carribean Sea','Southern Carribean','Yes','No'),
	array('Carribean Sea','Eastern Carribean','Yes','No'),
	array('Bay of Yucatan','Southern Carribean','Yes','No'),
	array('Bay of Yucatan','Honduras (North Coast)','Yes','No'),
	array('Bay of Yucatan','Nicaragua (East Coast)','Yes','No'),
	array('Southern Carribean','Eastern Carribean','Yes','No'),
	array('Galapagos Islands','Gulf of Panama','Yes','No'),
	array('Galapagos Islands','Perugraben','Yes','No'),
	array('Galapagos Islands','Bay of Chile','Yes','No'),
	array('Galapagos Islands','Pacific Ocean','Yes','No'),
	array('Galapagos Islands','Nicaragua (West Coast)','Yes','No'),
	array('Gulf of Panama','Perugraben','Yes','No'),
	array('Perugraben','Bay of Chile','Yes','No'),
	array('Bay of Chile','Pacific Ocean','Yes','No'),
	array('Honduras','Nicaragua','No','Yes'),
	array('Honduras (South Coast)','Nicaragua (West Coast)','Yes','No'),
	array('Honduras (North Coast)','Nicaragua (East Coast)','Yes','No')
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