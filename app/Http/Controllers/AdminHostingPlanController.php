<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\HostingPlan;

class AdminHostingPlanController extends Controller
{
    public function index()
    {
        $plans = HostingPlan::all();
        return view('admin.hosting_plans.index', compact('plans'));
    }

    public function edit(HostingPlan $hostingPlan)
    {
        return view('admin.hosting_plans.edit', compact('hostingPlan'));
    }

    public function update(Request $request, HostingPlan $hostingPlan)
    {
        $validatedData = $request->validate([
            'name.en' => 'required|string',
            'name.ar' => 'required|string',
            'price' => 'required|string',
            'currency.en' => 'required|string',
            'currency.ar' => 'required|string',
            'features.space.en' => 'required|string',
            'features.space.ar' => 'required|string',
            'features.traffic.en' => 'required|string',
            'features.traffic.ar' => 'required|string',
            'features.support.en' => 'required|string',
            'features.support.ar' => 'required|string',
            // Add validation for other features as needed
        ]);

        // Construct features array merging with existing to keep structure
        $features = $hostingPlan->features;
        $features['space']['en'] = $request->input('features.space.en');
        $features['space']['ar'] = $request->input('features.space.ar');
        $features['traffic']['en'] = $request->input('features.traffic.en');
        $features['traffic']['ar'] = $request->input('features.traffic.ar');
        $features['support']['en'] = $request->input('features.support.en');
        $features['support']['ar'] = $request->input('features.support.ar');

        // Handle other specific features based on keys if necessary, or iterate
        // For simplicity, we assume the form sends all necessary feature fields.
        // We might need a more dynamic approach if features vary greatly, but for these 3 plans they are consistent enough.

        if ($request->has('features.databases.en')) {
            $features['databases']['en'] = $request->input('features.databases.en');
            $features['databases']['ar'] = $request->input('features.databases.ar');
        }
        if ($request->has('features.subdomains.en')) {
            $features['subdomains']['en'] = $request->input('features.subdomains.en');
            $features['subdomains']['ar'] = $request->input('features.subdomains.ar');
        }
        if ($request->has('features.emails.en')) {
            $features['emails']['en'] = $request->input('features.emails.en');
            $features['emails']['ar'] = $request->input('features.emails.ar');
        }
        if ($request->has('features.ftp.en')) {
            $features['ftp']['en'] = $request->input('features.ftp.en');
            $features['ftp']['ar'] = $request->input('features.ftp.ar');
        }

        if ($request->has('features.custom_design')) {
            if (is_array($request->input('features.custom_design'))) {
                $features['custom_design']['en'] = $request->input('features.custom_design.en');
                $features['custom_design']['ar'] = $request->input('features.custom_design.ar');
            } else {
                // Handle boolean case if switched back? simplified for now as text/bool hybrid is tricky in form
            }
        }

        if ($request->has('features.free_domain.en')) {
            $features['free_domain']['en'] = $request->input('features.free_domain.en');
            $features['free_domain']['ar'] = $request->input('features.free_domain.ar');
        }


        $hostingPlan->update([
            'name' => [
                'en' => $request->input('name.en'),
                'ar' => $request->input('name.ar'),
            ],
            'price' => $request->price,
            'currency' => [
                'en' => $request->input('currency.en'),
                'ar' => $request->input('currency.ar'),
            ],
            'features' => $features,
        ]);

        return redirect()->route('admin.hosting_plans.index')->with('success', 'Plan updated successfully.');
    }
}
