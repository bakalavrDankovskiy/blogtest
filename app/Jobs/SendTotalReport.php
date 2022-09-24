<?php

namespace App\Jobs;

use App\Models\User;
use App\Services\AdminReporter;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


class SendTotalReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private ?array $tables;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $tables)
    {
        $this->tables = $tables;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        AdminReporter::send($this->tables);
    }
}
