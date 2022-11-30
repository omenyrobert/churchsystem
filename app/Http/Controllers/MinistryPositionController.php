<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ChurchPositions;
use App\Models\MinistryTypes;

class MinistryPositionController extends Controller
{
    public function ministry_positions()
    {
        $positions = ChurchPositions::all();
        $ministries = MinistryTypes::all();
        $ministry_positions = [
            "positions" => $positions,
            "ministries" => $ministries
        ];
        return json_encode($ministry_positions);
    }

}
