<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        // Obtener todas las preguntas frecuentes ordenadas
        $faqs = Faq::orderBy('order')->get();
        return view('faqs.index', compact('faqs'));
    }

    public function store(Request $request)
    {
        // Validación
        $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
        ]);

        // Crear una nueva F&Q
        Faq::create($request->only(['question', 'answer']));
        return redirect()->route('faqs.index');
    }

    public function updateOrder(Request $request)
    {
        foreach ($request->faqs as $index => $faqId) {
            Faq::where('id', $faqId)->update(['order' => $index + 1]); 
        }
        return response()->json(['message' => 'Orden actualizado con éxito']);
    }
    public function destroy(Faq $faq) 
    {
        $faq->delete();
        return redirect()->route('faqs.index')->with('danger', 'Pregunta eliminada correctamente.');
    }
        // Función para devolver las preguntas frecuentes en formato JSON
        public function apiIndex()
        {
            $faqs = Faq::orderBy('order')->get();
            return response()->json($faqs);
        }
}
