<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Comment;
use App\User;
use App\Post;
use App\Http\Controllers\FunctionController;

class CommentController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    public function index() {
        $user = Auth::user();
        if($user->status == "inactive") {
            return FunctionController::viewPage($user, '', 'Comments Table Error', FunctionController::getErrors('comment'), 'admin.errors.expired', 'menu3', '');
        } else {
            $comments = Comment::where('id', '!=', null)->orderBy('created_at', 'desc')->get();
            return FunctionController::viewPage($user, $comments, 'Comments Table', '', 'admin.comments.comments', 'menu4', '');
        }
    }
    public function create() {
        $user = Auth::user();
        if($user->status == "inactive") {
            return FunctionController::viewPage($user, '', 'Comments Table Error', FunctionController::getErrors('comment_add'), 'admin.errors.expired', 'menu3', '');
        } else {
            $posts = Post::where('id', '!=', null)->orderBy('title', 'asc')->get();
            if($posts->count() > 0) {
                $params = ['btn' => 'CREATE', 'stat1' => 'checked', 'stat2' => '', 'repcheck1' => '', 'repcheck2' => 'checked'];
                return FunctionController::viewPage($user, $posts, 'Comment Creator', '', 'admin.comments.comment_add', 'menu4', $params);
            } else {
                return FunctionController::viewPage($user, '', 'Comment Error', 'No post yet. Please add one.', 'admin.errors.comment', 'menu4', '');
            }
        }
    }
    public function store(Request $request) {
        $v = $request->validate([
            'name' => 'required|string|max:70',
            'website' => 'nullable|string|max:100',
            'email' => 'email|string|nullable|max:70',
            'message' => 'string|nullable',
        ]);
        $data = [
            'post_id' => $request->input('post_id'),
            'name' => $request->input('name'),
            'website' => $request->input('website', ''),
            'message' => $request->input('message', ''),
            'email' => $request->input('email', ''),
            'status' => $request->input('status', ''),
            'reported' => $request->input('reported', ''),
        ];
        $c = Comment::create($data);
        return redirect()->route('comments');
    }
    public function show($id) {
        $user = Auth::user();
        $comments = Comment::where('post_id', $id)->orderBy('created_at', 'desc')->get();
        return FunctionController::viewPage($user, $comments, 'Comments Table For Post', '', 'admin.comments.comments', 'menu4', '');
    }
    public function edit($id) {
        $user = Auth::user();
        if($user->status == "inactive") {
            return FunctionController::viewPage($user, '', 'Comments Table Error', FunctionController::getErrors('comment_edit'), 'admin.errors.expired', 'menu3', '');
        } else {
            $comment = Comment::find($id);
            $sc1 = $sc2 = $rc1 = $rc2 = '';
            if($comment->status == "active") { $sc1 = "checked"; } else { $sc2 = "checked"; }
            if($comment->reported == "yes") { $rc1 = "checked"; } else { $rc2 = "checked"; }
            $params = ['btn' => 'SAVE CHANGES', 'stat1' => $sc1, 'stat2' => $sc2, 'repcheck1' => $rc1, 'repcheck2' => $rc2];
            return FunctionController::viewPage($user, $comment, 'Comment Editor', '', 'admin.comments.comment_edit', 'menu4', $params);
        }
    }
    public function update(Request $request, $id) {
        $v = $request->validate([
            'name' => 'required|string|max:70',
            'website' => 'nullable|string|max:100',
            'email' => 'email|string|nullable|max:70',
            'message' => 'string|nullable',
        ]);
        $data = [
            'name' => $request->input('name'),
            'website' => $request->input('website', ''),
            'message' => $request->input('message', ''),
            'email' => $request->input('email', ''),
            'status' => $request->input('status', ''),
            'reported' => $request->input('reported', ''),
        ];
        $c = Comment::where('id', $id)->update($data);
        return redirect()->route('comments');
    }
    public function delete($id) {
        $user = Auth::user();
        if($user->status == "inactive") {
            return FunctionController::viewPage($user, '', 'Comments Table Error', FunctionController::getErrors('comment_delete'), 'admin.errors.expired', 'menu3', '');
        } else {
            $comment = Comment::find($id);
            return FunctionController::viewPage($user, $comment, 'Comment Delete', '', 'admin.comments.comment_delete', 'menu4', '');
        }
    }
    public function destroy($id) {
        $c = Comment::destroy($id);
        return redirect()->route('comments');
    }
}
