<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\Beneficiaries;
use App\Models\Vprocess;
use App\Models\Schedule;
use App\Models\Idproof;
use App\Models\Stock;
use Illuminate\Support\Facades\Auth;
use Mail;
use DB;

class beneficiarycontroller extends Controller
{
    public function beneficiarycreateindex()
    {
        $data['BeneficiariesCount']  =  Beneficiaries::where('user_id', Auth::user()->id)->count();
        return view('frontend.beneficiary.create',compact('data'));
    }
    public function docverification(Request $request)
    {
        $chkdata =0;
        if($request->id_proof == "Aadhaar Card" )
        {
            $Beneficiariesrec  =  Beneficiaries::where('id_number', $request->id_number)->where('id_proof', "Aadhaar Card" )->where('user_id', Auth::user()->id )->count();
            if($Beneficiariesrec == 1)
            {
                $chkdata = 1;
            }
            else
            {
                $idproofs  = Idproof::where('adharcard', $request->id_number)
                ->where('gender',$request->gender)
                ->whereBetween('dob', [$request->birthyear ."-01-01" ,$request->birthyear .'-12-31'])
                ->get();
            }
        }
        else if($request->id_proof == "PAN Card" )
        {
            $Beneficiariesrec  =  Beneficiaries::where('id_number', $request->id_number)->where('id_proof', "PAN Card" )->where('user_id', Auth::user()->id )->count();
            if($Beneficiariesrec == 1)
            {
                $chkdata = 1;
            }
            else
            {
                $idproofs  = Idproof::where('pancard', $request->id_number)
                ->where('gender',$request->gender)
                ->whereBetween('dob', [$request->birthyear ."-01-01" ,$request->birthyear .'-12-31'])->get();
            }
        }
        if($chkdata == 1)
        {
            return 1;
        }
        else if(count($idproofs) == 0)
        {
            return 0;
        }
        else
        {
            return $idproofs;
        }
    }

    public function insertbeneficiaryctrl(Request $req)
    {
        $data = $req->all();
        $this->create($data);
        return 1;
    }
    public function create(array $arrdata)
    {
       $referenceid=0;
        $Beneficiariesrec  =  Beneficiaries::max('referenceid');
        if($Beneficiariesrec == "")
        {
            $referenceid =  10000000000001;
        }
        else
        {
            $referenceid = $Beneficiariesrec + 1;
        }
        return Beneficiaries::create([
            'referenceid' => $referenceid,
            'user_id' => Auth::user()->id,
            'id_proof' => $arrdata['id_proof'],
            'id_number' => $arrdata['id_number'],
            'name' => $arrdata['name'],
            'gender' => $arrdata['gender'],
            'dob' => $arrdata['dob'],
            'dose' => '0'
        ]);
    }
    public function beneficiaryviewrec()
    {
        //#############################################
        $data['Beneficiariesrec']  =  Beneficiaries::where('beneficiaries.user_id', Auth::user()->id)->get();
        //#############################################
        $data['BeneficiariesCount']  =  Beneficiaries::where('user_id', Auth::user()->id)->count();
        //#############################################
		return view('frontend.beneficiary.view',compact('data'));
    }
    public function verify_ben_data_ctrl(Request $request)
    {
        $dt = date("Y-m-d");
        $data['beneficiariesrec']  = schedule::select('schedules.*','beneficiaries.*','vaccinecenters.*','vaccinetypes.*','schedules.id as scheduleid','beneficiaries.id as beneficiariesid','vaccinecenters.id as vaccinecentersid','vaccinetypes.id as vaccinetypesid')->leftJoin('beneficiaries','beneficiaries.id','=','schedules.beneficiaries_id')->leftJoin('vaccinecenters','vaccinecenters.id','=','schedules.vaccinecenter_id')->leftJoin('vaccinetypes','vaccinetypes.id','=','schedules.vaccinetype_id')->where('beneficiaries.referenceid', $request->referenceid)->where('beneficiaries.id_proof', $request->id_proof)->where('beneficiaries.id_number', $request->id_number)->where('schedules.secretcode', $request->secretcode)->where('schedules.status', 'Active')->where('schedules.secretcode', $request->secretcode)->where('schedules.vaccinecenter_id', Auth::user()->vaccine_center_id)
        ->whereBetween('schedules.scheduletime', [$dt . " 00:00:00" ,$dt . " 23:59:59"])->get();
        if(count($data['beneficiariesrec']) == 1)
        {
           $vprocesses = Vprocess::where('beneficiaries_id', $data['beneficiariesrec'][0]['beneficiariesid'])
           ->where('beneficiaries_id', $data['beneficiariesrec'][0]['beneficiariesid'])
           ->where('vaccinecenter_id', $data['beneficiariesrec'][0]['vaccinecentersid'])
           ->whereBetween('vaccinedate', [$dt . " 00:00:00" ,$dt . " 23:59:59"])
           ->count();
           if($vprocesses >= 1)
           {
               return 1;
           }
           else
           {
            $data['scheduledate'] = date("d-m-Y",strtotime($data['beneficiariesrec'][0]['scheduletime']));
            $data['scheduletime'] = date("h:i A",strtotime($data['beneficiariesrec'][0]['scheduletime']));
            $data['starttime'] = date("h:i A",strtotime($data['beneficiariesrec'][0]['starttime']));
            $data['endtime'] = date("h:i A",strtotime($data['beneficiariesrec'][0]['endtime']));
            return $data;
           }
        }
        else
        {
            return 0;
        }
    }
    public function searchvcenter($id,$scheduleid)
    {
        $data['scheduleid']  = $scheduleid;
        $data['ben']  = Beneficiaries::where('id',$id)->get();
        return view('frontend/appointment/search',compact('data'));
    }
    public function searchvaccinecenterctrl()
    {
        return view('frontend.appointment.searchvaccinecenter');
    }
    public function delbenrec($id)
    {
        $Beneficiaries = Beneficiaries::findOrFail($id);
        $Beneficiaries->delete();
        return 1;
    }
    public function insertvprocesses_ctrl(Request $request)
    {
        $vprocess =  Vprocess::create($request->all());
        return redirect('vprocessreceipt/'.$vprocess->id)->with('message', 'Verification Done Successfully...');
    }
    public function vprocesses_receipt_ctrl($id)
    {
        $data['vprocess'] =  Vprocess::findOrFail($id);
        $vaccinedate = date("Y-m-d",strtotime($data['vprocess']->vaccinedate));
        $data['beneficiariesrec']  = schedule::select('schedules.*','beneficiaries.*','vaccinecenters.*','vaccinetypes.*','schedules.id as scheduleid','beneficiaries.id as beneficiariesid','vaccinecenters.id as vaccinecentersid','vaccinetypes.id as vaccinetypesid')->leftJoin('beneficiaries','beneficiaries.id','=','schedules.beneficiaries_id')->leftJoin('vaccinecenters','vaccinecenters.id','=','schedules.vaccinecenter_id')->leftJoin('vaccinetypes','vaccinetypes.id','=','schedules.vaccinetype_id')
        ->where('schedules.beneficiaries_id', $data['vprocess']->beneficiaries_id)
        ->whereBetween('schedules.scheduletime', [$vaccinedate . " 00:00:01" ,$vaccinedate . " 23:59:59"])
        ->where('schedules.vaccinecenter_id', $data['vprocess']->vaccinecenter_id)
        ->get();
        $data['scheduledate'] = date("d-m-Y",strtotime($data['beneficiariesrec'][0]['scheduletime']));
        $data['scheduletime'] = date("h:i A",strtotime($data['beneficiariesrec'][0]['scheduletime']));
        $data['starttime'] = date("h:i A",strtotime($data['beneficiariesrec'][0]['starttime']));
        $data['endtime'] = date("h:i A",strtotime($data['beneficiariesrec'][0]['endtime']));
        return view('admin.vprocess.vprocess_receipt',compact('data'));
    }    
}
