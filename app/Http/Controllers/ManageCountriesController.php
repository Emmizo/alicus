<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use Response;
use Redirect;
use App\Models\{Country, State, City};
class ManageCountriesController extends Controller
{
    //*******************THE FUNCTION FOR FETCHING STATES******************/
    public function fetchState(Request $request)
    {
        $data['states'] = State::where("country_id",$request->country_id)->get(["name", "id"]);
        return response()->json($data);
    }

    //*******************THE FUNCTION FOR FETCHING CITIES OF THE STATE******************/
    public function fetchCity(Request $request)
    {
        $data['cities'] = City::where("state_id",$request->state_id)->get(["name", "id"]);
        return response()->json($data);
    }
}
