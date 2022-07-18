<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use App\Model\KategoriPerpustakaan;
use App\User;
use JsValidator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Default fungsi dari laravel, menuju from login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function rulesRegister()
    {
        $rules = [
            'nama' => 'required',
            'username' => 'required|unique:tb_user',
            'password' => 'required',
            'kategori_perpustakaan' => 'required',
            'perpustakaan' => 'required'
        ];

        return $rules;
    }

    // Form register
    public function showRegisterForm()
    {
        return view('auth.register', [
            'kategoriperpus' => KategoriPerpustakaan::orderBy('jenisperpustakaan_id','asc')->get(),
            'JsValidator' => JsValidator::make($this->rulesRegister())
        ]);
    }

    public function register(Request $request)
    {
        $data = $this->validate($request, $this->rulesRegister());

        $cek = User::where('perpustakaan_id', $request->perpustakaan)->first();
        if($cek != null) {
            return redirect()->route('registerform')->with('status','User Sudah Ada Pada Perpustakaan Ini');
        } else {
            $db = new User;
            $db->nama = $request->nama;
            $db->username = $request->username;
            $db->password = bcrypt($request->password);
            $db->perpustakaan_id = $request->perpustakaan;
            $db->tipe = 'User';
            $db->status = 'Verifikasi';

            if($db->save()) {
                return redirect()->route('registerform')->with('status','User Berhasil di Daftarkan, Tinggal Menunggu Verifikasi dari Admin');
            }
        }
    }

    public function login(Request $request)
    {
        if (Auth::attempt([
                'username' => $request->username,
                'password' => $request->password,
            ]))
        {
            return redirect()->intended('/');
        }

        return redirect()->guest('/login')->with('status','Username atau Password Salah');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/');
    }
}
