<?php
/**
 * Created by PhpStorm.
 * User: zhen
 * Date: 2018/11/13
 * Time: 下午3:39
 */

namespace Zz\Weather;


use GuzzleHttp\Client;
use Zz\Weather\Exceptions\HttpException;
use Zz\Weather\Exceptions\InvalidArgumentException;

class Weather
{
    protected $key;
    protected $guzzleOptions=[];

    public function __construct($key)
    {
        $this->key = $key;
    }

    public function getHttpClient()
    {
        return new Client($this->guzzleOptions);
    }

    public function setGuzzleOptions(array $options)
    {
        $this->guzzleOptions = $options;
    }

    public function getWeather($city, $type = 'base', $format = 'json')
    {
        $url = 'https://restapi.amap.com/v3/weather/weatherInfo';
        if(!\in_array(\strtolower($format),['xml','json'])){
            throw new InvalidArgumentException('Invalid response format: '.$format);
        }

        if(!\in_array(\strtolower($type),['base','all'])){
            throw new InvalidArgumentException('Invalid type value(base/all): '.$type);
        }

        $query = array_filter([
            'key' => $this->key,
            'city' => $city,
            'output' => $format,
            'extensions' =>  $type,
        ]);

        try{
            $response = $this->getHttpClient()->get($url, [
                'query' => $query,
            ])->getBody()->getContents();
        }catch (\Exception $e){
            throw new HttpException($e->getMessage(),$e->getCode(),$e);
        }


        return 'json' === $format ? \json_decode($response, true) : $response;

    }


}