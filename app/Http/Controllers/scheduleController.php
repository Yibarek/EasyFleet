<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class scheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function list(){
        $Scount= DB::table('schedules')->count();
        $schedules= DB::table('schedules')->distinct()->orderBy('id', 'DESC')->paginate(50);
        return view('schedule.schedule',['schedules'=>$schedules, 'Scount'=>$Scount, 'input'=>'']);
    }

    function addSchedule(){
        $vehicles = DB::table('vehicles')->get();
        $drivers = DB::table('users')->where('role', 'Driver')->get();
        return view('schedule.addSchedule', ['vehicles'=>$vehicles, 'drivers'=>$drivers,]);
    }

    function add(Request $request){
        if(Auth::user()->role == 'Vehicle_Manager'){
            $response=0;

            $response = DB::table('schedules')->insertOrIgnore([
                'date'=>$request->s_date,
                'fermata'=>$request->fermata,
                'car_type'=>$request->car_type,
                'driver'=>$request->driver,
                'remark'=>$request->remark,
                'morning1'=>$request->txt_m_1,
                'morning2'=>$request->txt_m_2,
                'morning3'=>$request->txt_m_3,
                'morning4'=>$request->txt_m_4,
                'day1'=>$request->txt_d_1,
                'day2'=>$request->txt_d_2,
                'night1'=>$request->txt_n_1,
                'night2'=>$request->txt_n_2,
                'night3'=>$request->txt_n_3,
                'night4'=>$request->txt_n_4,
                'night5'=>$request->txt_n_5,
            ]);
            if ($response == 1) {
                return redirect('/schedules')->with('success', 'Schedules information saved successfully!');
            }
            else{
                return redirect('/schedules')->with('danger', 'Failed to save the schedule! Incorrect data is detected. Please try again');
            }
        }
        else {
            return redirect('/accessdenied');
        }
    }

    function editSchedule($id){
        $schedules = DB::table('schedules')->where('id', $id)->get();
        $vehicles = DB::table('vehicles')->get();
        $drivers = DB::table('users')->where('role', 'Driver')->get();
        return view('schedule.editSchedule', ['schedules'=>$schedules, 'vehicles'=>$vehicles, 'drivers'=>$drivers, 'id'=> $id]);
    }

    function updateSchedule(Request $request, $id){
        if(Auth::user()->role == 'Vehicle_Manager'){
            $response=0;

            $response = DB::table('schedules')->where('id', $id)->Update([
                'date'=>$request->s_date,
                'fermata'=>$request->fermata,
                'car_type'=>$request->car_type,
                'driver'=>$request->driver,
                'remark'=>$request->remark,
                'morning1'=>$request->txt_m_1,
                'morning2'=>$request->txt_m_2,
                'morning3'=>$request->txt_m_3,
                'morning4'=>$request->txt_m_4,
                'day1'=>$request->txt_d_1,
                'day2'=>$request->txt_d_2,
                'night1'=>$request->txt_n_1,
                'night2'=>$request->txt_n_2,
                'night3'=>$request->txt_n_3,
                'night4'=>$request->txt_n_4,
                'night5'=>$request->txt_n_5,
            ]);
            if ($response == 1) {
                return redirect('/schedules')->with('success', 'Changes are Updated successfully!');
            }
            else{
                return redirect('/schedules')->with('danger', 'Nothing is Updated. Please try again');
            }
        }
        else {
            return redirect('/accessdenied');
        }
    }

    function delete($id){
        if (Auth::user()->role == 'Vehicle_Manager') {
            $response=0;
            $response = DB::table('schedules')->where('id', $id)->delete();
            if ($response == 1) {
                return redirect('/schedules')->with('success', 'Schedule successfully Deleted!');
            }
            else{
                return redirect('/schedules')->with('danger', 'Failed to Delete the vehicle! Invalid action detected.');
            }
        }
        else {
            return redirect('/accessdenied');
        }
    }
    function searchSchedule($input){
        $Scount = DB::table('schedules')->where('car_type', 'Like', '%'.$input.'%')
                                  ->orWhere('driver', 'Like', '%'.$input.'%')
                                  ->orWhere('date', 'Like', '%'.$input.'%')->count();
        $schedules = DB::table('schedules')->where('car_type', 'Like', '%'.$input.'%')
                                  ->orWhere('driver', 'Like', '%'.$input.'%')
                                  ->orWhere('date', 'Like', '%'.$input.'%')->orderBy('id', 'DESC')->paginate(50);

        return view('schedule.schedule',['schedules'=>$schedules, 'Scount'=>$Scount, 'input'=>$input]);
    }
}
