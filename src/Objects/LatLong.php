<?

namespace RapidWeb\SimpleGoogleMaps\Objects;

class LatLong
{
    public $lat;
    public $long;

    public function __construct($lat,$long)
    {
        $this->lat = $lat;
        $this->long = $long;
    }
}