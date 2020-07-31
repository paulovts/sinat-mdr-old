<?php
include("../seguranca/seguranca.php");
//require_once"../../require/class/Arquivos_json.class.php";
require_once"../../require/class/Tab_catalogoDatec.class.php"; //require_once"ConDBCorporativo.class.php"
header('Content-Type: text/html; charset=UTF-8');

$tabDatec = new Tab_catalogoDatec;
			
		echo $tabDatec->json_catDatec();
	
?>