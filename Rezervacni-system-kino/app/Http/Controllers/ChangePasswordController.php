<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\User;
use App\Rules\MatchCurrentPassword;

class ChangePasswordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @param User $user
     * @return Renderable
     */
    public function index()
    {
        return view('auth.change');
    }

    /**
     * Show the application dashboard.
     *
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchCurrentPassword],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
        ]);

        $user = User::find(Auth::guard('web')->User()->id);
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return redirect('/');
    }
}
