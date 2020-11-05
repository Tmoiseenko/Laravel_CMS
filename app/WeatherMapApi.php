<?php

namespace App;

class WeatherMapApi
{
    public static function getWeather($ipfyUrl, $ipApiUrl, $openWhetherUrl, $openWhetherKey)
    {
        curl_setopt_array($ch = curl_init(), [
            CURLOPT_URL => $ipfyUrl,
            CURLOPT_RETURNTRANSFER => true,
        ]);
        $ip = curl_exec($ch);
        curl_close($ch);

        curl_setopt_array($ch = curl_init(), [
            CURLOPT_URL => $ipApiUrl . $ip,
            CURLOPT_RETURNTRANSFER => true,
        ]);
        $geoIpData = \Opis\Closure\unserialize(curl_exec($ch));
        curl_close($ch);
        $whetherRequest = $openWhetherUrl . 'lat=' . $geoIpData['lat'] . '&lon=' . $geoIpData['lon'];
        curl_setopt_array($ch = curl_init(), [
            CURLOPT_URL => $whetherRequest,
            CURLOPT_HTTPHEADER => ['X-Yandex-API-Key:'.$openWhetherKey],
            CURLOPT_RETURNTRANSFER => true,
        ]);
        $result = curl_exec($ch);
        curl_close($ch);
        return \GuzzleHttp\json_decode($result);
    }
}
