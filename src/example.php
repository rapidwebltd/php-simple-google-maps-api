<?
require_once '../vendor/autoload.php';

use RapidWeb\SimpleGoogleMaps\Factories\SimpleGoogleMapsFactory;

$addressline = "10 Downing St, Westminster, London SW1A UK";

$simpleGoogleMaps = SimpleGoogleMapsFactory::getByClientNameAndCryptKey("[CLIENTNAME]","[CRYPTKEY]");
$simpleGoogleMaps = SimpleGoogleMapsFactory::getByKey("[APIKEY]");


$homeCoords = $simpleGoogleMaps->getByAddress($addressline);


