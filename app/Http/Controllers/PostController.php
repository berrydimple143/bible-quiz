<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\User;
use App\Comment;
use App\Subscription;
use App\Category;
use Carbon\Carbon;
use App\Rules\Uniqueslug;
use App\Http\Controllers\FunctionController;
use Conner\Tagging\Model\Tag;
use Image;
use Storage;

class PostController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    public function index() {
        $user = Auth::user();
        if($user->membership == "admin") {
            $posts = Post::withCount('comments')->where('id', '!=', null)->orderBy('created_at', 'desc')->get();
        } else {
            $posts = Post::withCount('comments')->where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        }
        if(FunctionController::isExpired($user)) {
            return FunctionController::viewPage($user, $posts, 'Posts Table Error', FunctionController::getErrors('post'), 'admin.errors.expired', 'menu3', '');
        } else {
            return FunctionController::viewPage($user, $posts, 'Posts Table', '', 'admin.posts.posts', 'menu3', FunctionController::getLimit('post'));
        }
    }
    public function create() {
        $user = Auth::user();
        if(FunctionController::isLimit($user->id, $user->membership, 'post') == 'limit exceeded') {
            return FunctionController::viewPage($user, '', 'Limit Exceeded', "The number of article you've created has reached to its limit.", 'admin.errors.limit', 'menu3', '');
        } else if($user->status == "inactive") {
            return FunctionController::viewPage($user, '', 'Posts Table Error', FunctionController::getErrors('post_add'), 'admin.errors.expired', 'menu3', '');
        } else {
            $categories = Category::where('id', '!=', null)->orderBy('name', 'asc')->get();
            $info = ['btn' => 'SAVE', 'statcheck1' => 'checked', 'statcheck2' => '', 'repcheck1' => '', 'repcheck2' => 'checked', 'pub1' => 'checked', 'pub2' => '', 'pop1' => 'checked', 'pop2' => ''];
            return FunctionController::viewPage($user, $categories, 'Article Creator', '', 'admin.posts.post_add', 'menu3', $info);
        }
    }
    public function store(Request $request) {
        $v = $request->validate([
            'slug' => ['required', 'string', 'max:254', new Uniqueslug],
            'description' => 'string|nullable',
            'body' => 'string|nullable',
            'author' => 'string|nullable|max:100',
            'title' => 'required|string|max:100',
            'photo' => 'required',
        ]);
        $user = Auth::user();
        if ($request->hasFile('photo')) {
            if ($request->file('photo')->isValid()) {
                $file = $request->file('photo');
                $ext = $file->extension();
                $fileTypes = ['jpg' => 'jpg', 'jpeg' => 'jpeg', 'bmp' => 'bmp', 'png' => 'png', 'gif' => 'gif'];
                if(array_has($fileTypes, $ext)) {
                    $image = Image::make($file)->resize(500, 300);
                    $path = FunctionController::genPath('photos', $user->id, $ext);
                    Storage::disk('uploads')->put($path, (string) $image->encode());
                    $fn = explode("/", $path);
                    $dp = null;
                    $pub = $request->input('published', '');
                    if($pub == "yes") {
                        $dp = Carbon::now();
                    }
                    $stat = "active";
                    $rep = $pop = "no";
                    if($user->membership == "admin") {
                        $stat = $request->input('status', '');
                        $rep = $request->input('reported', '');
                        $pop = $request->input('popular', '');
                    }
                    $slug = FunctionController::slugify($request->input('slug'));
                    $data = [
                        'user_id' => Auth::id(),
                        'category_id' => $request->input('category_id'),
                        'author' => $request->input('author', ''),
                        'title' => $request->input('title', ''),
                        'description' => $request->input('description', ''),
                        'slug' => $slug,
                        'body' => $request->input('body', ''),
                        'published' => $pub,
                        'popular' => $pop,
                        'reported' => $rep,
                        'status' => $stat,
                        'date_posted' => $dp,
                        'photo' => $fn[1],
                    ];
                    $p = Post::create($data);
                    return redirect()->route('posts');
                } else {
                    return FunctionController::viewPage($user, '', 'Image Upload Error', "The file you've uploaded is not an image.", 'admin.errors.photo', 'menu3', '');
                }
            } else {
                return FunctionController::viewPage($user, '', 'Image Upload Error', "Invalid file.", 'admin.errors.photo', 'menu3', '');
            }
        }
    }
    public function tags($id) {
        $user = Auth::user();
        if($user->status == "inactive") {
            return FunctionController::viewPage($user, '', 'Tags Table Error', FunctionController::getErrors('post_edit'), 'admin.errors.expired', 'menu3', '');
        } else {
            $post = Post::with('tagged')->find($id);
            return FunctionController::viewPage($user, $post, 'Article Tags Table', '', 'admin.posts.tags', 'menu3', '');
        }
    }
    public function tag_add($id) {
        $user = Auth::user();
        if($user->status == "inactive") {
            return FunctionController::viewPage($user, '', 'Tags Table Error', FunctionController::getErrors('post_edit'), 'admin.errors.expired', 'menu3', '');
        } else {
            $info = ['btn' => 'ADD', 'id' => $id];
            return FunctionController::viewPage($user, '', 'Tag Creator', '', 'admin.posts.tag_add', 'menu3', $info);
        }
    }
    public function store_tag(Request $request) {
        $v = $request->validate([
            'tag' => 'required|string|max:254',
        ]);
        $tag = $request->input('tag', '');
        $pid = $request->input('postid', '');
        $post = Post::with('tagged')->where('id', $pid)->first();
        $post->tag($tag);
        return redirect()->route('post.tags', ['id' => $pid]);
    }
    public function tag_delete($id, $tag_id) {
        $user = Auth::user();
        if($user->status == "inactive") {
            return FunctionController::viewPage($user, '', 'Tags Table Error', FunctionController::getErrors('post_delete'), 'admin.errors.expired', 'menu3', '');
        } else {
            $tag = Tag::where('id', $tag_id)->first();
            return FunctionController::viewPage($user, $tag, 'Delete Tag', '', 'admin.posts.post_tag_delete', 'menu3', $id);
        }
    }
    public function tag_destroy(Request $request) {
        $tag = $request->input('tag', '');
        $pid = $request->input('postid', '');
        $tag_id = $request->input('tag_id', '');
        $post = Post::with('tagged')->where('id', $pid)->first();
        $post->untag($tag);
        $t = Tag::destroy($tag_id);
        return redirect()->route('post.tags', ['id' => $pid]);
    }
    public function edit($id) {
        $user = Auth::user();
        if($user->status == "inactive") {
            return FunctionController::viewPage($user, '', 'Posts Table Error', FunctionController::getErrors('post_edit'), 'admin.errors.expired', 'menu3', '');
        } else {
            $post = Post::find($id);
            $pub1 = $pub2 = $pop1 = $pop2 = $rc1 = $rc2 = $sc1 = $sc2 = ""; 
            if($post->published == "yes") { $pub1 = "checked"; } else { $pub2 = "checked"; }
            if($post->popular == "yes") { $pop1 = "checked"; } else { $pop2 = "checked"; }
            if($post->status == "active") { $sc1 = "checked"; } else { $sc2 = "checked"; }
            if($post->reported == "yes") { $rc1 = "checked"; } else { $rc2 = "checked"; }
            $info = ['btn' => 'SAVE CHANGES', 'statcheck1' => $sc1, 'statcheck2' => $sc2, 'repcheck1' => $rc1, 'repcheck2' => $rc2, 'pub1' => $pub1, 'pub2' => $pub2, 'pop1' => $pop1, 'pop2' => $pop2];
            return FunctionController::viewPage($user, $post, 'Article Editor', '', 'admin.posts.post_edit', 'menu3', $info);
        }
    }
    public function update(Request $request, $id) {
        $v = $request->validate([
            'description' => 'string|nullable',
            'body' => 'string|nullable',
            'author' => 'string|nullable|max:100',
            'title' => 'required|string|max:100',
        ]);
        $pub = $request->input('published', '');
        if($pub == "no") {
            $dp = null;
        } else {
            $lp = $request->input('lastpub');
            if($lp == "yes") {
                $dp = $request->input('date_posted');
            } else {
                $dp = Carbon::now();
            }
        }
        $stat = "active";
        $rep = $pop = "no";
        $user = Auth::user();
        if($user->membership == "admin") {
            $stat = $request->input('status', '');
            $rep = $request->input('reported', '');
            $pop = $request->input('popular', '');
        }
        $data = [
            'author' => $request->input('author', ''),
            'title' => $request->input('title', ''),
            'description' => $request->input('description', ''),
            'body' => $request->input('body', ''),
            'published' => $pub,
            'popular' => $pop,
            'reported' => $rep,
            'status' => $stat,
            'date_posted' => $dp,
        ];
        $p = Post::where('id', $id)->update($data);
        return redirect()->route('posts');
    }
    public function delete($id) {
        $user = Auth::user();
        if($user->status == "inactive") {
            return FunctionController::viewPage($user, '', 'Posts Table Error', FunctionController::getErrors('post_delete'), 'admin.errors.expired', 'menu3', '');
        } else {
            $post = Post::find($id);
            return FunctionController::viewPage($user, $post, 'Delete Post', '', 'admin.posts.post_delete', 'menu3', '');
        }
    }
    public function destroy($id) {
        $c = Comment::where('post_id', $id)->delete();
        $p = Post::destroy($id);
        return redirect()->route('posts');
    }
}
