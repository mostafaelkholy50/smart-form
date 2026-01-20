<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Service;
use App\Models\SliderImage;

use App\Models\HostingPlan;

class WelcomeController extends Controller
{
    public function index()
    {
        $sliderImages = SliderImage::where('is_active', true)->orderBy('order')->get();
        $services = Service::where('page_id', null)->where('is_active', true)->orderBy('order')->take(3)->get();
        $hostingPlans = HostingPlan::whereIn('key', ['silver', 'gold', 'premium'])->get()->keyBy('key');

        return view('welcome', compact('sliderImages', 'services', 'hostingPlans'));
    }
}
