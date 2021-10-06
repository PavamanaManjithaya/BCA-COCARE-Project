<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Hash;
use Session;
use App\Models\Schedule;
use App\Models\Beneficiaries;
use App\Models\Stock;
use App\Models\vaccinecenter;
use App\Models\Vaccinetype;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use DateTime;
use DatePeriod;
use DateInterval;
use Mail;
use DB;
use PDF;

class schedulecontroller extends Controller
{
    public function load_appointment_search_rec($id,$benid,$searchtype,$cost,$age,$vaccinetype,$dose)
    {
        $begin = new DateTime(Date('Y-m-d', strtotime('-30 days')));
        $NewDate=Date('Y-m-d', strtotime('+7 days'));
        //$beneficiaries = Beneficiaries::where('id',$benid)->get();
        //$birthday = new DateTime($beneficiaries[0]->dob);
        //$interval = $birthday->diff(new DateTime);
        //$benage = $interval->y;=
        $st = 'Active';
        $query = DB::table('stocks')
        ->select('*',DB::raw("( SELECT count(*) FROM schedules WHERE DATE(scheduletime)= stocks.date AND vaccinecenter_id=stocks.vaccinecenter_id AND vaccinetype_id=stocks.vaccinetype_id AND doseno=stocks.dose AND status='Active' ) AS countbooking"))
        ->leftJoin('vaccinecenters','vaccinecenters.id','=','stocks.vaccinecenter_id')
        ->leftjoin('vaccinetypes','stocks.vaccinetype_id','=','vaccinetypes.id')
        ->whereBetween('date', [$begin, $NewDate])
       // ->where('stocks.sage','<=',$benage)
        //->where('stocks.eage','>=',$benage)
        ->where('stocks.status','DistAdmin2Vcenter')
        //->where('stocks.dose',$dose)
        ->orderBy('stocks.vaccinecenter_id', 'ASC')
        ->orderBy('stocks.date', 'ASC');
        //$cost,$age,$vaccinetype,$dose
        if($cost != "All")
        {
            $query->where('vaccinecenters.category', $cost);
        }
        if($age != "All")
        {
            if($age == "1844")
            {
                $query->where('stocks.sage','>=',1);
                $query->where('stocks.eage','<=',44);
            }
            if($age == "45100")
            {
                $query->where('stocks.sage','>=',45);
                $query->where('stocks.eage','<=',100);
            }
        }
        if($vaccinetype != "All")
        {
            $query->where('stocks.vaccinetype_id', $vaccinetype);
        }
        if($dose != "All")
        {
            $query->where('stocks.dose', $dose);
        }
        if($searchtype == "searchtypepincode")
        {
        $query->where('vaccinecenters.pincode','like','%' . $id . '%');
        }
        if($searchtype == "searchtypedistrict")
        {
        $query->where('vaccinecenters.district_id', $id);
        }
        $data['vaccinestocksrec'] = $query->get();
        return response()->json($data);
    }
    public function load_search_rec($id,$benid,$searchtype)
    {
        $begin = new DateTime(Date('Y-m-d', strtotime('-30 days')));
        $NewDate=Date('Y-m-d', strtotime('+7 days'));
        $beneficiaries = Beneficiaries::where('id',$benid)->get();
        $birthday = new DateTime($beneficiaries[0]->dob);
        $interval = $birthday->diff(new DateTime);
        $benage = $interval->y;
        $dose = 0;
        if($beneficiaries[0]->dose == 0)
        {
            $dose = 1;
        }
        else if($beneficiaries[0]->dose == 1)
        {
            $dose = 2;
        }
        $st = 'Active';
        $query = DB::table('stocks')
        ->select('*',DB::raw("( SELECT count(*) FROM schedules WHERE DATE(scheduletime)= stocks.date AND vaccinecenter_id=stocks.vaccinecenter_id AND vaccinetype_id=stocks.vaccinetype_id AND doseno=stocks.dose AND status='Active' ) AS countbooking"))
        ->leftJoin('vaccinecenters','vaccinecenters.id','=','stocks.vaccinecenter_id')
        ->leftjoin('vaccinetypes','stocks.vaccinetype_id','=','vaccinetypes.id')
        ->whereBetween('date', [$begin, $NewDate])
        ->where('stocks.sage','<=',$benage)
        ->where('stocks.eage','>=',$benage)
        ->where('stocks.status','DistAdmin2Vcenter')
        ->where('stocks.dose',$dose)
        ->orderBy('stocks.vaccinecenter_id', 'ASC')
        ->orderBy('stocks.date', 'ASC');
        if($searchtype == "searchtypepincode")
        {
        $query->where('vaccinecenters.pincode','like','%' . $id . '%');
        }
        if($searchtype == "searchtypedistrict")
        {
        $query->where('vaccinecenters.district_id', $id);
        }
        $data['vaccinestocksrec'] = $query->get();
        return response()->json($data);
    }
    public function bookappointmentctrl($vaccinecenter_id,$vaccinedate,$vaccinetype_id,$benid,$scheduleid)
    {
        $data['scheduleid'] = $scheduleid;
        $data['vaccinecenter_id'] = $vaccinecenter_id;
        $data['appdate'] = $vaccinedate;
        $data['vaccinetype_id'] = $vaccinetype_id;
        $data['benid'] = $benid;
        $data['vaccinecenterrec'] = DB::table('vaccinecenters')
        ->leftjoin('states','states.id','=','vaccinecenters.state_id')
        ->leftjoin('districts','districts.id','=','vaccinecenters.district_id')
        ->where('vaccinecenters.id',$vaccinecenter_id)
        ->get();
        $data['vaccinetypes'] = Vaccinetype::findOrFail($vaccinetype_id);
        $data['beneficiaries'] = Beneficiaries::where('id',$benid)->get();
        //#####Age Calculation Starts Here
        $birthday = new DateTime($data['beneficiaries'][0]->dob);
        $interval = $birthday->diff(new DateTime);
        $benage = $interval->y;
        //#####Age Calculation Ends Here
        //### Total Stocks on this day Starts here
        $data['stockcounter'] = Stock::select('qty')->where('vaccinecenter_id',$vaccinecenter_id)->where('vaccinetype_id',$vaccinetype_id)->where('date',$vaccinedate)
        ->where('stocks.sage','<=',$benage)
        ->where('stocks.eage','>=',$benage)
        ->get();
        //### Total Stocks on this day Ends Here
        return view('frontend.appointment.appointmentbooking',compact('data'));
    }
    public function storeschedulectrl(Request $request)
    {
        $oldschedulerec = Schedule::where('beneficiaries_id', $request->beneficiaries_id)->where('doseno', $request->doseno)->update(array('status' => 'Cancelled'));
        $sdttime= $request['scheduledate'] . " " . date("H:i:00",strtotime($request['scheduletime']));
        $updschedule = Schedule::where('id', $request->scheduleid)->update(array('status' => 'Cancelled'));
        $schedule = Schedule::create(array_merge($request->all(), ['scheduletime' => $sdttime]));
        if($request->scheduleid == 0)
        {
            return redirect('appointmentreceipt/'.$schedule->id)->with('message', 'Your appointment scheduled successfully...');
        }
        else
        {
            return redirect('appointmentreceipt/'.$schedule->id)->with('message', 'Your appointment Rescheduled successfully...');
        }
    }
    public function appointmentreceiptctrl($id)
    {
        $data['id'] = $id;
        $data['vaccinecenterrec'] = DB::table('schedules')
        ->leftjoin('vaccinecenters','vaccinecenters.id','=','schedules.vaccinecenter_id')
        ->leftjoin('vaccinetypes','vaccinetypes.id','=','schedules.vaccinetype_id')
        ->leftjoin('beneficiaries','beneficiaries.id','=','schedules.beneficiaries_id')
        ->where('schedules.id',$id)
        ->get();
        return view('frontend.appointment.appointmentreceipt',compact('data'));
    }
    public function appointmentpdfctrl($id)
    {
        $data['id'] = $id;
        $data['vaccinecenterrec'] = DB::table('schedules')
        ->leftjoin('vaccinecenters','vaccinecenters.id','=','schedules.vaccinecenter_id')
        ->leftjoin('vaccinetypes','vaccinetypes.id','=','schedules.vaccinetype_id')
        ->leftjoin('beneficiaries','beneficiaries.id','=','schedules.beneficiaries_id')
        ->where('schedules.id',$id)
        ->get();
        //#######################################
        //PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        $pdf = PDF::loadView('frontend.appointment.appointmentreceiptpdf',compact('data'));
        return $pdf->download('appointmentreceipt.pdf');
        //return view('frontend.appointment.appointmentreceiptpdf',compact('data'));
    }
    public function appointmentschedulectrl()
    {
        return view('admin.schedule.appointmentschedule');
    }
    public function offlineappointmentctrl()
    {
       // return view('admin.schedule.appointmentschedule');
        return view('admin.schedule.offlineappointment');
    }
}
