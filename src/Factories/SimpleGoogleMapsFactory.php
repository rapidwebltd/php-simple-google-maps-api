<?
namespace RapidWeb\SimpleGoogleMaps\Factories;

use RapidWeb\SimpleGoogleMaps\Objects\SimpleGoogleMaps;

abstract class SimpleGoogleMapsFactory
{
    public static function getByKey($key)
    {
      $simpleGoogleMap = new SimpleGoogleMaps($key,null,null);

      return $simpleGoogleMap;
    }

    public static function getByClientNameAndCryptKey($clientName,$cryptKey)
    {
      $simpleGoogleMap = new SimpleGoogleMaps(null,$clientName,$cryptKey);

      return $simpleGoogleMap;
    }
}



?>