<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\AuthRequest;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm():Renderable
    {
return view('admin.auth.login');
    }

    public function login(AuthRequest $request): RedirectResponse
    {
        $credentials = $request->validate([
            'mobile' => 'required|digits:11',
            'password' => 'required|min:3|max:50',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('admin');
        } else {
            toastr()->error('شماره موبایل یا پسورد را اشتباه وارد کردید');
        }

        return back()->withErrors([
            'mobile' => ' اعتبار ارائه شده با سوابق ما مطابقت ندارد',
        ])->onlyInput('mobile');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

}
