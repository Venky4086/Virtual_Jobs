<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\employee;
use App\Models\employer;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Mail;
use App\Jobs\QueueJob;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Mail\employerEmailVerify;
use GuzzleHttp\Client;
use Socialite;
use Auth;
use App\Models\filedownload;
use Exception;
use DateTime;


class jobController extends Controller
{

    // post employee+
    public function add_employee(Request $request)
    {
        // return $request->all();
        $rules = array(
            'role' => 'required',
            'resume'=>'required|mimes:pdf,docx|max:6000',
            'userID'=>'required'
        );


        $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response($validator->errors(), 422);
            }

        $this->validate($request, ['resume' => 'required',]);
        $file = $request->file('resume');
        $name = $file->getClientOriginalName();
        $file->move(public_path() . '/user-assets/resumes/', $name);
        $path = 'user-assets/resumes/' . $name;

        $user_id = $request->userID;
        $role=json_decode($request->role, true, JSON_UNESCAPED_SLASHES);
        $result = DB::table('employees')
            ->insert(['role' => json_encode($role, true), 'userID'=>$user_id, 'resume' => $path, 
            'created_at' => Carbon::now()]);

        if ($result) {
            return response()->json(['success' => 'Your details has been submitted']);
        }else{
            return response()->json(['error' => 'Something went wrong']);

        }
    }

    // verify email
    public function add_employer(Request $request){
        $email=$request->email;
        $name=$request->name;
        $skills=$request->skills;
        if($email == ""){
            return response()->json(['status'=>0, 'error'=>'Email is required'], 400);
        }
        if($name == ""){
            return response()->json(['status'=>0,'error'=>'Name is required'], 400);
        }
        if($skills == ""){
            return response()->json(['status'=>0, 'error'=>'Skills is required'], 400);
        }

         $User = User::where('email', $email)->first();
            if($User){
                return response()->json(['status'=>0, 'error'=>'This mail id already registered as a employee'], 400);
            }

            // Checking Email Validation
            $mailcheck = substr($email, strpos($email, "@") + 1);
            $mailresult=DB::table('blacklistmails')->where('mail', $mailcheck)->count();
            if($mailresult>0){
                return response()->json(['status'=>0, 'error'=>'invalid email'], 400);
            }
        
            $result=DB::table('employers')->where('email', $email)->get();
            if(count($result)>0){
                // User Found to run this code
                if($result[0]->status==1){
                    $key=Str::random(32);
                    for($i=0; $i<count($skills); $i++){
                        $data = DB::table('employees')->Where('role', 'like', '%' . $skills[$i] . '%')->where('matched_times', '=', 0)->first();
                        $details=[];
                        if($data){
                            $details[$i]=$data;
                            if($i<3){
                                DB::table('employees')  
                                ->where('id', $details[$i]->id)
                                ->update(['token' =>$key, 'matched_times'=>1,  'updated_at' => Carbon::now()]);
                            }
                        }  
                    }

                    

                    // return print_r($details);
                    if (count($details)>0) {
                        $msg="We found Resume(s) matching your requirements. Please click the link below to access them. Thank you for choosing our platform.";
                        $count=1;
                    }else if (count($details)==0) {
                        $exisiting=DB::table('unmatches')->where('skills', $request->skills)->get();
                        if(count($exisiting)<1){
                            DB::table('unmatches')->insert(
                            ['employer_email'=>$request->email, 
                            'employer_name'=>$request->name, 
                            'skills'=>json_encode($request->skills),
                            'created_at'=>Carbon::now()
                            ]);
                        }
                        $msg="Thank you for choosing our platform. Unfortunately, no Resume(s) has(ve) matched your requirement. Please submit a new request after 24hrs and we can find again as more resumes are added every day.";
                        $count=0;
                    }

                    if ($result[0]->used_times < 1) {

                        $filedownload=new filedownload;
                        $filedownload->user_id=$result[0]->id;
                        $filedownload->token=$key;
                        $filedownload->skills=json_encode($skills);
                        $filedownload->save();
                        
                            $job = (new \App\Jobs\QueueJob($name, $msg, $count, $key, $email))->delay(now()->addSeconds(5));
                            dispatch($job);


                            DB::table('employers')  
                                ->where('email', $email)
                                ->update(['used_times' =>1, 'skill_set'=>json_encode($skills, true), 'updated_at' => Carbon::now()]);

                            return response()->json(['status'=>1, 'success' => 'Your details has been submitted. We have Sent Matched Resumes to Your Mail ID']);
                    } else {
                         return response()->json(['status'=>0, 'error' => 'Your Limit Exceeded']);
                    }

                }

                if($result[0]->status==0){
                        $key=Str::random(32);
                        $update=DB::table('employers')->where('email', $email)->update(['email_verification_token'=>$key, 'skill_set'=>json_encode($skills)]);
                        if($update){
                        $user=['email'=>$email, 'name'=>$name, 'email_verification_token'=>$key];
                        \Mail::to($email)->send(new employerEmailVerify($user));
                        return response()->json(['status'=>0, 'error'=>'Your mail not verified. please verify now. Verification mail sent please verify mail'], 200);
                    }
                }
            }

        $key=Str::random(32);
        $insert=DB::table('employers')->insert(['email'=>$email, 'name'=>$name, 'email_verification_token'=>$key, 'skill_set'=>json_encode($skills), 'created_at'=>Carbon::now()]);
        if($insert){
            $user=['email'=>$email, 'name'=>$name, 'email_verification_token'=>$key, ];
            \Mail::to($email)->send(new employerEmailVerify($user));
            return response()->json(['status'=>0, 'error'=>'Verification mail sent please verify mail'], 200);
        }
    }

    // status 1= success  2=exceeded 3=email not verified



    // sending verification mail
    public function VerifyEmail($token = null)
    {
    	if($token == null) {
            $status=0;
            return view('Frontend.pages.mailsuccess')->with('status', $status);
    	}

       $user = DB::table('employers')->where('email_verification_token',$token)->first();

       if($user == null ){
        $status=0;
        return view('Frontend.pages.mailsuccess')->with('status', $status);
       }
      
       DB::table('employers')->where('email_verification_token', $token)->update(['status' => 1,
       'email_verification_token' => ''
        ]);
        $key=Str::random(32);
        $skills=json_decode($user->skill_set, true);
            for($i=0; $i<count($skills); $i++){
                $data = DB::table('employees')->Where('role', 'like', '%' . $skills[$i] . '%')->where('matched_times', '=', 0)->first();
                $details=[];

                if($data){
                  $details[$i]=$data;
                    if($i<3){
                        DB::table('employees')  
                        ->where('id', $details[$i]->id)
                        ->update(['token' =>$key, 'matched_times'=>1,  'updated_at' => Carbon::now()]);
                    }
                }
            }

            
            if (count($details)>0) {
                $msg="We found Resume(s) matching your requirements. Please click the link below to access them. Thank you for choosing our platform.";
                $count=1;
            } else if (count($details)==0) {
                $msg="Thank you for choosing our platform. Unfortunately, no Resume(s) has(ve) matched your requirement. Please submit a new request after 24hrs and we can find again as more resumes are added every day.";
                $count=0;
            }
            $filedownload=new filedownload;
            $filedownload->user_id=$user->id;
            $filedownload->token=$key;
            $filedownload->skills=json_encode($skills);
            $filedownload->save();
            
                $job = (new \App\Jobs\QueueJob($user->name, $msg, $count, $key, $user->email))->delay(now()->addSeconds(5));
                dispatch($job);
                    DB::table('employers')  
                    ->where('email', $user->email)
                    ->update(['used_times' =>1,  'updated_at' => Carbon::now()]);
            $status=1;
            return view('Frontend.pages.mailsuccess')->with('status', $status);
    }

    

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()

    {

        try {

            $user = Socialite::driver('google')->user();    

            $finduser = User::where('google_id', $user->id)->first();
            $employer = employer::where('email', $user->email)->first();
            if($employer){
                return redirect('/')->with('error', 'This mail id already registered as a employer');
            }
            if($finduser){

                Auth::login($finduser);

                return redirect('/')->with('success', 'login success');

            }else{

                $newUser = User::insert([

                    'name' => $user->name,

                    'email' => $user->email,

                    'google_id'=> $user->id

                ]);

                $lastuser = User::where('google_id', $user->id)->first();
                
                Auth::login($lastuser);

                return redirect('/')->with('success', 'login success');

            }

        } catch (Exception $e) {
            return redirect('auth/google');

        }

    }


    // login user check
    public function googlelogin(Request $request)
    {
            $user = $request->user;
            $finduser = User::where('google_id', $user['id'])->first();
            if($finduser){
                Auth::login($finduser);
                return response()->json(['success'=>'login success'], 200);
            }else{
                $newUser = User::insert([

                    'name' => $user['name'],

                    'email' => $user['email'],

                    'google_id'=> $user['id']

                ]);

                $lastuser = User::where('google_id', $user['id'])->first();
                Auth::login($lastuser);
                return response()->json(['success'=>'login success'], 200);

            }


    }

    public function filedownload($token = null){

        if($token == null) {
            $status=0;
            return view('Frontend.pages.mailsuccess')->with('status', $status);
    	}

        $user = DB::table('filedownloads')->where('token',$token)->first();

       if($user == null ){
        $status=0;
        return view('Frontend.pages.mailsuccess')->with('status', $status);
       }

       $details = DB::table('employees')->where('token', '=', $token)->get();
        return view('Frontend.pages.filedownload', compact('details'));


    }

    public function skillset(){
        $jobs=DB::table('jobnames')->get(['type', 'id']);
        return response()->json(["data"=>$jobs], 200);
    }


}
