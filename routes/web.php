<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\FeedBackMessageController;

/**
 * Вывод всех статей блога
 */
Route::get('/', [ArticleController::class, 'index'])
    ->name('articles.index');

/**
 * Создать статью
 */
Route::get('/articles/create', [ArticleController::class, 'create'])
    ->name('articles.create');

/**
 * Вывести конкретную статью
 */
Route::get('/articles/{article:slug}', [ArticleController::class, 'show'])
    ->name('articles.show');

/**
 * Сохранить статью
 */
Route::post('/articles', [ArticleController::class, 'store'])
    ->name('articles.store');

/**
 * Страница About
 */
Route::get('/about', function () {
    return view('about');
})
    ->name('about');

/**
 * Создание обращения к администрации
 */
Route::get('/contacts', [FeedBackMessageController::class, 'create'])
    ->name('feedbackMessage.create');

/**
 * Сохранение обращения к администрации
 */
Route::post('/contacts/', [FeedBackMessageController::class, 'store'])
    ->name('feedbackMessage.store');

/**
 * Показ обращений в админке
 */
Route::get('/admin/feedback', [FeedBackMessageController::class, 'index'])
    ->name('admin.feedback');
