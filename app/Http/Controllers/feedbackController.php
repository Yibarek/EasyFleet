<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class feedbackController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function list(){
        $Fcount= DB::table('feedback')->count();
        $feedbacks= DB::table('feedback')->distinct()->orderBy('id', 'DESC')->paginate(50);
        return view('feedback.feedback',['feedbacks'=>$feedbacks, 'Fcount'=>$Fcount, 'input'=>'']);
    }

    function sendFeedback(Request $request){
        $feedbacks = DB::table('feedback')->where('email', $request->email)->where('message', $request->message)->count();
        if ($feedbacks > 0) {
            return redirect('/')->with('danger', 'You already sent this Feedback before! Please send a new one if you have.');
        }
        $response = DB::table('feedback')->insertOrIgnore([
            'profile'=>Auth::user()->profile_image,
            'username'=>Auth::user()->username,
            'email'=>$request->email,
            'message'=>$request->message,
            'status'=>'',
        ]);
        if ($response == 1) {
            return redirect('/')->with('success', 'Feedback sent Successfully! Thanks for giving your feedback.');
        }
        else{
            return redirect('/')->with('danger', 'Unable to send the Feedback! Try again later.');
        }
    }

    function readFeedback($id){
        // $feedbacks = DB::table('feedback')->where('id', $id)->first();
        // if ($feedbacks->status = '') {
            $response = DB::table('feedback')->where('id', $id)->update([
                'status'=>'seen',
            ]);
            return response()->json(['sent'=>$response], 200);
        // }

    }

    function countUncheckedFeedback(){
        $count = DB::table('feedback')->where('status', '')->count();
        return response()->json(['count'=>$count], 200);
    }

    function searchFeedback($input){
        $Fcount = DB::table('feedback')->where('username', 'Like', '%'.$input.'%')
                                  ->orWhere('email', 'Like', '%'.$input.'%')
                                  ->orWhere('message', 'Like', '%'.$input.'%')
                                  ->orWhere('date', 'Like', '%'.$input.'%')->count();
        $feedbacks = DB::table('feedback')->where('username', 'Like', '%'.$input.'%')
                                  ->orWhere('email', 'Like', '%'.$input.'%')
                                  ->orWhere('message', 'Like', '%'.$input.'%')
                                  ->orWhere('date', 'Like', '%'.$input.'%')->orderBy('id', 'DESC')->paginate(50);

        return view('feedback.feedback',['feedbacks'=>$feedbacks, 'Fcount'=>$Fcount, 'input'=>$input]);
    }
}
