<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use DateTime;

class vehicleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'plate_no' => ['required', 'string', 'max:12', 'unique:vehicles'],
        ]);
    }

    public function list(){
        $Vcount= DB::table('vehicles')->count();
        $vehicles= DB::table('vehicles')->distinct()->orderBy('id', 'DESC')->paginate(50);
        return view('vehicle.vehicles',['vehicles'=>$vehicles, 'Vcount'=>$Vcount, 'input'=>'']);
    }

    function add(Request $request){
        if(Auth::user()->role == 'Vehicle_Manager'){
            $image="";
            $response=0;
            $new_image_name='';

            if($request->file('profile_image')){
                $file= $request->file('profile_image');
                $new_image_name= date('YmdHi').$file->getClientOriginalName();
                $file-> move(public_path('/image/vehicle'), $new_image_name);
            }

            if ($new_image_name == "") {
                $image = 'caravan.png';
            }else {
                $image = $new_image_name;
            }

            $data[]='';
            $data['plate_no']=$request->plate_no;

            if (DB::table('vehicles')->where('plate_no', $request->plate_no)->count() == 0) {
                $response = DB::table('vehicles')->insertOrIgnore([
                    'type'=>$request->type,
                    'model'=>$request->model,
                    'plate_no'=>$request->plate_no,
                    'capacity'=>$request->capacity,
                    'owner'=>$request->owner,
                    'engine_power'=>$request->engine_power,
                    'production_date'=>$request->production_date,
                    'image'=>$image,
                    'created_at'=>new DateTime(),
                ]);
            }else {
                return redirect('/vehicles')->with('danger', 'Failed to save the vehicle! Plate-No is already taken.');
            }

            if ($response == 1) {
                return redirect('/vehicles')->with('success', 'Vehicle information saved successfully!');
            }
            else{
                return redirect('/vehicles')->with('danger', 'Failed to save the vehicle! Incorrect data is detected. Please try again');
            }
        }
        else {
            return redirect('/accessdenied');
        }
    }

    function editVehicle($id){
        $vehicle = DB::table('vehicles')->where('id', $id)->get();
        return view('vehicle.editVehicle', ['vehicle'=>$vehicle, 'id'=> $id]);
    }

    function updateVehicle(Request $request, $id){
        $vehicleImage = DB::table('vehicles')->where('id', $id)->first();

        if(Auth::user()->role == 'Vehicle_Manager'){
            $image="";
            $response=0;
            $new_image_name='';

            if($request->file('profile_image')){
                $file= $request->file('profile_image');
                $new_image_name= date('YmdHi').$file->getClientOriginalName();
                $file-> move(public_path('/image/vehicle'), $new_image_name);
            }

            if ($new_image_name == "") {
                if ($request->pi == '') {
                    $image = $vehicleImage->image;
                }
                else {
                    $image = $request->pi;
                }
            }else {
                $image = $new_image_name;
            }

            $response = DB::table('vehicles')->where('id', $id)->Update([
                'type'=>$request->type,
                'model'=>$request->model,
                'plate_no'=>$request->plate_no,
                'capacity'=>$request->capacity,
                'owner'=>$request->owner,
                'production_date'=>$request->production_date,
                'image'=>$image,
            ]);
            if ($response == 1) {
                return redirect('/vehicles')->with('success', 'Changes are Updated successfully!');
            }
            else{
                return redirect('/vehicles')->with('danger', 'Nothing is Updated. Please try again');
            }
        }
        else {
            return redirect('/accessdenied');
        }
    }
    function delete($id){
        if (Auth::user()->role == 'Vehicle_Manager') {
            $response=0;
            $response = DB::table('vehicles')->where('id', $id)->delete();
            if ($response == 1) {
                return redirect('/vehicles')->with('success', 'Vehicle successfully Deleted!');
            }
            else{
                return redirect('/vehicles')->with('danger', 'Failed to Delete the vehicle! Invalid action detected.');
            }
        }
        else {
            return redirect('/accessdenied');
        }
    }
    function searchVehicle($input){
        $Vcount = DB::table('vehicles')->where('plate_no', 'Like', '%'.$input.'%')
                                  ->orWhere('type', 'Like', '%'.$input.'%')->count();
        $vehicles = DB::table('vehicles')->where('plate_no', 'Like', '%'.$input.'%')
                                  ->orWhere('type', 'Like', '%'.$input.'%')->orderBy('id', 'DESC')->paginate(50);

        return view('vehicle.vehicles',['vehicles'=>$vehicles, 'Vcount'=>$Vcount, 'input'=>$input]);
    }

}
