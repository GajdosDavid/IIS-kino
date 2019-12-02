<?php

namespace App\Http\Controllers;

use App\Hall;
use App\Performance;
use App\Piece;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use File;
use Illuminate\View\View;

class PerformanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $piece = Piece::get();

        return view('performance.index', ['performances' => Performance::orderBy('date')->get(), 'pieces' => $piece]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('performance.create', ['halls' => Hall::orderBy('name')->get(), 'pieces' => Piece::orderBy('name')->get() ]);
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
            'date' => ['required', 'date'],
            'beginning' => ['required', 'date_format:G:i'],
            'end' => ['required', 'date_format:G:i', 'after:beginning'],
            'price' => ['required', 'integer', 'min:1'],
            'piece' => ['required'],
            'hall' => ['required']
        ]);

        if($request->date <  date("Y-m-d")){
            return redirect()->back()->withErrors(['Zadaný datum a čas musí být větši než aktuální']);
        }
        else if($request->date ==  date("Y-m-d")){
            if($request->beginning < date("G:i")){
                return redirect()->back()->withErrors(['Zadaný datum a čas musí být větši než aktuální']);
            }
        }

        foreach($request->input('hall') as $hall_id){
            $hall = Hall::find($hall_id);
            foreach($hall->performances as $perf){
                if($request->input('date') == $perf->date){
                    $beginning = date('G:i', strtotime($perf->beginning));
                    $end = date('G:i', strtotime($perf->end));

                    if( (( $request->input('beginning') >= $beginning) && ( $request->input('beginning') <= $end))
                        ||
                        (( $request->input('date') >= $beginning) && ( $request->input('date') <= $end))
                    )
                    {
                        return redirect()->back()->withErrors(['Sál '.$hall->name.' je již v dobu od '.$beginning.' do '.$end.' zabrán událostí s dílem '.$perf->piece->name]);
                    }
                }
            }
        }

        $performance = new Performance();
        $performance->date = $request->input('date');
        $performance->beginning = $request->input('beginning');
        $performance->end = $request->input('end');
        $performance->price = $request->input('price');

        $piece = Piece::find($request->input('piece'));
        $piece->performances()->save($performance);

        $performance->save();

        $performance->halls()->attach($request->hall);

        return redirect()->route('performance.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Performance $performance
     * @return Factory|View
     */
    public function show(Performance $performance)
    {
        return view('performance.show', ['performance' => $performance]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Performance $performance
     * @return Factory|View
     */
    public function edit(Performance $performance)
    {
        return view('performance.edit', ['performance' => $performance, 'halls' => Hall::orderBy('name')->get(), 'pieces' => Piece::orderBy('name')->get()  ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Performance $performance
     * @return RedirectResponse
     */
    public function update(Request $request, Performance $performance)
    {
        $this->validate($request, [
            'date' => ['required', 'date'],
            'beginning' => ['required', 'date_format:G:i'],
            'end' => ['required', 'date_format:G:i', 'after:beginning'],
            'price' => ['required', 'integer', 'min:1'],
            'piece' => ['required'],
            'hall' => ['required']
        ]);

        if($request->date <  date("Y-m-d")){
            return redirect()->back()->withErrors(['Zadaný datum a čas musí být větši než aktuální']);
        }
        else if($request->date ==  date("Y-m-d")){
            if($request->beginning < date("G:i")){
                return redirect()->back()->withErrors(['Zadaný datum a čas musí být větši než aktuální']);
            }
        }

        foreach($request->input('hall') as $hall_id){
            $hall = Hall::find($hall_id);
            foreach($hall->performances as $perf){
                if($request->input('date') == $perf->date){
                    $beginning = date('G:i', strtotime($perf->beginning));
                    $end = date('G:i', strtotime($perf->end));

                    if( (( $request->input('beginning') >= $beginning) && ( $request->input('beginning') <= $end))
                        ||
                        (( $request->input('date') >= $beginning) && ( $request->input('date') <= $end))
                    )
                    {
                        return redirect()->back()->withErrors(['Sál '.$hall->name.' je již v dobu od '.$beginning.' do '.$end.' zabrán událostí s dílem '.$perf->piece->name]);
                    }
                }
            }
        }

        $performance->date = $request->input('date');
        $performance->beginning = $request->input('beginning');
        $performance->end = $request->input('end');
        $performance->price = $request->input('price');

        $piece = Piece::find($request->input('piece'));

        $piece->performances()->save($performance);
        $performance->save();

        $performance->halls()->sync($request->hall);

        return redirect()->route('performance.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Performance $performance
     * @return RedirectResponse
     */
    public function destroy(Performance $performance)
    {
        try {
            $performance->delete();
        } catch (Exception $exception) {
            return redirect()->back()->withErrors(['Při odstranění události došlo k chybě.']);
        }

        return redirect()->route('performance.index');
    }
}
