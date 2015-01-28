<?php

defined('IN_CODE') or die('This script can not be run by itself.');

class BuildAnywhere_processOrderBuilds extends processOrderBuilds
{
	public function create()
	{
		global $DB, $Game;

		$newOrders = array();
		foreach($Game->Members->ByID as $Member )
		{
			$difference = 0;
			if ( $Member->unitNo > $Member->supplyCenterNo )
			{
				$difference = $Member->unitNo - $Member->supplyCenterNo;
				$type = 'Destroy';
			}
			elseif ( $Member->unitNo < $Member->supplyCenterNo )
			{
				$difference = $Member->supplyCenterNo - $Member->unitNo;
				$type = 'Build Army';
			}

			for( $i=0; $i < $difference; ++$i )
			{
				$newOrders[] = "(".$Game->id.", ".$Member->countryID.", '".$type."')";
			}
		}

		if ( count($newOrders) )
		{
			$DB->sql_put("INSERT INTO wD_Orders
							(gameID, countryID, type)
							VALUES ".implode(', ', $newOrders));
		}
	}
}

class CustomStart_processOrderBuilds extends BuildAnywhere_processOrderBuilds
{
	protected $countryUnits = array(
		'Amazon-Empire' => array ('Manaus (man)'=>'Army', 'Belem (blm)'=>'Fleet', 'Guyana (guy)'=>'Fleet'),
		'Argentina' => array ('Patagonia (pat)'=>'Fleet', 'Rosario (rsr)'=>'Army', 'Buenos-Aries (bue)'=>'Army'),
		'Australia' => array ('Perth (per)'=>'Fleet', 'Sydney (syd)'=>'Fleet', 'Melbourne (mel)'=>'Army'),
		'Brazil' => array ('Sao Paulo (sao)'=>'Army', 'Rio De Janeiro (rio)'=>'Fleet', 'Belo Horizonte (blh)'=>'Army'),
		'California' => array ('San Francisco (sf)'=>'Fleet', 'Los Angeles (la)'=>'Army', 'Nevada (nev)'=>'Army'),
		'Canada' => array ('Edmonton (edm)'=>'Army', 'Vancouver (van)'=>'Fleet', 'Calgary (clg)'=>'Army'),
		'Catholica' => array ('Marseilles (mar)'=>'Army', 'Rome (rom)'=>'Fleet', 'Spain (spa) (South Coast)'=>'Fleet'),
		'Central-Asia' => array ('Kazakhstan (kaz)'=>'Army', 'Almaty (alm)'=>'Army', 'Uzbekistan (uzb)'=>'Army'),
		'Colombia' => array ('Barranquilla (brn)'=>'Fleet', 'Medellin (med)'=>'Fleet', 'Bogota (bog)'=>'Army'),
		'Congo' => array ('Kinshasa (kin)'=>'Army', 'Katanga (kat)'=>'Army', 'Kisangani (kis)'=>'Army'),
		'Cuba' => array ('Santa Clara (snc)'=>'Fleet', 'Guantanamo (gno)'=>'Fleet', 'Havana (hav)'=>'Fleet'),
		'Egypt' => array ('Khartoum (kha)'=>'Army', 'Tripoli (tri)'=>'Army', 'Egypt (egy)'=>'Fleet'),
		'Germany' => array ('Munich (mun)'=>'Army', 'Hamburg (ham)'=>'Fleet', 'Prague (prg)'=>'Army'),
		'Illinois' => array ('St Louis (stl)'=>'Army', 'Wisconsin (wis)'=>'Army', 'Chicago (chi)'=>'Army'),
		'Inca-Empire' => array ('La Paz (lpz)'=>'Army', 'Valparaiso (val)'=>'Army', 'Lima (lim)'=>'Fleet'),
		'India' => array ('Delhi (del)'=>'Army', 'Calcutta (cal)'=>'Army', 'Bombay (bom)'=>'Fleet'),
		'Indonesia' => array ('Jakarta (jak)'=>'Fleet', 'Palembang (plm)'=>'Army', 'Banjarmasin (bnj)'=>'Fleet'),
		'Iran' => array ('Shiraz (shi)'=>'Fleet', 'Tabriz (tab)'=>'Army', 'Tehran (teh)'=>'Army'),
		'Japan' => array ('Sapporo (sap)'=>'Fleet', 'Kyoto (kyo)'=>'Fleet', 'Tokyo (tok)'=>'Fleet'),
		'Kenya' => array ('Somalia (som)'=>'Fleet', 'Mombasa (mom)'=>'Army', 'Nairobi (nai)'=>'Army'),
		'Manchuria' => array ('Shenyang (she)'=>'Fleet', 'Harbin (har)'=>'Army', 'Beijing (bei)'=>'Army'),
		'Mexico' => array ('Veracruz (vcz)'=>'Fleet', 'Mexico City (mxc)'=>'Army', 'Acapulco (aca)'=>'Army'),
		'Nigeria' => array ('Ghana (gha)'=>'Fleet', 'Lagos (lag)'=>'Army', 'Kano (kno)'=>'Army'),
		'Oceania' => array ('Pitcairn Island (pit)'=>'Fleet', 'Tahiti (tah)'=>'Fleet', 'Samoa (sam)'=>'Fleet'),
		'Philippines' => array ('Cebu (ceb)'=>'Fleet', 'Mindanao (min)'=>'Fleet', 'Manila (mnl)'=>'Fleet'),
		'Quebec' => array ('Montreal (mtl)'=>'Army', 'Newfoundland (nwf)'=>'Fleet', 'Quebec (qbc)'=>'Army'),
		'Russia' => array ('Minsk (msk)'=>'Army', 'Moscow (mos)'=>'Army', 'Kiev (kie)'=>'Army'),
		'Sichuan-Empire' => array ('Xi\'an (xia)'=>'Army', 'Lanzhou (lnz)'=>'Army', 'Cheng Du (che)'=>'Army'),
		'Song-Empire' => array ('Hong Kong (hk)'=>'Fleet', 'Fuzhou (fuz)'=>'Fleet', 'Nanchang (nan)'=>'Army'),
		'South-Africa' => array ('Durban (dur)'=>'Army', 'Pretoria (pre)'=>'Army', 'Cape Town (cap)'=>'Fleet'),
		'Texas' => array ('Houston (hou)'=>'Fleet', 'San Antonio (san)'=>'Army', 'Dallas (dal)'=>'Army'),
		'Thailand' => array ('Rangoon (ran)'=>'Fleet', 'Korat Plateau (krt)'=>'Army', 'Bangkok (bnk)'=>'Army'),
		'Turkey' => array ('Istanbul (ist)'=>'Army', 'Izmir (izm)'=>'Army', 'Ankara (ank)'=>'Army'),
		'United-Kingdom' => array ('Ireland (ire)'=>'Fleet', 'London (lon)'=>'Fleet', 'Edinburgh (edi)'=>'Fleet'),
		'United-States' => array ('Carolinas (car)'=>'Army', 'Washington (was)'=>'Fleet', 'New York City (nyc)'=>'Fleet')
	);

	public function create()
	{
		global $DB, $Game;
		if ($Game->turn == 0) {

			$terrIDByName = array();
			$tabl = $DB->sql_tabl("SELECT id, name FROM wD_Territories WHERE mapID=".$Game->Variant->mapID);
			while(list($id, $name) = $DB->tabl_row($tabl))
				$terrIDByName[$name]=$id;

			$UnitINSERTs = array();
			foreach($this->countryUnits as $countryName => $params)
			{
				$countryID = $Game->Variant->countryID($countryName);

				foreach($params as $terrName=>$unitType)
				{
					$terrID = $terrIDByName[$terrName];
					$unitType = "Build " . $unitType;
					$UnitINSERTs[] = "(".$Game->id.", ".$countryID.", '".$terrID."', '".$unitType."')"; // ( gameID, countryID, terrID, type )
				}
			}
			$DB->sql_put(
				"INSERT INTO wD_Orders ( gameID, countryID, toTerrID, type )
				VALUES ".implode(', ', $UnitINSERTs)
			);		
		} else {
			parent::create();
		}		
	}
}

class WWIVsealanesVariant_processOrderBuilds extends CustomStart_processOrderBuilds {}
