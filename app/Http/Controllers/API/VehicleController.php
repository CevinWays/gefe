<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Vehicle;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VehicleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Vehicle::latest()->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string|max:191',
            'number' => 'required|string|max:191',
            'type' => 'required',
        ]);

        $id = Auth::id();
        // $id = auth('api')->user();

        return Vehicle::create([
            'user_id' => $id,
            'name' => $request['name'],
            'number' => $request['number'],
            'type' => $request['type'],
        ]);

        // return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $vehicle = Vehicle::findOrFail($id);

        $this->validate($request,[
            'name' => 'required|string|max:191',
            'number' => 'required|string|max:191',
            'type' => 'required',
        ]);

        $vehicle->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vehicle = Vehicle::findOrFail($id);

        $vehicle->delete();

        return ['message'=>'Vehicle deleted'];
    }

    public function vehicle(){

        $user = auth('api')->user();
        $vehicle = Vehicle::where('user_id',$user->id)->get();

        return $vehicle;
    }
}
