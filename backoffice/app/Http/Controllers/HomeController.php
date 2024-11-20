<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            view()->share('currentUser', auth()->user());
            return $next($request);
        });
    }

    public function index()
    {
        $users = User::with('role', 'updatedBy')->get();
        $currentUser = auth()->user();  // Obtener el usuario autenticado

        // Obtener las actividades recientes del usuario
        $activities = ActivityLog::where('user_id', $currentUser->id)
            ->orderBy('created_at', 'desc')
            ->take(5)  // Limitar a las 5 actividades más recientes
            ->get();

        return view('layouts.dash', compact('currentUser', 'activities'));
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('user.show', ['user' => $user]);
    }

    public function home()
    {
        $users = User::with('role', 'updatedBy')->get();
        $currentUser = auth()->user();  // Obtener el usuario autenticado

        // Obtener las actividades recientes del usuario
        $activities = ActivityLog::where('user_id', $currentUser->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('home', compact('currentUser', 'activities'));
    }
}
