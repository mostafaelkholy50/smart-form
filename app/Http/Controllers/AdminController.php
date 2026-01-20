<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\HeaderLink;
use App\Models\SocialLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Display admin dashboard
     */
    public function index()
    {
        $stats = [
            'total_links' => \App\Models\HeaderLink::count(),
            'total_pages' => \App\Models\Page::count(),
            'total_services' => \App\Models\Service::count(),
            'logo_status' => Setting::get('site_logo') ? __('admin.logo_uploaded') : __('admin.logo_not_set'),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    /**
     * Show logo settings page
     */
    public function showLogoSettings()
    {
        $currentLogo = Setting::get('site_logo');
        return view('admin.logo', compact('currentLogo'));
    }

    /**
     * Update logo
     */
    public function updateLogo(Request $request)
    {
        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        // Delete old logo if exists
        $oldLogo = Setting::get('site_logo');
        if ($oldLogo && Storage::disk('public')->exists($oldLogo)) {
            Storage::disk('public')->delete($oldLogo);
        }

        // Upload new logo
        $path = Setting::uploadFile('site_logo', $request->file('logo'), 'logo');

        return redirect()->route('admin.logo')
            ->with('success', __('admin.logo_updated_successfully'));
    }

    /**
     * Show header links settings page
     */
    public function showLinksSettings()
    {
        $links = HeaderLink::orderBy('order')->get();
        return view('admin.links', compact('links'));
    }

    /**
     * Store new header link
     */
    public function storeLink(Request $request)
    {
        $request->validate([
            'label_ar' => 'required|string|max:255',
            'label_en' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'order' => 'nullable|integer',
        ]);

        HeaderLink::create([
            'label_ar' => $request->label_ar,
            'label_en' => $request->label_en,
            'url' => $request->url,
            'order' => $request->order ?? 0,
            'is_active' => true,
        ]);

        return redirect()->route('admin.links')
            ->with('success', __('admin.link_added_successfully'));
    }

    /**
     * Update header link
     */
    public function updateLink(Request $request, HeaderLink $link)
    {
        $request->validate([
            'label_ar' => 'required|string|max:255',
            'label_en' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $link->update([
            'label_ar' => $request->label_ar,
            'label_en' => $request->label_en,
            'url' => $request->url,
            'order' => $request->order ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.links')
            ->with('success', __('admin.link_updated_successfully'));
    }

    /**
     * Show social links settings page
     */
    public function showSocialSettings()
    {
        $links = SocialLink::all();
        return view('admin.social', compact('links'));
    }

    /**
     * Store new social link
     */
    public function storeSocialLink(Request $request)
    {
        $request->validate([
            'platform' => 'required|string|max:50',
            'url' => 'required|string|max:255',
        ]);

        SocialLink::create([
            'platform' => $request->platform,
            'url' => $request->url,
            'is_active' => true,
        ]);

        return redirect()->route('admin.social')
            ->with('success', __('admin.social_added_successfully') ?? 'Social link added successfully');
    }

    /**
     * Update social link
     */
    public function updateSocialLink(Request $request, SocialLink $link)
    {
        $request->validate([
            'url' => 'required|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);

        $link->update([
            'url' => $request->url,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.social')
            ->with('success', __('admin.social_updated_successfully') ?? 'Social link updated successfully');
    }

    /**
     * Delete social link
     */
    public function deleteSocialLink(SocialLink $link)
    {
        $link->delete();

        return redirect()->route('admin.social')
            ->with('success', __('admin.social_deleted_successfully') ?? 'Social link deleted successfully');
    }
}
