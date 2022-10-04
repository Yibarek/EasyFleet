<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class reportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function generateReport(Request $request){
        if ($request->report == "User") {
            $users = DB::table('users')->where('created_at', '>=', $request->from)
                              ->where('created_at', '<=', $request->to)->get();

            return view('report.report', ['users'=>$users, 'report'=>$request->report, 'from'=>$request->from, 'to'=>$request->to]);
        }
        elseif ($request->report == "Vehicle") {
            $Vcount = DB::table('vehicles')->where('created_at', '>=', $request->from)
                              ->where('created_at', '<=', $request->to)->count();
            $vehicles = DB::table('vehicles')->where('created_at', '>=', $request->from)
                              ->where('created_at', '<=', $request->to)->get();
            return view('report.report', ['vehicles'=>$vehicles, 'Vcount'=>$Vcount, 'report'=>$request->report, 'from'=>$request->from, 'to'=>$request->to]);
        }
        elseif ($request->report == "Schedule") {
            $Scount = DB::table('schedules')->where('date', '>=', $request->from)
                              ->where('date', '<=', $request->to)->count();
            $schedules = DB::table('schedules')->where('date', '>=', $request->from)
                              ->where('date', '<=', $request->to)->get();
            return view('report.report', ['schedules'=>$schedules, 'Scount'=>$Scount, 'report'=>$request->report, 'from'=>$request->from, 'to'=>$request->to]);
        }
        elseif ($request->report == "Exit_Request") {
            $Rcount = DB::table('requests')->where('created_at', '>=', $request->from)
                              ->where('created_at', '<=', $request->to)->count();
            $requests = DB::table('requests')->where('created_at', '>=', $request->from)
                              ->where('created_at', '<=', $request->to)->get();
            return view('report.report', ['requests'=>$requests, 'Rcount'=>$Rcount, 'report'=>$request->report, 'from'=>$request->from, 'to'=>$request->to]);
        }
        elseif ($request->report == "Maintenance") {
            $Mcount = DB::table('maintenances')->where('created_at', '>=', $request->from)
                              ->where('created_at', '<=', $request->to)->count();
            $maintenances = DB::table('maintenances')->where('created_at', '>=', $request->from)
                              ->where('created_at', '<=', $request->to)->get();
            return view('report.report', ['maintenances'=>$maintenances, 'Mcount'=>$Mcount, 'report'=>$request->report, 'from'=>$request->from, 'to'=>$request->to]);
        }
        // $Scount= DB::table('schedules')->count();
        // $schedules= DB::table('schedules')->distinct()->orderBy('id', 'DESC')->get(50);
        // return view('schedule.schedule',['schedules'=>$schedules, 'Scount'=>$Scount, 'input'=>'']);
    }

}
