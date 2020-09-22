<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FunctionController;
use Image;
use App\Photo;
use App\Manipulate;
use Storage;

class PhotoController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    public function index() {
        $u = Auth::user();
        if($u->membership == "admin") {
            $m = Photo::where('id', '!=', null)->get();
        } else {
            $m = Photo::where('user_id', $u->id)->where('status', 'active')->get();
        }
        if(FunctionController::isExpired($u)) {
            return FunctionController::viewPage($u, '', 'Photo Table Error', FunctionController::getErrors('photo'), 'admin.errors.expired', 'menu6', '');
        } else {
            return FunctionController::viewPage($u, $m, 'Photo Table', '', 'admin.photos.photos', 'menu6', FunctionController::getLimit('photo'));
        }
    }
    public function create() {
        $user = Auth::user();
        if(FunctionController::isLimit($user->id, $user->membership, 'photo') == 'limit exceeded') {
            return FunctionController::viewPage($user, '', 'Limit Exceeded', "The number of image you've uploaded has reached to its limit.", 'admin.errors.limit', 'menu6', '');
        } else if($user->status == "inactive") {
            return FunctionController::viewPage($user, '', 'Photo Table Error', FunctionController::getErrors('photo_add'), 'admin.errors.expired', 'menu6', '');
        } else {
            return FunctionController::viewPage($user, '', 'IMAGE UPLOADER', '', 'admin.photos.photo_add', 'menu6', ['btn' => 'UPLOAD', 'stat1' => 'checked', 'stat2' => '']);
        }
    }
    public function store(Request $request) {
        $v = $request->validate([
            'title' => 'required|string|max:120',
            'description' => 'string|nullable|max:254',
            'filename' => 'required',
        ]);
        $user = Auth::user();
        if ($request->hasFile('filename')) {
            if ($request->file('filename')->isValid()) {
                $file = $request->file('filename');
                $ext = $file->extension();
                $fileTypes = ['jpg' => 'jpg', 'jpeg' => 'jpeg', 'bmp' => 'bmp', 'png' => 'png', 'gif' => 'gif'];
                if(array_has($fileTypes, $ext)) {
                    $man = Manipulate::where('id', '!=', null)->first();
                    if($man->format == "normal") {
                        $image = Image::make($file);
                    } else if($man->format == "widen") {
                        $image = Image::make($file)->widen($man->width);
                    } else if($man->format == "heighten") {
                        $image = Image::make($file)->heighten($man->height);
                    } else if($man->format == "resize") {
                        $image = Image::make($file)->resize($man->width, $man->height);
                    }
                    $path = FunctionController::genPath('photos', $user->id, $ext);
                    Storage::disk('uploads')->put($path, (string) $image->encode());
                    $fn = explode("/", $path);
                    $data = [
        				'user_id' => $user->id,
        				'title' => $request->input('title', ''),
        				'description' => $request->input('description', ''),
        				'filename' => $fn[1],
        			];				
        			$p = Photo::create($data);
        			return redirect()->route('photos');
                } else {
                    return FunctionController::viewPage($user, '', 'Image Upload Error', "The file you've uploaded is not an image.", 'admin.errors.photo', 'menu6', '');
                }
            } else {
                return FunctionController::viewPage($user, '', 'Image Upload Error', "Invalid file.", 'admin.errors.photo', 'menu6', '');
            }
        }
    }
    public function select($id) {
        $m = Photo::where('id', $id)->first();
        return FunctionController::viewPage(Auth::user(), $m, 'SELECT AN ACTION', '', 'admin.photos.photo_select', 'menu6', ['btn1' => 'EDIT DETAILS', 'btn2' => 'DELETE', 'btn3' => 'ACTIVATE', 'btn4' => 'DE-ACTIVATE', 'btn5' => 'DESELECT']);
    }
    public function deactivate($id) {
        $p = Photo::where('id', $id)->update(['status' => 'inactive']);
        return redirect()->route('photo.select', ['id' => $id]);
    }
    public function deselect($id) {
        $p = Photo::where('id', $id)->update(['selected' => 'no']);
        return redirect()->route('photos');
    }
    public function activate($id) {
        $p = Photo::where('id', $id)->update(['status' => 'active']);
        return redirect()->route('photo.select', ['id' => $id]);
    }
    public function edit($id) {
        $user = Auth::user();
        if($user->status == "inactive") {
            return FunctionController::viewPage($user, '', 'Photo Table Error', FunctionController::getErrors('photo_edit'), 'admin.errors.expired', 'menu6', '');
        } else {
            $m = Photo::where('id', $id)->first();
            $sc1 = $sc2 = ""; 
            if($m->status == "active") { $sc1 = "checked"; } else { $sc2 = "checked"; }
            return FunctionController::viewPage(Auth::user(), $m, 'IMAGE EDITOR', '', 'admin.photos.photo_edit', 'menu6', ['btn' => 'SAVE CHANGES', 'stat1' => $sc1, 'stat2' => $sc2]);
        }
    }
    public function update(Request $request, $id) {
        $v = $request->validate([
            'title' => 'required|string|max:120',
            'description' => 'string|nullable|max:254',
        ]);
        $u = Auth::user();
        if($u->membership == "admin") {
            $stat = $request->input('status', '');
        } else {
            $ph = Photo::where('id', $id)->first();
            $stat = $ph->status;
        }
        $data = [
			'title' => $request->input('title', ''),
			'description' => $request->input('description', ''),
			'status' => $stat,
		];
        $p = Photo::where('id', $id)->update($data);
        return redirect()->route('photos');
    }
    public function delete($id) {
        $u = Auth::user();
        if($u->status == "inactive") {
            return FunctionController::viewPage($u, '', 'Photo Table Error', FunctionController::getErrors('photo_delete'), 'admin.errors.expired', 'menu6', '');
        } else {
            $p = Photo::find($id);
            if($p->selected == "yes") {
                return FunctionController::viewPage($u, $p, 'Image Remove Error', "This image has been used somewhere else in your article/post.", 'admin.errors.photo', 'menu6', '');   
            } else {
                return FunctionController::viewPage($u, $p, 'IMAGE REMOVER', '', 'admin.photos.photo_delete', 'menu6', '');
            }
        }
    }
    public function destroy($id) {
        $u = Auth::user();
        $p = Photo::find($id);
        $img = public_path('/uploads/photos/'.$p->filename);
        if (!unlink($img))  {
            return FunctionController::viewPage($u, $p, 'Image Remove Error', "Error deleting this image", 'admin.errors.photo', 'menu6', '');
        } else {
            $ph = Photo::destroy($id);
            return redirect()->route('photos');
        }
    }
}
