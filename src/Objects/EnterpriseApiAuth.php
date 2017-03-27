<?
namespace RapidWeb\SimpleGoogleMaps\Objects;

use RapidWeb\SimpleGoogleMaps\Interfaces\ApiAuthInterface;
use Exception;

class EnterpriseApiAuth implements ApiAuthInterface
{
    private $clientName;
    private $cryptKey;

    public function __construct($clientName,$cryptKey)
    {  
        if(!$clientName){
            throw new Exception("ClientName not set");
        }

        if(!$cryptKey){
               throw new Exception("CryptKey not set");
        }
        $this->clientName = $clientName;
        $this->cryptKey = $cryptKey;   
    }

    public function applyToUrl($url)
    {
        $urlWithClient = $url."&client=".$this->clientName;

        $parsedUrl = parse_url($urlWithClient);

        $urlToEncode = $parsedUrl['path'].'?'.$parsedUrl['query'];
        $baseKey = base64_decode(str_replace(array('-', '_'), array('+', '/'), $this->cryptKey));

        $signature = hash_hmac('sha1', $urlToEncode, $baseKey, true);

        $encodedSignature = str_replace(array('+', '/'), array('-', '_'), base64_encode($signature));

        $appendedUrl = $urlWithClient."&signature=".$encodedSignature;

        return $appendedUrl;
    }
}

?>