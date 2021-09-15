<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\User;
use App\Notifications\ArticleCreatedNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;

class NotificateUsersAboutNewArticlesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'articles:notificate_users {period*}';

    protected $help = 'period argument format: {int} {months|years|days|etc}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'рассылает всем пользователям сообщение о новых статьях за период, указанный в аргументах этой команды.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        /**
         * @var $articles Collection
         */
        $articles = Article::where('created_at', '>', $this->formatPeriod())->get();

        /**
         * @var $users Collection
         */
        $users = User::all();

        if ($articles->isNotEmpty()) {
            $articles->map(function ($article) use ($users) {
                $users->map->notify(new ArticleCreatedNotification($article));
            });
            $this->line('Уведомления отправлены');
        } else {
            $this->line('Новых статей за этот период нет.');
        }
    }

    private function formatPeriod(): Carbon
    {
        $period = $this->validatePeriod();
        return Carbon::now()->sub($period[1], $period[0]);
    }

    private function validatePeriod(): array
    {
        try {
            $pattern = '/^\d{1,} (years|months|weeks|days|hours|minutes|seconds){1}$/';
            $period = implode(' ', $this->argument('period'));
            preg_match($pattern, $period, $result);
            throw_if(empty($result));
            return explode(' ', $result[0]);
        } catch (\Exception $exception) {
            $this->warn("Неправильный формат, введите: {number} {years|months|days|etc}");
            exit;
        }
    }
}
