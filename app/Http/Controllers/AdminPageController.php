<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Str;

class AdminPageController extends Controller
{
    public function index()
    {
        $pages = Page::orderBy('order')->get();
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title.en' => 'required|string',
            'title.ar' => 'required|string',
            'slug.en' => 'nullable|string',
            'slug.ar' => 'nullable|string',
            'order' => 'integer',
        ]);

        $slug_en = $request->input('slug.en') ?: Str::slug($request->input('title.en'));
        $slug_ar = $request->input('slug.ar') ?: $request->input('title.ar'); // Arabic slugs might just be the title or encoded

        Page::create([
            'title' => [
                'en' => $request->input('title.en'),
                'ar' => $request->input('title.ar'),
            ],
            'slug' => [
                'en' => $slug_en,
                'ar' => $slug_ar,
            ],
            'order' => $request->order ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.pages.index')->with('success', __('admin.page_added_successfully'));
    }

    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $request->validate([
            'title.en' => 'required|string',
            'title.ar' => 'required|string',
            'slug.en' => 'nullable|string',
            'slug.ar' => 'nullable|string',
            'order' => 'integer',
        ]);

        $slug_en = $request->input('slug.en') ?: Str::slug($request->input('title.en'));
        $slug_ar = $request->input('slug.ar') ?: $request->input('title.ar');

        $page->update([
            'title' => [
                'en' => $request->input('title.en'),
                'ar' => $request->input('title.ar'),
            ],
            'slug' => [
                'en' => $slug_en,
                'ar' => $slug_ar,
            ],
            'order' => $request->order ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.pages.index')->with('success', __('admin.page_updated_successfully'));
    }

    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('admin.pages.index')->with('success', __('admin.page_deleted_successfully'));
    }
}
