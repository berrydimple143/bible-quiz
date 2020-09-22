<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Comment;
use App\Photo;
use App\Subscriber;
use App\Contact;
use App\Subscription;
use App\Mail\ContactSent;
use App\Mail\NewsletterSubscribed;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\FunctionController;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use App\Rules\IsHtml;
use Illuminate\Support\Facades\Auth;
use Conner\Tagging\Model\Tag;

class SiteController extends Controller
{
    public function index() {
        return $this->commonPage('index', '', '');
    }
    public function view_sitemap() {
        $path = base_path('sitemap.xml');
        $arr = FunctionController::convertXMLToArray($path);
        $data = $arr['url'];
        return FunctionController::viewFrontPage('site.map', '', 'Sitemap Page', 'Sitemap Page', 'sitemap_page', $data, '');
    }
    public function not_available() {
        return FunctionController::viewFrontPage('site.not_available', '', 'This page is not yet available', 'This page is not yet available', '404error_page', '', '');
    }
    public function all_categories() {
        return FunctionController::viewFrontPage('site.categories', '', 'All Categories', 'All Categories', 'sitemap_page', '', '');
    }
    public function all_tags() {
        return FunctionController::viewFrontPage('site.tags', '', 'All article tags', 'All article tags', 'sitemap_page', '', '');
    }
    public function categories($slug) {
        $id = $this->getIds($slug);
        return $this->commonPage('categories', $id, '');
    }
    public function commonPage($pg, $id, $params) {
        $title = "Your best blogging system online";
        if($pg == 'index') {
            $desc = "We've got everything you need to know here. Be a smart blogger.";
            $seo = FunctionController::simpleSEO($title, $desc, 'https://onlinestorehouse.com/', 'articles', '@Virgil_Dimple');
            $posts = Post::with('tagged')->withCount('comments')->where('status', 'active')->where('reported', 'no')->where('published', 'yes')->orderBy('date_posted', 'desc')->paginate(10);
        } else if($pg == 'categories') {
            $posts = Post::with('tagged')->withCount('comments')->where('category_id', $id)->where('status', 'active')->where('reported', 'no')
                ->where('published', 'yes')->orderBy('date_posted', 'desc')->paginate(10);
        } else if($pg == 'tags') {
            $tag = Tag::where('id', $id)->first();
            $posts = Post::withAnyTag([$tag->name])->withCount('comments')->where('status', 'active')->where('reported', 'no')
                    ->where('published', 'yes')->orderBy('date_posted', 'desc')->paginate(10);
        } else if($pg == 'search') {
            if($id != "all") {
                $posts = Post::with('tagged')->withCount('comments')->where('category_id', $id)->where('status', 'active')->where('reported', 'no')->where('published', 'yes')
                                ->where(function ($query) use ($params) {
                                    $go = '%'.$params.'%';
						            $query->orWhere('body', 'like', $go)
						                  ->orWhere('slug', 'like', $go)
						                  ->orWhere('description', 'like', $go)
						                  ->orWhere('author', 'like', $go)
								          ->orWhere('title', 'like', $go);                                        
					    })->orderBy('date_posted', 'desc')->paginate(10);	
				
            } else {
                $posts = Post::with('tagged')->withCount('comments')->where('status', 'active')->where('reported', 'no')->where('published', 'yes')
                                ->where(function ($query) use ($params) {
                                    $go = '%'.$params.'%';
						            $query->orWhere('body', 'like', $go)
						                  ->orWhere('slug', 'like', $go)
						                  ->orWhere('description', 'like', $go)
						                  ->orWhere('author', 'like', $go)
								          ->orWhere('title', 'like', $go);                                        
					    })->orderBy('date_posted', 'desc')->paginate(10);
            }
        }
        $pp = FunctionController::cleanPaginator($posts->links());
        if($posts->count() > 0) {
            $seo = FunctionController::setMultiSEO($posts);
            return FunctionController::viewFrontPage('site.home', $posts, $title, $title, 'blog_right_sidebar_page', '', $pp);
        } else {
            if($pg == "index") {
                return FunctionController::viewFrontPage('site.home', $posts, $title, $title, 'blog_right_sidebar_page', '', $pp);
            } else {
                return FunctionController::viewFrontPage('site.errors.notfound', $posts, 'No articles', 'No articles', 'single_post_page', '', '');
            }
        }
    }
    public function with_tag($id) {
        return $this->commonPage('tags', $id, '');
    }
    private function getIds($slug) {
        $arr = explode("-", $slug);
        $index = count($arr) - 1;
        return $arr[$index];
    }
    public function post($slug) {
        $id = $this->getIds($slug);
        $post = Post::with('tagged')->withCount('comments')->where('id', $id)->first();
        if($post->status != 'inactive' and $post->reported != 'yes' and $post->published == 'yes') {
            $im = FunctionController::findImage(FunctionController::getImages(), $id); 
            $img = "";
            $body = $post->body;
            if(!Str::contains($body, $post->photo)) {
                $img = asset('uploads/photos/'.$post->photo);
            }
            $pb = new Carbon($post->date_posted);
            $pub = $pb->toFormattedDateString();
            $comments = Post::find($id)->comments;
            $url = 'https://onlinestorehouse.com/blog/'. $post->slug .'-'. $post->id; 
            $tw = "@Virgil_Dimple";
            $newip = \Request::ip();
            if((string)$newip != (string)$post->user->ip) {
                $vis = (int)$post->visit + 1;
                $p = Post::where('id', $id)->update(['visit' => $vis]);
            }
            $seo = FunctionController::setSEO($post->title, $post->description, $post->slug, $url, 'article', $img, $post->date_posted, $post->updated_at, $post->date_expired, $post->author, $post->category->name, $tw);
            $info = ['img' => $img, 'pub' => $pub, 'body' => $body, 'slug' => $slug, 'pcomments' => $comments];
            return FunctionController::viewFrontPage('site.post', $post, $post->title, $post->title, 'single_post_page', $info, '');
        } else {
            if($post->published == 'no') {
                $errType = "publishing";
            } else if($post->reported == 'yes') {
                $errType = "censored";
            } else {
                $errType = "disabled";
            }
            return FunctionController::viewFrontPage('site.errors.post', $post, 'Single Post Error', 'Single Post Error', 'single_post_page', $errType, '');
        }
    }
    public function maintenance() {
        return view('site.maintenance');
    }
    public function send_comment(Request $request) {
        $v = $request->validate([
            'name' => 'required|string|max:70',
            'website' => 'nullable|string|max:100',
            'email' => 'email|string|nullable|max:70', 
            'message' => ['string', 'nullable', new IsHtml],
        ]);
        $slug = $request->input('slug', '');
        $data = [
            'post_id' => $request->input('pid'),
            'name' => $request->input('name'),
            'website' => $request->input('website', ''),
            'message' => $request->input('message', ''),
            'email' => $request->input('email', ''),
        ];
        $c = Comment::create($data);
        return redirect()->route('single.post', ['slug' => $slug]);
    }
    public function subscribe() {
        try {
          $regular = Subscription::where('name', 'regular')->firstOrFail();
        } catch (ModelNotFoundException $ex) {
          $regular = "0";
        }
        try {
          $silver = Subscription::where('name', 'silver')->firstOrFail();
        } catch (ModelNotFoundException $ex) {
          $silver = "0";
        }
        try {
          $gold = Subscription::where('name', 'gold')->firstOrFail();
        } catch (ModelNotFoundException $ex) {
          $gold = "0";
        }
        $info = ['regular' => $regular, 'silver' => $silver, 'gold' => $gold];
        return FunctionController::viewFrontPage('site.subscription', '', 'Subscription Page', 'Subscription Page', 'shop_grid_page', $info, '');
    }
    public function payment($stype, $amt) {
        $firstname = $lastname = $password = $email = "";
        $id = "none";
        if(Auth::check()) {
            $usr = Auth::user();
            if($stype == "free") {
                return redirect()->route('registration.failed', ['firstname' => $usr->firstname]);
            }
            $id = $usr->id;
            $firstname = $usr->firstname;
            $lastname = $usr->lastname;
            $email = $usr->email;
        }
        $info = ['stype' => $stype, 'id' => $id, 'firstname' => $firstname, 'lastname' => $lastname, 'email' => $email, 'amt' => $amt, 'password' => $password];
        return FunctionController::viewFrontPage('site.subscribe_now', '', 'Subscription Page - Fill-up Form', 'Subscription Page - Fill-up Form', 'shop_grid_page', $info, '');
    }
    public function search_blog(Request $request) {
        $id = $request->input('category_id', '');
        $keyword = $request->input('searched_blog', '');
        return $this->commonPage('search', $id, $keyword);
    }
    public function subscribe_newsletter(Request $request) {
        $v = $request->validate([
            'lettermail' => 'email|required|string', 
        ]);
        $email = $request->input('lettermail', '');
        $count = Subscriber::where('email', $email)->count();
        if($count < 1) {
            $subs = Subscriber::create(['email' => $email]);
        }
        Mail::to($email)->send(new NewsletterSubscribed());
        return redirect()->route('redirect.to', ['page' => 'newsletter']);
    }
    public function redirectToPage($page) {
        if($page == 'newsletter') {
            return FunctionController::viewFrontPage('site.newsletter_sent', '', 'Newsletter Subscription Successful', 'Newsletter Subscription Successful', '404error_page', '', '');
        }
    }
    public function privacy() {
        return FunctionController::viewFrontPage('site.privacy', '', 'Privacy Page', 'Privacy Page', 'faq_page', '', '');
    }
    public function contact() {
        return FunctionController::viewFrontPage('site.contact', '', 'Contact Page', 'Contact Page', 'contact_us_page', '', '');
    }
    public function send_contact(Request $request) {
        $contact = new Contact();
        $contact->name = $request->input('name');
        $contact->email = $request->input('email');
        $contact->phone = $request->input('phone');
        $contact->message = $request->input('message');
        $admin = new Contact();
        $admin->name = 'Virgil T. Rosalita';
        $admin->email = 'shekinahberry143@gmail.com';
        $admin->phone = '09104374372';
        $admin->message = 'Online Storehouse Customer Service';
        Mail::to($admin)->send(new ContactSent($contact));
        return FunctionController::viewFrontPage('site.contact_sent', '', 'Contact Successful Page', 'Contact Successful Page', '404error_page', '', '');
    }
    public function about() {
        return FunctionController::viewFrontPage('site.about', '', 'About Page', 'About Page', 'about_us_page', '', '');
    }
}
