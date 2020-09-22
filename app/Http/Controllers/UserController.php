<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Carbon\Carbon;
use App\Http\Controllers\FunctionController;
use Hash;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('allowed');
    }
    public function index() {
        $user = Auth::user();
        $users = User::where('membership', '!=', null)->orderBy('created_at', 'desc')->get();
        return FunctionController::viewPage($user, $users, 'Users Table', '', 'admin.users.users', 'menu2', '');
    }
    public function create() {
        $user = Auth::user();
        $params = ['mem' => FunctionController::getMemberships(), 'sub' => FunctionController::getSubscriptions(), 'btn' => 'CREATE', 'stat1' => 'checked', 'stat2' => ''];
        return FunctionController::viewPage($user, '', 'User Creator', '', 'admin.users.user_add', 'menu2', $params);
    }
    public function store(Request $request) {
        $v = $request->validate([
            'firstname' => 'required|string|max:60',
            'lastname' => 'required|string|max:60',
            'email' => 'required|string|unique:users',
            'middlename' => 'string|nullable|max:60',
            'password' => 'required|string|min:8|max:255',
        ]);
        $subs = 0;
        $sub = $request->input('subscription', ''); 
        $now = Carbon::now();
        if($sub != '') {
            $subs = (int)$sub;
            if($subs == 1) {
                $exp = $now->addMonth();
            } else if($subs > 1) {
                $exp = $now->addMonths($subs);
            } else {
                $exp = $now->addDays(2);
            }
        } else {
            $exp = $now->addDays(2);
        }
        $data = [
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname', ''),
            'middlename' => $request->input('middlename', ''),
            'email' => $request->input('email', ''),
            'password' => Hash::make($request->input('password')),
            'ip' => \Request::ip(),
            'membership' => $request->input('membership', ''),
            'status' => $request->input('status', ''),
            'activated_at' => Carbon::now(),
            'expired_at' => $exp,
            'subscription' => $subs,
        ];
        $u = User::create($data);
        return redirect()->route('users');
    }
    public function edit($id) {
        $user = Auth::user();
        $usr = User::find($id);
        $sc1 = $sc2 = '';
        if($usr->status == "active") { $sc1 = "checked"; } else { $sc2 = "checked"; }
        $params = ['mem' => FunctionController::getMemberships(), 'sub' => FunctionController::getSubscriptions(), 'btn' => 'SAVE CHANGES', 'stat1' => $sc1, 'stat2' => $sc2];
        return FunctionController::viewPage($user, $usr, 'User Editor', '', 'admin.users.user_edit', 'menu2', $params);
    }
    public function update(Request $request, $id) {
        $v = $request->validate([
            'firstname' => 'required|string|max:60',
            'lastname' => 'required|string|max:60',
            'email' => 'required|string',
            'middlename' => 'string|nullable|max:60',
        ]);
        $subs = 0;
        $sub = $request->input('subscription', ''); 
        if($sub != '') {
            $subs = (int)$sub;
            $now = Carbon::now();
            if($subs == 1) {
                $exp = $now->addMonth();
            } else if($subs == 6 or $subs == 12 or $subs == 24) {
                $exp = $now->addMonths($subs);
            } else {
                $exp = $now->addDays(2);
            }
        }
        $data = [
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname', ''),
            'middlename' => $request->input('middlename', ''),
            'email' => $request->input('email', ''),
            'membership' => $request->input('membership', ''),
            'status' => $request->input('status', ''),
            'activated_at' => Carbon::now(),
            'expired_at' => $exp,
            'subscription' => $subs,
        ];
        $u = User::where('id', $id)->update($data);
        return redirect()->route('users');
    }
    public function delete($id) {
        $user = Auth::user();
        if($user->id == $id) {
            return FunctionController::viewPage($user, '', 'User Delete Error', 'You cannot delete an active user.', 'admin.errors.user', 'menu2', '');
        } else {
            $usr = User::find($id);
            return FunctionController::viewPage($user, $usr, 'User Delete', '', 'admin.users.user_delete', 'menu2', '');
        }
    }
    public function destroy($id) {
        $u = Auth::user();
        $p = User::find($id);
        $pic = $p->picture;
        if($pic != "" or $pic != null) {
            $img = public_path('/uploads/profiles/'.$pic);
            if (!unlink($img))  {
                return FunctionController::viewPage($u, '', 'Image Remove Error', "Error deleting profile picture", 'admin.errors.photo', 'menu2', '');
            } else {
                $u = User::destroy($id);
                return redirect()->route('users');
            }
        } else {
            $u = User::destroy($id);
            return redirect()->route('users');
        }
    }
}
