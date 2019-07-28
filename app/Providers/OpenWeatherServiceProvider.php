<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use View;
use Weather;
use Cache;
//use Cmfcmf\OpenWeatherMap\Exception as OWMException; bunları silmesinin sebebi $app şeklinde değişken şeklinde tanımlaması
//use Http\Adapter\Guzzle6\Client as GuzzleAdapter;

class OpenWeatherServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
      $this->app->singleton('Cmfcmf\OpenWeatherMap', function($app){
      //$httpRequestFactory = new RequestFactory();
      //$httpClient = GuzzleAdapter::createWithConfig([]);
      return new Weather(config('services.openweather.key'),
      $app->make('Http\Adapter\Guzzle6\Client'), //$httpClient
      $app->make('Http\Factory\Guzzle\RequestFactory'));//$httpRequestFactory
      });


    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Weather $weatherService)
    {
    //   dd( $weatherService);
    //
    $weather = Cache::remember('weather', 300, function () use($weatherService){//clouser değişken verme
    return $weatherService->getWeather('Bolu', 'metric', 'tr');//cache de bulunmuyorsa bu satırı clouserdan değişkenle çalıştırıyo.
    });

        View::share('weather', $weather);

    }
}
