<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('user.index', ['users' => user::orderBy('surname')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => ['required', 'min:1', 'max:30'],
            'surname' => ['required', 'min:1', 'max:30'],
            'phone' => ['nullable', 'min:4', 'max:20'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
            'role' => ['integer', 'min:0', 'max:3']
        ]);

        $user = new User();
        $user->first_name = $request->input('first_name');
        $user->surname = $request->input('surname');
        $user->phone = $request->input('phone');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->role = $request->input('role');
        $user->save();

        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return Factory|View
     */
    public function show(User $user)
    {
        return view('user.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return Factory|View
     */
    public function edit(User $user)
    {
        return view('user.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'first_name' => ['required', 'min:1', 'max:30'],
            'surname' => ['required', 'min:1', 'max:30'],
            'phone' => ['nullable', 'min:4', 'max:20'],
            'role' => ['integer', 'min:0', 'max:3']
        ]);

        $user->first_name = $request->input('first_name');
        $user->surname = $request->input('surname');
        $user->phone = $request->input('phone');

        if($request->input('role')){
            $user->role = $request->input('role');
        }
        $user->save();


        $role = Auth::guard('web')->User()->role;
        if ( $role == 3){
            return redirect()->route('user.index');
        }
        else{
            return redirect('/');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(User $user)
    {
        $role = Auth::guard('web')->User()->role;

        try {
            $user->delete();
        } catch (Exception $exception) {
            return redirect()->back()->withErrors(['Při odstranění uživatele došlo k chybě.']);
        }

        if ( $role == 3){
            return redirect()->route('user.index');
        }
        else{
            return redirect('/');
        }
    }
}
