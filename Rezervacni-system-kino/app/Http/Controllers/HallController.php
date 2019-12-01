<?php

namespace App\Http\Controllers;

use App\Hall;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('hall.index', ['halls' => hall::orderBy('name')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('hall.create');
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
            'name' => ['required', 'min:3', 'max:50'],
            'address' => ['nullable', 'min:3', 'max:50'],
            'rows' => ['required', 'integer', 'min:1', 'max:20'],
            'seats_in_row' => ['required', 'integer', 'min:1', 'max:20']
        ]);

        //TODO: FOREING KEYS
        $hall = new Hall();
        $hall->name = $request->input('name');
        $hall->address = $request->input('address');
        $hall->rows = $request->input('rows');
        $hall->seats_in_row = $request->input('seats_in_row');
        $hall->save();

        return redirect()->route('hall.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Hall $hall
     * @return Factory|View
     */
    public function show(Hall $hall)
    {
        return view('hall.show', ['hall' => $hall]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Hall $hall
     * @return Factory|View
     */
    public function edit(Hall $hall)
    {
        return view('hall.edit', ['hall' => $hall]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Hall $hall
     * @return RedirectResponse
     */
    public function update(Request $request, Hall $hall)
    {
        $this->validate($request, [
            'name' => ['required', 'min:3', 'max:50'],
            'address' => ['nullable', 'min:3', 'max:50'],
            'rows' => ['required', 'integer', 'min:1', 'max:20'],
            'seats_in_row' => ['required', 'integer', 'min:1', 'max:20']
        ]);

        //TODO: FOREING KEYS
        $hall->name = $request->input('name');
        $hall->address = $request->input('address');
        $hall->rows = $request->input('rows');
        $hall->seats_in_row = $request->input('seats_in_row');
        $hall->save();

        return redirect()->route('hall.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Hall $hall
     * @return RedirectResponse
     */
    public function destroy(Hall $hall)
    {
        try {
            $hall->delete();
        } catch (Exception $exception) {
            return redirect()->back()->withErrors(['Při odstranění sálu došlo k chybě.']);
        }

        return redirect()->route('hall.index');
    }
}
