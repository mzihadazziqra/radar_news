<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $userNews = $user->news()
            ->with('category')
            ->latest('published_at')
            ->paginate(9);

        $userNewsCount = $user->news()->count();

        return view('dashboard', [
            'user' => $user,
            'userNews' => $userNews,
            'userNewsCount' => $userNewsCount,
        ]);
    }
}
