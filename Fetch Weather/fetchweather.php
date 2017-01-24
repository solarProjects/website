<?php
include "config.php";
//$location = "Mumbai";
$details = json_decode(file_get_contents("http://ipinfo.io/json"));
$loc = explode(",",$details->loc);
$latitude  = $loc[0];
$longitude = $loc[1];
// $url = "http://api.openweathermap.org/data/2.5/weather?q=$location&appid=b7910dc2aad6c516749904c2afcef11c";
$url = "http://api.openweathermap.org/data/2.5/weather?lat=$latitude&lon=$longitude&appid=b7910dc2aad6c516749904c2afcef11c";
$data = file_get_contents($url);
$result = json_decode($data,true);
// echo var_dump($result);
date_default_timezone_set('Asia/Kolkata');
$date = date("d/m/y", $result['dt']);
$sunrise = date("H:i:s", $result['sys']['sunrise']);
$sunset = date("H:i:s", $result['sys']['sunset']);
$high_temp = $result['main']['temp_max'];
$low_temp = $result['main']['temp_min'];
$humidity = $result['main']['humidity'];
$wind_direction = $result['wind']['deg'];
$wind_speed = $result['wind']['speed'];
$lon = $result['coord']['lon'];
$lat = $result['coord']['lat'];
$clouds = $result['clouds']['all'];
$place = $result['name'];
$location_code = $result['id'];
$country = $result['sys']['country'];

$query = mysqli_query($con,"insert into weather_info(dates,sunrise,sunset,high_temp,low_temp,humidity,wind_direction,wind_speed,longitude,latitude,clouds,location,location_code,country)values ('{$date}','{$sunrise}','{$sunset}','{$high_temp}','{$low_temp}','{$humidity}','{$wind_direction}','{$wind_speed}','{$lon}','{$lat}','{$clouds}','{$place}','{$location_code}','{$country}')");

echo "Date: ".$date."<br>";
echo "Sunrise: ".$sunrise."<br>";
echo "Sunset: ".$sunset."<br>";
echo "High Temperature: ".$high_temp."<br>";
echo "Low Temperature: ".$low_temp."<br>";
echo "Humidity: ".$humidity." % <br>";
echo "Wind Direction: ".$wind_direction."<br>";
echo "Wind Speed: ".$wind_speed."<br>";
echo "Longitude: ".$lon."<br>";
echo "Latitude: ".$lat."<br>";
echo "Clouds: ".$clouds."<br>";
echo "Location: ".$place."<br>";
echo "Location Code: ".$location_code."<br>";
echo "Country: ".$country."<br>";
?>
