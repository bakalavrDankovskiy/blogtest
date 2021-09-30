<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\FeedBackMessageController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;

Route::get('/test', function (){
    dd(\App\Facades\Pushall::send('dsadas', 'dsadsa'));
});
/**
 * Авторизация и регистрация
 */
Auth::routes();

/**
 * Вывод всех статей блога
 */
Route::get('/{articles?}', [ArticleController::class, 'index'])
    ->where('articles', 'articles')
    ->name('articles.index');

/**
 * Создать статью
 */
Route::get('/articles/create', [ArticleController::class, 'create'])
    ->name('articles.create');

/**
 * Вывести конкретную статью\
 */
Route::get('/articles/{article:slug}', [ArticleController::class, 'show'])
    ->name('articles.show');

/**
 * Отредактировать статью
 */
Route::get('/articles/{article:slug}/edit', [ArticleController::class, 'edit'])
    ->name('articles.edit');
/**
 * Обновить статью
 */
Route::patch('/articles/{article:slug}', [ArticleController::class, 'update'])
    ->name('articles.update');

/**
 * Удалить статью
 */
Route::delete('/articles/{article:slug}/delete', [ArticleController::class, 'destroy'])
    ->name('articles.delete');

/**
 * Сохранить статью
 */
Route::post('/articles', [ArticleController::class, 'store'])
    ->name('articles.store');

/**
 * Вывести все статьи по тегу {tag}
 */
Route::get('/articles/tags/{tag}', [TagController::class, 'index'])
    ->name('articles.tag');
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
 * Для админов
 */
$groupData = [
    'prefix' => 'admin',
    'middleware' => 'admin',
];
Route::group($groupData, function () {
    /*
     * Главная страница админки
     */
    Route::view('/', 'admin.index')
        ->name('admin.index');

    /**
     * Показ обращений в админке
     */
    Route::get('/feedback', [FeedBackMessageController::class, 'index'])
        ->name('admin.feedback');

    /*
     * Ресурс для статей
     */
    Route::resource('articles', AdminArticleController::class)
        ->names('admin.articles')
        ->except(['create', 'store']);
});

