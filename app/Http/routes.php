<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('aaa',function(){
//   try {
//        Mail::send('emails.confirm', array('url' => "aaaa"), function ($message) {
//            $message->from('simpleapp789@gmail.com', 'Simple');
//            $message->to('simpleapp789@gmail.com', "bbbbb")->subject('Confirmation!');
//        });
//    }catch(Exception $e){
//        if($e->getCode() == 554)
//            session()->flash('email_error', 'Email doesn\'t exists.');
//        else
//            session()->flash('error', 'Something went wrong');
//            dd($e);
//    }
//    dd(11);
//});


Route::get('bbb',function(){
    // Set your secret key: remember to change this to your live secret key in production
// See your keys here: https://dashboard.stripe.com/account/apikeys
    \Stripe\Stripe::setApiKey("sk_test_NJlLUtLs1A9uU0T3qpgPZrsG");

// Get the credit card details submitted by the form
    $token = $_POST['_token'];

// Create a charge: this will charge the user's card
    try {
        \Stripe\Stripe::setApiKey("sk_test_NJlLUtLs1A9uU0T3qpgPZrsG");

        \Stripe\Charge::create(array(
            'amount' => 1000,
            'currency' => 'eur',
            'source' => $token,
            ));
    } catch(\Stripe\Error\Card $e) {
       dd(11);
    }
});


Route::get('/', function () {
     return   redirect('/home');
});

Route::auth();

Route::post('login','Auth\AuthController@login');
Route::get('logout','Auth\AuthController@logout');
Route::get('register','Auth\AuthController@showRegistrationForm');
Route::post('register','Auth\AuthController@register');
Route::post('password/email','Auth\PasswordController@sendResetLinkEmail');
Route::post('password/reset','Auth\PasswordController@reset');
Route::get('password/reset/{token?}','Auth\PasswordController@showResetForm');

Route::get('approve-account/{id}/{token}','Auth\AuthController@activate');

Route::get('/home', 'HomeController@index');

Route::group([ 'prefix' => 'admin', 'namespace' => 'Admin'],function(){

    Route::auth();
    Route::get('/','AdminBaseController@index');
    Route::get('/home', 'AdminBaseController@index');
    
    Route::resource('tags', 'TagsController');

    Route::get('questions/{id}/share','QuestionsController@getShare');
    Route::post('questions/{id}/share','QuestionsController@postShare');
    Route::delete('questions/remove/{id}','QuestionsController@remove');
//    Route::get('questions/{id}/tags','QuestionsController@getTags');
//    Route::post('questions/{id}/tags','QuestionsController@postTags');
//    Route::delete('questions/remove/{id}/tag','QuestionsController@removeTags');
//    Route::get('questions','QuestionsController@index');
    Route::resource('questions', 'QuestionsController');


    Route::get('marketers','MarketersController@index');
    Route::get('marketers/{id}','MarketersController@show');
    Route::post('marketers/pay','MarketersController@pay');
    Route::get('marketers/activate/{id}','MarketersController@activate');
    Route::get('marketers/contract/{id}','MarketersController@contract');

    Route::get('user/{user_id}/question/{question_id}/answer','AnswersController@getShow');
    Route::get('answer/{id}/edit','AnswersController@getEdit');
    Route::post('answer/{id}/edit','AnswersController@postEdit');
    Route::get('answer/{id}/approve','AnswersController@approve');
    Route::get('answer/{id}/tags','AnswersController@getTags');
    Route::post('answer/{id}/tags/add','AnswersController@addTagToAnswer');
    Route::delete('answer/{answer_id}/tags/remove/{tag_id}','AnswersController@deleteTagFromAnswer');

    Route::get('users/{id}/questionary', 'UsersController@getQuestions');
    Route::resource('users', 'UsersController',['only' => ['index','show']]);

    Route::get('notification/changeStatus/{id}','AdminBaseController@changeStatus');
    Route::get('notification/all','AdminBaseController@getAllNotifications');
    
    Route::get('contacts','ContactsController@index');
    Route::get('contacts/{role}/create','ContactsController@store');
    Route::get('contacts/{id}/edit','ContactsController@update');
    Route::delete('contacts/{id}','ContactsController@destroy');
    
    Route::get('homePage','PagesController@home');
    Route::get('homePage/{id}/edit','PagesController@homeUpdate');

    Route::get('aboutPage','PagesController@about');
    Route::get('aboutPage/{field}/edit','PagesController@aboutUpdate');
    
    Route::get('partnerPage','PagesController@partner');
    Route::get('partnerPage/{field}/edit','PagesController@partnerUpdate');


});


Route::group([ 'prefix' => 'user', 'namespace' => 'User'],function(){
    Route::get('/account','UserController@index');


    Route::get('/questions', 'UserController@getQuestions');
    Route::get('/question/{id}/answer','AnswerController@redirectIfAnswered');
    Route::post('/question/{id}/answer','AnswerController@postAnswer');
    Route::post('question/{id}/answer/images','AnswerController@addImages');
    Route::delete('image/{id}','AnswerController@removeImageFromAnswer');
    Route::post('question/{id}/answer/videos','AnswerController@addVideos');
    Route::delete('video/{id}','AnswerController@removeVideoFromAnswer');
    Route::get('question/answer/{id}/edit','AnswerController@getUpdateAnswer');
    Route::post('question/answer/{id}/edit','AnswerController@postUpdateAnswer');
    Route::get('question/answer/{id}/show','AnswerController@showAnswer');
    Route::delete('question/answer/{id}','AnswerController@delete');
    Route::post('videos/add','AnswerController@addVideos');
    Route::post('images/add','AnswerController@addImages');

    Route::get('question/answer/{id}/{alias}','AnswerController@getAlias');

    Route::get('notification/changeStatus/{id}','UserBaseController@changeStatus');
    Route::get('notification/all','UserBaseController@getAllNotifications');

    Route::get('account-details','AccountController@index');
    Route::post('account-details','AccountController@update');
    Route::get('account-details/password','AccountController@getChangePassword');
    Route::post('account-details/password','AccountController@postChangePassword');
    Route::get('account-details/remove-avatar','AccountController@removeAvatar');

    Route::get('delete','AccountController@delete');

    
});

 Route::group(['prefix' => 'marketer', 'namespace' => 'Marketer'],function(){

//     Route::auth();

     Route::get('auth','Auth\AuthController@showForm');
     Route::post('login','Auth\AuthController@login');
     Route::get('logout','Auth\AuthController@logout');
     Route::get('auth/contract', 'Auth\AuthController@getDownload');
//     Route::get('register','Auth\AuthController@showRegistrationForm');
     Route::post('register','Auth\AuthController@register');
     Route::post('password/email','Auth\PasswordController@sendResetLinkEmail');
     Route::post('password/reset','Auth\PasswordController@reset');
     Route::get('password/reset/{token?}','Auth\PasswordController@showResetForm');

     Route::get('/account','MarketerController@index');

     Route::get('account-details','AccountController@index');
     Route::post('account-details','AccountController@update');
     Route::get('account-details/password','AccountController@getChangePassword');
     Route::post('account-details/password','AccountController@postChangePassword');
     Route::get('account-details/remove-avatar','AccountController@removeAvatar');

     Route::get('commissions','MarketerController@commissions');


     Route::get('notification/changeStatus/{id}','MarketerBaseController@changeStatus');
     Route::get('notification/all','MarketerBaseController@getAllNotifications');

     Route::get('users','MarketerController@getUsers');
     Route::get('users/{id}','MarketerController@getUser');

 });

Route::get('search','SearchController@index');
Route::get('search/{id}','SearchController@getByTagId');
Route::post('search','SearchController@getByName');

Route::get('answer/{id}','HomeController@showAnswer');
Route::get('user/{id}','HomeController@getUser');

Route::group(['middleware' => ['web']], function () {
    Route::get('payPremium', ['as'=>'payPremium','uses'=>'PaypalController@payPremium']);
    Route::get('getCheckout/{status}/{id}', ['as'=>'getCheckout','uses'=>'PaypalController@getCheckout']);
    Route::get('getDone', ['as'=>'getDone','uses'=>'PaypalController@getDone']);
    Route::get('{id}/getCancel', ['as'=>'getCancel','uses'=>'PaypalController@getCancel']);
});

Route::get('contact','ContactController@index');
Route::get('getLocation','ContactController@getLocation');
Route::post('contact','ContactController@sendMail');


Route::get('about','AboutUSController@index');
Route::get('partnerWithUS','MarketerController@index');


//Route::get('order', ['as' => 'order', 'uses' => 'PagesController@getOrder']);
//Route::post('order', ['as' => 'order-post', 'uses' => 'PagesController@postOrder']);

return view('errors.404');




