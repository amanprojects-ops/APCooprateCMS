<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::orderBy('group')->orderBy('key')->get()->groupBy('group');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        // Validate files if present
        $rules = [];
        foreach ($request->files->all() as $key => $file) {
            if ($key === 'favicon') {
                $rules[$key] = 'nullable|file|mimes:jpeg,png,jpg,gif,svg,ico,webp|max:2048';
            } else {
                $rules[$key] = 'nullable|image|max:3072';
            }
        }
        $request->validate($rules);

        // Handle image removals
        if ($request->has('remove_image')) {
            foreach ($request->input('remove_image') as $key => $shouldRemove) {
                if ($shouldRemove) {
                    $setting = Setting::where('key', $key)->first();
                    if ($setting && $setting->value) {
                        Storage::disk('public')->delete($setting->value);
                        $setting->update(['value' => null]);
                    }
                }
            }
        }

        // Process other inputs
        $data = $request->except(['_token', '_method', 'remove_image']);
        foreach ($data as $key => $value) {
            if ($request->hasFile($key)) {
                continue;
            }

            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => is_array($value) ? implode(',', $value) : $value]
            );
        }

        // Process file uploads
        foreach ($request->files->all() as $key => $file) {
            if ($request->hasFile($key) && $request->file($key)->isValid()) {
                $setting = Setting::where('key', $key)->first();
                if ($setting) {
                    if ($setting->value) {
                        Storage::disk('public')->delete($setting->value);
                    }
                    $path = $request->file($key)->store('settings', 'public');
                    $setting->update(['value' => $path]);
                }
            }
        }

        return back()->with('success', 'Settings saved successfully.');
    }
}
