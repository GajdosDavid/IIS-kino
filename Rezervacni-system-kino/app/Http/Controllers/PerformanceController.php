<?php

namespace App\Http\Controllers;

use App\Performance;
use Illuminate\Http\Request;

class PerformanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('performance.index', ['performances' => Performance::orderBy('name')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('performance.create');
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
            'name' => ['required', 'min:1', 'max:300'],
            'date' => ['required', 'date'],
            'beginning' => ['required', 'date_format:G:i'],
            'end' => ['required', 'date_format:G:i', 'after:beginning'],
            'price' => ['required', 'integer', 'min:1'],
            'type' => ['required', 'min:1', 'max:50'],
            'description' => ['required', 'min:1', 'max:10000'],
            'genre' => ['required', 'min:1', 'max:500'],
            'image' => ['required',/* 'image'*/],
            'performer' => ['required', 'min:1', 'max:500']
        ]);
        //TODO: FOREING KEYS
        $performance = new Performance();
        $performance->name = $request->input('name');
        $performance->date = $request->input('date');
        $performance->beginning = $request->input('beginning');
        $performance->end = $request->input('end');
        $performance->price = $request->input('price');
        $performance->type = $request->input('type');
        $performance->name = $request->input('name');
        $performance->description = $request->input('description');
        $performance->genre = $request->input('genre');
        $performance->image = $request->input('image');
        $performance->performer = $request->input('performer');
        $performance->save();

        return redirect()->route('performance.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Performance  $performance
     * @return \Illuminate\Http\Response
     */
    public function show(Performance $performance)
    {
        return view('performance.show', ['performance' => $performance]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Performance  $performance
     * @return \Illuminate\Http\Response
     */
    public function edit(Performance $performance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Performance  $performance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Performance $performance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Performance  $performance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Performance $performance)
    {
        //
    }
}
