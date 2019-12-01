<?php

namespace App\Http\Controllers;

use App\Performance;
use File;
use Exception;
use App\Piece;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PieceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('piece.index', ['pieces' => Piece::orderBy('name')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('piece.create');
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
            'name' => ['required', 'min:1', 'max:300'],
            'type' => ['nullable', 'min:1', 'max:50'],
            'description' => ['nullable', 'min:1', 'max:10000'],
            'genre' => ['nullable', 'min:1', 'max:500'],
            'performer' => ['nullable', 'min:1', 'max:500'],
            'image' => ['required', 'image', 'max:5000']
        ]);

        $piece = new Piece();
        $piece->name = $request->input('name');
        $piece->type = $request->input('type');
        $piece->description = $request->input('description');
        $piece->genre = $request->input('genre');
        $piece->performer = $request->input('performer');

        $piece->image = $imageName = time().'.'.request()->image->getClientOriginalExtension();
        request()->image->move(public_path('/img'), $imageName);

        $piece->save();

        return redirect()->route('piece.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Piece $piece
     * @return Factory|View
     */
    public function show(Piece $piece)
    {
        $performance = Performance::where('piece_id', $piece->id)->orderBy('beginning')->orderBy('date')->get();

        return view('piece.show', ['piece' => $piece, 'performances' => $performance]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Piece $piece
     * @return Factory|View
     */
    public function edit(piece $piece)
    {
        return view('piece.edit', ['piece' => $piece ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Piece $piece
     * @return RedirectResponse
     */
    public function update(Request $request, Piece $piece)
    {
        $this->validate($request, [
            'name' => ['required', 'min:1', 'max:300'],
            'type' => ['nullable', 'min:1', 'max:50'],
            'description' => ['nullable', 'min:1', 'max:10000'],
            'genre' => ['nullable', 'min:1', 'max:500'],
            'performer' => ['nullable', 'min:1', 'max:500'],
            'image' => [ 'image', 'max:5000'],
        ]);

        $piece->name = $request->input('name');
        $piece->type = $request->input('type');
        $piece->description = $request->input('description');
        $piece->genre = $request->input('genre');
        $piece->performer = $request->input('performer');

        if ($request->image){
            File::delete(public_path('/img/'.$piece->image));
            $piece->image = $imageName = time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('/img'), $imageName);
        }

        $piece->save();

        return redirect()->route('piece.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Piece $piece
     * @return RedirectResponse
     */
    public function destroy(Piece $piece)
    {
        try {
            $piece->delete();
        } catch (Exception $exception) {
            return redirect()->back()->withErrors(['Při odstranění události došlo k chybě.']);
        }

        File::delete(public_path('/img/'.$piece->image));

        return redirect()->route('piece.index');
    }
}
