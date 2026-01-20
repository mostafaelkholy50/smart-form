<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ContactMethod;
use App\Models\SliderImage;
use App\Models\Service;
use App\Models\HostingPlan;

class ContactController extends Controller
{
    public function index()
    {
        $sliderImages = SliderImage::where('is_active', true)->orderBy('order')->get();
        // Still fetch services/hosting plans if we keep those sections, but user asked to replace services.
        // Let's assume we keep the rest of the page (slider, hosting table) but swap Services for Contact.
        // We'll pass everything just in case, or limit to what's needed.
        // Actually, user said "contact instead of Our_Services".

        $contactMethods = ContactMethod::where('is_active', true)->orderBy('order')->get();
        $hostingPlans = HostingPlan::whereIn('key', ['silver', 'gold', 'premium'])->get()->keyBy('key');

        return view('contact', compact('sliderImages', 'contactMethods', 'hostingPlans'));
    }
}
