<?
namespace RapidWeb\SimpleGoogleMaps\Objects;

use RapidWeb\SimpleGoogleMaps\Interfaces\ApiAuthInterface;
use Exception;

class BasicApiAuth implements ApiAuthInterface
{
    private $key;
    public function __construct($key)
    {
        if(!$key){
            throw new Exception("No key set");
        }
        $this->key = $key;
    }

    public function applyToUrl($url)
    {
        $authString= "&key=".$this->key;
        $appendedUrl = $url.$authString;

        return $appendedUrl;
    }
}

?>