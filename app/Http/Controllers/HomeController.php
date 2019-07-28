<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Weather;
use App\Blog;
// use Cmfcmf\OpenWeatherMap\Exception as OWMException;
// use Http\Factory\Guzzle\RequestFactory;
//use Http\Adapter\Guzzle6\Client as GuzzleAdapter;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only('index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $userIdToShowBlogs = $request->user->followees()->pluck('id')->toArray();
        $userIdToShowBlogs[] = $request->user()->id;
        $blogs = Blog::whereIn('user_id', $userIdToShowBlogs)->latest()->get();
        //compact('articles')
        return view('home' , compact('blogs'));
    }

// Language of data (try your own language here!):


// Units (can be 'metric' or 'imperial' [default]):


// You can use every PSR-17 compatible HTTP request factory
// and every PSR-18 compatible HTTP client. This example uses
// `http-interop/http-factory-guzzle` and `php-http/guzzle6-adapter`
// which you need to install separately.

    public function showWeather(Weather $weatherService){
      //  dd( $weatherService);
        $weather =  $weatherService->getWeather('Bolu', 'metric', 'tr')->temperature;
      //  return $weather->temperature.$weather->humidity;
        return $weather;
    }
}
