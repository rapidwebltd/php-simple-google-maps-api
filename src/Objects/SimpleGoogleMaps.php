<?
namespace RapidWeb\SimpleGoogleMaps\Objects;

use RapidWeb\SimpleGoogleMaps\Objects\BasicApiAuth;
use RapidWeb\SimpleGoogleMaps\Objects\EnterpriseApiAuth;
use RapidWeb\SimpleGoogleMaps\Objects\LatLong;
use GuzzleHttp\Client;

class SimpleGoogleMaps
{
 private $authObject;
 private $baseUrl = "https://maps.googleapis.com/maps/api/";

 public function __construct($key,$clientname,$cryptKey)
 {
  if(isset($key) && $key != null)
  {
    $this->authObject = new BasicApiAuth($key);
  }
  else 
  { 
    $this->authObject = new EnterpriseApiAuth($clientname,$cryptKey);
  }

 }

 public function getByAddress($address,$format = "json")
 {
    $test =  "?address=".urlencode($address);

    $queryUrl = $this->authObject->applyToUrl($this->baseUrl."geocode/".$format.$test);

    $client = new Client();

    $getResults = $client->request('GET', $queryUrl);
    if($format == "json"){
        $results = json_decode($getResults->getBody());
    }

    if(!isset($results) || !$results || !$results->results || !isset($results->results[0])) {
      return null;
    }

    $latLong = new LatLong($results->results[0]->geometry->location->lat,$results->results[0]->geometry->location->lng);

    return $latLong;

 }
}



?>
