<?php

class Nomove_IAmap extends IAmap{

        protected function jsFooterScript() {
			global $Game,$DB;
                
			parent::jsFooterScript();

			if($Game->phase == "Diplomacy") {
				list($nomove)=$DB->sql_row("SELECT text FROM wD_Notices WHERE toUserID=3 AND timeSent=0 AND fromID=".$Game->id);
				libHTML::$footerIncludes[] = '../variants/Rinascimento/resources/nomove.js';
					
				libHTML::$footerScript[] = 'IA_nomove('.$nomove.');';
			}
        }
}

class RinascimentoVariant_IAmap extends Nomove_IAmap{}

?>