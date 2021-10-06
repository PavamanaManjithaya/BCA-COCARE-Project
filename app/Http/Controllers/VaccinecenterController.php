<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vaccinecenter;
use Illuminate\Support\Facades\Auth;

class VaccinecenterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vcenters = Vaccinecenter::all();
        return view('admin.vaccinecenter.view', compact('vcenters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.vaccinecenter.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Vaccinecenter::create($request->all());
        return redirect()->route('vaccinecenter.index');
        
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vcenter = Vaccinecenter::findOrFail($id);
        return view('admin.vaccinecenter.edit', compact('vcenter'));
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
        $vcenter=Vaccinecenter::find($id);
        $vcenter->update($request->all());
        return redirect()->route('vaccinecenter.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vcenter = Vaccinecenter::findOrFail($id);
        $vcenter->delete();
        return 1;
    }

    public function load_vaccine_recs($id)
    {
        if(Auth::user()->user_role == "District Admin")
        {
            $vcenter = Vaccinecenter::where('district_id',$id)->where('status','Active')->where('state_id',Auth::user()->state_id)->where('district_id',Auth::user()->district_id)->pluck('cvcname','id');
        }
        else
        {
            $vcenter = Vaccinecenter::where('district_id',$id)->where('status','Active')->pluck('cvcname','id');
        }
        return response()->json($vcenter);
    }
}
