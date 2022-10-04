<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\validator;
use App\Models\User;
use DateTime;

class userController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone_no' => ['required', 'string', 'min:10', 'max:14'],
        ]);
    }

    public function users(){
        return DB::table('users')->count();
    }

    function list(){
        if(Auth::user()->role == 'admin'){
            $Ucount= DB::table('users')->count();
            $users= DB::table('users')->distinct()->orderBy('id')->paginate(50);
            return view('user.users',['users'=>$users, 'Ucount'=>$Ucount, 'input'=>'']);
        }
        else {
            return redirect('accessdenied');
        }
    }

    function add(Request $request){
        if(Auth::user()->role == 'admin'){
            $response=0;
            $password = rand(10000000, 100000000);
            $image="";
            $response=0;
            $new_image_name='';

            if($request->file('profile_image')){
                $file= $request->file('profile_image');
                $new_image_name= date('YmdHi').$file->getClientOriginalName();
                $file-> move(public_path('/image/profile'), $new_image_name);
            }

            if ($new_image_name == "") {
                $image = 'default_profile.png';
            }else {
                $image = $new_image_name;
            }

            $data[]='';
            $data['username']=$request->username;
            $data['email']=$request->email;

            if (validator($data)) {
                $response = DB::table('users')->insertOrIgnore([
                    'username'=>$request->username,
                    'role'=>$request->role,
                    'email'=>$request->email,
                    'phone_no'=>$request->phone_no,
                    'profile_image'=>$image,
                    'password'=>Hash::make($password),
                    'created_at'=>new DateTime(),
                ]);
            }
            $id = DB::table('users')->max('id');
            if ($response == 1) {
                if ($request->role == 'Driver') {
                    return view('user.addDriverInfo',['id'=>$id, 'password'=>$password]);
                }
                else {
                    return redirect('/users')->with('success', 'User registration completed successfully! User password is '. $password);
                }
            }
            else{
                return redirect('/addUser')->with('danger', 'Failed to save the user! Incorrect data is detected. Please try again');
        }
    }
        else {
            return redirect('accessdenied');
        }
    }

    function addDriver(Request $request, $id, $password){
        if(Auth::user()->role == 'admin'){
            $response=0;
            $image="";
            $response=0;
            $new_image_name='';

            if($request->file('profile_image1')){
                $file= $request->file('profile_image1');
                $new_image_name= date('YmdHi').$file->getClientOriginalName();
                $file-> move(public_path('/image/driver_licence'), $new_image_name);
            }

            if ($new_image_name == "") {
                $image = 'default_licence.png';
            }else {
                $image = $new_image_name;
            }

            $response = DB::table('users')->where('id',$id)->update([
                'licence'=>$image,
                'licence_expired'=>$request->licence_expired,
            ]);
            if ($response == 1) {
                return redirect('/users')->with('success', 'User registration completed! Driver info saved successfully! User password is '. $password);
            }
            else{
                //  return view('user.addDriverInfo',['id'=>$id, 'password'=>$password, 'danger'=>'Failed to save driver info! Incorrect data is detected. Please try again']);
                return redirect('/addDriverInfo', ['id'=>$id, 'password'=>$password])->with(['danger', 'Failed to save dridver info! Incorrect data is detected. Please try again']);
            }
        }
        else {
            return redirect('accessdenied');
        }
    }

    function editUser($id){
        $user = DB::table('users')->where('id', $id)->get();
        return view('user.editUser', ['user'=>$user, 'id'=> $id]);
    }

    function userProfile($id){
        $user = DB::table('users')->where('id', $id)->get();
        return view('user.userDetail', ['user'=>$user, 'id'=> $id]);
    }
    function updateUser(Request $request, $id){
        $profile_image = DB::table('users')->where('id', $id)->first();

        $userProfile = DB::table('users')->where('id', $id)->first();
        if(Auth::user()->role == 'admin'){
            $image="";
            $response=0;
            $new_image_name='';

            if($request->file('profile_image')){
                $file= $request->file('profile_image');
                $new_image_name= date('YmdHi').$file->getClientOriginalName();
                $file-> move(public_path('/image/profile'), $new_image_name);
            }

            if ($new_image_name == "") {
                if ($request->pi == '') {
                    $image = $profile_image->image;
                }
                else {
                    $image = $request->pi;
                }
            }else {
                $image = $new_image_name;
            }
             // ------- end profile upload ------

            //LICENCE UPLOAD
            $image1="";
            if ($request->role == 'Driver') {
                $new_image_name1='';

                if($request->file('profile_image1')){
                    $file1= $request->file('profile_image1');
                    $new_image_name1= date('YmdHi').$file1->getClientOriginalName();
                    $file1-> move(public_path('/image/driver_licence'), $new_image_name1);
                }

                if ($new_image_name1 == "") {
                    if ($request->pi1 == '') {
                        $image1 = $profile_image->licence;
                    }
                    else {
                        $image1 = $request->pi1;
                    }
                }else {
                    $image1 = $new_image_name1;
                }
            }
            $data[]='';
            $data['username']=$request->username;
            $data['email']=$request->email;

            if (validator($data)) {
                $response = DB::table('users')->where('id', $id)->Update([
                    'username'=>$request->username,
                    'role'=>$request->role,
                    'email'=>$request->email,
                    'phone_no'=>$request->phone_no,
                    'profile_image'=>$image,
                    'licence'=>$image1,
                    'licence_expired'=>$request->licence_expired,
                ]);
            }
            if ($response == 1) {
                return redirect('/users')->with('success', 'Changes are Updated successfully!');
            }
            else{
                return redirect("/editUser/$request->id")->with('danger', 'Nothing is Updated. Please try again');
            }
        }
        else {
            return redirect('accessdenied');
        }
    }
    function delete($id){
        $role='';
        $user = DB::table('users')->where('id', $id)->get();
        foreach($user as $u){
            $role = $u->role;
        }

        if ($role != 'admin' && Auth::user()->role =='admin') {
            $response=0;
            $response = DB::table('users')->where('id', $id)->delete();
            if ($response == 1) {
                return redirect('/users')->with('success', 'user successfully Deleted!');
            }
            else{
                return redirect('/users')->with('danger', 'Failed to Delete the user! Invalid action detected.');
            }
        }
        else {
            return redirect('accessdenied');
        }
    }

    function searchUser($input){
        $Ucount = DB::table('users')->where('username', 'Like', '%'.$input.'%')
                                  ->orWhere('email', 'Like', '%'.$input.'%')->count();
        $users = DB::table('users')->where('username', 'Like', '%'.$input.'%')
                                  ->orWhere('email', 'Like', '%'.$input.'%')->paginate(50);
        $output='123';
        // foreach ($users as $user) {
        //     if(Auth::user()->role == "admin" && $user->role != 'admin'){
        //         $output .= '<tr>
        //         <td>'. $user->id.'</td>
        //         <td>'. $user->username.'</td>
        //         <td>'. $user->email.'</td>
        //         <td>'. $user->phone_no.'</td>
        //         <td>'. $user->role.'</td>
        //         <td>'.
        //       '<a href="/editUser/'.$user->id.'" title="Edit User"
        //         style="border:none; border-radius:4px; text-decoration: none; height: 25px; margin-right: 8px;"
        //         class="btn btn-success btn-sm pr-2 pl-2 ri ri-edit-2-fill"></a>'.

        //         '<a href="deleteUser/'.$user->id.'" title="Delete User"
        //             class="btn btn-danger btn-sm bi bi-trash-fill"
        //             style="height: 25px;"
        //             onclick="return myFunction();"></a>'.
        //       '
        //       </td>
        //     </tr>';
        //     }else {
        //         $output .= '<tr>
        //         <td>'. $user->id.'</td>
        //         <td>'. $user->username.'</td>
        //         <td>'. $user->email.'</td>
        //         <td>'. $user->phone_no.'</td>
        //         <td>'. $user->role.'</td>
        //         <td>'.'</td>
        //     </tr>';
        //     }

        // }

        // return response()->json(['output'=>$users->email], 200);
        return view('user.users',['users'=>$users, 'Ucount'=>$Ucount,'input'=>$input]);
    }

    public function changePassword(Request $request)
    {
        $user = Auth::user();

        $curPassword =$request->input('currentPassword');
        $newPassword = $request->input('renewPassword');

        if (Hash::check($curPassword, $user->password)) {
            DB::table('users')->where('id', Auth::user()->id)->update([
                'password' => Hash::make($request->renewPassword)
            ]);
            // $user_id = $user->id;
            // $obj_user = User::find($user_id)->first();
            // $obj_user->password = Hash::make($newPassword);
            // $obj_user->save();

            // return response()->json(["result"=>true]);
            return redirect('/')->with('success', 'Password changed successfully!');
        }
        else
        {
            // return response()->json(["result"=>false]);
            return redirect('/password')->with('danger', 'failed to change the Password!');
        }
    }

}
