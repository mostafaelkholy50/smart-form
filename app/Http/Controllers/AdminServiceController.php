<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Service;
use App\Models\Page;

class AdminServiceController extends Controller
{
    public function index()
    {
        $services = Service::with('page')->orderBy('order')->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        $pages = Page::where('is_active', true)->orderBy('order')->get();
        return view('admin.services.create', compact('pages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title.en' => 'required|string',
            'title.ar' => 'required|string',
            'description.en' => 'required|string',
            'description.ar' => 'required|string',
            'icon_class' => 'required|string',
            'order' => 'integer',
        ]);

        Service::create([
            'title' => [
                'en' => $request->input('title.en'),
                'ar' => $request->input('title.ar'),
            ],
            'description' => [
                'en' => $request->input('description.en'),
                'ar' => $request->input('description.ar'),
            ],
            'icon_class' => $request->icon_class,
            'order' => $request->order ?? 0,
            'is_active' => $request->has('is_active'),
            'page_id' => $request->page_id,
        ]);

        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    public function edit(Service $service)
    {
        $pages = Page::where('is_active', true)->orderBy('order')->get();
        return view('admin.services.edit', compact('service', 'pages'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'title.en' => 'required|string',
            'title.ar' => 'required|string',
            'description.en' => 'required|string',
            'description.ar' => 'required|string',
            'icon_class' => 'required|string',
            'order' => 'integer',
        ]);

        $service->update([
            'title' => [
                'en' => $request->input('title.en'),
                'ar' => $request->input('title.ar'),
            ],
            'description' => [
                'en' => $request->input('description.en'),
                'ar' => $request->input('description.ar'),
            ],
            'icon_class' => $request->icon_class,
            'order' => $request->order ?? 0,
            'is_active' => $request->has('is_active'),
            'page_id' => $request->page_id,
        ]);

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
    }
}
