<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vaccinetype;

class VaccinetypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vtypes = Vaccinetype::all();
        return view('admin.vaccinetypes.view', compact('vtypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.vaccinetypes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Vaccinetype::create($request->all());
        return redirect()->route('vaccinetype.index');
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
        $vtype = Vaccinetype::findOrFail($id);
        return view('admin.vaccinetypes.edit', compact('vtype'));
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
        $vaccinetype=Vaccinetype::find($id);
        $vaccinetype->update($request->all());
        return redirect()->route('vaccinetype.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vtype = Vaccinetype::findOrFail($id);
        $vtype->delete();
        return 1;
    }
}
