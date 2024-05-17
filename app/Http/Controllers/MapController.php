<?php

namespace App\Http\Controllers;

use App\Models\Places_of_Interest;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function index()
    {
        $pointsOfInterest = Places_of_Interest::all();
        return view('index', compact('pointsOfInterest'));
    }

    public function editPoint(Request $request, $id)
    {
        $point = Places_of_Interest::find($id);
        if ($point) {
            $point->title = $request->title;
            $point->description = $request->description;
            $point->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }

    public function deletePoint($id)
    {
        $point = Places_of_Interest::find($id);
        if ($point) {
            $point->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }
}
