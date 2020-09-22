<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Category;
use App\Photo;
use App\Topic;
use App\Post;
use App\Comment;
use App\Subscription;
use App\Quiz;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use SEO;
use SEOMeta;
use OpenGraph;
use Twitter;
use Conner\Tagging\Model\Tag;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FunctionController extends Controller
{
    public static function OT() {
        return [
          "Genesis", "Exodus", "Leviticus", "Numbers", "Deuteronomy", "Joshua", "Judges", "Ruth", "1Samuel", "2Samuel",
          "1Kings", "2Kings", "1Chronicles", "2Chronicles", "Ezra", "Nehemiah", "Esther", "Job", "Psalms", "Proverbs", "Ecclesiastes",
          "SongofSolomon", "Isaiah", "Jeremiah", "Lamentations", "Ezekiel", "Daniel", "Hosea", "Joel", "Amos", "Obadiah", "Jonah",
          "Micah", "Nahum", "Habakkuk", "Zephaniah", "Haggai", "Zechariah", "Malachi"
        ];
    }
    public static function NT() {
        return [
          "Matthew", "Mark", "Luke", "John", "Acts", "Romans",
          "1Corinthians", "2Corinthians", "Galatians", "Ephesians", "Philippians",  "Colossians", "1Thessalonians", "2Thessalonians",
          "1Timothy", "2Timothy", "Titus","Philemon", "Hebrews", "James", "1Peter", "2Peter", "1John", "2John", "3John", "Jude", "Revelation"
        ];
    }
    public static function get_books() {
        return [
          "Genesis", "Exodus", "Leviticus", "Numbers", "Deuteronomy", "Joshua", "Judges", "Ruth", "1Samuel", "2Samuel",
          "1Kings", "2Kings", "1Chronicles", "2Chronicles", "Ezra", "Nehemiah", "Esther", "Job", "Psalms", "Proverbs", "Ecclesiastes",
          "SongofSolomon", "Isaiah", "Jeremiah", "Lamentations", "Ezekiel", "Daniel", "Hosea", "Joel", "Amos", "Obadiah", "Jonah",
          "Micah", "Nahum", "Habakkuk", "Zephaniah", "Haggai", "Zechariah", "Malachi", "Matthew", "Mark", "Luke", "John", "Acts", "Romans",
          "1Corinthians", "2Corinthians", "Galatians", "Ephesians", "Philippians",  "Colossians", "1Thessalonians", "2Thessalonians",
          "1Timothy", "2Timothy", "Titus","Philemon", "Hebrews", "James", "1Peter", "2Peter", "1John", "2John", "3John", "Jude", "Revelation"
        ];
    }
    public static function get_doubled($id) {
        $topic = Topic::where('id', $id)->first();
        $cntr = Topic::where('title', $topic->title)->count();
        $str = "";
        if($cntr > 1) {
            $str = self::getShortName($topic->book) . ' ' . $topic->chapter . ':' . $topic->verse;
        }
        return $str;
    }
    public static function get_word_counts($str) {
       $hist = [];
        foreach (preg_split('/\s+/', $str) as $word) {
          $word = strtolower($word);
          if (isset($hist[$word])) {
            $hist[$word]++;
          } else {
            $hist[$word] = 1;
          }
        }
        return $hist;
    }
    public static function longest_word($str) {
      $ar = explode(" ", $str);
      $ln = $ar[0];
      for($i=0; $i < count($ar); $i++) {
        if (strlen($ar[$i]) > strlen($ln)) {
          $ln = $ar[$i];
        }
      }
      return $ln;
    }
    public static function getTopic($book, $chapter, $verse) {
        try {
          $tp = Topic::where('book', $book)->where('chapter', $chapter)->where('verse', $verse)->firstOrFail();
          return $tp->title;
        } catch (ModelNotFoundException $ex) {
          return "";
        }
    }
    public static function getShortName($book) {
        $sn = "";
        if($book == "Genesis") { $sn = "Gen"; }
        else if($book == "Exodus") { $sn = "Exo"; }
        else if($book == "Leviticus") { $sn = "Lev"; }
        else if($book == "Numbers") { $sn = "Num"; }
        else if($book == "Deuteronomy") { $sn = "Deu"; }
        else if($book == "Joshua") { $sn = "Jos"; }
        else if($book == "Judges") { $sn = "Jdg"; }
        else if($book == "Ruth") { $sn = "Rth"; }
        else if($book == "1Samuel") { $sn = "1Sa"; }
        else if($book == "2Samuel") { $sn = "2Sa"; }
        else if($book == "1Kings") { $sn = "1Ki"; }
        else if($book == "2Kings") { $sn = "2Ki"; }
        else if($book == "1Chronicles") { $sn = "1Ch"; }
        else if($book == "2Chronicles") { $sn = "2Ch"; }
        else if($book == "Ezra") { $sn = "Ezr"; }
        else if($book == "Nehemiah") { $sn = "Neh"; }
        else if($book == "Esther") { $sn = "Est"; }
        else if($book == "Job") { $sn = "Job"; }
        else if($book == "Psalms") { $sn = "Psa"; }
        else if($book == "Proverbs") { $sn = "Pro"; }
        else if($book == "Ecclesiastes") { $sn = "Ecc"; }
        else if($book == "SongofSolomon") { $sn = "Son"; }
        else if($book == "Isaiah") { $sn = "Isa"; }
        else if($book == "Jeremiah") { $sn = "Jer"; }
        else if($book == "Lamentations") { $sn = "Lam"; }
        else if($book == "Ezekiel") { $sn = "Eze"; }
        else if($book == "Daniel") { $sn = "Dan"; }
        else if($book == "Hosea") { $sn = "Hos"; }
        else if($book == "Joel") { $sn = "Joe"; }
        else if($book == "Amos") { $sn = "Amo"; }
        else if($book == "Obadiah") { $sn = "Oba"; }
        else if($book == "Jonah") { $sn = "Jon"; }
        else if($book == "Micah") { $sn = "Mic"; }
        else if($book == "Nahum") { $sn = "Nah"; }
        else if($book == "Habakkuk") { $sn = "Hab"; }
        else if($book == "Zephaniah") { $sn = "Zep"; }
        else if($book == "Haggai") { $sn = "Hag"; }
        else if($book == "Zechariah") { $sn = "Zec"; }
        else if($book == "Malachi") { $sn = "Mal"; }
        else if($book == "Matthew") { $sn = "Mat"; }
        else if($book == "Mark") { $sn = "Mar"; }
        else if($book == "Luke") { $sn = "Luk"; }
        else if($book == "John") { $sn = "Joh"; }
        else if($book == "Acts") { $sn = "Act"; }
        else if($book == "Romans") { $sn = "Rom"; }
        else if($book == "1Corinthians") { $sn = "1Co"; }
        else if($book == "2Corinthians") { $sn = "2Co"; }
        else if($book == "Galatians") { $sn = "Gal"; }
        else if($book == "Ephesians") { $sn = "Eph"; }
        else if($book == "Philippians") { $sn = "Php"; }
        else if($book == "Colossians") { $sn = "Col"; }
        else if($book == "1Thessalonians") { $sn = "1Th"; }
        else if($book == "2Thessalonians") { $sn = "2Th"; }
        else if($book == "1Timothy") { $sn = "1Ti"; }
        else if($book == "2Timothy") { $sn = "2Ti"; }
        else if($book == "Titus") { $sn = "Tit"; }
        else if($book == "Philemon") { $sn = "Phm"; }
        else if($book == "Hebrews") { $sn = "Heb"; }
        else if($book == "James") { $sn = "Jas"; }
        else if($book == "1Peter") { $sn = "1Pe"; }
        else if($book == "2Peter") { $sn = "2Pe"; }
        else if($book == "1John") { $sn = "1Jn"; }
        else if($book == "2John") { $sn = "2Jn"; }
        else if($book == "3John") { $sn = "3Jn"; }
        else if($book == "Jude") { $sn = "Jud"; }
        else if($book == "Revelation") { $sn = "Rev"; }
        return $sn;
    }
    public static function getAllBooks() {
        $path = file_get_contents(base_path('vendor/djunehor/laravel-bible/bibles/en/Books.json'));
        $data = json_decode($path, true);
        return $data;
    }
    public static function getAvatar() {
        $avatars = [
            'user.png', 'agent.png', 'andy.png', 'angel.png', 'captain.png', 'default.png', 'default2.png', 'fury.png', 'hulk.png',
            'machine.png', 'robot1.png', 'robot2.png'
        ];
        return Arr::random($avatars);
    }
    public static function cleanBody($body, $limit) {
        $body = strip_tags($body);
        $body = str_replace("&nbsp;", "", $body);
        $body = Str::words($body, $limit, ' ...');
        return $body;
    }
    public static function convertXMLToArray($path) {
        $xmlfile = file_get_contents($path);
        $new = simplexml_load_string($xmlfile);
        $con = json_encode($new);
        $newArr = json_decode($con, true);
        return $newArr; 
        // print_r($newArr); 
    }
    public static function getDisplay() {
        $im1 = asset('admin/images/profile-post-image.jpg');
        $im2 = asset('admin/images/animation-bg.jpg');
        $im3 = asset('admin/images/image-gallery/17.jpg');
        $im4 = asset('admin/images/image-gallery/1.jpg');
        $im5 = asset('admin/images/image-gallery/10.jpg');
        $im6 = asset('admin/images/image-gallery/7.jpg');
        $arr = [$im1, $im2, $im3, $im4, $im5, $im6];
        return Arr::random($arr);
    }
    public static function getQuotes() {
        $array = [
                '"The purpose of our lives is to be happy." — Dalai Lama',
                '"Life is what happens when you’re busy making other plans." — John Lennon',
                '"Get busy living or get busy dying." — Stephen King',
                '"You only live once, but if you do it right, once is enough." — Mae West',
                '"Many of life’s failures are people who did not realize how close they were to success when they gave up." – Thomas A. Edison',
                '"If you want to live a happy life, tie it to a goal, not to people or things." – Albert Einstein',
                '"Never let the fear of striking out keep you from playing the game." – Babe Ruth',
                '"Money and success don’t change people; they merely amplify what is already there." — Will Smith',
                '"Your time is limited, so don’t waste it living someone else’s life. Don’t be trapped by dogma – which is living with the results of other people’s thinking." – Steve Jobs',
                '"Not how long, but how well you have lived is the main thing." — Seneca',
                '"And all things, whatsoever ye shall ask in prayer, believing, ye shall receive." — Matthew 21:22',
                '"For I know the plans I have for you, plans to prosper you and not to harm you, plans to give you hope and a future." — Jeremiah 29:11',
                '"I consider that our present sufferings are not worth comparing with the glory that will be revealed in us." — Romans 8:18',
                '"To answer before listening – that is folly and shame." — Proverbs 18:13',
                '"The LORD makes firm the steps of the one who delights in him; though he may stumble, he will not fall, for the LORD upholds him with his hand." — Psalm 37:23-24',
                '"Trust in the LORD with all your heart and lean not on your own understanding." — Proverbs 3:5',
                '"The fear of the LORD is the beginning of knowledge, but fools despise wisdom and instruction." — Proverbs 1:7',
                '"There is a way that appears to be right, but in the end it leads to death." — Proverbs 14:12',
                '"As iron sharpens iron, so one person sharpens another." — Proverbs 27:17',
                '"A cheerful heart is good medicine, but a crushed spirit dries up the bones." — Proverbs 17:22',
                '"Those who conceal their sins do not prosper, but those who confess and renounce them find mercy." — Proverbs 28:13',
                '"Commit to the LORD whatever you do, and he will establish your plans." — Proverbs 16:3',
                '"In their hearts human beings plan their course, but the LORD establishes their steps." — Proverbs 16:9',
                '"A gentle answer turns away wrath, but a harsh word stirs up anger." — Proverbs 15:1',
                '"Those who spare the rod hate their children, but those who love them are careful to discipline them." — Proverbs 13:24',
                '"Honor the LORD with your wealth, with the firstfruits of all your crops." — Proverbs 3:9',
                '"Charm is deceptive, and beauty is fleeting; but a woman who fears the LORD is to be praised." — Proverbs 31:30',
                '"In all your ways submit to him, and he will make your paths straight." — Proverbs 3:6',
                '"The tongue has the power of life and death, and those who love it will eat its fruit." — Proverbs 18:21',
                '"One who has unreliable friends soon comes to ruin, but there is a friend who sticks closer than a brother." — Proverbs 18:24',
                '"Many are the plans in a human heart, but it is the LORD\'s purpose that prevails." — Proverbs 19:21'
            ];
        return Arr::random($array);
    }
    public static function get_local_time() {
        $ip = \Request::ip();
        $url = 'http://ip-api.com/json/'.$ip;
        $tz = file_get_contents($url);
        $tz = json_decode($tz,true)['timezone'];
        return $tz;
    }
    public static function getGreetings() {
        $now = Carbon::now(self::get_local_time());
        $hour = $now->format('H');
        if ($hour < 12) {
            return 'morning';
        }
        if ($hour < 17) {
            return 'afternoon';
        }
        return 'evening';
    }
    public static function getBody($im, $body) {
        $pos = strpos($body, $im);
        if($pos != false) {
            $pos = $pos - 29;
            $str1 = substr($body, 0, $pos);
            $rp = ' style="display: none;" ';
            $str2 = substr($body, $pos);
            $body = $str1 . $rp . $str2;
        }
        $body = strip_tags($body);
        $body = str_replace("&nbsp;", "", $body);
        return $body;
    }
    public static function simpleSEO($tt, $desc, $url, $type, $tw) {
        SEO::setTitle($tt);
        SEO::setDescription($desc);
        SEO::opengraph()->setUrl($url);
        SEO::setCanonical($url);
        SEO::opengraph()->addProperty('type', $type);
        SEO::twitter()->setSite($tw);
        return 'ok';
    }
    public static function setMultiSEO($posts) {
        $desc = "";
        foreach($posts as $pst) {
            $desc .= $pst->description . ", ";
        }
        return self::simpleSEO("Every published blog posts at Online Storehouse", $desc, 'https://onlinestorehouse.com/site', 'articles', '@Virgil_Dimple');
    }
    public static function setSEO($title, $desc, $keywords, $url, $type, $imgurl, $created_at, $updated_at, $expired_at, $author, $category, $tw) {
      $keywords = explode("-", $keywords);
      SEO::setTitle($title);
      SEO::setDescription($desc);
      SEOMeta::addKeyword($keywords);
      SEOMeta::addMeta('article:published_time', $created_at, 'property');
      SEOMeta::addMeta('article:section', $category, 'property');
      SEO::setCanonical($url);
      OpenGraph::setTitle($title)
        ->setDescription($desc)
        ->setUrl($url)
        ->setType($type)
        ->addImage($imgurl)
        ->setArticle([
            'published_time' => $created_at,
            'modified_time' => $updated_at,
            'expiration_time' => $expired_at,
            'author' => $author,
            'section' => $category,
            'tag' => $keywords
      ]);
      Twitter::setType($type)
            ->addImage($imgurl)
            ->setTitle($title)
            ->setDescription($desc)
            ->setUrl($url)
            ->setSite($tw);
      return 'ok';
    }
    public static function slugify($str) {
        $str = str_replace("-", " ", $str);
        return Str::slug($str, '-');
    }
    public static function getSubscriptions() {
        return [ 
                '0' => 'Trial', '1' => '1 Month', '2' => '2 Month', '3' => '3 Month', '4' => '4 Month', '5' => '5 Month', 
                '6' => '6 Months', '7' => '7 Month', '8' => '8 Month', '9' => '9 Month', '10' => '10 Month', '11' => '11 Month',
                '12' => '1 Year', '13' => '13 Month', '14' => '14 Month', '15' => '15 Month', '16' => '16 Month', '17' => '17 Month', 
                '18' => '18 Month', '19' => '19 Month', '20' => '20 Month', '21' => '21 Month', '22' => '22 Month', '23' => '23 Month', '24' => '2 Years'
                ];
    }
    public static function getMemberships() {
        return ['regular' => 'Regular', 'silver' => 'Silver', 'gold' => 'Gold', 'staff' => 'Staff', 'admin' => 'Admin'];
    }
    public static function getLimit($table) {
        $user = Auth::user();
        $limit = Subscription::where('name', $user->membership)->first();
        if($table == "photo") {
            return $limit->image;
        } else if($table == "post") {
            return $limit->article;
        }
    }
    public static function getErrors($page) {
        $err = "";
        if($page == "dashboard") {
            $err = "<h2>Your account has expired already!</h2>";
        } else if($page == "post") {
            $err = "<h2>Error showing the list of articles/posts. Your subscription has expired</h2>";
        } else if($page == "post_add") {
            $err = "<h2>Error adding new article/post. Your subscription has expired</h2>";
        } else if($page == "post_edit") {
            $err = "<h2>Error editing an article/post. Your subscription has expired</h2>";
        } else if($page == "post_delete") {
            $err = "<h2>Error deleting an article/post. Your subscription has expired</h2>";
        } else if($page == "photo") {
            $err = "<h2>Error showing the photo gallery.</h2>";
        } else if($page == "photo_add") {
            $err = "<h2>Error uploading new image. Your subscription has expired</h2>";
        } else if($page == "photo_edit") {
            $err = "<h2>Error editing an image. Your subscription has expired</h2>";
        } else if($page == "photo_delete") {
            $err = "<h2>Error deleting an image. Your subscription has expired</h2>";
        } else if($page == "comment") {
            $err = "<h2>Error showing the list of comments. Your subscription has expired</h2>";
        } else if($page == "comment_add") {
            $err = "<h2>Error adding new comments. Your subscription has expired</h2>";
        } else if($page == "comment_edit") {
            $err = "<h2>Error editing a comment. Your subscription has expired</h2>";
        } else if($page == "comment_delete") {
            $err = "<h2>Error deleting a comment. Your subscription has expired</h2>";
        } 
        return $err;
    }
    public static function isAllowed($action) {
        $user = Auth::user();
        $stat = "no";
        if($user->membership == "admin") {
            $stat = "yes";
        }
        return $stat; 
    }
    public static function isLimit($id, $membership, $table) {
        $subs = Subscription::where('name', $membership)->first();
        if($table == "post") {
            $pcntr = Post::where('user_id', $id)->count();
            $sub = (int)$subs->article;
        } else if($table == "photo") {
            $pcntr = Photo::where('user_id', $id)->count();
            $sub = (int)$subs->image;
        }
        if($pcntr >= $sub) {
            return 'limit exceeded';
        } else {
            return 'not exceeded';
        }
    }
    public static function getImages() {
        $arr = [];
        $ph = Photo::where('status', 'active')->get();
        $pst = Post::where('status', 'active')->where('reported', 'no')->where('published', 'yes')->get();
        foreach($ph as $p) {
            foreach($pst as $ps) {
                if(Str::contains($ps->body, $p->filename)) {
                    $arr[] = [$ps->id => $p->filename];
                }
            }
        }
        return $arr;
    }
    
    public static function findImage($images, $pid) {
        $found = false;
        foreach($images as $im) {
            if(array_key_exists($pid, $im)) {
                $found = $im[$pid];
            }
        }
        return $found;
    }
    
    public static function isExpired($user) {
        if($user->membership != "admin") {
            $now = Carbon::now();
            //$day = $now->addDay();
            $exp = new Carbon($user->expired_at);
            if($now > $exp) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public static function viewFrontPage($view, $model, $title, $page, $class, $params, $pp) {
        return view($view, [
            'title' => $title, 
            'page' => $page, 
            'model' => $model,
            'params' => $params,
            'othercategories' => self::getRandomCategories(7),
            'categories' => self::getCategories(10),
            'allcategories' => self::allCategories(),
            'populars' => self::getPopular(5),
            'comments' => self::getComments(5),
            'images' => self::getImages(),
            'tags' => self::getTags(10),
            'alltags' => self::getAllTags(),
            'post_paginator' => $pp,
            'bclass' => $class
        ]);
    }
    public static function viewPage($user, $model, $title, $message, $view, $menu, $params) {
        $profile_pic = asset('admin/images/user.png');
        if($user->picture != "" or $user->picture != null) {
            $profile_pic = asset('uploads/profiles/'. $user->picture);
        }
        return view($view, [
            'title' => $title, 
            'user' => $user,
            'model' => $model,
            'profile_pic' => $profile_pic,
            'err' => $message,
            'params' => $params,
            'menus' => self::menus($menu)
        ]);
    }
    public static function genPath($dir, $id, $ext) {
        $dt = Carbon::now();
        $ddate = str_replace_array('-', ['', ''], $dt->toDateTimeString());						
		$ddate = str_replace_array(' ', [''], $ddate);
		$flname = str_replace_array(':', ['', ''], $ddate);
		$ex = '.gif';
		if($ext != "gif") { $ex = '.jpg'; }
		$nm = $dir . '/' . $id ."-". $flname.$ex;
		return $nm;
    }
    public static function genSimplePath($dir, $ext) {
        $dt = Carbon::now();
        $ddate = str_replace_array('-', ['', ''], $dt->toDateTimeString());						
		$ddate = str_replace_array(' ', [''], $ddate);
		$flname = str_replace_array(':', ['', ''], $ddate);
		$ex = '.gif';
		if($ext != "gif") { $ex = '.jpg'; }
		$nm = $dir . '/'. $flname.$ex;
		return $nm;
    }
    public static function menus($act) {
        $menu1 = $menu2 = $menu3 = $menu4 = $menu5 = $menu6 = $menu7 = $menu8 = $menu9 = $menu10 = $menu11 = "";
        if($act == 'menu1') { $menu1 = 'active'; }
        if($act == 'menu2') { $menu2 = 'active'; }
        if($act == 'menu3') { $menu3 = 'active'; }
        if($act == 'menu4') { $menu4 = 'active'; }
        if($act == 'menu5') { $menu5 = 'active'; }
        if($act == 'menu6') { $menu6 = 'active'; }
        if($act == 'menu7') { $menu7 = 'active'; }
        if($act == 'menu8') { $menu8 = 'active'; }
        if($act == 'menu9') { $menu9 = 'active'; }
        if($act == 'menu10') { $menu10 = 'active'; }
        if($act == 'menu11') { $menu11 = 'active'; }
        return [
            'menu1' => $menu1,
            'menu2' => $menu2,
            'menu3' => $menu3,
            'menu4' => $menu4,
            'menu5' => $menu5,
            'menu6' => $menu6,
            'menu7' => $menu7,
            'menu8' => $menu8,
            'menu9' => $menu9,
            'menu10' => $menu10,
            'menu11' => $menu11
        ];
    }
    public static function getQuizzes($cntr, $field, $value, $field2, $value2) {
        if($value2 == "") {
            return Quiz::withCount('choices')->inRandomOrder()->where($field, $value)->where('status', 'active')->orderBy('created_at', 'desc')->take($cntr)->get();
        } else {
            return Quiz::withCount('choices')->inRandomOrder()->where($field, $value)->where($field2, $value2)->where('status', 'active')->orderBy('created_at', 'desc')->take($cntr)->get();
        }
    }
    public static function getAllTags() {
        return Tag::where('id', '!=', null)->get();
    }
    public static function getTags($cntr) {
        return Tag::where('id', '!=', null)->take($cntr)->get();
    }
    public static function getComments($cntr) {
        return Comment::where('status', 'active')->where('reported', 'no')->orderBy('created_at', 'desc')->take($cntr)->get();
    }
    public static function getPopular($cntr) {
        return Post::withCount('comments')->where('status', 'active')->where('reported', 'no')->where('published', 'yes')->where('popular', 'yes')->orderBy('date_posted', 'desc')->take($cntr)->get();
    }
    public static function allCategories() {
        return Category::withCount('posts')->where('status', 'active')->where('reported', 'no')->where('dummy', 'no')->orderBy('name', 'asc')->get();
    }
    public static function getCategories($cntr) {
        return Category::withCount('posts')->where('status', 'active')->where('reported', 'no')->where('dummy', 'no')->orderBy('name', 'asc')->take($cntr)->get();
    }
    public static function getRandomCategories($cntr) {
        return Category::withCount('posts')->inRandomOrder()->where('status', 'active')->where('reported', 'no')->where('dummy', 'no')->orderBy('name', 'asc')->take($cntr)->get();
    }
    public static function getIcons() {
        $icons = [
            'anchor', 'angellist', 'git', 'apple', 'archive', 'asterisk', 'podcast', 'paint-brush',
            'bluetooth', 'at', 'clipboard', 'car', 'cloud', 'ravelry', 'briefcase', 'hand-o-right',
            'coffee', 'cogs', 'backward', 'ban', 'power-off', 'barcode', 'building', 'grav',
            'bars', 'tint', 'bed', 'beer', 'behance', 'bell', 'bicycle', 'bathtub', 'bank', 'smile-o',
            'compass', 'binoculars', 'bitbucket', 'bitcoin', 'copy', 'cube', 'snowflake-o', 'address-book',
            'cubes', 'cut', 'pencil', 'envelope', 'eraser', 'eye', 'fax', 'file', 'heartbeat',
            'film', 'fire', 'flag', 'flask', 'mobile', 'gamepad', 'gavel', 'motorcycle', 'bath',
            'gift', 'lock', 'globe', 'magnet', 'headphones', 'home', 'medkit', 'road', 'bandcamp',
            'hourglass', 'image', 'industry', 'key', 'television', 'laptop', 'ambulance', 'microphone',
            'share', 'phone', 'registered', 'times', 'plus-circle', 'send', 'rocket', 'registered',
            'rss-square', 'safari', 'plus', 'search', 'shopping-cart', 'plane', 'remove', 'signal',
            'bullhorn', 'calculator', 'taxi', 'tag', 'tasks', 'music', 'credit-card', 'trash', 
            'bolt', 'trademark', 'tree', 'trophy', 'refresh', 'reply', 'plug', 'qrcode', 'print', 'rss', 'recycle',
            'sign-in', 'user', 'sign-out', 'server', 'user-plus', 'users', 'ticket', 'truck', 'facebook', 'twitter',
            'linkedin', 'pinterest', 'instagram', 'github', 'firefox', 'dropbox', 'wordpress', 'joomla', 'drupal', 'digg',
            'paypal', 'slack', 'google', 'skype', 'opera', 'scribd', 'linux', 'reddit', 'maxcdn', 'spotify', 'rebel', 'qq',
            'snapchat', 'modx', 'openid', 'opencart', 'pagelines', 'slideshare', 'skyatlas', 'renren', 'stack-overflow',
            'stack-exchange', 'steam', 'jsfiddle', 'tumblr', 'youtube', 'trello', 'soundcloud', 'usb', 'vimeo', 'wechat',
            'vk', 'whatsapp', 'share-alt', 'resistance', 'sellsy', 'wikipedia-w', 'windows', 'xing', 'vine', 'wpforms',
            'weixin', 'stumbleupon', 'product-hunt', 'pied-piper', 'chrome', 'mixcloud', 'lastfm', 'medium', 'yelp', 'yahoo', 'gg',
            'glide', 'flickr', 'ge', 'empire', 'envira', 'edge', 'fonticons', 'foursquare', 'expeditedssl', 'css3', 'codepen'
        ];
        $icons = Arr::sort($icons);
        $icn = [];
        foreach($icons as $ic) {
            $icn[$ic] = $ic;    
        }
        return $icn;
    }
    public static function cleanPaginator($data) {
        $pag = str_replace('<ul class="pagination">', '<ul>', $data); 
        $pag = str_replace('<nav>', '', $pag); 
        $pp = str_replace('</nav>', '', $pag);
        return $pp;
    }
}
