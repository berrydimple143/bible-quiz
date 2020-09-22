<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FunctionController;
use App\Rules\HasPassword;
use App\Post;
use App\Comment;
use Carbon\Carbon;
use App\User;
use Storage;
use Image;

class HomeController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    public function index() {
        $u = Auth::user();
        if($u->status == "active") {
            $now = Carbon::now();
            $yesterday = $now->subDay();
            if($u->membership == "admin") {
                $pcntr = Post::where('id', '!=', null)->count();
                $ccounter = Comment::where('id', '!=', null)->count();
                $vcounter = Post::where('id', '!=', null)->sum('visit');
                $nccounter = Comment::where('created_at', '>=', $yesterday)->count();
            } else {
                $posts = Post::withCount('comments')->where('user_id', $u->id)->get(); 
                $vcounter = Post::where('user_id', $u->id)->sum('visit');
                $ccounter = $nccounter = 0;
                foreach($posts as $p) {
                    $ccounter = $ccounter + $p->comments_count;
                    $nccounter += Comment::where('post_id', $p->id)->where('created_at', '>=', $yesterday)->count();
                }
                $pcntr = $posts->count();
            }
            $params = ['pcntr' => $pcntr, 'nccounter' => $nccounter, 'vcounter' => $vcounter, 'ccounter' => $ccounter, 'greetings' => FunctionController::getGreetings(), 'quote' => FunctionController::getQuotes(), 'display' => FunctionController::getDisplay()];
            return FunctionController::viewPage($u, '', 'Online Storehouse Administration Panel', '', 'admin.dashboard.dashboard', 'menu1', $params);
        } else {
            return FunctionController::viewPage($u, '', 'Online Storehouse Administration Panel', FunctionController::getErrors('dashboard'), 'admin.errors.expired', 'menu1', '');
        }
    }
    public function picture_update(Request $request) {
        $v = $request->validate([
            'picture' => 'required',
        ]);
        $user = Auth::user();
        if ($request->hasFile('picture')) {
            if ($request->file('picture')->isValid()) {
                $file = $request->file('picture');
                $ext = $file->extension();
                $fileTypes = ['jpg' => 'jpg', 'jpeg' => 'jpeg', 'bmp' => 'bmp', 'png' => 'png', 'gif' => 'gif'];
                if(array_has($fileTypes, $ext)) {
                    $image = Image::make($file)->resize(48, 48);
                    $path = FunctionController::genPath('profiles', $user->id, $ext);
                    Storage::disk('uploads')->put($path, (string) $image->encode());
                    $fn = explode("/", $path);
                    $data = ['picture' => $fn[1]];		
        			$p = User::where('id', Auth::id())->update($data);
        			return redirect()->route('dashboard')->with('newstatus', 'Your profile picture has been changed successfully!');
                } else {
                    return FunctionController::viewPage($user, '', 'Image Upload Error', "The file you've uploaded is not an image.", 'admin.errors.photo', 'menu6', '');
                }
            } else {
                return FunctionController::viewPage($user, '', 'Image Upload Error', "Invalid file.", 'admin.errors.photo', 'menu6', '');
            }
        }
    }
    public function picture_change() {
        $u = Auth::user();
        return FunctionController::viewPage($u, '', 'Online Storehouse Administration Panel - Change Profile Picture', '', 'admin.dashboard.picture_form', 'menu1', '');
    }
    public function email_change() {
        $u = Auth::user();
        return FunctionController::viewPage($u, '', 'Online Storehouse Administration Panel', '', 'admin.dashboard.email_form', 'menu1', '');
    }
    public function email_update(Request $request) {
        $v = $request->validate([
            'email' => 'required|string|email|max:60|unique:users',
        ]);
        $p = User::where('id', Auth::id())->update(['email' => $request->input('email')]);
        return redirect()->route('dashboard')->with('newstatus', 'Your email has been changed successfully!');
    }
    public function password_update(Request $request) {
        $v = $request->validate([
            'oldpassword' => ['required', 'string', 'min:8', new HasPassword],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $p = User::where('id', Auth::id())->update(['password' => bcrypt($request->input('password'))]);
        return redirect()->route('dashboard')->with('newstatus', 'Your password has been changed successfully!');
    }
    public function profile(Request $request) {
        $v = $request->validate([
            'firstname' => 'required|string|max:60',
            'lastname' => 'required|string|max:60',
        ]);
        $data = [
            'firstname' => $request->input('firstname', ''),
            'lastname' => $request->input('lastname', ''),
            'description' => $request->input('description', ''),
            'middlename' => $request->input('middlename', ''),
            'website' => $request->input('website', ''),
            'facebook' => $request->input('facebook', ''),
            'twitter' => $request->input('twitter', ''),
            'linkedin' => $request->input('linkedin', ''),
            'portfolio' => $request->input('portfolio', ''),
        ];
        $p = User::where('id', Auth::id())->update($data);
        return redirect()->route('dashboard')->with('newstatus', 'Your profile has been updated successfully!');
    }
    public function logout() {
        return redirect()->route('site')->with(Auth::logout());
    }
}
