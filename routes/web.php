<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    // return view('dashboard');

    return redirect()->route('tweet.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// topページ
Route::get('/tweet',\App\Http\Controllers\Tweet\IndexController::class)->name('tweet.index');


Route::middleware('auth')->group(function(){
    //つぶやき作成
    Route::post('/tweet/create',\App\Http\Controllers\Tweet\CreateController::class)->name('tweet.create');

    // 編集
    Route::get('tweet/update/{tweetId}',\App\Http\Controllers\Tweet\Update\IndexController::class)->name('tweet.update.index');
    // 編集更新処理
    Route::put('tweet/update/{tweetId}',\App\Http\Controllers\Tweet\Update\PutController::class)->name('tweet.update.put');

    // 削除
    Route::delete('tweet/delete/{tweetId}',\App\Http\Controllers\Tweet\DeleteController::class)->name('tweet.delete');
});

