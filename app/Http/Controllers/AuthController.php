<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\RegisterMail;
use App\Models\user_role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function index(Request $request)
    {
        // if ($request->session()->has('badge')) {
        //     $badge = $request->session()->get('badge');
        //     return view('home', ['badge' => $badge]);
        // }
        if (auth()->check()) {
            return view('home');
        }
        /**
         * lakukan redirect login
         */
        return redirect('/login');
    }


    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function resetPassword()
    {
        return view('auth.reset_password');
    }

    public function create_user(Request $request)
    {
        // Validasi input
        request()->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'TTL' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
        ]);

        // Penggabungan nama
        $firstname = $request->firstname;
        $lastname = $request->lastname;
        $nama = $firstname . ' ' . $lastname;

        // Validasi kecocokan password
        if ($request->password != $request->confirm_password) {
            return redirect()->back()->with('error', 'Password does not match');
        }

        // Tetapkan role_id yang valid
        $roleId = 2; // Contoh role_id yang ingin disimpan
        $roleExists = user_role::where('id', $roleId)->exists();
        if (!$roleExists) {
            return redirect()->back()->with('error', 'Role tidak valid');
        }

        // Simpan user baru
        $save = new User();
        $save->nama = $nama;
        $save->email = $request->email;
        $save->password = Hash::make($request->password);
        $save->role_id = $roleId; // Pastikan role_id valid
        $save->remember_token = Str::random(40);
        $save->jenis_kelamin = $request->jenis_kelamin;
        $save->agama = $request->agama;
        $save->TTL = $request->TTL;
        $save->no_hp = $request->no_hp;
        $save->alamat = $request->alamat;
        $save->created_at = now();
        $save->save();

        // Kirim email registrasi
        Mail::to($save->email)->send(new RegisterMail($save));

        return redirect('login')->with('success', 'Your Account Register successfully and Verify your email address');
    }

    public function verifyEmail($token)
    {
        $user = User::where('remember_token', $token)->first();
        if (!empty($user)) {
            $user->email_verified_at = now();
            $user->remember_token = Str::random(40);
            $user->save();
            return redirect('login')->with('success', 'Your Account Verified successfully');
        } else {
            abort(404);
        }
    }

    public function auth_login(Request $request)
    {
        $remember = !empty($request->remember) ? true : false;

        if (auth()->attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            if (!empty(auth()->user()->email_verified_at)) {

                if (auth()->user()->role_id == 1) {
                    return redirect('/dashboard');
                }
                return redirect('/');
            } else {
                auth()->logout();
                return redirect()->back()->with('success', 'Your Account is not verified');
            }
        } else {
            return redirect()->back()->with('error', 'Invalid email or password');
        }
    }

    public function verify($token)
    {
        $user = User::where('remember_token', $token)->first();
        if (!empty($user)) {
            $user->email_verified_at = date('Y-m-d H:i:s');
            $user->remember_token = Str::random(40);
            $user->save();
            return redirect('login')->with('success', 'Your Account Verified successfully');
        }
    }

    public function logout()
    {
        auth()->logout();
        return redirect('login');
    }
}
