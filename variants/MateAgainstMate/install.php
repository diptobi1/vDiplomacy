<?php
// This is file installs the map data for the MateAgainstMate variant
defined('IN_CODE') or die('This script can not be run by itself.');
require_once("variants/install.php");

InstallTerritory::$Territories=array();
$countries=$this->countries;
$territoryRawData=array(
	array('Jakarta', 'Coast', 'Yes', 1, 23, 19, 16, 10),
	array('Surabaya', 'Coast', 'Yes', 1, 82, 13, 31, 15),
	array('Bali', 'Coast', 'Yes', 1, 124, 51, 63, 28),
	array('Lesser Sunda Islands', 'Coast', 'No', 1, 253, 54, 125, 40),
	array('West Timor', 'Coast', 'No', 1, 355, 74, 180, 35),
	array('East Timor', 'Coast', 'Yes', 9, 419, 53, 195, 32),
	array('Irian Jaya', 'Coast', 'No', 1, 745, 41, 382, 17),
	array('Java Sea', 'Sea', 'No', 0, 447, 25, 215, 13),
	array('Arafura Sea', 'Sea', 'No', 0, 619, 89, 325, 42),
	array('Torres Strait', 'Sea', 'No', 0, 734, 76, 380, 57),
	array('Coral Sea', 'Sea', 'No', 0, 983, 166, 550, 140),
	array('Central West Pacific Ocean', 'Sea', 'No', 0, 1262, 140, 640, 90),
	array('Gulf of Carpentaria', 'Sea', 'No', 0, 697, 157, 370, 115),
	array('North Indian Ocean', 'Sea', 'No', 0, 119, 190, 20, 75),
	array('Timor Sea', 'Sea', 'No', 0, 290, 172, 180, 85),
	array('Central Indian Ocean', 'Sea', 'No', 0, 33, 387, 20, 195),
	array('Shark Bay', 'Sea', 'No', 0, 111, 481, 55, 235),
	array('Southern Indian Ocean', 'Sea', 'No', 0, 104, 833, 50, 420),
	array('Kerguelen Plateau', 'Sea', 'No', 0, 82, 1134, 90, 590),
	array('West Southern Ocean', 'Sea', 'No', 0, 487, 1008, 260, 470),
	array('Great Australian Bight', 'Sea', 'No', 0, 497, 637, 295, 330),
	array('Spencer Gulf', 'Sea', 'No', 0, 655, 728, 325, 355),
	array('Twelve Apostles', 'Sea', 'No', 0, 724, 797, 363, 393),
	array('East Southern Ocean', 'Sea', 'No', 0, 942, 1039, 490, 520),
	array('South Pacific Ocean', 'Sea', 'No', 0, 1280, 1075, 665, 515),
	array('South Tasman Sea', 'Sea', 'No', 0, 1045, 846, 565, 450),
	array('North Tasman Sea', 'Sea', 'No', 0, 1145, 715, 610, 385),
	array('Bay of Plenty', 'Sea', 'No', 0, 1352, 722, 700, 370),
	array('South West Pacific Ocean', 'Sea', 'No', 0, 1289, 519, 610, 265),
	array('Wide Bay', 'Sea', 'No', 0, 998, 384, 534, 205),
	array('New Caledonia', 'Coast', 'Yes', 9, 1224, 280, 624, 140),
	array('Jakarta (North Coast)', 'Coast', 'No', 1, 19, 18, 14, 8),
	array('Jakarta (South Coast)', 'Coast', 'No', 1, 86, 50, 19, 21),
	array('Papua', 'Coast', 'No', 8, 817, 44, 416, 20),
	array('New Guinea', 'Coast', 'No', 8, 970, 41, 496, 14),
	array('Port Moresby', 'Coast', 'Yes', 0, 943, 62, 532, 49),
	array('Cape York', 'Coast', 'No', 8, 784, 144, 401, 60),
	array('Cairns', 'Coast', 'Yes', 8, 846, 259, 440, 124),
	array('Townsville', 'Coast', 'Yes', 0, 860, 293, 443, 147),
	array('Whitsundays', 'Coast', 'No', 8, 907, 325, 468, 161),
	array('Great Barrier Reef', 'Sea', 'No', 0, 948, 317, 489, 158),
	array('Rockhampton', 'Coast', 'Yes', 0, 957, 383, 490, 183),
	array('Burnett', 'Coast', 'No', 8, 972, 451, 506, 207),
	array('Fraser Coast', 'Coast', 'No', 8, 1019, 443, 526, 217),
	array('Brisbane', 'Coast', 'Yes', 8, 997, 484, 510, 237),
	array('Gold Coast', 'Coast', 'Yes', 0, 1005, 512, 513, 253),
	array('Darling Downs', 'Land', 'No', 8, 934, 454, 484, 239),
	array('Maranoa', 'Land', 'No', 8, 834, 456, 423, 234),
	array('Matilda Track', 'Land', 'No', 8, 734, 382, 371, 184),
	array('Mount Isa', 'Coast', 'Yes', 8, 700, 268, 362, 132),
	array('Auckland', 'Coast', 'Yes', 5, 1301, 743, 670, 373),
	array('Hawke Bay', 'Coast', 'No', 5, 1342, 822, 703, 404),
	array('Hamilton', 'Coast', 'Yes', 0, 1319, 814, 674, 405),
	array('Wellington', 'Coast', 'Yes', 5, 1335, 855, 686, 428),
	array('Marlborough', 'Coast', 'No', 5, 1287, 884, 665, 437),
	array('West Coast', 'Coast', 'No', 5, 1231, 925, 641, 449),
	array('Christchurch', 'Coast', 'Yes', 5, 1246, 951, 643, 472),
	array('Dunedin', 'Coast', 'Yes', 0, 1199, 1016, 619, 507),
	array('Milford Sound', 'Coast', 'No', 5, 1171, 972, 599, 490),
	array('Antarctic Mining Territory', 'Coast', 'Yes', 4, 1076, 1183, 559, 591),
	array('Hobart', 'Coast', 'Yes', 4, 908, 897, 463, 450),
	array('Wild Rivers', 'Coast', 'No', 4, 859, 925, 440, 459),
	array('Launceston', 'Coast', 'Yes', 4, 839, 860, 433, 437),
	array('Antarctic Oilfields', 'Coast', 'Yes', 0, 768, 1211, 361, 602),
	array('Bass Strait', 'Sea', 'No', 0, 898, 828, 446, 413),
	array('The Kimberley', 'Coast', 'No', 2, 419, 176, 214, 92),
	array('Broome', 'Coast', 'Yes', 2, 338, 252, 173, 121),
	array('Port Headland', 'Coast', 'No', 2, 309, 310, 157, 151),
	array('North West Shelf', 'Sea', 'No', 0, 228, 298, 121, 145),
	array('Carnarvon', 'Coast', 'No', 2, 155, 380, 74, 189),
	array('Great Sandy Desert', 'Land', 'No', 2, 378, 374, 177, 195),
	array('Geraldton', 'Coast', 'Yes', 0, 177, 535, 77, 243),
	array('Perth', 'Coast', 'Yes', 2, 189, 602, 94, 298),
	array('Albany', 'Coast', 'Yes', 0, 205, 680, 90, 333),
	array('Esperance', 'Coast', 'No', 2, 327, 658, 175, 325),
	array('Kalgoorlie', 'Land', 'Yes', 2, 289, 573, 144, 266),
	array('West Nullarbor Plain', 'Coast', 'No', 2, 427, 503, 219, 303),
	array('East Nullarbor Plain', 'Coast', 'No', 3, 514, 505, 285, 299),
	array('Alice Springs', 'Land', 'Yes', 3, 584, 374, 310, 182),
	array('Tanami Desert', 'Coast', 'No', 3, 510, 211, 260, 102),
	array('Darwin', 'Coast', 'Yes', 3, 510, 162, 262, 80),
	array('Kakadu', 'Coast', 'Yes', 0, 596, 138, 325, 68),
	array('Tennant Creek', 'Land', 'No', 3, 580, 229, 310, 119),
	array('Coober Pedy', 'Land', 'Yes', 0, 565, 492, 306, 239),
	array('Eyre', 'Coast', 'No', 3, 665, 514, 325, 317),
	array('Murray Bridge', 'Coast', 'No', 3, 737, 679, 376, 306),
	array('Barossa', 'Coast', 'No', 3, 674, 662, 348, 329),
	array('Adelaide', 'Coast', 'Yes', 3, 711, 674, 364, 339),
	array('Mount Gambier', 'Coast', 'Yes', 0, 736, 724, 379, 359),
	array('Broken Hill', 'Coast', 'Yes', 7, 766, 604, 397, 309),
	array('Central NSW', 'Coast', 'No', 7, 844, 623, 428, 311),
	array('New England', 'Land', 'No', 7, 941, 541, 495, 283),
	array('Northern Rivers', 'Coast', 'No', 7, 1030, 523, 526, 264),
	array('Coffs Harbour', 'Coast', 'Yes', 7, 1018, 575, 521, 289),
	array('North Coast', 'Coast', 'No', 7, 997, 601, 516, 298),
	array('Newcastle', 'Coast', 'Yes', 0, 979, 618, 503, 307),
	array('Hunter Valley', 'Coast', 'No', 7, 950, 610, 488, 305),
	array('Sydney', 'Coast', 'Yes', 7, 936, 653, 484, 328),
	array('Wollongong', 'Coast', 'Yes', 0, 948, 677, 485, 339),
	array('Blue Mountains', 'Land', 'No', 7, 905, 626, 466, 328),
	array('Snowy Mountains', 'Coast', 'No', 7, 915, 686, 473, 350),
	array('South Coast', 'Coast', 'No', 7, 938, 740, 489, 354),
	array('Albury', 'Coast', 'Yes', 7, 849, 694, 451, 352),
	array('Gippsland', 'Coast', 'No', 6, 887, 785, 457, 388),
	array('High Country', 'Land', 'No', 6, 880, 744, 460, 365),
	array('Melbourne', 'Coast', 'Yes', 6, 856, 773, 437, 381),
	array('Shepparton', 'Coast', 'Yes', 0, 845, 734, 436, 366),
	array('Bendigo', 'Coast', 'Yes', 6, 815, 712, 418, 363),
	array('Ballarat', 'Land', 'Yes', 0, 797, 743, 408, 380),
	array('Mildura', 'Coast', 'Yes', 6, 765, 683, 390, 337),
	array('Grampians', 'Land', 'No', 6, 761, 738, 393, 367),
	array('Geelong', 'Coast', 'Yes', 6, 802, 777, 413, 390),
	array('Great Ocean Road', 'Coast', 'No', 6, 762, 772, 391, 383),
	array('Great Barrier Reef (fake SC)', 'Land', 'Yes', 0, 911, 261, 490, 140),
	array('Bass Strait (fake SC)', 'Land', 'Yes', 0, 868, 830, 436, 405),
	array('North West Shelf (fake SC)', 'Land', 'Yes', 0, 206, 285, 109, 143)
);

foreach($territoryRawData as $territoryRawRow)
{
	list($name, $type, $supply, $countryID, $x, $y, $sx, $sy)=$territoryRawRow;
	new InstallTerritory($name, $type, $supply, $countryID, $x, $y, $sx, $sy);
}
unset($territoryRawData);

$bordersRawData=array(
	array('Jakarta','Surabaya','No','Yes'),
	array('Jakarta','Bali','No','Yes'),
	array('Surabaya','Bali','Yes','Yes'),
	array('Surabaya','Java Sea','Yes','No'),
	array('Surabaya','Jakarta (North Coast)','Yes','No'),
	array('Surabaya','Jakarta (South Coast)','Yes','No'),
	array('Bali','Lesser Sunda Islands','Yes','Yes'),
	array('Bali','Java Sea','Yes','No'),
	array('Bali','North Indian Ocean','Yes','No'),
	array('Bali','Timor Sea','Yes','No'),
	array('Bali','Jakarta (South Coast)','Yes','No'),
	array('Lesser Sunda Islands','East Timor','Yes','Yes'),
	array('Lesser Sunda Islands','Java Sea','Yes','No'),
	array('Lesser Sunda Islands','Timor Sea','Yes','No'),
	array('West Timor','East Timor','Yes','Yes'),
	array('West Timor','Timor Sea','Yes','No'),
	array('East Timor','Java Sea','Yes','No'),
	array('East Timor','Timor Sea','Yes','No'),
	array('Irian Jaya','Arafura Sea','Yes','No'),
	array('Irian Jaya','Torres Strait','Yes','No'),
	array('Irian Jaya','Papua','Yes','Yes'),
	array('Java Sea','Arafura Sea','Yes','No'),
	array('Java Sea','Timor Sea','Yes','No'),
	array('Java Sea','Jakarta (North Coast)','Yes','No'),
	array('Arafura Sea','Torres Strait','Yes','No'),
	array('Arafura Sea','Gulf of Carpentaria','Yes','No'),
	array('Arafura Sea','Timor Sea','Yes','No'),
	array('Arafura Sea','Darwin','Yes','No'),
	array('Arafura Sea','Kakadu','Yes','No'),
	array('Torres Strait','Coral Sea','Yes','No'),
	array('Torres Strait','Gulf of Carpentaria','Yes','No'),
	array('Torres Strait','Papua','Yes','No'),
	array('Torres Strait','Cape York','Yes','No'),
	array('Torres Strait','Great Barrier Reef','Yes','No'),
	array('Coral Sea','Central West Pacific Ocean','Yes','No'),
	array('Coral Sea','South West Pacific Ocean','Yes','No'),
	array('Coral Sea','Wide Bay','Yes','No'),
	array('Coral Sea','New Caledonia','Yes','No'),
	array('Coral Sea','Papua','Yes','No'),
	array('Coral Sea','Port Moresby','Yes','No'),
	array('Coral Sea','Great Barrier Reef','Yes','No'),
	array('Central West Pacific Ocean','South West Pacific Ocean','Yes','No'),
	array('Central West Pacific Ocean','New Caledonia','Yes','No'),
	array('Central West Pacific Ocean','New Guinea','Yes','No'),
	array('Central West Pacific Ocean','Port Moresby','Yes','No'),
	array('Gulf of Carpentaria','Cape York','Yes','No'),
	array('Gulf of Carpentaria','Mount Isa','Yes','No'),
	array('Gulf of Carpentaria','Kakadu','Yes','No'),
	array('North Indian Ocean','Timor Sea','Yes','No'),
	array('North Indian Ocean','Central Indian Ocean','Yes','No'),
	array('North Indian Ocean','Jakarta (South Coast)','Yes','No'),
	array('North Indian Ocean','North West Shelf','Yes','No'),
	array('Timor Sea','The Kimberley','Yes','No'),
	array('Timor Sea','Broome','Yes','No'),
	array('Timor Sea','North West Shelf','Yes','No'),
	array('Timor Sea','Tanami Desert','Yes','No'),
	array('Timor Sea','Darwin','Yes','No'),
	array('Central Indian Ocean','Shark Bay','Yes','No'),
	array('Central Indian Ocean','Southern Indian Ocean','Yes','No'),
	array('Central Indian Ocean','North West Shelf','Yes','No'),
	array('Central Indian Ocean','Carnarvon','Yes','No'),
	array('Central Indian Ocean','Geraldton','Yes','No'),
	array('Shark Bay','Carnarvon','Yes','No'),
	array('Shark Bay','Geraldton','Yes','No'),
	array('Southern Indian Ocean','Kerguelen Plateau','Yes','No'),
	array('Southern Indian Ocean','West Southern Ocean','Yes','No'),
	array('Southern Indian Ocean','Geraldton','Yes','No'),
	array('Southern Indian Ocean','Perth','Yes','No'),
	array('Southern Indian Ocean','Albany','Yes','No'),
	array('Kerguelen Plateau','West Southern Ocean','Yes','No'),
	array('West Southern Ocean','Great Australian Bight','Yes','No'),
	array('West Southern Ocean','Spencer Gulf','Yes','No'),
	array('West Southern Ocean','Twelve Apostles','Yes','No'),
	array('West Southern Ocean','East Southern Ocean','Yes','No'),
	array('West Southern Ocean','Antarctic Oilfields','Yes','No'),
	array('West Southern Ocean','Albany','Yes','No'),
	array('West Southern Ocean','Esperance','Yes','No'),
	array('Great Australian Bight','Spencer Gulf','Yes','No'),
	array('Great Australian Bight','Esperance','Yes','No'),
	array('Great Australian Bight','West Nullarbor Plain','Yes','No'),
	array('Great Australian Bight','East Nullarbor Plain','Yes','No'),
	array('Great Australian Bight','Eyre','Yes','No'),
	array('Spencer Gulf','Twelve Apostles','Yes','No'),
	array('Spencer Gulf','Eyre','Yes','No'),
	array('Spencer Gulf','Murray Bridge','Yes','No'),
	array('Spencer Gulf','Barossa','Yes','No'),
	array('Spencer Gulf','Adelaide','Yes','No'),
	array('Spencer Gulf','Mount Gambier','Yes','No'),
	array('Twelve Apostles','East Southern Ocean','Yes','No'),
	array('Twelve Apostles','Bass Strait','Yes','No'),
	array('Twelve Apostles','Mount Gambier','Yes','No'),
	array('Twelve Apostles','Great Ocean Road','Yes','No'),
	array('East Southern Ocean','South Pacific Ocean','Yes','No'),
	array('East Southern Ocean','South Tasman Sea','Yes','No'),
	array('East Southern Ocean','Milford Sound','Yes','No'),
	array('East Southern Ocean','Antarctic Mining Territory','Yes','No'),
	array('East Southern Ocean','Hobart','Yes','No'),
	array('East Southern Ocean','Wild Rivers','Yes','No'),
	array('East Southern Ocean','Launceston','Yes','No'),
	array('East Southern Ocean','Antarctic Oilfields','Yes','No'),
	array('East Southern Ocean','Bass Strait','Yes','No'),
	array('South Pacific Ocean','North Tasman Sea','Yes','No'),
	array('South Pacific Ocean','Bay of Plenty','Yes','No'),
	array('South Pacific Ocean','Hawke Bay','Yes','No'),
	array('South Pacific Ocean','Wellington','Yes','No'),
	array('South Pacific Ocean','Marlborough','Yes','No'),
	array('South Pacific Ocean','Christchurch','Yes','No'),
	array('South Pacific Ocean','Dunedin','Yes','No'),
	array('South Pacific Ocean','Milford Sound','Yes','No'),
	array('South Pacific Ocean','Antarctic Mining Territory','Yes','No'),
	array('South Tasman Sea','North Tasman Sea','Yes','No'),
	array('South Tasman Sea','Marlborough','Yes','No'),
	array('South Tasman Sea','West Coast','Yes','No'),
	array('South Tasman Sea','Milford Sound','Yes','No'),
	array('South Tasman Sea','Hobart','Yes','No'),
	array('South Tasman Sea','Launceston','Yes','No'),
	array('South Tasman Sea','Bass Strait','Yes','No'),
	array('South Tasman Sea','South Coast','Yes','No'),
	array('South Tasman Sea','Gippsland','Yes','No'),
	array('North Tasman Sea','Bay of Plenty','Yes','No'),
	array('North Tasman Sea','South West Pacific Ocean','Yes','No'),
	array('North Tasman Sea','Auckland','Yes','No'),
	array('North Tasman Sea','Hamilton','Yes','No'),
	array('North Tasman Sea','Wellington','Yes','No'),
	array('North Tasman Sea','Marlborough','Yes','No'),
	array('North Tasman Sea','Newcastle','Yes','No'),
	array('North Tasman Sea','Hunter Valley','Yes','No'),
	array('North Tasman Sea','Sydney','Yes','No'),
	array('North Tasman Sea','Wollongong','Yes','No'),
	array('North Tasman Sea','South Coast','Yes','No'),
	array('Bay of Plenty','South West Pacific Ocean','Yes','No'),
	array('Bay of Plenty','Auckland','Yes','No'),
	array('Bay of Plenty','Hawke Bay','Yes','No'),
	array('South West Pacific Ocean','Wide Bay','Yes','No'),
	array('South West Pacific Ocean','New Caledonia','Yes','No'),
	array('South West Pacific Ocean','Fraser Coast','Yes','No'),
	array('South West Pacific Ocean','Brisbane','Yes','No'),
	array('South West Pacific Ocean','Gold Coast','Yes','No'),
	array('South West Pacific Ocean','Northern Rivers','Yes','No'),
	array('South West Pacific Ocean','Coffs Harbour','Yes','No'),
	array('South West Pacific Ocean','North Coast','Yes','No'),
	array('South West Pacific Ocean','Newcastle','Yes','No'),
	array('Wide Bay','Great Barrier Reef','Yes','No'),
	array('Wide Bay','Rockhampton','Yes','No'),
	array('Wide Bay','Burnett','Yes','No'),
	array('Wide Bay','Fraser Coast','Yes','No'),
	array('Papua','New Guinea','No','Yes'),
	array('Papua','Port Moresby','Yes','Yes'),
	array('New Guinea','Port Moresby','Yes','Yes'),
	array('Cape York','Cairns','Yes','Yes'),
	array('Cape York','Townsville','No','Yes'),
	array('Cape York','Great Barrier Reef','Yes','No'),
	array('Cape York','Mount Isa','Yes','Yes'),
	array('Cairns','Townsville','Yes','Yes'),
	array('Cairns','Great Barrier Reef','Yes','No'),
	array('Townsville','Whitsundays','Yes','Yes'),
	array('Townsville','Great Barrier Reef','Yes','No'),
	array('Townsville','Matilda Track','No','Yes'),
	array('Townsville','Mount Isa','No','Yes'),
	array('Whitsundays','Great Barrier Reef','Yes','No'),
	array('Whitsundays','Rockhampton','Yes','Yes'),
	array('Whitsundays','Matilda Track','No','Yes'),
	array('Great Barrier Reef','Rockhampton','Yes','No'),
	array('Rockhampton','Burnett','Yes','Yes'),
	array('Rockhampton','Darling Downs','No','Yes'),
	array('Rockhampton','Matilda Track','No','Yes'),
	array('Burnett','Fraser Coast','Yes','Yes'),
	array('Burnett','Brisbane','No','Yes'),
	array('Burnett','Darling Downs','No','Yes'),
	array('Fraser Coast','Brisbane','Yes','Yes'),
	array('Brisbane','Gold Coast','Yes','Yes'),
	array('Brisbane','Darling Downs','No','Yes'),
	array('Gold Coast','Darling Downs','No','Yes'),
	array('Gold Coast','New England','No','Yes'),
	array('Gold Coast','Northern Rivers','Yes','Yes'),
	array('Darling Downs','Maranoa','No','Yes'),
	array('Darling Downs','Matilda Track','No','Yes'),
	array('Darling Downs','New England','No','Yes'),
	array('Maranoa','Matilda Track','No','Yes'),
	array('Maranoa','Eyre','No','Yes'),
	array('Maranoa','Broken Hill','No','Yes'),
	array('Maranoa','Central NSW','No','Yes'),
	array('Matilda Track','Mount Isa','No','Yes'),
	array('Matilda Track','Alice Springs','No','Yes'),
	array('Matilda Track','Eyre','No','Yes'),
	array('Mount Isa','Kakadu','Yes','Yes'),
	array('Mount Isa','Tennant Creek','No','Yes'),
	array('Auckland','Hawke Bay','Yes','Yes'),
	array('Auckland','Hamilton','Yes','Yes'),
	array('Hawke Bay','Hamilton','No','Yes'),
	array('Hawke Bay','Wellington','Yes','Yes'),
	array('Hamilton','Wellington','Yes','Yes'),
	array('Wellington','Marlborough','Yes','Yes'),
	array('Marlborough','West Coast','Yes','Yes'),
	array('Marlborough','Christchurch','Yes','Yes'),
	array('West Coast','Christchurch','No','Yes'),
	array('West Coast','Milford Sound','Yes','Yes'),
	array('Christchurch','Dunedin','Yes','Yes'),
	array('Christchurch','Milford Sound','No','Yes'),
	array('Dunedin','Milford Sound','Yes','Yes'),
	array('Hobart','Wild Rivers','Yes','Yes'),
	array('Hobart','Launceston','Yes','Yes'),
	array('Wild Rivers','Launceston','Yes','Yes'),
	array('Launceston','Bass Strait','Yes','No'),
	array('Bass Strait','Gippsland','Yes','No'),
	array('Bass Strait','Melbourne','Yes','No'),
	array('Bass Strait','Geelong','Yes','No'),
	array('Bass Strait','Great Ocean Road','Yes','No'),
	array('The Kimberley','Broome','Yes','Yes'),
	array('The Kimberley','Great Sandy Desert','No','Yes'),
	array('The Kimberley','Tanami Desert','Yes','Yes'),
	array('Broome','Port Headland','Yes','Yes'),
	array('Broome','Great Sandy Desert','No','Yes'),
	array('Port Headland','North West Shelf','Yes','No'),
	array('Port Headland','Carnarvon','Yes','Yes'),
	array('Port Headland','Great Sandy Desert','No','Yes'),
	array('North West Shelf','Carnarvon','Yes','No'),
	array('Carnarvon','Great Sandy Desert','No','Yes'),
	array('Carnarvon','Geraldton','Yes','Yes'),
	array('Great Sandy Desert','Geraldton','No','Yes'),
	array('Great Sandy Desert','Kalgoorlie','No','Yes'),
	array('Great Sandy Desert','West Nullarbor Plain','No','Yes'),
	array('Great Sandy Desert','Alice Springs','No','Yes'),
	array('Great Sandy Desert','Tanami Desert','No','Yes'),
	array('Geraldton','Perth','Yes','Yes'),
	array('Geraldton','Kalgoorlie','No','Yes'),
	array('Perth','Albany','Yes','Yes'),
	array('Perth','Kalgoorlie','No','Yes'),
	array('Albany','Esperance','Yes','Yes'),
	array('Esperance','Kalgoorlie','No','Yes'),
	array('Esperance','West Nullarbor Plain','Yes','Yes'),
	array('Kalgoorlie','West Nullarbor Plain','No','Yes'),
	array('West Nullarbor Plain','East Nullarbor Plain','Yes','Yes'),
	array('East Nullarbor Plain','Alice Springs','No','Yes'),
	array('East Nullarbor Plain','Coober Pedy','No','Yes'),
	array('East Nullarbor Plain','Eyre','Yes','Yes'),
	array('Alice Springs','Tanami Desert','No','Yes'),
	array('Alice Springs','Tennant Creek','No','Yes'),
	array('Alice Springs','Coober Pedy','No','Yes'),
	array('Alice Springs','Eyre','No','Yes'),
	array('Tanami Desert','Darwin','Yes','Yes'),
	array('Tanami Desert','Kakadu','No','Yes'),
	array('Tanami Desert','Tennant Creek','No','Yes'),
	array('Darwin','Kakadu','Yes','Yes'),
	array('Kakadu','Tennant Creek','No','Yes'),
	array('Coober Pedy','Eyre','No','Yes'),
	array('Eyre','Murray Bridge','No','Yes'),
	array('Eyre','Barossa','Yes','Yes'),
	array('Eyre','Broken Hill','No','Yes'),
	array('Murray Bridge','Barossa','No','Yes'),
	array('Murray Bridge','Adelaide','Yes','Yes'),
	array('Murray Bridge','Mount Gambier','Yes','Yes'),
	array('Murray Bridge','Broken Hill','Yes','Yes'),
	array('Murray Bridge','Mildura','Yes','Yes'),
	array('Murray Bridge','Grampians','No','Yes'),
	array('Barossa','Adelaide','Yes','Yes'),
	array('Mount Gambier','Grampians','No','Yes'),
	array('Mount Gambier','Great Ocean Road','Yes','Yes'),
	array('Broken Hill','Central NSW','Yes','Yes'),
	array('Broken Hill','Mildura','Yes','Yes'),
	array('Central NSW','New England','No','Yes'),
	array('Central NSW','Hunter Valley','No','Yes'),
	array('Central NSW','Blue Mountains','No','Yes'),
	array('Central NSW','Snowy Mountains','No','Yes'),
	array('Central NSW','Albury','Yes','Yes'),
	array('Central NSW','Shepparton','Yes','Yes'),
	array('Central NSW','Bendigo','Yes','Yes'),
	array('Central NSW','Mildura','Yes','Yes'),
	array('New England','Northern Rivers','No','Yes'),
	array('New England','Coffs Harbour','No','Yes'),
	array('New England','North Coast','No','Yes'),
	array('New England','Newcastle','No','Yes'),
	array('New England','Hunter Valley','No','Yes'),
	array('Northern Rivers','Coffs Harbour','Yes','Yes'),
	array('Coffs Harbour','North Coast','Yes','Yes'),
	array('North Coast','Newcastle','Yes','Yes'),
	array('Newcastle','Hunter Valley','Yes','Yes'),
	array('Hunter Valley','Sydney','Yes','Yes'),
	array('Hunter Valley','Blue Mountains','No','Yes'),
	array('Sydney','Wollongong','Yes','Yes'),
	array('Sydney','Blue Mountains','No','Yes'),
	array('Wollongong','Blue Mountains','No','Yes'),
	array('Wollongong','Snowy Mountains','No','Yes'),
	array('Wollongong','South Coast','Yes','Yes'),
	array('Blue Mountains','Snowy Mountains','No','Yes'),
	array('Snowy Mountains','South Coast','No','Yes'),
	array('Snowy Mountains','Albury','Yes','Yes'),
	array('Snowy Mountains','High Country','Yes','Yes'),
	array('South Coast','Gippsland','Yes','Yes'),
	array('Albury','High Country','No','Yes'),
	array('Albury','Shepparton','Yes','Yes'),
	array('Gippsland','High Country','No','Yes'),
	array('Gippsland','Melbourne','Yes','Yes'),
	array('High Country','Melbourne','No','Yes'),
	array('High Country','Shepparton','No','Yes'),
	array('Melbourne','Shepparton','No','Yes'),
	array('Melbourne','Bendigo','No','Yes'),
	array('Melbourne','Ballarat','No','Yes'),
	array('Melbourne','Geelong','Yes','Yes'),
	array('Shepparton','Bendigo','Yes','Yes'),
	array('Bendigo','Ballarat','No','Yes'),
	array('Bendigo','Mildura','Yes','Yes'),
	array('Bendigo','Grampians','No','Yes'),
	array('Ballarat','Grampians','No','Yes'),
	array('Ballarat','Geelong','No','Yes'),
	array('Ballarat','Great Ocean Road','No','Yes'),
	array('Mildura','Grampians','No','Yes'),
	array('Grampians','Great Ocean Road','No','Yes'),
	array('Geelong','Great Ocean Road','Yes','Yes')
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