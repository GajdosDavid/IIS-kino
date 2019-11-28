<?php

namespace App\Http\Controllers;

use App\Hall;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class HallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('hall.index', ['halls' => hall::orderBy('name')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hall.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => ['required', 'min:3', 'max:50'],
            'address' => ['required', 'min:3', 'max:50'],
            'rows' => ['required', 'integer', 'min:1', 'max:50'],
            'seatsInRow' => ['required', 'integer', 'min:1', 'max:50'],
            'capacity' => ['required', 'integer', Rule::in([$request->input('rows') * $request->input('seatsInRow')])]
        ]);

        //TODO: FOREING KEYS
        $hall = new Hall();
        $hall->name = $request->input('name');
        $hall->address = $request->input('address');
        $hall->capacity = $request->input('capacity');
        $hall->rows = $request->input('rows');
        $hall->seatsInRow = $request->input('seatsInRow');
        $hall->save();

        return redirect()->route('hall.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Hall  $hall
     * @return \Illuminate\Http\Response
     */
    public function show(Hall $hall)
    {
        return view('hall.show', ['hall' => $hall]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Hall  $hall
     * @return \Illuminate\Http\Response
     */
    public function edit(Hall $hall)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Hall  $hall
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hall $hall)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Hall  $hall
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hall $hall)
    {
        //
    }
}
