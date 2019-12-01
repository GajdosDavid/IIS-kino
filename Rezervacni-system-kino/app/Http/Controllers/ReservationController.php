<?php

namespace App\Http\Controllers;

use App\Hall;
use App\Performance;
use App\piece;
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
        $user = User::get();
        $performance = Performance::get();
        $piece = Piece::get();
        $hall = Hall::get();
        return view('reservation.index', [
            'reservations' => reservation::orderBy('created_at')->get(),
            'performances' => $performance,
            'users' => $user,
            'halls' => $hall,
            'pieces' => $piece
        ] );

    }

    public function myReservations()
    {
        if(Auth::guest()){
            return redirect('/');
        }

        $performance = Performance::get();
        $hall = Hall::get();
        $user = User::find(Auth::guard('web')->User()->id);

        return view('reservation.myReservations', [
            'reservations' => reservation::where('user_id', $user->id)->orderBy('created_at')->get(),
            'performances' => $performance,
            'halls' => $hall
        ] );
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
        if($request->first_name){
            $this->validate($request, [
                'seats' => ['required', 'array', 'max:10'],
                'hall_id' => ['required'],
                'performance_id' => ['required'],
                'first_name' => ['required', 'min:1', 'max:30'],
                'surname' => ['required', 'min:1', 'max:30'],
                'phone' => ['nullable', 'min:4', 'max:20'],
                'email' => ['required', 'email', 'unique:users'],
            ]);

            $reservation = new Reservation();
            $reservation->first_name = $request->input('first_name');
            $reservation->surname = $request->input('surname');
            $reservation->phone = $request->input('phone');
            $reservation->email = $request->input('email');
        }
        else{
            $this->validate($request, [
                'seats' => ['required'],
                'user_id' => ['required'],
                'hall_id' => ['required'],
                'performance_id' => ['required']
            ]);

            $reservation = new Reservation();
            $user = User::find($request->input('user_id'));
            $reservation->user()->associate($user);
        }

        $reservation->seats = $request->input('seats');

        $performance = Performance::find($request->input('performance_id'));
        $reservation->performance()->associate($performance);

        $hall = Hall::find($request->input('hall_id'));
        $reservation->hall()->associate($hall);

        $reservation->save();

        return redirect('/');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function createOnPerformance($performance_id, $hall_id)
    {
        $performance = Performance::find($performance_id);
        $hall = Hall::find($hall_id);

        $existingReservations = Reservation::where([
                            ['hall_id', $hall->id],
                            ['performance_id', $performance->id],
                        ])->get();

        $reservedSeats = array();

        foreach( $existingReservations as $existingReservation){
            $reservedSeats = array_merge($reservedSeats, $existingReservation->seats);
        }

        if(Auth::guest()){
            return view('reservation.create',[
                'reservations' => reservation::orderBy('created_at')->get(),
                'performance' => $performance,
                'hall' => $hall,
                'reservedSeats' => $reservedSeats
            ]);
        }
        else{
            $user = User::find(Auth::guard('web')->User()->id);

            return view('reservation.create',[
                'reservations' => reservation::orderBy('created_at')->get(),
                'performance' => $performance,
                'user' => $user,
                'hall' => $hall,
                'reservedSeats' => $reservedSeats
            ]);
        }
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
        $performance = Performance::find($reservation->performance->id);
        $hall = Hall::find($reservation->hall->id);

        $existingReservations = Reservation::where([
            ['hall_id', $hall->id],
            ['performance_id', $performance->id],
        ])->get();

        $reservedSeats = array();

        foreach( $existingReservations as $existingReservation){
            $reservedSeats = array_merge($reservedSeats, $existingReservation->seats);
        }

        return view('reservation.edit', ['reservation' => $reservation, 'reservedSeats' => $reservedSeats]);
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
            'seats' => ['required', 'array', 'max:10']
        ]);

        $reservation->update(['seats' => $request->input('seats')]);

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

    public function pay(Request $request, Reservation $reservation)
    {
        $reservation->update(['is_paid' => '1']);

        return redirect()->back();
    }
}
