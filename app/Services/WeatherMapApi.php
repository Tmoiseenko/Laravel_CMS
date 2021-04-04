<?php

namespace App\Services;

class WeatherMapApi
{
    public $ipfyUrl;
    public $ipApiUrl;
    public $openWhetherUrl;
    public $openWhetherKey;

    public function __construct($ipfyUrl, $ipApiUrl, $openWhetherUrl, $openWhetherKey)
    {
        $this->ipfyUrl = $ipfyUrl;
        $this->ipApiUrl = $ipApiUrl;
        $this->openWhetherUrl = $openWhetherUrl;
        $this->openWhetherKey = $openWhetherKey;
    }

    public function getIp()
    {

        curl_setopt_array($ch = curl_init(), [
            CURLOPT_URL => $this->ipfyUrl,
            CURLOPT_RETURNTRANSFER => true,
        ]);
        $ip = curl_exec($ch);
        curl_close($ch);
        return $ip;
    }

    public function getGeoIp()
    {
        curl_setopt_array($ch = curl_init(), [
            CURLOPT_URL => $this->ipApiUrl . $this->getIp(),
            CURLOPT_RETURNTRANSFER => true,
        ]);
        $geoIpData = \Opis\Closure\unserialize(curl_exec($ch));
        curl_close($ch);
        return $geoIpData;
    }

    public function getWeather()
    {
        $geoIpData = $this->getGeoIp();
        $whetherRequest = $this->openWhetherUrl . 'lat=' . $geoIpData['lat'] . '&lon=' . $geoIpData['lon'];
        curl_setopt_array($ch = curl_init(), [
            CURLOPT_URL => $whetherRequest,
            CURLOPT_HTTPHEADER => ['X-Yandex-API-Key:'.$this->openWhetherKey],
            CURLOPT_RETURNTRANSFER => true,
        ]);

        $result = curl_exec($ch);
        curl_close($ch);
        dd($result);
        return \GuzzleHttp\json_decode($result);
    }
}
