<?php
namespace RapidWeb\SimpleGoogleMaps\Objects;

use RapidWeb\SimpleGoogleMaps\Objects\BasicApiAuth;
use RapidWeb\SimpleGoogleMaps\Objects\EnterpriseApiAuth;
use RapidWeb\SimpleGoogleMaps\Objects\LatLong;
use RapidWeb\SimpleGoogleMaps\Objects\CacheDrivers\RWFileCacheDriver;
use GuzzleHttp\Client;

class SimpleGoogleMaps
{
  private $authObject;
  private $baseUrl = "https://maps.googleapis.com/maps/api/";

  private $cache = null;
  
  public function __construct($key,$clientname,$cryptKey)
  {
    if(isset($key) && $key != null) {
      $this->authObject = new BasicApiAuth($key);
    } else { 
      $this->authObject = new EnterpriseApiAuth($clientname,$cryptKey);
    }

    $this->setupCache();

  }

  private function setupCache()
  {
    $this->cache = new RWFileCacheDriver;
  }

  public function getByAddress($address,$format = "json")
  {
    $addressQueryParam =  "?address=".urlencode($address);

    $queryUrl = $this->authObject->applyToUrl($this->baseUrl."geocode/".$format.$addressQueryParam);

    $cacheKey = "SimpGoogMaps_".substr(sha1($queryUrl), 0, 2)."_".sha1($queryUrl);

    if (($results = $this->cache->get($cacheKey))===false) {

      $client = new Client();

      $response = $client->request('GET', $queryUrl);

      $results = null;

      if($format == "json"){
          $results = json_decode($response->getBody());
      }

      $this->cache->set($cacheKey, $results);
    }

    if(!$results || !$results->results || !isset($results->results[0])) {
      $this->cache->delete($cacheKey);
      return null;
    }

    $latLong = new LatLong($results->results[0]->geometry->location->lat,$results->results[0]->geometry->location->lng);

    return $latLong;

  }
}



?>
