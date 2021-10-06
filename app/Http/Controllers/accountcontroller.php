<?php

namespace App\Http\Controllers;

use App\Models\User;
use DB;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mail;
use Session;

class accountcontroller extends Controller
{
    public function createaccountctrl()
    {
        return view('admin.account.create');
    }
    public function accountregistration(Request $req)
    {
        $data = $req->all();
        $this->create($data);
        return redirect('createaccount')->with('message', 'Account Created successfully..');
    }
    public function create(array $arrdata)
    {
        return User::create([
            'state_id' => $arrdata['state_id'],
            'district_id' => $arrdata['district_id'],
            'vaccine_center_id' => $arrdata['vaccine_center_id'],
            'user_role' => $arrdata['user_role'],
            'name' => $arrdata['name'],
            'mob_no' => $arrdata['mob_no'],
            'state_id' => $arrdata['state_id'],
            'email' => $arrdata['email'],
            'password' => Hash::make($arrdata['password']),
            'status' => $arrdata['status'],
        ]);
    }

    public function viewaccountctrl($accounttype)
    {
        if (Auth::user()->user_role == "District Admin") {
            $users = User::where('user_role', $accounttype)->where('district_id', Auth::user()->district_id)->get();
        } else {
            $users = User::where('user_role', $accounttype)->get();
        }
        return view('admin.account.view', compact('users', 'accounttype'));
    }

    public function editaccountctrl($id)
    {
        $user = User::findOrFail($id);
        return view('admin.account.edit', compact('user'));
    }
    public function updateaccountctrl(Request $request)
    {
        if ($request->password == "") {
            $user = User::where('id', $request->user_id)->update(array('state_id' => $request->state_id, 'district_id' => $request->district_id, 'user_role' => $request->user_role, 'name' => $request->name, 'mob_no' => $request->mob_no, 'email' => $request->email, 'status' => $request->status));
        } else {
            $user = User::where('id', $request->user_id)->update(array('state_id' => $request->state_id, 'district_id' => $request->district_id, 'user_role' => $request->user_role, 'name' => $request->name, 'mob_no' => $request->mob_no, 'email' => $request->email, 'password' => Hash::make($request->password), 'status' => $request->status));
        }
        $user = User::findOrFail($request->user_id);
        return view('admin.account.edit', compact('user'));
    }

    public function deleteaccountctrl($delid)
    {
        $User = User::findOrFail($delid);
        $User->delete();
        return 1;
    }

    public function loginauth(Request $req)
    {
        if (Auth::attempt(['email' => $req->email, 'password' => $req->password, 'status' => 'Active'])) {
            return redirect('dashboard')->with('message', 'Successfully Logged in..');
        } else {
            return redirect('deptlogin')->with('message', 'You have entered Invalid Login credentials...');
        }
    }
    public function otploginauth(Request $req)
    {
        if (session('otpcode') == $req->otp) {
            $user = DB::table('users')->where('email', $req->emailotp)->where('status', 'Active')->first();
            Auth::loginUsingId($user->id);
            return 1;
        } else {
            return 0;
        }
    }
    public function userotploginauth(Request $req)
    {
        if (session('otpcode') == $req->otp) {
            if ($req->uid == 0) {
                $name = strstr($req->emailotp, '@', true);
                $data = array('state_id' => 0, 'district_id' => 0, 'vaccine_center_id' => 0, 'user_role' => 'User', 'name' => $name,
                    'mob_no' => '', 'email' => $req->emailotp, 'password' => '', 'status' => 'Active');
                $user = $this->create($data);
                Auth::loginUsingId($user->id);
                return 1;
            } else {

                $user = DB::table('users')->where('email', $req->emailotp)->where('status', 'Active')->first();
                Auth::loginUsingId($user->id);
                if (DB::table('beneficiaries')->where('user_id', $user->id)->first()) {
                    return 2;
                } else {
                    return 1;
                }

            }
        } else {
            return 0;
        }
    }
    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('/')->with('message', 'Logged Out Successfully..');
    }

    public function createotpsessionmail(Request $request)
    {
        $useremail = "";
        $usersname = "";
        $user = DB::table('users')->where('email', $request->emailotp)->first();
        if (isset($user)) {
            $request->useremail = $user->email;
            $request->name = $user->name;
            $randomno = rand(100000, 999999);
            session(['otpcode' => $randomno]);
            \Mail::send('frontend.layouts.emailtemplate', array(
                'name' => $user->name,
                'otp' => $randomno,
            ),
                function ($message) use ($request) {
                    $message->from("cocareproject@gmail.com");
                    $message->to($request->useremail, $request->name)->subject("COCARE OTP Verification Mail..");
                }
            );
            echo $user->id;
        } else {
            return 0;
        }
    }

    public function createuserotpsessionmail(Request $request)
    {
        $useremail = "";
        $usersname = "";
        $user = DB::table('users')->where('email', $request->emailotp)->first();
        if (isset($user)) {
            $request->useremail = $user->email;
            $request->name = $user->name;
            $randomno = rand(100000, 999999);
            session(['otpcode' => $randomno]);
            \Mail::send('frontend.layouts.emailtemplate', array(
                'name' => $user->name,
                'otp' => $randomno,
            ),
                function ($message) use ($request) {
                    $message->from("cocareproject@gmail.com");
                    $message->to($request->useremail, $request->name)->subject("COCARE OTP Verification Mail..");
                }
            );
            return $user->id;
        } else {
            $request->useremail = $request->emailotp;
            $request->name = strstr($request->emailotp, '@', true);
            $randomno = rand(100000, 999999);
            session(['otpcode' => $randomno]);
            \Mail::send('frontend.layouts.emailtemplate', array(
                'name' => $request->name,
                'otp' => $randomno,
            ),
                function ($message) use ($request) {
                    $message->from("cocareproject@gmail.com");
                    $message->to($request->useremail, $request->name)->subject("COCARE OTP Verification Mail..");
                }
            );
            return "New";
        }
    }

    public function viewprofile()
    {
        $user = User::findOrFail(Auth::user()->id);
        return view('admin.account.profile', compact('user'));
    }

    public function profilectrl(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->update(array('user_role' => $request->user_role, 'name' => $request->name, 'mob_no' => $request->mob_no, 'email' => $request->email, 'status' => 'Active'));
        $user = User::findOrFail($request->user_id);
        return redirect('/staffprofile')->with('message', 'Profile updated Successfully..');
    }

    public function staffchangepasswordctrl()
    {
        return view('admin.account.staffchangepassword');
    }

    public function updstaffpwdctrl(Request $request)
    {
        //opassword npassword cpassword  Hash::make($request->password);
        $user = User::where('id', Auth::user()->id)->where('password', $request->opassword)->update(array('password' => Hash::make($request->opassword)));
        return redirect('/staffchangepassword')->with('message', 'Password updated Successfully..');
    }
    public function dashboardctrl()
    {
        if(Auth::user()->user_role == "Admin")
        {
            $data['countvaccinecenters'] = DB::table('vaccinecenters')->count();
            $data['countadmins'] = DB::table('users')->where('user_role','District Admin')->count();
            $data['countvaccinator'] = DB::table('users')->where('user_role','Vaccinator')->count();
            $data['countverifier'] = DB::table('users')->where('user_role','Verifier')->count();
            $data['stocksfromadmin'] = DB::table('stocks')->where('status','Admin2District')->sum('qty');
            $data['countvprocessesdose1'] = DB::table('vprocesses')->leftJoin('schedules','schedules.id','=','vprocesses.schedules_id')->where('vprocesses.vaccinatorstatus','1')->where('schedules.doseno','1')->count();
            $data['countvprocessesdose2'] = DB::table('vprocesses')->leftJoin('schedules','schedules.id','=','vprocesses.schedules_id')->where('vprocesses.vaccinatorstatus','1')->where('schedules.doseno','2')->count();
            $data['counttotalvaccinated'] = DB::table('vprocesses')->leftJoin('schedules','schedules.id','=','vprocesses.schedules_id')->where('vprocesses.vaccinatorstatus','1')->where('schedules.doseno','2')->count();
        }
        else if(Auth::user()->user_role == "District Admin")
        {
            $data['countvaccinator'] = DB::table('users')->where('user_role','Vaccinator')->where('district_id',Auth::user()->district_id)->count();            
            $data['countverifier'] = DB::table('users')->where('user_role','Verifier')->where('district_id',Auth::user()->district_id)->count();
            $data['stocksfromadmin'] = DB::table('stocks')->where('status','Admin2District')->where('district_id',Auth::user()->district_id)->sum('qty');
            $data['countvprocessesdose1'] = DB::table('vprocesses')->leftJoin('schedules','schedules.id','=','vprocesses.schedules_id')->where('vprocesses.vaccinatorstatus','1')->where('schedules.doseno','1')->count();
            $data['countvprocessesdose2'] = DB::table('vprocesses')->leftJoin('schedules','schedules.id','=','vprocesses.schedules_id')->where('vprocesses.vaccinatorstatus','1')->where('schedules.doseno','2')->count();
            $data['counttotalvaccinated'] = DB::table('vprocesses')->leftJoin('schedules','schedules.id','=','vprocesses.schedules_id')->where('vprocesses.vaccinatorstatus','1')->where('schedules.doseno','2')->count();
        }
        else if(Auth::user()->user_role == "Verifier")
        {
            $data['countvaccinator'] = DB::table('users')->where('user_role','Vaccinator')->where('vaccine_center_id',Auth::user()->vaccine_center_id)->count();            
            $data['countverifier'] = DB::table('users')->where('user_role','Verifier')->where('vaccine_center_id',Auth::user()->vaccine_center_id)->count();
            $data['stocksfromadmin'] = DB::table('stocks')->where('status','Admin2District')->sum('qty');
            $data['countvprocessesdose1'] = DB::table('vprocesses')->leftJoin('schedules','schedules.id','=','vprocesses.schedules_id')->where('vprocesses.vaccinatorstatus','1')->where('schedules.doseno','1')->count();
            $data['countvprocessesdose2'] = DB::table('vprocesses')->leftJoin('schedules','schedules.id','=','vprocesses.schedules_id')->where('vprocesses.vaccinatorstatus','1')->where('schedules.doseno','2')->count();
            $data['counttotalvaccinated'] = DB::table('vprocesses')->leftJoin('schedules','schedules.id','=','vprocesses.schedules_id')->where('vprocesses.vaccinatorstatus','1')->where('schedules.doseno','2')->count();
        }
        else if(Auth::user()->user_role == "Vaccinator")
        {
            $data['countvaccinator'] = DB::table('users')->where('user_role','Vaccinator')->where('vaccine_center_id',Auth::user()->vaccine_center_id)->count();            
            $data['countverifier'] = DB::table('users')->where('user_role','Verifier')->where('vaccine_center_id',Auth::user()->vaccine_center_id)->count();
            $data['stocksfromadmin'] = DB::table('stocks')->where('status','Admin2District')->sum('qty');
            $data['countvprocessesdose1'] = DB::table('vprocesses')->leftJoin('schedules','schedules.id','=','vprocesses.schedules_id')->where('vprocesses.vaccinatorstatus','1')->where('schedules.doseno','1')->count();
            $data['countvprocessesdose2'] = DB::table('vprocesses')->leftJoin('schedules','schedules.id','=','vprocesses.schedules_id')->where('vprocesses.vaccinatorstatus','1')->where('schedules.doseno','2')->count();
            $data['counttotalvaccinated'] = DB::table('vprocesses')->leftJoin('schedules','schedules.id','=','vprocesses.schedules_id')->where('vprocesses.vaccinatorstatus','1')->where('schedules.doseno','2')->count();
        }
        return view('admin.layouts.index', compact('data'));
    }
}
