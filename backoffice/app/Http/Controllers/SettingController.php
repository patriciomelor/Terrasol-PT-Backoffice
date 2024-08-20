<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all();
        return view('settings.index', compact('settings'));
    }

    public function create()
    {
        return view('settings.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'key' => 'required|string|max:255|unique:settings',
            'value' => 'nullable|string',
        ]);

        Setting::create($request->all());

        return redirect()->route('settings.index')->with('success', 'Configuración creada correctamente.');
    }

    public function edit(Setting $setting)
    {
        return view('settings.edit', compact('setting'));
    }

    public function update(Request $request, Setting $setting)
    {
        $request->validate([
            'value' => 'nullable|string',
        ]);

        $setting->update($request->all());

        return redirect()->route('settings.index')->with('success', 'Configuración actualizada correctamente.');
    }

    public function destroy(Setting $setting)
    {
        $setting->delete();
        return redirect()->route('settings.index')->with('success', 'Configuración eliminada correctamente.');
    }
}
