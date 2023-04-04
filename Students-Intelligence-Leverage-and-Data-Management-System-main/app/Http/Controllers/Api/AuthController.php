<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\User;
//use Auth;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\Traits\ApiResponse;

class AuthController extends Controller
{
    use ApiResponse;

    public function login(Request $request)
    {
        $rules = [
            'email' => 'required|email|string',
            'password' => 'required|string',
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return $this->fail(400,$validator->errors());
        }
        if(!Auth::attempt(['email'=>$request->email, 'password' => $request->password ])){
            return $this->fail(400,'Invalid credentials!');
        }

        $accessToken = Auth::user()->createToken('authToken')->accessToken;

        return $this->success([
            'user' => Auth::user(),
            'access_token' => $accessToken
        ],'Login successful!');
    }



    public function profile(Request $request)
    {
        try{
            $user = Auth::user();
            $roles = $user->getRoleNames();
            $permission = $user->getAllPermissions();
            return $this->success([
                'user' => $user,
                'roles' => $roles,
                'permission' => $permission
            ],'Profile Data fetched successfully');
        }catch(Exception $e){
            Log::error('Error while fetching user : '.$e->getMessage());
            return $this->fail(400,$e->getMessage());
        }
    }


    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required|string',
            'password' => 'required|string|confirmed'
        ]);

        // match old password
        if (Hash::check($request->old_password, Auth::user()->password)){

            User::find(auth()->user()->id)
            ->update([
                'password'=> Hash::make($request->password)
            ]);

            return response([
                        'message' => 'Password has been changed',
                        'status'  => 1
                    ]);

        }
            return response([
                        'message' => 'Password not matched!',
                        'status'  => 0
                    ]);
    }

    public function sendOtp(Request $request){
        try{
            DB::beginTransaction();
            $rules = [
                'email' => 'required|email|string',
            ];
            $validator = Validator::make($request->all(),$rules);
            if($validator->fails()){
                return $this->fail(400,$validator->errors());
            }
            $user = User::where('email',$request->email)->first();
            if (!$user) {
                return $this->fail(400,'Invalid Email');
            }
            $otp = rand(1000,9999);
            $user->otp = $otp;
            $user->save();
            Mail::send('emails.sendOTP',['otp' => $otp], function ($message) use ($user) {
                $message->to($user->email)->subject('Password Reset OTP!');
            });
            DB::commit();
            return $this->success([
                'user' => $user,
            ],'OTP sent successfully');
        }catch(Exception $e){
            DB::rollBack();
            Log::error('Error while sending OTP : '.$e->getMessage());
            return $this->fail(400,$e->getMessage());
        }
    }

    public function verifyOtp(Request $request){
        try{
            DB::beginTransaction();
            $rules = [
                'email' => 'required|email|string',
                'otp' => 'required|integer',
            ];
            $validator = Validator::make($request->all(),$rules);
            if($validator->fails()){
                return $this->fail(400,$validator->errors());
            }
            $user = User::where('email',$request->email)->first();
            if (!$user) {
                return $this->fail(400,'Invalid Email');
            }
            if ($user->otp == $request->otp) {
                $user->otp = 0;
                $user->save();
                Auth::loginUsingId($user->id);
                $accessToken = Auth::user()->createToken('authToken')->accessToken;
                DB::commit();
                return $this->success([
                    'user' => $user,
                    'access_token' => $accessToken,
                ],'Valid OTP');
            }
            return $this->fail(400,'Invalid OTP');
        }catch(Exception $e){
            DB::rollBack();
            Log::error('Error while sending OTP : '.$e->getMessage());
            return $this->fail(400,$e->getMessage());
        }
    }

    public function updateProfile(Request $request)
    {
        $validData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email'
        ]);

        $user = Auth::user();
        // check unique email except this user
        if(isset($request->email)){
            $check = User::where('email', $request->email)
                     ->where('id', '!=', $user->id)
                     ->count();
            if($check > 0){
                return response([
                    'message' => 'The email address is already used!',
                    'success' => 0
                ]);
            }
        }

        $user->update($validData);


        return response([
                    'message' => 'Profile updated successfully!',
                    'status'  => 1
                ]);
    }


    public function logout(Request $request)
    {
        if(Auth::check()) {
            $user = Auth::user()->token();
            $user->revoke();
            return $this->success([], 'Logged out successfullly.');
        }
        return $this->fail(400,'Unable to logout');
    }

}
