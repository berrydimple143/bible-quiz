<?php
    use Spatie\Sitemap\SitemapGenerator;
    
    //Route::get('/', 'SiteController@maintenance')->name('site');
    Route::get('/', 'BibleController@bible_quiz')->name('site');
    Route::get('/ads.txt',function() {
       return view('ads');
    });
    Route::get('/test', 'BibleController@test')->name('test.site');
    Route::get('/donation/successful', 'BibleController@donate_success')->name('donate.success');
    Route::get('/donation/cancelled', 'BibleController@donate_cancel')->name('donate.cancel');
    Route::get('/blogs', 'SiteController@index')->name('blogs');
    Route::get('robots.txt', 'RobotsController');
    Route::get('site', 'SiteController@index');
    Route::post('subscribe/newsletter', 'SiteController@subscribe_newsletter')->name('subscribe.newsletter');
    Route::get('blog/{slug}', 'SiteController@post')->name('single.post');
    Route::post('send/comment', 'SiteController@send_comment')->name('send.comment');
    Route::get('blog/category/{slug}', 'SiteController@categories')->name('blog.categories');
    Route::post('search/blogs', 'SiteController@search_blog')->name('search.blog');
    Route::get('privacy', 'SiteController@privacy')->name('privacy');
    Route::get('contact', 'SiteController@contact')->name('contact');
    Route::post('contact/send', 'SiteController@send_contact')->name('contact.send');
    Route::get('about', 'SiteController@about')->name('about');
    Route::get('search/with/tag/{id}', 'SiteController@with_tag')->name('search.tag');
    Route::get('all/blog/categories', 'SiteController@all_categories')->name('all.categories');
    Route::get('all/blog/tags', 'SiteController@all_tags')->name('all.tags');
    Route::get('view/sitemap', 'SiteController@view_sitemap')->name('view.sitemap');
    Route::get('redirect/to/{page}', 'SiteController@redirectToPage')->name('redirect.to');
    Route::get('not-yet-available', 'SiteController@not_available')->name('not.available');
    Route::get('download/now/{filename}', 'BibleController@download_now')->name('download.now');
    Route::get('bible/quiz/with/items', 'BibleController@select_items')->name('select.items');
    Route::get('bible', 'BibleController@bible')->name('bible');
    Route::get('bible/search', 'BibleController@bible_search')->name('bible.search');
    Route::get('bible/search/topic', 'BibleController@bible_search_topic')->name('bible.search.topic');
    Route::get('bible/search/word', 'BibleController@bible_search_word')->name('bible.search.word');
    Route::post('get/book/chapter', 'BibleController@book_chapter')->name('book.chapter');
    Route::post('get/book/verse', 'BibleController@book_verse')->name('book.verse');
    Route::get('bible/quiz/by/level/{level}/{items}/{qcategory}', 'BibleController@quiz_level')->name('select.quiz.level');
    Route::post('send/discussion', 'BibleController@send_discussion')->name('send.discussion');
    Route::post('download/quiz', 'BibleController@download_quiz')->name('download.quiz');
    Route::post('save/quiz', 'BibleController@save_quiz')->name('save.quiz');
    Route::get('player/signup', 'BibleController@signup')->name('quiz.signup');
    Route::get('player/login', 'BibleController@login')->name('quiz.login');
    Route::post('register/player', 'BibleController@register')->name('register.player');
    Route::post('player/login', 'BibleController@login_now')->name('player.login');
    Route::get('bible/quiz/by/category/{level}/{items}/{qcategory}', 'BibleController@quiz_category')->name('select.quiz.category');
    
    Route::get('sitemap', function() {
        SitemapGenerator::create('http://onlinestorehouse.com/')->writeToFile('sitemap.xml');
        return Redirect::route('site');
    })->name('sitemap');
    
    // Payments 
    Route::get('subscribe', 'SiteController@subscribe')->name('subscribe');
    Route::get('subscription/payment/{stype}/{amt}', 'SiteController@payment')->name('premium.pay');
    Route::post('/paynow', 'PaypalPaymentController@paynow')->name('pay.now');
    Route::post('/creditcard/payment', 'PaypalPaymentController@processCreditCard')->name('creditcard.pay');
    Route::get('/payments/success/{crypto}', 'PaypalPaymentController@payment_successful')->name('payment.success');
    Route::get('/payments/fails/{ftype}', 'PaypalPaymentController@payment_failed')->name('payment.failed');
    Route::get('/payment', 'PaypalPaymentController@index')->name('payment');
    Route::get('/payment/{id}', 'PaypalPaymentController@show')->name('payment.show');
    Route::get('/free-registration/successful/{id}', 'PaypalPaymentController@registration_successful')->name('registration.successful');
    Route::get('/free-registration/failed/{firstname}', 'PaypalPaymentController@registration_failed')->name('registration.failed');
    
    Auth::routes();
    Route::prefix('control')->group(function () {
        
        // Dashboard
        Route::get('/', 'HomeController@index')->name('dashboard');
        Route::post('profile', 'HomeController@profile')->name('profile.store');
        Route::post('password/update', 'HomeController@password_update')->name('password.update');
        Route::get('email/change', 'HomeController@email_change')->name('email.change');
        Route::post('email/update', 'HomeController@email_update')->name('email.update');
        Route::get('picture/change', 'HomeController@picture_change')->name('picture.change');
        Route::post('picture/update', 'HomeController@picture_update')->name('picture.update');
        Route::get('logout', 'HomeController@logout')->name('logout');
        
        // Users
        Route::get('users', 'UserController@index')->name('users');
        Route::get('user/add', 'UserController@create')->name('user.add');
        Route::post('user', 'UserController@store')->name('user.store');
        Route::get('user/edit/{id}', 'UserController@edit')->name('user.edit');
        Route::put('user/update/{id}', 'UserController@update')->name('user.update');
        Route::get('user/show/{id}', 'UserController@show')->name('user.show');
        Route::get('user/delete/{id}', 'UserController@delete')->name('user.delete');
        Route::delete('user/destroy/{id}', 'UserController@destroy')->name('user.destroy');
        
        // Posts
        Route::get('posts', 'PostController@index')->name('posts');
        Route::get('post/add', 'PostController@create')->name('post.add');
        Route::post('post', 'PostController@store')->name('post.store');
        Route::get('post/edit/{id}', 'PostController@edit')->name('post.edit');
        Route::get('post/tags/{id}', 'PostController@tags')->name('post.tags');
        Route::get('post/tag/add/{id}', 'PostController@tag_add')->name('post.tag.add');
        Route::post('post/tag', 'PostController@store_tag')->name('post.tag.store');
        Route::get('post/tag/delete/{id}/{tag_id}', 'PostController@tag_delete')->name('post.tag.delete');
        Route::post('post/tag/destroy', 'PostController@tag_destroy')->name('post.tag.destroy');
        Route::put('post/update/{id}', 'PostController@update')->name('post.update');
        Route::get('post/comments/show/{id}', 'CommentController@show')->name('post.comments.show');
        Route::get('post/delete/{id}', 'PostController@delete')->name('post.delete');
        Route::delete('post/destroy/{id}', 'PostController@destroy')->name('post.destroy');
        
        // Photos
        Route::get('photos', 'PhotoController@index')->name('photos');
        Route::get('photo/add', 'PhotoController@create')->name('photo.add');
        Route::get('photo/select/{id}', 'PhotoController@select')->name('photo.select');
        Route::get('photo/deactivate/{id}', 'PhotoController@deactivate')->name('photo.deactivate');
        Route::get('photo/deselect/{id}', 'PhotoController@deselect')->name('photo.deselect');
        Route::get('photo/activate/{id}', 'PhotoController@activate')->name('photo.activate');
        Route::post('photo', 'PhotoController@store')->name('photo.store');
        Route::get('photo/edit/{id}', 'PhotoController@edit')->name('photo.edit');
        Route::put('photo/update/{id}', 'PhotoController@update')->name('photo.update');
        Route::get('photo/delete/{id}', 'PhotoController@delete')->name('photo.delete');
        Route::delete('photo/destroy/{id}', 'PhotoController@destroy')->name('photo.destroy');
        
        // Comments
        Route::get('comments', 'CommentController@index')->name('comments');
        Route::get('comment/add', 'CommentController@create')->name('comment.add');
        Route::post('comment', 'CommentController@store')->name('comment.store');
        Route::get('comment/edit/{id}', 'CommentController@edit')->name('comment.edit');
        Route::put('comment/update/{id}', 'CommentController@update')->name('comment.update');
        Route::get('comment/show/{id}', 'CommentController@show')->name('comment.show');
        Route::get('comment/delete/{id}', 'CommentController@delete')->name('comment.delete');
        Route::delete('comment/destroy/{id}', 'CommentController@destroy')->name('comment.destroy');
        
        // Categories
        Route::get('categories', 'CategoryController@index')->name('categories');
        Route::get('category/add', 'CategoryController@create')->name('category.add');
        Route::post('category', 'CategoryController@store')->name('category.store');
        Route::get('category/edit/{id}', 'CategoryController@edit')->name('category.edit');
        Route::put('category/update/{id}', 'CategoryController@update')->name('category.update');
        Route::get('category/show/{id}', 'CategoryController@show')->name('category.show');
        Route::get('category/delete/{id}', 'CategoryController@delete')->name('category.delete');
        Route::delete('category/destroy/{id}', 'CategoryController@destroy')->name('category.destroy');
        
        // Subscriptions
        Route::get('subscriptions', 'SubscriptionController@index')->name('subscriptions');
        Route::get('subscription/add', 'SubscriptionController@create')->name('subscription.add');
        Route::post('subscription', 'SubscriptionController@store')->name('subscription.store');
        Route::get('subscription/edit/{id}', 'SubscriptionController@edit')->name('subscription.edit');
        Route::put('subscription/update/{id}', 'SubscriptionController@update')->name('subscription.update');
        Route::get('subscription/show/{id}', 'SubscriptionController@show')->name('subscription.show');
        Route::get('subscription/delete/{id}', 'SubscriptionController@delete')->name('subscription.delete');
        Route::delete('subscription/destroy/{id}', 'SubscriptionController@destroy')->name('subscription.destroy');
        
        // Quizzes
        Route::get('quizzes', 'QuizController@index')->name('quizzes');
        Route::get('quiz/add', 'QuizController@create')->name('quiz.add');
        Route::post('quiz', 'QuizController@store')->name('quiz.store');
        Route::get('quiz/edit/{id}', 'QuizController@edit')->name('quiz.edit');
        Route::put('quiz/update/{id}', 'QuizController@update')->name('quiz.update');
        Route::get('quiz/show/{id}', 'QuizController@show')->name('quiz.show');
        Route::get('quiz/delete/{id}', 'QuizController@delete')->name('quiz.delete');
        Route::delete('quiz/destroy/{id}', 'QuizController@destroy')->name('quiz.destroy');
        
        // Quiz's Choices
        Route::get('quiz/choices/{id}', 'QuizController@choices')->name('quiz.choices');
        Route::get('choice/add/{id}', 'QuizController@choice_add')->name('choice.add');
        Route::post('choice', 'QuizController@choice_store')->name('choice.store');
        Route::get('choice/edit/{id}/{qid}', 'QuizController@choice_edit')->name('choice.edit');
        Route::put('choice/update/{id}', 'QuizController@choice_update')->name('choice.update');
        Route::get('choice/delete/{id}/{qid}', 'QuizController@choice_delete')->name('choice.delete');
        Route::delete('choice/destroy/{id}', 'QuizController@choice_destroy')->name('choice.destroy');
        
        // Bible Topics
        Route::get('bible/topics', 'TopicController@index')->name('topics');
        Route::get('bible/topic/add', 'TopicController@create')->name('topic.add');
        Route::post('bible/topic', 'TopicController@store')->name('topic.store');
        Route::get('bible/topic/edit/{id}', 'TopicController@edit')->name('topic.edit');
        Route::put('bible/topic/update/{id}', 'TopicController@update')->name('topic.update');
        Route::get('bible/topic/delete/{id}', 'TopicController@delete')->name('topic.delete');
        Route::delete('bible/topic/destroy/{id}', 'TopicController@destroy')->name('topic.destroy');
        
        // Bible Books
        Route::get('bible/books', 'BookController@index')->name('books');
        Route::get('bible/book/add', 'BookController@create')->name('book.add');
        Route::post('bible/book', 'BookController@store')->name('book.store');
        Route::get('bible/book/edit/{id}', 'BookController@edit')->name('book.edit');
        Route::put('bible/book/update/{id}', 'BookController@update')->name('book.update');
        Route::get('bible/book/delete/{id}', 'BookController@delete')->name('book.delete');
        Route::delete('bible/book/destroy/{id}', 'BookController@destroy')->name('book.destroy');
        
        // Bible Verses
        Route::get('bible/verses', 'VerseController@index')->name('verses');
        Route::get('bible/verse/add', 'VerseController@create')->name('verse.add');
        Route::post('bible/verse', 'VerseController@store')->name('verse.store');
        Route::get('bible/verse/edit/{id}', 'VerseController@edit')->name('verse.edit');
        Route::put('bible/verse/update/{id}', 'VerseController@update')->name('verse.update');
        Route::get('bible/verse/show/{id}', 'VerseController@show')->name('verse.show');
        Route::get('bible/verse/delete/{id}', 'VerseController@delete')->name('verse.delete');
        Route::delete('bible/verse/destroy/{id}', 'VerseController@destroy')->name('verse.destroy');
        
    });