This libary allows a user to easily communicate with the google maps api and retrieve a set of coordinates from an address.

## Installation
To install, just run the following composer command.

`composer require rapidwebltd/php-simple-google-maps-api`

Remember to include the `vendor/autoload.php` file if your framework does not do this for you.

## Usage

Creating the SimpleGoogleMaps Object can be done in one of two ways.

The first way is to pass through jsut the api key that you are provided upon registering for the google maps api.


```php
use RapidWeb\SimpleGoogleMaps\Factories\SimpleGoogleMapsFactory;
$simpleGoogleMaps = SimpleGoogleMapsFactory::getByKey("[APIKEY]");
```

The second way is to provide your client name and the crypt key that you are provided with upon creating a google enterprise account.

```php
use RapidWeb\SimpleGoogleMaps\Factories\SimpleGoogleMapsFactory;
$simpleGoogleMaps = SimpleGoogleMapsFactory::getByClientNameAndCryptKey("[CLIENTNAME]","[CRYPTKEY]");
```

Once you have created the object you can then get the coordinates from and address via the `getByAddress` method

```php
$addressline = "10 Downing St, Westminster, London SW1A UK";
$homeCoords = $simpleGoogleMaps->getByAddress($addressline);
```

The above method will return a object of type LatLong, this allows you to access the coordinates like so.

```php
$latitude = $homeCoords->lat;
$longitude = $homeCoords->long;
``` 


