<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Vaccinetype;
use App\Models\Vprocess;
use Log;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->user_role == "Admin")
        {
            $stocks = Stock::where('status','Admin2District')->get();
            return view('admin.stock.stkviewadmin', compact('stocks'));
        }
        elseif(Auth::user()->user_role == "District Admin")
        {
            $stocks = Stock::where('status','Admin2District')->where('district_id',Auth::user()->district_id)->get();
            return view('admin.stock.stkviewdistadmin', compact('stocks'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.stock.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        Stock::create($request->all());
        return redirect()->route('stock.index');
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
        $stock = Stock::findOrFail($id);
        return view('admin.stock.edit', compact('stock'));
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
        $stock=Stock::find($id);
        $stock->update($request->all());
        return redirect()->route('stock.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $stock = Stock::findOrFail($id);
        $stock->delete();
        return 1;
    }
    public function stockallotmentpanelctrl($id)
    {
        $data['vtype'] = Vaccinetype::where('status','Active')->where('id',$id)->get();
        return view('admin.stock.stockallotmentpanel', compact('data'));
    }

    public function stockallotmentinsertctrl(Request $req)
    {
        $countstockexists = Stock::where('vaccinecenter_id',$req->vaccinecenter_id)
        ->where('vaccinetype_id',$req->vaccinetype_id)
        ->where('date',$req->date)
        ->where('sage',$req->sage)
        ->where('eage',$req->eage)
        ->where('dose',$req->dose)
        ->count();
        if($countstockexists == 0)
        {
            $insdata = $req->all();
            $this->createrec($insdata);
            $data['vtype'] = Vaccinetype::where('status','Active')->where('id',$req->vaccinetype_id)->get();
            return redirect('stockallotment/'.$req->vaccinetype_id)->with('message', 'Stock Allotment Entry done successfully...');
        }
        else
        {
            return redirect('stockallotment/'.$req->vaccinetype_id)->with('errmessage', 'Record already exists...');
        }
    }

    public function createrec(array $arrdata)
    {
        return Stock::create([
            'user_id' => Auth::user()->id,
            'district_id' => $arrdata['district_id'],
            'vaccinecenter_id' => $arrdata['vaccinecenter_id'],
            'vaccinetype_id' => $arrdata['vaccinetype_id'],
            'stock_id' => $arrdata['stock_id'],
            'date' => $arrdata['date'],
            'qty' => $arrdata['qty']+$arrdata['rem'],
            'sage' => $arrdata['sage'],
            'eage' => $arrdata['eage'],
            'dose' => $arrdata['dose'],
            'status' => $arrdata['status'],
        ]);
    }
    public function stockallotmentdeletectrl($id)
    {
        $stock = Stock::findOrFail($id);
        $stock->delete();
        return 1;
    }
    public function stockbalancectrl()
    {
        $data['vtype'] = Vaccinetype::where('status','Active')->get();
        return view('admin.stock.stockbalancereport', compact('data'));   
    }
    public function load_previous_stockctrl($vtypeid,$vaccinecenter_id)
    {
        $dt = date("Y-m-d");
        $dttim = date("Y-m-d 00:00:00");
        $tim= date("Y-m-d  h:i:s");
        $wastetime= Stock::where('vaccinecenter_id',$vaccinecenter_id)->where('vaccinetype_id',$vtypeid)->where('date',$dt)->where('status','wastage')->get();

        $stk_tot = Stock::where('vaccinecenter_id',$vaccinecenter_id)->where('vaccinetype_id',$vtypeid)->where('date',$dt)->where('status','DistAdmin2Vcenter')->sum('qty');
        $waste = Stock::where('vaccinecenter_id',$vaccinecenter_id)->where('vaccinetype_id',$vtypeid)->where('date',$dt)->where('status','wastage')->sum('qty');
        $stk_processed = Vprocess::leftJoin('schedules','schedules.id','=','vprocesses.schedules_id')->where('vprocesses.vaccinecenter_id',$vaccinecenter_id)->where('schedules.vaccinetype_id',$vtypeid)->where('vprocesses.vaccinedate','>=',$dttim)->count();
        if(count($wastetime)>0){
            if( Stock::where('vaccinecenter_id',$vaccinecenter_id)->where('vaccinetype_id',$vtypeid)->where('created_at','>',$wastetime[0]->created_at)->where('status','DistAdmin2Vcenter')->where('date','>=',$dt)->first())
            {
                return 0;
            }
            else{
                return $stk_tot - $stk_processed-$waste;
              }
    }
        else{
            return $stk_tot - $stk_processed-$waste;
        }

        
    }
    public function stockallotmentrptctrl()
    {
        $stocks = Stock::select('stocks.*','users.*','vaccinecenters.*','vaccinetypes.*','stocks.id as stockid')->leftJoin('users','stocks.user_id','=','users.id')
        ->leftJoin('vaccinecenters','stocks.vaccinecenter_id','=','vaccinecenters.id')
        ->leftJoin('vaccinetypes','stocks.vaccinetype_id','=','vaccinetypes.id')
        ->where('stocks.status','DistAdmin2Vcenter')->get();
        return view('admin.stock.stkallotmentrpt', compact('stocks'));
    }
    public function stockwastageview()
    {

        $stocks = Stock::select('stocks.*','users.*','vaccinecenters.*','vaccinetypes.*','stocks.id as stockid')->leftJoin('users','stocks.user_id','=','users.id')
        ->leftJoin('vaccinecenters','stocks.vaccinecenter_id','=','vaccinecenters.id')
        ->leftJoin('vaccinetypes','stocks.vaccinetype_id','=','vaccinetypes.id')
        ->where('stocks.status','wastage')
        ->orderBy('stocks.date', 'ASC')->get();
        return view('admin.stock.wastageview', compact('stocks'));
    }
    /////////////vaccinator dashboard///////////////
    
}
