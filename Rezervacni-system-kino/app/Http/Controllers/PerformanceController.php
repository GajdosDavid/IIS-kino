<?php

namespace App\Http\Controllers;

use App\Performance;
use Illuminate\Http\Request;
use File;

class PerformanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('performance.index', ['performances' => Performance::orderBy('name')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('performance.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
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
            'image' => ['required', 'image', 'max:5000'],
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

        $performance->image = $imageName = time().'.'.request()->image->getClientOriginalExtension();
        request()->image->move(storage_path('/app/public'), $imageName);

        $performance->performer = $request->input('performer');
        $performance->save();

        return redirect()->route('performance.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Performance  $performance
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Performance $performance)
    {
        return view('performance.show', ['performance' => $performance]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Performance  $performance
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Performance $performance)
    {
        return view('performance.edit', ['performance' => $performance]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Performance  $performance
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Performance $performance)
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
            'image' => [ 'image', 'max:5000'],
            'performer' => ['required', 'min:1', 'max:500']
        ]);

        $performance->name = $request->input('name');
        $performance->date = $request->input('date');
        $performance->beginning = $request->input('beginning');
        $performance->end = $request->input('end');
        $performance->price = $request->input('price');
        $performance->type = $request->input('type');
        $performance->name = $request->input('name');
        $performance->description = $request->input('description');
        $performance->genre = $request->input('genre');

        if ($request->image){
            File::delete(storage_path('/app/public/'.$performance->image));
            $performance->image = $imageName = time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(storage_path('/app/public'), $imageName);
        }

        $performance->performer = $request->input('performer');
        $performance->save();

        return redirect()->route('performance.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Performance  $performance
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Performance $performance)
    {
        try {
            $performance->delete();
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors(['Při odstranění představení došlo k chybě.']);
        }

        File::delete(storage_path('/app/publicimages/'.$performance->image));

        return redirect()->route('performance.index');
    }
}
