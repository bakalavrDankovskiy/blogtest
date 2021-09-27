<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\User;
use App\Notifications\ArticleCreatedNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;

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
        $articles = Article::where('created_at', '>', $this->formatPeriod())->get();

        if ($articles->isNotEmpty()) {
            foreach ($articles as $article) {
                User::chunk(100, function ($users) use ($article) {
                    $users->each->notify(new ArticleCreatedNotification($article));
                });
            }
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
        $pattern = '/^\d{1,} (years|months|weeks|days|hours|minutes|seconds){1}$/';
        $period = implode(' ', $this->argument('period'));
        preg_match($pattern, $period, $result);

        if (empty($result)) {
            $this->warn("Неправильный формат, введите: {number} {years|months|days|etc}");
            exit;
        } else {
            return explode(' ', $result[0]);
        }
    }
}
