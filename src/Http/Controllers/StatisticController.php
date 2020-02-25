<?php

namespace ayzamodul\statistics\Http\Controllers;


use Analytics;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Spatie\Analytics\Period;

class StatisticController extends Controller
{

    public function __construct()
    {
        $this->middleware("web");  // this will solve your problem
        $this->middleware("auth");
    }


    public function index()
    {
        $active = "istatistik";
        $analytics = Cache::remember('analytics', 60, function () {
            $analytics['site'] = Analytics::fetchTotalVisitorsAndPageViews(Period::days(7));
            $analytics['top_referers'] = Analytics::fetchTopReferrers(Period::days(7));
            $analytics['location'] = Analytics::performQuery(Period::days(7), 'ga:users', ["dimensions" => "ga%3Acity"]);
            $analytics['browser'] = Analytics::fetchTopBrowsers(Period::days(7));
            return $analytics;
        });
        return view('Statistics::view', compact('analytics','active'));
    }
}
