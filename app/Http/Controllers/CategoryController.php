<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\User;
use App\Http\Controllers\FunctionController;

class CategoryController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('allowed');
    }
    public function index() {
        $user = Auth::user();
        $categories = Category::withCount('posts')->where('id', '!=', null)->orderBy('name', 'asc')->get();
        return FunctionController::viewPage($user, $categories, 'Categories Table', '', 'admin.categories.categories', 'menu5', '');
    }
    public function create() {
        $user = Auth::user();
        $params = ['btn' => 'CREATE', 'icons' => FunctionController::getIcons(), 'dummycheck1' => '', 'dummycheck2' => 'checked', 'statcheck1' => 'checked', 'statcheck2' => '', 'repcheck1' => '', 'repcheck2' => 'checked'];
        return FunctionController::viewPage($user, '', 'Category Creator', '', 'admin.categories.category_add', 'menu5', $params);
    }
    public function store(Request $request) {
        $v = $request->validate([
            'name' => 'required|string|unique:categories,name|max:60',
            'description' => 'string|nullable|max:254',
        ]);
        $data = [
            'name' => $request->input('name', ''),
            'description' => $request->input('description', ''),
            'dummy' => $request->input('dummy', ''),
            'status' => $request->input('status', ''),
            'icon' => $request->input('icon', ''),
            'reported' => $request->input('reported', ''),
        ];
        $c = Category::create($data);
        return redirect()->route('categories');
    }
    public function show($id) {
        
    }
    public function edit($id) {
        $user = Auth::user();
        $category = Category::find($id);
        $dc1 = $dc2 = $sc1 = $sc2 = $rc1 = $rc2 = ""; 
        if($category->dummy == "yes") { $dc1 = "checked"; } else { $dc2 = "checked"; }
        if($category->status == "active") { $sc1 = "checked"; } else { $sc2 = "checked"; }
        if($category->reported == "yes") { $rc1 = "checked"; } else { $rc2 = "checked"; }
        $params = ['btn' => 'SAVE CHANGES', 'icons' => FunctionController::getIcons(), 'dummycheck1' => $dc1, 'dummycheck2' => $dc2, 'statcheck1' => $sc1, 'statcheck2' => $sc2, 'repcheck1' => $rc1, 'repcheck2' => $rc2];
        return FunctionController::viewPage($user, $category, 'Category Editor', '', 'admin.categories.category_edit', 'menu5', $params);
    }
    public function update(Request $request, $id) {
        $v = $request->validate([
            'name' => 'required|string|max:60',
            'description' => 'string|nullable|max:254',
        ]);
        $data = [
            'name' => $request->input('name', ''),
            'description' => $request->input('description', ''),
            'dummy' => $request->input('dummy', ''),
            'icon' => $request->input('icon', ''),
            'status' => $request->input('status', ''),
            'reported' => $request->input('reported', ''),
        ];
        $c = Category::where('id', $id)->update($data);
        return redirect()->route('categories');
    }
    public function delete($id) {
        $user = Auth::user();
        $category = Category::find($id);
        return FunctionController::viewPage($user, $category, 'Category Remover', '', 'admin.categories.category_delete', 'menu5', '');
    }
    public function destroy($id) {
        $cat = Category::destroy($id);
        return redirect()->route('categories');
    }
}
