<?php
namespace App\Http\Controllers;

use Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use function Laravel\Prompts\password;
use Illuminate\Support\Facades\Cache;

class LoginController extends Controller
{
    public function login(){
        if (Auth::check()) {
            return redirect('/');
        }else{
            return view('auth.login');
        }
    }


    public function actionlogin(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $attemptKey = 'login_attempts_' . $email;
        $lockKey = 'login_locked_' . $email;

        if (Cache::has($lockKey)) {
            $lockTime = Cache::get($lockKey);
            $secondsLeft = $lockTime - time();

            if ($secondsLeft > 0) {
                return back()->with('error', "Sabar yah. Tunggu $secondsLeft detik sebelum mencoba lagi.");
            } else {
                Cache::forget($lockKey);
            }
        }

        $user = User::where('email', $email)->first();
        if (!$user) {
            return back()->with('error', 'Email tidak terdaftar.');
        }

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            Cache::forget($attemptKey);
            return redirect('/');
        } else {
            $attempts = Cache::get($attemptKey, 0) + 1;
            Cache::put($attemptKey, $attempts, 300);

            if ($attempts >= 5) {
                $lockTime = time() + 60;
                Cache::put($lockKey, $lockTime, 60);
                return back()->with('error', 'Sudah error 5 kali. Tunggu 60 detik sebelum mencoba kembali yah.');
            }

            return back()->with('error', 'Password salah.');
        }
    }




    public function actionlogout(){
        Auth::logout();
        return redirect('/');
    }

    public function registrasi(){
        return View('auth.registrasi');
    }

    public function create(Request $request) {
        Session::flash('name', $request->name);
        Session::flash('email', $request->email);
        Session::flash('number_phone', $request->number_phone);
        Session::flash('alamat', $request->alamat);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'number_phone' => 'required',
            'alamat' => 'required',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Silakan masukkan email yang valid.',
            'email.unique' => 'Email sudah pernah digunakan, silakan pilih email yang lain.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password harus memiliki minimal 6 karakter.',
            'number_phone.required' => 'Nomor telepon wajib diisi.',
            'number_phone.integer' => 'Nomor telepon harus berupa angka.',
            'alamat.required' => 'Alamat wajib diisi.',
        ]);


        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'User',
            'alamat' => $request->alamat,
            'number_phone' => $request->number_phone,
        ];

        User::create($data);

        return redirect('/login');
    }
}
