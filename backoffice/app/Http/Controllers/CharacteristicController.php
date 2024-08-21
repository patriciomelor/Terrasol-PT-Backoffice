<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Characteristic;

class CharacteristicController extends Controller
{
    public function index()
    {
        $characteristics = Characteristic::all();
        return view('characteristics.index', compact('characteristics'));
    }

    public function create()
    {
        return view('characteristics.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string',
        ]);
    
        $characteristic = new Characteristic();
        $characteristic->name = $request->name;
        $characteristic->icon = $request->icon;
        $characteristic->save();

        return redirect()->route('characteristics.index')->with('success', 'Característica creada con éxito.');
    }

    public function edit($id)
    {
        $characteristic = Characteristic::findOrFail($id);
        return view('characteristics.edit', compact('characteristic'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string',
        ]);

        $characteristic = Characteristic::findOrFail($id);
        $characteristic->name = $request->name;
        $characteristic->icon = $request->icon;
        $characteristic->save();

        return redirect()->route('characteristics.index')->with('success', 'Característica actualizada con éxito.');
    }

    public function destroy($id)
    {
        $characteristic = Characteristic::findOrFail($id);
        $characteristic->delete();

        return redirect()->route('characteristics.index')->with('success', 'Característica eliminada con éxito.');
    }
}
