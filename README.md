<h1 align="center"> 天气查询 </h1>

<p align="center"> 基于 高德开放平台 的 PHP 天气信息组件。</p>


## 安装

```shell
$ composer require zz/weather -vvv
```
## 配置
在使用本扩展之前，你需要去 <a href="https://lbs.amap.com/dev/index">高德开放平台</a> 注册账号，然后创建应用，获取应用的 API Key。



## 使用

```shell
use Zz\Weather\Weather;

$key = 'xxxxxxxxxxxxxxxxxxxxxxxxxxx';

$weather = new Weather($key);
```

## 获取实时天气
```shell
$response = $weather->getWeather('天津');
```
##### 示例
```shell
{
    "status": "1",
    "count": "1",
    "info": "OK",
    "infocode": "10000",
    "lives": [
        {
            "province": "天津",
            "city": "天津市",
            "adcode": "120000",
            "weather": "晴",
            "temperature": "10",
            "winddirection": "西",
            "windpower": "5",
            "humidity": "74",
            "reporttime": "2018-11-14 14:00:00"
        }
    ]
}
```
## 获取近期天气预报
```shell
$response = $weather->getWeather('天津', 'all');
```
#####示例
```shell
{
    "status": "1",
    "count": "1",
    "info": "OK",
    "infocode": "10000",
    "forecasts": [
        {
            "city": "天津市",
            "adcode": "120000",
            "province": "天津",
            "reporttime": "2018-11-14 11:00:00",
            "casts": [
                {
                    "date": "2018-11-14",
                    "week": "3",
                    "dayweather": "霾",
                    "nightweather": "雾",
                    "daytemp": "15",
                    "nighttemp": "8",
                    "daywind": "西南",
                    "nightwind": "西南",
                    "daypower": "≤3",
                    "nightpower": "≤3"
                },
                {
                    "date": "2018-11-15",
                    "week": "4",
                    "dayweather": "小雨",
                    "nightweather": "雨夹雪",
                    "daytemp": "11",
                    "nighttemp": "2",
                    "daywind": "东北",
                    "nightwind": "北",
                    "daypower": "5",
                    "nightpower": "4"
                },
                {
                    "date": "2018-11-16",
                    "week": "5",
                    "dayweather": "多云",
                    "nightweather": "阴",
                    "daytemp": "10",
                    "nighttemp": "1",
                    "daywind": "北",
                    "nightwind": "西南",
                    "daypower": "≤3",
                    "nightpower": "≤3"
                },
                {
                    "date": "2018-11-17",
                    "week": "6",
                    "dayweather": "阴",
                    "nightweather": "多云",
                    "daytemp": "12",
                    "nighttemp": "2",
                    "daywind": "西",
                    "nightwind": "西",
                    "daypower": "≤3",
                    "nightpower": "≤3"
                }
            ]
        }
    ]  
}
```
## 获取 XML 格式返回值
#####第三个参数为返回值类型，可选 json 与 xml，默认 json：
```shell
$response = $weather->getWeather('天津', 'all', 'xml');
```
##### 示例
```shell
<response>
    <status>1</status>
    <count>1</count>
    <info>OK</info>
    <infocode>10000</infocode>
    <forecasts type="list">
        <forecast>
            <city>天津市</city>
            <adcode>120000</adcode>
            <province>天津</province>
            <reporttime>2018-11-14 11:00:00</reporttime>
            <casts type="list">
                <cast>
                    <date>2018-11-14</date>
                    <week>3</week>
                    <dayweather>霾</dayweather>
                    <nightweather>雾</nightweather>
                    <daytemp>15</daytemp>
                    <nighttemp>8</nighttemp>
                    <daywind>西南</daywind>
                    <nightwind>西南</nightwind>
                    <daypower>≤3</daypower>
                    <nightpower>≤3</nightpower>
                </cast>
                <cast>
                    <date>2018-11-15</date>
                    <week>4</week>
                    <dayweather>小雨</dayweather>
                    <nightweather>雨夹雪</nightweather>
                    <daytemp>11</daytemp>
                    <nighttemp>2</nighttemp>
                    <daywind>东北</daywind>
                    <nightwind>北</nightwind>
                    <daypower>5</daypower>
                    <nightpower>4</nightpower>
                </cast>
                ...
            </casts>
        </forecast>
    </forecasts>
</response>
```
## 参数说明
```shell
array | string   getWeather(string $city, string $type = 'base', string $format = 'json')
```
```shell
$city - 城市名，比如：“深圳”；
$type - 返回内容类型：base: 返回实况天气 / all:返回预报天气；
$format - 输出的数据格式，默认为 json 格式，当 output 设置为 “xml” 时，输出的为 XML 格式的数据。
```
## 在 Laravel 中使用
##### 在 Laravel 中使用也是同样的安装方式，配置写在 config/services.php 中：
```shell
    .
    .
    .
     'weather' => [
        'key' => env('WEATHER_API_KEY'),
    ],
```
##### 然后在 .env 中配置 WEATHER_API_KEY ：
```shell
WEATHER_API_KEY=xxxxxxxxxxxxxxxxxxxxx
```
##### 可以用两种方式来获取 Overtrue\Weather\Weather 实例：
#### 方法参数注入
```shell
    .
    .
    .
    public function edit(Weather $weather) 
    {
        $response = $weather->getWeather('深圳');
    }
    .
    .
    .
```
#### 服务名访问
```shell
    .
    .
    .
    public function edit() 
    {
        $response = app('weather')->getWeather('深圳');
    }
    .
    .
    .
```
## 参考
<a href="https://lbs.amap.com/api/webservice/guide/api/weatherinfo/">高德开放平台天气接口</a>


## License

MIT