<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use GuzzleHttp\Client;
use Illuminate\Support\Carbon;
use App\Models\User;
use Auth;

class AdminController extends Controller
{


    public function index()
    {
        
        return view('Backend.pages.Home');
    }


    // this function for admin login
    public function adminlogin(Request $request)
    {
        // DB::table('admins')->insert(['email' => 'prashanth@gmail.com', 'password' => md5('root')]);

        $email = $request->email;
        $password = $request->password;
        $data = DB::table('admins')->where('email', $email)->where('password', md5($password))->first();
        if ($data) {
            $request->session()->put('user', $email);
            return redirect('dashboard');
            return redirect()->back()->with('success', 'Login Successful');

        } else {
            return redirect()->back()->with('error', 'incorrect login crediantials please enter valid details');
        }
    }

    // get employees details view
    public function get_employee(){
        
        $data= DB::table('employees')
                ->join('users', 'employees.userID', '=', 'users.id')
                ->paginate(10);
                
        return view('Backend.pages.EmployeeManagement')->with('data', $data);
    }

    // get employers details view
    public function get_employers(){
        $data=DB::table('employers')->paginate(10);
        return view('Backend.pages.EmployerManagement')->with('data', $data);
    }



    // get methods for view 
    public function home(){
        return view('Frontend.pages.home');
    }
    // get methods for view 
    public function search(){
        return view('Frontend.pages.search');
    }

    // post employee guzzle 
    public function employee_post(Request $request){
        $request->validate([
            'role' => 'required',
            'resume' => 'required|mimes:pdf,docx|max:5000'
        ]);

        $file = $request->file('resume');
        $name = $file->getClientOriginalName();
        $file->move(public_path() . '/user-assets/resumes/', $name);
        $path = 'user-assets/resumes/' . $name;
        $user_id = Auth::user()->id;
 
        $result = DB::table('employees')
            ->insert(['role' =>json_encode($request->role), 'resume' => $path, 'userID'=>$user_id,
             'created_at' => Carbon::now()]);
        if ($result) {

            return redirect()->back()->with('success', 'Successfully submited');
        }else{
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }


    // get all resume requests
    public function get_requests(){
        $unmactches=DB::table('unmatches')->get();
        return view('Backend.pages.Unmatched', compact('unmactches'));
    }

    // get all jobtypes
    public function get_jobstype(){
        $jobs=DB::table('jobnames')->get();
        return view('Backend.pages.jobtyps', compact('jobs'));
    }

    // adding new job types
    public function post_jobstype(Request $request){
        $job=$request->jobs;
        $check=DB::table('jobnames')->where('type', $job)->get();
        if(count($check)>0){
            return redirect()->back()->with('error', 'This Job Type already exisited');
        }

        $result=DB::table('jobnames')->insert(['type'=>$job]);
        if($result){
            return redirect()->back()->with('success', 'Successfully new one added');
        }else{
            return redirect()->back()->with('error', 'Something went wrong');
        }

    }

    // remove jobtype
    public function deletejob($id){
        $result=DB::table('jobnames')->where('id', $id)->delete();
        if($result){
            return redirect()->back()->with('error', 'Jobe type deleted');
        }else{
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }




    public function Employer(Request $request){
        $skills['skills']=$request->skill;
        $apikey='2cff30e1-f0c2-44e1-96e1-82a45b075461';
        $curl = curl_init();
        // return print_r($skills);
        $somefeilds=array('email' =>$request->email,'name' =>$request->name,'apikey' =>$apikey);
        $data=array_merge_recursive($somefeilds, $skills);
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://jobs.analogit.in/api/admin/add_employer',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>http_build_query($data),
        ));

        $response = curl_exec($curl);
        // return $response;
        curl_close($curl);
        $response=json_decode($response, true);
        if($response['status']==0){
        return response()->json(['error'=>$response['error']]);
        }
        return response()->json(['success'=>$response['success']]);

    }




    public function web_privacy_policy(){
        return view('Frontend.pages.Web_privacy');
    }


    public function app_privacy_policy(){
        return view('Frontend.pages.App_privacy');
    }

    
}
