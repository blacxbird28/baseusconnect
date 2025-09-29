<?php

use App\Mail\RegistrationFormMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\OurEventController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ConfigurationController;
use App\Http\Controllers\Dashboard\ActivitySubmitController;
use App\Http\Controllers\Dashboard\PostsController;
use App\Http\Controllers\Dashboard\PrizeController;
use App\Http\Controllers\Dashboard\LeaderboardController;
use App\Http\Controllers\Dashboard\EventsController;
use App\Http\Controllers\Dashboard\CommunityController;
use App\Http\Controllers\Dashboard\RedeemController;
use App\Http\Controllers\Dashboard\MembersController;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/about', [AboutController::class, 'index'])->name('about.index');
Route::get('/our-event', [OurEventController::class, 'index'])->name('our-event.index');
Route::get('/our-event/{slug}', [OurEventController::class, 'detail_event'])->name('detail-event');
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{slug}', [NewsController::class, 'detail_news'])->name('detail-news');

// Route::resource('registrations', RegistrationController::class);
Route::get('/registrations', [RegistrationController::class, 'index'])->name('registrations.index');
Route::post('/registrations/store', [RegistrationController::class, 'store'])->name('registrations.store');
Route::get('/registrations/success', [RegistrationController::class, 'success'])->name('registrations.success');

// http://baseusconnect.id/send-email?name=Yakin&email=yakinsajarotul@gmail.com
Route::get('/send-email', function () {
    $email = request()->query('email');
    $groupLink = request()->query('groupLink');

    if (!$email) {
        return response('Missing email parameters.', 400);
    }

    Mail::to($email)->send(new RegistrationFormMail($email, $groupLink));

    return 'Email sent successfully to ' . $email . '!';
});


Route::get('/email-template', function () {
    return view('emails.registration');
});


Route::get('/generate-image', [ProfileController::class, 'generateImage'])->name('generate-image');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/posts-data', [ProfileController::class, 'posts_data'])->name('profile.posts-data');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/activity', [ProfileController::class, 'activity_add'])->name('activity.add');
    Route::post('/activity/store', [ProfileController::class, 'activity_store'])->name('activity.store');

    Route::get('/redeem', [ProfileController::class, 'redeem_add'])->name('redeem.add');
    Route::post('/redeem/store', [ProfileController::class, 'redeem_store'])->name('redeem.store');
});

Route::middleware(['auth', 'role:super-admin|captain'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/upload-image', [DashboardController::class, 'uploadImage'])->name('dashboard.upload-image');

    Route::get('/dashboard/members', [MembersController::class, 'index'])->name('dashboard.members.index');
    Route::get('/dashboard/members/data', [MembersController::class, 'participant_data'])->name('dashboard.members.data');
    Route::get('/dashboard/members/create', [MembersController::class, 'participant_create'])->name('dashboard.members.create');
    Route::get('/dashboard/members/show/{id}', [MembersController::class, 'participant_show'])->name('dashboard.members.show');
    Route::get('/dashboard/members/edit/{id}', [MembersController::class, 'participant_edit'])->name('dashboard.members.edit');
    Route::get('/dashboard/members/delete/{id}', [MembersController::class, 'participant_delete'])->name('dashboard.members.delete');
    Route::post('/dashboard/members/{id}/update-status', [MembersController::class, 'participant_updateStatus'])->name('dashboard.members.update-status');
    Route::post('/dashboard/members', [MembersController::class, 'participant_save'])->name('dashboard.members.save');
    Route::put('/dashboard/members/{id}', [MembersController::class, 'participant_save'])->name('dashboard.members.update');

    Route::get('/dashboard/posts', [PostsController::class, 'index'])->name('dashboard.posts.index');
    Route::get('/dashboard/posts/create', [PostsController::class, 'create'])->name('dashboard.posts.create');
    Route::get('/dashboard/posts/edit/{post}', [PostsController::class, 'edit'])->name('dashboard.posts.edit');
    Route::post('/dashboard/posts/delete/{id}', [PostsController::class, 'delete'])->name('dashboard.posts.delete');
    Route::post('/dashboard/posts/{id}/update-status', [PostsController::class, 'updateStatus'])->name('dashboard.posts.update-status');
    Route::post('/dashboard/posts/store', [PostsController::class, 'store'])->name('dashboard.posts.store');
    Route::put('/dashboard/posts/update/{id}', [PostsController::class, 'store'])->name('dashboard.posts.update');
    Route::get('/dashboard/posts/get-data', [PostsController::class, 'getData'])->name('posts.get-data');

    Route::get('/dashboard/activity-submit', [ActivitySubmitController::class, 'index'])->name('dashboard.activity-submit.index');
    Route::post('/dashboard/activity-submit/{id}/update-status', [ActivitySubmitController::class, 'updateStatus'])->name('dashboard.activity-submit.update-status');
    Route::get('/dashboard/activity-submit/get-data', [ActivitySubmitController::class, 'getData'])->name('dashboard.activity-submit.get-data');
    // Route::get('/dashboard/posts/create', [ActivityController::class, 'create'])->name('dashboard.posts.create');
    // Route::get('/dashboard/posts/edit/{post}', [ActivityController::class, 'edit'])->name('dashboard.posts.edit');
    // Route::post('/dashboard/posts/delete/{id}', [ActivityController::class, 'delete'])->name('dashboard.posts.delete');
    // Route::post('/dashboard/posts/store', [ActivityController::class, 'store'])->name('dashboard.posts.store');
    // Route::put('/dashboard/posts/update/{id}', [ActivityController::class, 'store'])->name('dashboard.posts.update');

    Route::get('/dashboard/redeem', [RedeemController::class, 'index'])->name('dashboard.redeem.index');
    Route::post('/dashboard/redeem/{id}/update-status', [RedeemController::class, 'updateStatus'])->name('dashboard.redeem.update-status');
    Route::get('/dashboard/redeem/get-data', [RedeemController::class, 'getData'])->name('dashboard.redeem.get-data');

    Route::get('/dashboard/prize', [PrizeController::class, 'index'])->name('dashboard.prize.index');
    Route::get('/dashboard/prize/create', [PrizeController::class, 'create'])->name('dashboard.prize.create');
    Route::get('/dashboard/prize/edit/{id}', [PrizeController::class, 'edit'])->name('dashboard.prize.edit');
    Route::post('/dashboard/prize/delete/{id}', [PrizeController::class, 'delete'])->name('dashboard.prize.delete');
    Route::post('/dashboard/prize/store', [PrizeController::class, 'store'])->name('dashboard.prize.store');
    Route::put('/dashboard/prize/update/{id}', [PrizeController::class, 'store'])->name('dashboard.prize.update');
    Route::get('/dashboard/prize/get-data', [PrizeController::class, 'getData'])->name('dashboard.prize.get-data');

    Route::get('/dashboard/leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard.index');
    Route::get('/dashboard/leaderboard/data', [LeaderboardController::class, 'leaderboard_data'])->name('leaderboard.data');

    Route::get('/dashboard/event', [EventsController::class, 'index'])->name('dashboard.event.index');
    Route::get('/dashboard/event/create', [EventsController::class, 'create'])->name('dashboard.event.create');
    Route::get('/dashboard/event/edit/{id}', [EventsController::class, 'edit'])->name('dashboard.event.edit');
    Route::post('/dashboard/event/delete/{id}', [EventsController::class, 'delete'])->name('dashboard.event.delete');
    Route::post('/dashboard/event/store', [EventsController::class, 'store'])->name('dashboard.event.store');
    Route::put('/dashboard/event/update/{id}', [EventsController::class, 'store'])->name('dashboard.event.update');
    Route::get('/dashboard/event/get-data', [EventsController::class, 'getData'])->name('dashboard.event.get-data');

    Route::get('/dashboard/community', [CommunityController::class, 'index'])->name('dashboard.community.index');
    Route::get('/dashboard/community/create', [CommunityController::class, 'create'])->name('dashboard.community.create');
    Route::get('/dashboard/community/edit/{id}', [CommunityController::class, 'edit'])->name('dashboard.community.edit');
    Route::post('/dashboard/community/delete/{id}', [CommunityController::class, 'delete'])->name('dashboard.community.delete');
    Route::post('/dashboard/community/store', [CommunityController::class, 'store'])->name('dashboard.community.store');
    Route::put('/dashboard/community/update/{id}', [CommunityController::class, 'store'])->name('dashboard.community.update');
    Route::get('/dashboard/community/get-data', [CommunityController::class, 'getData'])->name('dashboard.community.get-data');
});

Route::middleware(['auth', 'role:super-admin|captain'])->group(function () {
    Route::get('/dashboard/configuration', [ConfigurationController::class, 'index'])->name('configuration.index');
    Route::get('/dashboard/configuration/create', [ConfigurationController::class, 'create'])->name('configuration.create');
    Route::post('/dashboard/configuration/store', [ConfigurationController::class, 'store'])->name('configuration.store');
    Route::post('/dashboard/configuration/send-email', [ConfigurationController::class, 'sendEmail'])->name('configuration.send-email');
    Route::put('/dashboard/configuration/update/{config}', [ConfigurationController::class, 'update'])->name('configuration.update');
    Route::get('/dashboard/configuration/delete/{id}', [ConfigurationController::class, 'delete'])->name('configuration.delete');
});
require __DIR__.'/auth.php';
