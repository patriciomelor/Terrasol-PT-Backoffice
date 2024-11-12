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
        $settings = [
            'site_name' => Setting::get('site_name'),
            'site_description' => Setting::get('site_description'),
            'primary_color' => Setting::get('primary_color'),
            'secondary_color' => Setting::get('secondary_color'),
            'link_color' => Setting::get('link_color'),
            'link_hover_color' => Setting::get('link_hover_color'),
            'contact_phone' => Setting::get('contact_phone'),
            'contact_email' => Setting::get('contact_email'),
            'address' => Setting::get('address'),
            'mission' => Setting::get('mission'),
            'vision' => Setting::get('vision'),
            'about_us' => Setting::get('about_us'),
        ];
        return view('settings.create', compact('settings'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'site_description' => 'required|string|max:255',
            'primary_color' => 'required|string|max:7',
            'secondary_color' => 'nullable|string|max:7',
            'link_color' => 'required|string|max:7',
            'link_hover_color' => 'required|string|max:7',
            'contact_phone' => 'nullable|string|max:15',
            'contact_email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:255',
            'mission' => 'nullable|string',
            'vision' => 'nullable|string',
            'about_us' => 'nullable|string',
        ]);
    
        Setting::set('site_name', $request->site_name);
        Setting::set('site_description', $request->site_description);
        Setting::set('primary_color', $request->primary_color);
        Setting::set('secondary_color', $request->secondary_color);
        Setting::set('link_color', $request->link_color);
        Setting::set('link_hover_color', $request->link_hover_color);
        Setting::set('contact_phone', $request->contact_phone);
        Setting::set('contact_email', $request->contact_email);
        Setting::set('address', $request->address);
        Setting::set('mission', $request->mission);
        Setting::set('vision', $request->vision);
        Setting::set('about_us', $request->about_us);
    
        return redirect()->route('settings.index')->with('success', 'Configuraciones guardadas correctamente.');
    }
    
    public function update(Request $request, Setting $setting)
    {
        $request->validate([
            'value' => 'nullable|string',
        ]);
    
        $setting->update($request->all());
    
        return redirect()->route('settings.index')->with('success', 'Configuración actualizada correctamente.');
    }
    

    public function edit(Setting $setting)
    {
        return view('settings.edit', compact('setting'));
    }

    public function destroy(Setting $setting)
    {
        $setting->delete();
        return redirect()->route('settings.index')->with('success', 'Configuración eliminada correctamente.');
    }
    public function apiSettings()
    {   
        $settings = Setting::all();  // Obtiene todos los registros de configuración

        $settingsArray = [];
        foreach ($settings as $setting) {
            $settingsArray[$setting->key] = $setting->value;
        }

        return response()->json($settingsArray);
    }
}
