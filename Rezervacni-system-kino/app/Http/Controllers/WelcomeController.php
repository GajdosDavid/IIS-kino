<?php

namespace App\Http\Controllers;

use App\Performance;
use App\Piece;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WelcomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return Factory|View
     */
    public function __invoke(Request $request)
    {
        $piecesWithPerformance = collect();

        $pieces =  Piece::all();
        foreach($pieces as $piece){
            if(Performance::where('piece_id', $piece->id)->count() > 0){
                $piecesWithPerformance->add($piece);
            }
        }

        return view('welcome', ['pieces' => $piecesWithPerformance]);
    }
}
