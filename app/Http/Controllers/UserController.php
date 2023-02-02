<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\PasswordReset;
use Carbon\Carbon;
use Auth;
use Str;
use Mail;
use DB;
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

// use Session;

class UserController extends Controller
{
   function user_login(Request $req){

        $validator = Validator::make($req->all(),[
            'email' => 'required|email|exists:users',
            'password' => [
                'required',
                'min:5',
                'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9]).*$/',
            ]
        ]);

        $user =  User::where(['email'=>$req->email])->first();

        if($validator->passes()){
            if(!$user || !Hash::check($req->password,$user->password)){
                return response()->json(['notexists' => "Username and password does not matched"]);
            }else{
                $req->session()->put('user',$user);
                return response()->json(['success' => 'Sucessfully Logged In']);
            }
        }else{ 
                return response()->json(['error' => $validator->errors()]);
        } 
    }

    public function save_user(Request $req){
        

        $validator = Validator::make($req->all(),[
            'name' => 'required|regex:/^[a-zA-Z]/u',
            'email' => 'required|email',
            'password' => [
                'required',
                'min:5',
                'max:15',
                'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9]).*$/',
            ]
        ]);

        $user = User::where('email',$req['email'])->first();
        
        if($validator->passes()){
            if($user){
                return response()->json(['exists' => "User already Exists" ]);
            }
            else{
                $user = new User;
                $user->name = $req['name'];
                $user->email=$req['email'];
                $user->password = Hash::make($req['password']);
                $user->save();
                return response()->json(['success'=> 'User Registered sucessfully']);
            }
        }
        else{  
            // return response()->json(['success' => $req->email ]);       
                return response()->json(['error' => $validator->errors() ]);
        }
    }

//------------------forget password--------------------------------------------------

    public function forgetPass()
          {
            return view("forgetpwd");
          }

    function newpass(Request $request){

        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
        ]);

        $user = User::where('email',$request['email'])->first();
        
        if($validator->passes()){
            if($user){

                $token = str::random(40);
                DB::table('password_resets')->insert([
                    'email' => $request->email,
                    'token' => $token,
                    'expire_at'=>Carbon::now()->addMinutes(10)->toDateTimeString()
                    ]);
            
                    $action_link = route('password-reset', ['token'=>$token, 'email'=>$request->email]);

                $body="You can reset your password by clicking the link below.";

                Mail::send('email-forgot', ['action_link'=> $action_link, 'body'=> $body], 
                    function($message) use($request){
                        $message->from('lokeshwakode@globussoft.in');
                        $message->to($request->email)
                                ->subject('reset password');
                    });

                return response()->json(['success'=> 'Reset link send sucessfully']);
            }else{
                return response()->json(['notexists'=> 'user not exists']);
            }
            
        }else{

            return response()->json(['error' => $validator->errors()]);

        }

    }

    public function passwordReset(Request $request, $token=null){

                return view("password-reset")->with(['token'=>$token, 'email'=>$request->email]);
        }

    public function reset(Request $request)
        {
            $validator = Validator::make($request->all(),[
                'password' => [
                    'required',
                    'min:5',
                    'max:15',
                    'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9]).*$/',
                ],
                'newpassword' => 'required|same:password',
            ]);

            if($validator->passes()){

                
                $check_token = \DB::table('password_resets')->where([
                    'email' => $request->email,
                    'token' => $request->token,
                ])->first();

                if($check_token){

                    User::where('email',$request->email)->update([
                        'password'=> Hash::make($request->password)
                    ]);

                    DB::table('password_resets')->where([
                        'email'=>$request->email
                    ])->delete();

                        return response()->json(['success'=> 'Password reset Sucessfully']);
                    }
                else{
                    return response()->json(['token'=> $check_token]);
                    }
                
            }else{
                return response()->json(['error' => $validator->errors()]);
            }
        }

// public function newpass(Request $request)

    //     {
            
    //         // $request->validate([
    //         //     'email' => 'required|email|exists:users,email',
    //         //     'password' => 'required|min:6|max:10|confirmed|regex:/^\S*$/u',
    //         //     'password_confirmation' => 'required'
    //         // ]);

            
    //         $val = $validator->errors()->toArray();


    //         if($validator->passes()){
    //             // $req->session();
    //             // return redirect()->with('msg','sucessfully registered ');
    //             return dd('IF statment');

    //         }else{
    //             // $req->session();
    //             // return redirect()->with('fail','fail msg');
    //             return dd('else');

    //         }

    //     }
//     $body="You can reset your password by clicking the link below.";
//                     $phpmailer = new PHPMailer();
//                     $phpmailer->isSMTP();
//                     $phpmailer->Host = 'smtp.mailtrap.io';
//                     $phpmailer->SMTPAuth = true;
//                     $phpmailer->Port = 2525;
//                     $phpmailer->Username = '50e88bec48bdb4';
//                     $phpmailer->Password = '645289f395f63f';
}
