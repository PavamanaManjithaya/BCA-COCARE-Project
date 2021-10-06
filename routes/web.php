<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StateController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\VaccinetypeController;
use App\Http\Controllers\VaccinecenterController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\accountcontroller;
use App\Http\Controllers\beneficiarycontroller;
use App\Http\Controllers\schedulecontroller;
use App\Http\Controllers\vprocessController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//home
Route::get('/', function () {
    return view('frontend.layouts.index');
})->name('beneficiary.home');


//Change system language
Route::get('/language/{language}', [LanguageController::class, 'changeLanguage'])
    //->middleware('auth:'.GuardType::ADMIN.','.GuardType::BUSINESS.','.GuardType::STAFF)
    ->name('language.change');


Route::get('/howtogetvaccined', function () {
    return view('frontend.layouts.howtogetvaccined');
});

Route::get('/doanddonts', function () {
    return view('frontend.layouts.doanddonts');
});

Route::get('/overview', function () {
    return view('frontend.layouts.overview');
});

Route::get('/faqs', function () {
    return view('frontend.layouts.faqs');
});

Route::get('adminlogin', function () {
    return view('admin/layouts/login');
});


//Admin
Route::resource('state', StateController::class)->middleware('adminAuth');
Route::resource('district', DistrictController::class)->middleware('adminAuth');
Route::resource('vaccinetype', VaccinetypeController::class)->middleware('adminAuth');
Route::resource('vaccinecenter', VaccinecenterController::class)->middleware('adminAuth');

/*
Route::get('dashboard', function () {
    return view('admin/layouts/index');
})->name('dashboard');
*/
Route::GET('dashboard', [accountcontroller::class,'dashboardctrl'])->name('dashboard')->middleware('auth');

//Users Menu starts here
//Registration or Login Page for Users
Route::get('login', function () {
    return view('frontend/account/login');
})->name('login');
//Users Menu ends here

//Users Menu ends here
//Admin and vaccinator login
Route::get('deptlogin', function () {
    return view('admin/account/login');
})->name('deptlogin');
Route::POST('loginauthentication', [accountcontroller::class,'loginauth'])->name('checklogin');
Route::get('vaccinatorlogin', function () {
    return view('admin/account/login');
})->name('vaccinatorlogin');
//Admin and vaccinator login Menu ends here

//Staff Account Starts here
Route::GET('createaccount', [accountcontroller::class,'createaccountctrl'])->name('createaccount')->middleware('auth');
Route::POST('createaccount', [accountcontroller::class,'accountregistration'])->name('insertaccount')->middleware('auth');
Route::GET('viewaccount/{accounttype}', [accountcontroller::class,'viewaccountctrl'])->name('viewaccount')->middleware('auth');
Route::GET('editaccount/{editid}', [accountcontroller::class,'editaccountctrl'])->name('editaccount')->middleware('auth');
Route::POST('updateaccount', [accountcontroller::class,'updateaccountctrl'])->name('updateaccount')->middleware('auth');
Route::GET('deleteaccount/{delid}', [accountcontroller::class,'deleteaccountctrl'])->middleware('auth');
//Staff Account Ends here

//Logout starts
Route::GET('logout', [accountcontroller::class,'logout'])->name('logout');
//Logout ends

Route::POST('otpgeneratemail', [accountcontroller::class,'createotpsessionmail'])->name('otpgeneratemail');

Route::get('emailtemplate', function () {
    return view('frontend/layouts/emailtemplate');
});

Route::POST('otploginverification', [accountcontroller::class,'otploginauth'])->name('otpchecklogin');

//### User Login Starts Here
Route::POST('userotpgeneratemail', [accountcontroller::class,'createuserotpsessionmail'])->name('userotpgeneratemail');
Route::POST('userotploginverification', [accountcontroller::class,'userotploginauth'])->name('userotploginverification');
//### User Login Starts Here

//Welcome page will be displayed for New users after  Successfullful Login
Route::get('welcome', function () {
    return view('frontend/account/welcome');
})->middleware('UserAuth');

//@@@Benificiary Starts Here
Route::GET('beneficiarycreate', [beneficiarycontroller::class,'beneficiarycreateindex'])->name('beneficiarycreate')->middleware('UserAuth');
Route::POST('docverification', [beneficiarycontroller::class,'docverification'])->name('docverification')->middleware('UserAuth');
Route::POST('insertbeneficiary', [beneficiarycontroller::class,'insertbeneficiaryctrl'])->name('insertbeneficiary')->middleware('UserAuth');
//View Benificiary
Route::GET('beneficiaryview', [beneficiarycontroller::class,'beneficiaryviewrec'])->name('beneficiaryview')->middleware('UserAuth');
Route::GET('del_ben_rec/{id}', [beneficiarycontroller::class,'delbenrec'])->name('del_ben_rec')->middleware('UserAuth');
//@@@Benificiary Ends Here

//@@@Stock Starts Here
Route::resource('stock', StockController::class)->middleware('auth');
Route::GET('stockallotment/{id}', [StockController::class,'stockallotmentpanelctrl'])->name('stockallotment')->middleware('DistrictAdminAuth');
Route::POST('stockallotmentinsert', [StockController::class,'stockallotmentinsertctrl'])->name('stockinsert')->middleware('auth');
Route::GET('deleteallotstock/{delid}', [StockController::class,'stockallotmentdeletectrl'])->middleware('auth');
Route::GET('stockbalance', [StockController::class,'stockbalancectrl'])->name('stockbalance')->middleware('DistrictAdminAuth');
Route::GET('load_previous_stock/{vtypeid}/{vaccinecenter_id}', [StockController::class,'load_previous_stockctrl'])->name('load_previous_stock')->middleware('auth');
Route::GET('stockallotmentreport', [StockController::class,'stockallotmentrptctrl'])->name('stockallotmentreport')->middleware('DistrictAdminAuth');
Route::GET('stockwastagereport', [StockController::class,'stockwastageview'])->name('stockwastageview')->middleware('auth');
//@@@Stock Ends Here
//Route::get('search', function () {
//return view('frontend/appointment/search');
//});
//For Public
Route::GET('searchvaccinecenter', [beneficiarycontroller::class,'searchvaccinecenterctrl'])->name('searchvaccinecenter');
//For User
Route::GET('searchvcenter/{id}/{scheduleid}', [beneficiarycontroller::class,'searchvcenter'])->name('searchvcenter')->middleware('UserAuth');

Route::GET('load_district_rec/{id}', [DistrictController::class,'load_district_recs'])->name('load_district_rec');
Route::GET('load_vaccinecenter_rec/{id}', [VaccinecenterController::class,'load_vaccine_recs'])->name('load_vaccinecenter_rec');
//Search Public Appointment Date Starts Here
Route::GET('load_appointment_search/{id}/{benid}/{searchtype}/{cost}/{age}/{vaccinetype}/{dose}', [schedulecontroller::class,'load_appointment_search_rec'])->name('load_appointment_search');
//Search Public Appointment Date Ends Here
//Appointment Schedule Code Starts Here
Route::GET('load_search/{id}/{benid}/{searchtype}', [schedulecontroller::class,'load_search_rec'])->name('load_vaccine_center');
////Appointment Schedule Code Ends Here

//Appointment Module Starts Here
Route::get('bookappointment/{vaccinecenter_id}/{vaccinedate}/{vaccinetype_id}/{benid}/{scheduleid}',  [schedulecontroller::class,'bookappointmentctrl'])->name('bookappointment')->middleware('UserAuth');
Route::POST('insertschedule', [schedulecontroller::class,'storeschedulectrl'])->name('insertschedule')->middleware('auth');
Route::get('appointmentreceipt/{id}', [schedulecontroller::class,'appointmentreceiptctrl'])->name('appointmentreceipt')->middleware('UserAuth');
Route::get('bookappointmentpdf/{id}', [schedulecontroller::class,'appointmentpdfctrl'])->name('bookappointmentpdf')->middleware('auth');
//Appointment Module Ends Here

//Offline Appointment Module Starts Here
Route::get('offlineappointment', [schedulecontroller::class,'offlineappointmentctrl'])->name('offlineappointment')->middleware('VerifierAuth')->middleware('auth');
//Offline Appointment Module Ends Here

//Verifier Module Starts Here
Route::get('appointmentschedule',  [schedulecontroller::class,'appointmentschedulectrl'])->name('appointmentschedule')->middleware('auth');
Route::POST('verify_ben_data', [beneficiarycontroller::class,'verify_ben_data_ctrl'])->name('verify_ben_data')->middleware('auth');
Route::POST('insertvprocesses', [beneficiarycontroller::class,'insertvprocesses_ctrl'])->name('insertvprocesses')->middleware('auth');
Route::GET('vprocessreceipt/{id}', [beneficiarycontroller::class,'vprocesses_receipt_ctrl'])->name('vprocessreceipt')->middleware('auth');
//Verifier Module Ends Here

//Vaccination Process Starts Here
Route::get('vaccinationprocess',  [vprocessController::class,'loadvprocessctrl'])->name('vaccinationprocess')->middleware('VaccinatorAuth');
Route::GET('loaddatavprocess/{id}', [vprocessController::class,'loaddatavprocess_ctrl'])->name('loaddatavprocess')->middleware('VaccinatorAuth');
Route::POST('insertvaccinactiondata', [vprocessController::class,'ins_vac_data_ctrl'])->name('insertvaccinactiondata')->middleware('VaccinatorAuth');
Route::POST('verify_offlineidproofs', [vprocessController::class,'offlineidproof_ctrl'])->name('verify_offlineidproofs')->middleware('auth');
Route::GET('load_vaccine_qty_rec', [vprocessController::class,'vaccine_count_ctrl'])->name('load_vaccine_qty_rec')->middleware('auth');
Route::GET('load_otp_num', [vprocessController::class,'load_otp_num_ctrl'])->name('load_otp_num')->middleware('auth');
Route::POST('insertofflineappt', [vprocessController::class,'insertofflineappt_ctrl'])->name('insertofflineappt')->middleware('auth');
Route::GET('verifiedview', [vprocessController::class,'viewverified'])->name('verifiedview')->middleware('auth');
Route::get('vaccinator_report', [vprocessController::class,'vaccinator_report'])->name('vaccinatorreport')->middleware('auth');
Route::POST('stockwastageinsert', [vprocessController::class,'stockwastageinsert'])->name('stockwastageinsert')->middleware('auth');

//Vaccination Process Ends Here

//Cocare Certificate starts here
Route::GET('cocarecertificate/{id}', [vprocessController::class,'cocare_certificate_ctrl'])->name('cocarecertificate')->middleware('auth');
Route::get('cocarecertificatepdf/{id}', [vprocessController::class,'cocarecertificatepdfctrl'])->name('cocarecertificatepdf')->middleware('auth');
//Cocare Certificate ends here

//Staff Profile starts here
Route::GET('staffprofile', [accountcontroller::class,'viewprofile'])->name('staffprofile')->middleware('auth');
Route::POST('updatestaffaccount', [accountcontroller::class,'profilectrl'])->name('updatestaffaccount')->middleware('auth');
Route::GET('staffchangepassword', [accountcontroller::class,'staffchangepasswordctrl'])->name('staffchangepassword')->middleware('auth');
Route::POST('updstaffpwd', [accountcontroller::class,'updstaffpwdctrl'])->name('updstaffpwd')->middleware('auth');
//Staff Profile Ends Here