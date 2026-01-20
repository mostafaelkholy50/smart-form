<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ContactMethod;

class AdminContactController extends Controller
{
    public function index()
    {
        $contactMethods = ContactMethod::orderBy('order')->get();
        return view('admin.contact.index', compact('contactMethods'));
    }

    public function create()
    {
        return view('admin.contact.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title.en' => 'required|string',
            'title.ar' => 'required|string',
            'content.en' => 'required|string',
            'content.ar' => 'required|string',
            'icon_class' => 'required|string',
            'order' => 'integer|nullable',
        ]);

        $data['order'] = $request->order ?? 0;
        $data['is_active'] = $request->has('is_active');

        ContactMethod::create($data);

        return redirect()->route('admin.contact.index')->with('success', 'Contact method created successfully.');
    }

    public function edit(ContactMethod $contact)
    {
        return view('admin.contact.edit', ['contactMethod' => $contact]);
    }

    public function update(Request $request, ContactMethod $contact)
    {
        $data = $request->validate([
            'title.en' => 'required|string',
            'title.ar' => 'required|string',
            'content.en' => 'required|string',
            'content.ar' => 'required|string',
            'icon_class' => 'required|string',
            'order' => 'integer|nullable',
        ]);

        $data['order'] = $request->order ?? 0;
        $data['is_active'] = $request->has('is_active');

        $contact->update($data);

        return redirect()->route('admin.contact.index')->with('success', 'Contact method updated successfully.');
    }

    public function destroy(ContactMethod $contact)
    {
        $contact->delete();
        return redirect()->route('admin.contact.index')->with('success', 'Contact method deleted successfully.');
    }
}
