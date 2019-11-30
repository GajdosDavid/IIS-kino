<?php

namespace App\Http\Controllers;

use App\Performance;
use App\Reservation;
use App\User;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('reservation.index', ['reservations' => reservation::orderBy('date')->get()]);
    }

    public function myReservations()
    {
        $performance = Performance::get();
        $user = User::find(Auth::guard('web')->User()->id);
        return view('reservation.myReservations', [ 'reservations' => reservation::where('userId', $user->id)->orderBy('date')->get(), 'performances' => $performance] );
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('reservation.create');
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
     * @param Reservation $reservation
     * @return Factory|View
     */
    public function show(Reservation $reservation)
    {
        return view('reservation.show', ['reservation' => $reservation]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Reservation $reservation
     * @return Factory|View
     */
    public function edit(Reservation $reservation)
    {
        return view('reservation.edit', ['reservation' => $reservation]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Reservation $reservation
     * @return RedirectResponse
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
     * @param Reservation $reservation
     * @return RedirectResponse
     */
    public function destroy(Reservation $reservation)
    {
        try {
            $reservation->delete();
        } catch (Exception $exception) {
            return redirect()->back()->withErrors(['Při odstranění rezervace došlo k chybě.']);
        }

        return redirect()->route('reservation.index');
    }
}
