<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use DateTime;

class maintenanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function list(){
        if (Auth::user()->role == 'Driver') {
            $Mcount= DB::table('maintenances')->where('requester', Auth::user()->username)->count();
            $maintenances= DB::table('maintenances')->where('requester', Auth::user()->username)->distinct()->orderBy('id', 'DESC')->paginate(50);
        }
        else {
            $Mcount= DB::table('maintenances')->count();
            $maintenances= DB::table('maintenances')->distinct()->orderBy('id', 'DESC')->paginate(50);
        }
        return view('maintenance.maintenances',['maintenances'=>$maintenances, 'Mcount'=>$Mcount,'input'=>'']);
    }

    function add(Request $request){
        if(Auth::user()->role == 'Driver'){
            $response=0;

            $response = DB::table('maintenances')->insertOrIgnore([
                'car_type'=>$request->car_type,
                'plate_no'=>$request->plate_no,
                'causes'=>$request->cause,
                'status'=>'Pending',
                'organization'=>'Kombolcha Institute of Technology',
                'requester'=>Auth::user()->username,
                'created_at'=>new DateTime(),
            ]);
            if ($response == 1) {
                return redirect('/maintenance')->with('success', 'Maintenance information saved successfully!');
            }
            else{
                return redirect('/maintenance')->with('danger', 'Failed to save the Maintenance! Incorrect data is detected. Please try again');
            }
        }
        else {
            return redirect('/accessdenied');
        }
    }

    function editMaintenance($id){
        $maintenance = DB::table('maintenances')->where('id', $id)->get();
        return view('maintenance.editMaintenance', ['maintenance'=>$maintenance, 'id'=> $id]);
    }

    function update(Request $request, $id){
        $driver = DB::table('maintenances')->where('id', $id)->first();
        if(Auth::user()->role == 'Driver' && $driver->requester == Auth::user()->username){

            $response=0;

            $response = DB::table('maintenances')->where('id', $id)->Update([
                'car_type'=>$request->car_type,
                'plate_no'=>$request->plate_no,
                'causes'=>$request->cause,
            ]);
            if ($response == 1) {
                return redirect('/maintenance')->with('success', 'Changes are Updated successfully!');
            }
            else{
                return redirect('/maintenance')->with('danger', 'Nothing is Updated. Please try again');
            }
        }
        else {
            return redirect('/accessdenied');
        }
    }

    function delete($id){
        if (Auth::user()->role == 'Driver') {
            $response=0;
            $response = DB::table('maintenances')->where('id', $id)->delete();
            if ($response == 1) {
                return redirect('/maintenance')->with('success', 'Maintenances request successfully Deleted!');
            }
            else{
                return redirect('/maintenance')->with('danger', 'Failed to Delete the Maintenance! Invalid action detected.');
            }
        }
        else {
            return Auth::user()->role;
        }
    }

    public function accept($id)
    {
        if (Auth::user()->role == 'Vehicle_Manager') {
            $response = 0;
            $response = DB::table('maintenances')->where('id', $id)->update(
                ['status'=>"Accepted"]
            );
            if ($response == 1) {
                return redirect('/maintenance')->with('success', 'Maintenance Request successfully Accepted!');
            }
            else{
                return redirect('/maintenance')->with('danger', 'Failed to accept the maintenance request! Invalid action detected.');
            }
        }
        else {
            return redirect('/accessdenied');
        }
    }

    public function reject($id)
    {
        if (Auth::user()->role == 'Vehicle_Manager') {
            $response = 0;
            $response = DB::table('maintenances')->where('id', $id)->update(
                ['status'=>"Rejected"]
            );
            if ($response == 1) {
                return redirect('/maintenance')->with('success', 'Maintenance Request successfully Rejected!');
            }
            else{
                return redirect('/maintenance')->with('danger', 'Failed to reject the maintenance request! Invalid action detected.');
            }
        }
        else {
            return redirect('/accessdenied');
        }
    }
    function countPendingMaintenance(){
        $count = DB::table('maintenances')->where('status', 'Pending')->count();
        return response()->json(['count'=>$count], 200);
    }
    function searchMaintenance($input){
        if (Auth::user()->role == 'Driver') {
            $Mcount = DB::table('maintenances')->where('car_type', 'Like', '%'.$input.'%')
                                    ->orWhere('requester', 'Like', '%'.$input.'%')
                                    ->orWhere('date', 'Like', '%'.$input.'%')->where('requester', Auth::user()->username)->count();
            $maintenances = DB::table('maintenances')->where('car_type', 'Like', '%'.$input.'%')
                                    ->orWhere('requester', 'Like', '%'.$input.'%')
                                    ->orWhere('date', 'Like', '%'.$input.'%')->where('requester', Auth::user()->username)->orderBy('id', 'DESC')->paginate(50);
        } else {
            $Mcount = DB::table('maintenances')->where('car_type', 'Like', '%'.$input.'%')
                                    ->orWhere('requester', 'Like', '%'.$input.'%')
                                    ->orWhere('date', 'Like', '%'.$input.'%')->where('requester', Auth::user()->username)->count();
            $maintenances = DB::table('maintenances')->where('car_type', 'Like', '%'.$input.'%')
                                    ->orWhere('requester', 'Like', '%'.$input.'%')
                                    ->orWhere('date', 'Like', '%'.$input.'%')->where('requester', Auth::user()->username)->orderBy('id', 'DESC')->paginate(50);
        }


        return view('maintenance.maintenances',['maintenances'=>$maintenances, 'Mcount'=>$Mcount, 'input'=>$input]);
    }
}
