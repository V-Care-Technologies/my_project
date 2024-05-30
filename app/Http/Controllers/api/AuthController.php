<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Http;
use Hash;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->first()], 400);
        }

        $checkUser=User::where('mobile',$request->mobile)->where('status','0')->where('is_deleted','0')->first();

        $otp =  random_int(1000,9999);
        $otp1 =  "1234";

        // dd($request->phone);
        // $response = Http::withHeaders([
        //     'accept' => 'application/json',
        //     'authkey' => '391534AQdtoB5MBz63fded5dP1',
        //     'content-type' => 'application/json',
        // ])->post('https://control.msg91.com/api/v5/flow/', [
        //     'template_id' => '6502f2f5d6fc0565d1644562',
        //     'sender' => 'VCareT',
        //     'short_url' => '1', // Replace with your desired value
        //     'mobiles' => '91' . $request->phone, // Replace with the desired phone number
        //     'otp' => $otp, // Replace with the desired OTP value
        // ]);
        if ($checkUser) {


            $user=User::find($checkUser->id);
            $user->otp=$otp1;
            $user->update();



        return response()->json([
            'status' => 'success',
            'message' => 'OTP Send successfully',
            // 'otp'=>123456
            'otp' => $otp1,
        ],200);

    } else {

        $user=new User;
        $user->mobile=$request->mobile;
        $user->otp=$otp1;
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'OTP Send successfully',
            // 'otp'=>123456
            'otp' => $otp1,
        ],200);
    }



    }

    /**
     * Show the form for creating a new resource.
     */
    public function checkOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|numeric',
            'otp' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->first()], 400);
        }
        // DB::enableQueryLog();
        $userCheckOtp = User::where('mobile', $request->mobile)
            ->where('otp', $request->otp)
            ->where('status', '0')
            ->where('is_deleted', '0')
            ->first();
            // dd(DB::getQueryLog());
        if ($userCheckOtp) {


            return response()->json([
                'status' => 'success',
                'message' => 'Logged in successfully',
                'user' => $userCheckOtp
            ],200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid mobile number or OTP',
                'user' => ''
            ], 400);
        }
    }
}
