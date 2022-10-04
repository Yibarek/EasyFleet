<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use DateTime;

class requestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function list(){
        if (Auth::user()->role == 'Driver') {
            $Rcount= DB::table('requests')->where('driver', Auth::user()->username)->count();
            $requests= DB::table('requests')->where('driver', Auth::user()->username)->distinct()->orderBy('id', 'DESC')->paginate(50);
        } else {
            $Rcount= DB::table('requests')->count();
        $requests= DB::table('requests')->distinct()->orderBy('id', 'DESC')->paginate(50);
        }

        return view('exitRequest.exitRequests',['requests'=>$requests, 'Rcount'=>$Rcount,'input'=>'']);
    }

    function add(Request $request){
        if(Auth::user()->role == 'Driver'){
            $response=0;
            $response = DB::table('requests')->insertOrIgnore([
                'plate_no'=>$request->plate_no,
                'requester'=>$request->requester,
                'cause'=>$request->cause,
                'start_time'=>$request->start_date . ' ' . $request->start_time,
                'arrival_time'=>$request->arrival_date . ' ' . $request->arrival_time,
                'driver'=>Auth::user()->username,
                'A_will'=>'',
                'status'=>'Pending',
                'created_at'=>new DateTime(),

            ]);
            if ($response == 1) {
                return redirect('/exitRequest')->with('success', 'Exit-Request send successfully!');
            }
            else{
                return redirect('/exitRequest')->with('danger', 'Failed to save the exit-request! Incorrect data is detected. Please try again');
            }
        }
        else {
            return redirect('/accessdenied');
        }
    }

    function editRequest($id){
        $requests = DB::table('requests')->where('id', $id)->get();
        return view('exitRequest.editRequest', ['requests'=>$requests, 'id'=> $id]);
    }

    function update(Request $request, $id){
        $driver = DB::table('requests')->where('id', $id)->first();
        if(Auth::user()->role == 'Driver' && $driver->driver == Auth::user()->username){

            $response=0;

            $response = DB::table('requests')->where('id', $id)->Update([
                'plate_no'=>$request->plate_no,
                'requester'=>$request->requester,
                'cause'=>$request->cause,
                'start_time'=>$request->start_date . ' ' . $request->start_time,
                'arrival_time'=>$request->arrival_date . ' ' . $request->arrival_time,
            ]);
            if ($response == 1) {
                return redirect('/exitRequest')->with('success', 'Changes are Updated successfully!');
            }
            else{
                return redirect('/exitRequest')->with('danger', 'Nothing is Updated. Please try again');
            }
        }
        else {
            return redirect('/accessdenied');
        }
    }

    function delete($id){
        if (Auth::user()->role == 'Driver') {
            $response=0;
            $response = DB::table('/requests')->where('id', $id)->delete();
            if ($response == 1) {
                return redirect('/exitRequest')->with('success', 'Request successfully Deleted!');
            }
            else{
                return redirect('/exitRequest')->with('danger', 'Failed to Delete the exit-request! Invalid action detected.');
            }
        }
        else {
            return redirect('/accessdenied');
        }
    }

    public function accept($id)
    {
        if (Auth::user()->role == 'Vehicle_Manager') {
            $response = 0;
            $response = DB::table('requests')->where('id', $id)->update(
                ['status'=>"Accepted",
                'A_will'=>Auth::user()->username]
            );
            if ($response == 1) {
                return redirect('/exitRequest')->with('success', 'Request successfully Accepted!');
            }
            else{
                return redirect('/exitRequest')->with('danger', 'Failed to accept the request! Invalid action detected.');
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
            $response = DB::table('requests')->where('id', $id)->update(
                ['status'=>"Rejected",
                'A_will'=>Auth::user()->username]
            );
            if ($response == 1) {
                return redirect('/exitRequest')->with('success', 'Request successfully Rejected!');
            }
            else{
                return redirect('/exitRequest')->with('danger', 'Failed to reject the request! Invalid action detected.');
            }
        }
        else {
            return redirect('/accessdenied');
        }
    }

    function countPendingRequest(){
        $count = DB::table('requests')->where('status', 'Pending')->count();
        return response()->json(['count'=>$count], 200);
    }

    function searchRequest($input){
        if (Auth::user()->role == 'Driver') {
            $Rcount = DB::table('requests')->where('plate_no', 'Like', '%'.$input.'%')
                                  ->orWhere('driver', 'Like', '%'.$input.'%')
                                  ->orWhere('start_time', 'Like', '%'.$input.'%')->where('driver', Auth::user()->username)->count();
        $requests = DB::table('requests')->where('plate_no', 'Like', '%'.$input.'%')
                                  ->orWhere('driver', 'Like', '%'.$input.'%')
                                  ->orWhere('start_time', 'Like', '%'.$input.'%')->where('driver', Auth::user()->username)->orderBy('id', 'DESC')->paginate(50);
        } else {
            $Rcount = DB::table('requests')->where('plate_no', 'Like', '%'.$input.'%')
                                  ->orWhere('driver', 'Like', '%'.$input.'%')
                                  ->orWhere('start_time', 'Like', '%'.$input.'%')->where('driver', Auth::user()->username)->count();
        $requests = DB::table('requests')->where('plate_no', 'Like', '%'.$input.'%')
                                  ->orWhere('driver', 'Like', '%'.$input.'%')
                                  ->orWhere('start_time', 'Like', '%'.$input.'%')->where('driver', Auth::user()->username)->orderBy('id', 'DESC')->paginate(50);
        }

        return view('exitRequest.exitRequests',['requests'=>$requests, 'Rcount'=>$Rcount, 'input'=>$input]);
    }
}
