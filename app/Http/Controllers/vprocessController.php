<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Hash;
use Session;
use App\Models\Schedule;
use App\Models\Beneficiaries;
use App\Models\District;
use App\Models\Stock;
use App\Models\Vaccinecenter;
use App\Models\Vaccinetype;
use App\Models\User;
use App\Models\Vprocess;
use App\Models\State;
use App\Models\Idproof;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use DateTime;
use DatePeriod;
use DateInterval;
use Mail;
use DB;
use PDF;

class vprocessController extends Controller
{
    public function loadvprocessctrl()
    {
        return view('admin.vprocess.vprocessvaccinator');
    }
    public function loaddatavprocess_ctrl($id)
    {
        $dt = date("Y-m-d");
        $data['bendata'] = Beneficiaries::where('referenceid',$id)->get();
        if(count($data['bendata']) == 0)
        {
            return 0;
        }
        else
        {
            $vprocesses = Vprocess::where('beneficiaries_id', $data['bendata'][0]['id'])
            ->where('vaccinecenter_id', Auth::user()->vaccine_center_id)
            ->where('vaccinator_id', 0)
            ->where('vaccinatorstatus', 0)
            ->get();
            if(count($vprocesses) == 0)
            {
                return 1;
            }
            else
            {
                if($data['bendata'][0]['dose'] == 0)
                {
                    $doseid = 1;
                }
                else if($data['bendata'][0]['dose'] == 1)
                {
                    $doseid = 2;
                }
                $data['vprocesses_id'] = $vprocesses[0]['id'];
                $data['beneficiariesrec']  = schedule::select('schedules.*','beneficiaries.*','vaccinecenters.*','vaccinetypes.*','schedules.id as scheduleid','beneficiaries.id as beneficiariesid','vaccinecenters.id as vaccinecentersid','vaccinetypes.id as vaccinetypesid')->leftJoin('beneficiaries','beneficiaries.id','=','schedules.beneficiaries_id')->leftJoin('vaccinecenters','vaccinecenters.id','=','schedules.vaccinecenter_id')->leftJoin('vaccinetypes','vaccinetypes.id','=','schedules.vaccinetype_id')
                ->where('beneficiaries.referenceid', $id)
                ->where('schedules.beneficiaries_id', $data['bendata'][0]['id'])
                ->where('schedules.status', 'Active')
                ->where('schedules.doseno', $doseid)
                ->where('schedules.vaccinecenter_id', Auth::user()->vaccine_center_id)
                ->get();
                if(count($data['beneficiariesrec']) == 1)
                {
                    $data['scheduledate'] = date("d-m-Y",strtotime($data['beneficiariesrec'][0]['scheduletime']));
                    $data['scheduletime'] = date("h:i A",strtotime($data['beneficiariesrec'][0]['scheduletime']));
                    $data['starttime'] = date("h:i A",strtotime($data['beneficiariesrec'][0]['starttime']));
                    $data['endtime'] = date("h:i A",strtotime($data['beneficiariesrec'][0]['endtime']));
                    return $data;
                }
                else
                {
                  return 0;
                }
                return $data;
            }
        }
    }
    public function ins_vac_data_ctrl(Request $request)
    {
        $upd_vac_data = Vprocess::where('id', $request->vprocesses_id)->update(array('vaccinator_id' => $request->vaccinator_id,'vaccinatorstatus' => $request->vaccinatorstatus));
        $upd_ben_data = Beneficiaries::where('id', $request->beneficiaries_id)->update(array('dose' => $request->dose));
        //################ Coding for Mail Starts Here
        $data['rsvprocessrec'] = Vprocess::select('vprocesses.*','schedules.*','vaccinecenters.*','vaccinetypes.*','beneficiaries.*','vaccinecenters.state_id as stid','vaccinecenters.district_id as disid')->leftjoin('schedules','schedules.id','=','vprocesses.schedules_id')->leftjoin('vaccinecenters','vaccinecenters.id','=','schedules.vaccinecenter_id')->leftjoin('vaccinetypes','vaccinetypes.id','=','schedules.vaccinetype_id')->leftjoin('beneficiaries','beneficiaries.id','=','schedules.beneficiaries_id')->where('vprocesses.id',$request->vprocesses_id)->where('schedules.status','Active')->get();
        $data['vaccinatorrec'] = User::where('users.id',$data['rsvprocessrec'][0]['vaccinator_id'])->get();
        $data['staterec'] = State::where('states.id',$data['rsvprocessrec'][0]['stid'])->get();
        $data['districtrec'] = District::where('districts.id',$data['rsvprocessrec'][0]['disid'])->get();
        if($data['rsvprocessrec'][0]['id_proof'] == "Aadhaar Card")
        {
            $data['idproofsrec'] = Idproof::where('adharcard',$data['rsvprocessrec'][0]['id_number'])->get();
        }
        if($data['rsvprocessrec'][0]['id_proof'] == "PAN Card")
        {
            $data['idproofsrec'] = Idproof::where('pancard',$data['rsvprocessrec'][0]['id_number'])->get();
        }
        $request['emailid'] = $data['idproofsrec'][0]['email'];
        $request['name']=$data['idproofsrec'][0]['name'];
        //@@@@@@@@@@@@@@@@@
        \Mail::send('frontend.layouts.emailcertificate', array(
            'data' => $data
        ),
            function ($message) use ($request) {
                $message->from("cocareproject@gmail.com");
                $message->to($request->emailid, $request->name)->subject("COCARE Vaccination Certificate..");
            }
        );
        ################ Coding for mail Ends Here
        return redirect('/vaccinationprocess')->with('message','Vaccination Process Completed Successfully..');
    }
    public function cocare_certificate_ctrl($id)
    {
        $data['id'] = $id;
        $data['rsvprocessrec'] = Vprocess::select('vprocesses.*','schedules.*','vaccinecenters.*','vaccinetypes.*','beneficiaries.*','vaccinecenters.state_id as stid','vaccinecenters.district_id as disid')->leftjoin('schedules','schedules.id','=','vprocesses.schedules_id')->leftjoin('vaccinecenters','vaccinecenters.id','=','schedules.vaccinecenter_id')->leftjoin('vaccinetypes','vaccinetypes.id','=','schedules.vaccinetype_id')->leftjoin('beneficiaries','beneficiaries.id','=','schedules.beneficiaries_id')->where('vprocesses.id',$id)->where('schedules.status','Active')->get();
        $data['vaccinatorrec'] = User::where('users.id',$data['rsvprocessrec'][0]['vaccinator_id'])->get();
        $data['staterec'] = State::where('states.id',$data['rsvprocessrec'][0]['stid'])->get();
        $data['districtrec'] = District::where('districts.id',$data['rsvprocessrec'][0]['disid'])->get();
        return view('frontend.beneficiary.cocarecertifications',compact('data'));
    }

    public function cocarecertificatepdfctrl($id)
    {
        $data['rsvprocessrec'] = Vprocess::select('vprocesses.*','schedules.*','vaccinecenters.*','vaccinetypes.*','beneficiaries.*','vaccinecenters.state_id as stid','vaccinecenters.district_id as disid')->leftjoin('schedules','schedules.id','=','vprocesses.schedules_id')
        ->leftjoin('vaccinecenters','vaccinecenters.id','=','schedules.vaccinecenter_id')
        ->leftjoin('vaccinetypes','vaccinetypes.id','=','schedules.vaccinetype_id')
        ->leftjoin('beneficiaries','beneficiaries.id','=','schedules.beneficiaries_id')
        ->where('vprocesses.id',$id)->where('schedules.status','Active')->get();
        $data['vaccinatorrec'] = User::where('users.id',$data['rsvprocessrec'][0]['vaccinator_id'])->get();
        $data['staterec'] = State::where('states.id',$data['rsvprocessrec'][0]['stid'])->get();
        $data['districtrec'] = District::where('districts.id',$data['rsvprocessrec'][0]['disid'])->get();
        //#######################################
        //PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        $pdf = PDF::loadView('frontend.beneficiary.cocarecertificationpdf',compact('data'));
        return $pdf->download('cocarecertification.pdf');
        //return view('frontend.appointment.appointmentreceiptpdf',compact('data'));
    }

    public function offlineidproof_ctrl(Request $request)
    {
        $data['id_proof'] = $request->id_proof;
        $data['id_number'] = $request->id_number;
        if($request->id_proof == "Aadhaar Card")
        {
            $data['idproofs'] = Idproof::where('adharcard',$request->id_number)->get();
        }
        if($request->id_proof == "PAN Card")
        {
            $data['idproofs'] = Idproof::where('pancard',$request->id_number)->get();
        }
        $data['beneficiaries'] = Beneficiaries::where('id_proof',$request->id_proof)->where('id_number',$request->id_number)->get();
        if(count($data['beneficiaries']) == 0)
        {
            $data['dosecount'] = 0;
        }
        else if( ($data['beneficiaries'][0]->dose)==0){
            $data['dosecount'] = 0;
        }
        else
        {
            $data['dosecount'] = $data['beneficiaries'][0]->dose;
            $schedule= Schedule::where('beneficiaries_id',$data['beneficiaries'][0]->id)->get();
            $data['vtypeid']=$schedule[0]->vaccinetype_id;
            foreach (Vaccinetype::where('status','Active')->get() as $type) {
                if($type->id==$data['vtypeid']){
                    $data['vtype']=$type->vname;
                }
            }
            
        $dt = date("Y-m-d");
        $birthday = new DateTime($data['idproofs'][0]->dob);
        $interval = $birthday->diff(new DateTime);
        $benage = $interval->y;
         $totalstocks= Stock::select('stocks.*')->where('stocks.status','DistAdmin2Vcenter')->where('stocks.vaccinecenter_id',Auth::user()->vaccine_center_id)->where('stocks.vaccinetype_id',$data['vtypeid'])->where('dose',$data['dosecount']+1)->where('stocks.date',$dt)->where('stocks.sage','<=',$benage)->where('stocks.eage','>=',$benage)->sum('stocks.qty');
        $stk_processed = Vprocess::leftJoin('schedules','schedules.id','=','vprocesses.schedules_id')->where('vprocesses.vaccinecenter_id',Auth::user()->vaccine_center_id)->where('schedules.vaccinetype_id',$data['vtypeid'])->where('vprocesses.vaccinedate',$dt)->count();
        $sche= Schedule::select('schedules.*')->where('schedules.vaccinecenter_id',Auth::user()->vaccine_center_id)->where('schedules.vaccinetype_id',$data['vtypeid'])->WHERE('bookingdate',$dt)->where('doseno',$data['dosecount']+1)->where('status','Active')->count();
       $data['qty']= $totalstocks-$stk_processed- $sche;
            

        }
        if(count($data['idproofs']) == 0)
        {
            return 0;
        }
        else
        {
            return $data;
        }
    }

    public function vaccine_count_ctrl(Request $request)
    {
        $dt = date("Y-m-d");
        $birthday = new DateTime($request->dob);
        $interval = $birthday->diff(new DateTime);
        $benage = $interval->y;
                $data['totalstocks'] = Stock::select('stocks.*')->where('stocks.status','DistAdmin2Vcenter')->where('stocks.vaccinecenter_id',Auth::user()->vaccine_center_id)->where('stocks.vaccinetype_id',$request->vaccinetype_id)->where('stocks.date',$dt)->where('stocks.sage','<=',$benage)->where('stocks.eage','>=',$benage)->where('dose',$request->dose)->sum('stocks.qty');
        $data['stk_processed'] = Vprocess::leftJoin('schedules','schedules.id','=','vprocesses.schedules_id')->where('vprocesses.vaccinecenter_id',Auth::user()->vaccine_center_id)->where('schedules.vaccinetype_id',$request->vaccinetype_id)->where('vprocesses.vaccinedate',$dt)->count();
        $data['schedule'] = Schedule::select('schedules.*')->where('schedules.vaccinecenter_id',Auth::user()->vaccine_center_id)->where('schedules.vaccinetype_id',$request->vaccinetype_id)->WHERE('bookingdate',$dt)->where('doseno',$request->dose)->where('status','Active')->count();
       return $data['totalstocks'] - $data['stk_processed']- $data['schedule'];
    }

    public function load_otp_num_ctrl(Request $request)
    {
        $useremail = $request->email;
        $usersname = $request->name;
        $request->useremail = $useremail;
        $request->name = $usersname;
        $randomno = rand(100000, 999999);
        session(['otpcode' => $randomno]);
        \Mail::send('frontend.layouts.emailtemplate', array(
            'name' => $usersname,
            'otp' => $randomno,
        ),
            function ($message) use ($request) {
                $message->from("cocareproject@gmail.com");
                $message->to($request->email, $request->name)->subject("COCARE OTP Verification Mail for Vaccination..");
            }
        );
        return $randomno;
    }

    public function insertofflineappt_ctrl(Request $request)
    {
        $amount="FREE";
        $vcenter=Vaccinecenter::where('id',Auth::user()->vaccine_center_id)->get();
        $vtype=Vaccinetype::where('id',$request->vaccinetype_id)->get();
        if($vcenter[0]->category=="Paid"){
             $amount=$vtype[0]->cost;
        }
        $dt = date("Y-m-d");
        $scheduletime = date("Y-m-d H:00:00");
       if(Beneficiaries::max('referenceid')=="") 
           $benmax  = 10000000000001;
        else
             $benmax  =  Beneficiaries::max('referenceid') +1;
        $scret=substr(crc32($benmax), -4);
        $user=User::where('email',$request->email)->get();
        if(count($user) ==0){
           $data = array('state_id' => 0, 'district_id' => 0, 'vaccine_center_id' => 0, 'user_role' => 'User', 'name' => $request->name,
            'mob_no' => '', 'email' => $request->email, 'password' => '', 'status' => 'Active');
            $user=User::create($data);
            $user=User::where('email',$request->email)->get();
        }
        $insben = Beneficiaries::where('id_proof',$request->id_proof)->where('id_number',$request->id_number)->get();
        if(count($insben) ==0)
        {
        $insben =  Beneficiaries::create(array_merge($request->all(), ['referenceid' => $benmax,'user_id'=>$user[0]->id,'dose'=>$request->dose-1]));
        $insben = Beneficiaries::where('id_proof',$request->id_proof)->where('id_number',$request->id_number)->get();
        }
        $schedule =  Schedule::create(array_merge($request->all(), ['beneficiaries_id' => $insben[0]->id,'bookingdate' => $dt,'scheduletime' => $scheduletime,'user_id'=>$user[0]->id,'doseno' => $request->dose,'status' => 'Active','secretcode'=>$scret]));
        $vprocess =  Vprocess::create(array_merge($request->all(), ['beneficiaries_id' => $insben[0]->id,'schedules_id' => $schedule->id,'amount'=>$amount]));
        return redirect('vprocessreceipt/'.$vprocess->id)->with('message', 'Verification Done Successfully...');
      }
     // return view('admin/vprocess/vaccineprocess');
    public function viewverified(){
        $verify = Vprocess::select('vprocesses.*','schedules.*','vaccinecenters.*','vaccinetypes.*','beneficiaries.*')
        ->leftjoin('schedules','schedules.id','=','vprocesses.schedules_id')
        ->leftjoin('vaccinecenters','vaccinecenters.id','=','schedules.vaccinecenter_id')
        ->leftjoin('vaccinetypes','vaccinetypes.id','=','schedules.vaccinetype_id')
        ->leftjoin('beneficiaries','beneficiaries.id','=','schedules.beneficiaries_id')
        ->where('schedules.status','Active')
        ->where('verifierstatus',1)->where('verifier_id',Auth::user()->id)->get();
        return view('admin/vprocess/viewverified',compact('verify'));
    }
    public function vaccinator_report(){
      /*  $verify = Vprocess::select('vprocesses.*','schedules.*','vaccinecenters.*','vaccinetypes.*','beneficiaries.*')
        ->leftjoin('schedules','schedules.id','=','vprocesses.schedules_id')
        ->leftjoin('vaccinecenters','vaccinecenters.id','=','schedules.vaccinecenter_id')
        ->leftjoin('vaccinetypes','vaccinetypes.id','=','schedules.vaccinetype_id')
        ->leftjoin('beneficiaries','beneficiaries.id','=','schedules.beneficiaries_id')
        ->where('schedules.status','Active')
        ->where('verifierstatus',1)->where('verifier_id',Auth::user()->id)->get();*/
        return view('admin/vprocess/vaccinatorreport');
    }
    public function stockwastageinsert(Request $request){
           $data['stwastage']=Stock::create($request->all());
            return redirect('dashboard')->with('message', 'Wastage Reported Successfully...');
          
    }

}
