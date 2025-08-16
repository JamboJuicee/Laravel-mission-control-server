<?php

namespace App\Http\Controllers;

use App\Models\Astronaut;
use App\Models\Destination;
use App\Models\Mission;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MissionController extends Controller
{
    public function getAstronauts() {
        return ["data" => Astronaut::all()];
    }

    public function getDestinations() {
        return ["data" => Destination::all()];
    }
    
}
