<?php
// Remove as variáveis da sessão (caso elas existam)
//unset($_SESSION['usuarioID'], $_SESSION['usuarioNome']);
session_start(); //iniciamos a sessão que foi aberta
session_destroy(); //pei!!! destruimos a sessão ;)
session_unset(); //limpamos as variaveis globais das sessões
// Manda pra tela de login
header("Location: ../../index.php");

?>