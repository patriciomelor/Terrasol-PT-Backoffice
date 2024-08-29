<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            view()->share('currentUser', auth()->user());
            return $next($request);
        });
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::with('role', 'updatedBy')->get();
        $currentUser = auth()->user();  // Obtener el usuario autenticado

        return view('layouts.dash', compact('currentUser')); }

    public function show($id)
    {
        $user = User::find($id);
        return view('user.show', ['user' => $user]);
    }
    public function home()
    {
        $users = User::with('role', 'updatedBy')->get();
        $currentUser = auth()->user();  // Obtener el usuario autenticado

        return view('home', compact('currentUser')); }

}
