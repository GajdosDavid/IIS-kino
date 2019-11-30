<?php

namespace App\Http\Controllers;

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
        return view('welcome', ['pieces' => Piece::all()]);
    }
}
