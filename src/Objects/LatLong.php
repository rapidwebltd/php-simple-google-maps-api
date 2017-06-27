<?php

namespace RapidWeb\SimpleGoogleMaps\Objects;

use exception;

class LatLong
{
    public $lat;
    public $long;

    public function __construct($lat,$long)
    {
        $this->lat = $lat;
        $this->long = $long;
    }

    public function distanceTo(LatLong $destination,$unitOfMeasurement = "miles")
    {
      if($unitOfMeasurement == "miles"){
        $earthsRadius = 3959;
      }
      else if($unitOfMeasurement =="kilometres" || $unitOfMeasurement == "kilometers"){
        $earthsRadius = 6371;
      }
      else{
          throw new exception("Unit of measurement is invalid");
      }
      

      $latFrom = deg2rad($this->lat);
      $lonFrom = deg2rad($this->long);
      $latTo = deg2rad($destination->lat);
      $lonTo = deg2rad($destination->long);

      $latDelta = $latTo - $latFrom;
      $lonDelta = $lonTo - $lonFrom;

      $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) + cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));

     return $angle * $earthsRadius;
    }
}