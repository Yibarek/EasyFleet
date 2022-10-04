<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->role == 'admin') {
            $users = DB::table('users')->count();
            $vehicles = DB::table('vehicles')->count();
            $requests = DB::table('requests')->count();
            $maintenances = DB::table('maintenances')->count();
            $schedules = DB::table('schedules')->count();
            $drivers = DB::table('users')->where('role', 'Driver')->count();
            return view('home', ['users'=>$users,
                                 'vehicles'=>$vehicles,
                                'requests'=>$requests,
                                'maintenances'=>$maintenances,
                                'schedules'=>$schedules,
                                'drivers'=>$drivers]);
        } else if (Auth::user()->role == 'Staff' || Auth::user()->role == 'Scheduler') {
            return redirect('/schedules');
        }
        else if (Auth::user()->role == 'Vehicle_Manager') {
            return redirect('/vehicles');
        }
        else if (Auth::user()->role == 'Scheduler') {
            return redirect('/schedules');
        }
        else if (Auth::user()->role == 'Security') {
            return redirect('/exitRequest');
        }
        else if (Auth::user()->role == 'Driver') {
            return redirect('/schedules');
        } else {
            return redirect('/');
        }
    }
}
