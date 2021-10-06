<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\District;
use Illuminate\Support\Facades\Auth;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $districts = District::all();
        return view('admin.district.view', compact('districts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		/*
		$staterec=$this->District->loadstatemodal();
		return json_encode($staterec);
		*/
        return view('admin.district.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        District::create($request->all());
        return redirect()->route('district.index');
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
		$district = District::findOrFail($id);
        return view('admin.district.edit', compact('district'));
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
	    $District=District::find($id);
        $District->update($request->all());
        return redirect()->route('district.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $District = District::findOrFail($id);
        $District->delete();
        return 1;
        //return redirect()->route('district.index')->with('success','Deleted successfully');
    }

    public function load_district_recs($id)
    {
        if(isset(Auth::user()->user_role))
        {
            if(Auth::user()->user_role == "District Admin")
            {
                $districts = District::where('id',Auth::user()->district_id)->where('status','Active')->pluck('district','id');
            }
            else
            {
                $districts = District::where('state_id',$id)->where('status','Active')->pluck('district','id');
            }
        }
        else
        {
            $districts = District::where('state_id',$id)->where('status','Active')->pluck('district','id');
        }
        return response()->json($districts);
    }

}
