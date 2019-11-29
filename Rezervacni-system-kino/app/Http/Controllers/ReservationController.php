<?php

namespace App\Http\Controllers;

use App\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('reservation.index', ['reservations' => reservation::orderBy('date')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('reservation.create');
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
            'date' => ['required', 'date'],
            'seats' => ['required']
        ]);

        //TODO: FOREING KEYS
        $reservation = new Reservation();
        $reservation->date = $request->input('date');
        $reservation->seats = $request->input('seats');
        $reservation->userId = 1;
        $reservation->hallId = 1;
        $reservation->performanceId = 1;
        $reservation->save();

        return redirect()->route('reservation.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Reservation $reservation)
    {
        return view('reservation.show', ['reservation' => $reservation]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Reservation $reservation)
    {
        return view('reservation.edit', ['reservation' => $reservation]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Reservation $reservation)
    {

        $this->validate($request, [
            'date' => ['required', 'date'],
            'seats' => ['required']
        ]);

        //TODO: FOREING KEYS
        $reservation->date = $request->input('date');
        $reservation->seats = $request->input('seats');
        $reservation->userId = 1;
        $reservation->hallId = 1;
        $reservation->performanceId = 1;
        $reservation->save();

        return redirect()->route('reservation.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Reservation $reservation)
    {
        try {
            $reservation->delete();
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors(['Při odstranění rezervace došlo k chybě.']);
        }

        return redirect()->route('reservation.index');
    }
}
