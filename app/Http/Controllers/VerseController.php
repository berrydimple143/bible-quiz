<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\FunctionController;
use Illuminate\Support\Facades\Auth;
use App\Verse;
use App\Topic;
use App\Book;

class VerseController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('allowed');
    }
    public function index() {
        $verses = Verse::where('created_at', '!=', null)->orderBy('chapter', 'asc')->get();
        return FunctionController::viewPage(Auth::user(), $verses, 'Bible Verses Table', '', 'admin.verses.verses', 'menu11', '');
    }
    public function create() {
        $topics = Topic::withCount('verses')->where('id', '!=', null)->orderBy('title', 'asc')->get();
        $books = Book::where('id', '!=', null)->orderBy('name', 'asc')->get();
        $params = ['btn' => 'CREATE', 'topics' => $topics, 'books' => $books];
        return FunctionController::viewPage(Auth::user(), '', 'Bible Verses Creator', '', 'admin.verses.verse_add', 'menu11', $params);
    }
    public function store(Request $request) {
        $v = $request->validate([
            'message' => 'required|string',
            'topic_id' => 'required',
            'book_id' => 'required',
        ]);
        $msg = trim($request->input('message')," ");
        $data = [
            'message' => $msg,
            'topic_id' => $request->input('topic_id'),
            'book_id' => $request->input('book_id'),
            'chapter' => $request->input('chapter', ''),
            'verse' => $request->input('verse', ''),
        ];
        $t = Verse::create($data);
        return redirect()->route('verses');
    }
    public function edit($id) {
        $verse = Verse::find($id);
        return FunctionController::viewPage(Auth::user(), $verse, 'Bible Verse Editor', '', 'admin.verses.verse_edit', 'menu11', ['btn' => 'SAVE CHANGES']);
    }
    public function update(Request $request, $id) {
        $v = $request->validate([
            'message' => 'required|string',
        ]);
        $msg = trim($request->input('message')," ");
        $data = [
            'message' => $msg,
            'chapter' => $request->input('chapter', ''),
            'verse' => $request->input('verse', ''),
        ];
        $v = Verse::where('id', $id)->update($data);
        return redirect()->route('verses');
    }
    public function delete($id) {
        $verse = Verse::find($id);
        return FunctionController::viewPage(Auth::user(), $verse, 'Bible Verse Remover', '', 'admin.verses.verse_delete', 'menu11', '');
    }
    public function destroy($id) {
        $v = Verse::destroy($id);
        return redirect()->route('verses');
    }
}
