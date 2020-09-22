<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\FunctionController;
use App\Quiz;
use App\User;
use App\Book;
use App\Verse;
use App\Ranking;
use App\Discussion;
use App\Quizfile;
use App\Topic;
use Storage;
use Image;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Djunehor\Logos\Bible;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;

class BibleController extends Controller
{
    public function test() {
        return "Nothing to test";
    }
    public function donate_success() {
        return FunctionController::viewFrontPage('site.donate_successful', '', 'Donation Successful', 'Donation Successful', '404error_page', '', '');
    }
    public function donate_cancel() {
        return FunctionController::viewFrontPage('site.donate_cancelled', '', 'Donation Successful', 'Donation Successful', '404error_page', '', '');
    }
    public function bible() {
        return $this->getBook('Genesis', '1', '1', 20, 'simple', '');
    }
    public function bible_search(Request $request) {
        if ($request->has('book')) {
            $book = $request->input('book');
            $chapter = $request->input('chapter');
            $verse = $request->input('verse');
            return $this->getBook($book, $chapter, $verse, 20, 'simple', '');
        } else {
            return $this->getBook('Exodus', '1', '1', 20, 'simple', '');
        }
    }
    public function book_chapter(Request $request) {
        $bible = new Bible();
        $book = $request->input('book');
        $bible->book($book);
        $chapters = $bible->getBook();
        $chapter_count = count($chapters['chapters']);
        $bible->chapter(1);
        $verses = $bible->getChapter();
        $verse_count = count($verses['verses']);
        return response()->json(['chapter_count' => $chapter_count, 'verse_count' => $verse_count]);
    }
    public function book_verse(Request $request) {
        $book = $request->input('book');
        $chapter = (int)$request->input('chapter');
        $bible = new Bible();
        $bible->book($book);
        $bible->chapter($chapter);
        $verses = $bible->getChapter();
        $verse_count = count($verses['verses']);
        return response()->json(['verse_count' => $verse_count]);
    }
    public function bible_search_topic(Request $request) {
        $id = $request->input('id');
        $topic = Topic::where('id', $id)->first();
        return $this->getBook($topic->book, $topic->chapter, $topic->verse, 20, 'simple', '');
    }
    private function verseOfTheDay() {
        $passage = [];
        $books = ['Psalms','Proverbs'];
        $bk = Arr::random($books);
        $bible = new Bible();
        $bible->book($bk);
        $book = $bible->getBook();
        $sn = FunctionController::getShortName($bk);
        $chapter_count = count($book['chapters']);
        for($cp=1; $cp<=$chapter_count;$cp++) {
            $bible->chapter($cp);
            $verses = $bible->getChapter();
            foreach($verses['verses'] as $vrs) {
                $passage[] = '<b>'. $sn . '. ' . $cp . ':' . $vrs['verse'] . '</b> ' . $vrs['text'];
            }
        }
        return Arr::random($passage);
    }
    public function bible_search_word(Request $request) {
        $passages = [];
        $otcount = 0;
        $ntcount = 0;
        $word = $request->input('word');
        if(Str::contains($word, '|@@@|')) {
            $res = explode('|@@@|', $word);
            $word = join(" ", $res);
        }
        $books = FunctionController::get_books();
        foreach($books as $bk) {
            $bible = new Bible();
            $bible->book($bk);
            $sn = FunctionController::getShortName($bk);
            $book = $bible->getBook();
            $chapter_count = count($book['chapters']);
            for($cp=1; $cp<=$chapter_count;$cp++) {
                $bible->chapter($cp);
                $verses = $bible->getChapter();
                foreach($verses['verses'] as $vrs) {
                    if(Str::contains($vrs['text'], $word)) {
                        $passages[] = '<b>'. $sn . ' ' . $cp . ':' . $vrs['verse'] . '</b> ' . $vrs['text'];
                        if(in_array($bk, FunctionController::OT())) {
                            $ot = substr_count($vrs['text'], $word);
                            $otcount += $ot;
                        }
                        if(in_array($bk, FunctionController::NT())) {
                            $nt = substr_count($vrs['text'], $word);
                            $ntcount += $nt;
                        }
                    }
                }
            }
        }
        $desc = "awesome king james version bible, perfect bible study guide, free online bible, dynamic bible, best Bible word search tool";
        $tit = "KJV Bible Word Search";
        $url = "https://onlinestorehouse.com/bible/search/word?word=" . $word;
        $seo = FunctionController::simpleSEO($tit, $desc, $url, 'articles', '@Virgil_Dimple');
        $params = ['otcount' => $otcount, 'ntcount' => $ntcount, 'item_count' => 20, 'qztype' => 'simple', 'qcategory' => '', 'menu' => $this->getGameMenu(), 'word_counter' => count($passages), 'word' => $word];
        return FunctionController::viewFrontPage('bible.word', $passages, $tit, $tit, 'blog_right_sidebar_page', $params, '');
    }
    public function getBook($book, $chapter, $verse, $item, $type, $category) {
        $bible = new Bible();
        $strbk = $book . ' ' . $chapter . ':' . $verse;
        $found_verse = $bible->get($strbk);
        $bible->book($book);
        $chapters = $bible->getBook();
        $chapter_count = count($chapters['chapters']);
        $bible->book($book);
        $bible->chapter($chapter);
        $verses = $bible->getChapter();
        $verse_count = count($verses['verses']);
        $str = $book . ' ' . $chapter . ':' . $verse;
        $desc = "awesome king james version bible, perfect bible study guide, free online bible, dynamic bible, $str, $book";
        try {
          $topic = Topic::where('book', $book)->where('chapter', $chapter)->where('verse', $verse)->firstOrFail();
          $desc .= ', ' . $topic->title;
        } catch (ModelNotFoundException $ex) {
          $tt = "";
        }
        $tit = 'King James Bible Online';
        $seo = FunctionController::simpleSEO($tit, $desc, 'https://onlinestorehouse.com/bible', 'articles', '@Virgil_Dimple');
        $topics = Topic::where('created_at', '!=', null)->orderBy('title', 'asc')->get();
        $params = ['books' => FunctionController::getAllBooks(), 'VOD' => $this->verseOfTheDay(), 'topics' => $topics, 'found_verse' => $found_verse, 'book' => $book, 'short' => FunctionController::getShortName($book), 'chapter' => $chapter, 'verse' => $verse, 'item_count' => $item, 'qztype' => $type, 'qcategory' => $category, 'chapter_count' => $chapter_count, 'verse_count' => $verse_count, 'menu' => $this->getGameMenu()];
        return FunctionController::viewFrontPage('bible.book', $verses, $tit, 'KJV Bible', 'blog_right_sidebar_page', $params, '');
    }
    public function bible_quiz() {
        return $this->getQuiz(20, 'simple', '');
    }
    public function getQuiz($item, $type, $qcategory) {
        if($qcategory == "") {
            $rankings = Ranking::where('level', $type)->where('items', $item)->where('status', 'active')->orderBy('score', 'desc')->take(10)->get(); 
        } else {
            $rankings = Ranking::where('level', $type)->where('category', $qcategory)->where('items', $item)->where('status', 'active')->orderBy('score', 'desc')->take(10)->get();
        }
        $model = FunctionController::getQuizzes($item, 'type', $type, 'category', $qcategory);
        $chats = Discussion::where('id', '!=', null)->where('status', 'active')->orderBy('created_at', 'desc')->get();
        $desc = "awesome bible quiz, free online bible quiz, dynamic bible quiz, downloadable bible quiz,";
        foreach($model as $md) {
            $desc .= $md->answer . ', ';
        }
        $tit = 'Your Favorite Online Bible Quiz';
        $seo = FunctionController::simpleSEO($tit, $desc, 'https://onlinestorehouse.com/bible/quiz', 'articles', '@Virgil_Dimple');
        $params = ['item_count' => $item, 'qztype' => $type, 'qcategory' => $qcategory, 'chats' => $chats, 'rankings' => $rankings, 'menu' => $this->getGameMenu()];
        return FunctionController::viewFrontPage('bible.quiz', $model, $tit, 'Bible Quiz', 'blog_right_sidebar_page', $params, '');
    }
    public function getGameMenu() {
        $arr = [];
        $model = Quiz::where('status', 'active')->orderBy('category', 'asc')->get();
        foreach($model as $quiz) {
            $cat = $quiz->category;
            $counter = Quiz::where('category', $cat)->count();
            if(!in_array($cat, $arr)) {
                $arr[$cat] = $counter;
            } 
        }
        return $arr;
    }
    public function processData($request, $page) {
        $quizzes = $request->input('quiz');
        $content = "Downloaded from: https://onlinestorehouse.com\n\nBIBLE QUIZ\n\n";
        $total_score = 0;
        $j = 1;
        foreach ($quizzes as $quiz) {
          $res = "wrong";
          $arr = explode("|@@|", $quiz);
          $qz = Quiz::where('id', $arr[0])->first();
          if($arr[1] == $qz->answer) {
              $res = "correct";
              $content .= $j . ". ". $qz->question . ' Your answer: ' . $arr[1] . ' - ' . $res . ' - Verse(s): '. $qz->verse;
              $total_score++;
          } else {
              $content .= $j . ". ".$qz->question . ' Your answer: ' . $arr[1] . ' - ' . $res . '. Correct answer: ' . $qz->answer . ' - Verse(s): '. $qz->verse;
          }
          $content .= "\n";
          $j++;
        }
        $items = $request->input('items');
        $content .= "\nTotal Score: " . $total_score . "\n";
        $content .= "Total Items: " . $items;
        $content .= "\n";
        if($page == "save") {
            $category = $request->input('category');
            $level = $request->input('level');
            $secs = $request->input('secs');
            $data = [
    			'user_id' => Auth::id(),
    			'category' => $category,
    			'level' => $level,
    			'items' => $items,
    			'time' => $this->getStrTime($secs),
    			'score' => $total_score,
    		];		
    		$rk = Ranking::create($data);
        }
        $ip = \Request::ip();
        $newip = str_replace('.', '', $ip);
        $dt = Carbon::now();
        $ddate = str_replace_array('-', ['', ''], $dt->toDateTimeString());						
		$ddate = str_replace_array(' ', [''], $ddate);
		$fileName = str_replace_array(':', ['', ''], $ddate);
        $fileName = $newip.$fileName . '.txt';
        $path = 'files/'.$fileName;
        Storage::disk('uploads')->put($path, $content);
        $rt = route('download.now',['filename' => $fileName]);
        return response()->json(['newrt' => $rt]);
    }
    public function getStrTime($init) {
        $hours = floor($init / 3600);
        $minutes = floor(($init / 60) % 60);
        $seconds = $init % 60;
        return "$hours:$minutes:$seconds";
    }
    public function save_quiz(Request $request) {
        return $this->processData($request, 'save');
    }
    public function download_quiz(Request $request) {
        return $this->processData($request, 'download');
    }
    public function download_now($filename) {
        $path = 'files/'.$filename;
        $qf = Quizfile::create(['filename' => $filename, 'delete' => 'yes']);
        return Storage::disk('uploads')->download($path);
    }
    public function select_items(Request $request) {
        $cat = $request->input('qcategory');
        $itm = $request->input('items');
        $level = $request->input('qztype');
        if(Str::contains($cat, '|@@|')) {
           $cat = str_replace("|@@|", " ", $cat);            
        }
        return $this->getQuiz($itm, $level, $cat);
    }
    public function quiz_category($level, $items, $qcategory) {
        return $this->getLevelCategory($level, $items, $qcategory);
    }
    public function quiz_level($level, $items, $qcategory) {
        return $this->getLevelCategory($level, $items, $qcategory);
    }
    public function getLevelCategory($level, $items, $qcategory) {
        $cat = "";
        if($qcategory != "none") {
            $cat = str_replace("@@@", " ", $qcategory);
        }
        return $this->getQuiz($items, $level, $cat);
    }
    public function send_discussion(Request $request) {
        $v = $request->validate([
            'message' => 'required|string',
        ]);
        $data = [
			'message' => $request->input('message'),
			'user_id' => Auth::id(),
		];		
		$p = Discussion::create($data);
		return redirect()->route('bible.quiz')->with('pgstatus', "Thanks for sharing your thoughts.");
    }
    public function signup() {
        return FunctionController::viewFrontPage('bible.register', '', 'Register as player', 'Register as player', 'shop_grid_page', '', '');
    }
    public function login() {
        return FunctionController::viewFrontPage('bible.login', '', 'Login as player', 'Login as player', 'shop_grid_page', '', '');
    }
    public function register(Request $request) {
        $v = $request->validate([
            'firstname' => 'required|string|max:60',
            'lastname' => 'required|string|max:60',
            'email' => 'required|email|string|max:60|unique:users',
            'username' => 'required|string|max:60|unique:users',
            'password' => 'required|min:2|confirmed',
        ]);
        $fn = FunctionController::getAvatar();
        if($request->hasFile('picture')) {
            $file = $request->file('picture');
            if($file->isValid()) {
                $ext = $file->extension();
                $fileTypes = ['jpg' => 'jpg', 'jpeg' => 'jpeg', 'bmp' => 'bmp', 'png' => 'png', 'gif' => 'gif'];
                if(array_has($fileTypes, $ext)) {
                    $image = Image::make($file)->resize(48, 48);
                    $path = FunctionController::genSimplePath('profiles', $ext);
                    Storage::disk('uploads')->put($path, (string) $image->encode());
                    $fln = explode("/", $path);
                    $fn = $fln[1];
                }
            }
        }
        $data = [
			'firstname' => $request->input('firstname'),
			'lastname' => $request->input('lastname'),
			'email' => $request->input('email'),
			'username' => $request->input('username'),
			'picture' => $fn,
			'membership' => 'player',
			'ip' => \Request::ip(),
			'password' => Hash::make($request->input('password')),
		];		
		$p = User::create($data);
		$creds = $request->only('email', 'password');
		if(Auth::attempt($creds)) {
            return redirect()->route('bible.quiz')->with('pgstatus', "Your account has been created successfully. You can now participate in the discussion below.");
        } else {
            return redirect()->route('bible.quiz')->with('pgstatus', "Your account has been created successfully. Please login to participate in the discussion below.");   
        }
    }
    public function login_now(Request $request) {
        $creds = $request->only('email', 'password');
        if (Auth::attempt($creds)) {
            return redirect()->route('bible.quiz')->with('pgstatus', "You can now participate in the discussion below.");
        } else {
            return redirect()->route('bible.quiz')->with('pgstatus', "Please login to participate in the discussion below.");
        }
    }
}
