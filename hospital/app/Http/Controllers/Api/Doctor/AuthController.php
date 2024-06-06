<?php

namespace App\Http\Controllers\Api\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DoctorLoginRequest;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\Sanctum;

class AuthController extends Controller
{
    public function login(DoctorLoginRequest $request)
    {

        $doctor = Doctor::query()->where('mobile', $request->input('mobile'))->first();

        if (!$doctor || !Hash::check($request->input('password'), $doctor->password)) {
            return Response()->error("اطلاعات وارد شده صحیح نمیباشد!", [], 422);
        }

//        if (Auth::guard('doctor-api')->attempt($request->only('mobile', 'password'))) {
//            $token = Auth::guard('doctor-api')->user()->createToken('access-surgeries')->plainTextToken;
//            return response()->json(['token' => $token]);
//        }
        $token = $doctor->createToken('authToken');
        Sanctum::actingAs($doctor);

        $data = [
            'doctor' => $doctor,
            'access_token' => $token->plainTextToken,
            'token_type' => 'Bearer'
        ];

       // return response()->ssucess('دکتر با موفقیت وارد شد ', compact('data'));
        return response()->json([
            'success' => true,
            'message' => '',
            'data' => $data
        ], 200);
    }

    public function logout(Request $request)
    {
//        $doctor=$request->user();
        $doctor = Auth::guard('doctor-api')->user();
        $doctor->currentAccessToken()->delete();
        return response()->success('دکتر با موفقیت خارج شد');

    }
}
