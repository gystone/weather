<?php
/**
 * Created by PhpStorm.
 * User: zhen
 * Date: 2018/11/13
 * Time: 下午5:59
 */

namespace TJZen\Weather;


class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    protected $defer = true;

    public function register()
    {
        $this->app->singleton(Weather::class,function (){
            return new Weather(config('services.weather.key'));
        });

        $this->app->alias(Weather::class,'weather');
    }

    public function provides()
    {
        return [Weather::class,'weather'];
    }

}