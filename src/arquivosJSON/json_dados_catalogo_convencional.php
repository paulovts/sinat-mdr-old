<?php
include("../seguranca/seguranca.php");
//require_once"../../require/class/Arquivos_json.class.php";
require_once"../../require/class/Tab_catalogoConvencional.class.php"; //require_once"ConDBCorporativo.class.php"
header('Content-Type: text/html; charset=UTF-8');
$tabCatalogo = new Tab_catalogoConvencional;

echo $tabCatalogo->json_catConvencional();
	
?>