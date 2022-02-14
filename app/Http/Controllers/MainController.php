<?php

namespace App\Http\Controllers;

use App\Models\User;      //Initializes model
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;      //Password Hashing
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function register(Request $request){
        //Validate requests
        $fields = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|max:12'
        ]);
        $email = $fields['email'];
        $name = $fields['name'];

        //Insert data into database
        $user = User::create([
            'name' => $fields["name"],
            'email' => $fields["email"],
            'password' => Hash::make($fields["password"])
        ]);

        $verification_code = mt_rand(100000, 999999);
        DB::table('user_verification')->insert([
            'user_id'=>$user->id,
            'token'=>$verification_code
        ]);
        $subject = "Please verify your email address.";
        Mail::send('email.verify', ['name' => $fields['name'], 'verification_code' => $verification_code],
            function($mail) use ($email, $name, $subject){
                $mail->from(getenv('MAIL_FROM_ADDRESS'), "sivatech234@gmail.com");
                $mail->to($email, $name);
                $mail->subject($subject);
            }
        );

        $token = $user->createToken('softech')->plainTextToken;
        return response()->json([
            'success'=> true, 
            'message'=> 'Thanks for signing up! Please check your email to complete your registration.',
            'token' => $token
        ]);
    }

    public function login(Request $request){
        //Validate requests
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where("email", $fields["email"])->first();
        if(!$user || !Hash::check($fields["password"], $user->password)){
            return response([
                'message' => "Wrong credentials"
            ],401);
        }
        $token = $user->createToken("softech")->plainTextToken;
        return response([
            'message' => "login successful",
            'user' => $user,
            'token' => $token
        ],200);
    }


    public function verifyUser($verification_code){
        $check = DB::table('user_verification')->where('token', $verification_code)->first();
        if(!is_null($check)):
            $user = User::find($check->user_id);
            if($user->is_verified == 1):
                return response()->json([
                    'success'=> true,
                    'message'=> 'Account already verified..',
                ]);
            endif;
            $current_time = Carbon::now();
            User::where('id', $user->id)->update(['is_verified' => 1, 'email_verified_at' => $current_time]);
            DB::table('user_verification')->where('token', $verification_code)->delete();
            return response()->json([
                'success'=> true,
                'message'=> 'Your email address is verified successfully.',
            ]);
        endif;
        return response()->json([
            'success'=> false, 
            'error'=> "Verification code is invalid."
        ]);

    }

    public function delete($id){
        $user_id = $id;
        $user = User::find($user_id);
        DB::table('users')->where('id', $user->id)->delete();

        return response()->json([
            'success'=> true,
            'message' => "account has been deleted successfully"
        ]);
    }

    public function userDetails($id){
        $user_id = $id;
        $user = User::find($user_id);

        return response()->json([
            'success'=> true,
            'user' => $user
        ]);
    }

    public function recover_password(Request $request){
        $user = User::where('email', $request->email)->first();
        if(!$user){
            $error_message ='Your email address not found !';
            return response()->json(['success' => false, 'error' => $error_message], 401);
        }
        $email = $request->email;
        $subject = "Password reset token.";
        try{
            $reset_token = mt_rand(100000,999999);
            $timestamp = Carbon::now();
            DB::table('password_resets')->insert(['email'=>$email, 'token'=>$reset_token,'created_at'=>$timestamp]);
            Mail::send('email.password_recovery', ['email' => $email, 'reset_token' => $reset_token],
            function($mail) use ($email, $subject, $reset_token){
                $mail->from(getenv('MAIL_FROM_ADDRESS'), "sivatech234@gmail.com");
                $mail->to($email);
                $mail->subject($subject);
            });
        }catch(\Exception $e){
            //Return with error
            $error_message = $e->getMessage();
            return response()->json([
                'success' => false, 
                'error' => $error_message],
            401);
        }
        return response()->json([
            'success' => true, 
            'message'=> 'A reset email has been sent! Please check your email.'
        ]);
    }

    public function password_reset(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);
        $user = DB::table('users')->where(['email'=> $request->email])->first();
        if(!$user){
            return response()->json([
                'success' => false, 
                'message' => "user does not exist",
            ]);
        }

        $updatedPassword =  DB::table('password_resets')->where([
            'email'=> $request->email, 
            'token'=> $request->token
        ])->first();

        if(!$updatedPassword){
            return response()->json(['error'=>'invalid token']);
        }
        User::where('email', $request->email)->update(['password'=> Hash::make($request->password)]);
        DB::table('password_resets')->where(['email'=> $request->email])->delete();
        return response()->json([
            'message'=>'Your password has been changed!'
        ]);
    }

    public function password_recover(Request $request){
        $email = $request->query('email');
        $token = $request->query('token');
        $check_user = DB::table('users')->where(['email'=> $email])->first();
        if($check_user){
            $user = DB::table('password_resets')->where(['email'=> $email, 'token' => $token])->first();
            if($user){
                $old_timestamp = $user->created_at;
                $current_time = Carbon::now();
                if($old_timestamp >= $current_time){
                    return response()->json([
                        'success' => true, 
                        'user' => $user,
                    ]);
                }
                return response()->json([
                    'success' => false, 
                    'message' => "token already expired",
                ]);
            }
            return response()->json(['success' => false, 'message' => "invalid data",]);
        }
        return response()->json([
            'success' => false, 
            'message' => "user does not exist",
        ]);
    }

}
