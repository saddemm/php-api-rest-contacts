<?php

// Definition du type de contenu celon les parametres passé
if (isset ($_REQUEST['content_type']) && $_REQUEST['content_type'] == 'xml') {
    header('Content-Type: text/xml');
} else {
    header('Content-Type: application/json');
}

require_once "vendor/autoload.php";

//Tester si les entrées sont valides et recupérer les paramétres
if (isset($_SERVER['PATH_INFO'])){
$params = explode('/', trim($_SERVER['PATH_INFO'], '/'));
	if (is_array($params) && count($params) > 0 && !empty($params[0])) {
		$api = new \App\Api(new \App\Database());
		$api->getData($params);
	}
}
else exit ("Bonjour et bienvenu dans TEST API de Appartoo, veuillez lire le fichier README. Merci");
