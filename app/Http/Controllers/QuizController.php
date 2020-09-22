<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FunctionController;
use App\Quiz;
use App\Choice;

class QuizController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('allowed');
    }
    public function index() {
        $u = Auth::user();
        $quizzes = Quiz::withCount('choices')->where('id', '!=', null)->get();
        return FunctionController::viewPage($u, $quizzes, 'Quizzes Table', '', 'admin.quizzes.quizzes', 'menu8', '');
    }
    public function create() {
        $u = Auth::user();
        return FunctionController::viewPage($u, '', 'Quiz Creator', '', 'admin.quizzes.quiz_add', 'menu8', ['btn' => 'CREATE', 'statcheck1' => 'checked', 'statcheck2' => '']);
    }
    public function store(Request $request) {
        $v = $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string|max:254',
        ]);
        $data = [
            'question' => $request->input('question'),
            'answer' => $request->input('answer'),
            'verse' => $request->input('verse', ''),
            'type' => $request->input('type', ''),
            'category' => $request->input('category', ''),
            'status' => $request->input('status', ''),
        ];
        $q = Quiz::create($data);
        return redirect()->route('quizzes');
    }
    public function choices($id) {
        $u = Auth::user();
        $choices = Choice::where('quiz_id', $id)->orderBy('label', 'asc')->get();
        return FunctionController::viewPage($u, $choices, 'Choices Table', '', 'admin.choices.choices', 'menu8', $id);
    }
    public function choice_add($id) {
        return FunctionController::viewPage(Auth::user(), '', 'Choice Creator', '', 'admin.choices.choice_add', 'menu8', ['btn' => 'CREATE', 'statcheck1' => 'checked', 'statcheck2' => '', 'qid' => $id]);
    }
    public function choice_store(Request $request) {
        $v = $request->validate([
            'label' => 'required|string',
        ]);
        $qid = $request->input('quiz_id');
        $data = [
            'quiz_id' => $qid,
            'label' => $request->input('label'),
            'status' => $request->input('status', ''),
        ];
        $q = Choice::create($data);
        return redirect()->route('quiz.choices', ['id' => $qid]);
    }
    public function choice_edit($id, $qid) {
        $choice = Choice::find($id);
        $sc1 = $sc2 = '';
        if($choice->status == "active") { $sc1 = "checked"; } else { $sc2 = "checked"; }
        return FunctionController::viewPage(Auth::user(), $choice, 'Choice Editor', '', 'admin.choices.choice_edit', 'menu8', ['btn' => 'SAVE CHANGES', 'statcheck1' => $sc1, 'statcheck2' => $sc2, 'qid' => $qid]);
    }
    public function choice_update(Request $request, $id) {
        $v = $request->validate([
            'label' => 'required|string',
        ]);
        $qid = $request->input('qid');
        $data = [
            'label' => $request->input('label'),
            'status' => $request->input('status', ''),
        ];
        $c = Choice::where('id', $id)->update($data);
        return redirect()->route('quiz.choices', ['id' => $qid]);
    }
    public function choice_delete($id, $qid) {
        $choice = Choice::find($id);
        return FunctionController::viewPage(Auth::user(), $choice, 'Choice Remover', '', 'admin.choices.choice_delete', 'menu8', $qid);
    }
    public function choice_destroy(Request $request, $id) {
        $qid = $request->input('qid');
        $q = Choice::destroy($id);
        return redirect()->route('quiz.choices', ['id' => $qid]);
    }
    public function edit($id) {
        $quiz = Quiz::find($id);
        $u = Auth::user();
        $sc1 = $sc2 = '';
        if($quiz->status == "active") { $sc1 = "checked"; } else { $sc2 = "checked"; }
        return FunctionController::viewPage($u, $quiz, 'Quiz Editor', '', 'admin.quizzes.quiz_edit', 'menu8', ['btn' => 'SAVE CHANGES', 'statcheck1' => $sc1, 'statcheck2' => $sc2]);
    }
    public function update(Request $request, $id) {
        $v = $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string|max:254',
        ]);
        $data = [
            'question' => $request->input('question'),
            'answer' => $request->input('answer'),
            'verse' => $request->input('verse', ''),
            'type' => $request->input('type', ''),
            'category' => $request->input('category', ''),
            'status' => $request->input('status', ''),
        ];
        $c = Quiz::where('id', $id)->update($data);
        return redirect()->route('quizzes');
    }
    public function delete($id) {
        $u = Auth::user();
        $quiz = Quiz::find($id);
        return FunctionController::viewPage($u, $quiz, 'Quiz Remover', '', 'admin.quizzes.quiz_delete', 'menu8', '');
    }
    public function destroy($id) {
        $ch = Choice::where('quiz_id', $id)->delete();
        $q = Quiz::destroy($id);
        return redirect()->route('quizzes');
    }
}
