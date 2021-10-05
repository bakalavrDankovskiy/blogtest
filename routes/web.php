<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\FeedBackMessageController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NewsPostController;
use App\Http\Controllers\Admin\NewsPostController as AdminNewsPostController;
use App\Http\Controllers\Admin\StatysticsController;

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
 * Вывести конкретную статью
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
Route::get('/articles/tags/{tag}', [TagController::class, 'articles'])
    ->name('articles.tag');

/**
 * Вывести все новости по тегу {tag}
 */
Route::get('/news/tags/{tag}', [TagController::class, 'newsPosts'])
    ->name('newsPosts.tag');

/**
 * Вывести все новости по тегу {tag}
 */
Route::get('tags/{tag}', [TagController::class, 'index'])
    ->name('index.tag');

/**
 * Вывести конкретную новость
 */
Route::get('/news/{newsPost}', [NewsPostController::class, 'show'])
    ->name('newsPosts.show')
    ->middleware('auth');

/**
 * Вывод всех новостей блога
 */
Route::get('/news', [NewsPostController::class, 'index'])
    ->name('newsPosts.index')
    ->middleware('auth');

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

    /*
     * Ресурс для новостей
     */
    Route::resource('news', AdminNewsPostController::class)
        ->names('admin.newsPosts');

    /**
     * Изменения статей
     */
    Route::get('articles/{article}/changes', function (\App\Models\Article $article) {
        return view('admin.articles.includes.articleHistory.changesHistory', ['histories' => $article->articleChanges]);
    })->name('admin.articles.changes');

    /**
     * Статистика сайта
     */
    Route::get('statystics', [StatysticsController::class, 'index'])
        ->name('admin.statystics');

    /*
     * Создание отчета о сайте
     */
    Route::view('report', 'admin.report')
        ->name('admin.report.view');

    Route::post('report', function (){
        \App\Jobs\AdminReportJob::dispatchNow(request()->input());
    })
    ->name('admin.report.generate');
});



/**
 * Комментарии к статьям
 */
Route::resource('comments', CommentController::class)
    ->only(['store', 'destroy'])
    ->middleware('auth');
