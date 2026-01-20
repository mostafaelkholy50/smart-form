<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SliderImage;
use Illuminate\Support\Facades\Storage;

class AdminSliderController extends Controller
{
    public function index()
    {
        $images = SliderImage::orderBy('order')->get();
        return view('admin.slider.index', compact('images'));
    }

    public function create()
    {
        return view('admin.slider.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'order' => 'integer',
        ]);

        $path = $request->file('image_path')->store('slider', 'public');

        SliderImage::create([
            'image_path' => $path,
            'title' => $request->title,
            'description' => $request->description,
            'order' => $request->order ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.slider.index')->with('success', 'Slider image created successfully.');
    }

    public function edit(SliderImage $slider)
    {
        return view('admin.slider.edit', ['sliderImage' => $slider]);
    }

    public function update(Request $request, SliderImage $slider)
    {
        $request->validate([
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'order' => 'integer',
        ]);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'order' => $request->order ?? 0,
            'is_active' => $request->has('is_active'),
        ];

        if ($request->hasFile('image_path')) {
            if ($slider->image_path) {
                Storage::disk('public')->delete($slider->image_path);
            }
            $data['image_path'] = $request->file('image_path')->store('slider', 'public');
        }

        $slider->update($data);

        return redirect()->route('admin.slider.index')->with('success', 'Slider image updated successfully.');
    }

    public function destroy(SliderImage $slider)
    {
        if ($slider->image_path) {
            Storage::disk('public')->delete($slider->image_path);
        }
        $slider->delete();

        return redirect()->route('admin.slider.index')->with('success', 'Slider image deleted successfully.');
    }
}
