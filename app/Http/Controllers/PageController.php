<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\SliderImage;
use App\Models\HostingPlan;

class PageController extends Controller
{
    public function show($slug)
    {
        $page = Page::where('slug->en', $slug)
            ->orWhere('slug->ar', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $sliderImages = SliderImage::where('is_active', true)->orderBy('order')->get();
        $services = $page->services()->where('is_active', true)->orderBy('order')->take(3)->get();
        $hostingPlans = HostingPlan::whereIn('key', ['silver', 'gold', 'premium'])->get()->keyBy('key');

        return view('page', compact('page', 'sliderImages', 'services', 'hostingPlans'));
    }
}
