<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\FunctionController;
use Illuminate\Support\Facades\Auth;
use App\Book;

class BookController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('allowed');
    }
    public function index() {
        $books = Book::withCount('verses')->where('id', '!=', null)->orderBy('priority', 'desc')->get();
        return FunctionController::viewPage(Auth::user(), $books, 'Bible Books Table', '', 'admin.books.books', 'menu9', '');
    }
    public function create() {
        return FunctionController::viewPage(Auth::user(), '', 'Bible Books Creator', '', 'admin.books.book_add', 'menu9', ['btn' => 'CREATE']);
    }
    public function store(Request $request) {
        $v = $request->validate([
            'name' => 'required|string|unique:books,name|max:70',
            'priority' => 'required',
        ]);
        $data = [
            'name' => $request->input('name'),
            'shortname' => $request->input('shortname', ''),
            'priority' => $request->input('priority'),
        ];
        $t = Book::create($data);
        return redirect()->route('books');
    }
    public function edit($id) {
        
    }
    public function update(Request $request, $id) {
        
    }
    public function destroy($id) {
        
    }
}
