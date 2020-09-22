<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\FunctionController;
use Illuminate\Support\Facades\Auth;
use App\Topic;

class TopicController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('allowed');
    }
    public function index() {
        $topics = Topic::where('id', '!=', null)->orderBy('title', 'asc')->get();
        return FunctionController::viewPage(Auth::user(), $topics, 'Bible Topics Table', '', 'admin.topics.topics', 'menu10', '');
    }
    public function create() {
        $params = ['btn' => 'CREATE', 'visibility1' => 'checked', 'visibility2' => ''];
        return FunctionController::viewPage(Auth::user(), '', 'Topic Creator', '', 'admin.topics.topic_add', 'menu10', $params);
    }
    public function store(Request $request) {
        $v = $request->validate([
            'title' => 'required|string|max:254',
        ]);
        $data = [
            'title' => $request->input('title', ''),
            'book' => $request->input('book', ''),
            'chapter' => $request->input('chapter', ''),
            'verse' => $request->input('verse', ''),
            'visible' => $request->input('visible'),
        ];
        $t = Topic::create($data);
        return redirect()->route('topics');
    }
    public function edit($id) {
        $topic = Topic::find($id);
        $vs1 = $vs2 = ""; 
        if($topic->visible == "yes") { $vs1 = "checked"; } else { $vs2 = "checked"; }
        $params = ['btn' => 'SAVE CHANGES', 'visibility1' => $vs1, 'visibility2' => $vs2];
        return FunctionController::viewPage(Auth::user(), $topic, 'Topic Editor', '', 'admin.topics.topic_edit', 'menu10', $params);
    }
    public function update(Request $request, $id) {
        $v = $request->validate([
            'title' => 'required|string|max:254',
        ]);
        $data = [
            'title' => $request->input('title', ''),
            'book' => $request->input('book', ''),
            'chapter' => $request->input('chapter', ''),
            'verse' => $request->input('verse', ''),
            'visible' => $request->input('visible'),
        ];
        $c = Topic::where('id', $id)->update($data);
        return redirect()->route('topics');
    }
    public function delete($id) {
        $topic = Topic::find($id);
        return FunctionController::viewPage(Auth::user(), $topic, 'Topic Remover', '', 'admin.topics.topic_delete', 'menu10', '');
    }
    public function destroy($id) {
        $t = Topic::destroy($id);
        return redirect()->route('topics');
    }
}
