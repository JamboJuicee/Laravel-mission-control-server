<?php

namespace App\Http\Controllers;

use App\Mail\MissionReport;
use App\Models\Astronaut;
use App\Models\Destination;
use App\Models\Mission;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class MissionController extends Controller
{
    public function getAstronauts() {
        return ["data" => Astronaut::all()];
    }

    public function getDestinations() {
        return ["data" => Destination::all()];
    }

    public function executeMission(Request $request) {
        $validator = Validator::make($request -> all(), $this -> buildRules());

        if ($validator -> fails()) {
            return response() -> json(["errors" => $validator -> errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $mission = new Mission($validator -> validated());
        $astronaut_ids = $validator -> validated()["astronaut_ids"];

        $strength = $this -> calculateMissionStrength($astronaut_ids);

        $mission -> success = $strength >= $mission -> destination -> distance;
    
        $mission -> report = $this -> buildReport($mission, $astronaut_ids);
        
        $mission -> save();

        $this -> sendMail($mission);

        return $mission;
    }

    public function sendMail($mission) {
        $report = new MissionReport($mission);
        Mail::to($mission -> captain) -> send($report);
    }

    public function buildReport($mission, $astronaut_ids) {
        if ($mission -> success) {
            return "Mission to " . $mission -> destination -> name . " was a success thanks to the power of the astronauts "
                . $this -> getAstronautNames($astronaut_ids);
        } else {
            return "Mission to " . $mission -> destination -> name . " was a failure due to poor performance of the astronauts "
                . $this -> getAstronautNames($astronaut_ids);
        }
    }

    public function getAstronautNames($astronaut_ids) {
        $names = [];

        foreach ($astronaut_ids as $astronaut_id) {
            $astronaut = Astronaut::find($astronaut_id);

            $names[] = $astronaut -> name;
        }

        return join(",", $names);
    }

    public function calculateMissionStrength($astronaut_ids) {
        $strength = 0;

        foreach ($astronaut_ids as $astronaut_id) {
            $astronaut = Astronaut::find($astronaut_id);

            $strength += $astronaut -> endurance * 1.5 + $astronaut -> skill;
        }

        return $strength;
    }

    public function buildRules() {
        return [
            "captain" => "email|required|max:255",
            "destination_id" => "uuid|required|exists:destinations,id",
            "astronaut_ids" => "array|required"
        ];
    }

}
