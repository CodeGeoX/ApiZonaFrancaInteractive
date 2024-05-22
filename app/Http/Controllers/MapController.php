<?php

namespace App\Http\Controllers;

use App\Models\Places_of_Interest;
use Illuminate\Http\Request;


class MapController extends Controller
{
    public function index()
{
    $pointsOfInterest = Places_of_Interest::all();
    \Log::info($pointsOfInterest);
    return view('index', compact('pointsOfInterest'));
}

}
