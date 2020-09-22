<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Carbon\Carbon;
use App\Http\Controllers\FunctionController;
use App\Subscription;

class RegisterController extends Controller
{
    use RegistersUsers;
    protected $redirectTo = '/control';
    
    public function __construct()
    {
        $this->middleware('guest');
    }
    protected function showRegistrationForm() {
        $reg = Subscription::where('name', 'regular')->first();
        return FunctionController::viewFrontPage('auth.register', '', 'Registration Page', 'Registration Page', 'shop_grid_page', $reg, '');
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => ['required', 'string', 'max:60'],
            'lastname' => ['required', 'string', 'max:60'],
            'email' => ['required', 'string', 'email', 'max:60', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
    protected function create(array $data)
    {
        $now = Carbon::now();
        $trial = $now->addMonth();
        return User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'membership' => 'regular',
            'status' => 'active',
            'ip' => \Request::ip(),
            'activated_at' => Carbon::now(),
            'expired_at' => $trial,
            'subscription' => 0,
        ]);
    }
}
